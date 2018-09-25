<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function standings($sid=0, $limit="") {
	global $xdb;
	$c  = X1plugin_style();
	if(!isset($_POST['sid'])){
		$_POST['sid'] = $sid;
	}
	
	$numberofplayersin = count($xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE ladder_id=".$xdb->qstr($_POST['sid'])));
	
	$row   = $xdb->GetRow("SELECT game FROM ".X1_prefix.X1_DB_events." 
	WHERE sid=".$xdb->qstr($_POST['sid']));
	
	$game  = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_games." 
	WHERE gameid=".$xdb->qstr($row['game']));
	
	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	WHERE sid=".$xdb->qstr($_POST['sid']));
	if ($event['type']==""){
		$c .= XL_missingfile; 
		return X1plugin_output($c);
	}
	require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$event[type]/standings.php");
	return X1plugin_output($c);
}
?>