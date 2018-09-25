<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function ladderhome() {
	global $xdb;
	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." WHERE sid=".$xdb->qstr(X1_clean($_REQUEST['sid'])));
	$event['sid'] = X1_clean($event['sid']);
	$event['type'] = X1_clean($event['type']);
	$rungsup=$event['score'];
	$rungsdown=$event['ratings'];
	$result = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamsevents." WHERE ladder_id=".$xdb->qstr(X1_clean($event['sid'])));
	$numberofplayersin = count($result);	  
	$c  = X1plugin_style();
	$c .= standings($event['sid'], X1_topteamlimit);
    $c .= X1plugin_title(XL_eventhome_viewtitle);
	$c .=  "
	<table class='".X1plugin_newmatchestable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				<th colspan='4'>&nbsp;</th>
			</tr>
		</thead>
		<tbody class='".X1plugin_tablebody."'>
			<tr>
				<td align='center'>
					<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
						<input name='Maps List' value='".XL_eventhome_mapsbutton."' type='submit'>
						<input name='id' type='hidden' value='$event[sid]'>
						<input name='".X1_actionoperator."' type='hidden' value='listmaps'>
					</form>
				</td>
				<td align='center'>
					<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
						<input name='standings' value='".XL_eventhome_standingsbutton."' type='submit'>
						<input name='sid' type='hidden' value='$event[sid]'>
						<input name='".X1_actionoperator."' type='hidden' value='standings'>
					</form>
				</td>
				<td align='center'>
					<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
						<input name='submit' value='".XL_eventhome_viewhistory."' type='submit'>
						<input name='sid' type='hidden' value='$event[sid]'>
						<input name='".X1_actionoperator."' type='hidden' value='pastmatches'>
					</form>
				</td>
				<td align='center'>
					<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
						<input name='submit' value='".XL_eventhome_viewrules."' type='submit'>
						<input name='sid' type='hidden' value='$event[sid]'>
						<input name='".X1_actionoperator."' type='hidden' value='eventrules'>
					</form>
				</td>
			</tr>
		</tbody>
		<tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='4'>&nbsp;</td>
            </tr>
        </tfoot>
    </table>
	<br />";
	$c .= X1plugin_title(XL_eventhome_newmatches);
	$c .= newmatches($event['sid'], X1_newmatchlimit,1);

	$c .= X1plugin_title(XL_eventhome_pastmatches);
	$c .= pastmatches($event['sid'],X1_resultslimit,1);

	$c .= X1plugin_title(XL_eventhome_settings);
    $c .= laddersettings($event['sid']);
    $c .= "<br/>";
	require_once(X1_modpath."/$event[type]/language/".X1_corelang.".php");
	require_once(X1_modpath."/$event[type]/modinfo.php");
	return X1plugin_output($c);
}

function laddersettings($sid){
	global $xdb;
	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	WHERE sid=".$xdb->qstr($sid));
	if($row){
		$active = ( $row['active'] ) ? XL_yes : XL_no; 
		$enabled = ( $row['enabled'] ) ? XL_yes : XL_no;
		$restrictdates = ( $row['restrictdates'] ) ? XL_yes : XL_no;
		$restrictmaps = ( $row['restrictmaps'] ) ? XL_yes : XL_no;
		return "
		<table class='".X1plugin_ladderhometable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
			<tr>	
				<th colspan='2'>&nbsp;</td>
			</tr>
		</thead>
		<tbody class='".X1plugin_tablebody."'>
			<tr>
				<td align='left' width='50%' class='alt1'>
					<ul>
						<li>".XL_eventhome_active."  $active
						<li>".XL_eventhome_enabled."  $enabled
						<li>".XL_eventhome_timezone."  $row[timezone]
						<li>".XL_eventhome_numdates."  $row[numdates]
						<li>".XL_eventhome_dupedates."  $restrictdates
						<li>".XL_eventhome_maps1."  $row[nummaps1]
						<li>".XL_eventhome_maps2."  $row[nummaps2]
						<li>".XL_eventhome_dupemaps."  $restrictmaps
					</ul>
				</td>
				<td align='left' width='50%' class='alt2'>
					<ul>
						<li>".XL_eventhome_pointswin."  $row[pointswin]
						<li>".XL_eventhome_pointsloss."  $row[pointsloss]
						<li>".XL_eventhome_pointsdecline."  -$row[declinepoints]
						<li>".XL_eventhome_gamesday."  $row[gamesmaxday]
						<li>".XL_eventhome_challlimit."  $row[challengelimit]
						<li>".XL_eventhome_timeout."  $row[challengedays]
						<li>".XL_eventhome_maxteams."  $row[maxteams]
						<li>".XL_eventhome_rostermin."  $row[minplayers]
					</ul>
				</td>
			</tr>
			</tbody>
			<tfoot class='".X1plugin_tablefoot."'>
				<tr>	
					<th colspan='2'>&nbsp;</td>
				</tr>
			</tfoot>
		</table>";
	}else{ 
	}
}
?>