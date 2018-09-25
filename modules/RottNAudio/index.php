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
$module_name = basename(dirname(__FILE__));
include_once("modules/$module_name/flashvars.php");
require_once("mainfile.php");
get_lang($module_name);
include_once("header.php");
  global $db, $prefix, $admin_file;
$use_themes              = $config_fetch['use_themes'];
$use_header              = $config_fetch['use_header'];
$use_custom_header       = $config_fetch['use_custom_header'];
$custom_header_url       = $config_fetch['custom_header_url'];
$show_module_pop_up      = $config_fetch['show_module_pop_up'];
echo "<script type=\"text/javascript\" src=\"modules/$module_name/swfobject.js\"></script>";
OpenTable();
if (file_exists('modules/RottNAudio/install.php') || file_exists('modules/RottNAudio/install/install.css')) {
    echo "<br /><table width='75%' align='center'><tr><td>";
    echo _INSTALL_FILES_FOUND;
    echo "</td></tr></table><br />";
  } elseif (file_exists('modules/RottNAudio/upgrade.php') || file_exists('modules/RottNAudio/upgrade/upgrade.css')) {
    OpenTable();
    echo "<br /><table width='75%' align='center'><tr><td>";
    echo _UPGRADE_FILES_FOUND;
    echo "</td></tr></table><br />";
    CloseTable();
    admin_footer();
} else {
echo "<center>";
if ($use_header == "1") {
  if ($use_custom_header == "1") {   
  $header_image = $custom_header_url;
  } else {
  $header_image = "modules/$module_name/images/rottnaudio.png";
    if ($use_themes == "1") {
        if (file_exists("themes/$ThemeSel/images/rottnaudio.gif")) {
                  $header_image = "themes/$ThemeSel/images/rottnaudio.gif";
        } elseif (file_exists("themes/$ThemeSel/images/rottnaudio.jpg")) {
                  $header_image = "themes/$ThemeSel/images/rottnaudio.jpg";
        } elseif (file_exists("themes/$ThemeSel/images/rottnaudio.png")) {
                  $header_image = "themes/$ThemeSel/images/rottnaudio.png";
        }
    }
  }
    echo "<a href=\"modules.php?name=$module_name\"><img src=\"$header_image\" border=\"0\" alt=\"\"></a><br /><br />";
} else {
    echo "\n";
}
if ($show_module_pop_up == "1") {
     echo "[";
     if($admin) {
        echo"&nbsp;<a href='".$admin_file.".php?op=$module_name'>"._ADMIN_ADMINISTRATION."</a>&nbsp;|";
     }
     echo "&nbsp;<a href=\"modules.php?name=$module_name&file=popup\" onClick=\"popup = window.open('modules.php?name=$module_name&file=popup', 'PopupPage', 'width=".$pup_width.",height=".$pup_height.",scrollbars=no,resizable=yes,title="._POP_UP_PLAYER."'); return false\" target=\"_blank\">"
         .""._POP_UP_LAUNCH."&nbsp;"._POP_UP_PLAYER."</a>&nbsp;"
         ."]<br><br>";
}
echo"<table width=\"".$mip_width."\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:#".$mip_border_color." ".$mip_border_size."px solid;\"><tr><td>"
   ."<embed src=\"modules/$module_name/player.swf\" width=\"100%\" height=\"".$mip_height."\" bgcolor=\"#".$mip_back_color."\""
   ."type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" "
   ."flashvars=\"file=modules/$module_name/playlist.php".$mip_flashvars."\">"
   ."</td></tr></table>"
."</center>";
}
CloseTable();
include("footer.php");
?>