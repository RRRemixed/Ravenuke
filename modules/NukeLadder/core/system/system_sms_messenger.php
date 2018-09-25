<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
#SMS MESSENGE ALERTS

#Alerts System - Future Use - Don't Touch
$X1_Alerts['SMS'] = "SMS Messages";

#If Not In Nukeladder, define needed path info
if (!defined('X1_plugpath')) {
	define('X1_plugpath', "NukeLadder");
}

#Define SMS Template Path
define('X1_smspath', X1_plugpath."/alerts/sms");

#Define SMS User Db field 
define('X1_DB_users_sms', 'user_sms');

#If Not In Nukeladder, define needed table info
if (!defined('X1_userprefix')) {
	define('X1_userprefix', 'nuke_');
	define('X1_DB_userstable', 'users');
	define('X1_DB_usersnamekey', 'username');
}

if(!isset($xdb)){
	require_once(X1_plugpath.'/adodb/adodb.inc.php');
    $xdb = &ADONewConnection('mysql');
    $result = $db->Connect( 'localhost' ,'root', 'toor', 'phpbb' );
    if(!$result)
    {
    	die("Could not connect to the database.");
    }
}

###############################################################

#Basic Carrier Array 
$carriers = array(
	'Boost Mobile' => '@myboostmobile.com',
	'Cingular'     => '@cingularME.com',
	'Nextel'       => '@messaging.nextel.com',
	'Qualcomm '    => '@pager.qualcomm.com',
	'Rogers'       => '@pcs.rogers.com',
	'Sprint '      => '@messaging.sprintpcs.com',
	'T-Mobile'     => '@tmomail.net',
	'Verizon '     => '@vtext.com',
	'Virgin '      => '@vmobl.com'
	);

###############################################################

#SelectBox to Display Carriers
#Id: Form id/name for selectbox
#Mode: 0 returns carrier name, 1 returns address suffix
function X1_carrier_select($id, $mode=0){
	global $carriers;
	$c  = "<select name='$id' id='$id'>";
	foreach($carriers As $key => $val) {
		$d = ($mode) ? $key : $val;
		$c .= "<option value='$d' align='left'>$key</option>";
	}
	$c .= "</select>";
	return $c;
}

###############################################################

#input box for 10 digits
function X1_carrier_input($id, $default){
	global $carriers;
	$c  = "<input name='$id' id='$id' type='int' value='$default' size='10' maxlength='10'>";
	return $c;
}

###############################################################

#Send contents to email address, via sms templates
function X1_send_sms($addy, $template, $content, $subject=''){
	if(str_split(str_replace(".","",preg_replace("/[^0-9\.]+/","",phpversion())),3) > 430){
		$temp = @file_get_contents(X1_smspath."/".$template);
	}else{
		$temp = implode("\n", file(X1_smspath."/".$template));
	}
	if($temp){
		foreach($content AS $key=>$val){
			$temp = str_replace("<? $key ?>", $val, $temp);
		}
		$sub = (empty($subject)) ? X1_emailsubject : $subject;
		mail($addy, $sub, $temp,"From:".X1_returnmail."\nX-Mailer: PHP/" . phpversion());
		if(X1_emaildebug){
			return "SMS sent to ".$addy;
		}
	}else{
		if(X1_emaildebug){
			return "Failed to load sms template :: $template<br />\n";
		}
	}
}

###############################################################

function X1_getuser_sms($member){
	global $xdb;
	$row = $xdb->GetRow("SELECT ".X1_DB_users_sms."  
	FROM ".X1_userprefix.X1_DB_userstable." 
	WHERE ".X1_DB_usersnamekey."=".$xdb->qstr($member));  
	if($row){
		return $row[X1_DB_users_sms];
	}else{
		return false;
	}
}

###############################################################


functions X1_updateuser_sms($member, $number, $carrier){
	global $xdb, $carriers;
	$ex = $xdb->Execute("
		UPDATE ".X1_userprefix.X1_DB_userstable." 
		SET ".X1_DB_users_sms."=".$xdb-qstr($number.$carriers[$carrier])." 
		WHERE ".X1_DB_usersnamekey."=".$xdb->qstr($member));  
	if($ex){
		return true
	}else{
		return false
	}
}

###############################################################
# Goats!
?>