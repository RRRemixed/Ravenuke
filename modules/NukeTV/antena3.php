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
$Imagen = "antena3.gif";
$Video = "http://www.comfm.com/php/tv/live.php?id=918";
$Enlace = "http://www.antena3tv.es";
$Pais = "Espa�a";
$Idioma="Espa�ol";
$Cadena = "Antena3";
$Nombre = "Antena3";
$Comentarios = "24 horas en directo";

/*
Now all we have to do is change the module name in the links through-out the script to $ModName
and you should be able to change than name of the directory to whatever you want, and the links will change with it.
This is done for our non-english speaking friends, and idiots like me that just change the name of things to
be "original"
*/

    include ('header.php');


OpenTable();
echo "

<center><h1>Internet TV 2.0</h1></center><p>
<a href=\"/modules.php?name=$ModName\">� Volver</a><p>
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"
style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\"
id=\"AutoNumber1\">
  <tr>
    <td width=\"50%\" valign=\"top\"><img border=\"0\" src=\"/modules/$ModName/images/$Imagen\"
width=\"188\" height=\"85\"><p>
    $Nombre<p>
    � <a target=\"_blank\" href=$Enlace>Web
Corporativa</a><br>
    � Pa�s: $Pais<br>
    � Idioma: $Idioma<br>
    � Emisi�n: $Comentarios<br>
&nbsp;</td>
       <td width=\"50%\"><DIV align=\"right\">
<TABLE BORDER=\"0\" CELLPADDING=\"0\" CELLSPACING=\"0\">
<TR> <TD bgcolor=\"#ACACAC\">
  <p align=\"center\"><FONT COLOR=\"#FFFFFF\" SIZE=\"1\" FACE=\"tahoma,
verdana, arial\"><B>eduangi telecom media player - $Cadena</TD> </TR> <TR>
    <TD align=\"center\" valign=\"top\">
    <BR>
    <OBJECT
  ID=\"mediaPlayer0\"
  CLASSID=\"CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95\"

CODEBASE=\"http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2
inf.cab#Version=5,1,52,701\"
  STANDBY=\"Loading Microsoft Windows Media Player components...\"
  TYPE=\"application/x-oleobject\">
  <PARAM NAME=\"fileName\"
VALUE=$Video>
  <PARAM NAME=\"animationatStart\" VALUE=\"true\">
  <PARAM NAME=\"transparentatStart\" VALUE=\"true\">
  <PARAM NAME=\"autoStart\" VALUE=\"true\">
  <PARAM NAME=\"showControls\" VALUE=\"true\">
</OBJECT>

</TD>
</TR>
</TABLE>
</DIV>
    <p>&nbsp;<p align=\"center\">&nbsp;</td>
  </tr>
  </table>
<p>
Internet TV 2.0 by <a href=\"http://www.eduangi.com\"
target\"_blank\"><b>http://www.eduangi.com</b></a>.
";

CloseTable();


    include ('footer.php');


?>
?>



