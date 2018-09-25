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
/* PHP-NUKE: Web Portal System                                                      */
/* ===========================                                                      */
/*                                                                                  */
/* Copyright (c) 2002 by Francisco Burzi                                            */
/* http://phpnuke.org                                                               */
/*                                                                                  */
/* MostMonth /MostDay / MostHour Routines are from PHP-Nuke 6.0 Statistics          */
/*                                                                                  */
/************************************************************************************/
require_once( dirname(__FILE__) . '/class.maintenance.php' );    // Routine Classes for tracker

class msanalysis
{
    var $l_size;
    var $m_size;
    var $r_size;

    /******************************************************************************/
    /* Constructor for this Class                                                 */
    /******************************************************************************/
    function msanalysis()
    {
       global $ThemeSel;

       $this->l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
       $this->m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
       $this->r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    }

    /******************************************************************************/
    /* FUNCTION: IsSearchEngine( $referral )                                      */
    /* Return 1 if $referral is a Search Engine else 0                            */
    /******************************************************************************/
    function IsSearchEngine( $referral )
    {
	    return( msa_maintenance::IsSearchEngine( $referral ) );
    }

    /******************************************************************************/
    /* FUNCTION: ResetTodayHits()                                                 */
    /* Reset the hits of last day                                                 */
    /******************************************************************************/
    function ResetTodayHits( )
    {
       msa_maintenance::daily_maintenance( );
    }

    /******************************************************************************/
    /* FUNCTION: MSAnalysisDaysOld( $enterdate )                                  */
    /* Return how many days ago a user was on-line                                */
    /******************************************************************************/
    function DaysOld( $enterdate )
    {
       return( msa_maintenance::DaysOld( $enterdate ) );
    }

    /******************************************************************************/
    /* FUNCTION: MSLogDate( $longshort)                                           */
    /* Return GMT adapted lgdate                                                  */
    /******************************************************************************/
    function MSLogDate( $longshort )
    {
       return( msa_maintenance::MSLogDate( $longshort ) );
    }

    /******************************************************************************/
    /* FUNCTION: MSAnalysisMinutesOld( $enterdate )                               */
    /* Return a time difference in Minutes                                        */
    /******************************************************************************/
    function MinutesOld( $enterdate )
    {
       $date_secs = strtotime( $enterdate );
       // get the value of right now
       $now = $this->MSLogDate( 2 );
       // compute the difference (seconds)
       $timediff = $date_secs - $now;
       //get the int val of the days passed
       $minutespassed = intval( abs( ( $timediff / 60 ) ) );
       return( $minutespassed );
    } // END function MSAnalysisMinutesOld( $enterdate )

    /******************************************************************************/
    /* FUNCTION: GetBrowserPicture( $ibrowser )                                   */
    /* Return name of browser image to display                                    */
    /******************************************************************************/
    function GetBrowserPicture( $ibrowser )
    {
       if( eregi( "msie", $ibrowser ) )               { $sym = "msie";          }
       else if( eregi( "netcaptor", $ibrowser ) )     { $sym = "netcaptor";     }
       else if( eregi( "crazy browser", $ibrowser ) ) { $sym = "crazy browser"; }
       else if( eregi( "konqueror", $ibrowser ) )     { $sym = "konqueror";     }
       else if( eregi( "netscape", $ibrowser ) )      { $sym = "netscape";      }
       else if( eregi( "opera", $ibrowser ) )         { $sym = "opera";         }
       else if( eregi( "webtv", $ibrowser ) )         { $sym = "webtv";         }
       else if( eregi( "lynx", $ibrowser ) )          { $sym = "lynx";          }
       else if( eregi( "mozilla", $ibrowser ) )       { $sym = "mozilla";       }
       else if( eregi( "galeon", $ibrowser ) )        { $sym = "galeon";        }
       else if( eregi( "phoenix", $ibrowser ) )       { $sym = "phoenix";       }
       else if( eregi( "seamonkey", $ibrowser ) )     { $sym = "seamonkey";     }
       else if( eregi( "firebird", $ibrowser ) )      { $sym = "firebird";      }
       else if( eregi( "firefox", $ibrowser ) )       { $sym = "firefox";       }
       else if( eregi( "myie2", $ibrowser ) )         { $sym = "myie2";         }
       else if( eregi( "maxthon", $ibrowser ) )       { $sym = "maxthon";       }
       else if( eregi( "IBrowse", $ibrowser ) )       { $sym = "ibrowse";       }
       else if( eregi( "Voyager", $ibrowser ) )       { $sym = "voyager";       }
       else if( eregi( "iCab", $ibrowser ) )          { $sym = "icab";          }
       else if( eregi( "NetPositive", $ibrowser ) )   { $sym = "netpositive";   }
       else if( eregi( "safari", $ibrowser ) )        { $sym = "safari";        }
       else                                           { $sym = "blank";         }

       return( $sym );
    }

    /******************************************************************************/
    /* FUNCTION: CountBrowserTypes( )                                             */
    /* Count the browsers per type                                                */
    /******************************************************************************/
    function CountBrowserTypes( $overview, $DateToday, $xdate )
    {
       global $db, $prefix;
       $sym1 = 0; $sym2 = 0; $sym3 = 0; $sym4 = 0; $sym5 = 0; $sym6 = 0; $sym7 = 0; $sym8 = 0; $sym9 = 0; $sym10 = 0; $sym11 = 0; $sym12 = 0; $sym13 = 0; $sym14 = 0; $sym15 = 0; $sym16 = 0; $sym17 = 0; $sym18 = 0; $sym19 = 0; $sym20 = 0; $sym21 = 0;
       if( $overview == 1 ) $result = $db->sql_query( "select id, ibrowser, hitstoday from ".$prefix."_msanalysis_browsers WHERE today='$DateToday' order by hitstoday DESC" );
       elseif( $overview == 2 ) $result = $db->sql_query( "select id, ibrowser, hitsxdays from ".$prefix."_msanalysis_browsers WHERE xdays='$xdate' order by hitsxdays DESC" );
       else $result = $db->sql_query( "select id, ibrowser, hits from ".$prefix."_msanalysis_browsers order by hits DESC" );
       while( ( list( $id, $ibrowser, $hits ) = $db->sql_fetchrow( $result ) ) ) {
          if( ! eregi( "Web Crawler", $ibrowser ) ) {
             if( eregi( "msie", $ibrowser ) )               { $sym1  = $sym1  + $hits; }
	           else if( eregi( "netcaptor", $ibrowser ) )     { $sym2  = $sym2  + $hits; }
	           else if( eregi( "crazy browser", $ibrowser ) ) { $sym3  = $sym3  + $hits; }
	           else if( eregi( "konqueror", $ibrowser ) )     { $sym4  = $sym4  + $hits; }
             else if( eregi( "netscape", $ibrowser ) )      { $sym5  = $sym5  + $hits; }
	           else if( eregi( "opera", $ibrowser ) )         { $sym6  = $sym6  + $hits; }
             else if( eregi( "webtv", $ibrowser ) )         { $sym7  = $sym7  + $hits; }
	           else if( eregi( "lynx", $ibrowser ) )          { $sym8  = $sym8  + $hits; }
	           else if( eregi( "mozilla", $ibrowser ) )       { $sym9  = $sym9  + $hits; }
             else if( eregi( "galeon", $ibrowser ) )        { $sym10 = $sym10 + $hits; }
             else if( eregi( "phoenix", $ibrowser ) )       { $sym11 = $sym11 + $hits; }
             else if( eregi( "seamonkey", $ibrowser ) )     { $sym12 = $sym12 + $hits; }
             else if( eregi( "firebird", $ibrowser ) )      { $sym13 = $sym13 + $hits; }
             else if( eregi( "firefox", $ibrowser ) )       { $sym14 = $sym14 + $hits; }
             else if( eregi( "myie2", $ibrowser ) )         { $sym15 = $sym15 + $hits; }
             else if( eregi( "maxthon", $ibrowser ) )       { $sym16 = $sym16 + $hits; }
             else if( eregi( "IBrowse", $ibrowser ) )       { $sym17 = $sym17 + $hits; }
             else if( eregi( "Voyager", $ibrowser ) )       { $sym18 = $sym18 + $hits; }
             else if( eregi( "iCab", $ibrowser ) )          { $sym19 = $sym19 + $hits; }
             else if( eregi( "NetPositive", $ibrowser ) )   { $sym20 = $sym20 + $hits; }
             else if( eregi( "safari", $ibrowser ) )        { $sym21 = $sym21 + $hits; }
          }
       }
       return( "43|$sym1|MSIE|$sym2|NetCaptor|$sym3|Crazy Browser|$sym4|Konqueror|$sym5|Netscape|$sym6|Opera|$sym7|Webtv|$sym8|Lynx|$sym9|Mozilla|$sym10|Galeon|$sym11|Phoenix|$sym12|SeaMonkey|$sym13|Firebird|$sym14|Firefox|$sym15|MyIE2|$sym16|Maxthon|$sym17|IBrowse|$sym18|Voyager|$sym19|iCab|$sym20|NetPositive|$sym21|Safari" );
    }

    /******************************************************************************/
    /* FUNCTION: GetOSPicture( $ios )                                             */
    /* Return name of operating image to display                                  */
    /******************************************************************************/
    function GetOSPicture( $ios )
    {
       if( eregi( "Macintosh", $ios ) )    { $sym = "mac";     }
  	    else if( eregi( "FreeBSD", $ios ) ) { $sym = "bsd";     }
	    else if( eregi( "SunOS", $ios ) )   { $sym = "sun";     }
	    else if( eregi( "IRIX", $ios ) )    { $sym = "irix";    }
	    else if( eregi( "BeOS", $ios ) )    { $sym = "be";      }
	    else if( eregi( "OS/2", $ios ) )    { $sym = "os2";     }
	    else if( eregi( "AIX", $ios ) )     { $sym = "aix";     }
	    else if( eregi( "Amiga", $ios ) )   { $sym = "amiga";   }
	    else if( eregi( "Linux", $ios ) )   { $sym = "linux";   }
	    else if( eregi( "Unix", $ios ) )    { $sym = "linux";   }
	    else if( eregi( "Windows", $ios ) ) { $sym = "windows"; }
	    else                                { $sym = "blank";   }

	   return( $sym );
	}

   /******************************************************************************/
   /* FUNCTION: GetMonth()                                                       */
   /* Convert month number to text month                                         */
   /******************************************************************************/
   function GetMonth( $month )
   {
      if ($month == 1)  return ""._MSA_JANUARY."";
      if ($month == 2)  return ""._MSA_FEBRUARY."";
      if ($month == 3)  return ""._MSA_MARCH."";
      if ($month == 4)  return ""._MSA_APRIL."";
      if ($month == 5)  return ""._MSA_MAY."";
      if ($month == 6)  return ""._MSA_JUNE."";
      if ($month == 7)  return ""._MSA_JULY."";
      if ($month == 8)  return ""._MSA_AUGUST."";
      if ($month == 9)  return ""._MSA_SEPTEMBER."";
      if ($month == 10) return ""._MSA_OCTOBER."";
      if ($month == 11) return ""._MSA_NOVEMBER."";
      if ($month == 12) return ""._MSA_DECEMBER."";
   } // End function GetMonth()

   /******************************************************************************/
   /* FUNCTION: TotalHits                                                        */
   /* Return total amount of hits for a certain overview                         */
   /******************************************************************************/
   function TotalHits( $screen, $overview, $DateToday, $xdate )
   {
      global $db, $prefix;
      $counter = 0;
      switch( $screen )
      {
         case 1:
            if( $overview == 1 ) $result = $db->sql_query( "select hitstoday from ".$prefix."_msanalysis_countries WHERE today='$DateToday'" );
            elseif( $overview == 2 ) $result = $db->sql_query( "select hitsxdays from ".$prefix."_msanalysis_countries WHERE xdays='$xdate'" );
            else $result = $db->sql_query( "select hits from ".$prefix."_msanalysis_countries" );
            while( list( $hits ) = $db->sql_fetchrow( $result ) ) $counter = $counter + $hits;
         break;
         case 2:
            if( $overview == 1 ) $result = $db->sql_query( "select referral, hitstoday from ".$prefix."_msanalysis_referrals WHERE today='$DateToday'" );
            elseif( $overview == 2 ) $result = $db->sql_query( "select referral, hitsxdays from ".$prefix."_msanalysis_referrals WHERE xdays='$xdate'" );
            else $result = $db->sql_query( "select referral, hits from ".$prefix."_msanalysis_referrals" );
            while(list( $referral, $hits ) = $db->sql_fetchrow( $result ) ) {
	           if( $this->IsSearchEngine( $referral ) == 0 ) { $counter = $counter + $hits; }
            }
	     break;
         case 3:
            if( $overview == 1 ) $result = $db->sql_query( "select referral, hitstoday from ".$prefix."_msanalysis_referrals WHERE today='$DateToday'" );
            elseif( $overview == 2 ) $result = $db->sql_query( "select referral, hitsxdays from ".$prefix."_msanalysis_referrals WHERE xdays='$xdate'" );
            else $result = $db->sql_query( "select referral, hits from ".$prefix."_msanalysis_referrals" );
            while(list( $referral, $hits ) = $db->sql_fetchrow( $result ) ) {
	           if( $this->IsSearchEngine( $referral ) == 1 ) { $counter = $counter + $hits; }
            }
	     break;
         case 4:
            if( $overview == 1 ) $result = $db->sql_query( "select ibrowser, hitstoday from ".$prefix."_msanalysis_browsers WHERE today='$DateToday'" );
            elseif( $overview == 2 ) $result = $db->sql_query( "select ibrowser, hitsxdays from ".$prefix."_msanalysis_browsers WHERE xdays='$xdate'" );
            else $result = $db->sql_query( "select ibrowser, hits from ".$prefix."_msanalysis_browsers" );
            while( list( $ibrowser, $hits ) = $db->sql_fetchrow( $result ) ) {
               if( ! eregi( "Web Crawler", $ibrowser ) ) { $counter = $counter + $hits; }
            }
	     break;
         case 5:
            if( $overview == 1 ) $result = $db->sql_query( "select hitstoday from ".$prefix."_msanalysis_os WHERE today='$DateToday'" );
            elseif( $overview == 2 ) $result = $db->sql_query( "select hitsxdays from ".$prefix."_msanalysis_os WHERE xdays='$xdate'" );
            else $result = $db->sql_query( "select hits from ".$prefix."_msanalysis_os" );
            while( list( $hits ) = $db->sql_fetchrow( $result ) ) $counter = $counter + $hits;
            break;
         case 6:
            if( $overview == 1 ) $result = $db->sql_query( "select hitstoday from ".$prefix."_msanalysis_modules WHERE today='$DateToday'" );
            elseif( $overview == 2 ) $result = $db->sql_query( "select hitsxdays from ".$prefix."_msanalysis_modules WHERE xdays='$xdate'" );
            else $result = $db->sql_query( "select hits from ".$prefix."_msanalysis_modules" );
            while( list( $hits ) = $db->sql_fetchrow( $result ) ) $counter = $counter + $hits;
            break;
         case 8:
            if( $overview == 1 ) $result = $db->sql_query( "select hitstoday from ".$prefix."_msanalysis_search WHERE today='$DateToday'" );
            elseif( $overview == 2 ) $result = $db->sql_query( "select hitsxdays from ".$prefix."_msanalysis_search WHERE xdays='$xdate'" );
            else $result = $db->sql_query( "select hits from ".$prefix."_msanalysis_search" );
            while( list( $hits ) = $db->sql_fetchrow( $result ) ) $counter = $counter + $hits;
	     break;
         case 9:
            if( $overview == 1 ) $result = $db->sql_query( "select hitstoday from ".$prefix."_msanalysis_scr WHERE today='$DateToday'" );
            elseif( $overview == 2 ) $result = $db->sql_query( "select hitsxdays from ".$prefix."_msanalysis_scr WHERE xdays='$xdate'" );
            else $result = $db->sql_query( "select hits from ".$prefix."_msanalysis_scr" );
            while( list( $hits ) = $db->sql_fetchrow( $result ) ) $counter = $counter + $hits;
            break;
      }

      if( $counter == 0 ) $counter = 1;
      return $counter;
   } // END function TotalHits( $screen, $overview, $DateToday, $xdate )

   /******************************************************************************/
   /* FUNCTION: CountLines                                                       */
   /* Return total amount of Data Lines for Countries, Users, etc                */
   /******************************************************************************/
   function CountLines( $screen, $overview, $DateToday, $xdate )
   {
      global $db, $prefix;
      $counter = 0;
      switch( $screen )
      {
         case 1:
            if( $overview == 1 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_countries WHERE today='$DateToday' AND hitstoday > 0") );
            elseif( $overview == 2 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_countries WHERE xdays='$xdate' AND hitsxdays > 0") );
            else $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_countries" ) );
         break;
         case 2:
            if( $overview == 1 ) {
               $result = $db->sql_query( "select referral from ".$prefix."_msanalysis_referrals WHERE today='$DateToday' AND hitstoday > 0");
               while( list( $referral ) = $db->sql_fetchrow( $result ) ) { if( $this->IsSearchEngine( $referral ) == 0 ) { $counter += 1; } }
            }
            elseif( $overview == 2 ) {
               $result = $db->sql_query( "select referral from ".$prefix."_msanalysis_referrals WHERE xdays='$xdate' AND hitsxdays > 0");
               while( list( $referral ) = $db->sql_fetchrow( $result ) ) { if( $this->IsSearchEngine( $referral ) == 0 ) { $counter += 1; } }
            }
            else {
               $result = $db->sql_query( "select referral from ".$prefix."_msanalysis_referrals" );
               while( list( $referral ) = $db->sql_fetchrow( $result ) ) { if( $this->IsSearchEngine( $referral ) == 0 ) { $counter += 1; } }
            }
	      break;
         case 3:
            if( $overview == 1 ) {
               $result = $db->sql_query( "select referral from ".$prefix."_msanalysis_referrals WHERE today='$DateToday' AND hitstoday > 0");
               while( (list( $referral ) = $db->sql_fetchrow( $result ) ) ) { if( $this->IsSearchEngine( $referral ) == 1 ) { $counter += 1; } }
            }
            elseif( $overview == 2 ) {
               $result = $db->sql_query( "select referral from ".$prefix."_msanalysis_referrals WHERE xdays='$xdate' AND hitsxdays > 0");
               while( (list( $referral ) = $db->sql_fetchrow( $result ) ) ) { if( $this->IsSearchEngine( $referral ) == 1 ) { $counter += 1; } }
            }
            else {
               $result = $db->sql_query( "select referral from ".$prefix."_msanalysis_referrals" );
               while( (list( $referral ) = $db->sql_fetchrow( $result ) ) ) { if( $this->IsSearchEngine( $referral ) == 1 ) { $counter += 1; } }
            }
 	      break;
         case 4:
            if( $overview == 1 ) {
               $result = $db->sql_query( "select ibrowser from ".$prefix."_msanalysis_browsers WHERE today='$DateToday' AND hitstoday > 0");
               while( ( list( $ibrowser ) = $db->sql_fetchrow( $result ) ) ) { if( !eregi( "Web Crawler", $ibrowser ) ) { $counter += 1; } }
            }
            elseif( $overview == 2 ) {
               $result = $db->sql_query( "select ibrowser from ".$prefix."_msanalysis_browsers WHERE xdays='$xdate' AND hitsxdays > 0");
               while( ( list( $ibrowser ) = $db->sql_fetchrow( $result ) ) ) { if( !eregi( "Web Crawler", $ibrowser ) ) { $counter += 1; } }
            }
            else {
               $result = $db->sql_query( "select ibrowser from ".$prefix."_msanalysis_browsers" );
               while( ( list( $ibrowser ) = $db->sql_fetchrow( $result ) ) ) { if( !eregi( "Web Crawler", $ibrowser ) ) { $counter += 1; } }
            }
         break;
         case 5:
            if( $overview == 1 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_os WHERE today='$DateToday' AND hitstoday > 0") ) - $db->sql_numrows( $db->sql_query( "select ios from ".$prefix."_msanalysis_os WHERE today='$DateToday' AND hitstoday > 0 AND ios='0'" ) );
            elseif( $overview == 2 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_os WHERE xdays='$xdate' AND hitsxdays > 0") ) - $db->sql_numrows( $db->sql_query( "select ios from ".$prefix."_msanalysis_os WHERE xdays='$xdate' AND hitsxdays > 0 AND ios='0'" ) );
            else $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_os") ) - $db->sql_numrows( $db->sql_query( "select ios from ".$prefix."_msanalysis_os where ios='0'" ) );
         break;
         case 6:
            if( $overview == 1 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_modules WHERE today='$DateToday' AND hitstoday > 0") );
            elseif( $overview == 2 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_modules WHERE xdays='$xdate' AND hitsxdays > 0") );
            else $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_modules" ) );
         break;
         case 7:
            if( $overview == 1 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_users WHERE today='$DateToday' AND hitstoday > 0") );
            elseif( $overview == 2 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_users WHERE xdays='$xdate' AND hitsxdays > 0") );
            else $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_users" ) );
         break;
         case 8:
            if( $overview == 1 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_search WHERE today='$DateToday' AND hitstoday > 0") );
            elseif( $overview == 2 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_search WHERE xdays='$xdate' AND hitsxdays > 0") );
            else $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_search" ) );
         break;
         case 9:
            if( $overview == 1 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_scr WHERE today='$DateToday' AND hitstoday > 0") );
            elseif( $overview == 2 ) $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_scr WHERE xdays='$xdate' AND hitsxdays > 0") );
            else $counter = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_msanalysis_scr" ) );
         break;
         case 10:
            if( $overview == 1 ) {
               $result = $db->sql_query( "select ibrowser from ".$prefix."_msanalysis_browsers WHERE today='$DateToday' AND hitstoday > 0");
               while( ( list( $ibrowser ) = $db->sql_fetchrow( $result ) ) ) { if( eregi( "Web Crawler", $ibrowser ) ) { $counter += 1; } }
            }
            elseif( $overview == 2 ) {
               $result = $db->sql_query( "select ibrowser from ".$prefix."_msanalysis_browsers WHERE xdays='$xdate' AND hitsxdays > 0");
               while( ( list( $ibrowser ) = $db->sql_fetchrow( $result ) ) ) { if( eregi( "Web Crawler", $ibrowser ) ) { $counter += 1; } }
            }
            else {
               $result = $db->sql_query( "select ibrowser from ".$prefix."_msanalysis_browsers" );
               while( ( list( $ibrowser ) = $db->sql_fetchrow( $result ) ) ) { if( eregi( "Web Crawler", $ibrowser ) ) { $counter += 1; } }
            }
      }

      return $counter;
   } // END function CountLines( $screen, $overview, $DateToday, $xdate )

   /******************************************************************************/
   /* FUNCTION: TotalDownloads                                                   */
   /* Return total amount of Downloads + how often downloaded                    */
   /******************************************************************************/
   function TotalDownloads( )
   {
      global $db, $prefix;
      $dresult=0;
      $result = $db->sql_query( "select lid, hits from ".$prefix."_downloads_downloads order by lid" );
      while( list( $lid, $hits ) = $db->sql_fetchrow( $result ) )  { $dresult = $dresult + $hits; }
      $result = $db->sql_query( "select * from ".$prefix."_downloads_downloads" );
      $numrows = $db->sql_numrows( $result );
      return( "$numrows|$dresult" );
   }

   /******************************************************************************/
   /* FUNCTION: TotalMBDownloads                                                 */
   /* Return total amount of MegaBytes Downloaded                                */
   /******************************************************************************/
   function TotalMBDownloads( )
   {
      global $db, $prefix;

      $totaldownloadsize = 0;
      $dresult = $db->sql_query( "select hits, filesize from ".$prefix."_downloads_downloads" );
      while( list( $hits, $filesize ) = $db->sql_fetchrow( $dresult ) )
      {
         $downloadsize = $hits * $filesize;
         $totaldownloadsize += $downloadsize;
      }
      return( sprintf("%01.2f", $totaldownloadsize / ( 1024 * 1024 ) ) );
   }

   /******************************************************************************/
   /* FUNCTION: TotalVisits                                                      */
   /* Return total amount of Page Visits                                         */
   /******************************************************************************/
   function TotalVisits( )
   {
      global $db, $prefix;
      $result = $db->sql_query( "select count from ".$prefix."_counter where type = 'total'" );
      list( $count ) = $db->sql_fetchrow( $result );
      return( $count + 1 );
   }

   /******************************************************************************/
   /* FUNCTION: MostMonth                                                        */
   /* Return Highest pagevisits in a Month                                       */
   /******************************************************************************/
   function MostMonth( )
   {
      global $db, $prefix;
      $result = $db->sql_query( "select year, month, hits from ".$prefix."_stats_month order by hits DESC limit 0,1" );
      list( $year, $month, $hits ) = $db->sql_fetchrow( $result );
      $month = $this->GetMonth( $month );
      return( ""._MSA_MOSTMONTH.": $month $year ($hits "._MSA_HITS.")<br>" );
   }

   /******************************************************************************/
   /* FUNCTION: MostDay                                                          */
   /* Return Highest pagevisits in a Day                                         */
   /******************************************************************************/
   function MostDay( )
   {
      global $db, $prefix;
      $result = $db->sql_query( "select year, month, date, hits from ".$prefix."_stats_date order by hits DESC limit 0,1" );
      list( $year, $month, $date, $hits ) = $db->sql_fetchrow( $result );
      $month = $this->GetMonth( $month );
      return( ""._MSA_MOSTDAY.": $date $month $year ($hits "._MSA_HITS.")<br>" );
   }

   /******************************************************************************/
   /* FUNCTION: MostHour                                                         */
   /* Return Highest pagevisits in an Hour                                       */
   /******************************************************************************/
   function MostHour( )
   {
      global $db, $prefix;
      $result = $db->sql_query( "select year, month, date, hour, hits from ".$prefix."_stats_hour order by hits DESC limit 0,1" );
      list( $year, $month, $date, $hour, $hits ) = $db->sql_fetchrow( $result );
      $month = $this->GetMonth( $month );
      if( $hour < 10 ) { $hour = "0$hour:00 - 0$hour:59"; } else { $hour = "$hour:00 - $hour:59"; }
      return( ""._MSA_MOSTHOUR.": $hour "._MSA_ON." $month $date, $year ($hits "._MSA_HITS.")<br>" );
   }






}

?>
