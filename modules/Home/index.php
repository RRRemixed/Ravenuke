<?php

/************************************************************************/
/* HOME: ADDON PHP-NUKE                                                   */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by Jhon Doe                                       */
/* http://www.jhondoe.info                                              */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));

define('INDEX_FILE', true);
$index=1;
$pagetitle = "- HOME JD";

function Home() {
global $db, $storyhome,$bgcolor1,$topicname, $module_name,$topicimage, $topictext, $datetime, $user, $cookie, $nukeurl, $prefix, $multilingual, $currentlang, $articlecomm, $sitename, $user_news, $userinfo,$tipath,$bgcolor1,$bgcolor2,$bgcolor3;
 get_lang("News");
include("header.php");
    $resultbc = $db->sql_query("SELECT * FROM ".$prefix."_bbconfig");
while($rowbc = $db->sql_fetchrow($resultbc)) {
    $board_config[$rowbc[config_name]] = $rowbc[config_value];
}
$avatar_sit=$board_config[avatar_path];
//Inicio de noticia Aleatoria
  if (is_user($user)) { getusrinfo($user); }
	if ($multilingual == 1) {
		$querylang = "AND (alanguage='$currentlang' OR alanguage='')";
	} else {
		$querylang = "";
	}


	if (isset($new_topic)) {
	$new_topic = intval($new_topic);
	} else {
	$new_topic == 0;
	}
        if (isset($userinfo['setstorynum']) AND $user_news == 1) {
                $storynum = $userinfo['setstorynum'];
	} else {
		$storynum = $storyhome;
	}
	if ($new_topic == 0) {
		$qdb = "WHERE (ihome='0' OR catid='0')";
		$home_msg = "";
	} else {
		$qdb = "WHERE topic='$new_topic'";
		$result_a = $db->sql_query("SELECT topictext FROM ".$prefix."_topics WHERE topicid='$new_topic'");
		$row_a = $db->sql_fetchrow($result_a);
		$numrows_a = $db->sql_numrows($result_a);
		$topic_title = stripslashes(check_html($row_a['topictext'], "nohtml"));
		OpenTable();
		if ($numrows_a == 0) {
			echo "<center><font class=\"title\">$sitename</font><br><br>"._NOINFO4TOPIC."<br><br>[ <a href=\"modules.php?name=News\">"._GOTONEWSINDEX."</a> | <a href=\"modules.php?name=Topics\">"._SELECTNEWTOPIC."</a> ]</center>";
		} else {
			$db->sql_query("UPDATE ".$prefix."_topics SET counter=counter+1");
			echo "<center><font class=\"title\">$sitename: $topic_title</font><br><br>"
			."<form action=\"modules.php?name=Search\" method=\"post\">"
			."<input type=\"hidden\" name=\"topic\" value=\"$new_topic\">"
			.""._SEARCHONTOPIC.": <input type=\"name\" name=\"query\" size=\"30\">&nbsp;&nbsp;"
			."<input type=\"submit\" value=\""._SEARCH."\">"
			."</form>"
			."[ <a href=\"index.php\">"._GOTOHOME."</a> | <a href=\"modules.php?name=Topics\">"._SELECTNEWTOPIC."</a> ]</center>";
		}
		CloseTable();
		echo "<br>";
	}
	$result = $db->sql_query("SELECT sid, catid, aid, title, time, hometext, bodytext, comments, counter, topic, informant, notes, acomm, score, ratings FROM ".$prefix."_stories $qdb $querylang ORDER BY RAND() limit 1");
	while ($row = $db->sql_fetchrow($result)) {
		$s_sid = intval($row['sid']);
		$catid = intval($row['catid']);
		$aid = stripslashes($row['aid']);
		$title = stripslashes(check_html($row['title'], "nohtml"));
		$time = $row['time'];
		$hometext = stripslashes($row['hometext']);
		$bodytext = stripslashes($row['bodytext']);
		$comments = stripslashes($row['comments']);
		$counter = intval($row['counter']);
		$topic = intval($row['topic']);
		$informant = stripslashes($row['informant']);
		$notes = stripslashes($row['notes']);
		$acomm = intval($row['acomm']);
		$score = intval($row['score']);
		$ratings = intval($row['ratings']);
		if ($catid > 0) {
			$row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_stories_cat WHERE catid='$catid'"));
			$cattitle = stripslashes(check_html($row2['title'], "nohtml"));
		}
		getTopics($s_sid);
		formatTimestamp($time);
		$introcount = strlen($hometext);
		$fullcount = strlen($bodytext);
		$totalcount = $introcount + $fullcount;
		$c_count = $comments;
		$r_options = "";
		if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
		if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
		if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
		$story_link = "<a href=\"modules.php?name=News&amp;file=article&amp;sid=$s_sid$r_options\">";
		$morelink = "(";
		if ($fullcount > 0 OR $c_count > 0 OR $articlecomm == 0 OR $acomm == 1) {
			$morelink .= "$story_link<b>"._READMORE."</b></a> | ";
		} else {
			$morelink .= "";
		}
		if ($fullcount > 0) { $morelink .= "$totalcount "._BYTESMORE." | "; }
		if ($articlecomm == 1 AND $acomm == 0) {
			if ($c_count == 0) { $morelink .= "$story_link"._COMMENTSQ."</a>"; } elseif ($c_count == 1) { $morelink .= "$story_link$c_count "._COMMENT."</a>"; } elseif ($c_count > 1) { $morelink .= "$story_link$c_count "._COMMENTS."</a>"; }
		}
		$sid = intval($s_sid);
		if ($catid != 0) {
			$row3 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_stories_cat WHERE catid='$catid'"));
			$title1 = stripslashes(check_html($row3['title'], "nohtml"));
			$title = "<a href=\"modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><font class=\"storycat\">$title1</font></a>: $title";
			$morelink .= " | <a href=\"modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=$catid\">$title1</a>";
		}
		if ($score != 0) {
			$rated = substr($score / $ratings, 0, 4);
		} else {
			$rated = 0;
		}
		$morelink .= " | "._SCORE." $rated";
		$morelink .= ")";
		$morelink = str_replace(" |  | ", " | ", $morelink);
		themeindex($aid, $informant, $datetime, $title, $counter, $topic, $hometext, $notes, $morelink, $topicname, $topicimage, $topictext);
	}
      $db->sql_freeresult($result);
    //Fin noticia Aleatoria
     //Inicio Temas noticias
      $xta=2;

     $resultx= $db->sql_query("SELECT topicid, topicimage,topictext FROM ".$prefix."_topics");
                  OpenTable();
            echo"<div style=\"background-color: $bgcolor1;valign:top;align:center;text-align:center\"><strong>Topics</strong></div><br /><table align=\"center\" width=\"100%\" valign=\"top\">";

		while ($rowx = $db->sql_fetchrow($resultx)) {
          if($ti == $xta) {
               echo "<tr>";
               $ti = 0;
               }
               echo"<td valign=\"top\" align=\"center\">";

   $cidtopi  = stripslashes(check_html($rowx['topicid'], "nohtml"));


       $resultr = $db->sql_query("SELECT * FROM ".$prefix."_stories where topic='$cidtopi'");
       	$numrowsx = $db->sql_numrows($resultr);
         if (file_exists("themes/$ThemeSel/images/topics/".$rowx['topicimage']."")) {
	$t_imagex = "themes/$ThemeSel/images/topics/".$rowx['topicimage']."";
    } else {
	$t_imagex = "$tipath".$rowx['topicimage']."";
    }
               echo"<td valign=\"top\" >";
               echo $topictex  = "<div style=\"background-color: $bgcolor1;valign:top;align:top\"><font color=red>.::</font> <a href=\"modules.php?name=News&amp;new_topic=$cidtopi\"><strong>" .stripslashes(check_html($rowx['topictext'], "nohtml"))."</strong></a> <font color=red>::.</font></div>";


    while ($rowx = $db->sql_fetchrow($resultr)) {
		$xs_sid = intval($rowx['sid']);
		$xcatid = intval($rowx['catid']);
		$xaid = stripslashes($rowx['aid']);
		$xtitle = stripslashes(check_html($rowx['title'], "nohtml"));
		$xtime = $rowx['time'];

		$xcomments = stripslashes($rowx['comments']);
		$xcounter = intval($rowx['counter']);
		$xtopic = intval($rowx['topic']);
		$xinformant = stripslashes($rowx['informant']);
		$xnotes = stripslashes($rowx['notes']);
		$xacomm = intval($rowx['acomm']);
		$xscore = intval($rowx['score']);
		$xratings = intval($rowx['ratings']);
        $aut = get_author($xaid);
        $ThemeSel = get_theme();

        echo "::<a href=\"modules.php?name=News&amp;file=article&amp;sid=$xs_sid\">$xtitle</a> : ($xcounter "._READS.")<br />";

        }

        echo"<br /></td>";
          $ti++;
        }
         echo"</tr></table>";
          CloseTable();
        $db->sql_freeresult($resultr);
        $db->sql_freeresult($resultx);
         //Fin Temas noticias
        //Inicio  Forums Aleatorios
         get_lang("Your_Account");
          get_lang("Forums");
           get_lang("Downloads");


echo"<table width=\"100%\"><tr><td valign=\"top\" width=\"50%\">";

;
   OpenTable();
echo"&nbsp;&nbsp;&nbsp;&nbsp;<strong>"._LAST10BBPOST."</strong>: <br />";
$resulte = $db->sql_query( "SELECT topic_id, forum_id, topic_last_post_id, topic_title, topic_poster, topic_views, topic_replies, topic_moved_id FROM ".$prefix."_bbtopics ORDER BY topic_last_post_id DESC limit 10");

while( list( $topic_id, $forum_idz, $topic_last_post_idf, $topic_titlef, $topic_poster, $topic_viewsf, $topic_replies, $topic_moved_idz )  = $db->sql_fetchrow( $resulte ) )

{
   $skip_display = 0;
   if( $HideViewReadOnly == 1 )
   {
      $result1e = $db->sql_query( "SELECT auth_view, auth_read FROM ".$prefix."_bbforums where forum_id = '$forum_idz'" );
      list( $auth_view, $auth_read ) = $db->sql_fetchrow( $result1e );
      if( ( $auth_view != 0 ) or ( $auth_read != 0 ) ) { $skip_display = 1; }
   }

   if( $topic_moved_idz != 0 )
   {
	  // Shadow Topic !!
      $skip_display = 1;
   }

   if( $skip_display == 0 )
   {
	  $Count_Topics += 1;

      echo":: <a href=\"modules.php?name=Forums&file=viewtopic&t=$topic_id#$topic_last_post_idf\">$topic_titlef</a> ($topic_viewsf "._FVIEWS.")<br />";
      }
      }
      $db->sql_freeresult($resulte);
  CloseTable();
echo"</td><td valign=\"top\"  width=\"50%\">";
 $result4 = $db->sql_query("select lid, title, hits from ".$prefix."_downloads_downloads order by date DESC limit 0,10");
     OpenTable();
echo"&nbsp;&nbsp;&nbsp;&nbsp;<strong>"._LAST10DOWNLOAD."</strong>: <br />";
while(list($lid, $title, $hits) = $db->sql_fetchrow($result4)) {

        $transfertitle = str_replace (" ", "_", $title);
        $title2 = ereg_replace("_", " ", $title);
          echo "::&nbsp;<a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$lid&amp;ttitle=$transfertitle\">$title2</a>&nbsp;($hits "._DOWNLOADS.")<br />";

}
$db->sql_freeresult($result4);
  CloseTable();
echo"</td></tr></table>";
    include("footer.php");
}



switch($op) {


    default:
    Home();
    break;

}

?>