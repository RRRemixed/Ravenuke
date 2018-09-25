<?php

/****************************************************************/
/*                  COPYRIGHT NOTICE!                           */
/*This script is designed by Western Studios and is copyrighted */
/*2004-2020. All rights reserved. Please do not claim this      */
/*      script as yours.DO NOT RE-DISTRIBUTE.                   */
/*          http://www.westernstudios.net                       */
/****************************************************************/
/*           ..::Subscription Module::..                        */
/****************************************************************/

if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }
$module_name = "WS_Subscription";
include_once("modules/$module_name/admin/language/lang-".$currentlang.".php");

switch($op) {

    case "ws_subscr":
	case "ws_addsubscrtype":
	case "ws_paypalsetup":
	case "ws_paypalsetupadd":
	case "ws_addsubscrtype_add":
	case "ws_editsubtype":
	case "ws_editsubtype_edit":
	case "ws_subscrdel":
	case "ws_submemb":
	case "ws_submembupd":
	case "ws_subuseradd":
	case "ws_subuseradddb":
	case "ws_config":
	case "ws_submembuser_add":
	case "ws_submembuser_addall":
	case "ws_earnings":
	case "ws_upconfig":
	case "ws_stats":
	case "ws_searchuser":
	case "ws_substatus":
    include("modules/$module_name/admin/index.php");
    break;

}

?>