<?php

/************************************************************************/
/*                                                                      */
/* Updated for PHP-Nuke 5.6 -  18 Jun 2002 NukeScripts                  */
/* website http://www.nukescripts.com                                   */
/*                                                                      */
/* Updated for PHP-Nuke 5.5 - 24/03/2002 Rugeri                         */
/* website http://newsportal.homip.net                                  */
/*                                                                      */
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

if(stristr( $_SERVER['SCRIPT_NAME'], "block-MSA_Info.php" ) ) {
    Header("Location: index.php");
    die();
}

global $user, $cookie, $prefix, $user_prefix, $db, $anonymous, $sitekey, $Version_Num, $gfx_chk;

$module_name = "MS_Analysis";
$max_displayed = 3;
define("_BSERV","Server Date/Time");
define("_BDT","Date");
define("_BTM","Time");
define("_BGMT","GMT");
define("_MSA_HITSTODAY","Today");
define("_MSA_HITSOVERALL","Overall");

$content = "<font class=\"content\">";

function IGetBrowserPicture( $ibrowser )
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

function IGetOSPicture( $ios )
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

if (isset( $newlang ) ) { $language = $newlang; } elseif ( isset( $lang ) ) { $language = $lang; } else { $language = $currentlang; }
if( file_exists( "modules/$module_name/language/lang-$language.php" ) ) { include( "modules/$module_name/language/lang-$language.php" ); } else { include( "modules/$module_name/language/lang-english.php" ); }

mt_srand ((double)microtime()*1000000);
$maxran = 1000000;
$random_num = mt_rand(0, $maxran);
$datekey = date("F j");
$rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
$code = substr($rcode, 2, 10);
cookiedecode($user);
$uname = $cookie[1];

$sql = "SELECT username FROM $user_prefix"._users." ORDER BY user_id DESC LIMIT 0,1";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$lastuser = $row[username];
$numrows = $db->sql_numrows($db->sql_query("SELECT user_id FROM $user_prefix"._users."")) - 1;

$sql = "SELECT uname, guest FROM ".$prefix."_session WHERE guest=0";
$result = $db->sql_query($sql);
$member_online_num = $db->sql_numrows($result);
$who_online_now = "";
while ($session = $db->sql_fetchrow($result)) {
   if (isset($session["guest"]) and $session["guest"] == 0) {
      $result1 = $db->sql_query( "select domain from ".$prefix."_msanalysis_users where uname = '$session[uname]'" );
      list( $domain ) = $db->sql_fetchrow( $result1 );
      $result2 = $db->sql_query( "select description from ".$prefix."_msanalysis_domains where domain = '$domain'" );
      list( $description ) = $db->sql_fetchrow( $result2 );
      $flag = "modules/$module_name/images/flags/$domain".".gif";
      if( !( file_exists( $flag ) ) ) $flag = "<img src=\"modules/$module_name/images/flags/blank.gif\" width=\"14\" height=\"10\" border=\"0\">";
      else $flag = "<img src=\"$flag\" width=\"18\" height=\"10\" ALT=\"$description\" TITLE=\"$description\" border=\"0\">";
      $who_online_now .= "$flag&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$session[uname]\">$session[uname]</a><br>\n";
   }
}

$Today = getdate();
//Formatting Current Date
$month = $Today['month'];
$mday = $Today['mday'];
$year = $Today['year'];
//Formatting Previous Date
$pmonth = $Today['month'];
$pmday = $Today['mday'];
$pmday = $mday-1;
$pyear = $Today['year'];
//Month conversion into numeric mode
if ($pmonth=="January") { $pmonth=1; } else
if ($pmonth=="February") { $pmonth=2; } else
if ($pmonth=="March") { $pmonth=3; } else
if ($pmonth=="April") { $pmonth=4; } else
if ($pmonth=="May") { $pmonth=5; } else
if ($pmonth=="June") { $pmonth=6; } else
if ($pmonth=="July") { $pmonth=7; } else
if ($pmonth=="August") { $pmonth=8; } else
if ($pmonth=="September") { $pmonth=9; } else
if ($pmonth=="October") { $pmonth=10; } else
if ($pmonth=="November") { $pmonth=11; } else
if ($pmonth=="December") { $pmonth=12; };
$test = mktime (0,0,0,$pmonth,$pmday,$pyear,-1);

//Creating SQL parameter
$curDate2 = "%".$month[0].$month[1].$month[2]."%".$mday."%".$year."%";
$preday = strftime ("%d",$test);
$premonth = strftime ("%B",$test);
$preyear = strftime ("%Y",$test);
$curDateP = "%".$premonth[0].$premonth[1].$premonth[2]."%".$preday."%".$preyear."%";

//Executing SQL Today
$sql = "SELECT COUNT(user_id) AS userCount FROM $user_prefix"._users." WHERE user_regdate LIKE '$curDate2'";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$userCount = $row[userCount];
//end

//Executing SQL Today
$sql = "SELECT COUNT(user_id) AS userCount FROM $user_prefix"._users." WHERE user_regdate LIKE '$curDateP'";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$userCount2 = $row[userCount];
//end

$guest_online_num = $db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest=1"));
$member_online_num = $db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest=0"));

$who_online_num = $guest_online_num + $member_online_num;
$content .= "<form action=\"modules.php?name=Your_Account\" method=\"post\">";

// Top-info
if (is_user($user)) {
    $content .= "<br><img src=\"images/blocks/group-4.gif\" height=\"14\" width=\"17\"> "._BWEL.", <b>$uname</b>.<br>\n";
    $content .= "<img src=\"modules/$module_name/images/delete.gif\" height=\"16\" width=\"20\"><a href=\"modules.php?name=Your_Account&op=logout\">" . _LOGOUT . "</a><br><hr>\n";
    $sql = "SELECT user_id FROM $user_prefix"._users." WHERE username='$uname'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $uid = intval( $row[user_id] );
    $newpms = $db->sql_numrows($db->sql_query("SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$uid' AND (privmsgs_type='5' OR privmsgs_type='1')"));
    $oldpms = $db->sql_numrows($db->sql_query("SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$uid' AND privmsgs_type='0'"));
    $content .= "<img src=\"images/blocks/email-y.gif\" height=\"10\" width=\"14\"> <a href=\"modules.php?name=Private_Messages\"><b>"._BPM."</b></a><br>\n";
    $content .= "<img src=\"images/blocks/email-r.gif\" height=\"10\" width=\"14\"> "._BUNREAD.": <b>$newpms</b><br>\n";
    $content .= "<img src=\"images/blocks/email-g.gif\" height=\"10\" width=\"14\"> "._BREAD.": <b>$oldpms</b><br>\n<hr>\n";
} else {
    $content .= "<img src=\"images/blocks/group-4.gif\" height=\"14\" width=\"17\"> "._BWEL.", <b>$anonymous</b>\n<hr>";
    $content .= "<center><b>"._NICKNAME."</b><br><input type=\"text\" name=\"username\" size=\"15\" maxlength=\"25\"><br>";
    $content .= "<b>"._PASSWORD."</b><br><input type=\"password\" name=\"user_password\" size=\"15\" maxlength=\"20\"><br>";
    if (extension_loaded("gd") AND ($gfx_chk == 2 OR $gfx_chk == 4 OR $gfx_chk == 5 OR $gfx_chk == 7)) {
       if( floatval( $Version_Num ) < 7.5 ) {
          $content .= "<b>"._SECURITYCODE."</b><br><img src='modules.php?name=Your_Account&op=gfx&random_num=$random_num' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'><br>\n";
       } else {
          $content .= "<b>"._SECURITYCODE."</b><br><img src='?gfx=gfx&random_num=$random_num' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'><br>\n";
       }
       $content .= "<b>"._TYPESECCODE."</b><br><input type=\"text\" name=\"gfx_check\" SIZE=\"15\" MAXLENGTH=\"10\"><br>\n";
       $content .="<input type=\"hidden\" name=\"random_num\" value=\"$random_num\"><br>\n";
    }
    $content .= "<input type=\"hidden\" name=\"op\" value=\"login\">";
    $content .= "<input type=\"submit\" value=\""._LOGIN."\">\n (<a href=\"modules.php?name=Your_Account&amp;op=new_user\">"._BREG."</a>)</center><hr>";
}

// Show Top-Countries of Today
$content .= "<img src=\"images/blocks/group-1.gif\" height=\"14\" width=\"17\"><a href=\"modules.php?name=MS_Analysis&file=index&op=MSAnalysisGeneral&screen=1&overview=3&sortby=\">&nbsp;<b><u>" . _MSA_GENCOUNTRIES . ":</u></b></a><br>\n";
$counter = 0;
$result = $db -> sql_query("select domain, description, hitstoday from ".$prefix."_msanalysis_countries order by hitstoday DESC");
while( ( list( $domain, $description, $hitstoday ) = $db -> sql_fetchrow( $result ) ) AND ( $counter < $max_displayed ) AND ( $hitstoday > 0 ) ) {
   $counter += 1;
   $flag = "modules/$module_name/images/flags/$domain" . ".gif";
   if( !( file_exists( $flag ) ) ) $flag = "modules/$module_name/images/flags/blank.gif";
   $content .= "<img src=\"$flag\" ALT=\"$description - $hitstoday hits\" TITLE=\"$description - $hitstoday hits\" border=\"0\" width=\"18\" height=\"10\" align=\"middle\"> $description<br>\n";
}
$content .= "<hr>\n";

// Show Top-Browsers of Today
$content .= "<img src=\"images/blocks/group-2.gif\" height=\"14\" width=\"17\"><a href=\"modules.php?name=MS_Analysis&file=index&op=MSAnalysisGeneral&screen=4&overview=3&sortby=\">&nbsp;<b><u>" . _MSA_GENBROWSERS . ":</u></b></a><br>\n";
$counter = 0;
$result = $db -> sql_query("select ibrowser, hitstoday from ".$prefix."_msanalysis_browsers order by hitstoday DESC");
while( ( list( $ibrowser, $hitstoday ) = $db -> sql_fetchrow( $result ) ) AND ( $counter < $max_displayed ) AND ( $hitstoday > 0 ) ) {
   if( (! eregi( "Other", $ibrowser ) ) AND ( ! eregi( "Web Crawler", $ibrowser ) ) ) {
      $counter += 1;
      $sym = IGetBrowserPicture( $ibrowser );
      $symp = "modules/$module_name/images/browsers/$sym" . ".gif";
      if( !( file_exists( $symp ) ) ) $symp = "modules/$module_name/images/browsers/blank.gif";
      $content .= "<img src=\"$symp\" ALT=\"$ibrowser - $hitstoday hits\" TITLE=\"$ibrowser - $hitstoday hits\" border=\"0\" align=\"middle\"> $ibrowser<br>\n";
   }
}
$content .= "<hr>\n";

// Show Top-OS of Today
$content .= "<img src=\"images/blocks/group-1.gif\" height=\"14\" width=\"17\"><a href=\"modules.php?name=MS_Analysis&file=index&op=MSAnalysisGeneral&screen=5&overview=3&sortby=\">&nbsp;<b><u>" . _MSA_ONLINEOPSYSTEM . ":</u></b></a><br>\n";
$counter = 0;
$result = $db -> sql_query("select ios, hitstoday from ".$prefix."_msanalysis_os order by hitstoday DESC");
while( ( list( $ios, $hitstoday ) = $db -> sql_fetchrow( $result ) ) AND ( $counter < $max_displayed ) AND ( $hitstoday > 0 ) ) {
   if(! eregi( "Other", $ios ) ) {
      $counter += 1;
      $sym = IGetOSPicture($ios);
      $symp = "modules/$module_name/images/os/$sym" . ".gif";
      if(!( file_exists( $symp ) ) ) $symp = "modules/$module_name/images/os/blank.gif";
      $content .= "<img src=\"$symp\" ALT=\"$ios - $hitstoday hits\" TITLE=\"$ios - $hitstoday hits\" border=\"0\" align=\"middle\"> $ios<br>\n";
   }
}
$content .= "<hr>\n";

// Server Date/Time
$Today = date("d M Y");
$Time = date("H:i:s");
$Offset = date("O");
$content .= "<img src='modules/$module_name/images/servertime.png' height='16' width='16'> <b>"._BSERV."</b><br>\n";
$content .= "<img src='modules/$module_name/images/arrow.png' height='9' width='16'> "._BDT.": <b>$Today</b><br>\n";
$content .= "<img src='modules/$module_name/images/arrow.png' height='9' width='16'> "._BTM.": <b>$Time</b><br>\n";
$content .= "<img src='modules/$module_name/images/arrow.png' height='9' width='16'> "._BGMT.": <b>$Offset</b><br>\n";
$content .= "</font><hr>\n";

// Hits
$t_time = time();
$t_year = date("Y", $t_time);
$t_month = date("n", $t_time);
$t_date = date("j", $t_time);
//Hits Today
$content .= "<img src=\"modules/$module_name/images/nukestats/counter.gif\"><a href=\"modules.php?name=MS_Analysis&file=index&op=MSAnalysisGeneral&screen=12&overview=3&sortby=\">&nbsp;<b><u>" . _MSA_HITS . ":</u></b></a><br>\n";
$result = $db->sql_query( "SELECT hits FROM ".$prefix."_stats_date WHERE year='$t_year' AND month='$t_month' AND date='$t_date'" );
list($today) = $db->sql_fetchrow( $result );
$content .= "<img src='modules/$module_name/images/arrow.png' height='9' width='16'> "._MSA_HITSTODAY.": <a href=\"modules.php?name=MS_Analysis&file=index&op=MSAnalysisGeneral&screen=11&overview=1&sortby=\"><b>$today</b></a><br>\n";
// Hits Overall
$result = $db->sql_query("SELECT count FROM ".$prefix."_counter WHERE type='total' AND var='hits'");
list($overall) = $db->sql_fetchrow( $result );
$content .= "<img src='modules/$module_name/images/arrow.png' height='9' width='16'> "._MSA_HITSOVERALL.": <a href=\"modules.php?name=MS_Analysis&file=index&op=MSAnalysisGeneral&screen=11&overview=3&sortby=\"><b>$overall</b></a>\n";
$content .= "<hr>\n";

// Membership
$content .= "<img src=\"images/blocks/group-2.gif\" height=\"14\" width=\"17\"> <b><u>"._BMEMP.":</u></b><br>\n";
$content .= "<img src=\"images/blocks/ur-moderator.gif\" height=\"14\" width=\"17\"> "._BLATEST.": <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$lastuser\"><b>$lastuser</b></a><br>\n";
$content .= "<img src=\"images/blocks/ur-author.gif\" height=\"14\" width=\"17\"> "._BTD.": <b>$userCount</b><br>\n";
$content .= "<img src=\"images/blocks/ur-admin.gif\" height=\"14\" width=\"17\"> "._BYD.": <b>$userCount2</b><br>\n";
$content .= "<img src=\"images/blocks/ur-guest.gif\" height=\"14\" width=\"17\"> "._BOVER.": <b>$numrows</b><br>\n<hr>\n";
$content .= "<img src=\"images/blocks/group-3.gif\" height=\"14\" width=\"17\"> <b><u>"._BVISIT.":</u></b>\n<br>\n";
$content .= "<img src=\"images/blocks/ur-anony.gif\" height=\"14\" width=\"17\"> "._BVIS.": <b>$guest_online_num</b><br>\n";
$content .= "<img src=\"images/blocks/ur-member.gif\" height=\"14\" width=\"17\"> "._BMEM.": <b>$member_online_num</b><br>\n";
$content .= "<img src=\"images/blocks/ur-registered.gif\" height=\"14\" width=\"17\"> "._BTT.": <b>$who_online_num</b><br>\n";
if ($member_online_num > 0) {
    $content .= "<hr>\n<img src=\"images/blocks/group-1.gif\" height=\"14\" width=\"17\"> <b><u>"._BON.":</u></b><br>$who_online_now";
}

$content .= "</form>";

?>