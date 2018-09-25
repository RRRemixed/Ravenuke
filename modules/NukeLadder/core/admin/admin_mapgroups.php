<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################

function mapgroups() {
    global $xdb;
	$limit = (!empty($_GET["groupslimit"])) ? $_REQUEST["groupslimit"] :X1_adminquerylimit ;
	$page = (!empty($_GET["groupspage"])) ? $_REQUEST["groupspage"] :1;
	$limitvalue = $page * $limit - ($limit); 
	$result = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_mapgroups);
	$totalgroups = count($result);
	$c ="<table class='".X1plugin_admintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='4' align='left'>".XL_amapgroups_add."</th>
			<th>".XL_save."</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1' width='96%' colspan='4'>
				<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
					<input type='int' value='2' size='2' name='num_mapgroups'>
					<input type='image' title='".XL_amapgroups_add."' src='".X1_imgpath.X1_addimage."'>
					<input name='".X1_actionoperator."' type='hidden' value='addmapgroups''>
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
				<th>".XL_amapgroups_id."</th>
				<th>".XL_amapgroups_name."</th>
				<th>".XL_amapgroups_contents."</th>
				<th>".XL_amapgroups_edit."</th>
				<th><img src='".X1_imgpath.X1_delimage."' title='".XL_delete."' border='0'></td>
			</tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>";
	$rows = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_mapgroups." ORDER BY id LIMIT 500");
	$count = 0;
	if($rows){
		foreach($rows AS $row){
			$tents = explode(",",$row[2]);
			$tents = array_chunk($tents, 3);
			if(is_array($tents))$contents = implode(",", X1_mapid2names($tents[0]));
			$c .= "<tr>
					<td class='alt1'><input type='text' name='nlv_".$count."[]' value='".$row[0]."' readonly size='2'></td>
					<td class='alt2'><input type='text' name='nlv_".$count."[]' value='".$row[1]."' size='30'></td>
					<td class='alt1'>$contents</td>
					<td class='alt2'><a href='".$_SERVER['SCRIPT_NAME']."?".X1_linkactionoperator."=addmapstogroup&amp;groupid=$row[0]'>".XL_edit."</a></td>
					<td class='alt1' align='center'><input type='checkbox' name='nlv_".$count."[]' value='checked'>
					</td>
				</tr>";
				$count++;
		}
	}else{
		$c .= "<tr><td colspan='6'>".XL_amapgroups_none."</td></tr>";
	}
		$c .= "
			</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='6'>&nbsp;
            <input type='hidden' name='".X1_actionoperator."' value='updatemapgroups'>
            <input type='hidden' name='num_rows' value='$count'>
            </td>
        </tr>
    </tfoot>
    </table>
	</form>";
	return X1plugin_output($c, 1);
}


function updatemapgroups(){
	global $xdb;
	for ($i=0; $i < $_POST['num_rows']; $i++) {
		$nlv_info = "nlv_".$i;
		list($mapgid, $mapgname,  $checked) = $_POST[$nlv_info];
		
		$iq = $xdb->GetRow("SELECT * 
		FROM ".X1_prefix.X1_DB_mapgroups." 
		WHERE id=".$xdb->qstr($mapgid));
		if($iq){
			$xdb->Execute("UPDATE ".X1_prefix.X1_DB_mapgroups." 
			SET name=".$xdb->qstr($mapgname)." 
			WHERE id=".$xdb->qstr($mapgid));
		}
		
		if($checked=="checked"){
			$xdb->Execute("delete from ".X1_prefix.X1_DB_mapgroups." where id=".$xdb->qstr($mapgid));
		}
	}
	$c  .= x1_admin("mapgroups");
	$c .= X1plugin_title(XL_amapgroups_updated);
    return X1plugin_output($c);
}

function addmapgroups(){
	global $xdb;
	for ($i=0; $i<$_POST['num_mapgroups']; $i++) {
		$result = $xdb->Execute("insert into ".X1_prefix.X1_DB_mapgroups." values ('','','')");
		print $xdb->ErrorMsg();
	}
	$c  = x1_admin("mapgroups");
	$c .= X1plugin_title($_POST['num_mapgroups'].' '.XL_amapgroups_added);
	return X1plugin_output($c);
}



function addmapstogroup() {
	global $xdb;
	$c  = x1_admin("mapgroups");
	
	$group = $xdb->GetRow("SELECT * 
		FROM ".X1_prefix.X1_DB_mapgroups." 
		WHERE id=".$xdb->qstr($_REQUEST['groupid']));
		
	if(!$group){
		$c .= X1plugin_title(XL_amapgroups_notfound);
		return X1plugin_output($c);
	}
	
	$c ="<br /><table class='".X1plugin_admintable."' width='100%'>
	<thead class='".X1plugin_tablehead."'>
		<tr>
			<th colspan='2' align='left'>".XL_amapgroups_addmapstogroup."</th>
			<th>".XL_save."</th>
		</tr>
    </thead>
    <tbody class='".X1plugin_tablebody."'>
		<tr>
			<td class='alt1' width='96%' colspan='2'>
				".XL_amapgroups_addmapstogroup_info."
			</td>
			<td class='alt2' width='4%' align='center'>
				<form action='".X1_adminpostfile."' method='POST' style='".X1_formstyle."'>
				<input type='image' title='".XL_save."' src='".X1_imgpath.X1_saveimage."'>
			</td>
		</tr>
		</tbody>
		<thead class='".X1plugin_tablehead."'>
			<tr>
				
				<th>".XL_amapgroups_id."</th>
				<th>".XL_amapgroups_mapname."</th>
				<th>".XL_amapgroups_select."</th>
			</tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>";
	$result = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_maps." ORDER BY mapid DESC");
	$count=0;
	foreach($result AS $row){ 
		$sel = (in_array($row[0], explode(",", $group["maps"]))) ? "checked" : "";
		$c .= "<tr>
					<td class='alt1'><input type='text' name='nlv_".$count."[]' value='".$row[0]."' readonly size='2'></td>
					<td class='alt2'><input type='text' name='nlv_".$count."[]' value='".$row[1]."' readonly size='30'></td>
					<td class='alt1'><input type=\"checkbox\" name=\"nlv_".$count."[]\" value=\"checked\" $sel></td>
				</tr>";
		$count++;
	}
	$c .= "</tbody>
    <tfoot class='".X1plugin_tablefoot."'>
        <tr>
            <td colspan='6'>&nbsp;
            <input type='hidden' name='".X1_actionoperator."' value='editmapgroup'>
            <input type='hidden' name='num_rows' value='".$count."'>
			<input type='hidden' name='groupid' value='".$_REQUEST['groupid']."'>
            </td>
        </tr>
    </tfoot>
    </table>
	</form>";
	return X1plugin_output($c);
}
	
	
function editmapgroup(){
	global $xdb;
		$array = array();
		for ($i=0; $i< $_POST['num_rows']; $i++) {
			$nlv_info = "nlv_".$i;
			list($mapid, $mapname,  $checked) = $_POST[$nlv_info];
			if($checked=="checked")$array[] = $mapid; 
	 	}
		$result = $xdb->Execute("UPDATE ".X1_prefix.X1_DB_mapgroups."
			SET maps=".$xdb->qstr(implode(",", $array))." 
			WHERE id=".$xdb->qstr($_POST['groupid'])
			);
		if(!$result){
			$c .= $xdb->ErrorMsg();
		}else{
			$c .= x1_admin("mapgroups");
			$c .= X1plugin_title(XL_amapgroups_updated);
		}
		return X1plugin_output($c);
}	
?>