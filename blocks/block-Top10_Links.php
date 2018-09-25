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
$n = 1;
$result = $db->sql_query('SELECT lid, title FROM '.$prefix.'_links_links ORDER BY hits DESC LIMIT 0,10');
while (list($lid, $title) = $db->sql_fetchrow($result)) {
   $lid = intval($lid);
   $title2 = htmlspecialchars(str_replace('_', ' ', $title), ENT_QUOTES, _CHARSET);
   $content .= '<strong><big>&middot;</big></strong>&nbsp;'.$n.
      ': <a href="modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid='.$lid.'">'.$title2.'</a><br />';
   ++$n;
}
?>
