<?php

/************************************************************************/
/* PHP-NUKE: Clanwars Module                                            */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2003 by Dick Snel                                      */
/* http://www.fvgaming.com	                      	                    */
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

global $module_name;
include("header.php");
get_lang($module_name);
title(""._UPCOMINGWARS."");
$index = 0;

$sql = "SELECT * FROM ".$prefix."_clanwars";
$resultaat = mysql_query($sql, $dbi);
while ($record = mysql_fetch_object($resultaat))
{

OpenTable();
echo "<center><b>$record->game "._UPCOMINGWARS.":</b></center><br>";
echo "<script src='modules/U_Wars/clanbase.js'></script>
<script src='http://www.clanbase.com/cbjswarupcoming.php?cid=$record->cid'></script>";
CloseTable();

}

include("footer.php");

?>