<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

global $prefix, $db, $admin_file;
if (!eregi("".$admin_file.".php", $_SERVER['PHP_SELF'])) { die ("Access Denied."); }
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='News'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;	
    }
}

if ($row2['radminsuper'] == 1) {
	$radminsuper = 1;	
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
  $mod_name = "Clan Module";
    define("_MODNAME",$mod_name);
  function admin_main()
  {
    include("header.php");
    Opentable();
    //Get some module information.
    $recmatchesblock2 = $db->sql_query("select active from ".$prefix."_blocks where block_file='blocks-clanmodule.recmatches.php'");
    $checkrmb2 = $db->sql_numrows($recentmatchesblock2);
    if($checkrmb2 == 0)
    {
      $rmb = "Block Not Installed!";
    }
    else
    {
      $recmatchesblock = $db->sql_query("select active from ".$prefix."_blocks where block_file='blocks-clanmodule.recmatches.php' and active='1'");
    $checkrmb = $db->sql_numrows($recentmatchesblock);
    if($checkrmb == 1)
    {
      $rmb = "Enabled!";
    }
    else
    {
      $rmb = "Disabled!";
    } 
  }
$mod_settings = $db->sql_query("select * from ".$prefix."_cmod_settings");
$row = $db->sql_fetchrow($mod_settings);
$guest_book_status = $row['clan_gbook'];
$clan_name = $row['clan_name'];
$clan_tag = $row['clan_tag'];
$clan_history = $row['clan_history'];
$clan_recruiting = $row['clan_recruiting'];
$clan_join_thread = $row['clan_join_thread'];
$display_recruiting = $row['clan_display_recruiting'];
$gbook_allow = $row['clan_guestbook_user'];
    $game_members = $db->sql_query("select username,clan_member from ".$prefix."_users where clan_member='1'");
    $number_of_members = $db->sql_numrows($game_members);
    $number_games = $db->sql_query("select game_id from ".$prefix."_cmod_games");
    $number_of_games = $db->sql_numrows($number_games);
    ##$number_matches = $db->sql_query("select match_id from ".$prefix."_cmod_matches");
    ##$number_of_matches = $db->sql_numrows($number_matches);
    ##$number_leagues = $db->sql_query("select league_id from ".$prefix."_cmod_leagues");
    ##$number_of_leagues = $db->sql_numrows($number_leagues);
    echo "<center><b>"._MODNAME." Administration Control Panel</b></center><br>
	Clan Mod Statistics :<br>
	# Of Players : <b>$number_of_members</b><br>
	# Of Games : <b>$number_of_games</b><br>
	"; # Of Leagues : <b>$number_of_leagues</b><br>
	 # Of Matches : <b>$number_of_matches</b><br>
	echo "Guestbook : <b>$guest_book_status</b><br>
	Clan Name : <b>$clan_name</b><br>
	Clan Tag : <b>$guest_book_status</b><br>
	Recruiting :<b> $clan_recruiting</b><br>
	Join Thread : <b>$clan_join_thread</b><br>
	Display Recruiting In Roster : <b>$display_recruiting</b><br>
	History : <b>$clan_history</b><br>";
	#Recent Matches Block : <b>$rmb</b><br>
	echo "Allow Guests To Post in Guestbook : <b>$gbook_allow</b>";
    Closetable();
    Opentable();
    echo "[<a href=\"".$admin_file."?op=Clan_Module&func=settings\">Module Settings</a>] [<a href=\"".$admin_file."?op=Clan_Module&func=add_member\">Add Member To Roster</a>] 
	[<a href=\"".$admin_file."?op=Clan_Module&func=remove_member\">Remove Member From Roster</a>] 
	[<a href=\"".$admin_file."?op=Clan_Module&func=create_game\">Create Game</a>]";
    #<a href=\"".$admin_file."?op=Clan_Module&func=create_league\">Create League</a>]
    Closetable();
    Opentable();
    $g_id = $_POST['game_id'];
    if(!$g_id)
    {
      echo "Select game to view :";
      	echo "<form action=\"?op=Clan_Module\" method=\"post\"><select name=\"game_id\" class=\"input\"><option>Select Game</option>
      		         <option>--------------</option>";
      	$topics = $db->sql_query("select game_name,game_id from ".$prefix."_cmod_games order by game_id desc");
      	while($g = $db->sql_fetchrow($topics))
      	{
      		$name = $g['game_name'];
      		$game_id = $g['game_id'];
      		echo "
      		         <option value=\"$game_id\" >$name</option>";
      	}
      	echo "</select><input type=\"submit\" value=\"Go\" class=\"input\"></form>";
      }
	  else
	  {
	    $roster = $db->sql_query("select * from ".$prefix."_cmod_roster where game_id='$g_id'");
      $countplayers = $db->sql_numrows($roster);
	     if($countplayers == 0)
      {
      	echo "<b>There are no players in this game.</b><br>";
      echo "Select game to view :";
      	echo "<form action=\"?op=Clan_Module\" method=\"post\"><select name=\"game_id\" class=\"input\"><option>Select Game</option>
      		         <option>--------------</option>";
      	$topics = $db->sql_query("select game_name,game_id from ".$prefix."_cmod_games order by game_id desc");
      	while($g = $db->sql_fetchrow($topics))
      	{
      		$name = $g['game_name'];
      		$game_id = $g['game_id'];
      		echo "
      		         <option value=\"$game_id\" >$name</option>";
      	}
      	echo "</select><input type=\"submit\" value=\"Go\" class=\"input\"></form>
		  [<a href=\"?op=Clan_Module&func=add_mroster&game_id=$g_id\">Add Member</a>] [<a href=\"?op=Clan_Module&func=delete_game&game_id=$g_id\">Delete Game</a>] [<a href=\"?op=Clan_Module&func=edit_game&game_id=$g_id\">Edit Game</a>]";
      }
      else 
      {
      Opentable();
      $roster = $db->sql_query("select * from ".$prefix."_cmod_roster where game_id=".$g_id."");
      $gamename = $db->sql_query("select game_name from ".$prefix."_cmod_games where game_id=".$g_id."");
      $rowgame = $db->sql_fetchrow($gamename);
      $game_name = $rowgame['game_name'];
           echo "<span>Roster For $game_name</span><table width=\"100%\" cellpadding=\"2\" cellspacing=\"1\">
              <tr>
                <td width=\"35%\" valign=\"top\" class=\"row1\"><span class=\"font\">Username</span> </td>
                <td width=\5%\" valign=\"top\" class=\"row1\"><span >Flag</span></td>
                <td width=\"46%\" valign=\"top\" class=\"row1\"></td>
              </tr>";
              $a = "1";
      while($row = $db->sql_fetchrow($roster))
      {
        	if($a == "0")
                  {
                         $rbg = "row1";
                         $a ++;
                  }
           elseif($a == "1")
                 {
                          $rbg = "row2";
                          $a = 0;
                  }
         $roster_id = $row['roster_id'];
         $user_id = $row['user_id'];
         $getplayer = $db->sql_query("select cmod_alias,cmod_country from ".$prefix."_users where user_id=".$user_id."");
         $plyr = $db->sql_fetchrow($getplayer);
         $name = $plyr['cmod_alias'];
         $country = $plyr['cmod_country'];
         $country = "<img src=\"images/roster/$country.gif\">";
         echo "<tr>
                <td width=\"35%\" valign=\"top\" class=\"$rbg\">$name</td>
                <td width=\5%\" valign=\"top\" class=\"$rbg\"><span >$country</span></td>
                <td width=\"46%\" valign=\"top\" class=\"$rbg\"><span >[<a href=\"?op=Clan_Module&func=removeplayer&user_id=$user_id&game_id=$g_id\">Remove</a>]</span></td>
              </tr>";
         }
      echo "</table>";
      echo "Select game to view :";
      	echo "<form action=\"?op=Clan_Module\" method=\"post\"><select name=\"game_id\" class=\"input\"><option>Select Game</option>
      		         <option>--------------</option>";
      	$topics = $db->sql_query("select game_name,game_id from ".$prefix."_cmod_games order by game_id desc");
      	while($g = $db->sql_fetchrow($topics))
      	{
      		$name = $g['game_name'];
      		$game_id = $g['game_id'];
      		echo "
      		         <option value=\"$game_id\" >$name</option>";
      	}
      		echo "</select><input type=\"submit\" value=\"Go\" class=\"input\"></form>
		  [<a href=\"?op=Clan_Module&func=add_mroster&game_id=$g_id\">Add Member</a>] [<a href=\"?op=Clan_Module&func=delete_game&game_id=$g_id\">Delete Game</a>] [<a href=\"?op=Clan_Module&func=edit_game&game_id=$g_id\">Edit Game</a>]";
		Closetable();
      }	
  }
  Closetable();
   GraphicAdmin();
    include("footer.php");
  }
  function admin_settings()
  {
    include('header.php');
    $save_settings = $_POST['save_settings'];
    if(!$save_settings)
    {
      $mod_settings = $db->sql_query("select * from ".$prefix."_cmod_settings");
$row = $db->sql_fetchrow($mod_settings);
$guest_book_status = $row['clan_gbook'];
$clan_name = $row['clan_name'];
$clan_tag = $row['clan_tag'];
$clan_history = $row['clan_history'];
$clan_recruiting = $row['clan_recruiting'];
$clan_join_thread = $row['clan_join_thread'];
$display_recruiting = $row['clan_display_recruiting'];
$gbook_allow = $row['clan_guestbook_user'];
      Opentable();
      echo "<b><center>Edit Clan Module Configuration</center></b>";
      echo "<hr width=\"95%\" height=\"2\" class=\"input\"><form action=\"admin.php?op=Clan_Module&func=settings\" method=\"post\" name=\"settings\">
		<table width=\"100%\">
		<tr>
		<td width=\"19%\"><span ><b>Clan Name :</b> </span></td>
		<td width=\"71%\"><input name=\"name\" class=\"input\" size=\"53\" value=\"$clan_name\" /></td>
		</tr>
		<tr>
		<td width=\"19%\"><span ><b>Clan Tag :</b> </span></td>
		<td width=\"71%\"><input name=\"tag\" class=\"input\" size=\"53\" value=\"$clan_tag\" /></td>
		</tr>
		<tr>
		<td width=\"19%\"><span ><b>Join Thread :</b> </span></td>
		<td width=\"71%\"><input name=\"thread\" class=\"input\" size=\"53\" value=\"$clan_join_thread\" /></td>
		</tr>
		<tr>
		<td width=\"19%\"><span ><b>GuestBook :</b> </span></td>
		<td width=\"71%\"><select name=\"guestbook\" class=\"input\"><option value=\"$guest_book_status\">$guest_book_status</option>
		<option value=\"\">---------</option>
		<option value=\"enabled\">enabled</option>
		<option value=\"disabled\">disabled</option></td>
		</tr>
		<tr>
		<td width=\"19%\"><span ><b>Allow Non-Member Posts :</b> </span></td>
		<td width=\"71%\"><select name=\"allow_gbook_guests\" class=\"input\"><option value=\"$gbook_allow\">$gbook_allow</option>
		<option value=\"\">---------</option>
		<option value=\"Yes\">Yes</option>
		<option value=\"No\">No</option></td>
		</tr>
		<tr>
		<td width=\"19%\"><span ><b>Recruiting :</b> </span></td>
		<td width=\"71%\"><select name=\"recruiting\" class=\"input\"><option value=\"$clan_recruiting\">$clan_recruiting</option>
		<option value=\"\">---------</option>
		<option value=\"yes\">yes</option>
		<option value=\"no\">no</option></td>
		</tr>
		<tr>
		<td width=\"19%\"><span ><b>Display Recruiting :</b> </span></td>
		<td width=\"71%\"><select name=\"display_recruiting\" class=\"input\"><option value=\"$display_recruiting\">$display_recruiting</option>
		<option value=\"\">---------</option>
		<option value=\"yes\">yes</option>
		<option value=\"no\">no</option> - Will appear at bottom of roster with a link to forum thread.</td>
		</tr>
		<tr>
		<td width=\"19%\" valign=\"top\"><span ><b>Clan History :</b> </span></td>
		<td width=\"71%\"><textarea name=\"history\" class=\"input\" cols=\"45\" rows=\"10\"/>$clan_history</textarea></td>
		</tr>
		<tr>
		<td width=\"19%\" valign=\"top\"> </td>
		<td width=\"71%\" valign=\"right\"><input class=\"input\" name=\"save_settings\" type=\"submit\" value=\"Submit\"></td>
		</tr>
		</table>
        </form>";
        Closetable();
 }  
 else
 {
   $guest_book_status = $_POST['guestbook'];
   $clan_name = $_POST['name'];
   $clan_tag = $_POST['tag'];
   $clan_history = $_POST['history'];
   $clan_recruiting = $_POST['recruiting'];
   $clan_join_thread = $_POST['thread'];
   $display_recruiting = $_POST['display_recruiting'];
   $guest_book_allow = $_POST['allow_gbook_guests'];
   $update = $db->sql_query("update ".$prefix."_cmod_settings set clan_gbook='$guest_book_status',clan_name='$clan_name',clan_tag='$clan_tag',clan_history='$clan_history',clan_recruiting='$clan_recruiting',clan_join_thread='$clan_join_thread',clan_display_recruiting='$display_recruiting',clan_guestbook_user='$guest_book_allow'") or die(mysql_error());
   Opentable();
   echo "Succefully Updated Settings <a href=\"admin.php?op=Clan_Module\">Continue</a>";
   Closetable();
 }
GraphicAdmin();
 include('footer.php');
 }   
function add_member()
{
    include('header.php');
    $save_member = $_POST['save_member'];
    if(!$save_member)
    {
      Opentable();
      $get_members = $db->sql_query("select username,clan_member,user_id from ".$prefix."_users where clan_member='0' and user_id != 1");
      echo "<span>Add Member For Roster</span><form action=\"?op=Clan_Module&func=add_member\" method=\"post\"><select class=\"input\" name=\"member\"><option value=\"\">Add Member</option>
	<option value=\"\">---------</option>";
      while($row = $db->sql_fetchrow($getmembers))
      { 
        $user_id = $row['user_id'];
	  $username = $row['username'];
	  echo "<option value=\"$user_id\">$username</option>";
      }
      echo "</select><input class=\"input\" name=\"save_member\" type=\"submit\" value=\"Submit\"></form>";
       Closetable();
     }
     else
     {
	   $user_id = $_POST['member'];
	   if(!$user_id)
	   {
		 Opentable();
		 echo "<span style=\"color: red\">No Member Selected! <a href=\"admin.php?op=Clan_Module\">Continue</a></span>";
		 Closetable();
       }

       $update = $db->sql_query("update ".$prefix."_users set clan_member='1' where user_id='$user_id' limit 1");
       if(!$update)
       {
		 Opentable();
		 echo "<span style=\"color: red\">Error Updating Member <a href=\"admin.php?op=Clan_Module\">Continue</a></span>";
		 Closetable();
       }
       else
       {
         Opentable();
		 echo "Member Has been added to the roster <a href=\"admin.php?op=Clan_Module\">Continue</a>";
		 Closetable();
       }
    }
    GraphicAdmin();
    include('footer.php');
}
function add_game()
{
  include('header.php');
  $save_game = $_POST['save_game'];
  if(!$save_game)
  {
    Opentable();
      echo "<b><center>Add Game</center></b>";
      echo "<hr width=\"95%\" height=\"2\" class=\"input\"><form action=\"admin.php?op=Clan_Module&func=create_game\" method=\"post\" name=\"add_game\">
		<table width=\"100%\">
		<tr>
		<td width=\"19%\"><span ><b>Game Name :</b> </span></td>
		<td width=\"71%\"><input name=\"name\" class=\"input\" size=\"53\" value=\"Game's Name\" /></td>
		</tr>
		<tr>
		<td width=\"19%\"><span ><b>Weight :</b> </span></td>
		<td width=\"71%\"><input name=\"weight\" class=\"input\" size=\"53\" value=\"0\" /></td>
		</tr>
		<tr>
		<td width=\"19%\" valign=\"top\"> </td>
		<td width=\"71%\" valign=\"right\"><input class=\"input\" name=\"save_game\" type=\"submit\" value=\"Submit\"></td>
		</tr>
		</table>
        </form>";
        Closetable();
      }
	  else
	  {
		$game_name = $_POST['name'];
		$weight = $_POST['weight'];
		 $insert = $db->sql_query("insert into ".$prefix."_cmod_games (game_name,game_weight) values ('$game_name','$weight')")or die(mysql_error());
		  if(!$insert)
       {
		 Opentable();
		 echo "<span style=\"color: red\">Error Adding Game <a href=\"admin.php?op=Clan_Module\">Continue</a></span>";
		 Closetable();
       }
       else
       {
         Opentable();
		 echo "Game Has been added to the roster <a href=\"admin.php?op=Clan_Module\">Continue</a>";
		 Closetable();
       }
	  }
	  GraphicAdmin();
	  include('footer.php');
}
function edit_game()
{
  include('header.php');
   	if(!$_GET['game_id'])
	{
		Opentable();
		echo "No Game Selected!";
		Closetable();
		die();
	}
	$game_id = $_GET['game_id'];
	$getgames = $db->sql_query("select * from ".$prefix."_cmod_games where game_id='$game_id'");
    $row = $db->sql_fetchrow($getgames);
	$game_weight = $row['game_weight'];
	$game_name = $row['game_name'];
	$save_game = $_POST['save_game'];
	if(!$save_game)
  {
    Opentable();
      echo "<b><center>Edit Game $game_name</center></b>";
      echo "<hr width=\"95%\" height=\"2\" class=\"input\"><form action=\"admin.php?op=Clan_Module&func=edit_game&game_id=$game_id\" method=\"post\" name=\"edit_game\">
		<table width=\"100%\">
		<tr>
		<td width=\"19%\"><span ><b>Game Name :</b> </span></td>
		<td width=\"71%\"><input name=\"name\" class=\"input\" size=\"53\" value=\"$game_name\" /></td>
		</tr>
		<tr>
		<td width=\"19%\"><span ><b>Weight :</b> </span></td>
		<td width=\"71%\"><input name=\"weight\" class=\"input\" size=\"53\" value=\"$game_weight\" /></td>
		</tr>
		<tr>
		<td width=\"19%\" valign=\"top\"> </td>
		<td width=\"71%\" valign=\"right\"><input class=\"input\" name=\"save_game\" type=\"submit\" value=\"Submit\"></td>
		</tr>
		</table>
        </form>";
        Closetable();
      }
	  else
	  {
		$game_name = $_POST['name'];
		$weight = $_POST['weight'];
		 $insert = $db->sql_query("update ".$prefix."_cmod_games set game_name='$game_name', game_weight='$weight' where game_id='$game_id'")or die(mysql_error());
		  if(!$insert)
       {
		 Opentable();
		 echo "<span style=\"color: red\">Error Editing Game <a href=\"admin.php?op=Clan_Module\">Continue</a></span>";
		 Closetable();
       }
       else
       {
         Opentable();
		 echo "Game Has been edited <a href=\"admin.php?op=Clan_Module\">Continue</a>.";
		 Closetable();
       }
	  }
	  GraphicAdmin();
	  include('footer.php');
}
function add_mroster()
{
  $game_id = $_GET['game_id'];
  include('header.php');
  if(!$game_id)
  {
	Opentable();
	 echo "<span style=\"color: red\">Error : No Game Selected <a href=\"admin.php?op=Clan_Module\">Continue</a></span>";
	 Closetable();
}
if(!$_POST['save_member'])
{
  Opentable();
  $getmembers = $db->sql_query("select user_id,username from ".$prefix."_users where clan_member='1'");
  echo "Add Member To Game<br>
  <b>Select Player :</b><form action=\"?op=Clan_Module&func=add_mroster&game_id=$game_id\" method=\"post\"><select class=\"input\" name=\"member\">";
  while($row = $db->sql_fetchrow($getmembers))
      {
        $user_id = $row['user_id'];
	  $username = $row['username'];
	  echo "<option value=\"$user_id\">$username</option>";
      }
      echo "</select><input class=\"input\" name=\"save_member\" type=\"submit\" value=\"Submit\"></form>";
       Closetable();
   }
   else
   {
	 $user_id = $_POST['member'];
	    	$checkifonroster = $db->sql_query("select user_id from ".$prefix."_cmod_roster where user_id='$user_id' and game_id='$game_id'");
   	$countcheck = $db->sql_numrows($checkifonroster);
   	if($countcheck == "1")
   	{
   		Opentable();
   		echo "This Member is allready on the roster!";
   		Closetable();
   		die();
   	}
	 $insert = $db->sql_query("insert into ".$prefix."_cmod_roster (game_id,user_id) values ('$game_id','$user_id')")or die(mysql_error());
	 if(!$insert)
       {
		 Opentable();
		 echo "<span style=\"color: red\">Error Adding Member <a href=\"admin.php?op=Clan_Module\">Continue</a></span>";
		 Closetable();
       }
       else
       {
         Opentable();
		 echo "Member Has been added to the roster <a href=\"admin.php?op=Clan_Module\">Continue</a>";
		 Closetable();
       }
     }
     GraphicAdmin();
     include('footer.php');
}
function create_league()
{
    include('header.php');
  $save_league = $_POST['save_league'];
  if(!$save_league)
  {
    Opentable();
      echo "<b><center>Add League</center></b>";
      echo "<hr width=\"95%\" height=\"2\" class=\"input\"><form action=\"admin.php?op=Clan_Module&func=create_league\" method=\"post\" name=\"add_league\">
		<table width=\"100%\">
		<tr>
		<td width=\"19%\"><span ><b>League Name :</b> </span></td>
		<td width=\"71%\"><input name=\"name\" class=\"input\" size=\"53\" value=\"League's Name\" /></td>
		</tr>
		<tr>
		<td width=\"19%\"><span ><b>Weight :</b> </span></td>
		<td width=\"71%\"><input name=\"weight\" class=\"input\" size=\"53\" value=\"0\" /></td>
		</tr>
		<tr>
		<td width=\"19%\" valign=\"top\"> </td>
		<td width=\"71%\" valign=\"right\"><input class=\"input\" name=\"save_league\" type=\"submit\" value=\"Submit\"></td>
		</tr>
		</table>
        </form>";
        Closetable();
      }
	  else
	  {
		$game_name = $_POST['name'];
		$weight = $_POST['weight'];
		 $insert = $db->sql_query("insert into ".$prefix."_cmod_leagues (league,weight) values ('$game_name','$weight')")or die(mysql_error());
		  if(!$insert)
       {
		 Opentable();
		 echo "<span style=\"color: red\">Error Adding League <a href=\"admin.php?op=Clan_Module\">Continue</a></span>";
		 Closetable();
       }
       else
       {
         Opentable();
		 echo "League Has been added to the match system <a href=\"admin.php?op=Clan_Module\">Continue</a>";
		 Closetable();
       }
	  }
	  GraphicAdmin();
	  include('footer.php');
}
function delete_game()
{
  include('header.php');
  	if(!$_GET['game_id'])
	{
		Opentable();
		echo "No Game Selected!";
		Closetable();
		die();
	}
	if(!$_GET['delete'])
	{
		$game_id = $_GET['game_id'];
		Opentable();
		echo "<span>Are you sure you want to delete this game and its roster? <br><a href=\"?op=Clan_Module&func=delete_game&game_id=$game_id&delete=yes\">Yes</a> | <a href=\"javascript:history.go(-1);\">No</a>.</span>";
		Closetable();
	}
	elseif($_GET['delete'] == "no")
	{
		Header("Location: admin.php?op=Clan_Module");
	}
	else
	{
	$game_id = $_GET['game_id'];
	$delete = $db->sql_query("delete from ".$prefix."_cmod_games where game_id=".$game_id."");
	$deletec = $db->sql_query("delete from ".$prefix."_cmod_roster where game_id=".$game_id."");
		if(!$delete)
	{
		Opentable2();
		echo "<span class=\"error\">Error couldnt delete game</span>";
		Closetable2();
	}
	elseif(!$deletec)
	{
		Opentable2();
		echo "<span class=\"error\">Error couldnt delete game roster</span>";
		Closetable2();
	}
	else
	{
	Opentable();
	echo "<span class=\"font\">Succefully Game and its roster!<a href=\"?op=Clan_Module\">Continue</a></span>";
	Closetable();
	}}
GraphicAdmin();
include('footer.php');
}
function remove_player()
{
   include('header.php');
  	if(!$_GET['game_id'])
	{
		Opentable();
		echo "No Game Selected!";
		Closetable();
		die();
	}
	if(!$_GET['user_id'])
	{
		Opentable();
		echo "No Player Selected!";
		Closetable();
		die();
	}
	if(!$_GET['delete'])
	{
		$game_id = $_GET['game_id'];
		$user_id = $_GET['user_id'];
		Opentable();
		echo "<span>Are you sure you want to delete this player from the roster? <br><a href=\"?op=Clan_Module&func=removeplayer&game_id=$game_id&delete=yes&user_id=$user_id\">Yes</a> | <a href=\"javascript:history.go(-1);\">No</a>.</span>";
		Closetable();
	}
	elseif($_GET['delete'] == "no")
	{
		Header("Location: admin.php?op=Clan_Module");
	}
	else
	{
	$game_id = $_GET['game_id'];
	$user_id = $_GET['user_id'];
	$deletec = $db->sql_query("delete from ".$prefix."_cmod_roster where game_id=".$game_id." and user_id=".$user_id." limit 1");
	if(!$deletec)
	{
		Opentable2();
		echo "<span class=\"error\">Error couldnt delete game roster</span>";
		Closetable2();
	}
	else
	{
	Opentable();
	echo "<span class=\"font\">Succefully Removed Player From roster!<a href=\"?op=Clan_Module\">Continue</a></span>";
	Closetable();
	}
	}
GraphicAdmin();
include('footer.php');

}
function remove_member()
{
   include('header.php');
	if(!$_POST['user_id'])
	{
		Opentable();
		 $getmembers = $db->sql_query("select user_id,username from ".$prefix."_users where clan_member='1'");
  echo "Remove Member From Clan<br>
  <b>Select Player :</b><form action=\"?op=Clan_Module&func=remove_member\" method=\"post\"><select class=\"input\" name=\"user_id\">";
  while($row = $db->sql_fetchrow($getmembers))
      {
        $user_id = $row['user_id'];
	  $username = $row['username'];
	  echo "<option value=\"$user_id\">$username</option>";
      }
      echo "</select><input class=\"input\" name=\"save_member\" type=\"submit\" value=\"Submit\"></form>";
		Closetable();
	}
	else 
	{
	$user_id = $_POST['user_id'];
	$deletec = $db->sql_query("update ".$prefix."_users set clan_member='0' where user_id='$user_id' limit 1");
	$deletem = $db->sql_query("delete from ".$prefix."_cmod_roster where user_id='$user_id'");
	if(!$deletec)
	{
		Opentable;
		echo "<span class=\"error\">Error Update Members Status!</span>";
		Closetable();
	}
	if(!$deletem)
	{
		Opentable();
		echo "<span class=\"error\">Error Couldnt Delete Player From Roster!</span>";
		Closetable();
	}
	else
	{
	Opentable();
	echo "<span class=\"font\">Succefully Removed Member From Clan! <a href=\"?op=Clan_Module\">Continue.</a></span>";
	Closetable();
	}
	}
GraphicAdmin();
include('footer.php');
}
  switch($_GET['func'])
  {
    case "main":
    admin_main();
    break;
    case "settings":
    admin_settings();
    break;
    case "add_member":
    add_member();
    break;
    case "create_game":
    add_game();
	break;
	 case "create_league":
    create_league();
	break;
	case "add_mroster":
	add_mroster();
	break;
	case "delete_game":
	delete_game();
	break;
	case "removeplayer":
	remove_player();
	break;
	case "edit_game":
	edit_game();
	break;
	case "remove_member":
	remove_member();
	break;
    default: 
    admin_main();
    break;
  } 
} else {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<center><b>"._ERROR."</b><br><br>You do not have administration permission for module \"$module_name\"</center>";
	CloseTable();
	include("footer.php");
}
  
