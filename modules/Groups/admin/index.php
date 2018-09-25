<?php
/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/
/***********************************************************/
/* Additional code clean-up, performance enhancements, and W3C	*/
/* and XHTML compliance fixes by Raven and Montego.		*/
/***********************************************************/

if (!defined('ADMIN_FILE')) {
	die ('Access Denied');
}

define('RN_GROUPS', true);

$module_name = 'Groups';

require_once ('mainfile.php');
require_once ('./modules/'.$module_name.'/includes/nsngr_module_func.php');

global $admin_file, $aid, $db, $prefix;

get_lang($module_name);

$aid = substr($aid, 0,25);
$query = $db->sql_query('SELECT `title`, `admins` FROM `'.$prefix.'_modules` WHERE `title`=\''.$module_name.'\'');
list($title, $admins) = $db->sql_fetchrow($query);
$db->sql_freeresult($query);

$query2 = $db->sql_query('SELECT `aid`, `email`, `radminsuper` FROM `'.$prefix.'_authors` WHERE `aid`=\''.$aid.'\'');
list($aname, $amail, $radminsuper) = $db->sql_fetchrow($query2);
$db->sql_freeresult($query2);

$admins = explode(",", $admins);
$auth_user = 0;

for($i=0; $i < sizeof($admins); $i++) {
	if($aname == $admins[$i] AND !empty($admins)) {
		$auth_user = 1;
	}
}

$grconfig = grget_configs();
$textrowcol = 'rows="10" cols="50"';

if($radminsuper == 1 || $auth_user == 1) {
	switch ($op) {
		case 'NSNGroups':
			include_once ('modules/Groups/admin/NSNGroups.php');
			break;
		case 'NSNGroupsAdd':
			include_once ('modules/Groups/admin/NSNGroupsAdd.php');
			break;
		case 'NSNGroupsAddSave':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsAddSave.php');
			break;
		case 'NSNGroupsConfig':
			include_once ('modules/Groups/admin/NSNGroupsConfig.php');
			break;
		case 'NSNGroupsConfigSave':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsConfigSave.php');
			break;
		case 'NSNGroupsDelete':
			include_once ('modules/Groups/admin/NSNGroupsDelete.php');
			break;
		case 'NSNGroupsDeleteConf':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsDeleteConf.php');
			break;
		case 'NSNGroupsEdit':
			include_once ('modules/Groups/admin/NSNGroupsEdit.php');
			break;
		case 'NSNGroupsEditSave':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsEditSave.php');
			break;
		case 'NSNGroupsEmpty':
			include_once ('modules/Groups/admin/NSNGroupsEmpty.php');
			break;
		case 'NSNGroupsEmptyConf':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsEmptyConf.php');
			break;
		case 'NSNGroupsUsersAdd':
			include_once ('modules/Groups/admin/NSNGroupsUsersAdd.php');
			break;
		case 'NSNGroupsUsersAddSave':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsUsersAddSave.php');
			break;
		case 'NSNGroupsUsersDelete':
			include_once ('modules/Groups/admin/NSNGroupsUsersDelete.php');
			break;
		case 'NSNGroupsUsersDeleteConf':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsUsersDeleteConf.php');
			break;
		case 'NSNGroupsUsersEmail':
			include_once ('modules/Groups/admin/NSNGroupsUsersEmail.php');
			break;
		case 'NSNGroupsUsersEmailSend':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsUsersEmailSend.php');
			break;
		case 'NSNGroupsUsersExpire':
			include_once ('modules/Groups/admin/NSNGroupsUsersExpire.php');
			break;
		case 'NSNGroupsUsersExpireDone':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsUsersExpireDone.php');
			break;
		case 'NSNGroupsUsersExpireSave':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsUsersExpireSave.php');
			break;
		case 'NSNGroupsUsersMove':
			include_once ('modules/Groups/admin/NSNGroupsUsersMove.php');
			break;
		case 'NSNGroupsUsersMoveSave':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsUsersMoveSave.php');
			break;
		case 'NSNGroupsUsersUpdate':
			include_once ('modules/Groups/admin/NSNGroupsUsersUpdate.php');
			break;
		case 'NSNGroupsUsersUpdateSave':
			csrf_check();
			include_once ('modules/Groups/admin/NSNGroupsUsersUpdateSave.php');
			break;
		case 'NSNGroupsUsersView':
			include_once ('modules/Groups/admin/NSNGroupsUsersView.php');
			break;
		case 'NSNGroupsView':
			include_once ('modules/Groups/admin/NSNGroupsView.php');
			break;
	}
} else {
	echo 'Access Denied';
}
?>