<?php

if( is_admin( $admin ) ) { $colspan = 8; } else { $colspan = 7; }

// Show Top-list of Users
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor1\">\n";
echo "<tr><td width=\"100%\" colspan=\"$colspan\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><b>"._MSA_TOP." $max_view "._MSA_GENUSERS." ("._MSA_GENTOTAL." $totalentries)</b></td></tr>\n";
echo "<tr><td width=\"5%\" bgcolor=\"$bgcolor2\"><p align=\"left\">&nbsp;</td>\n";
if( is_admin( $admin ) ) { echo "<td width=\"5%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\"><b>"._MSA_DELETE."</b></td>\n"; }
echo "<td width=\"15%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\">
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=A_name\"><img src=\"modules/$module_name/images/sup.gif\" ALT=\""._MSA_UP."\" TITLE=\""._MSA_UP."\" border=\"0\"></a>&nbsp;<b>"._MSA_NAME."</b>
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=D_name\"><img src=\"modules/$module_name/images/sdown.gif\" ALT=\""._MSA_DOWN."\" TITLE=\""._MSA_DOWN."\" border=\"0\"></a></td>\n";
echo "<td width=\"18%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\"><b>"._MSA_GENBROWSERS."</b></td>\n";
echo "<td width=\"17%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\"><b>"._MSA_GENOS."</b></td>\n";
echo "<td width=\"15%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\"><b>"._MSA_GENCOUNTRIES."</b></td>\n";
echo "<td width=\"15%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\">
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=A_time\"><img src=\"modules/$module_name/images/sup.gif\" ALT=\""._MSA_UP."\" TITLE=\""._MSA_UP."\" border=\"0\"></a>&nbsp;<b>"._MSA_LASTVISIT."</b>
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=D_time\"><img src=\"modules/$module_name/images/sdown.gif\" ALT=\""._MSA_DOWN."\" TITLE=\""._MSA_DOWN."\" border=\"0\"></a></td>\n";
echo "<td width=\"10%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\">
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=A_hits\"><img src=\"modules/$module_name/images/sup.gif\" ALT=\""._MSA_UP."\" TITLE=\""._MSA_UP."\" border=\"0\"></a>&nbsp;<b>"._MSA_HITS."</b>
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=D_hits\"><img src=\"modules/$module_name/images/sdown.gif\" ALT=\""._MSA_DOWN."\" TITLE=\""._MSA_DOWN."\" border=\"0\"></a></td></tr>\n";

switch( $sortby ) {
   case "A_name":
      if( $overview == 1 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitstoday from ".$prefix."_msanalysis_users WHERE today='$DateToday' AND hitstoday > 0 ORDER by uname ASC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitsxdays from ".$prefix."_msanalysis_users WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by uname ASC limit 0, $max_view" );
      else $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hits from ".$prefix."_msanalysis_users order by uname ASC limit 0, $max_view" );
   break;
   case "A_hits" :
      if( $overview == 1 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitstoday from ".$prefix."_msanalysis_users WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday ASC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitsxdays from ".$prefix."_msanalysis_users WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays ASC limit 0, $max_view" );
      else $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hits from ".$prefix."_msanalysis_users order by hits ASC limit 0, $max_view" );
   break;
   case "A_time" :
      if( $overview == 1 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitstoday from ".$prefix."_msanalysis_users WHERE today='$DateToday' AND hitstoday > 0 ORDER by time ASC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitsxdays from ".$prefix."_msanalysis_users WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by time ASC limit 0, $max_view" );
      else $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hits from ".$prefix."_msanalysis_users order by time ASC limit 0, $max_view" );
   break;
   case "D_name" :
      if( $overview == 1 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitstoday from ".$prefix."_msanalysis_users WHERE today='$DateToday' AND hitstoday > 0 ORDER by uname DESC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitsxdays from ".$prefix."_msanalysis_users WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by uname DESC limit 0, $max_view" );
      else $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hits from ".$prefix."_msanalysis_users order by uname DESC limit 0, $max_view" );
   break;
   case "D_hits" :
      if( $overview == 1 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitstoday from ".$prefix."_msanalysis_users WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitsxdays from ".$prefix."_msanalysis_users WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC limit 0, $max_view" );
      else $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hits from ".$prefix."_msanalysis_users order by hits DESC limit 0, $max_view" );
   break;
   case "D_time" :
      if( $overview == 1 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitstoday from ".$prefix."_msanalysis_users WHERE today='$DateToday' AND hitstoday > 0 ORDER by time DESC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitsxdays from ".$prefix."_msanalysis_users WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by time DESC limit 0, $max_view" );
      else $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hits from ".$prefix."_msanalysis_users order by time DESC limit 0, $max_view" );
   break;
   default:
      if( $overview == 1 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitstoday from ".$prefix."_msanalysis_users WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hitsxdays from ".$prefix."_msanalysis_users WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC limit 0, $max_view" );
      else $result = $db->sql_query( "select uid, uname, browser, os, domain, time, hits from ".$prefix."_msanalysis_users order by hits DESC limit 0, $max_view" );
}

while( list( $uid, $uname, $browser, $os, $domain, $time, $hits ) = $db->sql_fetchrow( $result ) ) {
   // Country Picture
   $result1 = $db->sql_query( "select description from ".$prefix."_msanalysis_domains where domain = '$domain'" );
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

   $daysago = $msa->DaysOld( $time );
   if( $daysago == 0 ) { $ptime = substr( $time, 11, 8 ); }
   else if( $daysago == 1 ) { $ptime = _MSA_YESTERDAY; }
   else $ptime = $daysago." " . _MSA_DAYSAGO;

   $counter += 1;
   echo "<tr><td width=\"5%\"><p align=\"left\">$counter.</td>\n";
   if( is_admin( $admin ) ) {
      echo "<td width=\"5%\" height=\"22\"><p align=\"left\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisUsersDel&amp;uid=$uid&amp;screen=$screen&amp;overview=$overview&amp;sortby=$sortby\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td>\n";
      echo "<td width=\"15%\"><p align=\"left\"><font class=\"content\"><A HREF=\"modules.php?name=$module_name&file=scripts&targetscript=userinfo&op=MSAuserinfo&amp;suser=$uname\"><b>$uname</b></a></td>\n";
   } else {
      echo "<td width=\"15%\"><p align=\"left\"><font class=\"content\"><A HREF=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\"><b>$uname</b></a></td>\n";
   }
   echo "<td width=\"18%\"><p align=\"left\"><font class=\"content\">$bsymp&nbsp;<b>$browser</b></td>\n";
   echo "<td width=\"17%\"><p align=\"left\"><font class=\"content\">$osymp&nbsp;<b>$os</b></td>\n";
   echo "<td width=\"15%\"><p align=\"left\"><font class=\"content\">$flag&nbsp;<b>$description</b></td>\n";
   echo "<td width=\"15%\"><p align=\"left\"><font class=\"content\"><b>$ptime</b></td>\n";
   echo "<td width=\"10%\"><p align=\"left\"><font class=\"content\"><b>$hits</b></td>\n";
   echo "</tr>\n";
}
echo "</table>\n";

?>
