<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* User Groups Module                                                   */
/* Copyright (c) 2004 David Karn                                        */
/* http://webdever.net/                                                 */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$pagetitle = "- User Groups";
$index = 0;

function ugheader()
{
global $admin, $db, $prefix, $admin_file;

$query = "SELECT 1 FROM `".$prefix."_groups_info` LIMIT 0";
$exists = $db->sql_query($query);
if (!$exists)
{
$db->sql_query("CREATE TABLE `".$prefix."_groups_info` (
  `id` int(11) NOT NULL auto_increment,
  `desc` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=22 ;");

$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (1, 'Personal user\'s Journal entry. Valid for publics and privates entries');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (2, 'Get points for commenting in a public user\'s Journal');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (3, 'Get points for sending the link to our site to a friend via Recommend Us Module');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (4, 'News that the user sends from Submit News module and then published by the administrator');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (5, 'Get points for commenting on any article and/or news');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (6, 'Each article\'s or news has an option to send it to a friend. Points valid for each time the user sends the article to a friend');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (7, 'Get points voting for any article');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (8, 'Get points for voting for any survey, actual or old ones are valid');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (9, 'Comment published for any actual or old survey');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (10, 'Get points for opening a new thread in the Forums');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (11, 'Forums threads answered or replied');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (12, 'Comment published for any review in the Reviews module');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (13, 'Get points for each page view. Valid for any page of the site');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (14, 'Get points for visiting any resource on WebLinks module');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (15, 'Get Points for voting for a resource in WebLinks module');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (16, 'Comments posted on any resource in the WebLink module');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (17, 'Get points for downloading any file or resource on Downloads module');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (18, 'Get points for voting for a resource in Downloads module');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (19, 'Comments posted on any resource in the Downloads module');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (20, 'Get points for publishing a public message using the Broadcast message system');");
$db->sql_query("INSERT INTO `".$prefix."_groups_info` VALUES (21, 'Get points for clicking on a banner');");
}

OpenTable();
?>
<center>
[&nbsp;<a href='modules.php?name=User_Groups'>Groups List</a>&nbsp;|&nbsp;
<a href='modules.php?name=User_Groups&op=list'>How to Earn Points</a>&nbsp;|&nbsp;
<a href='modules.php?name=User_Groups&op=users'>Top Users</a>&nbsp;]

<?php
if (is_admin($admin)) {
if ($admin_file == '') { $admin_file == 'admin'; }
?>
<br>[&nbsp;<a href="modules.php?name=User_Groups&op=alist">Edit Point Descriptions</a>&nbsp;|&nbsp;<a href="<?=$admin_file;?>.php?op=Groups">Edit Groups</a>&nbsp;|&nbsp;<a href="modules.php?name=User_Groups&op=modusers">Edit User Points</a>&nbsp;]</center>
<?php
}
echo "</center>";
CloseTable();
echo '<br>';
}

function arch()
{
global $db, $prefix;
include('header.php');
ugheader();
OpenTable();
echo '<span class="content"><center><b>User Groups</b></center><br />';
$query='SELECT * FROM '.$prefix.'_groups ORDER BY `points` ASC';
$result=$db->sql_query($query);
while ($h = $db->sql_fetchrow($result))
{
$description = $h['description'];
$name = $h['name'];
$points = $h['points'];
$id = $h['id'];
echo "<br><a href='modules.php?name=User_Groups&op=group&id=$id'>$name</a><br />(requires $points user points)<br />$description<br />";
}
CloseTable();
echo '<br />';
include("footer.php");
}

function group()
{
global $db, $prefix, $id;
include('header.php');
ugheader();
OpenTable();
$query='SELECT description, points, name FROM '.$prefix."_groups WHERE `id`='$id' LIMIT 1";
$result=$db->sql_query($query);
$h = $db->sql_fetchrow($result);
$description = $h['description'];
$name = $h['name'];
$points = $h['points'];
echo "<span class=\"content\"><b>$name</b><br /><br />(requires $points user points)<br />$description<br /></span>";
CloseTable();
echo '<br>';
OpenTable();
echo "<span class='content'><b>Users in this group</b></span><br><br>";
$query='SELECT points FROM '.$prefix."_groups WHERE `points`>'$points' ORDER BY `points` ASC LIMIT 1";
$result=$db->sql_query($query);
$h = $db->sql_fetchrow($result);
$mpoints = $h['points'];
if ($mpoints)
{
$query='SELECT username, user_id, points FROM '.$prefix."_users WHERE `points`<'$mpoints' AND `points`>='$points' AND `user_id`>'1' ORDER BY `points` DESC";
} else {
$query='SELECT username, user_id, points FROM '.$prefix."_users WHERE `points`>='$points' AND `user_id`>'1' ORDER BY `points` DESC";
}
$result=$db->sql_query($query);
while ($h = $db->sql_fetchrow($result))
{
$id = $h['user_id'];
$name = $h['username'];
$points = $h['points'];
echo "<a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$id\">$name</a> ($points points)<br><br>";
}
CloseTable();
echo '<br />';
include("footer.php");
}

function users()
{
global $db, $prefix;
include('header.php');
ugheader();
OpenTable();
echo "<span class='content'><center><b>Top 50 Users</b></span><br /><br /><table width=\"200px\" cellpadding=\"1\" cellspacing=\"0\" border=\"0\"><tr><td width=\"100%\" align=\"center\"><span class=\"content\"><b>Member</b></span></td><td align=\"center\"><span class=\"content\"><b>Points</b></span></td></tr>";
$query='SELECT username, user_id, points FROM '.$prefix."_users WHERE `user_id`>'1' ORDER BY `points` DESC LIMIT 50";
$result=$db->sql_query($query);
$i = 1;
while ($h = $db->sql_fetchrow($result))
{
$id = $h['user_id'];
$name = $h['username'];
$points = $h['points'];
echo "<tr><td align=\"left\"><span class=\"content\">$i: </span><a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$id\">$name</a></td><td align=\"center\"><span class=\"content\">$points</span></td></tr>";
$i++;
}

echo '</table></center><br />';
CloseTable();
include("footer.php");
}

function glist()
{
global $db, $prefix;
include('header.php');
ugheader();
OpenTable();
echo '<center><span class="content"><b>Point Values</b></span></center><br />';
$query='SELECT `points` FROM '.$prefix.'_groups_points ORDER BY `id` ASC LIMIT 21';
$result=$db->sql_query($query);
$i = 1;
while ($h = $db->sql_fetchrow($result))
{
${'p'.$i.''} = $h['points'];
$i++;
}
$query='SELECT `desc` FROM '.$prefix.'_groups_info ORDER BY `id` ASC LIMIT 21';
$result=$db->sql_query($query);
$i = 1;
while ($h = $db->sql_fetchrow($result))
{
${'i'.$i.''} = $h['desc'];
$i++;
}
?>
<table border="0" width="100%" cellspacing="10px"><tr><td align="center" bgcolor="#5c5c5b"><b>Name</b></td><td align="center" bgcolor="#5c5c5b"><b>Description</b></td><td align="center" bgcolor="#5c5c5b"><b>Points</b></td></tr>

<tr><td><span class="content"> Journal Entry </span></td><td><span class="content"><?=$i1;?></span></td><td><span class="content"> <?=$p1;?> </span></td></tr>

<tr><td><span class="content"> Journal Comment </span></td><td><span class="content"><?=$i2;?></span></td><td><span class="content"> <?=$p2;?> </span></td></tr>

<tr><td><span class="content"> Recommendation to a Friend </span></td><td><span class="content"><?=$i3;?></span></td><td><span class="content"> <?=$p3;?> </span></td></tr>

<tr><td><span class="content"> News Submission Published </span></td><td><span class="content"><?=$i4;?></span></td><td><span class="content"> <?=$p4;?> </span></td></tr>

<tr><td><span class="content"> News Comment </span></td><td><span class="content"><?=$i5;?></span></td><td><span class="content"> <?=$p5;?> </span></td></tr>

<tr><td><span class="content"> News Sent to a Friend </span></td><td><span class="content"><?=$i6;?></span></td><td><span class="content"> <?=$p6;?> </span></td></tr>

<tr><td><span class="content"> News Article Rating </span></td><td><span class="content"><?=$i7;?></span></td><td><span class="content"> <?=$p7;?> </span></td></tr>

<tr><td><span class="content"> Vote in Surveys </span></td><td><span class="content"><?=$i8;?></span></td><td><span class="content"> <?=$p8;?> </span></td></tr>

<tr><td><span class="content"> Comment in Surveys </span></td><td><span class="content"><?=$i9;?></span></td><td><span class="content"> <?=$p9;?> </span></td></tr>

<tr><td><span class="content"> Forum New Post </span></td><td><span class="content"><?=$i10;?></span></td><td><span class="content"> <?=$p10;?> </span></td></tr>

<tr><td><span class="content"> Forum Answer Post </span></td><td><span class="content"><?=$i11;?></span></td><td><span class="content"> <?=$p11;?> </span></td></tr>

<tr><td><span class="content"> Review Comment </span></td><td><span class="content"><?=$i12;?></span></td><td><span class="content"> <?=$p12;?> </span></td></tr>

<tr><td><span class="content"> Page View </span></td><td><span class="content"><?=$i13;?></span></td><td><span class="content"> <?=$p13;?> </span></td></tr>

<tr><td><span class="content"> Visit to a WebLink </span></td><td><span class="content"><?=$i14;?></span></td><td><span class="content"> <?=$p14;?> </span></td></tr>

<tr><td><span class="content"> Rate to any WebLink </span></td><td><span class="content"><?=$i15;?></span></td><td><span class="content"> <?=$p15;?> </span></td></tr>

<tr><td><span class="content"> Comment to any WebLink </span></td><td><span class="content"><?=$i16;?></span></td><td><span class="content"> <?=$p16;?> </span></td></tr>

<tr><td><span class="content"> Download of a File </span></td><td><span class="content"><?=$i17;?></span></td><td><span class="content"> <?=$p17;?> </span></td></tr>

<tr><td><span class="content"> Rate to any Download </span></td><td><span class="content"><?=$i18;?></span></td><td><span class="content"> <?=$p18;?> </span></td></tr>

<tr><td><span class="content"> Comment to any Download </span></td><td><span class="content"><?=$i19;?></span></td><td><span class="content"> <?=$p19;?> </span></td></tr>

<tr><td><span class="content"> Broadcast Message </span></td><td><span class="content"><?=$i20;?></span></td><td><span class="content"> <?=$p20;?> </span></td></tr>

<tr><td><span class="content"> Click on any Banner </span></td><td><span class="content"><?=$i21;?></span></td><td><span class="content"> <?=$p21;?> </span></td></tr></table>
<?php
CloseTable();
echo '<br />';
include("footer.php");
}

function alist()
{
global $db, $prefix, $admin;
if (!is_admin($admin)) {
die("Access Denied");
}
include('header.php');
ugheader();
OpenTable();
echo '<center><span class="content"><b>Point Descriptions</b></span></center><br />';
$query='SELECT `points` FROM '.$prefix.'_groups_points ORDER BY `id` ASC LIMIT 21';
$result=$db->sql_query($query);
$i = 1;
while ($h = $db->sql_fetchrow($result))
{
${'p'.$i.''} = $h['points'];
$i++;
}
$query='SELECT `desc` FROM '.$prefix.'_groups_info ORDER BY `id` ASC LIMIT 21';
$result=$db->sql_query($query);
$i = 1;
while ($h = $db->sql_fetchrow($result))
{
${'i'.$i.''} = $h['desc'];
$i++;
}
?>
<table border="0" width="100%" cellspacing="10px"><tr><td align="center" bgcolor="#5c5c5b"><b>Name</b></td><td align="center" bgcolor="#5c5c5b"><b>Description</b></td><td align="center" bgcolor="#5c5c5b"><b>Edit</b></td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Journal Entry </span></td><td><textarea name="text" rows="2" cols="30"><?=$i1;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="1"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Journal Comment </span></td><td><textarea name="text" rows="2" cols="30"><?=$i2;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="2"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Recommendation to a Friend </span></td><td><textarea name="text" rows="2" cols="30"><?=$i3;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="3"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> News Submission Published </span></td><td><textarea name="text" rows="2" cols="30"><?=$i4;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="4"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> News Comment </span></td><td><textarea name="text" rows="2" cols="30"><?=$i5;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="5"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> News Sent to a Friend </span></td><td><textarea name="text" rows="2" cols="30"><?=$i6;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="6"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> News Article Rating </span></td><td><textarea name="text" rows="2" cols="30"><?=$i7;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="7"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Vote in Surveys </span></td><td><textarea name="text" rows="2" cols="30"><?=$i8;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="8"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Comment in Surveys </span></td><td><textarea name="text" rows="2" cols="30"><?=$i9;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="9"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Forum New Post </span></td><td><textarea name="text" rows="2" cols="30"><?=$i10;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="10"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Forum Answer Post </span></td><td><textarea name="text" rows="2" cols="30"><?=$i11;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="11"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Review Comment </span></td><td><textarea name="text" rows="2" cols="30"><?=$i12;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="12"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Page View </span></td><td><textarea name="text" rows="2" cols="30"><?=$i13;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="13"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Visit to a WebLink </span></td><td><textarea name="text" rows="2" cols="30"><?=$i14;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="14"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Rate to any WebLink </span></td><td><textarea name="text" rows="2" cols="30"><?=$i15;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="15"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Comment to any WebLink </span></td><td><textarea name="text" rows="2" cols="30"><?=$i16;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="16"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Download of a File </span></td><td><textarea name="text" rows="2" cols="30"><?=$i17;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="17"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Rate to any Download </span></td><td><textarea name="text" rows="2" cols="30"><?=$i18;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="18"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Comment to any Download </span></td><td><textarea name="text" rows="2" cols="30"><?=$i19;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="19"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Broadcast Message </span></td><td><textarea name="text" rows="2" cols="30"><?=$i20;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="20"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr>

<tr><form action="modules.php" method="post"><td><span class="content"> Click on any Banner </span></td><td><textarea name="text" rows="2" cols="30"><?=$i21;?></textarea></td><td align="center">&nbsp;<input type="hidden" name="name" value="User_Groups"><input type="hidden" name="id" value="21"><input type="submit" name="op" value="Submit"></form>&nbsp;</td></tr></table>
<?php
CloseTable();
echo '<br />';
include("footer.php");
}

function Submit()
{
global $db, $prefix, $id, $text, $admin;
if (!is_admin($admin)) {
die("Access Denied");
}
include('header.php');
ugheader();
OpenTable();
$text = addslashes($text);
$query="UPDATE `".$prefix."_groups_info` SET `desc`='$text' WHERE `id`='$id' LIMIT 1";
$result=$db->sql_query($query);
if ($result)
{
echo "Description edited successfully";
} else {
echo "<span class='content'>Error, query was not executed successfully</span>";
}
CloseTable();
echo '<br />';
include("footer.php");
}

function modusers()
{
global $db, $prefix;
include('header.php');
ugheader();
OpenTable();
$res = $db->sql_query("SELECT username, user_id, points FROM ".$prefix."_users WHERE user_id>1 ORDER BY username");
$num = $db->sql_numrows($res);
echo "<center><span class='content'><b>Change User Points</b></span></center><br /><br />
<script type=\"text/javascript\">
var unames=new Array($num)
";
while($row = $db->sql_fetchrow($res)) {
echo "unames[${row['user_id']}]=\"${row['points']}\"\n";
}
echo "
function put(form)
{
option=form.id.options[form.id.selectedIndex].value
txt=unames[option]
form.points.value=txt
}
</script>
"
      .""
      ."<center><form action=\"$PHP_SELF\" method=\"post\">
<select name=\"id\" onchange=\"put(this.form)\">";
   $query = $db->sql_query("SELECT username, user_id, points FROM ".$prefix."_users WHERE user_id>1 ORDER BY username");
   while ($row = $db->sql_fetchrow($query)) {
      $id = $row['user_id'];
      $name = $row['username'];
      $points = $row['points'];
      echo "<option value=\"${row['user_id']}\">${row['username']}</option>";
   }
   echo "</select>  
<input type=\"text\" name=\"points\" value=\"$points\" size=\"5\" maxlength=\"5\">"
   ."<input type=\"submit\" name=\"op\" value=\"Edit Member\">"
   ."</form></center>";
CloseTable();
echo '<br />';
include("footer.php");
} 

function AddMember() {
global $db, $prefix, $id, $name, $points, $admin;
if (!is_admin($admin)) {
die("Access Denied");
}
$result=$db->sql_query("UPDATE ".$prefix."_users SET points='$points' WHERE user_id=$id LIMIT 1");
if ($result)
{
include('header.php');
ugheader();
OpenTable();
   Header("Location: modules.php?name=User_Groups&op=modusers");
} else {
echo "<span class='content'>Error, query was not executed successfully</span>";
}
CloseTable();
echo '<br />';
include("footer.php");
}

switch($op) {
case 'Submit':
Submit();
break;

case 'group':
group();
break;

case 'users':
users();
break;

case 'list':
glist();
break;

case 'alist':
alist();
break;

case 'modusers':
modusers();
break;

case 'Edit Member':
AddMember();
break; 

default:
arch();
break;
}
?>
