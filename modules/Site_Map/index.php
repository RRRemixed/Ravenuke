<?php

/************************************************************************/
/* NukeJMap [Site_Map]	4.0 Pro by z3rb		                			*/
/* =================================                                    */
/*                                                                      */
/* Copyright (c) 2006 by Techgen			                			*/
/* http://www.techg3n.net                                               */
/*                                                                      */
/************************************************************************/


if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));


// NON MODIFICARE IL CODICE SOTTOSTANTE
// DON'T TOUCH THE CODE BELOW
//--------------------------------------------------------------------------------------      

global $prefix, $db, $sitename, $currentlang, $admin, $multilingual, $module_name, $admin_file, $dbi;

$result = $db->sql_query("SELECT * FROM ".$prefix."_jmap", $dbi);
	while ($row=$db->sql_fetchrow($result))
  	{
    	$nametask = $row["name"];
    	$value = $row["value"];
    	$conf[$nametask]=$value;
  	}
$xml = $conf["xml"];
$ndown = $conf["ndown"];
$nnews = $conf["nnews"];
$nrev = $conf["nrev"];
$ntopics = $conf["ntopics"];
$nuser = $conf["nuser"];

/* PRINT DB VARIABLES
  echo "XML:";echo $xml;echo "-";echo"TOPIC:";echo $ntopics;echo"-";echo"NEWS:";echo $nnews;  
  echo"-";echo"DOWN:";echo $ndown;echo"-";echo"REV:";echo $nrev;echo"-";echo"US:";echo $nuser;*/

//---------------------- XML BEGIN -----------------
        //DELETE CONTENT
        $var1=@fopen("sitemap.xml","w+");
		if($xml==1)
		{
        	//OPEN FILE
        	$var=@fopen("sitemap.xml","a+");
        	// HEADER
        	@fwrite($var, "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
        	<!--Google Site Map File Generated by Site_Map http://www.techg3n.net -->
        	<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\">\n");
		}
//---------------------- XML END -----------------


if (file_exists("modules/Site_Map/language/lang-$currentlang.php")) {
	include_once("modules/Site_Map/language/lang-$currentlang.php");
} else {
	include_once("modules/Site_Map/language/lang-english.php");
}


include("header.php");

Opentable();
echo("<center><H2>"._NJMAP." $sitename</H2></center>");
Closetable();
OpenTable();
echo"<center>";
echo"<p><table>";
echo"<tr><td><img src=modules/Site_Map/images/cath.gif></td><td><a href=$nukeurl>Homepage</a></td></tr><tr></tr>";
$result2 = $db->sql_query("SELECT title, custom_title, view FROM " . $prefix . "_modules WHERE active=1 AND view<2 ORDER BY custom_title");
while ($row2 = $db->sql_fetchrow($result2)) {
	$titolomodulo = stripslashes($row2['custom_title']);
	$link=$row2['title'];
	$permesso=$row2['view'];
	echo"<tr><td>";
	if ($permesso==0) {
		echo "<img src=modules/Site_Map/images/cat1.gif>";
	}else {
		echo"<img src=modules/Site_Map/images/deny.gif>";
	}
	echo " </td><td><a href='modules.php?name=$link'>$titolomodulo</a></td></tr><tr></tr>";
	
	switch($link) {
		case 'Downloads':
			$result3 = $db->sql_query("SELECT cid, title FROM " . $prefix . "_downloads_categories WHERE active=1 AND parentid=0 ORDER BY title");
			while ($row3 = $db->sql_fetchrow($result3)) {
				$titolodown=$row3['title'];
				$cid1=$row3['cid'];
				echo"<tr><td></td><td><img src=modules/Site_Map/images/cat3.gif> <a href='modules.php?name=Downloads&cid=$cid1'>$titolodown</td>";
				if($xml==1)
                                {
                                        //XML
                                        @fwrite($var, "<url><loc>$nukeurl/modules.php?name=Downloads&amp;cid=$cid1</loc></url>\n");
                                }
                                $result4 = $db->sql_query("SELECT cid, title FROM " . $prefix . "_downloads_categories WHERE active=1 AND parentid=$cid1 ORDER BY title");
				while ($row4 = $db->sql_fetchrow($result4)) {
					$titolodown2=$row4['title'];
					$cid2=$row4['cid'];
					echo"<tr><td></td><td><target=blank>&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/cat2.gif> <a href='modules.php?name=Downloads&cid=$cid2'>$titolodown2</td>";
					if($xml==1)
                                        {
                                                //XML
                                                @fwrite($var, "<url><loc>$nukeurl/modules.php?name=Downloads&amp;cid=$cid2</loc></url>\n");
                                       }
                                $result4b = $db->sql_query("SELECT cid, lid, title FROM " . $prefix . "_downloads_downloads WHERE active=1 AND cid=$cid2 ORDER BY hits LIMIT 0,".$ndown);
                                while ($row4b = $db->sql_fetchrow($result4b)) {
					$titolodown3=$row4b['title'];
					$cid3=$row4b['lid'];
					echo"<tr><td></td><td><target=blank>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/catt.gif> <a href='modules.php?name=Downloads&op=getit&lid=$cid3'>$titolodown3</td>";
        				if($xml==1)
                                        {
                                                //XML
                                                //@fwrite($var, "<url><loc>$nukeurl/modules.php?name=Downloads&op=getit&lid=$cid3</loc></url>\n");
                                        }


                                        }

                                }
			}

		break;

		case 'Forums':
			$result5 = $db->sql_query("SELECT cat_id, cat_title FROM " . $prefix . "_bbcategories ORDER BY cat_order");
			while ($row5 = $db->sql_fetchrow($result5)) {
				$titolocatf=$row5['cat_title'];
				$cat_id=$row5['cat_id'];
				echo"<tr><td></td><td><img src=modules/Site_Map/images/cat3.gif> <a href='modules.php?name=Forums&file=index&c=$cat_id'>$titolocatf</td>";
			        if($xml==1)
                                {
                                        //XML
                                        @fwrite($var, "<url><loc>$nukeurl/modules.php?name=Forums&amp;file=index&amp;c=$cat_id</loc></url>\n");
                                }
                                $result6 = $db->sql_query("SELECT forum_name, forum_id, auth_view, auth_read FROM " . $prefix . "_bbforums WHERE cat_id=$cat_id AND auth_view<2 AND auth_read<2 ORDER BY forum_order");
				while ($row6 = $db->sql_fetchrow($result6)) {
					$titoloforum=$row6['forum_name'];
					$fid=$row6['forum_id'];
					$auth_view=$row6['auth_view'];
					$auth_read=$row6['auth_read'];
					echo"<tr><td></td><td>";
					if ($auth_view==1 && !is_user()) {
						echo"&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/deny.gif>";
						echo" $titoloforum</td></tr>";
					} else {
						echo"&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/cat2.gif>";
						echo" <a href='modules.php?name=Forums&file=viewforum&f=$fid'>$titoloforum</td></tr>";
					        if($xml==1)
                                                {
                                                        //XML
                                                        @fwrite($var, "<url><loc>$nukeurl/modules.php?name=Forums&amp;file=viewforum&amp;f=$fid</loc></url>\n");
                                                }
                                                $resultT = $db->sql_query("SELECT topic_title, topic_id FROM " . $prefix . "_bbtopics WHERE forum_id=$fid ORDER BY topic_id DESC LIMIT 0,".$ntopics);
						while($rowT = $db->sql_fetchrow($resultT)) {
							echo"<tr><td></td><td>";
							echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/catt.gif>";
							echo" <a href='modules.php?name=Forums&file=viewtopic&t=$rowT[topic_id]'>" . $rowT['topic_title'] . "</td>";
							if($xml==1)
							{
                                                                //XML
                                                                @fwrite($var, "<url><loc>$nukeurl/modules.php?name=Forums&amp;file=viewtopic&amp;t=$rowT[topic_id]</loc></url>\n");
                                                        }
                                                }
					}
				}
			}
		break;	
	
		case 'Sections':
			$result7 = $db->sql_query("select secid, secname, image from ".$prefix."_sections order by secname", $dbi);
			while ($row7 = $db->sql_fetchrow($result7)) {
				$secid=$row7['secid'];
				$secname=$row7['secname'];
				$view=$row7['view'];
				echo"<tr><td></td><td>";
				if ($view==1) {
					echo"&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/deny.gif>";
				} else {
					echo"&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/cat2.gif>";
				}
				echo" <a href='modules.php?name=Sections&op=listarticles&secid=$secid'> $secname</td>";
				if($xml==1)
				{
                                        //XML
				        @fwrite($var, "<url><loc>$nukeurl/modules.php?name=Sections&amp;op=listarticles&amp;secid=$secid</loc></url>\n");
			}       }
		break;
		
		case 'Web_Links':
			//$result8 = $db->sql_query("SELECT cid, title from ".$prefix."_links_categories where parentid='$cid' order by title limit 0,3");
                        $result8 = $db->sql_query("SELECT cid, title from ".$prefix."_links_categories where parentid='$cid' order by title");
			while ($row8 = $db->sql_fetchrow($result8)) {
				$titololink=$row8['title'];
				$cid1=$row8['cid'];
				echo"<tr><td></td><td><img src=modules/Site_Map/images/cat2.gif> <a href='modules.php?name=Web_Links&l_op=viewlink&cid=$cid1'>$titololink</td>";
				if($xml==1)
				{
                                        //XML
				        @fwrite($var, "<url><loc>$nukeurl/modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid=$cid1</loc></url>\n");
			        }
                        }
		break;
		
		case 'Topics':
			$result9 = $db->sql_query("SELECT topictext,topicid FROM ".$prefix."_topics ORDER BY topictext");
			while ($row9 = $db->sql_fetchrow($result9)) {
				$topiclink=$row9['topictext'];
				$cidtopic=$row9['topicid'];
				echo"<tr><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/cat2.gif> <a href='modules.php?name=Topics&cid=$cidtopic'>$topiclink</td>";
				if($xml==1)
			        {
                                        //XML
				        @fwrite($var, "<url><loc>$nukeurl/modules.php?name=Topics&amp;cid=$cidtopic</loc></url>\n");
			        }
                        }
		break;
		
		case 'News':
			$result10 = $db->sql_query("SELECT title,sid FROM ".$prefix."_stories ORDER BY sid DESC LIMIT 0,".$nnews);
			while ($row10 = $db->sql_fetchrow($result8)) {
				$newslink=$row10['title'];
				$cidnews=$row10['sid'];
				
				echo"<tr><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/cat2.gif> <a href='modules.php?name=News&file=read_article&sid=$cidnews'>$newslink</td>";
				if($xml==1)
			        {
                                    //XML
				    @fwrite($var, "<url><loc>$nukeurl/modules.php?name=News&amp;file=read_article&amp;sid=$cidnews</loc></url>\n");
			        }
                        }
		break;
		
		case 'Members_List':
			$result11 = $db->sql_query("SELECT username,user_id FROM ".$prefix."_users ORDER BY user_id DESC LIMIT 0,".$nuser);
			while ($row11 = $db->sql_fetchrow($result11)) {
				$user=$row11['username'];
				$ciduser=$row11['user_id'];
				
				echo"<tr><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/cat2.gif> <a href='modules.php?name=Profile&mode=viewprofile&u=$ciduser'>$user</a></td>";

                        }
		break;
		
		case 'Reviews':
			$result12 = $db->sql_query("SELECT title, id FROM ".$prefix."_reviews ORDER BY id DESC LIMIT 0,".$nrev);
			while ($row12 = $db->sql_fetchrow($result12)) {
				$titrev=$row12['title'];
				$cidrev=$row12['id'];
				
				echo"<tr><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;<img src=modules/Site_Map/images/cat2.gif> <a href='modules.php?name=Reviews&rop=showcontent&id=$cidrev'>$titrev</a></td>";
				if($xml==1)
			        {
                                    //XML
				    //@fwrite($var, "<url><loc>$nukeurl/modules.php?name=Reviews&rop=showcontent&id=$cidrev</loc></url>\n");
			        }

                        }
		break;
                

                

	}
}
echo"</table></center>";
CloseTable();
// YOU ARE NOT AUTHORISED TO REMOVE OR EDIT BELOW LINES WITHOUT AUTHORS PERMISSIONS. PLEASE PLAY FAIR.
// NON MOFIFICARE O RIMUOBERE LE LINEE SEGUENTI SENZA IL PERMESSO DELL'AUTORE
echo'
<script type="text/javascript">
 <!--
 function copy() {
   var w = 400;
   var h = 250;
   var l = Math.floor((screen.width-w)/2);
   var t = Math.floor((screen.height-h)/2);
      window.open("modules/Site_Map/copyright.php","","width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
 }
 //-->
</script>
<p align=right>
<a href="javascript:copy()">&copy;NukeJMap</a></p>';

if($xml==1)
{
// FOOTER XML
@fwrite($var, '</urlset>');
}
// FOOTER GRAPHIC
include("footer.php");



?>
