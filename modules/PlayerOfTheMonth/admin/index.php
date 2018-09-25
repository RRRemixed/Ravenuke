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
echo "<center><b>"._POTM_ADMIN_MAIN."</b><center><br><br>";
OpenTable2();
echo "<center><b>"._POTM_ADMIN_EDIT_MAIN."</b><br><br>"._POTM_ADMIN_EDIT_MAIN_DESCRIPTION."</center><br>";
CloseTable2();
OpenTable2();
echo "<center><b>"._POTM_ADMIN_EDIT_MAIN2."</b><br><br>"._POTM_ADMIN_EDIT_MAIN_DESCRIPTION2."</center><br>";
CloseTable2();
CloseTable();
include("modules/PlayerOfTheMonth/copyright/ct_by.php");
include("footer.php");
?>
