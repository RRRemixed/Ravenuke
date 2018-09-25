<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.nukeladder.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################

function gamesmanager() {
   global $xdb;
    $c = "
		<table class='".X1plugin_admintable."' width='100%'>
			<thead class='".X1plugin_tablehead."'>
				<tr>
					<th colspan='4'>".XL_agames_add."</td>
					<th>".XL_save."</td>
				</tr>
			</thead>
			<tbody class='".X1plugin_tablebody."'>
				<tr>
					<td class='alt1' width='96%' colspan='4' align='left'>
						<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
							<input type='int' value='2' size='2' name='num_games'>
							<input type='image' title='".XL_agames_add."' src='".X1_imgpath.X1_addimage."'>
							<input name='".X1_actionoperator."' type='hidden' value='addgames''>
						</form>
					</td>
					<td class='alt2' width='4%' align='center'>
						<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>
						<input type='image' title='".XL_save."' src='".X1_imgpath.X1_addimage."' >
					</td>
				</tr>
			</tbody>
	    <thead class='".X1plugin_tablehead."'>
	       <tr>
        		<th>".XL_agames_id."</th>
        		<th>".XL_agames_name."</th>
        		<th>".XL_agames_pic."</th>
        		<th>".XL_agames_desc."</th>
        		<th align='center'><img src='".X1_imgpath.X1_delimage."' title='".XL_delete."' border='0'></th>
            </tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>";


		$result = $xdb->GetAll("
        SELECT * FROM ".X1_prefix.X1_DB_games."
        order by gameid");

    	if(!$result){
        	$c .= "
				<tr>
					<td colspan='5'>".XL_agames_none."</td>
				</tr>
            </tbody>
            <tfoot class='".X1plugin_tablefoot."'>
                <tr>
                    <td colspan='5'>&nbsp;</td>
                </tr>
            </tfoot>
            </table>";
        	return  $c;
    	}

		$count=0;
		foreach($result AS $row){
			$c .= "<tr>
					<td class='alt1'><input type='text' name='nlv_".$count."[id]' value='".$row[0]."' readonly size='2'></td>
					<td class='alt2'><input type='text' name='nlv_".$count."[name]' value='".$row[1]."' size='15'></td>
					<td class='alt1'>
					<select name='nlv_".$count."[image]' onchange=\"X1plugin_imgpreview(this, '".X1_imgpath."/games/'); return false;\">";
			if ($handle = opendir(X1_imgpath."/games")) {
				$c .= "<option value=''>".XL_agames_selectimage."</option>\n";
				while (false != ($file = readdir($handle))) {
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
			$c .= "</select>
				</td>
				<td class='alt2'><input type='text' name='nlv_".$count."[desc]'  value='".$row[3]."'size='25'></td>
				<td  class='alt1'align='center'>
                <input type='checkbox' name='nlv_".$count."[checked]' value='checked'></td>
				</tr>";
			$count++;
		}
		$c .= "
		<input type='hidden' name='num_rows' value='".$count."'>
		</tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='5'>
                <input type='hidden' name='".X1_actionoperator."' value='updategames'>
                </td>
            </tr>
        </tfoot>
    </table>
	</form>
	<br/>
	<table class='".X1plugin_admintable."' width='100%'>
        <thead class='".X1plugin_tablehead."'>
    		<tr>
    			<th width='25%'>".XL_agames_preview."</th>
    			<th  width='75%'></th>
    		</tr>
        </thead>
        <tbody class='".X1plugin_tablebody."'>
    		<tr>
    			<td class='alt1' width='25%' align='center'>
				<img id='X1plugin_preimg' src='".X1_imgpath.X1_defpreviewimage."'</td>
    			<td class='alt2' width='75%' align='right'></td>
    		</tr>
	   </tbody>
        <tfoot class='".X1plugin_tablefoot."'>
            <tr>
                <td colspan='2'>&nbsp;</td>
            </tr>
        </tfoot>
        </table>";
	return X1plugin_output($c, 1);
}

function updategames(){
    global $xdb;
		for ($i=0; $i < $_POST['num_rows']; $i++) {
			$nlv_info = $_POST["nlv_".$i];
			$iq = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_games." 
			WHERE gameid=".$xdb->qstr($nlv_info['id']));
			$irows = count($iq);
			if($irows >=1){
				$xdb->Execute("UPDATE ".X1_prefix.X1_DB_games." SET
				gamename=".$xdb->qstr($nlv_info['name']).",
				gameimage=".$xdb->qstr($nlv_info['image']).",
				gametext=".$xdb->qstr($nlv_info['desc'])." 
				WHERE gameid=".$xdb->qstr($nlv_info['id']));
			}
			if(isset($nlv_info['checked'])){
				if($nlv_info['checked']=="checked"){
					$xdb->Execute("delete from ".X1_prefix.X1_DB_games." 
					WHERE gameid=".$xdb->qstr($nlv_info['id']));
				}
			}
	 	}
		$c  = x1_admin("games");
	    $c .= X1plugin_title(XL_agames_updated);
        return X1plugin_output($c);
}

function addgames(){
	global $xdb;
	for ($i=0; $i<$_POST['num_games']; $i++) {
		$result = $xdb->Execute("insert into ".X1_prefix.X1_DB_games." 
		values (NULL,NULL,NULL, NULL, '0')");
	}
	$c  = x1_admin("games");
	$c .= X1plugin_title($_POST['num_games'].XL_agames_added);
	return X1plugin_output($c);
}
?>