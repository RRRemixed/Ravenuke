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

$pagetitle = "- Player Of The Month";
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("header.php");
include("ct_config.php");

$index = $potm_index;

$row = $db->sql_fetchrow($db->sql_query("SELECT potm_announcement, potm_clantag, potm_img_url, potm_photo FROM nuke_potm_settings"));
$potm_announcement = $row['potm_announcement'];
$potm_clantag = $row['potm_clantag'];
$potm_img_url = $row['potm_img_url'];
$potm_photo = $row['potm_photo'];

$sql = "SELECT * FROM nuke_potm_players order by date ASC";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$pname=mysql_result($result,$i,"pname");
$i++;
}

if (file_exists("modules/$module_name/copyright/ct_copyright.php")) {
include("potm_menu.php");
OpenTable();
echo "<center><font size='4'>"._POTM_TITLE."</font><center><br><br>";
echo "$potm_announcement<br>";
echo "<center><b>"._POTM_TITLE2."</b><br><br><font size='5'>$potm_clantag $pname</font><center><br>";
$mypicture = "<img name=potm_img src=$potm_img_url/$potm_photo align=center border=0>\n";
echo $mypicture;
CloseTable();
include("modules/$module_name/copyright/ct_by.php");
} else {
OpenTable();
echo "
<center>"._POTM_OOPS."<br><br>
<img src=\"modules/$module_name/copyright/ct_no_copyright.png\" alt=\"No Copyright\" width=\"220\" height=\"220\" border=\"0;\"><br><br>
"._POTM_GO."<br><br>
<a href=\"javascript:history.back()\">"._POTM_BACK."</a><br></center>";
CloseTable();
}
include("footer.php");
?>
