<?php

/************************************************************************************/
/*                                                                                  */
/* Maty Scripts Analysis for PHP-Nuke 6.5-7.9                                       */
/* v2.3                                                                             */
/*                                                                                  */
/* Copyright © 2002-2005 by: Maty Scripts (webmaster@matyscripts.com)               */
/* http://www.matyscripts.com                                                       */
/*                                                                                  */
/* This program is free software. You can redistribute it and/or modify             */
/* it under the terms of the GNU General Public License as published by             */
/* the Free Software Foundation; either version 2 of the License.                   */
/*                                                                                  */
/************************************************************************************/

if(stristr( $_SERVER['SCRIPT_NAME'], "block-MSA-Analysis-1.php" ) ) {
    Header("Location: index.php");
    die();
}

global $prefix, $db, $language, $lang, $sitename;

$module_name = "MS_Analysis";
$max_displayed = 10;
$counter = 0;

if (isset( $newlang ) ) { $language = $newlang; } elseif ( isset( $lang ) ) { $language = $lang; } else { $language = $currentlang; }
if( file_exists( "modules/$module_name/language/lang-$language.php" ) ) { include( "modules/$module_name/language/lang-$language.php" ); } else { include( "modules/$module_name/language/lang-english.php" ); }

$content  = "<font class=\"content\"><center>"._MSA_BLOCKCOUNTRY." ".$sitename."</center></font><br>";
$content .= "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">";

$result = $db->sql_query( "select domain, description, hits from ".$prefix."_msanalysis_countries order by hits DESC" );
while( (list( $domain, $description, $hits ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_displayed ) ) {
   $flag = "modules/$module_name/images/flags/$domain".".gif";
   if( !( file_exists( $flag ) ) ) $flag = "modules/$module_name/images/flags/blank.gif";
   $counter += 1;
   $content .= "<tr><td align=\"right\" width=\"10%\">".$counter."</td>";
   $content .= "<td align=\"left\" width=\"90%\"><font class=\"content\">&nbsp;<img src=\"$flag\" ALT=\"$description\" TITLE=\"$description\" border=\"0\" width=\"16\" height=\"10\"><b>&nbsp;$description</b></td></tr>";
}
$content .= "<tr><td colspan=\"3\" align=\"center\"><br><font class=\"content\"><a href=\"modules.php?name=$module_name&op=MSAnalysisGeneral&file=index\">"._MSA_BLOCKVIEW."</a></font></td></tr></table>";

?>