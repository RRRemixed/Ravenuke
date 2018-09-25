<?php

if ( !defined( "ADMIN_FILE" ) )
{
    exit( "Access Denied" );
}
$module_name = "Clan_Roster";

function versioncheck()
{
    $latestversion = "http://www.t3gamingcommunity.com/versions/crversion.txt";
    $installedversion = "Clan Roster 1.6";
    $upgradeurl = "http://www.clan-themes.co.uk/shop.html";
    $version = fopen($latestversion, "r");
    $versiondata = fgets($version);
    fclose($version);
    if ($installedversion < $versiondata)
    {
        echo "<center><b>{$installedversion}</b> is not the the latest version.<br />";
        echo "<b>Find Out More</b>&nbsp;<a href='{$upgradeurl}' target='blank'>{$upgradeurl}</a></center>";
    }
    else
    {
        echo "<center><b>{$installedversion}</b> is the latest version</center>";
    }
}

function crcopy()
{
    opentable();
    echo "<div align=\"right\">Clan Roster by <a href=\"http://www.t3gamingcommunity.com/\">Floppy</a></div>";
    echo "<div align=\"right\">Copyright &copy; 2006-2007 by T3 Gaming Community</div>";
    closetable();
}

function scale_size($filename, $max)
    {
    list( $width, $height, $type, $attr ) = getimagesize( $filename );
    if ($width <= $max && $height <= $max)
    {
        $return = array($width, $height);
    }
    else
    {
        $k = $height <= $width ? $width / $max : $height / $max;
        $width = floor($width / $k);
        $height = floor($height / $k);
        $return = array($width, $height);
    }
    return $return;
}

function thumb_img($image, $type, $imgdir, $destdir)
{
    $size = scale_size($imgdir."/".$image, 255);
    $thumbwidth = $size[0];
    $thumbheight = $size[1];
    $type = strtolower($type);
    if ($type == "jpeg" || $type == "jpg")
    {
        thumb_jpeg($image, $thumbwidth, $thumbheight, $imgdir, $destdir);
    }
    else if ($type == "png")
    {
        thumb_png($image, $thumbwidth, $thumbheight, $imgdir, $destdir);
    }
    else if ($type == "gif")
    {
        thumb_gif($image, $thumbwidth, $thumbheight, $imgdir, $destdir);
    }
    else
    {
        echo "<center>Sorry, only jpg, gif, and png files can be resized<br></center>";
    }
}

function thumb_jpeg( $image, $thumbwidth, $thumbheight, $spath, $dpath )
{
    $destimg = imagecreatetruecolor( $thumbwidth, $thumbheight );
    $srcimg = imagecreatefromjpeg( $spath."/".$image );
    imagecopyresized( $destimg, $srcimg, 0, 0, 0, 0, $thumbwidth, $thumbheight, imagesx( $srcimg ), imagesy( $srcimg ) );
    imagejpeg( $destimg, $dpath."/".$image );
}

function thumb_png( $image, $thumbwidth, $thumbheight, $spath, $dpath )
{
    $destimg = imagecreatetruecolor( $thumbwidth, $thumbheight );
    $srcimg = imagecreatefrompng( $spath."/".$image );
    imagecopyresized( $destimg, $srcimg, 0, 0, 0, 0, $thumbwidth, $thumbheight, imagesx( $srcimg ), imagesy( $srcimg ) );
    imagepng( $destimg, $dpath."/".$image );
}

function thumb_gif( $image, $thumbwidth, $thumbheight, $spath, $dpath )
{
    $destimg = imagecreatetruecolor( $thumbwidth, $thumbheight );
    $srcimg = imagecreatefromgif( $spath."/".$image );
    imagecopyresized( $destimg, $srcimg, 0, 0, 0, 0, $thumbwidth, $thumbheight, imagesx( $srcimg ), imagesy( $srcimg ) );
    imagejpeg( $destimg, $dpath."/".$image );
}

?>
