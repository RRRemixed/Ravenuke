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
if (!isset($onwhat) or !is_numeric($onwhat) or empty($onwhat)) {
	die('No journal specified.');
} else {
	$onwhat = intval($onwhat);
}
if (!isset($ref) or !is_numeric($ref) or empty($ref)) {
	die('No journal specified.');
} else {
	$ref = intval($ref);
}
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- ' . _USERSJOURNAL;
include_once('header.php');
include_once('modules/' . $module_name . '/functions.php');
startjournal();
echo '<br />';
openTable();
if (!is_user($user) && !is_admin($admin)) {
	echo '<center><b>' . _YOUMUSTBEMEMBER . '</b></center>';
} elseif (is_admin($admin)) {
	csrf_check();
	$sql = 'DELETE FROM ' . $prefix . '_journal_comments WHERE cid = \'' . $onwhat . '\'';
	$db->sql_query($sql);
	echo '<div align="center">' . _COMMENTDELETED . '<br /><br />';
	echo '[ <a href="modules.php?name=' . $module_name . '&amp;file=display&amp;jid=' . $ref . '">' . _RETURNJOURNAL . '</a> ]</div>';
} else {
	/*
	 * montego: I think the owner of the journal entry should be the ONLY registered user allowed to delete
	 * comments under his/her journal.  I have already re-written the display code to only show the delete in this
	 * case as well.  Therefore, following SQL was modified to validate this.
	 */
	csrf_check();
	 getusrinfo($user);
	$username = $userinfo['username'];
	$sql = 'SELECT cid FROM ' . $prefix . '_journal_comments c, ' . $prefix . '_journal j WHERE c.rid=j.jid AND c.cid = \'' . $onwhat . '\' AND j.aid = \'' . $username . '\'';
	if ($db->sql_query($sql)) { // Ok to delete if the logged in user is also the Journal owner
		$sql = 'DELETE FROM ' . $prefix . '_journal_comments WHERE cid = \'' . $onwhat . '\'';
		$db->sql_query($sql);
		echo ('<div align="center">' . _COMMENTDELETED . '<br /><br />');
		echo ('[ <a href="modules.php?name=' . $module_name . '&amp;file=display&amp;jid=' . $ref . '">' . _RETURNJOURNAL . '</a> ]</div>');
	} else {
		echo 'Begone you miscreant!  Nice try to exploit this code<br />';
	}
}
closeTable();
echo '<br />';
journalfoot();

?>