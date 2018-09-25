<?php
/************************************************************/
/* CTShout Module - For PHP-Nuke                            */
/* By: Admin (admin@clan-themes.co.uk)                      */
/* http://www.clan-themes.co.uk                             */
/* Copyright © 2007 by Clan Themes                          */
/************************************************************/
if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}

$module_name = basename(dirname(dirname(__FILE__)));


global $admin_file;
//if (!stristr($_SERVER['PHP_SELF'], $admin_file.".php") && !stristr($_SERVER['SCRIPT_NAME'], $admin_file.".php")) { Header("Location: ../../../".$admin_file.".php"); }


switch($op) {
	case "CTShout_Config":
	case "CTShout_ListShouts":
	case "CTShout_ClearShouts":
	case "CTShout_Shouts":
	case "CTShout_Install":
	case "CTShout_UnInstall":
	case "CTShout_Shout":
	case "CTShout_Main":
	case "CTShout_Install";
	case "CTShout_UnInstall":
		include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
	break;

}

?>
