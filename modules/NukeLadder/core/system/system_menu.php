<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################

# Thanks to Steve Gibson, his newgroups and all the sources that made this menu possible!
# Http://www.grc.com

function Gibson_Menu(){
	global $menu_opts;
	global $xdb;
	$team_info = cookieread();
	$tn = (empty($team_info[1])) ? "Nothing Active" : "Active:".$team_info[1];
	$is_admin = check_admin();
	$c = '
	<link rel="stylesheet" media="all" type="text/css" href="'.X1_csspath.'/menu.css" />
	<!-- 
	########################## GRC Menu ########################## 
	# Thanks to Steve Gibson, his newgroups and all the sources that 
	# made this menu possible! http://www.grc.com
	########################## GRC Menu ########################## 
	-->
	<div class="menuminwidth0">
		<div class="menuminwidth1">
			<div class="menuminwidth2">
				<div class="menu">
				<ul class="rightmenu">';
				if($is_admin){
					#Admin button and Menu
					$c .='
						<li><a href="nukeladder.php?op=admin">
						<img src="'.X1_imgpath.'/menu/admin.gif" width="76" height="18" alt="[OpenVPN]" title="" border="0"/>
						<!--[if gt IE 6]><!--></a><!--<![endif]--><!--[if lt IE 7]>
						<table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
							<ul>
								<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=home">&nbsp;Home</a></li>
								<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=games">&nbsp;Games</a></li>
								<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=events">&nbsp;Events</a></li>
								<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=maps">&nbsp;Maps</a></li>
								<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=mapgroups">&nbsp;Map Groups</a></li>
								<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=teams">&nbsp;Teams</a></li>
								<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=matches">&nbsp;Matches</a></li>
								<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=challenges">&nbsp;Challenges</a></li>
								<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=disputes">&nbsp;Disputes</a></li>';
								
					if(X1_useconfigpanel)$c .='<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=admin&panel=config">&nbsp;Config</a></li>';
					$c .='
							</ul>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul>';
				}else{
					#Help Button and Menu
					$c .='
						<li><a href="/default.htm"><img src="'.X1_imgpath.'/menu/help.gif" width="76" height="18" alt="[OpenVPN]" title="" border="0"/>
						<!--[if gt IE 6]><!--></a><!--<![endif]--><!--[if lt IE 7]>
						<table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
							<ul>
								<li><a href="http://www.pxn.ca/Wiki">&nbsp;NukeLadder Wiki</a></li>
								<li><a href="http://www.pxn.ca/Forum">&nbsp;NukeLadder Forums</a></li>
							</ul>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul>';
				}
					
				#Teams Menu
				$c .='
				<ul>
					<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=teamlist">
					<img src="'.X1_imgpath.'/menu/teams.gif" width="76" height="18" alt="[Teams]" title="" border="0"/>
					<!--[if gt IE 6]><!--></a><!--<![endif]--><!--[if lt IE 7]>
					<table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
						<ul class="skinny">
							<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=myteams"><span class="drop"><span>My Teams</span>&raquo;</span><!--[if gt IE 6]><!--></a><!--<![endif]--><!--[if lt IE 7]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
								<ul >';
								$user = X1_userdetails();
								if($user){
									$teams = $xdb->GetAll("SELECT * 
									FROM ".X1_prefix.X1_DB_teams." 
									WHERE playerone=".$xdb->qstr($user[1]));
									$teamx[] = array();
									$i=0;
									foreach($teams AS $team){
										$c .="<li><a href='".X1_publicgetfile."?".X1_linkactionoperator."=activate_team&amp;t=$team[team_id]'>&nbsp;$team[name]</a></li>";
										$teamx[] = $team['team_id'];
										$i++;
									}
									$rows = $xdb->GetAll("
									SELECT * FROM ".X1_prefix.X1_DB_teamroster." 
									WHERE uid =".$xdb->qstr($user[0])." 
									AND cocaptain=1;");
									if($rows){
										foreach($rows AS $row){
											if(!in_array($row['team_id'], $teamx)){
												$team = $xdb->GetRow("SELECT team_id, name 
												FROM ".X1_prefix.X1_DB_teams." 
												WHERE team_id=".$xdb->qstr($row['team_id']));
												$c .="<li><a href='".X1_publicgetfile."?".X1_linkactionoperator."=activate_team&amp;t=$team[team_id]'>&nbsp;$team[name]</a></li>";
												$i++;
											}
										}
									}
									if($i==0)$c .="<li><a href='".X1_publicgetfile."?".X1_linkactionoperator."=createteam'>&nbsp;You have no teams</a></li>\n";
								}else{
									$c .="<li><a href='".X1_publicgetfile."?".X1_linkactionoperator."=createteam'>&nbsp;You have no teams</a></li>\n";
								}
								$c .='</ul>
								<!--[if lte IE 6]></td></tr></table></a><![endif]-->
							</li>
							<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=createteam">&nbsp;New Team</a>
							<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=jointeamform">&nbsp;Join Team</a>
							<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=quitteamform">&nbsp;Quit Team</a>
							<li><a href="'.X1_publicgetfile.'?'.X1_linkactionoperator.'=teamlist">&nbsp;Team List</a>
						</ul>
						<!--[if lte IE 6]></td></tr></table></a><![endif]-->
					</li>
				</ul>';
				
				#Events
				$games = $xdb->GetAll("select * from ".X1_prefix.X1_DB_games." ORDER BY gametext");
				
				$c .='
				<ul class="skinny">
					<li><a href="nukeladder.php"><img src="'.X1_imgpath.'/menu/events.gif" width="76" height="18" alt="[Events]" title="" border="0"/><!--[if gt IE 6]><!--></a><!--<![endif]--><!--[if lt IE 7]>
					<table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
						<ul class="skinny">';
							foreach($games AS $game){
								$c .='<li><a href="'.X1_publicgetfile.'&amp;game='.$game[0].'"><span class="drop"><span>'.$game[1].'</span>&raquo;
								</span><!--[if gt IE 6]><!--></a><!--<![endif]--><!--[if lt IE 7]>
								<table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
									<ul>';
									$events = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_events." 
									WHERE game=".$xdb->qstr($game['gameid'])." ORDER BY sid DESC");
									if ($events) {
										foreach($events As $event) {
											$c .="<li><a href='".X1_publicgetfile."?".X1_linkactionoperator."=ladderhome&sid=$event[sid]'>&nbsp;$event[title]</a></li>";
										}
									}else {
										$c .="<li><a href='#'>".XL_index_none."</a></li>";
									}
									$c .='</ul>
									<!--[if lte IE 6]></td></tr></table></a><![endif]-->
								</li>';
							}
						$c .='</ul>
					<!--[if lte IE 6]></td></tr></table></a><![endif]-->
					</li>
				</ul>';
				if(is_array($menu_opts)){
					$c .='
					<ul>
						<li><a href="/default.htm"><img src="'.X1_imgpath.'/menu/options.gif" width="76" height="18" alt="[Test]" title="" border="0"/><!--[if gt IE 6]><!--></a><!--<![endif]--><!--[if lt IE 7]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
							<ul class="skinny">';
							
					foreach($menu_opts AS $title => $url){
						if(is_array($url)){
							$c .='<li><a href="#"><span class="drop"><span>'.$title.'</span>&raquo;</span><!--[if gt IE 6]><!--></a><!--<![endif]--><!--[if lt IE 7]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
								<ul>';
							foreach($url AS $stitle => $surl){
								$c .='<li><a href="'.$surl.'">&nbsp;'.$stitle.'</a>';
							}
							$c .='</ul>
								<!--[if lte IE 6]></td></tr></table></a><![endif]-->
							</li>';
						}else{
							$c .='<li><a href="'.$url.'">&nbsp;'.$title.'</a>';
						}
					}
					$c .='</ul>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
					</ul>';
				}
				$c .='</div> <!-- close "menu" div -->
			</div>
		</div>
	</div> 
	<!-- close the "minwidth" wrappers -->
	<!-- ###################### END OF GRC MASTHEAD MENU  ###################### -->';
	return $c;
}



//Re-usable Menus

//Display Team
function X1_menu_displayteam(){
	global $xdb;
	list ($cookieteamid, $cookieteam, $password2) = cookieread();	
	$user_info = X1_userdetails();
	
	$row = $xdb->GetRow("
    SELECT playerone 
    FROM ".X1_prefix.X1_DB_teams."
    WHERE team_id =".$xdb->qstr($cookieteamid));  
	$iscaptain = ($row['playerone'] == $user_info[1]) ? true : false;

	$menu_opts[XL_teamadmin_profile] = "javascript:x1showPanel('panel1');";
	$menu_opts[XL_teamadmin_roster]  = "javascript:x1showPanel('panel2');";
	$menu_opts[XL_teamadmin_invites] = "javascript:x1showPanel('panel3');";
	$menu_opts[XL_teamadmin_events]  = "javascript:x1showPanel('panel4');";
	$menu_opts[XL_teamadmin_matches] = "javascript:x1showPanel('panel5');";
	$menu_opts[XL_teamadmin_history] = "javascript:x1showPanel('panel6');";
	if($iscaptain)$menu_opts[XL_teamadmin_quit] = "javascript:x1showPanel('panel7');";
	return $menu_opts;
}


//Admin Menu
function X1_menu_adminpanel(){
	$menu_opts[XL_tab_help]       = "javascript:x1showPanel('panel1');";
	$menu_opts[XL_tab_games]      = "javascript:x1showPanel('panel2');";
	$menu_opts[XL_tab_events]     = "javascript:x1showPanel('panel4');";
	$menu_opts[XL_tab_maps]       = "javascript:x1showPanel('panel5');";
	$menu_opts[XL_tab_mapgroups]  = "javascript:x1showPanel('panel10');";
	$menu_opts[XL_tab_teams]      = "javascript:x1showPanel('panel3');";
	$menu_opts[XL_tab_challenges] = "javascript:x1showPanel('panel7');";
	$menu_opts[XL_tab_matches]    = "javascript:x1showPanel('panel6');";
	$menu_opts[XL_tab_disputes]   = "javascript:x1showPanel('panel8');";
	if(X1_useconfigpanel)$menu_opts[XL_tab_config] = "javascript:x1showPanel('panel9');";
	return $menu_opts;
}




$is_admin = check_admin();
switch($op){

	### User end ###
	case "eventrules":

	break;
	
	case "disputeform":

	break;
	
	case "dispute":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "endteam":
	
	break;
	
	case "activate_team":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "displayteam":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "loginteam";

	break;
	
	case "logoutteam";

	break;
	
	case "joinladderpre":

	break;
	
	case "joinladder":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "quitladder":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "coreupdateteam":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "removemember":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "updatesteamid":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "mailteammatch";
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "challengeteamform":

	break;
	
	case "sendchallenge":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "confirmchallform":

	break;
	
	case "acceptchall":

	break;
	
	case "declinechall":

	break;
	
	case "withdrawchall";
		$menu_opts = X1_menu_displayteam();
	break;

	case "pastmatches":

	break;
	
	case "newmatches":

	break;
	
	case "matchdetails":

	break;
	
	case "standings":

	break;
	
	case "playerprofile":

	break;
	
	case "jointeamform":

	break;
	
	case "jointeam":

	break;
	
	case "quitteamform":

	break;

	case "quitteam":

	break;
	
	case "teamprofile":
		$menu_opts[XL_teamprofile_tprofile] = "javascript:x1showPanel('panel1');";
		$menu_opts[XL_teamprofile_troster] = "javascript:x1showPanel('panel2');";
		$menu_opts[XL_teamprofile_tevents] = "javascript:x1showPanel('panel3');";
		$menu_opts[XL_teamprofile_thistory] = "javascript:x1showPanel('panel4');";
	break;
	
	case "teamlist":
		$menu_opts['Show']['10'] = X1_publicgetfile."?".X1_linkactionoperator."=teamlist&limit=10";
		$menu_opts['Show']['25'] = X1_publicgetfile."?".X1_linkactionoperator."=teamlist&limit=25";
		$menu_opts['Show']['50'] = X1_publicgetfile."?".X1_linkactionoperator."=teamlist&limit=50";
		$menu_opts['Show']['100'] = X1_publicgetfile."?".X1_linkactionoperator."=teamlist&limit=100";
	break;
	
	case "reportform":
		
	break;
	
	case "reportloss":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "reportdraw":
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "listmaps":

	break;
	
	case "ladderhome";

	break;
	
	case "sendinvite";
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "confirminvite";

	break;
	
	case "acceptinvite";

	break;
	
	case "declineinvite";

	break;
	
	case "removeinvite";
		$menu_opts = X1_menu_displayteam();
	break;
	
	case "createteam":

	break;
	
	case "newteam":

	break;
	
	case "requestpass";

	break;
	
	case "forgotpassword";

	break;

	
	## ADMIN
	
	case "admin":
        if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "addgames":
        if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "updategames":
        if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "xadminladder":
        if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "newevent":
        if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "fixladderrungs":
       if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "editevent":
        if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "ChangeLadder":
        if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "RemoveLadder":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "addmaps":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "updatemaps":
	   if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;
	
	case "addmapgroups":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "updatemapgroups":
	   if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;
	
	case "addmapstogroup":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "editmapgroup":
	   if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "delTeam":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "modifyTeam":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "adminupdateteam":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "modifyladderTeam":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "updateladderTeam":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "delladderTeam":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "createchallenge":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "insertchallenge":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "deletechallenge":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "editchallenge":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "updatechallenge":
	   if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "deletetempchallenge":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "edittempchallenge":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "updatetempchallenge":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "insertplayedgame":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "createplayedgame":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "modifymatch":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "delmatch":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "updatematch":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "deldispute":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;
	
	case "updateconfigfile":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;

	case "updatelangfile":
	    if($is_admin)$menu_opts = X1_menu_adminpanel();
	break;
	
	default:
	
	break;
}
echo Gibson_Menu();
?>