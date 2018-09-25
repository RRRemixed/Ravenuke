<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file, $prefix, $db;
Configmenu();
if($update==1) {
$newcrfig = array();
$newcrfig['amemscreens'] = $amemscreens;
$newcrfig['amempath'] = $amempath;
$newcrfig['amemthbpath'] = $amemthbpath;
$newcrfig['aemail'] = $aemail;
$newcrfig['afb'] = $afb;
$newcrfig['atw'] = $atw;
$newcrfig['askype'] = $askype;
$newcrfig['asteam'] = $asteam;
$newcrfig['aage'] = $aage;
$newcrfig['aloc'] = $aloc;
$newcrfig['aflags'] = $aflags;
$newcrfig['astatus'] = $astatus;
$newcrfig['asite'] = $asite;
$sql = "SELECT * FROM ".$prefix."_croster_config WHERE config_name='amemscreens' OR config_name='amempath' OR config_name='amemthbpath' OR config_name='aemail' OR config_name='afb' OR config_name='atw' OR config_name='askype' OR config_name='asteam' OR config_name='aage' OR config_name='aloc' OR config_name='aflags' OR config_name='astatus'  OR config_name='asite'";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$db->sql_query("update ".$prefix."_croster_config set config_value='".$newcrfig[$config_name]."' WHERE config_name='".$config_name."'");	
}
Header("Location: ".$admin_file.".php?op=CRCUsers");
} else {
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
OpenTable();
echo "<form action='".$admin_file.".php?op=CRCUsers&amp;update=1' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Clan Roster User Options</font></b></td></tr>\n";
	if($crfig[astatus] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Show Member Status</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='astatus' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='astatus' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[amemscreens] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Allow Member Screenshot</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='amemscreens'  value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='amemscreens'  value='0' ".$cr2."></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Member Images Path</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='amempath' value=".$crfig[amempath]."><br \><font color='red'>Be sure to chmod directory 777</font><br \><b>Example</b>&nbsp;modules/$module_name/images/ribbons</center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Member Thumbnail Images Path</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='amemthbpath' value=".$crfig[amemthbpath]."><br \><font color='red'>Be sure to chmod directory 777</font><br \><b>Example</b>&nbsp;modules/$module_name/images/ribbons</center></td>\n";
echo "</tr>";
	if($crfig[aemail] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Allow Email-Address Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='aemail'  value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='aemail'  value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[afb] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Afficher Facebook</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='afb' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='afb' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[atw] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Afficher Tweeter</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='atw' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='atw' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[askype] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Afficher Skype</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='askype' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='askype' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[asteam] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Afficher Steam</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='asteam' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='asteam' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[asite] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Allow User Website Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='asite' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='asite' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[aage] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Allow Birthday Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='aage'  value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='aage'  value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[aloc] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Allow Location Field</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='aloc'  value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='aloc'  value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[aflags] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Allow Country Flap Selection</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='aflags'  value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='aflags'  value='0' ".$cr2."></center></td>\n";
echo "</tr>";
echo "</table><br>";
echo "<input type='submit' name='submit' value='Save Edit'></center>";
echo "</form>";
} 
CloseTable();
?>
