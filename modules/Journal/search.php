<?php
/************************************************************************/
/* Journal &#167 ZX                                                     */
/* ================                                                     */
/*                                                                      */
/* Original work done by Joseph Howard known as Member's Journal, which */
/* was based on Trevor Scott's vision of Atomic Journal.                */
/*                                                                      */
/* Modified on 25 May 2002 by Paul Laudanski (paul@computercops.biz)    */
/* Copyright (c) 2002 Modifications by Computer Cops.                   */
/* http://computercops.biz                                              */
/*                                                                      */
/* Member's Journal did not work on a PHPNuke 5.5 portal which had      */
/* phpbb2 port integrated.  Thus was Journal &#167 ZX created with the  */
/* Member's Journal author's blessings.                                 */
/*                                                                      */
/* To install, backup everything first and then FTP the Journal package */
/* files into your site's module directory.  Also run the tables.sql    */
/* script so the proper tables and fields can be created and used.  The */
/* default table prefix is "nuke" which is hard-coded throughout the    */
/* entire system as a left-over from Member's Journal.  If a demand     */
/* exists, that can be changed for a future release.                    */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/
/* Journal 2.0 Enhanced and Debugged 2004                               */
/* by sixonetonoffun -- http://www.netflake.com --                      */
/* Images Created by GanjaUK -- http://www.GanjaUK.com                  */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, bug fixes, and   */
/* W3C XHTML compliance fixes by Montego - http://montegoscripts.com.   */
/************************************************************************/
if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- ' . _USERSJOURNAL;
include_once('header.php');
include_once('modules/' . $module_name . '/functions.php');
if (!isset($bywhat)) {
	$bywhat = 'naddaanythang';
} else {
	$bywhat = check_html($bywhat, 'nohtml');
}
if (!isset($forwhat)) {
	$forwhat = 'naddaanythang';
} else {
	$forwhat = check_html($forwhat, 'nohtml');
}
if (isset($disp)) {
	$disp = check_html($disp, 'nohtml');
} else {
	$disp = '';
}
startjournal();
echo '<br />';
OpenTable();
switch ($disp) {
	case 'showsearch':
		displaySearch($bgcolor2, $bgcolor3, $bgcolor1, $forwhat);
		break;
	case 'search':
		search($bywhat, $forwhat, $bgcolor2, $bgcolor3);
		break;
	default:
		search($bywhat, $forwhat, $bgcolor2, $bgcolor3);
		break;
}
CloseTable();
echo '<br />';
journalfoot();
die();
/*
 * Everything below this line are functions
 */
function displaySearch($bgcolor2, $bgcolor3, $bgcolor1) {
	global $module_name;
	echo '<div align="center" class="title">';
	echo '<strong>' . _JOURNALSEARCH . '</strong></div><br /><br />';
	echo '<div align="center">';
	echo '<form action="modules.php?name=' . $module_name . '&amp;file=search" method="post">';
	echo '<input type="hidden" name="disp" value="search" />';
	echo '<input type="text" name="forwhat" size="30" maxlength="150" /> ' . _IN . ' <select name="bywhat">';
	echo '<option value="aid" selected="selected">' . _MEMBER . '</option>';
	echo '<option value="title">' . _TITLE . '</option>';
	echo '<option value="bodytext">' . _BODYTEXT . '</option>';
	echo '<option value="comment">' . _UCOMMENTS . '</option>';
	echo '</select>&nbsp;&nbsp;<input type="submit" name="submit" value="' . _SEARCH . '" />';
	echo '</form>';
	echo '</div>';
}
function search($bywhat, $forwhat, $bgcolor2, $bgcolor3) {
	global $prefix, $user_prefix, $db, $module_name, $exact, $bgcolor1, $username;
	echo '<div align="center">';
	$exact = intval($exact);
	if ($exact == '1') {
		echo '<strong>' . _JOURNALFOR . ': "' . $forwhat . '"</strong><br /><br />';
	} else {
		echo '<strong>' . _SEARCHRESULTS . ': "' . $forwhat . '"</strong><br /><br />';
	}
	if ($forwhat == 'naddaanythang') {
		displaySearch($bgcolor2, $bgcolor3, $bgcolor1);
	} else {
		echo '<table align="center" width="90%" border="2">';
		echo '<tr>';
		echo '<td align="center" width="100"><strong>' . _PROFILE . '</strong></td>';
		echo '<td align="center"><strong>' . _TITLE . '</strong> ' . _CLICKTOVIEW . '</td>';
		echo '<td align="center" width="5%"><strong>' . _VIEW . '</strong></td>';
		echo '<td align="center" width="5%"><strong>' . _PROFILE . '</strong></td>';
		echo '</tr>';
		$forwhat = addslashes($forwhat);
		if ($bywhat == 'aid') {
			if ($exact == '1') {
				$sql = 'SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ' . $prefix . '_journal j, ' . $user_prefix . '_users u WHERE u.username=j.aid AND j.aid=\'' . $forwhat . '\' ORDER BY j.jid DESC';
			} else {
				$sql = 'SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ' . $prefix . '_journal j, ' . $user_prefix . '_users u WHERE u.username=j.aid AND j.aid LIKE \'%' . $forwhat . '%\' ORDER BY j.jid DESC';
			}
		} elseif ($bywhat == 'title') {
			$sql = 'SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ' . $prefix . '_journal j, ' . $user_prefix . '_users u WHERE u.username=j.aid AND j.title LIKE \'%' . $forwhat . '%\' ORDER BY j.jid DESC';
		} elseif ($bywhat == 'bodytext') {
			$sql = 'SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ' . $prefix . '_journal j, ' . $user_prefix . '_users u WHERE u.username=j.aid AND j.bodytext LIKE \'%' . $forwhat . '%\' ORDER BY j.jid DESC';
		} elseif ($bywhat == 'comment') {
			$sql = 'SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ' . $prefix . '_journal j, ' . $user_prefix . '_users u, ' . $user_prefix . '_journal_comments c WHERE u.username=j.aid AND c.rid=j.jid AND c.comment LIKE \'%' . $forwhat . '%\' ORDER BY j.jid DESC';
		}
		$dcount = 0;
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$row['jid'] = intval($row['jid']);
			$row['aid'] = check_html($row['aid'], 'nohtml');
			$row['title'] = check_html($row['title'], 'nohtml');
			$row['pdate'] = check_html($row['pdate'], 'nohtml');
			$row['ptime'] = check_html($row['ptime'], 'nohtml');
			$row['status'] = check_html($row['status'], 'nohtml');
			$row['mdate'] = check_html($row['mdate'], 'nohtml');
			$row['mtime'] = check_html($row['mtime'], 'nohtml');
			$row['user_id'] = check_html($row['user_id'], 'nohtml');
			$row['username'] = check_html($row['username'], 'nohtml');
			if ($row['status'] == 'no') {
				$dcount = $dcount + 0;
			} else {
				$dcount = $dcount + 1;
				echo '<tr>';
				printf('<td align="center" bgcolor="' . $bgcolor2 . '"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $row['username'] . '">%s</a></td>', $row['aid'], $row['aid']);
				printf('<td align="left" bgcolor="' . $bgcolor2 . '">&nbsp;<a href="modules.php?name=' . $module_name . '&amp;file=display&amp;jid=%s">%s</a> <span class="tiny">(%s @ %s)</span>', $row['jid'], $row['title'], $row['pdate'], $row['ptime']);
				$sqlscnd = 'SELECT cid FROM ' . $prefix . '_journal_comments WHERE rid=' . $row['jid'];
				$rstscnd = $db->sql_query($sqlscnd);
				$scndcount = 0;
				while ($rowscnd = $db->sql_fetchrow($rstscnd)) {
					$scndcount = $scndcount+1;
				}
				if ($scndcount > 0) {
					printf(' &#151;&#151; ' . $scndcount . ' comments</td>');
				} else {
					echo '</td>';
				}
				printf('<td align="center" bgcolor="' . $bgcolor2 . '"><a href="modules.php?name=' . $module_name . '&amp;file=display&amp;jid=%s"><img src="modules/' . $module_name . '/images/read.gif" border="0" alt="' . _READ . '" title="' . _READ . '" /></a></td>', $row['jid'], $row['title']);
				printf('<td align="center" bgcolor="' . $bgcolor2 . '"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $row['username'] . '"><img src="modules/' . $module_name . '/images/nuke.gif" border="0" alt="' . _USERPROFILE2 . '" title="' . _USERPROFILE2 . '" /></a></td>');
				echo '</tr>';
			}
		}
		echo '</table>';
		if (empty($dcount)) {
			$dcount = 0;
		}
		echo '<br />' . $dcount . ' ' . _PUBLICFOR . ' "' . $forwhat . '"';
	}
	echo '</div>';
}
?>