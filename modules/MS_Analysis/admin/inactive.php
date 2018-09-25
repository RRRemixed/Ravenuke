<script language="JavaScript" type="text/javascript">
function WriteToWindow(uname, lastonline, ip_addr, user_email, user_regdate, buttonname )
{
   top.consoleRef=window.open('','myconsole',
   'width=500,height=175'
   +',menubar=0'
   +',toolbar=0'
   +',status=0'
   +',scrollbars=0'
   +',resizable=0')
   top.consoleRef.document.writeln(
   '<html><head><title>User Information</title></head>'
   +'<body bgcolor=white onLoad="self.focus()">'
   +'<table border=1 cellpadding=2 cellspacing=0 style=border-collapse: collapse bordercolor=#111111 width=100% id=AutoNumber1>'
   +'<tr>'
   +'<td width=100% colspan=2><p align=center><b>Username: '+uname+'</b></td>'
   +'</tr>'
   +'<tr>'
   +'<td width=50%>IP-Address</td>'
   +'<td width=50%>'+ip_addr+'</td>'
   +'</tr>'
   +'<tr>'
   +'<td width=50%>E-mail</td>'
   +'<td width=50%>'+user_email+'</td>'
   +'</tr>'
   +'<tr>'
   +'<td width=50%>Registration Date</td>'
   +'<td width=50%>'+user_regdate+'</td>'
   +'</tr>'
   +'<tr>'
   +'<td width=50%>Last Time Online</td>'
   +'<td width=50%>'+lastonline+'</td>'
   +'</tr>'
   +'<tr>'
   +'<td width=100% colspan=2><p align=center>[ <a href=javascript:void(0) onClick=javascript:self.close()>'+buttonname+'</a> ]</td>'
   +'</tr>'
   +'</table><br>'
   +'</body></html>'
   )
   top.consoleRef.document.close()
}
</script>

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

$index = 0;
$module_name = explode( "admin", dirname( __FILE__ ) );
$module_name = basename( $module_name[0] );

if( !stristr( $_SERVER['SCRIPT_NAME'], "modules.php" ) ) {
   die( "You can't access this file directly..." );
}

require_once( "mainfile.php" );
@(require_once( "modules/$module_name/include/class.general.php" )) OR die ("File class.general.php can not be found" );
@(require_once( "modules/$module_name/admin/class.admin.php" )) OR die ("File class.admin.php can not be found" );
get_lang( $module_name );

/******************************************************************************/
/* FUNCTION: Start                                                            */
/******************************************************************************/
function MSAinactive( )
{
   global $module_name;

   include( "header.php" );
   $msaadmin = new msa_admin( $module_name );
   if( $msaadmin->check_permission() == 1 ) {
      $msaadmin->admin_menu();
      MSADisplaySearchBox();
   } else { echo "Access Denied\n"; }
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSADisplaySearchBox                                              */
/******************************************************************************/
function MSADisplaySearchBox()
{
   global $admin, $module_name, $db, $prefix, $bgcolor1, $bgcolor2;

   echo "<br>\n";
   OpenTable();

   echo "<center>\n";
   echo "<form action=\"modules.php?name=$module_name&amp;file=scripts&targetscript=inactive\" method=\"post\">\n";
   echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" width=\"80%\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" bgcolor=$bgcolor2>\n";
   echo "<tr class=\"title\">\n";
   echo "<td width=\"100%\" height=\"30\" colspan=\"2\" bgcolor=$bgcolor2>\n";
   echo "<p align=\"center\">"._MSA_DELETEINACTIVEUSR."</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"50%\" bgcolor=$bgcolor1><b>"._MSA_SHOWINACTIVEUSR."</b></td>\n";
   $begindate = explode( "-", date( "Y-m-d" ) );
   $startday = $begindate[ 2 ]; $startmonth = $begindate[ 1 ]; $startyear = $begindate[ 0 ];
   echo "<td width=\"50%\" bgcolor=$bgcolor1>\n";
   echo "<select size=\"1\" name=\"startday\">\n";
   for( $i = 1; $i < 32; $i++ ) { if( strlen( $i ) == 1 ) $i = "0" . $i; if( $i == $startday ) { echo "<option selected>$i</option>\n"; } else { echo "<option>$i</option>\n"; } }
   echo "</select>&nbsp;-\n";
   echo "<select size=\"1\" name=\"startmonth\">\n";
   for( $i = 1; $i < 13; $i++ ) { if( strlen( $i ) == 1 ) $i = "0" . $i; if( $i == $startmonth ) { echo "<option selected>$i</option>\n"; } else { echo "<option>$i</option>\n"; } }
   echo "</select>&nbsp;-\n";
   echo "<select size=\"1\" name=\"startyear\">\n";
   for( $i = 2002; $i < 2026; $i++ ) { if( $i == $startyear ) { echo "<option selected>$i</option>\n"; } else { echo "<option>$i</option>\n"; } }
   echo "</select>\n";
   echo "</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"100%\" valign=\"top\" colspan=\"2\" bgcolor=$bgcolor1>\n";
   echo "<input type=\"hidden\" name=\"op\" value=\"MSADisplayInactiveUsers\">\n";
   echo "<p align=\"center\"><input type=\"submit\" value=\""._MSA_SEARCHINACTIVEUSR."\"></td>\n";
   echo "</tr>\n";
   echo "</table>\n";
   echo "</form>\n";
   echo "</center>\n";
   CloseTable();
}

/******************************************************************************/
/* FUNCTION: MSADisplayInactiveUsers                                          */
/******************************************************************************/
function MSADisplayInactiveUsers( $startday, $startmonth, $startyear, $page )
{
   global $db, $prefix, $user_prefix, $module_name, $bgcolor1, $bgcolor2;

   include( "header.php" );

   $msaadmin = new msa_admin( $module_name );
   $msa = new msanalysis();
   $msaadmin->admin_menu();

   OpenTable();
   // Get the maximum amount of lines that should be displayed
   $result = $db->sql_query( "select max_inactive from ".$prefix."_msanalysis_admin where id='1'" );
   list( $usersperpage ) = $db->sql_fetchrow( $result );

   // Determine amount of 'inactive' users
   $total_users = 0;
   $entered_time = mktime( 0, 0, 0, $startmonth, $startday, $startyear, -1 );
   $result = $db->sql_query( "select time from ".$prefix."_msanalysis_users" );
   while( list ( $time ) = $db->sql_fetchrow( $result ) )
   {
      $laststring = explode ( "-", substr( $time, 0, 10 ) );
      $lastonline_time = mktime( 0, 0, 0, $laststring[1], $laststring[2], $laststring[0], -1 );
      if( $lastonline_time < $entered_time ) { $total_users += 1; }
   }

   // Calculate how many pages have to be printed on one page.
   // $usersperpage tells how many users per page have to be displayed
   // $Page are the number of pages that should be displayed in case the total amount of inactive MSA users > $usersperpage (allowed Users per Page)
   if( ! isset( $page ) ) $page = 1;
   if( $total_users > $usersperpage ) {
      $nbr_pages = ceil( $total_users / $usersperpage );
      if( $page > $nbr_pages) { $page = $nbr_pages; }
   } else { // show all inactive usernames at once
      $start_row = 0;
      $nbr_pages = 1;
      $page = 1;
   }

   echo "<div align=\"center\"><center>\n";
   echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" width=\"95%\" bgcolor=$bgcolor2 style=\"border-collapse: collapse\" bordercolor=\"#111111\">\n";
   echo "<tr class=\"title\">\n";
   echo "<td width=\"100%\" height=\"30\" colspan=\"5\" bgcolor=$bgcolor2>\n";
   echo "<p align=\"center\">"._MSA_INACTIVEUSR." $startday-$startmonth-$startyear</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=\"20%\" height=\"20\" bgcolor=$bgcolor1 align=\"center\"><b>" . _MSA_NAME . "</b></td>\n";
   echo "<td width=\"30%\" height=\"20\" bgcolor=$bgcolor1 align=\"center\"><b>" . _MSA_LASTVISIT . "</b></td>\n";
   echo "<td width=\"30%\" height=\"20\" bgcolor=$bgcolor1 align=\"center\"><b>" . _MSA_EMAIL . "</b></td>\n";
   echo "<td width=\"10%\" height=\"20\" bgcolor=$bgcolor1 align=\"center\"><b>" . _MSA_DELINACTIVEMSA . "</b></td>\n";
   echo "<td width=\"10%\" height=\"20\" bgcolor=$bgcolor1 align=\"center\"><b>" . _MSA_DELINACTIVEMSAPHP . "</b></td>\n";
   echo "</tr>\n";

   $counter = 0;
   $result = $db->sql_query( "select uid, uname, ip_addr, time from ".$prefix."_msanalysis_users ORDER BY time ASC" );
   while( ( list( $uid, $uname, $ip_addr, $time ) = $db->sql_fetchrow( $result ) ) AND ( $counter < ( $usersperpage * $page ) ) ) {
      $laststring = explode ( "-", substr( $time, 0, 10 ) );
      $lastonline_time = mktime( 0, 0, 0, $laststring[1], $laststring[2], $laststring[0], -1 );
      if( $lastonline_time < $entered_time ) {
         $counter += 1;
         if( ( $usersperpage * ( $page - 1 ) ) < $counter ) {
            $result1 = $db->sql_query( "select user_id, username, user_email, user_regdate from ".$user_prefix."_users where username='$uname'" );
            $MSAinactive = $db->sql_fetchrow( $result1 );

            // When was user lasttime online
            $daysago = $msa->DaysOld( $time );
            if( $daysago == 0 ) { $ptime = substr( $time, 11, 8 ); }
            else if( $daysago == 1 ) { $ptime = _MSA_YESTERDAY; }
            else $ptime = $daysago." " . _MSA_DAYSAGO;

            $pu = "<a href=\"javascript:WriteToWindow('$uname', '$time', '$ip_addr', '".$MSAinactive[user_email]."', '".$MSAinactive[user_regdate]."', '"._MSA_CLOSE."')\">$uname";
            echo "<tr>\n";
            echo "<td width=\"20%\" height=\"20\" bgcolor=$bgcolor1><b>$pu</b></td>\n";
            echo "<td width=\"30%\" height=\"20\" bgcolor=\"$bgcolor1\" align=\"left\">" . substr( $time, 0, 10 ) . " ($ptime)</td>\n";
            echo "<td width=\"30%\" height=\"20\" bgcolor=$bgcolor1><b><a href=\"mailto:".$MSAinactive[user_email]."\">".$MSAinactive[user_email]."</a></b></td>\n";
            echo "<td width=\"10%\" height=\"20\" bgcolor=$bgcolor1><p align=\"center\"><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=inactive&amp;op=MSACDeleteInactiveUser&amp;MSAid=$uid&amp;PHPid=" . $MSAinactive[user_id] . "&amp;in_user=$uname&amp;delusr=0&amp;startday=$startday&amp;startmonth=$startmonth&amp;startyear=$startyear&amp;page=$page\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td>\n";
            echo "<td width=\"10%\" height=\"20\" bgcolor=$bgcolor1><p align=\"center\"><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=inactive&amp;op=MSACDeleteInactiveUser&amp;MSAid=$uid&amp;PHPid=" . $MSAinactive[user_id] . "&amp;in_user=$uname&amp;delusr=1&amp;startday=$startday&amp;startmonth=$startmonth&amp;startyear=$startyear&amp;page=$page\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td>\n";
            echo "</tr>\n";
         }
      }
   }
   echo "<tr>\n";
   echo "<td width=\"100%\" valign=\"top\" colspan=\"5\" height=\"25\" bgcolor=$bgcolor1>\n";

   echo "<p align=\"center\"><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=inactive&amp;op=MSACDeleteInactiveUsers&amp;delusr=0&amp;startday=$startday&amp;startmonth=$startmonth&amp;startyear=$startyear&amp;page=$page\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"><b>" . _MSA_DELETEALLINACTIVEUSR1 . ": $total_users " . _MSA_SELECTEDINACTIVEUSR . "</b></a><br>\n";
   echo "<a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=inactive&amp;op=MSACDeleteInactiveUsers&amp;delusr=1&amp;startday=$startday&amp;startmonth=$startmonth&amp;startyear=$startyear&amp;page=$page\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"><b>" . _MSA_DELETEALLINACTIVEUSR2 . ": $total_users " . _MSA_SELECTEDINACTIVEUSR . "</b></a><br>\n";
   echo "</td>\n";
   echo "<tr>\n";
   echo "<td width=\"100%\" valign=\"top\" colspan=\"5\" bgcolor=$bgcolor2>\n";
   // Display Pages + Sort on
   if( $nbr_pages > 1 ) {
      echo "<form method=\"post\" action=\"modules.php?name=$module_name&file=scripts&targetscript=inactive&op=MSADisplayInactiveUsers&startday=$startday&startmonth=$startmonth&startyear=$startyear&page=$page\">\n";
      echo "<center>"._MSA_PAGE2." <select name=\"page\" size=\"1\" onChange=\"submit()\">\n";
      for( $i = 1; $i <= $nbr_pages; $i++ ) {
         if( $i == $page ) { echo "<option value=$i selected>".$i."</option>\n"; } else { echo "<option value=$i>".$i."</option>\n"; }
      }
      echo "</select></center></form>\n";
   }
   echo "<center>"._MSA_PAGE1.": <b>$page</b> " . _MSA_PAGE3 . " $nbr_pages " ._MSA_PAGE4 . "<br><br>\n";
   echo "</td>\n";
   echo "</tr>\n";
   echo "</table></center></div>\n";

   CloseTable();
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSACDeleteInactiveUser                                           */
/******************************************************************************/
function MSACDeleteInactiveUser( $MSAid, $PHPid, $in_user, $delusr, $startday, $startmonth, $startyear, $page )
{
   global $db, $prefix, $user_prefix, $module_name, $bgcolor1, $bgcolor2;

   // Ask for Conformation
   include( "header.php" );
   OpenTable();
   if( $delusr == 0 ) echo "<h5 align=center><b>"._MSA_CDELINACTIVEMSA."</b></h5>\n";
   else echo "<h5 align=center><b>"._MSA_CDELINACTIVEMSAPHP."</b></h5>\n";

   $result = $db->sql_query( "select uname, ip_addr, time from ".$prefix."_msanalysis_users WHERE uid='$MSAid'" );
   list( $uname, $ip_addr, $lastonline ) = $db->sql_fetchrow( $result );
   $result1 = $db->sql_query( "select user_email, user_regdate from ".$user_prefix."_users where username='$uname'" );
   list( $user_email, $user_regdate ) = $db->sql_fetchrow( $result1 );

   echo "<div align=\"center\"><center>\n";
   echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" width=\"95%\" bgcolor=$bgcolor2 style=\"border-collapse: collapse\" bordercolor=\"#111111\">\n";
   echo "<tr>\n";
   echo "<td width=100% colspan=2><p align=center><b>"._MSA_USERNAME.": $uname</b></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=50% bgcolor=$bgcolor1>"._MSA_IP."</td>\n";
   echo "<td width=50% bgcolor=$bgcolor1>$ip_addr</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=50% bgcolor=$bgcolor1>"._MSA_EMAIL."</td>\n";
   echo "<td width=50% bgcolor=$bgcolor1>$user_email</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=50% bgcolor=$bgcolor1>"._MSA_REGDATE."</td>\n";
   echo "<td width=50% bgcolor=$bgcolor1>$user_regdate</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=50% bgcolor=$bgcolor1>"._MSA_TIME."</td>\n";
   echo "<td width=50% bgcolor=$bgcolor1>$lastonline</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td width=100% colspan=2><p align=center>\n";
   echo "[ <a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=inactive&amp;op=MSADisplayInactiveUsers&amp;startday=$startday&amp;startmonth=$startmonth&amp;startyear=$startyear&amp;page=$page\">"._MSA_GOBACK."</a> ÷\n";
   echo "<a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=inactive&amp;op=MSADeleteInactiveUser&amp;MSAid=$MSAid&amp;PHPid=$PHPid&amp;in_user=$in_user&amp;delusr=$delusr&amp;startday=$startday&amp;startmonth=$startmonth&amp;startyear=$startyear&amp;page=$page\">"._MSA_MSADELETEUSER."</a> ]</td>\n";
   echo "</tr>\n";
   echo "</table></center></div>\n";

   CloseTable(); echo "<br>";
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSADeleteInactiveUser                                            */
/******************************************************************************/
function MSADeleteInactiveUser( $MSAid, $PHPid, $in_user, $delusr, $startday, $startmonth, $startyear, $page )
{
   global $db, $prefix, $user_prefix, $module_name;

   // Delete from MSA Users Table
   $db->sql_query("delete from ".$prefix."_msanalysis_users where uname='$in_user'");
   $db->sql_query("OPTIMIZE TABLE ".$prefix."_msanalysis_users");

   // Delete from PHP-Nuke Users Table
   if( $delusr == 1 ) {
      $db->sql_query("delete from ".$user_prefix."_users where username='$in_user'");
      $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_users");
   }

   MSADisplayInactiveUsers( $startday, $startmonth, $startyear, $page );
}


/******************************************************************************/
/* FUNCTION: MSACDeleteInactiveUsers                                          */
/******************************************************************************/
function MSACDeleteInactiveUsers( $delusr, $startday, $startmonth, $startyear, $page )
{
   global $db, $prefix, $user_prefix, $module_name, $bgcolor1, $bgcolor2;

   // Ask for Conformation
   include( "header.php" );
   OpenTable();
   if( $delusr == 0 ) echo "<h5 align=center><b>"._MSA_CDELINACTIVESMSA."</b></h5>\n";
   else echo "<h5 align=center><b>"._MSA_CDELINACTIVESMSAPHP."</b></h5>\n";

   $result = $db->sql_query( "select uname, ip_addr, time from ".$prefix."_msanalysis_users WHERE uid='$MSAid'" );
   list( $uname, $ip_addr, $lastonline ) = $db->sql_fetchrow( $result );
   $result1 = $db->sql_query( "select user_email, user_regdate from ".$user_prefix."_users where username='$uname'" );
   list( $user_email, $user_regdate ) = $db->sql_fetchrow( $result1 );

   echo "<center>[ <a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=inactive&amp;op=MSADisplayInactiveUsers&amp;startday=$startday&amp;startmonth=$startmonth&amp;startyear=$startyear&amp;page=$page\">"._MSA_GOBACK."</a> ÷\n";
   echo "<a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=inactive&amp;op=MSADeleteInactiveUsers&amp;delusr=$delusr&amp;startday=$startday&amp;startmonth=$startmonth&amp;startyear=$startyear&amp;page=$page\">"._MSA_MSADELETEUSERS."</a> ]</cemter>\n";

   CloseTable(); echo "<br>";
   include( "footer.php" );
}

/******************************************************************************/
/* FUNCTION: MSADeleteInactiveUsers                                           */
/******************************************************************************/
function MSADeleteInactiveUsers( $delusr, $startday, $startmonth, $startyear, $page )
{
   global $db, $prefix, $user_prefix, $module_name;

   // Delete all selected inactive users from the MSA Users Table
   $entered_time = mktime( 0, 0, 0, $startmonth, $startday, $startyear, -1 );
   $result = $db->sql_query( "select uname, time from ".$prefix."_msanalysis_users" );
   while( list ( $uname, $time ) = $db->sql_fetchrow( $result ) ) {
      $laststring = explode ( "-", substr( $time, 0, 10 ) );
      $lastonline_time = mktime( 0, 0, 0, $laststring[1], $laststring[2], $laststring[0], -1 );
      if( $lastonline_time < $entered_time ) {
         // Delete from MSA Users Table
         $db->sql_query("delete from ".$prefix."_msanalysis_users where uname='$uname'");
         // Delete from PHP-Nuke Users Table
         if( $delusr == 1 ) {
            $db->sql_query("delete from ".$user_prefix."_users where username='$uname'");
         }
      }
   }
   $db->sql_query("OPTIMIZE TABLE ".$prefix."_msanalysis_users");
   $db->sql_query("OPTIMIZE TABLE ".$user_prefix."_users");

   MSAinactive();
}

/***************************************************/
/****************** PROGRAM START ******************/
/***************************************************/
switch ( $op )
{
   case "MSAinactive":
      MSAinactive( );
   break;

   case "MSADisplaySearchBox":
      MSADisplaySearchBox();
   break;

   case "MSADisplayInactiveUsers":
      MSADisplayInactiveUsers( $startday, $startmonth, $startyear, $page );
   break;

   case "MSACDeleteInactiveUser";
      MSACDeleteInactiveUser( $MSAid, $PHPid, $in_user, $delusr, $startday, $startmonth, $startyear, $page );
   break;

   case "MSADeleteInactiveUser";
      MSADeleteInactiveUser( $MSAid, $PHPid, $in_user, $delusr, $startday, $startmonth, $startyear, $page );
   break;

   case "MSACDeleteInactiveUsers";
      MSACDeleteInactiveUsers( $delusr, $startday, $startmonth, $startyear, $page );
   break;

   case "MSADeleteInactiveUsers";
      MSADeleteInactiveUsers( $delusr, $startday, $startmonth, $startyear, $page );
   break;
}

?>