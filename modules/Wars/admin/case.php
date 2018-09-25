<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Martijn Willekens                              */
/* http://www.unters-designs.be.tt                                      */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

$module_name = "Wars";

switch($op) {

    case "WarsMain":
    case "WarsAdmin":
    case "WarAdd":
    case "WarDelete":
    case "WarEdit":
    case "WarChange":
    case "Add_war":
    case "GamesAdmin":
    case "Add_game":
    case "GameAdd":
    case "GameDelete":
    case "GameEdit":
    case "GameChange":
    case "WarsCredits":
    case "Wars_add_screenshot":
    case "DelScreen":
    include("modules/$module_name/admin/index.php");
    break;

}

?>