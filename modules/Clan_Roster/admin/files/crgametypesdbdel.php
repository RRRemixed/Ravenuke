<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file, $prefix, $db;
$cgid = intval($cgid);
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
$sql = "SELECT * FROM ".$prefix."_croster_games WHERE cgid='$cgid'"; 
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
$cgid = intval($row['cgid']);
$gtitle =	$row['gtitle'];
$gimage = $row['gimage'];
}
if($ok==1) {
unlink($crfig[gamepath]."/".$gimage);	
$db->sql_query("delete from ".$prefix."_croster_games where cgid='$cgid'");
Header("Location: ".$admin_file.".php?op=CRGametypes");
} else {
OpenTable();
echo "<br /><center><b>Delete Game ";
if ($crfig[ugimg] == 1) {
echo "and Image</b><br />($crfig[gamepath]/$gimage)";
}
echo "<br /><br />[ <a href='".$admin_file.".php?op=CRGametypesdbdel&amp;cgid=$cgid&amp;ok=1'>YES</a> | <a href='".$admin_file.".php?op=CRGametypes>NO</a> ]</center><br \>";
CloseTable();
}
?>
