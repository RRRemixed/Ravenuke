<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file, $prefix, $db;
Configmenu();
if($update==1) {
$newcrfig = array();
$newcrfig['uhard'] = $uhard;
$newcrfig['uhardscreens'] = $uhardscreens;
$newcrfig['uhardpath'] = $uhardpath;
$newcrfig['uhardthbpath'] = $uhardthbpath;
$newcrfig['uboard'] = $uboard;
$newcrfig['uproc'] = $uproc;
$newcrfig['umon'] = $umon;
$newcrfig['uprimhd'] = $uprimhd;
$newcrfig['usechd'] = $usechd;
$newcrfig['ugraph'] = $ugraph;
$newcrfig['uram'] = $uram;
$newcrfig['umouse'] = $umouse;
$newcrfig['ukey'] = $ukey;
$newcrfig['ucase'] = $ucase;
$sql = "SELECT * FROM ".$prefix."_croster_config WHERE config_name='uhard' OR config_name='uhardpath' OR config_name='uhardthbpath' OR config_name='uboard' OR config_name='uproc' OR config_name='uproc' OR config_name='umon' OR config_name='uprimhd' OR config_name='usechd' OR config_name='ugraph' OR config_name='umouse' OR config_name='ukey' OR config_name='ucase'";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$db->sql_query("update ".$prefix."_croster_config set config_value='".$newcrfig[$config_name]."' WHERE config_name='".$config_name."'");	
}
Header("Location: ".$admin_file.".php?op=CRCHardware");
} else {
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
OpenTable();
echo "<form action='".$admin_file.".php?op=CRCHardware&amp;update=1' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Clan Roster Hardware Options</font></b></td></tr>\n";
	if($crfig[uhard] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Hardware Profiles</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='uhard' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='uhard' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[uhardscreens] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Hardware Screenshot</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='uhardscreens' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='uhardscreens' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Hardware Images Path</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='uhardpath' value=".$crfig[uhardpath]."><br \><font color='red'>Be sure to chmod directory 777</font><br \><b>Example</b>&nbsp;modules/$module_name/images/ribbons</center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Hardware Thumbnail Images Path</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='uhardthbpath' value=".$crfig[uhardthbpath]."><br \><font color='red'>Be sure to chmod directory 777</font><br \><b>Example</b>&nbsp;modules/$module_name/images/ribbons</center></td>\n";
echo "</tr>";
	if($crfig[uboard] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use MotherBoard Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='uboard'  value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='uboard'  value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[uproc] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Processor Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='uproc'  value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='uproc'  value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[umon] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Monitor Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='umon' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='umon' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[uprimhd] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Primary Hard Drive Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='uprimhd' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='uprimhd' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[usechd] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Secondar Hard Drive Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='usechd' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='usechd' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[ugraph] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Graphics Card Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='ugraph' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='ugraph' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[uram] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Ram Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='uram' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='uram' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[umouse] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Mouse Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='umouse' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='umouse' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[ukey] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Keyboard Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='ukey' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='ukey' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[ucase] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Case Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='ucase' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='ucase' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
echo "</table><br>";
echo "<input type='submit' name='submit' value='Save Edit'></center>";
echo "</form>";
} 
CloseTable();
?>
