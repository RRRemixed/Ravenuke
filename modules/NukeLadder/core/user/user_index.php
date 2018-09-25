<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak  2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function X1plugin_index(){
	global $xdb;
	$where = (!empty($_GET['game'])) ? "WHERE gameid=".$xdb->qstr($_REQUEST['game']) : "";
	$rows = $xdb->GetAll("select * from ".X1_prefix.X1_DB_games." $where ORDER BY gametext");
	$c  = X1plugin_style();
	$c .= X1plugin_title(XL_index_title);
    $c .= "<table class='".X1_teamlistclass."' width='100%'>
            <thead class='".X1plugin_tablehead."'>
    			<tr>
        			<td>".XL_index_image."</td>
                    <td>".XL_index_events."</td>
                </tr>
            </thead>
            <tbody class='".X1plugin_tablebody."'>";
	if ($rows) {
		foreach($rows AS $row){
			$c .= "
            <tr>
				<td class='alt1'>
                    <a href='".X1_publicgetfile."?".X1_linkactionoperator."=home&amp;game=$row[gameid]'>
					   <img src='".X1_imgpath."/games/$row[gameimage]' border='0' title='$row[gametext]'>
					</a>
				</td>";
			$results = $xdb->GetAll("select * from ".X1_prefix.X1_DB_events." 
			WHERE game=".$xdb->qstr($row['gameid'])." ORDER BY sid DESC");
			$c .="<td class='alt2'>";
			if ($results) {
				foreach($results As $row1) {
					$c .= "<a href='".X1_publicgetfile."?".X1_linkactionoperator."=ladderhome&amp;sid=$row1[sid]'>$row1[title]</a><br/>";
				}
			}else {
				$c .= XL_index_none;
			}
			$c .= "</td>
            </tr>";
		}
	}else{
		$c .= "<tr>
				<td colspan='2' class='alt1'>".XL_index_none."</td>
            </tr>";
	}
    $c .= "</tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='2'>&nbsp;</td>
            </tr>
        </tfoot>
    </table>";
	return X1plugin_output($c);
}
?>