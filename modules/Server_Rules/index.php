<?php
/********************************************************/
/* Server Rules Module for PHP-Nuke                     */
/* Version 1.0 12-13-06                                 */
/* By: Floppy (floppydrivez@hotmail.com)                */
/* http://www.clan-themes.co.uk                         */
/* Copyright © 2006 by T3 Gaming Community              */
/********************************************************/
if (!eregi("modules.php", $PHP_SELF)) {
   die ("You can't access this file directly...");

}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
include("header.php");
$index = 0;
global $db, $prefix, $bgcolor2, $textcolor1;
OpenTable();
echo "<center>\n<table width='100%' cellpadding='2' cellspacing='1' bgcolor='$textcolor1'>\n";
echo "<tr><td align='center' colspan='4' class='option'><b><font color='white'>Server Rules</font></b></td></tr>\n";
$result = $db->sql_query("SELECT * from ".$prefix."_server_rules ORDER BY rpos ASC");
while($row = $db->sql_fetchrow($result)) {
$rid = intval($row['rid']);
$rpos = intval($row['rpos']);
$rtitle = $row['rtitle'];
$rdetails = $row['rdetails'];
$one = $row['one'];
echo "<tr bgcolor='$bgcolor2' align='center'>\n";
echo "<td align='left' colspan='2'><b>$rtitle</b></td></tr>\n";
echo "<tr bgcolor='$bgcolor2'><td width='100%' colspan='2'>$rdetails<br><br><b>Penalty</b>&nbsp;$one</td></tr>";
echo "<tr><td colspan='2'></td></tr>";
}
echo "</tr></table><br />";
CloseTable();
include("footer.php");

?>