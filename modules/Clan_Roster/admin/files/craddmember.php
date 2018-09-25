<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
OpenTable();
global $db, $prefix, $admin_file, $module_name;
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
if ($search == 1) {
echo "<center><table width='80%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='4' class='option'><b><center><font color='$crfig[hcolor]'>Search Members Results</font></center></b></td></tr>\n";
$result = $db->sql_query("SELECT user_id, username, user_email, user_website, user_fb, user_tw, user_skype, user_steam FROM ".$user_prefix."_users WHERE username LIKE '%$crmsearch%' AND user_id !='1'");
$crmnumrows = $db->sql_numrows($result);
if ($crmnumrows >= 1) {
while(list($user_id, $uname, $email, $fb, $tw, $skype, $steam, $website) = $db->sql_fetchrow($result)){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='25%' align='center'>$user_id</td><td width='25%' align='center'>$uname</td><td width='25%' align='center'>$email</td><td width='25%' align='center'>";
$result2 = $db->sql_query("SELECT username FROM ".$prefix."_croster_members WHERE username='$uname'");
$row2 = $db->sql_fetchrow($result2);
$username2 = $row2['username'];
if($uname == $username2){
echo "<font color='red'>Add Member</font></td>";
}else{
echo "<a href='".$admin_file.".php?op=CRAddmemberp2&amp;uid=$user_id'>Add Member</a></td>";
}
echo "</tr>";
}
echo "</table>";
}else{
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td align='center'>No Members Found Matching Your Search Query<br \><br \><b>"._GOBACK."</b></td>";
echo "</tr>";
echo "</table>";
}
}else{
echo "<form action='".$admin_file.".php?op=CRAddmember&amp;search=1' method='post'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Search Members</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%' align='center'><input type='text' size='35' name='crmsearch'>&nbsp;";
echo "<input type='submit' value='Search For Member'></td>";
echo "</tr></table>";
echo "</form></center>";
}
CloseTable();
?>
