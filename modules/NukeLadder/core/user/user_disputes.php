<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function disputeform() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin()){
		$c .= XL_notlogggedin;
		return X1plugin_output($c);
	}
	list ($cookieteamid, $cookieteam, $password) = cookieread();
	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teamchallenges." WHERE randid = ".$xdb->qstr($_POST['randid'])); 
	$row2 = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." WHERE sid =".$xdb->qstr($row['ladder_id'])); 
	$otherteam = ($losername == $cookieteam) ? $row["winner"] : $row["loser"];
	$c .= "
	<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
	<table class='".X1plugin_disputestable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2'>".XL_teamdisputes_filedispute."</th>
		</tr>
	</thead>
	<tbody class='".X1plugin_tablebody."'>
	<tr>
		<td class='alt1'>".XL_teamdisputes_winner."</td>
		<td class='alt1'><input type='text' name='offender' value='$otherteam' disabled></td></tr>
	<tr>
		<td class='alt2'>".XL_teamdisputes_loser."</td>
		<td class='alt2'><input type='text' name='sender' value='$cookieteam' disabled></td>
	</tr>
	<tr>
		<td class='alt1'>".XL_teamdisputes_event.":</td>
		<td class='alt1'><input type='text' name='laddername' value='$row2[title]' disabled></td>
	</tr>
	<tr> 
		<td class='alt2'>".XL_teamdisputes_comments."</td>
		<td class='alt2'><textarea name='comments'cols='50' wrap='VIRTUAL' rows='5'></textarea></td>
	</tr>
	</tbody>
	<tfoot class='".X1plugin_tablefoot."'>
		<tr>
			<th colspan='2'>
				<input type='Submit' name='Submit' value='".XL_teamdisputes_button."' >
				<input name='".X1_actionoperator."' type='hidden' value='dispute'>
				<input name='ladder_id' type='hidden' value='$row[ladder_id]'>
				<input name='randid' type='hidden' value='$row[randid]'>
			</th>
		</tr>
	</tfoot>
	</table>
	</form>";
	return X1plugin_output($c);
}

function dispute() {
	global $xdb;
	$c  = X1plugin_style();
	if(!checklogin()){
		$c .=  X1plugin_title(XL_notlogggedin);
		return X1plugin_output($c);
	}
	list ($cookieteamid, $cookieteam, $password) = cookieread();
	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teamchallenges." WHERE randid = ".$xdb->qstr($_POST['randid'])); 
	$row2 = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." WHERE sid =".$xdb->qstr($row['ladder_id'])); 
	$otherteam = ($losername == $cookieteam) ? $row["winner"] : $row["loser"];
	if ($otherteam == $cookieteam) { 
		$c .=  X1plugin_title(XL_teamdisputes_error); 
		return X1plugin_output($c); 
	} 
	modifysql("INSERT INTO", X1_DB_teamdisputes, "
	(sender, offender, ladder_id, date, info)
	 VALUES 
	 (
	 ".$xdb->qstr($cookieteam).", 
	 ".$xdb->qstr($otherteam).", 
	 ".$xdb->qstr($row2['sid']).", 
	 ".$xdb->qstr(time()).", 
	 ".$xdb->qstr($_POST['comments'])."
	 )");
	$c .=  X1plugin_title(XL_teamdisputes_submitted);
	return X1plugin_output($c);
}
?>