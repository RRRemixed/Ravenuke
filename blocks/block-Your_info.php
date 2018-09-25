<?php
######################################
#                                    #
# Your Info block 1.0 for PHP-NUKE   #
# Copyright (c) 2003 by Dutchies     #
# http://www.dutchies.be             #
# http://www.autoclubrize.com        #
#                                    #
# file: blocks/block-your_info.php   #
#                                    #
######################################

if (eregi("block-your_info.php", $PHP_SELF)) {Header("Location: index.php");
die();
}
global $user, $cookie, $user_prefix, $bgcolor1, $bgcolor2, $bgcolor3;

cookiedecode($user);
$ip = $_SERVER["REMOTE_ADDR"];
$username = $cookie[1];
if ($username == "") {$username = "Anonymous";}

$isphash = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$ispstr = preg_split("/\./", $isphash);
$xy = count($ispstr);
$x = $xy - 1;
$y = $xy - 2;
$i = $xy - 3;
$pc  = "" . $ispstr[$i] . "";
$isp = "" . $ispstr[$y] . "." . $ispstr[$x] . "";
$ip  = "" . $_SERVER['REMOTE_ADDR'] . "";

$content .= "<center><img src=images/who_online/online.gif></center>";
$content .= "<center><table border=\"0\" cellspacing=\"1\" width=\"98%\"  align=\"center\">
<tr><td width=\"100%\" colspan=\"2\"  align=\"center\">Bilgileriniz</td></tr>";
$content .= "<tr><td width=\"10%\"  align=\"center\" title=\""._NICKNAME."\">
<img border=\"0\" src=\"images/who_online/you.gif\"></td>
<td width=\"90%\"  title=\""._NICKNAME."\">&nbsp;$username</td></tr>";
$content .= "<tr><td width=\"10%\"  align=\"center\" title=\"IP Address\">
<img border=\"0\" src=\"images/who_online/icon_links.gif\"></td>
<td width=\"90%\"  title=\"IP Address\">&nbsp;$ip</td></tr>
<tr><td width=\"10%\"  align=\"center\" title=\"ISP\">
<img border=\"0\" src=\"images/who_online/name.gif\"></td>
<td width=\"90%\"  title=\"ISP\">&nbsp;$isp</td></tr>
<tr><td width=\"10%\"  align=\"center\" title=\"NET Activity\">
<img border=\"0\" src=\"images/who_online/network.gif\"></td>
<td width=\"90%\" title=\"NET Activity\">&nbsp;$pc</td></tr>
</table></center><br>";
?>