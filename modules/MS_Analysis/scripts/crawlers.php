<?php

if( is_admin( $admin ) ) { $colspan = 5; } else { $colspan = 4; }
// Show Top-list of Webcrawlers
$totalentries = $msa->CountLines( 10, $overview, $DateToday, $xdate );
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor1\">\n";
echo "<tr><td width=\"100%\" colspan=\"$colspan\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><b>"._MSA_TOP." $max_view "._MSA_GENOTHERBROWSERS." ("._MSA_GENTOTAL." $totalentries)</b></td></tr>\n";
echo "<tr><td width=\"10%\" bgcolor=\"$bgcolor2\"><p align=\"center\">&nbsp;</td>\n";
if( is_admin( $admin ) ) { echo "<td width=\"10%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\"><b>"._MSA_DELETE."</b></td>"; }
echo "<td width=\"70%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\">
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=A_name\"><img src=\"modules/$module_name/images/sup.gif\" ALT=\""._MSA_UP."\" TITLE=\""._MSA_UP."\" border=\"0\"></a>&nbsp;&nbsp;&nbsp;&nbsp;<b>"._MSA_NAME."</b>&nbsp;&nbsp;&nbsp;&nbsp;
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=D_name\"><img src=\"modules/$module_name/images/sdown.gif\" ALT=\""._MSA_DOWN."\" TITLE=\""._MSA_DOWN."\" border=\"0\"></a></td>\n";
echo "<td width=\"10%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\">
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=A_hits\"><img src=\"modules/$module_name/images/sup.gif\" ALT=\""._MSA_UP."\" TITLE=\""._MSA_UP."\" border=\"0\"></a>&nbsp;&nbsp;&nbsp;&nbsp;<b>"._MSA_HITS."</b>&nbsp;&nbsp;&nbsp;&nbsp;
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=D_hits\"><img src=\"modules/$module_name/images/sdown.gif\" ALT=\""._MSA_DOWN."\" TITLE=\""._MSA_DOWN."\" border=\"0\"></a></td></tr>\n";

switch( $sortby ) {
   case "A_name":
      if( $overview == 1 ) $result = $db->sql_query( "select id, ibrowser, hitstoday from ".$prefix."_msanalysis_browsers WHERE today='$DateToday' AND hitstoday > 0 ORDER by ibrowser ASC" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, ibrowser, hitsxdays from ".$prefix."_msanalysis_browsers WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by ibrowser ASC" );
      else $result = $db->sql_query( "select id, ibrowser, hits from ".$prefix."_msanalysis_browsers order by ibrowser ASC" );
   break;
   case "A_hits" :
      if( $overview == 1 ) $result = $db->sql_query( "select id, ibrowser, hitstoday from ".$prefix."_msanalysis_browsers WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday ASC" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, ibrowser, hitsxdays from ".$prefix."_msanalysis_browsers WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays ASC" );
      else $result = $db->sql_query( "select id, ibrowser, hits from ".$prefix."_msanalysis_browsers order by hits ASC" );
   break;
   case "D_name" :
      if( $overview == 1 ) $result = $db->sql_query( "select id, ibrowser, hitstoday from ".$prefix."_msanalysis_browsers WHERE today='$DateToday' AND hitstoday > 0 ORDER by ibrowser DESC" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, ibrowser, hitsxdays from ".$prefix."_msanalysis_browsers WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by ibrowser DESC" );
      else $result = $db->sql_query( "select id, ibrowser, hits from ".$prefix."_msanalysis_browsers order by ibrowser DESC" );
   break;
   case "D_hits" :
      if( $overview == 1 ) $result = $db->sql_query( "select id, ibrowser, hitstoday from ".$prefix."_msanalysis_browsers WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, ibrowser, hitsxdays from ".$prefix."_msanalysis_browsers WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC" );
      else $result = $db->sql_query( "select id, ibrowser, hits from ".$prefix."_msanalysis_browsers order by hits DESC" );
   break;
   default:
      if( $overview == 1 ) $result = $db->sql_query( "select id, ibrowser, hitstoday from ".$prefix."_msanalysis_browsers WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, ibrowser, hitsxdays from ".$prefix."_msanalysis_browsers WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC" );
      else $result = $db->sql_query( "select id, ibrowser, hits from ".$prefix."_msanalysis_browsers order by hits DESC" );
}

while( ( list( $id, $ibrowser, $hits ) = $db->sql_fetchrow( $result ) ) AND ( $counter < $max_view ) ) {
   if( eregi( "Web Crawler", $ibrowser ) ) {
      $counter += 1;
      echo "<tr><td width=\"10%\"><p align=\"center\">$counter.</td>\n";
      if( is_admin( $admin ) ) { echo "<td width=\"10%\" height=\"22\"><p align=\"center\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisBrowsersDel&amp;id=$id&amp;screen=$screen&amp;overview=$overview&amp;sortby=$sortby\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td>\n"; }
      echo "<td width=\"70%\"><p align=\"left\"><font class=\"content\"><b>$ibrowser</b></td>\n";
      echo "<td width=\"10%\"><p align=\"center\"><font class=\"content\"><b>$hits</b></td></tr>\n";
   }
}
echo "</table>\n";

?>
