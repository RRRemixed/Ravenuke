<?php
if ( !defined('BLOCK_FILE') ) { Header("Location: ../index.php"); die(); }
//Block Options
//I will put these in the configs next version
$module_name = "Clan_Roster";
$behavior = "SCROLL";
$direction = "down";
$height = "150";
$speed = "2";
$delay = "5";
$showranks = 1; //Set to 0 to turn them off
//End Block Options
global $db, $prefix, $admin, $admin_file;
$active = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members WHERE active='1'"));
$inactive = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members WHERE active='0'"));
$total = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members"));
$i = 0;
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
$content  = "<table width='100%' cellpadding='1' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
//$content .= "<tr><td align='center' class='option' colspan='2'><b><font color='$crfig[hcolor]'></font></b></td></tr>\n";
$content .= "<tr align='center' bgcolor='$crfig[rcolor]'><td colspan='2'>";
$content .= "<Marquee Behavior=\"$behavior\" Direction=\"$direction\" Height=\"$height\" ScrollAmount=\"$speed\" ScrollDelay=\"$delay\" onMouseOver=\"this.stop()\" onMouseOut=\"this.start()\"><br />";
$sql = "SELECT * FROM ".$prefix."_croster_members";
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
$uid = intval($row['uid']);
$rid = intval($row['rid']);
$gid = intval($row['gid']);
$username = $row['username'];
$cusername = $row['cusername'];
$sql3 = "SELECT * FROM ".$prefix."_croster_ranks WHERE crid='$rid'";
$result3 = $db->sql_query($sql3);
$row3 = $db->sql_fetchrow($result3);
$rtitle = $row3['rtitle'];
$rimage = $row3['rimage'];
if($showranks == 1){
$rout = "<img src='$crfig[rankpath]/$rimage' alt='$rtitle'>";
}else{
$rout = $rtitle;
}
//Next version
/*if($crfig[cgames] == 1 && $gamecount > 1){
$sql2 = "SELECT * FROM ".$prefix."_croster_games WHERE cgid='$gid'";
$result2 = $db->sql_query($sql2);
$row2 = $db->sql_fetchrow($result2);
$gtitle = $row2['gtitle'];
$gabbrev = $row2['gabbrev'];
$gimage = $row2['gimage'];
if($crfig[ugimg] == 1){
$gout = "<img src='$crfig[gamepath]/$gimage' alt='$gtitle'>";
}elseif($crfig['ugabbrev'] == 1){
$gout = $gabbrev;
}else{
$gout = $gtitle;
}}*/
$content .= "<div align=\"center\"><a href=\"modules.php?name=".$module_name."&amp;op=profile&amp;uid=$uid&amp;username=$username'\" target=\"_blank\">$crfig[ctag]$cusername</a><br />$rout</div><br />\n";
}
$content .= "</td></tr>";
$content .= "</Marquee>";
$content .= "<tr align='center' bgcolor='$crfig[rcolor]'><td align='center' width='50%'><b>Active</b></td><td align='center' width='50%'><b>$active</b></td></tr>\n";
$content .= "<tr align='center' bgcolor='$crfig[rcolor]'><td align='center' width='50%'><b>InActive</b></td><td align='center' width='50%'><b>$inactive</b></td></tr>\n";
$content .= "<tr align='center' bgcolor='$crfig[rcolor]'><td align='center' width='50%'><b>Total</b></td><td align='center' width='50%'><b>$total</b></td></tr>\n";
if (is_admin($admin)) {
$content .= "<tr bgcolor='$crfig[rcolor]'><td align='center' class='option' colspan='2'>[&nbsp;<a href=\"$admin_file.php?op=CRMain\">Roster Admin</a>&nbsp;]</td></tr>\n";
}
$content .= "</table>";
?>
