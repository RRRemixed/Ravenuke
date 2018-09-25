<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/
$jpeg = 'image/jpeg';
$jpg = 'image/pjpeg';
$gif = 'image/gif';
$png = 'image/png';
$imageurl_name = $_FILES['site_image']['name'];
$imageurl_type = $_FILES['site_image']['type'];
if($imageurl_type != $jpg && $imageurl_type != $jpeg && $imageurl_type != $gif && $imageurl_type != $png){
	include("header.php");
	OpenTable();
	echo "<center><font color='red'>$imageurl_name</font> is not the proper extension<br/><br/>Allowed extensions are .gif, .jpg, & .png<br/><br/>"._GOBACK."</center>";
	CloseTable();
	include("footer.php");
}else{	
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
if(($site_name=="")OR($site_url=="")OR($site_description=="")) {
  include("header.php");
  OpenTable();
	echo "<center><img src= modules/Clan_Allies/images/logo.gif><br><br>";
    echo "<b>"._MISSINGDATA."</b><br><br>\n";
    echo ""._GOBACK."</center>\n";
    CloseTable();
  include("footer.php");
  die();
}
if($supporter_config['image_type']==0) {
  $imgurl = $site_image;
} else {
  list($newest_oid) = $db->sql_fetchrow($db->sql_query("SELECT max(`site_id`) AS newest_oid FROM `".$prefix."_clan_allies_sites`"));
  if($newest_oid == "-1") { $new_oid = 1; } else { $new_oid = $newest_oid+1; }
  $oid = str_pad($new_oid, 6, "0", STR_PAD_LEFT);
  $imageurl_name = $_FILES['site_image']['name'];
  $imageurl_temp = $_FILES['site_image']['tmp_name'];
  $ext = substr($imageurl_name, strrpos($imageurl_name,'.'), 5);
  if(move_uploaded_file($imageurl_temp, "modules/$modname/images/Clan_Allies/$oid$ext")) {
    chmod ("modules/$modname/images/Clan_Allies/$oid$ext", 0777);
    $imgurl = "modules/$modname/images/Clan_Allies/$oid$ext";
  } else {
    include("header.php");
    OpenTable();
	  echo "<center><img src= modules/Clan_Allies/images/logo.gif><br><br>";
      echo "<b>"._NOUPLOAD."</b><br><br>\n";
      echo ""._GOBACK."</center>";
      CloseTable();
    include("footer.php");
    die();
  }
}
list($user_id) = $db->sql_fetchrow($db->sql_query("SELECT `user_id` FROM `".$user_prefix."_users` WHERE `username`='$user_name'"));
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
$result = $db->sql_query("INSERT INTO `".$prefix."_clan_allies_sites` values (NULL, '$site_name', '$site_url', '$imgurl', '1', '0', now(), '$site_description', '$server_name', '$server_ip', '$server_port', '$server_slots', '$user_id', '$user_name', '$user_email', '$user_ip')");
if(!$result) {
  include("header.php");
  OpenTable();
  echo "<center><b>"._DBERROR1."</b></center><br>\n";
  echo "<center>"._GOBACK."</center>\n";
  CloseTable();
  include("footer.php");
  die();
}
Header("Location: ".$admin_file.".php?op=CAMain");
}
?>