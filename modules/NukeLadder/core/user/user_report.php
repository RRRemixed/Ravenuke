<?php
###############################################################
##X1plugin Competition Management
##Hmepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include')){
	die ("You cannot load this file outfile of X1plugin");
	}
###############################################################
function X1_reportform() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin()){
		$c .= XL_notlogggedin;
		return X1plugin_output($c);
	}
	list ($cookieteamid, $teamname, $password) = cookieread();

	$challenge = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teamchallenges." 
	WHERE randid = ".$xdb->qstr($_POST['randid']));

	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr($challenge['ladder_id']));

	$otherteam = ($challenge['winner'] == $teamname) ? $challenge['loser'] : $challenge['winner'];
	
	if($event['whoreports'] == "winner"){
		$temp = $teamname;
		$teamname = $otherteam;
		$otherteam = $temp;
		unset($temp);
	}
	
	if($_POST['draw'] == "1"){
		$button = trim(XL_teamreport_draw);
		$func = "X1_reportdraw";
	}else{
		$button = ($event['whoreports']=="winner") ? trim(XL_teamreport_win) : trim(XL_teamreport_loss);
		$func = "X1_reportloss";
	}
	
	$c .= "
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
	<table class='".X1_teamreportclass."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_teamreport_title."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_teamreport_event."</td>
			<td class='alt1'><input name='ladder' type='text' readonly size='40' value='$event[title]'></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_teamreport_opponent."</td>
			<td class='alt2'><input name='teamone' type='text' readonly size='40' value='$otherteam'></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_teamreport_you."</td>
			<td class='alt1'><input name='teamtwo' type='text' readonly size='40' value='$teamname'></td>
		</tr>
		<tr>
			<th class='alt2' colspan='2'>".XL_teamreport_mapsandscores."</th>
		</tr>";
		$mapsarry=explode(",",$challenge['map1']);
		$curmap=0;
		while($curmap < $event['nummaps1']){
			list ($mapname, $mappic, $mapdl) = mapinfo($event['sid'], $mapsarry[$curmap]);
			$c .= "
			<tr>
				<td class='alt1' colspan='2'>$mapname</td>
			</tr>
			<tr>
				<td class='alt2'><img src='".X1_imgpath."/maps/$mappic' title='$mapname'></td>
				<td class='alt2'>
					<input type='int' name='m1winnerscore[]' size='5' maxlength='4' value='".XL_na."'>::$otherteam<br />
					<input type='int' name='m1loserscore[]' size='5' maxlength='4' value='".XL_na."'>::$teamname
				</td>
			</tr>";
			$curmap++;
		}
		$mapsarry=explode(",",$challenge['map2']);
		$curmap=0;
		while($curmap < $event['nummaps2']){
			list ($mapname, $mappic, $mapdl) = mapinfo($event['sid'], $mapsarry[$curmap]);
			$c .= "
			<tr>
				<td class='alt1' colspan='2'>$mapname</td>
			</tr>
			<tr>
				<td class='alt2'><img src='".X1_imgpath."/maps/$mappic' title='$mapname'></td>
				<td class='alt2'>
				<input type='int' name='m2winnerscore[]' size='5' maxlength='4' value='".XL_na."'>::$otherteam<br />
				<input type='int' name='m2loserscore[]' size='5' maxlength='4' value='".XL_na."'>::$teamname
				</td>
			</tr>";
			$curmap++;
		}
		$c .= "
			<tr>
				<th class='alt2' colspan='2'>".XL_teamreport_comments."</th>
			</tr>
			<tr>
				<td class='alt1' colspan='2'> 
				<textarea name='comments' cols='60' rows='4'>".XL_teamreport_textarea."</textarea>
				<br />".XL_teamreport_textarea2."
				</td>
			</tr>
			<tr>
				<th class='alt2' colspan='2'>".XL_teamreport_extras."</th>
			</tr>
			<tr>
				<td class='alt2'>".XL_teamreport_demolink."</td>
				<td class='alt2'><input type='text' size='40' name='demo'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_teamreport_screenlink2."</td>
				<td class='alt2'><input type='text' size='40' name='screen1'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_teamreport_screenlink2."</td>
				<td class='alt1'><input type='text' size='40' name='screen2'></td>
			</tr>
		</tbody>
		<tfoot class='".X1plugin_tablefoot."'>
			<tr>
				<th colspan='2'>
				<input name='laddername' type='hidden' value='$event[title]'>
				<input name='winnername' type='hidden' value='$otherteam'>
				<input name='losername' type='hidden' value='$teamname'>
				<input name='map1' type='hidden' value='$challenge[map1]'>
				<input name='map2' type='hidden' value='$challenge[map2]'>
				<input name='map3' type='hidden' value='$challenge[mapid]'>
				<input name='randid' type='hidden' value='$challenge[randid]'>
				<input name='".X1_actionoperator."' type='hidden' value='$func'>
				<input type='Submit' name='Submit' value='$button'>
				</th>
			</tr>
		</tbody>
	</table>
	</form>";
	if ($event['showsettingsreport']){
		require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
		require_once(X1_modpath."/$event[type]/modinfo.php");         
		$c .= laddersettings($event['sid']);
	}
	if ($event['showrulesreport']){      
		$event['bodytext'] = stripslashes($event['bodytext']);
		$c .= XL_teamreport_rules."$event[bodytext]";
	}
	return X1plugin_output($c);
}

function X1_reportloss() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin()){
		$c .= XL_notlogggedin;
		return X1plugin_output($c);
	}
	list ($cookieteamid, $losername, $passworduser) = cookieread();
	
	$challenge = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teamchallenges." 
	WHERE randid = ".$xdb->qstr($_POST['randid']));

	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr($challenge['ladder_id']));

	$winner=$_POST['winnername'];
	$loser=$_POST['losername'];
	
	$row= $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE name = ".$xdb->qstr($_POST['winnername']));
	$mail = $row["mail"];
	$winner_id = $row["team_id"];
	
	$row= $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE name = ".$xdb->qstr($_POST['losername']));
	$mail2 = $row["mail"];
	$loser_id= $row['team_id'];
	
	$history= $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamhistory." 
	WHERE winner = ".$xdb->qstr($winner)." 
	AND loser = ".$xdb->qstr($loser)." 
	AND date >= ".$xdb->qstr(time()-3200*24)."  
	AND laddername = ".$xdb->qstr($event['sid']));
	
	$oneway = count($history);
	
	$history= $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamhistory." 
	WHERE winner = ".$xdb->qstr($loser)." 
	AND loser = ".$xdb->qstr($winner)." 
	AND date >= ".$xdb->qstr(time()-3200*24)."  
	AND laddername = ".$xdb->qstr($event['sid']));
	
	$otherway =count($history);
	$numgames = $oneway + $otherway;
	
	$mapnumarray=array($event['nummaps1'],$event['nummaps2']);

	$m1winnerarray = implode(",", $_POST['m1winnerscore']);
	$m2winnerarray = implode(",", $_POST['m2winnerscore']);
	$m1loserarray  = implode(",", $_POST['m1loserscore']);
	$m2loserarray  = implode(",", $_POST['m2loserscore']);
	
	$mapnumarray   = implode(",", $mapnumarray);
	#if the winner or loser is blank, there is a prob
	if ($winner =="") {
		$c = X1plugin_title( XL_teamreport_blankwinner );
		return X1plugin_output($c);
	}
	if ($loser =="") {
		$c = X1plugin_title( XL_teamreport_blankloser );
		return X1plugin_output($c);
	}
	#Check to see if the ladder is active
	if ($event['active'] != 1){
		$c = X1plugin_title( XL_teamreport_notactive );
		return X1plugin_output($c);
	}
	#Check to see if the ladder is active
	if ($event['enabled'] != 1){
		$c = X1plugin_title( XL_teamreport_disabled );
		 return X1plugin_output($c);
	}
	#if the winner = the loser then there is a problem
	if ($winner == $loser) {
		$c = X1plugin_title(XL_teamreport_playwithself );
		 return X1plugin_output($c);
	}
	#Check to see if X games have allready been played today with this team, if yes error
	if ($numgames >= $event['gamesmaxday']) {
		$c = X1plugin_title( XL_teamreport_gamesmaxday );
		 return X1plugin_output($c);
	}
	if (empty($event['type'])){
		$c .= XL_missingfile; 
		return X1plugin_output($c);
	}
	require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$event[type]/reportloss.php");

	#Send off the Email to each team if enabled
	if (X1_emailon){
		$content = array(
				'winner' =>  $winner,
				'loser' => $loser,
				'winnermail' => $mail,
				'losermail' => $mail2,
				'event' => $event['title']
				);
		$c .= X1plugin_email($mail2, "recievedloss.tpl", $content, XL_teamreport_emailloss);
		$c .= X1plugin_email($mail, "recievedwin.tpl", $content, XL_teamreport_emailwin);
	}
	return X1plugin_output($c);
}

function X1_reportdraw() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin()){
		$c .= XL_notlogggedin;
		return X1plugin_output($c);
	}
	list ($cookieteamid, $losername, $passworduser) = cookieread();
	
	$challenge = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teamchallenges." 
	WHERE randid = ".$xdb->qstr($_POST['randid']));

	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr($challenge['ladder_id']));

	$winner=$_POST['winnername'];
	$loser=$_POST['losername'];
	
	$row= $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE name = ".$xdb->qstr($_POST['winnername']));
	$mail = $row["mail"];
	$winner_id = $row["team_id"];
	
	$row= $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE name = ".$xdb->qstr($_POST['losername']));
	$mail2 = $row["mail"];
	$loser_id= $row['team_id'];
	
	$history= $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamhistory." 
	WHERE winner = ".$xdb->qstr($winner)." 
	AND loser = ".$xdb->qstr($loser)." 
	AND date >= ".$xdb->qstr(time()-3200*24)."  
	AND laddername = ".$xdb->qstr($event['sid']));
	
	$oneway = count($history);
	
	$history= $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamhistory." 
	WHERE winner = ".$xdb->qstr($loser)." 
	AND loser = ".$xdb->qstr($winner)." 
	AND date >= ".$xdb->qstr(time()-3200*24)."  
	AND laddername = ".$xdb->qstr($event['sid']));
	
	$otherway = count($history);
	$numgames = $oneway + $otherway;
	
	$mapnumarray=array($event['nummaps1'],$event['nummaps2']);
	
	$m1winnerarray = implode(",", $_POST['m1winnerscore']);
	$m2winnerarray = implode(",", $_POST['m2winnerscore']);
	$m1loserarray  = implode(",", $_POST['m1loserscore']);
	$m2loserarray  = implode(",", $_POST['m2loserscore']);
	
	$mapnumarray   = implode(",", $mapnumarray);
	#if the winner or loser is blank, there is a prob
	if ($winner =="") {
		$c = X1plugin_title(XL_teamreport_blankwinner);
		return X1plugin_output($c);
	}
	if ($loser =="") {
		$c = X1plugin_title(XL_teamreport_blankloser);
		return X1plugin_output($c);
	}
	#Check to see if the ladder is active
	if ($event['active'] != 1){
		$c = X1plugin_title(XL_teamreport_notactive);
		return X1plugin_output($c);
	}
	#Check to see if the ladder is active
	if ($event['enabled'] != 1){
		$c = X1plugin_title( XL_teamreport_disabled);
		 return X1plugin_output($c);
	}
	#if the winner = the loser then there is a problem
	if ($winner == $loser) {
		$c = X1plugin_title(XL_teamreport_playwithself);
		 return X1plugin_output($c);
	}
	#Check to see if X games have allready been played today with this team, if yes error
	if ($numgames >= $event['gamesmaxday']) {
		$c = X1plugin_title(XL_teamreport_gamesmaxday);
		 return X1plugin_output($c);
	}
	if (empty($event['type'])){
		$c .= XL_missingfile; 
		return X1plugin_output($c);
	}
	require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$event[type]/reportdraw.php");

	#Send off the Email to each team if enabled
	if (X1_emailon){
		$content = array(
				'winner' =>  $winner,
				'loser' => $loser,
				'event' => $event['title']
				);
		$c .= X1plugin_email($mail2, "recieveddraw.tpl", $content, XL_teamreport_emaildraw);
		$c .= X1plugin_email($mail, "recieveddraw.tpl", $content, XL_teamreport_emaildraw);
	}
	return X1plugin_output($c);
}
?>