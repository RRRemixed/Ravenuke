<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
$index = 0;
if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
if (defined('INDEX_FILE') AND INDEX_FILE === true) {
	// auto set right blocks for pre patch 3.1 compatibility
	$index = 1;
}
// END: Added in v2.40.00 - Mantis Issue 0001043require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
if (!(isset($new_topic))) $new_topic = 0;
if (!isset($op)) $op = '';
if (!isset($pagenum)) $pagenum = 0;
switch ($op) {
	default:
		theindex(intval($new_topic)); // Converting numerics to integers when passing precludes having to do it in every routine that calls it
		break;
	case 'rate_article':
		csrf_check();
		rate_article(intval($sid) , intval($score)); // Converting numerics to integers when passing precludes having to do it in every routine that calls it
		break;
	case 'rate_complete':
		if (!isset($rated)) {
			$rated = 0;
		}
		rate_complete(intval($sid) , intval($rated)); // Converting numerics to integers when passing precludes having to do it in every routine that calls it
		break;
}
die();
/*
 * Only functions below this line
 */
function theindex($new_topic = 0) {
	global $db, $storyhome, $topicname, $topicimage, $topictext, $datetime, $user, $cookie, $nukeurl, $prefix, $multilingual, $currentlang, $articlecomm, $sitename, $user_news, $userinfo;
	if (is_user($user)) getusrinfo($user);
	if ($multilingual == 1) {
		$querylang = 'AND (alanguage=\'' . $currentlang . '\' OR alanguage=\'\')';
	} else {
		$querylang = '';
	}
	include_once 'header.php';
	if (isset($userinfo['storynum']) AND $user_news == 1) {
		$storynum = $userinfo['storynum'];
	} else {
		$storynum = $storyhome;
	}
	$storynum = intval($storynum);
	if ($new_topic == 0) {
		$qdb = 'WHERE (ihome=0 OR s.catid=0)';
		$home_msg = '';
	} else {
		$qdb = 'WHERE topic=' . $new_topic;
		$result_a = $db->sql_query('SELECT topictext FROM ' . $prefix . '_topics WHERE topicid=\'' . $new_topic . '\'');
		$row_a = $db->sql_fetchrow($result_a);
		$numrows_a = $db->sql_numrows($result_a);
		$topic_title = stripslashes(check_html($row_a['topictext'], 'nohtml'));
		OpenTable();
		if ($numrows_a == 0) {
			echo '<center><font class="title">' . $sitename . '</font><br /><br />' . _NOINFO4TOPIC . '<br /><br />[ <a href="modules.php?name=News">' . _GOTONEWSINDEX . '<    /a> | <a href="modules.php?name=Topics">' . _SELECTNEWTOPIC . '</a> ]</center>';
		} else {
			echo '<center><font class="title">' . $sitename . ': ' . $topic_title . '</font><br /><br />'
				. '<form action="modules.php?name=Search" method="post">'
				. '<input type="hidden" name="topic" value="' . $new_topic . '" />'
				. _SEARCHONTOPIC . ': <input type="text" name="query" size="30" />&nbsp;&nbsp;'
				. '<input type="submit" value="' . _SEARCH . '" />'
				. '</form>'
				. '[ <a href="index.php">' . _GOTOHOME . '</a> | <a href="modules.php?name=Topics">' . _SELECTNEWTOPIC . '</a> ]</center>';
		}
		CloseTable();
		echo '<br />';
	} // END THAT THERE IS A NEW TOPIC
	/*
	* montego:0000727 - the following code was added for news index list paging controls.
	*/
	global $pagenum, $usePaginatorControl, $cfgPaginatorControl; // If you use setQSPage() to change from 'pagenum' to something else, you must change $pagenum here to whatever you used
	$iNumRowsPerPg = $storyhome+1;
	$sql = 'SELECT sid FROM ' . $prefix . '_stories LIMIT 0,' . $iNumRowsPerPg;
	$iTotNewsCount = $db->sql_numrows($db->sql_query($sql));
	if ($iTotNewsCount < $iNumRowsPerPg) $usePaginatorControl = false;
	if (isset($usePaginatorControl) and $usePaginatorControl) {
		$pagenum = intval($pagenum);
		list($iNewsCount) = $db->sql_fetchrow($db->sql_query('SELECT COUNT(sid) AS iNewsCount FROM ' . $prefix . '_stories s ' . $qdb . ' ' . $querylang));
		include_once NUKE_CLASSES_DIR . 'class.paginator.php';
		include_once NUKE_CLASSES_DIR . 'class.paginator_html.php';
		$oPaginator = new Paginator_html($pagenum, $iNewsCount, $storynum);
		$oPaginator->setDefaults($cfgPaginatorControl);
		$oPaginator->set_Links($cfgPaginatorControl['iMaxPages']); // Sets number of links before and after current page to show
		$oPaginator->setLink('modules.php?name=News&amp;new_topic=' . $new_topic);
		$oPaginator->setTotalItems(_PAGINATOR_TOTALSTORIES);
		$sPaginatorHTML = $oPaginator->getPagerHTML() . '<br />';
		if ($cfgPaginatorControl['iPosition'] == 0 or $cfgPaginatorControl['iPosition'] == 2) {
			echo $sPaginatorHTML;
		}
		// SQL for paginator situation
		$result = $db->sql_query('SELECT t.topicname, t.topicimage, t.topictext,t.topicid, s.sid as ssid, s.catid, s.aid, s.title, s.time, s.hometext, s.bodytext, s.comments, s.counter, s.topic, s.informant, s.notes, s.acomm, s.score, s.ratings, s.ihome, c.title as ctitle FROM ' . $prefix . '_stories s LEFT JOIN ' . $prefix . '_topics t ON t.topicid = s.topic LEFT JOIN ' . $prefix . '_stories_cat c ON c.catid=s.catid ' . $qdb . ' ' . $querylang . ' ORDER BY s.sid DESC limit ' . $oPaginator->getStartRow() . ',' . $storynum);
	} else {
		// SQL for non-paginator (could probably combine the two using a variable for the end of the SQL but ... someday
		$result = $db->sql_query('SELECT t.topicname, t.topicimage, t.topictext,t.topicid, s.sid as ssid, s.catid, s.aid, s.title, s.time, s.hometext, s.bodytext, s.comments, s.counter, s.topic, s.informant, s.notes, s.acomm, s.score, s.ratings, s.ihome, c.title as ctitle FROM ' . $prefix . '_stories s LEFT JOIN ' . $prefix . '_topics t ON t.topicid = s.topic LEFT JOIN ' . $prefix . '_stories_cat c ON c.catid=s.catid ' . $qdb . ' ' . $querylang . ' ORDER BY s.sid DESC limit ' . $storynum);
	}
	/*
	* montego:0000727 - end of add
	* fkelly: 787 -- end of standing on the shoulders of giants
	*/
	while ($row = $db->sql_fetchrow($result)) {
		$topicname = $row['topicname'];
		$topicimage = $row['topicimage'];
		$topictext = stripslashes(check_html($row['topictext'], 'nohtml'));
		$sid = intval($row['ssid']);
		$catid = intval($row['catid']);
		$aid = stripslashes($row['aid']);
		$title = stripslashes(check_html($row['title'], 'nohtml'));
		$time = $row['time'];
		$hometext = stripslashes($row['hometext']);
		$bodytext = stripslashes($row['bodytext']);
		$comments = stripslashes($row['comments']);
		$counter = intval($row['counter']);
		$topic = intval($row['topic']);
		$informant = stripslashes($row['informant']);
		$notes = stripslashes($row['notes']);
		$acomm = intval($row['acomm']);
		$score = intval($row['score']);
		$ratings = intval($row['ratings']);
		if ($catid > 0) {
			$cattitle = stripslashes(check_html($row['ctitle'], 'nohtml'));
		}
		formatTimestamp($time);
		$introcount = strlen($hometext);
		$fullcount = strlen($bodytext);
		$totalcount = $introcount+$fullcount;
		$c_count = $comments;
		$story_link = '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">';
		$morelink = '(';
		//RN0000646:BEGIN
		if ($fullcount > 0 || ($c_count > 0 && $articlecomm == 1 && $acomm == 0)) {
			$morelink .= $story_link . '<b>' . _READMORE . '</b></a> | ';
		} else {
			$morelink .= '';
		}
		//RN0000646:END
		if ($fullcount > 0) {
			$morelink .= $totalcount . ' ' . _BYTESMORE . ' | ';
		}
		if ($articlecomm == 1 AND $acomm == 0) {
			if ($c_count == 0) {
				$morelink .= $story_link . _COMMENTSQ . '</a>';
			} elseif ($c_count == 1) {
				$morelink .= $story_link . $c_count . ' ' . _COMMENT . '</a>';
			} elseif ($c_count > 1) {
				$morelink .= $story_link . $c_count . ' ' . _COMMENTS . '</a>';
			}
		}
		if ($catid != 0) {
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT title FROM ' . $prefix . '_stories_cat WHERE catid=\'' . $catid . '\''));
			$title1 = stripslashes(check_html($row3['title'], 'nohtml'));
			$title = '<a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=' . $catid . '"><font class="storycat">' . $title1 . ': </font></a>' . $title;
			$morelink .= ' | <a href="modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=' . $catid . '">' . $title1 . '</a>';
		}
		if ($score != 0) {
			$rated = substr($score/$ratings, 0, 4);
		} else {
			$rated = 0;
		}
		$morelink .= ' | ' . _SCORE . ' ' . $rated;
		$morelink .= ')';
		$morelink = str_replace(' |  | ', ' | ', $morelink);
		$morelink = str_replace('( | ', '(', $morelink); //RN0000646
        themeindex($aid, $informant, $datetime, $title, $counter, $topic, $hometext, $notes, $morelink, $topicname, $topicimage, $topictext);

	} // end of the while loop
	/*
	* montego:0000727 - the following code was added for news index list paging controls.
	*/
	if ((isset($usePaginatorControl) and $usePaginatorControl) and ($cfgPaginatorControl['iPosition'] == 1 or $cfgPaginatorControl['iPosition'] == 2)) {
		echo $sPaginatorHTML;
	}
	/*
	* montego:0000727 - end of add
	*/
	include_once 'footer.php';
}
function rate_article($sid, $score) {
	global $prefix, $db, $ratecookie, $sitename;
	if (!isset($a)) $a = '';
	if (!isset($r_cookie)) $r_cookie = '';
	if (!isset($rcookie)) $rcookie = '';
	if ($score) {
		if ($score > 5) {
			$score = 5;
		}
		if ($score < 1) {
			$score = 1;
		}
		if ($score != 1 AND $score != 2 AND $score != 3 AND $score != 4 AND $score != 5) {
			Header('Location: index.php');
			die();
		}
		if (isset($ratecookie)) {
			$rcookie = base64_decode($ratecookie);
			$rcookie = addslashes($rcookie);
			$r_cookie = explode(':', $rcookie);
		}
		for ($i = 0;$i < sizeof($r_cookie);$i++) {
			if ($r_cookie[$i] == $sid) {
				$a = 1;
			}
		}
		if ($a == 1) {
			Header('Location: modules.php?name=News&op=rate_complete&sid=' . $sid . '&rated=1');
		} else {
			$result = $db->sql_query('update ' . $prefix . '_stories set score=score+' . $score . ', ratings=ratings+1 where sid=\'' . $sid . '\'');
			$info = base64_encode($rcookie . $sid . ':');
			setcookie('ratecookie', $info, time() +3600);
			update_points(7);
			Header('Location: modules.php?name=News&op=rate_complete&sid=' . $sid);
		}
	} else {
		include_once 'header.php';
		title($sitename . ': ' . _ARTICLERATING);
		OpenTable();
		echo '<center>' . _DIDNTRATE . '<br /><br />' . _GOBACK . '</center>';
		CloseTable();
		include_once 'footer.php';
	}
}
function rate_complete($sid, $rated = 0) {
	global $sitename, $user, $cookie, $userinfo;

	include_once 'header.php';
	title($sitename . ': ' . _ARTICLERATING);
	OpenTable();
	if ($rated == 0) {
		echo '<center>' . _THANKSVOTEARTICLE . '<br /><br />'
			. '[ <a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . _BACKTOARTICLEPAGE . '</a> ]</center>';
	} elseif ($rated == 1) {
		echo '<center>' . _ALREADYVOTEDARTICLE . '<br /><br />'
			. '[ <a href="modules.php?name=News&amp;file=article&amp;sid=' . $sid . '">' . _BACKTOARTICLEPAGE . '</a> ]</center>';
	}
	CloseTable();
	include_once 'footer.php';
}
?>
