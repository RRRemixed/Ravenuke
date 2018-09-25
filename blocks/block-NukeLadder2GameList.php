<?php
if (eregi("block-NukeLadder2GameList.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}
global $prefix, $db, $nukeurl;
$module_name = "NukeLadder";
$result = $db->sql_query("select gameid, gamename, gameimage, gametext from ".$prefix."_games order by gameid DESC");
while(list($gameid, $gamename, $gameimage, $gametext) = $db->sql_fetchrow($result)) {
$content .= "&middot;<a href=\"modules.php?name=$module_name&game=$gameid\">$gamename</a><br>";
}
?>