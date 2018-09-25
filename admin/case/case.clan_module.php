 <?php

if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }

switch($op) {
    case "Clan_Module":
    include("admin/modules/clanmodule.php");
    break;
		
}

?>