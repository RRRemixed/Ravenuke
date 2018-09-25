<?php

/****************************************************************/
/*                  COPYRIGHT NOTICE!                           */
/*This script is designed by Western Studios and is copyrighted */
/*2004-2020. All rights reserved. Please do not claim this      */
/*      script as yours.DO NOT RE-DISTRIBUTE.                   */
/*          http://www.westernstudios.net                       */
/****************************************************************/
/*           ..::WS Banners Module::..                          */
/****************************************************************/

if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }

switch ($op) {
    case "ws_banneradmin":
	case "ws_bannerplans":
	case "ws_addbannerplan":
	case "ws_delbannerplan":
	case "ws_editbannerplan":
	case "ws_editbannerplan_edit":
	case "ws_adsearnings":
	case "ws_adsconfig":
	case "ws_upadsconfig":
	case "ws_adpaypalsetup":
	case "ws_adpaypalsetupadd":
	case "ws_adsclients":
	case "ws_clientadd":
	case "ws_addbanner_db":
	case "ws_adstats":
	case "ws_bannerstatus":
	case "ws_ban_del":
	case "ws_ban_edit":
	case "ws_updatebplan":
	case "ws_banclientedit":
	case "ws_banclientch":
	case "ws_banclientdel":
	case "ws_adsstats":
	case "ws_adstatus":
	include("admin/modules/wsbanners.php");
    break;

}

?>