<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function listmaps() {
	global $xdb;
	$c = X1plugin_style();
	$event = $xdb->GetRow("
        SELECT * FROM ".X1_prefix.X1_DB_events."
        WHERE sid=".$xdb->qstr($_REQUEST['id']));
    if(!$event){
        return X1plugin_output("Failed to load maplist");
    }
	$game  = $xdb->GetRow("
        SELECT * FROM ".X1_prefix.X1_DB_games."
        WHERE gameid=".$xdb->qstr($event['game']));
    if(!$game){
        return X1plugin_output("Failed to load maplist");
    }
	$c .= X1plugin_title(XL_maplist_title.$event['title'])."
		<table class='".X1plugin_mapslist."' width='100%'>
			<thead class='".X1plugin_tablehead."'>
				<tr>
					<th>".XL_maplist_image."</th>
					<th>".XL_maplist_name."</th>
					<th>".XL_maplist_download."</th>
				</tr>
			</thead>";
	$groups = explode(",",$event['mapgroups']);
	foreach($groups AS $group){
			$row = $xdb->GetRow("
				select * from ".X1_prefix.X1_DB_mapgroups."
				where id=".$xdb->qstr($group));
			$c .="<thead class='".X1plugin_tablehead."'>
					<tr>
						<th align='center' colspan='3'>$row[name]</th>
					</tr>
				</thead>
				<tbody class='".X1plugin_tablebody."'>";
			$arr = explode(",",$row['maps']);
			if(is_array($arr)){
				foreach($arr AS $map){
					if(!empty($map)){
						$map_row = $xdb->GetRow("
						select * from ".X1_prefix.X1_DB_maps."
						where mapid=".$xdb->qstr($map));
						list($mapid, $mapname, $mappic, $mapdl) = $map;
						if (empty($map_row['mapdl'])) {
							$download = XL_maplist_nodownload;
						}else{
							$download = "<a href='$map_row[mapdl]'>
							<img src='".X1_imgpath."/download.gif'border='0' title='".XL_maplist_download."'>
							</a>";
						}
						$c .= "
						<tr>
							<td><img src='".X1_imgpath."/maps/$map_row[mappic]'
							title='$map_row[mapid]' width='80' height='80' border='0'></td>
							<td>$map_row[mapname]</td>
							<td>$download</td>
						</tr>";
					}	
				}
			}else{
			   $c .= "<tr>
						<td colspan='3'>".XL_maplist_none."</td>
					</tr>";
			}
			$c .= "</tbody>";
	}
	$c .= "<tfoot class='".X1plugin_tablefoot."'>
					<tr>
						<td colspan='3'>&nbsp;</td>
					</tr>
				</tfoot>
			</table>";
	return X1plugin_output($c);
}
?>