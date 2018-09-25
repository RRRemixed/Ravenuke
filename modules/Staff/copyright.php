<?php


$module_name		= basename(dirname(__FILE__));
$mod_name		= "Mc Staff 1.2.5";
$author_email	= "scripts@matteoiammarrone.com";
$author_homepage	= "http://www.matteoiammarrone.com";
$author_name		= "<a href=\"$author_homepage\">matteoiamma</a>";
$license		= "GNU/GPL";
$download_location	= "http://www.matteoiammarrone.com/public/modules.php?name=Downloads";
$module_version	= "1.2.5";
$release_date	= "Ottobre 2009";
$module_description	= "Un semplice modulo per visualzzare lo staff del vostro nuke:),gestione avanzata ma facile dei componenti";
$mod_cost		= "Free Open Source";

function show_copyright() {
    global $mod_cost, $forum, $mod_name, $module_name, $release_date, $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if ($mod_name == "") { $mod_name = eregi_replace("_", " ", $module_name); }
    echo "<html>\n";
    echo "<head><title>$mod_name: Copyright Information</title></head>\n";
    echo "<body bgcolor='#FFFFFF' link='#000000' alink='#000000' vlink='#000000'>\n";
    echo "<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
    echo "<td width='100%' align='center'><font size='2' face='Arial, Helvetica'><b>Module Copyright &copy; Information</b><br>";
    echo "$mod_name module for <a href='http://phpnuke.org' target='new'>PHP-Nuke</a><br>[<a href='javascript:void(0)' onClick=javascript:self.close()>Chiudi finestra</a>]</font></td>\n";
    echo "</tr>\n</table>\n<hr>\n";
    echo "<font size='2' face='Arial, Helvetica'>";
    echo "<img src='images/arrow.png' border='0'>&nbsp;<b>Nome Modulo:</b> $mod_name<br>\n";
    if ($module_version != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<b>Versione:</b> $module_version<br>\n"; }
    if ($release_date != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<b>Data di rilascio:</b> $release_date<br>\n"; }
    if ($mod_cost != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<b>Prezzo Modulo:</b> $mod_cost<br>\n"; }
    if ($license != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<b>Licensa:</b> $license<br>\n"; }
    if ($author_name != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<b>Nome Autore:</b> $author_name<br>\n"; }
    if ($author_email != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<b>Email Autore:</b> $author_email<br>\n"; }
    if ($module_description != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<b>Descrizione modulo:</b> $module_description<br>\n"; }
    if ($download_location != "") { echo "<img src='images/arrow.png' border='0'>&nbsp;<b>Dove scaricare il modulo:</b> <a href='$download_location' target='new'>Download</a><br>\n"; }
    echo "<hr>\n";
    echo "</font>\n";
    echo "</body>\n";
    echo "</html>";
}

show_copyright();

?>