<?php
if (eregi("block-Forum.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}
	
global $prefix, $db, $sitename, $admin, $ThemeSel;

$HideViewReadOnly = 1; 
$Last_New_Topics  = 8; //amount of topics to show
$Count_Topics = 0;
$Topic_Buffer = "";

$result = $db->sql_query( "SELECT topic_id, forum_id, topic_last_post_id, topic_title, topic_poster, topic_views, topic_replies, topic_moved_id FROM ".$prefix."_bbtopics ORDER BY topic_last_post_id DESC", $db );
while( list( $topic_id, $forum_id, $topic_last_post_id, $topic_title, $topic_poster, $topic_views, $topic_replies, $topic_moved_id ) = $db->sql_fetchrow ( $result) )

{
   $skip_display = 0;
   if( $HideViewReadOnly == 1 )
   {
      $result1 = $db->sql_query( "SELECT auth_view, auth_read FROM ".$prefix."_bbforums where forum_id = '$forum_id'", $db );
      list( $auth_view, $auth_read ) = $db->sql_fetchrow ( $result1 );
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

$result2 = $db->sql_query("SELECT username, user_id FROM ".$prefix."_users where user_id='$topic_poster'", $db);
list($username, $user_id)=$db->sql_fetchrow ($result2);
$avtor=$username;
$sifra=$user_id;

$result3 = $db->sql_query("SELECT poster_id, FROM_UNIXTIME(post_time,'%d/%m/%Y om %H:%i') as post_time FROM ".$prefix."_bbposts where post_id='$topic_last_post_id'", $db);
list($poster_id, $post_time)=$db->sql_fetchrow ($result3);

$result4 = $db->sql_query("SELECT username, user_id FROM ".$prefix."_users where user_id='$poster_id'", $db);
list($username, $user_id)=$db->sql_fetchrow ($result4);

            	          $viewlast .="  <tr> 
    <td height=\"34\" class=\"row1\"><img src=\"themes/$ThemeSel/images/star.png\" border=\"0\" alt=\"\" /></td>
    <td width=\"80%\" class=\"row1\">&nbsp;<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;t=$topic_id#$topic_last_post_id\">$topic_title</a></td>
    <td align=\"center\" class=\"row2\"><span class='gensmall'>$topic_replies</span></td>
    <td align=\"center\" class=\"row3\"><a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$sifra\">$avtor</a></td>
    <td align=\"center\"  class='row2'><span class='gensmall'>$topic_views</span></td>
    <td width=\"20%\" align=\"center\" class=\"row1\"><span class='gensmall'><font size=\"-2\"><i>&nbsp;&nbsp;$post_time&nbsp;</i></font></span><br />
      <a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$user_id\">$username</a>&nbsp;<a href=\"modules.php?name=Forums&amp;file=viewtopic&amp;p=$topic_last_post_id#$topic_last_post_id\"><img src=\"themes/$ThemeSel/forums/images/icon_newest_reply.gif\" border=\"0\" alt=\"\" /></a></td>
  </tr>";
}
   
   if( $Last_New_Topics == $Count_Topics ) { break 1; }
   
}

    $content .= "
<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\">
  <tr>
    <td><table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\">
        <tr>
          <td bgcolor=\"#010101\">
		  
<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\">
  <tr> 
    <td height=\"25px\" colspan=\"2\" align=\"center\" class=\"cat\"><span class=\"title\">Topics</span></td>
    <td align=\"center\" class=\"cat\"><span class=\"title\">Answers</span></td>
	<td align=\"center\" class=\"cat\"><span class=\"title\">Author</span></td>
    <td align=\"center\" class=\"cat\"><span class=\"title\">Views</span></td>
    <td align=\"center\" class=\"cat\"><span class=\"title\">Last Post</span></td>
  </tr>";
    $content .= "$viewlast";

    $content .="  <tr> 
    <td height=\"12\" colspan=\"6\" class=\"spacerow\"></td>
  </tr>
</table></td>
        </tr>
      </table></td>
  </tr>
</table>";

?>