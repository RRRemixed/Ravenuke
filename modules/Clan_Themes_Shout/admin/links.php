<?php
/************************************************************/
/* CTShout Module - For PHP-Nuke                            */
/* By: Admin (admin@clan-themes.co.uk)                      */
/* http://www.clan-themes.co.uk                             */
/* Copyright © 2007 by Clan Themes                          */
/************************************************************/
if (!defined('ADMIN_FILE')) {
   die ('Access Denied');
}

global $admin_file;

adminmenu($admin_file.'.php?op=CTShout_Shout', "Clan Themes Shout", 'CTShout.gif');

?>