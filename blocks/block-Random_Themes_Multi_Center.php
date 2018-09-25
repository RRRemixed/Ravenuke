<?php

if (eregi("block-Random_Themes_Multi_Center.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}


// the only thing you might want to change on this block is the width of the images if your theme cant handle 150 pixels

// the actual size of the images on show are 413 x 692 they have been sized down to fit within nuke side blocks below are the settings to adjust it

$width="150";  //sets the width of the image
$height="251";  // sets the height of the image

//do not edit below unless you know what you are doing

$content  =  "<div align=\"center\">";
$content  .= " <table border=\"0\" cellpadding=\"4\" style=\"border-collapse: collapse\" width=\"100%\" cellspacing=\"4\">";
$content  .= "   <tr>";
$content  .= "     <td>";
$content  .= "     <p align=\"center\">";
$content  .= "     <a title=\"Making Clans Look Good\" target=\"_blank\" href=\"http://www.clanthemes.com/shop.html\">";
$content  .= "     <img border=\"0\" onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src=\"http://www.clanthemes.com/modules/Digital_Shop/images/rotate.php\" width=\"$width\" height=\"$height\" border=\"0\" alt=\"\" /></a></td>";
$content  .= "     <td>";
$content  .= "     <p align=\"center\">";
$content  .= "     <a title=\"Making Clans Look Good\" target=\"_blank\" href=\"http://www.clanthemes.com/shop.html\">";
$content  .= "     <img border=\"0\" onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src=\"http://www.clanthemes.com/modules/Digital_Shop/images/rotate1.php\" width=\"$width\" height=\"$height\" border=\"0\" alt=\"\" /></a></td>";
$content  .= "   </tr>";
$content  .= "   <tr>";
$content  .= "     <td>";
$content  .= "     <p align=\"center\">";
$content  .= "     <a title=\"Making Clans Look Good\" target=\"_blank\" href=\"http://www.clanthemes.com/shop.html\">";
$content  .= "     <img border=\"0\" onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src=\"http://www.clanthemes.com/modules/Digital_Shop/images/rotate2.php\" width=\"$width\" height=\"$height\" border=\"0\" alt=\"\" /></a></td>";
$content  .= "     <td>";
$content  .= "     <p align=\"center\">";
$content  .= "     <a title=\"Making Clans Look Good\" target=\"_blank\" href=\"http://www.clanthemes.com/shop.html\">";
$content  .= "     <img border=\"0\" onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src=\"http://www.clanthemes.com/modules/Digital_Shop/images/rotate3.php\" width=\"$width\" height=\"$height\" border=\"0\" alt=\"\" /></a></td>";
$content  .= "   </tr>";
$content  .= " </table>";
$content  .= "</div>";
$content  .= "<p align=\"center\"><a target=\"_blank\" href=\"http://www.clanthemes.com/\"> ";
$content  .= "Clan Themes, Making Clans Look Good, Come And See Our Awesome Themes !<br />We Make Custom And Commercial Themes Made To Order</a></p>";
$content  .= "<center><p align=\"center\"><b>Link To Us</b></p>";
$content  .= " <p align=\"center\">";
$content  .= " <a href=\"modules/Clan_Themes/files/clanthemes1.zip\">";
$content  .= " <img border=\"0\" onMouseover=\"slowhigh(this)\" onMouseout=\"slowlow(this)\" src=\"modules/Clan_Themes/images/clanthemes1.gif\" width=\"468\" height=\"60\" alt=\"\" /></a></p></center>";



?>