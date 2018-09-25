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

$module_name = basename( dirname( __FILE__ ) );
global $user, $admin, $prefix, $db, $cookie;

// Load Admin Settings
$result = $db->sql_query( "select curdate, lastupdate, staticupdate, enabled, GMT_offset, allow_pruning from ".$prefix."_msanalysis_admin where id='1'" );
$MSArow = $db->sql_fetchrow( $result );

if( $MSArow[enabled] ) {
   include( "modules/$module_name/include/nologging.php" ); // Excluding IP's and Users from being logged

   // Get User name
   cookiedecode( $user );
   $MSAdata[msuser] = $cookie[ 1 ];
   if( ! is_user( $user ) ) $MSAdata[msuser] = "Guest";

   // Determine IP
   $MSAdata[client_ip] = $_SERVER['HTTP_CLIENT_IP'];
   $MSAdata[x_forwarded_for] = $_SERVER['HTTP_X_FORWARDED_FOR'];
   $MSAdata[remote_addr] = $_SERVER['REMOTE_ADDR'];
   if( !empty( $MSAdata[client_ip] ) ) {
      $MSAdata[real_ip] = $MSAdata[client_ip];
   } elseif( !empty( $MSAdata[x_forwarded_for] ) ) {
      if( strstr( $MSAdata[x_forwarded_for], ',' ) ) {
         $MSAdata[ip_expl] = explode( ',', $MSAdata[x_forwarded_for] );
         $MSAdata[real_ip] = end( $MSAdata[ip_expl] );
      } else {
         $MSAdata[real_ip] = $MSAdata[x_forwarded_for];
      }
   } else {
      $MSAdata[real_ip] = $MSAdata[remote_addr];
   }
   $MSAdata[real_ip] = trim( $MSAdata[real_ip] );

   // Check if info should be logged
   if( is_admin( $admin ) ) { $MSAdata[isad] = in_array( "Admin", $MSIgnoreUNAME ); }
   if( ( in_array( $MSAdata[real_ip], $MSIgnoreIP ) ) OR ( in_array( $MSAdata[msuser], $MSIgnoreUNAME ) ) OR ( $MSAdata[isad] ) ) { }
   else {
      // Get Module Name
      $MSAdata[module] = $_REQUEST['name'];
      if( is_dir( "modules/" . $MSAdata[module] ) ) $MSAdata[module] = eregi_replace( "_", " ", $MSAdata[module] );
      else $MSAdata[module] = "";
      // Get Site user came from - Format the referring url (not including sub-dir's or query string)
      $MSAdata[referral] = parse_url( htmlspecialchars( strip_tags( $_SERVER['HTTP_REFERER'] ) ) );
      // Determine User Agent
      $MSAdata[agent] = $_SERVER['HTTP_USER_AGENT'];
      // Determine Host
      $MSAdata[host] = @getHostByAddr( $MSAdata[real_ip] );
      // Determine Domain
      $MSAarray = explode( ".", $MSAdata[host] );
      $MSAdata[domain] = strtolower( $MSAarray[ sizeof( $MSAarray ) -1 ] );
      if( $MSAdata[domain] == "gb" ) $MSAdata[domain] = "uk"; else if( $MSAdata[domain] == "cs" ) $MSAdata[domain] = "yu";
      // Compose LOCAL Timestamp
      $MSAdata[current] = -1 * ( date( "Z" ) / 3600 );
      $MSAdata[zonedate] = mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y'), -1) + ( ( $MSAdata[current] + $MSArow[GMT_offset] ) * 3600 );
      $MSAdata[logdate] = date( "Y-m-d H:i:s", $MSAdata[zonedate] );
      $MSAdata[slogdate] = date( "Y-m-d", $MSAdata[zonedate] );

      // Store Screen Resolution
      // (c) http://www.phpbuddy.com (Feel free to use this script but keep this message intact)
      // Author: Ranjit Kumar (Cheif Editor phpbuddy.com)
      if( ! isset( $_COOKIE["msa_resolution"] ) ) {
         ?>
         <script language="javascript"><!--
         writeCookie();
         function writeCookie()
         {
            var today = new Date();
            var the_date = new Date("December 31, 2023");
            var the_cookie_date = the_date.toGMTString();
            var the_cookie = "msa_resolution="+ screen.width +"x"+ screen.height +"x"+ screen.colorDepth;
            var the_cookie = the_cookie + ";expires=" + the_cookie_date;
            document.cookie=the_cookie;
         }
         //--></script>
         <?php
      } else { $MSAdata[screen_res] = $_COOKIE["msa_resolution"]; }

      // Store traced Information
      $MSAph = $MSAdata[referral]['host']; $MSApq = $MSAdata[referral]['query'];
      $db->sql_query( "insert into ".$prefix."_msanalysis_online ( time, uname, agent, ip_addr, host, domain, modulename, scr_res, referral, ref_query ) values ( '$MSAdata[logdate]', '$MSAdata[msuser]', '$MSAdata[agent]', '$MSAdata[real_ip]', '$MSAdata[host]', '$MSAdata[domain]', '$MSAdata[module]', '$MSAdata[screen_res]', '$MSAph', '$MSApq' )" );

      // Analyze Data for Dynamic mode on each visit
      if( $MSArow[staticupdate] == 0 ) {
         require_once( "modules/$module_name/include/class.dynamicadd.php" );    // Routine Classes for tracker
         $msamainteneance = new msa_dynamicadd();
         $msamainteneance->hourly_dynamicadd( $MSAdata[logdate], $MSAdata[slogdate], $MSAdata[msuser], $MSAdata[agent], $MSAdata[real_ip], $MSAdata[host], $MSAdata[domain], $MSAdata[module], $MSAdata[screen_res], $MSAph, $MSApq );
         // Every day default clear the hits for this day for Dynamic Mode. If set, also prune MS-Tables
         if( $MSAdata[slogdate] != $MSArow[curdate] ) {
            // Set new logdate in Admin Table
            $db->sql_query( "update ".$prefix."_msanalysis_admin set curdate='$MSAdata[slogdate]' where id = '1'" );
            require_once( "modules/$module_name/include/class.maintenance.php" );    // Routine Classes for tracker
            $msamainteneance = new msa_maintenance( );
            $msamainteneance->daily_maintenance( );
            if( $MSArow[allow_pruning] ) $msamainteneance->pruning_maintenance( );
         }
      }
      // Analyze Data for MSA Static-mode EACH HOUR
      elseif( $MSArow[staticupdate] == 2 ) {
         if( substr( $MSAdata[logdate], 11, 2 ) != substr( $MSArow[lastupdate], 11, 2 ) ) {
            $db->sql_query( "update ".$prefix."_msanalysis_admin set lastupdate = '$MSAdata[logdate]' where id='1'" );
            include( "modules/$module_name/include/selfmaintenance.php" );
         }
      }
   }
   unset( $MSAdata );
}

?>
