<?php
/********************************************************/
/* Donations for PHP-Nuke                               */
/* Version Universal 3.0  06-06                         */
/* By: Telli (telli@codezwiz.com)                       */
/* http://codezwiz.com/                                 */
/* Copyright © 2000-2006 by Codezwiz                    */
/********************************************************/
/********************************************************/
/* Graphic Meter Code written by Adam Crownoble         */
/* adam@obleDesign.com                                  */
/********************************************************/ 

if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php"); 
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

define('INDEX_FILE', true);
$index = 1;

    $czdmconf = array();
    $result = $db->sql_query("SELECT * FROM ".$prefix."_donators_config");
    while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
		$czdmconf[$config_name] = $config_value;
    }

function received($uid) {
    global $db, $prefix;
    if (is_numeric($uid)) { 
      $uid = intval($uid); 
    } 
  if ($uid == "Guest") {
    include("header.php");
    opentable();
    echo "<center><br /><br />\n";
    echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\" border=\"0\">"
	  ."<tr bgcolor=\"$bgcolor2\"><td width='100%'><strong>"._THANKYOU."</strong><br /></td></tr></table>";
    echo "<br /><br />\n";
    closetable();
    include("footer.php");
       Header("Refresh: 8; url=index.php");
  } elseif ($uid != "") { 
    include("header.php");
    $sql = "SELECT username FROM ".$prefix."_users where user_id='$uid'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $name = $row['username'];
    opentable();
    echo "<center><br /><br />\n";
    echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\" border=\"0\">"
	  ."<tr bgcolor=\"$bgcolor2\"><td width='100%'><strong>$name, "._THANKYOUREG."</strong><br /></td></tr></table>";
    echo "<br /><br />\n";
    closetable();
    include("footer.php");
       Header("Refresh: 8; url=index.php");
  } else {
       Header("Location: index.php");
  }
}

function view_all() {
    	global $db, $prefix, $czdmconf, $pagenum, $module_name;
    	$donnum = 10;
    	if ($pagenum == "") { $pagenum = 1; }
    	$offset = ($pagenum-1) * $donnum;
    	include("header.php");
    	title("All Donations");
    	//Currency
    	if (($czdmconf['dcurrcode'] == "USD") OR ($czdmconf['dcurrcode'] == "AUD") OR ($czdmconf['dcurrcode'] == "CAD")) { 
      	$currsymbol = "$";
    	} elseif ($czdmconf['dcurrcode'] == "EUR") { 
      	$currsymbol = "€";
    	} elseif ($czdmconf['dcurrcode'] == "GBP") { 
      	$currsymbol = "£";
    	} elseif ($czdmconf['dcurrcode'] == "JPY") {
      	$currsymbol = "¥";
    	} else {
      	$currsymbol = "$";
    	}  
    	OpenTable(); 
   	$dons = "";
    	$result = $db->sql_query("SELECT uid, uname, fname, donated, dondate FROM ".$prefix."_donators WHERE donshow='1' ORDER by id DESC LIMIT $offset, $donnum");
    	$num = $db->sql_numrows($result);
	if ($num > 0) {
    		echo "<strong><u>"._ALLDONATIONS.":</strong></u><br />\n";
    		while ($row = $db->sql_fetchrow($result)) {
    			$uname = check_html($row['uname'], "nohtml");
    			$uname = ucfirst(strtolower($uname));
    			$fname = check_html($row['fname'], "nohtml");
    			$uid = intval($row['uid']);
    			if ($czdmconf['dshowpay'] == 1) {
        			$donated = " - ".$currsymbol."".$row['donated'];
    			} else { 
        			$donated = ""; 
    			}
    			$dondate = $row['dondate'];
      		if ($uname == "Guest") {
          			$donator = "Guest";
      		} else {
          			$donator = "<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname'>$uname</a>"; 
      		}
    			$dons .= "$donator <small>($dondate$donated)</small><br />\n";
    		}
    		echo $dons;
		$numdons = $db->sql_numrows($db->sql_query("SELECT * FROM {$prefix}_donators"));
		$numpages = ceil($numdons / $donnum);
		if ($numpages > 1) {
			echo "<br /><center>$numdons Donator(s) ($numpages page(s), $donnum per page)<br>";
			if ($pagenum > 1) {
				$prevpage = $pagenum - 1;
				$leftarrow = "modules/$module_name/images/left.gif";
				echo "<a href=\"modules.php?name=$module_name&amp;op=view_all&amp;pagenum=$prevpage\">";
				echo "<img src=\"$leftarrow\" align=\"absmiddle\" border=\"0\" hspace=\"10\"></a>";
			}
			echo "[ ";
			for ($i=1; $i < $numpages+1; $i++) {
				if ($i == $pagenum) {
					echo "<strong>$i</strong>";
				} else {
					echo "<a href=\"modules.php?name=$module_name&amp;op=view_all&amp;pagenum=$i\">$i</a>";
				}
				if ($i < $numpages) { echo " | "; } else { echo " ]"; }
			}
			if ($pagenum < $numpages) {
				$nextpage = $pagenum + 1;
				$rightarrow = "modules/$module_name/images/right.gif";
				echo "<a href=\"modules.php?name=$module_name&amp;op=view_all&amp;pagenum=$nextpage\">";
				echo "<img src=\"$rightarrow\" align=\"absmiddle\" border=\"0\" hspace=\"10\"></a>";
			}
			echo "</center>";
            	echo "<br />"; 
		}
    		$db->sql_freeresult($result);
	} else {
    		echo "<center><strong>"._NODONATORSYET."</strong><br /><br />"._GOBACK."</center>\n";
	}
    	CloseTable(); 
    	include("footer.php");
}
  
function meter() {
	global $db, $prefix, $czdmconf;
      list($progress) = $db->sql_fetchrow($db->sql_query("SELECT SUM(donated) FROM {$prefix}_donators WHERE donmonth='".date("m")."' AND donyear='".date("Y")."'"));
	$goal = $czdmconf[strtolower(date("F"))];
 	if($progress && $goal) { $temp = $progress / $goal; }
	// Image dimensions
 	if(!$w = $_GET['w']) { $w = 45; }
 	if(!$h = $_GET['h']) { $h = 175; }

 	// Border
 	$border_w = 1;

 	// Tube Dimensions
 	$tube_w_ratio = .6;
 	$tube_w = $w * $tube_w_ratio;
 	$tube_h = $h - ($w);
 	$tube_l = ($w - $tube_w) / 2;
 	$tube_r = $w - $tube_l;
 
 	// Ball Dimensions
	$ball_w = $w;
 	$ball_cnt_x = $ball_w / 2;
 	$ball_cnt_y = $h - ($ball_cnt_x);
 
 	// Marks
 	$mark_num = 10;
 	$mark_w_min_ratio = .15;
 	$mark_w_max_ratio = .3;
 	$mark_w_min = $tube_w * $mark_w_min_ratio;
 	$mark_w_max = $tube_w * $mark_w_max_ratio;
 	$mark_spacing = $tube_h / $mark_num;

 	// Image
 	$img = imagecreatetruecolor($w,$h);
 
 	// Settings
 	imageantialias($img,true);
 	imagesetthickness($img,$border_w);
 
 	// Colors
 	$black = imagecolorallocate($img, 0, 0, 0);
 	$white = imagecolorallocate($img, 255, 255, 255);
 	$gray = imagecolorallocate($img, 225, 225, 225);
 	$red = imagecolorallocate($img, 190, 0, 0);
 
 	// Background
 	//imagefilledrectangle($img, 0, 0, $w, $h, $white);
 
 	// Draw Tube
 	imagefilledrectangle($img, $tube_l, 0, $tube_r, $tube_h, $gray);
 	// Top
 	imageline($img, $tube_l, 0, $tube_r, 0, $black);
 	// Left
 	imageline($img, $tube_l, 0, $tube_l, $tube_h + ($ball_w / 2), $black);
 	// Right
 	imageline($img, $tube_r, 0, $tube_r, $tube_h + ($ball_w / 2), $black);
	// Draw Ball
 	imagefilledellipse($img, $ball_cnt_x, $ball_cnt_y, $ball_w, $ball_w, $red);
 	imageellipse($img, $ball_cnt_x, $ball_cnt_y, $ball_w, $ball_w, $black);
 	// Draw Mercury
 	imagefilledrectangle($img, $tube_l + $border_w, $tube_h - ($tube_h * $temp), $tube_r - $border_w, $tube_h + ($ball_w / 2) + $border_w, $red);
	// Draw Marks
 	for($i = 1; $i <= $mark_num; $i++) {
		if (1&$i) {
   			$mark_w = $mark_w_min;
  		} else {
   			$mark_w = $mark_w_max;
  		}
		imageline($img, $tube_l, $mark_spacing * $i,$tube_l + $mark_w, $mark_spacing * $i, $black);
 	}
 	header("Content-type: image/png");
 	imagepng($img);
 	imagedestroy($img);
}

switch($op) {

    case "received":
    received($uid);
    break;

    case "meter":
    meter();
    break;

    default:
    view_all();
    break;
}
?>
