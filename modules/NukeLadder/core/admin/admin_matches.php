<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.nukeladder.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################

function matchmanager() {
    global $xdb;
	$c ="
	<table class='".X1plugin_admintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th>".XL_amatches_addrecord."</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>
	<tr>
		<td class='alt1'>
        <form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>".
		SelectBox_LadderDrop("ladder_id").
		"<input type='image' title='".XL_amatches_addrecord."' src='".X1_imgpath.X1_addimage."'>
			<input type='hidden' name='".X1_actionoperator."' value='createplayedgame'>
			</form>
			</td>
		</tr>
		</tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='6'>&nbsp;</td>
            </tr>
        </tfoot>
        </table>
		<br />
		<table class='".X1plugin_admintable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				<th>".XL_amatches_hid."</th>
				<th>".XL_amatches_hevent."</th>
				<th>".XL_amatches_hwinner."</th>
				<th>".XL_amatches_hloser."</th>
				<th>".XL_amatches_hdate."</th>
				<th>".XL_amatches_hdraw."</th>
				<th>".XL_amatches_hmodify."</th>
			</tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>";
	$rows = $xdb->GetAll("
	select winner, loser, date, laddername, game_id, draw 
	from ".X1_prefix.X1_DB_teamhistory." 
	order by game_id DESC");
	$count = count($rows);
	$cur = 1;
	if($rows){
		foreach($rows AS $row){
		$event =  $xdb->GetRow("
		select title from ".X1_prefix.X1_DB_events." 
		WHERE sid = ".$xdb->qstr($row['laddername']));
			$draw = ($row['draw']) ? XL_yes : XL_no;
			$c .= "
			<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
			<tr>
				<td class='alt1'>$row[game_id]</td>
				<td class='alt2'>$event[title]</td>
				<td class='alt1'>$row[winner]</td>
				<td class='alt2'>$row[loser]</td>
				<td class='alt1'>".date(X1_dateformat,$row['date'])."</td>
				<td class='alt2'>$draw</td>
				<td class='alt1'>
					<input name='id' type='hidden' value='$row[game_id]'>
					<select name='".X1_actionoperator."'>
						<option value='modifymatch'>".XL_edit."</option>
						<option value='delmatch'>".XL_delete."</option>
					</select>
					<input type='submit' value='".XL_ok."'>
				</td>
			</tr>
			</form>";
			$cur++;
		}
	}else{
		$c .= "	<tr>
					<td colspan='8'>".XL_amatches_none."</td>
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

function createplayedgame(){
	global $xdb;
	$c  = x1_admin("matches");
	$c .= "<br />";
	$c .= X1plugin_title(XL_amatches_createtitle);
	$event = $xdb->GetRow("
    SELECT * FROM ".X1_prefix.X1_DB_events."
    where sid=".$xdb->qstr($_POST['ladder_id']));

	$c .= "
	<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
	<table class='".X1plugin_admintable."' width='100%'>
    <tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_amatches_winner."</td>
			<td class='alt1'>
			<select name='winner'>";
			$toplist = $xdb->GetAll("
            select team_id, name from ".X1_prefix.X1_DB_teamsevents."
            WHERE ladder_id=".$xdb->qstr($event['sid']));

			$c .= "<option value=''>".XL_amatches_selwinner."</option>\n";
			foreach($toplist AS $option){
				$c .= "<option value='$option[name]'>$option[name]</option>\n";
			}
			$c .= "</select>
			</td>
		</tr>
		<tr>
			<td class='alt2'>".XL_amatches_loser."</td>
			<td class='alt2'>
			<select name='loser'>";
			$toplist = $xdb->GetAll("
            select team_id, name from ".X1_prefix.X1_DB_teamsevents."
            WHERE ladder_id=".$xdb->qstr($event['sid']));

			$c .= "<option value=''>".XL_amatches_selloser."</option>\n";
			foreach($toplist AS $option){
				$c .= "<option value='$option[name]'>$option[name]</option>\n";
			}
			$c .= "</select>
			</td>
		</tr>
	<tr>
	   <td class='alt1'>".XL_amatches_seldate."</td>
	   <td class='alt1'>".X1_edittime(time())."</td>
	</tr>
	<tr>
		<td colspan='2'>".XL_amatches_winnermaps."</td>
	</tr>";
	$cm = 1;
	while ($event['nummaps1'] >= $cm){
		$c .= "<tr><td class='alt2'>Map $cm;</td><td class='alt2'>";
		$c .= SelectBox_Maplist("mapa[]", $event['sid']);
		$c .= XL_amatches_winnerscore;
		$c .= "<input type='textfield' value='' name='wscorea[]' size='5'>";
        $c .= XL_amatches_loserscore;
		$c .= "<input type='textfield' value='' name='lscorea[]' size='5'>";
		$c .= "</td></tr>";
		$cm++;

	}
	$c .="<tr>
		  <td colspan='2'>".XL_amatches_losermaps."</td>
    	</tr>";
	$cm = 1;
	while ($event['nummaps2'] >= $cm){
		$c .= "<tr><td class='alt2'>Map $cm;</td><td class='alt2'>";
		$c .= SelectBox_Maplist("mapb[]", $event['sid']);
		$c .= XL_amatches_winnerscore;
		$c .= "<input type='textfield' value='' name='wscoreb[]' size='5'>";
        $c .= XL_amatches_loserscore;
		$c .= "<input type='textfield' value='' name='lscoreb[]' size='5'>";
		$c .= "</td></tr>";
		$cm++;
	}
	$c .= " <tr>
				<th>".XL_amatches_extras."</th>
			</tr>
			<tr>
				<td class='alt1'>".XL_amatches_screenshot."</td>
				<td class='alt1'><input type='textfield' value='' name='screen1'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_amatches_screenshot."</td>
				<td class='alt2'><input type='textfield' value='' name='screen2'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_amatches_demo."</td>
				<td class='alt1'><input type='textfield' value='' name='demo1'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_amatches_comments."</td>
				<td class='alt2'><input type='textfield' value='' name='comments'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_amatches_draw."</td>
				<td class='alt2'>
					<select name='draw'>
						<option value='0'>".XL_no."</option>
						<option value='1'>".XL_yes."</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class='alt1'>".XL_amatches_runplugincode."</td>
				<td class='alt1'>
					<select name='runplugin'>
						<option value='0'>".XL_no."</option>
						<option value='1' selected>".XL_yes."</option>
					</select>
				</td>
			</tr>
			
			";
			$randid = X1plugin_randid();
	$c .=  "</tbody>
            <tfoot class='".X1plugin_tablefoot."'>
                <tr>
                    <td colspan='2'>
                    	<input type='hidden' value='$event[title]' name='laddername'>
    					<input type='hidden' value='$randid' name='randid'>
    					<input type='hidden' value='$event[sid]' name='ladder_id'>
    					<input type='hidden' value='insertplayedgame' name='".X1_actionoperator."'>
    					<input type='submit' value='".XL_amatches_addmatch."'>
                    </td>
                </tr>
            </tfoot>
            </table>
			</form>";
	return X1plugin_output($c);
}

function insertplayedgame() {
	global $xdb;
	
	if (empty($_POST['winner'])){
		$c  = x1_admin("matches");
		$c .= X1plugin_title(XL_amatches_errnowinner);
		return X1plugin_output($c);
	}
	if (empty($_POST['loser'])){
		$c  = x1_admin("matches");
		$c .= X1plugin_title(XL_amatches_errnoloser);
		return X1plugin_output($c);
	}
	if ($_POST['winner']==$_POST['loser']){
		$c  = x1_admin("matches");
		$c .= X1plugin_title(XL_amatches_errsameteams);
		return X1plugin_output($c);
	}
	
	$event = $xdb->GetRow("
    SELECT * FROM ".X1_prefix.X1_DB_events."
    where sid=".$xdb->qstr($_POST['ladder_id']));

	$challenge['map1']=implode(",",$_POST['mapa']);
	$challenge['map2']=implode(",",$_POST['mapb']);

	$m1winnerarray=implode(",",$_POST['wscorea']);
	$m1loserarray=implode(",",$_POST['lscorea']);
	$m2winnerarray=implode(",",$_POST['wscoreb']);
	$m2loserarray=implode(",",$_POST['lscoreb']);
	
	$w = $xdb->GetRow("select team_id, mail 
	from ".X1_prefix.X1_DB_teams." 
	where name=".$xdb->qstr($_POST['winner']));
	$l = $xdb->GetRow("select team_id, mail 
	from ".X1_prefix.X1_DB_teams." 
	where name=".$xdb->qstr($_POST['loser']));
	$winner_id = $w[0];
	$loser_id = $l[0];
	$winner = $_POST['winner'];
	$loser = $_POST['loser'];
	$mail = $w[1];
	$mail2 = $l[1];
	if($_POST['runplugin'] =="1"){
		require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
		if($_POST['draw'] =="1"){
			require_once(X1_modpath."/$event[type]/reportdraw.php");
		}else{
			require_once(X1_modpath."/$event[type]/reportloss.php");
		}
	}else{
		$result = $xdb->Execute("insert into ".X1_prefix.X1_DB_teamhistory."
		(winner,loser,date,map1,map2,map1t1,map1t2,map2t1,map2t2,map3t1,map3t2,comments,laddername,draw,demo)
		values
		(
		".$xdb->qstr($_POST['winner']).",
		".$xdb->qstr($_POST['loser']).",
		".$xdb->qstr(X1_readtime()).",
		".$xdb->qstr($challenge['map1']).",
		".$xdb->qstr($challenge['map2']).",
		".$xdb->qstr($m1winnerarray).",
		".$xdb->qstr($m1loserarray).",
		".$xdb->qstr($m2winnerarray).",
		".$xdb->qstr($m2loserarray).",
		".$xdb->qstr($_POST['screen1']).",
		".$xdb->qstr($_POST['screen2']).",
		".$xdb->qstr($_POST['comments']).",
		".$xdb->qstr($_POST['ladder_id']).",
		".$xdb->qstr($_POST['draw']).",
		".$xdb->qstr($_POST['demo1'])."
		)");
	}
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
	$c  = x1_admin("matches");
	$c .= X1plugin_title(XL_amatches_added);
	return X1plugin_output($c);
}



function modifymatch() {
   global $xdb;
	$c  = x1_admin("matches");
	$c .= "<br />";
    $c .= X1plugin_title(XL_amatches_matchadmin);
    $row = $xdb->GetRow("select * from ".X1_prefix.X1_DB_teamhistory." where game_id=".$xdb->qstr($_POST['id']));
	$event = $xdb->GetRow("select * from ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr($row['laddername']));
    if(($row)&&($event)) {
	$draw = ($row['draw']) ? XL_yes : XL_no;
	$c .="
	    <form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
	    <table class='".X1plugin_admintable."' width='100%'>
	    <thead class='".X1plugin_tablehead."'>
            <tr>
                <td colspan='2'>".XL_amatches_modifymatch."</td>
            </tr>
			<tr>
				<td class='alt1'>".XL_amatches_gameid."</td>
				<td class='alt1'><input type='text' name='game_id' value='$row[game_id]'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_amatches_eventid."</td>
				<td class='alt2'>".SelectBox_ladders('ladder_id',$row['laddername'])."</td>
			</tr>
			<tr>
				<td class='alt2'>".XL_amatches_winner."</td>
				<td class='alt2'>".SelectBox_LadderTeamDrop('winner',$event['sid'], $row['winner'])." </td>
			</tr>
			<tr>
				<td class='alt1'>".XL_amatches_loser."</td>
				<td class='alt1'>".SelectBox_LadderTeamDrop('loser',$event['sid'], $row['loser'])."</td>
			</tr>
			<tr>
				<td class='alt2'>".XL_amatches_dateentry."</td>
				<td class='alt2'>".X1_edittime($row['date'])."</td>
			</tr>
			<tr>
				<td class='alt1'>".XL_amatches_maparray1."</td>
				<td class='alt1'>";
				$map1 = explode(",", $row['map1']);
				$ws = explode(",", $row['map1t1']);
				$ls = explode(",", $row['map1t2']);
				for($a=0; $a <$event['nummaps1']; $a++){
					$c .= SelectBox_Maplist('mapa[]', $event['sid'], $map1[$a]).
					XL_amatches_winner." <input type='text' name='map1t1[]' value='$ws[$a]' size='5'>
					".XL_amatches_loser." <input type='text' name='map1t2[]' value='$ls[$a]'  size='5'><br />";
				}
				$c .="
				</td>
			</tr>
			<tr>
				<td class='alt2'>".XL_amatches_maparray2."</td>
				<td class='alt2'>";
				$map2 = explode(",", $row['map2']);
				$ws = explode(",", $row['map2t1']);
				$ls = explode(",", $row['map2t2']);
				for($a=0; $a<$event['nummaps2']; $a++){
					$c .= SelectBox_Maplist('mapb[]', $event['sid'], $map2[$a]).
					XL_amatches_winner." <input type='text' name='map2t1[]' value='$ws[$a]'  size='5'>
					".XL_amatches_loser." <input type='text' name='map2t2[]' value='$ls[$a]' size='5'><br />";
				}
				$c .="</td>
			</tr>
				<td class='alt1'>".XL_amatches_screenshot1."</td>
				<td class='alt1'><input type='text' name='map3t1' value='$row[map3t1]'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_amatches_screenshot2."</td>
				<td class='alt2'><input type='text' name='map3t2' value='$row[map3t2]'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_amatches_comments."</td>
				<td class='alt1'><input type='text' name='comments' value='$row[comments]'></td>
			</tr>
			<tr>
				<td class='alt1'>".XL_amatches_demolink."</td>
				<td class='alt1'><input type='text' name='demo' value='$row[demo]'></td>
			</tr>
			<tr>
				<td class='alt2'>".XL_amatches_draw."</td>
				<td class='alt2'>
					<select name='draw'>
						<option value='$row[draw]'>$draw</option>
						<option value='0'>".XL_no."</option>
						<option value='1'>".XL_yes."</option>
					</select>
				</td>
			</tr>
	    </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='2'>
                <input type='submit' value='".XL_save."'>
                <input type='hidden' name='".X1_actionoperator."' value='updatematch'>
                </td>
            </tr>
        </tfoot>
        </table>
		</form>";
    } else {
		$c .= X1plugin_title(XL_amatches_nomatch);
    }
	return X1plugin_output($c);
}


function updatematch() {
	global $xdb;
	$_POST['map1'] = implode(',',$_POST['mapa']);
	$_POST['map2'] = implode(',',$_POST['mapb']);
	$_POST['map1t1'] = implode(',',$_POST['map1t1']);
	$_POST['map1t2'] = implode(',',$_POST['map1t2']);
	$_POST['map2t1'] = implode(',',$_POST['map2t1']);
	$_POST['map2t2'] = implode(',',$_POST['map2t2']);
	$_POST['date'] = X1_readtime();
	$winner = $xdb->GetRow("select name from ".X1_prefix.X1_DB_teams." WHERE team_id=".$xdb->qstr($_POST['winner']));
	$loser = $xdb->GetRow("select name from ".X1_prefix.X1_DB_teams." WHERE team_id=".$xdb->qstr($_POST['loser']));
	$xdb->Execute("update ".X1_prefix.X1_DB_teamhistory." set
		winner=".$xdb->qstr($winner['name']).",
		loser=".$xdb->qstr($loser['name']).",
		date=".$xdb->qstr($_POST['date']).",
		map1=".$xdb->qstr($_POST['map1']).",
		map2=".$xdb->qstr($_POST['map2']).",
		map1t1=".$xdb->qstr($_POST['map1t1']).",
		map1t2=".$xdb->qstr($_POST['map1t2']).",
		map2t1=".$xdb->qstr($_POST['map2t1']).",
		map2t2=".$xdb->qstr($_POST['map2t2']).",
		map3t1=".$xdb->qstr($_POST['map3t1']).",
		map3t2=".$xdb->qstr($_POST['map3t2']).",
		comments=".$xdb->qstr($_POST['comments']).",
		laddername=".$xdb->qstr($_POST['ladder_id']).",
		draw=".$xdb->qstr($_POST['draw']).",
		demo=".$xdb->qstr($_POST['demo'])." 
		where game_id=".$xdb->qstr($_POST['game_id']));
		$c  = x1_admin("matches");
		$c .= X1plugin_title(XL_amatches_updated);
	return X1plugin_output($c);
}

function X1_removematch(){
	global $xdb;
	$row = $xdb->GetRow("select * from ".X1_prefix.X1_DB_teamhistory." where game_id=".$xdb->qstr($_POST['id']));
    if($row){
		$xdb->Execute("DELETE FROM ".X1_prefix.X1_DB_teamhistory." WHERE game_id=".$xdb->qstr($_POST['id']));
		$c = x1_admin("matches");
		$c .= X1plugin_title("Match Removed");
	}else{
		$c = x1_admin("matches");
		$c .= X1plugin_title("Error::");
	}
	return X1plugin_output($c);
}
?>