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

if(stristr( $_SERVER['SCRIPT_NAME'], "block-MSA.php" ) ) {
    Header("Location: index.php");
    die();
}

global $prefix, $db, $language, $lang, $sitename;

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

$module_name = "MS_Analysis";
$max_displayed = 3;
$t_time = time();
$t_year = date("Y", $t_time);
$t_month = date("n", $t_time);
$t_date = date("j", $t_time);

if (isset( $newlang ) ) { $language = $newlang; } elseif ( isset( $lang ) ) { $language = $lang; } else { $language = $currentlang; }
if( file_exists( "modules/$module_name/language/lang-$language.php" ) ) { include( "modules/$module_name/language/lang-$language.php" ); } else { include( "modules/$module_name/language/lang-english.php" ); }

$result = $db->sql_query( "SELECT hits FROM ".$prefix."_stats_date WHERE year='$t_year' AND month='$t_month' AND date='$t_date'" );
list($today) = $db->sql_fetchrow( $result );

// Show Max Pagehits for Today
$content = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"2\" width=\"95%\">\n";
$content .= "<tr><td width=\"100%\" colspan=\"2\" valign=\"top\">\n";
$content .= "<p align=\"center\"><font class=\"boxcontent\"><a href=\"modules.php?name=MS_Analysis&file=index&op=MSAnalysisGeneral&screen=11&overview=1&sortby=\"><b>.::&nbsp;" . _MSA_OVERVIEWTODAY . "&nbsp;::.</b></a></font></p>\n";
$content .= "</td></tr>\n";
$content .= "<tr><td width=\"100%\" colspan=\"2\" valign=\"top\" nowrap>\n";
$content .= "<p align=\"center\"><font class=\"content\">" . $today . "&nbsp;" . _MSA_SPAGESVIEWS . "</font></p>\n";
$content .= "</td></tr>\n";
$content .= "<tr><td width=\"100%\" colspan=\"2\">&nbsp;</td></tr>\n";

// Show Top-Countries of Today
$counter = 0;
$result = $db->sql_query("select domain, description, hitstoday from ".$prefix."_msanalysis_countries order by hitstoday DESC" );
while((list($domain, $description, $hitstoday) = $db->sql_fetchrow($result)) AND ( $counter < $max_displayed) AND ($hitstoday > 0) ) {
   $counter += 1;
   $flag = "modules/$module_name/images/flags/$domain" . ".gif";
   if(!(file_exists($flag))) $flag = "modules/$module_name/images/flags/blank.gif";
   $content .= "<tr><td width=\"75%\" valign=\"top\"><b>$description</b></td>\n";
   $content .= "<td width=\"25%\" valign=\"top\" nowrap><img src=\"$flag\" ALT=\"$description - $hitstoday hits\" TITLE=\"$description - $hitstoday hits\" border=\"0\" width=\"16\" height=\"10\" align=\"middle\"></td></tr>";
}

// Horizontal Line
$content .= "<tr><td width=\"100%\" colspan=\"2\"><hr></td></tr>\n";

// Show Top-Browsers of Today
$counter = 0;
$result = $db->sql_query( "select ibrowser, hitstoday from ".$prefix."_msanalysis_browsers order by hitstoday DESC" );
while( (list( $ibrowser, $hitstoday ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_displayed) AND ($hitstoday > 0) ) {
   if( (! eregi( "Other", $ibrowser )) AND (! eregi( "Web Crawler", $ibrowser )) ) {
      $counter += 1;
      $sym = GetBrowserPicture( $ibrowser );
      $symp = "modules/$module_name/images/browsers/$sym".".gif";
      if( !( file_exists( $symp ) ) ) $symp = "modules/$module_name/images/browsers/blank.gif";
      $content .= "<tr><td width=\"75%\" valign=\"top\"><b>$ibrowser</b></td>\n";
      $content .= "<td width=\"25%\" valign=\"top\" nowrap><img src=\"$symp\" ALT=\"$ibrowser - $hitstoday hits\" TITLE=\"$ibrowser - $hitstoday hits\" border=\"0\" align=\"middle\"></td></tr>";
   }
}

// Horizontal Line
$content .= "<tr><td width=\"100%\" colspan=\"2\"><hr></td></tr>\n";

// Show Top-OS of Today
$counter = 0;
$result = $db->sql_query( "select ios, hitstoday from ".$prefix."_msanalysis_os order by hitstoday DESC" );
while( (list( $ios, $hitstoday ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_displayed) AND ($hitstoday > 0) ) {
   if( ! eregi( "Other", $ios ) ) {
      $counter += 1;
      $sym = GetOSPicture( $ios );
      $symp = "modules/$module_name/images/os/$sym".".gif";
      if( !( file_exists( $symp ) ) ) $symp = "modules/$module_name/images/os/blank.gif";
      $content .= "<tr><td width=\"75%\" valign=\"top\"><b>$ios</b></td>\n";
      $content .= "<td width=\"25%\" valign=\"top\" nowrap><img src=\"$symp\" ALT=\"$ios - $hitstoday hits\" TITLE=\"$ios - $hitstoday hits\" border=\"0\" align=\"middle\"></td></tr>";
   }
}

// Horizontal Line
$content .= "<tr><td width=\"100%\" colspan=\"2\"><hr></td></tr>\n";

// Show Top-Users of Today
$counter = 0;
$result = $db->sql_query( "select uname, domain, hitstoday from ".$prefix."_msanalysis_users order by hitstoday DESC" );
while( (list( $uname, $domain, $hitstoday ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_displayed ) AND ($hitstoday > 0) ) {
   $counter += 1;
   $result1 = $db->sql_query( "select description from ".$prefix."_msanalysis_domains where domain = '$domain'" );
   list( $description ) = $db->sql_fetchrow( $result1 );
   $flag = "modules/$module_name/images/flags/$domain".".gif";
   if( !( file_exists( $flag ) ) ) $flag = "<img src=\"modules/".$module_name."/images/flags/blank.gif\" width=\"14\" height=\"14\" ALT=\"Unknown\" TITLE=\"Unknown\" border=\"0\">";
   else $flag = "<img src=\"$flag\" width=\"16\" height=\"10\" ALT=\"$description - $hitstoday hits\" TITLE=\"$description - $hitstoday hits\" border=\"0\">";
   $luname = "<A HREF=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\">$uname</a></b>\n";

   $content .= "<tr><td width=\"75%\" valign=\"top\"><b>$luname</b></td>\n";
   $content .= "<td width=\"25%\" valign=\"top\" nowrap>$flag</td></tr>";
}

// Horizontal Line
$content .= "<tr><td width=\"100%\" colspan=\"2\"><hr></td></tr>\n";

// Show Top-Referrals of Today
$counter = 0;
$result = $db->sql_query( "select referral, hitstoday from ".$prefix."_msanalysis_referrals order by hitstoday DESC" );
while( (list( $referral, $hitstoday ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_displayed ) AND ($hitstoday > 0) ) {
   $counter += 1;
   if( strlen( $referral ) > 14 ) { $sreferral = substr( $referral, 0, 14 ) . "..."; } else $sreferral = $referral;
   $content .= "<tr><td width=\"75%\" valign=\"top\"><b><a title=\"$referral\" target=\"_blank\" href=\"http://$referral\">$sreferral</a></b></td>";
   $content .= "<td width=\"25%\" valign=\"top\" align=\"center\"><b>$hitstoday</b></td></tr>\n";
}

// Horizontal Line
$content .= "<tr><td width=\"100%\" colspan=\"2\"><hr></td></tr>\n";

// Show Top-Modules of Today
$counter = 0;
$result = $db->sql_query( "select modulename, hitstoday from ".$prefix."_msanalysis_modules order by hitstoday DESC" );
while( (list( $modulename, $hitstoday ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_displayed) AND ($hitstoday > 0) ) {
   $counter += 1;
   $nmodulename = strtr ( $modulename, ' ', '_' );
   $nmodulename = "<a href=\"modules.php?name=".$nmodulename."\">$modulename</a>";
   $content .= "<tr><td width=\"75%\" valign=\"top\"><b>$nmodulename</b></td>";
   $content .= "<td width=\"25%\" valign=\"top\" align=\"center\"><b>$hitstoday</b></td></tr>\n";
}


// Show Max Pagehits sofar
$result = $db->sql_query("SELECT count FROM ".$prefix."_counter WHERE type='total' AND var='hits'");
list($overall) = $db->sql_fetchrow( $result );
$content .= "<tr><td width=\"100%\" colspan=\"2\" valign=\"top\">&nbsp;</td></tr>\n";
$content .= "<tr><td width=\"100%\" colspan=\"2\" valign=\"top\">\n";
$content .= "<p align=\"center\"><font class=\"boxcontent\"><a href=\"modules.php?name=$module_name&op=MSAnalysisGeneral&screen=11&overview=3&sortby=\"><b>.::&nbsp;" . _MSA_OVERVIEWALL . "&nbsp;::.</b></a></font></p>\n";
$content .= "</td></tr>\n";
$content .= "<tr><td width=\"100%\" colspan=\"2\" valign=\"top\" nowrap>\n";
$content .= "<p align=\"center\"><font class=\"content\">" . $overall . "&nbsp;" . _MSA_SPAGESVIEWS . "</font></p>\n";
$content .= "</td></tr></table>\n";

?>
