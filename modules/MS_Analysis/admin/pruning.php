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
function MSApruning()
{
   global $module_name;

   include( "header.php" );
   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   if( $msaadmin->check_permission() == 1 ) {
      $msaadmin->admin_menu();
      MSAnalysisPruning();
   } else { echo "Access Denied\n"; }
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisPruning()                                              */
/******************************************************************************/
function MSAnalysisPruning()
{
   global $admin, $module_name, $db, $prefix, $bgcolor1, $bgcolor2;

   echo "<br>\n";
   OpenTable();
   $result = $db->sql_query( "SELECT allow_pruning, nbrdays, begindate, tcountries, treferrals, tsearcheng, tqueries, tbrowsers, tcrawlers, tos, tmodules, tusers, tresolution FROM ".$prefix."_msanalysis_admin where id='1'" );
   list( $allow_pruning, $nbrdays, $begindate, $tcountries, $treferrals, $tsearcheng, $tqueries, $tbrowsers, $tcrawlers, $tos, $tmodules, $tusers, $tresolution ) = $db->sql_fetchrow( $result );

   echo "<center>\n";
   echo "<form action=\"modules.php?name=$module_name&amp;file=scripts&targetscript=pruning\" method=\"post\">\n";
   echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" width=\"80%\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" bgcolor=$bgcolor2>\n";
   echo "<tr class=\"title\">\n";
   echo "<td width=\"100%\" height=\"30\" colspan=\"2\" bgcolor=$bgcolor2>\n";
   echo "<p align=\"center\">"._MSA_PRUNINGSETTINGS."</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1 rowspan=\"2\"><b>"._MSA_PRUNINGAUTO."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>\n";
   // Allow Auto reset of Statistics or not
   if( $allow_pruning == 0 )
   {
      echo "<input type=\"radio\" name=\"allow_pruning\" value=\"0\" checked><b>"._MSA_NO."</b>&nbsp;&nbsp;
      <input type=\"radio\" name=\"allow_pruning\" value=\"1\"><b>"._MSA_YES."</b></td>";
   }
   else {
      echo "<input type=\"radio\" name=\"allow_pruning\" value=\"0\" ><b>"._MSA_NO."</b>&nbsp;&nbsp;
      <input type=\"radio\" name=\"allow_pruning\" value=\"1\" checked><b>"._MSA_YES."</b></td>";
   }
   echo "</td></tr>\n";
   echo "<tr>\n";
   // Dates for Auto Reset Statistics
   $ebegindate = explode( "-", $begindate );
   $startday = $ebegindate[ 2 ]; $startmonth = $ebegindate[ 1 ]; $startyear = $ebegindate[ 0 ];
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGEVERY."&nbsp;<select size=\"1\" name=\"nbrdays\">\n";
   for( $i = 1; $i < 121; $i++ ) { if( $i == $nbrdays ) { echo "<option selected>$i</option>\n"; } else { echo "<option>$i</option>\n"; } }
   echo "</select>&nbsp;"._MSA_PRUNINGSTARTFROM."&nbsp;<br>\n";

   echo "<select size=\"1\" name=\"startday\">\n";
   for( $i = 1; $i < 32; $i++ ) { if( strlen( $i ) == 1 ) $i = "0" . $i; if( $i == $startday ) { echo "<option selected>$i</option>\n"; } else { echo "<option>$i</option>\n"; } }
   echo "</select>&nbsp;-\n";
   echo "<select size=\"1\" name=\"startmonth\">\n";
   for( $i = 1; $i < 13; $i++ ) { if( strlen( $i ) == 1 ) $i = "0" . $i; if( $i == $startmonth ) { echo "<option selected>$i</option>\n"; } else { echo "<option>$i</option>\n"; } }
   echo "</select>&nbsp;-\n";
   echo "<select size=\"1\" name=\"startyear\">\n";
   for( $i = 2002; $i < 2026; $i++ ) { if( $i == $startyear ) { echo "<option selected>$i</option>\n"; } else { echo "<option>$i</option>\n"; } }
   echo "</select><br>\n";
   echo "<font color=\"#FF0000\"><b>\n";
   if( $allow_pruning == 0 ) { echo "&nbsp;" . _MSA_PRUNINGNOAUTO . "<br>\n"; } else { echo "&nbsp;" . _MSA_PRUNINGYESAUTO . "<br>\n"; }
   echo "</b></font></td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENCOUNTRIES."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"tcountries\" value=\"$tcountries\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENREFERRALS."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"treferrals\" value=\"$treferrals\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENSENGINES."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"tsearcheng\" value=\"$tsearcheng\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENQUERIES."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"tqueries\" value=\"$tqueries\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENBROWSERS."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"tbrowsers\" value=\"$tbrowsers\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENOTHERBROWSERS."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"tcrawlers\" value=\"$tcrawlers\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENOS."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"tos\" value=\"$tos\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENMODULES."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"tmodules\" value=\"$tmodules\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENUSERS."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"tusers\" value=\"$tusers\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_GENRESOLUTION."</b></td>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1>"._MSA_PRUNINGMAX."&nbsp;<input type=\"text\" name=\"tresolution\" value=\"$tresolution\" size=\"20\"> "._MSA_PRUNINGLINKS."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"100%\" colspan=\"2\" bgcolor=$bgcolor1>"._MSA_PRUNINGEXPLANATION."</td>\n";
   echo "</tr>\n";

   echo "<tr>\n";
   echo "<td width=\"100%\" valign=\"top\" colspan=\"2\" bgcolor=$bgcolor1>\n";
   echo "<input type=\"hidden\" name=\"op\" value=\"MSAnalysisPruningSave\">\n";
   echo "<p align=\"center\"><input type=\"submit\" value=\""._MSA_SAVE."\"></td>\n";
   echo "</tr>\n";
   echo "</table>\n";
   echo "</form>\n";
   echo "</center>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSAnalysisPruningSave()                                          */
/******************************************************************************/
function MSAnalysisPruningSave( $allow_pruning, $nbrdays, $tcountries, $treferrals, $tsearcheng, $tqueries, $tbrowsers, $tcrawlers, $tos, $tmodules, $tusers, $tresolution, $startyear, $startmonth, $startday )
{
   global $db, $prefix;

   if( $tcountries == "" )  { $tcountries = "0"; }
   if( $treferrals == "" )  { $treferrals = "0"; }
   if( $tsearcheng == "" )  { $tsearcheng = "0"; }
   if( $tqueries == "" )    { $tqueries = "0"; }
   if( $tbrowsers == "" )   { $tbrowsers = "0"; }
   if( $tcrawlers == "" )   { $tcrawlers = "0"; }
   if( $tos == "" )         { $tos = "0"; }
   if( $tmodules == "" )    { $tmodules = "0"; }
   if( $tusers == "" )      { $tusers = "0"; }
   if( $tresolution == "" ) { $tresolution = "0"; }
   $begindate = $startyear . "-" . $startmonth . "-" . $startday;

   $result = $db->sql_query( "UPDATE ".$prefix."_msanalysis_admin SET allow_pruning='$allow_pruning', nbrdays='$nbrdays', begindate='$begindate',
             tcountries='$tcountries', treferrals='$treferrals', tsearcheng='$tsearcheng', tqueries='$tqueries', tbrowsers='$tbrowsers', tcrawlers='$tcrawlers',
             tos='$tos', tmodules='$tmodules', tusers='$tusers', tresolution='$tresolution'
             WHERE id = '1'" );

   MSApruning();
}

/***************************************************/
/****************** PROGRAM START ******************/
/***************************************************/
switch ( $op )
{
    case "MSApruning":
       MSApruning();
    break;

    case "MSAnalysisPruning":
       MSAnalysisPruning();
    break;

    case "MSAnalysisPruningSave":
       MSAnalysisPruningSave( $allow_pruning, $nbrdays, $tcountries, $treferrals, $tsearcheng, $tqueries, $tbrowsers, $tcrawlers, $tos, $tmodules, $tusers, $tresolution, $startyear, $startmonth, $startday );
    break;
}

?>

