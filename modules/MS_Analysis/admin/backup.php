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
/************************************************************************************/
/*                                                                                  */
/* Routine: MSAnalysisExportTable - Copyright (c) 2001 by:                          */
/*                                                                                  */
/* Thomas Rudant (thomas.rudant@grunk.net)                                          */
/* http://www.grunk.net                                                             */
/* http://www.securite-internet.org                                                 */
/*                                                                                  */
/************************************************************************************/

$index = 0;
$module_name = explode( "admin", dirname( __FILE__ ) );
$module_name = basename( $module_name[0] );

if( !stristr( $_SERVER['SCRIPT_NAME'], "modules.php" ) ) {
   die( "You can't access this file directly..." );
}

require_once( "mainfile.php" );

/******************************************************************************/
/* FUNCTION: MSAnalysisDump()                                                 */
/******************************************************************************/
function MSAnalysisDump()
{
   global $dbname, $prefix, $db, $module_name;

   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   if( $msaadmin->check_permission() == 1 ) {

      // Filename to be saved to
      $fn = "Backup MS-Analysis - " . date( "d-m-Y" ) . ".sql";
      // Get version number
      $result = $db->sql_query( "select version from ".$prefix."_msanalysis_admin where id='1'" );
      list( $version ) = $db->sql_fetchrow( $result );

      // Definitions for downloading the MS-Analysis backup
      header( "Content-type: application/octetstream");
      header( "Content-Disposition: attachment; filename = $fn" );
      header( "pragma: no-cache" );
      header( "expires: 0" );

      echo "#\n";
      echo "# Backup: " . $version . "\n";
      echo "# Date: " . date( "Y-m-d G:i:s" ). "\n";
      echo "# Database: " . $dbname . "\n";
      echo "#\n\n";

      MSAnalysisExportTable( $prefix."_msanalysis_admin" );     MSAnalysisExport( $prefix."_msanalysis_admin" );
      MSAnalysisExportTable( $prefix."_msanalysis_modules" );   MSAnalysisExport( $prefix."_msanalysis_modules" );
      MSAnalysisExportTable( $prefix."_msanalysis_referrals" ); MSAnalysisExport( $prefix."_msanalysis_referrals" );
      MSAnalysisExportTable( $prefix."_msanalysis_countries" ); MSAnalysisExport( $prefix."_msanalysis_countries" );
      MSAnalysisExportTable( $prefix."_msanalysis_browsers" );  MSAnalysisExport( $prefix."_msanalysis_browsers" );
      MSAnalysisExportTable( $prefix."_msanalysis_os" );        MSAnalysisExport( $prefix."_msanalysis_os" );
      MSAnalysisExportTable( $prefix."_msanalysis_search" );    MSAnalysisExport( $prefix."_msanalysis_search" );
      MSAnalysisExportTable( $prefix."_msanalysis_users" );     MSAnalysisExport( $prefix."_msanalysis_users" );
      MSAnalysisExportTable( $prefix."_msanalysis_online" );    MSAnalysisExport( $prefix."_msanalysis_online" );
      MSAnalysisExportTable( $prefix."_msanalysis_scr" );       MSAnalysisExport( $prefix."_msanalysis_scr" );
      MSAnalysisExportTable( $prefix."_msanalysis_domains" );   MSAnalysisExport( $prefix."_msanalysis_domains" );

      echo "# End of Backup-File " . $version . "\n";
   } else { echo "Access Denied\n"; }
}

/******************************************************************************/
/* FUNCTION: MSAnalysisExport( $table )                                       */
/* Export an MS-Analysis table contents                                       */
/******************************************************************************/
function MSAnalysisExport( $table )
{
   global $prefix, $db;

   echo "#\n";
   echo "# Dumping data for table `$table`\n";
   echo "#\n";

   $result = $db->sql_query( "SELECT * FROM ".$table );
   while( $row = $db->sql_fetchrow( $result ) ) {
      $insert = " INSERT INTO $table VALUES (";
      for( $j = 0; $j < mysql_num_fields( $result );$j++ ) {
         if( !isset( $row[ $j ] ) ) $insert .= "NULL,";
         else if($row[ $j ] != "" ) $insert .= "'".addslashes( $row[ $j ] )."',";
         else $insert .= "'',";
      }
      $insert = ereg_replace( ",$","",$insert );
      $insert .= ");\n";
      echo $insert;
   }
   echo "\n";
}

/******************************************************************************/
/* FUNCTION: MSAnalysisExportTable( $table )                                  */
/* Export an MS-Analysis table definition                                     */
/******************************************************************************/
function MSAnalysisExportTable( $table )
{
   global $dbname, $prefix;

   echo "#\n";
   echo "# Table structure for table `$table`\n";
   echo "#\n";
   echo "DROP TABLE IF EXISTS $table;\n";
   echo "CREATE TABLE $table (\n";

   $tbuf = "";
   $result = mysql_db_query( $dbname, "SHOW FIELDS FROM $table" );
   while( $row = mysql_fetch_array( $result ) )
   {
       $tbuf .= "   $row[Field] $row[Type]";
       if( isset( $row[ "Default" ] ) && ( !empty( $row["Default"] ) || $row[ "Default" ] == "0" ) ) $tbuf .= " DEFAULT '$row[Default]'";
       if( $row[ "Null" ] != "YES" ) $tbuf .= " NOT NULL";
       if( $row[ "Extra" ] != "" ) $tbuf .= " $row[Extra]";
       $tbuf .= ",\n";
   }
   $tbuf = ereg_replace(",\n$", "", $tbuf );
   $result = mysql_db_query( $dbname, "SHOW KEYS FROM $table" );
   while( $row = mysql_fetch_array( $result ) )
   {
       $kname = $row['Key_name'];
       if( ( $kname != "PRIMARY") && ( $row['Non_unique'] == 0 ) ) $kname = "UNIQUE|$kname";
       if( !isset( $index[$kname] ) ) $index[$kname] = array();
       $index[$kname][] = $row['Column_name'];
   }

   while(list($x, $columns) = @each( $index ) )
   {
      $tbuf .= ",\n";
      if( $x == "PRIMARY" ) $tbuf .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
      elseif( substr($x,0,6) == "UNIQUE" ) $tbuf .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
      else $tbuf .= "   KEY $x (" . implode($columns, ", ") . ")";
   }

   $tbuf .= "\n) TYPE=MyISAM;";
   echo ( stripslashes( $tbuf ) );
   echo "\n\n";
}

/***************************************************/
/****************** PROGRAM START ******************/
/***************************************************/
switch ( $op )
{
    case "MSAnalysisDump":
       MSAnalysisDump();
    break;

    case "MSAnalysisExport":
       MSAnalysisExport( $table );
    break;

    case "MSAnalysisExportTable":
       MSAnalysisExportTable( $table );
    break;
}

?>

