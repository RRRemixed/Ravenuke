<?php

/********************************************************/
/* NSN Supporters                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2003 by NukeScripts Network              */
/********************************************************/

global $admin_file;
if(!isset($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) {
    Header("Location: ../../".$admin_file.".php");
    die();
}
$modname = "Clan_Allies";
get_lang($modname);
switch ($op) {
  case "CAMain":
  case "CAActivate":
  case "CAActive":
  case "CAAdd":
  case "CAAddSave":
  case "CAApprove":
  case "CAApproveSave":
  case "CAConfig":
  case "CAConfigSave":
  case "CADeactivate":
  case "CADelete":
  case "CADeleteConfirm":
  case "CAEdit":
  case "CAEditSave":
  case "CAInactive":
  case "CAPending":
  include("modules/$modname/admin/index.php");
  break;
}

?>