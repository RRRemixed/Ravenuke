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

class msa_dynamicadd
{

   var $robots;

   /******************************************************************************/
   /* Constructor for this Class                                                 */
   /******************************************************************************/
   function msa_dynamicadd()
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
   function hourly_dynamicadd( $MSAlogdate, $MSAslogdate, $MSAuname, $MSAagent, $MSAip_addr, $MSAhost, $MSAdomain, $MSAmodulename, $MSAscr_res, $MSAreferral, $MSArefstr )
   {
      global $prefix, $db;

      // Load Admin Settings
      $result = $db->sql_query( "select search_store, xdate, msaurl from ".$prefix."_msanalysis_admin where id='1'" );
      list( $search_store, $xdate, $msaurl ) = $db->sql_fetchrow( $result );

         // Get browser name
         $MSAbrowser = $this->MSAget_browser( $MSAagent );
         // Get Operating System Name
         $MSAos = $this->MSAget_os( $MSAagent );

         // Store Module Name
         if( $MSAmodulename != "" ) {
            $result = $db->sql_query( "select modulename from ".$prefix."_msanalysis_modules where modulename = '$MSAmodulename'" );
            if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_modules ( modulename, hits, today, hitstoday, xdays, hitsxdays ) values ( '$MSAmodulename', '1', '$MSAslogdate', '1', '$xdate', '1' )" ); }
            else { $db->sql_query( "update ".$prefix."_msanalysis_modules set hits=hits+1, today='$MSAslogdate', hitstoday=hitstoday+1, hitsxdays=hitsxdays+1 where modulename ='$MSAmodulename'" ); }
         }
         // Store Browser
         if( $MSAbrowser == "" ) $MSAbrowser = "Other - Unknown";
         $result = $db->sql_query( "select ibrowser from ".$prefix."_msanalysis_browsers where ibrowser = '$MSAbrowser'" );
         if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_browsers ( ibrowser, hits, today, hitstoday, xdays, hitsxdays ) values ( '$MSAbrowser', '1', '$MSAslogdate', '1', '$xdate', '1' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_browsers set hits=hits+1, today='$MSAslogdate', hitstoday=hitstoday+1, hitsxdays=hitsxdays+1 where ibrowser = '$MSAbrowser'" ); }
         // Store Operating System
         if( $MSAos == "" ) $MSAos = "Other - Unknown";
         $result = $db->sql_query( "select ios from ".$prefix."_msanalysis_os where ios = '$MSAos'" );
         if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_os ( ios, hits, today, hitstoday, xdays, hitsxdays ) values ( '$MSAos', '1', '$MSAslogdate', '1', '$xdate', '1' )" ); }
         else { $db->sql_query( "update ".$prefix."_msanalysis_os set hits=hits+1, today='$MSAslogdate', hitstoday=hitstoday+1, hitsxdays=hitsxdays+1 where ios = '$MSAos'" ); }
         // Store Countries
         if( $MSAdomain != "" ) {
            $result = $db->sql_query( "select description from ".$prefix."_msanalysis_domains where domain = '$MSAdomain'" );
            list( $description ) = $db->sql_fetchrow( $result );
            if( $description == "" ) { $description = "unknown"; $MSAdomain = "unknown"; }

            $result1 = $db->sql_query( "select domain from ".$prefix."_msanalysis_countries where domain = '$MSAdomain'" );
            if( $db->sql_numrows( $result1 ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_countries ( domain, description, hits, today, hitstoday, xdays, hitsxdays ) values ( '$MSAdomain', '$description', '1', '$MSAslogdate', '1', '$xdate', '1' )" ); }
            else { $db->sql_query( "update ".$prefix."_msanalysis_countries set hits=hits+1, today='$MSAslogdate', hitstoday=hitstoday+1, hitsxdays=hitsxdays+1 where domain = '$MSAdomain'" ); }
         } else { $description = "unknown"; $MSAdomain = "unknown"; }
         // Store User Information
         if( $MSAuname != "Guest" ) {
            $result = $db->sql_query( "select uname from ".$prefix."_msanalysis_users where uname = '$MSAuname'" );
            if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_users ( uname, browser, os, ip_addr, domain, host, time, hits, today, hitstoday, xdays, hitsxdays ) values ( '$MSAuname', '$MSAbrowser', '$MSAos', '$MSAip_addr', '$MSAdomain', '$MSAhost', '$MSAlogdate', '1', '$MSAslogdate', '1', '$xdate', '1' )" ); }
            else { $db->sql_query( "update ".$prefix."_msanalysis_users set browser='$MSAbrowser', os='$MSAos', ip_addr='$MSAip_addr', domain='$MSAdomain', host='$MSAhost', time='$MSAlogdate', hits=hits+1, today='$MSAslogdate', hitstoday=hitstoday+1, hitsxdays=hitsxdays+1 where uname='$MSAuname' " ); }
            $db->sql_freeresult( $result );
         }
         // Store Screen Resolution
         if( $MSAscr_res != "" ) {
            $result = $db->sql_query( "select scr_res from ".$prefix."_msanalysis_scr where scr_res = '$MSAscr_res'" );
            if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_scr ( scr_res, hits, today, hitstoday, xdays, hitsxdays ) values ( '$MSAscr_res', '1', '$MSAslogdate', '1', '$xdate', '1' )" ); }
            else { $db->sql_query( "update ".$prefix."_msanalysis_scr set hits=hits+1, today='$MSAslogdate', hitstoday=hitstoday+1, hitsxdays=hitsxdays+1 where scr_res = '$MSAscr_res'" ); }
         }
         // Store Referral Name
         if( $MSAreferral != "" ) {
            if( !eregi( $MSAreferral, $msaurl ) )  {
               $result = $db->sql_query( "select referral from ".$prefix."_msanalysis_referrals where referral = '$MSAreferral'" );
               if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_referrals ( referral, hits, today, hitstoday, xdays, hitsxdays ) values ( '$MSAreferral', '1', '$MSAslogdate', '1', '$xdate', '1' )" ); }
               else { $db->sql_query( "update ".$prefix."_msanalysis_referrals set hits=hits+1, today='$MSAslogdate', hitstoday=hitstoday+1, hitsxdays=hitsxdays+1 where referral = '$MSAreferral'" ); }
               $db->sql_freeresult( $result );

               if( $this->IsSearchEngine( $MSAreferral ) == 1 ) {
                  $searchwords = $this->MSAGetSearchWords( $MSArefstr, $MSAreferral, $search_store );
                  if( $searchwords != "" ) {
                     if( $search_store ) {
                        $searchwords = explode( " ", $searchwords );
                        for( $i = 0; $i < sizeof( $searchwords ); $i++ )
                        {
	                   $sw = trim( $searchwords[ $i ] );
                           if( $sw != "" ) {
                              $sw = addslashes( $sw );
                              $result = $db->sql_query( "select words from ".$prefix."_msanalysis_search where words = '$sw'" );
                              if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_search ( words, hits, today, hitstoday, xdays, hitsxdays ) values ( '$sw', '1', '$MSAslogdate', '1', '$xdate', '1' )" ); }
                              else { $db->sql_query( "update ".$prefix."_msanalysis_search set hits=hits+1, today='$MSAslogdate', hitstoday=hitstoday+1, hitsxdays=hitsxdays+1 where words = '$sw'" ); }
                              $db->sql_freeresult( $result );
                           }
                        }
                     }
                     else {
                        $searchwords = addslashes( $searchwords );
                        $result = $db->sql_query( "select words from ".$prefix."_msanalysis_search where words = '$searchwords'" );
                        if( $db->sql_numrows( $result ) == 0 ) { $db->sql_query( "insert into ".$prefix."_msanalysis_search ( words, hits, today, hitstoday, xdays, hitsxdays ) values ( '$searchwords', '1', '$MSAslogdate', '1', '$xdate', '1' )" ); }
                        else { $db->sql_query( "update ".$prefix."_msanalysis_search set hits=hits+1, today='$MSAslogdate', hitstoday=hitstoday+1, hitsxdays=hitsxdays+1 where words = '$searchwords'" ); }
                        $db->sql_freeresult( $result );
                     }
                  }
               }
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

}

?>
