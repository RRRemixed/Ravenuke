<?php
###########################################
# SCRIPT CONFIG FOR PHP-NUKE
###########################################
# ERROR REPORTING OPTIONS
#error_reporting(2047);
###########################################
# PATH OPTIONS
# Path options define directorys where files should exsist and what to insert 
# into certain links to trigger certain actions within a cms.
###########################################
#Sets site name
define('X1_sitename', "NukeLadder Powered Gaming Site");
#Return url, loggin out ect
define('X1_url', 'http://www.nukeladder.com/');  
#Path to Plugin directory
define('X1_plugpath', "modules/NukeLadder");
#Path to css directory
define('X1_csspath', X1_plugpath."/css");
#Path to images directory
define('X1_imgpath', X1_plugpath."/images");
#Path to javascripts
define('X1_jspath', X1_plugpath."/jscript");
#Path to plugin mod files
define('X1_modpath',X1_plugpath."/mods");
#Path to language files
define('X1_langpath', X1_plugpath."/language");
#Path to email files
define('X1_emailpath', X1_plugpath."/emails");

#File to use in POST requests in admin
define('X1_adminpostfile', 'modules.php?name=NukeLadder');
#File to use in GET requests in admin
define('X1_admingetfile', 'modules.php');

#File to use in POST requests in core
define('X1_publicpostfile', 'modules.php?name=NukeLadder');
#File to use in GET requests in core
define('X1_publicgetfile', 'modules.php');
#Action operators

define('X1_linkactionoperator', 'name=NukeLadder&op');
define('X1_actionoperator', 'op');



#Which cms the plugin is running in
define('X1_parent', 'phpnuke');
#Output format of the plugin
define('X1_output', "echo");

###########################################
# LOCALE OPTIONS
# Locale options define which lanaguage files to use in core and admin areas.
# (only english, spanish so far, tanslators needed.)
###########################################

#Admin Lang 
define('X1_adminlang', 'english');
#Core Lang
define('X1_corelang', 'english');

#Normal dateformat
define('X1_dateformat', 'M:d:Y');
#Extended dateformat with time
define('X1_extendeddateformat', 'M:d:Y H:i');

###########################################
# DATABASE MAPPING OPTIONS
# The following tables define which prefixes and which database tables to use.
# If you have a default setup, most of these should remain as is.
# Some nuke users may need to change the prefix options
###########################################

#Use external adodb abstraction layer, NukeEvo 2.0.0+ set to false as it has built-in adodb
define('X1_useadodblite', true);

#main tables prefix
define('X1_prefix', 'nuke_'); 
#user table prefix
define('X1_userprefix', 'nuke_');

#Users Main
#CMS Database table containing users
define('X1_DB_userstable', 'users');
#Key name which contains user's id
define('X1_DB_usersidkey', 'user_id');
#Key name which contains user's name
define('X1_DB_usersnamekey', 'username');
#Key name which contains user's email
define('X1_DB_usersemailkey', 'user_email');
#Key name which contains user's fake email
define('X1_DB_usersfakeemailkey', 'femail');
#Key name which contains user's public email flag
define('X1_DB_usersviewemailkey', 'user_viewemail');
#User extras
#Key name which contains user's icq
define('X1_DB_userseicqkey', 'user_icq');
#Key name which contains user's aim
define('X1_DB_userseaimkey', 'user_aim');
#Key name which contains user's msn
define('X1_DB_usersemsnkey', 'user_msn');
#Key name which contains user's yim
define('X1_DB_userseyimkey', 'user_yahoo');
#Key name which contains user's homepage
define('X1_DB_usersewebkey', 'user_website');
#Key name which contains user's avatar
define('X1_DB_userseavatarkey', 'user_avatar');
#Key name which contains user's country
define('X1_DB_userslocationkey', 'user_from');
#Key name which contains user's registration date
define('X1_DB_usersregdatekey', 'user_regdate');


#Table Mapping
#Plugin Maps Table
define('X1_DB_maps', 'laddermaplist');
#Plugin Games Table
define('X1_DB_games', 'games');
#Plugin Teams Table
define('X1_DB_teams', 'teams');
#Plugin Events Table
define('X1_DB_events', 'ladders');
#Plugin Challenges Table
define('X1_DB_teamchallenges', 'challengeteam');
#Plugin Temp Challenges Table
define('X1_DB_teamtempchallenges', 'challengeteamtemp');
#Plugin Invites Table
define('X1_DB_teaminvites', 'confirminvites');
#Plugin Disputes Table
define('X1_DB_teamdisputes', 'ladderdisputes');
#Plugin Team's Events Table
define('X1_DB_teamsevents', 'ladderteams');
#Plugin Matches Table
define('X1_DB_teamhistory', 'playedgames');
#Plugin Joined Teams Table
define('X1_DB_teamroster', 'userteams');
#Plugin Mapgroups Table
define('X1_DB_mapgroups','mapgroups');



###########################################
# LINKBACK OPTIONS
# Linking back is nice.
###########################################

#Show linkback, true or false
define('X1_showlinkback', true);
#Show text version info under image, true or false
define('X1_showversion', true);
#Version Number
define('X1_release', '2.5.5');
#Alignment , right, center, left
define('X1_lbalign', 'right');
#black, blue, green, grey, orange, red, violet, white, yellow (.png)
define('X1_lbimage', 'blue.png');
#Linkback url
define('X1_lblink', 'http://www.nukeladder.com');



###########################################
# COOKIE AND LOGIN/OUT OPTIONS
# Define cookie name and time, and refreshtime when logging in and out.
###########################################

#Cookie mode (0=php) (1=javascript) (0 is default, 1 for phpbb)
define('X1_cookiemode','0');
#Cookie name (default works fine)
define('X1_cookiename', 'team');
#Time for cookie to last
define('X1_cookietime', '32000');
#Time to wait to fresh when logging in and out
define('X1_refreshtime', "2");
#Page to goto when logging out
define('X1_logoutpage', X1_url.'index.php');


###########################################
# EMAIL OPTIONS
# Options for sending emails
###########################################

#Turn sending on and off
define('X1_emailon',true);
#Return mail address
define('X1_returnmail', 'noreply@yourdomain.com');
#Timestamp format used when creating dates in emails
define('X1_emailtimestamp', 'M:d:Y H:i');
#Show text when emails are sent, for debugging use.
define('X1_emaildebug',false);


###########################################
# TEAMS OPTIONS
# Options related to teams and team profiles
###########################################

#How many teams to display per page on the team list
define('X1_teamlistlimit',5);
#How many teams one user is allowed to create
define('X1_maxcreate', "2");
#How many teams one user is allowed to join
define('X1_maxjoin', "5");
#Team image width
define('X1_teamimagew',"100");
#Team image height
define('X1_teamimageh',"100");
#Extra option on roster
define('X1_extraroster1', "Extra1");
define('X1_extraroster2', "Extra2");
define('X1_extraroster3', "Extra3");
#Mysql Orderby for sortinng rosters
define('X1_rostersort', "name ASC");
#Default Logo
define('X1_team_image', X1_imgpath.'/deflogo.gif');

###########################################
# LADDER HOME LIMIT OPTIONS
###########################################

#Number of teams to show in top standings table
define('X1_topteamlimit', "5");
#Number of new matches to show
define('X1_newmatchlimit',"5");
#number of past matches to show
define('X1_resultslimit', "5");

###########################################
# PLAYER OPTIONS - BROKEN!!!!!
###########################################

define('X1_newplayerdays', "3");
define('X1_newplayercolor', "#CCCCCC");
define('X1_showavatars', false );


###########################################
# MOD SETTINGS OPTIONS
###########################################

#Show settings when challenging
define('X1_showsettingschall', true );
#Show Rules when challenging
define('X1_showruleschall', true );
#Show settings when reporting
define('X1_showsettingsreport', true );
#Show rules when reporting
define('X1_showrulesreport', true );


###########################################
# CHALLENGE EXTRA OPTIONS - Marked for workover
###########################################

#Turn on Extras in challenges 1
define('X1_extraoneon', true );
#Turn on Extras in challenges 2
define('X1_extratwoon', true );
#Extra field 1's name
define('X1_extraonename', 'Server IP' );
#Extra field 2's name
define('X1_extratwoname', 'Server Port' );
# False =  shows field on send challenge form
# True  = shows field on accept challenge form
#Page to show field 1
define('X1_extraonepage', false );
#Page to show field 2
define('X1_extratwopage', false );


###########################################
# Css Options and Menu 
# Some systems may have conflicting or conforming css style classes, 
# define them here or leave as is for main style.
###########################################
define('X1_custommenu', false);
define('X1_custommenu_inc', "system_menu.php");

#Use a custom stylesheet found in Plugin Css directory
define('X1_customstyle', true);
define('X1plugin_title', 'title');
define('X1_formstyle', 'margin:0;');
define('X1_teamlistclass', 'tborder');
define('X1_teamreportclass', 'tborder');
define('X1plugin_gamecontainer', 'tborder');
define('X1plugin_newmatchestable', 'tborder');
define('X1plugin_pastmatchestable', 'tborder');
define('X1plugin_matchdetailstable', 'tborder');
define('X1plugin_standingstable', 'tborder');
define('X1plugin_mapslist', 'tborder');
define('X1plugin_teamprofiletable', 'tborder');
define('X1plugin_createteamtable', 'tborder');
define('X1plugin_quitteamtable', 'tborder');
define('X1plugin_jointeamtable', 'tborder');
define('X1plugin_teamadmintable', 'tborder');
define('X1plugin_playerprofiletable', 'tborder');
define('X1plugin_challengeteamtable', 'tborder');
define('X1plugin_admintable', 'tborder');
define('X1plugin_disputestable', 'tborder');
define('X1plugin_rulestable', 'tborder');
define('X1plugin_ladderhometable', 'tborder');
define('X1plugin_tablehead', 'thead');
define('X1plugin_tablebody', 'tbody');
define('X1plugin_tablefoot', 'tfoot');


###########################################
# Admin Options
###########################################

#help file, liad in admin panel 
define('X1_helpfile', 'http://www.projectxnetwork.com/help.htm');
#Icon Images
define('X1_addimage', '/submit/add.gif');
define('X1_delimage', '/submit/close_red.gif');
define('X1_saveimage', '/submit/disk.gif');
define('X1_editimage', '/submit/edit.gif');
define('X1_tab_image', '/folder.gif');
#Show or hide the config panel in the admin
define('X1_useconfigpanel', false);

#How many lines to show per panel page
define('X1_adminquerylimit', 10);

###########################################
# More
###########################################

#defualt image preview image
define('X1_defpreviewimage', '/games/default.png');
#Tab Size
define('X1_tab_width', '10');
define('X1_tab_height', '10');
#Tab Border
define('X1_tab_border', '0');
#Yes and no colors
define('X1_Yescolor', '#00FF00');
define('X1_Nocolor', '#FF0000');
?>
