<?php
/********************************************************/
/* Server Rules Module for PHP-Nuke                     */
/* Version 1.0 12-13-06                                 */
/* By: Floppy (floppydrivez@hotmail.com)                */
/* http://www.clan-themes.co.uk                         */
/* Copyright © 2006 by T3 Gaming Community              */
/********************************************************/
if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}
global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Content'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
        $auth_user = 1;
    }
}
if ($row2['radminsuper'] == 1 || $auth_user == 1) {
include("header.php");
function Navigation() {
global  $db, $prefix, $admin_file, $bgcolor1, $bgcolor2, $textcolor1, $module_name;
OpenTable();
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$textcolor1'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='white'>Server Rules Menu</font></b></td></tr>\n";
echo "<tr bgcolor='$bgcolor2' align='center'>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=SRMain\">Server Rules Main</a></center></td>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=SRAddrule\">Add Rule</a></center></td></tr>\n";
echo "</tr></table><br />";
echo "[ <a href='".$admin_file.".php'>Site Administration</a> ]</center>\n";
CloseTable();
}
function srcopy(){
global $sitename;
OpenTable();
echo "<div align=\"right\">Server Rules by <a href=\"http://www.t3gamingcommunity.com/\">Floppy</a></div>";
echo "<div align=\"right\">Copyright &copy; 2006 by T3 Gaming Community</div>";
CloseTable();
}
function srdel($rid, $ok=0) {
 global $admin_file, $prefix, $db;
$rid = intval($rid);
if($ok==1) {
$db->sql_query("delete from ".$prefix."_server_rules where rid='$rid'");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_server_rules");
Header("Location: ".$admin_file.".php?op=SRMain");
} else {
Navigation();
OpenTable();
$sql = "SELECT rid, rtitle FROM {$prefix}_server_rules WHERE rid='$rid'"; 
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
$rid = intval($row['rid']);
$rtitle =	$row['rtitle'];
echo "<br><center><b>Are you sure you want to delete $rtitle?</b><br><br>";
}}
echo "[ <a href='".$admin_file.".php?op=SRDel&amp;rid=$rid&amp;ok=1'>YES</a> | <a href='".$admin_file.".php?op=SRMain>NO</a> ]</center>";
CloseTable();
}
switch($op) {
case "SRMain":
Navigation();
OpenTable();
echo "<center>\n<table width='100%' cellpadding='2' cellspacing='1' bgcolor='$textcolor1'>\n";
echo "<tr><td align='center' colspan='4' class='option'><b><font color='white'>Server Rules</font></b></td></tr>\n";
$result = $db->sql_query("SELECT * from ".$prefix."_server_rules ORDER BY rpos ASC");
while($row = $db->sql_fetchrow($result)) {
$rid = intval($row['rid']);
$rpos = intval($row['rpos']);
$rtitle = $row['rtitle'];
$rdetails = $row['rdetails'];
$one = $row['one'];
$rposup = $rpos-1;
$rposdown = $rpos+1;
echo "<tr bgcolor='$bgcolor2' align='center'>\n";
echo "<td align='left' colspan='2'><b>$rtitle</b></td></tr>\n";
echo "<tr bgcolor='$bgcolor2'><td width='100%' colspan='2'>$rdetails<br><br><b>Penalty</b>&nbsp;$one</td></tr>";
echo "<tr bgcolor='$bgcolor2'><td width='20%' align='right'><b>Options:</b>&nbsp;[<a href='".$admin_file.".php?op=SREditrule&amp;rid=$rid'>Edit</a>-<a href='".$admin_file.".php?op=SRDel&amp;rid=$rid&amp;ok=0'>Delete</a>";
if ($rpos != 1){
echo "-<a href='".$admin_file.".php?op=SRMoveuprule&amp;rid=$rid&amp;rposup=$rposup'>Up</a>";
}
echo "<a href='".$admin_file.".php?op=SRMovedownrule&amp;rid=$rid&amp;rposdown=$rposdown'>-Down</a>]</td></tr>";
echo "<tr><td colspan='2'></td></tr>";
}
echo "</tr></table><br />";
CloseTable();
break;

case "SRAddrule":
Navigation();
OpenTable();
echo "<form action='".$admin_file.".php?op=SRAddruledb' method='post'>";
echo "<table align='center' width='100%'>";
echo "<tr><td><b>Title</b>&nbsp;(No&nbsp;Html&nbsp;is&nbsp;Allowed)</td></tr>";
echo "<tr><td><input type='text' name='rtitle' size='100'></td></tr>";
echo "<tr><td><b>Rule Details</b>&nbsp;(Html&nbsp;is&nbsp;Allowed)</td></tr>";
echo "<tr><td><textarea name='rdetails' rows='20' cols='97'></textarea></td></tr>";
echo "<tr><td><b>Penalty</b>&nbsp;(No&nbsp;Html&nbsp;is&nbsp;Allowed)</td></tr>";
echo "<tr><td><input type='text' name='one' size='100'></td></tr>";
echo "<tr><td><input type='submit' value='Add Rule'></form></td></tr></table>";
CloseTable();
break;

case "SRAddruledb":
global $admin_file, $prefix, $db;
if ($rtitle == "" || $rdetails == "" || $one == ""){
 Navigation();
OpenTable();
echo "<br><center><b>Title,Details, & Penalty are required fields.</b><br><br>["._GO_BACK."]<br>";
CloseTable();
} else {
$rtitle = strip_tags($rtitle);
$one = strip_tags($one);
$sql = "INSERT INTO ".$prefix."_server_rules (`rid`,`rpos`,`rtitle`,`rdetails`,`one`) VALUES ('NULL','NULL','$rtitle','$rdetails','$one')";
$db->sql_query($sql) or die ('Could not insert into table');
$db->sql_query("OPTIMIZE TABLE ".$prefix."_server_rules") or die ('optimise table failed');
 Navigation();
OpenTable();
Header("Location: ".$admin_file.".php?op=SRMain");
CloseTable();
}
break;

case "SRMoveuprule":
global $admin_file, $prefix, $db, $sitename, $pgtitle;
    $rid = intval($rid);
    $rposnew = intval($rposnew);
    $rposnew = $rposup+1;
    $rposup = intval($rposup);
    $sql = "UPDATE ".$prefix."_server_rules SET rpos='$rposnew' WHERE rpos='$rposup'";
    $result = $db->sql_query($sql);
    $sql2 = "UPDATE ".$prefix."_server_rules SET rpos='$rposup' WHERE rid='$rid'";
    $result2 = $db->sql_query($sql2);
    if((!$result) || (!$result2)){
	  Navigation();
    OpenTable();
    echo "<center><font color='red'>There was a problem updating the database</font></center>";
    CloseTable();
        header("Location: admin.php?op=SRMains");
    } else{
        header("Location: admin.php?op=SRMain");
    }
break;

case "SRMovedownrule":
global $admin_file, $prefix, $db, $sitename, $pgtitle;
    $rid = intval($rid);
    $rposnew = intval($rposnew);
    $rposnew = $rposdown+1;
    $rposdown = intval($rposdown);
    $sql = "UPDATE ".$prefix."_server_rules SET rpos='$rposnew' WHERE rpos='$rposdown'";
    $result = $db->sql_query($sql);
    $sql2 = "UPDATE ".$prefix."_server_rules SET rpos='$rposdown' WHERE rid='$rid'";
    $result2 = $db->sql_query($sql2);
    if((!$result) || (!$result2)){
    Navigation();
    OpenTable();
    echo "<center><font color='red'>There was a problem updating the database</font></center>";
    CloseTable();
    } else{
        header("Location: admin.php?op=SRMain");
    }
break;

case "SREditrule":
global $admin_file, $prefix, $db, $sitename, $pgtitle;
$result = $db->sql_query("SELECT rid, rtitle, rdetails, one from ".$prefix."_server_rules WHERE rid='$rid'");
while($row = $db->sql_fetchrow($result)) {
$rid = intval($row['rid']);
$rtitle = $row['rtitle'];
$rdetails = $row['rdetails'];
$one = $row['one'];
}
Navigation();
OpenTable();
echo "<form action='".$admin_file.".php?op=SREditruledb&amp;rid=$rid' method='post'>";
echo "<table align='center' width='100%'>";
echo "<tr><td><b>Title</b>&nbsp;(No&nbsp;Html&nbsp;is&nbsp;Allowed)</td></tr>";
echo "<tr><td><input type='text' name='rtitle' value='$rtitle' size='100'></td></tr>";
echo "<tr><td><b>Rule Details</b>&nbsp;(Html&nbsp;is&nbsp;Allowed)</td></tr>";
echo "<tr><td><textarea name='rdetails' rows='20' cols='97'>$rdetails</textarea></td></tr>";
echo "<tr><td><b>Penalty</b>&nbsp;(No&nbsp;Html&nbsp;is&nbsp;Allowed)</td></tr>";
echo "<tr><td><input type='text' name='one' value='$one' size='100'></td></tr>";
echo "<tr><td><input type='submit' value='Save Rule'></form></td></tr></table>";
CloseTable();
break;

case "SREditruledb":
global $admin_file, $prefix, $db;
if ($rtitle == "" || $rdetails == "" || $one == ""){
Navigation();
OpenTable();
echo "<br><center><b>Title,Details, & Penalty are required fields.</b><br><br>["._GO_BACK."]<br>";
CloseTable();
} else {
$rid = intval($rid);
$rtitle = strip_tags($rtitle);
$one = strip_tags($one);
$sql = "update ".$prefix."_server_rules set rtitle='$rtitle',rdetails='$rdetails',one='$one' WHERE rid='$rid'";
$db->sql_query($sql) or die ('Could not insert into table');
$db->sql_query("OPTIMIZE TABLE ".$prefix."_server_rules") or die ('optimise table failed');
Header("Location: ".$admin_file.".php?op=SRMain");
}
break;

case "SRDel":
srdel($rid, $ok);
break;
}
srcopy();
include("footer.php");
} else {
include("header.php");
OpenTable();
echo "<center><b>"._ERROR."</b><br><br>You do not have administration permission for module \"$module_name\"</center>";
CloseTable();
srcopy();
include("footer.php");
}
?>