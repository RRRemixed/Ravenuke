<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function newmatches($sid=0, $limit="", $rt=0) {
	global $xdb;
	$c  = X1plugin_style();
	$c .= "
	<table class='".X1plugin_newmatchestable."' width='100%'>
        <thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th>".XL_matchpreview_date."</th>
    			<th>".XL_matchpreview_challenger."</th>
    			<th>".XL_matchpreview_challenged."</th>
    			<th>".XL_matchpreview_matchdate."</th>
    		</tr>
		</thead>
		<tbody class='".X1plugin_tablebody."'>";
	if(!empty($limit)){
		$limit="LIMIT $limit";
	}else{
		$limit = "";
	}
	$rows = $xdb->GetAll("
    SELECT * FROM ".X1_prefix.X1_DB_teamchallenges."
    WHERE ladder_id=".$xdb->qstr($sid)."
    ORDER BY date DESC $limit");
	if($rows){
		foreach($rows AS $row){
			$c .="
			<tr>
				<td class='alt1'>".date(X1_dateformat,$row['date'])."</td>
				<td class='alt2'>
                <a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=".
				str_replace(" ", "+", $row["loser"])."'>$row[loser]</a>
                </td>
				<td class='alt1'>
                <a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=".
				str_replace(" ", "+", $row["winner"])."'>$row[winner]</a>
                </td>
				<td class='alt2'>".date(X1_extendeddateformat,$row['matchdate'])."</td>
			</tr>";
		}
	}else{
		$c .= "
		<tr>
			<td colspan='4'>".XL_matchpreview_none."</td>
		</tr>";
	}
	    $c .= "</tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='4'>&nbsp;</td>
            </tr>
        </tfoot>
    </table>
	<br />";
    if($rt){
        return $c;
    }else{
        print $c;
    }
}
?>