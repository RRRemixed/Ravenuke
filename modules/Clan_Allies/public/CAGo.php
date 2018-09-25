<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

$site_id = intval($site_id);
$result = $db->sql_query("select `site_url`, `site_status` from `".$prefix."_clan_allies_sites` where `site_id`='$site_id'");
list($url, $status) = $db->sql_fetchrow($result);
if($status==1) {
  $db->sql_query("UPDATE `".$prefix."_clan_allies_sites` set `site_hits`=site_hits+1 where `site_id`='$site_id'");
}
Header("Location: $url");

?>