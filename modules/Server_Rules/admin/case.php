<?php
/********************************************************/
/* Server Rules Module for PHP-Nuke                     */
/* Version 1.0 12-13-06                                 */
/* By: Floppy (floppydrivez@hotmail.com)                */
/* http://www.clan-themes.co.uk                         */
/* Copyright © 2006 by T3 Gaming Community              */
/********************************************************/
global $admin_file;
if(!isset($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) {
  Header("Location: ../../".$admin_file.".php");
  die();
}
$modulename = "Server_Rules";
switch ($op) {
  case "SRMain" :
  case "SRConfig" :
  case "SRAddrule" :
  case "SRAddruledb" :
  case "SRMoveuprule" :
  case "SRMovedownrule" :
  case "SREditrule" :
  case "SREditruledb" :
  case "SRDel" :
  case "SRMission" :
  include("modules/$modulename/admin/index.php");
  break;
}

?>