<?php
if (eregi("block-Random_Themes_Side.php", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}


// the only thing you might want to change on this block is the width of the images if your theme cant handle 150 pixels

// the actual size of the images on show are 413 x 692 they have been sized down to fit within nuke side blocks below are the settings to adjust it

$width="413";  //sets the width of the image
$height="692";  // sets the height of the image

//do not edit below unless you know what you are doing

$content = "<center><a title='Making Clans Look Good' target='_blank' href='http://www.clanthemes.com/shop.html'> <img onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src='http://www.clanthemes.com/modules/Digital_Shop/images/rotate.php' alt='Making Clans Look Good' width='$width' height='$height' border=\"0\" alt=\"\" /><p><a title='Making Clans Look Good' target='_blank' href='http://www.clanthemes.com/'>Clan Themes, Making Clans Look Good<br />Come And See Our Awesome Themes !</a></p></center>";

?>