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

if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

global $prefix, $db;

$content = '';
$sql = 'SELECT id, title FROM '.$prefix.'_reviews ORDER BY id DESC LIMIT 0,10';
$result = $db->sql_query($sql);
while (list($id, $title) = $db->sql_fetchrow($result)) {
	$id = intval($id); // montego:0000763 - even this line is unnecessary because this field is ALWAYS an integer coming off the db!
//	$title = stripslashes($title); // montego:0000763 - check_html was already done prior to adding to the DB and will end up stripping slashes again!
	$content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=Reviews&amp;rop=showcontent&amp;id='.$id.'">'.$title.'</a><br />';
}
?>
