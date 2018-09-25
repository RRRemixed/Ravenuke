<?php

/************************************************************************/
/*                     www.Clan-Themes.co.uk                            */
/*                  ===========================                         */
/*                    Making Clans Look Good!                           */
/************************************************************************/
/*                Player Of The Month Module V1.0                       */
/*                 Copyright (c) 2007 by Scorpion                       */
/*            Downloaded from http://www.Clan-Themes.co.uk.             */
/*                                                                      */
/*         The Power of the Nuke! - Without the Radiation!              */
/*        =================================================             */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/

/************************************************************************/
/*                                                                      */
/* PLEASE DO NOT TOUCH THE CODE BELOW, UNLESS YOU KNOW WHAT YOUR DOING  */
/*                                                                      */
/************************************************************************/

if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
    die ("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("config.php");
include("header.php");
include("potm_menu.php");
include("ct_config.php");

$index=$potm_index;

OpenTable();
?>
<meta http-equiv="REFRESH" content="3;url=modules.php?name=PlayerOfTheMonth&file=players">
<?
$uname = $_POST["uname"];
$ip = $_POST["ip"];
$date = $_POST["date"];
$pname = $_POST["pname"];
$cmd = $_GET["cmd"];
if(!isset($cmd))
{
$result = mysql_query("select * from nuke_potm_players");
while($row=mysql_fetch_array($result))
 {
$uname = $row['uname'];
$ip = $row['ip'];
$date = $row['date'];
$pname = $row['pname'];
 }
}
if($_GET["cmd"]=="addplayer")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "INSERT INTO nuke_potm_players VALUES ('','$pname','$uname','$ip','$date')";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><font size='4'>"._POTM_AWARDED."</font><center><br><br>";
echo "<center><b>$pname</b><br>has been awarded Player Of The Month<center>";
}
CloseTable();
include("modules/PlayerOfTheMonth/copyright/ct_by.php");
include("footer.php");
?>
