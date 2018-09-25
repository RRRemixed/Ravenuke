<?php

/************************************************************************
               RottNAudio
   ============================================
   Copyright (c) 2008 RottNResources.com & JeroenWijering.com

   Module Author : RottNKorpse (www.RottNResources.com)
   Flash Author  : Jeroen Wijering (www.JeroenWijering.com)
   Edited for Standard/Ravens Nuke : Ped (ped@clanthemes.com)
************************************************************************/

if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}

$module_name = 'RottNAudio';
get_lang($module_name);
include 'modules/' . $module_name . '/flashvars.php';

$show_block_pop_up = $config_fetch['show_block_pop_up'];

$content  .= "<table align=\"center\" width=\"".$bp_width."\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:#".$bp_border_color." ".$bp_border_size."px solid;\"><tr><td>";
$content .= "<embed src=\"modules/".$module_name."/player.swf\" width=\"100%\" height=\"".$bp_height."\" bgcolor=\"#".$bp_back_color."\"";
$content .= "type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" ";
$content .= "flashvars=\"file=modules/".$module_name."/playlist.php".$bp_flashvars."\">";
$content .= "</td></tr></table>";

if ($show_block_pop_up == "1") {
$content .= "<br /><table border=\"0\" width=\"100%\">";
$content .= "<tr><td align=\"center\">";
$content .= "<a href=\"modules.php?name=".$module_name."&file=popup\" ";
$content .= "onClick=\"popup = window.open('modules.php?name=".$module_name."&file=popup', 'PopupPage', 'width=".$pup_width.",height=".$pup_height.",scrollbars=no,resizable=yes,title="._POP_UP_PLAYER."'); return false\" target=\"_blank\">";
$content .= ""._POP_UP_LAUNCH."&nbsp;"._POP_UP_PLAYER."</a>";
$content .= "</td></tr></table>";
}

?>