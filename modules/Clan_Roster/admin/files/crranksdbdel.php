<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file, $prefix, $db;
$crid = intval($crid);
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
$sql = "SELECT * FROM ".$prefix."_croster_ranks WHERE crid='$crid'"; 
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
$crid = intval($row['crid']);
$rtitle =	$row['rtitle'];
$rimage = $row['rimage'];
}
if($ok==1) {
unlink($crfig[rankpath]."/".$rimage);	
$db->sql_query("delete from ".$prefix."_croster_ranks where crid='$crid'");
Header("Location: ".$admin_file.".php?op=CRRanks");
} else {

OpenTable();
echo "<br /><center><b>Delete Rank ";
if ($crfig[urimg] == 1) {
echo "and Image</b><br />($crfig[rankpath]/$rimage)";
}
echo "<br /><br />[ <a href='".$admin_file.".php?op=CRRanksdbdel&amp;crid=$crid&amp;ok=1'>YES</a> | <a href='".$admin_file.".php?op=CRRanks>NO</a> ]</center><br \>";
}
CloseTable();
?>
