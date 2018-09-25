<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file, $prefix, $db;
Configmenu();
if($update==1) {
$newcrfig = array();
$newcrfig['cranks'] = $cranks;
$newcrfig['rankpath'] = $rankpath;
$newcrfig['urimg'] = $urimg;
$sql = "SELECT * FROM ".$prefix."_croster_config WHERE config_name='cranks' OR config_name='rankpath' OR config_name='urimg'";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$db->sql_query("update ".$prefix."_croster_config set config_value='".$newcrfig[$config_name]."' WHERE config_name='".$config_name."'");	
}
Header("Location: ".$admin_file.".php?op=CRCRanks");
} else {
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
OpenTable();
echo "<form action='".$admin_file.".php?op=CRCRanks&amp;update=1' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Clan Roster Ranks</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
	if($crfig[cranks] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Clan Ranks</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='cranks' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='cranks' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[urimg] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Rank Images</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='urimg' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='urimg' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Rank Images Path</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='rankpath' value=".$crfig[rankpath]."><br \><font color='red'>Be sure to chmod directory 777</font><br \><b>Example</b>&nbsp;modules/$module_name/images/ribbons</center></td>\n";
echo "</tr>";
echo "</table><br>";
echo "<input type='submit' name='submit' value='Save Edit'></center>";
echo "</form>";
} 
CloseTable();
?>
