<?php
if (eregi("block-NukeLadder2Menu.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}
global $prefix, $multilingual, $currentlang, $db, $team, $cookie, $admin;
$module_name="NukeLadder";
if(is_admin($admin))$adminlink = "<li><a href=\"modules.php?name=$module_name&amp;op=admin\">Admin Panel</a></li>";
$content =  "
<li><a href=\"modules.php?name=$module_name&amp;op=home\">Events</a></li>
<li><a href=\"modules.php?name=$module_name&amp;op=myteams\">My Teams</a></li>
<li><a href=\"modules.php?name=$module_name&amp;op=createteam\">CreateTeam</a></li>
<li><a href=\"modules.php?name=$module_name&amp;op=requestpass\">Lost Password</a></li>
<li><a href=\"modules.php?name=$module_name&amp;op=jointeamform\">Join Team</a></li>
<li><a href=\"modules.php?name=$module_name&amp;op=quitteamform\">Quit Team</a></li>
<li><a href=\"modules.php?name=$module_name&amp;op=teamlist\">Team List</a></li>
$adminlink";
?>
