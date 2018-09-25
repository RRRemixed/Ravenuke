<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
##Revision 09092006
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function teamlist() {

	#Database
	global $xdb;
	
	#Load Style
	$c  = X1plugin_style();
	
	#Count total Teams
	$tt = $xdb->Execute("SELECT count(*) FROM ".X1_prefix.X1_DB_teams);
	$totalteams = $tt->fields[0];
	
	#Get Page Number
	$page = (!isset($_GET['page'])) ? 1 : X1_clean($_GET['page']);
	
	$limit = (isset($_REQUEST['limit'])) ? X1_clean($_REQUEST['limit']) : X1_teamlistlimit;
	
	#Get Page Limit
	$limitvalue = $page * $limit - ($limit);
	
	#Total Number of Pages
	$pages = $totalteams / $limit;
	
	#Set Column Span 
	$colspan = (check_admin()) ? 8 : 6;
	
	#Title
	$c .= X1plugin_title(XL_teamlist_title);
	
	#Table Head
	$c .=  "<table class='".X1_teamlistclass."' width='100%'>
            <thead class='".X1plugin_tablehead."'>
    			<tr>
    				<th>".XL_teamlist_hcountry."</th>
    				<th>".XL_teamlist_hname."</th>
    				<th>".XL_teamlist_hcontact."</th>
    				<th>".XL_teamlist_hmembers."</th>
    				<th>".XL_teamlist_hevents."</th>
					<th>".XL_teamlist_recruiting."</th>";
	#If Admin, show extra columns
	if(check_admin()){
			$c .=  "<th align='center'><img src='".X1_imgpath.X1_editimage."'/></th>
					<th align='center'><img src='".X1_imgpath.X1_delimage."'/></th>";
    }
	$c .=  "	</tr>
            </thead>
			<tbody class='".X1plugin_tablebody."'>";
	
	#Query Database for this page
	$rows = $xdb->GetAll("
	SELECT * FROM ".X1_prefix.X1_DB_teams." 
	ORDER BY name ASC 
	LIMIT $limitvalue, ".$limit);
	
	#If rows are returned
	if($rows){
		#Loop through the rows
		foreach($rows AS $row){
			
			#GCaptain Contact Info
			list ($capmaillink, $capmsnlink, $capicqlink, $capaimlink, $capyimlink, $capweblink, $avatar) = contacticons($row["playerone"]);
			$maillink = ($row["mail"] == XL_na) ? XL_na : "<a href='mailto:$row[mail]'><img src='".X1_imgpath."/mail.gif' width='21' height='17' border='0'></a>";
			$weblink = (!empty($row["homepage"])) ? "" : "<a href='$row[homepage]' target='_blank'><img src='".X1_imgpath."/home.gif' width='21' height='17' border='0' title=$row[homepage]></a>";
			$maillink = (!empty($row["ircserver"])) ? "" :"<a href='irc://$row[ircserver]/$row[ircchannel]'><img src='".X1_imgpath."/mirc.gif' title='$row[ircserver] / #$row[ircchannel]' width='21' height='17' border='0'></a>";
			
			#Total Members
			$tm = $xdb->Execute("SELECT count(*) FROM ".X1_prefix.X1_DB_teamroster." WHERE team_id=".X1_clean($row['team_id']));
			$totalmembers = $tm->fields[0];
			
			
			#Total Events Joined
			$te = $xdb->Execute("SELECT count(*) FROM ".X1_prefix.X1_DB_teamsevents." WHERE team_id=".X1_clean($row['team_id']));
			$totalevents = $te->fields[0];
			
			
			#Recruiting
			$rout = ($row['recruiting']) ? XL_yes:XL_no;
			
			#Table Rows
			$c .=  "<tr>
                    <td class='alt1'>
                    <img src='".X1_imgpath."/flags/".X1_clean($row['country']).".bmp' align='absmiddle'> ".X1_clean($row['country'])."</td>
                    <td class='alt2'><a href=".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=".urlencode(X1_clean($row['name'])).">".X1_clean($row['name'])."</a></td>
                    <td class='alt1'>$maillink $weblink $capmsnlink $capicqlink $capaimlink $capyimlink</td>
                    <td class='alt2'>".X1_clean($totalmembers)."</td>
                    <td class='alt1'>".X1_clean($totalevents)."</td>
					<td class='alt2'>".X1_clean($rout)."</td>";
					#If admin, add extra columns
					if(check_admin()){
						$c .=  "
						<td class='alt1' align='center'>
							<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
								<input type='hidden' value='$row[team_id]' name='team_id'>
								<input type='image' title='".XL_edit."' src='".X1_imgpath.X1_editimage."'>
								<input name='".X1_actionoperator."' type='hidden' value='modifyTeam''>
							</form>
							</td>
							<td class='alt2' align='center'>
							<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
								<input type='hidden' value='$row[team_id]' name='team_id'>
								<input type='hidden' value='$limit' name='limit'>
								<input type='image' title='".XL_delete."' src='".X1_imgpath.X1_delimage."'>
								<input name='".X1_actionoperator."' type='hidden' value='delTeam''>
							</form>
						</td>
						";
					}
		$c .=  "</tr>";
		}
	}
	#Table Footer and Pagination
	$c .=  "</tbody>
	<tfoot class='".X1plugin_tablefoot."'>
		<tr>
			<th colspan='$colspan' align='center'>";
		if($pages > 1){
			if($page != 1){
				$pageprev = $page-1;
				$c .= "<a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamlist&page=$pageprev'>".XL_teamlist_prev.X1_teamlistlimit."</a>&nbsp;";
			}else {
				$c .= XL_teamlist_prev.X1_teamlistlimit."&nbsp;";
			}
			for($i = 1; $i <= $pages; $i++){
				if($i == $page){
					$c .= $i."&nbsp;";
				}else{
					$c .= "<a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamlist&page=$i'>$i</a>&nbsp;";
				}
			}
			if(($totalteams % X1_teamlistlimit) != 0){
				if($i == $page){
					$c .= $i."&nbsp;";
				}else{
					$c .= "<a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamlist&page=$i'>$i</a>&nbsp;";
				}
			}
			if(($totalteams - (X1_teamlistlimit * $page)) > 0){
				$pagenext=$page+1;
				$c .= "<a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamlist&page=$pagenext'>".XL_teamlist_next.X1_teamlistlimit."</a>";
			}else{
				$c .= XL_teamlist_next.X1_teamlistlimit;
			}
		}else{
			$c .= "&nbsp;";
		}
		$c .=  "</th>
		</tr>
	</tfoot>
	</table>";
	#Return Output
	return X1plugin_output($c);
}
?>