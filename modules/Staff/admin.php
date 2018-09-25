<?php
//MODULO MC STAFF
//MODULO SEMPLICE MA AVANZATO PER LA GESTIONE DELLO STAFF SUL PROPIO SITO NUKE:)!
//Il mio primo modulo nuke con gestione corretta dei contenuti in mysql:)!(FInalmente ho imparato)!
//POWERED BY MATTEOIAMMA - WWW.MATTEOIAMMARRONE.COM


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
<a class=\"squarebutton\" href=\"modules.php?name=$module_name&file=index\"><span>"._PREVIEW."</span></a>
<a class=\"squarebutton\" href=\"modules.php?name=$module_name&file=admin\"><span>"._STAFF_MANAGER."</span></a>
<a class=\"squarebutton\" href=\"admin.php\"><span>"._ADMIN_HOME."</span></a>
</div>";
echo "</center>";

//INIZIO FUNZIONE AGGIUNGIMEMBRO
global $prefix;

$query1 = $db->sql_query("SELECT * FROM ".$prefix."_mcstaff_ranks");
$query2 = $db->sql_query("SELECT * FROM ".$prefix."_users");

echo "<center>";
echo "<b>"._ADD_STAFF_USER."</b>";
echo "<form action='modules.php?name=$module_name&file=admin' method='post'>";
echo "<p></p>";
echo ""._ADD_USER_CHOOSE."";
echo "<p></p>";
echo"<select name=\"username\">";
while($row = mysql_fetch_array($query2))
{


    echo "<option value=\"".$row['username']."\">".$row['username']."</option>";
}
echo"</select>";

echo "<p></p>";
echo "<p></p>";
echo ""._ADDRANK."";
echo "<p></p>";
echo"<select name=\"rank\">";
while($rank = mysql_fetch_array($query1))
{
    echo "<option value=\"".$rank['titolo']."\">".$rank['titolo']."</option>";
}
echo"</select>";


echo "<p></p>";
echo"<script language=\"JavaScript\">"
  . "function BtnOkClicked()"
  . "{"
  . "     document.getElementById(\"user_color\").value = SEL_COLOR;"
  . "}"
  . "</script>"
  . "<input type=\"text\"  name=\"user_color\" id=\"user_color\" size=\"12\"><input type=\"button\" value=\"...\" onclick=\"ShowLayer();\">"
  . ""
  . "<div style=\"position:absolute;border:1px solid black;background-color:white;display:none;width:337px;height:375px;\" id=\"main\" imgLoc=\"./\">"
  . "</div>"
  . "<script language=\"JavaScript\" src=\"modules/$module_name/admin/cpick.js\"></script>"
  . ""
  . ""
  . "</div>";
echo "<p></p>";
echo ""._CHOOSEAVATAR."";
echo "<p></p>";
include "modules/$module_name/admin/chooseavatar.html";
echo "<p></p>";
echo "<p></p>";
echo "<p></p>";
echo "<input type='submit' name='add' value='"._ADD_STAFF_USER."'/>";
echo "</form>";


if ($_POST['add']){

$username=$_POST['username'];
$rank=$_POST['rank'];
$user_avatar=$_POST['user_avatar'];
$user_color=$_POST['user_color'];


global $prefix; 

$result = $db->sql_query("INSERT INTO ".$prefix."_mcstaff_staff (id, username, rank, avatar, color) VALUES ('', '$username', '$rank', '$user_avatar', '$user_color')");
 
if ($result){

echo ""._ADD_SUCCESS."!";

} else {

echo ""._ADD_PROBLEM."!";


}

}

echo "</center>";



CloseTable();
//FINE FUNZIONE AGGIUNGIMEMBRO
echo "<br></br>";
//INIZIO FUNZIONE AGGIUNGI GRADO/TITOLO UTENTE
OpenTable();
echo "<center>";
echo "<b>"._ADDRANK."</b>";
echo "<form action='modules.php?name=$module_name&file=admin' method='post'>";
echo "<p></p>";
echo ""._RANKTITLE."";
echo "<p></p>";
echo "<input type='text' name='ranktitle'>";
echo "<p></p>";
echo "<p></p>";
echo "<p></p>";
echo "<input type=\"submit\" name=\"add_rank\" value=\""._ADDRANK."\" />";
echo "</form>";
echo "</center>";


if ($_POST['add_rank']){

$titolo=$_POST['ranktitle'];

global $prefix; 

$result = $db->sql_query("INSERT INTO ".$prefix."_mcstaff_ranks (id, titolo) VALUES ('', '$titolo')");
 
if ($result){

echo ""._RANKSUCCESS."";

} else {

echo ""._RANKPROBLEM."";


}


}
CloseTable();
//FINE FUNZIONE AGGIUNGI GRADO

echo "<br></br>";

//INIZIO FUNZIONE "ELIMINA UTENTE"
OpenTable();

$delete_staff = $db->sql_query("SELECT * FROM ".$prefix."_mcstaff_staff");

echo "<center>";
echo "<b>"._STAFF_DELETE."</b>";
echo "<form action='modules.php?name=$module_name&file=admin' method='post'>";
echo "<p></p>";
echo ""._STAFF_USERNAME_DELETE."";
echo "<p></p>";
echo"<select name=\"username\">";
while($row = mysql_fetch_array($delete_staff))
{


    echo "<option value=\"".$row['username']."\">".$row['username']."</option>";
}

echo "<p></p>";
echo "<p></p>";
echo "<input type='submit' name='delete_staff' value='"._STAFF_DELETE."'/>";
echo "<p></p>";

if ($_POST['delete_staff']){

$username=$_POST['username'];

$delete_staff_process = $db->sql_query("DELETE FROM ".$prefix."_mcstaff_staff WHERE username='$username'");

if ($delete_staff_process){

echo ""._DELETE_SUCCESS."";

} else {

echo ""._DELETEPROBLEM."";

}

}
//FINE FUNZIONE ELIMINA MEMBRO

CloseTable();

echo "<br></br>";

//INIZIO FUNZIONE "ELIMINA RANK"
OpenTable();

$delete_rank = $db->sql_query("SELECT * FROM ".$prefix."_mcstaff_ranks");

echo "<center>";
echo "<b>"._RANK_DELETE."</b>";
echo "<form action='modules.php?name=$module_name&file=admin' method='post'>";
echo "<p></p>";
echo ""._STAFF_RANK_DELETE."";
echo "<p></p>";
echo "<p></p>";
echo"<select name=\"rank\">";
while($row = mysql_fetch_array($delete_rank))
{


    echo "<option value=\"".$row['titolo']."\">".$row['titolo']."</option>";
}

echo "<p></p>";
echo "<p></p>";
echo "<input type='submit' name='delete_rank' value='"._RANK_DELETE."'/>";
echo "<p></p>";

if ($_POST['delete_rank']){

$titolo=$_POST['rank'];

$delete_staff_process = $db->sql_query("DELETE FROM ".$prefix."_mcstaff_ranks WHERE titolo='$titolo'");

if ($delete_staff_process){

echo ""._DELETE_RANK_SUCCESS."";

} else {

echo ""._DELETE_RANK_PROBLEM."";

}

}
//FINE FUNZIONE ELIMINA RANK

CloseTable();

 }  else {


echo ""._STOP."";


}



CloseTable();


include "footer.php";





?>