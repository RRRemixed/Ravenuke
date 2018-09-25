<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
#update Database
modifysql("UPDATE", X1_DB_teamsevents, "
SET challenged ='".laddermod_openchall."' 
WHERE name=".$xdb->qstr($challenge['winner'])." AND ladder_id=".$xdb->qstr($event['sid']));

modifysql("UPDATE", X1_DB_teamsevents, "
SET challenged ='".laddermod_openchall."' 
WHERE name=".$xdb->qstr($challenge['loser'])." AND ladder_id=".$xdb->qstr($event['sid']));

modifysql("DELETE FROM", X1_DB_teamtempchallenges, "
WHERE randid=".$xdb->qstr($challenge['randid']));

#Echo withdrawn message
$c .= laddermod_challengewithdrawn;
?>