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

global $prefix, $db, $admin_file;
require_once("mainfile.php");
$module_name="PlayerOfTheMonth";
get_lang($module_name);
include("header.php");
include("potm_amenu.php");
include("modules/PlayerOfTheMonth/ct_config.php");

$index = $potm_index; 

OpenTable();
echo "<center><font size='4'>"._POTM_EDITSETTINGS."</font><center><br><br>";
?>
<meta http-equiv="REFRESH" content="3;url=admin.php?op=EditSettings">
<?
$potm_announcement = $_POST["potm_announcement"];
$potm_awards = $_POST["potm_awards"];
$potm_clantag = $_POST['potm_clantag'];
$potm_img_url = $_POST['potm_img_url'];
$potm_photo = $_POST['potm_photo'];

$cmd = $_GET["cmd"];
if(!isset($cmd))
{
$result = mysql_query("select * from nuke_potm_settings");
while($row=mysql_fetch_array($result))
 {
$potm_announcement = $row['potm_announcement'];
$potm_awards = $row['potm_awards'];
$potm_clantag = $row['potm_clantag'];
$potm_img_url = $row['potm_img_url'];

 }
}
//
// Update the Tags.
//
if($_GET["cmd"]=="update_potm_tags")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE nuke_potm_settings SET potm_clantag = '$potm_clantag'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center>Your <b>Clan Tags</b><br>have been updated!</center>";
}
//
// Update the Announcement.
//
if($_GET["cmd"]=="update_potm_announcement")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE nuke_potm_settings SET potm_announcement = '$potm_announcement'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center>The <b>Announcement</b><br>has been updated!</center>";
}
//
// Update the Awards Description.
//
if($_GET["cmd"]=="update_potm_awards")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE nuke_potm_settings SET potm_awards = '$potm_awards'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center>The <b>Award Discription</b><br>has been updated!</center>";
}

//
// Update the Image Url.
//
if($_GET["cmd"]=="update_potm_img_url")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE nuke_potm_settings SET potm_img_url = '$potm_img_url'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center>The <b>Image Url</b><br>has been updated!</center>";
}
//
// If a photo is chosen for upload, upload it.
//
if($_GET["cmd"]=="update_potm_photo")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
if($the_file) {
		$sql = "SELECT potm_img_url FROM nuke_potm_settings";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$uploaddir = $row[potm_img_url];
			$uploadfile = $uploaddir . basename($_FILES['the_file']['name']);

			if (!move_uploaded_file($_FILES['the_file']['tmp_name'], $uploadfile)) {
				$img_error = "<b>" . _POTM_UPFAIL . "</b>";
			} else {
				$potm_photo = $_FILES['the_file']['name'];
			}
		}
$query = "UPDATE nuke_potm_settings SET potm_photo = '$potm_photo'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center>The <b>Image</b><br>has been updated & uploaded!</center>";
}
CloseTable();
include("modules/PlayerOfTheMonth/copyright/ct_by.php");
include("footer.php");
?>
