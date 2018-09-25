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

global $prefix, $db;

// Set time limit and ignore user abort
if( !get_cfg_var('safe_mode') )
{
   @set_time_limit( 300 );
   @ignore_user_abort( 1 );
}

// Next setting ($forum_admin) is needed so that PHP-Nuke finds the required files in the correct path
define('FORUM_ADMIN', true);
require_once("../../../config.php");
require_once("../../../db/db.php");
// END: Next setting ($forum_admin) is needed so that PHP-Nuke finds the required files in the correct path

// Load Admin Settings
$result = $db->sql_query( "select curdate, staticupdate, GMT_offset, allow_pruning from ".$prefix."_msanalysis_admin where id='1'" );
$MSArow = $db->sql_fetchrow( $result );

// Compose LOCAL Timestamp
$MSAdata[current] = -1 * ( date( "Z" ) / 3600 );
$MSAdata[zonedate] = mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y'), -1) + ( ( $MSAdata[current] + $MSArow[GMT_offset] ) * 3600 );
$MSAdata[logdate] = date( "Y-m-d H:i:s", $MSAdata[zonedate] );
$MSAdata[slogdate] = date( "Y-m-d", $MSAdata[zonedate] );

// Set last update time
$db->sql_query( "update ".$prefix."_msanalysis_admin set lastupdate = '$MSAdata[logdate]' where id='1'" );

// Carry out maintenance every hour (by cron deamon)
if( $MSArow[staticupdate] ) {
   require_once( "class.maintenance.php" );    // Routine Classes for tracker
   $msamainteneance = new msa_maintenance();
   $msamainteneance->hourly_maintenance( $MSAdata[slogdate] );
}

// Every day default clear the hits for this day. If set, also prune MS-Tables
if( $MSAdata[slogdate] != $MSArow[curdate] ) {
   if( $MSArow[staticupdate] ) {
      // Set new logdate in Admin Table
      $db->sql_query( "update ".$prefix."_msanalysis_admin set curdate='$MSAdata[slogdate]' where id = '1'" );
      require_once( "class.maintenance.php" );    // Routine Classes for tracker
      $msamainteneance = new msa_maintenance( );
      $msamainteneance->daily_maintenance( );
      if( $MSArow[allow_pruning] ) $msamainteneance->pruning_maintenance( );
   }
}

unset( $MSAdata );

?>
