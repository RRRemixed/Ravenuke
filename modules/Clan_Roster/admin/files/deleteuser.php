<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
OpenTable();
if($deleteuser == 1){
$uid = $_GET['uid'];
$sql2 = "SELECT cribid FROM ".$prefix."_croster_ribbons";
$result2 = $db->sql_query($sql2);
while(list($cribid) = $db->sql_fetchrow($result2)){
	$ribprefix = "rib";
$db->sql_query("delete from ".$prefix."_croster_ribbons_".$ribprefix."".$cribid." WHERE uid='$uid'");
}
$db->sql_query("delete from ".$prefix."_croster_members where uid='$uid'");
$db->sql_query("delete from ".$prefix."_croster_members_hardware where uid='$uid'");
header("Location: ".$admin_file.".php?op=CRMain");
}else{
$uid = $_GET['uid'];
echo "<center>Are you sure you want to delete $username?";
echo "<br /><br />[&nbsp;<a href='".$admin_file.".php?op=CRDeleteuser&amp;uid=$uid&amp;username=$username&amp;deleteuser=1'>Yes</a>&nbsp;||&nbsp;<a href='".$admin_file.".php?op=CRMain'>No</a>&nbsp;]<center>";
}
CloseTable();
?>
