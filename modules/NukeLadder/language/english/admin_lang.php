<?php
###############################################################
# X1plugin Competition Management
# Author::Emerica
# Homepage::http://www.projectxnetwork.com
# Admin Panel Version 2.5.5
###########################################
# line 6 _delete dupe fixed
# line 137 _comments dupe fixed
# syswide removed
#
#
###########################################
#Main Administration Panel
define('XL_admin_title', "Plugin Administration");
define('XL_tab_help', ' Help');
define('XL_tab_games', ' Games');
define('XL_tab_events', ' Events');
define('XL_tab_maps', ' Maps');
define('XL_tab_mapgroups', ' Map Groups');
define('XL_tab_teams', ' Teams');
define('XL_tab_challenges', ' Challenges');
define('XL_tab_matches', ' Matches');
define('XL_tab_disputes', ' Disputes');
define('XL_tab_config', ' Config');

###########################################
#Games Administration Panel
define('XL_agames_add', 'Add Games');
define('XL_agames_id', 'Id');
define('XL_agames_name', 'Name');
define('XL_agames_pic', 'Picture');
define('XL_agames_desc', 'Description');
define('XL_agames_none', 'No games have been created in the database.');
define('XL_agames_selectimage', 'Select Image');
define('XL_agames_preview', 'Image Preview');
define('XL_agames_updated', 'Updated Games.');
define('XL_agames_added', ' blank game entries added.');

###########################################
#Ladder Administration Panel
define('XL_aevents_add', 'Add New Events');
define('XL_aevents_fixrungs', 'Fix Rungs');
define('XL_aevents_new', 'Add New Ladder');
define('XL_aevents_hid', 'Id');
define('XL_aevents_hname', 'Ladder Name');
define('XL_aevents_hgame', 'Game');
define('XL_aevents_hmod', 'Mod Type');
define('XL_aevents_hactive', 'Active');
define('XL_aevents_henabled', 'Enabled');
define('XL_aevents_hmodify', 'Modify');
define('XL_aevents_none', 'No Competitions have been created');

###########################################

define('XL_aevents_general', 'General Options');
define('XL_aevents_name', 'Ladder Name');
define('XL_aevents_game', 'Game');
define('XL_aevents_mod', 'Competition Type.');
define('XL_aevents_sort', 'Sort Type.');
define('XL_aevents_lex1', 'Ladder Extra 1 (lex1)');
define('XL_aevents_lex2', 'Ladder Extra 2 (lex2)');
define('XL_aevents_options', 'Ladder Options and Settings');
define('XL_aevents_active', 'Competition Actived.');
define('XL_aevents_enabled', 'Challenges Enabled.');
define('XL_aevents_simchall', 'Simultaneous Challenges Allowed.');
define('XL_aevents_maxgames', 'Maximum Games/Day');
define('XL_aevents_maxteams', 'Maximum Teams');
define('XL_aevents_minplayers', 'Minimum Players');
define('XL_aevents_maxplayers', 'Maximum Players');
define('XL_aevents_challdate', 'Challenge Date Options');
define('XL_aevents_resdates', 'Restrict Simultaneous Date Selections.');
define('XL_aevents_dropdates', 'Number of days shown in date dropdown.');
define('XL_aevents_numdates', 'Number of date dropdowns.');
define('XL_aevents_timezone', 'Timezone');
define('XL_aevents_mapoptions', 'Challenge Map Options');
define('XL_aevents_resmaps', 'Restrict Simultaneous map selections.');
define('XL_aevents_nummaps1', 'Number of map selections for Challenger.  1-10');
define('XL_aevents_nummaps2', 'Number of map selections for Challenged.  1-10');
define('XL_aevents_pointoptions', 'Point Options');
define('XL_aevents_win', 'Points Awarded For A Win');
define('XL_aevents_loss', 'Points Awarded For A Loss');
define('XL_aevents_draw', 'Points Awarded For A Draw');
define('XL_aevents_declinedchall', 'Points Removed For A Declined Challenge');
define('XL_aevents_description', 'Please enter a decription for your ladder.');
define('XL_aevents_rules', 'Enter Your rules, this may include lowend Html.');
define('XL_aevents_notes', 'Enter any notes, this may include lowend Html.');
define('XL_aevents_change', 'ChangeLadder');
define('XL_aevents_post', 'Post Ladder');
define('XL_aevents_added', 'Competition added.');
define('XL_aevents_editing', 'Edit a Ladder :: ');
define('XL_aevents_removed', 'Removal Complete.');
define('XL_aevents_removewarning', 'Warning, this will remove the event and extra items you selected to remove, are you sure?');
define('XL_aevents_updated', 'Competition Updated');
define('XL_aevents_fixed', 'Rungs Fixed for ladder_id:');
define('XL_aevents_expireoptions', 'Challenge Expiration');
define('XL_aevents_enableexpires', 'Allow challenges to expire');
define('XL_aevents_expirehours', 'Hours to expire after');
define('XL_aevents_expirepenalty', 'Penalty for not accepting.(points)');
define('XL_aevents_expirebonus', 'Bonus for the challenger (points)');

define('XL_aevents_reportoptions', 'Reporting Options');
define('XL_aevents_whoreports', 'Who should report the game.');
define('XL_aevents_winner', 'Winner Reports');
define('XL_aevents_loser', 'Loser Reports');

define('XL_aevents_mapgroups', 'Select the Map groups that belong to this event.');

###########################################
#Matches ADministration Panel
define('XL_amatches_createtitle', 'Create a played match');
define('XL_amatches_winner', 'Winner');
define('XL_amatches_selwinner', 'Select Winner');
define('XL_amatches_loser', 'Loser');
define('XL_amatches_selloser', 'Select Loser');
define('XL_amatches_seldate', 'Select Date Played');
define('XL_amatches_dateformat', 'Format: MONTH:DAY:YEAR  IE: 08:29:1982');
define('XL_amatches_winnermaps', 'Select Winners Maps (First Set)');
define('XL_amatches_winnerscore', 'Winner Score');
define('XL_amatches_loserscore', 'Loser Score');
define('XL_amatches_losermaps', 'Select Losers Maps (Second Set)');
define('XL_amatches_extras', 'Extras and Comments');
define('XL_amatches_screenshot', 'Screenshot Link(blank if none)');
define('XL_amatches_demo', 'Demo Link(blank if none)');
define('XL_amatches_comments', 'Comments - 255 Char Max');
define('XL_amatches_addmatch', 'Add Match');
define('XL_amatches_errnowinner', 'Sorry winner cannot be blank');
define('XL_amatches_errnoloser', 'Sorry loser team cannot be blank');
define('XL_amatches_errsameteams', 'Sorry you cant create a past match with two identical teams');
define('XL_amatches_added', 'New Match Added to Database');
define('XL_amatches_addrecord', 'Add New Match Record');
define('XL_amatches_hid', 'Id');
define('XL_amatches_hevent', 'Ladder');
define('XL_amatches_hwinner', 'Winner');
define('XL_amatches_hloser', 'Loser');
define('XL_amatches_hdate', 'Date');
define('XL_amatches_hmodify', 'Modify');
define('XL_amatches_none', 'No Matches Have Been Played Yet');
define('XL_amatches_matchadmin', 'Match Administration');
define('XL_amatches_monifymatch', 'Modify Match:: ');
define('XL_amatches_gameid', 'Game ID');
define('XL_amatches_dateentry', 'Date');
define('XL_amatches_maparray1', 'First Maps');
define('XL_amatches_maparray2', 'Second Maps');
define('XL_amatches_selmaparray', 'Map Select Array');
define('XL_amatches_winnerscorearray1', 'Map1 Score Winnner Array');
define('XL_amatches_loserscorearray1', 'Map1 Score Loser Array');
define('XL_amatches_winnerscorearray2', 'Map2 Score Winnner Array');
define('XL_amatches_loserscorearray2', 'Map2 Score Loser Array');
define('XL_amatches_screenshot1', 'Screenshot 1');
define('XL_amatches_screenshot2', 'Screenshot 2');
define('XL_amatches_eventid', 'Ladder Id');
define('XL_amatches_demolink', 'Demo Link');
define('XL_amatches_nomatch', 'Match was not found, or the event has been removed.');
define('XL_amatches_updated', 'Match updated');
define('XL_amatches_draw', 'Match was a draw');
define('XL_amatches_hdraw', 'Draw');
define('XL_amatches_modifymatch', "Modify this match");
###########################################
#Teams ADministration Panel
define('XL_ateams_editglobal', 'Edit team profiles or global records');
define('XL_ateams_editevent', 'Edit team event records');
define('XL_ateams_teamadmin', 'Ladder Team Administration');
define('XL_ateams_editteam', 'Modify Team: ');
define('XL_ateams_eventname', 'Ladder Id');
define('XL_ateams_id', 'Team ID');
define('XL_ateams_name', 'Team Name');
define('XL_ateams_password', 'Password');
define('XL_ateams_email', 'Email');
define('XL_ateams_country', 'Country');
define('XL_ateams_rung', 'Rung');
define('XL_ateams_games', 'Games');
define('XL_ateams_wins', 'Wins');
define('XL_ateams_losses', 'Losses');
define('XL_ateams_draws', 'Draws');
define('XL_ateams_points', 'Points');
define('XL_ateams_twins', 'Total Wins');
define('XL_ateams_tlosses', 'Total Losses');
define('XL_ateams_tgames', 'Total Games');
define('XL_ateams_tpoints', 'Total Points');
define('XL_ateams_penalties', 'Penalties');
define('XL_ateams_swins', 'Streak Wins');
define('XL_ateams_slosses', 'Streak Losses');
define('XL_ateams_rest', 'Rest');
define('XL_ateams_status', 'Status');
define('XL_ateams_challyesno', 'ChallYesNo');
define('XL_ateams_clantags', 'Clan tags');
define('XL_ateams_homepage', 'Homepage');
define('XL_ateams_logo', 'Logo');
define('XL_ateams_none', 'Team was not found.');
define('XL_ateams_teamupdated', 'Team updated');
define('XL_ateams_captain', 'Captain');
define('XL_ateams_profile', 'Profile');
define('XL_ateams_challenged', 'Challenged');
define('XL_ateams_ircserver', 'IRC Server');
define('XL_ateams_ircchannel', 'IRC Channel');
define('XL_ateams_joinpassword', 'Join Password');
#2.5.4
define('XL_ateams_updatemain', 'Update Main Team Table');

###########################################
#Maps ADministration Panel
define('XL_amaps_add', 'Add New Maps');
define('XL_amaps_id', 'Id');
define('XL_amaps_name', 'Map Name');
define('XL_amaps_picture', 'Map Picture');
define('XL_amaps_event', 'Competition');
define('XL_amaps_download', 'Download');
define('XL_amaps_none', 'You have not added any maps');
define('XL_amaps_updated', 'Updated maps');
define('XL_amaps_added', ' map spots added');

###########################################
# Mapgroups ADministration Panel
define('XL_amapgroups_add', 'Add New Mapgroups');
define('XL_amapgroups_id', 'Id');
define('XL_amapgroups_name', 'Group Name');
define('XL_amapgroups_edit', 'Edit');
define('XL_amapgroups_none', 'You have not added any map groups');
define('XL_amapgroups_updated', 'Updated map groups');
define('XL_amapgroups_added', 'Map groups added');
define('XL_amapgroups_contents', ' Map Preview');
define('XL_amapgroups_select', 'Selected');
define('XL_amapgroups_addmapstogroup', 'Add Maps to Mapgroup');
define('XL_amapgroups_addmapstogroup_info', 'Select the maps you want to be part of this mapgroup and save.');
define('XL_amapgroups_mapname', 'Map name');
define('XL_amapgroups_notfound', "Mapgroup Not Found");

###########################################
#Config Administration Panel
define('XL_aconfig_configfile', 'The configuration file is : ');
define('XL_aconfig_notwritable', 'Not Writeable');
define('XL_aconfig_writable', 'Writeable');
define('XL_aconfig_error', 'Sorry, unable to update the config file. You may have to update the permissions on the file to a writable state.');
define('XL_aconfig_updated', 'Successfully updated the configuration file.');

###########################################
#Challenges Administration Panel
define('XL_achallenges_title','Challenge Administration');
define('XL_achallenges_id','Id');
define('XL_achallenges_challenger','Challenger');
define('XL_achallenges_challenged','Challenged');
define('XL_achallenges_date','Date');
define('XL_achallenges_modify','Modify');
define('XL_achallenges_delete','Delete');
define('XL_achallenges_create','Create a challenge on ladder');
define('XL_achallenges_selchallenger','Select Challenger');
define('XL_achallenges_selchallenged','Select Challenged');
define('XL_achallenges_extended','Extras and Comments');
define('XL_achallenges_add','Add Challenge');
define('XL_achallenges_errblankteam1','Sorry challenger cannot be blank');
define('XL_achallenges_errblankteam2','Sorry challenged team cannot be blank');
define('XL_achallenges_errsameteams','Sorry you cant create a challenge with two identical teams');
define('XL_achallenges_added','Challenge Inserted into Database');
define('XL_achallenges_editchallenge','Edit a challenge on ladder');
define('XL_achallenges_maps1','Select Challengers Maps (First Set)');
define('XL_achallenges_maps2','Select Challenged Maps (Second Set');
define('XL_achallenges_misc','Extra Challenge Options');
define('XL_achallenges_eventid','Ladder Id');
define('XL_achallenges_matchdate','Match Date');
define('XL_achallenges_randid','Random Id');
define('XL_achallenges_setdate','Set Date');
define('XL_achallenges_extra1','Extra 1 - 255 Char Max');
define('XL_achallenges_extra2','Extra 2 - 255 Char Max');
define('XL_achallenges_comments','Comments - 255 Char Max');
define('XL_achallenges_update','Update Challenge');
define('XL_achallenges_editunconfirmed','Edit a  unconfirmed challenge on ladder:');
define('XL_achallenges_dt1','Date /Time 1');
define('XL_achallenges_dt2','Date /Time 2');
define('XL_achallenges_dt3','Date /Time 3');
define('XL_achallenges_updated','Challenge Updated');
define('XL_achallenges_deleted','Challenge Deleted');
define('XL_achallenges_confirmed', 'Un-confirmed challenges on ladder:');
define('XL_achallenges_unconfirmed', 'Confirmed challenges on ladder');
define('XL_achallenges_none', 'There are no challenges on this event');
###########################################
#Disputes Administration Panel
define('XL_adisputes_id','Id');
define('XL_adisputes_sender','Sender');
define('XL_adisputes_offender','Offender');
define('XL_adisputes_event','Laddername');
define('XL_adisputes_date','Date');
define('XL_adisputes_view', 'View');
define('XL_adisputes_delete','Delete');
define('XL_adisputes_comments','Comments:');
define('XL_adisputes_none','No Disputes Have Been Filed');

?>