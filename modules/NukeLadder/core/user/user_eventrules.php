<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function eventrules() {
	global $xdb;
	$c = X1plugin_style();
	$c .= "
	<table class='".X1plugin_rulestable."' width='100%'>
    	<thead class='".X1plugin_tablehead."'>
        	<tr>
        		<th>".XL_eventrules_title.":</th>
        	</tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>";
	if($limit!=""){
		$limit="LIMIT $limit";
	}
	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	WHERE sid=".$xdb->qstr(X1_clean($_POST['sid']))); 
	if($row){
			$c .="
			<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
			<tr>
				<td class='alt1'>".stripslashes(utf8_decode($row['hometext']))." 
				<hr noshade><br />".stripslashes(utf8_decode($row['bodytext']))."</td>
			</tr>
			</form>
			";
	}else{
		$c .= "
		<tr>
			<td>".XL_eventrules_none."</td>
		</tr>";
	}
	    $c .= "</tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </tfoot>
    </table>";
	return X1plugin_output($c);
}
?>