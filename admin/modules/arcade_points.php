<?php
/********************************************************/
/* Arcade Points                                        */
/* By: Telli (telli@codezwiz.com)                       */
/* http://www.codezwiz.com                              */
/* Copyright © 2002-2004 by Codezwiz.com                */
/********************************************************/
if (!eregi("admin.php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }
$result = $db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'");
list($radminsuper) = $db->sql_fetchrow($result);
if ($radminsuper==1) {
$sql = "SELECT * FROM ".$prefix."_arcade_config";
if(!$db->sql_query($sql)) header("location: admin.php?op=czarcade_points_install");
/*********************************************************/
/* Main                                                  */
/*********************************************************/
function CZArcadePoints () {
	global $bgcolor2, $bgcolor4, $prefix, $db;
 	include("header.php");
	GraphicAdmin();
	OpenTable();
	$aconf = array();
	$sql = "SELECT * FROM ".$prefix."_arcade_config";
	$result = $db->sql_query($sql);
	while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
		$aconf[$config_name] = $config_value;
	}
	echo "<center><font class=\"option\"><b>$sitename Arcade Points Configuration</b></font></center><br><br>"
	    ."<center><table border=\"1\" width=\"80%\"><tr>"
	    ."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>Name</b></td>"
	    ."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>Description</b></td>"
	    ."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>Value</b></td>";
	echo "<form action=\"admin.php\" method=\"post\">"
	    ."<tr>";
	echo "<td align=\"left\" nowrap>&nbsp;Arcade Open/Closed&nbsp;</td>"
	    ."<td align=\"left\">&nbsp;Open or close the arcade.</td>"
	    ."<td align=\"center\">&nbsp;\n";
	if($aconf['arcadestatus'] == "1"){
		$scl1 = "";
		$scl2 = "CHECKED";
	}
	else{
		$scl1 = "CHECKED";
		$scl2 = "";
	}
	echo "<input type='radio' name='arcadestatus' value='0' ".$scl1.">&nbsp;Open&nbsp;&nbsp;&nbsp;\n"
	    ."<input type='radio' name='arcadestatus' value='1' ".$scl2.">&nbsp;Closed</td></tr>\n";
      echo "<tr><td align=\"left\" nowrap>&nbsp;Arcade Closed Message&nbsp;</td>"
	    ."<td align=\"left\">&nbsp;Message users see's when arcade is closed.</td>"
	    ."<td align=\"center\">&nbsp;<textarea rows=\"3\" cols=\"20\" name=\"statusmessage\">$aconf[statusmessage]</textarea></td></tr>";
	echo "<tr><td align=\"left\" nowrap>&nbsp;Certain Amount to Play&nbsp;</td>"
	    ."<td align=\"left\">&nbsp;Set a certain amount that a user has to have to play games. This doesn't charge them just won't let them play any games unless they have over this point amount.</td>"
	    ."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$aconf[musthave]\" size=\"5\" name=\"musthave\">&nbsp;</td></tr>";
      echo "<tr><td align=\"left\" nowrap>&nbsp;Amount To Play Message&nbsp;</td>"
	    ."<td align=\"left\">&nbsp;Message users see's when they do not have the certain amount to play.</td>"
	    ."<td align=\"center\">&nbsp;<textarea rows=\"3\" cols=\"20\" name=\"musthavemess\">$aconf[musthavemess]</textarea></td></tr>";	
      echo "<tr><td align=\"left\" nowrap>&nbsp;Highest Score&nbsp;</td>"
	    ."<td align=\"left\">&nbsp;If a user sets the highest score.</td>"
	    ."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$aconf[highscore]\" size=\"5\" name=\"highscore\">&nbsp;</td></tr>"
	    ."<tr>";
	echo "<td align=\"left\" nowrap>&nbsp;Place in top 10.&nbsp;</td>"
	    ."<td align=\"left\">&nbsp;If a user places in the top 10.</td>"
	    ."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$aconf[topscore]\" size=\"5\" name=\"topscore\">&nbsp;</td></tr>"
	    ."<tr>";
	echo "<td align=\"left\" nowrap>&nbsp;Charge Per Game&nbsp;</td>"
	    ."<td align=\"left\">&nbsp;You can charge per game here.</td>"
	    ."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$aconf[pergame]\" size=\"5\" name=\"pergame\">&nbsp;</td></tr>";
      echo "<tr><td align=\"left\" nowrap>&nbsp;Per Game Message&nbsp;</td>"
	    ."<td align=\"left\">&nbsp;Message users see's when they do not have the point's to play.</td>"
	    ."<td align=\"center\">&nbsp;<textarea rows=\"3\" cols=\"20\" name=\"pergamemess\">$aconf[pergamemess]</textarea></td></tr>"
          ."<tr><td align=\"left\" nowrap>&nbsp;Show the Arcade Menu?</td>\n"
	    ."<td align=\"left\">&nbsp;Activate the Arcade menu on the forums index.</td>"
	    ."<td align=\"center\">&nbsp;\n";
	if($aconf['showmenu'] == "1"){
		$sam1 = "";
		$sam2 = "CHECKED";
	}
	else{
		$sam1 = "CHECKED";
		$sam2 = "";
	}
	echo "<input type='radio' name='showmenu' value='0' ".$sam1.">&nbsp;"._YES."&nbsp;&nbsp;&nbsp;\n"
		."<input type='radio' name='showmenu' value='1' ".$sam2.">&nbsp;"._NO."</td></tr>\n";
      echo "<tr><td align=\"left\" nowrap>&nbsp;Points Name<br /></td>"
	    ."<td align=\"left\">&nbsp;The exact name or your points system field.<br /><i>( user_points, points etc.)</i></td>";
      echo "<td align=\"center\">&nbsp;<input type=\"text\" name=\"pname\" value=\"$aconf[pname]\" size=\"25\"></td></tr></table><br />";
	echo "<center><table border=\"1\" width=\"80%\"><tr bgcolor=\"$bgcolor2\">";
      echo "<td align=\"center\" nowrap><font class=\"content\">"
	    ."<input type=\"hidden\" name=\"op\" value=\"czarcade_points_update\">"
	    ."<input type=\"submit\" value=\"Update\"></td></tr>";
	echo "</table></form><br /></center>";
	CloseTable();
      Showarcadepp();
	include("footer.php");
}
function czarcade_points_install()
    {
    global $prefix, $db;
	include("header.php");
	title("Arcade Points Auto Installer");
	opentable();
	echo "<b>Here are the results of the installation:</b><br><br>\n";
	$db->sql_query("CREATE TABLE ".$prefix."_arcade_config (config_name varchar(255) NOT NULL default '', config_value varchar(255) NOT NULL default '', PRIMARY KEY (config_name))"); 
      $db->sql_query("INSERT INTO ".$prefix."_arcade_config (config_name, config_value) VALUES ('arcadestatus', '0'), ('statusmessage', 'Arcade is currently closed!'), ('musthave', '0'), ('musthavemess', 'More point\'s are required to participate in the arcade games.'), ('highscore', '0'), ('topscore', '0'), ('pergame', '0'), ('pergamemess', 'You don\'t have enough point\'s to play this game!'), ('showmenu', '0'), ('pname', 'user_points')");
	echo "<b>Arcade Points has been successfully installed!<br><center> [ <a href=\"admin.php?op=CZArcadePoints\">Go Back </a> ]</center></b>";
	closetable();
      Showarcadepp();
	include("footer.php");
    }

// Dont mess with my work please
function Showarcadepp() {
echo "<br>";
Opentable();
echo"<div align=\"right\">Arcade Points Add-on © Telli <a href='http://codezwiz.com/'>Codezwiz</a></div>";
Closetable();
}

switch($op) {

    case "CZArcadePoints":
    CZArcadePoints();
    break;

    case "czarcade_points_update":
    $newaconfig = array();
    $newaconfig['arcadestatus'] = $arcadestatus;
    $newaconfig['statusmessage'] = $statusmessage;
    $newaconfig['musthave'] = $musthave;
    $newaconfig['musthavemess'] = $musthavemess;
    $newaconfig['highscore'] = $highscore;
    $newaconfig['topscore'] = $topscore;
    $newaconfig['pergame'] = $pergame;
    $newaconfig['pergamemess'] = $pergamemess;
    $newaconfig['showmenu'] = $showmenu;
    $newaconfig['pname'] = $pname;
    $result = $db->sql_query("SELECT * FROM ".$prefix."_arcade_config");
    while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
		$db->sql_query("UPDATE ".$prefix."_arcade_config SET config_value='".$newaconfig[$config_name]."' WHERE config_name='".$config_name."'");
	}
	header("Location: admin.php?op=CZArcadePoints");
	break;


    case "czarcade_points_install":
    czarcade_points_install();
    break;
}

} else {
    echo "Access Denied";
}

?>
