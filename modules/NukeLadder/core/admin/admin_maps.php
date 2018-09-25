<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.nukeladder.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function mapsmanager() {
   global $xdb;
    $c = "
	<table class='".X1plugin_admintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='4'>".XL_amaps_add."</th>
			<th>".XL_save."</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1' width='96%'  colspan='4'>
				<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
					<input type='int' value='2' size='2' name='num_maps'>
					<input type='image' title='".XL_amaps_add."' src='".X1_imgpath.X1_addimage."'>
					<input name='".X1_actionoperator."' type='hidden' value='addmaps''>
				</form>
			</td>
			<td class='alt2' width='4%' align='center'>
				<form action='".X1_adminpostfile."' method='POST' style='".X1_formstyle."'>
				<input type='image' title='".XL_save."' src='".X1_imgpath.X1_saveimage."'>
			</td>
		</tr>
		</tbody>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				<th>".XL_amaps_id."</th>
				<th>".XL_amaps_name."</th>
				<th>".XL_amaps_picture."</th>
				<th>".XL_amaps_download."</th>
				<th><img src='".X1_imgpath.X1_delimage."' title='".XL_delete."' border='0'></td>
			</tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>";
	$rows = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_maps." ORDER BY ladder_id  DESC LIMIT 500");
	$count = 0;
	if($rows){
		foreach($rows AS $row) {
			$c .= "<tr>
					<td class='alt1'><input type='text' name='nlv_".$count."[]' value='".$row[0]."' readonly size='2'></td>
					<td class='alt2'><input type='text' name='nlv_".$count."[]' value='".$row[1]."' size='10'></td>
					<td class='alt1'>
					<select name='nlv_".$count."[]'>";
			if ($handle = opendir(X1_imgpath.'/maps')) {
				while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != "..") {
						if ($file == $row[2]){
							$sel="selected";
						}else{
							$sel = "";
						}
						$c .= "<option $sel value='$file'>$file</option>\n";
						unset($sel);
					}
				}
				closedir($handle);
			}
			$c .= "</select>";
			$c .= "</td>";
			if ($row[3]!=""){
				$dl_link="<a href='".$row[3]."' target='_blank'>
				<img src='".X1_imgpath.X1_saveimage."' title='".XL_amaps_download."' border='0'>
				</a>";
			}else {
				$dl_link="";
			}
			$c .= " <td class='alt2'>
						<input type='text' name='nlv_".$count."[]'  value='".$row[3]."' size='10'> $dl_link</td>
					<td class='alt1' align='center'>
						<input type='checkbox' name='nlv_".$count."[]' value='checked'>
					</td>
				</tr>";
				$count++;
		}
	}else{
		$c .= "<tr><td colspan='5'>".XL_amaps_none."</td></tr>";
	}
		$c .= "
			</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='5'>&nbsp;
            <input type='hidden' name='".X1_actionoperator."' value='updatemaps'>
            <input type='hidden' name='num_rows' value='$count'>
            </td>
        </tr>
    </tfoot>
    </table>
	</form>";
	return X1plugin_output($c, 1);
 }


function updatemaps(){
	global $xdb;
	for ($i=0; $i < $_POST['num_rows']; $i++) {
		$nlv_info = "nlv_".$i;
    	list($mapid, $mapname, $mappic, $mapdl, $checked) = $_POST[$nlv_info];
		$iq = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_maps." WHERE mapid=".$xdb->qstr($mapid));
		if($iq){
			$xdb->Execute("UPDATE ".X1_prefix.X1_DB_maps." SET
			mapname=".$xdb->qstr($mapname).",
			mappic=".$xdb->qstr($mappic).",
			mapdl=".$xdb->qstr($mapdl)." 
			WHERE mapid=".$xdb->qstr($mapid));
		}
		if($checked=="checked"){
			$xdb->Execute("delete from ".X1_prefix.X1_DB_maps." where mapid=".$xdb->qstr($mapid));
		}
	}
	$c  = x1_admin("maps");
	$c .= X1plugin_title(XL_amaps_updated);
    return X1plugin_output($c);
}

function addmaps(){
	global $xdb;
	for ($i=0; $i<$_POST['num_maps']; $i++) {
		$result = $xdb->Execute("insert into ".X1_prefix.X1_DB_maps." values(NULL,'','', '', '0')");
	}
	$c  = x1_admin("maps");
	$c .= X1plugin_title($_POST['num_maps'].XL_amaps_added);
	return X1plugin_output($c);
}
?>