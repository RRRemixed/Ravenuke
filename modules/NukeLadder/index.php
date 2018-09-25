<?php
###############################################################
# X1plugin Competition Management
# File::index.php
# File Version::2.5.5 
# Homepage::http://www.projectxnetwork.com
# Copyright:: Shane Andrusiak
###############################################################
if (!eregi("modules.php", $_SERVER['SCRIPT_NAME']))die("Error Loading Page!".$_SERVER['SCRIPT_NAME']);
define('X1plugin_include', true);
$module_name = basename(dirname(__FILE__));
define('NO_EDITOR', 1);
require_once('header.php');
require_once("modules/$module_name/config.php");
# Load X1 Config
require_once("modules/$module_name/config.php");

# Load AdodbLite if Requested
if(X1_useadodblite) require_once(X1_plugpath.'/adodb/adodb.inc.php');

# Load  Language Definitions
require_once(X1_langpath."/".X1_adminlang."/admin_lang.php");
require_once(X1_langpath."/".X1_corelang."/core_lang.php");

# Load Integration Functions
require_once(X1_plugpath."/integrate.php");

# Load System Functions
require_once(X1_plugpath."/core/system/system_selectboxes.php");
require_once(X1_plugpath."/core/system/system_functions.php");


# Load Admin Functions
function X1_require_admin(){
	if(check_admin()){
		require_once(X1_plugpath."/core/admin/admin_disputes.php");
		require_once(X1_plugpath."/core/admin/admin_config.php");
		require_once(X1_plugpath."/core/admin/admin_index.php");
		require_once(X1_plugpath."/core/admin/admin_games.php");
		require_once(X1_plugpath."/core/admin/admin_events.php");
		require_once(X1_plugpath."/core/admin/admin_matches.php");
		require_once(X1_plugpath."/core/admin/admin_teams.php");
		require_once(X1_plugpath."/core/admin/admin_maps.php");
		require_once(X1_plugpath."/core/admin/admin_mapgroups.php");
		require_once(X1_plugpath."/core/admin/admin_config.php");
		require_once(X1_plugpath."/core/admin/admin_challenges.php");
	}else{
		die("Go Away");
	}
}

#pseudo cron
expire_challenges();
$op = $_REQUEST[X1_actionoperator];
if(!defined('X1_cookiename'))define('X1_cookiename', "team");
# Header
require_once("header.php"); 
opentable();
# Menu
# Custom Menu
if(X1_custommenu)require_once(X1_plugpath."/core/system/".X1_custommenu_inc);
# Load Switch
require_once(X1_plugpath."/core/system/system_cases.php");
closetable();
# LinkBack
X1plugin_linkback();
require_once('footer.php');
?>