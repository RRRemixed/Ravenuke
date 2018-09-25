<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1_parent')) exit();
###############################################################

#May need to add your db details here. PHP and VB USERS
$xdb_host = 'localhost';
$xdb_db = 'phpbb'; // vbulletin
$xdb_user = 'username';
$xdb_pass = 'password';


switch(X1_parent){
###############################################################
# PHP-NUKE AND VARIANTS
###############################################################
	case "phpnuke":
		global $cookie,$dbhost,$dbuname,$dbpass,$dbname;
		$xdb = ADONewConnection('mysql');
		$result = $xdb->Connect($dbhost,$dbuname,$dbpass,$dbname);
		$ADODB_FETCH_MODE =  'ADODB_FETCH_ASSOC';
		if(!$result)die("Could not connect to the database.");
		$xdb->debug =false;
		function X1_userdetails()
		{
			global $user, $admin, $cookie;
			cookiedecode($user);
			$cookie[0] = (isset( $cookie[0]) ) ? $cookie[0] : "" ;
			$cookie[1] = (isset( $cookie[1]) ) ? $cookie[1] : "" ;
			return array($cookie[0], $cookie[1]);
		}
		function check_admin()
		{
			global $admin;
			if(is_admin($admin)){
				return true;
			}else{
				return false;
			}
		}
	break;
###############################################################
# BLACKFRAME ALPHA 
###############################################################
	case "blackframe":
		$BF['MAINMENU']['X1'] = "?x1=index";
		function X1_userdetails()
		{
			$user[0] = (isset($_SESSION['mid'])) ? $_SESSION['mid'] : "" ;
			$user[1] = (isset($_SESSION['username'])) ?  $_SESSION['username'] : "" ;
			return array($user[0], $user[1]);
		}
		function check_admin()
		{
			if(account_permission() > 89){
				return true;
			}else{
				return false;
			}
		}
	break;
###############################################################
# VBULLETIN FORUM SYSTEM
###############################################################
	case "vbulletin":
		$xdb = ADONewConnection('mysql');
		$result = $xdb->Connect($xdb_host , $xdb_user, $xdb_pass, $xdb_db);
		$ADODB_FETCH_MODE =  'ADODB_FETCH_ASSOC';
		if(!$result)die("Could not connect to the database.");
		$xdb->debug =false;
		function X1_userdetails()
		{
            global $vbulletin;
			$user[0] = (isset($vbulletin->userinfo['userid'])) ? $vbulletin->userinfo['userid'] : "" ;
			$user[1] = (isset($vbulletin->userinfo['username'])) ?  $vbulletin->userinfo['username'] : "" ;
			return array($user[0], $user[1]);
		}
		function check_admin()
		{
            global $vbulletin;
            $permissions = $vbulletin->userinfo['permissions'];
            if(is_array($permissions)){
                if($permissions['title']=='Administrators'){
                  return true;
                }else{
                  return false;
                }
            }else{
              return false;
            }
        }
	break;
###############################################################
# PHPBB FORUM SYSTEM
###############################################################
	case "phpbb":
		$xdb = ADONewConnection('mysql');
		$result = $xdb->Connect($xdb_host , $xdb_user, $xdb_pass, $xdb_db);
		$ADODB_FETCH_MODE =  'ADODB_FETCH_ASSOC';
		if(!$result)die("Could not connect to the database.");
		$xdb->debug =false;
		function X1_userdetails()
		{
			global $userdata;
			if($userdata['session_logged_in']=="1"){
				return array($userdata['user_id'],$userdata['username']);
			}
		}
		function check_admin()
		{
			global $userdata;
			if( ($userdata['session_logged_in']=="1") && ($userdata['session_admin']=="1") ){
				return true;
			}else{
				return false;
			}
		}
	break;
###############################################################
# E107 WEBSITE SYSTEM
###############################################################
	case "e107":
		global $mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb;
		$xdb = ADONewConnection('mysql');
		$result = $xdb->Connect($mySQLserver,$mySQLuser,$mySQLpassword,$mySQLdefaultdb);
		$ADODB_FETCH_MODE =  'ADODB_FETCH_ASSOC';
		if(!$result)die("Could not connect to the database.");
		function check_admin()
		{
			if(ADMIN){
				return true;
			}else{
				return false;
			}
		}
		function X1_userdetails()
		{
			if (USER)return array(USERID,USERNAME);
		}
	break;
###############################################################
# Aditional Systems 
# Please see the above 

###############################################################
}#End Switch
###############################################################
?>