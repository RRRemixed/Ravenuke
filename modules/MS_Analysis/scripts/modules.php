<?php

if( is_admin( $admin ) ) { $colspan = 6; } else { $colspan = 5; }
// Show Top-list of Modules
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor1\">\n";
echo "<tr><td width=\"100%\" colspan=\"$colspan\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><b>"._MSA_TOP." $max_view "._MSA_GENMODULES." ("._MSA_GENTOTAL." $totalentries)</b></td></tr>\n";
echo "<tr><td width=\"10%\" bgcolor=\"$bgcolor2\"><p align=\"center\">&nbsp;</td>\n";
if( is_admin( $admin ) ) { echo "<td width=\"5%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\"><b>"._MSA_DELETE."</b></td>\n"; }
echo "<td width=\"30%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\">
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=A_name\"><img src=\"modules/$module_name/images/sup.gif\" ALT=\""._MSA_UP."\" TITLE=\""._MSA_UP."\" border=\"0\"></a>&nbsp;&nbsp;&nbsp;&nbsp;<b>"._MSA_NAME."</b>&nbsp;&nbsp;&nbsp;&nbsp;
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=D_name\"><img src=\"modules/$module_name/images/sdown.gif\" ALT=\""._MSA_DOWN."\" TITLE=\""._MSA_DOWN."\" border=\"0\"></a></td>\n";
echo "<td width=\"35%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\">
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=A_hits\"><img src=\"modules/$module_name/images/sup.gif\" ALT=\""._MSA_UP."\" TITLE=\""._MSA_UP."\" border=\"0\"></a>&nbsp;&nbsp;&nbsp;&nbsp;<b>"._MSA_HITS."</b>&nbsp;&nbsp;&nbsp;&nbsp;
     <a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisGeneral&amp;screen=$screen&amp;overview=$overview&amp;sortby=D_hits\"><img src=\"modules/$module_name/images/sdown.gif\" ALT=\""._MSA_DOWN."\" TITLE=\""._MSA_DOWN."\" border=\"0\"></a></td>\n";
echo "<td width=\"20%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\"><b>"._MSA_HITS."</b></td></tr>\n";

switch( $sortby ) {
   case "A_name":
      if( $overview == 1 ) $result = $db->sql_query( "select id, modulename, hitstoday from ".$prefix."_msanalysis_modules WHERE today='$DateToday' AND hitstoday > 0 ORDER by modulename ASC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, modulename, hitsxdays from ".$prefix."_msanalysis_modules WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by modulename ASC limit 0, $max_view" );
      else $result = $db->sql_query( "select id, modulename, hits from ".$prefix."_msanalysis_modules order by modulename ASC limit 0, $max_view" );
   break;
   case "A_hits" :
      if( $overview == 1 ) $result = $db->sql_query( "select id, modulename, hitstoday from ".$prefix."_msanalysis_modules WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday ASC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, modulename, hitsxdays from ".$prefix."_msanalysis_modules WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays ASC limit 0, $max_view" );
      else $result = $db->sql_query( "select id, modulename, hits from ".$prefix."_msanalysis_modules order by hits ASC limit 0, $max_view" );
   break;
   case "D_name" :
      if( $overview == 1 ) $result = $db->sql_query( "select id, modulename, hitstoday from ".$prefix."_msanalysis_modules WHERE today='$DateToday' AND hitstoday > 0 ORDER by modulename DESC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, modulename, hitsxdays from ".$prefix."_msanalysis_modules WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by modulename DESC limit 0, $max_view" );
      else $result = $db->sql_query( "select id, modulename, hits from ".$prefix."_msanalysis_modules order by modulename DESC limit 0, $max_view" );
   break;
   case "D_hits" :
      if( $overview == 1 ) $result = $db->sql_query( "select id, modulename, hitstoday from ".$prefix."_msanalysis_modules WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, modulename, hitsxdays from ".$prefix."_msanalysis_modules WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC limit 0, $max_view" );
      else $result = $db->sql_query( "select id, modulename, hits from ".$prefix."_msanalysis_modules order by hits DESC limit 0, $max_view" );
   break;
   default:
      if( $overview == 1 ) $result = $db->sql_query( "select id, modulename, hitstoday from ".$prefix."_msanalysis_modules WHERE today='$DateToday' AND hitstoday > 0 ORDER by hitstoday DESC limit 0, $max_view" );
      elseif( $overview == 2 ) $result = $db->sql_query( "select id, modulename, hitsxdays from ".$prefix."_msanalysis_modules WHERE xdays='$xdate' AND hitsxdays > 0 ORDER by hitsxdays DESC limit 0, $max_view" );
      else $result = $db->sql_query( "select id, modulename, hits from ".$prefix."_msanalysis_modules order by hits DESC limit 0, $max_view" );
}

while( list( $id, $modulename, $hits ) = $db->sql_fetchrow( $result ) ) {
   $counter += 1;
   $nmodulename = strtr ( $modulename, ' ', '_' );
   $nmodulename = "<a href=\"modules.php?name=".$nmodulename."\">$modulename</a>";
   echo "<tr><td width=\"10%\"><p align=\"center\">$counter.</td>\n";
   if( is_admin( $admin ) ) { echo "<td width=\"5%\" height=\"22\"><p align=\"center\"><a href=\"modules.php?name=$module_name&amp;file=index&amp;op=MSAnalysisModulesDel&amp;id=$id&amp;screen=$screen&amp;overview=$overview&amp;sortby=$sortby\"><img src=\"modules/$module_name/images/delete.gif\" border=\"0\" align=\"bottom\"></a></td>\n"; }
   echo "<td width=\"30%\"><p align=\"left\"><font class=\"content\"><b>$nmodulename</b></td>\n";
   $graphhits = substr( 100 * $hits / $totalhits, 0, 5);
   echo "<td width=\"35%\" nowrap><p align=\"left\"><font class=\"content\"><img src=\"themes/$ThemeSel/images/leftbar.gif\" height=\"".$msa->l_size[1]."\" width=\"".$msa->l_size[0]."\" Alt=\"$modulename\" title=\"$modulename\"><img src=\"themes/$ThemeSel/images/mainbar.gif\" Alt=\"$modulename\" title=\"$modulename\" height=\"".$msa->m_size[1]."\" width=", $graphhits * 2, "><img src=\"themes/$ThemeSel/images/rightbar.gif\" height=\"".$msa->r_size[1]."\" width=\"".$msa->r_size[0]."\" Alt=\"$modulename\" Title=\"$modulename\"></td>\n";
   echo "<td width=\"20%\"><p align=\"left\"><font class=\"content\"><b> $graphhits %</b> ($hits)</td></tr>\n";
}
echo "</table>\n";

?>
