<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.nukeladder.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################

function listchallenges(){
	global $xdb;
	$date = date("U");
    $c  = x1_admin("challenges");
	$c .= '<br />'.X1plugin_title(XL_achallenges_confirmed.$row['subject']);
	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr($_POST['ladder_id']));
	$c .= "
	<table class='".X1plugin_admintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th>".XL_achallenges_id."</th>
			<th>".XL_achallenges_challenger."</th>
			<th>".XL_achallenges_challenged."</th>
			<th>".XL_achallenges_date."</th>
			<th>".XL_achallenges_modify."</th>
			<th>".XL_achallenges_delete."</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>";
	$ln = $xdb->GetRow("select title from ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr($_POST['ladder_id']));
	$laddername = $ln['title'];
	$rows = $xdb->GetAll("select winner, loser, date, randid
    from ".X1_prefix.X1_DB_teamtempchallenges."
    where ladder_id=".$xdb->qstr($_POST['ladder_id']));
	if(!$rows){
        $c .="<tr>
			<td colspan='5'>".XL_achallenges_none."</td>
			</tr>";
     }else{
    	foreach($rows AS $row){
    		$c .= "
    		<tr>
    			<td class='alt1'>$row[randid]</td>
    			<td class='alt2'>$row[loser]</td>
    			<td class='alt1'>$row[winner]</td>
    			<td class='alt2'>".date(X1_dateformat.' H:i',$row['date'])."</td>
    			<td class='alt1'>
    				<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
    				<input name='randid' type='hidden' value='$row[randid]'>
    				<input name='ladder_id' type='hidden' value='$_POST[ladder_id]'>
    				<input name='".X1_actionoperator."' type='hidden' value='edittempchallenge'>
    				<input type='submit' value='".XL_edit."'>
    				</form>
    			</td>
    			<td>
    				<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
    				<input name='randid' type='hidden' value='$row[randid]'>
    				<input name='ladder_id' type='hidden' value='$_POST[ladder_id]'>
    				<input name='".X1_actionoperator."' type='hidden' value='deletetempchallenge'>
    				<input type='submit' value='".XL_delete."'>
    				</form>
    			</td>
    	</tr>";
        }
    }
   $c .= "</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='6'>&nbsp;</td>
        </tr>
    </tfoot>
    </table>
	<br />";
	$c .= X1plugin_title(XL_achallenges_unconfirmed.$row['subject']);
	$c .="
    <table class='".X1plugin_admintable."' width='100%'>
    <thead class='".X1plugin_tablehead."'>
		<tr>
			<th>".XL_achallenges_challenger."</th>
			<th>".XL_achallenges_challenged."</th>
			<th>".XL_achallenges_date."</th>
			<th>".XL_achallenges_matchdate."</th>
			<th>".XL_achallenges_modify."</th>
			<th>".XL_achallenges_delete."</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>";
	$ln = $xdb->GetRow("select title from ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr($_POST['ladder_id']));
	$laddername = $ln['title'];
	$rows = $xdb->GetAll("select winner, loser, date, matchdate, randid
    from ".X1_prefix.X1_DB_teamchallenges." where ladder_id=".$xdb->qstr($_POST['ladder_id']));
	if(!$rows){
        $c .="<tr>
			<td colspan='5'>".XL_achallenges_none."</td>
			</tr>";
     }else{
    	foreach($rows AS $row) {
    	$c .= "
    		<tr>
    			<td class='alt1'>$row[loser]</td>
    			<td class='alt2'>$row[winner]</td>
    			<td class='alt1'>".date(X1_dateformat,$row['date'])."</td>
    			<td class='alt2'>".date(X1_dateformat.' H:i',$row['matchdate'])."</td>
    			<td class='alt1'>
    				<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
    				<input name='randid' type='hidden' value='$row[randid]'>
    				<input name='ladder_id' type='hidden' value='$_POST[ladder_id]'>
    				<input name='".X1_actionoperator."' type='hidden' value='editchallenge'>
    				<input type='submit' value='".XL_edit."'>
    				</form>
    			</td>
    			<td class='alt2'>
    				<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
    				<input name='randid' type='hidden' value='$row[randid]'>
    				<input name='ladder_id' type='hidden' value='$_POST[ladder_id]'>
    				<input name='".X1_actionoperator."' type='hidden' value='deletechallenge'>
    				<input type='submit' value='".XL_delete."'>
    				</form>
    			</td>
    		</tr>";
    	}
    }
	$c .= "</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='6'>&nbsp;</td>
        </tr>
    </tfoot>
    </table>
	<br />";

    $c .= X1plugin_title(XL_achallenges_create." $_POST[subject]");
	$c .= "
		<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
		<table class='".X1plugin_admintable."' width='100%'>
    		<thead class='".X1plugin_tablehead."'>
        	    <tr>
        			<th colspan='2'>".XL_achallenges_create."</th>
        		</tr>
    		</thead>
            <tbody class='".X1plugin_tablebody."'>
                <tr>
                    <td class='alt2'>".XL_achallenges_challenger."</td>
                    <td class='alt2'>
                    <select name='challenger'>";
                	$toplist = $xdb->GetAll("select team_id, name
                    from ".X1_prefix.X1_DB_teamsevents." 
					WHERE ladder_id=".$xdb->qstr($_POST['ladder_id']));
                	$c .= "<option value=''>Select Challenger</option>\n";
                	foreach($toplist AS $row){
                		$c .= "<option value='$row[name]'>$row[name]</option>\n";
                	}
                	$c .= "</select>
                    </td>
		</tr>
	    <tr>
            <td class='alt1'>".XL_achallenges_challenged."</td>
            <td class='alt1'>
    			<select name='challenged'>";
            	$toplist = $xdb->GetAll("select team_id, name
                from ".X1_prefix.X1_DB_teamsevents."
				 WHERE ladder_id=".$xdb->qstr($_POST['ladder_id']));
            	$c .= "<option value=''>Select Challenged</option>\n";
            	foreach($toplist AS $row){
            		$c .= "<option value='$row[name]'>$row[name]</option>\n";
            	}
				$randid = X1plugin_randid();
            	$c .= "</select>
            </td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_achallenges_matchdate."</td>
			<td class='alt2'>".X1_edittime(time())."
		<input type='hidden' value='$randid' name='randid'>
		<input type='hidden' value='$_POST[ladder_id]' name='ladder_id'>
		</td>
	</tr>
	<tr>
		<th colspan='2' class='alt1'>".XL_achallenges_maps1."</th>
	</tr>
	    <tr>";
	for($a=1; $a <$event['nummaps1']; $a++){
		$c .= "
		<tr>
		<td class='alt2'>Map $a</td>
		<td class='alt2'>".SelectBox_Maplist('mapa[]', $event['sid'])."</td>
		</tr>";
	}
	$c .= "
	<tr>
	<th colspan='2' class='alt1'>".XL_achallenges_maps2."</th>
	</tr>";
	for($a=1; $a <$event['nummaps1']; $a++){
		$c .= "
		<tr>
		<td class='alt1'>Map $a</td>
		<td class='alt1'>".SelectBox_Maplist('mapb[]', $event['sid'])."</td>
		</tr>";
	}
	$c .= "
		<tr>
			<th colspan='2' class='alt1'>".XL_achallenges_extended."</th>
		</tr>
	    <tr>
			<td class='alt2'>".XL_achallenges_extra1."</td>
			<td class='alt2'><input type='textfield' value='' name='extra1'></td>
		</tr>
	    <tr>
			<td class='alt1'>".XL_achallenges_extra2."</td>
			<td class='alt1'><input type='textfield' value='' name='extra2'></td>
		</tr>
	    <tr>
			<td class='alt2'>".XL_achallenges_comments."</td>
			<td class='alt2'><input type='textfield' value='' name='extra3'></td>
		</tr>
	</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='2'>
            <input type='hidden' value='insertchallenge' name='".X1_actionoperator."'>
            <input type='hidden' value='$date' name='date'>
            <input type='submit' value='".XL_achallenges_add."'></td>
            </form>
        </tr>
    </tfoot>
    </table>";
	return X1plugin_output($c);
}

function insertchallenge() {
	global $xdb;
	if ( (empty($_POST['challenger'])) || (empty($_POST['challenged']) )){
		$c .= XL_achallenges_errblankteam1;
		return X1plugin_output($c);
	}
	if ($_POST['challenger']==$_POST['challenged']){
		$c .= XL_achallenges_errsameteams;
		return X1plugin_output($c);
	}
	
	$maparray1= implode(',',$_POST['mapa']);
	$maparray2 = implode(',',$_POST['mapb']);
	
    $m = date('n', $_POST['date2']);
    $d = date('j', $_POST['date2']);
    $y = date('y', $_POST['date2']);

	$finalmatchdate = X1_readtime();
	
	$result = $xdb->Execute("insert into ".X1_prefix.X1_DB_teamchallenges."
	(winner, loser, date, randid, ladder_id, map1, map2, matchdate, extra1, extra2, extra3)
	values (
    ".$xdb->qstr($_POST['challenged']).",
    ".$xdb->qstr($_POST['challenger']).",
    ".$xdb->qstr(time()).",
    ".$xdb->qstr($_POST['randid']).",
    ".$xdb->qstr($_POST['ladder_id']).",
    ".$xdb->qstr($maparray1).",
    ".$xdb->qstr($maparray2).",
    ".$xdb->qstr($finalmatchdate).",
    ".$xdb->qstr($_POST['extra1']).",
    ".$xdb->qstr($_POST['extra2']).",
    ".$xdb->qstr("Admin Created Challenge<br>$_POST[extra3]").")");
	$c  = x1_admin("challenges");
	if($result){
        $c .= X1plugin_title(XL_achallenges_added);
    }else{
        $c .= $xdb->ErrorMsg();
    }
	return X1plugin_output($c);
}


function editchallenge() {
	global $xdb;
	$c  = x1_admin("challenges");
	
	$match = $xdb->GetRow("
    select * from ".X1_prefix.X1_DB_teamchallenges."
    where ladder_id=".$xdb->qstr($_POST['ladder_id'])." 
	and randid=".$xdb->qstr($_POST['randid']));
	
    if(!$match) {
        $c .= $xdb->ErrorMsg();
        return X1plugin_output($c);
    }
	
	$event = $xdb->GetRow("
    SELECT * FROM ".X1_prefix.X1_DB_events."
    where sid=".$xdb->qstr($_POST['ladder_id']));
	
	$mapa=explode(",",$match['map1']);
	$mapb=explode(",",$match['map2']);

	$c .= "<br />";
    $c .= X1plugin_title("Challenge Admin");
    $c .="
	<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
	<table class='".X1plugin_admintable."' width='100%'>
    <thead class='".X1plugin_tablehead."'>
	    <tr>
			<th colspan='2'>".XL_achallenges_editchallenge."</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>
		<tr>
            <td class='alt2'>".XL_achallenges_challenger."</td>
            <td class='alt2'>".SelectBox_LadderTeamDrop('challenger',$event['sid'], $match[loser])."</td>
		</tr>
	    <tr>
            <td class='alt1'>".XL_achallenges_challenged."</td>
            <td class='alt1'>".SelectBox_LadderTeamDrop('challenged',$event['sid'], $match[winner])."</td>
		</tr>
		<tr>
		  <th colspan='2' class='alt1'>".XL_achallenges_maps1."</th>
    	</tr>
	    <tr>";
		 
    	for($a=1; $event['nummaps1'] >=$a; $a++){
			$b=$a-1;
    		$c .= "
			<tr>
            <td class='alt2'>Map $a</td>
            <td class='alt2'>".SelectBox_Maplist('mapa[]', $event['sid'], $mapa[$b])."$mapa[$b]</td>
			</tr>";
    	}
    	$c .= "
    	<tr>
    	<th colspan='2' class='alt1'>".XL_achallenges_maps2."</th>
    	</tr>";
		for($a=1; $event['nummaps2']>= $a; $a++){
			$b=$a-1;
    		$c .= "
			<tr>
            <td class='alt1'>Map $a</td>
            <td class='alt1'>".SelectBox_Maplist('mapb[]', $event['sid'], $mapb[$b])."$mapa[$b]</td>
			</tr>";
    	}
		
    	$c .= "
			<tr>
				<th colspan='2' class='alt1'>".XL_achallenges_misc."</th>
			</tr>
    		<tr>
				<td class='alt1'>".XL_achallenges_eventid."</td>
				<td class='alt1'><input type='textfield' value='$event[sid]' name='ladder_id' size='50'> </td>
			</tr>
			<tr>
				<td class='alt2'>".XL_achallenges_matchdate."</td>
				<td class='alt2'>".X1_edittime($match['matchdate'])."</td>
			</tr>
			<tr>
				<td class='alt1'>".XL_achallenges_randid."</td>
				<td class='alt1'><input type='textfield' value='$match[randid]' name='randid' size='50'> </td>
			</tr>
			<tr>
				<td class='alt2'>".XL_achallenges_extra1."</td>
				<td class='alt2'><input type='textfield' value='$match[extra1]' name='extra1' size='50'> </td>
			</tr>
			<tr>
				<td class='alt1'>".XL_achallenges_extra2."</td>
				<td class='alt1'><input type='textfield' value='$match[extra2]' name='extra2' size='50'> </td>
			</tr>
			<tr>
				<td class='alt2'>".XL_achallenges_comments."</td>
				<td class='alt2'><input type='textfield' value='$match[extra3]' name='extra3' size='50'> </td>
			</tr>
			</tbody>
            <tfoot class='".X1plugin_tablefoot."'>
                <tr>
                    <td colspan='2'>
                        <input type='hidden' value='updatechallenge' name='".X1_actionoperator."'>
				        <input type='hidden' value='$match[randid]' name='oldrandid'>
				        <input type='hidden' value='$event[sid]' name='oldladder_id'>
				        <input type='submit' value='".XL_achallenges_updated."'>
                    </td>
                </tr>
            </tfoot>
            </table>
			</form>";
	return X1plugin_output($c);
}

function updatechallenge() {
	global $xdb;
	$c  = x1_admin("challenges");
	if ((empty($_POST['challenger']))||(empty($_POST['challenged']))){
      $c .= X1plugin_title(XL_achallenges_errblankteam1);
		return X1plugin_output($c);
	}
    if ($_POST['challenger']==$_POST['challenged']){
		$c .= XL_achallenges_errsameteams;
		return X1plugin_output($c);
	}
	
	$challenged = $xdb->GetRow("
    SELECT name FROM ".X1_prefix.X1_DB_teams."
    where team_id=".$xdb->qstr($_POST['challenged']));
	
	$challenger = $xdb->GetRow("
    SELECT name FROM ".X1_prefix.X1_DB_teams."
    where team_id=".$xdb->qstr($_POST['challenger']));
	
	$maparray1= implode(',',$_POST['mapa']);
	$maparray2 = implode(',',$_POST['mapb']);
	$finalmatchdate = X1_readtime();
	
	$result = $xdb->Execute("update ".X1_prefix.X1_DB_teamchallenges." SET
	winner=".$xdb->qstr($challenged[0]).",
	loser=".$xdb->qstr($challenger[0]).",
	date=".$xdb->qstr(time()).",
	randid=".$xdb->qstr($_POST['randid']).",
	ladder_id=".$xdb->qstr($_POST['ladder_id']).",
	map1=".$xdb->qstr($maparray1).",
	map2=".$xdb->qstr($maparray2).",
	matchdate=".$xdb->qstr($finalmatchdate).",
	extra1=".$xdb->qstr($_POST['extra1']).",
	extra2=".$xdb->qstr($_POST['extra2']).",
	extra3=".$xdb->qstr($_POST['extra3'])."
	where randid=".$xdb->qstr($_POST['oldrandid'])."
	and ladder_id=".$xdb->qstr($_POST['oldladder_id']));

    if($result){
        $c .= X1plugin_title(XL_achallenges_updated);
    }else{
        $c .= X1plugin_title('Error:'.$xdb->ErrorMsg());
    }
	return X1plugin_output($c);
}

function edittempchallenge() {
	global $xdb;
	$c = x1_admin("challenges");
	$challenge = $xdb->GetRow("select * FROM ".X1_prefix.X1_DB_teamtempchallenges." where randid=".$xdb->qstr($_POST['randid']));
	$event = $xdb->GetRow("select * FROM ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr($challenge['ladder_id']));
	$mapa=explode(",",$challenge['map1']);
	$mapb=explode(",",$challenge['map2']);
	$mdates=explode(",",$challenge['date1']);
	$c .= X1plugin_title("Edit Pending Challenge");
	$c .= "
	<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
	<table class='".X1plugin_admintable."' width='100%'>
    <thead class='".X1plugin_tablehead."'>
	    <tr>
			<th colspan='2'>".XL_achallenges_editunconfirmed."</th>
		</tr>
	</thead>
    <tbody class='".X1plugin_tablebody."'>
	    <tr>
			<td class='alt1'>".XL_achallenges_challenger."</td>
			<td class='alt1'>".SelectBox_LadderTeamDrop('challenger', $event['sid'], $challenge['loser'])."</td>
		</tr>
		<tr>
			<td class='alt2'>".XL_achallenges_challenged."</td>
			<td class='alt2'>".SelectBox_LadderTeamDrop('challenged', $event['sid'], $challenge['winner'])."</td>
		</tr>
		<tr>
			<td class='alt1'>".XL_achallenges_maps1."</td>
			<td class='alt1'>";
			for($cm = 1; $event['nummaps1'] >= $cm; $cm++){
				$b = $cm-1;
				$c .= SelectBox_Maplist("mapa[]", $event['sid'], $mapa[$b])."<br/>";
			}
			$c .= "
		   </td>
		   </tr>
			<tr>
				<td class='alt2'>".XL_achallenges_eventid."</td>
				<td class='alt2'>".SelectBox_ladders("ladder_id", $event['sid'])."</td>
			</tr>
			<tr>
				<td class='alt1'>".XL_achallenges_dt1."</td>
				<td class='alt1'>";
				for($cm = 0; count($mdates) > $cm; $cm++){
					$c .= X1_edittime($mdates[$cm], $cm)."<br/>";
				}
				$c .="</td>
			</tr>
			<tr>
				<th colspan='2' class='alt1'>".XL_achallenges_misc."</th>
			</tr>
			<tr>
				<td class='alt2'>".XL_achallenges_randid."</td>
				<td class='alt2'><input type='textfield' value='$challenge[randid]' name='randid' size='50'> </td>
			</tr>
			<tr>
				<td class='alt1'>".XL_achallenges_setdate."</td>
				<td class='alt1'>".X1_edittime($challenge['date'])."</td>
			</tr>
			<tr>
				<td class='alt2'>".XL_achallenges_extra1."</td>
				<td class='alt2'><input type='textfield' value='$challenge[extra1]' name='extra1' size='50'> </td>
			</tr>
			<tr>
				<td class='alt1'>".XL_achallenges_extra2."</td>
				<td class='alt1'><input type='textfield' value='$challenge[extra2]' name='extra2' size='50'> </td>
			</tr>
			<tr>
				<td class='alt2'>".XL_achallenges_comments."</td>
				<td class='alt2'><input type='textfield' value='$challenge[extra3]' name='extra3' size='50'> </td>
			</tr>
			</tbody>
            <tfoot class='".X1plugin_tablefoot."'>
                <tr>
                    <td colspan='2'>
					<input type='hidden' value='datecount' name='".count($dates)."'>
                    <input type='hidden' value='updatetempchallenge' name='".X1_actionoperator."'>
    				<input type='submit' value='".XL_achallenges_updated."'>
                    </td>
                </tr>
            </tfoot>
            </table>
			</form>";
	return X1plugin_output($c);
}

function updatetempchallenge() {
	global $xdb;
	$c  = x1_admin("challenges");
	
	if ($challenger==="")return X1plugin_title(XL_achallenges_errblankteam1);
	if ($challenged==="")return X1plugin_title(XL_achallenges_errblankteam2);
	
	$maparray1= implode(',',$_POST['mapa']);
	
	$date = X1_readtime();
	
	for($cm=0; count($_POST['countdates']) > $cm; $cm++){
		$dates[] = X1_readtime($cm);
	}
	
	$result = $xdb->Execute("update ".X1_prefix.X1_DB_challengeteam." SET
			winner=".$xdb->qstr($_POST['challenged']).",
			loser=".$xdb->qstr($_POST['challenger']).",
			date=".$xdb->qstr($date).",
			randid=".$xdb->qstr($_POST['randid']).",
			ladder_id=".$xdb->qstr($_POST['ladder_id']).",
			map1=".$xdb->qstr($maparray1).",
			map2=".$xdb->qstr($maparray2).",
			extra1=".$xdb->qstr($_POST['extra1']).",
			extra2=".$xdb->qstr($_POST['extra2']).",
			extra3=".$xdb->qstr($_POST['extra3']).",
			date1=".$xdb->qstr(implode(',', $dates))."
			where randid=".$xdb->qstr($_POST['randid'])." 
			and ladder_id=".$xdb->qstr($_POST['ladder_id']));
	$c .= X1plugin_title(XL_achallenges_updated);
	
	return X1plugin_output($c);
}

function deletechallenge() {
	global $xdb;
	$del =  $xdb->Execute("
    delete from ".X1_prefix.X1_DB_teamchallenges."
    where randid=".$xdb->qstr($_POST['randid'])."  
	and ladder_id=".$xdb->qstr($_POST['ladder_id']));
   	$c  = x1_admin("challenges");
    if($del){
        $c .= X1plugin_title(XL_achallenges_deleted);
    }else{
        $c .= X1plugin_title('oops:'.$xdb->ErrorMsg());
    }
	return X1plugin_output($c);
}


function deletetempchallenge() {
	global $xdb;
	$xdb->Execute("
    delete from ".X1_prefix.X1_DB_teamtempchallenges."
    where randid=".$xdb->qstr($_POST['randid'])."  
	and ladder_id=".$xdb->qstr($_POST['ladder_id'])
	);
	$c  = x1_admin("challenges");
	$c .= X1plugin_title(XL_achallenges_deleted);
	return X1plugin_output($c);
}

?>