<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################

$rungsup = $event['score'];
$rungsdown = $event['rating'];

//Get the current rung of the winner.
$row= $xdb->GetRow("SELECT * 
FROM ".X1_prefix.X1_DB_teamsevents." 
WHERE team_id=".$xdb->qstr($winner_id)." 
AND ladder_id=".$xdb->qstr($event['sid']));

$winnerrung = $row["rung"];

//Get the current rung of the loser.

$row= $xdb->GetRow("SELECT * 
FROM ".X1_prefix.X1_DB_teamsevents." 
WHERE team_id=".$xdb->qstr($loser_id)." 
AND ladder_id=".$xdb->qstr($event['sid']));

$loserrung = $row["rung"];


//If the winners rung is greater than the losers rung then we have to adjust the ranks.
if ($winnerrung > $loserrung){

	$challenger_new_rung = $loserrung;
	$challenged_new_rung = $loserrung+$rungsup;
	
	$rows= $xdb->GetAll("select name, rung 
	from ".X1_prefix.X1_DB_teamsevents." 
	WHERE rung > $winnerrung 
	AND rung <= $challenged_new_rung 
	AND ladder_id=".$xdb->qstr($event['sid']));
	
	foreach($rows AS $rowt){
		$result = $xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." 
		SET rung-1 
		WHERE name = $rowt[name] 
		AND ladder_id=".$xdb->qstr($event['sid'])); 
	}
	
	$teamsonladder = count($xdb->GetAll("SELECT * 
	FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE ladder_id=".$xdb->qstr($event['sid'])));
	
	if ($challenged_new_rung > $teamsonladder)$challenged_new_rung=$teamsonladder;

	$result = $xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." 
	set rung = $challenged_new_rung 
	where team_id=".$xdb->qstr($loser_id)."  
	AND ladder_id=".$xdb->qstr($event['sid'])); 
	
	$result = $xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." 
	set rung = $challenger_new_rung 
	where team_id=".$xdb->qstr($winner_id)." 
	AND ladder_id=".$xdb->qstr($event['sid'])); 
}


#Remove Challenge from databade
modifysql("DELETE FROM ", X1_DB_teamchallenges, "WHERE randid = ".$xdb->qstr($challenge['randid']));

#Update losing teams record in the datebase for the ladder
modifysql("UPDATE", X1_DB_teamsevents, "SET 
challenged ='".laddermod_defeateddby."$winner', 
wins=wins, 
losses=losses+1, 
totalwins=totalwins, 
totallosses=totallosses+1, 
points=points+$event[pointsloss], 
totalpoints=totalpoints+$event[pointsloss], 
games=games+1, totalgames=totalgames+1, 
streakwins=0, streaklosses=streaklosses+1 
WHERE team_id=".$xdb->qstr($loser_id)." AND ladder_id=".$xdb->qstr($event['sid']));


#Update winning teams record in the datebase for the ladder
modifysql("UPDATE", X1_DB_teamsevents, "SET 
challenged ='".laddermod_defeated." $loser', 
wins=wins+1, 
losses=losses, 
totalwins=totalwins+1, 
totallosses=totallosses, 
points=points+$event[pointswin], 
totalpoints=totalpoints+$event[pointswin], 
games=games+1, 
totalgames=totalgames+1, 
streakwins=streakwins+1, streaklosses=0 
WHERE team_id=".$xdb->qstr($winner_id)." AND ladder_id=".$xdb->qstr($event['sid']));

#Update overal teams record in the database. (loser)
modifysql("UPDATE", X1_DB_teams, "SET 
wins=wins, 
losses=losses+1, 
totalwins=totalwins, 
totallosses=totallosses+1, 
points=points+$event[pointsloss], 
totalpoints=totalpoints+$event[pointsloss], 
games=games+1, 
totalgames=totalgames+1, 
streakwins=0, 
streaklosses=streaklosses+1 
WHERE team_id=".$xdb->qstr($loser_id));

#Update overal teams record in the database. (winner)
modifysql("UPDATE", X1_DB_teams, "SET 
wins=wins+1, 
losses=losses, 
totalwins=totalwins+1, 
totallosses=totallosses, 
points=points+$event[pointswin], 
totalpoints=totalpoints+$event[pointswin], 
games=games+1, 
totalgames=totalgames+1, 
streakwins=streakwins+1, 
streaklosses=0 WHERE team_id=".$xdb->qstr($winner_id));

#Add the new played game to the datebase
modifysql("INSERT INTO",X1_DB_teamhistory, "
(laddername, winner, loser, date, comments, map1, map2, map3, map1t1, map1t2, map2t1, map2t2, map3t1, map3t2, demo)
VALUES 
(
".$xdb->qstr($event['sid']).", 
".$xdb->qstr($winner).", 
".$xdb->qstr($loser).", 
".$xdb->qstr(time()).", 
".$xdb->qstr($_POST['comments']).", 
".$xdb->qstr($challenge['map1']).", 
".$xdb->qstr($challenge['map2']).", 
".$xdb->qstr($mapnumarray).", 
".$xdb->qstr($m1winnerarray).", 
".$xdb->qstr($m1loserarray).", 
".$xdb->qstr($m2winnerarray).", 
".$xdb->qstr($m2loserarray).", 
".$xdb->qstr($_POST['screen1']).", 
".$xdb->qstr($_POST['screen2']).", 
".$xdb->qstr($_POST['demo'])."
)");

#Send successful report message
$c .= X1plugin_title(X1_laddermod_lossreported);
?>