<?php

/************************************************************************/
/* Club Membership System for PHP-Nuke                                  */
/* ===================================                                  */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* THIS PROGRAM CAN'T BE REDISTRIBUTED UNDER ANY CIRCUNSTANCE. This is  */
/* a commercial product made with effort, please respect the rules. You */
/* can use this module in your commercial or non-commercial website as  */
/* as you wish. It's a nice system to manage your own private and paid  */
/* area for your site with easy. This module has been tested for years  */
/* on phpnuke.org and it's still in use. Hope you enjoy using it!       */
/*                                                                      */
/* This program is distributed AS IS, without any warranty and without  */
/* technical support. Please read the readme.txt file for more info     */
/* about Club Membership module for PHP-Nuke.                           */
/************************************************************************/

if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

function catmenu() {
	global $db, $module_name, $prefix, $sitename;
	$sql = $db->sql_query("SELECT cid, title FROM ".$prefix."_club_categories WHERE pid='0'");
	echo "<center><font class='title'>$sitename "._CLUBCATEGORIES."</font></center><br><br>";
	echo "<table border='0' align='center' width='100%'><tr>";
	$a = 0;
	while ($row = $db->sql_fetchrow($sql)) {
		$a++;
		echo "<td align='left' valign='top'>";
		echo "<table border='0' align='center' width='100%'><tr><td>";
		echo "<img src='modules/$module_name/images/dot_blue.gif' width='9' height='9' alt='' title='' border='0'>&nbsp;<font class='title'>$row[title]</font></a>";
		echo "</td></tr><tr><td>";
		$sql2 = $db->sql_query("SELECT cid, title FROM ".$prefix."_club_categories WHERE pid='$row[cid]'");
		$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_club_categories WHERE pid='$row[cid]'"));
		if ($numrows == 0) {
			echo "<i>"._CATEGORYEMPTY."</i>";
		}
		$b = 0;
		while ($row2 = $db->sql_fetchrow($sql2)) {
			$b++;
			if ($b > 1) {
				echo ", ";
			}
			echo "<a href='modules.php?name=$module_name&op=members&cid=$row2[cid]' title='$row2[title]'>$row2[title]</a>";
		}
		echo "</td></tr></table>";
		echo "</td><td width='5%'>&nbsp;</td>";
		if ($a == 2) {
			echo "</tr><td colspan='2'><br></td></tr><tr>";
			$a = 0;
		}
	}
	echo "</table>";
}

function get($fid) {
    global $prefix, $db, $module_name, $sitename;
    $fid = intval($fid);
    if (isset($fid)) {
    	$num = $db->sql_numrows($db->sql_query("SELECT fid FROM ".$prefix."_club_files WHERE fid='$fid'"));
    	if ($num == 1) {
			if (!isset($_SERVER['PHP_AUTH_USER'])) {
				header('WWW-Authenticate: Basic realm="Club"');
			    header('HTTP/1.0 401 Unauthorized');
			    echo _USELOGIN;
			    exit;
			} else {
			  	$username = $_SERVER['PHP_AUTH_USER'];
			  	$password = md5($_SERVER['PHP_AUTH_PW']);
			  	$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_club_members WHERE nickname='$username' AND password='$password'"));
			  	if ($num == 1) {
		    		$db->sql_query("UPDATE ".$prefix."_club_files SET hits=hits+1 WHERE fid='$fid'");
		    		$row = $db->sql_fetchrow($db->sql_query("select filename from ".$prefix."_club_files where fid='$fid'"));
					Header("Location: modules/$module_name/files/$row[filename]");
					exit;
			  	} else {
			    	header('WWW-Authenticate: Basic realm="Club"');
			    	header('HTTP/1.0 401 Unauthorized');
			    	include("header.php");
			    	title("$sitename Club");
			    	OpenTable();
					echo "<center><b>"._CLUBERROR."</b><br><br>"._PASSWORDINCORRECT."<br><br>"._GOBACK."</center>";
					CloseTable();
					include("footer.php");
					die();
				}
			}
    	} else {
			include("header.php");
			title("$sitename Club");
			OpenTable();
			echo "<center><b>"._CLUBERROR."</b><br><br>"._FILENOTEXIST."<br><br>"._GOBACK."</center>";
			CloseTable();
			include("footer.php");
			die();
    	}
    } else {
		include("header.php");
		title("$sitename Club");
		OpenTable();
		echo "<center><b>"._CLUBERROR."</b><br><br>"._FILENOTEXIST."<br><br>"._GOBACK."</center>";
		CloseTable();
		include("footer.php");
		die();
    }
}

function CoolSize($size) {
    if ($size == 0 OR $size == "") {
	$mysize = "N/A";
    } else {
	$mb = 1024*1024;
	if ( $size > $mb ) {
    	    $mysize = sprintf ("%01.2f",$size/$mb) . " MB";
	} elseif ( $size >= 1024 ) {
    	    $mysize = sprintf ("%01.2f",$size/1024) . " Kb";
	} else {
    	    $mysize = $size . " bytes";
	}
    }
    return $mysize;
}

function refresh_users() {
    global $prefix, $db, $adminmail, $sitename, $nukeurl;
    $today = getdate();
    $day = $today[mday];
    if ($day < 10){
        $day = "0$day";
    }
    $month = $today[mon];
    if ($month < 10){
        $month = "0$month";
    }
    $year = $today[year];
    $today = "$year-$month-$day 00:00:00";
    $row = $db->sql_fetchrow($db->sql_query("SELECT date FROM ".$prefix."_club_refresh"));
    $adate = $row['date'];
    $adate = explode(" ", $adate);
    $date = explode("-", $adate[0]);
    if (($date[0] <= $year) AND ($date[1] != $month) || ($date[2] != $day)) {
		$db->sql_query("UPDATE ".$prefix."_club_refresh SET date='$today'");
		$result = $db->sql_query("SELECT mid, uname, email, expire FROM ".$prefix."_club_members");
		while($row = $db->sql_fetchrow($result)) {
			$mid = $row[mid];
			$uname = $row[uname];
			$email = $row[email];
			$expire = $row[expire];
		    $expire = explode(" ", $expire);
		    $thedate = explode("-", $expire[0]);
		    if (($thedate[0] <= $year) AND (($thedate[1] <= $month AND $thedate[2] <= $day) OR ($thedate[1] < $month) OR ($thedate[0] < $year))) {
				$db->sql_query("DELETE FROM ".$prefix."_club_members WHERE mid='$mid'");
				$email = "$uname <$email>";
				$subject = "$sitename "._MEMBERSHIPEXPIRED."";
				$content = ""._DEARUSER.":\n\n"._EXPIREDMSG1."\n\n"._EXPIREDMSG2." $nukeurl/modules.php?name=$module_name\n\n"._EXPIREDMSG3."\n\n"._THANKSSUPPORT."\n\n$sitename "._TEAM."\n$nukeurl";
				$from = $adminmail;
				mail($email, $subject, $content, "From: $from\nX-Mailer: PHP/" . phpversion());
		    }
		}
    }
}

function clublogo() {
    global $module_name, $sitename;
    refresh_users();
    title("$sitename Club");
}

function members_admin() {
    global $admin, $prefix, $db, $bgcolor2, $bgcolor1, $sitename;
    if (is_admin($admin)) {
	include("header.php");
	clublogo();
	title(""._USERSADMIN."");
	OpenTable();
	echo "<center><b>"._CLUBMEMBERS."</b></center><br><br>"
	    ."<table border=\"1\" align=\"center\" width=\"100%\">"
	    ."<tr><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._USERNAME."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._NICKNAME."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._EMAIL."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._EXPIRATION."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._FUNCTIONS."</b></td></tr>";
	$result = $db->sql_query("SELECT mid, uname, email, nickname, expire FROM ".$prefix."_club_members ORDER BY uname ASC");
	while ($row = $db->sql_fetchrow($result)) {
		$mid = $row[mid];
		$uname = $row[uname];
		$email = $row[email];
		$nickname = $row[nickname];
		$expire = $row[expire];
	    $expire = explode(" ", $expire);
	    echo "<tr><td align=\"center\">$uname</td><td align=\"center\">$nickname</td><td align=\"center\"><a href=\"mailto:$email\">$email</a></td><td align=\"center\" nowrap>$expire[0]</td><td align=\"center\" nowrap>&nbsp;<a href=\"modules.php?name=Club&amp;op=edit_user&amp;mid=$mid\"><img src=\"images/edit.gif\" border=\"0\" alt=\""._EDIT."\" title=\""._EDIT."\"></a>   <a href=\"modules.php?name=Club&amp;op=delete&amp;mid=$mid\"><img src=\"images/delete.gif\" border=\"0\" alt=\""._DELETE."\" title=\""._DELETE."\"></a>&nbsp;</td></tr>";
	}
	echo "</table>";
	CloseTable();
	admin_menu();
	include("footer.php");
    }
}

function admin_menu() {
    global $prefix, $db, $admin, $module_name;
    if (is_admin($admin)) {
		$result = $db->sql_query("SELECT date FROM ".$prefix."_club_refresh");
		$row = $db->sql_fetchrow($result);
		$date = $row[date];
		$date = explode(" ", $date);
		echo "<br>";
		OpenTable();
		$total_users = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_club_members"));
		echo "<center><b>"._CLUBADMIN."</b><br><br>"
	    	."[ <a href=\"modules.php?name=$module_name\">"._HOME."</a> | <a href='modules.php?name=$module_name&op=club_config'>Config</a> | <a href=\"modules.php?name=$module_name&amp;op=admin_news\">"._WHATSNEW."</a> | <a href=\"modules.php?name=$module_name&amp;op=add_user\">"._ADDUSER."</a> | <a href=\"modules.php?name=Club&amp;op=members_admin\">"._USERSLIST."</a> | <a href=\"modules.php?name=$module_name&amp;op=update_db\">"._UPDATEDB."</a> ]<br><br>"
	    	."[ <a href='modules.php?name=$module_name&op=add_file'>"._ADDFILE."</a> | <a href='modules.php?name=$module_name&op=add_main_category'>"._ADDMAINCATEGORY."</a> | <a href='modules.php?name=$module_name&op=add_category'>"._ADDSUBCATEGORY."</a> | <a href='modules.php?name=$module_name&op=edit_category'>"._EDITCATEGORY."</a> | <a href='modules.php?name=$module_name&op=delete_category'>"._DELETECATEGORY."</a> ]<br><br>"
		    .""._DBLASTUPDATE." $date[0]<br>"
		    .""._THEREARE." <b>$total_users</b> "._REGUSERS."</center>";
		CloseTable();
    }
}

function add_user() {
    global $prefix, $db, $admin, $module_name, $sitename;
    if (is_admin($admin)) {
    	$row = $db->sql_fetchrow($db->sql_query("SELECT type FROM ".$prefix."_club_config WHERE cid='1'"));
		$cons = "bcdfghjklmnpqrstvwxyz";
		$vocs = "aeiou";
		for ($x=0; $x < 6; $x++) {
			mt_srand ((double) microtime() * 1000000);
			$con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
			$voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
		}
		mt_srand((double)microtime()*1000000);
		$num1 = mt_rand(0, 9);
		$num2 = mt_rand(0, 9);
		$makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];
		include("header.php");
		clublogo();
		title(""._USERSADMIN."");
		OpenTable();
		echo "<center>"._CREATENEWUSER."</center><br><br>"
		    ."<table border=\"0\"><tr><td>"
		    ."<form method=\"post\" action=\"modules.php?name=Club\">"
		    ."<b>"._USERREALNAME."</b></td><td><input type=\"text\" name=\"uname\" size=\"50\" maxlength=\"255\"></td></tr><tr><td>"
		    ."<b>"._USEREMAIL."</b></td><td><input type=\"text\" name=\"email\" size=\"50\" maxlength=\"255\"></td></tr><tr><td>"
		    ."<b>"._NICKNAME.":</b></td><td><input type=\"text\" name=\"nickname\" size=\"26\" maxlength=\"25\"></td></tr><tr><td>"
		    ."<b>"._PASSWORD.":</b></td><td><input type=\"text\" name=\"password\" size=\"9\" maxlength=\"8\" value=\"$makepass\"></td></tr><tr><td colspan=\"2\">";
		$today = getdate();
		$tday = $today[mday];
		if ($tday < 10){
	    	$tday = "0$tday";
		}
		$tmonth = $today[month];
		$ttmon = $today[mon];
		$tyear = $today[year];
		$thour = $today[hours];
		if ($thour < 10){
		    $thour = "0$thour";
		}
		$tmin = $today[minutes];
		if ($tmin < 10){
		    $tmin = "0$tmin";
		}
		$tsec = $today[seconds];
		if ($tsec < 10){
		    $tsec = "0$tsec";
		}
		$date = getdate();
		$year = $date[year];
		$date = "$tmonth $tday, $tyear ($tday/$ttmon/$year) @ $thour:$tmin:$tsec";
		echo "<br><br><b>"._EXPIRATIONDATE."</b><br><br>"
		    .""._NOWIS.": $date<br><br>";
		$xday = 1;
		echo "<b>"._EXPIRESON.":</b> "._DAY.": <select name=\"day\">";
		if ($row[type] == "monthly") {
			if ($tday == 30 || $tday == 31) {
			    $a = 1;
			    $tday = 1;
			} else {
			    $a = 0;
			    $tday++;
			}
		}
		while ($xday <= 31) {
	    	if ($xday == $tday) {
				$sel = "selected";
		    } else {
				$sel = "";
		    }
		    echo "<option name=\"day\" $sel>$xday</option>";
		    $xday++;
		}
		echo "</select>";
		$month = 1;
		echo " "._MONTH.": <select name=\"month\">";
		if ($row[type] == "monthly") {
			if ($ttmon == 12) {
			    $ttmon = 1;
			    if ($a == 1) {
				$ttmon = 2;
			    }
			} else {
			    if ($tday == 1) {
				$ttmon = $ttmon+2;
			    } else {
				$ttmon++;
			    }
			}
		}
		while ($month <= 12) {
		    if ($month == $ttmon) {
				$sel = "selected";
		    } else {
				$sel = "";
		    }
		    echo "<option name=\"month\" $sel>$month</option>";
	    	$month++;
		}
		echo "</select>";
		$date = getdate();
		$year = $date[year];
		echo " "._YEAR.": <select name=\"year\">";
		if ($row[type] == "monthly") {
			if ($ttmon == 13 OR ($ttmon == 1 AND $a == 1)) {
				echo "<option value=\"$year\">$year</option>";
				$year++;
				echo "<option value=\"$year\" selected>$year</option>";
			} else {
				echo "<option value=\"$year\" selected>$year</option>";
			}
		} else {
			echo "<option value=\"$year\">$year</option>";
			$year++;
			echo "<option value=\"$year\" selected>$year</option>";
		}

		for ($i=0; $i<9; $i++) {
			$year++;
			echo "<option value=\"$year\">$year</option>";
		}
		echo "</select>"
		    ."</td></tr><tr><td colspan=\"2\"><br><br>"
		    ."<input type=\"hidden\" name=\"op\" value=\"create_user\">"
		    ."<input type=\"submit\" value=\""._CREATEUSER."\">"
		    ."</form></td></tr></table>";
		CloseTable();
		admin_menu();
		include("footer.php");
    }
}

function admin_news() {
    global $prefix, $db, $admin, $module_name, $sitename;
    if (is_admin($admin)) {
		$result = $db->sql_query("SELECT content FROM ".$prefix."_club_news");
		$row = $db->sql_fetchrow($result);
		$content = $row[content];
		include("header.php");
		clublogo();
		title(""._WHATSNEWADMIN."");
		OpenTable();
		echo "<center>"._EDITNEWS."</center><br><br>"
		    ."<b>"._WHATSNEWCONTENT.":</b><br><font class=\"tiny\"><i>"._BLANKFORNONE."</i></font><br><br>"
		    ."<form action=\"modules.php?name=$module_name\" method=\"post\">"
		    ."<textarea cols=\"70\" rows=\"20\" name=\"content\">$content</textarea><br><br>"
		    ."<input type=\"hidden\" name=\"op\" value=\"admin_news_add\">"
		    ."<input type=\"submit\" value=\""._SAVECHANGES."\">"
		    ."</form>";
		CloseTable();
		admin_menu();
		include("footer.php");
    }
}

function club_config() {
    global $prefix, $db, $admin, $module_name, $sitename;
    if (is_admin($admin)) {
		$result = $db->sql_query("SELECT * FROM ".$prefix."_club_config");
		$row = $db->sql_fetchrow($result);
		$content = $row[content];
		include("header.php");
		clublogo();
		title(""._CLUBCONFIG."");
		OpenTable();
		if ($row[type] = "annual") {
			$sel1 = "selected";
			$sel2 = "";
		} else {
			$sel1 = "";
			$sel2 = "selected";
		}
		echo "<center>"._CLUBCONFIGEDIT."</center><br><br>"
		    ."<b>"._HOMETEXT.":</b><br><i>"._HOMETEXTINFO."</i><br><br>"
		    ."<form action=\"modules.php?name=$module_name\" method=\"post\">"
		    ."<textarea cols=\"70\" rows=\"20\" name=\"content\">$content</textarea><br><br>"
		    ."<b>"._MEMBERSHIPTYPE.":</b> "
		    ."<select name='type'>"
		    ."<option value='annual' $sel1>"._ANNUAL."</option>"
		    ."<option value='monthly' $sel2>"._MONTHLY."</option>"
		    ."</select><br><br>"
		    ."<input type=\"hidden\" name=\"op\" value=\"club_config_save\">"
		    ."<input type=\"submit\" value=\""._SAVECHANGES."\">"
		    ."</form>";
		CloseTable();
		admin_menu();
		include("footer.php");
    }
}

function club_config_save($content, $type) {
    global $prefix, $db, $admin, $module_name;
    if (is_admin($admin)) {
		$db->sql_query("UPDATE ".$prefix."_club_config SET content='$content', type='$type' WHERE cid='1'");
		Header("Location: modules.php?name=$module_name");
    }
}

function create_user($uname, $email, $nickname, $password, $day, $month, $year) {
    global $prefix, $db, $admin, $module_name, $adminmail, $sitename;
	if (is_admin($admin)) {
	    $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_club_members WHERE nickname='$nickname'"));
	    if ($numrows != 0) {
			include("header.php");
			OpenTable();
			title(""._USERERROR."");
			echo "<center>"._USEREXISTS."<br><br>"
			    .""._GOBACK."</center>";
			CloseTable();
			include("footer.php");
			die();
	    } else {
			$expiration = "$year-$month-$day 00:00:00";
			$passwd = md5($password);
			$db->sql_query("INSERT INTO ".$prefix."_club_members VALUES (NULL, '$uname', '$email', '$nickname', '$passwd', '$expiration')");
			if ($month == 1) {
			    $the_month = _JANUARY;
			} elseif ($month == 2) {
			    $the_month = _FEBRUARY;
			} elseif ($month == 3) {
			    $the_month = _MARCH;
			} elseif ($month == 4) {
			    $the_month = _APRIL;
			} elseif ($month == 5) {
			    $the_month = _MAY;
			} elseif ($month == 6) {
			    $the_month = _JUNE;
			} elseif ($month == 7) {
			    $the_month = _JULY;
			} elseif ($month == 8) {
			    $the_month = _AUGUST;
			} elseif ($month == 9) {
			    $the_month = _SEPTEMBER;
			} elseif ($month == 10) {
			    $the_month = _OCTOBER;
			} elseif ($month == 11) {
			    $the_month = _NOVEMBER;
			} elseif ($month == 12) {
			    $the_month = _DECEMBER;	
			}	
			$from = "$sitename <$adminmail>";
			$subject = "$sitename: "._CLUBWELCOME."";
			$content = ""._HELLO." $uname!\n\n"._WELCOMEMSG1."\n"._WELCOMEMSG2."\n\n"._WELCOMEMSG3."\n\n"._NICKNAME.": $nickname\n"._PASSWORD.": $password\n\n"._SYSTEMCASE."\n\n"._MEMBERSHIPVALID." $the_month $day, $year\n\n"._TOACCESSCLUB." $nukeurl/modules.php?name=$module_name\n\n"._LOGINVALID."\n\n"._THANKS."";
			mail($email, $subject, $content, "From: $from\nX-Mailer: PHP/" . phpversion());
			Header("Location: modules.php?name=$module_name");
	    }
    }
}

function admin_news_add($content) {
    global $prefix, $db, $admin, $module_name;
    if (is_admin($admin)) {
		$db->sql_query("UPDATE ".$prefix."_club_news SET content='$content' WHERE nid='1'");
		Header("Location: modules.php?name=$module_name");
    }
}

function main_page() {
    global $prefix, $db, $sitename, $admin, $module_name;
	include("modules/$module_name/clubconfig.php");
    include("header.php");
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_club_config WHERE cid='1'"));
    clublogo();
    OpenTable();
    echo "$row[content]";
    CloseTable();
    echo "<br>";
    OpenTable();
    if ($buy_link == "") {
    	if (is_admin($admin)) {
    		$buy_link = "<BR><BR><blink><font color='Red'><b>W A R N I N G ! ! !<BR><BR>YOU DON'T HAVE THE BUY NOW BUTTON SET!!!<BR>EDIT FILE clubconfig.php AND SET YOUR BUY LINK!!!</b></font></blink><BR><BR><BR>";
    	}
    }
    echo "<center><b>$sitename "._MEMBERSAREA."</b><br><br>"
	."<a href=\"modules.php?name=$module_name&amp;op=members\"><h1>"._ENTER."</h1></a>"
	."<br>"
	."<i>"._ANYONEBROWSE."</i><br><br>"
	."<center>"._CLICKTOORDER."<br><br>"
	."$buy_link</center>";
    CloseTable();
    $result = $db->sql_query("SELECT content FROM ".$prefix."_club_news");
    $row = $db->sql_fetchrow($result);
    $content = $row[content];
    if ($content != "") {
		echo "<br>";
		OpenTable();
		echo "<center><b>"._WHATSNEWONTHECLUB."</b></center><br><br>"
		    ."$content";
		CloseTable();
    }
    admin_menu();
    include("footer.php");
}

function delete($ok=0, $mid) {
    global $prefix, $db, $admin;
    if (is_admin($admin)) {
		if ($ok == 1) {
		    $db->sql_query("DELETE FROM ".$prefix."_club_members WHERE mid='$mid'");
		    Header("Location: modules.php?name=Club&op=members_admin");
		} elseif ($ok == 0) {
		    include("header.php");
		    $result = $db->sql_query("SELECT uname, nickname FROM ".$prefix."_club_members WHERE mid='$mid'");
		    $row = $db->sql_fetchrow($result);
		    $uname = $row[uname];
		    $nickname = $row[nickname];
		    clublogo();
		    title(""._USERSADMIN."");
		    OpenTable();
		    echo "<center><b>"._DELETEUSER."</b><br><br>"
				.""._AREYOUSUREDELUSER." $uname ($nickname) ?<br><br>"
				."[ <a href=\"modules.php?name=Club&amp;op=delete&amp;ok=1&amp;mid=$mid\">"._YES."</a> | <a href=\"modules.php?name=Club&amp;op=members_admin\">"._NO."</a> ]"
				."</center>";
		    CloseTable();
		    admin_menu();
		    include("footer.php");
		}
    }
}

function edit_user($mid) {
    global $prefix, $db, $admin;
    if (is_admin($admin)) {
	    $result = $db->sql_query("SELECT uname, email, nickname, expire FROM ".$prefix."_club_members WHERE mid='$mid'");
	    $row = $db->sql_fetchrow($result);
	    $uname = $row[uname];
	    $email = $row[email];
	    $nickname = $row[nickname];
	    $expire = $row[expire];
	    $expire = explode(" ", $expire);
	    $exp = explode("-", $expire[0]);
	    $oday = $exp[2];
	    $omonth = $exp[1];
	    $oyear = $exp[0];
		$cons = "bcdfghjklmnpqrstvwxyz";
		$vocs = "aeiou";
		for ($x=0; $x < 6; $x++) {
			mt_srand ((double) microtime() * 1000000);
			$con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
			$voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
		}
		mt_srand((double)microtime()*1000000);
		$num1 = mt_rand(0, 9);
		$num2 = mt_rand(0, 9);
		$makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];
	    include("header.php");
	    clublogo();
	    OpenTable();
	    echo "<center><b>"._EDITUSER."</b><br>"
		."<i>$uname ($nickname)</i><br><br>"
		."<table border=\"0\"><tr><td>"
		."<form method=\"post\" action=\"modules.php?name=Club\">"
		."<b>"._USERREALNAME.":</b></td><td><input type=\"text\" name=\"uname\" size=\"50\" maxlength=\"255\" value=\"$uname\"></td></tr><tr><td>"
		."<b>"._USEREMAIL.":</b></td><td><input type=\"text\" name=\"email\" size=\"50\" maxlength=\"255\" value=\"$email\"></td></tr><tr><td>"
		."<b>"._NICKNAME.":</b></td><td><input type=\"text\" name=\"nickname\" size=\"26\" maxlength=\"25\" value=\"$nickname\"></td></tr><tr><td>"
		."<b>"._NEWPASSWORD.":</b></td><td><input type=\"text\" name=\"password\" size=\"9\" maxlength=\"8\" value=\"$makepass\"></td></tr><tr><td>"
		."<b>"._CHANGEPASSWORD."</b></td><td><input type=\"radio\" name=\"chng_pass\" value=\"1\"> "._YES." "
		."<input type=\"radio\" name=\"chng_pass\" value=\"0\" checked> "._NO."</td></tr><tr><td colspan=\"2\">";
	    $today = getdate();
	    $tday = $today[mday];
	    if ($tday < 10){
	        $tday = "0$tday";
	    }
	    $tmonth = $today[month];
	    $ttmon = $today[mon];
	    $tyear = $today[year];
	    $thour = $today[hours];
	    if ($thour < 10){
	        $thour = "0$thour";
	    }
	    $tmin = $today[minutes];
	    if ($tmin < 10){
	        $tmin = "0$tmin";
	    }
	    $tsec = $today[seconds];
	    if ($tsec < 10){
	        $tsec = "0$tsec";
	    }
	    $date = getdate();
	    $year = $date[year];
	    $date = "$tmonth $tday, $tyear ($tday/$ttmon/$year) @ $thour:$tmin:$tsec";
	    echo "<br><br><b>"._EXPIRATIONDATE."</b><br><br>"
			.""._NOWIS.": $date<br><br>";
	    $day = 1;
	    echo "<b>"._EXPIRESON.":</b> "._DAY.": <select name=\"day\">";
	    while ($day <= 31) {
	        if ($day == $oday) {
	    	    $sel = "selected";
			} else {
		    	$sel = "";
			}
			echo "<option name=\"day\" $sel>$day</option>";
			$day++;
	    }
	    echo "</select>";
	    $month = 1;
	    echo " "._MONTH.": <select name=\"month\">";
	    while ($month <= 12) {
	        if ($month == $omonth) {
	    	    $sel = "selected";
			} else {
		    	$sel = "";
			}
			echo "<option name=\"month\" $sel>$month</option>";
	    	$month++;
	    }
	    echo "</select>";
	    $date = getdate();
	    $year = $date[year];
		echo " "._YEAR.": <select name=\"year\">";
		if ($oyear == $year) {
			$sel = "selected";	
		} else {
			$sel = "";	
		}
		echo "<option value=\"$year\" $sel>$year</option>";
		$sel = "";
		for ($i=0; $i<10; $i++) {
			$year++;
			if ($oyear == $year) {
				$sel = "selected";	
			} else {
				$sel = "";	
			}
			echo "<option value=\"$year\" $sel>$year</option>";
		}
		echo "</select>"
	        ."</td></tr><tr><td colspan=\"2\"><br><br>"
			."<input type=\"hidden\" name=\"mid\" value=\"$mid\">"
	        ."<input type=\"hidden\" name=\"op\" value=\"save_edit_user\">"
	        ."<input type=\"submit\" value=\""._CHANGEUSER."\">"
	        ."</form></td></tr></table>";
	    CloseTable();
	    admin_menu();
	    include("footer.php");
    }
}

function save_edit_user($mid, $uname, $email, $nickname, $password, $day, $month, $year, $chng_pass) {
    global $prefix, $db, $admin, $module_name, $sitename, $adminmail, $nukeurl;
    if (is_admin($admin)) {
		$expiration = "$year-$month-$day 00:00:00";
		if ($chng_pass == 0) {
		    $db->sql_query("UPDATE ".$prefix."_club_members SET uname='$uname', email='$email', nickname='$nickname', expire='$expiration' where mid='$mid'");
		} elseif ($chng_pass == 1) {
		    $passwd = md5($password);
		    $db->sql_query("UPDATE ".$prefix."_club_members SET uname='$uname', email='$email', nickname='$nickname', password='$passwd', expire='$expiration' where mid='$mid'");
		}
		include("header.php");
		clublogo();
		title(""._USERSADMIN."");
		OpenTable();
	        $subject = "$sitename "._CLUBUPDATE."";
		if ($month == 1) {
		    $month = _JANUARY;
		} elseif ($month == 2) {
		    $month = _FEBRUARY;
		} elseif ($month == 3) {
		    $month = _MARCH;
		} elseif ($month == 4) {
		    $month = _APRIL;
		} elseif ($month == 5) {
		    $month = _MAY;
		} elseif ($month == 6) {
		    $month = _JUNE;
		} elseif ($month == 7) {
		    $month = _JULY;
		} elseif ($month == 8) {
		    $month = _AUGUST;
		} elseif ($month == 9) {
		    $month = _SEPTEMBER;
		} elseif ($month == 10) {
		    $month = _OCTOBER;
		} elseif ($month == 11) {
		    $month = _NOVEMBER;
		} elseif ($month == 12) {
		    $month = _DECEMBER;
		}
		if ($chng_pass == 0) {
		    $password = ""._NOTCHANGED."";
		}
		$body = ""._HELLO." $uname:%0D%0A%0D%0A"._UPDATEMSG1."%0D%0A%0D%0A"
			.""._UPDATEMSG2."%0D%0A%0D%0A"
			.""._LOGIN.": $nickname%0D%0A"
			.""._PASSWORD.": $password%0D%0A"
			.""._EXPIRATION.": $month $day, $year%0D%0A%0D%0A"
			.""._UPDATEMSG3." $nukeurl/modules.php?name=Club%0D%0A"
			.""._UPDATEMSG4."%0D%0A%0D%0A"
			.""._UPDATEMSG5."%0D%0A%0D%0A"
			.""._BESTREGARDS."%0D%0A%0D%0A"
			."$sitename "._TEAM."%0D%0A"
			."$nukeurl";
		echo "<center><b>"._USEREMAILNOTIFICATION."</b><br><br>"
		    .""._USERCHANGED."<br><br>"
		    ."<b>"._SENDMAILTOUSER." <a href=\"mailto:$email?Subject=$subject&Body=$body\">"._ANEMAIL."</a> "._TOTHISUSER."</b><br><br>";
		CloseTable();
		admin_menu();
		include("footer.php");
    }
}

function members($cid=0, $up='0', $down='0') {
    global $module_name, $admin, $prefix, $db, $sitename;
    $cid = intval($cid);
    $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_club_categories WHERE cid='$cid' AND pid='0'"));
    if ($numrows == 1) {
    	Header("Location: modules.php?name=$module_name&op=members");
    	die();	
    }
    if ($down == 0) {
        $limit = $up;
    }
    if ($up == 0) {
        $limit = $down;
    }
    if ($down == 0 AND $up == 0) {
        $limit = 0;
    }
    if ($cid != 0) {
    	$row = $db->sql_fetchrow($db->sql_query("SELECT pid, title FROM ".$prefix."_club_categories WHERE cid='$cid'"));
   		$row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_club_categories WHERE cid='$row[pid]'"));
   		$c_tit = $row2[title];
   		$content = "<hr noshade size='1'><br>";
   		$content .= "<font class='title'><b>$row2[title] / $row[title]</b></font><br><br>";
   		$result = $db->sql_query("SELECT * FROM ".$prefix."_club_files WHERE cid='$cid' ORDER BY fid DESC LIMIT $limit,10");
   		$a = 0;
   		while ($row2 = $db->sql_fetchrow($result)) {
   			if (file_exists("modules/$module_name/files/$row2[filename]")) {
	   			$md5file = @md5_file("modules/$module_name/files/$row2[filename]");
	   			$md5db = $row2[md5];
	   			if ($md5file != $md5db) {
	   				$db->sql_query("UPDATE ".$prefix."_club_files SET md5='$md5file' WHERE fid='$row2[fid]'");
	   				$md5 = $md5file;	
	   			} else {
	   				$md5 = $row2[md5];
	   			}
	   			$date = time();
	   			$old = 604800 + $row2[date];
	   			if ($date <= $old) {
	   				$new = "&nbsp;<img src='modules/$module_name/images/new.gif' border='0' alt='"._NEWFILE."' title='"._NEWFILE."'>";
	   			} else {
	   				$new = "";	
	   			}
	   			$content .= "<table border='0' width='90%'>";
	   			$content .= "<tr><td colspan='2'><img src='modules/$module_name/images/club_download.gif' border='0'>&nbsp;&nbsp;<a href='modules.php?name=$module_name&op=get&fid=$row2[fid]'><font class='title'><u>$row2[title]</u></font></a> $new</td></tr>";
	   			$content .= "<tr><td valign='top'><b>"._DESCRIPTION.":</b></td><td width='100%'>$row2[description]</td></tr>";
	   			$content .= "<tr><td valign='top'><b>"._FILESIZE.":</b></td><td>".CoolSize($row2[size])."</td></tr>";
	   			$content .= "<tr><td valign='top'><b>"._MD5SUM.":</b></td><td>$md5</td></tr>";
	   			if (is_admin($admin)) {
	   				$content .= "<tr><td valign='top'><b>"._DOWNLOADS.":</b></td><td>$row2[hits]</td></tr>";
	   				$content .= "<tr><td valign='top'><b>"._ADMIN.":</b></td><td><a href='modules.php?name=$module_name&op=edit_file&fid=$row2[fid]'>"._EDIT."</a> | <a href='modules.php?name=$module_name&op=delete_file&fid=$row2[fid]'>"._DELETE."</a></td></tr>";
	   			}
	   			$content .= "</table><br><br>";
	   			$a++;
			} else {
				if (is_admin($admin)) {
					$content .= "<table border='0' width='90%'>";
					$content .= "<tr><td colspan='2'><img src='modules/$module_name/images/club_download.gif' border='0'>&nbsp;&nbsp;<a href='modules.php?name=$module_name&op=get&fid=$row2[fid]'><font class='title'><u>$row2[title]</u></font></a></td></tr>";
					$content .= "<tr><td valign='top'><b>"._WARNING.":</b></td><td width='100%'>"._FILENOTEXISTS." <i>(modules/$module_name/files/$row2[filename])</i></td></tr>";
					$content .= "<tr><td valign='top'><b>"._ADMIN."</b></td><td>[ <a href='modules.php?name=$module_name&op=delete_file&fid=$row2[fid]'>"._DELETE."</a> ]</td></tr>";
					$content .= "</table><br><br>";
				} else {
					break;
				}
			}
   		}
   		$content .= "<br><br>";
   		if (is_admin($admin)) {
   			$content .= "<center>[ <a href='modules.php?name=$module_name&op=add_file&cid=$cid'>"._ADDFILEIN." $c_tit/$row[title]</a> | <a href='modules.php?name=$module_name&op=edit_category&cid=$cid'>"._EDITTHISCAT."</a> | <a href='modules.php?name=$module_name&op=add_category'>"._ADDSUBCATEGORY."</a> ]</center><br><br>";
   		}
   		$down = $limit-10;
 		$up = $limit+10;
	    $content .= "<hr noshade size='1'>";
	    $content .= "<table border='0' width='100%'><tr><td width='50%' align='left'>";
	    if ($up == 0 OR $down == -10) {
	        $content .= "&nbsp;";
	    } else {
	        $content .= "<img src='modules/$module_name/images/arrow-previous.gif' border='0' width='11' height='8' alt='' title=''> <a href='modules.php?name=$module_name&op=members&cid=$cid&down=$down'>"._PREVIOUS."</a>";
	    }
	    $content .= "</td><td width='50%' align='right'>";
	    if ($a <= 9 OR $last == 1) {
	        $content .= "&nbsp";
	    } else {
	        $content .= "<a href='modules.php?name=$module_name&op=members&cid=$cid&up=$up'>"._NEXT."</a> <img src='modules/$module_name/images/arrow-next.gif' border='0' width='11' height='8' alt='' title=''>";
	    }
		$content .= "</td></tr></table><br>";
	}
    include("header.php");
    clublogo();
	OpenTable();
	catmenu();
    echo "<br><br><center>$content";
    if ($cid == 0) {
    	echo "<center>[ <a href='modules.php?name=$module_name&op=add_main_category'>"._ADDMAINCATEGORY."</a> ]</center><br><br>";
    }
    $numfiles = $db->sql_numrows($db->sql_query("SELECT fid FROM ".$prefix."_club_files"));
    $numcat = $db->sql_numrows($db->sql_query("SELECT cid FROM ".$prefix."_club_categories"));
    echo "("._THEREARE." $numfiles "._FILESIN." $numcat "._CATEGORIES.")";
    CloseTable();
    admin_menu();
    include("footer.php");
}

function add_file($cid=0) {
    global $prefix, $db, $module_name, $admin;
    if (is_admin($admin)) {
    	$row = $db->sql_fetchrow($db->sql_query("SELECT pid, title FROM ".$prefix."_club_categories WHERE cid='$cid'"));
		include("header.php");
		clublogo();
		title("Files Administration");
		OpenTable();
		$content = "<center><b>"._ADDNEWFILE."</center><br><br>"
		    ."<table border=\"0\"><tr><td>"
		    ."<form action=\"modules.php?name=$module_name\" method=\"post\">"
		    ."<b>"._PROGRAMTITLE.":</b></td><td><input type=\"text\" name=\"title\" size=\"50\"></td></tr><tr><td>"
		    ."<b>"._FILENAME.":</b></td><td>";
		$file_list = "<select name='filename'>";
	    $path1 = explode ("/", "modules/$module_name/files/");
	    $path = "$path1[0]/$path1[1]/$path1[2]";
	    $handle = opendir($path);
	    while ($file = readdir($handle)) {
	    	$numrows = $db->sql_numrows($db->sql_query("SELECT fid FROM ".$prefix."_club_files WHERE filename='$file'"));
			if ($numrows == 0 AND !ereg(".htaccess",$file) AND !ereg(".htm",$file) AND !ereg(".php",$file) AND $file != "." AND $file != "..") {
			    $tlist .= "$file---";
			    $a = 1;
			}
	    }
	    closedir($handle);
	    $tlist = explode("---", $tlist);
	    sort($tlist);
	    for ($i=0; $i < sizeof($tlist); $i++) {
			if ($tlist[$i] != "") {
			    $file_list .= "<option name=\"filename\" value=\"$tlist[$i]\">$tlist[$i]\n";
			}
	    }
		$content .= "$file_list";
	    $row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_club_categories WHERE cid='$row[pid]'"));
	    $content .= "</select></td></tr><tr><td>"
			."<b>"._CATEGORY.":</b></td><td><select name=\"category\">";
		$result = $db->sql_query("SELECT cid, pid, title from ".$prefix."_club_categories WHERE pid!='0' ORDER BY pid,title");
		while($row = $db->sql_fetchrow($result)) {
			if ($cid != 0 AND $cid == $row[cid]) {
				$sel = "selected";
			} else {
				$sel = "";
			}
    		$row2 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_club_categories WHERE cid='$row[pid]'"));
    		$content .= "<option name=\"cid\" value=\"$row[cid]\" $sel>$row2[title]/$row[title]</option>";
		}
		$content .= "</select></td></tr><tr><td>"
	    	."<b>"._DESCRIPTION.":</b></td><td><textarea name=\"description\" cols=\"70\" rows=\"15\"></textarea></td></tr><tr><td>&nbsp;</td><td>";
	    if ($a == 1) {
		    $content .= "<input type=\"hidden\" name=\"op\" value=\"save_file\">"
		    	."<input type=\"submit\" value=\""._ADDFILE."\">"
		    	."</form></td></tr></table>";
	    } else {    
			$content = "<center>"._ERRORNOFILES."<br><br>"._GOBACK."";
	    }
		echo "$content";
		CloseTable();
		admin_menu();
		include("footer.php");
    }
}

function add_category($pid) {
    global $prefix, $db, $module_name, $admin;
    if (is_admin($admin)) {
	    include("header.php");
	    clublogo();
	    title(""._CATEGORIESADMIN."");
	    OpenTable();
	    echo "<center><b>"._ADDSUBCATEGORY."</b></center><br><br>"
			."<table border=\"0\"><tr><td>"
			."<form action=\"modules.php?name=$module_name\" method=\"post\">";
		if (!$pid) {
			echo "<b>"._MAINCATEGORY.":</b></td><td><select name='pid'>";
			$sql = $db->sql_query("SELECT cid, title FROM ".$prefix."_club_categories WHERE pid='0'");
			while ($row = $db->sql_fetchrow($sql)) {
				echo "<option value='$row[cid]'>$row[title]</option>";
			}
			echo "</select></td></tr><tr><td>";
		} else {
			$row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_club_categories WHERE cid='$pid'"));
			echo "<b>"._MAINCATEGORY.":</b></td><td><input type='hidden' name='pid' value='$pid'>$row[title]</td></tr><tr><td>";
		}
		echo "<b>"._SUBCATEGORY.":</b></td><td><input type=\"text\" name=\"title\" size=\"50\"></td></tr><tr><td>&nbsp;</td><td>"
			."<input type=\"hidden\" name=\"op\" value=\"save_category\">"
			."<input type=\"submit\" value=\""._ADDSUBCATEGORY."\">"
			."</form></td></tr></table>";
	    CloseTable();
	    admin_menu();
	    include("footer.php");
    }
}

function add_main_category() {
    global $prefix, $db, $module_name, $admin;
    if (is_admin($admin)) {
	    include("header.php");
	    clublogo();
	    title(""._CATEGORIESADMIN."");
	    OpenTable();
	    echo "<center><b>"._ADDNEWCATEGORY."</b></center><br><br>"
			."<table border=\"0\"><tr><td>"
			."<form action=\"modules.php?name=$module_name\" method=\"post\">"
			."<b>"._MAINCATEGORY.":</b></td><td><input type=\"text\" name=\"title\" size=\"50\"></td></tr><tr><td>&nbsp;</td><td>"
			."<input type=\"hidden\" name=\"op\" value=\"save_main_category\">"
			."<input type=\"submit\" value=\""._ADDCATEGORY."\">"
			."</form></td></tr></table>";
	    CloseTable();
	    admin_menu();
	    include("footer.php");
    }
}

function save_main_category($title) {
	global $prefix, $db;
	$db->sql_query("INSERT INTO ".$prefix."_club_categories VALUES (NULL, '0', '$title')");
	Header("Location: modules.php?name=Club&op=members");
}

function edit_category($cid) {
    global $prefix, $db, $module_name, $admin;
    if (is_admin($admin)) {
		if (!$cid) {
		    include("header.php");
		    clublogo();
		    title(""._CATEGORIESADMIN."");
		    OpenTable();
			echo "<center><b>"._SELECTCATEGORY."</b><br><br><form action=\"modules.php?name=$module_name\" method=\"post\">"
				."<b>"._EDITCATEGORY.":</b> "
				."<select name=\"cid\">";
		    $result = $db->sql_query("SELECT cid, pid, title from ".$prefix."_club_categories ORDER BY pid,title");
		    while($row = $db->sql_fetchrow($result)) {
		    	if ($row[pid] == 0) {
		    		echo "<option name=\"cid\" value=\"$row[cid]\">$row[title]</option>";
		    	} else {
	    			$row2 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_club_categories WHERE cid='$row[pid]'"));
	    			echo "<option name=\"cid\" value=\"$row[cid]\">$row2[title]/$row[title]</option>";
	    		}
		    }
		    echo "</select> "
		    	."<input type=\"hidden\" name=\"op\" value=\"edit_category\">"
				."<input type=\"submit\" value=\""._EDITCATEGORY."\">"
				."</form></center>";
		    CloseTable();
		    admin_menu();
		    include("footer.php");
		} else {
		    $row = $db->sql_fetchrow($db->sql_query("SELECT pid, title FROM ".$prefix."_club_categories WHERE cid='$cid'"));
		    include("header.php");
		    clublogo();
		    title(""._CATEGORIESADMIN."");
		    OpenTable();
		    echo "<center><b>"._WRITENEWCATEGORY."</b></center><br><br>"
				."<table border=\"0\"><tr><td>";
		    if ($row[pid] != 0) {
		    	$maincat = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_club_categories WHERE cid='$row[pid]'"));
		    	echo "<b>"._MAINCATEGORY.":</b></td><td>$maincat[title]</td></tr><tr><td>";
		    }
			echo "<form action=\"modules.php?name=$module_name\" method=\"post\">";
			if ($row[pid] != 0) {
				echo "<b>"._SUBCATEGORY.":</b></td><td><input type=\"text\" name=\"title\" size=\"50\" value=\"$row[title]\"></td></tr><tr><td>&nbsp;</td><td>";
			} else {
				echo "<b>"._CATEGORY.":</b></td><td><input type=\"text\" name=\"title\" size=\"50\" value=\"$row[title]\"></td></tr><tr><td>&nbsp;</td><td>";
			}
			echo "<input type=\"hidden\" name=\"cid\" value=\"$cid\">"
				."<input type=\"hidden\" name=\"op\" value=\"save_edit_category\">"
				."<input type=\"submit\" value=\""._SAVECATEGORY."\">"
				."</form></td></tr></table>";
		    CloseTable();
		    admin_menu();
		    include("footer.php");
		}
    }
}

function save_edit_category($cid, $title) {
    global $prefix, $db, $admin;
    if (is_admin($admin)) {
		$db->sql_query("update ".$prefix."_club_categories set title='$title' where cid='$cid'");
		Header("Location: modules.php?name=Club&op=members&cid=$cid");
    }
}

function save_category($title, $pid) {
    global $prefix, $db, $admin;
    if (is_admin($admin)) {
		$db->sql_query("INSERT INTO ".$prefix."_club_categories VALUES (NULL, '$pid', '$title')");
		Header("Location: modules.php?name=Club&op=members&cid=$pid");
    }
}

function save_file($category, $title, $filename, $description) {
    global $prefix, $db, $admin, $module_name;
    if (is_admin($admin)) {
    	$date = time();
    	$md5 = md5_file("modules/$module_name/files/$filename");
    	$filesize = filesize("modules/$module_name/files/$filename");
		$db->sql_query("INSERT INTO ".$prefix."_club_files VALUES (NULL, '$category', '$title', '$filename', '$description', '$filesize', '0', '$date', '$md5')");
		Header("Location: modules.php?name=Club&op=members&cid=$category");
    }
}

function save_edit_file($fid, $cid, $title, $description) {
    global $prefix, $db, $admin;
    $fid = intval($fid);
    $cid = intval($cid);
    if (is_admin($admin)) {
		$db->sql_query("UPDATE ".$prefix."_club_files SET cid='$cid', title='$title', description='$description' WHERE fid='$fid'");
		$row = $db->sql_fetchrow($db->sql_query("SELECT cid FROM ".$prefix."_club_files WHERE fid='$fid'"));
		Header("Location: modules.php?name=Club&op=members&cid=$row[cid]");
    }
}
/*
function files() {
    global $prefix, $dbi, $bgcolor2, $bgcolor1, $module_name, $admin;
    if (is_admin($admin)) {
	    include("header.php");
	    clublogo();
	    title("PHP-Nuke Club: Files Administration");
	    OpenTable();
	    echo "<center><b>Club Files</b></center><br><br>"
			."<table border=\"1\" align=\"center\" width=\"100%\">"
			."<tr><td align=\"center\" bgcolor=\"$bgcolor2\"><b>Title</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>Filename</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>Category</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>Size</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>Hits</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>Functions</b></td></tr>";
	    $result = sql_query("select fid, cid, title, filename, size, hits from ".$prefix."_club_files order by title ASC", $dbi);
	    while (list($fid, $cid, $title, $filename, $size, $hits) = sql_fetch_row($result, $dbi)) {
			$size = CoolSize($size);
			if ($cid == 0) {
			    $category = "Main";
			} else {
			    $res = sql_query("select title from ".$prefix."_club_categories where cid='$cid'", $dbi);
			    list($cat_title) = sql_fetch_row($res, $dbi);
			    $category = "<a href=\"modules.php?name=$module_name&amp;op=edit_category&amp;cid=$cid\">$cat_title</a>";
			}
			if (eregi("http://", $filename)) {
			    $filename = "<a href=\"$filename\">$filename</a>";
			} else {
			    $filename = "<a href=\"modules/$module_name/files/$filename\">$filename</a>";
			}
			echo "<tr><td align=\"center\">$title</td><td align=\"center\">$filename</td><td align=\"center\">$category</td><td align=\"center\">$size</td><td align=\"center\">$hits</td><td align=\"center\">[ <a href=\"modules.php?name=Club&amp;op=edit_file&amp;fid=$fid\">Edit</a> | <a href=\"modules.php?name=Club&amp;op=delete_file&amp;fid=$fid\">Delete</a> ]</td></tr>";
	    }
	    echo "</table>";
	    CloseTable();
	    admin_menu();
	    include("footer.php");
    }
}
*/
function delete_file($ok=0, $fid, $cid=0) {
    global $prefix, $db, $admin;
    if (is_admin($admin)) {
	    if ($ok == 1) {
			$db->sql_query("DELETE FROM ".$prefix."_club_files WHERE fid='$fid'");
			Header("Location: modules.php?name=Club&op=members&cid=$cid");
	    } elseif ($ok == 0) {
			include("header.php");
			$result = $db->sql_query("select cid, title from ".$prefix."_club_files where fid='$fid'");
			$row = $db->sql_fetchrow($result);
			$cid = $row[cid];
			clublogo();
			title(""._FILESADMIN."");
			OpenTable();
			echo "<center><b>"._DELETEFILE."</b><br><br>"
			    .""._SURETODELFILE." $row[title]?<br><br>"
			    ."[ <a href=\"modules.php?name=Club&amp;op=delete_file&amp;ok=1&amp;fid=$fid&cid=$cid\">"._YES."</a> | <a href=\"modules.php?name=Club&amp;op=members&cid=$cid\">"._NO."</a> ]"
			    ."</center>";
			CloseTable();
			admin_menu();
			include("footer.php");
		}
    }
}

function delete_category($ok=0, $cid=0, $new_cid=0, $new_files_cid=0) {
    global $prefix, $db, $admin, $module_name;
    $cid = intval($cid);
    if (is_admin($admin)) {
	    if ($ok == 1) {
			if ($new_cid != 0) {
				$db->sql_query("DELETE FROM ".$prefix."_club_categories WHERE cid='$cid'");
				$db->sql_query("UPDATE ".$prefix."_club_categories SET pid='$new_cid' WHERE pid='$cid'");
				$db->sql_query("UPDATE ".$prefix."_club_files SET cid='$new_cid' WHERE fid='$row[fid]'");
			}
			if ($new_files_cid != 0) {
				$db->sql_query("DELETE FROM ".$prefix."_club_categories WHERE cid='$cid'");
				$result = $db->sql_query("SELECT fid FROM ".$prefix."_club_files WHERE cid='$cid'");
				while($row = $db->sql_fetchrow($result)) {
				    $db->sql_query("UPDATE ".$prefix."_club_files SET cid='$new_files_cid' WHERE fid='$row[fid]'");
				}
			}
			Header("Location: modules.php?name=Club&op=members");
	    } elseif ($ok == 0) {
			include("header.php");
			clublogo();
			title(""._CATEGORIESADMIN."");
			OpenTable();
			if (!$cid) {
				echo "<center><b>"._DELETECATEGORY."</b><br><br>"
			    	.""._SELECTCATEGORYDEL."<br><br>"
					."<form action='modules.php?name=$module_name' method='post'>"
					.""._CATEGORYTODEL.": <select name='cid'>";
				$sql = $db->sql_query("SELECT * FROM ".$prefix."_club_categories ORDER BY pid,title");
				while($row2 = $db->sql_fetchrow($sql)) {
					if ($row2[pid] == 0) {
						echo "<option value='$row2[cid]'>$row2[title]</option>";
					} else {
						$row3 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_club_categories WHERE cid='$row2[pid]'"));
						echo "<option value='$row2[cid]'>$row3[title] / $row2[title]</option>";
					}
				}
				echo "</select> <input type='hidden' name='op' value='delete_category'>"
					."<input type='submit' value='"._DELETECATEGORY."'>"
			    	."</form></center>";
			} else {
				$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_club_categories WHERE cid='$cid'"));
				$title = $row[title];
				if ($row[pid] == 0) {
					$numcat = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_club_categories WHERE pid=0"));
					if ($numcat == 1) {
						echo "<center><b>"._ERRORDELMAINCAT."</b><br><br>"._MAINCATNOTDEL."<br><br>"._GOBACK."</center>";
					} else {
						echo "<center><b>"._DELETECATEGORY."</b><br><br>"
					    	.""._SUREDELCATEGORY." $title?<br><br>"
					    	.""._MAINCATSELECTNEW."<br><br>"
							."<form action='modules.php?name=$module_name' method='post'>"
							.""._MOVECONTENTTO.": <select name='new_cid'>";
						$sql = $db->sql_query("SELECT * FROM ".$prefix."_club_categories WHERE cid!='$cid' AND pid='0' AND pid!='$cid' ORDER BY pid,title");
						while($row2 = $db->sql_fetchrow($sql)) {
							echo "<option value='$row2[cid]'>$row2[title]</option>";
						}
						echo "</select> <input type='hidden' name='cid' value='$cid'><input type='hidden' name='ok' value='1'><input type='hidden' name='op' value='delete_category'>"
							."<input type='submit' value='"._OK."'>"
					    	."</form></center>";
				    }
				} else {
					$numsubcat = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_club_categories WHERE pid!=0"));
					if ($numsubcat == 1) {
						echo "<center><b>"._ERRORDELMAINCAT."</b><br><br>"._SUBCATNOTDEL."<br><br>"._GOBACK."</center>";
					} else {
						echo "<center><b>"._DELETECATEGORY."</b><br><br>"
					    	.""._SUREDELCATEGORY.": $title?<br><br>"
					    	.""._SUBCATSELECTNEW."<br><br>"
							."<form action='modules.php?name=$module_name' method='post'>"
							.""._MOVEFILESTO.": <select name='new_files_cid'>";
						$sql = $db->sql_query("SELECT * FROM ".$prefix."_club_categories WHERE cid!='$cid' AND pid!='0' AND pid!='$cid' ORDER BY pid,title");
						while($row2 = $db->sql_fetchrow($sql)) {
							$row3 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_club_categories WHERE cid='$row2[pid]'"));
							echo "<option value='$row2[cid]'>$row3[title] / $row2[title]</option>";
						}
						echo "</select> <input type='hidden' name='cid' value='$cid'><input type='hidden' name='ok' value='1'><input type='hidden' name='op' value='delete_category'>"
							."<input type='submit' value='"._OK."'>"
					    	."</form></center>";
					}
				}
			}
			CloseTable();
			admin_menu();
			include("footer.php");
	    }
    }
}

function edit_file($fid) {
    global $prefix, $db, $module_name, $admin;
    if (is_admin($admin)) {
	    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_club_files WHERE fid='$fid'"));
	    $row2 = $db->sql_fetchrow($db->sql_query("SELECT cid FROM ".$prefix."_club_categories WHERE cid='$row[cid]'"));
	    include("header.php");
	    clublogo();
	    title(""._FILESADMIN."");
	    OpenTable();
	    echo "<center><b>"._EDITFILE."</b><br><br>"
			."<table border=\"0\"><tr><td>"
			."<form method=\"post\" action=\"modules.php?name=Club\">"
			."<b>"._PROGRAMTITLE.":</b></td><td><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"255\" value=\"$row[title]\"></td></tr><tr><td>"
			."<b>"._FILENAME.":</b></td><td>$row[filename]</td></tr><tr><td>"
			."<b>"._CATEGORY.":</b></td><td>"
			."<select name=\"cid\">";
		$result = $db->sql_query("SELECT cid, pid, title from ".$prefix."_club_categories WHERE pid!='0' ORDER BY pid,title");
		while($row3 = $db->sql_fetchrow($result)) {
			if ($row3[cid] == $row2[cid]) {
				$sel = "selected";
			} else {
				$sel = "";
			}
    		$row4 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_club_categories WHERE cid='$row3[pid]'"));
    		echo "<option name=\"cid\" value=\"$row3[cid]\" $sel>$row4[title]/$row3[title]</option>";
		}
		echo "</select></td></tr><tr><td>"
			."<b>"._DESCRIPTION.":</b></td><td><textarea name=\"description\" cols=\"60\" rows=\"10\">$row[description]</textarea></td></tr><tr><td>"
			."<b>"._FILESIZE.":</b></td><td>$row[size] "._BYTES." (".CoolSize($row[size]).")</td></tr><tr><td>&nbsp;</td><td>"
	        ."<input type=\"hidden\" name=\"fid\" value=\"$fid\">"
			."<input type=\"hidden\" name=\"op\" value=\"save_edit_file\">"
	        ."<input type=\"submit\" value=\""._SAVECHANGES."\">"
	        ."</form></td></tr></table>";
	    CloseTable();
	    admin_menu();
	    include("footer.php");
    }
}

function update_db() {
    global $prefix, $db, $module_name, $admin, $adminmail, $sitename, $nukeurl;
    if (is_admin($admin)) {
		$today = getdate();
		$day = $today[mday];
		if ($day < 10){
	    	$day = "0$day";
		}
		$month = $today[mon];
		if ($month < 10){
	    	$month = "0$month";
		}
		$year = $today[year];
		$today = "$year-$month-$day 00:00:00";
		$result = $db->sql_query("SELECT mid, uname, email, expire FROM ".$prefix."_club_members");
		while ($db->sql_fetchrow($result)) {
			$mid = $row[mid];
			$uname = $row[uname];
			$email = $row[email];
			$expire  = $row[expire];
		    $expire = explode(" ", $expire);
		    $thedate = explode("-", $expire[0]);
		    if (($thedate[0] <= $year) AND (($thedate[1] <= $month AND $thedate[2] <= $day) OR ($thedate[1] < $month) OR ($thedate[0] < $year))) {
				$db->sql_query("DELETE FROM ".$prefix."_club_members WHERE mid='$mid'");
				$email = "$uname <$email>";
				$subject = "$sitename "._MEMBERSHIPEXPIRED."";
				$content = ""._DEARUSER.":\n\n"._EXPIREDMSG1."\n\n"._EXPIREDMSG2." $nukeurl/modules.php?name=$module_name\n\n"._EXPIREDMSG3."\n\n"._THANKSSUPPORT."\n\n$sitename "._TEAM."\n$nukeurl";
				$from = $adminmail;
				mail($email, $subject, $content, "From: $from\nX-Mailer: PHP/" . phpversion());
		    }
		}
		Header("Location: modules.php?name=$module_name");
    }
}

switch($op) {

    case admin_news:
    admin_news();
    break;

    case admin_news_add:
    admin_news_add($content);
    break;

    case club_config:
    club_config();
    break;

    case club_config_save:
    club_config_save($content, $type);
    break;

    case add_user:
    add_user();
    break;

    case create_user:
    create_user($uname, $email, $nickname, $password, $day, $month, $year);
    break;

    case save_edit_user:
    save_edit_user($mid, $uname, $email, $nickname, $password, $day, $month, $year, $chng_pass);
    break;

    case members_admin:
    members_admin();
    break;

    case delete:
    delete($ok, $mid);
    break;

    case edit_user:
    edit_user($mid);
    break;

    case members:
    members($cid, $up, $down);
    break;

    case add_file:
    add_file($cid);
    break;

    case edit_file:
    edit_file($fid);
    break;

    case add_category:
    add_category($pid);
    break;

    case add_main_category:
    add_main_category();
    break;

    case save_file:
    save_file($category, $title, $filename, $description);
    break;

    case save_category:
    save_category($title, $pid);
    break;

	case save_main_category:
	save_main_category($title);
	break;

    case delete_file:
    delete_file($ok, $fid, $cid);
    break;

    case delete_category:
    delete_category($ok, $cid, $new_cid, $new_files_cid);
    break;

    case edit_category:
    edit_category($cid);
    break;
    
    case save_edit_category:
    save_edit_category($cid, $title);
    break;

    case save_edit_file:
    save_edit_file($fid, $cid, $title, $description);
    break;

    case update_db:
    update_db();
    break;

    case get:
    get($fid);
    break;

    default:
    main_page();
    break;

}

?>