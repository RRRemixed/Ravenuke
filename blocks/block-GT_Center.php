<?php

/************************************************************************/
/* Gametrailers XML/RSS Blockv 1.0                                      */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2009 by ABD Inc.		                       			*/
/* http://phpnuke-downloads.com                                         */
/* July 30th 2009                                                       */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}

require_once ('rss_fetch.inc');
   
#####  You can customize your RSS feed from http://www.gametrailers.com/rssgenform.php
   
      $url = 'http://www.gametrailers.com/rssgenerate.php?s1=&favplats[wii]=wii&favplats[xb360]=xb360&favplats[ps3]=ps3&favplats[pc]=pc&favplats[xbox]=xbox&favplats[gc]=gc&favplats[ps2]=ps2&favplats[gba]=gba&favplats[ds]=ds&favplats[psp]=psp&favplats[classic]=classic&favplats[mob]=mob&vidformat[flv]=on&vidformat[mov]=on&vidformat[wmv]=on&type[review]=on&type[preview]=on&type[interview]=on&type[gameplay]=on&type[trailer]=on&type[feature]=on&embed=on&quality[either]=on&agegate[yes]=on&orderby=newest&limit=5';
       $rss = fetch_rss($url);
        $items = array_slice($rss->items, $startRow, 5);   //// Add how many feed you want to see. Default is 5
  
      foreach ($items as $item) {
        	 $title  = $item['title'];
		     $plat = $item['exinfo']['platform'];
           	 $url    = $item['link'];
			 $movtitle = $item['exinfo']['movietitle'];
			 $gameid = $item['exinfo']['gameid'];
			 $gamenam = $item['exinfo']['gamename'];
             $image = $item['exinfo']['image'];
           	 $date   = $item['date_timestamp'];
             $desc   = $item['description'];


$content  .= "<table width='100%'><tr>\n";
$content  .= "<td width='30%' align='center' valign='top'>\n";
$content  .= "<a href='http://www.gametrailers.com/game/$gameid.html' target='_blank' rel='nofollow'>\n";
$content  .= "<img src='$image' width='178' height='74' alt='$gamenam' border='0' />\n";
$content  .= "</a>\n";
$content  .= "</td><td width='70%' align='left' valign='top'>\n";
$content  .= "<a href='http://www.gametrailers.com/game/$gameid.html' target='_blank' rel='nofollow'>\n";
$content  .= "<strong>$title &nbsp; ($plat)</strong>\n";
$content  .= "</a>\n";
$content  .= "<br />$desc\n";
$content  .= "<br />\n";
$content  .= "<strong>Watch Video:&nbsp;</strong>\n";
$content  .= "<a href='$url&type=mov' target='_blank' rel='nofollow'>\n";
$content  .= "<img src='images/gametrailers/mov.png' style='vertical-align:middle;' border='0' width='18' height='20' />\n";
$content  .= "</a>&nbsp;\n";
$content  .= "<a href='$url&type=wmv' target='_blank' rel='nofollow'>\n";
$content  .= "<img src='images/gametrailers/wmv.png' style='vertical-align:middle;' border='0' width='18' height='20' />\n";
$content  .= "</a>&nbsp;\n";
$content  .= "<a href='$url&type=flv' target='_blank' rel='nofollow'>\n";
$content  .= "<img src='images/gametrailers/flv.png' style='vertical-align:middle;' border='0' width='18' height='20' />\n";
$content  .= "</a>&nbsp;\n";
$content  .= "</td>\n";
$content  .= "</tr></table>\n";
}
?>

