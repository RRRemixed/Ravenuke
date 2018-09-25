<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))die("Not Valid Include");
###############################################################
$op = $_REQUEST[X1_actionoperator];
switch($op){
	
	case "admin":
        if(check_admin()){
			X1_require_admin();
            x1_admin('home');
        }else{
          echo XL_adminonly;
        }
	break;

	case "addgames":
        if(check_admin()){
			X1_require_admin();
            addgames();
        }else{
          echo XL_adminonly;
        }
	break;

	case "updategames":
        if(check_admin()){
			X1_require_admin();
			updategames();
		}else{
          echo XL_adminonly;
        }
	break;

	case "xadminladder":
        if(check_admin()){
			X1_require_admin();
			X1plugin_adminladder();
		}else{
          echo XL_adminonly;
        }
	break;

	case "newevent":
        if(check_admin()){
			X1_require_admin();
			newcompevent();
		}else{
          echo XL_adminonly;
        }
	break;

	case "fixladderrungs":
        if(check_admin()){
			X1_require_admin();
			fixladderrungs();
		}else{
          echo XL_adminonly;
        }
	break;

	case "editevent":
        if(check_admin()){
			X1_require_admin();
			x1_editevent();
		}else{
          echo XL_adminonly;
        }
	break;

	case "ChangeLadder":
        if(check_admin()){
			X1_require_admin();
			changeLadder();
		}else{
          echo XL_adminonly;
        }
	break;

	case "RemoveLadder":
	    if(check_admin()){
			X1_require_admin();
			removeLadder();
		}else{
          echo XL_adminonly;
        }
	break;

	case "addmaps":
	    if(check_admin()){
			X1_require_admin();
			addmaps();
		}else{
          echo XL_adminonly;
        }
	break;

	case "updatemaps":
	   if(check_admin()){
			X1_require_admin();
			updatemaps();
		}else{
          echo XL_adminonly;
        }
	break;
	
	case "addmapgroups":
	    if(check_admin()){
			X1_require_admin();
			addmapgroups();
		}else{
          echo XL_adminonly;
        }
	break;

	case "updatemapgroups":
	   if(check_admin()){
			X1_require_admin();
			updatemapgroups();
		}else{
          echo XL_adminonly;
        }
	break;
	
	case "addmapstogroup":
	    if(check_admin()){
			X1_require_admin();
			addmapstogroup();
		}else{
          echo XL_adminonly;
        }
	break;

	case "editmapgroup":
	   if(check_admin()){
			X1_require_admin();
			editmapgroup();
		}else{
          echo XL_adminonly;
        }
	break;

	case "delTeam":
	    if(check_admin()){
			X1_require_admin();
			X1_removeteam();
		}else{
          echo XL_adminonly;
        }
	break;

	case "modifyTeam":
	    if(check_admin()){
			X1_require_admin();
			modifyTeam();
		}else{
          echo XL_adminonly;
        }
	break;

	case "adminupdateteam":
	    if(check_admin()){
			X1_require_admin();
			adminupdateteam();
		}else{
          echo XL_adminonly;
        }
	break;

	case "modifyladderTeam":
	    if(check_admin()){
			X1_require_admin();
			modifyladderTeam();
		}else{
          echo XL_adminonly;
        }
	break;

	case "updateladderTeam":
	    if(check_admin()){
			X1_require_admin();
			updateladderTeam();
		}else{
          echo XL_adminonly;
        }
	break;

	case "delladderTeam":
	    if(check_admin()){
			X1_require_admin();
			X1_removeladderteam();
		}else{
          echo XL_adminonly;
        }
	break;

	case "createchallenge":
	    if(check_admin()){
			X1_require_admin();
			listchallenges();
		}else{
          echo XL_adminonly;
        }
	break;

	case "insertchallenge":
	    if(check_admin()){
			X1_require_admin();
			insertchallenge();
		}else{
          echo XL_adminonly;
        }
	break;

	case "deletechallenge":
	    if(check_admin()){	
			X1_require_admin();
			deletechallenge();
		}else{
          echo XL_adminonly;
        }
	break;

	case "editchallenge":
	    if(check_admin()){
			X1_require_admin();
			editchallenge();
		}else{
          echo XL_adminonly;
        }
	break;

	case "updatechallenge":
	    if(check_admin()){
			X1_require_admin();
			updatechallenge();
		}else{
          echo XL_adminonly;
        }
	break;

	case "deletetempchallenge":
	    if(check_admin()){
			X1_require_admin();
			deletetempchallenge();
		}else{
          echo XL_adminonly;
        }
	break;

	case "edittempchallenge":
	    if(check_admin()){
			X1_require_admin();
			edittempchallenge();
		}else{
          echo XL_adminonly;
        }
	break;

	case "updatetempchallenge":
	    if(check_admin()){
			X1_require_admin();
			updatetempchallenge();
		}else{
          echo XL_adminonly;
        }
	break;

	case "insertplayedgame":
	    if(check_admin()){
			X1_require_admin();
			insertplayedgame();
		}else{
          echo XL_adminonly;
        }
	break;

	case "createplayedgame":
	    if(check_admin()){
			X1_require_admin();
            createplayedgame();
		}else{
          echo XL_adminonly;
        }
	break;

	case "modifymatch":
	    if(check_admin()){
			X1_require_admin();
			modifymatch();
		}else{
          echo XL_adminonly;
        }
	break;

	case "delmatch":
	    if(check_admin()){
			X1_require_admin();
			X1_removematch();
		}else{
          echo XL_adminonly;
        }
	break;

	case "updatematch":
	    if(check_admin()){
			X1_require_admin();
			updatematch();
		}else{
          echo XL_adminonly;
        }
	break;

	case "deldispute":
	    if(check_admin()){
			X1_require_admin();
			X1_removedispute();
		}else{
          echo XL_adminonly;
        }
	break;
	
	case "updateconfigfile":
	    if(check_admin()){
			X1_require_admin();
			updateconfigfile();
		}else{
          echo XL_adminonly;
        }
	break;

	case "updatelangfile":
	    if(check_admin()){
			X1_require_admin();
			updatelangfile();
		}else{
          echo XL_adminonly;
        }
	break;
	
	
	### User end ###
	
	
	case "eventrules":
		require_once(X1_plugpath."/core/user/user_eventrules.php");
		eventrules();
	break;
	
	case "disputeform":
		require_once(X1_plugpath."/core/user/user_disputes.php");
		disputeform();
	break;
	
	case "dispute":
		require_once(X1_plugpath."/core/user/user_disputes.php");
		dispute();
	break;
	
	case "endteam":
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		endteam();
	break;
	
	case "activate_team":
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		X1_activate_team();
	break;
	
	case "displayteam":
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		displayteam();
	break;
	
	case "loginteam";
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		loginteam();
	break;
	
	case "logoutteam";
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		logoutteam();
	break;
	
	case "joinladderpre":
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		require_once(X1_plugpath."/core/user/user_eventhome.php");
		joinladderpre();
	break;
	
	case "joinladder":
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		joinladder();
	break;
	
	case "quitladder":
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		quitladder();
	break;
	
	case "coreupdateteam":
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		coreupdateteam();
	break;
	
	case "removemember":
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		removemember();
	break;
	
	case "updatemember":
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		updatemember();
	break;
	
	case "mailteammatch";
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		mailteam();
	break;
	
	case "challengeteamform":
		require_once(X1_plugpath."/core/user/user_eventhome.php");
		require_once(X1_plugpath."/core/user/user_challenges.php");
		challengeteamform();
	break;
	
	case "sendchallenge":
		require_once(X1_plugpath."/core/user/user_challenges.php");
		sendchallenge();
	break;
	
	case "confirmchallform":
		require_once(X1_plugpath."/core/user/user_eventhome.php");
		require_once(X1_plugpath."/core/user/user_challenges.php");
		confirmchallform();
	break;
	
	case "acceptchall":
		require_once(X1_plugpath."/core/user/user_challenges.php");
		acceptchall();
	break;
	
	case "declinechall":
		require_once(X1_plugpath."/core/user/user_challenges.php");
		declinechall();
	break;
	
	case "withdrawchall";
		require_once(X1_plugpath."/core/user/user_challenges.php");
		withdrawchall();
	break;

	case "pastmatches":
		require_once(X1_plugpath."/core/user/user_pastmatches.php");
		pastmatches();
	break;
	
	case "newmatches":
		require_once(X1_plugpath."/core/user/user_newmatches.php");
		newmatches();
	break;
	
	case "matchdetails":
		require_once(X1_plugpath."/core/user/user_matchdetails.php");
		matchdetails();
	break;
	
	case "standings":
		require_once(X1_plugpath."/core/user/user_standings.php");
		standings();
	break;
	
	case "playerprofile":
		require_once(X1_plugpath."/core/user/user_playerprofile.php");
		playerprofile();
	break;
	
	case "jointeamform":
		require_once(X1_plugpath."/core/user/user_jointeam.php");
		jointeamform();
	break;
	
	case "jointeam":
		require_once(X1_plugpath."/core/user/user_jointeam.php");
		jointeam();
	break;
	
	case "quitteamform":
		require_once(X1_plugpath."/core/user/user_quitteam.php");
		quitteamform();
	break;

	case "quitteam":
		require_once(X1_plugpath."/core/user/user_quitteam.php");
		quitteam();
	break;
	
	case "teamprofile":
		require_once(X1_plugpath."/core/user/user_teamprofile.php");
		teamprofile();
	break;
	
	case "teamlist":
		$menu_opts['Test'] = "http://google.ca";
		require_once(X1_plugpath."/core/user/user_teamlist.php");
		teamlist();
	break;
	
	case "reportform":
		require_once(X1_plugpath."/core/user/user_report.php");
		X1_reportform();
	break;
	
	case "X1_reportloss":
		require_once(X1_plugpath."/core/user/user_report.php");
		X1_reportloss();
	break;
	
	case "X1_reportdraw":
		require_once(X1_plugpath."/core/user/user_report.php");
		X1_reportdraw();
	break;
	
	case "listmaps":
		require_once(X1_plugpath."/core/user/user_mapslist.php");
		listmaps();
	break;
	
	case "ladderhome";
		require_once(X1_plugpath."/core/user/user_eventhome.php");
		require_once(X1_plugpath."/core/user/user_standings.php");
		require_once(X1_plugpath."/core/user/user_newmatches.php");
		require_once(X1_plugpath."/core/user/user_pastmatches.php");
		ladderhome();
	break;
	
	case "sendinvite";
		require_once(X1_plugpath."/core/user/user_invites.php");
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		sendinvite();
	break;
	
	case "confirminvite";
		require_once(X1_plugpath."/core/user/user_invites.php");
		confirminvite();
	break;
	
	case "acceptinvite";
		require_once(X1_plugpath."/core/user/user_invites.php");
		acceptinvite();
	break;
	
	case "declineinvite";
		require_once(X1_plugpath."/core/user/user_invites.php");
		declineinvite();
	break;
	
	case "removeinvite";
		require_once(X1_plugpath."/core/user/user_invites.php");
		require_once(X1_plugpath."/core/user/user_displayteam.php");
		removeinvite();
	break;
	
	case "createteam":
		require_once(X1_plugpath."/core/user/user_teamcreate.php");
		createteam();
	break;
	
	case "newteam":
		require_once(X1_plugpath."/core/user/user_teamcreate.php");
		newteam();
	break;
	
	case "requestpass";
		require_once(X1_plugpath."/core/user/user_teamcreate.php");
		requestpass();
	break;
	
	case "forgotpassword";
		require_once(X1_plugpath."/core/user/user_teamcreate.php");
		forgotpassword();
	break;
	
	case "transferteam":
		require_once(X1_plugpath."/core/user/user_leadership.php");
		X1_transfer_leadership();
	break;

	case "myteams":
		require_once(X1_plugpath."/core/user/user_myteams.php");
		X1_myteams();
	break;

	default:
		require_once(X1_plugpath."/core/user/user_index.php");
		X1plugin_index();
	break;
}
?>