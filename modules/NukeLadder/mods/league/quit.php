<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
if (!$lad['active']){
    return $c .=X1_leaguemod_eventdisabled;
}

$del= $xdb->Execute("
delete from ".X1_prefix.X1_DB_teamsevents."
WHERE ladder_id=".$xdb->qstr($_POST['ladder_id'])."
AND team_id=".$xdb->qstr($_POST['team_id']));

if($del){
    $c .=leaguemod_teamremoved;
}else{
    $c .="Error:".$xdb->ErrorMsg();
}
?>