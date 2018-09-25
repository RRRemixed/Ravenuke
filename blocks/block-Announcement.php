<?php

if (eregi("block-Announcement.php",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}

//User settings start
$title = "<img border=\"0\" src=\"YOUR IMAGE HERE\" alt=\"\">"; //shows an image above the announcements
$fontcolor = "#FF0000"; // change to the color you want your announcement text to be
$fontsize = "10pt";
$scrollspeed ="2"; // scrolling speed 1 to 6, 1 being slow
$scrolldirection ="left"; //the way you want it to scroll either left or right
$space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; //this is the space inbetween the messages, leave it alone if your not sure
// scrolling announcement message, you can use up to 5 messages if you dont want 5 just // comment out a message for example look at $announcement6 
// remember to include $space at the start to space out your messages, so there no all bunched up

$announcement1 = "NOW RECRUITING!!! ---Enlist Now at the Recruit Center--- NOW RECRUITING!!!";
$announcement2 = "$space Your Second Message Can Go Here";
$announcement3 = "$space If Indeed You Wanted A 3rd Message !";
$announcement4 = "$space Even Number 4...";
$announcement5 = "$space Far Too Many Now But Here Is The 5th";
//$announcement6 = "commented out for display purposes only";

//User settings end

// do not alter the code below unless you know what you are doing
$content .= "<div align=\"center\">";
$content .= "<table border=\"0\" cellpadding=\"0\" style=\"border-collapse: collapse\" width=\"100%\" >";
$content .= "    <tr>";
$content .= "      <td>";
$content .= "     <p align=\"center\"><b>$title</b></td>";
$content .= "    </tr>";
$content .= "    <tr>";
$content .= "      <td style=\"font-size: $fontsize; color: $fontcolor\"><br><marquee id=\"scroll\" direction=\"$scrolldirection\" scrollamount=\"$scrollspeed\" onMouseOver=\"document.all.scroll.stop()\" onMouseOut=\"document.all.scroll.start() \"><b>$announcement1$announcement2$announcement3$announcement4$announcement5</b></marquee></td>";
$content .= "    </tr>";
$content .= "  </table>";
$content .= "</div>";
?>
