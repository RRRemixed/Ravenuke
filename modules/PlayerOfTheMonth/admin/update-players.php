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

if (!eregi("admin.php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }

$module_name="PlayerOfTheMonth";
get_lang($module_name);
include("header.php");
include("potm_amenu.php");
include("modules/PlayerOfTheMonth/ct_config.php");

$index = $potm_index; 

OpenTable();
echo "<center><font size='4'>"._POTM_EDITPLAYERS."</font><center><br><br>";

?>
<meta http-equiv="REFRESH" content="3;url=admin.php?op=EditPlayers">
<?

$id = $_GET["id"];
$pname = $_POST["pname"];
$cmd = $_GET["cmd"];
if(!isset($cmd))
{
$result = mysql_query("select * from nuke_potm_players");
while($row=mysql_fetch_array($result))
 {
$id = $row['id'];
$pname = $row['pname'];

 }
}
if($_GET["cmd"]=="deleteplayer")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "DELETE FROM nuke_potm_players WHERE id='$id'";
$sql = @mysql_query($query) or die('Could not delete: '.mysql_error());
echo "<center><b>$pname ID# $id</b><br>has been deleted!</center>";
}
if($_GET["cmd"]=="updateplayer")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE nuke_potm_players SET pname = '$pname' WHERE id='$id'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><b>$pname ID# $id</b><br>has been updated!</center>";
}
if($_GET["cmd"]=="deleteplayers")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "DELETE FROM nuke_potm_players";
$sql = @mysql_query($query) or die('Could not delete: '.mysql_error());
echo "<center>All <b>Winners</b> have been deleted!</center>";
}
CloseTable();
include("modules/PlayerOfTheMonth/copyright/ct_by.php");
include("footer.php");
?>
