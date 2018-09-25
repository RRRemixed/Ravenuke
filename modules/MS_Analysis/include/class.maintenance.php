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
global $MSSearchEngines;
include(dirname(__FILE__) . '/searchengines.php' );  // Search Engine Definitions

class msa_maintenance
{
   var $robots;

   /******************************************************************************/
   /* Constructor for this Class                                                 */
   /******************************************************************************/
   function msa_maintenance()
   {
      $this->robots = array( "Alexibot", "asterias", "BackDoorBot", "Black.Hole", "BlowFish", "BotALot", "BuiltBotTough", "Bullseye",
                             "BunnySlippers", "Cegbfeieh", "CheeseBot", "CherryPicker", "CopyRightCheck", "cosmos", "crawler", "Crescent", "DittoSpyder",
                             "EmailCollector", "EmailSiphon", "EmailWolf", "EroCrawler", "ExtractorPro", "FAST-WebCrawler", "Foobot",
                             "Googlebot", "Harvest", "hloader", "httplib", "humanlinks", "ia_archiver", "InfoNaviRobot", "JennyBot",
                             "Kenjin.Spider", "Keyword.Density", "LexiBot", "libWeb", "LinkextractorPro", "LinkScan",
                             "LinkWalker", "lwp-trivial", "Mata.Hari", "Microsoft.URL", "MIIxpc", "Mister.PiX", "moget",
                             "Mozilla.*NEWT", "NetAnts", "NetMechanic", "NICErsPRO", "NPBot", "Offline.Explorer", "Openfind", "ProPowerBot",
                             "ProWebWalker ", "QueryN.Metasearch", "RepoMonkey", "RMA", "SiteSnagger", "SpankBot", "spanner", "suzuran", "Szukacz",
                             "Teleport", "Telesoft", "The.Intraformant", "TheNomad", "TightTwatBot", "Titan", "toCrawl",
                             "True_Robot", "turingos", "TurnitinBot", "URLy.Warning", "VCI", "W3C_Validator", "W3C_CSS_Validator", "WebAuto",
                             "WebBandit", "WebCopier", "Webcrawler", "WebEMailExtrac", "WebEnhancer", "Web.Image.Collector", "WebmasterWorldForumBot",
                             "WebSauger", "Website.Quester", "Webster.Pro", "WebStripper", "WebWasher", "WebZip", "[Ww]eb[Bb]andit", "Slurp",
                             "WWW-Collector-E", "Xenu", "Zeus", "zyborg", "EmailCollector", "msnbot", "alexa.com", "antibot" );
   }

   /******************************************************************************/
   /* Hourly Maintenance                                                         */
   /******************************************************************************/
   function hourly_maintenance( $slogdate )
   {
      global $prefix, $db;

      // Set time limit and ignore user abort
      if( !get_cfg_var('safe_mode') )
      {
         @set_time_limit( 300 );
         @ignore_user_abort( 1 );
      }

      // Load Admin Settings
      $result = $db->sql_query( "select search_store, xdate, msaurl from ".$prefix."_msanalysis_admin where id='1'" );
      list( $search_store, $xdate, $msaurl ) = $db->sql_fetchrow( $result );

      // Array Definitions
      $MSAArrayModule = array();
      $MSAArrayBrowser = array();
      $MSAArrayOS = array();
      $MSAArrayCountry = array();
      $MSAArrayUser = array();
      $MSAArrayScr_res = array();
      $MSAArrayRef = array();
      $MSAArraySearch = array();

      $mresult = $db->sql_query( "select time, uname, agent, ip_addr, modulename, host, domain, scr_res, referral, ref_query from ".$prefix."_msanalysis_online" );
      while( $MSArow = $db->sql_fetchrow( $mresult ) )
      {
         // Get browser name
         $MSAMaint[browser] = $this->MSAget_browser( $MSArow[agent] );
         // Get Operating System Name
         $MSAMaint[os] = $this->MSAget_os( $MSArow[agent] );

         // Store Module Name
         if( $MSArow[modulename] != "" ) {
            $found = 0; foreach( $MSAArrayModule as $key=>$value ) { if( $key == $MSArow[modulename] ) { $MSAArrayModule[ $MSArow[modulename] ] += 1; $found = 1; break; } }
            if( ! $found ) $MSAArrayModule[ $MSArow[modulename] ] = 1;
         }

         // Store Browser
         if( $MSAMaint[browser] == "" ) $MSAMaint[browser] = "Other - Unknown";
         $found = 0; foreach( $MSAArrayBrowser as $key=>$value ) { if( $key == $MSAMaint[browser] ) { $MSAArrayBrowser[ $MSAMaint[browser] ] += 1; $found = 1; break; } }
         if( ! $found ) $MSAArrayBrowser[ $MSAMaint[browser] ] = 1;

         // Store Operating System
         if( $MSAMaint[os] == "" ) $MSAMaint[os] = "Other - Unknown";
         $found = 0; foreach( $MSAArrayOS as $key=>$value ) { if( $key == $MSAMaint[os] ) { $MSAArrayOS[ $MSAMaint[os] ] += 1; $found = 1; break; } }
         if( ! $found ) $MSAArrayOS[ $MSAMaint[os] ] = 1;

         // Store Countries
         if( $MSArow[domain] != "" ) {
            $found = 0; foreach( $MSAArrayCountry as $key=>$value ) { if( $key == $MSArow[domain] ) { $MSAArrayCountry[ $MSArow[domain] ] += 1; $found = 1; break; } }
            if( ! $found ) $MSAArrayCountry[ $MSArow[domain] ] = 1;
         }

         // Store User Information
         if( $MSArow[uname] != "Guest" ) {
            $found = 0;
            foreach( $MSAArrayUser as $key=>$value ) {
               if( $key == $MSArow[uname] ) {
                  $MSAArrayUser[ $MSArow[uname] ][hits] += 1;
                  $MSAArrayUser[ $MSArow[uname] ][time] = $MSArow[time];
                  $found = 1;
                  break;
               }
            }
            if( ! $found ) {
               $MSAArrayUser[ $MSArow[uname] ][hits] = 1;
               $MSAArrayUser[ $MSArow[uname] ][browser] = $MSAMaint[browser];
               $MSAArrayUser[ $MSArow[uname] ][os] = $MSAMaint[os];
               $MSAArrayUser[ $MSArow[uname] ][ip_addr] = $MSArow[ip_addr];
               $MSAArrayUser[ $MSArow[uname] ][domain] = $MSArow[domain];
               $MSAArrayUser[ $MSArow[uname] ][host] = $MSArow[host];
               $MSAArrayUser[ $MSArow[uname] ][time] = $MSArow[time];
            }
         }

         // Store Screen Resolution
         if( $MSArow[scr_res] != "" ) {
            $found = 0; foreach( $MSAArrayScr_res as $key=>$value ) { if( $key == $MSArow[scr_res] ) { $MSAArrayScr_res[ $MSArow[scr_res] ] += 1; $found = 1; break; } }
            if( ! $found ) $MSAArrayScr_res[ $MSArow[scr_res] ] = 1;
         }

         // Store Referral Name
         if( $MSArow[referral] != "" ) {
            if( !eregi( $MSArow[referral], $msaurl ) )  {
               $found = 0; foreach( $MSAArrayRef as $key=>$value ) { if( $key == $MSArow[referral] ) { $MSAArrayRef[ $MSArow[referral] ] += 1; $found = 1; break; } }
               if( ! $found ) $MSAArrayRef[ $MSArow[referral] ] = 1;
               // Store search engine search words
               if( $this->IsSearchEngine( $MSArow[referral] ) == 1 ) {
                  $searchwords = $this->MSAGetSearchWords( $MSArow[ref_query], $MSArow[referral], $search_store );
                  if( $searchwords != "" ) {
                     if( $search_store ) {
                        $searchwords = explode( " ", $searchwords );
                        for( $i = 0; $i < sizeof( $searchwords ); $i++ )
                        {
	                   $sw = trim( $searchwords[ $i ] );
                           if( $sw != "" ) {
                              $sw = addslashes( $sw );
                              $found = 0; foreach( $MSAArraySearch as $key=>$value ) { if( $key == $sw ) { $MSAArraySearch[ $sw ] += 1; $found = 1; break; } }
                              if( ! $found ) $MSAArraySearch[ $sw ] = 1;
                           }
                        }
                     }
                     else {
                        $searchwords = addslashes( $searchwords );
                        $found = 0; foreach( $MSAArraySearch as $key=>$value ) { if( $key == $searchwords ) { $MSAArraySearch[ $searchwords ] += 1; $found = 1; break; } }
                        if( ! $found ) $MSAArraySearch[ $searchwords ] = 1;
                     }
                  }
               }
            }
         }
      } // END while( $MSArow = $db->sql_fetchrow( $mresult ) )

      // Store Module Name
      foreach( $MSAArrayModule as $key=>$value ) {
         $result = $db->sql_query( "select modulename from ".$prefix."_msanalysis_modules where modulename = '$key'" );
         if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_modules ( modulename, hits, today, hitstoday, xdays, hitsxdays ) values ( '$key', '$value', '$slogdate', '$value', '$xdate', '$value' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_modules set hits=hits+$value, today='$slogdate', hitstoday=hitstoday+$value, hitsxdays=hitsxdays+$value where modulename ='$key'" ); }
      }

      // Store Browser
      foreach( $MSAArrayBrowser as $key=>$value ) {
         $result = $db->sql_query( "select ibrowser from ".$prefix."_msanalysis_browsers where ibrowser = '$key'" );
         if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_browsers ( ibrowser, hits, today, hitstoday, xdays, hitsxdays ) values ( '$key', '$value', '$slogdate', '$value', '$xdate', '$value' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_browsers set hits=hits+$value, today='$slogdate', hitstoday=hitstoday+$value, hitsxdays=hitsxdays+$value where ibrowser = '$key'" ); }
      }

      // Store Operating System
      foreach( $MSAArrayOS as $key=>$value ) {
         $result = $db->sql_query( "select ios from ".$prefix."_msanalysis_os where ios = '$key'" );
         if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_os ( ios, hits, today, hitstoday, xdays, hitsxdays ) values ( '$key', '$value', '$slogdate', '$value', '$xdate', '$value' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_os set hits=hits+$value, today='$slogdate', hitstoday=hitstoday+$value, hitsxdays=hitsxdays+$value where ios = '$key'" ); }
      }

      // Store Countries
      foreach( $MSAArrayCountry as $key=>$value ) {
         $result = $db->sql_query( "select description from ".$prefix."_msanalysis_domains where domain = '$key'" );
         list( $description ) = $db->sql_fetchrow( $result );
         if( $description == "" ) { $description = "unknown"; $key = "unknown"; }

         $result1 = $db->sql_query( "select domain from ".$prefix."_msanalysis_countries where domain = '$key'" );
         if( $db->sql_numrows( $result1 ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_countries ( domain, description, hits, today, hitstoday, xdays, hitsxdays ) values ( '$key', '$description', '$value', '$slogdate', '$value', '$xdate', '$value' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_countries set hits=hits+$value, today='$slogdate', hitstoday=hitstoday+$value, hitsxdays=hitsxdays+$value where domain = '$key'" ); }
      }

      // Store User Information
      foreach( $MSAArrayUser as $key=>$value ) {
         $result = $db->sql_query( "select uname from ".$prefix."_msanalysis_users where uname = '$key'" );
         if( $db->sql_numrows( $result ) == 0 ) {
            $db->sql_query( "insert into ".$prefix."_msanalysis_users ( uname, browser, os, ip_addr, domain, host, time, hits, today, hitstoday, xdays, hitsxdays ) values ( '$key', '$value[browser]', '$value[os]', '$value[ip_addr]', '$value[domain]', '$value[host]', '$value[time]', '$value[hits]', '$slogdate', '$value[hits]', '$xdate', '$value[hits]' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_users set browser='$value[browser]', os='$value[os]', ip_addr='$value[ip_addr]', domain='$value[domain]', host='$value[host]', time='$value[time]', hits=hits+$value[hits], today='$slogdate', hitstoday=hitstoday+$value[hits], hitsxdays=hitsxdays+$value[hits] where uname='$key' " ); }
         $db->sql_freeresult( $result );
      }

      // Store Screen Resolution
      foreach( $MSAArrayScr_res as $key=>$value ) {
         $result = $db->sql_query( "select scr_res from ".$prefix."_msanalysis_scr where scr_res = '$key'" );
         if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_scr ( scr_res, hits, today, hitstoday, xdays, hitsxdays ) values ( '$key', '$value', '$slogdate', '$value', '$xdate', '$value' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_scr set hits=hits+$value, today='$slogdate', hitstoday=hitstoday+$value, hitsxdays=hitsxdays+$value where scr_res = '$key'" ); }
      }

      // Store Referral Name
      foreach( $MSAArrayRef as $key=>$value ) {
         $result = $db->sql_query( "select referral from ".$prefix."_msanalysis_referrals where referral = '$key'" );
         if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_referrals ( referral, hits, today, hitstoday, xdays, hitsxdays ) values ( '$key', '$value', '$slogdate', '$value', '$xdate', '$value' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_referrals set hits=hits+$value, today='$slogdate', hitstoday=hitstoday+$value, hitsxdays=hitsxdays+$value where referral = '$key'" ); }
         $db->sql_freeresult( $result );
      }

      // Store search engine search words
      foreach( $MSAArraySearch as $key=>$value ) {
         $result = $db->sql_query( "select words from ".$prefix."_msanalysis_search where words = '$key'" );
         if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_search ( words, hits, today, hitstoday, xdays, hitsxdays ) values ( '$key', '$value', '$slogdate', '$value', '$xdate', '$value' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_search set hits=hits+$value, today='$slogdate', hitstoday=hitstoday+$value, hitsxdays=hitsxdays+$value where words = '$key'" ); }
         $db->sql_freeresult( $result );
      }

      // Delete all records from table msanalysis_online
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_online" );
      $result = $db->sql_query( "DELETE QUICK FROM ".$prefix."_msanalysis_online" );
      $db->sql_freeresult( $result );
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_online" );

      unset( $MSAMaint );
      unset( $MSArobots );
      unset( $MSAArrayModule );
      unset( $MSAArrayBrowser );
      unset( $MSAArrayOS );
      unset( $MSAArrayCountry);
      unset( $MSAArrayUser );
      unset( $MSAArrayScr_res );
      unset( $MSAArrayRef );
      unset( $MSAArraySearch );
   }

   /******************************************************************************/
   /* Daily Maintenance                                                          */
   /******************************************************************************/
   function daily_maintenance( )
   {
      global $prefix, $db;

      $db->sql_query( "update ".$prefix."_msanalysis_countries set hitstoday=0" );
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_countries" );

      $db->sql_query( "update ".$prefix."_msanalysis_referrals set hitstoday=0" );
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_referrals" );

      $db->sql_query( "update ".$prefix."_msanalysis_search set hitstoday=0" );
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_search" );

      $db->sql_query( "update ".$prefix."_msanalysis_browsers set hitstoday=0" );
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_browsers" );

      $db->sql_query( "update ".$prefix."_msanalysis_os set hitstoday=0" );
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_os" );

      $db->sql_query( "update ".$prefix."_msanalysis_modules set hitstoday=0" );
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_modules" );

      $db->sql_query( "update ".$prefix."_msanalysis_users set hitstoday=0" );
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_users" );

      $db->sql_query( "update ".$prefix."_msanalysis_scr set hitstoday=0" );
      $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_scr" );

      // When function is invoked by a Dynamically set Site, then clear on-line table
      $result = $db->sql_query( "select staticupdate from ".$prefix."_msanalysis_admin where id='1'" );
      list( $staticupdate ) = $db->sql_fetchrow( $result );
      if( ! $staticupdate ) {
         // Delete all records from table msanalysis_online
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_online" );
         $result = $db->sql_query( "DELETE QUICK FROM ".$prefix."_msanalysis_online" );
         $db->sql_freeresult( $result );
         $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_online" );
      }
   }

   /******************************************************************************/
   /* Pruning Maintenance                                                        */
   /******************************************************************************/
   function pruning_maintenance( )
   {
      global $prefix, $db;

      // Set time limit and ignore user abort
      if( !get_cfg_var('safe_mode') )
      {
         @set_time_limit( 300 );
         @ignore_user_abort( 1 );
      }

      $result = $db->sql_query( "SELECT nbrdays, begindate, tcountries, treferrals, tsearcheng, tqueries, tbrowsers, tcrawlers, tos, tmodules, tusers, tresolution FROM ".$prefix."_msanalysis_admin where id='1'" );
      list( $nbrdays, $begindate, $tcountries, $treferrals, $tsearcheng, $tqueries, $tbrowsers, $tcrawlers, $tos, $tmodules, $tusers, $tresolution ) = $db->sql_fetchrow( $result );

      $daysold = $this->DaysOld( $begindate );
      // If defined amount of days are passed than prune MSA tables
      if( ( $daysold % $nbrdays ) == 0 )
      {
         // Prune Country Table
         $counter = 0;
         if( $tcountries > 0 ) {
            $result = $db->sql_query( "SELECT id FROM ".$prefix."_msanalysis_countries ORDER BY hits DESC" );
            while( ( list( $id ) = $db->sql_fetchrow( $result ) ) ) {
               if( $counter >= $tcountries ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_countries WHERE id='$id'" ); }
               $counter += 1;
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_countries" );
         }

         // Prune Referral Table
         $counter = 0;
         if( $treferrals > 0 ) {
            $result = $db->sql_query( "SELECT id, referral FROM ".$prefix."_msanalysis_referrals ORDER BY hits DESC" );
            while( list( $id, $referral ) = $db->sql_fetchrow( $result ) ) {
               if( $this->IsSearchEngine( $referral ) == 0 ) {
                  if( $counter >= $treferrals ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_referrals WHERE id='$id'" ); }
                  $counter += 1;
               }
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_referrals" );
         }

         // Prune Search Engines Table
         $counter = 0;
         if( $tsearcheng > 0 ) {
            $result = $db->sql_query( "SELECT id, referral FROM ".$prefix."_msanalysis_referrals ORDER BY hits DESC" );
            while( list( $id, $referral ) = $db->sql_fetchrow( $result ) ) {
               if( $this->IsSearchEngine( $referral ) == 1 ) {
                  if( $counter >= $treferrals ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_referrals WHERE id='$id'" ); }
                  $counter += 1;
               }
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_referrals" );
         }

         // Prune Search Words/Quey Words of searchengines Table
         $counter = 0;
         if( $tqueries > 0 ) {
            $result = $db->sql_query( "SELECT id FROM ".$prefix."_msanalysis_search ORDER BY hits DESC" );
            while( ( list( $id ) = $db->sql_fetchrow( $result ) ) ) {
               if( $counter >= $tqueries ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_search WHERE id='$id'" ); }
               $counter += 1;
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_search" );
         }

         // Prune Browsers Table
         $counter = 0;
         if( $tbrowsers > 0 ) {
            $result = $db->sql_query( "SELECT id, ibrowser FROM ".$prefix."_msanalysis_browsers ORDER BY hits DESC" );
            while( list( $id, $ibrowser ) = $db->sql_fetchrow( $result ) ) {
               if( !eregi( "Web Crawler", $ibrowser ) ) {
                  if( $counter >= $tbrowsers ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_browsers WHERE id='$id'" ); }
                  $counter += 1;
               }
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_browsers" );
         }

         // Prune Web Crawlers Table
         $counter = 0;
         if( $tcrawlers > 0 ) {
            $result = $db->sql_query( "SELECT id, ibrowser FROM ".$prefix."_msanalysis_browsers ORDER BY hits DESC" );
            while( list( $id, $ibrowser ) = $db->sql_fetchrow( $result ) ) {
               if( eregi( "Web Crawler", $ibrowser ) ) {
                  if( $counter >= $tcrawlers ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_browsers WHERE id='$id'" ); }
                  $counter += 1;
               }
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_browsers" );
         }

         // Prune Operating Systems Table
         $counter = 0;
         if( $tos > 0 ) {
            $result = $db->sql_query( "SELECT id FROM ".$prefix."_msanalysis_os ORDER BY hits DESC" );
            while( ( list( $id ) = $db->sql_fetchrow( $result ) ) ) {
               if( $counter >= $tos ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_os WHERE id='$id'" ); }
               $counter += 1;
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_os" );
         }

         // Prune Modules Table
         $counter = 0;
         if( $tmodules > 0 ) {
            $result = $db->sql_query( "SELECT id FROM ".$prefix."_msanalysis_modules ORDER BY hits DESC" );
            while( ( list( $id ) = $db->sql_fetchrow( $result ) ) ) {
               if( $counter >= $tmodules ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_modules WHERE id='$id'" ); }
               $counter += 1;
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_modules" );
         }

         // Prune Users Table
         $counter = 0;
         if( $tusers > 0 ) {
            $result = $db->sql_query( "SELECT uid FROM ".$prefix."_msanalysis_users ORDER BY hits DESC" );
            while( ( list( $uid ) = $db->sql_fetchrow( $result ) ) ) {
               if( $counter >= $tusers ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_users WHERE uid='$uid'" ); }
               $counter += 1;
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_users" );
         }

         // Prune Screen Resolution Table
         $counter = 0;
         if( $tresolution > 0 ) {
            $result = $db->sql_query( "SELECT id FROM ".$prefix."_msanalysis_scr ORDER BY hits DESC" );
            while( ( list( $id ) = $db->sql_fetchrow( $result ) ) ) {
               if( $counter >= $tresolution ) { $result1 = $db->sql_query( "DELETE FROM ".$prefix."_msanalysis_scr WHERE id='$id'" ); }
               $counter += 1;
            }
            $db->sql_freeresult( $result );
            $db->sql_query( "OPTIMIZE TABLE ".$prefix."_msanalysis_scr" );
         }
      }
   }

   /******************************************************************************/
   /* FUNCTION: get_browser()                                                    */
   /* Return users hostname                                                      */
   /******************************************************************************/
   function MSAget_browser( $agent )
   {
      // Opera (Disguised as MSIE)
      if( preg_match("/Opera ([0-9]\.[0-9]{0,2})/i", $agent, $found ) &&  strstr( $agent, "MSIE" ) ) $browser = "Opera " . $found[ 1 ];
      // Opera (Disguised as Netscape/Mozilla)
      else if( preg_match("/Opera ([0-9]\.[0-9]{0,2})/i", $agent, $found ) && strstr( $agent, "Mozilla" ) ) $browser = "Opera " . $found[ 1 ];
      // Opera (Itself)
      else if( preg_match("/Opera\/([0-9]\.[0-9]{0,2})/i", $agent, $found ) ) $browser = "Opera " . $found[ 1 ];
      // Netscape 6.x
      else if( preg_match("/Netscape[0-9]\/([0-9]{1,2}\.[0-9]{1,2})/i", $agent, $found ) ) $browser = "Netscape " . $found[ 1 ];
      // Netscape 7.x
      else if( preg_match("/Netscape\/([0-9]{1,2}\.[0-9]{1,2})/i", $agent, $found ) ) $browser = "Netscape " . $found[ 1 ];
      // NetCaptor
      else if( preg_match("/NetCaptor ([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})/i", $agent, $found ) ) $browser = $found[0];
      // Crazy Browser
      else if( preg_match("/Crazy Browser ([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})/i", $agent, $found ) ) $browser = $found[0];
      // MyIE2
      else if( preg_match("/MyIE2/i", $agent ) ) $browser = "MyIE2";
      // Maxthon
      else if( preg_match("/Maxthon/i", $agent ) ) $browser = "Maxthon";
      // WebTV
      else if( preg_match("/WebTV\/([0-9\.]{1,8})/i", $agent, $found ) ) $browser = "WebTV " . $found[ 1 ];
      // MSIE
      else if( preg_match("/MSIE ([0-9]{1,2}\.[0-9]{1,2})/i", $agent, $found ) ) $browser = $found[0];
      // Konqueror
      else if( preg_match("/Konqueror\/([0-9\.]{1,8})/i", $agent, $found ) ) $browser = "Konqueror " . $found[ 1 ];
      // Galeon
      else if( preg_match("/Galeon\/([0-9\.]{1,8})/i", $agent, $found ) ) $browser = "Galeon " . $found[ 1 ];
      // SeaMonkey
      else if( preg_match("/SeaMonkey\/([a-zA-Z0-9\.]{1,8})/i", $agent, $found ) ) $browser = "SeaMonkey " . $found[ 1 ];
      // Phoenix
      else if( preg_match("/Phoenix\/([0-9]{1}\.[0-9]{1,2})/i", $agent, $found ) ) $browser = "Phoenix " . $found[ 1 ];
      // Firebird
      else if( preg_match("/Firebird\/([0-9]{1}\.[0-9]{1,2})/i", $agent, $found ) ) $browser = "Firebird " . $found[ 1 ];
      // FireFox
      else if( preg_match("/Firefox\/([0-9\.]{1,8})/i", $agent, $found ) ) $browser = "Firefox " . $found[ 1 ];
      // Lynx
      else if( preg_match("/Lynx\/([0-9\.]{1,8})/i", $agent, $found ) ) $browser = "Lynx " . $found[ 1 ];
      // IBrowse
      else if( preg_match("/IBrowse ([0-9]{1,2}\.[0-9]{1,2})/i", $agent, $found ) ) $browser = "IBrowse " . $found[ 1 ];
      // Voyager
      else if( preg_match("/Voyager/i", $agent, $found ) ) $browser = "Voyager " . $found[ 1 ];
      // Safari
      else if( preg_match("/Safari/i", $agent, $found ) ) $browser = "Safari " . $found[ 1 ];
      // iCab
      else if( preg_match("/iCab ([0-9]{1,2})/i", $agent, $found ) ) $browser = "iCab " . $found[ 1 ];
      // NetPositive
      else if( preg_match("/NetPositive\/([0-9]{1,2})/i", $agent, $found ) ) $browser = "NetPositive " . $found[ 1 ];
      // Web Crawler
      else if( $this->MSAchk_crawler( $agent ) ) $browser = "Web Crawler - " . $agent;
      // Netscape 4.x
      else if( preg_match("/Mozilla\/([0-9]{1}\.[0-9]{1,2}) \[en\]/i", $agent, $found ) ) $browser = "Netscape " . $found[ 1 ];
      // A different definition of Mozilla browsers
      else if( preg_match("/Mozilla\/([0-9]{1,2}\.[0-9]{1,2})/i", $agent, $found ) ) $browser = "Mozilla " . $found[ 1 ];
      // Mozilla
      else if( preg_match("/(^Mozilla)(.)*\;\srv:([0-9]\.[0-9])/i", $agent, $found ) ) $browser = $found[ 1 ] . " " . $found[ 3 ];
      // Other (Dont know what it is)
      else $browser = "Other";

      return( $browser );
   }

   /*****************************************************************/
   /* function function chk_crawler()                               */
   /*****************************************************************/
   function MSAchk_crawler( $agent )
   {
      foreach( $this->robots as $value )
         if( preg_match("/" . $value . "/i", $agent ) ) return true;
      return false;
   }

   /******************************************************************************/
   /* FUNCTION: get_host()                                                       */
   /* Return users hostname                                                      */
   /******************************************************************************/
   function MSAget_os( $agent )
   {
      // Determine the platform they are on
      if( strstr( $agent, "Win") )
      {
         $platform = "Windows";
         if ( preg_match("/Windows NT 5\.1/i", $agent ) ) $platform = "Windows XP";
         else if( preg_match("/Windows NT 5\.2/i", $agent ) ) $platform = "Windows 2003";
         else if( preg_match("/Windows NT 5\.0/i", $agent ) ) $platform = "Windows 2000";
         else if( preg_match("/Windows NT/i", $agent ) ) $platform = "Windows NT";
         else if( preg_match("/WinNT/i", $agent ) ) $platform = "Windows NT";
         else if( preg_match("/Windows ME/i", $agent ) ) $platform = "Windows ME";
         else if( preg_match("/Win 9x 4.90/i", $agent ) ) $platform = "Windows ME";
         else if( preg_match("/Windows ME/i", $agent ) ) $platform = "Windows ME";
         else if( preg_match("/Windows CE/i", $agent ) ) $platform = "Windows CE";
         else if( preg_match("/98/i", $agent ) ) $platform = "Windows 98";
         else if( preg_match("/95/i", $agent ) ) $platform = "Windows 95";
         else if( preg_match("/Win16/i", $agent ) ) $platform = "Windows 3.1";
         else if( preg_match("/Windows 3\.1/i", $agent ) ) $platform = "Windows 3.1";
      }
      else if(strstr($agent, "Mac" ) ) $platform = "Macintosh";
      else if(strstr($agent, "PPC" ) ) $platform = "Macintosh";
      else if(strstr($agent, "FreeBSD" ) ) $platform = "FreeBSD";
      else if(strstr($agent, "SunOS" ) ) $platform = "SunOS";
      else if(strstr($agent, "IRIX" ) ) $platform = "IRIX";
      else if(strstr($agent, "BeOS" ) ) $platform = "BeOS";
      else if(strstr($agent, "OS/2" ) ) $platform = "OS/2";
      else if(strstr($agent, "AIX" ) ) $platform = "AIX";
      else if(strstr($agent, "Linux" ) ) $platform = "Linux";
      else if(strstr($agent, "Unix" ) ) $platform = "Unix";
      else if(strstr($agent, "Amiga" ) ) $platform = "Amiga";
      else $platform = "Other";
      return( $platform );
   }

   /******************************************************************************/
   /* FUNCTION: IsSearchEngine( $referral )                                      */
   /* Return 1 if $referral is a Search Engine else 0                            */
   /******************************************************************************/
   function IsSearchEngine( $referral )
   {
      global $MSSearchEngines;
      $se = 0;
      foreach( $MSSearchEngines as $key=>$value ) { if( eregi( $key, $referral ) ) { $se = 1; } }
      return( $se );
   }

   /******************************************************************************/
   /* FUNCTION: GetSearchWords                                                   */
   /* Return searchwords                                                         */
   /******************************************************************************/
   function MSAGetSearchWords( $sestring, $onlyhost, $search_store )
   {
      global $MSSearchEngines;
      $searchwords = "";
      foreach( $MSSearchEngines as $key=>$value ) {
         if( eregi( $key, $onlyhost ) ) {
            $asestring = explode( "&", $sestring );
            for( $j = 0; $j < sizeof( $asestring ); $j++ )
            {
               $asestring[ $j ] = ereg_replace ('amp;', '', trim( $asestring[ $j ] ) );
               $fquery = explode( "=" , $asestring[ $j ] );
               if( $fquery[ 0 ] == $value ) {
                  $searchwords = trim( strtolower( $fquery[ 1 ] ) );
                  $searchwords = str_replace( array('%3d','%27'), array('',''), $searchwords );
                  $searchwords = str_replace( array('=','\''), array('',''), $searchwords );
                  $searchwords = urldecode( $searchwords );
                  $searchwords = str_replace( ",", "", $searchwords );
                  if( $search_store ) $searchwords = str_replace( "+", " ", $searchwords );
                  break;
               }
            } // END sizeof( $asestring )
         } // END eregi
      }
      return( $searchwords );
   } // END Function

   /******************************************************************************/
   /* FUNCTION: MSLogDate( $longshort)                                           */
   /* Return GMT adapted lgdate                                                  */
   /******************************************************************************/
   function MSLogDate( $longshort )
   {
      global $prefix, $db;

      $result = $db->sql_query( "select GMT_offset from ".$prefix."_msanalysis_admin where id='1'" );
      list( $GMT_offset ) = $db->sql_fetchrow( $result );
      $current = date( "Z" ) / 3600;
      $current = -1 * $current;
      $zonedate = mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y'), -1) + ( ( $current + $GMT_offset ) * 3600 );

      if( $longshort == 0 ) return date( "Y-m-d H:i:s", $zonedate );
      elseif( $longshort == 1 ) return date( "Y-m-d", $zonedate );
      elseif( $longshort == 2 ) return ( $zonedate );
      elseif( $longshort == 3 ) return date( "d-m-Y-H", $zonedate );
   }

   /******************************************************************************/
   /* FUNCTION: DaysOld( $enterdate )                                            */
   /* Return how many days ago a user was on-line                                */
   /******************************************************************************/

   function DaysOld( $enterdate )
   {
      $enterdate = substr( $enterdate, 0, 10 ) . " 00:00:00";
      $date_secs = strtotime( $enterdate );
      // get the value of right now
      $now = $this->MSLogDate( 2 );
      // compute the difference (seconds)
      $timediff = $date_secs - $now;
      //get the int val of the days passed
      $dayspassed = intval( abs( ( ( ( $timediff / 60 ) / 60 ) / 24 ) ) );
      return( $dayspassed );
   }


}

?>
