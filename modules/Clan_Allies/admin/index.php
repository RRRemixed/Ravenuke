<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

global $admin_file, $adveditor;
$adveditor = 0;
if(!isset($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) {
    Header("Location: ../../".$admin_file.".php");
    die();
}
$modname = "Clan_Allies";
require_once("mainfile.php");
get_lang($modname);
$index=0;
$textrowcol = "rows='10' cols='50'";
if($Version_Num > "7.6") { $textrowcol = "rows='10' cols='75'"; }
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT `title`, `admins` FROM `".$prefix."_modules` WHERE `title`='$modname'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT `name`, `radminsuper` FROM `".$prefix."_authors` WHERE `aid`='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for($i=0; $i < sizeof($admins); $i++) { if($row2['name'] == "$admins[$i]" AND $row['admins'] != "") { $auth_user = 1; } }
if($row2['radminsuper'] == 1 || $auth_user == 1) {
  include_once("modules/$modname/public/clan_allies_func.php");
  $ca_config = caget_configs();
  switch ($op) {
    case "CAMain":include("modules/$modname/admin/CAConfig.php");break;
    case "CAActivate":include("modules/$modname/admin/CAActivate.php");break;
    case "CAActive":include("modules/$modname/admin/CAActive.php");break;
    case "CAAdd":include("modules/$modname/admin/CAAdd.php");break;
    case "CAAddSave":include("modules/$modname/admin/CAAddSave.php");break;
    case "CAApprove":include("modules/$modname/admin/CAApprove.php");break;
    case "CAApproveSave":include("modules/$modname/admin/CAApproveSave.php");break;
    case "CAConfig":include("modules/$modname/admin/CAConfig.php");break;
    case "CAConfigSave":include("modules/$modname/admin/CAConfigSave.php");break;
    case "CADeactivate":include("modules/$modname/admin/CADeactivate.php");break;
    case "CADelete":include("modules/$modname/admin/CADelete.php");break;
    case "CADeleteConfirm":include("modules/$modname/admin/CADeleteConfirm.php");break;
    case "CAEdit":include("modules/$modname/admin/CAEdit.php");break;
    case "CAEditSave":include("modules/$modname/admin/CAEditSave.php");break;
    case "CAInactive":include("modules/$modname/admin/CAInactive.php");break;
    case "CAPending":include("modules/$modname/admin/CAPending.php");break;
  }
} else {
  echo "Access Denined";
}

?>