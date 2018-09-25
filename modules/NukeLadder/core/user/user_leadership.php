<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
# Function to give another user captain status
# Old admin will no longer be captain.
function X1_transfer_leadership(){
	#Database
	global $xdb;
	#Style
	$c  = X1plugin_style();
	#Check Login
	if(!checklogin())return X1plugin_output(X1plugin_title($c .=XL_notlogggedin));
	#Cookie Information
	list ($team_id, $team, $password) = cookieread();
	#Lookup Team
	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE team_id=".$xdb->qstr(X1_clean($team_id)));
	#Exit if No Team Found
	if(!$row)return X1plugin_output($c .= X1plugin_title(XL_cantloadteam));
	#User Information
	$user = X1_userdetails();
	#If Captian is the logged in user, allow transfer
	if($row['playerone'] == $user[1]){
		#Lookup Selected User info
		$row = $xdb->GetRow("
		SELECT * FROM ".X1_userprefix.X1_DB_userstable."
		WHERE ".X1_DB_usersidkey."=".$xdb->qstr(X1_clean($_POST['user_id'])));
		#Exit if Cant Find Selected User
		if(!$row)return X1plugin_output($c .= X1plugin_title(XL_cantloaduser));
		$email = $row[X1_DB_usersemailkey];
		$id = $row[X1_DB_usersidkey];
		$name = $row[X1_DB_usersnamekey];
		#Check if the user is a member on the roster
		$ex = $xdb->GetRow("SELECT uid 
		FROM ".X1_prefix.X1_DB_teamroster." 
		WHERE uid=".$xdb->qstr(X1_clean($id))."  
		AND team_id=".$xdb->qstr(X1_clean($team_id)));
		if($ex){
			#Update team record with selected user
			$row = $xdb->Execute("
			UPDATE ".X1_prefix.X1_DB_teams." 
			SET playerone =".$xdb->qstr(X1_clean($name)).",
			mail =".$xdb->qstr(X1_clean($email))." 
			WHERE team_id=".$xdb->qstr(X1_clean($team_id)));
			setcookie(X1_cookiename);
			#Output Success
			$c .= X1plugin_title(XL_leadership_transfered);
			return X1plugin_output($c);
		}else{
			#Output Failure
			$c .= X1plugin_title(XL_leadership_notonroster);
			return X1plugin_output($c);
		}
	}else{
		#Not Captain, Exit
		return X1plugin_output($c .= X1plugin_title(XL_notcaptian));
	}
}
?>