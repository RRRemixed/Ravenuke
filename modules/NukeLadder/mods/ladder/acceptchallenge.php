<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
$maps1=explode(",",$challenge['map1']);
$maps2=implode(",",$maps);

modifysql("UPDATE", X1_DB_teamsevents, " 
SET challenged =".$xdb->qstr(laddermod_gamevs.$challenge['loser'])." 
WHERE name=".$xdb->qstr($challenge['winner'])." 
AND ladder_id=".$xdb->qstr($event['sid']));

modifysql("UPDATE", X1_DB_teamsevents, " 
SET challenged =".$xdb->qstr(laddermod_gamevs.$challenge['winner'])." 
WHERE name=".$xdb->qstr($challenge['loser'])." 
AND ladder_id=".$xdb->qstr($event['sid']));

modifysql("INSERT INTO", X1_DB_teamchallenges, "
(winner, loser, date, randid, ladder_id, 
map1, map2, matchdate, extra1, extra2, extra3) 
VALUES 
(
".$xdb->qstr($challenge['winner']).", 
".$xdb->qstr($challenge['loser']).", 
".$xdb->qstr(time()).", 
".$xdb->qstr($challenge['randid']).", 
".$xdb->qstr($event['sid']).",
".$xdb->qstr($challenge['map1']).",
".$xdb->qstr($maps2).",
".$xdb->qstr($_POST['matchdate']).",
".$xdb->qstr($extra1).",
".$xdb->qstr($extra2).",
".$xdb->qstr($challenge['extra3'].laddermod_followup.$_POST['comments2'])."
)");

modifysql("DELETE FROM", X1_DB_teamtempchallenges, "WHERE randid = ".$xdb->qstr($challenge['randid']));

$c .= laddermod_challaccepted; 
?>