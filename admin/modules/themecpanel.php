<?PHP

if (!eregi("admin.php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }
global $prefix, $db;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1)

 { 

function themecpanel() { 
    include ("header.php");
    OpenTable();
    echo "<center><font class=\"title\"><b>Theme Control Panel</b><br /><br />[ <a href=admin.php>Main Admin</a> ]</font></center>";

    CloseTable();
    echo "<br />";
//theme links
    OpenTable();
    $result = $db->sql_query("SELECT link1name, link1url, link2name, link2url, link3name, link3url, link4name, link4url, link5name, link5url, link6name, link6url, link7name, link7url, link8name, link8url, link9name, link9url, link10name, link10url from ".$prefix."_themecpanel");
list($link1name, $link1url, $link2name, $link2url, $link3name, $link3url, $link4name, $link4url, $link5name, $link5url, $link6name, $link6url, $link7name, $link7url, $link8name, $link8url, $link9name, $link9url, $link10name, $link10url) = $db->sql_fetchrow($result);

  ///begin layout/// 
    echo "<center><font class='title'>This is where you set your themes header links.<br /><br /></font></center>"
	."<form action='admin.php' method='post'>"
	."<table border='0' align=center><tr><td>"
	."Link 1 Name:</td><td><input type='text' name='xlink1name' value='$link1name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 1 URL:</td><td><input type='text' name='xlink1url' value='$link1url' size='60' maxlength='500'>"
	."<hr /></td></tr><tr><td>"
	."Link 2 Name:</td><td><input type='text' name='xlink2name' value='$link2name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 2 URL:</td><td><input type='text' name='xlink2url' value='$link2url' size='60' maxlength='500'>"
	."<hr /></td></tr><tr><td>"
	."Link 3 Name:</td><td><input type='text' name='xlink3name' value='$link3name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 3 URL:</td><td><input type='text' name='xlink3url' value='$link3url' size='60' maxlength='500'>"
	."<hr /></td></tr><tr><td>"
	."Link 4 Name:</td><td><input type='text' name='xlink4name' value='$link4name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 4 URL:</td><td><input type='text' name='xlink4url' value='$link4url' size='60' maxlength='500'>"
	."<hr /></td></tr><tr><td>"
	."Link 5 Name:</td><td><input type='text' name='xlink5name' value='$link5name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 5 URL:</td><td><input type='text' name='xlink5url' value='$link5url' size='60' maxlength='500'>"
	."<hr /></td></tr><tr><td>"
	."Link 6 Name:</td><td><input type='text' name='xlink6name' value='$link6name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 6 URL:</td><td><input type='text' name='xlink6url' value='$link6url' size='60' maxlength='500'>"
	."<hr /></td></tr><tr><td>"
	."Link 7 Name:</td><td><input type='text' name='xlink7name' value='$link7name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 7 URL:</td><td><input type='text' name='xlink7url' value='$link7url' size='60' maxlength='500'>"
	."<hr /></td></tr><tr><td>"
	."Link 8 Name:</td><td><input type='text' name='xlink8name' value='$link8name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 8 URL:</td><td><input type='text' name='xlink8url' value='$link8url' size='60' maxlength='500'>"
	."<hr /></td></tr><tr><td>"
	."Link 9 Name:</td><td><input type='text' name='xlink9name' value='$link9name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 9 URL:</td><td><input type='text' name='xlink9url' value='$link9url' size='60' maxlength='500'>"
	."<hr /></td></tr><tr><td>"
	."Link 10 Name:</td><td><input type='text' name='xlink10name' value='$link10name' size='60' maxlength='500'>"
	."</td></tr><tr><td>"
	."Link 10 URL:</td><td><input type='text' name='xlink10url' value='$link10url' size='60' maxlength='500'>"
	."</td></tr><tr><td>";
	
// save
    echo "</td></tr></table><br /><br />";
    echo "<input type='hidden' name='op' value='themecpanelsave'>" //themecpanel save case
	."<center><input type='submit' value='Save Links'></center>"
	."</form>";
	 CloseTable();




//security start
    echo "<br />";
    OpenTable();
    $result = $db->sql_query("SELECT headertype, rightclick, rightclick1, top4, gtfooter from ".$prefix."_themecpanel");
	list($headertype, $rightclick, $rightclick1, $top4, $gtfooter) = $db->sql_fetchrow($result);
	
    echo "<center><font class=\"title\">Additonal theme options</font></center><br /><br />";
    echo"<form action='admin.php' method='post'>"
       ."<table border='0' width='100%' align='center' cellpadding='1' align='center'><tr><td>";
    
	echo "Type of Header to Show:</td><td>";
    if ($headertype==1) {
       echo "<input type='radio' name='xheadertype' value='1' checked>Image &nbsp;
	   		 <input type='radio' name='xheadertype' value='2'>Random Image &nbsp;
       		 <input type='radio' name='xheadertype' value='0'>Flash";
    }
	if ($headertype==2) {
       echo "<input type='radio' name='xheadertype' value='1'>Image &nbsp;
	   		 <input type='radio' name='xheadertype' value='2' checked>Random Image &nbsp;
        	 <input type='radio' name='xheadertype' value='0'>Flash";
    }
	if ($headertype==0) {
        echo "<input type='radio' name='xheadertype' value='1'>Image &nbsp;
			  <input type='radio' name='xheadertype' value='2'>Random Image &nbsp;
        	  <input type='radio' name='xheadertype' value='0' checked>Flash";
    }
    echo "</td></tr><tr><td>";
	
	echo "Disable Rightclick (User/Guest):</td><td>";
    if ($rightclick==1) {
       echo "<input type='radio' name='xrightclick' value='1' checked>Yes &nbsp;
        <input type='radio' name='xrightclick' value='0'>No";
    } else {
        echo "<input type='radio' name='xrightclick' value='1'>Yes &nbsp;
        <input type='radio' name='xrightclick' value='0' checked>No";
    }
    echo "</td></tr><tr><td>";

    echo "Disable Rightclick for Admins:</td><td>";
    if ($rightclick1==1) {
       echo "<input type='radio' name='xrightclick1' value='1' checked>Yes &nbsp;
        <input type='radio' name='xrightclick1' value='0'>No";
    } else {
        echo "<input type='radio' name='xrightclick1' value='1'>Yes &nbsp;
        <input type='radio' name='xrightclick1' value='0' checked>No";
    }
    echo "</td></tr><tr><td>";


    echo "Display Top Forums and Top News:</td><td>";
    if ($top4==1) {
       echo "<input type='radio' name='xtop4' value='1' checked>Yes &nbsp;
        <input type='radio' name='xtop4' value='0'>No";
    } else {
        echo "<input type='radio' name='xtop4' value='1'>Yes &nbsp;
        <input type='radio' name='xtop4' value='0' checked>No";
    }
	echo "</td></tr><tr><td>";


    echo "Display JQuery Sliding Footer:</td><td>";
    if ($gtfooter==1) {
       echo "<input type='radio' name='xgtfooter' value='1' checked>Yes &nbsp;
        <input type='radio' name='xgtfooter' value='0'>No";
    } else {
        echo "<input type='radio' name='xgtfooter' value='1'>Yes &nbsp;
        <input type='radio' name='xgtfooter' value='0' checked>No";
    }
	
    echo "</td></tr></table><br /><br />";

    echo "<center><input type='hidden' name='op' value='savesecurity'>";
    echo "<input type='submit' value='Save Scripts'></center></form><br /><p style='text-align:right;'>Coded by Ped, Help support <a href='http://www.clanthemes.com/article472-phpnuke-success-story.html' title='Piracy in PHPNuke' target='_blank'>piracy within PHPNuke</a> by linking directly to<br /> <a href='http://www.clanthemes.com' title='PHPNuke Themes' target='_blank'>www.clanthemes.com</a> and <a href='http://www.phpnukedownloads.com' title='PHPNuke Downloads' target='_blank'>www.phpnukedownloads.com</a> on your sites home page</p><br />";
    CloseTable();
    include("footer.php");

}

//save links
function themecpanelsave($xlink1name, $xlink1url, $xlink2name, $xlink2url, $xlink3name, $xlink3url, $xlink4name, $xlink4url, $xlink5name, $xlink5url, $xlink6name, $xlink6url, $xlink7name, $xlink7url, $xlink8name, $xlink8url, $xlink9name, $xlink9url, $xlink10name, $xlink10url) {
     global $prefix, $db, $module_name;

    $xlink1name = htmlentities($xlink1name, ENT_QUOTES);
    $xlink1url = htmlentities($xlink1url, ENT_QUOTES);
    $xlink2name = htmlentities($xlink2name, ENT_QUOTES);
    $xlink2url = htmlentities($xlink2url, ENT_QUOTES);
    $xlink3name = htmlentities($xlink3name, ENT_QUOTES);
    $xlink3url = htmlentities($xlink3url, ENT_QUOTES);
    $xlink4name = htmlentities($xlink4name, ENT_QUOTES);
    $xlink4url = htmlentities($xlink4url, ENT_QUOTES);
    $xlink5name = htmlentities($xlink5name, ENT_QUOTES);
    $xlink5url = htmlentities($xlink5url, ENT_QUOTES);
	$xlink6name = htmlentities($xlink6name, ENT_QUOTES);
    $xlink6url = htmlentities($xlink6url, ENT_QUOTES);
	$xlink7name = htmlentities($xlink7name, ENT_QUOTES);
    $xlink7url = htmlentities($xlink7url, ENT_QUOTES);
	$xlink8name = htmlentities($xlink8name, ENT_QUOTES);
    $xlink8url = htmlentities($xlink8url, ENT_QUOTES);
	$xlink9name = htmlentities($xlink9name, ENT_QUOTES);
    $xlink9url = htmlentities($xlink9url, ENT_QUOTES);
	$xlink10name = htmlentities($xlink10name, ENT_QUOTES);
    $xlink10url = htmlentities($xlink10url, ENT_QUOTES);

     $db->sql_query("UPDATE ".$prefix."_themecpanel SET 
	link1name='$xlink1name',
	link1url='$xlink1url',
	link2name='$xlink2name',
 	link2url='$xlink2url',
 	link3name='$xlink3name',
 	link3url='$xlink3url',
 	link4name='$xlink4name',
 	link4url='$xlink4url',
 	link5name='$xlink5name',
 	link5url='$xlink5url',
 	link6name='$xlink6name',
 	link6url='$xlink6url',
 	link7name='$xlink7name',
 	link7url='$xlink7url',
 	link8name='$xlink8name',
 	link8url='$xlink8url',
 	link9name='$xlink9name',
 	link9url='$xlink9url',
 	link10name='$xlink10name',
 	link10url='$xlink10url'", $db);	 
Header("Location: admin.php?op=themecpanel");
}
//save links end

//save security
function savesecurity($xheadertype, $xrightclick, $xrightclick1, $xtop4, $xgtfooter) {
     global $prefix, $db, $module_name;
     $db->sql_query("UPDATE ".$prefix."_themecpanel SET headertype='$xheadertype', rightclick='$xrightclick', rightclick1='$xrightclick1', top4='$xtop4', gtfooter='$xgtfooter'", $db);
Header("Location: admin.php?op=themecpanel");
}

//save security end




switch ($op) {
    case "themecpanel":
    themecpanel();
    break;
    case "themecpanelsave":
    themecpanelsave ($xlink1name, $xlink1url, $xlink2name, $xlink2url, $xlink3name, $xlink3url, $xlink4name, $xlink4url, $xlink5name, $xlink5url, $xlink6name, $xlink6url, $xlink7name, $xlink7url, $xlink8name, $xlink8url, $xlink9name, $xlink9url, $xlink10name, $xlink10url);
    break;
    case "savesecurity":
    savesecurity($xheadertype, $xrightclick, $xrightclick1, $xtop4, $xgtfooter);
    break;
}


}
else {
    echo "Access Denied";
}
?>
