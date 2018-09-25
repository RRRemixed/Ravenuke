<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

global $admin_file;
if(!isset($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) {
    Header("Location: ../../".$admin_file.".php");
    die();
}
$modname = "Clan_Allies";
get_lang($modname);
if($radminsuper==1) {
    adminmenu($admin_file.".php?op=CAMain", _CLANALLIES, "clanallies.gif");
}

?>