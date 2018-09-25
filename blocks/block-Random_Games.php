<?php
/************************************************************************/
/* PHP-NUKE: Center Random Block										*/
/* ================================										*/
/*																		*/
/* Copyright (c) 2004 by Barcrest										*/
/* http://baja.ods.org/													*/
/*																		*/
/* And																	*/
/*																		*/
/* Copyright (c) 2004 by Phantomk										*/
/* http://www.5thlegion.com												*/
/*																		*/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation                                         */
/************************************************************************/

if (eregi("block-Random_Games.php",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}

define("_TOPGAMERS", "The Top Players");
define("_VICTOIRES", "Number Of Wins :");

global $prefix, $user_prefix, $db;

$sql = "SELECT g.* , u.username, u.user_color_gc FROM ".$prefix."_bbgames g, ".$user_prefix."_users u WHERE u.user_id = g.game_highuser ORDER BY rand()";

$result = $db->sql_query($sql); 
$row = $db->sql_fetchrow($result);

$lastScore = $row['game_highscore'];
$lastGame = $row['game_name'];
$lastUser = checkUsernameColor($row['user_color_gc'], $row['username']);

$lastgameid = $row['game_id'];
$lastgamepic = $row['game_pic'];
$lastuserid = $row['game_highuser'];

$content .= "<center><b>$lastGame</b><br><a href=\"modules.php?name=Forums&file=games&gid=$lastgameid\">";
$content .= "<img src=\"modules/Forums/games/pics/$lastgamepic\" border= \"0\"></a><br> ";
$content .= "High Score set by <br><b>";
$content .= "<a href=\"modules.php?name=Forums&amp;file=statarcade&amp;uid=$lastuserid\"><img src=\"modules/Forums/templates/subSilver/images/loupe.gif\" border= \"0\"></a> ";
$content .= "<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$lastuserid\">$lastUser</a> ";
$content .= "</b><br>with <b>$lastScore</b></center>";

?>


