<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function playerprofile() {
	global $xdb;
	$c  = X1plugin_style();
	$c .= X1plugin_title(XL_playerprofile_title);
	$c .= "<table class='".X1plugin_playerprofiletable."' width='100%'>";
	$row = $xdb->GetRow("
    SELECT * FROM ".X1_userprefix.X1_DB_userstable."
    WHERE ".X1_DB_usersnamekey."=".$xdb->qstr($_REQUEST['member']));

	if($row){
		$countrylink = (empty($row[X1_DB_userslocationkey])) ?  XL_na : $row[X1_DB_userslocationkey];
		$homepagelink = (empty($row[X1_DB_usersewebkey])) ? XL_na : $row[X1_DB_usersewebkey];
		list ($maillink, $msnlink, $icqlink, $aimlink,
        $yimlink, $weblink, $avatar) = contacticons($row[X1_DB_usersnamekey]);
		$c .= "
		<thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th colspan='2'>".XL_playerprofile_title."</th>
    		</tr>
		</thead>
		<tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1'>".XL_playerprofile_homepage."</td>
			<td class='alt1'><a href='".$row[X1_DB_usersewebkey]."' target='_blank'> ".$row[X1_DB_usersewebkey]."</a></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_playerprofile_location."</td>
			<td class='alt2'><a href='".$row[X1_DB_usersewebkey]."' target='_blank'>$countrylink</a></td>
		</tr>
		<tr>
			<td class='alt1'>".XL_playerprofile_contact."</td>
			<td class='alt1'><a href='".$row[X1_DB_usersewebkey]."' target='_blank'>
            $maillink $msnlink $yimlink $aimlink $icqlink $weblink</a></td>
		</tr>
		<tr>
			<td class='alt2'>".XL_playerprofile_reg."</td>
			<td class='alt2'><a href='".$row[X1_DB_usersewebkey]."' target='_blank'>".$row[X1_DB_usersregdatekey]."</a></td>
		</tr>";
	}else{
		$c .= "
		<tr>
			<td>".XL_playerprofile_missing."</td>
		</tr>";
	}
	$c .= "    </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
				<td colspan='6'>&nbsp;</td>
            </tr>
        </tfoot>
        </table>
        <br/>";
    $c .= X1plugin_title(XL_playerprofile_joinedteams);
	$c .= "
	<table class='".X1plugin_playerprofiletable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr> 
			<th>".XL_playerprofile_id."</th>
			<th>".XL_playerprofile_country."</th>
			<th>".XL_playerprofile_team."</th>
			<th>".XL_playerprofile_tags."</th>
			<th>".XL_playerprofile_mail."</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>";
	$rows= $xdb->GetAll("
    SELECT * FROM ".X1_prefix.X1_DB_teamroster."
    WHERE uid=".$xdb->qstr($row[X1_DB_usersidkey])."
    ORDER BY joindate ASC");
	if($rows){
		$rank = 1;
		foreach($rows As $row){
			$row1= $xdb->GetRow("
            SELECT * FROM ".X1_prefix.X1_DB_teams."
            WHERE team_id = $row[team_id]");
			if(!empty($row1['name'])){
				$c .= "
				<tr> 
					<td class='alt1'>$row[team_id].</td>
					<td class='alt2'>
                    <img src='".X1_imgpath."/flags/$row1[country].bmp' width='20' height='15' border='0'>$row1[country]</td>
					<td class='alt1'><a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=$row1[name]'>$row1[name]</a></td>
					<td class='alt2'><a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=$row1[name]'>$row1[clantags]</a></td>
					<td class='alt1'>
					<a href='mailto:$row1[mail]'><img src='".X1_imgpath."/mail.gif' border='0'></a>
					</td>
				</tr>";
				$rank++;
			}
		}
	}else{
        $c .= "<tr>
				<td>".XL_playerprofile_none."</td>
				</tr>";
	}
	$c .= "    </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
				<td colspan='6'>&nbsp;</td>
            </tr>
        </tfoot>
        </table>";
	return X1plugin_output($c);
}
?>