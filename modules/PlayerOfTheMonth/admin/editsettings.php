<?php

/************************************************************************/
/*                     www.Clan-Themes.co.uk                            */
/*                  ===========================                         */
/*                    Making Clans Look Good!                           */
/************************************************************************/
/*                Player Of The Month Module V1.0                       */
/*                 Copyright (c) 2007 by Scorpion                       */
/*            Downloaded from http://www.Clan-Themes.co.uk.             */
/*                                                                      */
/*         The Power of the Nuke! - Without the Radiation!              */
/*        =================================================             */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/

/************************************************************************/
/*                                                                      */
/* PLEASE DO NOT TOUCH THE CODE BELOW, UNLESS YOU KNOW WHAT YOUR DOING  */
/*                                                                      */
/************************************************************************/

if (!eregi("admin.php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }

require_once("mainfile.php");
$module_name="PlayerOfTheMonth";
get_lang($module_name);
include("header.php");
include("potm_amenu.php");
include("modules/PlayerOfTheMonth/ct_config.php");

$index = $potm_index; 

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM nuke_potm_settings"));
$potm_announcement = $row['potm_announcement'];
$potm_awards = $row['potm_awards'];
$potm_clantag = $row['potm_clantag'];
$potm_img_url = $row['potm_img_url'];
$potm_photo = $row['potm_photo'];

OpenTable();
echo "
<center><b>"._POTM_EDITSETTINGS."</b></center><br><br>
<table align=center width=75%>
  <tr> 
    <hr width=75%>
    <td width=46%><b>"._POTM_CLANTAG." :</b></td>
    <form action=admin.php?op=UpdatePOTMTags&cmd=update_potm_tags method=post>
      <td align=left width=18%> 
        <input type=text size=8 name=potm_clantag value=$potm_clantag>
      <td width=18%></td>
      <td width=18%> 
        <input type=Submit value="._POTM_UPDATE.">
      </td>
    </form>
  </tr>
  <tr> 
    <td width=46%><b>"._POTM_RIGHTBLOCKS." :</b></td>
      <td align=left colspan=3>"._POTM_RB_DISCRIPTION."</td>
  </tr>
</table>
<br>
<table align=center width=75%>
  <tr>
    <hr width=75%> 
    <td align=center colspan=2><b>"._POTM_CHANGEANNOUCEMENT."</b> 
      <form action=admin.php?op=UpdatePOTMAnnouncement&cmd=update_potm_announcement method=post>
        <textarea cols=50 rows=15 name=potm_announcement>$potm_announcement</textarea><br>
        <input type=Submit value="._POTM_UPDATE.">
      </form>
    </td>
    <td align=center colspan=2><b>"._POTM_CHANGEAWARDDISCRIPTION."</b> 
      <form action=admin.php?op=UpdatePOTMAwards&cmd=update_potm_awards method=post>
        <textarea cols=50 rows=15 name=potm_awards>$potm_awards</textarea><br>
        <input type=Submit value="._POTM_UPDATE.">
      </form>
    </td>
  </tr>
  </table>
<br>
<table align=center width=75%>
  <tr> 
    <td align=left width=46%><b>"._POTM_PHDIR." :</b></td>
    <td> 
      <form action=admin.php?op=UpdatePOTMImgUrl&cmd=update_potm_img_url method=post>
        <input type=text size=35 name=potm_img_url value=$potm_img_url>
        <td width=18%></td>
      <td width=18%> 
        <input type=Submit value="._POTM_UPDATE.">
      </form>
    </td>
  </tr>
  <td align=left width=46%><b>"._POTM_PHOTO." :</b><br></td> 
  <td><b>"._POTM_IMGPATH." : $potm_img_url</b><br>
    <form action=admin.php?op=UpdatePOTMPhoto&cmd=update_potm_photo enctype='multipart/form-data' method=post>
      <input name=the_file type=file size=35 >
       <!-- <input type=text name=the_file maxlength=255 size=35 value=$potm_photo> -->
  <td width=18%></td>
      <td width=18%> 
        <input type=Submit value="._POTM_UPDATE.">
    </form>
   </td>
</table>
";
CloseTable();		

//If there is a photo already, print it. 
if($potm_photo) {
OpenTable(); 
echo "
  <table align=center width=75%>
   <tr> 
    <td align=center colspan=2><b>"._POTM_CURRPHOT."</b><br><br>
      <img src=$potm_img_url$potm_photo align=center border=2></td>
     </tr>
  </table>
";
CloseTable();
}
include("modules/PlayerOfTheMonth/copyright/ct_by.php");
include("footer.php");
?>
