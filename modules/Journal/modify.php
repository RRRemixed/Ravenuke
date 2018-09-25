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
/* Required: PHPNuke 5.5 ( http://www.phpnuke.org/ ) and phpbb2         */
/* ( http://bbtonuke.sourceforge.net/ ) forums port.                    */
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
include_once('modules/' . $module_name . '/functions.php');
if (!isset($jid) OR !is_numeric($jid)) {
	die('No journal specified.');
} else {
	$jid = intval($jid);
}
$pagetitle = '- ' . _USERSJOURNAL;
include_once('header.php');
startjournal();
echo '<br />';
OpenTable();
if (!is_user($user) and !is_admin($admin)) {
	echo '<center><b>' . _YOUMUSTBEMEMBER . '</b></center>';
	CloseTable();
	echo '<br />';
	journalfoot();
	die();
} elseif (is_user($user)) {
	getusrinfo($user);
	$username = $userinfo['username'];
} else {
	$username = '';
}
echo '<div align="center" class="title">' . _EDITJOURNAL . '</div><br />';
echo '<div align="center"> [ <a href="modules.php?name=' . $module_name . '&amp;file=add">' . _ADDENTRY . '</a> | <a href="modules.php?name=' . $module_name . '&amp;file=edit&amp;op=last">' . _YOURLAST20 . '</a> | <a href="modules.php?name=' . $module_name . '&amp;file=edit&amp;op=all">' . _LISTALLENTRIES . '</a> ]</div>';
CloseTable();
echo '<br />';
OpenTable();
$sql = 'SELECT * FROM ' . $prefix . '_journal WHERE jid = \'' . $jid . '\'';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
	$jaid = check_html($row['aid'], 'nohtml');
	if (!is_admin($admin)) {
		if ($username != $jaid) {
			echo '<div align="center">' . _NOTYOURS . ' <strong>' . $username . '</strong></div>';
			CloseTable();
			echo '<br />';
			journalfoot();
			die();
		}
	}
	$jtitle = check_html($row['title'], 'nohtml');
	$jbodytext = check_html($row['bodytext'], '');
	$jmood = check_html($row['mood'], 'nohtml');
	echo '<form action="modules.php?name=' . $module_name . '&amp;file=edit" method="post">';
	echo '<input type="hidden" name="edit" value="1" />';
	echo '<input type="hidden" name="jid" value="' . $jid . '" />';
	echo '<table align="center" border="0" width="100%">';
	echo '<tr>';
	echo '<td align="right" valign="top"><strong>' . _TITLE . ': </strong></td>';
	printf ('<td valign="top"><input type="text" value="%s" size="50" maxlength="80" name="title" /></td>', $jtitle);
	echo '</tr>';
	echo '<tr>';
	echo '<td align="right" valign="top"><strong>' . _BODY . ': </strong></td>';
	echo '<td valign="top">';
    if (!isset($advanced_editor) || $advanced_editor == 0) $jbodytext = htmlentities($jbodytext, ENT_QUOTES);
	wysiwyg_textarea('jbodytext', $jbodytext, 'NukeUser', '100', '12');
	echo '<br />' . _WRAP . '</td>';
	echo '</tr>';
	$tempcount = 0;
	$checked = '';
	$handle = opendir($jsmiles);
	$filelist = array();
	while ($file = readdir($handle)) {
		$file_ext = strtolower(substr($file, -4));
		if ($file != '.' && $file != '..' && in_array($file_ext, $jsmiles_ext) && is_file($jsmiles . '/' . $file)) {
			$filelist[] = $file;
		}
	}
	if (empty($filelist)) {
		echo '</table></form>';
		CloseTable();
		OpenTable();
		echo '<center><b>' . _ANERROR . '</b></center>';
		CloseTable();
		echo '<br />';
		journalfoot();
		die();
	}
	closedir($handle);
	asort($filelist);
	echo '<tr>';
	echo '<td align="right" valign="top"><strong>' . _LITTLEGRAPH . ': </strong><br />' . _OPTIONAL . '</td>';
	echo '<td valign="top"><table cellpadding="3"><tr>';
	foreach($filelist as $file) {
		if ($file == $jmood) {
			$checked = ' checked="checked"';
		} else {
			$checked = '';
		}
		if ($tempcount == 6) {
			echo '</tr><tr>';
			$tempcount = 0;
		}
		echo '<td><input type="radio" name="mood" value="' . $file . '"' . $checked . ' /></td><td><img src="' . $jsmiles . '/' . $file . '" alt="' . $file . '" title="' . $file . '" /></td>';
		$tempcount = $tempcount + 1;
	}
	if ($tempcount > 0) {
		$tempcount = (6 - $tempcount) * 2;
		echo '<td colspan="' . $tempcount . '">&nbsp;</td>';
	}
	echo '</tr></table>';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td align="right" valign="top"><strong>' . _PUBLIC . ': </strong></td>';
	echo '<td align="left" valign="top">';
	echo '<select name="status">';
	$jstatus = check_html($row['status'], 'nohtml');
	if ($jstatus == 'yes') {
		echo '<option value="yes" selected="selected">' . _YES . '</option>';
	} else {
		echo '<option value="yes">' . _YES . '</option>';
	}
	if ($jstatus == 'no') {
		echo '<option value="no" selected="selected">' . _NO . '</option>';
	} else {
		echo '<option value="no">' . _NO . '</option>';
	}
	echo '</select>';
	echo '</td>';
	echo '</tr><tr>';
	echo '<td colspan="2" align="center"><input type="submit" name="submit" value="' . _MODIFYENTRY . '" /><br /><br />' . _TYPOS . '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</form>';
}
CloseTable();
echo '<br />';
journalfoot();
?>