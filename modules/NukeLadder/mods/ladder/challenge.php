<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################

#Check to see if rung is lower
if ($rchallenger['rung'] <= $rchallenged['rung'])return X1plugin_output($c .= X1plugin_title(laddermod_lowerrung));


#Check to see if challenged is too many rungs ahead
if ($rchallenger['rung'] - $event['score'] > $rchallenged['rung']){
	$c .= laddermod_toomanyrungs.$event['score'].laddermod_toomanyrungs2;
	$c .= "challenger :: ".$rchallenger['rung']."<br/>";
	$c .= "challenged :: ".$rchallenged['rung']."<br/>";
	return X1plugin_output($c);
}


#Implode For Storage in Database
$mapentry=implode(",",$maps);
$dateentry=implode(",",$dates);

#Update the database.
modifysql("UPDATE", X1_DB_teamsevents, "
SET challenged=".$xdb->qstr(laddermod_challengedby.$challenger['name'])."  
WHERE name=".$xdb->qstr($challenged['name'])."  
AND ladder_id=".$xdb->qstr($event['sid']));

modifysql("UPDATE", X1_DB_teamsevents, "
SET challenged=".$xdb->qstr(laddermod_challenged.$challenged['name'])."  
WHERE name=".$xdb->qstr($challenger['name'])."  
AND ladder_id=".$xdb->qstr($event['sid']));

modifysql("INSERT INTO", X1_DB_teamtempchallenges, "
(winner, loser, date, randid, ladder_id, map1, date1, extra1, extra2, extra3) 
VALUES (
".$xdb->qstr($challenged['name']).", 
".$xdb->qstr($challenger['name']).", 
".$xdb->qstr(time()).", 
".$xdb->qstr($randid).", 
".$xdb->qstr($event['sid']).",
".$xdb->qstr($mapentry).",
".$xdb->qstr($dateentry).",
".$xdb->qstr($_POST['extra1']).",
".$xdb->qstr($_POST['extra2']).",
".$xdb->qstr($_POST['extra3'])."
)");

$c .= laddermod_challengesuccess;
?>