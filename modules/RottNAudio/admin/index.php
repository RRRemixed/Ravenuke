<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
               RottNAudio
   ============================================
   Copyright (c) 2008 RottNResources.com & JeroenWijering.com

   Module Author : RottNKorpse (www.RottNResources.com)
   Flash Author  : Jeroen Wijering (www.JeroenWijering.com)
   Edited for Standard/Ravens Nuke : Ped (ped@clanthemes.com)
************************************************************************/

if (!defined('ADMIN_FILE')) {
    die ("Illegal File Access");
}

$config_sql         = $db->sql_query("SELECT * FROM " . $prefix . "_rottnaudio_config");
$config_fetch       = $db->sql_fetchrow($config_sql);
get_lang('RottNAudio');

global $prefix, $db;

function admin_header() {
    global $admin_file;
    get_lang('RottNAudio');
    OpenTable();
        echo "<center>"
        ."<a href=\"$admin_file.php?op=RottNAudio\">" . _ADMIN_ROTTNAUDIO_HEADER . "</a>"
        ."<br /><br />"
        ."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">"
        ."<tr>"
        ."<td align='center' width='200'><strong>"._ADMIN_HEADTITLE1."</strong></td>"
        ."<td align='center' width='200'><strong>"._ADMIN_HEADTITLE2."</strong></td>"
        ."<td align='center' width='200'><strong>"._ADMIN_HEADTITLE3."</strong></td>"
        ."</tr>"
        ."<tr>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Configuration'>"._ADMIN_GENERAL_LINK1."</a></td>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Add_Track'>"._ADMIN_SONGMNGMT_LINK1."</a></td>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Flashvars&act=universal'>"._ADMIN_FLASHVARS_LINK1."</a></td>"
        ."</tr>"
        ."<tr>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Color_Palette'>"._ADMIN_GENERAL_LINK2."</a></td>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Edit_Tracks'>"._ADMIN_SONGMNGMT_LINK2."</a></td>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Flashvars&act=module'>"._ADMIN_FLASHVARS_LINK2."</a></td>"
        ."</tr>"
        ."<tr>"
        ."<td align='center'><a href='http://rottnresources.com/projects/RottNAudio/faqs.php' target='_blank'>"._ADMIN_GENERAL_LINK3."</a></td>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Delete_Tracks'>"._ADMIN_SONGMNGMT_LINK3."</a></td>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Flashvars&act=block'>"._ADMIN_FLASHVARS_LINK3."</a></td>"
        ."</tr>"
        ."<tr>"
        ."<td align='center'>&nbsp;</td>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Track_Order'>"._ADMIN_SONGMNGMT_LINK4."</a></td>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Flashvars&act=pop_up'>"._ADMIN_FLASHVARS_LINK4."</a></td>"
        ."</tr>"
        ."<tr>"
        ."<td align='center'>&nbsp;</td>"
        ."<td align='center'>&nbsp;</td>"
        ."<td align='center'><a href='admin.php?op=RottNAudio-Flashvars&act=bbcode'>"._ADMIN_FLASHVARS_LINK5."</a></td>"
        ."</tr>"
        ."</table>"
        ."<br /><br />[ "
        ."<a href=\"modules.php?name=RottNAudio\">"._ADMIN_GO_TO_INDEX."</a>&nbsp;|&nbsp;"
        ."<a href=\"$admin_file.php\">"._ADMIN_MAIN_RETURN."&nbsp;"._ADMIN_ADMINISTRATION."</a> ]"
        ."</center>";
    CloseTable();
    echo "<br />";
}

function admin_footer() {
    global $db, $prefix, $admin_file, $config_sql, $config_fetch;
      echo "<table border='0' width='100%'><tr><td align='left'>";
      echo "RottNAudio ".$config_fetch['rottnaudio_version']."<br />&copy; <a href='http://rottnresources.com' target='_blank'>RottNResources.com</a><br />&copy; <a href='http://visuex.com' target='_blank'>Visuex.com</a>";
      echo "</td><td align='right'>";
      echo "Flash Player<br />&copy; <a href='http://www.jeroenwijering.com/' target='_blank'>JeroenWijering.com</a>";
      echo "</td></tr></table>";
}

function theme_integration() {
    global $db, $prefix, $admin_file, $config_sql, $config_fetch;
    $module_name = basename(dirname(dirname(__FILE__)));
    $themes_sql  = $db->sql_query("SELECT theme_name FROM ".$prefix."_themes WHERE active = '1'");
    OpenTable();
      echo "<center>"
          ."<h3>"._ADMIN_THEME_INTEGRATION."</h3>"
          ."<table width='55%'>";
      while ($list = $db->sql_fetchrow($themes_sql)){
      $theme_name = $list['theme_name'];
        if (file_exists("themes/$theme_name/images/rottnaudio.gif")) {
                  $header_image = "1";
        } elseif (file_exists("themes/$theme_name/images/rottnaudio.jpg")) {
                  $header_image = "1";
        } elseif (file_exists("themes/$theme_name/images/rottnaudio.png")) {
                  $header_image = "1";
        } else {
                  $header_image = "0";
        }
        if (file_exists("themes/$theme_name/rottnaudio.php")) {
                  $php_file = "1";
        } else {
                  $php_file = "0";
        }
        if ($header_image == "1" && $php_file == "1") {
                  $compatibility_check = "<font style=\"color:#027F12;\">"._ADMIN_THEME_INTEGRATION_COMPATIBLE."</font>";
        } else {
             if ($header_image == "0") {
                  $header_image_missing = ""._ADMIN_THEME_INTEGRATION_MISSING_IMAGE."<br />";
             }
             if ($php_file == "0") {
                  $php_file_missing = ""._ADMIN_THEME_INTEGRATION_MISSING_FILE."<br />";
             }
                  $compatibility_check  = "<font style=\"color:#A31B1B;\">"._ADMIN_THEME_INTEGRATION_INCOMPATIBLE."</font>";
                  $compatibility_check .= "</td></tr><tr><td colspan='2'>";
                  $compatibility_check .= $php_file_missing;
                  $compatibility_check .= $header_image_missing;
                  $compatibility_check .= "</td></tr>";
        }
        echo "<tr><td class='row1' width='40%'>"
             .$theme_name
             ."</td><td class='row1' width='60%'>"
             .$compatibility_check;
      }
      echo "</table></center>";
    CloseTable();
      echo "<br />";
}

function version_check() {
    global $db, $prefix, $admin_file, $config_sql, $config_fetch;
    $module_name = basename(dirname(dirname(__FILE__)));
    $version_number = file_get_contents("http://rottnresources.com/projects/".$module_name."/version.txt");
    OpenTable();
      echo "<center>";
      echo "<h3>".$module_name." "._ADMIN_VERSION_INFO."</h3>";
      if ($version_number == $config_fetch['rottnaudio_version']) {
           echo ""._ADMIN_VERSION_CHECK_MSG1." <strong>".$version_number."</strong><br /><br />"
               ."<font style=\"color:#027F12;\">"._ADMIN_VERSION_CHECK_MSG2."</font><br /><br />";
      } else {
           $reason_for_update = file_get_contents("http://rottnresources.com/projects/".$module_name."/reason_for_update.txt");
           $should_i_update   = file_get_contents("http://rottnresources.com/projects/".$module_name."/should_i_update.txt");
           $download_link     = file_get_contents("http://rottnresources.com/projects/".$module_name."/download_link.txt");
           echo ""._ADMIN_VERSION_CHECK_MSG1." <strong><font style=\"color:#A31B1B;\">".$version_number."</font></strong><br /><br />"
               ."<font style=\"color:#A31B1B; font-weight:bold;\">"._ADMIN_VERSION_CHECK_MSG3."</font><br /><br /><hr /><br />"
               ."<u>"._ADMIN_VERSION_CHECK_MSG4." ".$version_number."</u><br />"
               .$reason_for_update
               ."<br /><br /><hr /><br />"
               ."<u>"._ADMIN_VERSION_CHECK_MSG5."</u><br />"
               .$should_i_update
               ."<br /><br /><hr /><br />"
               ."<u>"._ADMIN_VERSION_CHECK_MSG6." ".$version_number."</u><br />"
               ."<a href='$download_link' target='_blank'>$download_link</a>"
               ."<br /><br />";
      }
      echo "</center>";
    CloseTable();
}

function Configuration() {
    global $prefix, $db, $admin_file, $config_sql, $config_fetch;
          if ($config_fetch['use_themes'] == "1") {
               $use_themes_yes = "selected";
               $use_themes_no  = "\n";
          } else {
               $use_themes_yes = "\n";
               $use_themes_no  = "selected";
          }
          if ($config_fetch['use_header'] == "1") {
               $use_header_yes = "selected";
               $use_header_no  = "\n";
          } else {
               $use_header_yes = "\n";
               $use_header_no  = "selected";
          }
          if ($config_fetch['use_custom_header'] == "1") {
               $use_custom_header_yes = "selected";
               $use_custom_header_no  = "\n";
          } else {
               $use_custom_header_yes = "\n";
               $use_custom_header_no  = "selected";
          }
          if ($config_fetch['show_module_pop_up'] == "1") {
               $show_module_pop_up_yes = "selected";
               $show_module_pop_up_no  = "\n";
          } else {
               $show_module_pop_up_yes = "\n";
               $show_module_pop_up_no  = "selected";
          }
          if ($config_fetch['show_block_pop_up'] == "1") {
               $show_block_pop_up_yes = "selected";
               $show_block_pop_up_no  = "\n";
          } else {
               $show_block_pop_up_yes = "\n";
               $show_block_pop_up_no  = "selected";
          }
          if ($config_fetch['universal_status_module'] == "1") {
               $module_checked = "checked";
          } else {
               $module_checked = "\n";
          }
          if ($config_fetch['universal_status_block'] == "1") {
               $block_checked = "checked";
          } else {
               $block_checked = "\n";
          }
          if ($config_fetch['universal_status_pop_up'] == "1") {
               $pop_up_checked = "checked";
          } else {
               $pop_up_checked = "\n";
          }
          if ($config_fetch['universal_status_bbcode'] == "1") {
               $bbcode_checked = "checked";
          } else {
               $bbcode_checked = "\n";
          }
            OpenTable();
                echo "<form action='$admin_file.php?op=RottNAudio-Configuration-submit' method='post'><center>"
                ."<input type='hidden' name='op' value='RottNAudio-Configuration-submit'>"
                ."<strong>"._ADMIN_GENERAL_LINK1."</strong><br /><br />\n"
                ."<table border='1' class='bodyline' width='85%'>"
                ."<tr><td class='catHead' colspan='2' align='center'>"
                ."<span style='font-weight:bold;font-size:13px;'>"
                ._ADMIN_CONFIGURATION_TITLE1
                ."</span>"
                ."</td></tr>"
                ."<tr><td class='row1' width='50%'>"
                ._ADMIN_CONFIGURATION_FIELD1
                ."</td><td class='row1' width='50%'>"
                ."<select name='use_themes'>"
                ."<option value='1' ".$use_themes_yes.">"._ADMIN_YES."</option>"
                ."<option value='0' ".$use_themes_no.">"._ADMIN_NO."</option></select>"
                ."</td></tr>"
                ."<tr><td class='row1' width='50%'>"
                ._ADMIN_CONFIGURATION_FIELD2
                ."<br /><br /><span class='gensmall'>"
                ._ADMIN_CONFIGURATION_FIELD2_NOTE
                ."</span></td><td class='row1' width='50%'>"
                ."<table>"
                ."<tr><td class='row1'>"
                .""._ADMIN_CONFIGURATION_PLAYER1."</td><td> : <input type='checkbox' name='universal_status_module' value='1' ".$module_checked.">"
                ."</td></tr><tr><td class='row1'>"
                .""._ADMIN_CONFIGURATION_PLAYER2."</td><td> : <input type='checkbox' name='universal_status_block' value='1' ".$block_checked.">"
                ."</td></tr><tr><td class='row1'>"
                .""._ADMIN_CONFIGURATION_PLAYER3."</td><td> : <input type='checkbox' name='universal_status_pop_up' value='1' ".$pop_up_checked.">"
                ."</td></tr><tr><td class='row1'>"
                .""._ADMIN_CONFIGURATION_PLAYER4."</td><td> : <input type='checkbox' name='universal_status_bbcode' value='1' ".$bbcode_checked.">"
                ."</td></tr></table>"
                ."<tr><td class='catHead' colspan='2' align='center'>"
                ."<span style='font-weight:bold;font-size:13px;'>"
                ._ADMIN_CONFIGURATION_TITLE2
                ."</span>"
                ."</td></tr>"
                ."<tr><td class='row1' width='50%'>"
                ._ADMIN_CONFIGURATION_FIELD3
                ."</td><td class='row1' width='50%'>"
                ."<select name='use_header'>"
                ."<option value='1' ".$use_header_yes.">"._ADMIN_YES."</option>"
                ."<option value='0' ".$use_header_no.">"._ADMIN_NO."</option></select>"
                ."</td></tr>"
                ."<tr><td class='row1' width='50%'>"
                ._ADMIN_CONFIGURATION_FIELD4
                ."<br /><br /><span class='gensmall'>"
                ._ADMIN_CONFIGURATION_FIELD4_NOTE
                ."</span></td><td class='row1' width='50%'>"
                ."<select name='use_custom_header'>"
                ."<option value='1' ".$use_custom_header_yes.">"._ADMIN_YES."</option>"
                ."<option value='0' ".$use_custom_header_no.">"._ADMIN_NO."</option></select>"
                ."</td></tr>"
                ."<tr><td class='row1' width='50%'>"
                ._ADMIN_CONFIGURATION_FIELD5
                ."</td><td class='row1' width='50%'>"
                ."<input type='text' size='40' name='custom_header_url' value='".$config_fetch['custom_header_url']."'>"
                ."</td></tr>"
                ."<tr><td class='row1' width='50%'>"
                ._ADMIN_CONFIGURATION_FIELD6
                ."</td><td class='row1' width='50%'>"
                ."<select name='show_module_pop_up'>"
                ."<option value='1' ".$show_module_pop_up_yes.">"._ADMIN_YES."</option>"
                ."<option value='0' ".$show_module_pop_up_no.">"._ADMIN_NO."</option></select>"
                ."</td></tr>"
                ."<tr><td class='row1' width='50%'>"
                ._ADMIN_CONFIGURATION_MODULE_MSG1
                ."</td><td class='row1'><a href='admin.php?op=modules' target='_self'>"
                ._ADMIN_CONFIGURATION_MODULE_MSG2
                ."</a></td></tr>"
                ."<tr><td class='catHead' colspan='2' align='center'>"
                ."<span style='font-weight:bold;font-size:13px;'>"
                ._ADMIN_CONFIGURATION_TITLE3
                ."</span>"
                ."</td></tr>"
                ."<tr><td class='row1' width='50%'>"
                ._ADMIN_CONFIGURATION_FIELD7
                ."</td><td class='row1' width='50%'>"
                ."<select name='show_block_pop_up'>"
                ."<option value='1' ".$show_block_pop_up_yes.">"._ADMIN_YES."</option>"
                ."<option value='0' ".$show_block_pop_up_no.">"._ADMIN_NO."</option></select>"
                ."</td></tr>"
                ."<tr><td class='row1' width='50%'>"
                ._ADMIN_CONFIGURATION_BLOCK_MSG1
                ."</td><td class='row1'><a href='admin.php?op=blocks' target='_self'>"
                ._ADMIN_CONFIGURATION_BLOCK_MSG2
                ."</a></td></tr>"
                ."<input type='hidden' name='song_order' value='".$config_fetch['song_order']."'>"
                ."<input type='hidden' name='rottnaudio_version' value='".$config_fetch['rottnaudio_version']."'>"
                ."<tr><td class='catBottom' colspan='2' align='center'>"
                ."<input type='submit' value='"._ADMIN_SUBMIT."'>"
                ."</td></tr>"
                ."</table>"
                ."<br />"
                ."</center></form>";
            CloseTable();
}

function Configuration_submit() {
    global $prefix, $db, $admin_file;
            if ($_REQUEST['universal_status_module'] == "1") {
                 $universal_status_module = "1";
            } else {
                 $universal_status_module = "0";
            }
            if ($_REQUEST['universal_status_block'] == "1") {
                 $universal_status_block = "1";
            } else {
                 $universal_status_block = "0";
            }
            if ($_REQUEST['universal_status_pop_up'] == "1") {
                 $universal_status_pop_up = "1";
            } else {
                 $universal_status_pop_up = "0";
            }
            if ($_REQUEST['universal_status_bbcode'] == "1") {
                 $universal_status_bbcode = "1";
            } else {
                 $universal_status_bbcode = "0";
            }
            $sql = "UPDATE ".$prefix."_rottnaudio_config SET `rottnaudio_version` = '".$_REQUEST['rottnaudio_version']."',`song_order` = '".$_REQUEST['song_order']."', `use_themes` = '".$_REQUEST['use_themes']."', `universal_status_module` = '".$universal_status_module."', `universal_status_block` = '".$universal_status_block."', `universal_status_pop_up` = '".$universal_status_pop_up."', `universal_status_bbcode` = '".$universal_status_bbcode."', `use_header` = '".$_REQUEST['use_header']."', `use_custom_header` = '".$_REQUEST['use_custom_header']."', `custom_header_url` = '".$_REQUEST['custom_header_url']."', `show_module_pop_up` = '".$_REQUEST['show_module_pop_up']."', `show_block_pop_up` = '".$_REQUEST['show_block_pop_up']."'";
            $result = $db->sql_query($sql);
            OpenTable();
                echo "<center>";
            if ($result) {
                echo "<strong>"._ADMIN_GENERAL_LINK1."</strong><br /><br />"
                    ._ADMIN_CONFIGURATION_COMPLETE
                    ."<br /><br />";
            } else {
                echo "<strong>"._ADMIN_FAILURE."</strong><br /><br />\n"
                    ._ADMIN_FAILURE_NOTE
                    ."<br /><br />";
            }
                echo "</center>\n";
            CloseTable();
}

function Add_Track() {
    global $prefix, $db, $admin_file;
            OpenTable();
                echo "<form action='$admin_file.php?op=RottNAudio-Add_Track-submit' method='post'><center>"
                ."<strong>" . _ADMIN_HEADTITLE1 . "&nbsp;:&nbsp;" . _ADMIN_SONGMNGMT_LINK1 . "</strong><br /><br />\n"
                ."<div style=\"width:75%;\">" . _ADMIN_ADDSONG_NOTE . "</div><br />"
                ."<table border='1' class='bodyline' width='75%'>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD1
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='song_name' value=''>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD2
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='artist_name' value=''>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD3
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='song_url' value=''>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD4
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='download_url' value=''>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD5
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='album_cover' value=''>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD6
                ."</td><td class='row2'>"
                ."<input type='text' size='5' name='manual_order' value=''>"
                ."</td></tr>"
                ."<tr><td class='catBottom' colspan='2' align='center'>"
                ."<input type='hidden' name='op' value='RottNAudio-Add_Track-submit'>"
                ."<input type='submit' value='" . _ADMIN_SUBMIT . "'>"
                ."</td></tr>"
                ."</table>"
                ."<br />"
                ."</center></form>";
            CloseTable();
}

function Add_Track_submit() {
    global $prefix, $db, $admin_file;
        if (!$_REQUEST['song_name']) {
            $song_name = _ADMIN_ADDSONG_BLANK_FIELD;
        } else {
            $song_name = $_REQUEST['song_name'];
        }
        if (!$_REQUEST['artist_name']) {
            $artist_name = _ADMIN_ADDSONG_BLANK_FIELD;
        } else {
            $artist_name = $_REQUEST['artist_name'];
        }
        if (!$_REQUEST['manual_order']) {
            $manual_order = "0";
        } else {
            $manual_order = $_REQUEST['manual_order'];
        }
            $sql = "INSERT INTO " . $prefix . "_rottnaudio_songs VALUES ('', '".$song_name."', '".$artist_name."', '" . $_REQUEST['song_url'] . "', '" . $_REQUEST['download_url'] . "', '" . $_REQUEST['album_cover'] . "', '".$manual_order."')";
            $res1 = $db->sql_query($sql);
            OpenTable();
            if($res1) {
                echo "<center>\n";
                echo "<strong>" . _ADMIN_SONGADDED . "</strong><br /><br />\n";
                echo "" . _ADMIN_FOLLOWING_SONG . "<br />\n";
                echo "\"<b>".$song_name."</b>\" by <b>".$artist_name."</b><br /><br />\n";
                echo "<a href=\"$admin_file.php?op=RottNAudio\">" . _ADMIN_RETURN . "</a>\n";
                echo "</center>\n";
            } else {
                echo "<center>\n";
                echo "<strong>" . _ADMIN_SONGADDED . "</strong><br /><br />\n";
                echo "Epic failure<br />\n";
                echo "<a href=\"$admin_file.php?op=RottNAudio\">" . _ADMIN_RETURN . "</a>\n";
                echo "</center>\n";
            }
            CloseTable();
}

function Edit_Tracks($mode, $post) {
    global $prefix, $db, $admin_file;
    if(!$mode) $mode = 'main';
    switch($mode) {
        case 'main':
          $order_query = $db->sql_query("SELECT song_order FROM " . $prefix . "_rottnaudio_config");
          $order_row   = $db->sql_fetchrow($order_query);
          $song_order  = $order_row['song_order'];
          $list_songs  = $db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_songs ORDER BY ".$song_order." ASC");
            OpenTable();
                echo "<center>"
                    ."<strong>"._ADMIN_SONGMNGMT_LINK2."</strong><br /><br />"
                    ."<form action='$admin_file.php' method='get'>"
                    ."<select name='song_id'>";
                      while ($list = $db->sql_fetchrow($list_songs)){
                              echo "<option value='".$list['song_id']."'>\"".$list['song_name']."\" by ".$list['artist_name']."</option>";
                      }
                echo "</select>"
                    ."<input type='hidden' name='op' value='RottNAudio-Edit_Tracks' />"
                    ."<input type='hidden' name='act' value='edit' />"
                    ."<input type='submit' value='"._ADMIN_EDIT."' />"
                    ."</form>"
                    ."</center>";
            CloseTable();
        break;
        case 'edit':
            OpenTable();
          $edit_song = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_songs WHERE song_id ='".$post['song_id']."'"));
                echo "<form action='$admin_file.php' method='post'><center>"
                ."<strong>" . _ADMIN_HEADTITLE1 . "&nbsp;:&nbsp;" . _ADMIN_SONGMNGMT_LINK2 . "</strong><br /><br />\n"
                ."<div style=\"width:75%;\">" . _ADMIN_ADDSONG_NOTE . "</div><br />"
                ."<table border='1' class='bodyline' width='75%'>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD1
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='song_name' value='".$edit_song['song_name']."'>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD2
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='artist_name' value='".$edit_song['artist_name']."'>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD3
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='song_url' value='".$edit_song['song_url']."'>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD4
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='download_url' value='".$edit_song['download_url']."'>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD5
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='album_cover' value='".$edit_song['album_cover']."'>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_ADDSONG_FIELD6
                ."</td><td class='row2'>"
                ."<input type='text' size='5' name='manual_order' value='".$edit_song['manual_order']."'>"
                ."</td></tr>"
                ."<tr><td class='catBottom' colspan='2' align='center'>"
                ."<input type='hidden' name='song_id' value='".$edit_song['song_id']."'>"
                ."<input type='hidden' name='op' value='RottNAudio-Edit_Tracks-submit'>"
                ."<input type='submit' value='" . _ADMIN_SUBMIT . "'>"
                ."</td></tr>"
                ."</table>"
                ."<br />"
                ."</center></form>";
            CloseTable();
        break;
    }
    return true;
}

function Edit_Tracks_submit() {
    global $prefix, $db, $admin_file;
            $sql = "UPDATE ".$prefix."_rottnaudio_songs SET `song_id` = '".$_REQUEST['song_id']."',`song_name` = '".$_REQUEST['song_name']."',`artist_name` = '".$_REQUEST['artist_name']."',`song_url` = '".$_REQUEST['song_url']."',`download_url` = '".$_REQUEST['download_url']."',`album_cover` = '".$_REQUEST['album_cover']."',`manual_order` = '".$_REQUEST['manual_order']."' WHERE `song_id` = ".$_REQUEST['song_id']." LIMIT 1 ;";
            $res1 = $db->sql_query($sql);
            OpenTable();
            if($res1) {
                echo "<center>\n";
                echo "<strong>"._ADMIN_EDIT_UPDATED."</strong><br /><br />\n";
                echo "" . _ADMIN_EDIT_FOLLOWING_SONG . "<br />\n";
                echo "\"<b>" . $_REQUEST['song_name'] . "</b>\" by <b>" . $_REQUEST['artist_name'] . "</b><br /><br />\n";
                echo "<a href=\"$admin_file.php?op=RottNAudio\">" . _ADMIN_RETURN . "</a>\n";
                echo "</center>\n";
            } else {
                echo "<center>\n";
                echo "<strong>"._ADMIN_FAILURE."</strong><br /><br />\n";
                echo ""._ADMIN_FAILURE_NOTE."<br />\n";
                echo "</center>\n";
            }
            CloseTable();
}

function Delete_Tracks($mode, $post) {
    global $prefix, $db, $admin_file;
    if(!$mode) $mode = 'main';
    switch($mode) {
        case 'main':
          $order_query = $db->sql_query("SELECT song_order FROM " . $prefix . "_rottnaudio_config");
          $order_row   = $db->sql_fetchrow($order_query);
          $song_order  = $order_row['song_order'];
          $list_songs  = $db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_songs ORDER BY ".$song_order." ASC");
            OpenTable();
                echo "<center>"
                    ."<strong>"._ADMIN_SONGMNGMT_LINK3."</strong><br /><br />"
                    ."<form action='$admin_file.php' method='get'>"
                    ."<select name='song_id'>";
                      while ($list = $db->sql_fetchrow($list_songs)){
                              echo "<option value='".$list['song_id']."'>\"".$list['song_name']."\" by ".$list['artist_name']."</option>";
                      }
                echo "</select>"
                    ."<input type='hidden' name='op' value='RottNAudio-Delete_Tracks' />"
                    ."<input type='hidden' name='act' value='verify' />"
                    ."<input type='submit' value='"._ADMIN_DELETE."' />"
                    ."</form>"
                    ."</center>";
            CloseTable();
        break;
        case 'verify':
          $delete_song = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_songs WHERE song_id ='".$post['song_id']."'"));
            OpenTable();
                echo "<center>"
                    ."<strong>"._ADMIN_SONGMNGMT_LINK3."</strong><br /><br />"
                    .""._ADMIN_DELETE_VERIFY1."<strong>".$delete_song['song_name']."</strong>"._ADMIN_DELETE_VERIFY2." <strong>".$delete_song['artist_name']."</strong> "._ADMIN_DELETE_VERIFY3."<br /><br />"
                ."<table border='1' class='bodyline' width='100'>"
                ."<tr><td class='row1' align=\"center\">"
                ."<a href=\"admin.php?op=RottNAudio-Delete_Tracks&song_id=".$delete_song['song_id']."&act=delete\" style=\"font-weight:bold;\">"._ADMIN_DELETE_YES."</a>"
                ."</td><td class='row2' align=\"center\">"
                ."<a href=\"admin.php?op=RottNAudio-Delete_Tracks\" style=\"font-weight:bold;\">"._ADMIN_DELETE_NO."</a>"
                ."</td></tr></table><br /><br />"
                    ."</center>";
            CloseTable();
        break;
        case 'delete':
            $song_deleted = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_rottnaudio_songs WHERE song_id ='".$post['song_id']."'"));
            $sql = "DELETE FROM `".$prefix."_rottnaudio_songs` WHERE song_id = ".$post['song_id']." LIMIT 1";
            $res1 = $db->sql_query($sql);
            OpenTable();
            if ($res1) {
                echo "<center>"
                    ."<strong>"._ADMIN_SONGMNGMT_LINK3."</strong><br /><br />"
                    .""._ADMIN_DELETE_COMPLETE1."<strong>".$song_deleted['song_name']."</strong>"._ADMIN_DELETE_COMPLETE2." <strong>".$song_deleted['artist_name']."</strong> "._ADMIN_DELETE_COMPLETE3."<br /><br />"
                    ."</center>";
            } else {
                echo "<center>\n";
                echo "<strong>"._ADMIN_FAILURE."</strong><br /><br />\n";
                echo ""._ADMIN_FAILURE_NOTE."<br />\n";
                echo "</center>\n";
            }
            CloseTable();
        break;
    }
    return true;
}

function Track_Order($mode, $post) {
    global $prefix, $db, $admin_file;
    if(!$mode) $mode = 'main';
    switch($mode) {
        case 'main':
          $order_query = $db->sql_query("SELECT song_order FROM " . $prefix . "_rottnaudio_config");
          $order_row   = $db->sql_fetchrow($order_query);
          $song_order  = $order_row['song_order'];
          if ($song_order == "artist_name") {
              $song_order_display = _ADMIN_ORDER_OPTION1;
          } elseif ($song_order == "song_name") {
              $song_order_display = _ADMIN_ORDER_OPTION2;
          } elseif ($song_order == "song_id") {
              $song_order_display = _ADMIN_ORDER_OPTION3;
          } else {
              $song_order_display = _ADMIN_ORDER_OPTION4;
          }
            OpenTable();
                echo "<center><form action='$admin_file.php' method='get'>"
                ."<strong>" . _ADMIN_HEADTITLE2 . "&nbsp;:&nbsp;" . _ADMIN_SONGMNGMT_LINK3 . "</strong><br /><br />\n"
                ."<table border='1' class='bodyline' width='350'>";
                echo "<tr><td class='row1'>"
                .""._ADMIN_ORDER_CURRENT."\n"
                ."</td><td class='row1'>"
                ."".$song_order_display."\n"
                ."</td></tr>";
                echo "<tr><td class='row1'>"
                .""._ADMIN_ORDER_CHANGE."\n"
                ."</td><td class='row1'>"
                ."<select name=song_order>"
                ."<option value='_' selected>" . _ADMIN_ORDER_SELECTED . "</option>"
                ."<option value='artist_name'>" . _ADMIN_ORDER_OPTION1 . "</option>"
                ."<option value='song_name'>" . _ADMIN_ORDER_OPTION2 . "</option>"
                ."<option value='song_id'>" . _ADMIN_ORDER_OPTION3 . "</option>"
                ."<option value='manual_order'>" . _ADMIN_ORDER_OPTION4 . "</option></select>"
                ."</td></tr>";
                echo "<tr><td class='catBottom' colspan='3' align='center'>"
                ."<input type='hidden' name='op' value='RottNAudio-Track_Order'>"
                ."<input type='hidden' name='act' value='order_submit'>"
                ."<input type='submit' value='" . _ADMIN_SUBMIT . "'>"
                ."</td></tr>"
                ."</table>"
                ."<br /><br />"
                ."</form>"
                ."<strong>"._ADMIN_ORDER_OPTION4."</strong><br />\n"
                .""._ADMIN_ORDER_EDIT_MANUAL_MSG1." \""._ADMIN_ORDER_OPTION4."\" "._ADMIN_ORDER_EDIT_MANUAL_MSG2."<br /><br />\n"
                ."<form action='$admin_file.php' method='get'>"
                ."<input type='hidden' name='op' value='RottNAudio-Track_Order'>"
                ."<input type='hidden' name='act' value='manual'>"
                ."<input type='submit' value='"._ADMIN_ORDER_EDIT_MANUAL."'>"
                ."</form></center>";
            CloseTable();
        break;
        case 'order_submit':
            $song_order = $post['song_order'];
            $sql = "UPDATE `".$prefix."_rottnaudio_config` SET `song_order` = '".$song_order."' LIMIT 1 ;";
            $db->sql_query($sql);
            if ($song_order == "artist_name") {
                $song_order_display = _ADMIN_ORDER_OPTION1;
            } elseif ($song_order == "song_name") {
                $song_order_display = _ADMIN_ORDER_OPTION2;
            } elseif ($song_order == "song_id") {
                $song_order_display = _ADMIN_ORDER_OPTION3;
            } else {
                $song_order_display = _ADMIN_ORDER_OPTION4;
            }
            OpenTable();
            if ($song_order == "manual_order") {
                echo "<center>\n";
                echo "<strong>" . _ADMIN_ORDER_UPDATED . "</strong><br /><br />\n";
                echo ""._ADMIN_ORDER_NEW_IS_MANUAL.".<br /><br>\n";
                echo "<a href=\"$admin_file.php?op=RottNAudio\">" . _ADMIN_RETURN . "</a>\n";
                echo "</center>\n";
            } else {
                echo "<center>\n";
                echo "<strong>" . _ADMIN_ORDER_UPDATED . "</strong><br /><br />\n";
                echo ""._ADMIN_ORDER_NEW." \"".$song_order_display."\".<br /><br>\n";
                echo "<a href=\"$admin_file.php?op=RottNAudio\">" . _ADMIN_RETURN . "</a>\n";
                echo "</center>\n";
            }
            CloseTable();
        break;
        case 'manual':
          $order_query = $db->sql_query("SELECT song_order FROM " . $prefix . "_rottnaudio_config");
          $order_row   = $db->sql_fetchrow($order_query);
          $song_order  = $order_row['song_order'];
          $edit_query  = $db->sql_query("SELECT * FROM " . $prefix . "_rottnaudio_songs ORDER BY ".$song_order." ASC");
            OpenTable();
                echo "<center>"
                ."<strong>" . _ADMIN_ORDER_EDIT_MANUAL . "</strong><br />\n"
                .""._ADMIN_ORDER_EDIT_MANUAL_MSG1." \""._ADMIN_ORDER_OPTION4."\" "._ADMIN_ORDER_EDIT_MANUAL_MSG2."<br /><br />\n"
                ."<table border='1' class='bodyline' width='75%'>";
                while($editrow = $db->sql_fetchrow($edit_query)) {
                echo"<form action='$admin_file.php' method='get'>"
                ."<input type='hidden' name='op' value='RottNAudio-Track_Order'>"
                ."<input type='hidden' name='act' value='manual_submit'>"
                ."<tr><td class='row1' width='50%'>"
                ."".$editrow['song_name']."\n"
                ."<input type='hidden' name='song_id' value='".$editrow['song_id']."'>"
                ."</td><td class='row1' width='50%'>"
                ."".$editrow['artist_name']."\n"
                ."</td><td class='row2' width='20'>"
                ."<input type='text' size='5' name='manual_order' value='".$editrow['manual_order']."'>"
                ."</td><td class='row2' width='20'>"
                ."<input type='submit' value='" . _ADMIN_UPDATE . "'>"
                ."</td></tr></form>";
                }
                echo "</table>"
                ."<br />"
                ."</center>";
            CloseTable();
        break;
        case 'manual_submit':
            $db->sql_query("UPDATE ".$prefix."_rottnaudio_songs SET `manual_order` = " . $post['manual_order'] . " WHERE " . $prefix . "_rottnaudio_songs.`song_id` = " . $post['song_id'] . " LIMIT 1");
            OpenTable();
                echo "<center>\n";
                echo "<strong>" . _ADMIN_ORDER_UPDATED . "</strong><br /><br /><hr style=\"width:50%;\"><br />\n";
          $order_query = $db->sql_query("SELECT song_order FROM " . $prefix . "_rottnaudio_config");
          $order_row   = $db->sql_fetchrow($order_query);
          $song_order  = $order_row['song_order'];
          $edit_query  = $db->sql_query("SELECT * FROM " . $prefix . "_rottnaudio_songs ORDER BY ".$song_order." ASC");
                echo "<center>"
                ."<strong>" . _ADMIN_ORDER_EDIT_MANUAL . "</strong><br />\n"
                .""._ADMIN_ORDER_EDIT_MANUAL_MSG1." \""._ADMIN_ORDER_OPTION4."\" "._ADMIN_ORDER_EDIT_MANUAL_MSG2."<br /><br />\n"
                ."<table border='1' class='bodyline' width='75%'>";
                while($editrow = $db->sql_fetchrow($edit_query)) {
                echo"<form action='$admin_file.php' method='get'>"
                ."<input type='hidden' name='op' value='RottNAudio-Track_Order'>"
                ."<input type='hidden' name='act' value='manual_submit'>"
                ."<tr><td class='row1' width='50%'>"
                ."".$editrow['song_name']."\n"
                ."<input type='hidden' name='song_id' value='".$editrow['song_id']."'>"
                ."</td><td class='row1' width='50%'>"
                ."".$editrow['artist_name']."\n"
                ."</td><td class='row2' width='20'>"
                ."<input type='text' size='5' name='manual_order' value='".$editrow['manual_order']."'>"
                ."</td><td class='row2' width='20'>"
                ."<input type='submit' value='" . _ADMIN_UPDATE . "'>"
                ."</td></tr></form>";
                }
                echo "</table>"
                ."<br />";
                echo "</center>\n";
            CloseTable();
        break;
    }
    return true;
}

function Flashvars_Form() {
    global $prefix, $db;
          $player_name  = $_GET['act'];
          $sql          = $db->sql_query("SELECT * FROM " . $prefix . "_rottnaudio_settings WHERE player_name = '".$player_name."'");
          $fetch        = $db->sql_fetchrow($sql);
          $config_sql   = $db->sql_query("SELECT * FROM " . $prefix . "_rottnaudio_config");
          $config_fetch = $db->sql_fetchrow($config_sql);

       if ($player_name == "universal") {
            $use_themes_on_message  = "<font size=\"2\"><strong>"._ADMIN_FLASHVARS_IMPORTANT_MSG."</strong></font>";
            $use_themes_on_message .= "<table border='0' width='75%'><tr><td>";
            $use_themes_on_message .= _ADMIN_FLASHVARS_UFV_MSG;
            $use_themes_on_message .= "</td></tr></table><br />";
            $back_color             = "<input type='text' size='40' name='back_color' value='".$fetch['back_color']."'>";
            $front_color            = "<input type='text' size='40' name='front_color' value='".$fetch['front_color']."'>";
            $light_color            = "<input type='text' size='40' name='light_color' value='".$fetch['light_color']."'>";
            $screen_color           = "<input type='text' size='40' name='screen_color' value='".$fetch['screen_color']."'>";
            $border_color           = "<input type='text' size='40' name='border_color' value='".$fetch['border_color']."'>";
       } else {
          if ($config_fetch['use_themes'] == "1") {
            $use_themes_on_message  = "<font size=\"2\"><strong>"._ADMIN_FLASHVARS_IMPORTANT_MSG."</strong></font>";
            $use_themes_on_message .= "<table border='0' width='75%'><tr><td>";
            $use_themes_on_message .= _ADMIN_FLASHVARS_USE_THEMES;
            $use_themes_on_message .= "</td></tr></table><br />";
            $read_only              = "style='color:#BFBFBF;background-color:#930006;background-image:none;' readonly";
            $back_color             = "<input type='text' size='40' name='back_color_ignored' value='"._ADMIN_FLASHVARS_USE_THEMES_IGNORED."' ".$read_only.">";
            $back_color            .= "<input type='hidden' name='back_color' value='".$fetch['back_color']."'>";
            $front_color            = "<input type='text' size='40' name='front_color_ignored' value='"._ADMIN_FLASHVARS_USE_THEMES_IGNORED."' ".$read_only.">";
            $front_color           .= "<input type='hidden' name='front_color' value='".$fetch['front_color']."'>";
            $light_color            = "<input type='text' size='40' name='light_color_ignored' value='"._ADMIN_FLASHVARS_USE_THEMES_IGNORED."' ".$read_only.">";
            $light_color           .= "<input type='hidden' name='light_color' value='".$fetch['light_color']."'>";
            $screen_color           = "<input type='text' size='40' name='screen_color_ignored' value='"._ADMIN_FLASHVARS_USE_THEMES_IGNORED."' ".$read_only.">";
            $screen_color          .= "<input type='hidden' name='screen_color' value='".$fetch['screen_color']."'>";
            $border_color           = "<input type='text' size='40' name='border_color_ignored' value='"._ADMIN_FLASHVARS_USE_THEMES_IGNORED."' ".$read_only.">";
            $border_color          .= "<input type='hidden' name='border_color' value='".$fetch['border_color']."'>";
          } else {
            $use_themes_on_message  = "\n";
            $back_color             = "<input type='text' size='40' name='back_color' value='".$fetch['back_color']."'>";
            $front_color            = "<input type='text' size='40' name='front_color' value='".$fetch['front_color']."'>";
            $light_color            = "<input type='text' size='40' name='light_color' value='".$fetch['light_color']."'>";
            $screen_color           = "<input type='text' size='40' name='screen_color' value='".$fetch['screen_color']."'>";
            $border_color           = "<input type='text' size='40' name='border_color' value='".$fetch['border_color']."'>";
          }
       }
            echo $use_themes_on_message;
            echo "<table border='1' class='bodyline' width='80%'>"
                ."<tr><td class='row1' width='40%'>"
                ._ADMIN_FLASHVARS_FIELD1
                ."</td><td class='row2' width='60%'>"
                ."<input type='text' size='40' name='width' value='".$fetch['width']."'>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD2
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='height' value='".$fetch['height']."'>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD3
                ."</td><td class='row2'>"
                .$back_color
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD4
                ."</td><td class='row2'>"
                .$front_color
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD5
                ."</td><td class='row2'>"
                .$light_color
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD6
                ."</td><td class='row2'>"
                .$screen_color
                ."</td></tr>";
          if ($fetch['overstretch'] == "true") {
               $one_is_selected   = "selected";
               $two_is_selected   = "\n";
               $three_is_selected = "\n";
               $four_is_selected  = "\n";
          } elseif ($fetch['overstretch'] == "false") {
               $one_is_selected   = "\n";
               $two_is_selected   = "selected";
               $three_is_selected = "\n";
               $four_is_selected  = "\n";
          } elseif ($fetch['overstretch'] == "fit") {
               $one_is_selected   = "\n";
               $two_is_selected   = "\n";
               $three_is_selected = "selected";
               $four_is_selected  = "\n";
          } else {
               $one_is_selected   = "\n";
               $two_is_selected   = "\n";
               $three_is_selected = "\n";
               $four_is_selected  = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD7
                ."</td><td class='row2'>"
                ."<select name='overstretch'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."<option value='fit' ".$three_is_selected.">" . _ADMIN_FLASHVARS_FIELD7_FIT . "</option>"
                ."<option value='none' ".$four_is_selected.">" . _ADMIN_FLASHVARS_FIELD7_NONE . "</option>"
                ."</select>"
                ."</td></tr>";
          if ($fetch['shoq_eq'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD8
                ."</td><td class='row2'>"
                ."<select name='show_eq'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
          if ($fetch['show_icons'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD9
                ."</td><td class='row2'>"
                ."<select name='show_icons'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
          if ($fetch['show_stop'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD10
                ."</td><td class='row2'>"
                ."<select name='show_stop'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
          if ($fetch['show_digits'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD11
                ."</td><td class='row2'>"
                ."<select name='show_digits'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
          if ($fetch['show_download'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD12
                ."</td><td class='row2'>"
                ."<select name='show_download'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
          if ($fetch['auto_scroll'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD13
                ."</td><td class='row2'>"
                ."<select name='auto_scroll'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD14
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='display_width' value='".$fetch['display_width']."'>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD15
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='display_height' value='".$fetch['display_height']."'>"
                ."</td></tr>";
          if ($fetch['thumbs_in_playlist'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD16
                ."</td><td class='row2'>"
                ."<select name='thumbs_in_playlist'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
          if ($fetch['auto_start'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD17
                ."</td><td class='row2'>"
                ."<select name='auto_start'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
          if ($fetch['repeat'] == "true") {
               $one_is_selected   = "selected";
               $two_is_selected   = "\n";
               $three_is_selected = "\n";
          } elseif ($fetch['repeat'] == "false") {
               $one_is_selected   = "\n";
               $two_is_selected   = "selected";
               $three_is_selected = "\n";
          } else {
               $one_is_selected   = "\n";
               $two_is_selected   = "\n";
               $three_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD18
                ."</td><td class='row2'>"
                ."<select name='repeat'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."<option value='list' ".$three_is_selected.">" . _ADMIN_FLASHVARS_FIELD18_LIST . "</option>"
                ."</select>"
                ."</td></tr>";
          if ($fetch['shuffle'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD19
                ."</td><td class='row2'>"
                ."<select name='shuffle'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD20
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='volume' value='".$fetch['volume']."'>"
                ."</td></tr>";
          if ($fetch['link_target'] == "_self") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD21
                ."</td><td class='row2'>"
                ."<select name='link_target'>"
                ."<option value='_self' ".$one_is_selected.">" . _ADMIN_FLASHVARS_FIELD21_SELF . "</option>"
                ."<option value='_blank' ".$two_is_selected.">" . _ADMIN_FLASHVARS_FIELD21_BLANK . "</option>"
                ."</select>"
                ."</td></tr>";


            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD22
                ."</td><td class='row2'>"
                ."<input type='text' size='40' name='border_size' value='".$fetch['border_size']."'>"
                ."</td></tr>"
                ."<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD23
                ."</td><td class='row2'>"
                .$border_color
                ."</td></tr>";
          if ($fetch['align_right'] == "true") {
               $one_is_selected = "selected";
               $two_is_selected = "\n";
          } else {
               $one_is_selected = "\n";
               $two_is_selected = "selected";
          }
            echo "<tr><td class='row1'>"
                ._ADMIN_FLASHVARS_FIELD24
                ."</td><td class='row2'>"
                ."<select name='align_right'>"
                ."<option value='true' ".$one_is_selected.">" . _ADMIN_YES . "</option>"
                ."<option value='false' ".$two_is_selected.">" . _ADMIN_NO . "</option>"
                ."</select>"
                ."</td></tr>";
            echo "<tr><td class='catBottom' colspan='2' align='center'>"
                ."<input type='submit' value='"._ADMIN_SUBMIT."'>"
                ."</td></tr>";
}

function Flashvars($mode, $post) {
    global $prefix, $db, $admin_file;
    if(!$mode) $mode = 'universal';
    switch($mode) {
        case 'universal':
            OpenTable();
            echo "<form action='$admin_file.php' method='get'><center>"
                ."<input type='hidden' name='op' value='RottNAudio-Flashvars'>"
                ."<input type='hidden' name='act' value='submit_universal'>"
                ."<strong>"._ADMIN_HEADTITLE3."&nbsp;:&nbsp;"._ADMIN_FLASHVARS_LINK1."</strong><br /><br />\n";
            Flashvars_Form();
            echo "</table>"
                ."<br />"
                ."</center></form>";
            CloseTable();
        break;
        case 'submit_universal':
            $sql = "UPDATE ".$prefix."_rottnaudio_settings SET `width` = '".$post['width']."', `height` = '".$post['height']."', `back_color` = '".$post['back_color']."', `front_color` = '".$post['front_color']."', `light_color` = '".$post['light_color']."', `screen_color` = '".$post['screen_color']."', `overstretch` = '".$post['overstretch']."', `show_eq` = '".$post['show_eq']."', `show_icons` = '".$post['show_icons']."', `show_stop` = '".$post['show_stop']."', `show_digits` = '".$post['show_digits']."', `show_download` = '".$post['show_download']."', `auto_scroll` = '".$post['auto_scroll']."', `display_width` = '".$post['display_width']."', `display_height` = '".$post['display_height']."', `thumbs_in_playlist` = '".$post['thumbs_in_playlist']."', `auto_start` = '".$post['auto_start']."', `repeat` = '".$post['repeat']."', `shuffle` = '".$post['shuffle']."', `volume` = '".$post['volume']."', `link_target` = '".$post['link_target']."', `border_size` = '".$post['border_size']."', `border_color` = '".$post['border_color']."', `align_right` = '".$post['align_right']."' WHERE player_name = 'universal'";
            $result = $db->sql_query($sql);
            OpenTable();
            if ($result) {
                echo "<center>"
                    ."<strong>"._ADMIN_HEADTITLE3."&nbsp;:&nbsp;"._ADMIN_FLASHVARS_LINK1."</strong><br /><br />"
                    ._ADMIN_FLASHVARS_COMPLETE
                    ."<br /><br /></center>";
            } else {
                echo "<center>\n";
                echo "<strong>"._ADMIN_FAILURE."</strong><br /><br />\n";
                echo ""._ADMIN_FAILURE_NOTE."<br />\n";
                echo "</center>\n";
            }
            CloseTable();
        break;
        case 'module':
            OpenTable();
            echo "<form action='$admin_file.php' method='get'><center>"
                ."<input type='hidden' name='op' value='RottNAudio-Flashvars'>"
                ."<input type='hidden' name='act' value='submit_module'>"
                ."<strong>"._ADMIN_FLASHVARS_LINK2." "._ADMIN_HEADTITLE3."</strong><br /><br />\n";
            Flashvars_Form();
            echo "</table>"
                ."<br />"
                ."</center></form>";
            CloseTable();
        break;
        case 'submit_module':
            $sql = "UPDATE ".$prefix."_rottnaudio_settings SET `width` = '".$post['width']."', `height` = '".$post['height']."', `back_color` = '".$post['back_color']."', `front_color` = '".$post['front_color']."', `light_color` = '".$post['light_color']."', `screen_color` = '".$post['screen_color']."', `overstretch` = '".$post['overstretch']."', `show_eq` = '".$post['show_eq']."', `show_icons` = '".$post['show_icons']."', `show_stop` = '".$post['show_stop']."', `show_digits` = '".$post['show_digits']."', `show_download` = '".$post['show_download']."', `auto_scroll` = '".$post['auto_scroll']."', `display_width` = '".$post['display_width']."', `display_height` = '".$post['display_height']."', `thumbs_in_playlist` = '".$post['thumbs_in_playlist']."', `auto_start` = '".$post['auto_start']."', `repeat` = '".$post['repeat']."', `shuffle` = '".$post['shuffle']."', `volume` = '".$post['volume']."', `link_target` = '".$post['link_target']."', `border_size` = '".$post['border_size']."', `border_color` = '".$post['border_color']."', `align_right` = '".$post['align_right']."' WHERE player_name = 'module'";
            $result = $db->sql_query($sql);
            OpenTable();
            if ($result) {
                echo "<center>"
                    ."<strong>"._ADMIN_FLASHVARS_LINK2." "._ADMIN_HEADTITLE3."</strong><br /><br />"
                    ._ADMIN_FLASHVARS_COMPLETE
                    ."<br /><br /></center>";
            } else {
                echo "<center>\n";
                echo "<strong>"._ADMIN_FAILURE."</strong><br /><br />\n";
                echo ""._ADMIN_FAILURE_NOTE."<br />\n";
                echo "</center>\n";
            }
            CloseTable();
        break;
        case 'block':
            OpenTable();
            echo "<form action='$admin_file.php' method='get'><center>"
                ."<input type='hidden' name='op' value='RottNAudio-Flashvars'>"
                ."<input type='hidden' name='act' value='submit_block'>"
                ."<strong>"._ADMIN_HEADTITLE3."&nbsp;:&nbsp;"._ADMIN_FLASHVARS_LINK3."</strong><br /><br />\n";
            Flashvars_Form();
            echo "</table>"
                ."<br />"
                ."</center></form>";
            CloseTable();
        break;
        case 'submit_block':
            $sql = "UPDATE ".$prefix."_rottnaudio_settings SET `width` = '".$post['width']."', `height` = '".$post['height']."', `back_color` = '".$post['back_color']."', `front_color` = '".$post['front_color']."', `light_color` = '".$post['light_color']."', `screen_color` = '".$post['screen_color']."', `overstretch` = '".$post['overstretch']."', `show_eq` = '".$post['show_eq']."', `show_icons` = '".$post['show_icons']."', `show_stop` = '".$post['show_stop']."', `show_digits` = '".$post['show_digits']."', `show_download` = '".$post['show_download']."', `auto_scroll` = '".$post['auto_scroll']."', `display_width` = '".$post['display_width']."', `display_height` = '".$post['display_height']."', `thumbs_in_playlist` = '".$post['thumbs_in_playlist']."', `auto_start` = '".$post['auto_start']."', `repeat` = '".$post['repeat']."', `shuffle` = '".$post['shuffle']."', `volume` = '".$post['volume']."', `link_target` = '".$post['link_target']."', `border_size` = '".$post['border_size']."', `border_color` = '".$post['border_color']."', `align_right` = '".$post['align_right']."' WHERE player_name = 'block'";
            $result = $db->sql_query($sql);
            OpenTable();
            if ($result) {
                echo "<center>"
                    ."<strong>"._ADMIN_FLASHVARS_LINK3." "._ADMIN_HEADTITLE3."</strong><br /><br />"
                    ._ADMIN_FLASHVARS_COMPLETE
                    ."<br /><br /></center>";
            } else {
                echo "<center>\n";
                echo "<strong>"._ADMIN_FAILURE."</strong><br /><br />\n";
                echo ""._ADMIN_FAILURE_NOTE."<br />\n";
                echo "</center>\n";
            }
            CloseTable();
        break;
        case 'pop_up':
            OpenTable();
            echo "<form action='$admin_file.php' method='get'><center>"
                ."<input type='hidden' name='op' value='RottNAudio-Flashvars'>"
                ."<input type='hidden' name='act' value='submit_pop_up'>"
                ."<strong>"._ADMIN_HEADTITLE3."&nbsp;:&nbsp;"._ADMIN_FLASHVARS_LINK4."</strong><br /><br />\n";
            Flashvars_Form();
            echo "</table>"
                ."<br />"
                ."</center></form>";
            CloseTable();
        break;
        case 'submit_pop_up':
            $sql = "UPDATE ".$prefix."_rottnaudio_settings SET `width` = '".$post['width']."', `height` = '".$post['height']."', `back_color` = '".$post['back_color']."', `front_color` = '".$post['front_color']."', `light_color` = '".$post['light_color']."', `screen_color` = '".$post['screen_color']."', `overstretch` = '".$post['overstretch']."', `show_eq` = '".$post['show_eq']."', `show_icons` = '".$post['show_icons']."', `show_stop` = '".$post['show_stop']."', `show_digits` = '".$post['show_digits']."', `show_download` = '".$post['show_download']."', `auto_scroll` = '".$post['auto_scroll']."', `display_width` = '".$post['display_width']."', `display_height` = '".$post['display_height']."', `thumbs_in_playlist` = '".$post['thumbs_in_playlist']."', `auto_start` = '".$post['auto_start']."', `repeat` = '".$post['repeat']."', `shuffle` = '".$post['shuffle']."', `volume` = '".$post['volume']."', `link_target` = '".$post['link_target']."', `border_size` = '".$post['border_size']."', `border_color` = '".$post['border_color']."', `align_right` = '".$post['align_right']."' WHERE player_name = 'pop_up'";
            $result = $db->sql_query($sql);
            OpenTable();
            if ($result) {
                echo "<center>"
                    ."<strong>"._ADMIN_FLASHVARS_LINK4." "._ADMIN_HEADTITLE3."</strong><br /><br />"
                    ._ADMIN_FLASHVARS_COMPLETE
                    ."<br /><br /></center>";
            } else {
                echo "<center>\n";
                echo "<strong>"._ADMIN_FAILURE."</strong><br /><br />\n";
                echo ""._ADMIN_FAILURE_NOTE."<br />\n";
                echo "</center>\n";
            }
            CloseTable();
        break;
        case 'bbcode':
            OpenTable();
            echo "<form action='$admin_file.php' method='get'><center>"
                ."<input type='hidden' name='op' value='RottNAudio-Flashvars'>"
                ."<input type='hidden' name='act' value='submit_bbcode'>"
                ."<strong>"._ADMIN_FLASHVARS_LINK5." "._ADMIN_HEADTITLE3."</strong><br /><br />\n";
            Flashvars_Form();
            echo "</table>"
                ."<br />"
                ."</center></form>";
            CloseTable();
        break;
        case 'submit_bbcode':
            $sql = "UPDATE ".$prefix."_rottnaudio_settings SET `width` = '".$post['width']."', `height` = '".$post['height']."', `back_color` = '".$post['back_color']."', `front_color` = '".$post['front_color']."', `light_color` = '".$post['light_color']."', `screen_color` = '".$post['screen_color']."', `overstretch` = '".$post['overstretch']."', `show_eq` = '".$post['show_eq']."', `show_icons` = '".$post['show_icons']."', `show_stop` = '".$post['show_stop']."', `show_digits` = '".$post['show_digits']."', `show_download` = '".$post['show_download']."', `auto_scroll` = '".$post['auto_scroll']."', `display_width` = '".$post['display_width']."', `display_height` = '".$post['display_height']."', `thumbs_in_playlist` = '".$post['thumbs_in_playlist']."', `auto_start` = '".$post['auto_start']."', `repeat` = '".$post['repeat']."', `shuffle` = '".$post['shuffle']."', `volume` = '".$post['volume']."', `link_target` = '".$post['link_target']."', `border_size` = '".$post['border_size']."', `border_color` = '".$post['border_color']."', `align_right` = '".$post['align_right']."' WHERE player_name = 'bbcode'";
            $result = $db->sql_query($sql);
            OpenTable();
            if ($result) {
                echo "<center>"
                    ."<strong>"._ADMIN_FLASHVARS_LINK5." "._ADMIN_HEADTITLE3."</strong><br /><br />"
                    ._ADMIN_FLASHVARS_COMPLETE
                    ."<br /><br /></center>";
            } else {
                echo "<center>\n";
                echo "<strong>"._ADMIN_FAILURE."</strong><br /><br />\n";
                echo ""._ADMIN_FAILURE_NOTE."<br />\n";
                echo "</center>\n";
            }
            CloseTable();
        break;
    }
    return true;
}


function Color_Palette() {
    global $admin_file;
    OpenTable();
    echo "<center>";
    echo "<iframe src=\"http://rottnresources.com/projects/Color_Palette/index.html\" style=\"width:100%;height:575px;border: 1px solid #404040;\" scrolling=\"no\"></iframe>";
    echo "</center>";
    CloseTable();
}


if ($admin) {
    include_once(NUKE_BASE_DIR.'header.php');
  if (file_exists('modules/RottNAudio/install.php') || file_exists('modules/RottNAudio/install/install.css')) {
    OpenTable();
    echo "<br /><table width='75%' align='center'><tr><td>";
    echo _INSTALL_FILES_FOUND;
    echo "</td></tr></table><br />";
    CloseTable();
    admin_footer();
  } elseif (file_exists('modules/RottNAudio/upgrade.php') || file_exists('modules/RottNAudio/upgrade/upgrade.css')) {
    OpenTable();
    echo "<br /><table width='75%' align='center'><tr><td>";
    echo _UPGRADE_FILES_FOUND;
    echo "</td></tr></table><br />";
    CloseTable();
    admin_footer();
  } else {
    switch ($op) {
        case 'RottNAudio-Configuration':
            admin_header();
            Configuration($_GET['act'], $_GET);
            admin_footer();
        break;
        case 'RottNAudio-Configuration-submit':
            admin_header();
            Configuration_submit();
            admin_footer();
        break;
        case 'RottNAudio-Add_Track':
            admin_header();
            Add_Track();
            admin_footer();
        break;
        case 'RottNAudio-Add_Track-submit':
            admin_header();
            Add_Track_submit();
            admin_footer();
        break;
        case 'RottNAudio-Edit_Tracks':
            admin_header();
            Edit_Tracks($_GET['act'], $_GET);
            admin_footer();
        break;
        case 'RottNAudio-Edit_Tracks-submit':
            admin_header();
            Edit_Tracks_submit();
            admin_footer();
        break;
        case 'RottNAudio-Delete_Tracks':
            admin_header();
            Delete_Tracks($_GET['act'], $_GET);
            admin_footer();
        break;
        case 'RottNAudio-Track_Order':
            admin_header();
            Track_Order($_GET['act'], $_GET);
            admin_footer();
        break;
        case 'RottNAudio-Flashvars':
            admin_header();
            Flashvars($_GET['act'], $_GET);
            admin_footer();
        break;
        case 'RottNAudio-Color_Palette':
            admin_header();
            Color_Palette();
            admin_footer();
        break;
        default:
            admin_header();
            theme_integration();
            version_check();
            admin_footer();
        break;
    }
  }
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    echo "Access Denied";
}

?>