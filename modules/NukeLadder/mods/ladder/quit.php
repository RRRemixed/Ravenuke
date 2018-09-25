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
    return $c .=X1_laddermod_eventdisabled;
}

$mod=$xdb->GetRow("
select * from ".X1_prefix.X1_DB_teamsevents." 
WHERE ladder_id='".$xdb->qstr($_POST['ladder_id'])."' 
AND team_id='".$xdb->qstr($_POST['team_id']));

$rungs= $xdb->GetAll("
select * from ".X1_prefix.X1_DB_teamsevents." 
WHERE ladder_id='".$xdb->qstr($_POST['ladder_id'])."' 
order by rung");
if($rungs){
	$nft = count($rungs);
	$cur1 = "1";
	foreach($rungs AS $row){
		if($row['rung'] > $mod['rung']){
			$result = $xdb->Execute("
			update ".X1_prefix.X1_DB_teamsevents." 
			set rung='rung-1' 
			where rung='$rowt[rung]' 
			AND ladder_id='".$xdb->qstr($_POST['ladder_id'])."'"); 
		}
	}
}
$del= $xdb->Execute("
delete from ".X1_prefix.X1_DB_teamsevents."
WHERE ladder_id=".$xdb->qstr($_POST['ladder_id'])."
AND team_id=".$xdb->qstr($_POST['team_id']));

if($del){
    $c .=laddermod_teamremoved;
}else{
    $c .="Error:".$xdb->ErrorMsg();
}
?>