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
get_lang( $module_name );

if( !is_array( $admin ) ) {
   $adm = base64_decode( $admin );
   $adm = explode( ":", $adm );
   $aname = "$adm[0]";
} else { $aname = "$admin[0]"; }
$result = $db->sql_query( "select radminsuper from ".$prefix."_authors where aid='$aname'" );
list( $radminsuper ) = $db->sql_fetchrow( $result );
if( $radminsuper == 1 ) {
/******************************************************************************/
/* FUNCTION: MSAnalysisAdmin()                                                */
/******************************************************************************/
function MSAnalysisAdmin( $which_function )
{
   global $module_name;

   if( isset( $which_function ) ) { $which_function = intval( $which_function ); }
   else { $which_function = 0; }

   switch( $which_function ) {
   case 0:
      include( "header.php" );
      @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
      $msaadmin = new msa_admin( $module_name );
      $msaadmin->admin_menu();
      include( "footer.php" );
   break;
   case 1:
      @(include( "modules/$module_name/admin/gensettings.php" ) ) OR die ("File gensettings.php can not be found" );
      MSAgensettings();
   break;
   case 2:
      @(include( "modules/$module_name/admin/excludeip.php" ) ) OR die ("File excludeip.php can not be found" );
      MSAexcludeip( 0 );
   break;
   case 3:
      @(include( "modules/$module_name/admin/excludeuser.php" ) ) OR die ("File excludeuser.php can not be found" );
      MSAexcludeusers( 0 );
   break;
   case 4:
      @(include( "modules/$module_name/admin/searchengines.php" ) ) OR die ("File searchengines.php can not be found" );
      MSAdefse( 0 );
   break;
   case 5:
      @(include( "modules/$module_name/admin/tables.php" ) ) OR die ("File tables.php can not be found" );
      MSAtablemain( _MSA_GENCOUNTRIES, 2, 2 );
   break;
   case 6:
      @(include( "modules/$module_name/admin/reset.php" ) ) OR die ("File reset.php can not be found" );
      MSAstatsreset( 0 );
   break;
   case 7:
      @(include( "modules/$module_name/admin/pruning.php" ) ) OR die ("File pruning.php can not be found" );
      MSApruning();
   break;
   case 8:
      @(include( "modules/$module_name/admin/userinfo.php" ) ) OR die ("File userinfo.php can not be found" );
      MSAenterinfo();
   break;
   case 9:
      @(include( "modules/$module_name/admin/inactive.php" ) ) OR die ("File inactive.php can not be found" );
      MSAinactive();
   break;
   case 10:
      @(include( "modules/$module_name/admin/backup.php" ) ) OR die ("File backup.php can not be found" );
      MSAnalysisDump();
   break;
   default:
      include( "header.php" );
      @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
      $msaadmin = new msa_admin( $module_name );
      $msaadmin->admin_menu();
      include( "footer.php" );
   }
}


/***************************************************/
/****************** PROGRAM START ******************/
/***************************************************/
switch ( $op )
{
   case "MSAnalysisAdmin":
      MSAnalysisAdmin( $which_function );
   break;

   default:
      MSAnalysisAdmin( $which_function );
}

} else { echo "Access Denied\n"; }

?>

