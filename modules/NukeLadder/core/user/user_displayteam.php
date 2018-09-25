<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include')){
	die ("You cannot load this file outfile of X1plugin");
	}
###############################################################
function X1_activate_team(){
	$team_info = cookieread();
	if($team_info[0] === $_REQUEST['t'])return displayteam();
	X1_setlogin($_REQUEST['t']);
	$c  = X1plugin_style();
	$c .= "<meta http-equiv='refresh' content='".X1_refreshtime.";URL=".X1_publicgetfile."?".X1_linkactionoperator."=displayteam'>";	
	$c .= X1plugin_title("<a href='".X1_publicgetfile."?".X1_linkactionoperator."=displayteam'>".XL_teamadmin_activating."</a>");	
	return X1plugin_output($c);
}

function displayteam($panel='home', $msg=''){
	global $xdb;	
	$c  = X1plugin_style();
	$c .= "<script type='text/javascript' >
	var panels = new Array('panel1', 'panel2', 'panel3', 'panel4', 'panel5', 'panel6', 'panel7');
	function x1showPanel(name){
		for(i = 0; i < panels.length; i++){
			document.getElementById(panels[i]).style.display = (name == panels[i]) ? 'block':'none';
		}
	}
	</script>\n";
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));	
	if(!empty($msg))$c .= X1plugin_title($msg);
	list ($cookieteamid, $cookieteam, $password2) = cookieread();	
	if(!isset($cookieteam))return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));	
	$user_info = X1_userdetails();
	
	$row = $xdb->GetRow("
    SELECT passworddb, team_id, name, playerone
    FROM ".X1_prefix.X1_DB_teams."
    WHERE team_id =".$xdb->qstr($cookieteamid));  
	  
	$xdbpass = $row['passworddb'];	
	$team_id = $row['team_id'];	
	$team = $row['name'];
	
	$iscaptain = ($row['playerone'] == $user_info[1]) ? true : false;
	$captain = $row['playerone'];
	
	
	if(!X1_custommenu){
		$c .= "
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel1');return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>".XL_teamadmin_profile."</a>
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel2');return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>".XL_teamadmin_roster."</a>
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel3');return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>".XL_teamadmin_invites."</a>
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel4');return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>".XL_teamadmin_events."</a>
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel5');return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>".XL_teamadmin_matches."</a>
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel6');return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>".XL_teamadmin_history."</a>";
		if($iscaptain)$c .= "<a href='javascript:' class='tab' onclick=\"x1showPanel('panel7');return false;\" STYLE='text-decoration:none'><img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>".XL_teamadmin_quit."</a>";
	}
	$c .= X1plugin_title(XL_teamadmin_title."$team");	
	
	$panstyle = ( $panel=="home" ) ? '' : 'style="display:none"';
	$c .= "<div class='panel' id='panel1' $panstyle>";

	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE name = ".$xdb->qstr($team));
	$rout = ($row['recruiting']) ? XL_yes:XL_no;
	$c .= "
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
	<table class='".X1plugin_teamadmintable."' width='100%'>
    <thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_teamadmin_title.":</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_teamadmin_teamname.":</td>
			<td class='alt1'><input type='text' name='team' readonly value='$row[name]' size='25' maxlength='25'></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_teamadmin_teamtags.":</td>
			<td class='alt2'><input type='text' name='clantags' value='$row[clantags]' size='7' maxlength='7'></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_teamadmin_adminpass.":</td>
			<td class='alt1'><input type='password' name='chng_passworddb' value='' size='25' maxlength='25'></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_teamadmin_joinpass.":</td>
			<td class='alt2'><input type='password' name='joinpassword' value='$row[joinpassword]' size='25' maxlength='25'></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_teamadmin_homepage.":</td>
			<td class='alt1'><input type='text' name='homepage' value='$row[homepage]' size='25' maxlength='200'></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_teamadmin_logo.":</td>
			<td class='alt2'><input type='text' name='clanlogo' value='$row[clanlogo]' size='25' maxlength='200'></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_teamadmin_ircchannel.":#</td>
			<td class='alt1'><input type='text' name='ircchannel' value='$row[ircchannel]' size='25' maxlength='200'></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_teamadmin_ircserver.":</td>
			<td class='alt2'><input type='text' name='ircserver' value='$row[ircserver]' size='25' maxlength='200'></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_teamadmin_captain.":</td>
			<td class='alt1'><input type='text' name='playerone' disabled value='$row[playerone]' size='25' maxlength='35'></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_teamadmin_mail.":</td>
			<td class='alt2'><input type='text' name='mail' value='$row[mail]' size='25' maxlength='35'></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_teamadmin_country.":</td>
			<td class='alt1'><img src='".X1_imgpath."/flags/$row[country].bmp'>".SelectBox_Country('country', $row['country'])."</td>
		</tr>
		<tr>
			<td class='alt2'>".XL_teamadmin_recruiting.":</td>
			<td class='alt2'>
				<select name='recruiting'>
					<option value='$rwo[recruiting]' selected>$rout</option>
					<option value='0'>".XL_no."</option>
					<option value='1'>".XL_yes."</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan='2' class='alt1'><strong>".XL_teamadmin_profile.":</strong></td>
		</tr>
		<tr>
			<td colspan='2' class='alt2'>
			<textarea name='playerone2' cols='50' rows='10'>$row[playerone2]</textarea>
			</td>
		</tr>
		</tbody>
		<tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<th colspan='2' align='center'>
    			<input type='Submit' name='Submit' value='".XL_teamadmin_update."' >
    			</th>
    		</tr>
		</tfoot>
	</table>
	<input name='playerone' type='hidden' value='$row[playerone]'>
	<input name='".X1_actionoperator."' type='hidden' value='coreupdateteam'>
	</form>
	</div>";
	
	
	$panstyle = ( $panel=="roster" ) ? '' : 'style="display:none"';
	$c .= "<div class='panel' id='panel2' $panstyle>
	<table class='".X1plugin_teamadmintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
	<tr>
		<th>".XL_teamadmin_rosterusername."</th>
		<th>".XL_teamadmin_rostercontact."</th>
		<th>".XL_teamadmin_rosterjoindate."</th>
		<th>".X1_extraroster1."</th>
		<th>".X1_extraroster2."</th>
		<th>".X1_extraroster3."</th>
		<th>".XL_teamadmin_captain."</th>
		<th>".XL_teamadmin_rostermodify."</th>
	</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>";
		$rows= $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamroster." 
		WHERE team_id=".$xdb->qstr($team_id)." ORDER BY ".X1_rostersort);	
		foreach ($rows AS $row){
			$uid = $row["uid"];		
			$joindate = date(X1_dateformat, $row["joindate"]);			
			list ($maillink, $msnlink, $icqlink, $aimlink, $yimlink, $weblink, $avatar) = contacticons($row["name"],1);		
			
			$result2= $xdb->GetAll("SELECT * 
			FROM ".X1_prefix.X1_DB_teamroster." 
			WHERE uid=".$xdb->qstr(X1_clean($uid)));		
			
			$smurfteams = count($result2);	
			$checked = ($row['cocaptain']) ? "checked": "";
			$cap_status = ($row['name'] == $captain) ? "*":"";
			$c .=  "
			<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
			<tr>
				<td class='alt1'>$cap_status<a href='".X1_publicgetfile."?".X1_linkactionoperator."=playerprofile&member=$row[name]'>$row[name]</a></td>
				<td class='alt2'>$maillink $msnlink $icqlink $aimlink $yimlink $weblink</td>
				<td class='alt1'>$joindate</td>
				<td class='alt2'><input name='extra1' size='10' type='text' value='$row[extra1]'></td>
				<td class='alt1'><input name='extra2' size='10' type='text' value='$row[extra2]'></td>
				<td class='alt2'><input name='extra3' size='10' type='text' value='$row[extra3]'></td>
				<td class='alt1' align='center'><input name='cocaptain' type='checkbox' value='checked' $checked></td>
				<td class='alt2'>
					<input name='member' type='hidden' value='$row[name]'>
					<input name='team_id' type='hidden' value='$team_id'>
					<select name='".X1_actionoperator."'>
					<option value='updatemember'>".XL_teamadmin_rosterupdate."</option>
					<option value='removemember'>".XL_teamadmin_resterremove."</option>
					</select>
					<input type='image' title='submit' src='".X1_imgpath.X1_saveimage."' >
					<input name='team' type='hidden' value='$team'>
				</td>
			</tr>
			</form>
			</tbody>";	
		}
	$c .= "<tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<td colspan='8'>&nbsp;</td>
    		</tr>
		</tfoot>
	</table>
	</div>";
	
	
	$panstyle = ( $panel=="invites" ) ? '' : 'style="display:none"';
	$c .= "<div class='panel' id='panel3' $panstyle>
	<table class='".X1plugin_teamadmintable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				<th>".XL_teamadmin_invname."</th>
				<th>".XL_teamadmin_invcontact."</th>
				<th>".XL_teamadmin_invcancel."</th>
			</tr>
		</thead>
    	<tbody class='".X1plugin_tablebody."'>";
		$rows=$xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teaminvites."
		WHERE team_id=".$xdb->qstr(X1_clean($team_id))." 
		ORDER BY uid ASC LIMIT 0, 100");	
		if($rows){
			foreach($rows As $row){
				$team_id = $row["team_id"];
				$row2 = $xdb->GetRow("SELECT ".X1_DB_usersnamekey." 
				FROM ".X1_userprefix.X1_DB_userstable." 
				WHERE ".X1_DB_usersidkey."=".$xdb->qstr(X1_clean($row["uid"])));
				if($row2){
					list ($usermail, $usermsn, $usericq, $useraim, $useryim, $userweb, $avatar) = contacticons($row2[0]);
					$c .=  "<tr>
							<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
								<td class='alt1'>$row2[0]</td>
								<td class='alt2'>$usermail $usermsn $usericq $useraim $useryim $userweb</td>
								<td class='alt1'>
									<input type='Submit' name='Submit' value='".XL_teamadmin_invcancelbut."' >
									<input name='".X1_actionoperator."' type='hidden' value='removeinvite'>
									<input name='randid' type='hidden' value='$row[randid]'>
									<input name='team' type='hidden' value='$team'>
								</td>
							</form>
							</tr>";
				}
			}
		}else{
			$c .="<tr>
					<td colspan='3'>".XL_teamadmin_invnone."</td>
				</tr>";	
		}
	$c .= "
	</tbody>
	<tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<td colspan='3'>&nbsp;</td>
    		</tr>
		</tfoot>
	</table>
	<br/>
	<table class='".X1plugin_teamadmintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
    	<tr>
            <td>&nbsp;</td>
        </tr>
	</thead>
    <tbody class='".X1plugin_tablebody."'>
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
	<tr>
		<td>";		
		$list = $xdb->GetAll("SELECT ".X1_DB_usersidkey.",".X1_DB_usersnamekey." 
		FROM ".X1_userprefix.X1_DB_userstable." order by ".X1_DB_usersnamekey."");		
		$c .=  "<SELECT NAME='user_id''>";		
		foreach($list AS $item){
			$c .= "<option value='$item[0]'>$item[1]</option>";		
		}
		$c .= "
		</select>
		<input name='Submit' type='Submit' value='".XL_teamadmin_invuser."' >
		<input name='team' type='hidden' value='$team'>
		<input name='team_id' type='hidden' value='$team_id'>
		<input name='".X1_actionoperator."' type='hidden' value='sendinvite'>
		</td>
	</tr>
	</tbody>
	<tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<td>&nbsp;</td>
    		</tr>
		</tfoot>
	</table>
	</form>
	</div>";
	
	$panstyle = ( $panel=="challenges" ) ? '' : 'style="display:none"';
	$c .= "<div class='panel' id='panel5' $panstyle>
	<table class='".X1plugin_teamadmintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
    	<tr>
            <td>".XL_teamadmin_challnew."</td>
        </tr>
	</thead>
    <tbody class='".X1plugin_tablebody."'>
	<tr>
		<td>
		<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
		".SelectBox_JoinedLadderDrop($team_id)."
		<input type='Submit' name='Submit' value='".XL_teamadmin_challnew."' >
		<input name='".X1_actionoperator."' type='hidden' value='challengeteamform'>
		<input name='team' type='hidden' value='$team'>
		</form>
		</td>
	</tr>
	</tbody>
	<tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<td>&nbsp;</td>
    		</tr>
		</tfoot>
	</table>
	<br/>
	<table class='".X1plugin_teamadmintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
	<tr>
		<th>".XL_teamadmin_challchallenger."</th>
		<th>".XL_teamadmin_challcontact."</th>
		<th>".XL_teamadmin_challevent."</th>
		<th>".XL_teamadmin_challdate."</th>
		<th>".XL_teamadmin_challconfirm."</th>
	</tr>
	</thead>
    <tbody class='".X1plugin_tablebody."'>";
	$rows= $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamtempchallenges." 
	WHERE winner=".$xdb->qstr(X1_clean($team))." ORDER BY date");	
	if($rows){
		foreach($rows AS $row){
			list ($maillink, $msnlink, $icqlink, $aimlink, $yimlink, $weblink, $irclink) = teamcontacticons($row['loser']);
			$event = $xdb->GetRow("SELECT title FROM ".X1_prefix.X1_DB_events." 
			where sid=".$xdb->qstr(X1_clean($row['ladder_id'])));
			$c .=  "<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
			<tr>
				<td class='alt1'>$row[loser]</td>
				<td class='alt2'>$maillink $msnlink $icqlink $aimlink $yimlink $weblink $irclink</td>
				<td class='alt1'>$event[title]</td>
				<td class='alt2'>".date(X1_dateformat, $row['date'])."</td>
				<td class='alt1'>
					<input type='hidden' name='randid' value='$row[randid]'>
					<input name='".X1_actionoperator."' type='hidden' value='confirmchallform'>
					<input type='submit' name='submit' value='".XL_teamadmin_challconfirm."' >
				</td>
			</tr>
			</form>";
		}
	}else{
		$c .="
			<tr>
				<td colspan='5'>".XL_teamadmin_challnone."</td>
			</tr>";	
	}
	$c .= "
	</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<td colspan='5'>&nbsp;</td>
    		</tr>
		</tfoot>
	</table>
    <br />
	<table class='".X1plugin_teamadmintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
	<tr>
		<th>".XL_teamadmin_challchallenged."</th>
		<th>".XL_teamadmin_challcontact."</th>
		<th>".XL_teamadmin_challevent."</th>
		<th>".XL_teamadmin_challdate."</th>
		<th>".XL_teamadmin_challstatus."</th>
	</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'> ";
	
	$rows = $xdb->GetAll("SELECT * 
	FROM ".X1_prefix.X1_DB_teamtempchallenges." 
	WHERE loser = ".$xdb->qstr(X1_clean($team))." 
	ORDER BY date");	
	
	if($rows){
	foreach($rows As $row){
		list ($maillink, $msnlink, $icqlink, $aimlink, $yimlink, $weblink, $irclink) = teamcontacticons($row["winner"]);
		$event = $xdb->GetRow("SELECT title FROM ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr(X1_clean($row['ladder_id'])));
		$c .= "<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
				<tr>
					<td class='alt1'>$row[winner]</td>
					<td class='alt2'>$maillink $msnlink $icqlink $aimlink $yimlink $weblink $irclink</td>
					<td class='alt1'>$event[title]</td>
					<td class='alt2'>".date(X1_dateformat, $row['date'])."</td>
					<td class='alt1'>
						<input type='hidden' name='randid' value='$row[randid]'>
						<input name='".X1_actionoperator."' type='hidden' value='withdrawchall'>
						<input type='submit' name='submit' value='".XL_teamadmin_challwidthdraw."' >
					</td>
				</tr>
				</form>";		
		}
	}else{
		$c .="
			<tr>
				<td colspan='5'>".XL_teamadmin_challnone."</td>
			</tr>";	
	}
	$c .= "
    </tbody>
    <tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<td colspan='5'>&nbsp;</td>
    		</tr>
		</tfoot>
	</table>
    <br />
	
    <table class='".X1plugin_teamadmintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>";
	
	$rows= $xdb->GetAll("SELECT * 
	FROM ".X1_prefix.X1_DB_teamchallenges." 
	WHERE winner = ".$xdb->qstr(X1_clean($team))."  
	OR loser = ".$xdb->qstr(X1_clean($team))."  
	ORDER BY date");	
	
	if($rows){
		foreach($rows AS $row){
			$event = $xdb->GetRow("SELECT * 
			FROM ".X1_prefix.X1_DB_events." 
			WHERE sid=".$xdb->qstr(X1_clean($row['ladder_id'])));
			$c .=  "<tr>
					<th>".XL_teamadmin_matchchallenger."</td>
					<th>".XL_teamadmin_matchchallenged."</th>
					<th>".XL_teamadmin_matchevent."</th>
					<th>".XL_teamadmin_matchdate."</td>
				</tr>
				</thead>
				<tbody class='".X1plugin_tablebody."'>
				<tr>
					<td><a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=$row[loser]'>$row[loser]</a></td>
					<td><a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=$row[winner]'>$row[winner]</a></td>
					<td><a href='".X1_publicgetfile."?".X1_linkactionoperator."=ladderhome&sid=$event[sid]'>$event[title]</a></td>
					<td>".date(X1_extendeddateformat, $row['matchdate'])."</td>
				</tr>
				</tbody>
				<thead class='".X1plugin_tablehead."'>
				<tr>
					<th class='alt1'>".XL_teamadmin_matchmappicks."($event[nummaps1])</th>
					<th class='alt2'>".XL_teamadmin_matchmappicks."($event[nummaps2])</th>
					<th class='alt1'>".X1_extraonename."</th>
					<th class='alt2'>".X1_extratwoname."</th>
				</tr>
				</thead>
				<tbody class='".X1plugin_tablebody."'>
				<tr>
			<td class='alt1'>
			<textarea name='textarea' cols='15' rows='3' readonly>";
			$mapsarry=explode(",",$row["map1"]);
			$curmap=0;
			while($curmap < $event['nummaps1']){
				list ($mapname, $mappic, $mapdl) = mapinfo($row["ladder_id"], $mapsarry[$curmap]);
				$c .=  "$mapname\n--------\n";
				$curmap++;
			}
			$c .=  "
			</textarea>
			</td>
			<td class='alt2'>
			<textarea name='textarea' cols='15' rows='3' readonly>";
			$mapsarry=explode(",",$row["map2"]);
			$curmap=0;
			while($curmap < $event['nummaps2']){
				list ($mapname, $mappic, $mapdl) = mapinfo($row["ladder_id"], $mapsarry[$curmap]);
				$c .=  "$mapname\n--------\n";
				$curmap++;
			}
			if ($row["winner"] == "$team") {
				$thewinner = $row["loser"];
			}else {
				$contacticons = $row["winner"];
			}
			if ($row["loser"] == "$team") {
				$thewinner = $row["winner"];
			}else {
				$contacticons = $row["loser"];
			}
			list ($maillink, $msnlink, $icqlink, $aimlink, $yimlink, $weblink, $irclink) = teamcontacticons($contacticons);
			$rep_but = ($event['whoreports']=="winner") ? XL_teamadmin_challreportwin : XL_teamadmin_challreportloss;
			$c .= "</textarea>
					</td>
					<td class='alt1'>$row[extra1]</td>
					<td class='alt2'>$row[extra2]</td>
				</tr>
				<tr>
					<td colspan='4' class='alt1'>".XL_teamadmin_matchcomments."</td>
				</tr>
				<tr>
					<td colspan='4' class='alt2'>$row[extra3]</td>
				</tr>
				<tr>
					<td colspan='4' class='alt1'>".XL_teamadmin_matchcontact."</td>
				</tr>
				<tr>
					<td colspan='4' class='alt2'>$maillink $msnlink $icqlink $aimlink $yimlink $weblink $irclink</td>
				</tr>
				<tr>
				<td class='alt1'>
					<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
						<input name='Submit' type='Submit' value='$rep_but' >
						<input name='".X1_actionoperator."' type='hidden' value='reportform'>
						<input name='randid' type='hidden' value='$row[randid]'>
					</form>
				</td>
				<td class='alt2'>
					<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
						<input name='Submit' type='Submit' value='".XL_teamadmin_challreportdraw."' >
						<input name='".X1_actionoperator."' type='hidden' value='reportform'>
						<input name='draw' type='hidden' value='1'>
						<input name='randid' type='hidden' value='$row[randid]'>
					</form>
				</td>
				<td class='alt1'>
					<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
						<input name='Submit' type='Submit' value='".XL_teamadmin_challnotify."' >
						<input name='".X1_actionoperator."' type='hidden' value='mailteammatch'>
						<input name='randid' type='hidden' value='$row[randid]'>
					</form>
				</td>
				<td class='alt2'>
					<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
						<input name='Submit' type='Submit' value='".XL_teamadmin_challdispute."' >
						<input name='".X1_actionoperator."' type='hidden' value='disputeform'>
						<input name='randid' type='hidden' value='$row[randid]'>
					</form>
				</td>
				</tr>";
			$cur++;		
		}
	}else{
		$c .="
			<tr>
				<th colspan='4'>".XL_teamadmin_nosetmatches."</td>
			</tr>";	
	}
	$c .= "
	</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<td colspan='4'>&nbsp;</td>
    		</tr>
		</tfoot>
	</table>
    </div>";
	
	$panstyle = ( $panel=="events" ) ? '' : 'style="display:none"';
	$c .= "<div class='panel' id='panel4' $panstyle>
	<table class='".X1plugin_teamadmintable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				<th>".XL_teamadmin_eventsid."</th>
				<th>".XL_teamadmin_eventsname."</th>
				<th>".XL_teamadmin_eventstgp."</th>
				<th>".XL_teamadmin_eventstw."</th>
				<th>".XL_teamadmin_eventstl."</th>
				<th>".XL_teamadmin_eventstd."</th>
				<th>".XL_teamadmin_eventstgp."</th>
				<th>".XL_teamadmin_eventsgp."</th>
				<th>".XL_teamadmin_eventsw."</th>
				<th>".XL_teamadmin_eventsl."</th>
				<th>".XL_teamadmin_eventsd."</th>
				<th>".XL_teamadmin_eventsp."</th>
				<th>".XL_teamadmin_eventsquit."</th>
			</tr>
		</thead>
    <tbody class='".X1plugin_tablebody."'>";
	$rows = $xdb->GetAll("SELECT * 
	FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE team_id=".$xdb->qstr(X1_clean($team_id))." 
	ORDER BY ladder_id ASC");	
	if($rows) {
		unset($row);		
		foreach($rows As $lad){
			$ladder=$xdb->GetRow("SELECT title FROM ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr($lad['ladder_id']));
			$c .= "<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
			<tr>
				<td class='alt1'><a href='".X1_publicgetfile."?".X1_linkactionoperator."=ladderhome&sid=$lad[ladder_id]'>$lad[ladder_id]</a></td>
				<td class='alt2'>
				<a href='".X1_publicgetfile."?".X1_linkactionoperator."=ladderhome&sid=$lad[ladder_id]'>$ladder[title]</a>
				</td>
				<td class='alt2'>$lad[totalgames]</td>
				<td class='alt1'>$lad[totalwins]</td>
				<td class='alt2'>$lad[totallosses]</td>
				<td class='alt1'>$lad[totaldraws]</td>
				<td class='alt1'>$lad[totalpoints]</td>
				<td class='alt1'>$lad[games]</td>
				<td class='alt2'>$lad[wins]</td>
				<td class='alt1'>$lad[losses]</td>
				<td class='alt1'>$lad[draws]</td>
				<td class='alt2'>$lad[points]</td>
				<td class='alt2'>
					<input name='".X1_actionoperator."' type='hidden' value='quitladder'>
					<input name='team_id' type='hidden' value='$team_id'>
					<input name='ladder_id' type='hidden' value='$lad[ladder_id]'>
					<input type='submit' name='submit' value='".XL_teamadmin_eventsbut."' >
				</td>
			</tr>
		</form>";		
		}
	}else{
		$c .="<tr>
				<td colspan='14'>".XL_teamadmin_eventsnone.".</td>
			</tr>";	
	}
	$c .= "
    </tbody>
    <tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<td colspan='14'>&nbsp;</td>
    		</tr>
		</tfoot>
	</table>
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>";	
	$c .= SelectBox_LadderDrop('ladder');	
	$c .= "
	<input name='Submit' type='Submit' value='".XL_teamadmin_eventsjoin."' >
	<input name='".X1_actionoperator."' type='hidden' value='joinladderpre'>
	</form>
	</div>";
	
	$panstyle = ( $panel=="matches" ) ? '' : 'style="display:none"';
	$c .= "<div class='panel' id='panel6' $panstyle>
	<table class='".X1plugin_teamadmintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th>".XL_teamadmin_matchesid."</th>
			<th>".XL_teamadmin_matchesevent."</th>
			<th>".XL_teamadmin_matcheswinner."</th>
			<th>".XL_teamadmin_matchesloser."</th>
			<th>".XL_teamadmin_matchesdate."</th>
			<th>".XL_teamadmin_matchesdetails."</th>
		</tr>
		</thead>
        <tbody class='".X1plugin_tablebody."'>";	
	$rows = $xdb->GetAll("SELECT * 
	FROM ".X1_prefix.X1_DB_teamhistory." 
	WHERE winner=".$xdb->qstr(X1_clean($team))."  
	OR loser=".$xdb->qstr(X1_clean($team))."  
	ORDER BY game_id DESC");	
	if($rows){
		foreach($rows AS $row){
			$event = $xdb->GetRow("select * 
			FROM ".X1_prefix.X1_DB_events." 
			WHERE sid=".$xdb->qstr(X1_clean($row['laddername'])));
			$c .= "
			<tr>
				<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
					<td class='alt1'>$row[game_id]</td>
					<td class='alt2'>$event[title]</td>
					<td class='alt1'>$row[winner]</td>
					<td class='alt2'>$row[loser]</td>
					<td class='alt1'>".date(X1_dateformat, $row['date'])."</td>
					<td class='alt2'>
						<input name='".X1_actionoperator."' type='hidden' value='matchdetails'>
						<input name='game_id' type='hidden' value='$row[game_id]'>
						<input type='Submit' name='Submit' value='".XL_teamadmin_matchesdetails."' >
					</td>
				</form>
			</tr>";		
		}
	}else{
		$c .="
			<tr>
				<td colspan='6'>".XL_teamadmin_matchesnone."</td>
			</tr>";	
	}
	$c .= "
    </tbody>
    <tfoot class='".X1plugin_tablefoot."'>
    		<tr>
    			<td colspan='6'>&nbsp;</td>
    		</tr>
		</tfoot>
	</table>
	</div>";
	
	if($iscaptain){
		$panstyle = ( $panel=="quit" ) ? '' : 'style="display:none"';
		$c .= "<div class='panel' id='panel7' $panstyle>
		<table class='".X1plugin_teamadmintable."' width='100%'>
				<thead class='".X1plugin_tablehead."'>
					<tr>
						<th>".XL_teamadmin_removeteam."</th>
					</tr>
				</thead>
				<tbody class='".X1plugin_tablebody."'>
					<tr>
						<td align='center' valign='middle'>".XL_teamadmin_removeteamwarming."
							<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
								<input type='Submit' name='Submit' value='".XL_teamadmin_removeteambut."'>
								<input name='".X1_actionoperator."' type='hidden' value='endteam'>
							</form>
						</td>
					</tr>
				</tbody>
			<tfoot class='".X1plugin_tablefoot."'>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</tfoot>
		</table>
		<br/>
		<table class='".X1plugin_teamadmintable."' width='100%'>
				<thead class='".X1plugin_tablehead."'>
					<tr>
						<th>".XL_teamadmin_transferteam."</th>
					</tr>
				</thead>
				<tbody class='".X1plugin_tablebody."'>
					<tr>
						<td align='center' valign='middle'>".XL_teamadmin_transferteamwarming."
							<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>";
								$list = $xdb->GetAll("SELECT uid, name  
								FROM ".X1_prefix.X1_DB_teamroster." 
								WHERE team_id=".$xdb->qstr(X1_clean($cookieteamid))."
								order by name;");		
								$c .=  "<SELECT NAME='user_id''>" ;		
								if($list){
									foreach($list AS $item){
										$c .= "<option value='$item[0]'>$item[1]</option>";		
									}
								}
								$c .= "
								</select>
								<input type='Submit' name='Submit' value='".XL_teamadmin_transferteambut."'>
								<input name='".X1_actionoperator."' type='hidden' value='transferteam'>
							</form>
						</td>
					</tr>
				</tbody>
			<tfoot class='".X1plugin_tablefoot."'>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</tfoot>
		</table>
		</div>";
	}
	return X1plugin_output($c);
}

function coreupdateteam() {
	global $xdb;
	list ($cookieteamid, $cookieteam, $password2) = cookieread();
	$password = md5($password2);
	$c  = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	modifysql("UPDATE", X1_DB_teams, "SET
	name = ".$xdb->qstr(X1_clean($cookieteam)).",
	mail = ".$xdb->qstr(X1_clean($_POST['mail'])).",
	playerone = ".$xdb->qstr(X1_clean($_POST['playerone'])).",
	playerone2 = ".$xdb->qstr(X1_clean($_POST['playerone2'])).",
	clantags = ".$xdb->qstr(X1_clean($_POST['clantags'])).",
	clanlogo = ".$xdb->qstr(X1_clean($_POST['clanlogo'])).",
	homepage = ".$xdb->qstr(X1_clean($_POST['homepage'])).",
	ircserver = ".$xdb->qstr(X1_clean($_POST['ircserver'])).",
	ircchannel=".$xdb->qstr(X1_clean($_POST['ircchannel'])).",
	joinpassword = ".$xdb->qstr(X1_clean($_POST['joinpassword'])).",
	recruiting = ".$xdb->qstr(X1_clean($_POST['recruiting'])).",
	country = ".$xdb->qstr(X1_clean($_POST['country']))."
	WHERE name = ".$xdb->qstr(X1_clean($cookieteam)));

	modifysql("UPDATE", X1_DB_teamsevents, "SET
	clantags = ".$xdb->qstr(X1_clean($_POST['clantags'])).",
	country= ".$xdb->qstr(X1_clean($_POST['country']))."
	WHERE name = ".$xdb->qstr(X1_clean($cookieteam))
	);

	$c .= XL_teamadmina_teamupdated;
	if (!empty($_POST['chng_passworddb'])) {
		$newpass = md5($_POST['chng_passworddb']);
		modifysql("UPDATE", X1_DB_teams, "
		SET passworddb = ".$xdb->qstr($newpass)." 
		WHERE name = ".$xdb->qstr($cookieteam));
		$c .= XL_teamadmina_passupdated;
		doteamcookie($cookieteamid, $cookieteam, $chng_passworddb);
	}
	return displayteam();
}

function joinladderpre() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	if (!isset($_POST['ladder']))return X1plugin_output($c .= X1plugin_title(XL_teamadmina_noeventsel));
	list ($team_id, $team, $password) = cookieread();
	$row = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_events." 
	WHERE sid=".$xdb->qstr(X1_clean($_POST['ladder'])));
	if (!$row)return X1plugin_output($c .= X1plugin_title(XL_teamadmina_noevent));
	$c .= X1plugin_title(XL_teamadmina_joinevent."::$row[title]");
	$title = stripslashes($row['title']);
	$hometext = stripslashes($row['hometext']);
	$bodytext = stripslashes($row['bodytext']);
	$notes = stripslashes($row['notes']);
	$notes =(!empty($notes)) ? "<br /><br />"._NOTE." <i>$notes</i>" : "";
	$bodytext = (!empty($bodytext)) ? "$hometext$notes<br />" : "$hometext<br /><br />$bodytext$notes";

    $row2=$xdb->GetRow("select * 
	FROM ".X1_prefix.X1_DB_games." 
	WHERE gameid=".$xdb->qstr(X1_clean($row['game'])));

    if($row2){
        $gameid = $row2['gameid'];
        $gamename = $row2['gamename'];
        $gameimage = $row2['gameimage'];
    }
	$c .= laddersettings($row['sid'])."<br />";
	if (!isset($row['type']))return X1plugin_output($c .= X1plugin_title(XL_missingfile));
	require_once(X1_modpath."/$row[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$row[type]/modinfo.php");
		
	$c .= "
	<br />
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
	<input name='Submit' type='Submit' value='".XL_teamadmina_joinevent."' >
	<input name='".X1_actionoperator."' type='hidden' value='joinladder'>
	<input name='ladder_id' type='hidden' value='$row[sid]'>
	</form>";
	return X1plugin_output($c);
}

function joinladder() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	list ($team_id, $team, $password) = cookieread();
	
	$teamsonladder = count($xdb->GetAll("
    SELECT *
    FROM ".X1_prefix.X1_DB_teamsevents."
    WHERE team_id = ".$xdb->qstr(X1_clean($team_id))." 
	AND ladder_id = ".$xdb->qstr(X1_clean($_POST['ladder_id']))));
	
	$numteamsonladder=count($xdb->GetAll("
    SELECT *
    FROM ".X1_prefix.X1_DB_teamsevents."
    WHERE ladder_id = ".$xdb->qstr(X1_clean($_POST['ladder_id']))));
	
	$ladderexists=count($xdb->GetAll("
    SELECT *
    FROM ".X1_prefix.X1_DB_events."
    WHERE sid = ".$xdb->qstr(X1_clean($_POST['ladder_id']))));
	
	$numonroster =count($xdb->GetAll("
    SELECT *
    FROM ".X1_prefix.X1_DB_teamroster."
    WHERE team_id = ".$xdb->qstr(X1_clean($team_id))));
	
	$row = $xdb->GetRow("
    SELECT *
    FROM ".X1_prefix.X1_DB_teams."
    WHERE team_id = ".$xdb->qstr(X1_clean($team_id)));
	
	$name = $row['name'];
	$password = $row['passworddb'];
	$mail = $row['mail'];
	$icq = $row['icq'];
	$msn = $row['msn'];
	$country = $row['country'];
	$clantags = $row['clantags'];
	$clanlogo = $row['clanlogo'];
	
	$lad = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_events." 
	WHERE sid=".$xdb->qstr(X1_clean($_POST['ladder_id'])));
	
	if($numonroster > $lad['maxplayers'])return X1plugin_output(displayteam("events", $c .= XL_teamadmina_joinmaxplayers));
	if($numonroster < $lad['minplayers'])return X1plugin_output(displayteam("events", $c .= XL_teamadmina_joinminplayers));
	if (!isset($lad['type']))return X1plugin_output(displayteam("events", $c .= XL_missingfile));
	
	require_once(X1_modpath."/$lad[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$lad[type]/join.php");
	
	return X1plugin_output(displayteam("events", $c));
}

function quitladder() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	list ($team_id, $team, $password) = cookieread();
	$lad = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_events." 
	WHERE sid=".$xdb->qstr(X1_clean($_POST['ladder_id'])));
	if(isset($lad['type'])){
		require_once(X1_modpath."/$lad[type]/language/".X1_corelang.".php");
        require_once(X1_modpath."/$lad[type]/quit.php");
    }else{
		require_once(X1_modpath."/league//language/".X1_corelang.".php");
        require_once(X1_modpath."/league/quit.php");
    }
	return X1plugin_output(displayteam("events", $c));
}

function endteam() {
	global $xdb;
	$c = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	list ($team_id, $team, $password) = cookieread();
	$cookie = X1_userdetails();
	$row = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teams." 
	WHERE team_id = ".$xdb->qstr(X1_clean($team_id)));
	if($row["playerone"] != $cookie[1])return X1plugin_output($c .= XL_teamadmina_captainonly);
	modifysql("delete from", X1_DB_teams, "
	WHERE team_id=".$xdb->qstr(X1_clean($row['team_id'])));
	modifysql("delete from", X1_DB_teamsevents, "
	WHERE team_id=".$xdb->qstr(X1_clean($row['team_id'])));
	modifysql("delete from", X1_DB_teamchallenges, "
	WHERE winner=".$xdb->qstr(X1_clean($row['name']))." 
	OR loser=".$xdb->qstr($row['name']));
	modifysql("delete from", X1_DB_teamtempchallenges, "
	WHERE winner=".$xdb->qstr(X1_clean($row['name']))." 
	OR loser=".$xdb->qstr($row['name']));
	modifysql("delete from", X1_DB_teamroster, "
	WHERE team_id=".$xdb->qstr(X1_clean($row['team_id'])));
	$c .= X1plugin_title(XL_teamadmina_teamremoved);
	$c .= "<meta http-equiv='refresh' content='1;URL=".X1_logoutpage."'>";
	setcookie(X1_cookiename);
	return X1plugin_output(displayteam("events", $c));
}

function removemember() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	list ($cookieteamid, $team, $password) = cookieread();
	modifysql("delete from", X1_DB_teamroster, "
	WHERE name=".$xdb->qstr(X1_clean($_POST['member']))." 
	AND team_id=".$xdb->qstr(X1_clean($_POST['team_id'])));
	$c .= displayteam("roster", XL_teamadmina_memberremoved);
	return X1plugin_output($c);
}

function updatemember() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin())return X1plugin_output($c .= XL_notlogggedin);
	list ($cookieteamid, $team, $password) = cookieread();
	$cocap = ($_POST['cocaptain'] == "checked") ? 1:0;
	modifysql("UPDATE", X1_DB_teamroster, "SET 
	extra1 ='".X1_clean($_POST['extra1'])."',
	extra2 ='".X1_clean($_POST['extra2'])."',
	extra3 ='".X1_clean($_POST['extra3'])."',
	cocaptain ='".X1_clean($cocap)."' 
	WHERE name=".$xdb->qstr(X1_clean($_POST['member']))."  
	AND team_id=".$xdb->qstr(X1_clean($_POST['team_id'])));
	return X1plugin_output(displayteam("roster", XL_teamadmina_memberupdated));
}

function mailteam() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin()){
		$c .= X1plugin_title(XL_notlogggedin);
		return X1plugin_output($c);
	}
	list ($teamid, $teamname, $password) = cookieread();
	$challenge = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teamchallenges." 
	WHERE randid = ".$xdb->qstr($_POST['randid']));
	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr($challenge['ladder_id']));
	$result=$xdb->GetAll("select * from ".X1_prefix.X1_DB_teamroster." 
	WHERE team_id=".$xdb->qstr($teamid));
	foreach($result AS $row){
		if (X1_emailon){
			$content = array(
				'team1' =>  $challenge['winner'],
				'team2' =>  $challenge['loser'],
				'date' => date(X1_extendeddateformat, $challenge['matchdate']),
				'event' => $event['title']
				);
			$c .= X1plugin_email($row["mail"], "teamnotify.tpl", $content);
			$c .= XL_teamadmina_msgsent." $mailname.<br />";
		}
	}
	return X1plugin_output(displayteam("roster", $c));
}
?>