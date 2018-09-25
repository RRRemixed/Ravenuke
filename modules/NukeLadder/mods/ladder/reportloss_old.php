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
	//The new rung of the winner will be the rung of the loser.
	$newwinnerrung = $loserrung;
	//The new rung of the loser will be thier original rung minus the number of rungs selected to drop for each ladder
	$newloserrung = $loserrung+$rungsdown;
	//When rankings are adjusted, you must fix the rungs to account for the change.
	//Select all teams where the rung is greater than the rung of the winner. 
	//Then subtract one rank to fill the hole where the winner was.
	$rows= $xdb->GetAll("select name, rung 
	from ".X1_prefix.X1_DB_teamsevents." 
	WHERE rung > $winnerrung 
	AND ladder_id=".$xdb->qstr($event['sid'])." order by rung");
	foreach($rows AS $rowt){
		$currungt = $rowt["rung"];
		$rungnamet = $rowt["name"];
		$cr = $currungt-1;
		$result = $xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." 
		set rung = $cr 
		where rung = $currungt 
		AND ladder_id=".$xdb->qstr($event['sid'])); 
	}
	//Select all teams where the rung is greater than the rung of the loser. 
	//Then add one rank to make room for where the loser will now be.
	$resultr = $xdb->GetAll("select name, rung 
	from ".X1_prefix.X1_DB_teamsevents." 
	WHERE rung >= $newloserrung 
	AND ladder_id=".$xdb->qstr($event['sid'])." 
	order by rung");
	foreach($resultr AS $rw){
		$cur2rung = $rw["rung"];
		$rungnamey = $rw["name"];
		$fix = $cur2rung +1;
		$result6 = $xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." 
		set rung='$fix' 
		where name='$rungnamey' 
		AND ladder_id=".$xdb->qstr($event['sid'])); 
	}
	
	//If the new loser rung is larger than the number of team on the ladder then there will be gaps.
	// This will check for that and set it to the last rung.
	$teamsonladder = count($xdb->GetAll("SELECT * 
	FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE ladder_id=".$xdb->qstr($event['sid'])));
	if ($newloserrung > $teamsonladder)$newloserrung=$teamsonladder;


	//Set the new rungs for each team.
	$result9 = $xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." 
	set rung = $newloserrung 
	where team_id=".$xdb->qstr($loser_id)."  
	AND ladder_id=".$xdb->qstr($event['sid'])); 
	$result0 = $xdb->Execute("update ".X1_prefix.X1_DB_teamsevents." 
	set rung = $newwinnerrung 
	where team_id=".$xdb->qstr($winner_id)." 
	AND ladder_id=".$xdb->qstr($event['sid'])); 
}else{
	//Else there should be no change in rungs.
	$newwinnerrung = $winnerrung;
	$newloserrung = $loserrung;
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