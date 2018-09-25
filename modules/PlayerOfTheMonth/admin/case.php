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

switch($op) {
    case "PlayerOfTheMonthMain":
    include("modules/PlayerOfTheMonth/admin/index.php");
    case "EditSettings":
    include("modules/PlayerOfTheMonth/admin/editsettings.php");
	case "UpdatePOTMTags":
    case "UpdatePOTMAnnouncement":
    case "UpdatePOTMAwards":
    case "UpdatePOTMImgUrl":
	case "UpdatePOTMPhoto":
    include("modules/PlayerOfTheMonth/admin/update-settings.php");
    case "EditPlayers":
    include("modules/PlayerOfTheMonth/admin/editplayers.php");
    case "DeletePlayer":
    case "DeletePlayers":
    case "UpdatePlayer":
    include("modules/PlayerOfTheMonth/admin/update-players.php");
    case "AwardPlayer":
        include("modules/PlayerOfTheMonth/award-player.php");
          break;
    }
?>
