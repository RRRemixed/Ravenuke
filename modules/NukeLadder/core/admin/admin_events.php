<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.nukeladder.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################

function ladderlistmanager() {
  global $xdb;
    $c = "
    <table class='".X1plugin_admintable."' width='100%'>
        <thead class='".X1plugin_tablehead."'>
        	<tr>
        		<th>".XL_aevents_add."</th>
        		<th>".XL_aevents_fixrungs."</th>
        	</tr>
    	</thead>
    <tbody class='".X1plugin_tablebody."'>
	<tr>
		<td class='alt1' width='50%'>
			<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
				<input name='Submit' type='Submit' value='".XL_aevents_new."'>
				<input name='".X1_actionoperator."' type='hidden' value='xadminladder'>
			</form>
		</td>
		<td class='alt2' align='right' width='50%'>
			<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>".
			SelectBox_LadderDrop("fix_ladder_id").
			"<input name='".X1_actionoperator."' type='hidden' value='fixladderrungs'>
			<input name='Submit' type='Submit' value='".XL_aevents_fixrungs."'>
			</form>
		</td>
	</tr>
	</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='2'>&nbsp;</td>
        </tr>
    </tfoot>
    </table>
	<br />
	<table class='".X1plugin_admintable."' width='100%'>
    	<thead class='".X1plugin_tablehead."'>
        	<tr>
        		<th>".XL_aevents_hid."</th>
        		<th>".XL_aevents_hname."</th>
        		<th>".XL_aevents_hgame."</th>
        		<th>".XL_aevents_hmod."</th>
        		<th>".XL_aevents_hactive."</th>
        		<th>".XL_aevents_henabled."</th>
        		<th>".XL_aevents_hmodify."</th>
        	</tr>
    	</thead>
	<tbody class='".X1plugin_tablebody."'>";
	$result = $xdb->GetAll("select * from ".X1_prefix.X1_DB_events." order by sid DESC");
	$num = count($result);
	$cur = 1;
	if($result){
		foreach($result AS $row) {
			$game = $xdb->GetRow("select gamename from ".X1_prefix.X1_DB_games." where gameid=".$xdb->qstr($row['game']));
			if($game){
				$gamename = $game['gamename'];
				$active  = ($row['active']) ? XL_yes : XL_no;
				$enabled = ($row['enabled']) ? XL_yes : XL_no;
				$c .= "
				<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
					<tr>
						<td class='alt1'>$row[sid]</td>
						<td class='alt2'>$row[title]</td>
						<td class='alt1'>$gamename</td>
						<td class='alt2'>$row[type]</td>
						<td class='alt1'>$active</td>
						<td class='alt2'>$enabled</td>
						<td class='alt1'>
							<input name='sid' type='hidden' value='$row[sid]'>
							<select name='".X1_actionoperator."'>
								<option value='editevent'>".XL_edit."</option>
								<option value='RemoveLadder'>".XL_delete."</option>
							</select>
							<input name='Submit' type='Submit' value='".XL_ok."'>
						</td>
					</tr>
				</form>";
				$cur++;
				}
			}
	}else{
		$c .= "	<tr>
					<td colspan='8'>".XL_aevents_none."</td>
				</tr>";
	}
	$c .= "</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='8'>&nbsp;</td>
        </tr>
    </tfoot>
    </table>";
	return X1plugin_output($c, 1);
}

function X1plugin_adminladder() {
    global $xdb;
	$c  = x1_admin("ladders");
	$c .= '<br />';
	$c .= X1plugin_title('New Event');
    $c .= "<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>";
	$c .= "<script type='text/javascript' src='".X1_jspath."/mapgroups.js' ></script>
	<table class='".X1plugin_admintable."' width='100%'>
    	<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_general."</th>
    		</tr>
        </head>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1'>".XL_aevents_name."</td>
    			<td class='alt1'><input type='text' name='subject' size='50' value=''></td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_game."</td>
    			<td class='alt2'>".SelectBox_games()."</td>
    		</tr>
    		<tr>
    			<td class='alt1'>".XL_aevents_mod."</td>
    			<td class='alt1'>".SelectBox_mods("type", "league")."</td>
    		</tr>";
    			$lex1 = ( isset($liex1) ) ? $lex1 : '';
    			$lex2 = ( isset($liex2) ) ? $lex2 : '';
    			$c .= "
    		<tr>
    			<td class='alt2'>".XL_aevents_sort."</td>
    			<td class='alt2'><input type='text' name='standingstype' size='20' value=''></td>
    		</tr>
    		<tr>
    			<td class='alt1'>".XL_aevents_lex1."</td>
    			<td class='alt1'><input type='text' name='score' size='20' value='$lex1'> </td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_lex2."</td>
    			<td class='alt2'><input type='text' name='ratings' size='20' value='$lex2'> </td>
    		</tr>
		</tbody>
		<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_options."</th>
    		</tr>
		</head>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1'>".XL_aevents_active."</td>
    			<td class='alt1'>
    				<select name='active'>
    					<option value='1' selected>".XL_yes."</option>
    					<option value='0'>".XL_no."</option>
    				</select>
    			</td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_enabled."</td>
    			<td class='alt2'>
    				<select name='enabled'>
    					<option value='1' selected>".XL_yes."</option>
    					<option value='0'>".XL_no."</option>
    				</select>
    			</td>
    		</tr>
    		<tr>
    			<td class='alt1'>".XL_aevents_simchall."</td>
    			<td class='alt1'><input type='int' name='challengelimit' size='6' value='2'> </td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_maxgames."</td>
    			<td class='alt2'><input type='int' name='gamesmaxday' size='6' value='1'> </td>
    		</tr>
    		<tr>
    			<td class='alt1'>".XL_aevents_maxteams."</td>
    			<td class='alt1'><input type='int' name='maxteams' size='6' value='100'> </td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_minplayers."</td>
    			<td class='alt2'><input type='int' name='minplayers' size='6' value='1'> </td>
    		</tr>
			<tr>
    			<td class='alt2'>".XL_aevents_maxplayers."</td>
    			<td class='alt2'><input type='int' name='maxplayers' size='6' value='500'> </td>
    		</tr>
		</tbody>
		<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_challdate."</th>
    		</tr>
    		</head>
            <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1'>".XL_aevents_resdates."</td>
    			<td class='alt1'>
    				<select name='restrictdates'>
    					<option value='1'>".XL_yes."</option>
    					<option value='0' selected>".XL_no."</option>
    				</select>
    			</td>
    		</tr>
    		<tr>
    			<td class='alt1'>".XL_aevents_numdates."</td>
    			<td class='alt1'><input type='int' name='numdates' size='6' value='3'></td>
    		</tr>
		</tbody>
		<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_mapoptions."</th>
    		</tr>
		</head>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1'>".XL_aevents_resmaps."</td>
    			<td class='alt1'>
    				<select name='restrictmaps'>
    					<option value='1'>".XL_yes."</option>
    					<option value='0' selected>".XL_no."</option>
    				</select>
    			</td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_nummaps1."</td>
    			<td class='alt2'><input type='int' name='nummaps1' size='6' value='2'> </td>
    		</tr>
    		<tr>
    			<td class='alt1'>".XL_aevents_nummaps2."</td>
    			<td class='alt1'><input type='int' name='nummaps2' size='6' value='1'> </td>
    		</tr>
			
			<tr>
    			<td class='alt1'>".XL_aevents_mapgroups."</td>
    			<td class='alt1'>".SelectBox_MapGroups(array())."</td>
    		</tr>
			
		</tbody>
		<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_pointoptions."</th>
    		</tr>
		</head>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1'>".XL_aevents_win."</td>
    			<td class='alt1'><input type='int' name='pointswin' size='6' value='2'> </td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_loss."</td>
    			<td class='alt2'><input type='int' name='pointsloss' size='6' value='0'> </td>
    		</tr>
    		<tr>
    			<td class='alt1'>".XL_aevents_draw."</td>
    			<td class='alt1'><input type='int' name='pointsdraw' size='6' value='1'> </td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_declinedchall."</td>
    			<td class='alt2'><input type='int' name='declinepoints' size='6' value='1'> </td>
    		</tr>
		</tbody>
		<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_expireoptions."</th>
    		</tr>
		</head>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1'>".XL_aevents_enableexpires."</td>
    			<td class='alt1'>   				
					<select name='enableexpires'>
    					<option value='1'>".XL_yes."</option>
    					<option value='0' selected>".XL_no."</option>
    				</select></td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_expirehours."</td>
    			<td class='alt2'><input type='int' name='expirehours' size='6' value='120'> </td>
    		</tr>
    		<tr>
    			<td class='alt1'>".XL_aevents_expirepenalty."</td>
    			<td class='alt1'><input type='int' name='expirepen' size='6' value='1'> </td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_expirebonus."</td>
    			<td class='alt2'><input type='int' name='expirebon' size='6' value='1'> </td>
    		</tr>
		</tbody>
		<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_reportoptions."</th>
    		</tr>
		</head>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1'>".XL_aevents_whoreports."</td>
    			<td class='alt1'>   				
					<select name='whoreports'>
    					<option value='winner'>".XL_aevents_winner."</option>
    					<option value='loser' selected>".XL_aevents_loser."</option>
    				</select></td>
    		</tr>
		</tbody>
		<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_description."</th>
			</tr>
		</head>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td colspan='2' class='alt1'><textarea wrap='virtual' cols='50' rows='12' name='hometext'></textarea></td>
			</tr>
		</tbody>
		<thead class='".X1plugin_tablehead."'>
			<tr>
    			<th colspan='2'>".XL_aevents_rules."</th>
    		</tr>
		</head>
       	<tbody class='".X1plugin_tablebody."'>
			<tr>
    			<td colspan='2' class='alt2'><textarea wrap='virtual' cols='50' rows='12' name='bodytext'></textarea></td>
    		</tr>
		</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
		<tr>
			<th colspan='2'>
				<input type='submit' value='".XL_aevents_post."'>
				<input type='hidden' name='".X1_actionoperator."' value='newevent'>
			</th>
		</tr>
	</tfoot>
    </table>
	</form>";
	return X1plugin_output($c);
}



function newcompevent() {
    global $xdb;
	$result = $xdb->Execute("insert into ".X1_prefix.X1_DB_events." (
	title,time,hometext,bodytext,game,score,ratings,pointswin,pointsloss,pointsdraw,gamesmaxday,
	declinepoints,active,enabled,challengelimit,restrictdates,numdates,
	restrictmaps,nummaps1,nummaps2,standingstype,maxteams,minplayers,maxplayers,type,
	expirechalls,expirehours,expirepen,expirebon,whoreports,mapgroups
	) values (
	".$xdb->qstr($_POST['subject']).",
	".$xdb->qstr(time()).",
	".$xdb->qstr(trim($_POST['hometext'])).",
	".$xdb->qstr(trim($_POST['bodytext'])).",
	".$xdb->qstr($_POST['game']).",
	".$xdb->qstr($_POST['score']).",
	".$xdb->qstr($_POST['ratings']).",
	".$xdb->qstr($_POST['pointswin']).",
	".$xdb->qstr($_POST['pointsloss']).",
	".$xdb->qstr($_POST['pointsdraw']).",
	".$xdb->qstr($_POST['gamesmaxday']).",
	".$xdb->qstr($_POST['declinepoints']).",
	".$xdb->qstr($_POST['active']).",
	".$xdb->qstr($_POST['enabled']).",
	".$xdb->qstr($_POST['challengelimit']).",
	".$xdb->qstr($_POST['restrictdates']).",
	".$xdb->qstr($_POST['numdates']).",
	".$xdb->qstr($_POST['restrictmaps']).",
	".$xdb->qstr($_POST['nummaps1']).",
	".$xdb->qstr($_POST['nummaps2']).",
	".$xdb->qstr($_POST['standingstype']).",
	".$xdb->qstr($_POST['maxteams']).",
	".$xdb->qstr($_POST['minplayers']).",
	".$xdb->qstr($_POST['maxplayers']).",
	".$xdb->qstr($_POST['type']).",
	".$xdb->qstr($_POST['enableexpires']).",
	".$xdb->qstr($_POST['expirehours']).",
	".$xdb->qstr($_POST['expirepen']).",
	".$xdb->qstr($_POST['expirebon']).",
	".$xdb->qstr($_POST['whoreports']).",
	".$xdb->qstr(implode(",",$_POST['selectedmapgroups']))."
	)");
	$c = x1_admin("ladders");
    $c .= X1plugin_title(XL_aevents_added);
	return X1plugin_output($c);
}

function x1_editevent() {
    global $xdb;
	$c  = x1_admin("ladders");
	$c .= '<br />';
	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr($_POST['sid']));
    $result2=$xdb->GetRow("select gameimage from ".X1_prefix.X1_DB_games." where gameid=".$xdb->qstr($event['game']));
    $gameimage = $result2['gameimage'];
	$active2 = ($event['active']) ? XL_yes : XL_no;
	$enabled2 = ($event['enabled']) ? XL_yes : XL_no;
	$restrictdates2 = ($event['restrictdates']) ? XL_yes : XL_no;
	$restrictmaps2 = ($event['restrictmaps']) ? XL_yes : XL_no;
	$expirechalls = ($event['expirechalls']) ? XL_yes : XL_no;
	$whoreports = ($event['whoreports']=="winner") ? XL_aevents_winner : XL_aevents_loser;
	
    $c .= X1plugin_title(XL_aevents_editing."$event[sid] - $event[title]");
	$c .= "<script type='text/javascript' src='".X1_jspath."/mapgroups.js' ></script>
	<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
	<table class='".X1plugin_admintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
			<tr>
				<th colspan='2'>".XL_aevents_general."</th>
			</tr>
	</thead>
		<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_aevents_name."</td>
			<td class='alt1'><input type='text' name='subject' size='50' value='$event[title]'></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_game."</td>
			<td class='alt2'>".SelectBox_games('game', $event['game'])."</td>
		</tr>
		<tr>
			<td class='alt1'>".XL_aevents_mod."</td>
			<td class='alt1'>".SelectBox_mods("type", $event['type'])."</td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_sort."</td>
			<td class='alt2'><input type='text' name='standingstype' size='20' value='$event[standingstype]'> </td>
		</tr>
		<tr>
			<td class='alt1'>".XL_aevents_lex1."</td>
			<td class='alt1'><input type='text' name='score' size='20' value='$event[score]'></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_lex2."</td>
			<td class='alt2'><input type='text' name='ratings' size='20' value='$event[ratings]'> </td>
		</tr>
	</tbody>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_aevents_options."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_aevents_active."</td>
			<td class='alt1'>
				<select name='active'>
					<option value='$event[active]' selected>$active2</option>
					<option value='1'>".XL_yes."</option>
					<option value='0'>".XL_no."</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_enabled."</td>
			<td class='alt2'>
				<select name='enabled'>
					<option value='$event[enabled]' selected>$enabled2</option>
					<option value='1'>".XL_yes."</option>
					<option value='0'>".XL_no."</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='alt1'>".XL_aevents_simchall."</td>
			<td class='alt1'><input type='int' name='challengelimit' size='6' value='$event[challengelimit]'> </td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_maxgames."</td>
			<td class='alt2'><input type='int' name='gamesmaxday' size='6' value='$event[gamesmaxday]'> </td>
		</tr>
		<tr>
			<td class='alt1'>".XL_aevents_maxteams."</td>
			<td class='alt1'><input type='int' name='maxteams' size='6' value='$event[maxteams]'> </td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_minplayers."</td>
			<td class='alt2'><input type='int' name='minplayers' size='6' value='$event[minplayers]'> </td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_maxplayers."</td>
			<td class='alt2'><input type='int' name='maxplayers' size='6' value='$event[maxplayers]'> </td>
		</tr>
	</tbody>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_aevents_challdate."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_aevents_resdates."</td>
			<td class='alt1'>
				<select name='restrictdates'>
					<option value='$event[restrictdates]' selected>$restrictdates2</option>
					<option value='1'>".XL_yes."</option>
					<option value='0'>".XL_no."</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_numdates."</td>
			<td class='alt2'><input type='int' name='numdates' size='6' value='$event[numdates]'></td>
		</tr>
	</tbody>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_aevents_mapoptions."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_aevents_resmaps."</td>
			<td class='alt1'>
				<select name='restrictmaps'>
					<option value='$event[restrictmaps]' selected>$restrictmaps2</option>
					<option value='1'>".XL_yes."</option>
					<option value='0'>".XL_no."</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_nummaps1."</td>
			<td class='alt2'><input type='int' name='nummaps1' size='6' value='$event[nummaps1]'> </td>
		</tr>
		<tr>
			<td class='alt1'>".XL_aevents_nummaps2."</td>
			<td class='alt1'><input type='int' name='nummaps2' size='6' value='$event[nummaps2]'> </td>
		</tr>
		<tr>
			<td class='alt1'>".XL_aevents_mapgroups."</td>
			<td class='alt1'>".SelectBox_MapGroups(explode(",",$event[mapgroups]))."</td>
		</tr>
	</tbody>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_aevents_pointoptions."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt2'>".XL_aevents_win."</td>
			<td class='alt2'><input type='int' name='pointswin' size='6' value='$event[pointswin]'> </td>
		</tr>
		<tr>
			<td class='alt1'>".XL_aevents_loss."</td>
			<td class='alt1'><input type='int' name='pointsloss' size='6' value='$event[pointsloss]'> </td>
		</tr>
		<tr>
			<td class='alt2'>".XL_aevents_draw."</td>
			<td class='alt2'><input type='int' name='pointsdraw' size='6' value='$event[pointsdraw]'> </td>
		</tr>
		<tr>
			<td class='alt1'>".XL_aevents_declinedchall."</td>
			<td class='alt1'><input type='int' name='declinepoints' size='6' value='$event[declinepoints]'> </td>
		</tr>
	</tbody>
	<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_expireoptions."</th>
    		</tr>
		</head>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1'>".XL_aevents_enableexpires."</td>
    			<td class='alt1'>   				
					<select name='enableexpires'>
						<option value='$event[expirechalls]' selected>$expirechalls</option>
    					<option value='1'>".XL_yes."</option>
    					<option value='0'>".XL_no."</option>
    				</select></td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_expirehours."</td>
    			<td class='alt2'><input type='int' name='expirehours' size='6' value='$event[expirehours]'> </td>
    		</tr>
    		<tr>
    			<td class='alt1'>".XL_aevents_expirepenalty."</td>
    			<td class='alt1'><input type='int' name='expirepen' size='6' value='$event[expirepen]'> </td>
    		</tr>
    		<tr>
    			<td class='alt2'>".XL_aevents_expirebonus."</td>
    			<td class='alt2'><input type='int' name='expirebon' size='6' value='$event[expirebon]'> </td>
    		</tr>
		</tbody>
		
	</tbody>
	<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_aevents_reportoptions."</th>
    		</tr>
		</head>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1'>".XL_aevents_whoreports."</td>
    			<td class='alt1'>   				
					<select name='whoreports'>
						<option value='$event[whoreports]' selected>$whoreports</option>
    					<option value='winner'>".XL_aevents_winner."</option>
    					<option value='loser'>".XL_aevents_loser."</option>
    				</select></td>
    		</tr>
		</tbody>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_aevents_description."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt2' colspan='2'><textarea wrap='virtual' cols='50' rows='12' name='hometext'>
			".stripslashes($event['hometext'])."</textarea></td>
		</tr>
	</tbody>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_aevents_rules."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1' colspan='2'><textarea wrap='virtual' cols='50' rows='4' name='bodytext'>
			".stripslashes($event['bodytext'])."</textarea></td>
		</tr>
	</tbody>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_aevents_notes."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt2' colspan='2'><textarea wrap='virtual' cols='50' rows='4' name='notes'>
			".stripslashes($event['notes'])."</textarea></td>
		</tr>
	</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='2'>
				<input type='hidden' name='sid' size='50' value='$_POST[sid]'>
				<input type='hidden' name='".X1_actionoperator."' value='".XL_aevents_change."'>
				<input type='Submit'  value='Save'>
			</td>
        </tr>
    </tfoot>
    </table>
	</form>";
	return X1plugin_output($c);
}

function removeLadder() {
   global $xdb;
	if(isset($_GET['ok'])) {
    	$xdb->Execute("DELETE FROM ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr($_GET['sid']));
		$xdb->Execute("DELETE FROM ".X1_prefix.X1_DB_teamsevents." where ladder_id=".$xdb->qstr($_GET['sid']));
	    $b = XL_aevents_removed;
	} else {
	    $b = XL_aevents_removewarning."[ <a href='".X1_admingetfile."'>".XL_no."</a> |
		 <a href='".X1_admingetfile."?".X1_linkactionoperator."=RemoveLadder&amp;sid=$_POST[sid]&amp;ok=1'>".XL_yes."</a> ]";
	}
	$c  = x1_admin("ladders");
	$c .= X1plugin_title($b);
	return X1plugin_output($c);
}

function changeLadder() {
    global $xdb;
	$groups = (!empty($_POST['selectedmapgroups'])) ? implode(",",$_POST['selectedmapgroups']):"";
	$xdb->Execute("update ".X1_prefix.X1_DB_events." set
						sid=".$xdb->qstr($_POST['sid']).",
						title=".$xdb->qstr($_POST['subject']).",
						time=".$xdb->qstr(time()).",
						hometext=".$xdb->qstr($_POST['hometext']).",
						bodytext=".$xdb->qstr($_POST['bodytext']).",
						game=".$xdb->qstr($_POST['game']).",
						notes=".$xdb->qstr($_POST['notes']).",
						score=".$xdb->qstr($_POST['score']).",
						ratings=".$xdb->qstr($_POST['ratings']).",
						pointswin=".$xdb->qstr($_POST['pointswin']).",
						pointsloss=".$xdb->qstr($_POST['pointsloss']).",
						pointsdraw=".$xdb->qstr($_POST['pointsdraw']).",
						gamesmaxday=".$xdb->qstr($_POST['gamesmaxday']).",
						declinepoints=".$xdb->qstr($_POST['declinepoints']).",
						active=".$xdb->qstr($_POST['active']).",
						enabled=".$xdb->qstr($_POST['enabled']).",
						challengelimit=".$xdb->qstr($_POST['challengelimit']).",
						restrictdates=".$xdb->qstr($_POST['restrictdates']).",
						numdates=".$xdb->qstr($_POST['numdates']).",
						restrictmaps=".$xdb->qstr($_POST['restrictmaps']).",
						nummaps1=".$xdb->qstr($_POST['nummaps1']).",
						nummaps2=".$xdb->qstr($_POST['nummaps2']).",
						standingstype=".$xdb->qstr($_POST['standingstype']).",
						maxteams=".$xdb->qstr($_POST['maxteams']).",
						minplayers=".$xdb->qstr($_POST['minplayers']).",
						maxplayers=".$xdb->qstr($_POST['maxplayers']).",
						type=".$xdb->qstr($_POST['type']).",
						expirechalls=".$xdb->qstr($_POST['enableexpires']).",
						expirehours=".$xdb->qstr($_POST['expirehours']).",
						expirepen=".$xdb->qstr($_POST['expirepen']).",
						expirebon=".$xdb->qstr($_POST['expirebon']).",
						whoreports=".$xdb->qstr($_POST['whoreports']).",
						mapgroups=".$xdb->qstr($groups)."
						where sid=".$xdb->qstr($_POST['sid']));
	$result = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_events);
	foreach($result AS $row){
		$sid=$row['sid'];
		$type=$row['title'];
		$xdb->Execute("UPDATE ".X1_prefix.X1_DB_teamsevents." 
		SET ladder_name =".$xdb->qstr($_POST['type'])." 
		WHERE ladder_id=".$xdb->qstr($_POST['sid']));
	}
	$c = x1_admin("ladders");
	$c .= X1plugin_title(XL_aevents_updated);
	return X1plugin_output($c);
}


function fixladderrungs(){
	global $xdb;
	$result=$xdb->GetAll("select * from ".X1_prefix.X1_DB_teamsevents." 
	WHERE ladder_id=".$xdb->qstr($_POST['fix_ladder_id'])." ORDER BY rung ASC");
	$cur=1;
	foreach($result AS $row){
		$fixteam_id=$row["team_id"];
		$xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." set rung=".$xdb->qstr($cur)." 
		WHERE team_id=".$xdb->qstr($fixteam_id)." AND ladder_id=".$xdb->qstr($_POST['fix_ladder_id']));
		$cu++;
	}
	$c  = x1_admin("ladders");
	$c .= X1plugin_title(XL_aevents_fixed." $_POST[fix_ladder_id]");
	return X1plugin_output($c);
}
?>