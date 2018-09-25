<?php
require_once("mainfile.php");
global $admin;
if(!is_array($admin)) {
    $adm = base64_decode($admin);
    $adm = explode(":", $adm);
    $admin_name = "$adm[0]";
} else {
    $admin_name = "$admin[0]";
}

        $isadmin = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_authors WHERE aid='$admin_name'"));
if ($isadmin['radminsuper']==1) {

switch($op) {

    default:
        $pagetitle = "Tag Cloud";
        title("$pagetitle");
        OpenTable();
        echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
        echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>\n";
        echo "<tr><td>This script will install, uninstall or upgrade the tables for the $pagetitle.</td></tr>\n";
        echo "<tr><td><b>Backup data tables before going on!</b></td></tr>\n";
        echo "<tr><td><select name='op'>\n";
        echo "<option value=''>---- Install Options ----</option>\n";
        echo "<option value='install'>First Time Install of $pagetitle</option>\n";
        echo "<option value=''>---- Destall Options ----</option>\n";
        echo "<option value='uninstall'>Uninstall $pagetitle</option>\n";
        echo "</select> <input type='submit' value='COMMIT'></td></tr>\n";
        echo "<tr><td><b>Once you have finished with this script, delete it from your server!</b></td></tr>\n";
        echo "</form>";
        echo "</table>\n";
        CloseTable();
        
    break;

    case "install":
        $pagetitle = "Tag Cloud: Install";
        title("$pagetitle");
        OpenTable();
        $db->sql_query("CREATE TABLE `". $prefix ."_tags` (
     `tag` varchar(25) NOT NULL,
     `cid` int(10) NOT NULL default '0',
     `whr` int(1) NOT NULL default '0'
      ) ENGINE=MyISAM;");

 		 
		
		$db->sql_query("CREATE TABLE `". $prefix ."_tags_temp` (
 		 `tag` varchar(25) NOT NULL,
     `cid` int(10) NOT NULL default '0',
     `whr` int(1) NOT NULL default '0'
      ) ENGINE=MyISAM;");
		 
	echo "<hr>\n";
        echo "<b>Database tables where successfully installed.</b>\n";
        echo "<hr>\n"; 
        echo "<br /><font color=red><b>Make sure you delete this file off of your server for security reasons.</b></font><br /><br />\n";
        echo "<a href=\"admin.php?op=modules\">Go to modules admin to activate the Tag Cloud Module !</a>\n";
        CloseTable();
      
    break;	 

    case "uninstall":
        $pagetitle = "Tag Cloud: Uninstall";
           title("$pagetitle");
        OpenTable();
        $db->sql_query("DROP TABLE ".$prefix."_tags");
        $db->sql_query("DROP TABLE ".$prefix."_tags_temp");
		echo "<hr>\n";
        echo "<b>Database tables where successfully dropped!</b>\n";
        echo "<hr>\n"; 
        echo "Please delete this file off your server for security reasons.\n";
        CloseTable();
         break;

}
} else {
    $pagetitle = "Tag Cloud: ERROR";
    title("$pagetitle");
    OpenTable();
    echo "<center><b>Sorry, ONLY super admins may run this script.</b><center>\n";
    CloseTable();
}
?>
