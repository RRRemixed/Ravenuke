<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

$site_name = strip_tags($site_name);
$site_name = htmlspecialchars($site_name, ENT_QUOTES);
$site_name = stripslashes($site_name);
$site_description = strip_tags($site_description);
$server_name = strip_tags($server_name);
$server_ip = strip_tags($server_ip);
$server_port = strip_tags($server_port);
$server_slots = strip_tags($server_slots);
$site_description = htmlspecialchars($site_description, ENT_QUOTES);
$site_description = stripslashes($site_description);
$site_id = intval($site_id);
$oid = str_pad($site_id, 6, "0", STR_PAD_LEFT);
$newimage_name = $_FILES['new_image']['name'];
$newimage_temp = $_FILES['new_image']['tmp_name'];
if($newimage_name != "") {
  $ext = substr($newimage_name, strrpos($newimage_name,'.'), 5);
  if(move_uploaded_file($newimage_temp, "modules/$modname/images/Clan_Allies/$oid$ext")) {
    chmod ("modules/$modname/images/Clan_Allies/$oid$ext", 0777);
    $imgurl = "modules/$modname/images/Clan_Allies/$oid$ext";
  } else {
    include("header.php");
    OpenTable();
    echo "<center><b>"._NOUPLOAD."</b></center><br>\n";
    echo "<center>"._GOBACK."</center>";
    CloseTable();
    include("footer.php");
    die();
  }
} else {
  $imgurl = $old_image;
}
$user_id = intval($user_id);
if(!get_magic_quotes_runtime()) {
  $site_name = addslashes($site_name);
  $site_url = addslashes($site_url);
  $site_description = addslashes($site_description);
  $server_name = addslashes($server_name);
  $server_ip = addslashes($server_ip);
  $server_port = addslashes($server_port);
  $server_slots = addslashes($server_slots);
  $user_name = addslashes($user_name);
  $user_email = addslashes($user_email);
  $imgurl = addslashes($imgurl);
}
$result = $db->sql_query("UPDATE `".$prefix."_clan_allies_sites` SET `site_name`='$site_name', `site_url`='$site_url', `site_image`='$imgurl', `site_date`='$site_date', `site_description`='$site_description', `server_name`='$server_name', `server_ip`='$server_ip', `server_port`='$server_port', `server_slots`='$server_slots', `user_name`='$user_name', `user_email`='$user_email' where `site_id`='$site_id'");
Header("Location: $comefrom");

?>