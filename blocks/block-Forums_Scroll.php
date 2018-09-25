<?php

/************************************************************************/
/* Forums Block for phpBB 2.0.0-6 port to PHP Nuke 6.5+                 */
/* ====================================================                 */
/* Copyright (c) 2003-2004 by Telli (telli@codezwiz.com)                */
/* http://codezwiz.com 						                  */
/* Last Edited - 20 Aug 2004	      					      */
/*					                                          */
/* This Block shows the last 10 topics where a message was posted,	*/
/* along with the username of the last poster and the day and time	*/
/* of the post.								            */
/* It will also show smileys in the topic titles thanks to the		*/
/* smileys.php file found in Leo Tan Block Forums version		      */
/* (http://www.cybercomp.d2g.com).					            */
/************************************************************************/

if (eregi("block-Forums_Scroll.php", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}
define("_BBFORUM_TOTTOPICS","Topics ");
define("_BBFORUM_TOTPOSTS","Posts ");
define("_BBFORUM_TOTVIEWS","Views ");
define("_BBFORUM_TOTREPLIES","Replies ");
define("_BBFORUM_TOTMEMBERS","Members");
define("_BBFORUM_FORUM","Forums");
define("_BBFORUM_SEARCH","Search");

include_once ('blocks/smileys.php');
$cz_theme = get_theme();
global $prefix, $user_prefix, $db, $dbi, $sitename, $user, $cookie, $group_id;
/* Total Amount of Topics */
$result = $db->sql_query( "SELECT * FROM ".$prefix."_bbtopics" );
$Amount_Of_Topics = $db->sql_numrows( $result );

/* Total Amount of Posts */
$result = $db->sql_query( "SELECT * FROM ".$prefix."_bbposts" );
$Amount_Of_Posts = $db->sql_numrows( $result );

/* Total Amount of Topic Views */
$Amount_Of_Topic_Views = 0;
$result = $db->sql_query( "SELECT topic_views FROM ".$prefix."_bbtopics" );
while( list( $topic_views ) = $db->sql_fetchrow( $result ) )
{
   $Amount_Of_Topic_Views = $Amount_Of_Topic_Views + $topic_views;
}

/* Total Amount of Topic Replies */
$Amount_Of_Topic_Replies = 0;
$result = $db->sql_query( "SELECT topic_replies FROM ".$prefix."_bbtopics" );
while( list( $topic_replies ) = $db->sql_fetchrow( $result ) )
{
   $Amount_Of_Topic_Replies = $Amount_Of_Topic_Replies + $topic_replies;
}

/* Total Amount of Members */
$result = $db->sql_query( "SELECT * FROM ".$user_prefix."_users" );
$Amount_Of_Members = $db->sql_numrows( $result );

$count = 1;
$content = "<table class=\"row1\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">
 <tr>
  <td align=\"left\" class=\"row1\" width=\"50%\"><font class=\"tiny\"><b>"._BBFORUM_TOTTOPICS."</b></font></td>
  <td align=\"left\" class=\"row1\" width=\"50%\"><b>$Amount_Of_Topics</b></td>
 </tr>
 <tr>
  <td align=\"left\" class=\"row1\" width=\"50%\"><font class=\"tiny\"><b>"._BBFORUM_TOTPOSTS."</b></font></td>
  <td align=\"left\" class=\"row1\" width=\"50%\"><b>$Amount_Of_Posts</b></td>
 </tr>
 <tr>
  <td align=\"left\" class=\"row1\" width=\"50%\"><font class=\"tiny\"><b>"._BBFORUM_TOTVIEWS."</b></font></td>
  <td align=\"left\" class=\"row1\" width=\"50%\"><b>$Amount_Of_Topic_Views</b></td>
 </tr>
 <tr>
  <td align=\"left\" class=\"row1\" width=\"50%\"><font class=\"tiny\"><b>"._BBFORUM_TOTREPLIES."</b></font></td>
  <td align=\"left\" class=\"row1\" width=\"50%\"><b>$Amount_Of_Topic_Replies</b></td>
 </tr>
 <tr>
  <td align=\"left\" class=\"row1\" width=\"50%\"><font class=\"tiny\"><a href=\"modules.php?name=Members_List\">"._BBFORUM_TOTMEMBERS."</a></font></td>
  <td align=\"left\" class=\"row1\" width=\"50%\"><b>$Amount_Of_Members</b></td>
 </tr>
</table>";
$content .= "<table class=\"row1\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">
 <tr>
  <td class=\"row1\" width=\"100%\">";
$content  .= "<A name= \"scrollingCode\"></A><MARQUEE behavior=\"scroll\" direction=\"up\" height=\"220\" scrollamount=\"2\" scrolldelay=\"20\" onmouseover='this.stop()' onmouseout='this.start()'>";
$content .="<center><font class=\"content\"><b>Last 20 Forum Messages</b></center>";
$content .= "<br>";
$result1 = $db->sql_query("SELECT
 t.topic_id, t.topic_last_post_id, t.topic_title,
 f.forum_name, f.forum_id,
 u.username, u.user_id,
 p.poster_id, FROM_UNIXTIME(p.post_time,'%b %d, %Y at %T') as post_time
 FROM ".$prefix."_bbtopics t, ".$prefix."_bbforums f
 LEFT JOIN ".$prefix."_bbposts p ON (p.post_id = t.topic_last_post_id)
 LEFT JOIN ".$prefix."_users u ON (u.user_id = p.poster_id)
 WHERE t.forum_id=f.forum_id AND f.auth_view=0
 ORDER BY t.topic_last_post_id DESC
 LIMIT 20");
while(list($topic_id, $topic_last_post_id, $topic_title, $forum_name, $forum_id, $username, $user_id, $poster_id, $post_time) = $db->sql_fetchrow($result1)) {

$topic_title=parseEmoticons($topic_title);
$content .= "<img src=\"themes/$cz_theme/forums/images/icon_minipost.gif\" border=\"0\" alt=\"\"><a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;p=$topic_last_post_id#$topic_last_post_id\"STYLE=\"text-decoration: none\"><b> $topic_title </b></a><br><font class=\"content\"><i>Last post by <A HREF=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$poster_id\"STYLE=\"text-decoration: none\"> $username </a> in <a href=\"modules.php?name=Forums&amp;file=viewforum&amp;f=$forum_id\">$forum_name</a> on $post_time</i></font><br><br>";
$count = $count + 1;
}
$content .= "</marquee></td></tr></table>";
$content .= "<table class=\"row1\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">
 <tr>
  <td align=\"center\" class=\"row1\" width=\"50%\"><a href=\"modules.php?name=Forums\">"._BBFORUM_FORUM."</a></td>
  <td align=\"center\" class=\"row1\" width=\"50%\"><a href=\"modules.php?name=Forums&file=search\">"._BBFORUM_SEARCH."</a></td>
 </tr></table>";
?>
