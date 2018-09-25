<?php

// Total amount of downloads
$download_info = explode("|", $msa->TotalDownloads( ) );
// Determine how many MBytes is already downloaded from the Site
$mbdwn = $msa->TotalMBDownloads( );
// Total Hits
$total = $msa->TotalVisits( );
OpenTable();
echo "<center><font class=\"option\"><b>$sitename "._MSA_STATS." - "._MSA_GENTITLE."</b></font><br><br>"._MSA_WERECEIVED." <b>$total</b> "._MSA_PAGESVIEWS." <b>$startdate</b>\n";
echo "<br>"._MSA_DOWNLOADS1. " <a href=modules.php?name=Downloads>".$download_info[ 0 ]. "</a> "._MSA_DOWNLOADS2. " ".$download_info[ 1 ]. " "._MSA_DOWNLOADS3."<br>"._MSA_TODAYIS." <b>".$msa->MSLogDate( 0 )."</b><br><br>\n";
// Most visited Month, Day and Hour
echo $msa->MostMonth();
echo $msa->MostDay();
echo $msa->MostHour();
echo "<br></center>";
CloseTable();
echo "<br>\n";

/* Determine General Site Statistics */
$totmembers     = $db->sql_numrows( $db->sql_query( "select * from ".$user_prefix."_users" ) ) - 1;
$totauthors     = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_authors" ) );
$totstories     = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_stories" ) );
$totcom         = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_comments" ) );
$totseccont     = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_seccont" ) );
$totnewswaiting = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_queue" ) );
$tottopics      = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_topics" ) );
$totpcat        = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_pages_categories" ) );
$totpages       = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_pages" ) );
$totlinks       = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_links_links" ) );
$totlinkscat    = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_links_categories" ) );
$totsec         = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_sections" ) );
$totrev         = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_reviews" ) );
$totfaq         = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_faqcategories" ) );
$totdowncat     = $db->sql_numrows( $db->sql_query( "select * from ".$prefix."_downloads_categories" ) );

/* Write General Site Statistics */
$OutputBuffer  = "<br><center><table width=\"50%\" border=\"1\" cellspacing=\"2\" cellpadding=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\"><tr>\n";
$OutputBuffer .= "<td bgcolor=$bgcolor2 colspan=\"2\" height=\"25\" align=\"center\"><b>"._MSA_MISCSTATS."</b></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/authors.gif\"   border=\"0\" alt=\"\">"._MSA_ACTIVEAUTHORS."</td><td bgcolor=$bgcolor1><center><b>$totauthors</b></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/mem.gif\" align=\"absmiddle\">"._MSA_TOTMEM."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Members_List><b>$totmembers</b></a></b></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/counter.gif\" align=\"absmiddle\">"._MSA_TOTHITS."$startdate:</td><td bgcolor=$bgcolor1><center><a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisStats\"><b>".$msa->TotalVisits()."</b></a></b></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/topics.gif\"    border=\"0\" alt=\"\">"._MSA_SACTIVETOPICS."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Topics><b>$tottopics</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/news.gif\"      border=\"0\" alt=\"\">"._MSA_SACTIVESTORIES."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=News><b>$totstories</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/topics.gif\"    border=\"0\" alt=\"\">"._MSA_SACTIVECONTENTS."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Content><b>$totpcat/$totpages</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/comments.gif\"  border=\"0\" alt=\"\">"._MSA_COMMENTSPOSTED."</td><td bgcolor=$bgcolor1><center><b>$totcom</b></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/links.gif\"     border=\"0\" alt=\"\">"._MSA_LINKSINLINKS."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Web_Links><b>$totlinks</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/sections.gif\"  border=\"0\" alt=\"\">"._MSA_LINKSCAT."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Web_Links><b>$totlinkscat</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/info.gif\"      border=\"0\" alt=\"\">"._MSA_FAQ."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=FAQ><b>$totfaq</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/waiting.gif\"   border=\"0\" alt=\"\">"._MSA_NEWSWAITING."</td><td bgcolor=$bgcolor1><center><a href=admin.php?op=submissions><b>$totnewswaiting</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/sections.gif\"  border=\"0\" alt=\"\">"._MSA_SECTIONS."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Sections><b>$totsec</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/articles.gif\"  border=\"0\" alt=\"\">"._MSA_ARTICLESSEC."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Sections><b>$totseccont</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/news.gif\"      border=\"0\" alt=\"\">"._MSA_REVIEWS."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Reviews><b>$totrev</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/download.gif\"  border=\"0\" alt=\"\">"._MSA_AMOUNTDOWNLOADS."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Downloads><b>".$download_info[ 0 ]."</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/download.gif\"  border=\"0\" alt=\"\">"._MSA_TOTALDOWNLOADS."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Downloads><b>".$download_info[ 1 ]."</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/downloads.gif\" border=\"0\" alt=\"\">"._MSA_DWNLC."</td><td bgcolor=$bgcolor1><center><a href=modules.php?name=Downloads><b>$totdowncat</b></a></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/size.gif\"      border=\"0\" alt=\"\" width=\"16\" height=\"13\">"._MSA_DWNLSIZE."</td><td bgcolor=$bgcolor1><center><b><font color=\"#FF0000\">$mbdwn</font></b></center></td></tr>\n";
$OutputBuffer .= "<tr><td bgcolor=$bgcolor1><img src=\"modules/$module_name/images/nukestats/sections.gif\"  border=\"0\" alt=\"\">"._MSA_NUKEVERSION."</td><td bgcolor=$bgcolor1><center><a href=http://www.phpnuke.org  target=_new><b>$Version_Num</b></a></center></td></tr>\n";
$OutputBuffer .= "</table></center><br>\n";

/* Print everything to Screen */
OpenTable();
echo $OutputBuffer;
CloseTable();

?>
