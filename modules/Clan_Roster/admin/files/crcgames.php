<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file, $prefix, $db;
Configmenu();
if($update==1) {
$newcrfig = array();
$newcrfig['cgames'] = $cgames;
$newcrfig['gamepath'] = $gamepath;
$newcrfig['ugimg'] = $ugimg;
$newcrfig['ugabbrev'] = $ugabbrev;
$sql = "SELECT * FROM ".$prefix."_croster_config WHERE config_name='cgames' OR config_name='gamepath' OR config_name='ugimg' OR config_name='ugabbrev'";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$db->sql_query("update ".$prefix."_croster_config set config_value='".$newcrfig[$config_name]."' WHERE config_name='".$config_name."'");	
}
Header("Location: ".$admin_file.".php?op=CRCGames");
} else {
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
OpenTable();
echo "<form action='".$admin_file.".php?op=CRCGames&amp;update=1' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Clan Roster Games</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
	if($crfig[cgames] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Games</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='cgames' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='cgames' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[ugabbrev] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Game Abbreviation</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='ugabbrev' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='ugabbrev' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[ugimg] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Game Images</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='ugimg' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='ugimg' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Game Type Images Path</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='gamepath' value=".$crfig[gamepath]."><br \><font color='red'>Be sure to chmod directory 777</font><br \><b>Example</b>&nbsp;modules/$module_name/images/ribbons</center></td>\n";
echo "</tr>";
echo "</table><br>";
echo "<input type='submit' name='submit' value='Save Edit'></center>";
echo "</form>";
} 
CloseTable();
?>
