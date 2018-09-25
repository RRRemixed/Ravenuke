<?php

/************************************************************************
               RottNAudio
   ============================================
   Copyright (c) 2008 RottNResources.com & JeroenWijering.com

   Module Author : RottNKorpse (www.RottNResources.com)
   Flash Author  : Jeroen Wijering (www.JeroenWijering.com)
   Edited for Standard/Ravens Nuke : Ped (ped@clanthemes.com)
************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include_once("modules/$module_name/flashvars.php");
echo "<html><head><title>"._POP_UP_PLAYER."</title></head>";
echo "<body leftmargin=\"0\" topmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\" bgcolor=\"#".$pup_back_color."\" text=\"#".$pup_font_color."\">";
echo "<script type=\"text/javascript\" src=\"scriptobject.js\"></script>";
echo "<table width=\"".$pup_width."\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:#".$pup_border_color." ".$pup_border_size."px solid;\"><tr><td>"
    ."<embed src=\"modules/$module_name/player.swf\" width=\"100%\" height=\"".$pup_height."\" bgcolor=\"#".$pup_back_color."\""
    ."type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" "
    ."flashvars=\"file=modules/$module_name/playlist.php".$pup_flashvars."\">"
    ."</td></tr></table>";
echo "</td><td>";
echo "</body>"
    ."</html>";
?>