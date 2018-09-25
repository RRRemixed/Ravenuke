<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function quitteamform() {
	global $xdb;
	$c  = X1plugin_style();
	$cookie = X1_userdetails();
	if (!isset($cookie[1])) {
		$c .= X1plugin_title(XL_teamquit_login);
		return X1plugin_output($c);
	}

	$row = $xdb->GetRow("SELECT ".X1_DB_usersidkey.",".X1_DB_usersnamekey." 
	FROM ".X1_userprefix.X1_DB_userstable." 
	WHERE ".X1_DB_usersidkey."=".$xdb->qstr($cookie[0]));  

	if (!$row) {
		$c .= X1plugin_title(XL_teamquit_login);
		return X1plugin_output($c);
	}

	$c .= X1plugin_title(XL_teamquit_title);
	$c .="
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
	<table class='".X1plugin_quitteamtable."' width='100%'>
        <thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_teamquit_header."</th>
    		</tr>
		</thead>

		<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_teamquit_username."</td>
			<td class='alt1'><input name='member' type='text' disabled value='$row[1]'></td>
		</tr>
		<tr> 
			<td class='alt2'>".XL_teamquit_team."</td>
			<td class='alt2'>";
			$c .= SelectBox_JoinedTeamDrop("team_id", $row[0]);
			$c .= "
			</td>
		</tr>
		</tbody>
		<tfoot class='".X1plugin_tablefoot."'>
		<tr> 
			<td colspan='2' align='center'>
				<input type='Submit' name='submit' value='".XL_teamquit_button."' >
				<input name='".X1_actionoperator."' type='hidden' value='quitteam'> 
			</td>
		</tr>
		</tfoot>
	</table>
	</form>";
	return X1plugin_output($c);
}

function quitteam() {
	global $xdb;
	$c  = X1plugin_style();
	$cookie = X1_userdetails();
	$theuser = $cookie[1];
	if (empty($cookie[1])) {
		$c .= X1plugin_title(XL_teamquit_login);
		return X1plugin_output($c);
	}else{
		$result = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamroster." 
		WHERE team_id = ".$xdb->qstr($_POST['team_id'])." AND name = ".$xdb->qstr($cookie[1])); 
		if (count($result) < 1){      
			$c .= XL_teamquit_none;
			return X1plugin_output($c);
		}else{
			modifysql("delete from", X1_DB_teamroster, " 
			WHERE name=".$xdb->qstr($cookie[1])." 
			AND team_id=".$xdb->qstr($_POST['team_id']));
			
			$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
			WHERE team_id =".$xdb->qstr($_POST['team_id']));  
			$c .= XL_teamquit_removed." ".$row["name"];
		}
	}
	return X1plugin_output($c);
}
?>