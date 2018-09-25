<?php
/***************************************************************************/
/* PHP-NUKE: Web Portal System									*/
/* ===========================									*/
/*														*/
/* Copyright (c) 2002 by Francisco Burzi								*/
/* http://phpnuke.org											*/
/*														*/
/* This program is free software. You can redistribute it and/or modify			*/
/* it under the terms of the GNU General Public License as published by			*/
/* the Free Software Foundation; either version 2 of the License.	 			*/
/***************************************************************************/
/*		 Additional security & Abstraction layer conversion		 		*/
/*						   2003 chatserv						*/
/*	  http://www.nukefixes.com -- http://www.nukeresources.com				*/
/**************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
require_once 'mainfile.php';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
define('INDEX_FILE', true);
$categories = 1;
$catid = intval($catid);
$cat = $catid;
switch ($op) {
	case 'newindex':
		if ($catid == 0 OR $catid == '') {
			Header('Location: modules.php?name=' . $module_name);
		}
		theindex($catid);
		break;
	default:
		Header('Location: modules.php?name=' . $module_name);
}
die();
/*
* Only functions below here
*/
function theindex($catid) {
	global $storyhome, $topicname, $topicimage, $topictext, $datetime, $user, $cookie, $nukeurl, $prefix, $multilingual, $currentlang, $db, $articlecomm, $module_name, $userinfo, $user_news;
	if (is_user($user)) {
		getusrinfo($user);
	}
	if ($multilingual == 1) {
		$querylang = 'AND (alanguage=\'' . $currentlang . '\' OR alanguage=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
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
	$catid = intval($catid);
	$db->sql_query('UPDATE ' . $prefix . '_stories_cat SET counter=counter+1 WHERE catid=\'' . $catid . '\'');
	$result = $db->sql_query('SELECT sid, aid, title, time, hometext, bodytext, comments, counter, topic, informant, notes, acomm, score, ratings FROM ' . $prefix . '_stories where catid=\'' . $catid . '\' ' . $querylang . ' ORDER BY sid DESC limit ' . $storynum);
	while ($row = $db->sql_fetchrow($result)) {
		$s_sid = intval($row['sid']);
		$aid = stripslashes($row['aid']);
		$title = stripslashes(check_html($row['title'], 'nohtml'));
		$time = $row['time'];
		$hometext = stripslashes($row['hometext']);
		$bodytext = stripslashes($row['bodytext']);
		$comments = intval($row['comments']);
		$counter = intval($row['counter']);
		$topic = intval($row['topic']);
		$informant = stripslashes($row['informant']);
		$notes = stripslashes($row['notes']);
		$acomm = intval($row['acomm']);
		$score = intval($row['score']);
		$ratings = intval($row['ratings']);
		getTopics($s_sid);
		formatTimestamp($time);
		// note ... subject is a field in nuke queue that gets turned into title in nuke_stories
		// probably not even needed here nor used but I'm leaving it in for safety
		// fkelly 12/20/2006
		if (isset($subject)) {
			$subject = stripslashes(check_html($subject, 'nohtml'));
		} else {
			$subject = '';
		}
		$introcount = strlen($hometext);
		$fullcount = strlen($bodytext);
		$totalcount = $introcount+$fullcount;
		$c_count = $comments;
		$story_link = '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $s_sid . '">';
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
		if ($score != 0) {
			$rated = substr($score/$ratings, 0, 4);
		} else {
			$rated = 0;
		}
		$morelink .= ' | ' . _SCORE . ' ' . $rated;
		$morelink .= ')';
		$morelink = str_replace(' |  | ', ' | ', $morelink);
		$morelink = str_replace('( | ', '(', $morelink); //RN0000646
		$sid = intval($s_sid);
		$row2 = $db->sql_fetchrow($db->sql_query('select title from ' . $prefix . '_stories_cat where catid=\'' . $catid . '\''));
		$title1 = stripslashes(check_html($row2['title'], 'nohtml'));
		$title = $title1 . ': ' . $title;
		themeindex($aid, $informant, $datetime, $title, $counter, $topic, $hometext, $notes, $morelink, $topicname, $topicimage, $topictext);
	}
	include_once 'footer.php';
}
?>