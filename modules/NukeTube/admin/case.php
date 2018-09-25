<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by Ramón			                                */
/* http://www.songohack.com                                             */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

$module_name = "NukeTube";
include_once("modules/$module_name/admin/language/lang-".$currentlang.".php");

switch($op) {

		case "nuketube_menu":
		case "nuketube":
		case "nuketube_cat":
		case "nuketube_anadir":
		case "nuketube_videos_editar":
		case "nuketube_editar_video":
		case "nuketube_borrar_video":
		case "nuketube_borrar_video_si":
		case "nuketube_nueva_categoria":
		case "nuketube_editar_categoria":
		case "nuketube_guardar_editar_categoria":
		case "nuketube_borrar_categoria":
		case "nuketube_envios":
		case "nuketube_envios_aceptar":
		case "nuketube_envios_aceptar_si":
		case "nuketube_envios_aceptar_no":
		case "nuketube_config":
		case "nuketube_config_guardar":
		
        include("modules/$module_name/admin/index.php");
		break;

}

?>