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
/* PHP-NUKE: Web Portal System                                                      */
/* ===========================                                                      */
/*                                                                                  */
/* Copyright (c) 2002 by Francisco Burzi                                            */
/* http://phpnuke.org                                                               */
/*                                                                                  */
/* The visits per Year/Month/Day/Hour + Graphics are from PHP-Nuke 6.x Statistics   */
/************************************************************************************/

echo "<div align=\"center\">\n";
echo "<center>\n";
echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\"  bgcolor=\"$bgcolor1\">\n";

/*******************************************************/
/* Count amount of Countries, Referrals, SearchEngines */
/*******************************************************/
$total1 = $msa->CountLines( 1, $overview, $DateToday, $xdate );
$total2 = $msa->CountLines( 2, $overview, $DateToday, $xdate );
$total3 = $msa->CountLines( 3, $overview, $DateToday, $xdate );

echo "<tr><td width=\"33%\" height=\"20\" align=\"center\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;overview=$overview&amp;screen=1\"><b>"._MSA_GENCOUNTRIES." ("._MSA_GENTOTAL." $total1)</b></a></td>\n";
echo "<td width=\"33%\" height=\"20\" colspan=\"2\" align=\"center\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;overview=$overview&amp;screen=2\"><b>"._MSA_GENREFERRALS." ("._MSA_GENTOTAL." $total2)</b></a></td>\n";
echo "<td width=\"33%\" height=\"20\" align=\"center\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;overview=$overview&amp;screen=3\"><b>"._MSA_GENSENGINES." ("._MSA_GENTOTAL." $total3)</b></a></td>\n";
echo "</tr><tr><td width=\"33%\" valign=\"top\">\n";
/* Top Countries */
   $counter = 0;
   echo "<br><table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">\n";

   if( $overview == 1 ) $result = $db->sql_query( "select domain, description, hitstoday from $prefix"._msanalysis_countries." WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC" );
   elseif( $overview == 2 ) $result = $db->sql_query( "select domain, description, hitsxdays from $prefix"._msanalysis_countries." WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC" );
   else $result = $db->sql_query( "select domain, description, hits from $prefix"._msanalysis_countries." order by hits DESC" );

   while( (list( $domain, $description, $hits ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_items ) ) {
      $flag = "modules/$module_name/images/flags/$domain".".gif";
      if( !( file_exists( $flag ) ) ) $flag = "modules/$module_name/images/flags/blank.gif";
      $counter += 1;
      echo "<tr><td align=\"right\">$counter.</td>\n";
      echo "<td align=\"left\"><font class=\"content\"><img src=\"$flag\" ALT=\"$description\" TITLE=\"$description\" border=\"0\" width=\"16\" height=\"10\"><b>&nbsp;$description</b></td>\n";
      echo "<td align=\"left\"><font class=\"content\"><b>$hits</b></td>\n";
   }
   echo "</td></tr></table><br>\n";
   echo "</td><td width=\"33%\" colspan=\"2\" valign=\"top\">\n";
/* Top Referrals */
   $counter = 0;
   echo "<br><table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">\n";

   if( $overview == 1 ) $result = $db->sql_query( "select referral, hitstoday from $prefix"._msanalysis_referrals." WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC" );
   elseif( $overview == 2 ) $result = $db->sql_query( "select referral, hitsxdays from $prefix"._msanalysis_referrals." WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC" );
   else $result = $db->sql_query( "select referral, hits from $prefix"._msanalysis_referrals." order by hits DESC" );

   while( (list( $referral, $hits ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_items ) ) {
      if( $msa->IsSearchEngine( $referral ) == 0 ) {
         $counter += 1;
	 echo "<tr><td align=\"right\">$counter.</td>\n";
	 if( strlen( $referral ) > 25 ) { $sreferral = substr( $referral, 0, 25 ) . "..."; } else { $sreferral = $referral; }
	 echo "<td align=\"left\"><font class=\"content\"><b><a target=\"_blank\" href=\"http://$referral\">$sreferral</a></b></td>\n";
	 echo "<td align=\"left\"><font class=\"content\"><b>$hits</b></td>\n";
      }
   }
   echo "</td></tr></table><br>\n";
   echo "</td><td width=\"34%\" valign=\"top\">\n";
/* Top Search Engines */
   $counter = 0;
   echo "<br><table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">\n";

   if( $overview == 1 ) $result = $db->sql_query( "select referral, hitstoday from $prefix"._msanalysis_referrals." WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC" );
   elseif( $overview == 2 ) $result = $db->sql_query( "select referral, hitsxdays from $prefix"._msanalysis_referrals." WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC" );
   else $result = $db->sql_query( "select referral, hits from $prefix"._msanalysis_referrals." order by hits DESC" );

   while( (list( $referral, $hits ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_items ) ) {
      if( $msa->IsSearchEngine( $referral ) == 1 ) {
         $counter += 1;
         echo "<tr><td align=\"right\">$counter.</td>\n";
         echo "<td align=\"left\"><font class=\"content\"><b><a target=\"_blank\" href=\"http://$referral\">$referral</a></b></td>\n";
	 echo "<td align=\"left\"><font class=\"content\"><b>$hits</b></td>\n";
      }
   }
   echo "</td></tr></table><br>\n";
   echo "</td></tr><tr>\n";

/********************************************************/
/* Count amount of Browsers, Operating Systems, Modules */
/********************************************************/
$total1 = $msa->CountLines( 4, $overview, $DateToday, $xdate );
$total2 = $msa->CountLines( 5, $overview, $DateToday, $xdate );
$total3 = $msa->CountLines( 6, $overview, $DateToday, $xdate );

echo "<td width=\"33%\" height=\"20\" align=\"center\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;overview=$overview&amp;screen=4\"><b>"._MSA_GENBROWSERS." ("._MSA_GENTOTAL." $total1)</b></a></td>\n";
echo "<td width=\"33%\" height=\"20\" colspan=\"2\" align=\"center\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;overview=$overview&amp;screen=5\"><b>"._MSA_GENOS." ("._MSA_GENTOTAL." $total2)</b></a></td>\n";
echo "<td width=\"34%\" height=\"20\" align=\"center\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;overview=$overview&amp;screen=6\"><b>"._MSA_GENMODULES." ("._MSA_GENTOTAL." $total3)</b></a></td>\n";
echo "</tr><tr><td width=\"33%\" valign=\"top\">\n";
/* Top Browsers */
   $counter = 0;
   echo "<br><table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">\n";

   if( $overview == 1 ) $result = $db->sql_query( "select ibrowser, hitstoday from $prefix"._msanalysis_browsers." WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC" );
   elseif( $overview == 2 ) $result = $db->sql_query( "select ibrowser, hitsxdays from $prefix"._msanalysis_browsers." WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC" );
   else $result = $db->sql_query( "select ibrowser, hits from $prefix"._msanalysis_browsers." order by hits DESC" );

   while( (list( $ibrowser, $hits ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_items ) ) {
      if( (! eregi( "Other", $ibrowser )) AND (! eregi( "Web Crawler", $ibrowser )) ) {
         $sym = $msa->GetBrowserPicture( $ibrowser );
	 $symp = "modules/$module_name/images/browsers/$sym".".gif";
	 if( !( file_exists( $symp ) ) ) $symp = "modules/$module_name/images/browsers/blank.gif";
	 $counter += 1;
	 echo "<tr><td align=\"right\">$counter.</td>\n";
	 echo "<td align=\"left\"><font class=\"content\"><img src=\"$symp\" ALT=\"$ibrowser\" TITLE=\"$ibrowser\" border=\"0\"><b>&nbsp;$ibrowser</b></td>\n";
	 echo "<td align=\"left\"><font class=\"content\"><b>$hits</b></td>\n";
      }
   }
   echo "</td></tr></table><br>\n";
   echo "</td><td width=\"33%\"colspan=\"2\" valign=\"top\">\n";
/* Top Operating Systems */
   $counter = 0;
   echo "<br><table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">\n";

   if( $overview == 1 ) $result = $db->sql_query( "select ios, hitstoday from $prefix"._msanalysis_os." WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC" );
   elseif( $overview == 2 ) $result = $db->sql_query( "select ios, hitsxdays from $prefix"._msanalysis_os." WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC" );
   else $result = $db->sql_query( "select ios, hits from $prefix"._msanalysis_os." order by hits DESC" );

   while( (list( $ios, $hits ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_items ) ) {
      if( ! eregi( "Other", $ios ) ) {
         $sym = $msa->GetOSPicture( $ios );
	 $symp = "modules/$module_name/images/os/$sym".".gif";
	 if( !( file_exists( $symp ) ) ) $symp = "modules/$module_name/images/os/blank.gif";
	 $counter += 1;
	 echo "<tr><td align=\"right\">$counter.</td>\n";
	 echo "<td align=\"left\"><font class=\"content\"><img src=\"$symp\" ALT=\"$ios\" TITLE=\"$ios\" border=\"0\"><b>&nbsp;$ios</b></td>\n";
	 echo "<td align=\"left\"><font class=\"content\"><b>$hits</b></td>\n";
      }
   }
   echo "</td></tr></table><br>\n";
   echo "</td><td width=\"33%\" valign=\"top\">\n";
/* Top Modules */
   $counter = 0;
   echo "<br><table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">\n";

   if( $overview == 1 ) $result = $db->sql_query( "select modulename, hitstoday from $prefix"._msanalysis_modules." WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC limit 0, $max_items" );
   elseif( $overview == 2 ) $result = $db->sql_query( "select modulename, hitsxdays from $prefix"._msanalysis_modules." WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC limit 0, $max_items" );
   else $result = $db->sql_query( "select modulename, hits from $prefix"._msanalysis_modules." order by hits DESC limit 0, $max_items" );

   while( (list( $modulename, $hits ) = $db->sql_fetchrow( $result ) ) ) {
      $counter += 1;
      $nmodulename = strtr ( $modulename, ' ', '_' );
      $nmodulename = "<a href=\"modules.php?name=".$nmodulename."\">$modulename</a>";
      echo "<tr><td align=\"right\">$counter.</td>\n";
      echo "<td align=\"left\"><font class=\"content\"><b>$nmodulename</b></td>\n";
      echo "<td align=\"left\"><font class=\"content\"><b>$hits</b></td>\n";
   }
   echo "</td></tr></table><br>\n";
   echo "</td></tr>\n";

/*********************************************/
/* Count amount of Users, Screen Resolutions */
/*********************************************/
$total1 = $msa->CountLines( 7, $overview, $DateToday, $xdate );
$total2 = $msa->CountLines( 9, $overview, $DateToday, $xdate );

// When Overview = 1 (daily Page Visits) display not the last 7 days stats
if( $overview == 1 ) $colspan = 3; else $colspan = 1;
echo "<td width=\"33%\" height=\"20\" colspan=\"$colspan\" align=\"center\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;overview=$overview&amp;screen=7\"><b>"._MSA_GENUSERS." ("._MSA_GENTOTAL." $total1)</b></a></td>\n";
echo "<td width=\"33%\" height=\"20\" colspan=\"2\" align=\"center\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;overview=$overview&amp;screen=9\"><b>"._MSA_GENRESOLUTION." ("._MSA_GENTOTAL." $total2)</b></a></td>\n";
if( $overview != 1 ) echo "<td width=\"34%\" height=\"20\" align=\"center\" bgcolor=\"$bgcolor2\"><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisStats\"><b>"._MSA_VISITOROVERVIEW."</b></a></td>\n";
echo "</tr><tr><td width=\"33%\" colspan=\"$colspan\" valign=\"top\">\n";
/* Top Users */
   $counter = 0;
   echo "<br><table cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">\n";

   if( $overview == 1 ) $result = $db->sql_query( "select uname, browser, os, domain, time, hitstoday from $prefix"._msanalysis_users." WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC limit 0, $max_items" );
   elseif( $overview == 2 ) $result = $db->sql_query( "select uname, browser, os, domain, time, hitsxdays from $prefix"._msanalysis_users." WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC limit 0, $max_items" );
   else $result = $db->sql_query( "select uname, browser, os, domain, time, hits from $prefix"._msanalysis_users." order by hits DESC limit 0, $max_items" );

   while( (list( $uname, $browser, $os, $domain, $time, $hits ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_items ) ) {
      $counter += 1;
      // To show difference between users and admins 15.01.2003 sickb0y
      $user_level = $db->sql_query("select user_level from ".$user_prefix."_users where username='$uname'" );
      list( $level ) = $db->sql_fetchrow( $user_level );
      if( $level==3 | $level==2 ) {
         $flag = "modules/$module_name/images/online-admin.gif";
      } else {
         $flag = "modules/$module_name/images/online-user.gif";
      }
      $daysago = $msa->DaysOld( $time );
      if( $daysago == 0 ) { $ptime = substr( $time, 11, 8 ); }
      elseif( $daysago == 1 ) { $ptime = _MSA_YESTERDAY; }
      else $ptime = $daysago." " . _MSA_DAYSAGO;
      echo "<tr><td align=\"right\">$counter.</td>\n";

      if( $overview == 1 ) $suname = $uname; else $suname = substr( $uname, 0, 7 );
      if( is_admin( $admin ) ) {
         echo "<td align=\"left\"><font class=\"content\"><img src=\"$flag\" ALT=\"$uname\" TITLE=\"$uname\" border=\"0\"><b>&nbsp;<A HREF=\"modules.php?name=$module_name&file=scripts&targetscript=userinfo&op=MSAuserinfo&amp;suser=$uname\">$suname</a></b></td>\n";
      } else {
         echo "<td align=\"left\"><font class=\"content\"><img src=\"$flag\" ALT=\"$uname\" TITLE=\"$uname\" border=\"0\"><b>&nbsp;<A HREF=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\">$suname</a></b></td>\n";
      }

      if( $overview == 1 ) {
         // Country Picture
         $result1 = $db->sql_query( "select description from $prefix"._msanalysis_domains." where domain = '$domain'" );
         list( $description ) = $db->sql_fetchrow( $result1 );
         $flag = "modules/$module_name/images/flags/$domain".".gif";
         if( !( file_exists( $flag ) ) ) $flag = "<img src=\"modules/".$module_name."/images/flags/blank.gif\" width=\"14\" height=\"14\" ALT=\"$description\" TITLE=\"$description\" border=\"0\">";
         else $flag = "<img src=\"$flag\" width=\"20\" height=\"10\" ALT=\"$description\" TITLE=\"$description\" border=\"0\">";

         // Browser Picture
         $bsym = $msa->GetBrowserPicture( $browser );
         $bsymp = "modules/$module_name/images/browsers/$bsym".".gif";
         if( !( file_exists( $bsymp ) ) ) $bsymp = "<img src=\"modules/".$module_name."/images/browsers/blank.gif\" width=\"14\" height=\"14\" ALT=\"$browser\" TITLE=\"$browser\" border=\"0\">";
         else $bsymp = "<img src=\"$bsymp\" ALT=\"$browser\" TITLE=\"$browser\" border=\"0\">";

         // Operating System Picture
         $osym = $msa->GetOSPicture( $os );
         $osymp = "modules/$module_name/images/os/$osym".".gif";
         if( !( file_exists( $osymp ) ) ) $osymp = "<img src=\"modules/".$module_name."/images/os/blank.gif\" width=\"14\" height=\"14\" ALT=\"$os\" TITLE=\"$os\" border=\"0\">";
         else $osymp = "<img src=\"$osymp\" ALT=\"$os\" TITLE=\"$os\" border=\"0\">";

         echo "<td align=\"left\"><font class=\"content\">$bsymp&nbsp;$osymp&nbsp;$flag</td>\n";
      }
      echo "<td align=\"left\"><font class=\"content\"><b>$ptime</b></td>\n";
      echo "<td align=\"left\"><font class=\"content\"><b>$hits</b></td>\n";
   }
   echo "</td></tr></table><br>\n";
   echo "<td width=\"33%\" colspan=\"2\" valign=\"top\">\n";
/* Top Screen Resolutions */
   $counter = 0;
   echo "<br><div align=\"center\">\n";
   echo "<center>\n";
   echo "<table border=\"1\" height=\"20\" cellpadding=\"1\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"90%\" bgcolor=\"$bgcolor1\">\n";
   echo "<tr>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor2\">&nbsp;</td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor2\"><b>"._MSA_WIDTH."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor2\"><b>"._MSA_HEIGHT."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor2\"><b>"._MSA_COLORS."</b></td>\n";
   echo "<td width=\"20%\" bgcolor=\"$bgcolor2\"><b>"._MSA_HITS."</b></td>\n";
   echo "</tr>\n";

   if( $overview == 1 ) $result = $db->sql_query( "select scr_res, hitstoday from $prefix"._msanalysis_scr." WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC" );
   elseif( $overview == 2 ) $result = $db->sql_query( "select scr_res, hitsxdays from $prefix"._msanalysis_scr." WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC" );
   else $result = $db->sql_query( "select scr_res, hits from $prefix"._msanalysis_scr." order by hits DESC" );

   while( (list( $scr_res, $hits ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_items ) ) {
      $counter += 1;
      if( $counter == 1 ) { $flag = "modules/$module_name/images/green_dot.gif"; } else { $flag = "modules/$module_name/images/red_dot.gif"; }
      $whc = explode( "x", $scr_res );
      echo "<tr>\n";
      echo "<td>$counter.</td>\n";
      echo "<td align=\"center\"><b>".$whc[ 0 ]."</b></td>\n";
      echo "<td align=\"center\"><b>".$whc[ 1 ]."</b></td>\n";
      echo "<td align=\"center\"><b>".$whc[ 2 ]."</b></td>\n";
      echo "<td><b>$hits</b></td>\n";
      echo "</tr>\n";
   }
   echo "</table></center></div>\n";
   echo "</td><td width=\"34%\" valign=\"top\">\n";

// Calculate current date
$dot = explode ("-", $DateToday );
$nowdate = $dot[2];
$month = $dot[1];
$year = $dot[0];

/***************************************************/
/* 7 Days Page Visits only for OVERVIEW 2 and 3    */
/***************************************************/
if( $overview != 1 ) {
   // Show page hits last 7 days
   MSAnalysis7DaysStats( $year, $month, $nowdate );
}
echo "</td></tr></table>\n";
echo "</center>\n";
echo "</div><br>\n";

/************************************************************************/
/* Display Hourly, Monthly or Yearly page visits, depending on overview */
/************************************************************************/
if( $overview == 1 ) { MSAnalysisHourlyPVStats( $DateToday, $year, $month, $nowdate ); }
if( $overview == 2 ) { MSAnalysisMonthlyPVStats( $year ); }
if( $overview == 3 ) { MSAnalysisYearlyPVStats( ); }


?>

