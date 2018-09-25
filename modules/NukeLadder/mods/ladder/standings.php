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
$c .= X1plugin_title(laddermod_leaderboard.$event['title']);
$c .= "
<table class='".X1plugin_standingstable."' width='100%'>
    <thead class='".X1plugin_tablehead."'>
    	<tr>
    		<th>".laddermod_rank."</th>
    		<th>".laddermod_tags." </th>
    		<th>".laddermod_team."</th>
    		<th>".laddermod_status."</th>
    		<th>".laddermod_wins."</th>
    		<th>".laddermod_losses."</th>
    		<th>".laddermod_draws."</th>
    		<th>".laddermod_points."</th>
    		<th>".laddermod_percentage."</th>
    		<th>".laddermod_country."</th>
    	</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>";
if($limit!=""){
	$limit="LIMIT $limit";
}
$rows = $xdb->GetAll("SELECT * 
FROM ".X1_prefix.X1_DB_teamsevents." 
WHERE ladder_id=".$xdb->qstr($_REQUEST['sid'])." 
ORDER BY rung asc ".$limit);
if($rows){
	$rank = 1;
	foreach($rows AS $row){
		$rating=sprintf("%.0f", $rating); 
		$played = $row["wins"]+$row["losses"]+$row['draws'];
		if ($played <= 0) {
			$percentage = 0.00;
		}else {
			$percentage = round($row["wins"]/$played, 2)*100;
		}
		if ($row["streakwins"] >= 5) {
			$streak = "<img src='".X1_imgpath."/articles/stars-5.gif' title='$row[streakwins] ".laddermod_winsinarow."'>";
		}else if ($row["streakwins"] >= 4) {
			$streak = "<img src='".X1_imgpath."/articles/stars-4.gif' title='$row[streakwins] ".laddermod_winsinarow."'>";
		}else if ($row["streakwins"] >= 3) {
			$streak = "<img src='".X1_imgpath."/articles/stars-3.gif' title='$row[streakwins] ".laddermod_winsinarow."'>";
		}else if ($row["streakwins"] >= 2) {
			$streak = "<img src='".X1_imgpath."/articles/stars-2.gif' title='$row[streakwins] ".laddermod_winsinarow."'>";
		}else if ($row["streakwins"] >= 1) {
			$streak = "<img src='".X1_imgpath."/articles/stars-1.gif' title='$row[streakwins] ".laddermod_winsinarow."'>";
		}else {
			$streak = "<img src='".X1_imgpath."/articles/stars-0.gif' title='$row[streakwins] ".laddermod_winsinarow."'>";
		}
		$name2 = str_replace(' ', "+", $row["name"]);
		$c .=  "
		<tr>
			<td class='alt1'>$rank($row[rung])</td>
			<td class='alt2'>$row[clantags]</td>
			<td class='alt1'>
			<a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=$name2'>$row[name]</a></td>
			<td class='alt2'>$row[challenged]</td>
			<td class='alt1'>$row[wins]</td>
			<td class='alt2'>$row[losses]</td>
			<td class='alt1'>$row[draws]</td>
			<td class='alt2'>$row[points]</td>
			<td class='alt1'>$percentage%</td>
			<td class='alt1'><img src='".X1_imgpath."/flags/$row[country].bmp' align='absmiddle'></td>
		</tr>";
		$rank++;
	}
}else{
	$c .="<tr>
				<td colspan='11'>".laddermod_noteams."</td>
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