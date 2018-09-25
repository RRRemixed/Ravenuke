<?php

/************************************************************************
               RottNAudio
   ============================================
   Copyright (c) 2008 RottNResources.com & JeroenWijering.com

   Module Author : RottNKorpse (www.RottNResources.com)
   Flash Author  : Jeroen Wijering (www.JeroenWijering.com)
   Edited for Standard/Ravens Nuke : Ped (ped@clanthemes.com)
************************************************************************/

global $db, $prefix;
$module_name = basename(dirname(__FILE__));

/***[ START ]*****************************************
 **           Module Index Player Settings          **
 *****************************************************/
$mip_sql                 = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_settings WHERE player_name = 'module'"));
$mip_width               = $mip_sql['width'];
$mip_height              = $mip_sql['height'];
$mip_back_color          = $mip_sql['back_color'];
$mip_front_color         = $mip_sql['front_color'];
$mip_light_color         = $mip_sql['light_color'];
$mip_screen_color        = $mip_sql['screen_color'];
$mip_overstretch         = $mip_sql['overstretch'];
$mip_show_eq             = $mip_sql['show_eq'];
$mip_show_icons          = $mip_sql['show_icons'];
$mip_show_stop           = $mip_sql['show_stop'];
$mip_show_digits         = $mip_sql['show_digits'];
$mip_show_download       = $mip_sql['show_download'];
$mip_auto_scroll         = $mip_sql['auto_scroll'];
$mip_display_width       = $mip_sql['display_width'];
$mip_display_height      = $mip_sql['display_height'];
$mip_thumbs_in_playlist  = $mip_sql['thumbs_in_playlist'];
$mip_auto_start          = $mip_sql['auto_start'];
$mip_repeat              = $mip_sql['repeat'];
$mip_shuffle             = $mip_sql['shuffle'];
$mip_volume              = $mip_sql['volume'];
$mip_link_target         = $mip_sql['link_target'];
$mip_border_size         = $mip_sql['border_size'];
$mip_border_color        = $mip_sql['border_color'];
$mip_align_right         = $mip_sql['align_right'];
/*****************************************************
 **           Module Index Player Settings          **
 ***[  END  ]*****************************************/

/***[ START ]*****************************************
 **           Block Player Settings                 **
 *****************************************************/
$bp_sql                  = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_settings WHERE player_name = 'block'"));
$bp_width                = $bp_sql['width'];
$bp_height               = $bp_sql['height'];
$bp_back_color           = $bp_sql['back_color'];
$bp_front_color          = $bp_sql['front_color'];
$bp_light_color          = $bp_sql['light_color'];
$bp_screen_color         = $bp_sql['screen_color'];
$bp_overstretch          = $bp_sql['overstretch'];
$bp_show_eq              = $bp_sql['show_eq'];
$bp_show_icons           = $bp_sql['show_icons'];
$bp_show_stop            = $bp_sql['show_stop'];
$bp_show_digits          = $bp_sql['show_digits'];
$bp_show_download        = $bp_sql['show_download'];
$bp_auto_scroll          = $bp_sql['auto_scroll'];
$bp_display_width        = $bp_sql['display_width'];
$bp_display_height       = $bp_sql['display_height'];
$bp_thumbs_in_playlist   = $bp_sql['thumbs_in_playlist'];
$bp_auto_start           = $bp_sql['auto_start'];
$bp_repeat               = $bp_sql['repeat'];
$bp_shuffle              = $bp_sql['shuffle'];
$bp_volume               = $bp_sql['volume'];
$bp_link_target          = $bp_sql['link_target'];
$bp_border_size          = $bp_sql['border_size'];
$bp_border_color         = $bp_sql['border_color'];
$bp_align_right          = $bp_sql['align_right'];
/*****************************************************
 **           Block Player Settings                 **
 ***[  END  ]*****************************************/

/***[ START ]*****************************************
 **           Pop-Up Player Settings                **
 *****************************************************/
$pup_sql                 = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_settings WHERE player_name = 'pop_up'"));
$pup_width               = $pup_sql['width'];
$pup_height              = $pup_sql['height'];
$pup_back_color          = $pup_sql['back_color'];
$pup_front_color         = $pup_sql['front_color'];
$pup_light_color         = $pup_sql['light_color'];
$pup_screen_color        = $pup_sql['screen_color'];
$pup_overstretch         = $pup_sql['overstretch'];
$pup_show_eq             = $pup_sql['show_eq'];
$pup_show_icons          = $pup_sql['show_icons'];
$pup_show_stop           = $pup_sql['show_stop'];
$pup_show_digits         = $pup_sql['show_digits'];
$pup_show_download       = $pup_sql['show_download'];
$pup_auto_scroll         = $pup_sql['auto_scroll'];
$pup_display_width       = $pup_sql['display_width'];
$pup_display_height      = $pup_sql['display_height'];
$pup_thumbs_in_playlist  = $pup_sql['thumbs_in_playlist'];
$pup_auto_start          = $pup_sql['auto_start'];
$pup_repeat              = $pup_sql['repeat'];
$pup_shuffle             = $pup_sql['shuffle'];
$pup_volume              = $pup_sql['volume'];
$pup_link_target         = $pup_sql['link_target'];
$pup_border_size         = $pup_sql['border_size'];
$pup_border_color        = $pup_sql['border_color'];
$pup_align_right         = $pup_sql['align_right'];
/*****************************************************
 **           Pop-Up Player Settings                **
 ***[  END  ]*****************************************/

/***[ START ]*****************************************
 **           MP3 BBCode Player Settings            **
 *****************************************************/
$bbc_sql                 = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_settings WHERE player_name = 'bbcode'"));
$bbc_width               = $bbc_sql['width'];
$bbc_height              = $bbc_sql['height'];
$bbc_back_color          = $bbc_sql['back_color'];
$bbc_front_color         = $bbc_sql['front_color'];
$bbc_light_color         = $bbc_sql['light_color'];
$bbc_screen_color        = $bbc_sql['screen_color'];
$bbc_overstretch         = $bbc_sql['overstretch'];
$bbc_show_eq             = $bbc_sql['show_eq'];
$bbc_show_icons          = $bbc_sql['show_icons'];
$bbc_show_stop           = $bbc_sql['show_stop'];
$bbc_show_digits         = $bbc_sql['show_digits'];
$bbc_show_download       = $bbc_sql['show_download'];
$bbc_auto_scroll         = $bbc_sql['auto_scroll'];
$bbc_display_width       = $bbc_sql['display_width'];
$bbc_display_height      = $bbc_sql['display_height'];
$bbc_thumbs_in_playlist  = $bbc_sql['thumbs_in_playlist'];
$bbc_auto_start          = $bbc_sql['auto_start'];
$bbc_repeat              = $bbc_sql['repeat'];
$bbc_shuffle             = $bbc_sql['shuffle'];
$bbc_volume              = $bbc_sql['volume'];
$bbc_link_target         = $bbc_sql['link_target'];
$bbc_border_size         = $bbc_sql['border_size'];
$bbc_border_color        = $bbc_sql['border_color'];
$bbc_align_right         = $bbc_sql['align_right'];
/*****************************************************
 **           MP3 BBCode Player Settings            **
 ***[  END  ]*****************************************/

/***[ START ]*****************************************
 **           Player Alignment Settings             **
 *****************************************************/

/*----- Module Index Player -----*/
if ($mip_align_right == "true") {
     $mip_right_display  = "&displaywidth=".$mip_display_width."";
     $mip_height         = round($mip_display_height+20, 2);
} else {
     $mip_right_display  = "";
}

/*----- Block Player -----*/
if ($bp_align_right == "true") {
     $bp_right_display   = "&displaywidth=".$bp_display_width."";
     $bp_height          = round($bp_display_height+20, 2);
} else {
     $bp_right_display   = "";
}

/*----- Stand-Alone Player -----*/
if ($pup_align_right == "true") {
     $pup_right_display  = "&displaywidth=".$pup_display_width."";
     $pup_height         = round($pup_display_height+20, 2);
} else {
     $pup_right_display  = "";
}

/*----- Stand-Alone Player -----*/
if ($bbc_align_right == "true") {
     $bbc_right_display  = "&displaywidth=".$bbc_display_width."";
     $bbc_height         = round($bbc_display_height+20, 2);
} else {
     $bbc_right_display  = "";
}

/*****************************************************
 **           Player Alignment Settings             **
 ***[  END  ]*****************************************/

/***[ START ]*****************************************
 **           RNA - Theme System                    **
 *****************************************************/

$config_sql              = $db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_config");
$config_fetch            = $db->sql_fetchrow($config_sql);
$use_themes              = $config_fetch['use_themes'];

$ThemeSel = get_theme();

  if ($use_themes == "1") {
   if (file_exists("themes/$ThemeSel/rottnaudio.php")) {
       include_once("themes/$ThemeSel/rottnaudio.php");
       $mip_back_color   = $module_back_color;
       $mip_front_color  = $module_front_color;
       $mip_light_color  = $module_light_color;
       $mip_screen_color = $module_screen_color;
       $mip_border_color = $module_border_color;
       $bp_back_color    = $block_back_color;
       $bp_front_color   = $block_front_color;
       $bp_light_color   = $block_light_color;
       $bp_screen_color  = $block_screen_color;
       $bp_border_color  = $block_border_color;
       $pup_back_color   = $pop_up_back_color;
       $pup_front_color  = $pop_up_front_color;
       $pup_light_color  = $pop_up_light_color;
       $pup_screen_color = $pop_up_screen_color;
       $pup_border_color = $pop_up_border_color;
       $bbc_back_color   = $bbcode_back_color;
       $bbc_front_color  = $bbcode_front_color;
       $bbc_light_color  = $bbcode_light_color;
       $bbc_screen_color = $bbcode_screen_color;
       $bbc_border_color = $bbcode_border_color;

   }
  }
/*****************************************************
 **           RNA - Theme System                    **
 ***[  END  ]*****************************************/

$mip_flashvars           = "&width=".$mip_width."&height=".$mip_height."&searchbar=false&backcolor=0x".$mip_back_color."&frontcolor=0x".$mip_front_color."&lightcolor=0x".$mip_light_color."&screencolor=0x".$mip_screen_color."&overstretch=".$mip_overstretch."&showeq=".$mip_show_eq."&showicons=".$mip_show_icons."&showstop=".$mip_show_stop."&showdigits=".$mip_show_digits."&showdownload=".$mip_show_download."&usefullscreen=false&autoscroll=".$mip_auto_scroll."".$mip_right_display."&displayheight=".$mip_display_height."&thumbsinplaylist=".$mip_thumbs_in_playlist."&autostart=".$mip_auto_start."&repeat=".$mip_repeat."&shuffle=".$mip_shuffle."&volume=".$mip_volume."&link_target=".$mip_link_target."&abouttxt=".$module_name." ".$config_fetch['rottnaudio_version']."&aboutlnk=http://rottnresources.com/projects/".$module_name."/index.php";
$bp_flashvars            = "&width=".$bp_width."&height=".$bp_height."&searchbar=false&backcolor=0x".$bp_back_color."&frontcolor=0x".$bp_front_color."&lightcolor=0x".$bp_light_color."&screencolor=0x".$bp_screen_color."&overstretch=".$bp_overstretch."&showeq=".$bp_show_eq."&showicons=".$bp_show_icons."&showstop=".$bp_show_stop."&showdigits=".$bp_show_digits."&showdownload=".$bp_show_download."&usefullscreen=false&autoscroll=".$bp_auto_scroll."".$bp_right_display."&displayheight=".$bp_display_height."&thumbsinplaylist=".$bp_thumbs_in_playlist."&autostart=".$bp_auto_start."&repeat=".$bp_repeat."&shuffle=".$bp_shuffle."&volume=".$bp_volume."&link_target=".$bp_link_target."&abouttxt=".$module_name." ".$config_fetch['rottnaudio_version']."&aboutlnk=http://rottnresources.com/projects/".$module_name."/index.php";
$pup_flashvars           = "&width=".$pup_width."&height=".$pup_height."&searchbar=false&backcolor=0x".$pup_back_color."&frontcolor=0x".$pup_front_color."&lightcolor=0x".$pup_light_color."&screencolor=0x".$pup_screen_color."&overstretch=".$pup_overstretch."&showeq=".$pup_show_eq."&showicons=".$pup_show_icons."&showstop=".$pup_show_stop."&showdigits=".$pup_show_digits."&showdownload=".$pup_show_download."&usefullscreen=false&autoscroll=".$pup_auto_scroll."".$pup_right_display."&displayheight=".$pup_display_height."&thumbsinplaylist=".$pup_thumbs_in_playlist."&autostart=".$pup_auto_start."&repeat=".$pup_repeat."&shuffle=".$pup_shuffle."&volume=".$pup_volume."&link_target=".$pup_link_target."&abouttxt=".$module_name." ".$config_fetch['rottnaudio_version']."&aboutlnk=http://rottnresources.com/projects/".$module_name."/index.php";
$bbc_flashvars           = "&width=".$bbc_width."&height=".$bbc_height."&searchbar=false&backcolor=0x".$bbc_back_color."&frontcolor=0x".$bbc_front_color."&lightcolor=0x".$bbc_light_color."&screencolor=0x".$bbc_screen_color."&overstretch=".$bbc_overstretch."&showeq=".$bbc_show_eq."&showicons=".$bbc_show_icons."&showstop=".$bbc_show_stop."&showdigits=".$bbc_show_digits."&showdownload=".$bbc_show_download."&usefullscreen=false&autoscroll=".$bbc_auto_scroll."".$bbc_right_display."&displayheight=".$bbc_display_height."&thumbsinplaylist=".$bbc_thumbs_in_playlist."&autostart=".$bbc_auto_start."&repeat=".$bbc_repeat."&shuffle=".$bbc_shuffle."&volume=".$bbc_volume."&link_target=".$bbc_link_target."&abouttxt=".$module_name." ".$config_fetch['rottnaudio_version']."&aboutlnk=http://rottnresources.com/projects/".$module_name."/index.php";


/***[ START ]*****************************************
 **           Universal Settings                    **
 *****************************************************/
$ufv_sql                 = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_settings WHERE player_name = 'universal'"));
$ufv_width               = $ufv_sql['width'];
$ufv_height              = $ufv_sql['height'];
$ufv_back_color          = $ufv_sql['back_color'];
$ufv_front_color         = $ufv_sql['front_color'];
$ufv_light_color         = $ufv_sql['light_color'];
$ufv_screen_color        = $ufv_sql['screen_color'];
$ufv_overstretch         = $ufv_sql['overstretch'];
$ufv_show_eq             = $ufv_sql['show_eq'];
$ufv_show_icons          = $ufv_sql['show_icons'];
$ufv_show_stop           = $ufv_sql['show_stop'];
$ufv_show_digits         = $ufv_sql['show_digits'];
$ufv_show_download       = $ufv_sql['show_download'];
$ufv_auto_scroll         = $ufv_sql['auto_scroll'];
$ufv_display_width       = $ufv_sql['display_width'];
$ufv_display_height      = $ufv_sql['display_height'];
$ufv_thumbs_in_playlist  = $ufv_sql['thumbs_in_playlist'];
$ufv_auto_start          = $ufv_sql['auto_start'];
$ufv_repeat              = $ufv_sql['repeat'];
$ufv_shuffle             = $ufv_sql['shuffle'];
$ufv_volume              = $ufv_sql['volume'];
$ufv_link_target         = $ufv_sql['link_target'];
$ufv_border_size         = $ufv_sql['border_size'];
$ufv_border_color        = $ufv_sql['border_color'];
$ufv_align_right         = $ufv_sql['align_right'];

$ufv_flashvars           = "&width=".$ufv_width."&height=".$ufv_height."&searchbar=false&backcolor=0x".$ufv_back_color."&frontcolor=0x".$ufv_front_color."&lightcolor=0x".$ufv_light_color."&screencolor=0x".$ufv_screen_color."&overstretch=".$ufv_overstretch."&showeq=".$ufv_show_eq."&showicons=".$ufv_show_icons."&showstop=".$ufv_show_stop."&showdigits=".$ufv_show_digits."&showdownload=".$ufv_show_download."&usefullscreen=false&autoscroll=".$ufv_auto_scroll."&displayheight=".$ufv_display_height."&thumbsinplaylist=".$ufv_thumbs_in_playlist."&autostart=".$ufv_auto_start."&repeat=".$ufv_repeat."&shuffle=".$ufv_shuffle."&volume=".$ufv_volume."&link_target=".$ufv_link_target."";

$universal_status_module = $config_fetch['universal_status_module'];
$universal_status_block  = $config_fetch['universal_status_block'];
$universal_status_pop_up = $config_fetch['universal_status_pop_up'];
$universal_status_bbcode = $config_fetch['universal_status_bbcode'];
  if ($universal_status_module == "1") {
       $mip_flashvars    = $ufv_flashvars;
       $mip_width         = $ufv_width;
       $mip_height        = $ufv_height;
       $mip_back_color    = $ufv_back_color;
       $mip_border_size   = $ufv_border_size;
       $mip_border_color  = $ufv_border_color;
  }
  if ($universal_status_block == "1") {
       $bp_flashvars     = $ufv_flashvars;
       $bp_width         = $ufv_width;
       $bp_height        = $ufv_height;
       $bp_back_color    = $ufv_back_color;
       $bp_border_size   = $ufv_border_size;
       $bp_border_color  = $ufv_border_color;
  }
  if ($universal_status_pop_up == "1") {
       $pup_flashvars    = $ufv_flashvars;
       $pup_width        = $ufv_width;
       $pup_height       = $ufv_height;
  }
  if ($universal_status_bbcode == "1") {
       $bbc_flashvars    = $ufv_flashvars;
  }
/*****************************************************
 **           Universal Settings                    **
 ***[  END  ]*****************************************/

?>