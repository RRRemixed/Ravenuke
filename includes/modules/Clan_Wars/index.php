<?php

/************************************************************************/
/* PHP-NUKE: Clanwars Module                                            */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2003 by Dick Snel                                      */
/* http://www.fvgaming.com	                               	            */
/* webmaster@fvgaming.com												*/
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/* 																		*/
/* This module contains: Your clans rankings and results 				*/
/* Enjoy!																*/
/************************************************************************/

if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
global $module_name, $prefix, $dbi;
include("header.php");
title("Wars & Rankings");
$index = 0;

$sql = "SELECT * FROM ".$prefix."_clanwars";
$resultaat = mysql_query($sql, $dbi);
while ($record = mysql_fetch_object($resultaat))
{

OpenTable();
echo "<center><b>$record->game War "._RESULTS.":</b></center><br>";
echo "<script src='modules/Clan_Wars/clanbase.js'></script>";
echo "<script src='http://www.clanbase.com/cbjswarpast.php?cid=$record->cid'></script>";
CloseTable();

OpenTable();
echo"
<center><b>$record->game Rankings:</b></center><br>
<table border='0' cellpadding='1' cellspacing='1' width='100%' align='center'>
<tr>
<td class='td3d' height='23' class='small'><b>Ladder</b></td>
<td class='td3d' height='23' class='small'><b>Rank</b></td>
</tr>";
if ( $record->lid != "" ) {
echo "<tr>
<td class='td3d'>$record->ladder <img src='$record->image'></td><td class='td3d'><script src='http://www.clanbase.com/cbrank.php?cid=$record->cid&lid=$record->lid&type=js'></script></td>
</tr>";
}
if ( $record->lid1 != "" ) {
echo "<tr>
<td class='td3d'>$record->ladder1 <img src='$record->image1'></td><td class='td3d'><script src='http://www.clanbase.com/cbrank.php?cid=$record->cid&lid=$record->lid1&type=js'></script></td>
</tr>";
}
if ( $record->lid2 != "" ) {
echo "<tr>
<td class='td3d'>$record->ladder2 <img src='$record->image2'></td><td class='td3d'><script src='http://www.clanbase.com/cbrank.php?cid=$record->cid&lid=$record->lid2&type=js'></script></td>
</tr>";
}
if ( $record->lid3 != "" ) {
echo "<tr>
<td class='td3d'>$record->ladder3 <img src='$record->image3'></td><td class='td3d'><script src='http://www.clanbase.com/cbrank.php?cid=$record->cid&lid=$record->lid3&type=js'></script></td>
</tr>";
}
if ( $record->lid4 != "" ) {
echo "<tr>
<td class='td3d'>$record->ladder4 <img src='$record->image4'></td><td class='td3d'><script src='http://www.clanbase.com/cbrank.php?cid=$record->cid&lid=$record->lid4&type=js'></script></td>
</tr>";
}
echo "</table>";
CloseTable();

}

include("footer.php");

?>