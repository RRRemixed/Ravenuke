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

if(stristr( $_SERVER['SCRIPT_NAME'], "block-MSA_User_Info.php" ) ) {
    Header("Location: index.php");
    die();
}

$content = "";

global $user, $cookie, $prefix, $user_prefix, $db, $anonymous, $sitekey, $Version_Num, $gfx_chk;
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
      $flag = "modules/MS_Analysis/images/flags/$domain".".gif";
      if( !( file_exists( $flag ) ) ) $flag = "<img src=\"modules/MS_Analysis/images/flags/blank.gif\" width=\"14\" height=\"10\" border=\"0\">";
      else $flag = "<img src=\"$flag\" width=\"16\" height=\"10\" ALT=\"$description\" TITLE=\"$description\" border=\"0\">";
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

if (is_user($user)) {
    $content .= "<br><img src=\"images/blocks/group-4.gif\" height=\"14\" width=\"17\"> "._BWEL.", <b>$uname</b>.<br>\n<hr>\n";
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