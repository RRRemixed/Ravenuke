<?php

// Split the HTML color representation
$protect_string = $_GET['protect_string'];
$bgcolor = $_GET['bgcolor'];
$tcolor = $_GET['tcolor'];
function string_split($str, $nr){   
   return split("-l-", chunk_split($str, $nr, '-l-'));
}
$hexcolor1 = string_split($bgcolor, 2);
$hexcolor2 = string_split($tcolor, 2);

// Convert HEX values to DECIMAL
$bincolor1[0] = hexdec("0x{$hexcolor1[0]}");
$bincolor1[1] = hexdec("0x{$hexcolor1[1]}");
$bincolor1[2] = hexdec("0x{$hexcolor1[2]}");
$bincolor2[0] = hexdec("0x{$hexcolor2[0]}");
$bincolor2[1] = hexdec("0x{$hexcolor2[1]}");
$bincolor2[2] = hexdec("0x{$hexcolor2[2]}");
$font = 2;
$width = strlen($protect_string) * ImageFontWidth($font);
$height	= ImageFontHeight($font);
$im = imagecreate ($width,$height);
//Create background
$background_color = ImageColorAllocate($im, "$bincolor1[0]", "$bincolor1[1]", "$bincolor1[2]"); 
//Create Text
$text_color = ImageColorAllocate($im, "$bincolor2[0]", "$bincolor2[1]", "$bincolor2[2]");
imagestring ($im, $font, 0, 0,  $protect_string, $text_color);
imagejpeg ($im);
ImageDestroy($im);
?>