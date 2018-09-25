<?php
/********************************************************/
/* Site Arcade Menu                                     */
/* Version 1.0.0         7-14-04                        */
/* By: Telli (telli@codezwiz.com)                       */
/* http://codezwiz.com/                                 */
/* Copyright © 2001-2004 by Codezwiz                    */
/********************************************************/

if (eregi("arcade_menu.php",$_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}

//definitions
define("_CZ_ARCADETOP","Flash Arcade");
define("_CZ_ARCADE","Arcade");
define("_CZ_TOPSCORERS","Top 5");
define("_CZ_ARCADEGAMES","Arcade Games");
//

     global $prefix, $db;
echo "<br />";
//Just a simple menu for the arcade.
echo"<table cellspacing=\"0\" cellpadding=\"5\" width=\"90%\" class=\"bodyline\" align=\"center\">\n"
  . "<tr>\n"
  . "  <td align=\"center\" width=\"90%\" class=\"row1\"><b>"._CZ_ARCADETOP."</b></td>\n"
  . "</tr>\n"
  . "</table>\n"
  . "<table cellspacing=\"0\" cellpadding=\"5\" width=\"90%\" class=\"bodyline\" align=\"center\">\n"
  . " <tr>\n"
  . "  <td align=\"center\" width=\"25%\" class=\"row1\">[&nbsp;<a href=\"modules.php?name=Forums&file=arcade\">"._CZ_ARCADE."</a> ]&nbsp;</td>\n"
  . "  <td align=\"center\" width=\"50%\" class=\"row1\">\n"
  . "<form name=\"arcademenu\">\n"
  . "<select name=\"arcade_menu\">\n"
  . "<option value=\"#\">"._CZ_ARCADEGAMES.":</option>";
    $sql = "SELECT game_id, game_name from ".$prefix."_bbgames ORDER BY game_id ASC"; 
    $result = $db->sql_query($sql);
    while( $row = $db->sql_fetchrow($result))
    {
    $game_id = intval($row[game_id]);
    $game_name = $row[game_name];

echo "<option value=\"modules.php?name=Forums&file=games&gid=$game_id\">$game_name</option>\n";
}
echo "<input type=\"button\" value=\"Play\" onClick=\"self.location.href=document.arcademenu.arcade_menu.options[document.arcademenu.arcade_menu.selectedIndex].value\">\n"
   . "</td>"
   . "  <td align=\"center\" width=\"25%\" class=\"row1\">[&nbsp;<a href=\"modules.php?name=Forums&file=toparcade\">"._CZ_TOPSCORERS."</a> ]&nbsp;</td>\n"
   . "  "
   . "  </tr>\n"
   . "</table>\n";
echo "<br />\n";
?>