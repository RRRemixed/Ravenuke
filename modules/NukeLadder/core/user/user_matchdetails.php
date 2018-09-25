<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function matchdetails() {
	global $xdb;
	$c  = X1plugin_style();
	$row = $xdb->GetRow("
    SELECT * FROM ".X1_prefix.X1_DB_teamhistory."
    WHERE game_id=".$xdb->qstr($_REQUEST['game_id'])." 
    LIMIT 1");
    if(!$row){
      $c .= X1plugin_title(XL_matchinfo_notfound);
      return;
    }
	$event = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_events." 
	where sid=".$xdb->qstr($row['laddername']));
	$demolink = (empty($row["demo"])) ? XL_matchinfo_nodemo : "<a href='$row[demo]' targer='_blank'>".XL_matchinfo_demo."</a>";
	if($row['draw']) $c .= X1plugin_title(XL_matchinfo_gamewasdraw);
    $c .= "
    <table class='".X1plugin_matchdetailstable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				<th>".XL_matchinfo_event."</th>
				<th>".XL_matchinfo_winner."</th>
				<th>".XL_matchinfo_loser."</th>
				<th>".XL_matchinfo_date."</th>
				<th>".XL_matchinfo_demo."</th>
			</tr>
		</thead>
		<tbody class='".X1plugin_tablebody."'>
			<tr>
				<td class='alt1'><a href='".X1_publicgetfile."?".X1_linkactionoperator."=ladderhome&sid=$event[sid]'>$row[laddername]</a></td>
				<td class='alt2'><a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=".str_replace(" ", "+", $row["winner"])."'>$row[winner]</a></td>
				<td class='alt1'><a href='".X1_publicgetfile."?".X1_linkactionoperator."=teamprofile&teamname=".str_replace(" ", "+", $row["loser"])."'>$row[loser]</a></td>
				<td class='alt2'>".date(X1_dateformat,$row['date'])."</td>
				<td class='alt1'>$demolink</td>
			</tr>
		</tbody>
		<tfoot class='".X1plugin_tablefoot."'>
			<tr>
				<td colspan='5'>".XL_matchinfo_comments.": $row[comments]</td>
			</tr>
		</tfoot>
	</table>
	<br />
	<table class='".X1plugin_matchdetailstable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				<th>".XL_matchinfo_screen1."</th>
				<th>".XL_matchinfo_screen2."</th>
			</tr>
		</thead>
	<tbody class='".X1plugin_tablebody."'>
	<tr> ";
	if(!empty($row['map3t1'])){
		$c .= "<td><a href='$row[map3t1]'><img src='$row[map3t1]' border='0' width='100' height='100'></a></td>";
	}else{
		$c .= "<td>".XL_matchinfo_noscreen."</td>";
	}
	if(!empty($row['map3t2'])){
		$c .= "<td align='center'><a href='$row[map3t2]'><img src='$row[map3t2]' border='0' width='100' height='100'></a></td>";
	}else{
		$c .= "<td>".XL_matchinfo_noscreen."</td>";
	}
	$c .= "
	</tr>
	</tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='2'>&nbsp;</td>
            </tr>
        </tfoot>
    </table>
	<br/>
	<table class='".X1plugin_matchdeatailstable."' width='100%'>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				<th>".XL_matchinfo_mapimage."</td>
				<th>".XL_matchinfo_mapname."</th>
				<th>$row[winner]</th>
				<th>$row[loser]</th>
			</tr>
		</thead>
		<tbody class='".X1plugin_tablebody."'>";

	$scoresarryW1 = explode(",",$row['map1t1']);
	$scoresarryL1 = explode(",",$row['map1t2']);
	$scoresarryW2 = explode(",",$row['map2t1']);
	$scoresarryL2 = explode(",",$row['map2t2']);
	
	$mapsarry = explode(",",$row['map1']);
	$curmap=0;
	while($curmap < $event['nummaps1']){
		list ($mapname, $mappic, $mapdl) = mapinfo($event['sid'], $mapsarry[$curmap]);
		$c .= "
		<tr>
			<td class='alt1'><img src='".X1_imgpath."/maps/$mappic' border='0'></td>
			<td class='alt2'>$mapname</td>
			<td class='alt1'>$scoresarryW1[$curmap]</td>
			<td class='alt2'>$scoresarryL1[$curmap]</td>
		</tr>";
		$curmap++;
	}
	$mapsarry=explode(",",$row['map2']);
	$curmap=0;
	while($curmap < $event['nummaps2']){
		list ($mapname, $mappic, $mapdl) = mapinfo($event['sid'], $mapsarry[$curmap]);
		$c .= "
		<tr>
			<td class='alt1'><img src='".X1_imgpath."/maps/$mappic' border='0'></td>
			<td class='alt2'>$mapname</td>
			<td class='alt1'>$scoresarryW2[$curmap]</td>
			<td class='alt2'>$scoresarryL2[$curmap]</td>
		</tr>";
		$curmap++;
	}
	$c .= "</tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='4'>&nbsp;</td>
            </tr>
        </tfoot>
    </table>";
	return X1plugin_output($c);
}
?>