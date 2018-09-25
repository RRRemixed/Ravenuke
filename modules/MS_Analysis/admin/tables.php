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
function MSAtablemain( $table, $sort_on, $sort_dir )
{
   global $module_name;

   include( "header.php" );
   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   if( $msaadmin->check_permission() == 1 ) {
      $msaadmin->admin_menu();
      // Show Table ScrollBox
      MSAnalysisDispOptions( $table, $sort_on, $sort_dir );
      // Show contents selected table
      MSAnalysisShowTable( $table, $sort_on, $sort_dir );
   } else { echo "Access Denied\n"; }
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisDispOptions();                                         */
/******************************************************************************/
function MSAnalysisDispOptions( $table, $sort_on, $sort_dir )
{
   global $module_name, $bgcolor1, $bgcolor2;
   echo "<br>\n";

   OpenTable();
   echo "<div align=\"center\"><center><table border=\"0\" cellpadding=\"2\" width=\"80%\" cellspacing=\"0\">\n";
   echo "<tr>\n";
   echo "<td width=\"30%\" align=\"right\">\n";

   echo "<form enctype=\"multipart/form-data\" method=\"post\" action=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAtablemain&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\">";
   echo "<center><b>"._MSA_TABLEMAIN."</b><br><select name=\"table\" size=\"4\" onChange=\"submit()\">";
   echo "<option>"._MSA_GENCOUNTRIES."</option>\n";
   echo "<option>"._MSA_GENREFERRALS."</option>\n";
   echo "<option>"._MSA_GENSENGINES."</option>\n";
   echo "<option>"._MSA_GENQUERIES."</option>\n";
   echo "<option>"._MSA_GENBROWSERS."</option>\n";
   echo "<option>"._MSA_GENOTHERBROWSERS."</option>\n";
   echo "<option>"._MSA_GENOS."</option>\n";
   echo "<option>"._MSA_GENMODULES."</option>\n";
   echo "<option>"._MSA_GENUSERS."</option>\n";
   echo "<option>"._MSA_GENRESOLUTION."</option>\n";
   echo "</select></center></form></center></td>\n";

   echo "<td width=\"70%\" align=\"left\">\n";

   // Display sort options
   echo "<center>"._MSA_SORTON."&nbsp;<b>[</b>&nbsp;
        <a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAtablemain&amp;table=$table&amp;sort_on=1&amp;sort_dir=$sort_dir\">"._MSA_SORTONID."</a>&nbsp;&nbsp;<b>÷</b>&nbsp;&nbsp;
        <a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAtablemain&amp;table=$table&amp;sort_on=2&amp;sort_dir=$sort_dir\">"._MSA_SORTONHITS."</a>";
   if( $table == _MSA_GENUSERS ) { echo "&nbsp;&nbsp;<b>÷</b>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAtablemain&amp;table=$table&amp;sort_on=3&amp;sort_dir=$sort_dir\">"._MSA_SORTONTIME."</a>"; }
   echo "&nbsp;&nbsp;<b>|</b>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAtablemain&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=1\">"._MSA_SORTDIRASC."</a>&nbsp;&nbsp;<b>÷</b>&nbsp;&nbsp;
        <a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAtablemain&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=2\">"._MSA_SORTDIRDESC."</a>
        &nbsp;<b>]</b></center>\n";

   echo "</td></tr></table></center></div>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisShowTable();                                           */
/******************************************************************************/
function MSAnalysisShowTable( $table, $sort_on, $sort_dir )
{
   global $db, $prefix, $module_name, $bgcolor1, $bgcolor2;
   $msa = new msanalysis();

   echo "<br>"; OpenTable();
   // Get the maximum amount of lines that should be displayed
   $result = $db->sql_query( "select max_browse from ".$prefix."_msanalysis_admin where id='1'" );
   list( $max_browse ) = $db->sql_fetchrow( $result );
   $i = 1;

   if( $sort_on == 1 ) {
	  if( $table == _MSA_GENUSERS ) { $sid = "uid"; } else { $sid = "id"; }
      if( $sort_dir == 1 ) { $squery = " order by $sid ASC LIMIT 0, $max_browse"; $sort_string = ""._MSA_SORTONID." - " . _MSA_SORTDIRASC.""; }
      else { $squery = " order by $sid DESC LIMIT 0, $max_browse"; $sort_string = ""._MSA_SORTONID." - " . _MSA_SORTDIRDESC.""; }
   }
   else if( $sort_on == 2 ) {
      if( $sort_dir == 1 ) { $squery = " order by hits ASC LIMIT 0, $max_browse"; $sort_string = ""._MSA_SORTONHITS." - " . _MSA_SORTDIRASC.""; }
      else { $squery = " order by hits DESC LIMIT 0, $max_browse"; $sort_string = ""._MSA_SORTONHITS." - " . _MSA_SORTDIRDESC.""; }
   }
   else {  // Time sort on table _MSA_GENUSERS
      if( $table == _MSA_GENUSERS ) {
         if( $sort_dir == 1 ) { $squery = " order by time ASC LIMIT 0, $max_browse"; $sort_string = ""._MSA_SORTONTIME." - " . _MSA_SORTDIRASC.""; }
         else { $squery = " order by time DESC LIMIT 0, $max_browse"; $sort_string = ""._MSA_SORTONTIME." - " . _MSA_SORTDIRDESC.""; }
      }
      else { MSAnalysisShowTable( $table, 1, $sort_dir ); }
   }
   echo "<h4 align=center><b>$table -"._MSA_TABLEMAIN." </b></h4>\n";
   echo "<center>["._MSA_SORTON." <b>$sort_string]</b></center>\n";
   if( $table == _MSA_GENCOUNTRIES )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=1&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Id</b></td><td><b>Domain</b></td><td><b>Description</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select id, domain, description, hits from ".$prefix."_msanalysis_countries".$squery );
      while( list( $id, $domain, $description, $hits ) = $db->sql_fetchrow( $result ) ) {
         echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$id&amp;screen=1&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$id</td><td bgcolor=\"$bgcolor1\">$domain</td><td bgcolor=\"$bgcolor1\">$description</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
         $i++;
      }
	  echo "</table></center>\n";
   }
   else if( $table == _MSA_GENREFERRALS )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=2&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Id</b></td><td><b>Referral</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select id, referral, hits from ".$prefix."_msanalysis_referrals".$squery );
      while( list( $id, $referral, $hits ) = $db->sql_fetchrow( $result ) ) {
         if( $msa->IsSearchEngine( $referral ) == 0 ) {
            echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$id&amp;screen=2&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$id</td><td bgcolor=\"$bgcolor1\">$referral</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
            $i++;
         }
      }
	  echo "</table></center>\n";
   }
   else if( $table == _MSA_GENSENGINES )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=3&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Id</b></td><td><b>Referral</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select id, referral, hits from ".$prefix."_msanalysis_referrals".$squery );
      while( list( $id, $referral, $hits ) = $db->sql_fetchrow( $result ) ) {
         if( $msa->IsSearchEngine( $referral ) == 1 ) {
            echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$id&amp;screen=3&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$id</td><td bgcolor=\"$bgcolor1\">$referral</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
            $i++;
         }
      }
	  echo "</table></center>\n";
   }
   else if( $table == _MSA_GENQUERIES )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=4&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Id</b></td><td><b>Word</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select id, words, hits from ".$prefix."_msanalysis_search".$squery );
      while( list( $id, $words, $hits ) = $db->sql_fetchrow( $result ) ) {
         echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$id&amp;screen=4&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$id</td><td bgcolor=\"$bgcolor1\">$words</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
         $i++;
      }
	  echo "</table></center>\n";
   }
   else if( $table == _MSA_GENBROWSERS )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=5&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Id</b></td><td><b>Browser</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select id, ibrowser, hits from ".$prefix."_msanalysis_browsers".$squery );
      while( list( $id, $ibrowser, $hits ) = $db->sql_fetchrow( $result ) ) {
         if( ! eregi( "Web Crawler", $ibrowser ) ) {
            echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$id&amp;screen=5&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$id</td><td bgcolor=\"$bgcolor1\">$ibrowser</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
            $i++;
         }
      }
	  echo "</table></center>\n";
   }
   else if( $table == _MSA_GENOTHERBROWSERS )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=6&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Id</b></td><td><b>Browser</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select id, ibrowser, hits from ".$prefix."_msanalysis_browsers".$squery );
      while( list( $id, $ibrowser, $hits ) = $db->sql_fetchrow( $result ) ) {
         if( eregi( "Web Crawler", $ibrowser ) ) {
            echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$id&amp;screen=6&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$id</td><td bgcolor=\"$bgcolor1\">$ibrowser</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
            $i++;
         }
      }
	  echo "</table></center>\n";
   }
   else if( $table == _MSA_GENOS )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=7&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Id</b></td><td><b>OS</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select id, ios, hits from ".$prefix."_msanalysis_os".$squery );
      while( list( $id, $ios, $hits ) = $db->sql_fetchrow( $result ) ) {
         echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$id&amp;screen=7&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$id</td><td bgcolor=\"$bgcolor1\">$ios</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
         $i++;
      }
	  echo "</table></center>\n";
   }
   else if( $table == _MSA_GENMODULES )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=8&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Id</b></td><td><b>Modulename</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select id, modulename, hits from ".$prefix."_msanalysis_modules".$squery );
      while( list( $id, $modulename, $hits ) = $db->sql_fetchrow( $result ) ) {
         echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$id&amp;screen=8&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$id</td><td bgcolor=\"$bgcolor1\">$modulename</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
         $i++;
      }
	  echo "</table></center>\n";
   }
   else if( $table == _MSA_GENUSERS )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=9&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Uid</b></td><td><b>Name</b></td><td><b>Browser</b></td><td><b>OS</b></td><td><b>IP</b></td><td><b>Domain</b></td><td><b>Time</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select uid, uname, browser, os, ip_addr, domain, time, hits from ".$prefix."_msanalysis_users".$squery );
      while( list( $uid, $uname, $browser, $os, $ip_addr, $domain, $time, $hits ) = $db->sql_fetchrow( $result ) ) {
         echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$uid&amp;screen=9&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$uid</td><td bgcolor=\"$bgcolor1\">$uname</td><td bgcolor=\"$bgcolor1\">$browser</td><td bgcolor=\"$bgcolor1\">$os</td><td bgcolor=\"$bgcolor1\">$ip_addr</td><td bgcolor=\"$bgcolor1\">$domain</td><td bgcolor=\"$bgcolor1\">$time</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
         $i++;
      }
	  echo "</table></center>\n";
   }
   else if( $table == _MSA_GENRESOLUTION )
   {
      echo "<center><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&op=MSAnalysisResetTable&amp;screen=10&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\">&nbsp;"._MSA_RESETTABLE."</a></center><br>\n";
      echo "<div align=\"center\"><center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor2\">\n";
      echo "<tr><td><b>"._MSA_DELETE."</b></td><td><b>Counter</b></td><td><b>Id</b></td><td><b>Resolution</b></td><td><b>Hits</b></td></tr>\n";
      $result = $db->sql_query( "select id, scr_res, hits from ".$prefix."_msanalysis_scr".$squery );
      while( list( $id, $scr_res, $hits ) = $db->sql_fetchrow( $result ) ) {
         echo "<tr><td bgcolor=\"$bgcolor1\"><p align=\"center\"><a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisDelRow&amp;id=$id&amp;screen=10&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td><td bgcolor=\"$bgcolor1\">$i</td><td bgcolor=\"$bgcolor1\">$id</td><td bgcolor=\"$bgcolor1\">$scr_res</td><td bgcolor=\"$bgcolor1\">$hits</td></tr>\n";
         $i++;
      }
	  echo "</table></center>\n";
   }
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisDelRow                                                 */
/* Clear a row from a table                                                   */
/******************************************************************************/
function MSAnalysisDelRow( $id, $screen, $table, $sort_on, $sort_dir )
{
   global $prefix, $db;

   switch( $screen ) {
      case 1:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_countries WHERE id='$id'" );
      break;
      case 2:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_referrals WHERE id='$id'" );
      break;
      case 3:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_referrals WHERE id='$id'" );
      break;
      case 4:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_search WHERE id='$id'" );
      break;
      case 5:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_browsers WHERE id='$id'" );
      break;
      case 6:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_browsers WHERE id='$id'" );
      break;
      case 7:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_os WHERE id='$id'" );
      break;
      case 8:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_modules WHERE id='$id'" );
      break;
      case 9:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_users WHERE uid='$id'" );
      break;
      case 10:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_scr WHERE id='$id'" );
      break;
   }

   MSAtablemain( $table, $sort_on, $sort_dir );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisResetTable()                                           */
/* Clear a selected Table                                                     */
/******************************************************************************/
function MSAnalysisResetTable( $screen, $table, $sort_on, $sort_dir )
{
   global $module_name;

   include( "header.php" );
   echo "<br>\n";
   OpenTable();
   echo "<center><b>"._MSA_DELETETABLE."</b></center><br>\n";
   echo "<center>[ <a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAnalysisResetTableNow&amp;screen=$screen&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\">"._MSA_YES."</a> ]&nbsp;&nbsp;<b>÷</b>&nbsp;&nbsp;[ <a href=\"modules.php?name=$module_name&file=scripts&targetscript=tables&amp;op=MSAtablemain&amp;table=$table&amp;sort_on=$sort_on&amp;sort_dir=$sort_dir\">"._MSA_NO."</a> ]</center>\n";
   CloseTable();
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisResetTableNow()                                        */
/* Clear a selected Table                                                     */
/******************************************************************************/
function MSAnalysisResetTableNow( $screen, $table, $sort_on, $sort_dir )
{
   global $prefix, $db;
   $msa = new msanalysis();

   switch( $screen ) {
      case 1:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_countries" );
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_countries" );
      break;
      case 2:
         $result = $db->sql_query( "select id, referral from ".$prefix."_msanalysis_referrals" );
         while( list( $id, $referral ) = $db->sql_fetchrow( $result ) ) {
            if( $msa->IsSearchEngine( $referral ) == 0 ) {
               $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_referrals WHERE id='$id'" );
            }
         }
         $db->sql_freeresult( $result );
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_referrals" );
      break;
      case 3:
         $result = $db->sql_query( "select id, referral from ".$prefix."_msanalysis_referrals" );
         while( list( $id, $referral ) = $db->sql_fetchrow( $result ) ) {
            if( $msa->IsSearchEngine( $referral ) == 1 ) {
               $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_referrals WHERE id='$id'" );
            }
         }
         $db->sql_freeresult( $result );
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_referrals" );
      break;
      case 4:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_search" );
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_search" );
         $screen = 3;
      break;
      case 5:
         $result = $db->sql_query( "select id, ibrowser from ".$prefix."_msanalysis_browsers" );
         while( list( $id, $ibrowser ) = $db->sql_fetchrow( $result ) ) {
            if( ! eregi( "Web Crawler", $ibrowser ) ) {
               $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_browsers WHERE id='$id'" );
            }
         }
      break;
      case 6:
         $result = $db->sql_query( "select id, ibrowser from ".$prefix."_msanalysis_browsers" );
         while( list( $id, $ibrowser ) = $db->sql_fetchrow( $result ) ) {
            if( eregi( "Web Crawler", $ibrowser ) ) {
               $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_browsers WHERE id='$id'" );
            }
         }
      break;
      case 7:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_os" );
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_os" );
      break;
      case 8:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_modules" );
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_modules" );
      break;
      case 9:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_users" );
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_users" );
      break;
      case 10:
         $result = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_scr" );
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_scr" );
      break;
   }
   MSAtablemain( $table, $sort_on, $sort_dir );
}

/***************************************************/
/****************** PROGRAM START ******************/
/***************************************************/
switch ( $op )
{
   case "MSAtablemain":
      MSAtablemain( $table, $sort_on, $sort_dir );
   break;

   case "MSAnalysisDispOptions":
      MSAnalysisDispOptions( $table, $sort_on, $sort_dir );
   break;

   case "MSAnalysisShowTable":
      MSAnalysisShowTable( $table, $sort_on, $sort_dir );
   break;

   case "MSAnalysisDelRow":
      MSAnalysisDelRow( $id, $screen, $table, $sort_on, $sort_dir );
   break;

   case "MSAnalysisResetTable":
      MSAnalysisResetTable( $screen, $table, $sort_on, $sort_dir );
   break;

   case "MSAnalysisResetTableNow":
      MSAnalysisResetTableNow( $screen, $table, $sort_on, $sort_dir );
   break;
}

?>