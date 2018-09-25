<?php
/****************************************************************/
/* Jhon Doe Image Host	V. 2.5 Macondo GPL						*/
/*  Copyright (C) 2006 by Jhon Doe jhodoe[AT}gmail.com)   		*/
/* Description: Allows site members to upload  					*/
/* images add Photo Blog on your website.						*/
/*This program comes with ABSOLUTELY NO WARRANTY. 				*/
/*This is free software, and you are welcome to 				*/
/*redistribute it under certain conditions; 					*/
/*please refer to the GNU General Public License for details.	*/
/****************************************************************/

if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");


$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- $module_name";
require_once("modules/$module_name/ih_config.php");
function Imageh() {
global $prefix, $db, $module_name,$user, $anonymous, $cookie, $user, $sitename,$anonymos,$quota,$max_size,$ihpath;

if (!file_exists("$ihpath")) {
$old_umask = umask(0);
mkdir("$ihpath", 0755);
}
$cookie[0] = intval($cookie[0]);
$usrinfo = $db->sql_fetchrow($db->sql_query("select * from ".$prefix."_users WHERE user_id='$cookie[0]'"));
$ihpathx = "$ihpath/".$usrinfo['username']."/";

if (!file_exists("$ihpathx")) {
$old_umask = umask(0);
mkdir("$ihpath/".$usrinfo['username']."", 0755);
}


    $max=filesizepre($max_size);
    Opentable();
echo"<FORM ENCTYPE=\"multipart/form-data\" ACTION=\"modules.php?name=$module_name\" METHOD=\"POST\">"
   . "  <div align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"><br />"
  ."  .::.  <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</strong></a> .::.<br />
   .::. <a href=modules.php?name=$module_name&amp;op=Fotoaddcat><strong>"._ADD." "._CATEGORIES."</strong></a> .::.
  </div>" ;
  CloseTable();
  echo"<br />";
  OpenTable();
   echo"<div align=center>"._BWEL." <a href=modules.php?name=Your_Account&amp;op=userinfo&username=".$usrinfo['username'].">".$usrinfo['username']."</a> !  <br />";

$result= $db->sql_query("SELECT SUM(peso) FROM ".$prefix."_imagehost WHERE ihuser= '".$usrinfo['username']."'");
	   while ($row = $db->sql_fetchrow($result)) {
		 $total = $row['SUM(peso)'];
		}
        if($total==""){
        $total1=0;
        }else{
$total1= filesizepre($total);
}
$ResulPorc=( $total * 100 ) / $quota;
	$freespace = $quota - $total;
     $freespace=filesizepre($freespace);
      $quota= filesizepre($quota);

     echo ihquota(round($ResulPorc,0));
echo""._USET." $total1 "._FRET." $freespace "._OF." $quota </div>";
if($total==$quota){
}else{
  echo "<p align=\"center\">"._ALLOWED.""
  ."<br />"
  . "  <p align=\"center\">"._UPLOAD."</p>"
  . "  <p align=\"center\">"._LINK."</p>"
  . "  <p align=\"center\">"._FILE.""
  . "    <INPUT TYPE=\"file\" NAME=\"userfile\"><br /> "._BIGT." $max.<br /><br />"
  ."<input type=\"hidden\" name=\"op\" value=\"AddUpload\">"

  . "    <INPUT TYPE=\"submit\" VALUE=\""._UPLOAD1."\">"
  . "    </p>"
  . "</FORM>";
  }
  CloseTable();
       echo"<br />";



}

function addupload(){
global $ihpath, $max_size,$quota,$HTTP_POST_FILES, $module_name, $nukeurl, $username, $prefix,$user, $cookie, $db ,$thumbwidth,$thumbheight;
//Inicio Control Caracteres Especiales
$HTTP_POST_FILES['userfile']= str_replace("ñ", "n", $HTTP_POST_FILES['userfile']);
$HTTP_POST_FILES['userfile']= str_replace("+", "", $HTTP_POST_FILES['userfile']);
$HTTP_POST_FILES['userfile']= str_replace("&", "", $HTTP_POST_FILES['userfile']);
$HTTP_POST_FILES['userfile']= str_replace("&amp;", "", $HTTP_POST_FILES['userfile']);
$HTTP_POST_FILES['userfile']= str_replace("\/'~?^?°?`?´:", "", $HTTP_POST_FILES['userfile']);
$HTTP_POST_FILES['userfile']= str_replace(" ", "", $HTTP_POST_FILES['userfile']);
$HTTP_POST_FILES['userfile']= str_replace("<", "", $HTTP_POST_FILES['userfile']);
$HTTP_POST_FILES['userfile']= str_replace(">", "", $HTTP_POST_FILES['userfile']);
$HTTP_POST_FILES['userfile']= str_replace("[", "", $HTTP_POST_FILES['userfile']);
$HTTP_POST_FILES['userfile']= str_replace("]", "", $HTTP_POST_FILES['userfile']);
 //fin control
$cookie[0] = intval($cookie[0]);
$row = $db->sql_fetchrow($db->sql_query("SELECT username from ".$prefix."_users where user_id = '".intval($cookie[0])."'"));
$usernamex = $row['username'];
$ihpathx = "$ihpath".$usernamex."/";
$title=$HTTP_POST_FILES['userfile']['name'];
$xfile=$HTTP_POST_FILES['userfile']['tmp_name'];
$ihfile=$HTTP_POST_FILES['userfile']['name'];
$peso=$HTTP_POST_FILES['userfile']['size'];
$imagesize = @getimagesize($xfile);
$ihwidth= $imagesize[0];
$ihheight= $imagesize[1];
$tamano=$ihwidth."x".$ihheight;
$ihuser=$usernamex;
$fsizet=filesizepre($peso);
$total= dirsize($ihpathx);
$modifx = date("Y-m-d");
$split_img = explode('.', $HTTP_POST_FILES['userfile']['name']);
$split_im=$split_img[1];
include("header.php");

  if(is_user($user)){
OpenTable();
echo "  <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"></p>"
  ."   <p align=\"center\"> .::. <a href=\"modules.php?name=$module_name&amp;op=ShowFiles\"><strong>"._VIEW."</a></strong>"
  ."  .::.  <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</strong> </a> .::. </p>" ;

  CloseTable();
  echo"<br />";
  OpenTable();
$bug = @getimagesize($xfile);
 if($xfile==""){
  $iherror=1;
}else if($bug==null){
$iherror=2;
}elseif ($total+$HTTP_POST_FILES['userfile']['size'] > $quota){
 $iherror=3;
}else if ($HTTP_POST_FILES['userfile']['size']>$max_size) {
 $iherror=3;
}elseif (file_exists($ihpathx . $HTTP_POST_FILES['userfile']['name'])) {
 $iherror=4;
}else{
if(preg_match("/.psd|.tiff|.bmp|.swf|.ico$/i", $HTTP_POST_FILES['userfile']['name'])){
  $iherror=2;
}

}


if($iherror==0){

   $result=$db->sql_query("INSERT INTO ".$prefix."_imagehost VALUES ('', '$title', '$ihuser','$ihfile','$peso','$tamano','0','0','$modifx')");
     if(!$result) {
		$iherror=2;

	}else{

if (copy($HTTP_POST_FILES['userfile']['tmp_name'], $ihpathx .$HTTP_POST_FILES['userfile']['name'])) {
}else{
move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $ihpathx .$HTTP_POST_FILES['userfile']['name']);
}

echo"<table width=\"100%\"  border=\"0\" cellspacing=\"8\" cellpadding=\"0\" align=\"center\"><tr><td width=\"95%\"><table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n"
  . "  <tr>\n"
  . "    <td width=\"20%\">"._FNAME." </td>\n"
  . "    <td width=\"80%\">".$HTTP_POST_FILES['userfile']['name']."</td>\n"
  . "  </tr>\n"
  . "  <tr>\n"
  . "    <td width=\"20%\">"._FSIZE."</td>\n"
  . "    <td width=\"80%\">$fsizet</td>\n"
  . "  </tr>\n"
  . "  <tr>\n"
  . "    <td width=\"20%\">"._FPREVIEW."</td>\n"
  . "    <td width=\"80%\"><img src=\"".$ihpathx.$HTTP_POST_FILES['userfile']['name']."\" width=$thumbwidth height=$thumbheight border=0></td>\n"
  . "  </tr>"
  . "  <tr>"
  . "    <td width=\"20%\">"._FHTML."</td>\n"
  . "    <td width=\"80%\"><input type='text' name='"._FHTML."' size='80' value='<img src=\"$nukeurl/$ihpathx$ihfile\" alt=\"$nukeurl\" title=\"$nukeurl\" border=\"0\">'></td>\n"
  . "  </tr>\n"
  . "  <tr>\n"
  . "    <td width=\"20%\">"._FBB."</td>\n"
  . "    <td width=\"80%\"><input type='text' name='"._FBB."' size='80' value='"."["."img"."]"."$nukeurl/$ihpathx$ihfile"."["."/img"."]"."'></td>\n"
  . "  </tr>\n"
    . "  <tr>\n"
  . "    <td width=\"20%\">"._FHTTP."</td>\n"
  . "    <td width=\"80%\"><input type='text' name='"._FHTTP."' size='80' value='$nukeurl/$ihpathx$ihfile'></td>\n"
  . "  </tr>\n"
  . "</table></td></tr></table>\n";
  }
}

switch($iherror) {

    case 1:
     echo"<div align=center>";
    echo""._BLANK."";
     echo"<br /><img src=\"modules/$module_name/images/error.gif\"><br />.:: "._GOBACK." ::.</div>";
    break;
    case 2:
     echo"<div align=center>";
    echo""._WRONG."";
     echo"<br /><img src=\"modules/$module_name/images/error.gif\"><br />.:: "._GOBACK." ::.</div>";
    break;
    case 3:
     echo"<div align=center>";
    echo""._BIG."";
     echo"<br /><img src=\"modules/$module_name/images/error.gif\"><br />.:: "._GOBACK." ::.</div>";
    break;
    case 4:
     echo"<div align=center>";
    echo""._EXISTS."";
     echo"<br /><img src=\"modules/$module_name/images/error.gif\"><br />.:: "._GOBACK." ::.</div>";
    break;

    }
CloseTable();
}else{

                 header ("Location: modules.php?name=$module_name");

 }
include("footer.php");
}

function showfiles(){
global $module_name,$db,$cookie,$user,$quota,$max_size,$thumbwidth,$thumbheight,$sitename,$ihpath,$per_page,$pagenum,$admin_file;
echo"
<script>

function checkedAll (id, checked) {
	var el = document.getElementById(id);
	for (var i = 0; i < el.elements.length; i++) {
	  el.elements[i].checked = checked;
	}
      }

</script>

";
include("header.php");
if(!$db->sql_query("SELECT * FROM ".$prefix."_ihconfig")) header("location: ".$admin_file.".php?op=ihinstall");
if(is_user($user)){
echo"<script type=\"text/javascript\" charset=\"UTF-8\" src=\"modules/$module_name/images/lightbox_plus.js\"></script>\n
<script>

function checkedAll (id, checked) {
	var el = document.getElementById(id);
	for (var i = 0; i < el.elements.length; i++) {
	  el.elements[i].checked = checked;
	}
      }

</script>\n
<style>
#lightbox {
	background-color: #eee;
	padding: 10px;
	border-bottom: 1px solid #666;
	border-right: 1px solid #666;
}
#overlay {
	background-image: url(modules/$module_name/images/overlay.png);
}
#lightboxCaption {
	color: #333;
	background-color: #eee;
	font-size: 90%;
	text-align: center;
	border-bottom: 1px solid #666;
	border-right: 1px solid #666;
}
* html #overlay {
	background-color: #000;
	background-image: url(modules/$module_name/images/blank.gif);
	filter: Alpha(opacity=50);
}
.loading {
    margin-bottom: 5px;
	position: relative;
	 background: #FFFFFF url(modules/$module_name/images/loadin.gif)  50% 50% no-repeat;
}
.cimg {  background: url(modules/$module_name/images/loadin.gif)  50% 50% no-repeat; position: relative; margin-bottom: 5px; }

</style>
";

$cookie[0] = intval($cookie[0]);
$usrinfo = $db->sql_fetchrow($db->sql_query("select * from ".$prefix."_users WHERE user_id='$cookie[0]'"));
$fileuser=$usrinfo['username'];
$filepath= "$ihpath$fileuser";
Imageh();

OpenTable();
echo" <br><table width='100%' cellpadding=2>

   ";
    if ($pagenum == "") { $pagenum = 1 ; }
    $offset = ($pagenum-1) * $per_page ;
$result = $db->sql_query("SELECT * FROM ".$prefix."_imagehost WHERE ihuser='$fileuser' limit $offset, $per_page");
 $numrowx = $db->sql_numrows($result);
 if($numrowx > "0"){
 echo" <tr bgcolor=#CCCCCC>
    <td align=center><b>"._DELETE."</b></td>
        <td align=center><b>"._ICON."</b></td>
        <td align=center><b>"._NAME."</b></td>
        <td align=center><b>"._SIZE."</b></td>
                <td align=center><b>"._DATE."</b></td>

              <td align=center><b>"._PB."</b></td>
    </tr>";
	while ($row = $db->sql_fetchrow($result)) {
    $id = intval($row['id']);
    $title = $row['title'];
    $ihfile = $row['ihfile'];
    $peso = filesizepre($row['peso']);
    $tamano = $row['tamano'];
     $cate = $row['cate'];
    $active = $row['active'];
    $modified = fxdate($row['dates']);
    $imagesize = explode("x", $tamano);
     $width= $imagesize[0];
                $height= $imagesize[1];
                if ($width>$thumbwidth) {
                    $ratio= $thumbwidth / $width;
                    $width=$thumbwidth;
                    $height= $height*$ratio;
                    }
                if ($height>$thumbheight) {
                    $ratio= $thumbheight / $height;
                    $height=$thumbheight;
                    $width= $width*$ratio;
                    }

              echo "<form method=post action=\"modules.php?name=$module_name\" id=\"borrar\">\n
              <input type=hidden name=op value=delete>\n";
              for($i=0;$i<count($ihfile);$i++){
if($bgih == '#FFFFFF')$bgih = '#F5F5F5';
else $bgih = '#FFFFFF';
            echo "
            <tr bgcolor=$bgih>
            <td valign=top align=center><input type=checkbox name=arc[] value=\"".$ihfile."\"></td>
            <td align='center' valign='center' bordercolor='#000000'><a href=\"$filepath/$ihfile\" rel='lightbox'><img src=\"$filepath/$ihfile\" class=\"cimg\" alt=\"$title\" title=\"$title\" width=\"$width\" height=\"$height\" border=\"2\"></a><br />
            [ <a href=\"modules.php?name=$module_name&op=rechange&amp;arc=$ihfile\">"._RENAME."</a> ]<br>
            [<a href=\"javascript:;\" onClick=\"window.open('modules.php?name=$module_name&amp;op=codeview&amp;username=".$fileuser."&arc=$ihfile','_blank','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=700, height=270')\">"._CODE."</a>]
            </td>
            <td valign=top><a href=\"$filepath/$ihfile\" rel='lightbox'>$title</a> ($tamano)</td>
            <td valign=top align=center>$peso</td>
            <td valign=top align=center>$modified</td> ";


            if ($active=='1'){
            echo"<td valign=top align=center><a href=\"modules.php?name=$module_name&amp;op=Fotodel&amp;kaiw=$id\"><img src=\"modules/$module_name/images/on.jpg\" border=\"0\" title=\"Active  "._FOTOBLOG."\" alt=\"Active "._FOTOBLOG."\"></a><a href=\"modules.php?name=$module_name&amp;op=Fotoedit&amp;kaiw=$id&amp;namex=$cate\"><img src=\"modules/$module_name/images/pm.gif\" border=\"0\" title=\"Edit "._FOTOBLOG."\" alt=\"Edit "._FOTOBLOG."\"></a></td>";

            }else{
            echo"<td valign=top align=center><a href=\"modules.php?name=$module_name&amp;op=Fotoadd&amp;kaiw=$id\"><img src=\"modules/$module_name/images/off.jpg\" border=\"0\" title=\"Inactive "._FOTOBLOG."\" alt=\"Inactive "._FOTOBLOG."\"></a></td>";

            }

            echo "</tr>";
           }
           }
           echo"
            <tr bgcolor=#CCCCCC>
            <td valign=\"middle\" colspan=\"3\" align=\"left\">&nbsp;&nbsp;<a href=\"javascript:;\" onClick=\"checkedAll('borrar', true)\">"._CALL."</a> || <a href=\"javascript:;\" onClick=\"checkedAll('borrar', false)\">"._UALL."</a></td><td colspan=\"3\" valign=\"middle\" align=\"right\">&nbsp;&nbsp;</td>
            </tr>\n
           ";
             echo"<tr><td colspan=\"6\">\n"
            ."<br />\n"
           ."&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" value=\""._SUBMIT."\"></form>\n"
            ."<br /><br />\n"
         ."</td> </tr>";
            }else {
            echo "
        <tr bgcolor=#CCCCCC>
            <td valign=middle colspan='6' align=center><strong>"._NOFILES."</strong></td>
            </tr>\n";
            }
    echo "

</table><br />\n";

CloseTable();
$tnamex=""._IMAGES."";
 $ihresult="SELECT * FROM ".$prefix."_imagehost WHERE ihuser='$fileuser'";
                   echo"<br />";
          echo ihpagi($ihresult,$per_page,$pagenum,$tnamex);
 } else {
                Opentable();

				echo "
                <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\">
                 <br /> .::. <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong> "._FOTOBLOG." </strong></a> .::.
     <br />
                </p>\n";
                CloseTable();
                echo"<br />";
                Opentable();
                echo"<center><b>"._RESTRIC."</b><br><br>\n"
				    .""._MODULEUSERS." .:: "._GOBACK." ::.\n";
				CloseTable();
			include("footer.php");
				die();
       }
include("footer.php");
}
//Size
 function dirsize($dir)
// calculate the size of files in $dir
{
	$dh = opendir($dir);
	$size = 0;
	while (($file = readdir($dh)) !== false)
	{
   
		if ($file != "." and $file != "..")
		{

        $path = $dir."/".$file;
			if (is_dir($path))
			{
				$size += dirsize("$path/");
			}
			elseif (is_file($path))
			{
				$size += filesize($path);

			}
}
	}
	closedir($dh);

	return $size;
}


function rechange($arc) {
    global $module_name,$db,$cookie,$user;
$cookie[0] = intval($cookie[0]);

include("header.php");


   if(is_user($user)){
     OpenTable();
    echo "   <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"></p>"
  ."   <p align=\"center\"> .::. <a href=\"modules.php?name=$module_name\"><strong>"._VIEW."</a></strong>"
  ."  .::.  <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</a></strong> .::.
  <br />
   .::. <a href=modules.php?name=$module_name&amp;op=Fotoaddcat><strong>"._ADD." "._CATEGORIES."</strong></a> .::. "
  ."   </p>";
  CloseTable();
  echo"<br />";
  OpenTable();
  echo"<p align=\"center\">"._CARCH."</p>";
  $dj = explode(".", $arc);
                echo "<div align=center><form method=post action=\"modules.php?name=$module_name\">\n";
                echo"<input type=hidden name=op value=renombre>\n";
                echo"<input type=hidden name=arc value=$arc>\n";
                echo"<input type=hidden name=djoh value=$dj[1]>\n";
                echo"<input type=text name=djo value=$dj[0] size=30>\n";
                echo".$dj[1]<br /><br />";
                echo"<input type=\"submit\" name=\"submit\" value=\""._SUBMIT."\"> <input type=\"button\" value=\""._CANCEL."\" onclick=\"javascript:history.go(-1)\"></form></div><br /><br />\n";


 }else {
header ('Location: modules.php?name=Imagehost');
 }
 CloseTable();
include("footer.php");

 }
function renombre($arc,$djo,$djoh) {
    global $module_name,$db,$cookie,$ihpath,$user;
$cookie[0] = intval($cookie[0]);

include("header.php");
$usrinfo = $db->sql_fetchrow($db->sql_query("select * from ".$prefix."_users WHERE user_id='$cookie[0]'"));
$filepath= "$ihpath".$usrinfo['username']."";
   if(is_user($user)){
    OpenTable();
    echo " <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"></p>"
  ."   <p align=\"center\"> .::. <a href=\"modules.php?name=$module_name\"><strong"._VIEW."</strong</a>"
  ."  .::.  <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</strong</a> .::."
  ."   </p>";
  CloseTable();
  echo"<br />";
   OpenTable();

 $result = $db->sql_query("SELECT * from " . $prefix . "_imagehost where ihfile='$arc'");
  $numrows = $db->sql_numrows($result);
  if($djo != null) {

   while($row = $db->sql_fetchrow($result)) {
       $id = intval($row['id']);


 $rem= $db->sql_query("update " . $prefix . "_imagehost set ihfile='$djo.$djoh',title='$djo.$djoh' where id='$id'");

     }

     }
    if($djo != null) {

   $resultt =rename("$filepath/$arc","$filepath/$djo.$djoh");
   $resultx = 1;
  $rem;

            }

             if($resultx==1){

        echo "<div align=center>"._HMOD.".</div>";
	} else {
		echo "<div align=center>"._HNMOD.". </div>";
	}



 }else {
 header ('Location: modules.php?name=Imagehost');
 }
 CloseTable();
include("footer.php");

 }

function codeview($username,$arc){
global $module_name,$db,$cookie,$user,$nukeurl,$ihpath;
$filepath= "$ihpath/$username";
OpenTable();
echo"  <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"></p>" ;
echo "  <table><tr>"
 . "  <tr>"
  . "    <td width=\"20%\">"._FHTML."</td>\n"
  . "    <td width=\"80%\"><input type='text' name='"._FHTML."' size='80' value='<img src=\"$nukeurl/$filepath/$arc\" alt=\"$nukeurl\" title=\"$nukeurl\" border=\"0\">'></td>\n"
  . "  </tr>\n"
  . "  <tr>\n"
  . "    <td width=\"20%\">"._FBB."</td>\n"
  . "    <td width=\"80%\"><input type='text' name='"._FBB."' size='80' value='"."["."img"."]"."$nukeurl/$filepath/$arc"."["."/img"."]"."'></td>\n"
  . "  </tr>\n"
    . "  <tr>\n"
  . "    <td width=\"20%\">"._FHTTP."</td>\n"
  . "    <td width=\"80%\"><input type='text' name='"._FHTTP."' size='80' value='$nukeurl/$filepath/$arc'></td>\n"
  . "  </tr>\n"
  . "</table>";
CloseTable();
}
function delete($arc) {
    global $module_name,$db,$cookie,$user,$prefix,$ihpath;
$cookie[0] = intval($cookie[0]);

include("header.php");


$usrinfo = $db->sql_fetchrow($db->sql_query("select * from ".$prefix."_users WHERE user_id='$cookie[0]'"));
$filepath= "$ihpath".$usrinfo['username']."";



   if(is_user($user)){
         OpenTable();
    echo  "  <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"></p>"
  ."   <p align=\"center\"> .::. <a href=\"modules.php?name=$module_name&amp;op=dir\"><strong>"._VIEW."</strong></a>"
  ."  .::. <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong> "._FOTOBLOG."</strong></a> .::.  </p>";
        CloseTable();
        echo"<br />";
      OpenTable();
  if ( !file_exists($arc)){

		$arrayindex = array_keys($arc);
		$index = 0;
		while($index < count($arc)) {
			$result = unlink($filepath."/".$arc[$arrayindex[$index]]);
            $db->sql_query("delete from " . $prefix . "_imagehost where ihfile='".$arc[$arrayindex[$index]]."'");
            $result = 1;
			$index++;

		}
        }
       if($result==1){
       echo"<META HTTP-EQUIV=REFRESH CONTENT=\"9; URL=modules.php?name=$module_name\">";

        echo "
        <div align=center>"._HDELE.". </div>";
	} else {
		echo "<div align=center>"._HNDELE.". </div>";
	}

     CloseTable();

}else {
 header ("Location: modules.php?name=$module_name");
 }

 include("footer.php");
 }
function fotoadd($kaiw){
  global $module_name,$db,$cookie,$user,$prefix,$ihpath;
$cookie[0] = intval($cookie[0]);
  $kaiw = intval($kaiw);
include("header.php");

   if(is_user($user)){
          OpenTable();
    echo "  <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"></p>"
  ."   <p align=\"center\"> .::. <a href=\"modules.php?name=$module_name\"><strong>"._VIEW."</strong></a>"
  ."  .::.  <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</strong></a> .::.
  <br />
   .::.<a href=modules.php?name=$module_name&amp;op=Fotoaddcat> <strong>"._ADD." "._CATEGORIES."</strong></a> .::.
  "
  ."   </p>";
  CloseTable();
  echo"<br />";
         OpenTable();
    	echo "<form method=\"post\" action=\"modules.php?name=$module_name\">";
    echo "<div align=\"center\"><font class=\"content\"><strong>"._ADD." "._FOTOBLOG."</strong></div><br /><br />";
    echo "<table width=\"100%\" valign=\"middle\"><tr><td></td><td><table valign=\"middle\" align=\"center\"><tr><td>
    " . _CATEGORIES . "</td><td> <select name=\"cate\">";
     $result = $db->sql_query("SELECT * from " . $prefix . "_ihcategory where ihuser='$cookie[1]'");
    $numrows= $db->sql_numrows($result);
  if ($numrows== 0) {

echo "<option value=\"0\">"._UNCATEGORIE."</option>";
          }


    while($row = $db->sql_fetchrow($result)) {
       $id = intval($row['id']);
       $name = $row['title'];
     //
     echo "<option value=\"0\" select>"._UNCATEGORIE."</option>";
    echo "<option value=\"$id\">$name</option>";
    }
    echo "</select></td><tr><td>";
     $datos = $db->sql_query("SELECT * from " . $prefix . "_imagehost where id='$kaiw'");
    while($rowx = $db->sql_fetchrow($datos)) {
       $idx = intval($rowx['id']);
       $name = $rowx['title'];

    echo"<input type=\"hidden\" name=\"idx\" value=\"$idx\">";
    echo""._TITLE." </td><td><input type=\"text\" name=\"title\" value=\"$name\" size=50>";

  echo"<input type=\"hidden\" name=\"active\" value=\"1\">" ;
    echo "</td></tr><tr><td colspan=\"2\"><input type=\"hidden\" name=\"op\" value=\"Fotoupdate\">";
    }
    echo "<br /><input type=\"submit\" value=\""._SUBMIT."\">&nbsp;<input type=\"button\" value=\""._CANCEL."\" onclick=\"javascript:history.go(-1)\">";
    echo "</td></tr></table></td></tr></table></form>";
      CloseTable();

 }else {
 header ("Location: modules.php?name=$module_name");
 }

 include("footer.php");
 }
 function fotoupdate($cate,$idx,$title,$active){
global $prefix, $db, $module_name,$user, $anonymous, $cookie, $user, $sitename;
  $now = date("Y-m-d");
  $idx = intval($idx);
  $cate = intval($cate);
  $active = intval($active);

    if(is_user($user)){

        $db->sql_query("update " . $prefix . "_imagehost set title='$title', cate='$cate', active='$active', dates='$now' where id='$idx'");
         Header("Location: modules.php?name=$module_name");
 }else {
 header ("Location: modules.php?name=$module_name");
 }

}
 function fotodel($kaiw){
 global $prefix, $db, $module_name,$user, $anonymous, $cookie, $user, $sitename;
 $kaiw = intval($kaiw);
  $now = date("Y-m-d");
  if(is_user($user)){
  $db->sql_query("update " . $prefix . "_imagehost set cate='0', active='0', dates='$now' where id='$kaiw'");
         Header("Location: modules.php?name=$module_name");
         }else {
 header ("Location: modules.php?name=$module_name");
 }
 }
function fotoedit($kaiw,$namex){
  global $module_name,$db,$cookie,$user,$prefix,$ihpath;
$cookie[0] = intval($cookie[0]);
$namex = intval($namex);
$kaiw = intval($kaiw);
include("header.php");

   if(is_user($user)){
          OpenTable();
    echo "  <p align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"></p>"
  ."   <p align=\"center\"> .::. <a href=\"modules.php?name=$module_name\"><strong>"._VIEW."</strong></a>"
  ."  .::.  <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</strong></a> .::."
  ."   </p>";
  CloseTable();
  echo"<br />";
         OpenTable();
    	echo "<form method=\"post\" action=\"modules.php?name=$module_name\">";
    echo "<div align=\"center\"><font class=\"content\"><strong>"._ADD." "._FOTOBLOG."</strong></div><br /><br />";
    echo "<table width=\"100%\" valign=\"middle\"><tr><td></td><td><table valign=\"middle\" align=\"center\"><tr><td>
    " . _CATEGORIES . "</td><td> <select name=\"cate\">";

    $result = $db->sql_query("SELECT * from " . $prefix . "_ihcategory where ihuser='$cookie[1]'");
     $numrows= $db->sql_numrows($result);
  if ($numrows== 0) {

echo "<option value=\"0\">"._UNCATEGORIE."</option>";
          }

    while($row = $db->sql_fetchrow($result)) {
       $id = intval($row['id']);
       $name = $row['title'];

     if($namex==$id){
     $sel="selected";
     }else {
	$sel = "";
		}
       echo "<option value=\"$id\" $sel>"._UNCATEGORIE."</option>";
    echo "<option value=\"$id\" $sel>$name</option>";

    }
    echo "</select></td><tr><td>";
     $datos = $db->sql_query("SELECT * from " . $prefix . "_imagehost where id='$kaiw'");
    while($rowx = $db->sql_fetchrow($datos)) {
       $idx = intval($rowx['id']);
       $name = $rowx['title'];

    echo"<input type=\"hidden\" name=\"idx\" value=\"$idx\">";
    echo""._TITLE." </td><td><input type=\"text\" name=\"title\" value=\"$name\" size=50>";

  echo"<input type=\"hidden\" name=\"active\" value=\"1\">" ;
    echo "</td></tr><tr><td colspan=\"2\"><input type=\"hidden\" name=\"op\" value=\"Fotoupdate\">";
    }
    echo "<br /><input type=\"submit\" value=\""._SUBMIT."\">&nbsp;<input type=\"button\" value=\""._CANCEL."\" onclick=\"javascript:history.go(-1)\">";
    echo "</td></tr></table></td></tr></table></form>";
      CloseTable();

 }else {
 header ("Location: modules.php?name=$module_name");
 }

 include("footer.php");
 }
function fotolist(){
  global $module_name,$db,$cookie,$user,$prefix,$ihpath;
include("header.php");
echo"<style>
#thumbs {width: 100%; margin: 10px; border: 1px solid black; clear: both; text-align: center; }
p.thumb {width: 85;  margin: 1em; padding: 3px; float: center; font-size: 12px; text-align: center; background-color: #CCCCCC; border: 1px solid black;}
.cimg {  background: url(modules/$module_name/images/loadin.gif)  50% 50% no-repeat; position: relative; margin-bottom: 5px; }
</style>";
$impt="$ihpath";

$zara=4;
OpenTable();
echo " <p align=\"center\"><img src=\"modules/$module_name/images/blog.gif\"></p>\n";
 echo"<p align=\"center\">";
 if (is_user($user)) {

  echo " .::.  <a href=\"modules.php?name=$module_name\"><strong>"._VIEW."</strong></a>\n";
  }
  echo "  .::.  <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</strong></a> .::.\n"
  ."  </p>" ;
   CloseTable();
  echo"<br />";
  OpenTable();
$result = $db->sql_query("SELECT * from " . $prefix . "_imagehost where active='1' group by ihuser");
$numrowx = $db->sql_numrows($result);
 echo"<table align=center>";
 if($numrowx > "0"){

           while ($row = $db->sql_fetchrow($result)) {
           $thor = $row['ihuser'];
            $joto = $row['ihfile'];
            $impt="$ihpath$thor/";
            if($ti == $zara) {
               echo "<tr>";
               $ti = 0;
               }

echo"<td align=center><p class='thumb'><a href=modules.php?name=$module_name&amp;op=Fotoblog&amp;thor=".$thor.">\n<img src=\"$impt$joto\" class=\"cimg\" width=\"80\"> <br /><strong>".$thor."</strong></a></p></td>\n";
$ti++;
}
}else{
echo"<tr><td align=center><img src=\"modules/$module_name/images/noimage.gif\"><br /><strong>No "._FOTOBLOG."</strong></td>";
}
echo"</tr></table><br>\n";
CloseTable();

include("footer.php");
}

function fotoblog($thor){
 global $module_name,$db,$cookie,$user,$prefix,$ihpath,$thumbwidth,$thumbheight;
 $thor = check_html($thor, "nohtml");
include("header.php");
echo"<style>
#thumbs {width: 100%; margin: 10px; border: 1px solid black; clear: both; text-align: center; }
p.thumb { margin: 1em; padding: 3px; float: left; font-size: 12px; text-align: center; background-color: #CCCCCC; border: 1px solid black;}
.title2{
font-size: 18;
font-weight: bold;}
#lightbox {
	background-color: #eee;
	padding: 10px;
	border-bottom: 1px solid #666;
	border-right: 1px solid #666;
}
#overlay {
	background-image: url(modules/$module_name/images/overlay.png);
}
#lightboxCaption {
	color: #333;
	background-color: #eee;
	font-size: 90%;
	text-align: center;
	border-bottom: 1px solid #666;
	border-right: 1px solid #666;
}
* html #overlay {
	background-color: #000;
	background-image: url(modules/$module_name/images/blank.gif);
	filter: Alpha(opacity=50);
}
.loading {
    margin-bottom: 5px;
	position: relative;
	 background: #FFFFFF url(modules/$module_name/images/loadin.gif)  50% 50% no-repeat;
}
.cimg {  background: url(modules/$module_name/images/loadin.gif)  50% 50% no-repeat; position: relative; margin-bottom: 5px; }
</style>";
echo"<script type=\"text/javascript\" charset=\"UTF-8\" src=\"modules/$module_name/images/lightbox_plus.js\"></script>";
$impt="$ihpath$thor/";
OpenTable();
echo " <p align=\"center\"><img src=\"modules/$module_name/images/blog.gif\"></p>";
 echo"<p align=\"center\">";
 if (is_user($user)) {

  echo " .::. <a href=\"modules.php?name=$module_name\"><strong>"._VIEW."</strong></a>";

  }
  echo "  .::. <b> <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</strong></a> </b>.::."
  ."  </p>" ;
  CloseTable();
  echo"<br />";
  OpenTable();
echo"
<div align=\"center\"><span class=title2>"._FOTOBLOG." "._OF." </span><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$thor\"><span class=title2>$thor</span></a></div>";
  CloseTable();
  echo"<br />";
  OpenTable();
echo "<table width=\"100%\" align=\"center\"><tr><td>
";
 $result = $db->sql_query("SELECT * from " . $prefix . "_ihcategory WHERE ihuser='$thor'");
           $numrows= $db->sql_numrows($result);
           if ($numrows== 0) {

          }else {
          echo""._CATEGORIES.": ";
           while ($row = $db->sql_fetchrow($result)) {
              $id=$row['id'];
               $title=$row['title'];
                echo"<a href=modules.php?name=$module_name&amp;op=Fotocat&amp;id=".$id."&amp;thor=".$thor.">[ $title ]</a> ";
                }
               }
	$result1 = $db->sql_query("SELECT * from " . $prefix . "_imagehost WHERE ihuser='$thor' AND active='1'");
       		while ($row = $db->sql_fetchrow($result1)) {
			$id = $row['id'];
            $title = $row['title'];
            $joto = $row['ihfile'];
            $cat_id = $row['cate'];
            $tamano = $row['tamano'];

         $imagesize = explode("x", $tamano);
     $width= $imagesize[0];
                $height= $imagesize[1];
                if ($width>$thumbwidth) {
                    $ratio= $thumbwidth / $width;
                    $width=$thumbwidth;
                    $height= $height*$ratio;
                    }
                if ($height>$thumbheight) {
                    $ratio= $thumbheight / $height;
                    $height=$thumbheight;
                    $width= $width*$ratio;
                    }

            if ($cat_id=="" || $cat_id=="0" ){

echo"<p class=\"thumb\"> <a href=\"$impt$joto\" rel=\"lightbox\" title=\"$title\"><img class=cimg src=\"$impt$joto\" width=\"$width\" height=\"$height\" alt=\"$title\" title=\"$title\"><br />$title</a></p>";

}

}
echo"</td></tr></table>";
CloseTable();
  include("footer.php");
}
function fotocat($id,$thor){
global $module_name,$db,$cookie,$user,$prefix,$ihpath,$thumbwidth,$thumbheight;
$thor = check_html($thor, "nohtml");
$id = intval($id);
include("header.php");
echo"<style>
#thumbs {width: 100%; margin: 10px; border: 1px solid black; clear: both; text-align: center; }
p.thumb { margin: 1em; padding: 3px; float: left; font-size: 12px; text-align: center; background-color: #CCCCCC; border: 1px solid black;}
.title2{
font-size: 18;
font-weight: bold;}
#lightbox {
	background-color: #eee;
	padding: 10px;
	border-bottom: 1px solid #666;
	border-right: 1px solid #666;
}
#overlay {
	background-image: url(modules/$module_name/images/overlay.png);
}
#lightboxCaption {
	color: #333;
	background-color: #eee;
	font-size: 90%;
	text-align: center;
	border-bottom: 1px solid #666;
	border-right: 1px solid #666;
}
* html #overlay {
	background-color: #000;
	background-image: url(modules/$module_name/images/blank.gif);
	filter: Alpha(opacity=50);
}
.loading {
    margin-bottom: 5px;
	position: relative;
	 background: #FFFFFF url(modules/$module_name/images/loadin.gif)  50% 50% no-repeat;
}
.cimg {  background: url(modules/$module_name/images/loadin.gif)  50% 50% no-repeat; position: relative; margin-bottom: 5px; }
</style>";
echo"<script type=\"text/javascript\" charset=\"UTF-8\" src=\"modules/$module_name/images/lightbox_plus.js\"></script>";
$impt="$ihpath$thor/";
OpenTable();
echo " <p align=\"center\"><img src=\"modules/$module_name/images/blog.gif\"></p>";
 echo"<p align=\"center\">";
 if (is_user($user)) {

  echo " .::. <a href=\"modules.php?name=$module_name\"><strong>"._VIEW."</strong></a>";

  }
  echo "  .::.  <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."<strong></a> .::."
  ."  </p>" ;
  CloseTable();
  echo"<br />";
  OpenTable();
echo"<div align=\"center\">
<span class=title2>"._FOTOBLOG." "._OF." </span><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$thor\"><span class=title2>$thor</span></a></div>";
  CloseTable();
  echo"<br />";
  OpenTable();
echo"<table width=\"100%\"><tr><td>";
 $result = $db->sql_query("SELECT * from " . $prefix . "_ihcategory WHERE ihuser='$thor'");
         $numrows= $db->sql_numrows($result);

           while ($row = $db->sql_fetchrow($result)) {
           echo""._CATEGORIES.": ";
              $id2=$row['id'];
               $name=$row['title'];

               if ($id==$id2){
                echo"<a href=modules.php?name=$module_name&amp;op=Fotocat&amp;id=".$id."&amp;thor=".$thor."><strong>[ $name ]</strong></a>\n";
                }else{
                echo"<a href=modules.php?name=$module_name&amp;op=Fotocat&amp;id=".$id2."&amp;thor=".$thor.">[ $name ]</a>\n";
                }
                }


	$result1 = $db->sql_query("SELECT * from " . $prefix . "_imagehost WHERE cate='$id' and ihuser='$thor'");
       		while ($row = $db->sql_fetchrow($result1)) {

            $title = $row['title'];
            $joto = $row['ihfile'];



   $tamano = $row['tamano'];

         $imagesize = explode("x", $tamano);
     $width= $imagesize[0];
                $height= $imagesize[1];
                if ($width>$thumbwidth) {
                    $ratio= $thumbwidth / $width;
                    $width=$thumbwidth;
                    $height= $height*$ratio;
                    }
                if ($height>$thumbheight) {
                    $ratio= $thumbheight / $height;
                    $height=$thumbheight;
                    $width= $width*$ratio;
                    }

echo"<p class=\"thumb\"> <a href=\"$impt$joto\" rel=\"lightbox\" title=\"$title\"><img class=cimg src=\"$impt$joto\" width=\"$width\" height=\"$height\" alt=\"$title\" title=\"$title\"><br />$title</a></p>";



}
echo""._GOBACK."</td></tr></table>\n";

CloseTable();
  include("footer.php");
}
function fotoaddcat(){
global $module_name,$db,$cookie,$user,$prefix,$bgcolor1;
include("header.php");
$result = $db->sql_query("SELECT * from " . $prefix . "_ihcategory where ihuser='$cookie[1]'");
    if (is_user($user)) {

      Opentable();
echo"<FORM ENCTYPE=\"multipart/form-data\" ACTION=\"modules.php?name=$module_name\" METHOD=\"POST\">"
   . "  <div align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"><br />"
  ."  .::. <a href=\"modules.php?name=$module_name\"><strong>"._VIEW."</strong></a>  .::. <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</strong></a> .::.
  </div>" ;
  CloseTable();
  echo"<br />";
    OpenTable();
     echo" <table align=\"center\" border=\"0\"><tr>
     <td valign=top><strong>"._ADD." "._CATEGORIES."</strong><br />
     "._TITLE." :<input type=text name=title>
     <input type=\"hidden\" name=\"op\" value=\"Fotoaddc\">
       <input type=\"submit\" value=\""._SUBMIT."\">
     </form></td>
     </tr></table><br /> ";
     $numrows = $db->sql_numrows($result);
     	if ($numrows>0) {
     echo"
     <table width=\"100%\" border=\"0\">
  <tr bgcolor=$bgcolor1>
     <td width=\"100%\" colspan=\"2\" bgcolor=$bgcolor2>"._NAME."</td>


  </tr>
     ";
    while($row = $db->sql_fetchrow($result)) {
       $id = intval($row['id']);
       $title = $row['title'];
       echo"
       <tr>
    <td valign=top width=\"85%\">$title</td>
    <td valign=top><a href=\"modules.php?name=$module_name&amp;op=Fotoeditc&amp;id=$id\">Editar</a> ||
    <a href=\"modules.php?name=$module_name&amp;op=Fotoeditd&amp;id=$id\">Delete</a></td>

  </tr>
  <tr><td colspan=\"2\" height=\"1\" bgcolor=$bgcolor1></td></tr>";

       }

       echo"</table>";
        }
        CloseTable();
   }else{
         Header("Location: modules.php?name=$module_name");

  }

  include("footer.php");
       }
function fotoaddc($id,$title){
global $module_name,$db,$cookie,$user,$prefix;
$id = intval($id);
$title = check_html($title, "nohtml");
$result = $db->sql_query("SELECT * from " . $prefix . "_ihcategory where id='$id'");
 if (is_user($user)) {
     $numrows= $db->sql_numrows($result);
     if ($numrows== 0) {
      $result=$db->sql_query("INSERT INTO ".$prefix."_ihcategory VALUES ('', '$cookie[1]', '$title')");
      Header("Location: modules.php?name=$module_name&op=Fotoaddcat");
     }else{
     $db->sql_query("update " . $prefix . "_ihcategory set title='$title' where id='$id'");
     Header("Location: modules.php?name=$module_name&op=Fotoaddcat");
     }
  }else{
         Header("Location: modules.php?name=$module_name");

  }
}
function fotoeditc($id){
global $module_name,$db,$cookie,$user,$prefix;
$id = intval($id);
include("header.php");
$result = $db->sql_query("SELECT * from " . $prefix . "_ihcategory where id='$id'");
    if (is_user($user)) {

      Opentable();
echo"<FORM ENCTYPE=\"multipart/form-data\" ACTION=\"modules.php?name=$module_name\" METHOD=\"POST\">"
   . "  <div align=\"center\"><img src=\"modules/$module_name/images/logo.gif\"><br />"
  ."  .::. <a href=\"modules.php?name=$module_name\"><strong>"._VIEW."</strong></a>  .::. <a href=\"modules.php?name=$module_name&amp;op=Fotolist\"><strong>"._FOTOBLOG."</strong></a> .::.
  </div>" ;
  CloseTable();
  echo"<br />";
    OpenTable();
     echo"<div align=\"center\"><strong>"._EDIT." "._CATEGORIES."</strong></div><br />
     <table width=\"100%\" border=\"0\">
  <tr>

     <td valign=top>
     ";
       while($row = $db->sql_fetchrow($result)) {
       $id = intval($row['id']);
       $title = $row['title'];
    echo" "._TITLE." :<input type=text name=title value=$title>" ;
    }
    echo" <input type=\"hidden\" name=\"id\" value=\"$id\">
    <input type=\"hidden\" name=\"op\" value=\"Fotoaddc\">
       <input type=\"submit\" value=\""._SUBMIT."\">\n
     </form></td>
  </tr>\n
     ";


       echo"</table>";
   }else{
         Header("Location: modules.php?name=$module_name");

  }
  CloseTable();
  include("footer.php");
       }
function fotoeditd($id){
global $module_name,$db,$cookie,$user,$prefix;
$id = intval($id);

     $now = date("Y-m-d");
  if(is_user($user)){
  $db->sql_query("update " . $prefix . "_imagehost set cate='0', active='0', dates='$now' where cate='$id'");
   $db->sql_query("delete from " . $prefix . "_ihcategory where id='$id'");

      Header("Location: modules.php?name=$module_name&op=Fotoaddcat");
      }else{
         Header("Location: modules.php?name=$module_name");

  }
       }

switch($op) {

    default:
    showfiles();
    break;

    case "AddUpload":
    addupload();
    break;
    case "ShowFiles":
    showfiles();
    break;
    case "rechange":
    rechange($arc);
    break;

    case "renombre":
    renombre($arc,$djo,$djoh);
    break;
    case "codeview":
    codeview($username,$arc);
    break;
    case "delete":
    delete($arc);
    break;

    case "Fotoblog":
    fotoblog($thor);
    break;

    case "Fotoadd":
    fotoadd($kaiw);
    break;

    case "Fotoupdate":
    fotoupdate($cate,$idx,$title,$active);
    break;
    case "Fotodel":
    fotodel($kaiw);
    break;
    case "Fotoedit":
    fotoedit($kaiw,$namex);
    break;

    case "Fotolist":
    fotolist();
    break;

    case "Fotocat":
    fotocat($id,$thor);
    break;

    case "Fotoaddcat":
    fotoaddcat();
    break;

    case "Fotoaddc":
    fotoaddc($id,$title);
    break;

    case "Fotoeditc":
    fotoeditc($id);
    break;

    case "Fotoeditd":
    fotoeditd($id);
    break;

    }

?>