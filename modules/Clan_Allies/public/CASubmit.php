<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

if($ca_config['require_user'] == 0 || is_user($user)) {
  $pagetitle = _ADDSUPPORTER;
  $comefrom = $_SERVER['HTTP_REFERER'];
  if(defined("NUKESENTINEL_IS_LOADED")) {
    
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  if(!is_array($user)) {
    $member = base64_decode($user);
    $member = explode(":", $member);
    $memname = "$member[1]";
  } else {
    $memname = "$user[1]";
  }
  list($suid, $sname, $semail, $surl) = $db->sql_fetchrow($db->sql_query("select `user_id`, `username`, `user_email`, `user_website` from `".$user_prefix."_users` where `username`='$memname'"));
  include("header.php");
  OpenTable();
  echo "<center><img src= modules/Clan_Allies/images/logo.gif><br><br>";
  if(is_admin($admin)) { echo "[ <a href='".$admin_file.".php?op=CAMain'>"._GOTOADMIN."</a> ]\n"; }
  echo "<br>";
  echo "<b>"._ADDSUPPORTER."</b><br>"._ALLREQ."<br>\n";
  CloseTable();
  OpenTable();  
  echo "<center><table border='0'>\n";
  if($ca_config['image_type']==0) { $enctype = ""; } else { $enctype = " enctype='multipart/form-data'"; }
  echo "<form action='modules.php?name=$module_name' method='post'$enctype>\n";
  echo "<input type='hidden' name='op' value='CASubmitSave'>\n";
  echo "<input type='hidden' name='user_id' value='$suid'>\n";
  echo "<tr><td><b>"._NAME.":</b></td><td><input type='text' name='site_name' size='50'></td></tr>\n";
  echo "<tr><td><b>"._URL.":</b></td><td><input type='text' name='site_url' size='50' value='$surl'></td></tr>\n";
  if($ca_config['image_type']==0) { $type = "type='input'"; } else { $type = "type='file'"; }
  echo "<tr><td valign='top'><b>"._IMAGE.":</b></td><td><input $type name='site_image' size='50'>";
  echo "<br>"._MUSTBE;
  if($ca_config['image_type']==0) { echo "<br>"._IMAGETYPE0; } else { echo "<br>"._IMAGETYPE1; }
  echo "</td></tr>\n";
  echo "<tr><td valign='top'><b>"._DESCRIPTION.":</b></td><td><textarea $textrowcol name='site_description'></textarea></td></tr>\n";
  echo "<tr><td><b>"._SERVERNAME.":</b></td><td><input type='text' name='server_name' size='50'></td></tr>\n";
  echo "<tr><td><b>"._SERVERIP.":</b></td><td><input type='text' name='server_ip' size='50'></td></tr>\n";
  echo "<tr><td><b>"._SERVERPORT.":</b></td><td><input type='text' name='server_port' size='50'></td></tr>\n";
  echo "<tr><td><b>"._SERVERSLOTS.":</b></td><td><input type='text' name='server_slots' size='50'></td></tr>\n";
  echo "<tr><td><b>"._YOURNAME.":</b></td><td><input type='test' name='user_name' value='$sname' size='40'></td></tr>\n";
  echo "<tr><td><b>"._YOUREMAIL.":</b></td><td><input type='text' name='user_email' value='$semail' size='40'></td></tr>\n";
  echo "<tr><td><b>"._YOURIP."</b></td><td>$ip</td></tr>\n";
  echo "<input type='hidden' name='user_ip' value='$ip'>\n";
  echo "<input type='hidden' name='comefrom' value='$comefrom'>\n";
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SUBMITSITE."'></td></tr>\n";
  echo "</form></table></center>\n";
  CloseTable();
  include("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>