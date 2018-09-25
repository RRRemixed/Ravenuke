<?php
/************************************************************************/
/* nukeFEED
/* http://www.nukeSEO.com
/* Copyright © 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

global $admin_file, $db, $prefix;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if(!defined('ADMIN_FILE')) {
    Header('Location: ../../../'.$admin_file.'.php');
    die();
}

$module_name = basename(substr(__FILE__, 0, -16));
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query('SELECT title, admins FROM '.$prefix."_modules WHERE title='$module_name'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(',', $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;  
    }
}
if ($row2['radminsuper'] == 1 || $auth_user == 1) {

// Module Definition
include_once('includes/nukeSEO/seocontent.class.php');
include_once('includes/nukeSEO/nukeFEED.php');
seoCheckInstall();
// Header stuff:

  $pagetitle = ' - '._nF_ADMIN;
  include('header.php');
  $checktime = strtotime(date("Y-m-d", TIME()));
  $seoModule = 'Feeds';
  $seoConfig = seoGetConfigs($seoModule);
  $nFVersion = $seoConfig['version_newest'];
  $nFVerURL = $seoConfig['version_url'];
  $nFVerNotes = $seoConfig['version_notes'];
  if (nf_ENABLEUPDATECHECK) {
  if($seoConfig['version_check'] < $checktime) {
    $versionInfo = seoGetCurrentVersion('nukeFEED', 0);
    //$nFVersion  = $versionInfo['version'];
    //$nFVerURL   = $versionInfo['url'];
    //$nFVerNotes = addslashes($versionInfo['notes']);
    seoSaveConfig($seoModule, 'version_check', $checktime);
    seoSaveConfig($seoModule, 'version_newest', $nFVersion);
    seoSaveConfig($seoModule, 'version_url', $nFVerURL);
    seoSaveConfig($seoModule, 'version_notes', $nFVerNotes);
  }
  if ($nFVersion > $seoConfig['version_number']) {  
    $seoVersionHTML = seoPopUp(_nF_NEWVER.' - '.$nFVersion, $nFVerNotes).' <strong>'._nF_NEWVER.' - <a href="'.htmlentities($nFVerURL).'" title="'._nF_GETNEWVER.$nFVersion.'">'.$nFVersion.'</a></strong>';
  } else {
    $seoVersionHTML = '<i>'._nF_CURVER.'</i>';
  }
  } else {
    $seoVersionHTML = '';
  }
  OpenTable();
  echo '<center><h2>'._nukeFEED.' '.$seoConfig['version_number'].'</h2>'.$seoVersionHTML.'</center>
        <table width="100%" border="0">';
  echo '<tr>
          <td>'.seoHelp('_nF_CONFIG').' <a href="'.$admin_file.'.php?op=nfConfigMod">'._nF_CONFIG.'</a></td>
          <td>'.seoHelp('_nF_ADMIN').' <a href="'.$admin_file.'.php?op=nukeFEED">'._nF_ADMIN.'</a></td>
          <td>'.seoHelp('_nF_AGGREGATORS').' <a href="'.$admin_file.'.php?op=nfEditSubscript">'._nF_AGGREGATORS.'</a></td>
          <td>'.seoHelp('_nF_SITEADMIN').' <a href="'.$admin_file.'.php">'._nF_SITEADMIN.'</a></td>
        </tr></table>';
	CloseTable();
	OpenTable();

	switch ($_REQUEST['op']) {
		case 'nukeFEED':
		case 'nfEditFeed':
			include('modules/'.$module_name.'/admin/nukeFeedAdmin.php');
			break;
		case 'nfSaveFeed':
		case 'nfDeleteFeed':
		case 'nfDeleteConfirm':
			csrf_check();
			include('modules/'.$module_name.'/admin/nukeFeedAdmin.php');
			break;
		case 'nfConfigMod':
			include('modules/'.$module_name.'/admin/nfConfig.php');
			break;
		case 'nfSaveConfig':
		case 'nfDisableMod':
		case 'nfEnableMod':
			csrf_check();
			include('modules/'.$module_name.'/admin/nfConfig.php');
			break;
		case 'nfEditSubscript':
			include('modules/'.$module_name.'/admin/nfSubscriptions.php');
			break;
		case 'nfDelSubscript':
		case 'nfSaveSubscript':
			csrf_check();
			include('modules/'.$module_name.'/admin/nfSubscriptions.php');
			break;
	}
} else {
	include('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<center><b>'._ERROR.'</b><br /><br />'.$module_name.'</center>';
}

CloseTable();
include('footer.php');

?>
