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
include("potm_menu.php");
include("ct_config.php");

$index=$potm_index;

$row = $db->sql_fetchrow($db->sql_query("SELECT potm_awards FROM nuke_potm_settings"));
$potm_awards = $row['potm_awards'];

OpenTable();
echo "<center><font size='4'>"._POTM_AWARD_DESCRIPTION."</font><center><br><br>";

echo "$potm_awards";

CloseTable();

include("modules/$module_name/copyright/ct_by.php");
include("footer.php");
?>
