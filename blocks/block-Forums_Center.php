<?php
if( eregi( "block-Forums_Center.php",$PHP_SELF ) )
{
   Header("Location: index.php");
   die();
}
global $user, $cookie, $sitename, $prefix, $user_prefix, $sitename, $admin, $module_name, $bgcolor1, $bgcolor2, $db;

// When set to 1 then Forums permissions which View and/or Read are NOT set to 'ALL' will NOT be displayed in the center block
$HideViewReadOnly = 'ALL';
// Show only 5 last new topics
$Last_New_Topics  = 5;                            
// Icon that is displayed in Center Block in front of Topic
$IconPath         = "images/msg.png";  
//size of the outer border
$border = 1;
//cell spacing around the tables
$cellspacing = 0;

/* Total Amount of Topics */
$result = $db->sql_query( "SELECT * FROM ".$prefix."_bbtopics");
$Amount_Of_Topics = $db->sql_numrows($result);

/* Total Amount of Posts */
$result = $db->sql_query( "SELECT * FROM ".$prefix."_bbposts");
$Amount_Of_Posts = $db->sql_numrows($result);

/* Total Amount of Topic Views */
$Amount_Of_Topic_Views = 0;
$result = $db->sql_query( "SELECT topic_views FROM ".$prefix."_bbtopics" );
while( list( $topic_views ) = $db->sql_fetchrow($result) )
{
   $Amount_Of_Topic_Views = $Amount_Of_Topic_Views + $topic_views;
}

/* Total Amount of Topic Replies */
$Amount_Of_Topic_Replies = 0;
$result = $db->sql_query( "SELECT topic_replies FROM ".$prefix."_bbtopics" );
while( list( $topic_replies ) = $db->sql_fetchrow($result) )
{
   $Amount_Of_Topic_Replies = $Amount_Of_Topic_Replies + $topic_replies;
}

/* Total Amount of Members */
$result = $db->sql_query( "SELECT * FROM ".$prefix."_users" );
$Amount_Of_Members = $db->sql_numrows($result);

/* Last X New Topics */
$Count_Topics = 0;
$Topic_Buffer = "";
$result1 = $db->sql_query( "SELECT topic_id, forum_id, topic_last_post_id, topic_title, topic_poster, topic_views, topic_replies, topic_moved_id FROM ".$prefix."_bbtopics ORDER BY topic_last_post_id DESC" );
while( list( $topic_id, $forum_id, $topic_last_post_id, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_moved_id ) = $db->sql_fetchrow( $result1 ) )
{
   $skip_display = 0;
   if( $HideViewReadOnly == 1 )
   {
      $result5 = $db->sql_query( "SELECT auth_view, auth_read FROM ".$prefix."_bbforums where forum_id = '$forum_id'" );
      list( $auth_view, $auth_read ) = $db->sql_fetchrow( $result5 );
      if( ( $auth_view != 0 ) or ( $auth_read != 0 ) ) { $skip_display = 1; }
   }
   
   if( $topic_moved_id != 0 )
   {
	  // Shadow Topic !!
      $skip_display = 1;
   }
   
   if( $skip_display == 0 )
   {
	  $Count_Topics += 1;
      $result2 = $db->sql_query( "SELECT topic_id, poster_id, FROM_UNIXTIME( post_time,'%b %d, %Y at %T') as post_time FROM ".$prefix."_bbposts where post_id = '$topic_last_post_id'" );
      list( $topic_id, $poster_id, $post_time ) = $db->sql_fetchrow( $result2 );

      $result3 = $db->sql_query( "SELECT username, user_id FROM ".$prefix."_users where user_id='$poster_id'" );
      list( $username, $user_id ) = $db->sql_fetchrow( $result3 );
      $LastPoster = "<a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$user_id\">$username</a>";
      
      $result4 = $db->sql_query( "SELECT username, user_id FROM ".$prefix."_users where user_id='$topic_poster'" );
      list( $username, $user_id ) = $db->sql_fetchrow( $result4 );
      $OrigPoster = "<A HREF=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$user_id\"STYLE=\"text-decoration: none\"> $username </a>";
   
      $TopicImage = "&nbsp;<img src=\"$IconPath\" border=\"0\" alt=\"\">";
      $TopicTitleShow = "<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;p=$topic_last_post_id#$topic_last_post_id\"STYLE=\"text-decoration: none\">$topic_title</a>";
   
      $Topic_Buffer .= "<tr><td>$TopicImage&nbsp;&nbsp;$TopicTitleShow</td><td><div align=\"center\">$OrigPoster</div></td><td><div align=\"center\"><b>$topic_views</b></div></td><td><div align=\"center\"><b>$topic_replies</b></div></td><td align=\"center\">$LastPoster&nbsp;<a href=\"modules.php?name=Forums&file=viewtopic&p=$topic_last_post_id#$topic_last_post_id\"><img src=\"images/icon_latest_reply.gif\" border=\"0\"></a><br><font size=\"-2\"><i>$post_time</i></font></td></tr>";
   }
   
   if( $Last_New_Topics == $Count_Topics ) { break 1; }
   
}

$cat = $db->sql_query("SELECT * FROM ".$prefix."_bbcategories");
$content = "";


/* Write Table to Screen */
$content  = "<center><table width=\"100%\" border=\"$border\"  cellspacing=\"$cellspacing\" bordercolor=\"#292929\">";
$content .= "<td width=\"100%\" height=\"21\" colspan=\"6\" align=\"center\"><STRONG>Last 5 Forum Posts</STRONG></td></tr>";
$content .= "<td rowspan=\"0\" >";
$content .= "<table width=\"100%\" cellpadding=\"$cellspacing\" bordercolor=\"$bgcolor1\" cellspacing=\"1\" border=\"$border\" vAlign=\"top\">";

		$forum_id = $forum_row[0];
		$forum_title = $forum_row[5];
		$for_count ++;
	
	

$content .= "</table>";
$content .= "<tr><td align=\"center\" >"._BBFORUM_TOTTHREAD."</td><td align=\"center\">"._BBFORUM_POSTER."</td><td align=\"center\">"._BBFORUM_VIEWS."</td><td align=\"center\">"._BBFORUM_REPLIES."</td><td align=\"center\">"._BBFORUM_LASTPOSTER."</td></tr>";
$content .= "$Topic_Buffer";
$content .= "<tr><td align=\"center\" colspan=\"6\">"._BBFORUM_TOTTOPICS."<b>$Amount_Of_Topics</b>&nbsp;<b>|</b>&nbsp;"._BBFORUM_TOTPOSTS."<b>$Amount_Of_Posts</b>&nbsp;<b>|</b>&nbsp;"._BBFORUM_TOTVIEWS."<b>$Amount_Of_Topic_Views</b>&nbsp;<b>|</b>&nbsp;"._BBFORUM_TOTREPLIES."<b>$Amount_Of_Topic_Replies</b>&nbsp;<b>|</b>&nbsp;<a href=\"modules.php?name=Members_List\">"._BBFORUM_TOTMEMBERS."</a>&nbsp;<b>$Amount_Of_Members</b></center></td></tr>";
$content .= "<tr><td colspan=\"6\">";
$content .= "<table width=\"100%\" cellpadding=\"0\" bordercolor=\"$bgcolor1\" cellspacing=\"$cellspacing\" border=\"0\" vAlign=\"top\" height=\"32\">";
$content .= "<tr>";
$a = 1;
    global $user, $cookie, $sitename, $prefix, $user_prefix, $admin, $module_name, $db;
    $result=$db->sql_query("SELECT user_id, username, user_posts, user_avatar FROM ".$user_prefix."_users ORDER BY user_posts DESC LIMIT 0,5");
    while(list($user_id, $username, $user_posts, $user_avatar) = $db->sql_fetchrow($result)) {

$content .= "<td width=\"32\" vAlign=\"middle\">";
if (eregi("http://", $user_avatar)) {
$content .= "&nbsp;&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\"><img alt src=\"$user_avatar\" border =\"0\" width=\"32\" height=\"32\"></a></td>";
}
else
$content .= "&nbsp;&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\"><img alt src=\"modules/Forums/images/avatars/$user_avatar\" border =\"0\" width=\"32\" height=\"32\"></a></td>";
$content .= "<td vAlign=\"middle\">&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\"><b>$username</b></a>&nbsp;<br>&nbsp;<a href=\"modules.php?name=Forums&amp;file=search&amp;search_author=$username\">Posts:</a>&nbsp; ";
$content .= "&nbsp;<a href=\"modules.php?name=Forums&amp;file=search&amp;search_author=$username\">$user_posts</a>&nbsp;</td>";
}
$content .= "</tr></table>";
$content .= "</td><tr>";
$content .= "</table>";
//Please leave the following link in place so other people can also share this block !!
$content .=  "<p align=right><a href= http://udesign.me.uk>©</a></p>";
?>
