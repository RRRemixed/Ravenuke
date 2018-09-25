<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

global $admin_file;
if(!isset($admin_file)) { $admin_file = "admin"; }

function casave_config($config_name, $config_value){
  global $prefix, $db;
  $db->sql_query("UPDATE `".$prefix."_clan_allies_config` SET `config_value`='$config_value' WHERE `config_name`='$config_name'");
}

function caget_configs(){
  global $prefix, $db;
  $configresult = $db->sql_query("SELECT `config_name`, `config_value` FROM `".$prefix."_clan_allies_config`");
  while(list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
    $config[$config_name] = $config_value;
  }
  return $config;
}

function camenu() {
  global $admin_file;
  OpenTable();
  echo "<center>\n<table cellpadding='3' width='70%'>\n";
  echo "<tr>\n";
  echo "<td align='center' valign='top' width='50%'>";
  echo "<a href='".$admin_file.".php?op=CAMain'>"._SITEADMIN."</a><br>\n";
  echo "<a href='".$admin_file.".php?op=CAConfig'>"._CONFIGMAIN."</a><br>";
  echo "<a href='".$admin_file.".php?op=CAAdd'>"._ADDSUPPORTER."</a><br>";
  echo "</td>\n";
  echo "<td align='center' valign='top' width='50%'>";
  echo "<a href='".$admin_file.".php?op=CAActive'>"._ACTIVESITES."</a><br>";
  echo "<a href='".$admin_file.".php?op=CAPending'>"._SUBMITTEDSITES."</a><br>";
  echo "<a href='".$admin_file.".php?op=CAInactive'>"._INACTIVESITES."</a><br>";
  echo "</td>\n";
  echo "</tr>\n";
  echo "<tr><td align='center' colspan='2'><a href='".$admin_file.".php'><i>"._ADMINMAIN."</i></a></td></tr>\n";
  echo "</table>\n</center>\n";
  CloseTable();
}

?>