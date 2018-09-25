<?php
/********************************************************/
/* Forum Messages V1.0.0                                */
/* By: Telli (telli@codezwiz.com)                       */
/* http://www.codezwiz.com                              */
/* Copyright © 2002-2004 by Codezwiz.com                */
/********************************************************/
if (eregi("fmessagebox.php",$_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}
function fmessage_box() {
    global $bgcolor1, $bgcolor2, $user, $admin, $cookie, $textcolor2, $prefix, $multilingual, $currentlang, $db;
    if ($multilingual == 1) {
		$querylang = "AND (mlanguage='$currentlang' OR mlanguage='')";
    } else {
		$querylang = "";
    }
    $result = $db->sql_query("SELECT mid, title, content, date, expire, view FROM ".$prefix."_forum_message WHERE active='1' $querylang");
    if ($numrows = $db->sql_numrows($result) == 0) {
		return;
    } else {
	while ($row = $db->sql_fetchrow($result)) {
	    $mid = intval($row['mid']);
	    $title = $row['title'];
	    $content = $row['content'];
	    $mdate = $row['date'];
	    $expire = intval($row['expire']);
	    $view = intval($row['view']);
	if ($title != "" && $content != "") {
	    if ($expire == 0) {
		$remain = _UNLIMITED;
	    } else {
		$etime = (($mdate+$expire)-time())/3600;
		$etime = (int)$etime;
		if ($etime < 1) {
		    $remain = _EXPIRELESSHOUR;
		} else {
		    $remain = ""._EXPIREIN." $etime "._HOURS."";
		}
	    }
	    if ($view == 5 AND paid()) {
            OpenTable();
            echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
		    	."<font class=\"content\">$content</font>";
			if (is_admin($admin)) {
		    	echo "<br><br><center><font class=\"content\">[ "._MVIEWSUBUSERS." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
			}
    		CloseTable();
			echo "<br>";
	    } elseif ($view == 4 AND is_admin($admin)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
		    ."<font class=\"content\">$content</font>"
		    ."<br><br><center><font class=\"content\">[ "._MVIEWADMIN." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		CloseTable();
		echo "<br>";
	    } elseif ($view == 3 AND is_user($user) || is_admin($admin)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
		    ."<font class=\"content\">$content</font>";
		if (is_admin($admin)) {
		    echo "<br><br><center><font class=\"content\">[ "._MVIEWUSERS." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		}
    		CloseTable();
		echo "<br>";
	    } elseif ($view == 2 AND !is_user($user) || is_admin($admin)) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
		    ."<font class=\"content\">$content</font>";
		if (is_admin($admin)) {
		    echo "<br><br><center><font class=\"content\">[ "._MVIEWANON." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		}
		CloseTable();
		echo "<br>";
	    } elseif ($view == 1) {
                OpenTable();
                echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
		    ."<font class=\"content\">$content</font>";
		if (is_admin($admin)) {
		    echo "<br><br><center><font class=\"content\">[ "._MVIEWALL." - $remain - <a href=\"admin.php?op=editfmsg&mid=$mid\">"._EDIT."</a> ]</font></center>";
		}
		CloseTable();
		echo "<br>";
	    }
	    if ($expire != 0) {
	    	$past = time()-$expire;
		if ($mdate < $past) {
		    $db->sql_query("UPDATE ".$prefix."_forum_message SET active='0' WHERE mid='$mid'");
		}
          }
	  }
	}
    }
  }
fmessage_box();
?>
