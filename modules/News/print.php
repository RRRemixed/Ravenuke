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
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');
require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
if(!isset($sid)) exit();
PrintPage($sid);
die();
// Only functions below this line
function PrintPage($sid) {
	global $site_logo, $nukeurl, $sitename, $datetime, $prefix, $db, $module_name;
	$sid = intval($sid);
	$row = $db->sql_fetchrow($db->sql_query('SELECT title, time, hometext, bodytext, topic, notes FROM ' . $prefix . '_stories WHERE sid=\'' . $sid . '\''));
	$title = stripslashes(check_html($row['title'], 'nohtml'));
	$time = $row['time'];
	$hometext = stripslashes($row['hometext']);
	$bodytext = stripslashes($row['bodytext']);
	$topic = intval($row['topic']);
	$notes = stripslashes($row['notes']);
	$row2 = $db->sql_fetchrow($db->sql_query('SELECT topictext FROM ' . $prefix . '_topics WHERE topicid=\'' . $topic . '\''));
	$topictext = stripslashes(check_html($row2['topictext'], 'nohtml'));
	formatTimestamp($time);
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'."\n".' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n"
		. '<html xmlns="http://www.w3.org/1999/xhtml">'."\n"
		. '<head><title>' . $sitename . ' - ' . $title . '</title>'
		. '<meta http-equiv="Content-Type" content="text/html; charset=' . _CHARSET . '" />'
		. '<meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />'."\n".'</head>'
		. '<body bgcolor="#ffffff" text="#000000">'
		. '<table border="0" align="center"><tr><td>'
		. '<table border="0" width="640" cellpadding="0" cellspacing="1" bgcolor="#000000"><tr><td>'
		. '<table border="0" width="640" cellpadding="20" cellspacing="1" bgcolor="#ffffff"><tr><td>'
		. '<center>'
		. '<img src="images/' . $site_logo . '" border="0" alt="" /><br /><br />'
		. '<span class="content">'
		. '<b>' . $title . '</b></span><br />'
		. '<span class="tiny"><b>' . _PDATE . '</b> ' . $datetime . '<br /><b>' . _PTOPIC . '</b> ' . $topictext . '</span><br /><br />'
		. '</center>'
		. '<div class="content">'
		. $hometext . '<br /><br />'
		. $bodytext . '<br /><br />'
		. $notes . '<br /><br />'
		. '</div>'
		. '</td></tr></table></td></tr></table>'
		. '<br /><br /><center>'
		. '<span class="content">'
		. _COMESFROM . ' ' . $sitename . '<br />'
		. '<a href="' . $nukeurl . '">' . $nukeurl . '</a><br /><br />'
		. _THEURL.'<br />'
		. '<a href="' . $nukeurl . '/modules.php?name=' . $module_name . '&amp;file=article&amp;sid=' . $sid . '">' . $nukeurl . '/modules.php?name=' . $module_name . '&amp;file=article&amp;sid=' . $sid . '</a>'
		. '</span></center>'
		. '</td></tr></table>'
		. '</body>'
		. '</html>';
	die();
}
?>