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
if (!isset($jid) or !is_numeric($jid) or empty($jid)) {
	die('No journal specified.');
} else {
	$jid = intval($jid);
}
$pagetitle = '- ' . _USERSJOURNAL;
include_once('header.php');
include_once('modules/' . $module_name . '/functions.php');
startjournal();
echo '<br />';
OpenTable();
if (!is_user($user) and !is_admin($admin)) {
	echo '<center><b>' . _YOUMUSTBEMEMBER . '</b></center>';
} else {
	echo '<div align="center" class="title"><strong>' . _ABOUTTODELETE . '</strong><br /><br /><img src="modules/' . $module_name . '/images/trash.gif" alt="" />&nbsp;&nbsp;&nbsp;<img src="modules/' . $module_name . '/images/trash.gif" alt="" />&nbsp;&nbsp;&nbsp;<img src="modules/' . $module_name . '/images/trash.gif" alt="" /></div>';
	echo '<br /><div align="center">' . _SUREDELJOURNAL . '<br /><br /><div style="display: inline;">[ <form style="display: inline;" action="modules.php?name=' . $module_name . '&amp;file=deleteyes&amp;jid=' . $jid . '" method="post"><input type="submit" value="' . _YES . '" /></form> | <form style="display: inline;" action="modules.php?name=' . $module_name . '&amp;file=edit" method="post"><input type="submit" value="' . _NO . '" /></form> ]</div></div><br /><br />';
	echo '<div align="center">' . _YOUCANTSAVE . '</div>';
}
CloseTable();
echo '<br />';
journalfoot();
?>