<?
/************************************************************************/
/* File Repository POPUP MEDIA WINDOW                                   */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by MJ Hufford                                     */
/* http://www.GuitarVoice.com                                           */
/* v2.8                                                                */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
global $db, $prefix, $cookie, $sitename, $admin, $admin_file;
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

include("modules/".$module_name."/functions.php");

$cur_theme = get_theme();
include("themes/".$cur_theme."/theme.php");

$row = $db->sql_fetchrow($db->sql_query("SELECT filename, title, custom1, custom2, custom3 FROM ".$prefix."_fr_files WHERE id=$lid"));
$url = $file_dir.$row['filename'];
$title = $row['title'];
$custom1 = $row['custom1'];
$custom2 = $row['custom2'];
$custom3 = $row['custom3'];

if ($file_type == "audio") {
  $width = "100%";
  $height = "44px";
  $window_width = "350";
  $window_height = "350";
  $show_video = false;
  } else {
      $width = "100%";
      $height = "75";
      $window_width = "350";
      $window_height = "550";
	  $show_video = true;
}
OpenTable();
echo '<html>
      <head>
      <script language="javascript">
         function resize(){
           window.resizeTo('.$window_width.', '.$window_height.')
         }
      </script>
      <title>'.$title.'</title>
      </head>
      <link rel="StyleSheet" href="themes/'.$cur_theme.'/style/style.css" type="text/css">
      <body onload="resize()">
	  <center><h2>'.$title.'</h2>'.$custom1.': '.$custom2.' ('.$custom3.')</b>
	  <table align="center"><tr><td>
		<OBJECT ID="MediaPlayer" WIDTH="'.$width.'" HEIGHT="'.$height.'" CLASSID="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95" STANDBY="Loading Windows Media Player components..." TYPE="application/x-oleobject">
			<PARAM NAME="FileName" VALUE="'.$url.'"">
			<PARAM NAME="autostart" VALUE="true">
			<PARAM NAME="ShowControls" VALUE="true">
			<PARAM NAME="ShowStatusBar" VALUE="false">
			<PARAM NAME="ShowDisplay" value="'.$show_video.'">
			<EMBED TYPE="application/x-mplayer2" SRC="'.$url.'"" NAME="MediaPlayer" WIDTH="'.$width.'" HEIGHT="'.$height.'" ShowControls="1" ShowStatusBar="0" ShowDisplay="'.$show_video.'" autostart="1"></EMBED>
		</OBJECT>
		</td></tr></table>
	    <br /><a href="'.$url.'">Right click here to save file</a><br /><br />
		</center>
	    </body>
	    </html>';
CloseTable();
?>