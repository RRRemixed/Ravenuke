<?php
// ----------------------------------------------------------------------
// Internet TV 
// Copyright (C) 2002 by eduangi telecom Team.
// http://www.eduangi.com/
// ----------------------------------------------------------------------
// Based on:
// PHP-NUKE Web Portal System - http://phpnuke.org/
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------

if (!eregi("modules.php", $PHP_SELF)) {
        die ("You can't access this file directly...");
    }

/* Internet TV 
Credits to Eduardo Collado -- http://www.eduangi.com/  */

$ModName = basename( dirname( __FILE__ ) ); 
if(!IsSet($mainfile)) { include ("mainfile.php"); }

if (isset($newlang)) {
   include("modules/$ModName/language/lang-$newlang.php");
   $language = $newlang;
} elseif (isset($lang)) {
   include("modules/$ModName/language/lang-$lang.php");
   $language = $lang;
} else {
   include("modules/$ModName/language/lang-$language.php");
}

$Imagen = "vsbTV.gif";
$Video = "http://www.vsb.bm:8080/ramgen/vsb/dly9256.rm";
$Enlace = "http://www.vsb.bm";
$Pais = ""._BER."";
$Idioma=""._EN."";
$Cadena = "VSB TV";
$Nombre = "VSB TV";
$Comentarios = ""._NOT."";

/*
Now all we have to do is change the module name in the links through-out the script to $ModName
and you should be able to change than name of the directory to whatever you want, and the links will change with it.
This is done for our non-english speaking friends, and idiots like me that just change the name of things to
be "original"
*/

    include ('header.php');


OpenTable();
echo "

<center><h1>"._ITV."</h1></center></p>
<a href=\"/modules.php?name=$ModName\">· "._VOLVER."</a><p>
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"
style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\"
id=\"AutoNumber1\">
  <tr>
    <td width=\"50%\" valign=\"top\">
    <img border=\"0\" src=\"/modules/$ModName/images/$Imagen\"><p>
    $Nombre<p>
    · <a target=\"_blank\" href=$Enlace>"._WEB."</a><br>
    · "._PAIS.": $Pais<br>
    · "._IDIOMA.": $Idioma<br>
    · "._GENERO.": $Comentarios<br>
&nbsp;</td>
    <td width=\"50%\"><DIV align=\"right\">
<TABLE BORDER=\"0\" CELLPADDING=\"0\" CELLSPACING=\"0\">
<TR> <TD>
  <p align=\"center\"><FONT  SIZE=\"1\" FACE=\"tahoma,
verdana, arial\"><B>eduangi telecom media player - $Cadena</TD> </TR>
  <tr>
    <td width=\"100%\" align=\"center\">
    <object id=\"video3\"
classid=\"clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA\" height=\"212\"
width=\"264\"
codebase=\"http://scopes.real.com/real/player/player.html?src=000315choic
e_3,rpchoiceintl_es&lang=es&dc=272625\">
                              <param name=\"_ExtentX\" value=\"6985\">
                              <param name=\"_ExtentY\" value=\"5609\">
                              <param name=\"AUTOSTART\" value=\"-1\">
                              <param name=\"SHUFFLE\" value=\"0\">
                              <param name=\"PREFETCH\" value=\"0\">
                              <param name=\"NOLABELS\" value=\"0\">
                              <param name=\"SRC\"
value=$Video ref>
                              <param name=\"CONTROLS\"
value=\"ImageWindow\">
                              <param name=\"CONSOLE\" value=\"Clip1\">
                              <param name=\"LOOP\" value=\"0\">
                              <param name=\"NUMLOOP\" value=\"0\">
                              <param name=\"CENTER\" value=\"0\">
                              <param name=\"MAINTAINASPECT\" value=\"0\">
                              <param name=\"BACKGROUNDCOLOR\"
value=\"#000000\">
                              <embed
src=$Video
type=\"audio/x-pn-realaudio-plugin\" console=\"Clip1\"
controls=\"ImageWindow\" height=\"144\" width=\"192\" autostart=\"1\"
_extentx=\"5080\" _extenty=\"3810\" shuffle=\"0\" prefetch=\"0\" nolabels=\"0\"
loop=\"0\" numloop=\"0\" center=\"0\" maintainaspect=\"0\"
backgroundcolor=\"#000000\">
                              </embed></object></td>
  </tr>
  <tr>
    <td width=\"100%\" align=\"center\">
                            <object id=\"video1\"
classid=\"clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA\" height=\"25\"
width=\"45\">
                              <param name=\"_ExtentX\" value=\"1191\">
                              <param name=\"_ExtentY\" value=\"661\">
                              <param name=\"AUTOSTART\" value=\"0\">
                              <param name=\"SHUFFLE\" value=\"0\">
                              <param name=\"PREFETCH\" value=\"0\">
                              <param name=\"NOLABELS\" value=\"0\">
                              <param name=\"CONTROLS\" value=\"PlayButton\">
                              <param name=\"CONSOLE\" value=\"Clip1\">
                              <param name=\"LOOP\" value=\"0\">
                              <param name=\"NUMLOOP\" value=\"0\">
                              <param name=\"CENTER\" value=\"0\">
                              <param name=\"MAINTAINASPECT\" value=\"0\">
                              <param name=\"BACKGROUNDCOLOR\"
value=\"#000000\">
                              <embed type=\"audio/x-pn-realaudio-plugin\"
console=\"Clip1\" controls=\"PlayButton\" height=\"25\" width=\"45\"
autostart=\"false\">
                              </embed></object>
    <object id=\"video2\"
classid=\"clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA\" height=\"25\"
width=\"35\">
                              <param name=\"_ExtentX\" value=\"926\">
                              <param name=\"_ExtentY\" value=\"661\">
                              <param name=\"AUTOSTART\" value=\"0\">
                              <param name=\"SHUFFLE\" value=\"0\">
                              <param name=\"PREFETCH\" value=\"0\">
                              <param name=\"NOLABELS\" value=\"0\">
                              <param name=\"CONTROLS\" value=\"StopButton\">
                              <param name=\"CONSOLE\" value=\"Clip1\">
                              <param name=\"LOOP\" value=\"0\">
                              <param name=\"NUMLOOP\" value=\"0\">
                              <param name=\"CENTER\" value=\"0\">
                              <param name=\"MAINTAINASPECT\" value=\"0\">
                              <param name=\"BACKGROUNDCOLOR\"
value=\"#000000\">
                              <embed type=\"audio/x-pn-realaudio-plugin\"
console=\"Clip1\" controls=\"StopButton\" height=\"25\" width=\"35\"
autostart=\"false\">
                              </embed></object></td>
  </tr>
</TABLE>
</DIV>
    <p>&nbsp;<p align=\"center\">&nbsp;</td>
  </tr>
  </table>
  <p>
"._ITV." "._POR." <a href=\"http://www.eduangi.com\" target=\"_blank\"><img src=\"/modules/$ModName/images/module.gif\"></a>


";

CloseTable();


    include ('footer.php');


?>
?>



