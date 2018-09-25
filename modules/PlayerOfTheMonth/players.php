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

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("header.php");
include("potm_menu.php");
include("ct_config.php");

$index=$potm_index;

OpenTable();
echo "<center><font size='4'>"._POTM_FAME."</font><center><br><br>";

echo "<table align=center width=75%>
<tr>
<td align=center width=50%><b>Month</b><hr></td>
<td align=center width=50%><b>Players</b><hr></td>
</tr></table>";

$sql = "SELECT * FROM nuke_potm_players order by date ASC";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$pname=mysql_result($result,$i,"pname");
$date=mysql_result($result,$i,"date");

echo "<table align=center width=75%><tr>
<td align=center width=50%>$date</td>
<td align=center width=50%>$pname</td>
</tr>
</table>";

$i++;
}
CloseTable();

include("modules/PlayerOfTheMonth/copyright/ct_by.php");
include("footer.php");
?>
