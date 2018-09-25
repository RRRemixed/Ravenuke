<?php if (!defined('ADMIN_FILE')) {
    die('Access Denied');
}
global $prefix, $db, $admdata;
$module_name = basename(dirname(dirname('index.php')));
global $admin_file;
$aid = substr("$aid", 0, 25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM " . $prefix . "_modules WHERE title='CTShout'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i = 0;$i < sizeof($admins);$i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;
    }
}
if ($row2['radminsuper'] == 1 || $auth_user == 1) {
    global $prefix, $db, $admin_file;
    include ("header.php");
    OpenTable();
    echo "<div style='text-align:center;'>[ <a href='" . $admin_file . ".php'>Main Administration</a> ]</div>";
    CloseTable();
    OpenTable();
    echo "<table width='100%' border='0' cellspacing='0' cellpadding='4'>
  <tr> 
    <td width='150' valign='top' class='row1'><br /><div style='text-align:center;'><b>Clan Themes Shout Admin</b></div><br />
	<b>Management</b><br />
	  - <a href='" . $admin_file . ".php?op=CTShout_Shout'>Main</a><br />
      - <a href='" . $admin_file . ".php?op=CTShout_Config'>Preferences</a><br />
      - <a href='" . $admin_file . ".php?op=CTShout_Shouts'>Manage Shouts</a>
	  <br /><br />
	  <b>Setup</b><br />
      - <a href='" . $admin_file . ".php?op=CTShout_Install'>Install</a><br />
      - <a href='" . $admin_file . ".php?op=CTShout_UnInstall'>Uninstall</a> 
    </td>
    <td valign='top' class='row2'>";
    function CTShout_config($op2, $anon, $wordcensor, $censorwords, $autoprune, $autoprunecount) {
        global $db, $admin_file, $prefix;
        if ($op2 == "POST") {
            $result = $db->sql_query("UPDATE `" . $prefix . "_ctshout_shoutconfig` SET `anon` = '" . $anon . "',
						`wordcensor` = '" . $wordcensor . "',
						`censorwords` = '" . $censorwords . "',
						`autoprune` = '" . $autoprune . "',
						`autoprunecount` = '" . $autoprunecount . "';");
            if ($result) {
                echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shoutconfig Preferences Updated!</div>";
            } else {
                echo "<div style='text-align:center;font-size:14px;'>Database Error! ... Please Check Your Installation</div>";
            }
        }
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_ctshout_shoutconfig;"));
        echo "<form method=\"post\" action=\"" . $admin_file . ".php?op=CTShout_Config\">
";
        echo "<input name=\"op2\" type=\"hidden\" value=\"POST\">
";
        echo "  <table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
";
        echo "    <tr>
";
        echo "      <td colspan=\"3\" class='row1'><strong>Preferences</strong></td>
";
        echo "    </tr>
";
        echo "    <tr>
";
        echo "      <td width=\"33%\" align=\"right\" class=\"row2\">Anonymous Posting:</td>
";
        echo "      <td width=\"33%\" class=\"row2\"><select name=\"anon\" id=\"anon\">
";
        if ($row['anon'] == 1) {
            echo "        <option value=\"1\" selected>On</option>
";
            echo "        <option value=\"0\">Off</option>
";
        } else {
            echo "        <option value=\"1\">On</option>
";
            echo "        <option value=\"0\" selected>Off</option>
";
        }
        echo "      </select></td>
";
        echo "      <td width=\"33%\" class=\"row2\">&nbsp;</td>
";
        echo "    </tr>
";
        echo "    <tr>
";
        echo "      <td width=\"33%\" class=\"row1\" align='right'>Word Censoring: </div></td>
";
        echo "      <td width=\"33%\" class=\"row1\"><select name=\"wordcensor\" id=\"wordcensor\">
";
        if ($row['wordcensor'] == 1) {
            echo "        <option value=\"1\" selected>On</option>
";
            echo "        <option value=\"0\">Off</option>
";
        } else {
            echo "        <option value=\"1\">On</option>
";
            echo "        <option value=\"0\" selected>Off</option>
";
        }
        echo "      </select></td>
";
        echo "      <td width=\"33%\" class=\"row1\">&nbsp;</td>
";
        echo "    </tr>
";
        echo "    <tr>
";
        echo "      <td width=\"33%\" valign=\"top\" class=\"row1\" align=\"right\">Censored Words:</td>
";
        echo "      <td width=\"33%\" class=\"row1\" align=\"center\">
";
        echo "        <textarea name=\"censorwords\" cols=\"50\" rows=\"8\" id=\"censorwords\">" . $row['censorwords'] . "</textarea>
";
        echo "      </td>
";
        echo "      <td width=\"33%\" valign=\"top\" class=\"row1\">Please seperate all censor words with a space &quot; &quot;. </td>
";
        echo "    </tr>
";
        echo "    <tr class=\"row2\">
";
        echo "      <td width=\"33%\" class=\"row2\" align=\"right\">Auto Prune: </td>
";
        echo "      <td width=\"33%\" class=\"row2\"><select name=\"autoprune\" id=\"autoprune\">
";
        if ($row['autoprune'] == 0) {
            echo "        <option value=\"0\" selected>Off</option>
";
            echo "        <option value=\"1\">Posts</option>
";
        } else {
            echo "        <option value=\"0\">Off</option>
";
            echo "        <option value=\"1\" selected>Posts</option>
";
        }
        echo "      </select></td>
";
        echo "      <td width=\"33%\" class=\"row2\">&nbsp;</td>
";
        echo "    </tr>
";
        echo "    <tr>
";
        echo "      <td width=\"33%\" class=\"row1\" align=\"right\">Auto Prune Count:</td>
";
        echo "      <td width=\"33%\" class=\"row1\"><input name=\"autoprunecount\" type=\"text\" id=\"autoprunecount\" value=\"" . $row['autoprunecount'] . "\" size=\"10\"></td>
";
        echo "      <td width=\"33%\" class=\"row1\">&nbsp;</td>
";
        echo "    </tr>
";
        echo "    <tr>
";
        echo "      <td colspan=\"3\">&nbsp;</td>
";
        echo "    </tr>
";
        echo "    <tr>";
        echo "      <td colspan=\"3\" class=\"row2\"align=\"center\">
";
        echo "        <input type=\"submit\" name=\"Submit\" value=\"Submit\">
";
        echo "      </td>
";
        echo "    </tr>
";
        echo "  </table>
";
        echo "</form>
";
    }
    function CTShout_install($op2, $choice, $delexists) {
        global $db, $admin_file, $prefix;
        if ($op2 == "POST") {
            if ($choice == "Yes" && $delexists == "Yes") {
                $preresults1 = $db->sql_query("DROP TABLE IF EXISTS " . $prefix . "_ctshout_shouts");
                $preresults2 = $db->sql_query("DROP TABLE IF EXISTS " . $prefix . "_ctshout_shoutconfig");
                if ($preresults = 1) {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shouts Table Un-Installed</div>
";
                } else {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shouts Table Not Un-Installed</div>
";
                }
                if ($preresults2 = 1) {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shoutconfig Table Un-Installed</div>
";
                } else {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shoutconfig Table Not Un-Installed</div>
";
                }
            }
            if ($choice == "Yes") {
                $results = $db->sql_query("CREATE TABLE `nuke_ctshout_shoutconfig` (
							`anon` varchar(255) NOT NULL default '',
							`wordcensor` varchar(255) NOT NULL default '',
							`censorwords` varchar(255) NOT NULL default '',
							`autoprune` varchar(255) NOT NULL default '',
							`autoprunecount` varchar(255) NOT NULL default ''
							) TYPE=MyISAM;");
                $results1 = $db->sql_query("CREATE TABLE `" . $prefix . "_ctshout_shouts` (
							`PID` int(15) NOT NULL auto_increment,
							`UID` varchar(125) default NULL,
							`PDT` int(11) default NULL,
							`MSG` mediumtext,
							`IP` varchar(16) NOT NULL default '',
							PRIMARY KEY  (`PID`)
							) ENGINE=MyISAM AUTO_INCREMENT=1;");
                $results2 = $db->sql_query("INSERT INTO `" . $prefix . "_ctshout_shoutconfig` ( `anon` , `wordcensor` , `censorwords` , `autoprune` , `autoprunecount` )
							VALUES ('1', '1', 'shit pussy fuck cunt cock c0ck cum twat clit bitch fuk motherfucker', '0', '0');");
                $results3 = $db->sql_query("INSERT INTO `nuke_ctshout_shouts` VALUES (1, 'Clan Themes Team', 1119084877, 'Clan Themes ShoutBox has been installed!', '204.257.131.245');");
                if ($results) {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shoutconfig Table Installed </div>
";
                } else {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shoutconfig Table Not Installed </div>
";
                }
                if ($results1) {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shouts Table Installed </div>
";
                } else {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shouts Table Not Installed </div>
";
                }
                if ($results2) {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shoutconfig Preferences Inserted </div>
";
                } else {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shoutconfig Preferences Not Inserted </div>
";
                }
                if ($results3) {
                    echo "<div style='text-align:center;'>First Shout Inserted </div>
";
                } else {
                    echo "<div style='text-align:center;'>First Shout Not Inserted </div>
";
                }
                if ($results && $results1 && $results2) {
                    echo "<div style='font-size:14px; color:#FF0000;text-align:center;'>Shoutbox Installed</div>
";
                } else {
                    echo "<div style='text-align:center;font-size:14px;'>Database Error ... Please Check Your Installation</div>
";
                }
                if ($choice == "No") {
                    header("Location: " . $admin_file . ".php?op=CTShout_Shout");
                }
            } else {
                header("Location: " . $admin_file . ".php?op=CTShout_Shouts");
                exit();
            }
        } else {
            echo "<form method=\"post\" action=\"" . $admin_file . ".php?op=CTShout_Install\">
";
            echo "<input name=\"op2\" type=\"hidden\" value=\"POST\">
";
            echo "  <table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
";
            echo "    <tr>
";
            echo "      <td class='row1'><b>Install Clan Themes Shoutbox </b></td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row1\" align='center'>Warning This Will Install Clan Themes Shoutbox</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td>&nbsp;</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row1\"><div style='text-align:center;'>
";
            echo "        Do You Wish To Proceed? 
";
            echo "          <select name=\"choice\" id=\"choice\">
";
            echo "          <option value=\"Yes\">Yes</option>
";
            echo "          <option value=\"No\" selected>No</option>
";
            echo "        </select>
";
            echo "      </div></td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td>&nbsp;</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row1\"><div style='text-align:center;'>Delete Prior Installation If Exists?
";
            echo "          <select name=\"delexists\" id=\"delexists\">
";
            echo "            <option value=\"No\" selected>No</option>
";
            echo "            <option value=\"Yes\">Yes</option>
";
            echo "              </select>
";
            echo "      </div></td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td>&nbsp;</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row2\"><div style='text-align:center;'>
";
            echo "        <input type=\"submit\" name=\"Submit\" value=\"Submit\">
";
            echo "      </div></td>
";
            echo "    </tr>
";
            echo "  </table>
";
            echo "</form>
";
        }
    }
    function CTShout_uninstall($op2, $choice) {
        global $db, $admin_file, $prefix;
        if ($op2 == "POST") {
            if ($choice == "Yes") {
                $results1 = $db->sql_query("DROP TABLE IF EXISTS " . $prefix . "_ctshout_shouts");
                $results2 = $db->sql_query("DROP TABLE IF EXISTS " . $prefix . "_ctshout_shoutconfig");
                if ($results1) {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shouts Table Un-Installed</div>
";
                } else {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shouts Table Not Un-Installed</div>
";
                }
                if ($results2) {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shoutconfig Table Un-Installed</div>
";
                } else {
                    echo "<div style='text-align:center;'>" . $prefix . "_ctshout_shoutconfig Table Not Un-Installed</div>
";
                }
                if ($results1 && $results2) {
                    echo "<div style='font-size:14px; color:#FF0000;text-align:center;'>Shoutbox Un-Installed!</div>
";
                } else {
                    echo "<div style='text-align:center;font-size:14px;'>Database Error ... Please Check Your Installation </div>
";
                }
            }
            if ($choice == "No") {
                header("Location: " . $admin_file . ".php?op=CTShout_Shout");
            }
        } else {
            echo "<form method=\"post\" action=\"" . $admin_file . ".php?op=CTShout_UnInstall\">
";
            echo "<input name=\"op2\" type=\"hidden\" value=\"POST\">
";
            echo "  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
";
            echo "    <tr>
";
            echo "      <td class='row1'><b>Un-Install Clan Themes Shoutbox</b></td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row1\" align=\"center\">Warning This Will Un-Install Clan Themes Shoutbox</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td>&nbsp;</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row1\" align=\"center\">
";
            echo "        Do You Wish To Proceed? 
";
            echo "          <select name=\"choice\" id=\"choice\">
";
            echo "          <option value=\"Yes\">Yes</option>
";
            echo "          <option value=\"No\" selected>No</option>
";
            echo "        </select>
";
            echo "      </td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td>&nbsp;</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td>&nbsp;</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row2\" align=\"center\">
";
            echo "        <input type=\"submit\" name=\"Submit\" value=\"Submit\">
";
            echo "      </td>
";
            echo "    </tr>";
            echo "  </table>
";
            echo "</form>
";
        }
    }
    function CTShout_clearShouts($choice, $op2) {
        global $db, $admin_file, $prefix;
        if ($op2 == "POST") {
            if ($choice == "Yes") {
                $result = $db->sql_query("TRUNCATE TABLE `" . $prefix . "_ctshout_shouts`");
                if ($result) {
                    echo "<div style='text-align:center;'>Shouts Cleared!</div>
";
                } else {
                    echo "<div style='text-align:center;font-size:14px;'>Database Error ... Please Check Your Installation</div>
";
                }
            }
            if ($choice == "No") {
                header("Location: " . $admin_file . ".php?op=CTShout_Shouts");
            }
        } else {
            echo "<form method=\"post\" action=\"" . $admin_file . ".php?op=CTShout_ClearShouts\">
";
            echo "<input name=\"op2\" type=\"hidden\" value=\"POST\">
";
            echo "  <table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
";
            echo "    <tr>
";
            echo "      <td class='row1'><b>Clear Shouts</b></td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row1\"align=\"center\">Warning This Will Delete All Shouts</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td>&nbsp;</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row1\" align=\"center\">
";
            echo "        Do You Wish To Proceed? 
";
            echo "          <select name=\"choice\" id=\"choice\">
";
            echo "          <option value=\"Yes\">Yes</option>
";
            echo "          <option value=\"No\" selected>No</option>
";
            echo "        </select>
";
            echo "      </td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td>&nbsp;</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td>&nbsp;</td>
";
            echo "    </tr>
";
            echo "    <tr>
";
            echo "      <td class=\"row2\" align=\"center\">
";
            echo "        <input type=\"submit\" name=\"Submit\" value=\"Submit\">
";
            echo "      </td>
";
            echo "    </tr>";
            echo "  </table>
";
            echo "</form>
";
        }
    }
    function CTShout_shouts($pid, $op2, $option, $uid, $ip, $msg) {
        global $db, $admin_file, $prefix;
        switch ($option) {
            case "Show":
                $query = $db->sql_query("SELECT * FROM `" . $prefix . "_ctshout_shouts` WHERE (`PID` = '" . $pid . "')");
                $row = $db->sql_fetchrow($query);
                $time = strftime("%a %m/%d/%y %H:%M", $row['PDT']);
                echo "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
                echo "  <tr>
";
                echo "    <th colspan=\"2\"><div style='text-align:center;'>Full Shout By: " . $row['UID'] . "</div></th>
";
                echo "  </tr>
";
                echo "  <tr valign=\"top\">
";
                echo "    <td width=\"33%\" class=\"row1\"><strong>Username:</strong></td>
";
                echo "    <td>" . $row['UID'] . "</td>
";
                echo "  </tr>
";
                echo "  <tr valign=\"top\">
";
                echo "    <td width=\"33%\" class=\"row2\"><strong>Timestamp:</strong></td>
";
                echo "    <td>" . $time . "</td>
";
                echo "  </tr>
";
                echo "  <tr valign=\"top\">
";
                echo "    <td width=\"33%\" class=\"row1\"><strong>IP:</strong></td>
";
                echo "    <td>" . $row['IP'] . "</td>
";
                echo "  </tr>
";
                echo "  <tr valign=\"top\">
";
                echo "    <td width=\"33%\" class=\"row2\"><strong>Message Text: </strong></td>
";
                echo "    <td>" . $row['MSG'] . "</td>
";
                echo "  </tr>
";
                echo "  <tr>
";
                echo "    <td colspan=\"2\">&nbsp;</td>
";
                echo "  </tr>
";
                echo "  <tr>
";
                echo "    <th colspan=\"2\" valign=\"top\"><form method=\"post\" action=\"" . $admin_file . ".php?op=CTShout_Shouts\">
";
                echo "	<input name=\"op2\" type=\"hidden\" id=\"op2\" value=\"PROCESS\">
";
                echo "	<input name=\"pid\" type=\"hidden\" id=\"pid\" value=\"" . $row['PID'] . "\">
";
                echo "      <div style='text-align:center;'>
";
                echo "        Action: 
";
                echo "        <select name=\"option\">
";
                echo "          <option value=\"Edit\" selected>Edit</option>
";
                echo "          <option value=\"Delete\">Delete</option>
";
                echo "        </select>
";
                echo "        <input type=\"submit\" name=\"Submit\" value=\"Go\">
";
                echo "        </div>";
                echo "    </form></th>
";
                echo "  </tr>
";
                echo "</table>
";
            break;
            case "Edit":
                if ($op2 == "POST") {
                    $pdt = time();
                    $result = $db->sql_query("UPDATE `" . $prefix . "_ctshout_shouts` SET `UID` = '" . $uid . "', `PDT` = '" . $pdt . "', `MSG` = '" . $msg . "', `IP` = '" . $ip . "' WHERE `PID` = '" . $pid . "' LIMIT 1;");
                    header("Location: " . $admin_file . ".php?op=CTShout_Shouts");
                    exit();
                } else {
                    $query = $db->sql_query("SELECT * FROM `" . $prefix . "_ctshout_shouts` WHERE (`PID` = '" . $pid . "')");
                    $row = $db->sql_fetchrow($query);
                    $time = strftime("%a %m/%d/%y %H:%M", $row['PDT']);
                    echo "<form action=\"" . $admin_file . ".php?op=CTShout_Shouts\" method=\"post\">
";
                    echo "<input name=\"op2\" type=\"hidden\" value=\"POST\">
";
                    echo "<input name=\"option\" type=\"hidden\" value=\"Edit\">";
                    echo "<input name=\"pid\" type=\"hidden\" value=\"" . $row['PID'] . "\">
";
                    echo "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
";
                    echo "  <tr>
";
                    echo "    <td colspan=\"2\"><div style='text-align:center;'>Edit Shout PID:" . $pid . " </div></td>
";
                    echo "  </tr>
";
                    echo "  <tr>
";
                    echo "    <td colspan=\"2\">&nbsp;</td>
";
                    echo "  </tr>
";
                    echo "  <tr>
";
                    echo "    <td width=\"33%\" class=\"row1\"><div align=\"left\"><strong>Username:</strong></div></td>
";
                    echo "    <td class=\"row1\"><input name=\"uid\" type=\"text\" id=\"uid\" value=\"" . $row['UID'] . "\"></td>
";
                    echo "  </tr>
";
                    echo "  <tr>
";
                    echo "    <td class=\"row2\"><strong>Timestamp:</strong></td>
";
                    echo "    <td class=\"row2\">" . $time . "</td>
";
                    echo "  </tr>
";
                    echo "  <tr>
";
                    echo "    <td class=\"row1\"><strong>IP:</strong></td>
";
                    echo "    <td class=\"row1\"><input name=\"ip\" type=\"text\" id=\"ip\" value=\"" . $row['IP'] . "\"></td>
";
                    echo "  </tr>
";
                    echo "  <tr>
";
                    echo "    <td valign=\"top\" class=\"row2\"><strong>Message Text: </strong></td>
";
                    echo "    <td valign=\"top\" class=\"row2\"><textarea name=\"msg\" cols=\"50\" rows=\"5\" id=\"msg\">" . $row['MSG'] . "</textarea></td>
";
                    echo "  </tr>
";
                    echo "  <tr>
";
                    echo "    <td colspan=\"2\" valign=\"top\">&nbsp;</td>
";
                    echo "    </tr>
";
                    echo "  <tr>
";
                    echo "    <td colspan=\"2\" valign=\"top\" class=\"row1\"><div style='text-align:center;'>
";
                    echo "      <input type=\"submit\" name=\"Submit\" value=\"Submit\">
";
                    echo "    </div></td>
";
                    echo "    </tr>
";
                    echo "</table>
";
                    echo "</form>
";
                }
            break;
            case "Delete":
                $result = $db->sql_query("DELETE FROM `" . $prefix . "_ctshout_shouts` WHERE `PID` = '" . $pid . "' LIMIT 1;");
                if ($result) {
                    echo "<div style='text-align:center;'>Shout Deleted!</div>
";
                } else {
                    echo "<div style='text-align:center;font-size:14px;'>Database Error!</div>
";
                }
            default:
                echo "  <table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
";
                echo "    <tr>
";
                echo "      <td colspan=\"5\" class='row2'><b>Shout Management </b></td>
";
                echo "    </tr>
";
                echo "    <tr class=\"cattitle\">
";
                echo "      <td width=\"15%\" class='row1'><div style='text-align:center;'>Timestamp</div></td>
";
                echo "      <td width=\"18%\" class='row1'><div style='text-align:center;'>Username</div></td>
";
                echo "      <td width=\"12%\" class='row1'><div style='text-align:center;'>IP</div></td>
";
                echo "      <td class='row1'><div style='text-align:center;'>Shout</div></td>
";
                echo "      <td width=\"15%\" class='row1'><div style='text-align:center;'>Options</div></td>
";
                echo "    </tr>
";
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
                    echo "<tr>
";
                    echo "      <td align=\"center\" class=\"row" . $rows . "\">" . $time . "</td>
";
                    echo "      <td align=\"center\" class=\"row" . $rows . "\">" . $row['UID'] . "</td>
";
                    echo "      <td align=\"center\" class=\"row" . $rows . "\">" . $row['IP'] . "</td>
";
                    echo "      <td class=\"row" . $rows . "\">" . $msg . "....</td>";
                    echo "      <td align=\"center\" valign=\"middle\" class=\"row" . $rows . "\"><form method=\"post\" action=\"" . $admin_file . ".php?op=CTShout_Shouts\">
";
                    echo "          <input name=\"pid\" type=\"hidden\" value=\"" . $row['PID'] . "\">
";
                    echo "          <input name=\"op2\" type=\"hidden\" value=\"PROCESS\">
";
                    echo "          <select name=\"option\" id=\"option\">
";
                    echo "            <option value=\"Show\" selected>Show</option>
";
                    echo "            <option value=\"Edit\">Edit</option>
";
                    echo "            <option value=\"Delete\">Delete</option>
";
                    echo "          </select>
";
                    echo "          <input type=\"submit\" name=\"Submit\" value=\"Go\">
";
                    echo "      </form></td>
";
                    echo "    </tr>
";
                }
                echo "    <tr>
";
                echo "      <td colspan=\"5\">&nbsp;</td>
";
                echo "    </tr>
";
                echo "    <tr>
";
                echo "      <td colspan=\"5\">Total Shouts: <strong>" . $scount . "</strong></td>
";
                echo "    </tr>
";
                echo "    <tr>
";
                echo "      <td colspan=\"5\"><div style='text-align:center;'><strong><a href=\"" . $admin_file . ".php?op=CTShout_ClearShouts\">Clear All Shouts</a></strong></div></td>
";
                echo "    </tr>
";
                echo "</table>
";
        }
    }
    function CTShout_welcome() {
        global $ThemeSel;
        if (file_exists("themes/$ThemeSel/images/CTShout.swf")) {
            echo "<div style='text-align:center;'>";
            echo "  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='170' height='330'>";
            echo "    <param name='movie' value='themes/$ThemeSel/images/CTShout.swf'><param name='quality' value='high'><param name='wmode' value='transparent'>";
            echo "    <embed src='themes/$ThemeSel/images/CTShout.swf' quality='high' wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='170' height='330'></embed>";
            echo "  </object>";
            echo "<script type=\"text/javascript\" src=\"modules/Clan_Themes_Shout/iefix.js\"></script>";
            echo "</div>";
        } else {
            echo "<div style='text-align:center;'>";
            echo "  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='170' height='330'>";
            echo "    <param name='movie' value='modules/Clan_Themes_Shout/CTShout.swf'><param name='quality' value='high'><param name='wmode' value='transparent'>";
            echo "    <embed src='modules/Clan_Themes_Shout/CTShout.swf' quality='high' wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='170' height='330'></embed>";
            echo "  </object>";
            echo "<script type=\"text/javascript\" src=\"modules/Clan_Themes_Shout/iefix.js\"></script>";
            echo "</div>";
        }
    }
    switch ($op) {
        case "CTShout_Config":
            CTShout_config($_POST['op2'], $_POST['anon'], $_POST['wordcensor'], $_POST['censorwords'], $_POST['autoprune'], $_POST['autoprunecount']);
        break;
        case "CTShout_ClearShouts":
            CTShout_clearShouts($_POST['choice'], $_POST['op2']);
        break;
        case "CTShout_Shouts":
            CTShout_shouts($_POST['pid'], $_POST['op2'], $_POST['option'], $_POST['uid'], $_POST['ip'], $_POST['msg']);
        break;
        case "CTShout_Install":
            CTShout_install($_POST['op2'], $_POST['choice'], $_POST['delexists']);
        break;
        case "CTShout_UnInstall":
            CTShout_uninstall($_POST['op2'], $_POST['choice']);
        break;
        case "CTShout_Shout":
        case "CTShout_Main":
        default:
            CTShout_welcome();
    }
    echo "</td>
  </tr>
</table>";
    CloseTable();
    OpenTable();
    echo "<div style='text-align:center;'><a target= \"_blank\" href='http://www.clan-themes.co.uk'><img src='modules/$module_name/images/88x31.gif' /><br /><br />Clan Themes, Making Clans Look Good!</a></div>";
    CloseTable();
    include ("footer.php");
} else {
    include ("header.php");
    OpenTable();
    echo "<div style='text-align:center;'><b>" . _ERROR . "</b><br /><br />You do not have administration permission for module \"$module_name\"</div>";
    CloseTable();
    include ("footer.php");
}