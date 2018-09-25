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
/********************************************************/
/* LAST 10 .............. routines by:                  */
/* By: NukeScripts Network (webmaster@nukescripts.com)  */
/* http://www.nukescripts.com                           */
/* Copyright © 2002 by NukeScripts Network              */
/********************************************************/

$index = 0;
$module_name = explode( "admin", dirname( __FILE__ ) );
$module_name = basename( $module_name[0] );

if( !stristr( $_SERVER['SCRIPT_NAME'], "modules.php" ) ) {
   die( "You can't access this file directly..." );
}

require_once( "mainfile.php" );
@(require_once( "modules/$module_name/include/class.general.php" )) OR die ("File class.general.php can not be found" );
get_lang( $module_name );

/******************************************************************************/
/* FUNCTION: Start                                                            */
/******************************************************************************/
function MSAenterinfo()
{
   global $module_name, $bgcolor2, $bgcolor1;

   include( "header.php" );
   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   if( $msaadmin->check_permission() == 1 ) {
      $msaadmin->admin_menu();
      echo "<br>\n";
      OpenTable();
      echo "<div align=\"center\"><center>\n";
      echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" width=\"50%\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" bgcolor=\"$bgcolor1\">\n";
      echo "<tr>\n";
      echo "<td width=\"100%\" bgcolor=\"$bgcolor2\" align=\"center\" height=\"25\" colspan=\"2\"><b>"._MSA_SEARCHINFO."</b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      // Search for a user
      echo "<td width=\"50%\" align=\"center\" valign=\"middle\" bgcolor=\"$bgcolor1\">\n";
      echo "<form action=\"modules.php?name=$module_name&file=scripts&targetscript=userinfo\" method=\"post\">\n";
      echo "<input type=\"text\" name=\"suser\" size=\"20\">\n";
      echo "</td>\n";
      echo "<td width=\"50%\" align=\"left\" valign=\"middle\" bgcolor=\"$bgcolor1\">\n";
      echo "<br><p align=\"center\">\n";
      echo "<input type=\"hidden\" name=\"op\" value=\"MSAuserinfo\">\n";
      echo "<input type=\"submit\" value=\""._MSA_SEARCHUSER."\">\n";
      echo "</form>\n";
      echo "</td>\n";
      echo "</tr>\n";
      // Search for an IP-address
      echo "<tr>\n";
      echo "<td width=\"50%\" align=\"center\" valign=\"middle\" bgcolor=\"$bgcolor1\">\n";
      echo "<form action=\"modules.php?name=$module_name&file=scripts&targetscript=userinfo\" method=\"post\">\n";
      echo "<input type=\"text\" name=\"ipaddr\" size=\"20\">\n";
      echo "</td>\n";
      echo "<td width=\"50%\" align=\"left\" valign=\"middle\" bgcolor=\"$bgcolor1\">\n";
      echo "<br><p align=\"center\">\n";
      echo "<input type=\"hidden\" name=\"op\" value=\"MSAuserinfo\">\n";
      echo "<input type=\"submit\" value=\""._MSA_SEARCHIP."\">\n";
      echo "</form>\n";
      echo "</td>\n";
      echo "</tr>\n";
      echo "</table></center></div>\n";
      CloseTable();
   } else { echo "Access Denied\n"; }
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisUserInfo()                                             */
/* Show Detailed User Information                                             */
/******************************************************************************/
function MSAuserinfo( $suser, $ipaddr )
{
   global $admin, $prefix, $module_name, $db;

   include( "header.php" );
   @(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
   $msaadmin = new msa_admin( $module_name );
   $msaadmin->admin_menu();
   if( $msaadmin->check_permission() == 1 ) {
      if( isset( $suser ) ) {
         if( $db->sql_numrows( $db->sql_query( "select uname from ".$prefix."_msanalysis_users where uname='$suser'" ) ) == 0 ) {
            OpenTable();
            echo "<h4 align=center><b>"._MSA_NOSUCHUSER."</b></h4>\n";
            CloseTable();
         }
         else { MSAnalysisUserInfoShow( $suser, $ipaddr ); }
      }
      else if( isset( $ipaddr ) ) {
         if( $db->sql_numrows( $db->sql_query( "select ip_addr from ".$prefix."_msanalysis_users where ip_addr='$ipaddr'" ) ) == 0 ) {
            OpenTable();
            echo "<h4 align=center><b>"._MSA_NOSUCHIPADDR."</b></h4>\n";
            CloseTable();
         }
         else { MSAnalysisUserInfoShow( $suser, $ipaddr ); }
      }
   } else { echo "Access Denied\n"; }
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSAnalysisUserInfoShow()                                         */
/* Show All userinfo for specified Username or IP-address                     */
/******************************************************************************/
function MSAnalysisUserInfoShow( $suser, $ipaddr )
{
   global $admin, $prefix, $user_prefix, $module_name, $db, $bgcolor2, $bgcolor1;

   $msa = new msanalysis();

   echo "<br>\n";
   OpenTable();
   if( isset( $suser ) ) {
      $result = $db->sql_query( "select uname, browser, os, ip_addr, domain, host, time, hits from ".$prefix."_msanalysis_users where uname='$suser'" );
      list( $uname, $browser, $os, $ip_addr, $domain, $host, $time, $hits ) = $db->sql_fetchrow( $result );
   }
   else if( isset( $ipaddr ) ) {
      $result = $db->sql_query( "select uname, browser, os, ip_addr, domain, host, time, hits from ".$prefix."_msanalysis_users where ip_addr='$ipaddr'" );
      list( $uname, $browser, $os, $ip_addr, $domain, $host, $time, $hits ) = $db->sql_fetchrow( $result );
      $suser = $uname;
   }

   $result = $db->sql_query( "select user_id, name, user_email, user_website, user_avatar, user_regdate, user_occ, user_interests, user_sig from ".$user_prefix."_users where username='$suser'" );
   list( $user_id, $name, $user_email, $user_website, $user_avatar, $user_regdate, $user_occ, $user_interests, $user_sig ) = $db->sql_fetchrow( $result );

   echo "<center>\n";
   echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" width=\"70%\" bgcolor=$bgcolor2 class=\"content\">\n";
   echo "<tr class=\"title\">\n";
   echo "<td width=\"100%\" colspan=\"2\" bgcolor=$bgcolor2>\n";
   if( $user_avatar != "" ) {
      if( substr( $user_avatar, 0, 7 ) == "http://" ) {
         echo "<p align=\"center\"><img src=\"$user_avatar\"><br><font color=\"#FF0000\">$uname</font></td>\n";
      }
      else {
         if( file_exists( "modules/Forums/images/avatars/$user_avatar" ) ) {
            echo "<p align=\"center\"><img src=\"modules/Forums/images/avatars/$user_avatar\"><br><font color=\"#FF0000\">$uname</font></td>\n";
         }
         else { echo "<p align=\"center\"><img src=\"modules/Forums/images/avatars/blank.gif\"><br><font color=\"#FF0000\">$uname</font></td>\n"; }
      }
   }
   else { echo "<p align=\"center\"><font color=\"#FF0000\">$uname</font></td>\n"; }
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_USERNAME."</td>\n";
   echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b>$name</b></td>\n";
   echo "</tr>\n";
   echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_EMAIL."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b><a href=\"mailto:$user_email\">$user_email</a></b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_URL."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b><a href=".$user_website." target=_new>$user_website</a></b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_REGDATE."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b>$user_regdate</b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_OCC."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b>$user_occ</b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_INTREST."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b>$user_interests</b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_SIG."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b>$user_sig</b></td>\n";
      echo "</tr>\n";

      $sym = $msa->GetBrowserPicture( $browser );
      $symp = "modules/$module_name/images/browsers/$sym".".gif";
	  if( !( file_exists( $symp ) ) ) $symp = "modules/$module_name/images/browsers/blank.gif";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_BROWSER."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<img src=\"$symp\" ALT=\"$browser\" TITLE=\"$browser\" border=\"0\">&nbsp;<b>$browser</b></td>\n";
      echo "</tr>\n";

      $sym = $msa->GetOSPicture( $os );
	  $symp = "modules/$module_name/images/os/$sym".".gif";
	  if( !( file_exists( $symp ) ) ) $symp = "modules/$module_name/images/os/blank.gif";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_OS."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<img src=\"$symp\" ALT=\"$os\" TITLE=\"$os\" border=\"0\">&nbsp;<b>$os</b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_IP."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b><a href=\"http://www.samspade.org/t/lookat?a=$ip_addr\" target=\"_blank\">$ip_addr</a></b></td>\n";
      echo "</tr>\n";

      $result = $db->sql_query( "select description from ".$prefix."_msanalysis_domains where domain = '$domain'" );
      list( $description ) = $db->sql_fetchrow( $result );
      $sym = "modules/$module_name/images/flags/$domain".".gif";
      if( !( file_exists( $sym ) ) ) $sym = "modules/$module_name/images/flags/blank.gif";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_COUNTRY."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<img src=\"$sym\" ALT=\"$description\" TITLE=\"$description\" width=\"24\" height=\"15\" border=\"0\">&nbsp;<b>$description</b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_HOST."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b>$host</b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_TIME."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b>$time</b></td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
      echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_HITS."</td>\n";
      echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b>$hits</b></td>\n";
      echo "</tr>\n";
      // Check if PHP-Nuke 7.x is installed: Show then the User Points in the overview
      $result = $db->sql_query("select points from ".$user_prefix."_users where username='$suser'" );
      list( $points ) = $db->sql_fetchrow( $result );
      if( $db->sql_numrows( $result ) > 0 ) {
         echo "<tr>\n";
         echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_POINTS."</td>\n";
         echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<b>$points</b></td>\n";
         echo "</tr>\n";
      }
      // Check if NSN Your Account Tweak is installed
      $result = $db->sql_query("select config_name from ".$prefix."_nsnya_config");
      list( $config_name ) = $db->sql_fetchrow( $result );
      if( $db->sql_numrows( $result ) > 0 ) {
         echo "<tr>\n";
         echo "<td width=\"30%\" bgcolor=$bgcolor1>"._MSA_ADMINFUNCTIONS."</td>\n";
         echo "<td width=\"80%\" bgcolor=$bgcolor1>&nbsp;<a href=\"modules.php?name=Your_Account&file=admin&op=modifyUser&chng_uid=$user_id\">"._MSA_MSAEDITUSER."</a> | <a href=\"modules.php?name=Your_Account&file=admin&op=suspendUser&chng_uid=$user_id\">"._MSA_MSASUSPENDUSER."</a> | <a href=\"modules.php?name=Your_Account&file=admin&op=deleteUser&chng_uid=$user_id\">"._MSA_MSADELETEUSER."</a></td>\n";
         echo "</tr>\n";
      }
      echo "</table>\n";
      echo "</center><br>\n";
      CloseTable();

      // Code from: NukeScripts Network (webmaster@nukescripts.net): http://www.nukescripts.net
      // Last 10 Comments
      $result = $db->sql_query( "select tid, sid, subject from ".$prefix."_comments where name='$uname' order by tid DESC limit 0,10" );
      if( ( $db->sql_numrows( $result ) > 0 ) ) {
          echo "<br>\n";
          OpenTable();
          echo "<b>"._MSA_LAST10COMMENTS." $uname:</b><br>\n";
          while( list( $tid, $sid, $subject ) = $db->sql_fetchrow( $result ) ) {
              echo "<li><a href=\"modules.php?name=News&file=article&thold=-1&mode=flat&order=0&sid=$sid#$tid\">$subject</a><br>\n";
          }
          CloseTable();
      }
      // Last 10 Submissions
      $result = $db->sql_query( "select sid, title from ".$prefix."_stories where informant='$uname' order by sid DESC limit 0,10" );
      if( ( $db->sql_numrows( $result ) > 0 ) ) {
          echo "<br>\n";
          OpenTable();
          echo "<b>"._MSA_LAST10SUBMISSIONS." $uname:</b><br>\n";
          while(list($sid, $title) = $db->sql_fetchrow( $result ) ) {
              echo "<li><a href=\"modules.php?name=News&file=article&sid=$sid\">$title</a><br>\n";
          }
          CloseTable();
      }

      // Last 10 phpBB Forum Topics
      $result1 = $db->sql_query("select t.topic_id, t.topic_title, f.forum_name, t.forum_id from ".$prefix."_bbtopics t, ".$prefix."_bbforums f where t.forum_id=f.forum_id and f.auth_view=0 and t.topic_poster='$user_id' order by t.topic_time DESC limit 0,10" );
      $result2 = $db->sql_query("select t.topic_id, t.topic_title, f.forum_name, t.forum_id from ".$prefix."_forumtopics t, ".$prefix."_forums f where t.forum_id=f.forum_id and t.topic_poster='$user_id' order by t.topic_time DESC limit 0,10" );
      if( $result1 ) {
         if( ( $db->sql_numrows( $result1 ) > 0) ) {
            echo "<br>\n";
            OpenTable();
            echo "<b>"._MSA_LAST10BBTOPICS." $uname:</b><br>\n";
            while( list( $topic_id, $topic_title, $forum_id, $forum_name ) = $db->sql_fetchrow( $result1 ) ) {
               echo "<li><a href=\"modules.php?&name=Forums&file=viewforum&f=$forum_name\">$forum_id</a> &#187 <a href=\"modules.php?&name=Forums&file=viewtopic&t=$topic_id\">$topic_title</a><br>\n";
            }
            CloseTable();
         }
      }
      // Last 10 Splatt Forum Topics
      else if( $result2 ) {
         if( ( $db->sql_numrows( $result2 ) > 0 ) ) {
            echo "<br>\n";
            OpenTable();
            echo "<b>"._MSA_LAST10BBTOPICS." $uname:</b><br>\n";
            while( list( $topic_id, $topic_title, $forum_id, $forum_name ) = $db->sql_fetchrow( $result2 ) ) {
               echo "<li><a href=\"modules.php?&name=Forums&file=viewforum&forum=$forum_name\">$forum_id</a> &#187 <a href=\"modules.php?&name=Forums&file=viewtopic&topic=$topic_id&forum=$forum_name\">$topic_title</a><br>\n";
            }
            CloseTable();
         }
      }

      // Last 10 Download Links Approved
      $result = $db->sql_query( "SELECT lid, title FROM ".$prefix."_downloads_downloads where submitter='$uname' order by date DESC limit 0,10" );
      if( ( $db->sql_numrows( $result ) > 0 ) ) {
          echo "<br>\n";
          OpenTable();
          echo "<b>"._MSA_LAST10DOWNLOADS." $uname:</b><br>\n";
          while( list( $lid, $title ) = $db->sql_fetchrow( $result ) ) {
              echo "<li><a href=\"modules.php?name=Downloads&d_op=viewdownloaddetails&lid=$lid&ttitle=$title\">$title</a><br>\n";
          }
          CloseTable();
      }
      // Last 10 Weblinks Approved
      $result = $db->sql_query( "SELECT lid, title, cid FROM ".$prefix."_links_links where submitter='$uname' order by date DESC limit 0,10" );
      if( ( $db->sql_numrows( $result ) > 0 ) ) {
          echo "<br>\n";
          OpenTable();
          echo "<b>"._MSA_LAST10WEBLINKS." $uname:</b><br>\n";
          while( list( $lid, $title, $cid ) = $db->sql_fetchrow( $result ) ) {
              echo "<li><a href=\"modules.php?op=modload&name=Web_Links&file=index&l_op=viewlink&cid=$cid\">$title</a><br>\n";
          }
          CloseTable();
      }
} // END function MSAnalysisUserInfo()

/*********************************************************/
/*                                                       */
/*********************************************************/
switch( $op )
{
   case "MSAenterinfo":
      MSAenterinfo();
   break;

   case "MSAuserinfo":
      MSAuserinfo( $suser, $ipaddr );
   break;

   case "MSAnalysisUserInfoShow":
      MSAnalysisUserInfoShow( $suser, $ipaddr );
   break;
}

?>
