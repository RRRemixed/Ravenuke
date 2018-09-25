<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

$site_id = intval($site_id);
$result = $db->sql_query("UPDATE `".$prefix."_clan_allies_sites` SET `site_status`='1' where `site_id`='$site_id'");
Header("Location: ".$admin_file.".php?op=CAPending");

?>