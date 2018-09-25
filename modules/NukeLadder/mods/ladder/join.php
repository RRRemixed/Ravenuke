<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
#Check to see if ladder exsists, error if none
if ($ladderexists < 1) {
	return $c .= X1_laddermod_missingevent;
}
#Check if they are on the ladder allready
if ($teamsonladder >= 1) {
	return $c .= X1_laddermod_allreadyjoined;
}
#Check to see if the ladder is full
if ($numteamsonladder >= $lad['maxteams']){
	return $c .= X1_laddermod_eventfull;
}

#Check to see if the ladder is active
if (!$lad['active']){
	return $c .= X1_laddermod_eventdisabled;
}

#Update database
$return = $xdb->Execute(
"INSERT INTO ".X1_prefix.X1_DB_teamsevents."
(ladder_id, team_id, ladder_name, name, country, mail, icq, clantags, homepage, clanlogo, msn, rung)
VALUES
(
".$xdb->qstr($lad['sid']).", 
".$xdb->qstr($team_id).", 
".$xdb->qstr($ladder_name).", 
".$xdb->qstr($name).", 
".$xdb->qstr($country).", 
".$xdb->qstr($mail).",
".$xdb->qstr($icq).", 
".$xdb->qstr($clantags).", 
".$xdb->qstr($homepage).", 
".$xdb->qstr($clanlogo).", 
".$xdb->qstr($msn).",
".$xdb->qstr($numteamsonladder+1)."
)");
$c .= X1_laddermod_joinedevent;
?>