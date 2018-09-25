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
get_lang( $module_name );

/******************************************************************************/
/* FUNCTION: Start                                                            */
/******************************************************************************/
function MSAdefse( $func )
{
   global $module_name;

   include( "header.php" );
   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   if( $msaadmin->check_permission() == 1 ) {
      $msaadmin->admin_menu();
      if( $func == 0 ) MSAnalysisDefSE( $id, 0 );
      else MSAnalysisAddSE( $id, 1 );
   } else { echo "Access Denied\n"; }
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisDefSE                                                  */
/******************************************************************************/
function MSAnalysisDefSE( $id, $func )
{
   global $prefix, $db, $module_name, $bgcolor1, $bgcolor2;

   @(include( "modules/$module_name/include/searchengines.php" ) ) OR die ("File searchengines.php can not be found" );
   // Configure SearchEngines
   echo "<br>"; OpenTable();
   echo "<center><font color=\"000000\">"._MSA_DEFSE."</font></center>\n";
   echo "<br><div align=\"center\">\n";
   echo "<center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"60%\" bgcolor=\"$bgcolor2\">\n";
   echo "<tr>\n";
   echo "<td width=\"20%\" align=\"center\" height=\"30\"><b>"._MSA_DELETE."</b></td>\n";
   echo "<td width=\"50%\" align=\"center\" height=\"30\"><b>"._MSA_GENSENGINES."</b></td>\n";
   echo "<td width=\"30%\" align=\"center\" height=\"30\"><b>"._MSA_QUERYID."</b></td>\n";
   echo "</tr>\n";

   foreach( $MSSearchEngines as $key=>$value ) {
      echo "<tr>\n";
      echo "<td width=\"20%\" align=\"center\" bgcolor=\"$bgcolor1\"><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=searchengines&op=MSAnalysisDeleteSE&amp;id=$key\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td>\n";
      echo "<td width=\"50%\" align=\"center\" bgcolor=\"$bgcolor1\">$key</td>\n";
      echo "<td width=\"30%\" align=\"center\" bgcolor=\"$bgcolor1\">$value</td>\n";
      echo "</tr>\n";
   }
   echo "<tr>\n";
   echo "<td width=\"100%\" colspan=\"3\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=searchengines&op=MSAdefse&amp;func=1\"><img src=\"modules/$module_name/images/edit.gif\" border=\"0\" align=\"bottom\"><b>"._MSA_DEFSE."</b></a></td>\n";
   echo "</tr>\n";
   echo "</table></center></div>";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisAddSE                                                  */
/******************************************************************************/
function MSAnalysisAddSE( $func )
{
   global $prefix, $db, $module_name, $bgcolor1, $bgcolor2;

   // Add a User Name which should not be logged
   echo "<br>"; OpenTable();
   echo "<br><div align=\"center\">\n";
   echo "<form action=\"modules.php?name=$module_name&file=scripts&targetscript=searchengines\" method=\"post\">\n";
   echo "<center><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"60%\" bgcolor=\"$bgcolor2\">\n";
   echo "<tr>\n";
   echo "<td width=\"100%\" colspan=\"2\" align=\"center\" height=\"30\"><b>"._MSA_DEFSE."</b></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"30%\" bgcolor=\"$bgcolor1\" align=\"center\" height=\"30\"><b>"._MSA_GENSENGINES."</b></td>\n";
   echo "<td width=\"70%\" bgcolor=\"$bgcolor1\" align=\"center\" height=\"30\"><input type=\"text\" name=\"nse\" value=\"$nse\" size=\"30\"></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"30%\" bgcolor=\"$bgcolor1\" align=\"center\" height=\"30\"><b>"._MSA_QUERYID."</b></td>\n";
   echo "<td width=\"70%\" bgcolor=\"$bgcolor1\" align=\"center\" height=\"30\"><input type=\"text\" name=\"nseq\" value=\"$nseq\" size=\"30\"></td>\n";
   echo "</tr>\n";
   echo "<td width=\"100%\" colspan=\"2\" valign=\"top\" colspan=\"2\" bgcolor=$bgcolor1><br>\n";
   echo "<input type=\"hidden\" name=\"op\" value=\"MSAnalysisSaveSE\">\n";
   echo "<p align=\"center\"><input type=\"submit\" value=\""._MSA_SAVE."\"></td>\n";
   echo "</table></form></center></div>";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisSaveSE                                                 */
/******************************************************************************/
function MSAnalysisSaveSE( $nse, $nseq )
{
   global $module_name;
   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   $msaadmin->save_searchengines( $nse, $nseq, 0, "-1"  );
   MSAdefse( 0 );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisDeleteSE                                               */
/******************************************************************************/
function MSAnalysisDeleteSE( $id )
{
   global $module_name;
   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   $msaadmin->save_searchengines( "DUMMY!!!", "DUMMY!!!", 1, $id );
   MSAdefse( 0 );
}

/***************************************************/
/****************** PROGRAM START ******************/
/***************************************************/
switch ( $op )
{
   case "MSAdefse":
      MSAdefse( $func );
   break;

   case "MSAnalysisDefSE":
      MSAnalysisDefSE( $id, $func );
   break;

   case "MSAnalysisAddSE":
      MSAnalysisAddSE( $func );
   break;

   case "MSAnalysisSaveSE":
      MSAnalysisSaveSE( $nse, $nseq );
   break;

   case "MSAnalysisDeleteSE":
      MSAnalysisDeleteSE( $id );
   break;
}

?>