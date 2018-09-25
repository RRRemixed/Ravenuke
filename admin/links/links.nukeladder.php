<?php

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file;
if ($radminsuper==1) {
    adminmenu("modules.php?name=NukeLadder&op=admin", "NukeLadder", "NukeLadder.gif");
}	
?>