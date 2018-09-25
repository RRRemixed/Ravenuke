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

// Set time limit and ignore user abort
if( !get_cfg_var('safe_mode') )
{
   @set_time_limit( 300 );
   @ignore_user_abort( 1 );
}

// Carry out maintenance every hour; initiated by MSA self
if( $MSArow[staticupdate] == 2 ) {
   require_once( "modules/$module_name/include/class.maintenance.php" );    // Routine Classes for tracker
   $msamainteneance = new msa_maintenance();
   $msamainteneance->hourly_maintenance( $MSAdata[slogdate] );
}

// Every day default clear the hits for this day. If set, also prune MS-Tables
if( $MSAdata[slogdate] != $MSArow[curdate] ) {
   if( $MSArow[staticupdate] == 2 ) {
      // Set new logdate in Admin Table
      $db->sql_query( "update ".$prefix."_msanalysis_admin set curdate='$MSAdata[slogdate]' where id = '1'" );
      require_once( "modules/$module_name/include/class.maintenance.php" );    // Routine Classes for tracker
      $msamainteneance = new msa_maintenance( );
      $msamainteneance->daily_maintenance( );
      if( $MSArow[allow_pruning] ) $msamainteneance->pruning_maintenance( );
   }
}

?>
