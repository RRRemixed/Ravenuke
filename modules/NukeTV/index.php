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
			    


if (!eregi("modules.php", $PHP_SELF)) {
        die ("You can't access this file directly...");
    }

/* Internet TV 
Credits to Eduardo Collado -- http://www.eduangi.com/  */

$ModName = basename( dirname( __FILE__ ) ); 

/*
Now all we have to do is change the module name in the links through-out the script to $ModName
and you should be able to change than name of the directory to whatever you want, and the links will change with it.
This is done for our non-english speaking friends, and idiots like me that just change the name of things to
be "original"
*/



    include ('header.php');


OpenTable();
echo "
<div align=\"center\"><b><br>
</b>
<div align=\"left\">
<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"100%\">
  <tbody>
    <tr>
      <td valign=\"top\"><h3>"._ITV."</h3><br>
      "._LISTA1."<b><font color=\"#FF0000\"> "._LISTA2."
      </font></b>
      </td>
      <td valign=\"top\" align=\"center\"><b>"._ITV."</b><br>
      <img src=\"/modules/$ModName/images/tv.jpg\" alt=\""._ITV."\"
width=\"118\"  height=\"81\">
      <br>
      </td>
    </tr>
  </tbody>
</table>
</div>
<b><br><h2>"._CANALES."</h2><p>
</b>
<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"100%\"
height=\"50\">
  <tbody>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r1\">5 City TV</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r2\">Nasa News</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ESP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._MEX."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r3\">TeleFormula</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._CAN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r4\">CBC News Online</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._UK."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r49\">BBC News</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r5\">C Span 2</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._JAPA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._JAP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r6\">Fuji News Network</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._TAIW."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._TAI."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r7\">MAC TV</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ESP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._ES."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r8\">Canal Sur</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ARAB."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._TUN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r9\">Tunisia TV</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._GRIE."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._GRE."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r10\">ERT Sat</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._GRIE."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._CHIP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r11\">Cyprus Broadcasting Corp.</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ARA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._BAH."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r12\">Discover Islam TV</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._SER."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._BOS."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r13\">NTV</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._IND."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r14\">NetGuru</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._FRAN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._FRA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r15\">Demain</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ALE."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._GER."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r16\">Germany n-tv</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r17\">EWTN</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r21\">KCCG-TV Channel 2</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._GRIE."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._CHIP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r22\">Kypros</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r25\">Daytona Beach Live</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._IREL."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r26\">Ireland Television News</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._UK."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r27\">E-Music</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._CAT."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._AND."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r35\">Televisió d'Andorra</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ES."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._MEX."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r36\">TeVe-de-mente</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._HUNG."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._HUN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=r40\">TV Egy</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/rp.gif\" alt=\"rp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ESP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._ES."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w3\">Television Castilla</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._RUS."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._RU."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w4\">Special Radio</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w5\">Austin Music Network</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._DESC."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w6\">Africa Hits</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._ICE."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w7\">Popptivi</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._CHIN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w8\">CCTV 9 Live</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w9\">OAHU TV</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ITL."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._VAT."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w10\">Vatican City Television</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ESP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._COSRIC."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w11\">Canal 23</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._AUS."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w12\">National 9 News</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ITL."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._IT."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w13\">HitChannel</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._PHIL."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._PHI."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w14\">UNTVweb</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._SLOV."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._SLO."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w15\">TV Pika</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._DUT."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._BEL."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w18\">Vitaya, TV for Women</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ALE."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._AUSTRIA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w19\">Austria EROTIC TV6</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._CAN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w20\">Canada's Political Channel</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ESP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._VEN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w43\">VENEZUELA Government television</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ESP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._ARG."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w26\">RTVR</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ARAB."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._KUW."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w27\">KTV-1</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ARA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._BRU."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w32\">RTB</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w35\">Kulaks WoodShed - Acoustic</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ESP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._DOM."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w36\">Telemedios Dominicana S.A. canal 25</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._ESP."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._CU."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w37\">Televisión Cubana 6</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._GAL."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._ES."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w38\">Televisión de Galicia</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w39\">Worldart Media Television</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._SERBI."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._SERB."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w40\">TV Metropolis</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._VARI."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._UK."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w41\">Classic FM</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._WEBC."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w42\">Monterey Bay Aquarium</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>
<tr> <td valign=\"top\" align=\"center\" height=\"31\">"._EN."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\">"._USA."<br> </td> <td valign=\"top\" align=\"center\" height=\"31\"><a href=\"/modules.php?name=$ModName&amp;file=w43\">Mania TV</a></td> <td valign=\"top\" align=\"center\" height=\"31\"><img src=\"/modules/$ModName/images/wmp.gif\" alt=\"wmp\" width=\"75\" height=\"25\"> <br> </td> </tr>

  </tbody>
</table>
<p>

"._ITV." "._POR." <a href=\"http://www.eduangi.com\" target=\"_blank\"><img src=\"/modules/$ModName/images/module.gif\"></a>
"._GREG."
<B>"._FORUM."</B>

</div>


";

CloseTable();


    include ('footer.php');


?>
?>




