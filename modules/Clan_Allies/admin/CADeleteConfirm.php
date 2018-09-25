<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

$site_id = intval($site_id);
$db->sql_query("DELETE FROM `".$prefix."_clan_allies_sites` WHERE `site_id`='$site_id'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_clan_allies_sites`");
Header("Location: $comefrom");

?>