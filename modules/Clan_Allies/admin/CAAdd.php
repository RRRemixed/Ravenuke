<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

$pagetitle = ": "._ADMINMAIN." - "._ADDSUPPORTER;
include("header.php");
if(defined("NUKESENTINEL_IS_LOADED")) {

  $ip = $_SERVER['REMOTE_ADDR'];
}
camenu();
echo "<br>\n";
OpenTable();
echo "<center><br>"._ALLREQ."<br>\n";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
if($ca_config['image_type']==0) { $enctype = ""; } else { $enctype = "enctype='multipart/form-data'"; }
echo "<form action='".$admin_file.".php?op=CAAddSave' method='post'$enctype>\n";
echo "<input type='hidden' name='user_id' value='$suid'>\n";
echo "<tr><td><b>"._NAME.":</b></td><td><input type='text' name='site_name' size='50'></td></tr>\n";
echo "<tr><td><b>"._URL.":</b></td><td><input type='text' name='site_url' size='50' value='$surl'></td></tr>\n";
if($ca_config['image_type']==0) { $type = "type='input'"; } else { $type = "type='file'"; }
echo "<tr><td valign='top'><b>"._IMAGE.":</b></td><td><input $type name='site_image' size='50'><br>";
echo ""._MUSTBE."</td></tr>\n";
echo "<tr><td valign='top'><b>"._DESCRIPTION.":</b></td><td><textarea $textrowcol name='site_description'></textarea></td></tr>\n";
echo "<tr><td><b>"._SERVERNAME.":</b></td><td><input type='text' name='server_name' size='50'></td></tr>\n";
  echo "<tr><td><b>"._SERVERIP.":</b></td><td><input type='text' name='server_ip' size='50'></td></tr>\n";
  echo "<tr><td><b>"._SERVERPORT.":</b></td><td><input type='text' name='server_port' size='50'></td></tr>\n";
  echo "<tr><td><b>"._SERVERSLOTS.":</b></td><td><input type='text' name='server_slots' size='50'></td></tr>\n";
echo "<tr><td><b>"._YOURNAME.":</b></td><td><input type='test' name='user_name' size='40'></td></tr>\n";
echo "<tr><td><b>"._YOUREMAIL.":</b></td><td><input type='text' name='user_email' size='40'></td></tr>\n";
  echo "<tr><td><b>"._YOURIP."</b></td><td>$ip</td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SUBMITSITE."'></td></tr>\n";
echo "</form></table></center>\n";
CloseTable();
include("footer.php");

?>