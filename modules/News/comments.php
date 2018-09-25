<?php
/***************************************************************************/
/* PHP-NUKE: Web Portal System									*/
/* ========================================================================*/
/* 														*/
/* Copyright (c) 2002 by Francisco Burzi								*/
/* http://phpnuke.org											*/
/*														*/
/* This program is free software. You can redistribute it and/or modify			*/
/* it under the terms of the GNU General Public License as published by			*/
/* the Free Software Foundation; either version 2 of the License.				*/
/***************************************************************************/
/*	Additional security & Abstraction layer conversion 					*/
/*			2003 chatserv									*/
/*	http://www.nukefixes.com -- http://www.nukeresources.com				*/
/***************************************************************************/
/***************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and 			*/
/* XHTML compliance fixes by Raven and Montego.						*/
/***************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
require_once 'mainfile.php';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
global $admin, $db, $prefix;
if (isset($sid)) {
	$sid = intval($sid);
} else {
	$sid = '';
}
if (isset($tid)) {
	$tid = intval($tid);
} else {
	$tid = '';
}
if (isset($pid)) {
	$pid = intval($pid);
} else {
	$pid = '';
}
/*
 * Get the comment configuration options for use throughout this script.  Going to get the options from the userinfo array
 * instead of passing it around everywhere in the querystring.
 */
$mode = $order = $thold = '';
if (isset($user)) {
	cookiedecode($user);
	if (is_user($user)) {
		getusrinfo($user);
		$mode = strtolower($userinfo['umode']);
		$order = (int)$userinfo['uorder'];
		$thold = (int)$userinfo['thold'];
	}
}
if (empty($mode) || ($mode != 'thread' && $mode != 'nested' && $mode != 'flat' && $mode != 'nocomments')) {
	$mode = 'nested';
}
if (empty($order)) {
	$order = 0;
}
if (empty($thold)) {
	$thold = -1;
}
// End of comment configuration option cleansing
if (!isset($xanonpost)) {
	$xanonpost = 0;
}
if (!isset($anonpost)) {
	$anonpost = 0;
}
if (!isset($op)) {
	$op = '';
}
if (!isset($host_name)) $host_name = '';
// Determine if Admin and if so what level
$admin_comments = addslashes(base64_decode($admin));
$admin_comments = explode(':', $admin_comments);
$aid = addslashes($admin_comments[0]);
$aid = substr($aid, 0, 25);
$row = $db->sql_fetchrow($db->sql_query('SELECT title, admins FROM ' . $prefix . '_modules WHERE title=\'' . $module_name . '\''));
$row2 = $db->sql_fetchrow($db->sql_query('SELECT name, radminsuper FROM ' . $prefix . '_authors WHERE aid=\'' . $aid . '\''));
$admins = explode(',', $row['admins']);
$auth_admin = 0;
if ($row2['radminsuper'] == 1) {
	$adminsuper = 1;
	$thold = -1;
} else {
	$adminsuper = 0;
}
for ($i = 0;$i < sizeof($admins);$i++) {
	if (is_admin($admin) && $row2['name'] == $admins[$i] && $row['admins'] != '') {
		$auth_admin = 1;
		$thold = -1;
	}
}
switch ($op) {
	case 'Reply':
		reply($pid, $sid, $mode, $order, $thold);
		break;
	case _PREVIEW:
		csrf_check();
		replyPreview($pid, $sid, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype);
		break;
	case _OK:
		csrf_check();
		CreateTopic($xanonpost, $subject, $comment, $pid, $sid, $host_name, $mode, $order, $thold, $posttype);
		break;
	case 'moderate':
		csrf_check();
		require_once 'mainfile.php';
		global $admin, $module_name, $user, $userinfo;
		if (($admintest == 1 && is_admin($admin)) || ($admintest == 2 && $moderate == 1 && is_admin($admin)) || ($moderate == 2 && is_user($user))) {
			while (list($tdw, $emp) = each($_POST)) {
				if (stripos_clone($tdw, 'dkn')) {
					$emp = explode(':', $emp);
					if ($emp[1] != 0) {
						$tdw = str_replace('dkn', '', $tdw);
						$emp[0] = intval($emp[0]);
						$emp[1] = intval($emp[1]);
						$tdw = intval($tdw);
						$q = 'UPDATE ' . $prefix . '_comments SET';
						if (($emp[1] == 9) && ($emp[0] >= 0)) { // Overrated
							$q .= ' score=score-1 WHERE tid=\'' . $tdw . '\'';
						} elseif (($emp[1] == 10) && ($emp[0] <= 4)) { // Underrated
							$q .= ' score=score+1 WHERE tid=\'' . $tdw . '\'';
						} elseif (($emp[1] > 4) && ($emp[0] <= 4)) {
							$q .= ' score=score+1, reason=\'' . $emp[1] . '\' WHERE tid=\'' . $tdw . '\'';
						} elseif (($emp[1] < 5) && ($emp[0] > -1)) {
							$q .= ' score=score-1, reason=\'' . $emp[1] . '\' WHERE tid=\'' . $tdw . '\'';
						} elseif (($emp[0] == -1) || ($emp[0] == 5)) {
							$q .= ' reason=' . $emp[1] . ' WHERE tid=\'' . $tdw . '\'';
						}
						if (strlen($q) > 20) $db->sql_query($q);
					}
				}
			}
		}
		Header('Location: modules.php?name=' . $module_name . '&file=article&sid=' . $sid);
		break;
	case 'showreply':
		DisplayTopic($sid, $pid, $tid, $mode, $order, $thold);
		include_once 'footer.php';
		break;
	default:
		if (!empty($tid) AND empty($pid)) {
			singlecomment($tid, $sid, $mode, $order, $thold);
		} elseif (!defined('NUKE_FILE') xor ($pid == 0 AND !isset($pid))) {
			Header('Location: modules.php?name=' . $module_name . '&file=article&sid=' . $sid);
		} else {
			if (!isset($pid)) $pid = 0;
			DisplayTopic($sid, $pid, $tid, $mode, $order, $thold);
		}
		break;
}
//Only functions below this line
function format_url($comment) {
	global $nukeurl;
	unset($location);
	$links = array();
	$hrefs = array();
	$pos = 0;
	while (!(($pos = strpos($comment, '<', $pos)) === false)) {
		$pos++;
		$endpos = strpos($comment, '>', $pos);
		$tag = substr($comment, $pos, $endpos-$pos);
		$tag = trim($tag);
		if (isset($location)) {
			if (!strcasecmp(strtok($tag, ' ') , '/A')) {
				$link = substr($comment, $linkpos, $pos-1-$linkpos);
				$links[] = $link;
				$hrefs[] = $location;
				unset($location);
			}
			$pos = $endpos+1;
		} else {
			if (!strcasecmp(strtok($tag, ' ') , 'A')) {
				if (eregi("HREF[ \t\n\r\v]*=[ \t\n\r\v]*\"([^\"]*)\"",$tag,$regs));
				else if (eregi("HREF[ \t\n\r\v]*=[ \t\n\r\v]*([^ \t\n\r\v]*)",$tag,$regs));
				else $regs[1] = '';
				if ($regs[1]) {
					$location = $regs[1];
				}
				$pos = $endpos+1;
				$linkpos = $pos;
			} else {
				$pos = $endpos+1;
			}
		}
	}
	for ($i = 0;$i < sizeof($links);$i++) {
		if (!stripos_clone($hrefs[$i], 'http://')) {
			$hrefs[$i] = $nukeurl;
		} elseif (!stripos_clone($hrefs[$i], 'mailto://')) {
			$href = explode('/', $hrefs[$i]);
			$href = ' [' . $href[2] . ']';
			$comment = str_replace('>' . $links[$i] . '</a>', ' title="' . $hrefs[$i] . '"> ' . $links[$i] . '</a>' . $href, $comment);
		}
	}
	return ($comment);
}
function modone() {
	global $admin, $adminsuper, $auth_admin, $moderate, $module_name, $user;
	if ($adminsuper == 1 || ($auth_admin == 1 && $moderate == 1) || ($moderate == 2 && $user)) {
		echo '<form action="modules.php?name=', $module_name, '&amp;file=comments" method="post">';
	}
}
function modtwo($tid, $score, $reason) {
	global $admin, $adminsuper, $auth_admin, $moderate, $reasons, $user;
	if ($adminsuper == 1 || ($auth_admin == 1 && $moderate == 1) || ($moderate == 2 && $user)) {
		echo ' | <select name="dkn', $tid, '">';
		for ($i = 0;$i < sizeof($reasons);$i++) {
			echo '<option value="', $score, ':', $i, '">', $reasons[$i], '</option>';
		}
		echo '</select>';
	}
}
function modthree($sid, $mode, $order, $thold = 0) {
	global $admin, $adminsuper, $auth_admin, $moderate, $user;
	if ($adminsuper == 1 || ($auth_admin == 1 && $moderate == 1) || ($moderate == 2 && $user)) {
		echo '<center><input type="hidden" name="sid" value="', $sid, '" />', "\n"
			. '<input type="hidden" name="op" value="moderate" />', "\n";
		if ($adminsuper == 1) {
			echo '<input type="hidden" name="admintest" value="1" />', "\n";
		} elseif ($auth_admin == 1) {
			echo '<input type="hidden" name="admintest" value="2" />', "\n";
		} else {
			echo '<input type="hidden" name="admintest" value="0" />', "\n";
		}
		echo '<input type="image" src="images/menu/moderate.gif" /></center></form>', "\n";
	}
}
function nocomm() {
	OpenTable();
	echo '<center><span class="content">' . _NOCOMMENTSACT . '</span></center>';
	CloseTable();
}
function navbar($sid, $title, $thold, $mode, $order) {
	global $admin, $anonpost, $bgcolor1, $bgcolor2, $cookie, $db, $module_name, $pid, $prefix, $textcolor1, $textcolor2, $userinfo, $user;
	$sid = intval($sid);
	$query = $db->sql_query('SELECT * FROM ' . $prefix . '_comments WHERE sid=\'' . $sid . '\'');
	if (!$query) {
		$count = 0;
	} else {
		$count = $db->sql_numrows($query);
	}
	$query = $db->sql_query('SELECT title FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\'');
	list($un_title) = $db->sql_fetchrow($query);
	if (!isset($thold)) {
		$thold = 0;
	}
	echo "\n\n" . '<!-- COMMENTS NAVIGATION BAR START -->' . "\n\n";
	// Header box
	OpenTable();
	echo '<table width="100%" border="0" cellspacing="1" cellpadding="2">';
	if ($title) {
		echo '<tr><td bgcolor="' . $bgcolor2 . '" align="center"><font color="' . $textcolor1 . '">' . $un_title . ' | ';
		if (is_user($user)) {
			echo '<a href="modules.php?name=Your_Account&amp;op=editcomm">' . _CONFIGURE . '</a>';
		} else {
			echo '<a href="modules.php?name=Your_Account">' . _LOGINCREATE . '</a>';
		}
		if (($count == 1)) {
			echo ' | <b>' . $count . '</b> ' . _COMMENT;
		} else {
			echo ' | <b>' . $count . '</b> ' . _COMMENTS;
		}
		if ($count > 0 AND is_active('Search')) {
			echo ' | <a href="modules.php?name=Search&amp;type=comments&amp;sid=' . $sid . '">' . _SEARCHDIS . '</a>';
		}
		echo '</font></td></tr>';
	}
	if ($anonpost == 1 OR (isset($admin) AND is_admin($admin)) OR is_user($user)) {
		echo '<tr><td align="center" width="100%">';
		echo '<form action="modules.php?name=' . $module_name . '&amp;file=comments" method="post">'
			. '<input type="hidden" name="pid" value="' . $pid . '" />'
			. '<input type="hidden" name="sid" value="' . $sid . '" />'
			. '<input type="hidden" name="op" value="Reply" />'
			. '<input type="submit" value="' . _REPLYMAIN . '" /></form></td></tr>';
	}
	echo '<tr><td bgcolor="' . $bgcolor2 . '" align="center"><font class="tiny">' . _COMMENTSWARNING . '</font></td></tr></table>'
		. "\n\n" . '<!-- COMMENTS NAVIGATION BAR END -->' . "\n\n";
	CloseTable();
	// No Anonomous Posting Box
	if ($anonpost == 0 AND !is_user($user)) {
		OpenTable();
		echo '<center><p>' . _NOANONCOMMENTS . '</p></center>';
		CloseTable();
	}
}
function DisplayKids($tid, $mode, $order = 0, $thold = 0, $level = 0, $dummy = 0, $tblwidth = 99) {
	global $admin, $admin_file, $anonpost, $anonymous, $bgcolor1, $commentlimit, $cookie, $datetime, $db, $module_name, $prefix, $reasons, $textcolor2, $user, $user_prefix, $userinfo;
	$comments = 0;
	static $indentAmt = 0; //Used to help get to XHTML compliance on the nested unordered lists
	if ($level == 0) $indentAmt = 0;
	cookiedecode($user);
	getusrinfo($user);
	$hadUlTag = false; //Used to help get to XHTML compliance on the nested unordered lists
	$hadListTag = false; //Used to help get to XHTML compliance on the nested unordered lists
	$tid = intval($tid);
	$result = $db->sql_query('SELECT tid, pid, sid, date, name, email, host_name, subject, comment, score, reason FROM ' . $prefix . '_comments WHERE pid=\'' . $tid . '\' ORDER BY date, tid');
	if ($mode == 'nested') {
		/* without the tblwidth variable, the tables run of the screen with netscape */
		/* in nested mode in long threads so the text can't be read. */
		while ($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_sid = intval($row['sid']);
			$r_date = $row['date'];
			$r_name = stripslashes($row['name']);
			$r_email = stripslashes($row['email']);
			$r_host_name = $row['host_name'];
			$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$r_comment = stripslashes($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if ($r_score >= $thold) {
				if ($level > 0) {
					$indentAmt = $level+1;
				} else {
					$indentAmt = 1;
				}
				if (!eregi('[a-z0-9]', $r_name)) $r_name = $anonymous;
				if (!eregi('[a-z0-9]', $r_subject)) $r_subject = '[' . _NOSUBJECT . ']';
				echo '<table id="t' . $r_tid . '" width="90%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td width="', $indentAmt*25, '"></td><td>';
				if (is_user($user)) {
					userdate($r_date);
				} else {
					formatTimestamp($r_date);
				}
				echo '<p><b>', $r_subject, '</b> <font color="', $textcolor2, '">';
				if ($userinfo['noscore'] == 0) {
					echo '(', _SCORE, ' ', $r_score;
					if ($r_reason > 0) {
						echo ', ', $reasons[$r_reason];
					}
					echo ')';
				}
				echo '<br />' . _BY . ' ';
				if ($r_email) {
					echo '<a href="mailto:', $r_email, '">', $r_name, '</a></font> <b>(' . $r_email . ')</b> ';
				} else {
					echo $r_name, '</font> ';
				}
				echo _ON, ' ', $datetime;
				if ($r_name != $anonymous) {
					$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users WHERE username=\'' . $r_name . '\''));
					$r_uid = intval($row2['user_id']);
					echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $r_name . '">' . _USERINFO . '</a> ';
					if (is_active('Private_Messages')) {
						echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $r_uid . '">' . _SENDAMSG . '</a>) ';
					} else {
						echo ')';
					}
				}
				$row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM ' . $user_prefix . '_users WHERE username=\'' . $r_name . '\''));
				$url = stripslashes($row_url['user_website']);
				if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) {
					echo '<a href="' . $url . '" target="_blank">' . $url . '</a> ';
				}
				echo '</p></td></tr><tr><td width="', $indentAmt*25, '"></td><td>';
				if ((isset($userinfo['commentmax'])) AND (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax']) . '<br /><br /><b><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;sid=' . $r_sid . '&amp;tid=' . $r_tid . '">' . _READREST . '</a></b>';
				elseif (strlen($r_comment) > $commentlimit) echo substr($r_comment, 0, $commentlimit) . '<br /><br /><b><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;sid=' . $r_sid . '&amp;tid=' . $r_tid . '">' . _READREST . '</a></b>';
				else echo $r_comment . '<br /><br />';
				if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
					echo '<p><font color="' . $textcolor2 . '"> [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid=' . $r_tid . '&amp;sid=' . $r_sid . '">' . _REPLY . '</a>';
				}
				modtwo($r_tid, $r_score, $r_reason);
				if (is_admin($admin)) {
					echo ' | <a href="' . $admin_file . '.php?op=RemoveComment&amp;tid=' . $r_tid . '&amp;sid=' . $r_sid . '">' . _DELETE . '</a> ]</font></p>';
				} elseif ($anonpost != 0 || is_user($user)) {
					echo ' ]</font></p>';
				}
				echo '</td></tr></table>';
				DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1, $tblwidth);
			}
		}
	} elseif ($mode == 'flat') {
		while ($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_sid = intval($row['sid']);
			$r_date = $row['date'];
			$r_name = stripslashes($row['name']);
			$r_email = stripslashes($row['email']);
			$r_host_name = $row['host_name'];
			$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$r_comment = stripslashes($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if ($r_score >= $thold) {
				if (!eregi('[a-z0-9]', $r_name)) $r_name = $anonymous;
				if (!eregi('[a-z0-9]', $r_subject)) $r_subject = '[' . _NOSUBJECT . ']';
				echo '<hr /><table id="t' . $r_tid . '" width="99%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td>';
				if (is_user($user)) {
					userdate($r_date);
				} else {
					formatTimestamp($r_date);
				}
				echo '<p><b>', $r_subject, '</b> <font color="', $textcolor2, '">';
				if ($userinfo['noscore'] == 0) {
					echo '(', _SCORE, ' ', $r_score;
					if ($r_reason > 0) {
						echo ', ', $reasons[$r_reason];
					}
					echo ')';
				}
				echo '<br />' . _BY . ' ';
				if ($r_email) {
					echo '<a href="mailto:', $r_email, '">', $r_name, '</a></font> <b>(' . $r_email . ')</b> ';
				} else {
					echo $r_name, '</font> ';
				}
				echo _ON, ' ', $datetime;
				if ($r_name != $anonymous) {
					$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users WHERE username=\'' . $r_name . '\''));
					$r_uid = intval($row2['user_id']);
					echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $r_name . '">' . _USERINFO . '</a> ';
					if (is_active('Private_Messages')) {
						echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $r_uid . '">' . _SENDAMSG . '</a>) ';
					} else {
						echo ')';
					}
				}
				$row_url2 = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM ' . $user_prefix . '_users WHERE username=\'' . $r_name . '\''));
				$url = stripslashes($row_url2['user_website']);
				if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) {
					echo '<a href="' . $url . '" target="_blank">' . $url . '</a> ';
				}
				echo '</p></td></tr><tr><td>';
				if ((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax']) . '<br /><br /><b><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;sid=' . $r_sid . '&amp;tid=' . $r_tid . '">' . _READREST . '</a></b>';
				elseif (strlen($r_comment) > $commentlimit) echo substr($r_comment, 0, $commentlimit) . '<br /><br /><b><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;sid=' . $r_sid . '&amp;tid=' . $r_tid . '">' . _READREST . '</a></b>';
				else echo $r_comment;
				echo '</td></tr></table><p><font color="' . $textcolor2 . '">';
				if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
					echo ' [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid=' . $r_tid . '&amp;sid=' . $r_sid . '">' . _REPLY . '</a>';
				}
				modtwo($r_tid, $r_score, $r_reason);
				if (is_admin($admin)) {
					echo ' | <a href="' . $admin_file . '.php?op=RemoveComment&amp;tid=' . $r_tid . '&amp;sid=' . $r_sid . '">' . _DELETE . '</a> ]</font></p>';
				} elseif ($anonpost != 0 || is_user($user)) {
					echo ' ]</font></p>';
				}
				DisplayKids($r_tid, $mode, $order, $thold);
			}
		}
	} else {
		while ($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_sid = intval($row['sid']);
			$r_date = $row['date'];
			$r_name = stripslashes($row['name']);
			$r_email = stripslashes($row['email']);
			$r_host_name = $row['host_name'];
			$r_subject = stripslashes(check_html($row['subject'], 'nohtml'));
			$r_comment = stripslashes($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if ($r_score >= $thold) {
				if (isset($level) && !$comments) {
					if ($indentAmt > 0) {
						echo '<li style="list-style:none">';
						$hadListTag = true;
					}
					echo '<ul>';
					$indentAmt++;
					$hadUlTag = true;
				}
				$comments++;
				if (!eregi('[a-z0-9]', $r_name)) $r_name = $anonymous;
				if (!eregi('[a-z0-9]', $r_subject)) $r_subject = '[' . _NOSUBJECT . ']';
				if (is_user($user)) {
					userdate($r_date);
				} else {
					formatTimestamp($r_date);
				}
				echo '<li><font color="' . $textcolor2 . '"><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=showreply&amp;tid=' . $r_tid . '&amp;sid=' . $r_sid . '&amp;pid=' . $r_pid . '#' . $r_tid . '">' . $r_subject . '</a> ' . _BY . ' ' . $r_name . ' ' . _ON . ' ' . $datetime . '</font></li>';
				DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1);
			}
		}
	}
	if ($hadUlTag) echo '</ul>';
	if ($hadListTag && $indentAmt > 1) {
		echo '</li>';
		$indentAmt--;
	}
}
function DisplayTopic($sid, $pid = 0, $tid = 0, $mode = 'thread', $order = 0, $thold = 0, $level = 0, $nokids = 0) {
	global $acomm, $admin, $admin_file, $anonpost, $anonymous, $articlecomm, $bgcolor1, $bgcolor2, $bgcolor3, $commentlimit, $cookie, $datetime, $db, $foot1, $foot2, $foot3, $foot4, $hr, $module_name, $nukeurl, $prefix, $reasons, $textcolor2, $title, $user, $user_prefix, $userinfo;
	include_once 'header.php';
	$count_times = 0;
	cookiedecode($user);
	getusrinfo($user);
	$q = 'SELECT tid, pid, sid, date, name, email, host_name, subject, comment, score, reason FROM ' . $prefix . '_comments WHERE sid=\'' . $sid . '\' and pid=\'' . $pid . '\'';
	if (!empty($thold)) {
		$q .= ' AND score >=\'' . $thold . '\'';
	} else {
		$q .= ' AND score >=0';
	}
	if ($order == 0) $q .= ' ORDER BY date ASC';
	if ($order == 1) $q .= ' ORDER BY date DESC';
	if ($order == 2) $q .= ' ORDER BY score DESC';
	$something = $db->sql_query($q);
	$num_tid = $db->sql_numrows($something);
	if ($acomm == 1) {
		nocomm();
		return;
	}
	echo '<div class="content">';
	if (($acomm == 0) AND ($articlecomm == 1)) {
		navbar($sid, $title, $thold, $mode, $order);
	}
	modone();
	while ($count_times < $num_tid) {
		// Initial comment box
		OpenTable();
		$row_q = $db->sql_fetchrow($something);
		$tid = intval($row_q['tid']);
		$pid = intval($row_q['pid']);
		$sid = intval($row_q['sid']);
		$date = $row_q['date'];
		$c_name = stripslashes($row_q['name']);
		$email = stripslashes($row_q['email']);
		$host_name = $row_q['host_name'];
		$subject = stripslashes(check_html($row_q['subject'], 'nohtml'));
		$comment = stripslashes($row_q['comment']);
		$score = intval($row_q['score']);
		$reason = intval($row_q['reason']);
		if (empty($c_name)) {
			$c_name = $anonymous;
		}
		if (empty($subject)) {
			$subject = '[' . _NOSUBJECT . ']';
		}
		echo '<table id="t' . $tid . '" width="99%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td width="500">';
		if (is_user($user)) {
			userdate($date);
		} else {
			formatTimestamp($date);
		}
		echo '<p><b>', $subject, '</b> <font color="', $textcolor2, '">';
		if ($userinfo['noscore'] == 0) {
			echo '(', _SCORE, ' ', $score;
			if ($reason > 0) {
				echo ', ', $reasons[$reason];
			}
			echo ')';
		}
		echo '<br />' . _BY . ' ';
		if ($email) {
			echo '<a href="mailto:', $email, '">', $c_name, '</a></font> <b>(' . $email . ')</b> ';
		} else {
			echo $c_name, '</font> ';
		}
		echo _ON, ' ', $datetime;
		$journal = '';
		if (is_active('Journal')) {
			$row = $db->sql_fetchrow($db->sql_query('SELECT jid FROM ' . $prefix . '_journal WHERE aid=\'' . $c_name . '\' AND status=\'yes\' ORDER BY pdate,jid DESC LIMIT 0,1'));
			$jid = intval($row['jid']);
			if (!empty($jid) AND isset($jid)) {
				$journal = ' | <a href="modules.php?name=Journal&amp;file=display&amp;jid=' . $jid . '">' . _JOURNAL . '</a>';
			} else {
				$journal = '';
			}
		}
		if ($c_name != $anonymous) {
			$row2 = $db->sql_fetchrow($db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users WHERE username=\'' . $c_name . '\''));
			$r_uid = intval($row2['user_id']);
			echo '<br />(<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $c_name . '">' . _USERINFO . '</a> ';
			if (is_active('Private_Messages')) {
				echo '| <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $r_uid . '">' . _SENDAMSG . '</a>';
			}
			echo $journal . ') ';
		}
		$row_url = $db->sql_fetchrow($db->sql_query('SELECT user_website FROM ' . $user_prefix . '_users WHERE username=\'' . $c_name . '\''));
		$url = stripslashes($row_url['user_website']);
		if ($url != 'http://' AND !empty($url) AND stripos_clone($url, 'http://')) {
			echo '<a href="' . $url . '" target="new">' . $url . '</a> ';
		}
		if (is_admin($admin)) {
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT host_name FROM ' . $prefix . '_comments WHERE tid=\'' . $tid . '\''));
			$host_name = $row3['host_name'];
			echo '<br /><b>(IP: ' . $host_name . ')</b>';
		}
		echo '</p></td></tr><tr><td>';
		if ((isset($userinfo['commentmax'])) AND (strlen($comment) > $userinfo['commentmax'])) echo substr($comment, 0, $userinfo['commentmax']) . '<br /><br /><b><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;sid=' . $sid . '&amp;tid=' . $tid . '">' . _READREST . '</a></b>';
		elseif (strlen($comment) > $commentlimit) echo substr($comment, 0, $commentlimit) . '<br /><br /><b><a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;sid=' . $sid . '&tid=' . $tid . '">' . _READREST . '</a></b>';
		else echo $comment;
		echo '<br /><br />';
		if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
			echo ' [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid=' . $tid . '&amp;sid=' . $sid . '">' . _REPLY . '</a>';
		}
		if ($pid != 0) {
			$row4 = $db->sql_fetchrow($db->sql_query('SELECT pid FROM ' . $prefix . '_comments WHERE tid=\'' . $pid . '\''));
			$erin = intval($row4['pid']);
			echo ' | <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;sid=' . $sid . '&amp;pid=' . $erin . '">' . _PARENT . '</a>';
		}
		modtwo($tid, $score, $reason);
		if (is_admin($admin)) {
			echo ' | <a href="' . $admin_file . '.php?op=RemoveComment&amp;tid=' . $tid . '&amp;sid=' . $sid . '">' . _DELETE . '</a> ]<br /><br />';
		} elseif ($anonpost != 0 || is_user($user)) {
			echo ' ]';
		}
		echo '</td></tr></table>';
		DisplayKids($tid, $mode, $order, $thold, $level);
		if ($hr) echo '<hr noshade="noshade" size="1" />';
		$count_times+=1;
		CloseTable();
	}
	modthree($sid, $mode, $order, $thold);
	echo '</div>';
}
function singlecomment($tid, $sid, $mode, $order, $thold) {
	global $admin, $admin_file, $anonpost, $anonymous, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $cookie, $db, $datetime, $module_name, $prefix, $reasons, $textcolor2, $user, $userinfo;
	include_once 'header.php';
	cookiedecode($user);
	getusrinfo($user);
	$row = $db->sql_fetchrow($db->sql_query('SELECT date, name, email, subject, comment, score, reason FROM ' . $prefix . '_comments WHERE tid=\'' . $tid . '\' AND sid=\'' . $sid . '\''));
	$date = $row['date'];
	$name = stripslashes($row['name']);
	$email = stripslashes($row['email']);
	$subject = stripslashes(check_html($row['subject'], 'nohtml'));
	$comment = stripslashes($row['comment']);
	$score = intval($row['score']);
	$reason = intval($row['reason']);
	$titlebar = '<b>$subject</b>';
	if (empty($name)) $name = $anonymous;
	if (empty($subject)) $subject = '[' . _NOSUBJECT . ']';
	title($subject);
	OpenTable();
	echo '<div class="content">';
	modone();
	echo '<table width="99%" border="0"><tr bgcolor="' . $bgcolor1 . '"><td width="500">';
	if (is_user($user)) {
		userdate($date);
	} else {
		formatTimestamp($date);
	}
	echo '<p><b>', $subject, '</b> <font color="', $textcolor2, '">';
	if ($userinfo['noscore'] == 0) {
		echo '(', _SCORE, ' ', $score;
		if ($reason > 0) {
			echo ', ', $reasons[$reason];
		}
		echo ')';
	}
	echo '<br />' . _BY . ' ';
	if ($email) {
		echo '<a href="mailto:', $email, '">', $name, '</a></font> <b>(' . $email . ')</b> ';
	} else {
		echo $name, '</font> ';
	}
	echo _ON, ' ', $datetime;
	echo '</p></td></tr><tr><td>' . $comment . '</td></tr></table><br /><br />';
	if ($anonpost == 1 OR is_admin($admin) OR is_user($user)) {
		echo ' [ <a href="modules.php?name=' . $module_name . '&amp;file=comments&amp;op=Reply&amp;pid='
			. $tid . '&amp;sid=' . $sid . '">' . _REPLY . '</a> | <a href="modules.php?name='
			. $module_name . '&amp;file=article&amp;sid=' . $sid . '">' . _ROOT . '</a>';
	}
	modtwo($tid, $score, $reason);
	if (is_admin($admin)) {
		echo ' | <a href="' . $admin_file . '.php?op=RemoveComment&amp;tid=' . $tid . '&amp;sid=' . $sid . '">' . _DELETE . '</a> ]<br /><br />';
	} elseif ($anonpost != 0 || is_user($user)) {
		echo ' ]';
	}
	modthree($sid, $mode, $order, $thold);
	echo '</div>';
	CloseTable();
	include_once 'footer.php';
}
function reply($pid, $sid, $mode, $order, $thold) {
	include_once 'header.php';
	global $AllowableHTML, $anonpost, $anonymous, $bgcolor1, $bgcolor2, $bgcolor3, $cookie, $datetime, $db, $modGFXChk, $module_name, $prefix, $reasons, $user, $userinfo;
	cookiedecode($user);
	getusrinfo($user);
	echo '<div class="content">';
	if ($anonpost == 0 AND !is_user($user)) {
		title(_COMMENTREPLY);
		OpenTable();
		echo '<center><p>' . _NOANONCOMMENTS . '</p><p>' . _GOBACK . '</p></center>';
		CloseTable();
	} else {
		if ($pid != 0) {
			list($date, $name, $email, $subject, $comment, $score, $reason) = $db->sql_fetchrow($db->sql_query('select date, name, email, subject, comment, score, reason from ' . $prefix . '_comments where tid=\'' . $pid . '\''));
			$score = intval($score);
			$reason = intval($reason);
			if (!validateEmailFormat($email)) {
				$email = '';
			}
		} else {
			list($date, $subject, $temp_comment, $comment2, $name, $notes) = $db->sql_fetchrow($db->sql_query('SELECT time, title, hometext, bodytext, informant, notes FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\''));
		}
		if (empty($comment)) {
			$comment = $temp_comment . '<br /><br />' . $comment2;
		}
		title(_COMMENTREPLY);
		OpenTable();
		if (empty($name)) $name = $anonymous;
		if (empty($subject)) $subject = '[' . _NOSUBJECT . ']';
		if (is_user($user)) {
			userdate($date);
		} else {
			formatTimestamp($date);
		}
		echo '<b>' . $subject . '</b> ';
		if (empty($temp_comment)) {
			if ($userinfo['noscore'] == 0) {
				echo '(', _SCORE, ' ', $score;
				if ($reason > 0) {
					echo ', ', $reasons[$reason];
				}
				echo ')';
			}
		}
		if (!empty($email)) {
			echo '<br />' . _BY . ' <a href="mailto:' . $email . '">' . $name . '</a> <b>(' . $email . ')</b> ' . _ON . ' ' . $datetime;
		} else {
			echo '<br />' . _BY . ' ' . $name . ' ' . _ON . ' ' . $datetime;
		}
		echo '<br /><br />' . $comment . '<br /><br />';
		if ($pid == 0) {
			if (!empty($notes)) {
				echo '<b>' . _NOTE . '</b> <i>' . $notes . '</i><br /><br />';
			} else {
				echo '';
			}
		}
		if (!isset($pid) || !isset($sid)) {
			echo _SOMETHINGSNOTRIGHT;
			exit();
		}
		if ($pid == 0) {
			$row3 = $db->sql_fetchrow($db->sql_query('SELECT title FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\''));
			$subject = stripslashes(check_html($row3['title'], 'nohtml'));
		} else {
			$row4 = $db->sql_fetchrow($db->sql_query('SELECT subject FROM ' . $prefix . '_comments WHERE tid=\'' . $pid . '\''));
			$subject = stripslashes(check_html($row4['subject'], 'nohtml'));
		}
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<form action="modules.php?name=' . $module_name . '&amp;file=comments" method="post">';
		echo '<font class="option"><b>' . _YOURNAME . ':</b></font> ';
		if (is_user($user)) {
			cookiedecode($user);
			echo '<a href="modules.php?name=Your_Account">' . $cookie[1] . '</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">' . _LOGOUT . '</a> ]<br /><br />';
		} else {
			echo $anonymous;
			echo ' [ <a href="modules.php?name=Your_Account">' . _NEWUSER . '</a> ]<br /><br />';
		}
		echo '<font class="option"><b>' . _SUBJECT . ':</b></font><br />';
		if (!stripos_clone($subject, 'Re:')) $subject = 'Re: ' . substr($subject, 0, 81);
		echo '<input type="text" name="subject" size="50" maxlength="85" value="' . $subject . '" /><br /><br />';
		echo '<font class="option"><b>' . _UCOMMENT . ':</b></font><br />'
			. '<textarea cols="50" rows="10" name="comment"></textarea><br />'
			. _ALLOWEDHTML . '<br />';
		while (list($key) = each($AllowableHTML)) echo ' &lt;' . $key . '&gt;';
		echo '<br />';
		if (is_user($user) AND ($anonpost == 1)) {
			echo '<input type="checkbox" name="xanonpost" /> ' . _POSTANON . '<br />';
		}
		echo '<br />' . security_code($modGFXChk[$module_name], 'stacked') . '<br />';
		echo '<input type="hidden" name="pid" value="' . $pid . '" />'
			. '<input type="hidden" name="sid" value="' . $sid . '" />'
			. '<input type="submit" name="op" value="' . _PREVIEW . '" />'
			. '<input type="submit" name="op" value="' . _OK . '" />'
			. '<select name="posttype">'
			. '<option value="exttrans">' . _EXTRANS . '</option>'
			. '<option value="html">' . _HTMLFORMATED . '</option>'
			. '<option value="plaintext" selected="selected">' . _PLAINTEXT . '</option>'
			. '</select></form>';
		CloseTable();
	}
	echo '</div>';
	include_once 'footer.php';
}
function replyPreview($pid, $sid, $subject, $comment, $xanonpost, $mode, $order, $thold, $posttype) {
	global $AllowableHTML, $anonymous, $anonpost, $cookie, $modGFXChk, $module_name, $user, $userinfo;
	include_once 'header.php';
	cookiedecode($user);
	getusrinfo($user);
	echo '<div class="content">';
	title(_COMREPLYPRE);
	OpenTable();
	cookiedecode($user);
	$subject = stripslashes(check_html($subject, 'nohtml'));
	$comment = stripslashes($comment);
	if (!isset($pid) OR !isset($sid)) {
		die(_NOTRIGHT);
	}
	echo '<p><b>' . $subject . '</b><br />';
	echo _BY . ' ';
	if (is_user($user)) {
		echo $cookie[1];
	} else {
		echo $anonymous;
	}
	echo ' ' . _ONN . '</p>';
	if ($posttype == 'exttrans') {
		echo nl2br(htmlspecialchars($comment));
	} elseif ($posttype == 'plaintext') {
		echo nl2br($comment);
	} else {
		echo $comment;
	}
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<form action="modules.php?name=' . $module_name . '&amp;file=comments" method="post"><p><b>' . _YOURNAME . ':</b> ';
	if (is_user($user)) {
		echo '<a href="modules.php?name=Your_Account">' . $cookie[1] . '</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">' . _LOGOUT . '</a> ]';
	} else {
		echo $anonymous;
	}
	echo '</p><p><b>' . _SUBJECT . ':</b><br />'
		. '<input type="text" name="subject" size="50" maxlength="85" value="' . $subject . '" /></p>'
		. '<p><b>' . _UCOMMENT . ':</b><br />'
		. '<textarea cols="50" rows="10" name="comment">' . htmlentities($comment, ENT_QUOTES) . '</textarea></p>'
		. '<p>' . _ALLOWEDHTML . '<br />';
	while (list($key,) = each($AllowableHTML)) echo ' &lt;' . $key . '&gt;';
	echo '</p>';
	if (($xanonpost) AND ($anonpost == 1)) {
		echo '<input type="checkbox" name="xanonpost" checked="checked" /> ' . _POSTANON . '<br />';
	} elseif ((is_user($user)) AND ($anonpost == 1)) {
		echo '<input type="checkbox" name="xanonpost" /> ' . _POSTANON . '<br />';
	}
	echo '<br />' . security_code($modGFXChk[$module_name], 'stacked') . '<br />';
	echo '<input type="hidden" name="pid" value="' . $pid . '" />'
		. '<input type="hidden" name="sid" value="' . $sid . '" />'
		. '<input type="submit" name="op" value="' . _PREVIEW . '" />'
		. '<input type="submit" name="op" value="' . _OK . '" />'
		. '<select name="posttype"><option value="exttrans"';
	if ($posttype == 'exttrans') {
		echo ' selected="selected"';
	}
	echo '>' . _EXTRANS . '</option>'
		. '<option value="html"';
	if ($posttype == 'html') {
		echo ' selected="selected"';
	}
	echo '>' . _HTMLFORMATED . '</option>'
		. '<option value="plaintext"';
	if (($posttype != 'exttrans') && ($posttype != 'html')) {
		echo ' selected="selected"';
	}
	echo '>' . _PLAINTEXT . '</option></select></form>';
	CloseTable();
	echo '</div>';
	include_once 'footer.php';
}
function CreateTopic($xanonpost, $subject, $comment, $pid, $sid, $host_name, $mode, $order, $thold, $posttype) {
	global $anonpost, $articlecomm, $cookie, $db, $EditedMessage, $modGFXChk, $module_name, $prefix, $user, $userinfo;
	if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check'];
	else $gfx_check = '';
	if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
		include_once 'header.php';
		OpenTable();
		echo '<center><font class="option"><b><i>' . _SECCODEINCOR . '</i></b></font><br /><br />';
		echo '[ <a href="javascript:history.go(-1)">' . _GOBACK2 . '</a> ]</center>';
		CloseTable();
		include_once 'footer.php';
		die();
	}
	cookiedecode($user);
	getusrinfo($user);
	$subject = FixQuotes(filter_text($subject, 'nohtml'));
	$comment = format_url(trim($comment));
	if ($posttype == 'exttrans') {
		$comment = FixQuotes(nl2br(htmlspecialchars(check_words($comment))));
	} elseif ($posttype == 'plaintext') {
		$comment = FixQuotes(nl2br(filter_text($comment)));
	} else {
		$comment = FixQuotes(stripslashes(filter_text($comment)));
	}
	if (is_user($user) AND !$xanonpost) {
		$name = $userinfo['username'];
		$email = $userinfo['femail'];
		$url = $userinfo['user_website'];
		$score = 1;
	} else {
		$name = '';
		$email = '';
		$url = '';
		$score = 0;
	}
	if (empty($ip)) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	if (!validIP($ip)) $ip = '';
	$fakeresult = $db->sql_query('SELECT acomm FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\'');
	$fake = $db->sql_numrows($fakeresult);
	if ($fake == 1 AND $articlecomm == 1) {
		$fakerow = $db->sql_fetchrow($fakeresult);
		$acomm = intval($fakerow['acomm']);
		if ((($anonpost == 0 AND is_user($user)) OR $anonpost == 1) AND $acomm == 0) {
			$db->sql_query('INSERT INTO ' . $prefix . '_comments VALUES (NULL, \'' . $pid . '\', \'' . $sid . '\', now(), \'' . $name . '\', \'' . $email . '\', \'' . $url . '\', \'' . $ip . '\', \'' . $subject . '\', \'' . $comment . '\', \'' . $score . '\',\'0\')');
			$db->sql_query('UPDATE ' . $prefix . '_stories SET comments=comments+1 WHERE sid=\'' . $sid . '\'');
			update_points(5);
		} else {
			die(_NICETRY);
		}
	} else {
		include_once 'header.php';
		echo _ANNOYINGMSG;
		include_once 'footer.php';
	}
	Header('Location: modules.php?name=' . $module_name . '&file=article&sid=' . $sid);
}
function userdate($time) {
	global $datetime, $timestamp, $userinfo;
	convert_datetime($time);
	$userTimeZone = $userinfo['user_timezone'];
	$userDateFormat = $userinfo['user_dateformat'];
	$serverTimeZone = date('Z') /3600;
	if ($serverTimeZone >= 0) {
		$serverTimeZone = '+' . $serverTimeZone;
	}
	$userTimeZone = ($userTimeZone-$serverTimeZone) *3600;
	if (!is_numeric($userTimeZone)) {
		$userTimeZone = 0;
	}
	$datetime = date($userDateFormat, ($timestamp+$userTimeZone));
	return $datetime;
}
// from MySQL to UNIX timestamp
function convert_datetime($str) {
	global $timestamp;
	list($date, $time) = explode(' ', $str);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);
	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	return $timestamp;
}
?>