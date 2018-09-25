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
function MSAgensettings()
{
   global $module_name;

   include( "header.php" );
   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   if( $msaadmin->check_permission() == 1 ) {
      $msaadmin->admin_menu();
      MSAnalysisGenSettings();
   } else { echo "Access Denied\n"; }
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisGenSettings                                            */
/******************************************************************************/
function MSAnalysisGenSettings()
{
   global $prefix, $db, $bgcolor1, $bgcolor2, $module_name;

   // Configure Views
   // Get the maximum amount of lines that should be displayed per block in the overview screen
   $result = $db->sql_query( "select max_items, max_view, max_online, max_browse, max_inactive, search_store, overview, screen, staticupdate, enabled, GMT_offset, msaurl from ".$prefix."_msanalysis_admin where id='1'" );
   list( $max_items, $max_view, $max_online, $max_browse, $max_inactive, $search_store, $overview, $screen, $staticupdate, $enabled, $GMT_offset, $msaurl ) = $db->sql_fetchrow( $result );

   echo "<br>"; OpenTable();
   echo "<form action=\"modules.php?name=$module_name&amp;file=scripts&targetscript=gensettings\" method=\"post\">\n";
   echo "<div align=\"center\"><center>\n";
   echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" width=\"80%\" bgcolor=$bgcolor2 class=\"content\">\n";
   echo "<tr class=\"title\">\n";
   echo "<td width=\"100%\" height=\"30\" colspan=\"2\" bgcolor=$bgcolor2>\n";
   echo "<p align=\"center\">"._MSA_GENSETTINGS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_DATAUPDATE."</b></td>\n";
   if( $staticupdate == 0 )
   {
      echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"radio\" name=\"staticupdate\" value=\"0\" checked><b>"._MSA_UPDATEDYNAMIC."</b><br>
      <input type=\"radio\" name=\"staticupdate\" value=\"1\"><b>"._MSA_UPDATESTATIC1."</b><br>
      <input type=\"radio\" name=\"staticupdate\" value=\"2\"><b>"._MSA_UPDATESTATIC2."</b></td>";
   }
   elseif( $staticupdate == 1 ) {
      echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"radio\" name=\"staticupdate\" value=\"0\"><b>"._MSA_UPDATEDYNAMIC."</b><br>
      <input type=\"radio\" name=\"staticupdate\" value=\"1\" checked><b>"._MSA_UPDATESTATIC1."</b><br>
      <input type=\"radio\" name=\"staticupdate\" value=\"2\"><b>"._MSA_UPDATESTATIC2."</b></td>";
   }
   else {
      echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"radio\" name=\"staticupdate\" value=\"0\"><b>"._MSA_UPDATEDYNAMIC."</b><br>
      <input type=\"radio\" name=\"staticupdate\" value=\"1\"><b>"._MSA_UPDATESTATIC1."</b><br>
      <input type=\"radio\" name=\"staticupdate\" value=\"2\" checked><b>"._MSA_UPDATESTATIC2."</b></td>";
   }
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_MSAURL."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"text\" name=\"msaurl\" value=\"$msaurl\" size=\"30\" maxlength=\"255\"></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_AVIEWS." "._MSA_AITEMS."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"text\" name=\"imax_items\" value=\"$max_items\" size=\"30\" maxlength=\"10\"></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_AVIEWS." "._MSA_AVIEW."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"text\" name=\"imax_view\" value=\"$max_view\" size=\"30\" maxlength=\"10\"></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_AVIEWS." "._MSA_AONLINE."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"text\" name=\"imax_online\" value=\"$max_online\" size=\"30\" maxlength=\"10\"></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_AVIEWS." "._MSA_TABLEMAIN."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"text\" name=\"imax_browse\" value=\"$max_browse\" size=\"30\" maxlength=\"10\"></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_AVIEWS." "._MSA_DELETEINACTIVEUSR."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"text\" name=\"imax_inactive\" value=\"$max_inactive\" size=\"30\" maxlength=\"5\"></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_SQUERY." "._MSA_SEARCH."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><input type=\"text\" name=\"search_store\" value=\"$search_store\" size=\"30\" maxlength=\"10\"></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_OVERVIEWTYPE."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><select name=\"overview\" size=\"1\">\n";
   if( $overview == 1 ) echo "<option value=\"1\" selected>"._MSA_OVERVIEWTODAY."</option>\n"; else echo "<option value=\"1\">"._MSA_OVERVIEWTODAY."</option>\n";
   if( $overview == 2 ) echo "<option value=\"2\" selected>"._MSA_OVERVIEWLASTDAYS1." X "._MSA_OVERVIEWLASTDAYS2."</option>\n"; else echo "<option value=\"2\">"._MSA_OVERVIEWLASTDAYS1." X "._MSA_OVERVIEWLASTDAYS2."</option>\n";
   if( $overview == 3 ) echo "<option value=\"3\" selected>"._MSA_OVERVIEWALL."</option>\n"; else echo "<option value=\"3\">"._MSA_OVERVIEWALL."</option>\n";
   echo "</select></td>\n";
   echo "</tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_SCREENTYPE."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><select name=\"screen\" size=\"1\">\n";
   if( $screen == 1 ) echo "<option value=\"1\" selected>"._MSA_GENCOUNTRIES."</option>\n"; else echo "<option value=\"1\">"._MSA_GENCOUNTRIES."</option>\n";
   if( $screen == 2 ) echo "<option value=\"2\" selected>"._MSA_GENREFERRALS."</option>\n"; else echo "<option value=\"2\">"._MSA_GENREFERRALS."</option>\n";
   if( $screen == 3 ) echo "<option value=\"3\" selected>"._MSA_GENSENGINES."</option>\n"; else echo "<option value=\"3\">"._MSA_GENSENGINES."</option>\n";
   if( $screen == 4 ) echo "<option value=\"4\" selected>"._MSA_GENBROWSERS."</option>\n"; else echo "<option value=\"4\">"._MSA_GENBROWSERS."</option>\n";
   if( $screen == 5 ) echo "<option value=\"5\" selected>"._MSA_GENOS."</option>\n"; else echo "<option value=\"5\">"._MSA_GENOS."</option>\n";
   if( $screen == 6 ) echo "<option value=\"6\" selected>"._MSA_GENMODULES."</option>\n"; else echo "<option value=\"6\">"._MSA_GENMODULES."</option>\n";
   if( $screen == 7 ) echo "<option value=\"7\" selected>"._MSA_GENUSERS."</option>\n"; else echo "<option value=\"7\">"._MSA_GENUSERS."</option>\n";
   if( $screen == 8 ) echo "<option value=\"8\" selected>"._MSA_GENQUERIES."</option>\n"; else echo "<option value=\"8\">"._MSA_GENQUERIES."</option>\n";
   if( $screen == 9 ) echo "<option value=\"9\" selected>"._MSA_GENRESOLUTION."</option>\n"; else echo "<option value=\"9\">"._MSA_GENRESOLUTION."</option>\n";
   if( $screen == 10 ) echo "<option value=\"10\" selected>"._MSA_GENOTHERBROWSERS."</option>\n"; else echo "<option value=\"10\">"._MSA_GENOTHERBROWSERS."</option>\n";
   if( $screen == 11 ) echo "<option value=\"11\" selected>"._MSA_GENTITLE."</option>\n"; else echo "<option value=\"11\">"._MSA_GENTITLE."</option>\n";
   if( $screen == 12 ) echo "<option value=\"12\" selected>"._MSA_VISITOROVERVIEWGRAPH."</option>\n"; else echo "<option value=\"12\">"._MSA_VISITOROVERVIEWGRAPH."</option>\n";
   if( $screen == 13 ) echo "<option value=\"13\" selected>"._MSA_MENUPAGEVISITS."</option>\n"; else echo "<option value=\"13\">"._MSA_MENUPAGEVISITS."</option>\n";
   if( $screen == 14 ) echo "<option value=\"14\" selected>"._MSA_MENUNUKESTATS."</option>\n"; else echo "<option value=\"14\">"._MSA_MENUNUKESTATS."</option>\n";
   if( $screen == 15 ) echo "<option value=\"15\" selected>"._MSA_VISITOROVERVIEW."</option>\n"; else echo "<option value=\"15\">"._MSA_VISITOROVERVIEW."</option>\n";
   if( $screen == 16 ) echo "<option value=\"16\" selected>"._MSA_MENUNUKETHEMES."</option>\n"; else echo "<option value=\"16\">"._MSA_MENUNUKETHEMES."</option>\n";
   if( $screen == 17 ) echo "<option value=\"17\" selected>"._MSA_GENAVERAGES."</option>\n"; else echo "<option value=\"17\">"._MSA_GENAVERAGES."</option>\n";
   echo "</select></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><b>"._MSA_TIMEZONE."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><select name=\"GMT_offset\" size=\"1\">\n";
   for( $i = -12; $i <= 12; $i++ ) {
      if( $i > 0 ) $ai = "+".$i; else $ai = $i;
      if( $i == -1 || $i == 1 ) $h = _MSA_GMTHOUR; elseif( $i < -1 || $i > 1 ) $h = _MSA_GMTHOURS; elseif( $i == 0 ) $h = "";
      if( strcmp( $ai, $GMT_offset ) == 0 ){ echo "<option value=\"$ai\" selected>GMT ".$ai." $h</option>\n"; } else { echo "<option value=\"$ai\">GMT ".$ai." $h</option>\n"; }
   }
   echo "</select></td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1><img src=\"modules/".$module_name."/images/tablemain.gif\" border=\"0\" alt=\""._MSA_ENDISABLE."\" title=\""._MSA_ENDISABLE."\" align=\"bottom\">&nbsp;<b>"._MSA_ENDISABLE."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor1\" align=\"center\"><select name=\"enabled\" size=\"1\">\n";
   if( $enabled == 0 ) echo "<option value=\"0\" selected>"._MSA_DISABLED."</option>\n"; else echo "<option value=\"0\">"._MSA_DISABLED."</option>\n";
   if( $enabled == 1 ) echo "<option value=\"1\" selected>"._MSA_ENABLED."</option>\n"; else echo "<option value=\"1\">"._MSA_ENABLED."</option>\n";
   echo "</select></td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"100%\" valign=\"top\" colspan=\"2\" bgcolor=$bgcolor2>\n";
   echo "<input type=\"hidden\" name=\"op\" value=\"MSAnalysisStore\">\n";
   echo "<p align=\"center\"><input type=\"submit\" value=\""._MSA_SAVE."\"></p></td>\n";
   echo "</tr>\n";
   echo "</table>\n";
   echo "</form>\n";
   echo "</center>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisStore()                                                */
/******************************************************************************/
function MSAnalysisStore( $staticupdate, $msaurl, $imax_items, $imax_view, $imax_online, $imax_browse, $imax_inactive, $search_store, $overview, $screen, $enabled, $GMT_offset )
{
   global $prefix, $db, $module_name;

   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );

   if( ( $msaurl == "" ) || ( $imax_items == "" ) || ( $imax_view == "" ) || ( $imax_online == "" ) || ( $imax_browse == "" ) || ( $imax_inactive == "" ) || ( $search_store == "" ) ) { $msaadmin->disp_error( _MSA_VIEWERROR ); }
   else {
      $result = $db->sql_query( "update ".$prefix."_msanalysis_admin set max_items = '$imax_items', max_view = '$imax_view', max_online = '$imax_online', max_browse = '$imax_browse', max_inactive = '$imax_inactive', search_store = '$search_store', overview = '$overview', screen = '$screen', staticupdate = '$staticupdate', enabled = '$enabled', GMT_offset = '$GMT_offset', msaurl = '$msaurl' where id='1'" );
      if( ! $result ) { $msaadmin->disp_error( _MSA_UPDATEERROR ); }
      else MSAgensettings( );
   }
}

/***************************************************/
/****************** PROGRAM START ******************/
/***************************************************/
switch ( $op )
{
   case "MSAgensettings":
      MSAgensettings();

   case "MSAnalysisGenSettings":
      MSAnalysisGenSettings();
   break;

   case "MSAnalysisStore":
      MSAnalysisStore( $staticupdate, $msaurl, $imax_items, $imax_view, $imax_online, $imax_browse, $imax_inactive, $search_store, $overview, $screen, $enabled, $GMT_offset );
   break;
}

?>