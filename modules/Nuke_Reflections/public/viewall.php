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









if ($galllookup == "member") {
} else if ($galllookup == "main") {
} else {
Header("Location: modules.php?name=$module_name&op=gallistpub");
}

$showgalurl = "modules.php?name=$module_name&op=showgal&galid=";


//start main lookup
if ($galllookup == "main") {
$ajinfo = getmain1();
echo "<table border='0' width='100%'>";
if ($ajinfo[0] == "NONYET") {
    echo "<tr><td><strong><center><hr>All Main Galleries<hr></center></strong></td></tr>";
    echo "<tr><td><strong><center><br>No main galleries.<br><br><hr></center></strong></td></tr>";
} else {
    echo "<tr><td colspan='4'><strong><center><hr>All Main Galleries<hr></strong></center></td></tr>";
echo "<tr>";

$x=0;
while ($ajinfo[$x] != "") {
echo "<tr>";
echo "<td>";
echo $ajinfo[$x];
echo "<hr></td>";
echo "</tr>";
$x++;
}

}
echo "</table><center><strong>End Of All Main Galleries</center></strong><hr>";



}
//end main lookup



if ($galllookup == "member") {
$ajinfo1 = getmem();
echo "<br><table border='0' width='100%'>";
if ($ajinfo1[0] == "NONYET") {
    echo "<tr><td><strong><center><hr>List of All Member Galleries<hr></center></strong></td></tr>";
    echo "<tr><td><strong><center><br>No Member galleries.<br><br><hr></center></strong></td></tr>";
} else {
echo "<tr><td><strong><center><hr>List of All Member Galleries<hr></center></strong></td></tr>";
$x1=0;
while ($ajinfo1[$x1] != "") {
echo "<tr>";
echo "<td>";
echo $ajinfo1[$x1];
echo "<hr></td>";
echo "</tr>";
$x1++;
}
}
echo "</table><center><strong>End of All Members Gallery<hr></strong></center><br>";

}

















closetable();
include("footer.php");

function getmain1()
{
    global $tooltippic, $hiddenspecial, $showgalurl, $prefix, $sql, $module_name, $admin;
    if (is_admin($admin)) {
    	    $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='0' AND galtype='main' ORDER BY rawtime DESC";
    } else {
    $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='0' AND galtype='main' AND active='1' ORDER BY rawtime DESC";
}
    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $i = 0;
    while ($i < $num) {
        $daid = mysql_result($result, $i, "galid");
        $daname = mysql_result($result, $i, "name");
        $dadesc = mysql_result($result, $i, "desc");
        $dafolder = mysql_result($result, $i, "folder");
        $dathumb = mysql_result($result, $i, "thumb");
        $dausername = mysql_result($result, $i, "creator");
        $daactive = mysql_result($result, $i, "active");
        $dapassword = mysql_result($result, $i, "password");


if ($daactive == "0") {
	$active = "Not Active<br>";
} else {
$active = "Active";
}
if ($dapassword != "") {
	$dapassword = "<img src='modules/$module_name/images/lock.gif'>";
} else {
$dapassword = "No";
}


if ($dathumb == "") {
	$dathumb = "asdasd.adssad";
}


   $checkthumb = "modules/$module_name/files/maingallery/$dafolder/$dathumb";
        if (!file_exists($checkthumb)) {
            $ajinfo[$i] = "<a href='$showgalurl$daid'><img border='0' src='modules/$module_name/images/nodefault.gif' height='100' width='100'></a>";
        } else {

            $imgSize = wdresizeinfo($checkthumb, 100);
                                           if ($tooltippic == 1) {
            $ajinfo[$i] = "<a href='$showgalurl$daid' onMouseover=\"ddrivetip('<b> <img src=\'$checkthumb\'> </b>','green', $imgSize[2])\"; onMouseout=\"hideddrivetip()\"><img border='0' src='$checkthumb' width='$imgSize[0]' height='$imgSize[1]'></a>";
        } else {
            $ajinfo[$i] = "<a href='$showgalurl$daid'><img border='0' src='$checkthumb' width='$imgSize[0]' height='$imgSize[1]'></a>";

		}
		  }



$sql2 = "SELECT * FROM " . $prefix . "_reflections_gallery where galtype='main' AND parentid='$daid'";
$result2 = mysql_query($sql2);
$num2 = mysql_numrows($result2);
$a = 0;
while ($a < $num2) {
$subid[$a] = mysql_result($result2, $a, "galid");
$subname[$a] = mysql_result($result2, $a, "name");
$subdesc[$a] = mysql_result($result2, $a, "desc");
$subpass[$a] = mysql_result($result2, $a, "password");
$subthumb[$a] = mysql_result($result2, $a, "thumb");
$subfolder[$a] = mysql_result($result2, $a, "folder");


if ($subthumb[$a] == "") {
	$subthumb[$a] = "asdasd.adssad";
}
   $subcheckthumb = "modules/$module_name/files/maingallery/$subfolder[$a]/$subthumb[$a]";
        if (!file_exists($subcheckthumb)) {
        if ($tooltippic == 1) {
            $subthumb[$a] = " onMouseover=\"ddrivetip('<b> <img border=\'0\' src=\'modules/$module_name/images/nodefault.gif\' height=\'100\' width=\'100\'> </b>','green', '100')\"; onMouseout=\"hideddrivetip()\"";
        } else {
		$subthumb[$a] = "";
		}
		} else {
            $imgSize = wdresizeinfo($checkthumb, 100);
        if ($tooltippic == 1) {
            $subthumb[$a] = " onMouseover=\"ddrivetip('<b> <img src=\'$subcheckthumb\'> </b>','green', $imgSize[2])\"; onMouseout=\"hideddrivetip()\"";
        } else {
            $subthumb[$a] = "";
		}
		}




if ($subpass[$a] != "") {
	$subpass[$a] = "Locked - ";
} else {
$subpass[$a] = "";
}
$sql167 = "SELECT * FROM " . $prefix . "_reflections_files where galid='$subid[$a]'";
$result167 = mysql_query($sql167);
$num167 = mysql_numrows($result167);
$subfiles[$a] = $num167;
$a++;
}


$sql1 = "SELECT * FROM " . $prefix . "_reflections_files where galid='$daid'";
$result1 = mysql_query($sql1);
$num1 = mysql_numrows($result1);


$ajinfo[$i] = "<table border=\"0\" width=\"100%\">
<tr>
<td width=\"100\">" . $ajinfo[$i] . "</td>
<td valign=\"top\"><strong>Gallery Name :: $daname<br>
Gallery Description :: $dadesc<br>
Gallery Creator :: $dausername<br>
Files In Gallery :: $num1<br>
Gallery Active :: $active<br>
Password Protected :: $dapassword
";
if ($num2 != "0" && $num2 != "") {
$ajinfo[$i] = $ajinfo[$i] . "
<br><a href=\"javascript:;\" onclick=\"if(document.getElementById('mydiv$hiddenspecial').style.display == 'none'){ document.getElementById('mydiv$hiddenspecial').style.display = 'block'; }else{ document.getElementById('mydiv$hiddenspecial').style.display = 'none'; }\">[Show $num2 Sub Galleries]</a>
";
}


$ajinfo[$i] = $ajinfo[$i] . "</strong></td>
</tr>";

if ($num2 != "0" && $num2 != "") {

$ajinfo[$i] = $ajinfo[$i] . "<tr><td colspan=\"2\">";
$ajinfo[$i] = $ajinfo[$i] . "<div id='mydiv$hiddenspecial' style='display:none'><table border='0' width='100%'><tr><td colspan=\"2\">";
$ajinfo[$i] = $ajinfo[$i] . "<strong>Sub Galleries List</strong><br>";
$g=0;
while($subid[$g] != ""){
	$count = $g + 1;
$ajinfo[$i] = $ajinfo[$i] . "<a href='$showgalurl$subid[$g]'$subthumb[$g]><strong>" . $count . " $subpass[$g]Name :: $subname[$g] - Desc :: $subdesc[$g] - Files :: $subfiles[$g]</strong></a><bR>";
$g++;
} // while
$ajinfo[$i] = $ajinfo[$i] . "</td></tr></table></div></td></tr>";
$hiddenspecial++;
}


$ajinfo[$i] = $ajinfo[$i] . "</table>";

        $i++;
    }
    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    }
    return $ajinfo;
}







function getmem()
{
    global $tooltippic, $hiddenspecial, $showgalurl, $prefix, $sql, $module_name, $admin, $db;

    if (is_admin($admin)) {
    	    $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='0' AND galtype='member' ORDER BY rawtime DESC";
    } else {
    $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='0' AND galtype='member' AND active='1' ORDER BY rawtime DESC";
}

    $result = mysql_query($sql);
    $num = mysql_numrows($result);

    $i = 0;
    while ($i < $num) {
        $daid = mysql_result($result, $i, "galid");
        $daname = mysql_result($result, $i, "name");
        $dadesc = mysql_result($result, $i, "desc");
        $dafolder = mysql_result($result, $i, "folder");
        $dathumb = mysql_result($result, $i, "thumb");
        $dausername = mysql_result($result, $i, "creator");
        $daactive = mysql_result($result, $i, "active");
        $dapassword = mysql_result($result, $i, "password");

if ($daactive == "0") {
	$active = "Not Active<br>";
} else {
$active = "Active";
}
if ($dapassword != "") {
	$dapassword = "<img src='modules/$module_name/images/lock.gif'>";
} else {
$dapassword = "No";
}

        // check for a image as a default?
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE thumbforgalid='$daid'"));
        $thumbfromfiles = $row['filename'];
        if ($thumbfromfiles != "") {
            // check it and show if possible
            $checkit = "modules/$module_name/files/memgallery/$dafolder/thumbs/$thumbfromfiles";
            if (file_exists($checkit)) {
                $imgSize = wdresizeinfo($checkit, 100);
             if ($tooltippic == 1) {
                            $ajinfo[$i] = "<a href='$showgalurl$daid' onMouseover=\"ddrivetip('<b> <img src=\'$checkit\'> </b>','green', $imgSize[2])\"; onMouseout=\"hideddrivetip()\"><img border='0' src='$checkit' width='$imgSize[0]' height='$imgSize[1]'></a>";
                }   else {
                            $ajinfo[$i] = "<a href='$showgalurl$daid'><img border='0' src='$checkit' width='$imgSize[0]' height='$imgSize[1]'></a>";
}
          } else {
                $ajinfo[$i] = "<a href='$showgalurl$daid'><img border='0' src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'></a>";
            }
        } else {
            // Check the next option in the database
            $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$daid' AND approved='1' ORDER BY rawtime ASC"));
            $thumbfromfiles = $row['filename'];
            if ($thumbfromfiles != "") {
                $checkit = "modules/$module_name/files/memgallery/$dafolder/thumbs/$thumbfromfiles";
                if (file_exists($checkit)) {
                    $imgSize = wdresizeinfo($checkit, 100);
   if ($tooltippic == 1) {
                    $ajinfo[$i] = "<a href='$showgalurl$daid' onMouseover=\"ddrivetip('<b> <img src=\'$checkit\'> </b>','green', $imgSize[2])\"; onMouseout=\"hideddrivetip()\"><img border='0' src='$checkit' width='$imgSize[0]' height='$imgSize[1]'></a>";
               } else {
                    $ajinfo[$i] = "<a href='$showgalurl$daid'><img border='0' src='$checkit' width='$imgSize[0]' height='$imgSize[1]'></a>";


			   }
			                  } else {
                    $ajinfo[$i] = "<a href='$showgalurl$daid'><img border='0' src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'></a>";
                }
            } else {
                $ajinfo[$i] = "<a href='$showgalurl$daid'><img border='0' src='modules/$module_name/images/nodefault.gif' height='100' width='100'></a>";
            }
        }

$sql2 = "SELECT * FROM " . $prefix . "_reflections_gallery where galtype='member' AND parentid='$daid'";
$result2 = mysql_query($sql2);
$num2 = mysql_numrows($result2);
$a = 0;
while ($a < $num2) {
$subid[$a] = mysql_result($result2, $a, "galid");
$subname[$a] = mysql_result($result2, $a, "name");
$subdesc[$a] = mysql_result($result2, $a, "desc");
$subpass[$a] = mysql_result($result2, $a, "password");
$subthumb[$a] = mysql_result($result2, $a, "thumb");
$subfolder[$a] = mysql_result($result2, $a, "folder");

        // check for a image as a default?
        $row90 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE thumbforgalid='$subid[$a]'"));
        $subthumbfromfiles = $row90['filename'];
        if ($subthumbfromfiles != "") {
            // check it and show if possible
            $subcheckit = "modules/$module_name/files/memgallery/$subfolder[$a]/thumbs/$subthumbfromfiles";
            if (file_exists($subcheckit)) {
                $imgSize = wdresizeinfo($subcheckit, 100);

            if ($tooltippic == 1) {
                            $subthumb[$a] = " onMouseover=\"ddrivetip('<b> <img src=\'$subcheckit\'> </b>','green', $imgSize[2])\"; onMouseout=\"hideddrivetip()\"";
                }   else {
                            $subthumb[$a] = "";
}
			} else {

	            if ($tooltippic == 1) {
                $subthumb[$a] = " onMouseover=\"ddrivetip('<b> <img src=\'modules/$module_name/images/thumbmissing.gif\' height=\'100\' width=\'100\'> </b>','green', '100')\"; onMouseout=\"hideddrivetip()\"";
   } else {
   $subthumb[$a] = "";
   }
            }
        } else {
            // Check the next option in the database



            $row90 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$subid[$a]' AND approved='1' ORDER BY rawtime ASC"));
            $subthumbfromfiles = $row90['filename'];
            if ($subthumbfromfiles != "") {
                $subcheckit = "modules/$module_name/files/memgallery/$subfolder[$a]/thumbs/$subthumbfromfiles";
                if (file_exists($subcheckit)) {
                    $imgSize = wdresizeinfo($subcheckit, 100);

                           if ($tooltippic == 1) {
                    $subthumb[$a] = " onMouseover=\"ddrivetip('<b> <img src=\'$subcheckit\'> </b>','green', $imgSize[2])\"; onMouseout=\"hideddrivetip()\"";
               } else {
                    $subthumb[$a] = "";


			   }

			    } else {
			                               if ($tooltippic == 1) {
                    $subthumb[$a] = " onMouseover=\"ddrivetip('<b> <img src=\'modules/$module_name/images/thumbmissing.gif\' height=\'100\' width=\'100\'> </b>','green', '100')\"; onMouseout=\"hideddrivetip()\"";
                               } else {
                    $subthumb[$a] = "";


			   }
				}
            } else {
                                       if ($tooltippic == 1) {
                $subthumb[$a] = " onMouseover=\"ddrivetip('<b> <img src=\'modules/$module_name/images/nodefault.gif\' height=\'100\' width=\'100\'> </b>','green', '100')\"; onMouseout=\"hideddrivetip()\"";
                          } else {
                    $subthumb[$a] = "";


			   }
		    }
        }




if ($subpass[$a] != "") {
	$subpass[$a] = "Locked - ";
} else {
$subpass[$a] = "";
}
$sql167 = "SELECT * FROM " . $prefix . "_reflections_files where galid='$subid[$a]'";
$result167 = mysql_query($sql167);
$num167 = mysql_numrows($result167);
$subfiles[$a] = $num167;
$a++;
}


$sql1 = "SELECT * FROM " . $prefix . "_reflections_files where galid='$daid'";
$result1 = mysql_query($sql1);
$num1 = mysql_numrows($result1);


$ajinfo[$i] = "<table border=\"0\" width=\"100%\">
<tr>
<td width=\"100\">" . $ajinfo[$i] . "</td>
<td valign=\"top\"><strong>Gallery Name :: $daname<br>
Gallery Description :: $dadesc<br>
Gallery Creator :: $dausername<br>
Files In Gallery :: $num1<br>
Gallery Active :: $active<br>
Password Protected :: $dapassword
";
if ($num2 != "0" && $num2 != "") {
$ajinfo[$i] = $ajinfo[$i] . "
<br><a href=\"javascript:;\" onclick=\"if(document.getElementById('mydiv$hiddenspecial').style.display == 'none'){ document.getElementById('mydiv$hiddenspecial').style.display = 'block'; }else{ document.getElementById('mydiv$hiddenspecial').style.display = 'none'; }\">[Show $num2 Sub Galleries]</a>
";
}


$ajinfo[$i] = $ajinfo[$i] . "</strong></td>
</tr>";

if ($num2 != "0" && $num2 != "") {

$ajinfo[$i] = $ajinfo[$i] . "<tr><td colspan=\"2\">";
$ajinfo[$i] = $ajinfo[$i] . "<div id='mydiv$hiddenspecial' style='display:none'><table border='0' width='100%'><tr><td colspan=\"2\">";
$ajinfo[$i] = $ajinfo[$i] . "<strong>Sub Galleries List</strong><br>";
$g=0;
while($subid[$g] != ""){
	$count = $g + 1;
$ajinfo[$i] = $ajinfo[$i] . "<a href='$showgalurl$subid[$g]'$subthumb[$g]><strong>" . $count . " $subpass[$g]Name :: $subname[$g] - Desc :: $subdesc[$g] - Files :: $subfiles[$g]</strong></a><bR>";
$g++;
} // while
$ajinfo[$i] = $ajinfo[$i] . "</td></tr></table></div></td></tr>";
$hiddenspecial++;
}


$ajinfo[$i] = $ajinfo[$i] . "</table>";


        $i++;
    }
    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    }
    return $ajinfo;
}











?>