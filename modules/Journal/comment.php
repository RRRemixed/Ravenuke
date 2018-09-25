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
if (!isset($onwhat) or !is_numeric($onwhat) or empty($onwhat)) {
	die('No journal specified.');
} else {
	$onwhat = intval($onwhat);
}
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include_once('modules/' . $module_name . '/functions.php');
$pagetitle = '- ' . _USERSJOURNAL;
include_once('header.php');
startjournal();
echo '<br />';
OpenTable();
if (!is_user($user)) {
	echo '<center><b>' . _YOUMUSTBEMEMBER . '</b></center>';
} else {
	getusrinfo($user);
	$username = $userinfo['username'];
	$htime = date('h');
	$mtime = date('i');
	$ntime = date('a');
	$mtime = $htime . ':' . $mtime . ' ' . $ntime;
	$mdate = date('m');
	$ddate = date('d');
	$ydate = date('Y');
	$ndate = $mdate . '-' . $ddate . '-' . $ydate;
	$ndate = check_html($ndate, 'nohtml');
	echo '<div align="center" class="title">' . _LEAVECOMMENT . '</div><br /><br />';
	echo '<form action="modules.php?name=' . $module_name . '&amp;file=commentsave" method="post"><input type="hidden" name="rid" value="' . $onwhat . '" />';
	echo '<div align="center">' . _COMMENTBOX . ':<br /><textarea name="comment" cols="55" rows="10"></textarea><br /><br /><input type="submit" name="submit" value="' . _POSTCOMMENT . '" /></div>';
	echo '</form><br />';
	echo '<center>' . _COMMENTSNOTE . '</center>';
}
CloseTable();
echo '<br />';
journalfoot();
?>