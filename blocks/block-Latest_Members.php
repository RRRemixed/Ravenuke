<?php
/************************************************************************/
/* Latest Members for phpBB 2.0.0-6 port to PHP Nuke 6.5+               */
/* ====================================================                 */
/* Copyright (c) 2003-2004 by Telli (telli@codezwiz.com)                */
/* http://codezwiz.com 						                  */
/* Last Edited - 26 Jan 2004	      					      */
/*                                                                      */ 
/* This block list the last five members that joined in descending      */
/* order. User name is also a hyperlink to thier forum Profile          */
/************************************************************************/


if (eregi("block-Latest_Members.php",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
}
//Language
define("_THEME","Theme");
// Set avatar size
$Avsize = "width=20 height=20 align=\"absmiddle\"";
global $prefix;
// How Many to display
$totaltoshow  = 5;
$query="SELECT username, theme, user_avatar, user_from, user_website, user_regdate, user_id from $prefix"._users." ORDER BY user_id DESC LIMIT $totaltoshow"; 
	$result=mysql_query($query);
	while(list($user_name, $theme, $user_avatar, $user_from, $user_website, $user_regdate, $uid) = mysql_fetch_row($result)) {
 
   if ($theme == "") {
	$theme = "Default";
			}

      $ShowLatestMembers .="<font class=\"content\"><img src = modules/Forums/images/avatars/$user_avatar $Avsize>&nbsp;<A HREF=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$uid\">$user_name</a><br>("._THEME."&nbsp;:&nbsp;<strong>$theme</strong>)<br>"._DATE."&nbsp;($user_regdate)</font><br>";
}

$content .= "$ShowLatestMembers";
?>