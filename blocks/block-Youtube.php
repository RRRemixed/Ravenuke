<?php

if (eregi("block-Youtube.php",$_SERVER['PHP_SELF'])) {
    Header(" Location: index.php" );
   die();
}
global $prefix, $user,$username,$datetime ,$userinfo, $username, $cookie,$db ,$dbi;


$linkyoutube= "xC5uEe5OzNQ"; ///// Enter the code of the video


$content.= "<table style=\"border-collapse:collapse;\" align=\"center\" cellspacing=\"0\">
    <tr>
        <td width=\"100%\" style=\"border-width:1; border-color:black; border-style:none;\">
            <p align=\"center\"><object width=\"425\" height=\"344\"><param name=\"movie\" value=\"http://www.youtube.com/v/$linkyoutube&hl=it&fs=1&rel=0&color1=0x3a3a3a&color2=0x999999\"></param><param name=\"allowFullScreen\" value=\"true\"></param><embed src=\"http://www.youtube.com/v/$linkyoutube&hl=it&fs=1&rel=0&color1=0x3a3a3a&color2=0x999999\" type=\"application/x-shockwave-flash\" allowfullscreen=\"true\" width=\"425\" height=\"344\"></embed></object></p><p align=\"right\"><span style=\"font-size:8pt;\"><font face=\"Verdana\"><a href=\"http://www.clanthemes.com\"><b>PHPNuke</b></a></font></span></p>
        </td>
    </tr>
</table>";


?>