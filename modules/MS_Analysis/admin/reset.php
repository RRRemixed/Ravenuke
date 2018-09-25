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
$module_name = explode( "admin", dirname( __FILE__ ) );
$module_name = basename( $module_name[0] );

if( !stristr( $_SERVER['SCRIPT_NAME'], "modules.php" ) ) {
   die( "You can't access this file directly..." );
}

require_once( "mainfile.php" );
@(require_once( "modules/$module_name/include/class.general.php" )) OR die ("File class.general.php can not be found" );
get_lang( $module_name );

/******************************************************************************/
/* FUNCTION: Start                                                            */
/******************************************************************************/
function MSAstatsreset( $func )
{
   global $module_name;

   include( "header.php" );
   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   if( isset( $func ) ) { $func = intval( $func ); }
   if( $msaadmin->check_permission() == 1 ) {
      $msaadmin->admin_menu();
      if( $func == 0 ) MSAnalysisStatsReset();
      elseif( $func == 1 ) MSAnalysisStatsResetToday();
      elseif( $func == 2 ) MSAnalysisStatsResetLastXDays();
      elseif( $func == 3 ) MSAnalysisStatsResetAll();
   } else { echo "Access Denied\n"; }
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisResetTableAllNow()                                     */
/* Clear a selected Table                                                     */
/******************************************************************************/
function MSAnalysisResetAll()
{
   global $prefix, $db;

   $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_online" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_online" );

   $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_search" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_search" );

   $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_browsers" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_browsers" );

   $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_referrals" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_referrals" );

   $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_countries" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_countries" );

   $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_os" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_os" );

   $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_modules" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_modules" );

   $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_users" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_users" );

   $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_scr" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_scr" );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisStatsReset();                                          */
/******************************************************************************/
function MSAnalysisStatsReset()
{
   global $db, $prefix, $module_name, $bgcolor1, $bgcolor2;

   echo "<br>\n";
   OpenTable();
   echo "<div align=\"center\"><center>\n";
   echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" height=\"25\" width=\"90%\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" bgcolor=\"$bgcolor1\">\n";
   echo "<tr>\n";
   echo "<td width=\"100%\" colspan=\"2\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"></a><b>" . _MSA_STATSRESET . "</b></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"50%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=reset&amp;op=MSAstatsreset&amp;func=1\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_OVERVIEWTODAY."</a></td>\n";
   echo "<td width=\"50%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=reset&amp;op=MSAstatsreset&amp;func=2\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_OVERVIEWLASTDAYS1." X "._MSA_OVERVIEWLASTDAYS2."</a></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"100%\" height=\"25\" colspan=\"2\" align=\"center\" bgcolor=\"$bgcolor1\"><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=reset&amp;op=MSAstatsreset&amp;func=3\"><img src=\"modules/$module_name/images/tablemain.gif\" border=\"0\" align=\"bottom\">&nbsp;<img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_OVERVIEWALL."</a></td>\n";
   echo "</tr>\n";
   echo "</table></center></div>\n";
   echo "<br>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisStatsResetToday                                        */
/* Reset the Statistics of 'Today'                                            */
/******************************************************************************/
function MSAnalysisStatsResetToday()
{
   global $module_name;

   echo "<br>\n";
   OpenTable();
   echo "<center><b>"._MSA_RESETTODAY."</b></center><br>\n";
   echo "<center>[ <a href=\"modules.php?name=$module_name&file=scripts&targetscript=reset&amp;op=MSAnalysisStatsResetTodayNow\">"._MSA_YES."</a> ]&nbsp;&nbsp;<b>÷</b>&nbsp;&nbsp;[ <a href=\"modules.php?name=$module_name&file=scripts&targetscript=reset&amp;op=MSAstatsreset&amp;func=0\">"._MSA_NO."</a> ]</center>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisStatsResetTodayNow                                     */
/* Reset the Statistics of 'Today'                                            */
/******************************************************************************/
function MSAnalysisStatsResetTodayNow()
{
   $msa = new msanalysis();
   $msa->ResetTodayHits();
   MSAstatsreset( 0 );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisStatsResetLastXDays                                    */
/* Reset the Statistics of 'the last X days'                                  */
/******************************************************************************/
function MSAnalysisStatsResetLastXDays()
{
   global $module_name;

   echo "<br>\n";
   OpenTable();
   echo "<center><b>"._MSA_RESETLASTXDATE."</b></center><br>\n";
   echo "<center>[ <a href=\"modules.php?name=$module_name&file=scripts&targetscript=reset&amp;op=MSAnalysisStatsResetLastXDaysNow\">"._MSA_YES."</a> ]&nbsp;&nbsp;<b>÷</b>&nbsp;&nbsp;[ <a href=\"modules.php?name=$module_name&file=scripts&targetscript=reset&amp;op=MSAstatsreset&amp;func=0\">"._MSA_NO."</a> ]</center>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisStatsResetLastXDaysNow                                 */
/* Reset the Statistis of 'the last X days'                                   */
/******************************************************************************/
function MSAnalysisStatsResetLastXDaysNow()
{
   global $prefix, $db;

   $msa = new msanalysis();
   $newxdate = $msa->MSLogDate( 1 );

   // Reset xdays + hitsxdays
   $db->sql_query( "update ".$prefix."_msanalysis_countries set xdays='$newxdate', hitsxdays=0" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_countries" );

   $db->sql_query( "update ".$prefix."_msanalysis_referrals set xdays='$newxdate', hitsxdays=0" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_referrals" );

   $db->sql_query( "update ".$prefix."_msanalysis_search set xdays='$newxdate', hitsxdays=0" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_search" );

   $db->sql_query( "update ".$prefix."_msanalysis_browsers set xdays='$newxdate', hitsxdays=0" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_browsers" );

   $db->sql_query( "update ".$prefix."_msanalysis_os set xdays='$newxdate', hitsxdays=0" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_os" );

   $db->sql_query( "update ".$prefix."_msanalysis_modules set xdays='$newxdate', hitsxdays=0" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_modules" );

   $db->sql_query( "update ".$prefix."_msanalysis_users set xdays='$newxdate', hitsxdays=0" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_users" );

   $db->sql_query( "update ".$prefix."_msanalysis_scr set xdays='$newxdate', hitsxdays=0" );
   $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_scr" );

   // Update Admin xdate date
   $db->sql_query("UPDATE ".$prefix."_msanalysis_admin SET xdate='$newxdate' where id='1'" );
   MSAstatsreset( 0 );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisStatsResetAll                                          */
/* Reset ALL statistics                                                       */
/******************************************************************************/
function MSAnalysisStatsResetAll()
{
   global $module_name;

   echo "<br>\n";
   OpenTable();
   echo "<center><b>"._MSA_RESETALL."</b></center><br>\n";
   echo "<center>[ <a href=\"modules.php?name=$module_name&file=scripts&targetscript=reset&amp;op=MSAnalysisStatsResetAllNow\">"._MSA_YES."</a> ]&nbsp;&nbsp;<b>÷</b>&nbsp;&nbsp;[ <a href=\"modules.php?name=$module_name&file=scripts&targetscript=reset&amp;op=MSAstatsreset&amp;func=0\">"._MSA_NO."</a> ]</center>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisStatsResetAllNow                                       */
/* Reset ALL Statistics                                                       */
/******************************************************************************/
function MSAnalysisStatsResetAllNow()
{
   MSAnalysisResetAll();
   MSAstatsreset( 0 );
}



/***************************************************/
/****************** PROGRAM START ******************/
/***************************************************/
switch ( $op )
{
   case "MSAstatsreset":
      MSAstatsreset( $func );
   break;

   case "MSAnalysisResetALL":
      MSAnalysisResetALL();
   break;

    case "MSAnalysisStatsReset":
       MSAnalysisStatsReset();
    break;

    case "MSAnalysisStatsResetToday":
       MSAnalysisStatsResetToday();
    break;

    case "MSAnalysisStatsResetTodayNow":
       MSAnalysisStatsResetTodayNow();
    break;

    case "MSAnalysisStatsResetLastXDays":
       MSAnalysisStatsResetLastXDays();
    break;

    case "MSAnalysisStatsResetLastXDaysNow":
       MSAnalysisStatsResetLastXDaysNow();
    break;

    case "MSAnalysisStatsResetAll":
       MSAnalysisStatsResetAll( $which_function );
    break;

    case "MSAnalysisStatsResetAllNow":
       MSAnalysisStatsResetAllNow( $which_function );
    break;
}

?>