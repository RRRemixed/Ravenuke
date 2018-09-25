<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function pastmatches($laddername=0, $limit="", $rt=0) {
	global $xdb;
	if(isset($_POST['sid'])){
		$laddername=$_POST['sid'];
	}
	$c = X1plugin_style();
	$c .= "
	<table class='".X1plugin_pastmatchestable."' width='100%'>
    	<thead class='".X1plugin_tablehead."'>
        	<tr>
        		<th>".XL_matchhistory_id.":</th>
        		<th>".XL_matchhistory_winner."</th>
        		<th>".XL_matchhistory_loser."</th>
        		<th>".XL_matchhistory_date."</th>
				<th>".XL_matchhistory_draw."</th>
        		<th>".XL_matchhistory_details."</th>
        	</tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>";
	if($limit!=""){
		$limit="LIMIT $limit";
	}
	$rows = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamhistory." 
	WHERE laddername=".$xdb->qstr($laddername)." ORDER BY game_id DESC $limit"); 
	if($rows){
		foreach($rows As $row){
			$draw = ($row['draw']) ? XL_yes : XL_no;
			$c .="
			<form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
			<tr>
				<td class='alt1'>$row[game_id]</td>
				<td class='alt2'>
					<a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=".
					str_replace(" ", "+", $row["winner"])."'>$row[winner]</a></td>
				<td class='alt1'>
					<a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=".
					str_replace(" ", "+", $row["loser"])."'>$row[loser]</a></td>
				<td class='alt2'>".date(X1_dateformat, $row['date'])."</td>
				<td class='alt1'>$draw</td>
				<td class='alt2'>
					<input name='".X1_actionoperator."' type='hidden' value='matchdetails'>
					<input name='game_id' type='hidden' value='$row[game_id]'>
					<input type='Submit' name='Submit' value='".XL_matchhistory_button."' >
				</td>
			</tr>
			</form>";
		}
	}else{
		$c .= "
		<tr>
			<td colspan='6'>".XL_matchhistory_none."</td>
		</tr>";
	}
	    $c .= "</tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='6'>&nbsp;</td>
            </tr>
        </tfoot>
    </table>
	<br/>";
	if($rt){
        return $c;
    }else{
        print $c;
    }
}
?>