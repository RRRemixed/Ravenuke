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

global $prefix, $db;

$content = '';
$sql = 'SELECT eid, title FROM '.$prefix.'_encyclopedia WHERE active=\'1\'';
$result = $db->sql_query($sql);
while (list($eid, $title) = $db->sql_fetchrow($result)) {
	$eid = intval($eid);
	$title = stripslashes($title);
	$content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=Encyclopedia&amp;op=list_content&amp;eid='.$eid.'">'.$title.'</a><br />';
}
?>
