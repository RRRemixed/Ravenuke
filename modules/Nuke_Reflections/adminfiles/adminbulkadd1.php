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




if (!is_admin($admin)) {
    echo "<b><center>You are not an admin. LEAVE NOW!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}


	function getparent($daparentid,$daname) {
		global $prefix, $db;
		$daparentid = intval(trim($daparentid));
		$row = $db->sql_fetchrow($db->sql_query("SELECT * from " . $prefix . "_reflections_gallery where galid='$daparentid'"));
		$daownerid = intval($row['galid']);
		$daownername = $row['name'];
		$daownerparent = $row['parentid'];
		if ($daownername=="$daname") $daname=$daname;
		elseif (!empty($daownername)) $daname=$daownername."/".$daname;
		if ($daownerparent!=0) {
			$daname=getparent($daownerparent,$daname);
		}
		return $daname;
	}


















echo "<br><b><center>Bulk Adding System</center></b><br>";
echo "<form id='bulkaddsystemNR' name='bulkaddsystemNR' method='post' action='modules.php?name=$module_name&adminarea=adminbulkadd2'>";
echo "<strong>Select Gallery to Add to :: </strong>";

$result7 = $db->sql_query("SELECT * from " . $prefix . "_reflections_gallery WHERE galtype='main' order by parentid,name");
echo "<select name=\"galid\">";
echo "<option value=\"\">-------- Main Galleries --------</option>";
while ($row7 = $db->sql_fetchrow($result7)) {
    $dagalid = intval($row7['galid']);
    $daname = $row7['name'];
    $daparentid = intval($row7['parentid']);
    if ($daparentid != 0) $daname = getparent($daparentid, $daname);
    echo "<option value=\"$dagalid\">$daname</option>";
}
$dagalid = "";
$daname = "";
$daparentid = "";
$result7 = $db->sql_query("SELECT * from " . $prefix . "_reflections_gallery WHERE galtype='member' order by creator,name");
echo "<option value=\"\">-------- Member Galleries --------</option>";
while ($row7 = $db->sql_fetchrow($result7)) {
    $dagalid = $row7['galid'];
    $daname = $row7['name'];
    $daparentid = $row7['parentid'];
    $dacreator = $row7['creator'];
    if ($daparentid != 0) $daname = getparent($daparentid, $daname);
    echo "<option value=\"$dagalid\">$dacreator = $daname</option>";
}
echo "</select>";

echo "<table border='1' width='100%'>";
$path = "modules/$module_name/add_bulk/";

if (file_exists($path)) {
    $dh = opendir($path);
    while (false !== ($file = readdir($dh))) {
        if (is_dir("$path$file")) {
            if ($file == ".") {
            } else if ($file == "..") {
            } else {
                $listfold[] = "$file";
            }
        } else {
            $sys1 = substr($file, -3);
            if (strtolower($sys1) == "gif" || strtolower($sys1) == "jpg" || strtolower($sys1) == "peg") {
                $listfile[] = "$file";
            }
        }
    }
    closedir($dh);
}
if ($listfile != "") {
    $totalfolders++;
}


echo "<tr><td><strong>Images in add_bulk Root</strong></td></tr>";


$i = 0;
$applebluedevil1=0;
if ($listfile != "") {
    SORT($listfile);
} while ($listfile[$i] != "") {
    echo "<tr><td><a href='$path" . $listfile[$i] . "' target='_blank'><img src='$path" . $listfile[$i] . "' height='100' width='100' align='top'></a> File Description (optional) :: <input name='filedesc" . $applebluedevil1 . "' type='text' size='30'/></td><td>Add Image? Yes<input type='checkbox' checked name='bulk" . $applebluedevil1 . "' value='$path" . $listfile[$i] . "' /><input type='hidden' name='filename" . $applebluedevil1 . "' value='" . $listfile[$i] . "'></td></tr>";
    $applebluedevil1++;
    $i++;
} // while
$i = 0;
while ($listfold[$i] != "") {
    $path = "modules/$module_name/add_bulk/" . $listfold[$i] . "/";

    unset($listfile);
    if (file_exists($path)) {
        $dh = opendir($path);
        while (false !== ($file = readdir($dh))) {
            if (is_dir("$path$file")) {
            } else {
                $sys1 = substr($file, -3);
                if (strtolower($sys1) == "gif" || strtolower($sys1) == "jpg" || strtolower($sys1) == "peg") {
                    $listfile[] = "$file";
                }
            }
        }
        closedir($dh);
    }
    $totalfolders++;
    echo "<strong><tr><td><strong>Images in the add_bulk/" . $listfold[$i] . "/</strong></td></tr>";
    $i1 = 0;
    if ($listfile != "") {
        SORT($listfile);
    } while ($listfile[$i1] != "") {
        echo "<tr><td><a href='$path" . $listfile[$i1] . "' target='_blank'><img src='$path" . $listfile[$i1] . "' height='100' width='100' align='top'></a> File Description (optional) :: <input name='filedesc" . $applebluedevil1 . "' type='text' size='30'/></td><td>Add Image? Yes<input type='checkbox' checked name='bulk" . $applebluedevil1 . "' value='$path" . $listfile[$i1] . "' /><input type='hidden' name='filename" . $applebluedevil1 . "' value='" . $listfile[$i1] . "'></td></tr>";
        $applebluedevil1++;
        $i1++;
    } // while
    $i++;
} // while
$applebluedevil1 = $applebluedevil1 - 1;
echo "</table>Total Files $applebluedevil1 :: Total Folders $totalfolders";
echo "<input type='hidden' name='totalfilestoadd' value='$applebluedevil1'>";
echo "<br><input type='submit' name='Submit' value='Submit' />";
echo "</form>";
closetable();
include("footer.php");
die;

?>