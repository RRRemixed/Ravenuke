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

include_once('modules/' . $module_name . '/functions.php');
include_once('header.php');

if (is_user($user)) {
	getusrinfo($user);
	$username = $userinfo['username'];
	define('JOURNAL_ISUSER', true);
} else {
	$username = '';
}

startjournal();
echo '<br />';
OpenTable();
echo '<div align="center"> [ <a href="modules.php?name=' . $module_name . '&amp;op=last">' . _20AUTHORS . '</a> | <a href="modules.php?name=' . $module_name . '&amp;op=all">' . _LISTALLJOURNALS . '</a> | <a href="modules.php?name=' . $module_name . '&amp;file=search&amp;disp=showsearch">' . _SEARCHMEMBER . '</a> ]</div>';
CloseTable();
echo '<br />';
if (!isset($op)) $op = '';

switch ($op) {
	case 'last':
		last20($bgcolor1, $bgcolor2, $bgcolor3, $username);
		break;
	case 'all':
		all($bgcolor1, $bgcolor2, $bgcolor3, $sitename, $username);
		break;
	default:
		last20($bgcolor1, $bgcolor2, $bgcolor3, $username);
		break;
}

echo '<br />';
journalfoot();
die();

/*
 * Everything below this line are functions
 */

 function last20($bgcolor1, $bgcolor2, $bgcolor3, $username) {
	global $prefix, $user_prefix, $db, $module_name;
	OpenTable();
	echo '<div align="center" class="title">' . _20ACTIVE . '</div><br />';
	echo '<table align="center" border="1" cellpadding="0" cellspacing="0">';
	echo '<tr>';
	echo '<td bgcolor="' . $bgcolor1 . '" width="150">&nbsp;<strong>' . _MEMBER . '</strong> ' . _CLICKTOVIEW . '</td>';
	echo '<td bgcolor="' . $bgcolor1 . '" width="70" align="center"><strong>' . _VIEWJOURNAL . '</strong></td>';
	echo '<td bgcolor="' . $bgcolor1 . '" width="70" align="center"><strong>' . _MEMBERPROFILE . '</strong></td>';
	if (empty($username)) {
		echo '<td bgcolor="' . $bgcolor1 . '" width="70" align="center"><strong>' . _CREATEACCOUNT2 . '</strong></td>';
	} else {
		if (is_active('Private_Messages')) {
			echo '<td bgcolor="' . $bgcolor1 . '" width="70" align="center"><strong>' . _PRIVMSGJ . '</strong></td>';
		}
	}
	echo '</tr>';
	$sql = 'SELECT j.id, j.joid, j.nop, j.ldp, j.ltp, j.micro, u.user_id, u.username FROM ' . $prefix . '_journal_stats j, ' . $user_prefix . '_users u where u.username=j.joid ORDER BY j.ldp DESC LIMIT 20';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$row['id'] = intval($row['id']);
		$row['joid'] = check_html($row['joid'], 'nohtml');
		$row['nop'] = check_html($row['nop'], 'nohtml');
		$row['ldp'] = check_html($row['ldp'], 'nohtml');
		$row['ltp'] = check_html($row['ltp'], 'nohtml');
		$row['micro'] = check_html($row['micro'], 'nohtml');
		$row['user_id'] = check_html($row['user_id'], 'nohtml');
		echo '<tr>';
		printf('<td bgcolor="' . $bgcolor2 . '">&nbsp;&nbsp;<a href="modules.php?name=' . $module_name . '&amp;file=search&amp;bywhat=aid&amp;exact=1&amp;forwhat=%s">%s</a></td>', $row['joid'], $row['joid']);
		printf('<td bgcolor="' . $bgcolor2 . '" align="center"><div class="title"><a href="modules.php?name=' . $module_name . '&amp;file=search&amp;bywhat=aid&amp;exact=1&amp;forwhat=%s"><img src="modules/' . $module_name . '/images/binocs.gif" border="0" alt="' . _VIEWJOURNAL2 . '" title="' . _VIEWJOURNAL2 . '" /></a></div></td>', $row['joid'], $row['joid']);
		printf('<td bgcolor="' . $bgcolor2 . '" align="center"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=%s"><img src="modules/' . $module_name . '/images/nuke.gif" alt="' . _USERPROFILE2 . '" title="' . _USERPROFILE2 . '" border="0" /></a></td>', $row['joid'], $row['joid'], $row['joid']);
		if (empty($username)) {
			echo '<td align="center" bgcolor="' . $bgcolor2 . '"><a href="modules.php?name=Your_Account&amp;op=new_user"><img src="modules/' . $module_name . '/images/folder.gif" border="0" alt="' . _CREATEACCOUNT . '" title="' . _CREATEACCOUNT . '" /></a></td>';
		} else {
			if (is_active('Private_Messages')) {
				printf('<td align="center" bgcolor="' . $bgcolor2 . '"><a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $row['user_id'] . '"><img src="modules/' . $module_name . '/images/chat.gif" border="0" alt="' . _PRIVMSGJ2 . '" /></a></td>', $row['joid'], $row['joid']);
			}
		}
		echo '</tr>';
	}
	echo '</table>';
	CloseTable();
}

function all($bgcolor1, $bgcolor2, $bgcolor3, $sitename, $username) {
	global $prefix, $user_prefix, $db, $module_name;
	OpenTable();
	echo '<div align="center" class="title">' . _ALPHABETICAL . '</div><br />';
	echo '<table align="center" border="1" cellpadding="0" cellspacing="0">';
	echo '<tr>';
	echo '<td bgcolor="' . $bgcolor1 . '" width="150">&nbsp;<strong>' . _MEMBER . '</strong> ' . _CLICKTOVIEW . '</td>';
	echo '<td bgcolor="' . $bgcolor1 . '" width="70" align="center"><strong>' . _VIEWJOURNAL . '</strong></td>';
	echo '<td bgcolor="' . $bgcolor1 . '" width="70" align="center"><strong>' . _MEMBERPROFILE . '</strong></td>';
	if (empty($username)) {
		echo '<td bgcolor="' . $bgcolor1 . '" width="70" align="center"><strong>' . _CREATEACCOUNT2 . '</strong></td>';
	} else {
		echo '<td bgcolor="' . $bgcolor1 . '" width="70" align="center"><strong>' . _PRIVMSGJ . '</strong></td>';
	}
	echo ('</tr>');
	$sql = 'SELECT j.id, j.joid, j.nop, j.ldp, j.ltp, j.micro, u.user_id FROM ' . $prefix . '_journal_stats j, ' . $user_prefix . '_users u where u.username=j.joid ORDER BY j.joid';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$row['id'] = intval($row['id']);
		$row['joid'] = check_html($row['joid'], 'nohtml');
		$row['nop'] = check_html($row['nop'], 'nohtml');
		$row['ldp'] = check_html($row['ldp'], 'nohtml');
		$row['ltp'] = check_html($row['ltp'], 'nohtml');
		$row['micro'] = check_html($row['micro'], 'nohtml');
		$row['user_id'] = check_html($row['user_id'], 'nohtml');
		echo '<tr>';
		printf('<td bgcolor="' . $bgcolor2 . '">&nbsp;&nbsp;<a href="modules.php?name=' . $module_name . '&amp;file=search&amp;bywhat=aid&amp;forwhat=%s">%s</a></td>', $row['joid'], $row['joid']);
		printf('<td bgcolor="' . $bgcolor2 . '" align="center"><div class="title"><a href="modules.php?name=' . $module_name . '&amp;file=search&amp;bywhat=aid&amp;forwhat=%s"><img src="modules/' . $module_name . '/images/binocs.gif" border="0" alt="' . _VIEWJOURNAL2 . '" title="' . _VIEWJOURNAL2 . '" /></a></div></td>', $row['joid'], $row['joid']);
		printf('<td bgcolor="' . $bgcolor2 . '" align="center"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=%s"><img src="modules/' . $module_name . '/images/nuke.gif" alt="' . _USERPROFILE2 . '" title="' . _USERPROFILE2 . '" border="0" /></a></td>', $row['joid'], $row['joid'], $row['joid']);
		if (empty($username)) {
			echo '<td align="center" bgcolor="' . $bgcolor2 . '"><a href="modules.php?name=Your_Account&amp;op=new_user"><img src="modules/' . $module_name . '/images/folder.gif" border="0" alt="' . _CREATEACCOUNT . '" title="' . _CREATEACCOUNT . '" /></a></td>';
		} elseif (!empty($username) AND is_active('Private_Messages')) {
			echo '<td align="center" bgcolor="' . $bgcolor2 . '"><a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $row['user_id'] . '"><img src="modules/' . $module_name . '/images/chat.gif" border="0" alt="' . _PRIVMSGJ2 . '" /></a></td>';
		}
		echo '</tr>';
	}
	echo '</table>';
	CloseTable();
}

?>