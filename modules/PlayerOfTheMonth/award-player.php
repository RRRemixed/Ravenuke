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
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("header.php");
include("admin/potm_amenu.php");
include("ct_config.php");

$index=$potm_index;

$cookie[0] = intval($cookie[0]);
if ($cookie[1] != "") {
    $row = $db->sql_fetchrow($db->sql_query("SELECT username FROM ".$user_prefix."_users WHERE user_id='$cookie[0]'"));
$submitter = $row['username'];
}else{
$submitter = "._POTM_NOT_REGISTERED.";
}

$ip   = getenv('REMOTE_ADDR');
$date=date("F Y");

OpenTable();
echo "<center><b>"._POTM_AWARD_PLAYER."</b><center><br><br>";
echo "<table align=center>
<form action='modules.php?name=PlayerOfTheMonth&file=submit-player&cmd=addplayer' method=post>
<tr>
<td><input type=text size=25 maxlength=25 name=pname value="._POTM_INSERT_NAME."></td>
<td><input type=hidden name=uname value='$submitter'></td>
<td><input type=hidden name=ip value='$ip'></td>
<td><input type=hidden name=date value='$date'></td>
<td><input type=submit value="._POTM_SUBMIT."></td>
</tr>
</form>
</table>
<center>$submitter [$ip]</center>";
CloseTable();

include("modules/PlayerOfTheMonth/copyright/ct_by.php");
include("footer.php");
?>
