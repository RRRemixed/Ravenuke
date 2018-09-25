<?php
if (eregi("block-Random_Themes_Side.php", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}


// the only thing you might want to change on this block is the width of the images if your theme cant handle 150 pixels

// the actual size of the images on show are 413 x 692 they have been sized down to fit within nuke side blocks below are the settings to adjust it

$width="150";  //sets the width of the image
$height="251";  // sets the height of the image

//do not edit below unless you know what you are doing

$content = "<center><a title='Making Clans Look Good' target='_blank' href='http://www.clanthemes.com/shop.html'> <img onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src='http://www.clanthemes.com/modules/Digital_Shop/images/rotate.php' alt='Making Clans Look Good' width='$width' height='$height' border='0' alt=\"\" /><br /><br />

<a title='Making Clans Look Good' target='_blank' href='http://www.clanthemes.com/shop.html'> <img onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src='http://www.clanthemes.com/modules/Digital_Shop/images/rotate1.php' alt='Making Clans Look Good' width='$width' height='$height' border='0' alt=\"\" /><br /><br />

<a title='Making Clans Look Good' target='_blank' href='http://www.clanthemes.com/shop.html'> <img onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src='http://www.clanthemes.com/modules/Digital_Shop/images/rotate2.php' alt='Making Clans Look Good' width='$width' height='$height' border='0' alt=\"\" /><p><a title='Making Clans Look Good' target='_blank' href='http://www.clanthemes.com/'>Clan Themes, Making<br />Clans Look Good...</a></p></center>

<center><p align=\"center\"><b>Link To Us</b></p>
  <p align=\"center\">
  <a href=\"modules/Clan_Themes/files/clanthemes5.zip\">
  <img border=\"0\" onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src=\"modules/Clan_Themes/images/88x31.gif\" width=\"88\" height=\"31\" alt=\"\" /></a></p></center>";

  
?>