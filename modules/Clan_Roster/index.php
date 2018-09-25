<?php
if (!defined('MODULE_FILE')) { die ("You can't access this file directly..."); } 
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
global $db, $prefix, $admin_file, $cookie;
include("modules/$module_name/files/functions.php");
include("modules/$module_name/files/includes.php");
include("header.php");
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
if($crfig[cblocks] == "true"){
define('INDEX_FILE', true);
}else{
$index = 0;
}
OpenTable();
pubmenu();
$puid = $cookie[0];
$pusername = $cookie[1];
$sql = "SELECT username FROM ".$prefix."_croster_members where username='$pusername'";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$pusername2 = $row['username'];
if($pusername2 == $pusername && $puid > 1){
usermenu($pusername, $puid);
}
CloseTable();
OpenTable();
switch($op){
default:
$memcount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members"));
if($memcount >=1){
include("modules/$module_name/files/index2.php");
include("modules/$module_name/files/index.php");
}else{
echo "<center><b>No Members have been added</b></center>";
}
break;

case "dosort":
include("modules/$module_name/files/index2.php");
do_sort($sort, $order);
break;

case "dosortgame":
include("modules/$module_name/files/index2.php");
$cgid=$_GET['cgid'];
do_sort_game($cgid);
break;

case "dosearch":
include("modules/$module_name/files/index2.php");
do_search($username, $crmsearch);
break;

case "profile":
include("modules/$module_name/files/profile.php");
break;

case "editprofile":
include("modules/$module_name/files/editprofile.php");
break;

case "edithardware":
include("modules/$module_name/files/edithardware.php");
break;

case "ribbons":
include("modules/$module_name/files/ribbons.php");
break;
}
if (is_admin($admin)) {
      echo "<br /><br /><center>[ <a href=\"$admin_file.php?op=CRMain\">Clan Roster Admin</a> ]</center>\n";
}
CloseTable();
include("footer.php");
?>
