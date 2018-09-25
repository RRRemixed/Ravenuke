<?php

if (eregi("ih_config.php", $_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}

global $db,$prefix,$admin_file,$module_name;
if(!isset($admin_file)) { $admin_file = "admin"; }
if(!isset($lang)) { $lang = $nuke_config['language']; }
if (!stristr("$lang", ".") AND file_exists($lang_dir."modules/$module_name/language/lang-$lang.php")) {
  @require_once($lang_dir."modules/$module_name/language/lang-$lang.php");
} else {
  @require_once($lang_dir."modules/$module_name/language/lang-english.php");
}
$sql = "SELECT * FROM ".$prefix."_ihconfig";
	$result = $db->sql_query($sql);
	while ( $row = $db->sql_fetchrow($result) )
	{
		$ih_config[$row['config_ihname']] = $row['config_ihvalue'];
	}
$max_size = $ih_config[max_size];
$quota = $ih_config[quota];
$ihpath = $ih_config[path];
$per_page = $ih_config[per_page];
$thumbwidth = $ih_config[thumbwidth];
$thumbheight = $ih_config[thumbheight];


function ihquota($percent) {
    global $module_name;
    $ihprogress="<table><tr><td><table cellpadding=\"0\" border=\"0\" cellspacing=\"0\" style=\"background-color:white;border: black 1px solid;
padding:0px; padding-right: 0px; padding-left: 0px;\" width=\"100\">
<tr><td width=\"100%\">
<div style=\"height:8px; width:$percent%; font-size:1px; background-color:#76D769\"></div></td></tr></table></td><td>$percent%</td></tr></table>";
    return($ihprogress);
}
function filesizepre($file){
        $kb = 1024;         // Kilobyte
    $mb = 1024 * $kb;   // Megabyte
    $gb = 1024 * $mb;   // Gigabyte
    $tb = 1024 * $gb;   // Terabyte

    // Get the file size in bytes.
    if($file < $kb) return $file." B";
    else if($file < $mb) return round($file/$kb,1)." KB";
    else if($file < $gb) return round($file/$mb,1)." MB";
    else if($file < $tb) return round($file/$gb,1)." GB";
    else return round($file/$tb,1)." TB";
    }
//end Size
function fxdate($fodate){
	$Adob = explode ("-",$fodate);
	$newdob = $Adob[2];
	if ($Adob[1] == 1)$month = _JANUARY;
	if ($Adob[1] == 2)$month = _FEBRUARY;
	if ($Adob[1] == 3)$month = _MARCH;
	if ($Adob[1] == 4)$month = _APRIL;
	if ($Adob[1] == 5)$month = _MAY;
	if ($Adob[1] == 6)$month = _JUNE;
	if ($Adob[1] == 7)$month = _JULY;
	if ($Adob[1] == 8)$month = _AUGUST;
	if ($Adob[1] == 9)$month = _SEPTEMBER;
	if ($Adob[1] == 10)$month = _OCTOBER;
	if ($Adob[1] == 11)$month = _NOVEMBER;
	if ($Adob[1] == 12)$month = _DECEMBER;
	$newdob = "$month"." ".$newdob.", ".$Adob[0];
	return $newdob;
}
function squota($dati){
      $meta = explode("M", $dati);
      $dati1= $meta[0];
    $mb = 1048576 * $dati1;   // Megabyte
    return round($mb);
}
/*
if ($pagenum == "") { $pagenum = 1 ; }
    $offset = ($pagenum-1) * $per_page ;
    $result = $db->sql_query("SELECT * FROM ".$prefix."_stories  ORDER BY a.sid DESC limit $offset, $per_page");

 */
function ihpagi($ihresul,$per_page,$pagenum,$tnamex){
global $db,$prefix,$module_name,$admin,$admin_file;
$result_ih = $db->sql_query($ihresul);
    $numih = $db->sql_numrows($result_ih);
    $numpages = ceil($numih / $per_page);
	if ($numpages > 0) {
        opentable();
        echo "<div align=\"center\">";

        echo"<strong>$numih</strong> $tnamex ($numpages "._PAGES.", $per_page "._PERPAGE.")<br>" ;
          if (is_admin($admin)) {
           echo "<FORM METHOD=GET ACTION=\"$admin_file.php\">";
          }else{
        echo "<FORM METHOD=GET ACTION=\"modules.php\">";
        }
        if ($pagenum > 1) {
            $prevpage = $pagenum - 1 ;
			$leftarrow = "modules/$module_name/images/left.gif" ;

                echo "<a href=\"modules.php?name=$module_name&amp;pagenum=$prevpage\">";

                echo "<img src=\"$leftarrow\" align=\"absmiddle\" border=\"0\" hspace=\"10\"></a>";

        }
		echo "<SELECT NAME=\"name\" CLASS=\"boxcontent\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">";
        for ($i=1; $i < $numpages+1; $i++) {

            if ($i == $pagenum) {
                echo "<OPTION VALUE=\"\" selected>"._PAGIN." $i";
            } else {

                    echo "<OPTION VALUE=\"modules.php?name=$module_name&amp;pagenum=$i\">"._PAGIN." $i";

            }


        }
		echo "</select>";
        if ($pagenum < $numpages) {
            $nextpage = $pagenum + 1 ;
			$rightarrow = "modules/$module_name/images/right.gif" ;

                echo "<a href=\"modules.php?name=$module_name&amp;pagenum=$nextpage\">";

                echo "<img src=\"$rightarrow\" align=\"absmiddle\" border=\"0\" hspace=\"10\"></a>";

        }
        echo "</form></div>" ;
        closetable();
    }
    }
function ihpagix($ihresul,$per_page,$pagenum,$tnamex,$taw){
global $db,$prefix,$module_name,$admin,$admin_file,$cookie;

$result_ih = $db->sql_query($ihresul);
    $numih = $db->sql_numrows($result_ih);
    $numpages = ceil($numih / $per_page);
	if ($numpages > 0) {
        opentable();
        echo "<div align=\"center\">";

        echo"<strong>$numih</strong> $tnamex ($numpages "._PAGES.", $per_page "._PERPAGE.")<br>" ;

           echo "<FORM METHOD=GET ACTION=\"$admin_file.php\">";

        if ($pagenum > 1) {
            $prevpage = $pagenum - 1 ;
			$leftarrow = "modules/$module_name/images/left.gif" ;
               if ($taw=="") {
               echo "<a href=\"modules.php?name=$module_name&amp;pagenum=$prevpage\">";

                }else{
                  echo "<a href=\"$admin_file.php?op=jd&amp;taw=$taw&amp;pagenum=$prevpage\">";
                 }
                echo "<img src=\"$leftarrow\" align=\"absmiddle\" border=\"0\" hspace=\"10\"></a>";

        }
		echo "<SELECT NAME=\"name\" CLASS=\"boxcontent\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">";
        for ($i=1; $i < $numpages+1; $i++) {

            if ($i == $pagenum) {
                echo "<OPTION VALUE=\"\" selected>"._PAGIN." $i";
            } else {
                   if ($taw=="") {
                     echo "<OPTION VALUE=\"modules.php?name=$module_name&amp;pagenum=$i\">"._PAGIN." $i";
                   }else{

                     echo "<OPTION VALUE=\"$admin_file.php?op=jd&amp;taw=$taw&amp;pagenum=$i\">"._PAGIN." $i";
                   }
            }


        }
		echo "</select>";
        if ($pagenum < $numpages) {
            $nextpage = $pagenum + 1 ;
			$rightarrow = "modules/$module_name/images/right.gif" ;
                if ($taw=="") {
                 echo "<a href=\"modules.php?name=$module_name&amp;pagenum=$nextpage\">";
                }else{
                echo "<a href=\"$admin_file.php?op=jd&amp;taw=$taw&amp;pagenum=$nextpage\">";
                }
                echo "<img src=\"$rightarrow\" align=\"absmiddle\" border=\"0\" hspace=\"10\"></a>";

        }
        echo "</form></div>" ;
        closetable();
    }
    }
?>