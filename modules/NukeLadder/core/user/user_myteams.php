<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
#My Teams
function X1_myteams(){
	global $xdb;
	$c    = X1plugin_style();
	$user = X1_userdetails();
	$cook = cookieread();
	$c .= X1plugin_title(XL_myteams_title);
	$c .=  "<table class='".X1_teamlistclass."' width='100%'>
            <thead class='".X1plugin_tablehead."'>
    			<tr>
    				<th>".XL_myteams_loc."</th>
    				<th>".XL_myteams_team."</th>
    				<th>".XL_myteams_captain."</th>
					<th>".XL_myteams_members."</th>
					<th>".XL_myteams_events."</th>
					<th>".XL_myteams_recruiting."</th>
					<th>".XL_myteams_active."</th>
				</tr>
            </thead>
			<tbody class='".X1plugin_tablebody."'>";
	if(!empty($user[1])){
		$teams = $xdb->GetAll("SELECT * 
		FROM ".X1_prefix.X1_DB_teams." 
		WHERE playerone=".$xdb->qstr($user[1]));
		$teamx[] = array();
		$i=0;
		foreach($teams AS $row){
			$active = ($cook[0] == $row['team_id']) ? "<img src='".X1_imgpath.X1_editimage."'/>" :"";
			$tm = $xdb->Execute("SELECT count(*) 
			FROM ".X1_prefix.X1_DB_teamroster." 
			WHERE team_id=".X1_clean($row['team_id']));
			$totalmembers = $tm->fields[0];
			$te = $xdb->Execute("SELECT count(*) 
			FROM ".X1_prefix.X1_DB_teamsevents." 
			WHERE team_id=".X1_clean($row['team_id']));
			$totalevents = $te->fields[0];
			$rout = ($row['recruiting']) ? XL_yes:XL_no;
			$c .=  "<tr>
                    <td class='alt1'><img src='".X1_imgpath."/flags/".X1_clean($row['country']).".bmp' align='absmiddle'></td>
                    <td class='alt2'><a href=".X1_publicgetfile."?".X1_linkactionoperator."=activate_team&t=".$row['team_id'].">".X1_clean($row['name'])."</a></td>
					<td class='alt1'>".X1_clean($row['playerone'])."</td>
                    <td class='alt2'>".X1_clean($totalmembers)."</td>
                    <td class='alt1'>".X1_clean($totalevents)."</td>
					<td class='alt1'>".X1_clean($rout)."</td>
					<td class='alt2'>$active</td>
					</tr>";
			$teamx[] = $team['team_id'];
			$i++;
		}
		
		$rows = $xdb->GetAll("
		SELECT * FROM ".X1_prefix.X1_DB_teamroster." 
		WHERE uid =".$xdb->qstr($user[0])." 
		AND cocaptain=1 
		AND playerone !=".$xdb->qstr($user[1]));
		
		if($rows){
			foreach($rows AS $row2){
				if(!in_array($row2['team_id'], $teamx)){
					$row = $xdb->GetRow("SELECT *
					FROM ".X1_prefix.X1_DB_teams." 
					WHERE team_id=".$xdb->qstr($row2['team_id']));
					$active = ($cook[0] == $row['team_id']) ? "<img src='".X1_imgpath.X1_editimage."'/>" :"";
					$tm = $xdb->Execute("SELECT count(*) 
					FROM ".X1_prefix.X1_DB_teamroster." 
					WHERE team_id=".X1_clean($row['team_id']));
					$totalmembers = $tm->fields[0];
					$te = $xdb->Execute("SELECT count(*) 
					FROM ".X1_prefix.X1_DB_teamsevents." 
					WHERE team_id=".X1_clean($row['team_id']));
					$totalevents = $te->fields[0];
					$rout = ($row['recruiting']) ? XL_yes:XL_no;
					$c .=  "<tr>
							<td class='alt1'><img src='".X1_imgpath."/flags/".X1_clean($row['country']).".bmp' align='absmiddle'></td>
							<td class='alt2'><a href=".X1_publicgetfile."?".X1_linkactionoperator."=activate_team&t=".$row['team_id'].">".X1_clean($row['name'])."</a></td>
							<td class='alt1'>".X1_clean($row['playerone'])."</td>
							<td class='alt2'>".X1_clean($totalmembers)."</td>
							<td class='alt1'>".X1_clean($totalevents)."</td>
							<td class='alt2'>".X1_clean($rout)."</td>
							<td class='alt1'>$active</td>
							</tr>";
					$teamx[] = $team['team_id'];
					$i++;
				}
			}
		}
		if($i==0)$c .="<tr><td colspan='7' align='center'><a href='".X1_publicgetfile."?".X1_linkactionoperator."=createteam'>".XL_myteams_noteams."</a></td></tr>\n";
	}else{
		$c .="<tr><td colspan='7' align='center'>".XL_myteams_notloggedin."</td></tr>\n";
	}
	#Table Footer
	$c .=  "</tbody>
	<tfoot class='".X1plugin_tablefoot."'>
		<tr>
			<th colspan='7' align='center'>&nbsp;</th>
		</tr>
	</tfoot>
	</table>";
	return X1plugin_output($c);
}
?>