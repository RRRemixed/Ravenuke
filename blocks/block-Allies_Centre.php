<?php







if(!defined('NUKE_FILE') AND !defined('BLOCK_FILE')) {

  Header("Location: ../index.php");

  die();

}

include_once("modules/Clan_Allies/public/clan_allies_func.php");

$ca_config = caget_configs();

get_lang("Clan_Allies");

global $prefix, $db, $user, $admin, $admin_file;

if(!isset($admin_file)) { $admin_file = "admin"; }

$content = "<center>"._SUPPORTEDBY."<br><br>";

$content .= "<marquee direction='left' height='150' width='100%' scrollamount='3' scrolldelay='90' width='100' onmouseover='this.stop()' onmouseout='this.start()'>\n";

$result = $db->sql_query("SELECT `site_id`, `site_name`, `site_image` FROM $prefix"._clan_allies_sites." WHERE site_status>'0' ORDER BY site_name");

while(list($site_id, $site_name, $site_image) = $db->sql_fetchrow($result)) {

  list($width, $height, $type, $attr) = getimagesize($site_image);

  if($width > $ca_config['max_width']) { $width = $ca_config['max_width']; }

  if($height > $ca_config['max_height']) { $height = $ca_config['max_height']; }

  $content .= "<a target='_blank' href='modules.php?name=Clan_Allies&op=CAGo&site_id=$site_id'><img src='$site_image' height='$height' width='$width' title='$site_name' alt='$site_name' border='0'></a>&nbsp;&nbsp;&nbsp;&nbsp;\n";

}

$content .="</marquee><br>\n";

$content .="<center>\n";

if($ca_config['require_user'] == 0 || is_user($user)) { $content .= "[ <a href='modules.php?name=Clan_Allies&amp;op=CASubmit'>"._BESUPPORTER."</a> ]<br>\n"; }

if(is_admin($admin)) { $content .= "[ <a href='".$admin_file.".php?op=CAMain'>"._GOTOADMIN."</a> ]<br>\n"; }

$content .= "[ <a href='modules.php?name=Clan_Allies'>"._CLANALLIES."</a> ]</center>\n";



?>

