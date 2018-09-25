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

if(stristr( $_SERVER['SCRIPT_NAME'], "block-MSA-Analysis-2.php" ) ) {
    Header("Location: index.php");
    die();
}

global $prefix, $db, $language, $lang, $sitename;

$module_name = "MS_Analysis";
$max_displayed = 10;
$counter = 0;

if (isset( $newlang ) ) { $language = $newlang; } elseif ( isset( $lang ) ) { $language = $lang; } else { $language = $currentlang; }
if( file_exists( "modules/$module_name/language/lang-$language.php" ) ) { include( "modules/$module_name/language/lang-$language.php" ); } else { include( "modules/$module_name/language/lang-english.php" ); }

$content  = "<font class=\"content\"><center>"._MSA_BLOCKONLINE." ".$sitename."</center></font><br>";
$content .= "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"100%\"><tr>";

$result = $db->sql_query( "select uname, domain, modulename from ".$prefix."_msanalysis_online order by time DESC limit 0, $max_displayed" );
while( (list( $uname, $domain, $modulename ) = $db->sql_fetchrow( $result ) ) ) {
   $counter += 1;
   if( $counter <= 9 ) { $counter = '0'.$counter; }
   if( $modulename != "" ) {
      $modulename = strtr ( $modulename, ' ', '_' );
      $modulename = "<br>&nbsp;&nbsp;--->&nbsp;"."<a href=\"modules.php?name=".$modulename."\">$modulename</a>";
   }
   $result1 = $db->sql_query( "select description from ".$prefix."_msanalysis_domains where domain='$domain'" );
   list( $description ) = $db->sql_fetchrow( $result1 );
   $flag = "modules/$module_name/images/flags/$domain".".gif";
   if( !( file_exists( $flag ) ) ) $flag = "modules/$module_name/images/flags/blank.gif";
   if( $uname != "Guest" ) {
      $suname = substr( $uname, 0, 10 );
      $usergraph = "modules/$module_name/images/online-user.gif";
      $content .= "<td align=\"left\"><font class=\"content\">$counter&nbsp;<img src=\"$flag\" ALT=\"$description\" TITLE=\"$description\" width=\"16\" height=\"10\"><img src=\"$usergraph\" ALT=\"$uname\" TITLE=\"$uname\">&nbsp;<A HREF=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\"><b>$suname</b></a>".$modulename."</td></tr>";
   } else {
      $usergraph = "modules/$module_name/images/offline-user.gif";
      $content .= "<td align=\"left\"><font class=\"content\">$counter&nbsp;<img src=\"$flag\" ALT=\"$description\" TITLE=\"$description\" width=\"16\" height=\"10\"><img src=\"$usergraph\" ALT=\"$uname\" TITLE=\"$uname\">&nbsp;<b>"._MSA_ONLINEGUEST."</b>$modulename</td></tr>";
   }
}
$content .= "<tr><td colspan=\"3\" align=\"center\"><br><font class=\"content\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=13\">"._MSA_BLOCKVIEW."</a></font></td></tr></table>";

?>