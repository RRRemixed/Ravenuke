<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
#Update the database
modifysql("UPDATE", X1_DB_teamsevents, "
SET challyesno ='No', challenged ='".laddermod_openchall."', points = '$newpoints' 
WHERE name=".$xdb->qstr($challenge['winner'])."  
AND ladder_id=".$xdb->qstr($event['sid']));

modifysql("UPDATE", X1_DB_teamsevents, "
SET challyesno ='No', challenged ='".laddermod_openchall."' 
WHERE name=".$xdb->qstr($challenge['loser'])." 
AND ladder_id=".$xdb->qstr($event['sid']));

modifysql("DELETE FROM", X1_DB_teamtempchallenges, "
WHERE randid = ".$xdb->qstr($challenge['randid']));

modifysql("UPDATE", "teams", "
SET totalpoints = ".$xdb->qstr($newtotalpoints)." 
WHERE name=".$xdb->qstr($challenge['winner']));

$c .= laddermod_challengedeclined;
?>