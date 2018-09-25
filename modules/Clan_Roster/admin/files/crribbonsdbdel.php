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
$sql = "SELECT * FROM ".$prefix."_croster_ribbons WHERE cribid='$cribid'"; 
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
$cribid = intval($row['cribid']);
$ribtitle =	$row['ribtitle'];
$ribimage = $row['ribimage'];
$ribtitle = str_replace(' ','',$ribtitle);
$ribtitle = strtolower($ribtitle);
$ribtitle = stripslashes($ribtitle);
$ribtitle = htmlspecialchars($ribtitle);
}
if($ok==1) {
unlink($crfig[ribbonpath]."/".$ribimage);	
$db->sql_query("delete from ".$prefix."_croster_ribbons where cribid='$cribid'");
$ribprefix = "rib";
$db->sql_query("DROP TABLE ".$prefix."_croster_ribbons_$ribprefix$cribid") OR die("Could not delete table");
Header("Location: ".$admin_file.".php?op=CRRibbons");
} else {
OpenTable();
echo "<br /><center><b>Delete Ribbon ";
if ($crfig[uribimg] == 1) {
echo "and Image</b><br />($crfig[ribbonpath]/$ribimage)";
}
echo "<br /><br />[ <a href='".$admin_file.".php?op=CRRibbonsdbdel&amp;cribid=$cribid&amp;ok=1'>YES</a> | <a href='".$admin_file.".php?op=CRRibbons>NO</a> ]</center><br \>";
CloseTable();
}
?>
