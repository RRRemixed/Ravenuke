<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.nukeladder.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################

function disputemanager() {
    global $xdb;
    $c = "
	<table class='".X1plugin_admintable."' width='100%'>
    	<thead class='".X1plugin_tablehead."'>
        	<tr>
        		<th>".XL_adisputes_id."</th>
        		<th>".XL_adisputes_sender."</th>
        		<th>".XL_adisputes_offender."</th>
        		<th>".XL_adisputes_event."</th>
        		<th>".XL_adisputes_date."</th>
				<!--<th>".XL_adisputes_view."</th>-->
        		<th>".XL_adisputes_delete."</th>
        	</tr>
        </thead>
		<tbody class='".X1plugin_tablebody."'> ";
	$rows = $xdb->GetAll("
    select dispute_id, sender, offender, ladder_id, date, info
    from ".X1_prefix.X1_DB_teamdisputes."
    order by dispute_id DESC");
	if($rows){
		foreach($rows AS $row){
			$ln = $xdb->GetRow("select title from ".X1_prefix.X1_DB_events." where sid=".$xdb->qstr($row['ladder_id']));
			$c .= "
			<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
			<tr>
				<td class='alt1'>$row[dispute_id]</td>
				<td class='alt2'>$row[sender]</td>
				<td class='alt1'>$row[offender]</td>
				<td class='alt2'>$ln[title]</td>
				<td class='alt1'>".date(X1_dateformat,$row['date'])."</td>
				<!--<td class='alt1'>
					<input name='id' type='hidden' value='$row[dispute_id]'>
					<input name='".X1_actionoperator."' type='hidden' value='viewdispute'>
					<input type='submit' value='".XL_view."'>
				</td>
				-->
				<td class='alt2'>
					<input name='id' type='hidden' value='$row[dispute_id]'>
					<input name='".X1_actionoperator."' type='hidden' value='deldispute'>
					<input type='submit' value='".XL_ok."'>
				</td>
			</tr>
			<tr>
				<td colspan='6'>".XL_adisputes_comments."$row[info]</td>
				</tr>
			</form>";
		}
	}else{
		$c .= "	<tr>
					<td colspan='6'>".XL_adisputes_none."</td>
				</tr>";
	}
	$c .= "
		</tbody>
		<tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='7'>&nbsp;</td>
        </tr>
    </tfoot>
    </table>";
	return X1plugin_output($c, 1);
}

function X1_removedispute(){
	global $xdb;
	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teamdisputes." WHERE dispute_id=".$xdb->qstr($_POST['id']));
    if($row){
		$xdb->Execute("DELETE FROM ".X1_prefix.X1_DB_teamdisputes." WHERE dispute_id=".$xdb->qstr($_POST['id']));
		$c = x1_admin("disputes");
		$c .= X1plugin_title("Dispute Removed");
	}else{
		$c = x1_admin("disputes");
		$c .= X1plugin_title("Error::");
	}
	return X1plugin_output($c);
}
?>