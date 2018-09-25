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

// Count total hits per hour
$hourviews = array ( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,17, 18, 19, 20, 21, 22, 23 );
$maxhour = 0;
$totalhits = 0;

for( $i = 0; $i <= 23; $i++ ) {
   $result = $db->sql_query( "select SUM(hits) from ".$prefix."_stats_hour WHERE hour='$i'" );
   list( $hits ) = $db->sql_fetchrow( $result );
   $hourviews[ $i ] = $hits;
   if( $maxhour < $hits ) $maxhour = $hits;
   $totalhits = $totalhits + $hits;
}
$db->sql_freeresult( $result );
// Display Graphs
echo "<br>\n"; OpenTable();
echo "<div align=\"center\"><b>"._MSA_TOTALVISITSHOURS."</b><br><table border=\"0\" cellPadding=\"2\" cellSpacing=\"0\" width=\"90%\" align=\"center\"><tr><td></td>\n";
for( $i = 0; $i <= 23; $i++ ) {
   echo "<td align=\"center\" valign=\"bottom\">";
   if( $maxhour != 0 ) { $sheight =( $hourviews[ $i ] / $maxhour) * 120; }
   echo " <img src=\"modules/$module_name/images/vstat.gif\" height=\"$sheight\" width=\"16\" alt=\"".$hourviews[ $i ].""._MSA_PAGESVIEWED."\" title=\"".$hourviews[ $i ].""._MSA_PAGESVIEWED."\"></td>";
}
echo "</tr><tr><td><b>"._MSA_HOURS."</b></td>\n";
for( $i = 0; $i < 24; $i++ ) { if( strlen( $i ) == 1 ) echo "<td align=\"center\">0".$i."</td>\n"; else echo "<td align=\"center\">".$i."</td>\n"; }
echo "</tr></table>\n";

// Draw Text Table
echo "<br><div align=\"center\"><center>\n";
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor1\">\n";
echo "<tr>\n";
echo "<td width=\"100%\" colspan=\"8\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><b>"._MSA_TOTALVISITSHOURS."</b></td>\n";
echo "</tr>\n";
$j = 0;
for( $i = 0; $i <= 5; $i++ ) {
   echo "<tr>\n";
   if( $hourviews[ $j ] == 0 ) $hourviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "<td width=\"20%\" align=\"center\" bgcolor=\"$bgcolor1\"><b>".$sj.":00-".$sj.":59</b></td>\n";
   echo "<td width=\"5%\" align=\"center\" bgcolor=\"$bgcolor1\">" . round( 100 * ( $hourviews[ $j ] / $totalhits ), 2 ) . "%</td>\n";
   $j += 1; if( $hourviews[ $j ] == 0 ) $hourviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "<td width=\"20%\" align=\"center\" bgcolor=\"$bgcolor1\"><b>".$sj.":00-".$sj.":59</b></td>\n";
   echo "<td width=\"5%\" align=\"center\" bgcolor=\"$bgcolor1\">" . round( 100 * ( $hourviews[ $j ] / $totalhits ), 2 ) . "%</td>\n";
   $j += 1; if( $hourviews[ $j ] == 0 ) $hourviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "<td width=\"20%\" align=\"center\" bgcolor=\"$bgcolor1\"><b>".$sj.":00-".$sj.":59</b></td>\n";
   echo "<td width=\"5%\" align=\"center\" bgcolor=\"$bgcolor1\">" . round( 100 * ( $hourviews[ $j ] / $totalhits ), 2 ) . "%</td>\n";
   $j += 1; if( $hourviews[ $j ] == 0 ) $hourviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "<td width=\"20%\" align=\"center\" bgcolor=\"$bgcolor1\"><b>".$sj.":00-".$sj.":59</b></td>\n";
   echo "<td width=\"5%\" align=\"center\" bgcolor=\"$bgcolor1\">" . round( 100 * ( $hourviews[ $j ] / $totalhits ), 2 ) . "%</td>\n";
   $j += 1; if( $hourviews[ $j ] == 0 ) $hourviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "</tr>\n";
}
echo "</table>\n";
echo "</center>\n";
echo "</div>\n";

CloseTable();
unset( $hourviews );

////////////////////////////////////////////////////////////////////////////

// Count total hits per WEEKday
$weekdayviews = array ( 0, 1, 2, 3, 4, 5, 6 );
$maxweekday = 0;
$totalhits = 0;

// Reset Weekday array
for( $i = 0; $i <= 6; $i++ ) { $weekdayviews[ $i ] = 0; }

// Gather data
$result = $db->sql_query( "select year, month, date, hits from ".$prefix."_stats_date" );
while( list( $year, $month, $date, $hits ) = $db->sql_fetchrow( $result ) ) {
   // Calculate weekday
   $weekday = date( "w", mktime( 0, 0, 0, $month, $date, $year ) );
   $weekdayviews[ $weekday ] = $weekdayviews[ $weekday ] + $hits;
   if( $maxweekday < $weekdayviews[ $weekday ] ) $maxweekday = $weekdayviews[ $weekday ];
   $totalhits = $totalhits + $hits;
}
$db->sql_freeresult( $result );

// Display Text Table and Graphs
echo "<br>\n"; OpenTable();
echo "<div align=\"center\">\n";
echo "<center>\n";
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor1\">\n";
echo "<tr>\n";
echo "<td width=\"100%\" colspan=\"2\" height=\"30\" align=\"center\" bgcolor=\"$bgcolor2\"><b>"._MSA_TOTALVISITSWEEKDAYS."</b></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td width=\"20%\">\n";
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor1\">\n";
echo "<tr>\n";
echo "<td width=\"50%\"><b>"._MSA_SUNDAY."</b></td>\n";
echo "<td width=\"10%\">" . round( 100 * ( $weekdayviews[ 0 ] / $totalhits ), 2 ) . "%</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td width=\"90%\"><b>"._MSA_MONDAY."</b></td>\n";
echo "<td width=\"10%\">" . round( 100 * ( $weekdayviews[ 1 ] / $totalhits ), 2 ) . "%</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td width=\"90%\"><b>"._MSA_TUESDAY."</b></td>\n";
echo "<td width=\"10%\">" . round( 100 * ( $weekdayviews[ 2 ] / $totalhits ), 2 ) . "%</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td width=\"90%\"><b>"._MSA_WEDNESDAY."</b></td>\n";
echo "<td width=\"10%\">" . round( 100 * ( $weekdayviews[ 3 ] / $totalhits ), 2 ) . "%</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td width=\"90%\"><b>"._MSA_THURSDAY."</b></td>\n";
echo "<td width=\"10%\">" . round( 100 * ( $weekdayviews[ 4 ] / $totalhits ), 2 ) . "%</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td width=\"90%\"><b>"._MSA_FRIDAY."</b></td>\n";
echo "<td width=\"10%\">" . round( 100 * ( $weekdayviews[ 5 ] / $totalhits ), 2 ) . "%</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td width=\"90%\"><b>"._MSA_SATURDAY."</b></td>\n";
echo "<td width=\"10%\">" . round( 100 * ( $weekdayviews[ 6 ] / $totalhits ), 2 ) . "%</td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "</td>\n";

echo "<td width=\"80%\">\n";
echo "<div align=\"center\"><table border=\"0\" cellPadding=\"2\" cellSpacing=\"0\" width=\"90%\" align=\"center\"><tr><td></td>\n";
for( $i = 0; $i <= 6; $i++ ) {
   echo "<td align=\"center\" valign=\"bottom\">";
   if( $maxweekday != 0 ) { $sheight =( $weekdayviews[ $i ] / $maxweekday) * 120; }
   echo " <img src=\"modules/$module_name/images/vstat.gif\" height=\"$sheight\" width=\"32\" alt=\"".$weekdayviews[ $i ].""._MSA_PAGESVIEWED."\" title=\"".$weekdayviews[ $i ].""._MSA_PAGESVIEWED."\"></td>";
}
echo "</tr><tr><td><b>"._MSA_DAYS."</b></td>\n";
echo "<td align=\"center\">"._MSA_SUNDAY."</td>\n";
echo "<td align=\"center\">"._MSA_MONDAY."</td>\n";
echo "<td align=\"center\">"._MSA_TUESDAY."</td>\n";
echo "<td align=\"center\">"._MSA_WEDNESDAY."</td>\n";
echo "<td align=\"center\">"._MSA_THURSDAY."</td>\n";
echo "<td align=\"center\">"._MSA_FRIDAY."</td>\n";
echo "<td align=\"center\">"._MSA_SATURDAY."</td>\n";
echo "</tr></table>\n";
echo "</center>\n";
echo "</div>\n";
echo "</td>\n";

echo "</tr>\n";
echo "</table>\n";
echo "</center>\n";
echo "</div>\n";

CloseTable();
unset( $weekdayviews );

////////////////////////////////////////////////////////////////////////////

// Count total hits per month
$monthviews = array ( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 );
$maxmonth = 0;
$totalhits = 0;

for( $i = 1; $i <= 12; $i++ ) {
   $result = $db->sql_query( "select SUM(hits) from ".$prefix."_stats_month WHERE month='$i'" );
   list( $hits ) = $db->sql_fetchrow( $result );
   $monthviews[ $i ] = $hits;
   if( $maxmonth < $hits ) $maxmonth = $hits;
   $totalhits = $totalhits + $hits;
}
$db->sql_freeresult( $result );
// Display Graphs
echo "<br>\n"; OpenTable();
echo "<div align=\"center\"><b>"._MSA_TOTALVISITSMONTHS."</b><br><table border=\"0\" cellPadding=\"2\" cellSpacing=\"0\" width=\"90%\" align=\"center\"><tr><td></td>\n";
for( $i = 1; $i <= 12; $i++ ) {
   echo "<td align=\"center\" valign=\"bottom\">";
   if( $maxmonth != 0 ) { $sheight =( $monthviews[ $i ] / $maxmonth) * 120; }
   echo " <img src=\"modules/$module_name/images/vstat.gif\" height=\"$sheight\" width=\"32\" alt=\"".$monthviews[ $i ].""._MSA_PAGESVIEWED."\" title=\"".$monthviews[ $i ].""._MSA_PAGESVIEWED."\"></td>";
}
echo "</tr><tr><td><b>"._MSA_MONTHS."</b></td>\n";
for( $i = 1; $i < 13; $i++ ) { if( strlen( $i ) == 1 ) echo "<td align=\"center\">0".$i."</td>\n"; else echo "<td align=\"center\">".$i."</td>\n"; }
echo "</tr></table>\n";

// Draw Text Table
echo "<br><div align=\"center\"><center>\n";
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor1\">\n";
echo "<tr>\n";
echo "<td width=\"100%\" colspan=\"8\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><b>"._MSA_TOTALVISITSMONTHS."</b></td>\n";
echo "</tr>\n";
$j = 1;
for( $i = 0; $i <= 2; $i++ ) {
   echo "<tr>\n";
   if( $monthviews[ $j ] == 0 ) $monthviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "<td width=\"20%\" align=\"center\" bgcolor=\"$bgcolor1\"><b>".$sj."</b></td>\n";
   echo "<td width=\"5%\" align=\"center\" bgcolor=\"$bgcolor1\">" . round( 100 * ( $monthviews[ $j ] / $totalhits ), 2 ) . "%</td>\n";
   $j += 1; if( $monthviews[ $j ] == 0 ) $monthviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "<td width=\"20%\" align=\"center\" bgcolor=\"$bgcolor1\"><b>".$sj."</b></td>\n";
   echo "<td width=\"5%\" align=\"center\" bgcolor=\"$bgcolor1\">" . round( 100 * ( $monthviews[ $j ] / $totalhits ), 2 ) . "%</td>\n";
   $j += 1; if( $monthviews[ $j ] == 0 ) $monthviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "<td width=\"20%\" align=\"center\" bgcolor=\"$bgcolor1\"><b>".$sj."</b></td>\n";
   echo "<td width=\"5%\" align=\"center\" bgcolor=\"$bgcolor1\">" . round( 100 * ( $monthviews[ $j ] / $totalhits ), 2 ) . "%</td>\n";
   $j += 1; if( $monthviews[ $j ] == 0 ) $monthviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "<td width=\"20%\" align=\"center\" bgcolor=\"$bgcolor1\"><b>".$sj."</b></td>\n";
   echo "<td width=\"5%\" align=\"center\" bgcolor=\"$bgcolor1\">" . round( 100 * ( $monthviews[ $j ] / $totalhits ), 2 ) . "%</td>\n";
   $j += 1; if( $monthviews[ $j ] == 0 ) $monthviews[ $j ] = 1; if( strlen( $j ) == 1 ) $sj = "0" . $j; else $sj = $j;
   echo "</tr>\n";
}
echo "</table>\n";
echo "</center>\n";
echo "</div>\n";

CloseTable();
unset( $monthviews );

?>
