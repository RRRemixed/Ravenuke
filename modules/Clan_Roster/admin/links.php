<?php
if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}
global $admin_file;
adminmenu("".$admin_file.".php?op=CRMain", "ClanRoster", "clanroster.gif");
?>