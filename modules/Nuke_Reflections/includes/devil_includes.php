<?php
// check text boxes and text area's for html and ' "
function devilcleanitup($information)
{
    // &#039;
    // &quot;
    $information = strip_tags($information);
    $information = str_replace("\"", "&quot;", $information);
    $information = str_replace("'", "&#039;", $information);
    return $information;
}

function devilcleanitupfix($information)
{
    // &#039;
    // &quot;
    $information = str_replace("&quot;", "\"", $information);
    $information = str_replace("&#039;", "'", $information);
    return $information;
}

function wdcreatetgalhumb($name, $filename, $new_w, $new_h)
{
    $system = explode(".", $name);
    if (preg_match("/jpg|JPG|JPEG|jpeg/", $system[1])) {
        $src_img = imagecreatefromjpeg($name);
    }
    if (preg_match("/gif|GIF/", $system[1])) {
        $src_img = imagecreatefromgif($name);
    }
    $old_x = imageSX($src_img);
    $old_y = imageSY($src_img);

    $dst_img = ImageCreateTrueColor($new_w, $new_h);
    imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, $old_x, $old_y);
    if (preg_match("/gif|GIF/", $system[1])) {
        imagegif($dst_img, $filename);
    } else {
        imagejpeg($dst_img, $filename);
    }
    imagedestroy($dst_img);
    imagedestroy($src_img);
}

function wdresizeinfo($filename, $target)
{
if (file_exists($filename)) {


    $mysock = getimagesize("$filename");
    $width = $mysock[0];
    $height = $mysock[1];
    if ($width > $target || $height > $target) {
        if ($width > $height) {
            $percentage = ($target / $width);
        } else {
            $percentage = ($target / $height);
        }
        // gets the new value and applies the percentage, then rounds the value
        $width = round($width * $percentage);
        $height = round($height * $percentage);

        $imgSizeArray[0] = $width;
        $imgSizeArray[1] = $height;
        $imgSizeArray[2] = $mysock[0];
        $imgSizeArray[3] = $mysock[1];
    } else {
        $imgSizeArray[0] = $width;
        $imgSizeArray[1] = $height;
        $imgSizeArray[2] = $mysock[0];
        $imgSizeArray[3] = $mysock[1];
    }
    return $imgSizeArray;
    } else {
	        $imgSizeArray[0] = "100";
        $imgSizeArray[1] = "100";
        $imgSizeArray[2] = "100";
        $imgSizeArray[3] = "100";
      return $imgSizeArray;
	}
}
// watermarking....
function makewatermark($filename, $text1, $text2)
{
    $lst = GetImageSize($filename);
    $image_width = $lst[0];
    $image_height = $lst[1];
    $image_format = $lst[2];

    if ($image_format == 1) {
        $old_image = imagecreatefromgif($filename);
    } elseif ($image_format == 2) {
        $old_image = imagecreatefromjpeg($filename);
    } elseif ($image_format == 3) {
        $old_image = imagecreatefrompng($filename);
    }

    $text_color = imagecolorallocate ($old_image, 255, 255, 255);
    $texttext = $text1;
    $text_height = imagefontheight(3);
    $text_width = strlen($texttext) * imagefontwidth(3);

    $wt_y = $image_height - $text_height-10;
    $wt_x = $image_width - $text_width-10;

    imagestring($old_image, 3, $wt_x, $wt_y, $texttext, $text_color);

    $texttext = $text2;
    $text_height = imagefontheight(3);
    $text_width = strlen($texttext) * imagefontwidth(3);

    $wt_y = $image_height - $text_height-0;
    $wt_x = $image_width - $text_width-0;

    imagestring($old_image, 3, $wt_x, $wt_y, $texttext, $text_color);

    $text_color = imagecolorallocate ($old_image, 255, 0, 0);
    $texttext = $text1;
    $text_height = imagefontheight(3);
    $text_width = strlen($texttext) * imagefontwidth(3);

    $wt_y = $image_height - $text_height-10.5;
    $wt_x = $image_width - $text_width-10.5;

    imagestring($old_image, 3, $wt_x, $wt_y, $texttext, $text_color);

    $texttext = $text2;
    $text_height = imagefontheight(3);
    $text_width = strlen($texttext) * imagefontwidth(3);

    $wt_y = $image_height - $text_height-0.5;
    $wt_x = $image_width - $text_width-0.5;

    imagestring($old_image, 3, $wt_x, $wt_y, $texttext, $text_color);

    if ($image_format == 1) {
        imageGif($old_image, $filename);
    }
    if ($image_format == 2) {
        imageJpeg($old_image, $filename);
    }
    if ($image_format == 3) {
        imagePng($old_image, $filename);
    }

    imagedestroy($old_image); // destroy contents of $im
    // imagedestroy($filename);     // destroy contents of $im
    $hot = "<img src=\"$filename\">";

    return $hot;
}

function makewatermark1($filename, $text1, $text2, $imagetype)
{
    require_once("mainfile.php");
    global $module_name, $user, $cookie, $prefix, $db, $user_prefix, $row, $admin;
    $lst = GetImageSize($filename);
    $image_width = $lst[0];
    $image_height = $lst[1];
    $image_format = $lst[2];
    if ($image_format == 1) {
        $image = imagecreatefromgif($filename);
    } elseif ($image_format == 2) {
        $image = imagecreatefromjpeg($filename);
    } elseif ($image_format == 3) {
        $image = imagecreatefrompng($filename);
    }

    if ($imagetype == "thumbnail") {
        $font = "modules/$module_name/fonts/bold.ttf";
        $clr_white = imagecolorallocate($image, 255, 255, 255);
        $clr_red = imagecolorallocate ($image, 0, 0, 0);
        $size = 9;
        $angle = 0;
        $bbox = imagettfbbox ($size, $angle, $font, $text1);
        $bbox["left"] = 0 - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["top"] = 0 - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        $bbox["width"] = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]) - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["height"] = max($bbox[1], $bbox[3], $bbox[5], $bbox[7]) - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        extract ($bbox, EXTR_PREFIX_ALL, 'bb');
        // check width of the image
        $width = $image_width;
        $height = $image_height;
        $pad = 16;
        imagettftext($image, $size, $angle, $width / 2 - $bb_width / 2 + 2, $height - $bb_height - $pad + 2, $clr_red, $font, $text1);
        $size = 9;
        $angle = 0;
        $bbox = imagettfbbox ($size, $angle, $font, $text2);
        $bbox["left"] = 0 - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["top"] = 0 - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        $bbox["width"] = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]) - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["height"] = max($bbox[1], $bbox[3], $bbox[5], $bbox[7]) - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        extract ($bbox, EXTR_PREFIX_ALL, 'bb');
        // check width of the image
        $width = $image_width;
        $height = $image_height;
        $pad1 = 0;
        imagettftext($image, $size, $angle, $width / 2 - $bb_width / 2 + 2, $height - $bb_height - $pad1 + 2, $clr_red, $font, $text2);

        $size = 9;
        $angle = 0;
        $bbox = imagettfbbox ($size, $angle, $font, $text1);
        $bbox["left"] = 0 - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["top"] = 0 - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        $bbox["width"] = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]) - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["height"] = max($bbox[1], $bbox[3], $bbox[5], $bbox[7]) - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        extract ($bbox, EXTR_PREFIX_ALL, 'bb');
        // check width of the image
        $width = $image_width;
        $height = $image_height;
        $pad = 16;
        imagettftext($image, $size, $angle, $width / 2 - $bb_width / 2, $height - $bb_height - $pad, $clr_white, $font, $text1);
        $size = 9;
        $angle = 0;
        $bbox = imagettfbbox ($size, $angle, $font, $text2);
        $bbox["left"] = 0 - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["top"] = 0 - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        $bbox["width"] = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]) - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["height"] = max($bbox[1], $bbox[3], $bbox[5], $bbox[7]) - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        extract ($bbox, EXTR_PREFIX_ALL, 'bb');
        // check width of the image
        $width = $image_width;
        $height = $image_height;
        $pad1 = 0;
        imagettftext($image, $size, $angle, $width / 2 - $bb_width / 2, $height - $bb_height - $pad1, $clr_white, $font, $text2);
    }
    if ($imagetype == "fullsize") {
        $font = "modules/$module_name/fonts/bold.ttf";
        $clr_white = imagecolorallocate($image, 255, 255, 255);
        $clr_red = imagecolorallocate ($image, 0, 0, 0);
        $size = 15;
        $angle = 0;
        $bbox = imagettfbbox ($size, $angle, $font, $text1);
        $bbox["left"] = 0 - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["top"] = 0 - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        $bbox["width"] = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]) - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["height"] = max($bbox[1], $bbox[3], $bbox[5], $bbox[7]) - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        extract ($bbox, EXTR_PREFIX_ALL, 'bb');
        // check width of the image
        $width = $image_width;
        $height = $image_height;
        $pad = 25;
        imagettftext($image, $size, $angle, $width - $bb_width-3, $height - $bb_height - $pad + 2, $clr_red, $font, $text1);
        $size = 15;
        $angle = 0;
        $bbox = imagettfbbox ($size, $angle, $font, $text2);
        $bbox["left"] = 0 - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["top"] = 0 - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        $bbox["width"] = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]) - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["height"] = max($bbox[1], $bbox[3], $bbox[5], $bbox[7]) - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        extract ($bbox, EXTR_PREFIX_ALL, 'bb');
        // check width of the image
        $width = $image_width;
        $height = $image_height;
        $pad1 = 0;
        imagettftext($image, $size, $angle, $width - $bb_width-3, $height - $bb_height - $pad1 + 2, $clr_red, $font, $text2);

        $size = 15;
        $angle = 0;
        $bbox = imagettfbbox ($size, $angle, $font, $text1);
        $bbox["left"] = 0 - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["top"] = 0 - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        $bbox["width"] = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]) - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["height"] = max($bbox[1], $bbox[3], $bbox[5], $bbox[7]) - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        extract ($bbox, EXTR_PREFIX_ALL, 'bb');
        // check width of the image
        $width = $image_width;
        $height = $image_height;
        $pad = 25;
        imagettftext($image, $size, $angle, $width - $bb_width-5, $height - $bb_height - $pad, $clr_white, $font, $text1);
        $size = 15;
        $angle = 0;
        $bbox = imagettfbbox ($size, $angle, $font, $text2);
        $bbox["left"] = 0 - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["top"] = 0 - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        $bbox["width"] = max($bbox[0], $bbox[2], $bbox[4], $bbox[6]) - min($bbox[0], $bbox[2], $bbox[4], $bbox[6]);
        $bbox["height"] = max($bbox[1], $bbox[3], $bbox[5], $bbox[7]) - min($bbox[1], $bbox[3], $bbox[5], $bbox[7]);
        extract ($bbox, EXTR_PREFIX_ALL, 'bb');
        // check width of the image
        $width = $image_width;
        $height = $image_height;
        $pad1 = 0;
        imagettftext($image, $size, $angle, $width - $bb_width-5, $height - $bb_height - $pad1, $clr_white, $font, $text2);
    }

    if ($image_format == 1) {
        imageGif($image, $filename);
    }
    if ($image_format == 2) {
        imageJpeg($image, $filename);
    }
    if ($image_format == 3) {
        imagePng($image, $filename);
    }

    imagedestroy($image); // destroy contents of $im
    // imagedestroy($filename);     // destroy contents of $im
    $hot = "<img src=\"$filename\">";

    return $hot;
}

function waterMarkimage($fileInHD, $wmFile, $transparency = 60, $margin = 5)
{


    $wmImg = imageCreateFromGIF($wmFile);
    $lst = GetImageSize($fileInHD);
    $image_width = $lst[0];
    $image_height = $lst[1];
    $image_format = $lst[2];
    if ($image_format == 1) {
        $jpegImg = imagecreatefromgif($fileInHD);
    } elseif ($image_format == 2) {
        $jpegImg = imagecreatefromjpeg($fileInHD);
    } elseif ($image_format == 3) {
        $jpegImg = imagecreatefrompng($fileInHD);
    }
    // Water mark random position
    // $wmX = (bool)rand(0,1) ? $margin : (imageSX($jpegImg) - imageSX($wmImg)) - $margin;
    // $wmY = (bool)rand(0,1) ? $margin : (imageSY($jpegImg) - imageSY($wmImg)) - $margin;
    $wmX = (imageSX($jpegImg) - imageSX($wmImg) - $margin);
    $wmY = (imageSY($jpegImg) - imageSY($wmImg) - $margin);
    // Water mark process
    imageCopyMerge($jpegImg, $wmImg, $wmX, $wmY, 0, 0, imageSX($wmImg), imageSY($wmImg), $transparency);
    // Overwriting image
    if ($image_format == 1) {
        imageGif($jpegImg, $fileInHD);
    }
    if ($image_format == 2) {
        imageJpeg($jpegImg, $fileInHD);
    }
    if ($image_format == 3) {
        imagePng($jpegImg, $fileInHD);
    }
}




function checkremovallogins1(){
    global $loginkilltime, $module_name, $user, $cookie, $prefix, $db, $user_prefix, $row, $admin;

$killlogintime = $loginkilltime;
$past10 = time() - $killlogintime;
$sql = "DELETE FROM " . $prefix . "_reflections_logins WHERE rawtime < $past10";
$db->sql_query($sql);
$row12 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_logins WHERE username='$cookie[1]'"));
$checklogin = $row12['id'];
if ($checklogin != "") {
	$cooltime = time();
$db->sql_query("update " . $user_prefix . "_reflections_logins set rawtime='$cooltime' where username='$cookie[1]'");

}


}






function versioncheck() {
global $NRVersion;
echo "<strong><br><hr>Version Checking System.</strong>";
$latestversion = "http://devil-modz.us/versions/nrversion.txt";
$installedversion = $NRVersion;
$upgradeurl = "http://devil-modz.us";
$version = fopen($latestversion, 'r');
$versiondata = fgets($version);
fclose($version);
if($versiondata != $installedversion){
echo "<br><b>$installedversion</b> is not the the latest version.<br />";
echo "<b>Find Out More</b>&nbsp;<a href='$upgradeurl' target='blank'>$upgradeurl</a>";
}else{
echo "<br><b>$installedversion</b> is the latest version";
}
echo "<hr><br>";
}




	function getparent1($daparentid,$daname) {
		global $prefix, $db;
		echo "called";
		$daparentid = intval(trim($daparentid));
		$row = $db->sql_fetchrow($db->sql_query("SELECT * from " . $prefix . "_reflections_gallery where galid='$daparentid'"));
		$daownerid = intval($row['galid']);
		$daownername = $row['name'];
		$daownerparent = $row['parentid'];
		if ($daownername=="$daname") $daname=$daname;
		elseif (!empty($daownername)) $daname=$daownername."/".$daname;
		if ($daownerparent!=0) {
			$daname=getparent1($daownerparent,$daname);
		}
		return $daname;
	}



?>