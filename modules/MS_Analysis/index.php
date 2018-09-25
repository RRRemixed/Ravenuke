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

$index = 0;
$module_name = basename( dirname( __FILE__ ) );

if( !stristr( $_SERVER['SCRIPT_NAME'], "modules.php" ) ) {
   die( "You can't access this file directly..." );
}

require_once( "mainfile.php" );
@(require_once( "modules/$module_name/include/class.general.php" )) OR die ("File class.general.php can not be found" );
get_lang( $module_name );

if( isset( $sortby ) )  { $sortby = substr( "$sortby", 0, 6 ); }
if( isset( $screen ) )  { $screen = intval( $screen ); }
if( isset( $overview) ) { $overview = intval( $overview ); }

/******************************************************************************/
/* FUNCTION: MSAnalysisGeneral()                                              */
/* Show General Overview of all Statistics                                    */
/******************************************************************************/
function MSAnalysisGeneral( $screen, $overview, $sortby )
{
   global $module_name, $db, $prefix, $admin, $bgcolor1, $bgcolor2;

   include( "header.php" );
   @(include( "modules/$module_name/scripts/title.php" ) ) OR die ("File title.php can not be found" );

   $result = $db->sql_query( "select max_items, max_view, max_online, xdate, lastupdate, staticupdate from ".$prefix."_msanalysis_admin where id='1'" );
   list( $max_items, $max_view, $max_online, $xdate, $lastupdate, $staticupdate ) = $db->sql_fetchrow( $result );

   $max_items  = intval( $max_items );
   $max_view   = intval( $max_view );
   $max_online = intval( $max_online );

   // $overview: 1 = Today Overview | 2 = Last XX Days overview | 3 = Total Overview
   if( !isset( $overview ) ) {
      $result = $db->sql_query( "select overview from ".$prefix."_msanalysis_admin where id='1'" );
      list( $overview ) = $db->sql_fetchrow( $result );
      $overview = intval( $overview );
   }
   if( !isset( $screen ) ) {
      $result = $db->sql_query( "select screen from ".$prefix."_msanalysis_admin where id='1'" );
      list( $screen ) = $db->sql_fetchrow( $result );
      $screen = intval( $screen );
   }

   $msa = new msanalysis();
   // Date of Today
   $DateToday = $msa->MSLogDate( 1 );
   // Grep xdays and determine how many days the data is logged for that specific overview
   $xd = $msa->DaysOld( $xdate . "00:00:00" ) + 1;

   OpenTable();
   echo "<form enctype=\"multipart/form-data\" method=\"post\" action=\"modules.php?name=$module_name&file=index&op=MSAnalysisGeneral&screen=$screen&overview=$overview&sortby=$sortby\">";
   echo "<center><b>"._MSA_OVERVIEWPERIODS."</b>&nbsp;<select name=\"overview\" size=\"1\" onChange=\"submit()\">";
   if( $overview == 1 ) echo "<option value=\"1\" selected>"._MSA_OVERVIEWTODAY."</option>\n"; else echo "<option value=\"1\">"._MSA_OVERVIEWTODAY."</option>\n";
   if( $overview == 2 ) echo "<option value=\"2\" selected>"._MSA_OVERVIEWLASTDAYS1." $xd "._MSA_OVERVIEWLASTDAYS2."</option>\n"; else echo "<option value=\"2\">"._MSA_OVERVIEWLASTDAYS1." $xd "._MSA_OVERVIEWLASTDAYS2."</option>\n";
   if( $overview == 3 ) echo "<option value=\"3\" selected>"._MSA_OVERVIEWALL."</option>\n"; else echo "<option value=\"3\">"._MSA_OVERVIEWALL."</option>\n";
   if( ! $staticupdate ) echo "</select></center></form>\n";
   else echo "</select>&nbsp;(". _MSA_NEWSTATS . " " . $lastupdate . ")</center></form>\n";

   // Display All possible pages
   echo "<div align=\"center\">\n";
   echo "<center>\n";
   echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" height=\"25\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"80%\" bgcolor=\"$bgcolor1\">\n";
   echo "<tr><td width=\"100%\" colspan=\"8\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><b>" . _MSA_ADMINOPTIONS . "</b></td></tr>\n";
   echo "<tr>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/flags/nl.gif\" width=\"16\" height=\"10\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=1&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENCOUNTRIES."</a></td>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/nukestats/waiting.gif\" width=\"16\" height=\"10\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=2&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENREFERRALS."</a></td>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/nukestats/info.gif\" width=\"16\" height=\"16\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=3&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENSENGINES."</a></td>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/nukestats/info.gif\" width=\"16\" height=\"16\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=8&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENQUERIES."</a></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/browsers/netcaptor.gif\" width=\"16\" height=\"16\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=4&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENBROWSERS."</a></td>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/browsers/blank.gif\" width=\"10\" height=\"14\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=10&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENOTHERBROWSERS."</a></td>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/os/linux.gif\" width=\"16\" height=\"16\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=5&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENOS."</a></td>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/nukestats/sections.gif\" width=\"16\" height=\"16\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=6&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENMODULES."</a></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/online-user.gif\" width=\"17\" height=\"14\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=7&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENUSERS."</a></td>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/nukestats/profile.gif\" width=\"18\" height=\"15\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=9&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENRESOLUTION."</a></td>\n";
   echo "<td width=\"5%\" height=\"25\"><center><img src=\"modules/$module_name/images/overview.gif\" width=\"20\" height=\"20\" border=\"0\"></center></td><td width=\"20%\" height=\"25\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=11&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_GENTITLE."</a></td>\n";
   echo "<td width=\"5%\" height=\"25\">&nbsp;</td><td width=\"20%\" height=\"25\">&nbsp;</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"100%\" colspan=\"8\" align=\"center\" height=\"25\" bgcolor=\"$bgcolor1\" style=\"border-style: solid; border-width: 0; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\">\n";
   echo "<img src=\"modules/$module_name/images/vstat.gif\" width=\"12\" height=\"14\" border=\"0\">&nbsp;<a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=12&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_VISITOROVERVIEWGRAPH."</a>&nbsp;&nbsp;\n";
   echo "<img src=\"modules/$module_name/images/nukestats/counter.gif\" width=\"12\" height=\"15\" border=\"0\">&nbsp;<a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=15\">"._MSA_VISITOROVERVIEW."</a>&nbsp;&nbsp;\n";
   echo "<img src=\"modules/$module_name/images/nuke.png\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=14\">"._MSA_MENUNUKESTATS."</a>\n";
   echo "</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"100%\" colspan=\"8\" align=\"center\" height=\"25\" bgcolor=\"$bgcolor1\" style=\"border-style: solid; border-width: 0; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\">\n";
   echo "<img src=\"modules/$module_name/images/lastpage.png\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=13&amp;overview=$overview&amp;sortby=$sortby\">"._MSA_MENUPAGEVISITS."</a>&nbsp;&nbsp;\n";
   echo "<img src=\"modules/$module_name/images/themes.png\" width=\"16\" height=\"16\" border=\"0\">&nbsp;<a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=16\">"._MSA_MENUNUKETHEMES."</a>&nbsp;&nbsp;\n";
   echo "<img src=\"modules/$module_name/images/vstat.gif\" width=\"12\" height=\"14\" border=\"0\">&nbsp;<a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=17\">"._MSA_GENAVERAGES."</a>\n";
   echo "</td>\n";
   echo "</tr>\n";

   echo "</table>\n";
   echo "</center>\n";
   echo "</div>\n";
   CloseTable();
   echo "<br>\n";

   switch( $screen ) {
   case 1:
      MSAnalysisCountries( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
   break;
   case 2:
      MSAnalysisReferrals( $max_view, $screen, $overview, $sortby, $DateToday, $xdate  );
   break;
   case 3:
      MSAnalysisSE( $max_view, $screen, $overview, $sortby, $DateToday, $xdate  );
   break;
   case 4:
      MSAnalysisBrowsers( $max_view, $screen, $overview, $sortby, $DateToday, $xdate  );
   break;
   case 5:
      MSAnalysisOS( $max_view, $screen, $overview, $sortby, $DateToday, $xdate  );
   break;
   case 6:
      MSAnalysisModules( $max_view, $screen, $overview, $sortby, $DateToday, $xdate  );
   break;
   case 7:
      MSAnalysisUsers( $max_view, $screen, $overview, $sortby, $DateToday, $xdate  );
   break;
   case 8:
      MSAnalysisSESQ( $max_view, "8", $overview, $sortby, $DateToday, $xdate  );
   break;
   case 9:
      MSAnalysisResolutions( $max_view, $screen, $overview, $sortby, $DateToday, $xdate  );
   break;
   case 10:
      MSAnalysisCrawlers( $max_view, $screen, $overview, $sortby, $DateToday, $xdate  );
   break;
   case 11:
      MSAnalysisOverview( $max_items, $screen, $overview, $sortby, $DateToday, $xdate  );
   break;
   case 12:
      MSAnalysisVisitorGraphs( $DateToday );
   break;
   case 13:
      MSAnalysisLastPageVisits( $lastupdate, $staticupdate, $max_online );
   break;
   case 14:
      MSAnalysisNukeStats( );
   break;
   case 15:
      MSAnalysisVisitStats( );
   break;
   case 16:
      MSAnalysisThemes( );
   break;
   case 17:
      MSAnalysisAverages( );
   break;
   default:
      MSAnalysisCountries( $max_view, $screen, $overview, $sortby, $DateToday, $xdate  );
   }

   include( "footer.php" );
} // END function MSAnalysisGeneral()

/******************************************************************************/
/* FUNCTION: MSAnalysisCountries()                                            */
/* Show Detailed Overview of all Countries                                    */
/******************************************************************************/
function MSAnalysisCountries( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $counter = 0;
   $msa = new msanalysis();
   $totalhits = $msa->TotalHits( $screen, $overview, $DateToday, $xdate );
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );
   // Show detailed list of Countries
   @(include( "modules/$module_name/scripts/countries.php" ) ) OR die ("File countries.php can not be found" );
} // END function MSAnalysisCountries( )

/******************************************************************************/
/* FUNCTION: MSAnalysisReferrals()                                            */
/* Show Detailed Overview of all Referrals                                    */
/******************************************************************************/
function MSAnalysisReferrals( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $counter = 0;
   $msa = new msanalysis();
   $totalhits = $msa->TotalHits( $screen, $overview, $DateToday, $xdate );
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );

   // Show Detailed list of Referrals
   @(include( "modules/$module_name/scripts/referrals.php" ) ) OR die ("File referrals.php can not be found" );
} // END function MSAnalysisReferrals( )

/******************************************************************************/
/* FUNCTION: MSAnalysisSE()                                                   */
/* Show Detailed Overview of all Search Engines AND Queries                   */
/******************************************************************************/
function MSAnalysisSE( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $counter = 0;
   $msa = new msanalysis();
   $totalhits = $msa->TotalHits( $screen, $overview, $DateToday, $xdate );
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );
   // Show Detailed list of Search Engines
   @(include( "modules/$module_name/scripts/se.php" ) ) OR die ("File se.php can not be found" );
} // END function MSAnalysisSE( )

/******************************************************************************/
/* FUNCTION: MSAnalysisSESQ()                                                 */
/* Show Detailed Overview of all Search Engine Queries                        */
/******************************************************************************/
function MSAnalysisSESQ( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $counter = 0;
   $msa = new msanalysis();
   $totalhits = $msa->TotalHits( $screen, $overview, $DateToday, $xdate );
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );
   // Show Detailed list of Search Engine Queries
   @(include( "modules/$module_name/scripts/seq.php" ) ) OR die ("File seq.php can not be found" );
} // END function MSAnalysisSESQ( )

/******************************************************************************/
/* FUNCTION: MSAnalysisBrowsers()                                             */
/* Show Detailed Overview of all Browsers and Webcrawlers                     */
/******************************************************************************/
function MSAnalysisBrowsers( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $counter = 0;
   $msa = new msanalysis();
   $totalhits = $msa->TotalHits( $screen, $overview, $DateToday, $xdate );
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );
   // Show Detailed list of Browsers
   @(include( "modules/$module_name/scripts/browsers.php" ) ) OR die ("File browsers.php can not be found" );
} // END function MSAnalysisBrowsers( )

/******************************************************************************/
/* FUNCTION: MSAnalysisCrawlers()                                             */
/* Show Detailed Overview of all Web-Crawlers                                 */
/******************************************************************************/
function MSAnalysisCrawlers( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $counter = 0;
   $msa = new msanalysis();
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );
   // Show Detailed list of Webcrawlers
   @(include( "modules/$module_name/scripts/crawlers.php" ) ) OR die ("File crawlers.php can not be found" );
} // END function MSAnalysisCrawlers( )

/******************************************************************************/
/* FUNCTION: MSAnalysisOS()                                                   */
/* Show Detailed Overview of all OS                                           *
/******************************************************************************/
function MSAnalysisOS( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $counter = 0;
   $msa = new msanalysis();
   $totalhits = $msa->TotalHits( $screen, $overview, $DateToday, $xdate );
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );
   // Show Detailed list of Operating Systems
   @(include( "modules/$module_name/scripts/os.php" ) ) OR die ("File os.php can not be found" );
} // END function MSAnalysisOS( )

/******************************************************************************/
/* FUNCTION: MSAnalysisModules()                                              */
/* Show Detailed Overview of all Modules                                      */
/******************************************************************************/
function MSAnalysisModules( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $counter = 0;
   $msa = new msanalysis();
   $totalhits = $msa->TotalHits( $screen, $overview, $DateToday, $xdate );
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );
   // Show Detailed list of invoked Modules
   @(include( "modules/$module_name/scripts/modules.php" ) ) OR die ("File modules.php can not be found" );
} // END function MSAnalysisModules( )

/******************************************************************************/
/* FUNCTION: MSAnalysisUsers()                                                */
/* Show Detailed Overview of all Users                                        */
/******************************************************************************/
function MSAnalysisUsers( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2;

   $counter = 0;
   $msa = new msanalysis();
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );
   // Show Detailed list of Users
   @(include( "modules/$module_name/scripts/users.php" ) ) OR die ("File users.php can not be found" );
} // END function MSAnalysisUsers( )

/******************************************************************************/
/* FUNCTION: MSAnalysisResolutions()                                          */
/* Show Detailed Overview of all Screen Resolutions                           */
/******************************************************************************/
function MSAnalysisResolutions( $max_view, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $counter = 0;
   $msa = new msanalysis();
   $totalhits = $msa->TotalHits( $screen, $overview, $DateToday, $xdate );
   $totalentries = $msa->CountLines( $screen, $overview, $DateToday, $xdate );
   // Show Detailed list of Screen Resolutions
   @(include( "modules/$module_name/scripts/scr.php" ) ) OR die ("File scr.php can not be found" );
} // END function MSAnalysisResolution( )

/******************************************************************************/
/* FUNCTION: MSAnalysisOverview()                                             */
/* Show General Overview of all Statistics                                    */
/******************************************************************************/
function MSAnalysisOverview( $max_items, $screen, $overview, $sortby, $DateToday, $xdate )
{
   global $prefix, $user_prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2, $ThemeSel;

   $msa = new msanalysis();
   // Show General Overview
   @(include( "modules/$module_name/scripts/overview.php" ) ) OR die ("File overview.php can not be found" );
} // END function MSAnalysisOverview( )

/******************************************************************************/
/* FUNCTION: MSAnalysisVisitorGraphs()                                        */
/* Show Hourly/Dayly/Monthly/Yearly Page Visits graphs                        */
/******************************************************************************/
function MSAnalysisVisitorGraphs( $DateToday )
{
   // Calculate current date
   $dot = explode ("-", $DateToday );
   $nowdate = $dot[2];
   $month = $dot[1];
   $year = $dot[0];

   MSAnalysisHourlyPVStats( $DateToday, $year, $month, $nowdate );
   MSAnalysisDaylyPVStats( $DateToday, $year, $month );
   MSAnalysisMonthlyPVStats( $year );
   MSAnalysisYearlyPVStats( );
} // END function MSAnalysisVisitorGraphs( )

/******************************************************************************/
/* FUNCTION: MSAnalysisLastPageVisits()                                       */
/* Show last Page Visits of users/guests                                      */
/******************************************************************************/
function MSAnalysisLastPageVisits( $lastupdate, $staticupdate, $max_online )
{
   global $prefix, $db, $sitename, $module_name, $admin, $bgcolor1, $bgcolor2;

   $counter = 0;
   // Show last page visits
   @(include( "modules/$module_name/scripts/online.php" ) ) OR die ("File online.php can not be found" );
} // END function MSAnalysisLastPageVisits( )

/******************************************************************************/
/* FUNCTION: MSAnalysisNukeStats()                                            */
/* Show General Overview of all PHP-Nuke Releated Statistics                  */
/******************************************************************************/
function MSAnalysisNukeStats( )
{
   global $bgcolor2, $bgcolor1, $prefix, $user_prefix, $sitename, $db, $admin, $Version_Num, $module_name, $startdate;

   $msa = new msanalysis();
   // Show Nuke Stats
   @(include( "modules/$module_name/scripts/nukestats.php" ) ) OR die ("File nukestats.php can not be found" );
} // END function MSAnalysisNukeStats( )

/******************************************************************************/
/* FUNCTION: MSAnalysisVisitStats()                                            */
/* Show General Overview of all PHP-Nuke Releated Statistics                  */
/******************************************************************************/
function MSAnalysisVisitStats( )
{
   global $module_name;
   Header( "Location: modules.php?name=$module_name&file=scripts&targetscript=visits&amp;op=MSAnalysisStats" );
} // END function MSAnalysisVisitStats( )

/******************************************************************************/
/* FUNCTION: MSAnalysisThemes()                                               */
/* Show General Overview of all Themes used by users                          */
/******************************************************************************/
function MSAnalysisThemes( )
{
   global $prefix, $user_prefix, $db, $module_name, $admin, $bgcolor1, $bgcolor2;

   // Show General Overview
   $counter = 0;
   @(include( "modules/$module_name/scripts/themes.php" ) ) OR die ("File themes.php can not be found" );
} // END function function MSAnalysisThemes( )

/******************************************************************************/
/* FUNCTION: MSAnalysisAverages()                                             */
/* Show Average Overview of hits per day/week/year etc                        */
/******************************************************************************/
function MSAnalysisAverages( )
{
   global $prefix, $db, $module_name, $bgcolor1, $bgcolor2;

   @(include( "modules/$module_name/scripts/averages.php" ) ) OR die ("File averages.php can not be found" );
} // END function function MSAnalysisAverages( )

/******************************************************************************/
/* FUNCTION: MSAnalysisCountriesDel()                                         */
/* Delete selected item from Country Table                                    */
/******************************************************************************/
function MSAnalysisCountriesDel( $id, $screen, $overview, $sortby )
{
   global $prefix, $db;

   $id = intval( $id );
   if( $overview == 1) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_countries set hitstoday='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   elseif( $overview == 2) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_countries set hitsxdays='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   else {
      $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_countries WHERE id='$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   MSAnalysisGeneral( $screen, $overview, $sortby );
}
/******************************************************************************/
/* FUNCTION: MSAnalysisReferralsDel()                                         */
/* Delete selected item from Referrals Table                                  */
/******************************************************************************/
function MSAnalysisReferralsDel( $id, $screen, $overview, $sortby )
{
   global $prefix, $db;

   $id = intval( $id );
   if( $overview == 1) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_referrals set hitstoday='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   elseif( $overview == 2) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_referrals set hitsxdays='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   else {
      $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_referrals WHERE id='$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   MSAnalysisGeneral( $screen, $overview, $sortby );
}
/******************************************************************************/
/* FUNCTION: MSAnalysisSEDel()                                                */
/* Delete selected item from Referrals Table !!!!!!!                          */
/******************************************************************************/
function MSAnalysisSEDel( $id, $screen, $overview, $sortby )
{
   global $prefix, $db;

   $id = intval( $id );
   if( $overview == 1) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_referrals set hitstoday='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   elseif( $overview == 2) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_referrals set hitsxdays='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   else {
      $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_referrals WHERE id='$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   MSAnalysisGeneral( $screen, $overview, $sortby );
}
/******************************************************************************/
/* FUNCTION: MSAnalysisSESQDel()                                              */
/* Delete selected item from Search Table                                     */
/******************************************************************************/
function MSAnalysisSESQDel( $id, $screen, $overview, $sortby )
{
   global $prefix, $db;

   $id = intval( $id );
   if( $overview == 1) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_search set hitstoday='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   elseif( $overview == 2) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_search set hitsxdays='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   else {
      $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_search WHERE id='$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   MSAnalysisGeneral( $screen, $overview, $sortby );
}
/******************************************************************************/
/* FUNCTION: MSAnalysisBrowsersDel()                                          */
/* Delete selected item from Browsers Table                                   */
/******************************************************************************/
function MSAnalysisBrowsersDel( $id, $screen, $overview, $sortby )
{
   global $prefix, $db;

   $id = intval( $id );
   if( $overview == 1) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_browsers set hitstoday='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   elseif( $overview == 2) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_browsers set hitsxdays='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   else {
      $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_browsers WHERE id='$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   MSAnalysisGeneral( $screen, $overview, $sortby );
}
/******************************************************************************/
/* FUNCTION: MSAnalysisOSDel()                                                */
/* Delete selected item from OS Table                                         */
/******************************************************************************/
function MSAnalysisOSDel( $id, $screen, $overview, $sortby )
{
   global $prefix, $db;

   $id = intval( $id );
   if( $overview == 1) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_os set hitstoday='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   elseif( $overview == 2) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_os set hitsxdays='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   else {
      $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_os WHERE id='$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   MSAnalysisGeneral( $screen, $overview, $sortby );
}
/******************************************************************************/
/* FUNCTION: MSAnalysisModulesDel()                                           */
/* Delete selected item from Modules Table                                    */
/******************************************************************************/
function MSAnalysisModulesDel( $id, $screen, $overview, $sortby )
{
   global $prefix, $db;

   $id = intval( $id );
   if( $overview == 1) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_modules set hitstoday='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   elseif( $overview == 2) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_modules set hitsxdays='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   else {
      $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_modules WHERE id='$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   MSAnalysisGeneral( $screen, $overview, $sortby );
}
/******************************************************************************/
/* FUNCTION: MSAnalysisUsersDel()                                             */
/* Delete selected item from Users Table                                      */
/******************************************************************************/
function MSAnalysisUsersDel( $uid, $screen, $overview, $sortby )
{
   global $prefix, $db;

   $uid = intval( $uid );
   if( $overview == 1) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_users set hitstoday='0' WHERE uid = '$uid'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   elseif( $overview == 2) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_users set hitsxdays='0' WHERE uid = '$uid'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   else {
      $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_users WHERE uid='$uid'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   MSAnalysisGeneral( $screen, $overview, $sortby );
}
/******************************************************************************/
/* FUNCTION: MSAnalysisResolutionsDel()                                       */
/* Delete selected Resolution from Resolution Table                           */
/******************************************************************************/
function MSAnalysisResolutionsDel( $id, $screen, $overview, $sortby )
{
   global $prefix, $db;

   $id = intval( $id );
   if( $overview == 1) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_scr set hitstoday='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   elseif( $overview == 2) {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_scr set hitsxdays='0' WHERE id = '$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   else {
      $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_scr WHERE id='$id'" );
      if ( !$result ) { echo "<center><b>"._MSA_DELETERROR."<b></center>\n"; }
   }
   MSAnalysisGeneral( $screen, $overview, $sortby );
}

/******************************************************************************/
/* FUNCTION: MSAnalysis7DaysStats                                             */
/* Display Page Hits of last 7en days                                         */
/******************************************************************************/
function MSAnalysis7DaysStats( $year, $month, $nowdate )
{
    global $prefix, $bgcolor1, $bgcolor2, $db, $ThemeSel, $module_name;

    $msa = new msanalysis();
    // Current Month
    $resulttotal = $db->sql_query( "select max(hits) as TotalHitsDate from ".$prefix."_stats_date where year='$year' and month='$month'" );
    list( $TotalHitsDate ) = $db->sql_fetchrow( $resulttotal );
    $db->sql_freeresult( $resulttotal );

    // When less then 7 days in month, also calculate the rest of the previous month
    if( $nowdate <= 7 ) {
	   if( $month > 1 ) { $prevmonth = $month - 1; $prevyear = $year; }
	   else { $prevmonth = 12; $prevyear = $year - 1; }

	   $resulttotal1 = $db->sql_query( "select max(hits) as TotalHitsDate1 from ".$prefix."_stats_date where year='$prevyear' and month='$prevmonth'" );
       list( $TotalHitsDate1 ) = $db->sql_fetchrow( $resulttotal1 );
       $db->sql_freeresult( $resulttotal1 );
       if( $TotalHitsDate1 > $TotalHitsDate ) $TotalHitsDate = $TotalHitsDate1;
    }

    // Current Month
    $result = $db->sql_query( "select year,month,date,hits from ".$prefix."_stats_date where year='$year' and month='$month' order by date" );
    // Previous Month
    if( $nowdate <= 7 ) {
       $totrows = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_stats_date where year='$prevyear' and month='$prevmonth' order by date" ) );
       $startrow = $totrows - 7 + $nowdate;
       $result1 = $db->sql_query( "select year,month,date,hits from ".$prefix."_stats_date where year='$prevyear' and month='$prevmonth' order by date LIMIT $startrow,$totrows" );
    }

    echo "<br><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"80%\" bgcolor=\"$bgcolor1\">\n";
    echo "<tr><td width=\"10%\" bgcolor=\"$bgcolor2\"><p align=\"center\">"._MSA_DATE."</td><td bgcolor=\"$bgcolor2\"><p align=\"center\">"._MSA_GPAGESVIEWS."</td><td bgcolor=\"$bgcolor2\"><p align=\"center\">"._MSA_HITS."</td></tr>\n";

    // Previous Month
    if( $nowdate <= 7 ) {
       while( list( $year, $month, $date, $hits) = $db->sql_fetchrow( $result1 ) ) {
          echo "<tr bgcolor=\"$bgcolor1\" height=\"22\"><td>\n";
          echo "<a href=\"modules.php?name=$module_name&file=scripts&targetscript=visits&op=MSAnalysisDailyStats&year=$year&month=$month&date=$date\" class=\"hover_orange\">\n";
          if( $date == $nowdate ) { echo "<font color=\"#FF0000\">$date</font>"; } else { echo $date; }
          echo "</a></td><td nowrap>\n";
          if ($hits == 0) {
             $WidthIMG = 0;
          }
          else {
	         $WidthIMG = round( ( round(100 * $hits/$TotalHitsDate,0) ) * 1 );
	      }
          echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" Alt=\"\" width=\"".$msa->l_size[0]."\" height=\"".$msa->l_size[1]."\"><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"".$msa->m_size[1]."\" width=".$WidthIMG." Alt=\"\">"
          ."<img src=\"themes/$ThemeSel/images/rightbar.gif\" Alt=\"\" width=\"".$msa->r_size[0]."\" height=\"".$msa->r_size[1]."\"></td><td><b>$hits</b></td></tr>"
          ."</td></tr>";
       }
       $db->sql_freeresult( $result1 );
    }
    // Current Month
    while( list( $year,$month,$date,$hits ) = $db->sql_fetchrow( $result ) ) {
       if( ( $date <= $nowdate ) AND ( $date > $nowdate - 7 ) ) {
          echo "<tr bgcolor=\"$bgcolor1\" height=\"22\"><td>\n";
          echo "<a href=\"modules.php?name=$module_name&file=scripts&targetscript=visits&op=MSAnalysisDailyStats&year=$year&month=$month&date=$date\" class=\"hover_orange\">\n";
          if( $date == $nowdate ) { echo "<font color=\"#FF0000\">$date</font>"; } else { echo $date; }
          echo "</a></td><td nowrap>\n";
          if ($hits == 0) {
             $WidthIMG = 0;
          }
          else {
	         $WidthIMG = round( ( round(100 * $hits/$TotalHitsDate,0) ) * 1 );
	      }
          echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" Alt=\"\" width=\"".$msa->l_size[0]."\" height=\"".$msa->l_size[1]."\"><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"".$msa->m_size[1]."\" width=".$WidthIMG." Alt=\"\">"
          ."<img src=\"themes/$ThemeSel/images/rightbar.gif\" Alt=\"\" width=\"".$msa->r_size[0]."\" height=\"".$msa->r_size[1]."\"></td><td><b>$hits</b></td></tr>"
          ."</td></tr>";
       }
    }
    $db->sql_freeresult( $result );
    echo "</table>";
} // End function MSAnalysis7DaysStats()

/******************************************************************************/
/* FUNCTION: MSAnalysisHourlyPVStats                                          */
/* Display Page Hits for each hour for current date                           */
/******************************************************************************/
function MSAnalysisHourlyPVStats( $DateToday, $year, $month, $nowdate )
{
   global $prefix, $db, $module_name;

   // Calculate Page Visits for Today
   $visitstoday = 0;
   for( $i = 0; $i <= 23; $i++ ) {
      $result = $db->sql_query( "select hits from ".$prefix."_stats_hour where year='$year' and month='$month' and date='$nowdate' and hour='$i'" );
      list( $hits ) = $db->sql_fetchrow( $result );
      $visitstoday += $hits;
   }
   $db->sql_freeresult( $result );

   $highest = 0;
   $result = $db->sql_query( "select max(hits) as highest from ".$prefix."_stats_hour where year='$year' and month='$month' and date='$nowdate'" );
   list( $highest ) = $db->sql_fetchrow( $result );
   $db->sql_freeresult( $result );

   echo "<br>\n"; OpenTable();
   echo "<div align=\"center\"><b><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisStats\">"._MSA_VISITSHOURS." $DateToday ($visitstoday "._MSA_SOFAR.")</b></div><br><table border=\"0\" cellPadding=\"2\" cellSpacing=\"0\" width=\"90%\" align=\"center\"></a><tr><td></td>\n";
   for( $i = 0; $i <= 23; $i++ ) {
      $result = $db->sql_query( "select hits from ".$prefix."_stats_hour where year='$year' and month='$month' and date='$nowdate' and hour='$i'" );
      list( $hits ) = $db->sql_fetchrow( $result );
      $db->sql_freeresult( $result );
      echo "<td align=\"center\" valign=\"bottom\">";
      if( $highest != 0 ) { $sheight =( $hits/ $highest) * 120; }
      echo " <img src=\"modules/$module_name/images/vstat.gif\" height=\"$sheight\" width=\"16\" alt=\"".$hits.""._MSA_PAGESVIEWED."\" title=\"".$hits.""._MSA_PAGESVIEWED."\"></td>";
   }
   echo "</tr><tr><td><b>"._MSA_HOURS."</b></td>\n";
   for( $i = 0; $i < 24; $i++ ) { if( strlen( $i ) == 1 ) echo "<td align=\"center\">0".$i."</td>\n"; else echo "<td align=\"center\">".$i."</td>\n"; }
   echo "</tr></table>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisDaylyPVStats                                           */
/* Display Page Hits for each day for current month                           */
/******************************************************************************/
function MSAnalysisDaylyPVStats( $DateToday, $year, $month )
{
   global $prefix, $db, $module_name;

   $msa = new msanalysis();
   // Calculate total Page Visits for Current Month
   $visitsthismonth = 0;
   $result = $db->sql_query( "select sum(hits) as visitsthismonth from ".$prefix."_stats_hour where year='$year' and month='$month'" );
   list( $visitsthismonth ) = $db->sql_fetchrow( $result );
   $db->sql_freeresult( $result );

   // Calculate highest PV for a specific month
   $highest = 0;
   $result = $db->sql_query( "select max(hits) as highest from ".$prefix."_stats_date where year='$year' and month='$month'" );
   list( $highest ) = $db->sql_fetchrow( $result );
   $db->sql_freeresult( $result );

   // How many days has current month ?
   $daysthismonth = 0;
   $result = $db->sql_query( "select max(date) as daysthismonth from ".$prefix."_stats_date where year='$year' and month='$month'" );
   list( $daysthismonth ) = $db->sql_fetchrow( $result );
   $db->sql_freeresult( $result );

   echo "<br>\n"; OpenTable();
   echo "<div align=\"center\"><b><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisStats\">"._MSA_VISITSDAYS." for month: ".$msa->GetMonth( $month )." ($visitsthismonth "._MSA_SOFAR.")</b></div><br><table border=\"0\" cellPadding=\"2\" cellSpacing=\"0\" width=\"90%\" align=\"center\"></a><tr><td></td>\n";
   for( $i = 1; $i <= $daysthismonth; $i++ ) {
      $result = $db->sql_query( "select hits from ".$prefix."_stats_date where year='$year' and month='$month' and date='$i'" );
      list( $hits ) = $db->sql_fetchrow( $result );
      $db->sql_freeresult( $result );
      echo "<td align=\"center\" valign=\"bottom\">";
      if( $highest != 0 ) { $sheight =( $hits / $highest) * 120; }
      echo " <img src=\"modules/$module_name/images/vstat.gif\" height=\"$sheight\" width=\"16\" alt=\"".$hits.""._MSA_PAGESVIEWED."\" title=\"".$hits.""._MSA_PAGESVIEWED."\"></td>";
   }
   echo "</tr><tr><td><b>"._MSA_DAYS."</b></td>\n";
   for( $i = 1; $i <= $daysthismonth; $i++ ) { if( strlen( $i ) == 1 ) echo "<td align=\"center\">0".$i."</td>\n"; else echo "<td align=\"center\">".$i."</td>\n"; }
   echo "</tr></table>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisMonthlyPVStats                                         */
/* Display Page Hits for each month for current year                          */
/******************************************************************************/
function MSAnalysisMonthlyPVStats( $year )
{
   global $prefix, $db, $module_name;

   $highest = 0;
   $result = $db->sql_query( "select max(hits) as highest from ".$prefix."_stats_month where year='$year'" );
   list( $highest ) = $db->sql_fetchrow( $result );
   $db->sql_freeresult( $result );

   echo "<br>\n"; OpenTable();
   echo "<div align=\"center\"><b>"._MSA_VISITSMONTHS." $year</b></div><br><table border=\"0\" cellPadding=\"2\" cellSpacing=\"0\" width=\"90%\" align=\"center\"><tr><td></td>\n";
   for( $i = 1; $i <= 12; $i++ ) {
      $result = $db->sql_query( "select hits from ".$prefix."_stats_month where year='$year' and month='$i'" );
      list( $hits ) = $db->sql_fetchrow( $result );
      $db->sql_freeresult( $result );
      echo "<td align=\"center\" valign=\"bottom\">";
      if( $highest != 0 ) { $sheight =( $hits/ $highest) * 120; }
      echo " <img src=\"modules/$module_name/images/vstat.gif\" height=\"$sheight\" width=\"32\" alt=\"".$hits.""._MSA_PAGESVIEWED."\" title=\"".$hits.""._MSA_PAGESVIEWED."\"></td>";
   }
   echo "</tr><tr><td><b>"._MSA_MONTHS."</b></td>\n";
   for( $i = 1; $i <= 12; $i++ ) { if( strlen( $i ) == 1 ) echo "<td align=\"center\">0".$i."</td>\n"; else echo "<td align=\"center\">".$i."</td>\n"; }
   echo "</tr></table>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisYearlyPVStats                                          */
/* Display Page Hits for each present year                                    */
/******************************************************************************/
function MSAnalysisYearlyPVStats( )
{
   global $prefix, $db, $module_name;

   $highest = 0;
   $result = $db->sql_query( "select max(hits) as highest from ".$prefix."_stats_year" );
   list( $highest ) = $db->sql_fetchrow( $result );
   $db->sql_freeresult( $result );

   echo "<br>\n"; OpenTable();
   echo "<div align=\"center\"><b>"._MSA_VISITSYEARS."</b></div><br><table border=\"0\" cellPadding=\"2\" cellSpacing=\"0\" width=\"90%\" align=\"center\"><tr><td></td>\n";
   for( $i = 2000; $i <= 2011; $i++ ) {
      $result = $db->sql_query( "select hits from ".$prefix."_stats_year where year='$i'" );
      list( $hits ) = $db->sql_fetchrow( $result );
      $db->sql_freeresult( $result );
      echo "<td align=\"center\" valign=\"bottom\">";
      if( $highest != 0 ) { $sheight =( $hits/ $highest) * 120; }
      echo " <img src=\"modules/$module_name/images/vstat.gif\" height=\"$sheight\" width=\"32\" alt=\"".$hits.""._MSA_PAGESVIEWED."\" title=\"".$hits.""._MSA_PAGESVIEWED."\"></td>";
   }
   echo "</tr><tr><td><b>"._MSA_YEARS."</b></td>\n";
   for( $i = 2000; $i <= 2011; $i++ ) { if( strlen( $i ) == 1 ) echo "<td align=\"center\">0".$i."</td>\n"; else echo "<td align=\"center\">".$i."</td>\n"; }
   echo "</tr></table>\n";
   CloseTable();
}

/***************************************************/
/****************** PROGRAM START ******************/
/***************************************************/
switch ( $op )
{
    case "MSAnalysisGeneral":
       MSAnalysisGeneral( $screen, $overview, $sortby );
    break;

    case "MSAnalysisCountries":
       MSAnalysisCountries( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisReferrals":
       MSAnalysisReferrals( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisSE":
       MSAnalysisSE( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisSESQ":
       MSAnalysisSESQ( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisBrowsers":
       MSAnalysisBrowsers( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisCrawlers":
       MSAnalysisCrawlers( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisOS":
       MSAnalysisOS( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisModules":
       MSAnalysisModules( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisUsers":
       MSAnalysisUsers( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisResolutions":
       MSAnalysisResolutions( $max_view, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisOverview":
       MSAnalysisOverview( $max_items, $screen, $overview, $sortby, $DateToday, $xdate );
    break;

    case "MSAnalysisVisitorGraphs":
       MSAnalysisVisitorGraphs( $DateToday );
    break;

    case "MSAnalysisLastPageVisits":
       MSAnalysisLastPageVisits( $lastupdate, $staticupdate, $max_online );
    break;

    case "MSAnalysisNukeStats":
       MSAnalysisNukeStats( );
    break;

    case "MSAnalysisVisitStats":
       MSAnalysisVisitStats( );
    break;

    case "MSAnalysisThemes":
       MSAnalysisThemes( );
    break;

    case "MSAnalysisAverages":
       MSAnalysisAverages( );
    break;

    case "MSAnalysisCountriesDel":
       MSAnalysisCountriesDel( $id, $screen, $overview, $sortby );
    break;

    case "MSAnalysisReferralsDel":
       MSAnalysisReferralsDel( $id, $screen, $overview, $sortby );
    break;

    case "MSAnalysisSEDel":
       MSAnalysisSEDel( $id, $screen, $overview, $sortby );
    break;

    case "MSAnalysisSESQDel":
       MSAnalysisSESQDel( $id, $screen, $overview, $sortby );
    break;

    case "MSAnalysisBrowsersDel":
       MSAnalysisBrowsersDel( $id, $screen, $overview, $sortby );
    break;

    case "MSAnalysisOSDel":
       MSAnalysisOSDel( $id, $screen, $overview, $sortby );
    break;

    case "MSAnalysisModulesDel":
       MSAnalysisModulesDel( $id, $screen, $overview, $sortby );
    break;

    case "MSAnalysisUsersDel":
       MSAnalysisUsersDel( $uid, $screen, $overview, $sortby );
    break;

    case "MSAnalysisResolutionsDel":
       MSAnalysisResolutionsDel( $id, $screen, $overview, $sortby );
    break;

    case "MSAnalysis7DaysStats":
       MSAnalysis7DaysStats( $year, $month, $nowdate );
    break;

    case "MSAnalysisHourlyPVStats":
       MSAnalysisHourlyPVStats( $DateToday, $year, $month, $nowdate );
    break;

    case "MSAnalysisDaylyPVStats":
       MSAnalysisDaylyPVStats( $DateToday, $year, $month );
    break;

    case "MSAnalysisMonthlyPVStats":
       MSAnalysisMonthlyPVStats( $year );
    break;

    case "MSAnalysisYearlyPVStats":
       MSAnalysisYearlyPVStats( );
    break;

    default:
       MSAnalysisGeneral( $screen, $overview, $sortby );
}


?>

