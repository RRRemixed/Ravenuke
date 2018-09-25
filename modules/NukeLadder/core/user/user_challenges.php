<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.X1plugin.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function challengeteamform() {
	$xdb = XDB::getInstance();
	$c = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	list ($cookieteamid, $teamname, $password) = cookieread();
	$challenger = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE name = ".$xdb->qstr(X1_clean($teamname))." 
	AND ladder_id = ".$xdb->qstr(X1_clean($_POST['ladder_id'])));
	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr(X1_clean($_POST['ladder_id'])));
	$numonroster =count($xdb->GetAll("
    SELECT *
    FROM ".X1_prefix.X1_DB_teamroster."
    WHERE team_id = ".$xdb->qstr(X1_clean($cookieteamid))));
	if($numonroster > $event['maxplayers'])return X1plugin_output($c .= X1plugin_title(XL_teamadmina_joinmaxplayers));
	if($numonroster < $event['minplayers'])return X1plugin_output($c .= X1plugin_title(XL_teamadmina_joinminplayers));
	if (!$event['enabled'])return X1plugin_output($c .= X1plugin_title(XL_challenges_notenabled));
	if (!$event['active'])return X1plugin_output($c .= X1plugin_title(XL_challenges_notactive));
	$c .= X1plugin_title(XL_challenges_challengeteam);
	$c .= "<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
	<table class='".X1plugin_challengeteamtable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th class='alt1'>".XL_challenges_event.":</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
	<tr>
		<td class='alt2'>
			<input name='Laddername' type='text' size='40' readonly='true' value='$event[title]'>
		</td>
	</tr>
	<tr>
		<th class='alt1'>".XL_challenges_yourteam.":</th>
	</tr>
	<tr>
		<td class='alt2'>
			<input type='text' name='yourteamdisplay' value='$teamname' size='40' readonly>
		</td>
	</tr>
	<tr>
		<th class='alt1'>".XL_challenges_otherteam.":</th>
	</tr>
	<tr>
		<td class='alt2'>".SelectBox_ChallLadderTeamDrop("challteam", $event['sid'])."</td>
	</tr>
	<tr>
		<th class='alt1'>".XL_challenges_selectdates."</th>
	</tr>
	<td class='alt2'>";
	$curdate = 1;
	while ($event['numdates'] >= $curdate){
		$c .= X1_edittime(time(), "_$curdate")."<br />";
		$curdate++;
	}
	$c .= "</td>
	</tr>
	<tr>
		<th class='alt1'>".XL_challenges_selectmaps."</th>
	</tr>
	<tr>
	<td class='alt2'>";
	$cm = 1;
	while ($event['nummaps1'] >= $cm){
		$c .= SelectBox_Maplist("maps[]", "$event[sid]");
		$c .= "<br />"; 
		$cm++;
	}
	$c .= "
	</tr>
	<tr>
		<th class='alt1'>".XL_challenges_addedinfo."</th>
	</tr>
	<tr>
		<td class='alt2'>
			<textarea name='extra3' cols='40' rows='5' maxlength='125'></textarea>
		</td>
	</tr>";
	if (X1_extraoneon){
		if (!X1_extraonepage){
			$c .= "
			<tr>
				<th class='alt1'>".X1_extraonename."</th>
			</tr>
			<tr>
				<td class='alt2'>
					<input type='text' name='extra1'>
				</td>
			</tr>";
		}
	}
	$c .= "<br />"; 
	if (X1_extratwoon) {
		if (!X1_extratwopage) {
			$c .= "
			<tr>
				<th class='alt1'>".X1_extratwoname."</th>
			</tr>
			<tr>
				<td class='alt2'>
					<input type='text' name='extra2'>
				</td>
			</tr>";
		}
	}
	$c .= "
	</tbody>
	<tfoot class='".X1plugin_tablefoot."'>
		<tr>
			<td>
				<input type='Submit' name='".X1_actionoperator."' value='sendchallenge'>
				<input type='hidden' name='gamesmaxday' value='$event[gamesmaxday]'>
				<input type='hidden' name='ladder_id' value='$event[sid]'>
			</td>
		</tr>
	</table><br />
	</form>
	";
	if (X1_showsettingschall){
		if (!isset($event['type']))return X1plugin_output($c .= X1plugin_title( XL_missingfile));
		require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
		require_once(X1_modpath."/$event[type]/modinfo.php");
		$c .= laddersettings($event['sid']);
	}
	if (X1_showruleschall)$c .= stripslashes(X1_clean($bodytext,3));
	return X1plugin_output($c);
}

function sendchallenge() {
	$xdb = XDB::getInstance();
	$c = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	list ($teamid, $yourteam, $password) = cookieread();
	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr(X1_clean($_POST['ladder_id'])));
	$numonroster =count($xdb->GetAll("
    SELECT *
    FROM ".X1_prefix.X1_DB_teamroster."
    WHERE team_id = ".$xdb->qstr(X1_clean($teamid))));
	if($numonroster > $event['maxplayers'])return X1plugin_output($c .= X1plugin_title(XL_teamadmina_joinmaxplayers));
	if($numonroster < $event['minplayers'])return X1plugin_output($c .= X1plugin_title(XL_teamadmina_joinminplayers));
	$randid = X1plugin_randid();
	$date=date("U")-(3600*24);
	$challenged = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE team_id = ".$xdb->qstr(X1_clean($_POST['challteam'])));
	$challenger = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE team_id = ".$xdb->qstr(X1_clean($teamid)));
	$rchallenged = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE team_id = ".$xdb->qstr(X1_clean($_POST['challteam']))."
	AND ladder_id=".$xdb->qstr(X1_clean($event['sid'])));
	$rchallenger = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE team_id = ".$xdb->qstr(X1_clean($teamid))." 
	AND ladder_id=".$xdb->qstr(X1_clean($event['sid'])));
	$oneway  = count($xdb->GetAll("SELECT ladder_id 
	FROM ".X1_prefix.X1_DB_teamtempchallenges." 
	WHERE winner = ".$xdb->qstr(X1_clean($challenged['name']))."  
	and loser = ".$xdb->qstr(X1_clean($challenger['name']))."  
	and date >= ".$xdb->qstr(X1_clean($date))."  
	and ladder_id = ".$xdb->qstr(X1_clean($_POST['ladder_id']))));
	$otherway= count($xdb->GetAll("SELECT ladder_id 
	FROM ".X1_prefix.X1_DB_teamchallenges."  
	WHERE winner = ".$xdb->qstr(X1_clean($challenger['name']))."  
	and loser = ".$xdb->qstr(X1_clean($challenged['name']))."  
	and date >= ".$xdb->qstr(X1_clean($date))."  
	and ladder_id = ".$xdb->qstr(X1_clean($_POST['ladder_id']))));
	$num = $oneway + $otherway;
	$challw1= count($xdb->GetAll("SELECT ladder_id 
	FROM ".X1_prefix.X1_DB_teamtempchallenges." 
	WHERE ladder_id = ".$xdb->qstr( X1_clean($_POST['ladder_id']))."  
	and winner = ".$xdb->qstr(X1_clean($challenged['name']))."  
	or loser = ".$xdb->qstr(X1_clean($challenged['name']))));
	$challw2= count($xdb->GetAll("SELECT ladder_id 
	FROM ".X1_prefix.X1_DB_teamchallenges." 
	WHERE ladder_id = ".$xdb->qstr(X1_clean($_POST['ladder_id']))."  
	and winner = ".$xdb->qstr(X1_clean($challenged['name']))."  
	or loser = ".$xdb->qstr(X1_clean($challenged['name'])))); 
	$challw=$challw1+$challw2;
	$challl1= count($xdb->GetAll("SELECT ladder_id 
	FROM ".X1_prefix.X1_DB_teamtempchallenges." 
	WHERE ladder_id = ".$xdb->qstr(X1_clean($_POST['ladder_id']))."  
	and winner = ".$xdb->qstr(X1_clean($challenger['nam']))."  
	or loser = ".$xdb->qstr(X1_clean($challenger['name'])))); 
	$challl2= count($xdb->GetAll("SELECT ladder_id 
	FROM ".X1_prefix.X1_DB_teamchallenges." 
	WHERE ladder_id = ".$xdb->qstr(X1_clean($_POST['ladder_id']))."  
	and winner = ".$xdb->qstr(X1_clean($challenger['name']))."  
	or loser = ".$xdb->qstr(X1_clean($challenger['name'])))); 
	$challl=$challl1+$challl2;
	$curdate = 1;
	while ($event['numdates'] >= $curdate){
		$dates[] = X1_readtime("_$curdate");
		$curdate++;
	}
	if ($event['restrictdates'])if(count($dates) > count(array_unique($dates)))return X1plugin_output($c .= X1plugin_title(XL_challenges_datesrestricted));
	if ($event['type']=="")return X1plugin_output($c .= X1plugin_title( XL_missingfile));
	if($challenger['name'] == $challenged['name'])return X1plugin_output($c .=X1plugin_title(XL_challenges_playwithself));
	#Checks team for being challenged or not
	if($challw >= $event['challengelimit'])return X1plugin_output($c .= X1plugin_title(XL_challenges_allreadychallenged));
	#Checks team for being challenged or not
	if($challl >= $event['challengelimit'])return X1plugin_output($c .= X1plugin_title(XL_challenges_allreadychallenged));
	#Check to see if team has played more than alloted number of games with that team perday
	if($num >= $event['gamesmaxday'])return X1plugin_output($c .= X1plugin_title(XL_challenges_gamesmaxday));
	#Check to see if the ladder is active
	if (!$event['active'])return X1plugin_output($c .= X1plugin_title(XL_challenges_notactive));
	#Check to see if the ladder is active
	if (!$event['enabled'])return X1plugin_output($c .= X1plugin_title(XL_challenges_disabled));
	$maps=$_POST['maps'];
	if ($event['restrictmaps']!=0){
		if(count($maps) > count(array_unique($maps)))return X1plugin_output($c .=  X1plugin_title(XL_mapsrestricted));
	}
	require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$event[type]/challenge.php");
	if (X1_emailon){
		$content = array(
				'team' =>  X1_clean($challenged['name']),
				'team2' =>  X1_clean($challenger['name']),
				'event' =>  X1_clean($event['title']),
				'teammail' => $challenged['mail'],
				'teammail2' => $challenger['mail'],
				'extra1' => X1_extraonename,
				'extra2' => X1_extratwoname,
				'extra1val' => X1_clean($_POST['extra1']),
				'extra2val' => X1_clean($_POST['extra2']),
				'comments' => X1_clean($_POST['extra3'])
				);
		$c .= X1plugin_email($challenger['mail'], "challengesend.tpl", $content);	
		$c .= X1plugin_email($challenged['mail'], "challengerecv.tpl", $content);
	}
	return X1plugin_output(X1plugin_title($c));
}
function confirmchallform() {
	$xdb = XDB::getInstance();
	$c = X1plugin_style();
	list ($cookieteamid, $teamname, $teampass) = cookieread();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	$challenge = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teamtempchallenges." 
	WHERE randid = ".$xdb->qstr(X1_clean($_POST['randid'])));
	$event = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr(X1_clean($challenge['ladder_id'])));
	$mapsarray=explode(",",$challenge['map1']);
	$datesarray=explode(",",$challenge['date1']);
	$c .= X1plugin_title(XL_teamadmin_ChallengeTitle)."
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
	".X1plugin_title($challenge['winner']." ".XL_challenges_vs." ".$challenge['loser'])."
	<table class='".X1plugin_challengeteamtable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_challenges_challengeteam."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_challenges_selectdate.":</td>
			<td class='alt1'>
				<select name='matchdate' id='matchdate'>";
				$cd=0;
				while($cd < $event['numdates']){
					$c .= "<option value='$datesarray[$cd]'>".date(X1_extendeddateformat,$datesarray[$cd])."</option>";
					$cd++;
				}
				$c .= "
				</select>
			</td>
		</tr>
		<tr>
			<td class='alt2'>".XL_challenges_challengermaps."</td>
			<td class='alt2'>";
			$cm=0;
			while($cm < $event['nummaps1']){
				list ($mapname, $mappic, $mapdl) = mapinfo($event['sid'], $mapsarray[$cm]);
				$c .= "<input name='map$cm' readonly type='text' id='map$cm' value='$mapname' size='40'/><br />";
				$cm++;
			}
			$c .= "
			</td>
		</tr>
		<tr>
			<td class='alt1'>".XL_challenges_yourmaps.":</td>
			<td class='alt1'>";
			$cm = 1;
			while ($event['nummaps2'] >= $cm){
				$c .= SelectBox_Maplist("maps[]", $event['sid']);
				$cm++;
			}
			$c .= "
			</td>
		</tr>";
		if (X1_extraoneon) {
			if (X1_extraonepage){
				$c .= "
				<tr>
					<td class='alt2'>".X1_extraonename."</td>
					<td class='alt2'><input type='text' id='extra1' name='extra1' value='$challenge[extra1]'></td>
				</tr>";
			}
		}
		$c .= "<br />"; 
		if (X1_extratwoon) {
			if (X1_extratwopage){
				$c .= "
				<tr>
					<td class='alt1'>".X1_extratwoname."</td>
					<td class='alt1'><input type='text' id='extra2' name='extra2' value='$challenge[extra2]'></td>
				</tr>
				";
			}
		}
		$c .= "
		<tr>
			<td class='alt2'>".XL_challenges_comments."</td>
			<td class='alt2'><textarea name='nonehere' cols='40' rows='5' disabled>$challenge[extra3]</textarea></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_challenges_followup."</td>
			<td class='alt1'><input name='comments2' size='50' maxlength='125'></td>
		</tr>
		</tbody>
		<tfoot class='".X1plugin_tablefoot."'>
			<tr>
				<td colspan='2'>
					<input type='submit' name='accept' value='".XL_challenges_acceptchalenge."'>
					<input name='randid' type='hidden' value='$challenge[randid]'>
					<input name='extra3' type='hidden' value='$challenge[extra3]'>
					<input name='".X1_actionoperator."' type='hidden' value='acceptchall'>
				</td>
			</tr>
		</table>
		</form>
		<br/>
		<table class='".X1plugin_challengeteamtable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				<th>".XL_challenges_challengeteam."</th>
			</tr>
		</thead>
		<tbody class='".X1plugin_tablebody."'>
			<tr>
				<td class='alt1'>
					<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
					<input type='submit' name='decline' value='".XL_challenges_declinechall."'><br />
					$event[declinepoints] ".XL_challenges_warning."
					<input name='randid' type='hidden' value='$challenge[randid]'>
					<input name='".X1_actionoperator."' type='hidden' value='declinechall'>
					</form>
				<td>
			</tr>
			</tbody>
			<tfoot class='".X1plugin_tablefoot."'>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		";
	if ($event['showsettingschall']=='1')$c .= laddersettings($ladder_id);
	if ($event['showruleschall']=='1')$c .= stripslashes(X1_clean($bodytext));
	return X1plugin_output($c);
}

function acceptchall() {
	$xdb = XDB::getInstance();
	$c  = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	list ($cookieteamid, $teamname, $teampass) = cookieread();
	$challenge = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teamtempchallenges." 
	WHERE randid = ".$xdb->qstr($_POST['randid']));
	$event = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr($challenge['ladder_id']));
	if (!$challenge)return X1plugin_output($c .= X1plugin_title(XL_challenges_notfound));
	$extra1 = (X1_extraonepage) ? $_POST['extra1'] : $challenge['extra1'];
	$extra2 = (X1_extratwopage) ?  $_POST['extra2'] : $challenge['extra2'];
	if ($event['type']=="")return X1plugin_output($c .= X1plugin_title(XL_missingfile));
	$maps=$_POST['maps'];
	if ($event['restrictmaps']!=0){
		if(count($maps) > count(array_unique($maps)))return X1plugin_output($c .=  X1plugin_title(XL_mapsrestricted));
	}
	require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$event[type]/acceptchallenge.php");
	if (X1_emailon){
		$row = $xdb->GetRow("SELECT * 
		FROM ".X1_prefix.X1_DB_teams." 
		WHERE name =  ".$xdb->qstr($challenge['winner']));
		$row2= $xdb->GetRow("SELECT * 
		FROM ".X1_prefix.X1_DB_teams." 
		WHERE name = ".$xdb->qstr($challenge['loser']));
		$content = array(
		'team1' =>  $row2["name"],
		'team2' =>  $row["name"],
		'team1mail' =>  $row2["mail"],
		'team2mail' =>  $row["mail"],
		'date' =>  date(X1_extendeddateformat, $_POST['matchdate']),
		'comments' => $challenge['extra3'],
		'followup' => $_POST['comments2']
		);
		$c .= X1plugin_email($row["mail"], "challengeaccept1.tpl", $content);	
		$c .= X1plugin_email($row2["mail"], "challengeaccept2.tpl", $content);
	}
	return X1plugin_output(X1plugin_title($c));
}

function declinechall() {
	$xdb = XDB::getInstance();
	$c  = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	list ($cookieteamid, $teamname, $teampass) = cookieread();
	$challenge = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teamtempchallenges." 
	WHERE randid = ".$xdb->qstr($_POST['randid']));
	if (!$challenge)return X1plugin_output($c .= X1plugin_title(XL_challenges_notfound));
	$event = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr($challenge['ladder_id']));
	$loser_row = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teams." 
	WHERE name = ".$xdb->qstr($challenge['loser']));
	$winner_row = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teams." 
	WHERE name = ".$xdb->qstr($challenge['winner'])); 
	$newtotalpoints = $winner_row["totalpoints"]-$declinepoints;
	$row = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE name = ".$xdb->qstr($challenge['winner'])." 
	AND ladder_id=".$xdb->qstr($challenge['ladder_id'])); 
	$newpoints = $row["points"]-$declinepoints;
	if (!$event['active'])return X1plugin_output($c .= X1plugin_title(XL_challenges_notactive));
	if (!$event['enabled'])return X1plugin_output($c .= X1plugin_title(XL_challenges_disabled));
	if ($event['type']=="")return X1plugin_output($c .= X1plugin_title(XL_missingfile));
	require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$event[type]/declinechallenge.php");
	if (X1_emailon){
		$content = array('time'=>date(X1_extendeddateformat));
		$c .= X1plugin_email($winner_row['mail'], "challengedecline.tpl", $content, 'Challenge Declined');	
		$c .= X1plugin_email($loser_row['mail'], "challengedecline.tpl", $content, 'Challenge Declined');
	}
	return X1plugin_output(X1plugin_title($c));
}

function withdrawchall() {
	$xdb = XDB::getInstance();
	$c  = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	list ($cookieteamid, $team, $password) = cookieread();
	$challenge = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teamtempchallenges." 
	WHERE randid = ".$xdb->qstr($_POST['randid']));
	if (!$challenge)return X1plugin_output($c .= X1plugin_title(XL_challenges_notfound));
	$event = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr($challenge['ladder_id']));
	$row  = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teams." 
	WHERE name = ".$xdb->qstr($challenge['winner']));
	if (!isset($event['type']))return X1plugin_output($c .= X1plugin_title(XL_missingfile));
	require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$event[type]/withdrawchallenge.php");
	if (X1_emailon){
		$content = array(
		'site' =>  X1_site,
		'team1' =>  $loser
		);
		$c .= X1plugin_email($row["mail"], "challengedecline.tpl", $content);	
	}
	return X1plugin_output(X1plugin_title($c));
}
?>