<?php
###############################################################
##X1plugin Competition Management
##File::core-lang.php (english)
##File Version::2.5.4
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak
###############################################################
#Syswide 
define('XL_add', 'Add');
define('XL_save', 'Save');
define('XL_delete', 'Delete');
define('XL_edit','Edit');
define('XL_view','View');
define('XL_yes','Yes');
define('XL_no','No');
define('XL_ok','Ok');
define('XL_na','n/a');
define('XL_missingfile','Error:Missing File or undefined configuration variable.');
define('XL_notlogggedin','Error:Please login to use this feature.');
define('XL_adminonly','<center>Sorry, Administrators Only.</center>');
define('XL_teamadmin_activating', 'Please wait while we activate your team');
###########################################
# Select Boxes
define('XL_select_event','Select Ladder');
define('XL_select_team','Select Team');
define('XL_select_map', 'Select Map');
define('XL_select_game','Select Game');
define('XL_select_user','Select User');

###########################################
# Emails
define('X1_emailsubject','Attention user!');

###########################################
# Core Index Page
define('XL_index_title','Welcome to our competition site.');
define('XL_index_none','No events have been created yet, please check back later.');
define('XL_index_mod','Competition Type :: ');
define('XL_index_teams','Curent Teams :: ');
define('XL_index_matches','Played Games :: ');
define('XL_index_challenges','Confirmed Challenges :: ');
define('XL_index_image','Image');
define('XL_index_events','Events');
###########################################

# Team Profile Page
define('XL_teamprofile_noteam','The team you requested could not be found. It may have been removed or there could be errors contacting the database.');
define('XL_teamprofile_noprofile','This Team has not entered a profile yet.');
define('XL_teamprofile_title','Team Profile: ');
define('XL_teamprofile_tprofile','Profile');
define('XL_teamprofile_troster','Roster');
define('XL_teamprofile_tevents','Events');
define('XL_teamprofile_thistory','History');
define('XL_teamprofile_logo','Team Logo');
define('XL_teamprofile_name','Team Name');
define('XL_teamprofile_homepage','Homepage');
define('XL_teamprofile_location','Location');
define('XL_teamprofile_mail','Mail');
define('XL_teamprofile_captain','Captain');
define('XL_teamprofile_contact','Captain Contact');
define('XL_teamprofile_moto','Team Moto/Profile');
define('XL_teamprofile_report','Report this profile');
define('XL_teamprofile_husername','Username');
define('XL_teamprofile_hcontact','Contact');
define('XL_teamprofile_hjoindate','Joindate');
define('XL_teamprofile_hextras','Extras');
define('XL_teamprofile_nomembers','This team has no members.');
define('XL_teamprofile_hid','Id');
define('XL_teamprofile_hevent','Event');
define('XL_teamprofile_spacer','|');
define('XL_teamprofile_tgp','TGP');
define('XL_teamprofile_tw','TW');
define('XL_teamprofile_tl','TL');
define('XL_teamprofile_td','TD');
define('XL_teamprofile_tp','TP');
define('XL_teamprofile_gp','GP');
define('XL_teamprofile_w','W');
define('XL_teamprofile_l','L');
define('XL_teamprofile_d','D');
define('XL_teamprofile_p','P');
define('XL_teamprofile_noevents','This team has not joined any events.');
define('XL_teamprofile_hwinner','Winner');
define('XL_teamprofile_hloser','Loser');
define('XL_teamprofile_hdate','Date');
define('XL_teamprofile_hdetails','Details');
define('XL_teamprofile_details','Details');
define('XL_teamprofile_nomatches','This team has not played in any matches.');
define('XL_teamprofile_recruiting','Recruiting:');
###########################################
# Team List Page
define('XL_teamlist_title','Teamlist');
define('XL_teamlist_hcountry','Country');
define('XL_teamlist_hname','Name');
define('XL_teamlist_hcontact','Contact');
define('XL_teamlist_hmembers','Members');
define('XL_teamlist_hevents','Events');
define('XL_teamlist_recruiting', 'Recruiting');
define('XL_teamlist_prev','Prev');
define('XL_teamlist_next','Next');


###########################################
# Team Create Page
define('XL_teamcreate_logintocreate','Please login to create a team');
define('XL_teamcreate_title','Create a new team');
define('XL_teamcreate_name','Team Name');
define('XL_teamcreate_tags','Team Tags');
define('XL_teamcreate_email','Team Email');
define('XL_teamcreate_homepage','Team Homepage');
define('XL_teamcreate_pass1','Team Admin Password');
define('XL_teamcreate_pass2','Team Admin Password Confirm');
define('XL_teamcreate_jpass1','Team Join Password');
define('XL_teamcreate_jpass2','Team Join Password Confirm');
define('XL_teamcreate_location','Team Main Location');
define('XL_teamcreate_newteam','Create New Team');
define('XL_teamcreate_blankname','Team name cannot be blank.');
define('XL_teamcreate_invalidfeed','Invalid characters in team name.');
define('XL_teamcreate_blankpass','Password cannot be blank.');
define('XL_teamcreate_dupepass','Admin password cannot be the same as the join password.');
define('XL_teamcreate_blankjpass','Join password cannot be blank.');
define('XL_teamcreate_blankemail','Please enter a email address.');
define('XL_teamcreate_blanktags','Please enter clantags or team initials.');
define('XL_teamcreate_passnomatch','Admin passwords do not match, please confirm again.');
define('XL_teamcreate_jpassnomatch','Join passwords do not match, please confirm again.');
define('XL_teamcreate_blankcountry','Country is not set.');
define('XL_teamcreate_toomanyteams','You have created too many teams.');
define('XL_teamcreate_dupeteam','This Allready Team Exsists!');
define('XL_teamcreate_created','Team Created, you can now login.');
define('XL_teamcreate_requestpass','Request password');
define('XL_teamcreate_sendrequest','Send Request');
define('XL_teamcreate_emailoff','Server emails are disabled , please contact and admin to have your password reset.');
define('XL_teamcreate_reset','Password Reset');
define('XL_teamcreate_emptyuser','Please Login');
define('XL_teamcreate_enteremail', 'Please enter the email address for your teams(s)');
define('XL_teamcreate_noteam','Cant find that email');
###########################################

# Team Report Page
define('XL_teamreport_title','Report a match');
define('XL_teamreport_previous','View Previous Matches');
define('XL_teamreport_event','Event Name');
define('XL_teamreport_opponent','Opponent Name');
define('XL_teamreport_you','Your Team');
define('XL_teamreport_mapsandscores','Maps and Scores');
define('XL_teamreport_comments','Match Comments');
define('XL_teamreport_textarea','Please keep it clean.');
define('XL_teamreport_textarea2','255 characters max.');
define('XL_teamreport_demolink','Demo or Video Link');
define('XL_teamreport_screenlink1','Screenshot Link');
define('XL_teamreport_screenlink2','Screenshot Link');
define('XL_teamreport_report','Report');
define('XL_teamreport_rules','Rules ::');
define('XL_teamreport_loss',' Loss');
define('XL_teamreport_draw','Draw');
#2.5.4
define('XL_teamreport_win','Win');
#
define('XL_teamreport_blankwinner','Unknown Team');
define('XL_teamreport_blankloser','Unknown Team');
define('XL_teamreport_notactive','This event is disabled');
define('XL_teamreport_disabled','Challenges have been disabled');
define('XL_teamreport_playwithself','Stop Playing with yourself!');
define('XL_teamreport_gamesmaxday','You have played too many games on this event today.');
define('XL_teamreport_emailloss','Loss Recorded');
define('XL_teamreport_emailwin','Win Recorded');
define('XL_teamreport_emaildraw','Draw Recorded');

###########################################

# Team Quit Page
define('XL_teamquit_login','Please login to quit a team.');
define('XL_teamquit_title','Quit a team.');
define('XL_teamquit_header','Select a team to remove yourself from.');
define('XL_teamquit_username','Username');
define('XL_teamquit_team','Select Team');
define('XL_teamquit_button','Quit Team');
define('XL_teamquit_none','You were not found on this team. You may have been removed allready.');
define('XL_teamquit_removed','You have been removed from team :');

###########################################

# Player Profile Page
define('XL_playerprofile_title','Player Profile');
define('XL_playerprofile_homepage','Homepage:');
define('XL_playerprofile_location','Location:');
define('XL_playerprofile_contact','Contact Information:');
define('XL_playerprofile_reg','Registration:');
define('XL_playerprofile_missing','Player has been removed or you entered thier name wrong.');
define('XL_playerprofile_id','Id');
define('XL_playerprofile_country','Country');
define('XL_playerprofile_team','Team');
define('XL_playerprofile_tags','Tags');
define('XL_playerprofile_mail','Captain Mail');
define('XL_playerprofile_none','There are no members on this roster');
define('XL_playerprofile_joinedteams','Joined Teams');
###########################################

# Match History Page
define('XL_matchhistory_title','Match History');
define('XL_matchhistory_id','Id');
define('XL_matchhistory_winner','Winner');
define('XL_matchhistory_loser','Loser');
define('XL_matchhistory_date','Date');
define('XL_matchhistory_draw', 'Draw');
define('XL_matchhistory_details','Details');
define('XL_matchhistory_button','View');
define('XL_matchhistory_none','There are no previous matches');

###########################################
# Match History Page
define('XL_matchpreview_title','Match Preview');
define('XL_matchpreview_date','Date');
define('XL_matchpreview_challenger','Challenger');
define('XL_matchpreview_challenged','Challenged');
define('XL_matchpreview_matchdate','MatchDate');
define('XL_matchpreview_none','There are no pending matches');

###########################################
# Match Information Page
define('XL_matchinfo_title','Match Information');
define('XL_matchinfo_nodemo','No Demo Avaliable');
define('XL_matchinfo_demo','Download Demo');
define('XL_matchinfo_event','Event');
define('XL_matchinfo_winner','Winner');
define('XL_matchinfo_loser','Loser');
define('XL_matchinfo_date','Date');
define('XL_matchinfo_comments','Comments');
define('XL_matchinfo_mapimage','Map Image');
define('XL_matchinfo_mapname','Map Name');
define('XL_matchinfo_notfound','<center>This match id no longer exsists</center>');
define('XL_matchinfo_screen1','ScreenShot');
define('XL_matchinfo_screen2','ScreenShot');
define('XL_matchinfo_noscreen','No ScreenShot Posted');
define('XL_matchinfo_gamewasdraw', 'This match was a determined to be a draw');
###########################################
# Maps Listing Page
define('XL_maplist_title','Maps list for: ');
define('XL_maplist_image','Image');
define('XL_maplist_name','Name');
define('XL_maplist_download','Download');
define('XL_maplist_nodownload','No Download Avaliable');
define('XL_maplist_none','No maps have been added to this event.');


###########################################
# Event Home Page
define('XL_eventhome_viewtitle','Viewing Options');
define('XL_eventhome_mapsbutton','View Maps');
define('XL_eventhome_standingsbutton','View Standings');
define('XL_eventhome_viewhistory','View History');
define('XL_eventhome_newmatches','Pending Matches');
define('XL_eventhome_pastmatches','Match History');
define('XL_eventhome_settings','Event Settings');
define('XL_eventhome_viewrules', 'View Rules');

###########################################
# Event Rules Page
define('XL_eventrules_title','View Rules for the event.');
define('XL_eventrules_none','No rules have been posted, check back later');


###########################################
# Event Settings
define('XL_eventhome_active','Active');
define('XL_eventhome_enabled','Enabled');
define('XL_eventhome_timezone','Timezone');
define('XL_eventhome_numdates','Number of date selections');
define('XL_eventhome_dupedates','Duplicate dates?');
define('XL_eventhome_maps1','Challenger Maps');
define('XL_eventhome_maps2','Challenged maps');
define('XL_eventhome_dupemaps','Duplicate maps?');
define('XL_eventhome_pointswin','Points for a win');
define('XL_eventhome_pointsloss','Points for a loss');
define('XL_eventhome_pointsdraw','Points for a draw');
define('XL_eventhome_pointsdecline','Points subtracted for declining a challenge');
define('XL_eventhome_gamesday','Games per day limit');
define('XL_eventhome_challlimit','Challenge limit');
define('XL_eventhome_timeout','Challenge Timeout');
define('XL_eventhome_maxteams','Team limit');
define('XL_eventhome_rostermin','Roster minnimum');

###########################################
# Team Join Page
define('XL_teamjoin_title','Join a team.');
define('XL_teamjoin_header','Select a team to join.');
define('XL_teamjoin_username','Username');
define('XL_teamjoin_team','Select Team');
define('XL_teamjoin_password','Teams join password');
define('XL_teamjoin_joinbutton','Join Team');
define('XL_teamjoin_none','Team does not exsist or the password was wrong.');
define('XL_teamjoin_login','Please login to join a team');
define('XL_teamjoin_dupe','You are allready a member of this team');
define('XL_teamjoin_limit','You are a member of too many teams.');
define('XL_teamjoin_joined','You have joined the team: ');

##########################################
# Team Invites Page
define('XL_teaminvites_title','Confirm invitation');
define('XL_teaminvites_limit','This user is a member of too many teams allready.');
define('XL_teaminvites_sent','Invite Sent');
define('XL_teaminvites_accept','Accept Invite');
define('XL_teaminvites_decline','Decline Invite');
define('XL_teaminvites_button','Ok');
define('XL_teaminvites_none','Invite does not exsist.');
define('XL_teaminvites_youlimit','You are allready a member of too many teams.');
define('XL_teaminvites_accepted','Invite accepted');
define('XL_teaminvites_declined','Invite declined');
define('XL_teaminvites_removed','Invite removed');
define('XL_teaminvites_enterid', 'Please enter the id sent in the confirmation email');
define('XL_teaminvites_allreadyonroster','This user is allready on your roster, please choose another user.');
define('XL_teaminvites_allreadyinvited','This user is allready on your invite list, please choose another user.');

###########################################
# Team Disputes
define('XL_teamdisputes_filedispute','File Dispute');
define('XL_teamdisputes_winner','Winner');
define('XL_teamdisputes_loser','Loser');
define('XL_teamdisputes_event','Event');
define('XL_teamdisputes_comments','Comments');
define('XL_teamdisputes_button','Send');
define('XL_teamdisputes_error','Error');
define('XL_teamdisputes_submitted','Dispute Submitted');

###########################################
# Team Admin Actions
define('XL_teamadmina_teamupdated','Team Updated');
define('XL_teamadmina_passupdated','<br />Password Changed');
define('XL_teamadmina_noeventsel','No Event Selected');
define('XL_teamadmina_noevent','Event doesnt exsist');
define('XL_teamadmina_joinevent','Join event :');
define('XL_teamadmina_joininfo1','Join Information');
define('XL_teamadmina_joininfo2','Join Information 2');
define('XL_teamadmina_joinmaxplayers','Your team has too many members on its roster for this event.');
define('XL_teamadmina_joinminplayers','Your team does not have enough members on its roster for this event.');
define('XL_teamadmina_captainonly','You must be a captain to remove a team.');
define('XL_teamadmina_teamremoved','Team removed.');
define('XL_teamadmina_memberremoved','Member Removed');
define('XL_teamadmina_memberupdated','Member Updated');
define('XL_teamadmin_msgsent','Notifications have been sent to :');

###########################################
# Team Admin Page
define('XL_teamadmin_loggingout','You have been logged out.');
define('XL_teamadmin_errorlogin','Error logging in.');
define('XL_teamadmin_badpass','Failed password check');
define('XL_teamadmin_loggingin','Logging you in, please wait.');
define('XL_teamadmin_title','Team Administration: ');
define('XL_teamadmin_profile','Profile');
define('XL_teamadmin_roster','Roster');
define('XL_teamadmin_invites','Invites');
define('XL_teamadmin_events','Events');
define('XL_teamadmin_matches','Matches');
define('XL_teamadmin_history','History');
define('XL_teamadmin_quit','Quit');
define('XL_teamadmin_teamname','Team Name');
define('XL_teamadmin_teamtags','Team Tags');
define('XL_teamadmin_adminpass','Admin Password');
define('XL_teamadmin_joinpass','Join Password');
define('XL_teamadmin_homepage','Team Webpage');
define('XL_teamadmin_logo','Clan Logo');
define('XL_teamadmin_ircchannel','Irc Channel');
define('XL_teamadmin_ircserver','Irc Server');
define('XL_teamadmin_captaininfo','Captain Information');
define('XL_teamadmin_captain','Captain');
define('XL_teamadmin_mail','Email');
define('XL_teamadmin_country','Country');
define('XL_teamadmin_profilemoto','Profile/Moto');
define('XL_teamadmin_recruiting','Recruiting');
define('XL_teamadmin_update','Update Information');
define('XL_teamadmin_rosterusername','Username');
define('XL_teamadmin_rostercontact','Contact');
define('XL_teamadmin_rosterjoindate','Joindate');
define('XL_teamadmin_rosterextra','Extra');
define('XL_teamadmin_rostermodify','Modify');
define('XL_teamadmin_rosterupdate','Update');
define('XL_teamadmin_resterremove','Remove');
define('XL_teamadmin_rosterbut','Ok');
define('XL_teamadmin_invname','Invite Name');
define('XL_teamadmin_invcontact','Contact Info');
define('XL_teamadmin_invcancel','Cancel Invite');
define('XL_teamadmin_invcancelbut','Cancel');
define('XL_teamadmin_invnone','No Pending Invitations');
define('XL_teamadmin_invuser','Invite User');
define('XL_teamadmin_challnew','Start New Challenge');
define('XL_teamadmin_challchallenger','Challenger');
define('XL_teamadmin_challchallenged','Challenged');
define('XL_teamadmin_challcontact','Contact');
define('XL_teamadmin_challevent','Event');
define('XL_teamadmin_challdate','Date');
define('XL_teamadmin_challconfirm','Confirm');
define('XL_teamadmin_challstatus','Status');
define('XL_teamadmin_challwidthdraw','Withdraw');
define('XL_teamadmin_challnone','No challenges');
define('XL_teamadmin_challmaps','Map Picks');
define('XL_teamadmin_challcomments','Challenge Comments');
define('XL_teamadmin_challreportwin','Report Win');
define('XL_teamadmin_challreportloss','Report Loss');
define('XL_teamadmin_challreportdraw','Report Draw');
define('XL_teamadmin_challnotify','Notify Roster');
define('XL_teamadmin_challdispute','Dispute Match');
define('XL_teamadmin_eventsid','Id');
define('XL_teamadmin_eventsname','Event');
define('XL_teamadmin_eventsspace','|');
define('XL_teamadmin_eventstgp','TGP');
define('XL_teamadmin_eventstw','TW');
define('XL_teamadmin_eventstl','TL');
define('XL_teamadmin_eventstd', 'TD');
define('XL_teamadmin_eventstp','TP');
define('XL_teamadmin_eventsgp','GP');
define('XL_teamadmin_eventsw','W');
define('XL_teamadmin_eventsl','L');
define('XL_teamadmin_eventsd', 'D');
define('XL_teamadmin_eventsp','P');
define('XL_teamadmin_eventsquit','Quit');
define('XL_teamadmin_eventsbut','Quit');
define('XL_teamadmin_eventsnone','You have not joined any events.');
define('XL_teamadmin_eventsjoin','Join Event.');
define('XL_teamadmin_nosetmatches', 'No Matches have been confirmed');
define('XL_teamadmin_matchcontact', 'Contact Information');
define('XL_teamadmin_matchcomments', 'Comments');
define('XL_teamadmin_matchmappicks', 'Map Picks');
define('XL_teamadmin_matchchallenger', 'Challenger');
define('XL_teamadmin_matchchallenged', 'Challenged');
define('XL_teamadmin_matchevent', 'Event');
define('XL_teamadmin_matchdate', 'Date');
define('XL_teamadmin_matchesid','Id');
define('XL_teamadmin_matchesevent','Event');
define('XL_teamadmin_matcheswinner','Winner');
define('XL_teamadmin_matchesloser','Loser');
define('XL_teamadmin_matchesdate','Date');
define('XL_teamadmin_matchesdetails','Details');
define('XL_teamadmin_matchesnone','You have not played any matches.');
define('XL_teamadmin_removeteam','Team Removal');
define('XL_teamadmin_removeteamwarming','You cannot get your team back. Once its gone its gone.');
define('XL_teamadmin_removeteambut','Yes, Remove My Team!');
define('XL_teamadmin_challengetitle','Accept - Decline Challenge Menu');
define('XL_teamadmin_transferteam','Team Captain Tranfer');
define('XL_teamadmin_transferteamwarming','Select a user to transfer the team to.');
define('XL_teamadmin_transferteambut','Yes, Transfer My Team!');
###########################################
# Challenges
define('XL_challenges_selectevent','Select Event to challenge on.');
define('XL_challenges_continue','Continue');
define('XL_challenges_notenabled','Event not enabled');
define('XL_challenges_challengeteam','Challenge a team.');
define('XL_challenges_event','Event');
define('XL_challenges_yourteam','Your Team');
define('XL_challenges_otherteam','Other Team');
define('XL_challenges_selectdates','Select Dates');
define('XL_challenges_selectmaps','Select Maps');
define('XL_challenges_addedinfo','Added Information');
define('XL_challenges_declinechall','Decline Challenge');
define('XL_challenges_warning',' point(s) are subtracted for decling a challenge');
define('XL_challenges_vs','Vs');
define('XL_challenges_selectdate','Select Date.');
define('XL_challenges_challengermaps','Challengers Maps');
define('XL_challenges_yourmaps','Your Maps');
define('XL_challenges_comments','Comments');
define('XL_challenges_followup','Followup');
define('XL_challenges_acceptchalenge','Accept Challenege');
define('XL_challenges_notfound','Challenge Not Found');
define('XL_challenges_allreadychallenged', 'This team has allready been challenged.');
define('XL_challenges_gamesmaxday', 'Past the games limit for today.');
define('XL_challenges_notactive', 'This event is not active');
define('XL_challenges_disabled', 'Challenged are not enabled');
define('XL_challenges_playwithself', 'Stop Playing with yourself');
define('XL_teamadmin_ChallengeTitle', 'Confirm a challenge');
define('XL_challenges_datesrestricted', 'You cannot select a date more than once, please try again.');
define('XL_mapsrestricted', "You cannot select a map more than once, please try again.");
#Expired
define('XL_challenges_expired','Challenge Expired');
###########################################
#My Teams
define('XL_myteams_title','Select a team to activate.');
define('XL_myteams_loc','Loc');
define('XL_myteams_team','Team Name');
define('XL_myteams_captain','Captain');
define('XL_myteams_members','Members');
define('XL_myteams_events','Events');
define('XL_myteams_recruiting','Recruiting');
define('XL_myteams_active','Active');
define('XL_myteams_notloggedin','You must be logged in to activate teams.');
define('XL_myteams_noteams','You dont have any teams, click here to create one.');

?>