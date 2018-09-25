<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
#Remove Challenge from databade
modifysql("DELETE FROM ", X1_DB_teamchallenges, "WHERE randid = ".$xdb->qstr($challenge['randid']));

#Update losing teams record in the datebase for the ladder
modifysql("UPDATE", X1_DB_teamsevents, "SET 
draws=draws+1,
totaldraws=totaldraws+1,
challenged ='".laddermod_drawvs."$winner', 
points=points+$event[pointsdraw], 
totalpoints=totalpoints+$event[pointsdraw], 
games=games+1, totalgames=totalgames+1, 
streakwins=0, streaklosses=streaklosses=0 
WHERE team_id=".$xdb->qstr($loser_id)." 
AND ladder_id=".$xdb->qstr($event['sid']));

modifysql("UPDATE", X1_DB_teamsevents, "SET 
draws=draws+1,
totaldraws=totaldraws+1,
challenged ='".laddermod_drawvs."$loser', 
points=points+$event[pointsdraw], 
totalpoints=totalpoints+$event[pointsdraw], 
games=games+1, totalgames=totalgames+1, 
streakwins=0, streaklosses=streaklosses=0 
WHERE team_id=".$xdb->qstr($winner_id)." 
AND ladder_id=".$xdb->qstr($event['sid']));


#Update overal teams record in the database. (loser)
modifysql("UPDATE", X1_DB_teams, "SET 
draws=draws+1,
totaldraws=totaldraws+1,
points=points+$event[pointsloss], 
totalpoints=totalpoints+$event[pointsloss], 
games=games+1, 
totalgames=totalgames+1, 
streakwins=0, 
streaklosses=streaklosses+1 
WHERE team_id=".$xdb->qstr($loser_id));

#Update overal teams record in the database. (winner)
modifysql("UPDATE", X1_DB_teams, "SET 
draws=draws+1,
totaldraws=totaldraws+1,
points=points+$event[pointsdraw], 
totalpoints=totalpoints+$event[pointsdraw], 
games=games+1, 
totalgames=totalgames+1, 
streakwins=streakwins=0, 
streaklosses=0 
WHERE team_id=".$xdb->qstr($winner_id));

#Add the new played game to the datebase
modifysql("INSERT INTO",X1_DB_teamhistory, "
(laddername, winner, loser, date, comments, map1, map2, map3, 
map1t1, map1t2, map2t1, map2t2, map3t1, map3t2, demo, draw)
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
".$xdb->qstr($_POST['demo']).",
".$xdb->qstr(1)."
)");

#Send successful report message
$c .= X1plugin_title(laddermod_drawreported);
?>