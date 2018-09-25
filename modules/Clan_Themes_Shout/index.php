<?php if (!eregi("modules.php", $PHP_SELF)) {
    die("You can't access this file directly...");
}
function make_clickable($text) {
    $ret = ' ' . $text;
    $ret = preg_replace("#(^|[
 ])([\w]+?://[^ \"

	<]*)#is", "<a href=\"\" target=\"_blank\"></a>", $ret);
    $ret = preg_replace("#(^|[
 ])((www|ftp)\.[^ \"	

<]*)#is", "<a href=\"http://\" target=\"_blank\"></a>", $ret);
    $ret = preg_replace("#(^|[
 ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "<a href=\"mailto:@\">@</a>", $ret);
    $ret = substr($ret, 1);
    return ($ret);
}
require_once ("mainfile.php");
$module_name = basename(dirname('index.php'));
global $db, $prefix, $user, $admin;
cookiedecode($user);
$username = $cookie[1];
if ($username == "") {
    $username = "Anonymous";
}
switch ($op) {
    case write:
        $msg = $_POST['msgtxt'];
        $time = time();
        $query3 = $db->sql_query("SELECT * FROM " . $prefix . "_ctshout_shoutconfig;");
        $row3 = $db->sql_fetchrow($query3);
        if ($row3['anon'] == 0 && $username != "Anonymous" || $row3['anon'] == 1) {
            $msg = str_replace("&", "and", $msg);
            $msg = ereg_replace("[^A-Za-z0-9 --\:\@\.\/\'\*\(\)\_\+\|\?\,\#\^\}\{]", "", $msg);
            $result = $db->sql_query("INSERT INTO " . $prefix . "_ctshout_shouts (UID, PDT, MSG, IP)
VALUES ('$username', '$time', '$msg', '$REMOTE_ADDR')") or die(mysql_error());
        }
    case access:
        $query = $db->sql_query("select * from " . $prefix . "_ctshout_shouts ORDER BY PID DESC");
        if ($query) {
            $nrows = mysql_num_rows($query);
        }
        $query2 = $db->sql_query("SELECT * FROM " . $prefix . "_ctshout_shoutconfig;");
        $row2 = $db->sql_fetchrow($query2);
        if ($row2['autoprune'] == 1 && $nrows >= $row2['autoprunecount']) {
            $result = $db->sql_query("TRUNCATE TABLE `" . $prefix . "_ctshout_shouts`");
        }
        if (file_exists("themes/$ThemeSel/CTShout/display.php")) {
            include ("themes/$ThemeSel/CTShout/display.php");
        } else {
            $msg = "output=";
            while ($row = $db->sql_fetchrow($query)) {
                $time = strftime("%a %m/%d/%y %H:%M", $row['PDT']);
                $msg.= "<p class=\"shout1\">" . $row['UID'] . " " . $time . "</p>";
                $m1 = strtolower($m1);
                $m1 = make_clickable($row['MSG']);
                $msg.= "<p class=\"shout2\">" . $m1 . "</p>";
                $msg.= "<p class=\"shout1\">---------------------------------------------</p>";
            }
            $msg.= "";
            echo $msg;
        }
        $msg2 = "&username=";
        $msg2.= $username;
        echo $msg2;
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_ctshout_shoutconfig;"));
        $censorWords = str_replace(" ", ",", $row['censorwords']);
        $msg3 = "&censor=" . $row['wordcensor'] . "&urls=" . $row['urls'] . "&anon=" . $row['anon'] . "&pcount=" . $nrows . "&ip=" . $REMOTE_ADDR . "&censorwords=" . $censorWords;
        echo $msg3;
    break;
    default:
        include ("header.php");
        if (file_exists("modules/$module_name/copyright.php")) {
            $index = 0;
            OpenTable();
            echo "  <table width='100%'  border='0' cellspacing='0' cellpadding='4'>
  <tr> 
    <td colspan='3' class='bodyline'><div align='center'><strong>Clan Themes Shouts</strong></div></td>
  </tr>
  <tr> 
    <td colspan='3' class='row1'><div align='center'>Posted Shouts </div></td>
  </tr>
  <tr class='cattitle'> 
    <td class='row2' width='15%'><div align='center'>Timestamp</div></td>
    <td class='row2' width='18%'><div align='center'>Username</div></td>
    <td class='row2'><div align='center'>Shout</div></td>
  </tr>";
            $query = $db->sql_query("select * from " . $prefix . "_ctshout_shouts ORDER BY PID ASC");
            if ($query) {
                $scount = mysql_num_rows($query);
            } else {
                $scount = 0;
            }
            $rows = 1;
            while ($row = $db->sql_fetchrow($query)) {
                $time = strftime("%a %m/%d/%y %H:%M", $row['PDT']);
                $msg = substr($row['MSG'], 0, 75);
                echo "  <tr> 
    <td class='row" . $rows . "' align='center'>" . $time . "</td>
    <td class='row" . $rows . "' align='center'>" . $row['UID'] . "</td>
    <td class='row" . $rows . "'>" . $msg . "</td>
  </tr>";
                if ($rows == 2) {
                    $rows = 1;
                } else {
                    $rows++;
                }
            }
            echo "  <tr> 
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr> 
    <td colspan='3'>Total Shouts: <strong>" . $scount . "</strong></td>
  </tr>
</table>";
            CloseTable();
            if (is_admin($admin)) {
                OpenTable();
                echo "<center>[ <a href=admin.php?op=CTShout_Shout>Shout Admin</a> ] [ <a href=admin.php?op=CTShout_Shouts>Shout Management</a> ] [ <a href=admin.php?op=CTShout_Config>Shout Preferences</a> ]</center>";
                CloseTable();
            }
        } else {
            OpenTable();
            echo "<center><b>Opps, you forgot to upload the modules/$module_name/copyright.php file!<br><br>
<a href= http://clan-themes.co.uk><img src=\"modules/$module_name/ct_no_copyright.png\" alt=\"No Copyright\" border=\"0\"></a><br><br>
Go and upload it or this image will not go away!</b></center>";
            CloseTable();
        }
        include ("footer.php");
}