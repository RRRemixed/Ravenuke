<?php
/********************************************************/
/* Donations for PHP-Nuke                               */
/* Version Universal 3.0  06-06                         */
/* By: Telli (telli@codezwiz.com)                       */
/* http://codezwiz.com/                                 */
/* Copyright © 2000-2006 by Codezwiz                    */
/********************************************************/
if (is_admin($admin)) {
    if(!is_array($admin)) {
        $adm = base64_decode($admin);
        $adm = explode(":", $adm);
        $aname = "$adm[0]";
    } else {
        $aname = "$admin[0]";
    }
}
get_lang("Donate");
$adm = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_authors WHERE aid='$aname'"));
if ($adm['radminsuper']==1) {
    	adminmenu("modules.php?name=Donate&file=admin", ""._DONATORS."", "donator.gif");
}
?>