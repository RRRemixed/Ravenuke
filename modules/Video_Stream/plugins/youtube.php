<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Video Stream Module for PHP-Nuke with many features                  */
/*                                                                      */
/* Copyright (c) 2006 by Scott Cariss (Brady)                           */
/* http://phpnuke-downloads.com                                    */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
	die ("You can't access this file directly...");
}
// Modify URL For use in this plugin
$url = $row['url'];
$url = stristr($url, 'watch?v=');
$url = explode('=', $url);
$url = explode('&', $url[1]);
$url = $url[0];
// YouTube Plugin
$embedcode = "<object width=\"".$row['width']."\" height=\"".$row['height']."\">\n";
$embedcode .= "<param name=\"movie\" value=\"http://www.youtube.com/v/".$url."\"></param>\n";
$embedcode .= "<param name=\"wmode\" value=\"transparent\"></param>\n";
$embedcode .= "<embed src=\"http://www.youtube.com/v/".$url."\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"".$row['width']."\" height=\"".$row['height']."\"></embed>\n";
$embedcode .= "</object>\n";
$url = "http://www.youtube.com/v/".$url;
?>