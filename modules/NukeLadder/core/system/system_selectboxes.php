<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
function SelectBox_LadderDrop($type="ladder", $cur="", $start=XL_select_event, $startval="") {
	global $xdb;
    $rows = $xdb->GetAll("select sid, title from ".X1_prefix.X1_DB_events." order by title");
	if($rows){
		$c  = "<select name='$type' id='$type'>";
		if($cur=="")$c .= "<option value='$startval'>$start</option>";
		foreach($rows As $row) {
			if ($row['sid']==$cur) {
				$sel = "selected ";
			}else{
				$sel = "";
			}
			$c .= "<option $sel value='$row[sid]' align='left'>$row[title]</option>";
			unset($sel);
		}
		$c .= "</select>";
	}else{
		$c .= "";
	}
	return $c;
}


function SelectBox_TeamDrop($type, $cur="", $start=XL_select_team, $startval="") {
	global $xdb;
    $rows = $xdb->GetAll("select team_id, name from ".X1_prefix.X1_DB_teams." order by name");
    $c  = "<select name='$type' id='$type'>" ;
    if($cur=="")$c .= "<option value='$startval'>$start</option>";
	if($rows){
		foreach($rows As $row) {
			if ($row['team_id']==$cur) {
				$sel = "selected ";
			}else{
				$sel = "";
			}
			$c .= "<option $sel value='$row[team_id]' align='left'>$row[name]</option>";
			unset($sel);
		}
    }
	$c .= "</select>";
	return $c;
}

function SelectBox_ladders($type, $cur="") {
	global $xdb;
    $rows = $xdb->GetAll("select sid, title from ".X1_prefix.X1_DB_events." order by sid");
    $c = "<select name='$type'>";
	foreach($rows As $row){
		if (($row[0]==$cur)||($row[1]== $cur)){
			$sel = "selected ";
		}
		$c .= "<option $sel value='$row[0]' align='left'>$row[1]</option>";
		$sel = "";
	}
	$c .= "</select>";
	return $c;
}

function SelectBox_games($type='game', $cur='',  $start="", $startval="") {
	global $xdb;
	$rows = $xdb->GetAll("select gameid, gametext from ".X1_prefix.X1_DB_games." order by gametext");
	$c  = "<select name='$type'>";
	if(!empty($start)){
    	$c .= "<option value='$startval'>$start</option>";
	}
	foreach($rows As $row){
		if ($row['gameid']==$cur) {
			$sel = "selected ";
		}else{
			$sel = "";
		}
		$c .= "<option $sel value='$row[gameid]'>$row[gametext]</option>\n";
		$sel = "";
	}
	$c .= "</select>";
	return $c;
}
function SelectBox_mods($type, $cur){
	$c = "<select name='$type'>";
 	if ($dir = @opendir(X1_modpath)) {
		while (($file = readdir($dir)) !== false) {
			$sel="";
			if($file == $cur) {
				$sel="selected";
			}
			if($file != ".." && $file != "." && $file != "index.htm") {
				$c .= "<option value='$file' $sel>$file</option>";
			}
		}
		closedir($dir);
	}
	$c .= "</select>";
	return $c;
}
function SelectBox_JoinedLadderDrop($team) {
	global $xdb;
    $toplist = $xdb->GetAll("select ladder_id from ".X1_prefix.X1_DB_teamsevents." 
	where team_id=".$xdb->qstr($team)." order by ladder_name");
    $c = "<SELECT NAME='ladder_id'>" ;
    foreach($toplist AS $row){
		$event =  $xdb->GetRow("select sid,title from ".X1_prefix.X1_DB_events." 
		where sid=".$xdb->qstr($row['ladder_id']));
		$c .=  "<option value='$event[sid]' align='left'>$event[title]</option>";
    }
	$c .= "</select>";
	return $c;
}
function SelectBox_JoinedTeamDrop($type, $uid) {
	global $xdb;
    $list = $xdb->GetAll("select team_id, name from ".X1_prefix.X1_DB_teamroster." 
	WHERE uid = ".$xdb->qstr($uid)." order by name");
    $c = "<SELECT NAME='$type'>" ;
	if($list){
		foreach($list As $item){
			$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
			WHERE team_id = ".$xdb->qstr($item['team_id']));
			if(!empty($row["name"])){
				$c .= "<option value='$item[team_id]' align='left'>$row[name]</option>";
			}
		}
	}
	$c .= "</select>";
	return $c;
}


function SelectBox_Maplist($type, $ladder_id, $selected=0) {
	global $xdb;
	$groups = $xdb->GetRow("SELECT mapgroups 
		FROM ".X1_prefix.X1_DB_events." 
		WHERE sid=".$xdb->qstr($ladder_id));
	$groups = explode(",",$groups[0]);
	if(is_array($groups)){
		$final = array();
		foreach($groups AS $group){
			$maps = $xdb->GetRow("SELECT maps 
				FROM ".X1_prefix.X1_DB_mapgroups." 
				WHERE id=".$xdb->qstr($group));
			$final = array_merge($final, explode(",",$maps[0]));
		}
		$maps = array_unique($final);
		$c = "<SELECT NAME=".$type."'>" ;
		foreach($maps AS $map){
			if ($selected==$map){
				$sel = "selected ";
			}
			$info = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_maps." WHERE mapid=".$xdb->qstr($map));
			if($info)$c .=  "<option $sel value='$info[mapid]' align='left'>$info[mapname]</option>";
			$sel = "";
		}
		$c .=  "</select>";
		return $c;
	}else{
		return "No Map Groups Yet";
	}
}

function SelectBox_LadderTeamDrop($type, $ladder_id, $cur='') {
	global $xdb;
    $toplist = $xdb->GetAll("select team_id, name from ".X1_prefix.X1_DB_teamsevents." 
	WHERE ladder_id = ".$xdb->qstr($ladder_id)." order by name");
    $c = "<SELECT NAME='$type'>" ;
	foreach($toplist AS $row){
		if (($row[0]==$cur)||($row[1]==$cur)) {
			$sel = "selected ";
		}
		$c .= "<option $sel value='$row[0]'>$row[1]</option>";
		$sel = "";
    }
	$c .= "</select>";
	return $c;
}

function SelectBox_ChallLadderTeamDrop($type, $ladder_id, $cur='') {
	global $xdb;
	$toplist = $xdb->GetAll("select team_id, name from ".X1_prefix.X1_DB_teamsevents." 
	WHERE ladder_id=".$xdb->qstr($ladder_id)." order by name");
	$c = "<SELECT NAME='$type'>" ;
	foreach($toplist As $row){
		if ($row['team_id']==$cur) {
			$sel = "selected ";
		}
		$c .= "<option $sel value='$row[team_id]' align='left'>$row[name]</option>";
		$sel = "";
	}
	$c .= "</select>";
	return $c;
}

function SelectBox_Country($type, $valone) {
	$c = "
	<select size='1' name='$type'>";
	if ($valone===''){
	
	}else {
		$c .= "<option>$valone</option>";
	}
	$c .= "
	<option>Argentina</option>
	<option>Australia</option>
	<option>Austria</option>
	<option>Belgium</option>
	<option>Bosnia</option>
	<option>Brazil</option>
	<option>Bulgaria</option>
	<option>Canada</option>
	<option>Chile</option>
	<option>Croatia</option>
	<option>Cyprus</option>
	<option>Czechoslavakia</option>
	<option>Denmark</option>
	<option>England</option>
	<option>Finland</option>
	<option>France</option>
	<option>Georgia</option>
	<option>Germany</option>
	<option>Greece</option>
	<option>Holland</option>
	<option>Hong Kong</option>
	<option>Hungary</option>
	<option>Iceland</option>
	<option>India</option>
	<option>Indonesia</option>
	<option>Iran</option>
	<option>Iraq</option>
	<option>Ireland</option>
	<option>Israel</option>
	<option>Italy</option>
	<option>Japan</option>
	<option>Leichenstein</option>
	<option>Luxembourg</option>
	<option>Malaysia</option>
	<option>Malta</option>
	<option>Mexico</option>
	<option>Morocco</option>
	<option>New Zealand</option>
	<option>North Vietnam</option>
	<option>Norway</option>
	<option>Poland</option>
	<option>Portugal</option>
	<option>Puerto Rico</option>
	<option>Qatar</option>
	<option>Rumania</option>
	<option>Russia</option>
	<option>Scotland</option>
	<option>Singapore</option>
	<option>South Africa</option>
	<option>Spain</option>
	<option>Sweden</option>
	<option>Switzerland</option>
	<option>Turkey</option>
	<option>United Kingdom</option>
	<option>United States</option>
	<option>Pirates</option>
	</select>";
	return $c;
}




function SelectBox_MapGroups($options_selected=array(), $size=4) {
	global $xdb;
	$ids = array();
	$groups = $xdb->GetAll("SELECT id, name FROM ".X1_prefix.X1_DB_mapgroups." ORDER BY name;");
	foreach ($groups AS $group) {
		$ids[] = $group[0]; 
		$names[$group[0]] = $group[1];
	}
	$difference = array_diff($ids, $options_selected);
	$c = "
	<table border='0'>
		  <tr>
			<td>
				<select size='$size' id='availablemapgroups' name='available_mapgroups' >";
				foreach($difference AS $id){
					$c .="<option value='$id'>$names[$id]</option>";
				}
	$c .='		</select> 
			</td>
			<td valign="top">
				<a href="javascript:" onclick="addAttribute();return false;">></a> 
				<br>
				<a href="javascript:" onclick="delAttribute();return false;"><</a> 
			</td>
			<td>';
	$c .="		<select name='selectedmapgroups[]' id='selectedmapgroups[]' size='$size' multiple>";
				foreach($options_selected AS $id){
					$c .="<option value='$id'>$names[$id]</option>";
				}
	$c .="		</select>
			</td>
		  </tr>
		</table>
		<script type='text/javascript'>createListObjects('availablemapgroups','selectedmapgroups[]');</script>";
	return $c;
}
function SelectBox_MyTeams() {

}
?>