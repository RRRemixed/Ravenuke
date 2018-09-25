<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function jointeamform() {
	global $xdb;
	$c  = X1plugin_style();
	$cookie = X1_userdetails();
	if (!isset($cookie[1]))return X1plugin_output($c .= X1plugin_title(XL_teamjoin_login));
	$row = $xdb->GetRow("
	SELECT ".X1_DB_usersidkey.",".X1_DB_usersnamekey." 
	FROM ".X1_userprefix.X1_DB_userstable." 
	WHERE ".X1_DB_usersidkey."=".$xdb->qstr($cookie[0]));  
	if (!$row)return X1plugin_output($c .= X1plugin_title(XL_teamjoin_login));
	$c .= X1plugin_title(XL_teamjoin_title)."
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
	<table class='".X1plugin_jointeamtable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
    	<tr>
    		<th colspan='2'>".XL_teamjoin_header.":</th>
    	</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>
	<tr>
		<td class='alt1'>".XL_teamjoin_username."</td>
		<td class='alt1'><input name='member' type='text' disabled value='$cookie[1]'></td>
	</tr>
	<tr>
		<td class='alt2'>".XL_teamjoin_team.":</td>
		<td class='alt2'>". SelectBox_TeamDrop("team_id")."</td>
	</tr>
	<tr> 
		<td class='alt1'>".XL_teamjoin_password.":</td>
		<td class='alt1'>
		<input name='".X1_actionoperator."' type='hidden' value='jointeam'>
		<input type='password' name='joinpassword'>
		</td>
	</tr>
	</tbody>
	<tfoot class='".X1plugin_tablefoot."'>
    	<tr> 
    		<th colspan='2'><input type='Submit' name='submit' value='".XL_teamjoin_joinbutton."'/></th>
    	</tr>
	</tfoot>
	</table>
	</form>";
	return X1plugin_output($c);
}

function jointeam() {
	global $xdb;
	$c  = X1plugin_style();
	$cookie = X1_userdetails();
	if (!isset($cookie[1]))return X1plugin_output($c .= X1plugin_title(XL_teamjoin_login));
	$row = $xdb->GetRow("SELECT ".X1_DB_usersidkey.",".X1_DB_usersnamekey." 
	FROM ".X1_userprefix.X1_DB_userstable." 
	WHERE ".X1_DB_usersidkey."=".$xdb->qstr($cookie[0]));  
	if (!$row)return X1plugin_output($c .= X1plugin_title(XL_teamjoin_login));
	$result = $xdb->GetAll("SELECT team_id FROM ".X1_prefix.X1_DB_teams." 
	WHERE team_id =".$xdb->qstr($_POST['team_id'])." and joinpassword =".$xdb->qstr($_POST['joinpassword'])); 
	if (count($result) < 1)return X1plugin_output($c .= XL_teamjoin_none);
	if ($cookie[1] == "")return X1plugin_output($c .= XL_teamjoin_login);
	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE team_id =".$xdb->qstr($_POST['team_id']));  
	$team_id = $row["team_id"];
	$result2 = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamroster." 
	WHERE team_id = ".$xdb->qstr($_POST['team_id'])." AND name = ".$xdb->qstr($cookie[1])); 
	$check2= count($result2);
	if ($check2 >= 1)return X1plugin_output($c .= XL_teamjoin_dupe);
	$result3 = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamroster." 
	WHERE name =".$xdb->qstr($cookie[1]));  
	$check3= count($result3);
	if ($check3 >= X1_maxjoin)return X1plugin_output($c .= XL_teamjoin_limit);
	$row = $xdb->GetRow("SELECT * FROM ".X1_userprefix.X1_DB_userstable." 
	WHERE ".X1_DB_usersidkey."=".$xdb->qstr($cookie[0]));  
	modifysql("INSERT INTO", X1_DB_teamroster, "
	(uid, team_id, name, mail, joindate) 
	VALUES (
	".$xdb->qstr($row[X1_DB_usersidkey]).",
	".$xdb->qstr($_POST['team_id']).",
	".$xdb->qstr($row[X1_DB_usersnamekey]).", 
	".$xdb->qstr($row[X1_DB_usersemailkey]).", 
	".$xdb->qstr(time()).")
	");
	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." WHERE team_id =".$xdb->qstr($team_id));  
	$c .= XL_teamjoin_joined.$row["name"];
	return X1plugin_output($c);
}
?>