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
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

if (!defined('BLOCK_FILE')) {
	Header('Location: ../index.php');
	die();
}

global $cookie, $prefix, $multilingual, $currentlang, $db, $user, $userinfo;

if ($multilingual == 1) {
	$querylang = 'AND (alanguage=\''.$currentlang.'\' OR alanguage=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
} else {
	$querylang = '';
}

$today = getdate();
$day = $today['mday'];
if ($day < 10) {
	$day = '0' . $day;
}
$month = $today['mon'];
if ($month < 10) {
	$month = '0' . $month;
}
$year = $today['year'];
$tdate = $year . '-' . $month . '-' . $day;
$sql = 'SELECT sid, title FROM ' . $prefix . '_stories WHERE (time LIKE \'%' . $tdate . '%\') ' . $querylang . ' ORDER BY counter DESC LIMIT 0,1';
$query = $db->sql_query($sql);
list($sid, $title) = $db->sql_fetchrow($query);
$fsid = intval($sid);
$ftitle = check_html($title, 'nohtml');
$content = '<span class="content">';
if ((!$fsid) AND (!$ftitle)) {
	$content .= _NOBIGSTORY . '</span>';
} else {
	$content .= _BIGSTORY . '<br /><br />';
	$content .= '<a href="modules.php?name=News&amp;file=article&amp;sid=' . $fsid . '">' . $ftitle . '</a></span>';
}
?>