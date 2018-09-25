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

require_once("mainfile.php");
$module_name="PlayerOfTheMonth";
get_lang($module_name);
include("header.php");
include("potm_amenu.php");
include("modules/PlayerOfTheMonth/ct_config.php");

$index = $potm_index; 

OpenTable();
echo "<center><b>"._POTM_EDITPLAYERS."</b><center><br><br>";
echo"<table><tr>
<td width=30><b>ID</b></td>
    <td width=100><b>Submitter</b></td>
    <td width=100><b>IP Address</b></td>
    <td width=100><b>Date&Time</b></td>
    <td width=100><b>Players Name</b></td>
	<td width=170></td>
</tr></table>
";

$sql = "SELECT * FROM nuke_potm_players ORDER BY id ASC";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$id=mysql_result($result,$i,"id");
$pname=mysql_result($result,$i,"pname");
$uname=mysql_result($result,$i,"uname");
$ip=mysql_result($result,$i,"ip");
$date=mysql_result($result,$i,"date");

echo "<hr><table>
<tr>
<td width=30>$id</td>
<td width=100>$uname</td>
<td width=100>$ip</td>
<td width=100>$date</td>
<form action=admin.php?op=UpdatePlayer&cmd=updateplayer&id=$id method=post>
<td width=130><input type=text name=pname value='$pname'></td>
<td width=40><input type=Submit value="._POTM_UPDATE."></td>
</form>
<form action=admin.php?op=DeletePlayer&cmd=deleteplayer&id=$id method=post>
<td width=40><input type=Submit value="._POTM_DELETE."></td>
</form>
</tr></table>";
$i++;
}

echo "<hr><table align=right>
<tr>
<form action=admin.php?op=DeletePlayers&cmd=deleteplayers method=post>
<td align=center><input type=Submit value="._POTM_DELETEALLPLAYERS."></td>
</form>
</tr>
</table>";
CloseTable();
include("modules/PlayerOfTheMonth/copyright/ct_by.php");
include("footer.php");
?>
