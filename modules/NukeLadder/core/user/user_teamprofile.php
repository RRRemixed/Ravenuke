<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function teamprofile() {
	global $xdb;
	$row = $xdb->GetRow("SELECT * 
	FROM ".X1_prefix.X1_DB_teams." 
	WHERE name=".$xdb->qstr($_REQUEST['teamname'])); 
	if (!$row)return X1plugin_output(X1plugin_style().X1plugin_title(XL_teamprofile_noteam));
	$c  = X1plugin_style();
	$c .= "<script type='text/javascript' >
	var panels = new Array('panel1', 'panel2', 'panel3', 'panel4');
	function x1showPanel(name){
		for(i = 0; i < panels.length; i++){
			document.getElementById(panels[i]).style.display = (name == panels[i]) ? 'block':'none';
		}
	}
	</script>\n";
	
	if(!X1_custommenu){
		$c .= "
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel1'); return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>
		".XL_teamprofile_tprofile."</a>
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel2'); return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>
		".XL_teamprofile_troster."</a>
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel3'); return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>
		".XL_teamprofile_tevents."</a>
		<a href='javascript:' class='tab' onclick=\"x1showPanel('panel4'); return false;\" STYLE='text-decoration:none'>
		<img src='".X1_imgpath.X1_tab_image."' width='".X1_tab_width."' height='".X1_tab_height."' border='".X1_tab_border."'>
		".XL_teamprofile_thistory."</a>";
	}
	$maillink = ($row['mail'] == XL_na) ? XL_na : $row['mail'];
	$maillinkpic = ($row['mail'] == "") ? XL_na : "<a href='mailto:$row[mail]'>
    <img border='0' src='".X1_imgpath."/mail.gif' align='absmiddle'></a>";
	$irclink = (empty($row['ircserver'])) ? "" : "<a href='irc://$row[ircserver]/$row[ircchannel]'>
    <img src='".X1_imgpath."/mirc.gif' title='$row[ircserver] / #$row[ircchannel]' width='21' height='17' border='0'>
    </a>";	
	if(empty($row['playerone2']))$row['playerone2'] = XL_teamprofile_noprofile;
	list ($capmaillink, $capmsnlink, $capicqlink, $capaimlink, $capyimlink, $capweblink, $avatar) = contacticons($row['playerone']);
	$rout = ($row['recruiting']) ? XL_yes:XL_no;
	$c .= X1plugin_title(XL_teamprofile_title.$row['name']);
	$c .="
	<div class='panel' id='panel1'>
	<table class='".X1plugin_teamprofiletable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
    	<tr>
    		<th colspan='2'>".XL_teamprofile_title."</th>
    	</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>";
	if(!empty($row['clanlogo'])){
		$c .="
		<tr>
			<td colspan='2' align='center' class='alt1'>
			<a href='$row[homepage]' target='_blank'><img src='$row[clanlogo]' border='0' hspace='5' vspace='5'></a>
			</td>
		</tr>";
	}
	$c .="
	<tr>
		<td class='alt2'>".XL_teamprofile_name.":</td>
		<td class='alt2'>$row[name]</td>
	</tr>
	<tr>
		<td class='alt1'>".XL_teamprofile_homepage.":</td>
		<td class='alt1'><a href='$row[homepage]' target='_blank'> $row[homepage]</a></td>
	</tr>
	<tr>
		<td class='alt2'>".XL_teamprofile_location.":</td>
		<td class='alt2'><img src='".X1_imgpath."/flags/$row[country].bmp' align='absmiddle'> $row[country]</td>
	</tr>
	<tr>
		<td class='alt1'>".XL_teamprofile_mail.":</td>
		<td class='alt1'>$maillinkpic</td>
	</tr>
	<tr>
		<td class='alt2'>".XL_teamprofile_captain.":</td>
		<td class='alt2'>$row[playerone]</td>
	</tr>
	<tr>
		<td class='alt1'>".XL_teamprofile_contact."</td>
		<td class='alt1'>$capmaillink $capmsnlink $capicqlink $capyimlink $capaimlink $capyimlink $capweblink $irclink</td>
	</tr>
	<tr>
		<td class='alt2'>".XL_teamprofile_recruiting."</td>
		<td class='alt2'>$rout</td>
	</tr>
	<tr>
		<th colspan='2' class='alt1'>".XL_teamprofile_moto.":</th>
	</tr>
	<tr>
		<td colspan='2'  class='alt2'>$row[playerone2]<!--<hr noshade><a href='#'>".XL_teamprofile_report."</a>--></td>
	</tr>
    </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
				<td colspan='6'>&nbsp;</td>
            </tr>
        </tfoot>";
	$c .= "</table>
	</div>
	<div class='panel' id='panel2' style='display: none'>
	<table class='".X1plugin_teamprofiletable."' width='100%'>
    <thead class='".X1plugin_tablehead."'>
		<tr> 
			<th>".XL_teamprofile_husername."</th>
			<th>".XL_teamprofile_hcontact."</th>
			<th>".XL_teamprofile_hjoindate."</th>
			<th>".X1_extraroster1."</th>
			<th>".X1_extraroster2."</th>
			<th>".X1_extraroster3."</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>";
	$rows = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamroster."
	 WHERE team_id=".$xdb->qstr($row['team_id'])." 
	 ORDER BY ".X1_rostersort);
	if($rows){
		foreach($rows As $row){
			list ($maillink, $msnlink, $icqlink, $aimlink, $yimlink, $weblink, $avatar) = contacticons($row["name"]);
			$extra1 = (empty($row['extra1'])) ? "n/a" : $row['extra1'];
			$extra2 = (empty($row['extra2'])) ? "n/a" : $row['extra2'];
			$extra3 = (empty($row['extra3'])) ? "n/a" : $row['extra3'];
			$c .= "
            <tr>
                <td class='alt1'>
    			<a href='".X1_publicgetfile."?".X1_linkactionoperator."=playerprofile&member=$row[name]'>$row[name]</a></td>
    			<td class='alt2'>$maillink $msnlink $icqlink $aimlink $yimlink $weblink</td>
    			<td class='alt1'>".date(X1_dateformat, $row['joindate'])."</td>
    			<td class='alt2'>$extra1</td>
				<td class='alt2'>$extra2</td>
				<td class='alt2'>$extra3</td>
			</tr>";
		} 
	}else{
		$c .= "<tr>
				<td colspan='6'>".XL_teamprofile_nomembers."</td>
				</tr>";
	}
	$c .= "
    </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
				<td colspan='4'>&nbsp;</td>
            </tr>
        </tfoot>";
	$c .= "</table>
	</div>
	<div class='panel' id='panel3' style='display: none'>
	<table class='".X1plugin_teamprofiletable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr> 
			<th>".XL_teamprofile_hid."</th>
			<th>".XL_teamprofile_hevent."</th>
			<th>".XL_teamprofile_tgp."</th>
			<th>".XL_teamprofile_tw."</th>
			<th>".XL_teamprofile_tl."</th>
			<th>".XL_teamprofile_td."</th>
			<th>".XL_teamprofile_tp."</th>
			<th>".XL_teamprofile_gp."</th>
			<th>".XL_teamprofile_w."</th>
			<th>".XL_teamprofile_l."</th>
			<th>".XL_teamprofile_d."</th>
			<th>".XL_teamprofile_p."</th>
		</tr>
		</thead>
		<tbody class='".X1plugin_tablebody."'>";
	$rows= $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamsevents." 
	WHERE team_id=".$xdb->qstr($row['team_id'])." 
	ORDER BY ladder_id ASC");
	if($rows) {
		foreach($rows AS $row){
			$ladder=$xdb->GetRow("SELECT title FROM ".X1_prefix.X1_DB_events." 
			WHERE sid=".$xdb->qstr($row['ladder_id']));
			$c .="
			<tr> 
				<td class='alt1'><a href='".X1_publicgetfile."?".X1_linkactionoperator."=ladderhome&sid=$row[ladder_id]'>
				$row[ladder_id]</a></td>
				<td class='alt2'><a href='".X1_publicgetfile."?".X1_linkactionoperator."=ladderhome&sid=$row[ladder_id]'>
				$ladder[title]</a></td>
				<td class='alt2'>$row[totalgames]</td>
				<td class='alt1'>$row[totalwins]</td>
				<td class='alt2'>$row[totallosses]</td>
				<td class='alt2'>$row[totaldraws]</td>
				<td class='alt1'>$row[totalpoints]</td>
				<td class='alt1'>$row[games]</td>
				<td class='alt2'>$row[wins]</td>
				<td class='alt1'>$row[losses]</td>
				<td class='alt1'>$row[draws]</td>
				<td class='alt1'>$row[points]</td>
			</tr>";
		}
	}else{
		$c .= "<tr>
				<td colspan='13'>".XL_teamprofile_noevents."</td>
				</tr>";
	}
	$c .= "
    </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
				<td colspan='13'>&nbsp;</td>
            </tr>
        </tfoot>";
	$c .= "</table>
	</div>
	<div class='panel' id='panel4' style='display: none'>
	<table class='".X1plugin_teamprofiletable."' width='100%'>
        <thead class='".X1plugin_tablehead."'>
        	<tr>
            	<th>".XL_teamprofile_hid."</th>
            	<th>".XL_teamprofile_hevent."</th>
            	<th>".XL_teamprofile_hwinner."</th>
            	<th>".XL_teamprofile_hloser."</th>
            	<th>".XL_teamprofile_hdate."</th>
            	<th>".XL_teamprofile_hdetails."</th>
        	</tr>
    	</thead>
    	<tbody class='".X1plugin_tablebody."'>";
	$rows = $xdb->GetAll("
    SELECT * FROM ".X1_prefix.X1_DB_teamhistory."
    WHERE winner=".$xdb->qstr($_GET['teamname'])." OR loser=".$xdb->qstr($_GET['teamname'])."
    ORDER BY game_id DESC"); 
	if($rows){
		foreach($rows AS $row) {
			$event = $xdb->GetRow("select * 
			from ".X1_prefix.X1_DB_events." 
			where sid=".$xdb->qstr($row['laddername']));
			$c .= "
			<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
                <tr>
    				<td class='alt1'>$row[game_id]</td>
    				<td class='alt2'>$event[title]</td>
    				<td class='alt1'>$row[winner]</td>
    				<td class='alt2'>$row[loser]</td>
    				<td class='alt1'>".date(X1_dateformat, $row['date'])."</td>
    				<td class='alt2'>
    					<input name='".X1_actionoperator."' type='hidden' value='matchdetails'>
    					<input name='game_id' type='hidden' value='$row[game_id]'>
    					<input name='ladder' type='hidden' value='$row[laddername]'>
    					<input type='Submit' name='Submit' value='".XL_teamprofile_details."' >
    				</td>
    			</tr>
			</form>";
		} 
	}else{
		$c .="<tr>
				<td colspan='6'>".XL_teamprofile_nomatches."</td>
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
	return X1plugin_output($c);
}
?>