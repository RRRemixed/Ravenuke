<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function createteam() {
	global $xdb;
	$c  = X1plugin_style();
	$cookie = X1_userdetails();
	if (empty($cookie[1])) {
		$c .= X1plugin_title(XL_notlogggedin);
		return X1plugin_output($c);
	}
	$c .= X1plugin_title(XL_teamcreate_title)."
	<table class='".X1plugin_createteamtable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
    	<tr>
    		<th colspan='2'>".XL_teamcreate_title."</th>
    	</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
	<tr>
		<td class='alt1'>".XL_teamcreate_name."</td>
		<td class='alt1'><input name='teamname' id='teamname' type='text' value='' size='25'></td>
	</tr>
	<tr>
		<td class='alt2'>".XL_teamcreate_tags."</td>
		<td class='alt2'><input name='clantags' id='clantags' type='text' value='' size='25'></td>
	</tr>
	<tr>
		<td class='alt1'>".XL_teamcreate_email."</td>
		<td class='alt1'><input name='mail' id='mail' type='text' value='' size='25'></td>
	</tr>
	<tr>
		<td class='alt2'>".XL_teamcreate_homepage."</td>
		<td class='alt2'><input name='homepage' id='homepage' type='text' value='http://' size='25'></td>
	</tr>
	<tr>
		<td class='alt1'>".XL_teamcreate_pass1."</td>
		<td class='alt1'><input name='password' id='password' type='password' value='' size='25'></td>
	</tr>
	<tr>
		<td class='alt2'>".XL_teamcreate_pass2."</td>
		<td class='alt2'><input name='password2' id='password2' type='password' value='' size='25'></td>
	</tr>
	<tr>
		<td class='alt1'>".XL_teamcreate_jpass1."</td>
		<td class='alt1'><input name='joinpassword'  id='joinpassword' type='password' value='' size='25'></td>
	</tr>
	<tr>
		<td class='alt2'>".XL_teamcreate_jpass2."</td>
		<td class='alt2'><input name='joinpassword2' id='joinpassword2' type='password' value='' size='25'></td>
	</tr>
	<tr>
		<td class='alt1'>".XL_teamcreate_location."</td>
		<td class='alt1'>".SelectBox_country("country","")."</td>
	</tr>
	</tbody>
	<tfoot class='".X1plugin_tablefoot."'>
	<tr>
		<th colspan='2' align='center'>
			<input name='".X1_actionoperator."' type='hidden' value='newteam'>
			<input name='captain' type='hidden' value='$cookie[1]'>
			<input type='submit' name='submit' value='".XL_teamcreate_newteam."'>
			</form>
		</th>
	</tr>
    </tfoot>
	</table>";
	return X1plugin_output($c);
}



function newteam() {
	global $xdb;
	$c  = X1plugin_style();
	$c .= X1plugin_title(XL_teamcreate_title);
	$cookie = X1_userdetails();
	$username = $cookie[1];
	$to_userid = $cookie[0];

	if ( !isset($_POST['teamname'])) {
		$c .= X1plugin_title(XL_teamcreate_blankname);
		return X1plugin_output($c); 
	}
	if(!preg_match("/^[a-z0-9 ]+$/i", $_POST['teamname'])){
		$c .= X1plugin_title(XL_teamcreate_invalidfeed);
		return X1plugin_output($c); 
	}
	if ( !isset($_POST['password'])) {
		$c .= X1plugin_title(XL_teamcreate_blankpass);
		return X1plugin_output($c); 
	}
	if ( $_POST['password'] == $_POST['joinpassword']) {
		$c .= X1plugin_title(XL_teamcreate_dupepass);
		return X1plugin_output($c); 
	}

	if ( !isset($_POST['joinpassword'])) {
		$c .= X1plugin_title(XL_teamcreate_blankjpass);
		return X1plugin_output($c); 
	}

	if ( !isset($_POST['mail'])) {
		$c .= X1plugin_title(XL_teamcreate_blankemail);
		return X1plugin_output($c); 
	}

	if ( !isset($_POST['clantags'])) {
		$c .= X1plugin_title(XL_teamcreate_blanktags);
		return X1plugin_output($c); 
	}

	if ( $_POST['password'] != $_POST['password2']) {
		$c .= X1plugin_title(XL_teamcreate_passnomatch);
		return X1plugin_output($c); 
	}

	if ( $_POST['joinpassword'] != $_POST['joinpassword2']) {
		$c .= X1plugin_title(XL_teamcreate_jpassnomatch);
		return X1plugin_output($c); 
	}

	if ( !isset($_POST['country'])) {
		$c .= X1plugin_title(XL_teamcreate_blankcountry);
		return X1plugin_output($c); 
	}

	$samenick = count($xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE name=".$xdb->qstr($_POST['teamname'])));
	
	$sameemail = count($xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE mail=".$xdb->qstr($_POST['mail'])));
	
	$maxteam = count($xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE playerone=".$xdb->qstr($_POST['captain'])));
	
	if ($maxteam >= X1_maxcreate) {
		$c .= XL_teamcreate_toomanyteams; 
		return X1plugin_output($c);
	}
	if ($samenick >= 1) {
		$c .= XL_teamcreate_dupeteam; 
		return X1plugin_output($c);
	}else{
		$new_pass = md5($_POST['password']);
		modifysql("INSERT INTO", X1_DB_teams, "
		(name, passworddb, mail, country, playerone, clantags, joinpassword, homepage) 
		VALUES 
		(
		".$xdb->qstr($_POST['teamname']).", 
		".$xdb->qstr($new_pass).", 
		".$xdb->qstr($_POST['mail']).", 
		".$xdb->qstr($_POST['country']).", 
		".$xdb->qstr($_POST['captain']).", 
		".$xdb->qstr($_POST['clantags']).", 
		".$xdb->qstr($_POST['joinpassword']).", 
		".$xdb->qstr($_POST['homepage'])."
		)");
		
		$team = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
		WHERE name=".$xdb->qstr($_POST['teamname']));
		 
		$row = $xdb->GetRow("SELECT ".X1_DB_usersemailkey.",".X1_DB_usersnamekey.",".X1_DB_usersidkey." 
		FROM ".X1_userprefix.X1_DB_userstable." 
		WHERE ".X1_DB_usersidkey."='$to_userid'");  

		modifysql("INSERT INTO",X1_DB_teamroster, "
		(uid, team_id, name, mail, joindate) 
		VALUES (
		".$xdb->qstr($row[2]).", 
		".$xdb->qstr($team['team_id']).", 
		".$xdb->qstr($row[1]).", 
		".$xdb->qstr($row[0]).",
		".$xdb->qstr(time())."
		)");
		if(X1_emailon){
			$content = array(
				'site' =>  X1_sitename,
				'name' => $_POST['teamname'],
				'apass' => $_POST['password'],
				'jpass' => $_POST['joinpassword'],
				'url' => X1_url
				);
			$c .= X1plugin_email($row[0], "registration.tpl", $content, XL_teamcreate_created);
		}
		$c .= XL_teamcreate_created;
	}
	return X1plugin_output($c);
}

function requestpass() {
	$c  = X1plugin_style();
	$c .= X1plugin_title(XL_teamcreate_requestpass);
	$c .= "
	<table class='".X1plugin_mapslist."' width='100%'>
        <thead class='".X1plugin_tablehead."'>
        <tr>
            <td>".XL_teamcreate_enteremail."</td>
        </tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>
	       <tr>
            <td class='alt1'>
        		<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
        		<input name='maddress' type='text' value=''>
            </td>
          </tr>
          </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td>
					<input name='".X1_actionoperator."' type='hidden' value='forgotpassword'>
					<input type='Submit' name='submit' value='".XL_teamcreate_sendrequest."' >
					</form>
				</td>
            </tr>
        </tfoot>
    </table>";
	return X1plugin_output($c);
}

function forgotpassword() {
	global $xdb;
	$cookie = X1_userdetails();
	$username = $cookie[1];
	if (empty($username)) {
		return X1plugin_title(XL_teamcreate_emptyuser);
	}
	$c .= X1plugin_title(XL_teamcreate_reset);
	$result = $xdb->GetAll("select * from ".X1_prefix.X1_DB_teams." 
	WHERE mail=".$xdb->qstr($_POST['maddress']));
	$num = count($row);
	if (!$result){  
		$c .= X1plugin_title(XL_teamcreate_noteam);
		return X1plugin_output($c);
	}
	foreach($result AS $row){
		$randid = X1plugin_randid();
		$randid2 = md5($randid);
		modifysql("UPDATE", X1_DB_teams, "SET passworddb =".$xdb->qstr($randid2)." 
		WHERE name=".$xdb->qstr($row['name']));
		if (X1_emailon){
			$content = array(
					'site' =>  X1_sitename,
					'name' => $row['name'],
					'pass' => $randid,
					'ip' => getenv("REMOTE_ADDR")
					);
			$c .= X1plugin_email($row["mail"], "passreset.tpl", $content);
			$c .= X1plugin_title(XL_teamcreate_reset);
		}else{
			$c .= X1plugin_title(XL_teamcreate_emailoff);
		}
	}
	return X1plugin_output($c);
}
?>