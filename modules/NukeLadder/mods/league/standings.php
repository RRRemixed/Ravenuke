<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
//$c .= "<center><img src='".X1_imgpath."/games/$game[gameimage]' border='0'></center>";
$c .= X1plugin_title(leaguemod_leaderboard.$event['title']);
$c .= "
<table class='".X1plugin_standingstable."' width='100%'>
    <thead class='".X1plugin_tablehead."'>
    	<tr>
    		<th>".leaguemod_rank."</th>
    		<th>".leaguemod_tags." </th>
    		<th>".leaguemod_team."</th>
    		<th>".leaguemod_status."</th>
    		<th>".leaguemod_wins."</th>
    		<th>".leaguemod_losses."</th>
    		<th>".leaguemod_draws."</th>
    		<th>".leaguemod_points."</th>
    		<th>".leaguemod_percentage."</th>
    		<th>".leaguemod_rating."</th>
    		<th>".leaguemod_country."</th>
    	</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>";
	
if($limit!=""){
	$limit="LIMIT $limit";
}

if (empty($event['standingstype'])){
	$sortby = 'games/2 + wins - losses + draws/2 + streakwins/2 - streaklosses/2 - 4 * penalties + 100 DESC ';
}else{
	$sortby = $event['standingstype'];
}

$rows = $xdb->GetAll("SELECT * 
FROM ".X1_prefix.X1_DB_teamsevents." 
WHERE ladder_id=".$xdb->qstr($_REQUEST['sid'])." 
ORDER BY ".$sortby." ".$limit);

$rank = 1;
if($rows){
	foreach($rows AS $row){
		$rating = $row['games']/2 + $row["wins"] - $row["losses"] + $row["draws"]/2 + $row["streakwins"]/2 - $row["streaklosses"]/2 - 4 * $row["penalties"]  + 100;
		$rating=sprintf("%.0f", $rating); 
		$played = $row["wins"]+$row["losses"]+$row['draws'];
		if ($played <= 0) {
			$percentage = 0.00;
		}else {
			$percentage = round($row["wins"]/$played, 2)*100;
		}
		if ($row["streakwins"] >= 5) {
			$streak = "<img src='".X1_imgpath."/articles/stars-5.gif' title='$row[streakwins] ".leaguemod_winsinarow."'>";
		}else if ($row["streakwins"] >= 4) {
			$streak = "<img src='".X1_imgpath."/articles/stars-4.gif' title='$row[streakwins] ".leaguemod_winsinarow."'>";
		}else if ($row["streakwins"] >= 3) {
			$streak = "<img src='".X1_imgpath."/articles/stars-3.gif' title='$row[streakwins] ".leaguemod_winsinarow."'>";
		}else if ($row["streakwins"] >= 2) {
			$streak = "<img src='".X1_imgpath."/articles/stars-2.gif' title='$row[streakwins] ".leaguemod_winsinarow."'>";
		}else if ($row["streakwins"] >= 1) {
			$streak = "<img src='".X1_imgpath."/articles/stars-1.gif' title='$row[streakwins] ".leaguemod_winsinarow."'>";
		}else {
			$streak = "<img src='".X1_imgpath."/articles/stars-0.gif' title='$row[streakwins] ".leaguemod_winsinarow."'>";
		}
		$name2 = str_replace(' ', "+", $row["name"]);
		$c .=  "
		<tr>
			<td class='alt1'>$rank</td>
			<td class='alt2'>$row[clantags]</td>
			<td class='alt1'>
			<a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=$name2'>$row[name]</a></td>
			<td class='alt2'>$row[challenged]</td>
			<td class='alt1'>$row[wins]</td>
			<td class='alt2'>$row[losses]</td>
			<td class='alt1'>$row[draws]</td>
			<td class='alt2'>$row[points]</td>
			<td class='alt1'>$percentage%</td>
			<td class='alt2'>$rating</td>
			<td class='alt1'><img src='".X1_imgpath."/flags/$row[country].bmp' align='absmiddle'></td>
		</tr>";
		$rank++;
	}
}else{
	$c .="<tr>
				<td colspan='11'>".leagueoutmod_noteams."</td>
			</tr>";
}
$c .=  "
    </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='11'>&nbsp;</td>
            </tr>
        </tfoot>
    </table>
	<br />";
?>