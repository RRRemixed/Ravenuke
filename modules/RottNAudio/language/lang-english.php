<?php

/************************************************************************
               RottNAudio
   ============================================
   Copyright (c) 2008 RottNResources.com & JeroenWijering.com

   Module Author : RottNKorpse (www.RottNResources.com)
   Flash Author  : Jeroen Wijering (www.JeroenWijering.com)
   Edited for Standard/Ravens Nuke : Ped (ped@clanthemes.com)
************************************************************************/

global $admin_file;
$module_name = basename(dirname(dirname(__FILE__)));

/****[ START ]***********************************************************/
/*           Administration Terms                                       */
/************************************************************************/

define("_ADMIN_ROTTNAUDIO_HEADER","$module_name : Administration");
define("_ADMIN_HEADTITLE1","General");
define("_ADMIN_HEADTITLE2","Track Management");
define("_ADMIN_HEADTITLE3","Flashvar Settings");
define("_ADMIN_GO_TO_INDEX","$module_name Module Index");
define("_ADMIN_MAIN_RETURN","Return to Main");
define("_ADMIN_ADMINISTRATION","Administration");
define("_ADMIN_RETURN","Return to $module_name Admin");
define("_ADMIN_YES","Yes");
define("_ADMIN_NO","No");
define("_ADMIN_SUBMIT","Submit");
define("_ADMIN_UPDATE","Update");
define("_ADMIN_DENIED","Access Denied!");
define("_ADMIN_FAILURE","There seems to be an error somewhere in the system!");
define("_ADMIN_FAILURE_NOTE","If you require assistance please go to <a href='http://www.RottNResources.com' target='_blank'>www.RottNResources.com</a> for support, you can also hire RottNKorpse personally to fix your copy of ".$module_name." just email him at <a href='mailto:RottNKorpse@RottNResources.com'>RottNKorpse@RottNResources.com</a>");

/*****************************/

/*****[ General ]*****/

define("_ADMIN_GENERAL_LINK1","Configuration");
define("_ADMIN_GENERAL_LINK2","Color Palette");
define("_ADMIN_GENERAL_LINK3","FAQs");

/*****[ Theme Integration ]*****/

define("_ADMIN_THEME_INTEGRATION","Theme Integration Statistics");
define("_ADMIN_THEME_INTEGRATION_COMPATIBLE","This theme is compatible.");
define("_ADMIN_THEME_INTEGRATION_INCOMPATIBLE","Sorry but this theme is not compatible.");
define("_ADMIN_THEME_INTEGRATION_MISSING_IMAGE","- The Header Image for this theme is missing.");
define("_ADMIN_THEME_INTEGRATION_MISSING_FILE","- The rottnaudio.php file for this theme is missing.");

/*****[ Version Checker ]*****/

define("_ADMIN_VERSION_INFO","Version Info");
define("_ADMIN_VERSION_CHECK_MSG1","The latest version of ".$module_name." is");
define("_ADMIN_VERSION_CHECK_MSG2","You are currently running the latest version of ".$module_name."");
define("_ADMIN_VERSION_CHECK_MSG3","Your version of ".$module_name." seems to be outdated");
define("_ADMIN_VERSION_CHECK_MSG4","Reason for ".$module_name."'s update to version");
define("_ADMIN_VERSION_CHECK_MSG5","Do I really <strong>have</strong> to update to this version?");
define("_ADMIN_VERSION_CHECK_MSG6","Download Link for version");

/*****[ Configuration ]*****/

define("_ADMIN_CONFIGURATION_TITLE1","General Configuration");
define("_ADMIN_CONFIGURATION_TITLE2","Module Configuration");
define("_ADMIN_CONFIGURATION_TITLE3","Block Configuration");
define("_ADMIN_CONFIGURATION_FIELD1","Do you want to use Theme Integration?");
define("_ADMIN_CONFIGURATION_FIELD2","Do you want to use Universal settings?");
define("_ADMIN_CONFIGURATION_FIELD2_NOTE","If so, check the box next to the player.");
define("_ADMIN_CONFIGURATION_PLAYER1","Module Player");
define("_ADMIN_CONFIGURATION_PLAYER2","Block Player");
define("_ADMIN_CONFIGURATION_PLAYER3","Pop-Up Player");
define("_ADMIN_CONFIGURATION_PLAYER4","[mp3] BBCode Player");
define("_ADMIN_CONFIGURATION_FIELD3","Use Module Header Image?");
define("_ADMIN_CONFIGURATION_FIELD4","Use Custom Global Header Image?");
define("_ADMIN_CONFIGURATION_FIELD4_NOTE","This will overwrite all theme based header image and use this image on every theme.");
define("_ADMIN_CONFIGURATION_FIELD5","URL for Custom Global Header Image");
define("_ADMIN_CONFIGURATION_FIELD6","Do you want to show the launch Pop-Up link?");
define("_ADMIN_CONFIGURATION_FIELD7","Do you want to show the launch Pop-Up link?");
define("_ADMIN_CONFIGURATION_MODULE_MSG1","All other module settings are done in the Modules Admininstration");
define("_ADMIN_CONFIGURATION_MODULE_MSG2","Click Here to proceed to the Modules Admin");
define("_ADMIN_CONFIGURATION_BLOCK_MSG1","All other block settings are done in the Blocks Admininstration");
define("_ADMIN_CONFIGURATION_BLOCK_MSG2","Click Here to proceed to the Blocks Admin");
define("_ADMIN_CONFIGURATION_COMPLETE","The Configuration settings have been succesfully updated.");

/*****************************/

/*****[ Song Management ]*****/

define("_ADMIN_SONGMNGMT_LINK1","Add a Track");
define("_ADMIN_SONGMNGMT_LINK2","Edit Tracks");
define("_ADMIN_SONGMNGMT_LINK3","Delete Tracks");
define("_ADMIN_SONGMNGMT_LINK4","Edit Track Order");

/**[ Adding a Song ]**/

define("_ADMIN_ADDSONG_NOTE","Be sure to include the \"<strong>http://</strong>\" part at the beginning of the url or the player will not recognize your url. http:// is important but the www's are not you can use or not use them if you want.");
define("_ADMIN_ADDSONG_BLANK_FIELD","Unknown");
define("_ADMIN_ADDSONG_FIELD1","Track Title");
define("_ADMIN_ADDSONG_FIELD2","Artist Name");
define("_ADMIN_ADDSONG_FIELD3","Direct URL to play MP3");
define("_ADMIN_ADDSONG_FIELD4","Download URL");
define("_ADMIN_ADDSONG_FIELD5","Album Cover URL");
define("_ADMIN_ADDSONG_FIELD6","Manual Order #");
define("_ADMIN_SONGADDED","Track Successfully Added!");
define("_ADMIN_FOLLOWING_SONG","The following track has been added to the database:");

/**[ Edit Songs ]**/

define("_ADMIN_EDIT","Edit");
define("_ADMIN_EDIT_UPDATED","Track Successfully Updated!");
define("_ADMIN_EDIT_FOLLOWING_SONG","The following track has been updated in the database:");

/**[ Edit Songs ]**/

define("_ADMIN_DELETE","Delete");
define("_ADMIN_DELETE_VERIFY1","Are you sure you would like to delete the song \"");
define("_ADMIN_DELETE_VERIFY2","\" by");
define("_ADMIN_DELETE_VERIFY3","?");
define("_ADMIN_DELETE_YES","Yes");
define("_ADMIN_DELETE_NO","No");
define("_ADMIN_DELETE_COMPLETE1","The track \"");
define("_ADMIN_DELETE_COMPLETE2","\" by");
define("_ADMIN_DELETE_COMPLETE3","has been successfully deleted.");

/**[ Song Order ]**/

define("_ADMIN_ORDER_CURRENT","Currently Ordered by :");
define("_ADMIN_ORDER_CHANGE","Change Order to :");
define("_ADMIN_ORDER_SELECTED","Select an Order");
define("_ADMIN_ORDER_OPTION1","Artist Name");
define("_ADMIN_ORDER_OPTION2","Track Title");
define("_ADMIN_ORDER_OPTION3","Date Added");
define("_ADMIN_ORDER_OPTION4","Manual Order");
define("_ADMIN_ORDER_EDIT_MANUAL","Edit Manual Order");
define("_ADMIN_ORDER_EDIT_MANUAL_MSG1","Only required if");
define("_ADMIN_ORDER_EDIT_MANUAL_MSG2","is set as the Song Order<br />Otherwise, just ignore this section.");

define("_ADMIN_ORDER_UPDATED","Song Order Successfully Updated!");
define("_ADMIN_ORDER_NEW","The Song Order has been changed to");
define("_ADMIN_ORDER_NEW_IS_MANUAL","The Song Order has been changed to Manual so be sure ");

/*****************************/

/*****[ Flashvars ]*****/

define("_ADMIN_FLASHVARS_LINK1","Universal*");
define("_ADMIN_FLASHVARS_LINK2","Module");
define("_ADMIN_FLASHVARS_LINK3","Block");
define("_ADMIN_FLASHVARS_LINK4","Pop-Up");
define("_ADMIN_FLASHVARS_LINK5","[mp3] BBCode");
define("_ADMIN_FLASHVARS_IMPORTANT_MSG","Important Message - READ THIS");
define("_ADMIN_FLASHVARS_UFV_MSG","If used <strong>Universal</strong> Settings will ignore the individual settings of the selected players chosen in the $module_name <strong>Configuration</strong> but will also ignore the theme based settings so if you want to have the colors change based on themes do not use the <strong>Universal</strong> Settings.");
define("_ADMIN_FLASHVARS_USE_THEMES","You currently have <strong>Theme Integration</strong> on so some of the settings below will be ignored.");
define("_ADMIN_FLASHVARS_USE_THEMES_IGNORED","ignored by Theme Integration");
define("_ADMIN_FLASHVARS_FIELD1","Width");
define("_ADMIN_FLASHVARS_FIELD2","Height");
define("_ADMIN_FLASHVARS_FIELD3","Back Color");
define("_ADMIN_FLASHVARS_FIELD4","Front Color");
define("_ADMIN_FLASHVARS_FIELD5","Light Color");
define("_ADMIN_FLASHVARS_FIELD6","Screen Color");
define("_ADMIN_FLASHVARS_FIELD7","Overstretch");
define("_ADMIN_FLASHVARS_FIELD7_FIT","Stretch to fit disproportionally");
define("_ADMIN_FLASHVARS_FIELD7_NONE","Keep original dimensions");
define("_ADMIN_FLASHVARS_FIELD8","Show Equalizer");
define("_ADMIN_FLASHVARS_FIELD9","Show Icons");
define("_ADMIN_FLASHVARS_FIELD10","Show Stop Button");
define("_ADMIN_FLASHVARS_FIELD11","Show Song Duration & Time Left");
define("_ADMIN_FLASHVARS_FIELD12","Show Download Button");
define("_ADMIN_FLASHVARS_FIELD13","Auto Scroll through Playlists");
define("_ADMIN_FLASHVARS_FIELD14","Display Width");
define("_ADMIN_FLASHVARS_FIELD15","Display Height");
define("_ADMIN_FLASHVARS_FIELD16","Album Covers in Playlist");
define("_ADMIN_FLASHVARS_FIELD17","Auto Start");
define("_ADMIN_FLASHVARS_FIELD18","Repeat");
define("_ADMIN_FLASHVARS_FIELD18_LIST","Play through all tracks once");
define("_ADMIN_FLASHVARS_FIELD19","Shuffle");
define("_ADMIN_FLASHVARS_FIELD20","Volume (1-100)");
define("_ADMIN_FLASHVARS_FIELD21","Download Link Target");
define("_ADMIN_FLASHVARS_FIELD21_SELF","Open Download in Current Window");
define("_ADMIN_FLASHVARS_FIELD21_BLANK","Open Download in New Window");
define("_ADMIN_FLASHVARS_FIELD22","Border Size");
define("_ADMIN_FLASHVARS_FIELD23","Border Color");
define("_ADMIN_FLASHVARS_FIELD24","Use Right Alignment");
define("_ADMIN_FLASHVARS_COMPLETE","The settings have been succesfully updated.");

/*****************************/

/*****[ Installer ]*****/

define("_ADMIN_INSTALL_PAGE_TITLE_0","Introduction");
define("_ADMIN_INSTALL_PAGE_TITLE_1","Database Scan");
define("_ADMIN_INSTALL_PAGE_TITLE_2","File Scan");
define("_ADMIN_INSTALL_PAGE_TITLE_3","Create Tables");
define("_ADMIN_INSTALL_PAGE_TITLE_4","Install Block");
define("_ADMIN_INSTALL_PAGE_TITLE_5","Activate Module");
define("_ADMIN_INSTALL_PAGE_TITLE_6","Finish");

define("_ADMIN_INSTALL_PAGE_CONTENT_0","Welcome and thank you for using ".$module_name." from RottNResources.com<br /><br />This is the new RottNStaller which is an automatic installer that takes the insanely easy installation of previous projects and enhances the crap out of it providing you with not only installing of the module but also installation of the block, activation of the module and scan features which check to make sure the installation will work correctly before you even run it.<br /><br />So let's get started shall we, simply click on the \"Forward\" button.");
define("_ADMIN_INSTALL_PAGE_CONTENT_1_DETECTED","Scan Complete...<br /><br />Results:<br />Wait! It seems you have already installed ".$module_name."!<br /><br />Are you sure you want to continue with the installation?<br /><br />Running the installation process more than once could result in unrepairable damage to the database. I STRONGLY urge you to stop immediately.<br /><br /><hr class='rns'>If you feel you've reached this message in error you can do one of the following:<br /><br />1. Try your luck and install it anyway, if so just click the \"Forward\" button.<br /><br />2. If you are the more sensible type you can go to <a href='' target='_blank'>www.RottNResources.com</a> and request for help in the forums or you can use professional installation. Professional Installation is provided as a paid service that will have the module installed by RottNKorpse himself.");
define("_ADMIN_INSTALL_PAGE_CONTENT_1_UNDETECTED","Scan Complete...<br /><br />Results:<br />Great! There wasn't a previous installation of ".$module_name." found so we're ready to continue to the file scan.");
define("_ADMIN_INSTALL_SCAN_DATABASE_1","Existing ".$module_name." Tables Scan");
define("_ADMIN_INSTALL_SCAN_DATABASE_2","Blocks Table Scan");
define("_ADMIN_INSTALL_SCAN_DATABASE_3","Modules Table Scan");
define("_ADMIN_INSTALL_SCAN_FILES_1","BBCode Install Files Scan");
define("_ADMIN_INSTALL_SCAN_COMPLETE","Scan Complete...<br /><br />Results:<br />");
define("_ADMIN_INSTALL_SCAN_GOOD","Status: Good");
define("_ADMIN_INSTALL_SCAN_ERROR","Status: ERROR!");
define("_ADMIN_INSTALL_SCAN_MISSING","Status: MISSING!");
define("_ADMIN_INSTALL_PAGE_CONTENT_3","All of the necessary tables for ".$module_name." have been succesfully created!");
define("_ADMIN_INSTALL_PAGE_CONTENT_4","The ".$module_name." block player has been succesfully installed!");
define("_ADMIN_INSTALL_PAGE_CONTENT_5","".$module_name." has been succesfully activated!");
define("_ADMIN_INSTALL_PAGE_CONTENT_6","Great! The installation of ".$module_name." has been completed.<br /><br />Please <strong>remove this install file</strong> (modules/".$module_name."/install.php) & the <strong>install directory</strong> (modules/".$module_name."/install/) <strong>immediately</strong>, reuse of this file may result in database complications!<br /><br />Thank you for using ".$module_name."!<br /><br /><strong><a href=\"".$admin_file.".php?op=".$module_name."\">Click Here to proceed to the ".$module_name." Administration</a></strong><br /><br />If you have any questions or suggestions regarding this module visit");
define("_ADMIN_INSTALL_CANCEL_TITLE_0","Are you sure you want to cancel the installation of ".$module_name."?");
define("_ADMIN_INSTALL_CANCEL_TITLE_1","The installation of ".$module_name." has been cancelled");
define("_ADMIN_INSTALL_CANCEL_CONTENT_1","No further action is required to cancel the installation as nothing has been altered on your site.");
define("_ADMIN_INSTALL_CANCEL_CONTENT_2","In order to cancel you must click the \"Reset Database\" button below. When you reset the database all of the alterations that have been made so far to your database will be removed. This will NOT set your database back to Nuke-Evo default it will simply revert back to the status before this installation was started.");
define("_ADMIN_INSTALL_CANCEL_CONTENT_3","The installation has been cancelled and your database has been succesfully reset.");
define("_ADMIN_INSTALL_CANCEL_RESET","Reset Database");
define("_ADMIN_INSTALL_HELP_TITLE","".$module_name." Installation Help");
define("_ADMIN_INSTALL_HELP_CONTENT_0_MSG1","Unfortunately, due to the section of the installation that the RottNStaller has detected you need help with, the RottNStaller Help system can not provide you with immediate assistance. <br /><br />So to assist you&nbsp;");
define("_ADMIN_INSTALL_HELP_CONTENT_0_MSG2","It seems you are having some problems with running the <strong>Database Scan</strong> if that is the case then you can run the \"Auto-Fix\", if the button is displayed, and then Rescan the database. If you are still getting errors click the \"Cancel\" button and use the \"Reset Database\" feature. This will allow you to start over with the installation.<br /><br />If you are still having some problems&nbsp;");
define("_ADMIN_INSTALL_HELP_CONTENT_0_MSG3","It seems you are having some problems with running the <strong>File Scan</strong> if that is the case then look to see what files the scan is reporting that are missing. Now upload the files being sure to keep the folder structure intact and click the \"Rescan\" button.<br /><br />If problem is fixed then continue onto the next step, if you are still getting missing errors&nbsp;");
define("_ADMIN_INSTALL_HELP_CONTENT_0_OPTIONS","here are a few options to choose from in order to solve your problem:");
define("_ADMIN_INSTALL_HELP_CONTENT_0_OPTION_1","100% Free Support - Free support is provided by RottNKorpse on the RottNResources Support Forum. The benefit of the 100% Free Support is obviously that it's free but the drawbacks is that the support won't be immediate and will require patience to receive assistance. If this type of support works best for you then click the following link:");
define("_ADMIN_INSTALL_HELP_CONTENT_0_OPTION_2","Hire RottNKorpse to fix your installation - For $15.00, RottNKorpse will takeover the installation process and repair any issues that may have been created and will finish the installation for you. The benefit is your peace of mind. If you would like to hire RottNKorpse just send him an email at the address below.");
define("_ADMIN_INSTALL_HELP_CONTENT_0_OPTION_3","Order a Professional Installation - For ONLY $10.00, you can purchase a professional installation which guarantees the module will be properly installed complete with all BBCode file edits. All professional installations are provided by RottNKorpse<br /><br />At this time the professional installation ordering system is being created so for now just Email RottNKorpse and tell him you want a professional installation:");

/*****[ Upgrader ]*****/

define("_ADMIN_UPGRADE_PAGE_TITLE_0","Introduction");
define("_ADMIN_UPGRADE_PAGE_TITLE_1","Database Scan");
define("_ADMIN_UPGRADE_PAGE_TITLE_2","Upgrade Database");
define("_ADMIN_UPGRADE_PAGE_TITLE_3","Finish");

define("_ADMIN_UPGRADE_PAGE_CONTENT_0","Welcome and thank you for using ".$module_name." from RottNResources.com<br /><br />To start the upgrade of your installation of ".$module_name." simply click on the \"Forward\" button.");
define("_ADMIN_UPGRADE_SCAN_COMPLETE","Scan Complete...<br /><br />Results:<br />");
define("_ADMIN_UPGRADE_SCAN_DATABASE_1","Your current version of ".$module_name." is");
define("_ADMIN_UPGRADE_SCAN_DATABASE_2","To continue the upgrade simply click the \"Forward\" button and RottNStaller will upgrade your database based on the version it just automatically detected.");
define("_ADMIN_UPGRADE_COMPLETE","Your database has been successfully upgraded to ".$module_name."&nbsp;");
define("_ADMIN_UPGRADE_FINISH","Great! The upgrade of ".$module_name." has been completed.<br /><br />Please <strong>remove this upgrade file</strong> (modules/".$module_name."/upgrade.php) & the <strong>upgrade directory</strong> (modules/".$module_name."/upgrade/) <strong>immediately</strong>, reuse of this file may result in database complications!<br /><br />Thank you for using ".$module_name."!<br /><br /><strong><a href=\"".$admin_file.".php?op=".$module_name."\">Click Here to proceed to the ".$module_name." Administration</a></strong><br /><br />If you have any questions or suggestions regarding this module visit");
define("_ADMIN_UPGRADE_HELP_TITLE","".$module_name." Upgrade Help");
define("_ADMIN_UPGRADE_HELP_CONTENT_0_MSG1","Unfortunately, due to the section of the upgrade that the RottNStaller has detected you need help with, the RottNStaller Help system can not provide you with immediate assistance. <br /><br />So to assist you&nbsp;");
define("_ADMIN_UPGRADE_HELP_CONTENT_0_OPTIONS","here are a few options to choose from in order to solve your problem:");
define("_ADMIN_UPGRADE_HELP_CONTENT_0_OPTION_1","100% Free Support - Free support is provided by RottNKorpse on the RottNResources Support Forum. The benefit of the 100% Free Support is obviously that it's free but the drawbacks is that the support won't be immediate and will require patience to receive assistance. If this type of support works best for you then click the following link:");
define("_ADMIN_UPGRADE_HELP_CONTENT_0_OPTION_2","Hire RottNKorpse to fix your installation - For $15.00, RottNKorpse will takeover the installation process and repair any issues that may have been created and will finish the installation for you. The benefit is your peace of mind. If you would like to hire RottNKorpse just send him an email at the address below.");
define("_ADMIN_UPGRADE_HELP_CONTENT_0_OPTION_3","Order a Professional Installation - For ONLY $10.00, you can purchase a professional installation which guarantees the module will be properly installed complete with all BBCode file edits. All professional installations are provided by RottNKorpse<br /><br />At this time the professional installation ordering system is being created so for now just Email RottNKorpse and tell him you want a professional installation:");

/****[ END ]*************************************************************/
/*           Administration Terms                                       */
/************************************************************************/

/****[ START ]***********************************************************/
/*           Public Terms                                               */
/************************************************************************/

define("_POP_UP_LAUNCH","Launch");
define("_POP_UP_PLAYER","Pop-Up Player");
define("_INSTALL_FILES_FOUND","".$module_name." requires you to install the projct before it lets you edit anything. So <a href='modules.php?name=".$module_name."&file=install' style='font-weight:bold;'>click here to go to the RottNStaller</a> to install ".$module_name.".<br /><br />If you have already installed ".$module_name." then please <strong>remove this install file</strong> (modules/".$module_name."/install.php) & the <strong>install directory</strong> (modules/".$module_name."/install/) <strong>immediately</strong>, reuse of this file may result in database complications!");
define("_UPGRADE_FILES_FOUND","It seems you have uploaded the upgrade files for ".$module_name." <a href='modules.php?name=".$module_name."&file=upgrade' style='font-weight:bold;'>click here to go to the RottNStaller</a> to upgrade ".$module_name.".<br /><br />If you have already ran the upgrade process please <strong>remove this upgrade file</strong> (modules/".$module_name."/upgrade.php) & the <strong>upgrade directory</strong> (modules/".$module_name."/upgrade/) <strong>immediately</strong>, reuse of this file may result in database complications!");

/****[ END ]*************************************************************/
/*           Public Terms                                               */
/************************************************************************/

?>