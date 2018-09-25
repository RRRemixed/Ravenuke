<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file, $prefix, $db;
Configmenu();
if($update==1) {
$newcrfig = array();
$ctag = str_replace(' ','&nbsp;',$ctag);
$newcrfig['ctag'] = $ctag;
$newcrfig['cspam'] = $cspam;
$newcrfig['cblocks'] = $cblocks;
$newcrfig['cnactive'] = $cnactive;
$newcrfig['cstatus'] = $cstatus;
$newcrfig['cloc'] = $cloc;
$newcrfig['calign'] = $calign;
$newcrfig['calign2'] = $calign2;
$newcrfig['cflags'] = $cflags;
$sql = "SELECT * FROM ".$prefix."_croster_config WHERE config_name='ctag' OR config_name='cspam' OR config_name='cblocks' OR config_name='cnactive' OR config_name='cstatus' OR config_name='cloc' OR config_name='calign' OR config_name='calign2' OR config_name='cflags'";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$db->sql_query("update ".$prefix."_croster_config set config_value='".$newcrfig[$config_name]."' WHERE config_name='".$config_name."'");	
}
Header("Location: ".$admin_file.".php?op=CRCGeneral");
} else {
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
$oldcrfigalign = $crfig[calign];
$oldcrfigalign2 = $crfig[calign2];
OpenTable();
echo "<form action='".$admin_file.".php?op=CRCGeneral&amp;update=1' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Clan Roster Configuration</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Clan Tag</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='ctag' value=".$crfig[ctag]."></center></td>\n";
echo "</tr>";
	if($crfig[cspam] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Use Contact Spam Protection</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='cspam' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='cspam' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[cblocks] == "true"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Right blocks on or off?</center></td>\n";
echo "<td width='50%'><center>On&nbsp;<input type='radio' name='cblocks' value='true' ".$cr1.">&nbsp;Off&nbsp;<input type='radio' name='cblocks' value='false' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[cnactive] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Show inactive members on main page?</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='cnactive' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='cnactive' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[cstatus] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Show status on main page?</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='cstatus' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='cstatus' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[cloc] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Show location on main page?</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='cloc' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='cloc' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[cflags] == "1"){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Show flags on main page?</center></td>\n";
echo "<td width='50%'><center>Yes&nbsp;<input type='radio' name='cflags' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='cflags' value='0' ".$cr2."></center></td>\n";
echo "</tr>";
	if($crfig[calign] == "left"){            
		$cr1 = "selected";
		$cr2 = "";
		$cr3 = "";
	} elseif($crfig[calign] == "center"){
		$cr1 = "";
		$cr2 = "selected";
		$cr3 = "";
	}	else {
		$cr1 = "";
		$cr2 = "";
		$cr3 = "selected";
	}
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Alignment for main page column titles</center></td>\n";
echo "<td width='50%'><center><select name='calign'><option value=''>-------------</option><option value='left' $cr1>Left</option>";
echo "<option value='center' $cr2>Center</option><option value='right' $cr3>Right</option></select></center></td>\n";
echo "</tr>";
	if($crfig[calign2] == "left"){            
		$cr1 = "selected";
		$cr2 = "";
		$cr3 = "";
	} elseif($crfig[calign2] == "center"){
		$cr1 = "";
		$cr2 = "selected";
		$cr3 = "";
	}	else {
		$cr1 = "";
		$cr2 = "";
		$cr3 = "selected";
	}
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Alignment for main page row values</center></td>\n";
echo "<td width='50%'><center><select name='calign2'><option value=''>-------------</option><option value='left' $cr1>Left</option>";
echo "<option value='center' $cr2>Center</option><option value='right' $cr3>Right</option></select></center></td>\n";
echo "</tr>";
echo "</table><br \>";
echo "<input type='submit' name='submit' value='Save Edit'></center>";
echo "</form>";
} 
CloseTable();
?>
