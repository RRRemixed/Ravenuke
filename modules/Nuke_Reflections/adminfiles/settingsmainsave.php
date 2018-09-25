<?php
// *************************************************
// This file is Part of Nuke_Reflections V1 Module by
// White_Devil of http://devil-modz.us
// E-Mail arleighesq@gmail.com

// Please do not remove any copyright notices
// Or modify beyond the main parts of this script

// Everything is pretty much Explained.
// *************************************************
if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}



if (!is_admin($admin)) {
	echo "<b><center>You are not an Admin. LEAVE NOW!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}


echo "<br><bR><center><strong>This is a save settings page. Error Page<br><br>";

$errorsystem = "";

$maximagesperpage = $maximagesperpage;
if ($maximagesperpage == "") {
	$errorsystem = "1";
}

$maxviewsize = $maxviewsize;
if ($maxviewsize == "") {
	$errorsystem = "1";
}



$thumbmaxsizecreate = $thumbmaxsizecreate;
if ($thumbmaxsizecreate == "") {
	$errorsystem = "1";
}

$waterstyle = $waterstyle;
if ($waterstyle == "") {
	$errorsystem = "1";
}


$watertext1 = devilcleanitup($watertext1);
$watertext2 = devilcleanitup($watertext2);


$waterimage = $waterimage;
if (!file_exists($waterimage) && $waterstyle == "3") {
$watermarkerror = "The watermark image was not found. Please fix or try again!";
}



$loginkiller = $loginkiller;
if ($loginkiller == "") {
	$errorsystem = "1";
}

$votingtimekiller = $votingtimekiller;
if ($votingtimekiller == "") {
	$errorsystem = "1";
}

$unapprovekill = $unapprovekill;
if ($unapprovekill == "") {
	$errorsystem = "1";
}

$killonxreports = $killonxreports;
if ($killonxreports == "") {
	$errorsystem = "1";
}

$tooltippicset = $tooltippicset;
if ($tooltippicset == "") {
	$errorsystem = "1";
}

$SoNTransferallowset = $SoNTransferallowset;
if ($SoNTransferallowset == "") {
	$errorsystem = "1";
}



$tooltipbackcolor = $tooltipbackcolor;
if ($tooltipbackcolor == "") {
	$errorsystem = "1";
}

$tooltiptextcolor = $tooltiptextcolor;
if ($tooltiptextcolor == "") {
	$errorsystem = "1";
}

$tooltipborder = $tooltipborder;
if ($tooltipborder == "") {
	$errorsystem = "1";
}

if ($errorsystem == "1") {
echo "There was an Error. Please go back and see what fields was left blank.<bR>
Only fields allowed to be left blank was watermark text.<br><br>";
closetable();
include_once("footer.php");
die;

}

if ($watermarkerror != NULL) {
echo "Watermark Image file not found. Please go back and put in a valid<br>
path to a watermarking image. Or unselect watermark option.<bR><br>";
closetable();
include_once("footer.php");
die;
}



$sql = "update " . $user_prefix . "_reflections_config set
loginkilltime='$loginkiller',

maxperpage='$maximagesperpage',
maxthumbsizegal='$maxviewsize',
config_thumbsize='$thumbmaxsizecreate',
watermark='$waterstyle',
watermark_text1='$watertext1',
watermark_text2='$watertext2',
watermarkimage='$waterimage',
tooltippic='$tooltippicset',
tooltipback='$tooltipbackcolor',
tooltiptext='$tooltiptextcolor',
tooltipbordercolor='$tooltipborder',
voterestriction='$votingtimekiller',
killfilereportedonmax='$unapprovekill',
filereportmax='$killonxreports',
SoNTransferallow='$SoNTransferallowset'
WHERE `configinfo` = 'configsys'";


            if (mysql_query($sql)) {
			echo "Updating File Information OK <img src='modules/$module_name/images/okyes.gif'>";
            } else {
			echo "Updating of File Information is NOT OK Contact Admin!<img src='modules/$module_name/images/okno.gif'>";
		echo "<bR><br>";
closetable();
include_once("footer.php");
die;
			}



/*



$loginkilltime = $row['$loginkiller'];
$maxperpage = $row['maxperpage'];
$maxthumbsizegal = $row['maxthumbsizegal'];
$config_thumbsize = $row['config_thumbsize'];
$watermark = $row['watermark'];
$watermark_text1 = $row['watermark_text1'];
$watermark_text1 = devilcleanitupfix($watermark_text1);
$watermark_text2 = $row['watermark_text2'];
$watermark_text2 = devilcleanitupfix($watermark_text2);
$watermarkimage = $row['watermarkimage'];
$tooltippic = $row['tooltippic'];
$tooltipback = $row['tooltipback'];
$tooltiptext = $row['tooltiptext'];
$tooltipbordercolor = $row['tooltipbordercolor'];
$voterestriction = $row['voterestriction'];
$killfilereportedonmax = $row['killfilereportedonmax'];
$filereportmax = $row['filereportmax'];
*/






header("Location: modules.php?name=$module_name&adminarea=settingsmain&somethinggood=saveok"); /* Redirect browser */





closetable();
include_once("footer.php");
die;






?>