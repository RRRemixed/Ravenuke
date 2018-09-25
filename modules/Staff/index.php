<?php

//MODULO MC STAFF
//MODULO SEMPLICE MA AVANZATO PER LA GESTIONE DELLO STAFF SUL PROPIO SITO NUKE:)!
//POWERED BY MATTEOIAMMA - WWW.MATTEOIAMMARRONE.COM

//MODIFICATO E FIXATO PER LA 1.2.5 DEL 5 OTTOBRE 2009

if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}

require_once "mainfile.php";

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

include("header.php");
OpenTable();

global $admin; 

if (is_admin($admin)) { 
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"modules/$module_name/admin/style.css\">";

echo "<center>";
echo "<div class=\"buttonwrapper\">
<a class=\"squarebutton\" href=\"modules.php?name=$module_name&file=admin\"><span>"._ADMINMC."</span></a>
</div>";
echo "</center>";
} 




global $prefix;
$staff = $db->sql_query("SELECT * FROM ".$prefix."_mcstaff_staff");


	echo "<center><table  border=\"0\" cellspacing=\"2\" cellpadding=\"0\" height=\"266\">";
   while ($staff_row = $db->sql_fetchrow($staff)) {
	if (file_exists("images/staff/".$staff_row['avatar']."")){
$imgfile = "images/staff/".$staff_row['avatar']."";
} else {
$imgfile = "".$staff_row['avatar']."";
}

	echo "<p></p>";
		echo "<p></p>";
		echo "<tr>";
	echo"	<td>"
  . "					<div align=\"center\">"
  . "						<img  src=\"$imgfile\" alt=\"\" border=\"0\" /></div>"
  . "				</td>"
  . "				<td>"
  . "					<div align=\"center\">"
  . "<p></p>"
  . "Username:"
  . "<p><a href='modules.php?name=Your_Account&op=userinfo&username=".$staff_row['username']."'>".$staff_row['username']."</a>"
  . "<br></br>"
  . "						<p></p><p></p><p></p><p>"._RANK.":</p>"
  . "						<p><font color='".$staff_row['color']."'>".$staff_row['rank']."</font></p>"
  . "					</div>"
  . "				</td>";
  echo "</tr>";

	}
	
	echo "	</table></center>";








CloseTable();


include "footer.php";





?>