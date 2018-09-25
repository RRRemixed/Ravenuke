<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/


global $admin_file;
if(!defined('MODULE_FILE')) {
  header("Location: ../../index.php");
  die();
}
$module_name = basename(dirname(__FILE__));
require_once("mainfile.php");
include_once("modules/Clan_Allies/public/clan_allies_func.php");
$ca_config = caget_configs();
get_lang($module_name);
if(!isset($op)) { $op = "CAIndex"; }
$textrowcol = "rows='10' cols='50'";
if($Version_Num > "7.6") { $textrowcol = "rows='10' cols='75'"; }
switch ($op) {
  case "CAGo":include("modules/$module_name/public/CAGo.php");break;
  case "CAIndex":include("modules/$module_name/public/CAIndex.php");break;
  case "CASubmit":include("modules/$module_name/public/CASubmit.php");break;
  case "CASubmitSave":include("modules/$module_name/public/CASubmitSave.php");break;
}

?>