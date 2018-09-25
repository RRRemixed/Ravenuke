<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.nukeladder.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function teamsmanager(){
	$c = "
		<table class='".X1plugin_admintable."' width='100%'>
			<thead class='".X1plugin_tablehead."'>
				<tr>
					<th>".XL_ateams_editglobal."</th>
				</tr>
			</thead>
			<tbody class='".X1plugin_tablebody."'>
				<tr>
					<td class='alt1'>".displayTeams()."</td>
				</tr>
			</tbody>
			<thead class='".X1plugin_tablehead."'>
				<tr>
					<th>".XL_ateams_editevent."</th>
				</tr>
			</thead>
			<tbody class='".X1plugin_tablebody."'>
				<tr>
					<td class='alt2'>".displayladderTeams()."</td>
				</tr>
			</tbody>
			<tfoot class='".X1plugin_tablefoot."'>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</tfoot>
    	</table>";
	return X1plugin_output($c, 1);
}

function displayladderTeams() {
	$c = "<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>".XL_ateams_name;
	$c .= SelectBox_LadderDrop("ladder_id");
    $c .= SelectBox_TeamDrop("team_id");
	if(!isset($team_id)){
		$team_id="";
	}
	$c .= "
	<select name='".X1_actionoperator."'>
		<option value='modifyladderTeam'>".XL_edit."</option>\n
		<option value='delladderTeam'>".XL_delete."</option>\n
	</select>\n
	<input type='submit' value='".XL_ok."'>
	</form>";
	return X1plugin_output($c, 1);
}

function modifyladderTeam() {
    global $xdb;
	$c  = x1_admin("teams");
	$C .= "<br />";
    $c .= X1plugin_title(XL_ateams_teamadmin);
	$row = $xdb->GetRow("
    select * from ".X1_prefix.X1_DB_teamsevents."
    where team_id=".$xdb->qstr($_POST['team_id'])." and ladder_id=".$xdb->qstr($_POST['ladder_id']));
	if($row) {
		$c .= XL_ateams_editteam."$chng_team
		<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
		<table class='".X1plugin_admintable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
        <tr>
			<td colspan='2'>".XL_ateams_editevent."</td>
        </tr>
        <tbody class='".X1plugin_tablebody."'>
	    <tr>
			<td class='alt1'>".XL_ateams_eventname."</td>
			<td class='alt1'><input type='text' name='ladder_id' readonly='true' value='$row[ladder_id]'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_id."</td>
			<td class='alt2'><input type='text' name='team_id' readonly='true' value='$row[team_id]'></td>
		</tr>
	    <tr>
			<td class='alt1'>".XL_ateams_name."</td>
			<td class='alt1'><input type='text' name='tname' readonly='true' value='$row[name]'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_password."</td>
			<td class='alt2'><input type='hidden' name='passworddb' value=''></td>
		</tr>
	    <tr>
			<td class='alt1'>".XL_ateams_email."</td>
			<td class='alt1'><input type='text' name='mail' value='$row[mail]' size='30' maxlength='60'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_country."</td>
			<td class='alt2'><input type='text' name='country' value='$row[country]' size='20' maxlength='20'></td>
		</tr>
		<tr>
			<td>".XL_ateams_rung."</td>
			<td><input type='text' name='rung' value='$row[rung]' size='20' maxlength='20'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_games."</td>
			<td class='alt2'><input type='text' name='games' value='$row[games]' size='20' maxlength='20'></td>
		</tr>
	    <tr>
			<td class='alt1'>".XL_ateams_wins."</td>
			<td class='alt1'><input type='text' name='wins' value='$row[wins]' size='20' maxlength='20'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_losses."</td>
			<td class='alt2'><input type='text' name='losses' value='$row[losses]' size='20' maxlength='20'></td>
		</tr>
	    <tr>
			<td class='alt1'>".XL_ateams_points."</td>
			<td class='alt1'><input type='text' name='points' value='$row[points]' size='25' maxlength='60'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_twins."</td>
			<td class='alt2'><input type='text' name='totalwins' value='$row[totalwins]' size='25' maxlength='60'></td>
		</tr>
	    <tr>
			<td class='alt1'>".XL_ateams_tlosses."</td>
			<td><input type='text' name='totallosses' value='$row[totallosses]' size='25' maxlength='255'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_tgames."</td>
			<td class='alt2'><input type='text' name='totalgames' value='$row[totalgames]' size='25' maxlength='60'></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_ateams_tpoints."</td>
			<td class='alt1'><input type='text' name='totalpoints' value='$row[totalpoints]' size='20' maxlength='20'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_penalties."</td>
			<td class='alt2'><input type='text' name='penalties' value='$row[penalties]' size='25' maxlength='60'></td>
		</tr>
	    <tr>
			<td class='alt1'>".XL_ateams_swins."</td>
			<td class='alt1'><input type='text' name='streakwins' value='$row[streakwins]' size='25' maxlength='255'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_slosses."</td>
			<td class='alt2'><input type='text' name='streaklosses' value='$row[streaklosses]' size='20' maxlength='20'></td>
		</tr>
	    <tr>
			<td class='alt1'>".XL_ateams_rest."</td>
			<td class='alt1'><input type='text' name='rest' value='$row[rest]' size='20' maxlength='20'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_status."</td>
			<td class='alt2'><input type='text' name='challenged' value='$row[challenged]' size='25' maxlength='255'></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_ateams_challyesno."</td>
			<td class='alt1'><input type='text' name='challyesno' value='$row[challyesno]' size='25' maxlength='255'></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_ateams_clantags."</td>
			<td class='alt2'><input type='text' name='clantags' value='$row[clantags]' size='25' maxlength='60'></td>
		</tr>
	    <tr>
			<td class='alt1'>".XL_ateams_homepage."</td>
			<td class='alt1'><input type='text' name='homepage' value='$row[homepage]' size='20' maxlength='255'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_ateams_logo."</td>
			<td class='alt2'><input type='text' name='clanlogo' value='$row[clanlogo]' size='25' maxlength='60'></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_ateams_updatemain."</td>
			<td class='alt1'>
				<select name='updatemain'>
					<option value='0'>".XL_no."</option>
					<option value='1' selected>".XL_yes."</option>
				</select>
			</td>
		</tr>
		
	    </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='2'>
                <input type='submit' value='".XL_save."Save' />
                <input type='hidden' name='".X1_actionoperator."' value='updateladderTeam' />
                </td>
            </tr>
        </tfoot>
        </table>
		</form>";
    } else {
		$c .= X1plugin_title(XL_ateams_none);
    }
	return X1plugin_output($c);
}

function updateladderTeam() {
    global $xdb;
	$result = $xdb->GetRow("select * from ".X1_prefix.X1_DB_teams." 
	where team_id=".$xdb->qstr($_POST['team_id'])."  
	or name=".$xdb->qstr($_POST['team_id']));
    $xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." set
		name=".$xdb->qstr($_POST['tname']).",
		mail=".$xdb->qstr($POST['mail']).",
		icq=".$xdb->qstr($_POST['icq']).",
		msn=".$xdb->qstr($_POST['msn']).",
		country=".$xdb->qstr($_POST['country']).",
		games=".$xdb->qstr($_POST['games']).",
		wins=".$xdb->qstr($_POST['wins']).",
		losses=".$xdb->qstr($_POST['losses']).",
		points=".$xdb->qstr($_POST['points']).",
		totalwins=".$xdb->qstr($_POST['totalwins']).",
		totallosses=".$xdb->qstr($_POST['totallosses']).",
		totalpoints=".$xdb->qstr($_POST['totalpoints']).",
		totalgames=".$xdb->qstr($_POST['totalgames']).",
		penalties=".$xdb->qstr($_POST['penalties']).",
		streakwins=".$xdb->qstr($_POST['streakwins']).",
		streaklosses=".$xdb->qstr($_POST['streaklosses']).",
		challenged=".$xdb->qstr($_POST['challenged']).",
		clantags=".$xdb->qstr($_POST['clantags']).",
		homepage=".$xdb->qstr($_POST['homepage']).",
		clanlogo=".$xdb->qstr($_POST['clanlogo']).",
		rung=".$xdb->qstr($_POST['rung']).",
		rest=".$xdb->qstr($_POST['rest'])."
		where team_id=".$xdb->qstr($_POST['team_id'])." 
		and ladder_id=".$xdb->qstr($_POST['ladder_id']));
	if ($_POST['passworddb'] != '') {
		$newpass = md5($_POST['passworddb']);
		$xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." 
		set passworddb=".$xdb->qstr($newpass)." 
		where team_id=".$xdb->qstr($_POST['team_id'])."  
		and ladder_id=".$xdb->qstr($_POST['ladder_id']));
	}
	if($_POST['updatemain']=="1"){
		$games_diff = $result['games'] - $_POST['games'];
		$wins_diff = $result['wins'] - $_POST['wins'];
		$losses_diff = $result['losses'] - $_POST['losses'];
		$points_diff = $result['points'] - $_POST['points'];
		$totalwins_diff = $result['totalwins'] - $_POST['totalwins'];
		$totallosses_diff = $result['totallosses'] - $_POST['totallosses'];
		$totalpoints_diff = $result['totalpoints'] - $_POST['totalpoints'];
		$totalgames_diff = $result['totalgames'] - $_POST['totalgames'];
		$penalties_diff = $result['penalties'] - $_POST['penalties'];
		$xdb->Execute("update ".X1_prefix.X1_DB_teams." set
					games=games-$games_diff,
					wins=wins-$wins_diff,
					losses=losses-$losses_diff,
					points=points-$points_diff,
					totalwins=totalwins-$totalwins_diff,
					totallosses=totallosses-$totallosses_diff,
					totalpoints=totalpoints-$totalpoints_diff,
					totalgames=totalgames-$totalgames_diff,
					penalties=penalties-$penalties_diff
					where team_id=".$xdb->qstr($_POST['team_id']));
		
	}


	$c  = x1_admin("teams");
	$c .= X1plugin_title(XL_ateams_teamadmin);
	return X1plugin_output($c);
}

function displayTeams() {
	$c  = "<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>".XL_ateams_editteam;
	$c .= SelectBox_TeamDrop("team_id");
	$c .= "<select name='".X1_actionoperator."'>
				<option value='modifyTeam'>".XL_edit."</option>\n
				<option value='delTeam'>".XL_delete."</option>
			</select>\n
			<input type='submit' value='".XL_ok."'>
			</form>";
	return X1plugin_output($c, 1);
}

function X1_removeteam(){
    global $xdb;
    $xdb->Execute("DELETE FROM ".X1_prefix.X1_DB_teams." WHERE team_id=".$xdb->qstr(X1_clean($_POST['team_id'])));
	$c  = x1_admin("teams");
    $c .= X1plugin_title("Team Removed");
}



function X1_removeladderteam(){
   global $xdb;
    $xdb->Execute("DELETE FROM ".X1_prefix.X1_DB_teamsevents."
    WHERE team_id=".$xdb->qstr(X1_clean($_POST['team_id']))."  
	and ladder_id=".$xdb->qstr(X1_clean($_POST['ladder_id'])));
	$c  = x1_admin("teams");
    $c .= X1plugin_title("Team Removed");
}

function modifyTeam() {
    global $xdb;
	$c  = x1_admin("teams");
    $result = $xdb->GetRow("select * from ".X1_prefix.X1_DB_teams." 
	where team_id=".$xdb->qstr(X1_clean($_POST['team_id']))."  
	or name=".$xdb->qstr(X1_clean($_POST['team_id'])));
    if($result) {
		$c .= "<br />
	    <form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
	    <table class='".X1plugin_admintable."' width='100%'>
	    <thead class='".X1plugin_tablehead."'>
			<tr>
				<th colspan='2'>".XL_ateams_editteam."$result[name]</th>
			</tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>
			<tr>
				<td class='alt1'>".XL_ateams_id."</td>
				<td class='alt1'>$result[team_id]</td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_name."</td>
				<td class='alt2'><input type='text' name='tname' value='$result[name]'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_password."</td>
				<td class='alt1'><input type='text' name='passworddb' value=''></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_email."</td>
				<td class='alt2'><input type='text' name='mail' value='$result[mail]' size='30' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_country."</td>
				<td class='alt1'><input type='text' name='country' value='$result[country]' size='20' maxlength='20'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_rung."</td>
				<td class='alt2'><input type='text' name='games' value='$result[games]' size='20' maxlength='20'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_games."</td>
				<td class='alt1'><input type='text' name='wins' value='$result[wins]' size='20' maxlength='20'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_wins."</td>
				<td class='alt2'><input type='text' name='losses' value='$result[losses]' size='20' maxlength='20'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_losses."</td>
				<td class='alt1'><input type='text' name='points' value='$result[points]' size='25' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_twins."</td>
				<td class='alt2'><input type='text' name='totalwins' value='$result[totalwins]' size='25' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_tlosses."</td>
				<td class='alt1'><input type='text' name='totallosses' value='$result[totallosses]' size='25' maxlength='255'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_tpoints."</td>
				<td class='alt2'><input type='text' name='totalpoints' value='$result[totalpoints]' size='20' maxlength='20'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_tgames."</td>
				<td class='alt1'><input type='text' name='totalgames' value='$result[totalgames]' size='25' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_penalties."</td>
				<td class='alt2'><input type='text' name='penalties' value='$result[penalties]' size='25' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_swins."</td>
				<td class='alt1'><input type='text' name='streakwins' value='$result[streakwins]' size='25' maxlength='255'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_slosses."</td>
				<td class='alt2'><input type='text' name='streaklosses' value='$result[streaklosses]' size='20' maxlength='20'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_captain."</td>
			 	<td class='alt1'><input type='text' name='playerone' value='$result[playerone]' size='25' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_profile."</td>
			 	<td class='alt2'><input type='text' name='playerone2' value='$result[playerone2]' size='25' maxlength='255'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_clantags."</td>
			 	<td class='alt1'><input type='text' name='clantags' value='$result[clantags]' size='25' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_challenged."</td>
				<td class='alt2'><input type='text' name='challenged' value='$result[challenged]' size='25' maxlength='255'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_homepage."</td>
				<td class='alt1'><input type='text' name='homepage' value='$result[homepage]' size='20' maxlength='255'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_logo."</td>
				<td class='alt2'><input type='text' name='clanlogo' value='$result[clanlogo]' size='25' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_ircserver."</td>
				<td class='alt1'><input type='text' name='ircserver' value='$result[ircserver]' size='25' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_ateams_ircchannel."l</td>
				<td class='alt2'><input type='text' name='ircchannel' value='$result[ircchannel]' size='25' maxlength='60'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_ateams_joinpassword."</td>
				<td class='alt1'><input type='text' name='joinpassword' value='$result[joinpassword]' size='25' maxlength='60'></td>
			</tr>
	    </tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='2'>
                <input type='hidden' name='team_id' value='$result[team_id]'>
    			<input type='hidden' name='".X1_actionoperator."' value='adminupdateteam'>
                <input type='submit' value='".XL_save."'>
            </td>
        </tr>
    </tfoot>
    </table>
	</form>";
    } else {
		$c .= X1plugin_title(XL_ateams_none);
    }
	return X1plugin_output($c);
}

function adminupdateteam() {
	global $xdb;
    $xdb->Execute("update ".X1_prefix.X1_DB_teams." set
					name=".$xdb->qstr(X1_clean($_POST['tname'])).",
					mail=".$xdb->qstr(X1_clean($_POST['mail'])).",
					icq=".$xdb->qstr(X1_clean($_POST['icq'])).",
					msn=".$xdb->qstr(X1_clean($_POST['msn'])).",
					country=".$xdb->qstr(X1_clean($_POST['country'])).",
					games=".$xdb->qstr(X1_clean($_POST['games'])).",
					wins=".$xdb->qstr(X1_clean($_POST['wins'])).",
					losses=".$xdb->qstr(X1_clean($_POST['losses'])).",
					points=".$xdb->qstr(X1_clean($_POST['points'])).",
					totalwins=".$xdb->qstr(X1_clean($_POST['totalwins'])).",
					totallosses=".$xdb->qstr(X1_clean($_POST['totallosses'])).",
					totalpoints=".$xdb->qstr(X1_clean($_POST['totalpoints'])).",
					totalgames=".$xdb->qstr(X1_clean($_POST['totalgames'])).",
					penalties=".$xdb->qstr(X1_clean($_POST['penalties'])).",
					streakwins=".$xdb->qstr(X1_clean($_POST['streakwins'])).",
					streaklosses=".$xdb->qstr(X1_clean($_POST['streaklosses'])).",
					playerone=".$xdb->qstr(X1_clean($_POST['playerone'])).",
					clantags=".$xdb->qstr(X1_clean($_POST['clantags'])).",
					challenged=".$xdb->qstr(X1_clean($_POST['challenged'])).",
					homepage=".$xdb->qstr(X1_clean($_POST['homepage'])).",
					clanlogo=".$xdb->qstr(X1_clean($_POST['clanlogo'])).",
					ircserver=".$xdb->qstr(X1_clean($_POST['ircserver'])).",
					ircchannel=".$xdb->qstr(X1_clean($_POST['ircchannel'])).",
					joinpassword=".$xdb->qstr(X1_clean($_POST['joinpassword']))." 
					where team_id=".$xdb->qstr(X1_clean($_POST['team_id'])));
	if ($_POST['passworddb'] != '') {
		$newpass = md5($_POST['passworddb']);
		$xdb->Execute("update ".X1_prefix.X1_DB_teams." 
		set passworddb=".$xdb->qstr(X1_clean($newpass))." 
		where team_id=".$xdb->qstr(X1_clean($_POST['team_id'])));
	}
	$c  = x1_admin("teams");
	$c .= X1plugin_title(XL_ateams_teamupdated);
	return X1plugin_output($c);
}
?>