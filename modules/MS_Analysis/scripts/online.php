<?php

// Show last page visitis of users/guests
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor1\">\n";
if( $staticupdate ) echo "<tr><td width=\"100%\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><b>"._MSA_ONLINETITLE1." $max_online "._MSA_ONLINETITLE2." $sitename " . _MSA_SINCE . " " . substr( $lastupdate, 11, 5 ) . "</b></td></tr>\n";
else echo "<tr><td width=\"100%\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><b>"._MSA_ONLINETITLE1." $max_online "._MSA_ONLINETITLE2." $sitename </b></td></tr>\n";
echo "<tr><td width=\"100%\">\n";

echo "<br><table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" width=\"100%\" style=\"border-collapse: collapse\" bordercolor=\"#111111\">\n";
echo "<tr><td align=\"right\" bgcolor=\"$bgcolor2\">&nbsp;</td>\n";
echo "<td align=\"center\" bgcolor=\"$bgcolor2\"><font class=\"content\"><b>"._MSA_ONLINEDATE."</b></td>\n";
echo "<td align=\"center\" bgcolor=\"$bgcolor2\"><font class=\"content\"><b>"._MSA_ONLINEUSER."</b></td>\n";
echo "<td align=\"center\" bgcolor=\"$bgcolor2\"><font class=\"content\"><b>"._MSA_ONLINEMOD."</b></td>\n";
echo "<td align=\"center\" bgcolor=\"$bgcolor2\"><font class=\"content\"><b>"._MSA_ONLINECOUNTRY."</b></td>\n";
echo "<td align=\"center\" bgcolor=\"$bgcolor2\"><font class=\"content\"><b>"._MSA_ONLINEHOST."</b></td>\n";
if( is_admin( $admin ) ) { echo "<td align=\"center\" bgcolor=\"$bgcolor2\"><font class=\"content\"><b>"._MSA_IP."</b></td>\n"; }

$result = $db->sql_query( "select time, uname, agent, ip_addr, host, domain, modulename from ".$prefix."_msanalysis_online order by time DESC limit 0, $max_online" );
while( (list( $time, $uname, $agent, $ip_addr, $host, $domain, $modulename ) = $db->sql_fetchrow( $result ) ) ) {
   $counter += 1;
   echo "<tr><td align=\"right\">$counter.</td>\n";
   echo "<td align=\"left\"><font class=\"content\">&nbsp;<b>".substr( $time, 11, 8 )."</b></td>\n";

   if( $uname != "Guest" ) {
      $flag = "modules/$module_name/images/online-user.gif";
      if( is_admin( $admin ) ) {
         echo "<td align=\"left\"><font class=\"content\"><img src=\"$flag\" ALT=\"$uname\" TITLE=\"$uname\" border=\"0\">&nbsp;<b><A HREF=\"modules.php?name=$module_name&file=scripts&targetscript=userinfo&op=MSAuserinfo&amp;suser=$uname\">".substr( $uname, 0, 7 )."</a></b></td>\n";
      } else {
         echo "<td align=\"left\"><font class=\"content\"><img src=\"$flag\" ALT=\"$uname\" TITLE=\"$uname\" border=\"0\">&nbsp;<b><A HREF=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\">".substr( $uname, 0, 7 )."</a></b></td>\n";
      }
   } else {
      $flag = "modules/$module_name/images/offline-user.gif";
      echo "<td align=\"left\"><font class=\"content\"><img src=\"$flag\" ALT=\"$uname\" TITLE=\"$uname\" border=\"0\">&nbsp;<b>"._MSA_ONLINEGUEST."</b></td>\n";
   }

   $nmodulename = strtr ( $modulename, ' ', '_' );
   $nmodulename = "<a href=\"modules.php?name=".$nmodulename."\">$modulename</a>";
   echo "<td align=\"left\"><font class=\"content\"><b>$nmodulename</b></td>\n";
   $result1 = $db->sql_query( "select description from ".$prefix."_msanalysis_domains where domain='$domain'" );
   list( $description ) = $db->sql_fetchrow( $result1 );
   $flag = "modules/$module_name/images/flags/$domain".".gif";
   if( !( file_exists( $flag ) ) ) $flag = "modules/$module_name/images/flags/blank.gif";
   echo "<td align=\"left\"><font class=\"content\"><img src=\"$flag\" ALT=\"$description\" TITLE=\"$description\" border=\"0\" width=\"16\" height=\"10\">&nbsp;<b>$description</b></td>\n";
   if( strlen( $host ) > 25 ) { $shost = substr( $host, 0, 25 ) . "..."; } else $shost = $host;
   echo "<td align=\"left\"><img src=\"modules/$module_name/images/host.gif\" ALT=\"$host\" TITLE=\"$host\" border=\"0\">&nbsp;<font class=\"content\"><b>$shost</b></td>\n";
   if( is_admin( $admin ) ) { echo "<td align=\"left\"><font class=\"content\"><b><a href=\"http://www.samspade.org/t/lookat?a=$ip_addr\" target=\"_blank\">$ip_addr</a></b></td>\n"; }
}
echo "</td></tr></table><br>\n";
echo "</td></tr></table>\n";

?>

