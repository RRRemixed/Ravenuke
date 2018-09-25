<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='ImageHost'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
require_once("mainfile.php");
$module_name = "ImageHost";
$pagetitle = "- $module_name";

include("modules/$module_name/ih_config.php");

function imagehost(){
global $prefix, $admin_file,$db, $pagenum,$per_page,$module_name,$user, $anonymous, $cookie, $user, $sitename,$anonymos,$quota,$max_size,$ihpath;

              include("header.php");
               if(!$db->sql_query("SELECT * FROM ".$prefix."_ihconfig")) header("location: ".$admin_file.".php?op=ihinstall");
                      Opentable();
                     echo" <div align=center><img src=\"modules/$module_name/images/logo.gif\" alt=\"$module_name\" title=\"$module_name\"></div>
                       <div align=\"center\"> <a href=\"$admin_file.php\"><img src=\"modules/$module_name/images/admin.gif\" border=\"0\"> <strong>"._I_ADMIN."</strong></a>&nbsp; <a href=\"$admin_file.php?op=ihconfig\"><img src=\"modules/$module_name/images/config.gif\" border=\"0\"> <strong>"._CONFIG."</strong></a>
                       &nbsp; <a href=\"$admin_file.php?op=ihinstall\"><img src=\"modules/$module_name/images/uninstall.gif\" border=\"0\"> <strong>"._UINSTAL." $module_name</strong></a></div>";
                         Closetable();
                    echo"<br />";

                     Opentable();
                     if ($pagenum == "") { $pagenum = 1 ; }
    $offset = ($pagenum-1) * $per_page ;
                $result = $db->sql_query("SELECT DISTINCT ihuser from " . $prefix . "_imagehost limit $offset, $per_page");
                $num     = $db->sql_numrows($result);
           echo"<table width=\"99%\" align=\"center\">";
           if($num > 0) {
           while ($row = $db->sql_fetchrow($result)) {
           $thor = $row['ihuser'];

             $result2= $db->sql_query("SELECT SUM(peso),COUNT(ihfile) FROM ".$prefix."_imagehost WHERE ihuser= '$thor'");
	   while ($row = $db->sql_fetchrow($result2)) {
		 $total = $row['SUM(peso)'];
          $it = $row['COUNT(ihfile)'];
		}
        if($total==""){
        $total1=0;
        }else{
$total1= filesizepre($total);
}

$ResulPorc=( $total * 100 ) / $quota;
   for($i=0;$i<count($thor);$i++){
if($bgih == '#FFFFFF')$bgih = '#F5F5F5';
else $bgih = '#FFFFFF';
echo"<tr>\n
<td bgcolor=\"$bgih\"><img src=\"modules/$module_name/images/folder.gif\" title=\"$thor\"  align=middle alt=\"$thor\" border=\"0\"><a href=\"$admin_file.php?op=jd&amp;taw=$thor\"><strong>".$thor."</strong></a> ($it "._IMAGES.")</td><td bgcolor=\"$bgih\"  align=\"center\">";
echo ihquota(round($ResulPorc,0));

echo"&nbsp;$total1 </td><td bgcolor=\"$bgih\" align=\"center\"><a href=\"admin.php?op=imagerm&amp;rmdir=$thor\"><img src=\"modules/$module_name/images/delete.gif\" title=\""._DELETE."\"  alt=\""._DELETE."\" border=\"0\"></a> <a href=\"$admin_file.php?op=jd&amp;taw=$thor\"><img src=\"modules/$module_name/images/view.gif\" title=\""._VIEW." $thor\"  alt=\""._VIEW." $thor\" border=\"0\"></a><td></tr>\n";
 }
}
}else{
echo"<tr><td align=\"center\"><strong>"._NOFILES."</strong></td></tr>";
}
echo"</table>\n";
$tnamex=""._USER."";
                   Closetable();
                   $ihresult="SELECT DISTINCT ihuser from " . $prefix . "_imagehost";
                   echo"<br />";
          echo ihpagix($ihresult,$per_page,$pagenum,$tnamex,$taw);

 include("footer.php");
 }


function jd($taw){
global $module_name,$db,$cookie,$user,$quota,$max_size,$thumbwidth,$thumbheight,$sitename,$ihpath,$admin_file,$per_page,$pagenum;

include("header.php");

echo"<script type=\"text/javascript\" charset=\"UTF-8\" src=\"modules/$module_name/images/lightbox_plus.js\"></script>\n
<script>

function checkedAll (id, checked) {
	var el = document.getElementById(id);
	for (var i = 0; i < el.elements.length; i++) {
	  el.elements[i].checked = checked;
	}
      }

</script>
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


$usrinfo = $db->sql_fetchrow($db->sql_query("select * from ".$prefix."_users WHERE username='$taw'"));
$fileuser=$usrinfo['username'];
$filepath= "$ihpath$fileuser";
      Opentable();
                     echo" <div align=center><img src=\"modules/$module_name/images/logo.gif\" alt=\"$module_name\" title=\"$module_name\"></div>
                       <div align=\"center\">  <a href=\"$admin_file.php?op=imagehost\"><img src=\"modules/$module_name/images/imageh.gif\" border=\"0\"><strong>"._I_ADMIN." $module_name</strong></a></div>";
                         Closetable();
                    echo"<br />";
                    OpenTable();
                      echo "<div align=center><h1>$module_name "._OF." $fileuser</h1></div>";
                    CloseTable();
                    echo"<br />";
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

              echo "<form method=post action=\"$admin_file.php\" id=\"borrar\">\n
              <input type=hidden name=folder value=$taw>\n
              <input type=hidden name=\"op\" value=\"imagehostdel\">\n";
              for($i=0;$i<count($ihfile);$i++){
if($bgih == '#FFFFFF')$bgih = '#F5F5F5';
else $bgih = '#FFFFFF';
            echo "
            <tr bgcolor=$bgih>
            <td valign=top align=center><input type=checkbox name=arc[] value=\"".$ihfile."\"></td>
            <td align='center' valign='center' bordercolor='#000000'><a href=\"$filepath/$ihfile\" rel='lightbox'><img src=\"$filepath/$ihfile\" class=\"cimg\" alt=\"$title\" title=\"$title\" width=\"$width\" height=\"$height\" border=\"2\"></a>
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
            <td valign=middle align=center><strong>"._NOFILES."</strong></td>
            </tr>\n";
            }
    echo "

</table><br />\n";

CloseTable();
$tnamex=""._IMAGES."";
   $ihresult="SELECT * FROM ".$prefix."_imagehost WHERE ihuser='$fileuser'";
                   echo"<br />";
          echo ihpagix($ihresult,$per_page,$pagenum,$tnamex,$taw);
include("footer.php");
}

function imagehostdel($folder,$arc){
    global $module_name,$db,$cookie,$user,$prefix,$ihpath,$admin_file;


include("header.php");


$usrinfo = $db->sql_fetchrow($db->sql_query("select * from ".$prefix."_users WHERE username='$folder'"));
$filepath= "$ihpath".$usrinfo['username']."";



   if(is_admin($admin)){
          Opentable();
                     echo" <div align=center><img src=\"modules/$module_name/images/logo.gif\" alt=\"$module_name\" title=\"$module_name\"></div>
                       <div align=\"center\">  <a href=\"$admin_file.php?op=imagehost\"><img src=\"modules/$module_name/images/imageh.gif\" border=\"0\"><strong>"._I_ADMIN." $module_name</strong></a></div>";
                         Closetable();
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
       echo"<META HTTP-EQUIV=REFRESH CONTENT=\"9; URL=$admin_file.php?op=imagehost\">";

        echo "
        <div align=center>"._HDELE.". </div>";
	} else {
		echo "<div align=center>"._HNDELE.". </div>";
	}

     CloseTable();

}else {
 header ("Location: $admin_file.php");
 }

 include("footer.php");
 }
 function imagerm($rmdir) {
global $module_name,$db,$cookie,$user,$prefix,$ihpath,$admin_file;
     $dir="$ihpath$rmdir";
     include("header.php");
      Opentable();
                     echo" <div align=center><img src=\"modules/$module_name/images/logo.gif\" alt=\"$module_name\" title=\"$module_name\"></div>
                       <div align=\"center\"> <a href=\"$admin_file.php?op=imagehost\"><img src=\"modules/$module_name/images/imageh.gif\" border=\"0\"><strong>"._I_ADMIN." $module_name</strong></a></div>";
                         Closetable();
                         echo"<br />";
   $dir = str_replace("../", " ", $dir);
   if($files = glob($dir."/*")){

       foreach($files as $file) {
   is_dir($file)? rmdirr($file) : @unlink($file);
       }
   $db->sql_query("delete from " . $prefix . "_imagehost where ihuser='$rmdir'");
   }
   if(file_exists($dir)) {
   echo"<META HTTP-EQUIV=REFRESH CONTENT=\"9; URL=$admin_file.php?op=imagehost\">";
   opentable();

   @rmdir($dir) or die('Folder '.$dir.' couldn\'t be deleted!');

   echo "<div align=center>"._HDELE."</div>";
   closetable();
   } else {
   echo"<META HTTP-EQUIV=REFRESH CONTENT=\"9; URL=$admin_file.php?op=imagehost\">";
      opentable();
       echo "<div align=center>"._HNDELE.". </div>";
       closetable();
   }
   include("footer.php");
   }
function ihconfig(){
global $module_name,$db,$cookie,$user,$quota,$max_size,$thumbwidth,$thumbheight,$sitename,$ihpath,$admin_file,$per_page;
include("header.php");
 Opentable();
 echo" <div align=center><img src=\"modules/$module_name/images/logo.gif\" alt=\"$module_name\" title=\"$module_name\"></div>
 <div align=\"center\"> <a href=\"$admin_file.php?op=imagehost\"><img src=\"modules/$module_name/images/imageh.gif\" border=\"0\"><strong>"._I_ADMIN." $module_name</strong></a></div>";
 Closetable();
 echo"<br />";
 OpenTable();
 echo"
 <div align=\"center\"><h1><strong>"._CONFIG."</strong></div>\n";
 CloseTable();
 echo"<br />";
 OpenTable();
 echo"
 <form method=post action=\"$admin_file.php\" id=\"borrar\">\n
              <input type=hidden name=\"op\" value=\"ihsave\">\n
 <table align=\"center\">\n
 <tr><td width=\"250\">"._PATH."</td><td><input type=\"text\" name=xihpath value=\"$ihpath\"> ( ej: file/ = root/file/)</td></tr>\n
 <tr><td width=\"250\">"._QUOTA."</td><td><input type=\"text\" name=xquota value=\"".filesizepre("$quota")."\"> MB</td></tr>\n
 <tr><td width=\"250\">"._MAX."</td><td><input type=\"text\" name=xmax_size value=\"".filesizepre("$max_size")."\"> MB</td></tr>\n
 <tr><td width=\"250\">"._THUMW."</td><td><input type=\"text\" name=ithumbwidth value=\"$thumbwidth\"> px</td></tr>\n
 <tr><td width=\"250\">"._THUMH."</td><td><input type=\"text\" name=ithumbheight value=\"$thumbheight\"> px</td></tr>\n
 <tr><td width=\"250\">"._PAGE."</td><td><input type=\"text\" name=xper_page value=\"$per_page\"></td></tr>\n
 <tr><td colspan=\"2\" align=\"center\"><br /><input type=\"submit\" name=\"submit\" value=\""._SUBMIT."\"></form></td></tr>\n
 </table>\n
 ";
 CloseTable();

include("footer.php");
}

function ihsave($xihpath,$xquota,$xmax_size,$ithumbwidth,$ithumbheight,$xper_page){
global $admin_file,$module_name;
$xquota=squota($xquota);
$xmax_size=squota($xmax_size);
 saveconfig('ihpath', $xihpath);
 saveconfig('quota', $xquota);
 saveconfig('max_size', $xmax_size);
 saveconfig('thumbwidth', $ithumbwidth);
 saveconfig('thumbheight', $ithumbheight);
 saveconfig('per_page', $xper_page);
     include("header.php");
    Opentable();
 echo" <div align=center><img src=\"modules/$module_name/images/logo.gif\" alt=\"$module_name\" title=\"$module_name\"></div>
 <div align=\"center\"> <a href=\"$admin_file.php?op=imagehost\"><strong>"._I_ADMIN." $module_name</strong></a></div>";
 Closetable();
    echo "<br>\n";
    OpenTable();
    echo "<center><h4>"._CONFIG." "._SAVE."</h4></center>";
    echo "<table align=\"center\"><tr><td><form><input type=\"button\" value=\""._CONFIG."\" onclick=\"javascript:location='".$admin_file.".php?op=ihconfig';\"></form></td></tr></table>";
    CloseTable();
    include("footer.php");
  // header ("Location: $admin_file.php?op=ihconfig");

}
 function saveconfig($config_name, $config_value){
	global $prefix, $db;
	if (!get_magic_quotes_gpc()) { $config_value = addslashes($config_value); }

		$config_name = check_html($config_name, 'nohtml');
		$config_value = check_html($config_value, 'nohtml');
		$db -> sql_query("UPDATE ".$prefix."_ihconfig SET config_ihvalue='$config_value' WHERE config_ihname='$config_name'");

}
function ihinstall($ok){
        global $prefix, $db, $admin_file,$pagetitle,$module_name;


        include("header.php");
         OpenTable();
	echo "<center><font class=\"title\"><b>$module_name</font></b></center>";
	CloseTable();
	echo "<br>";
         if($ok==1){
          OpenTable();
     echo "<div align=center>"._STTEXT."<br>\n";
     echo "<hr>\n";
     	if($db->sql_query("CREATE TABLE ".$prefix."_ihconfig
        (`config_ihname` varchar(255) NOT NULL default '',
         `config_ihvalue` varchar(255) NOT NULL default '',
         PRIMARY KEY  (`config_ihname`)
         ) TYPE=MyISAM")){ echo "CREATE TABLE... "._COMPLETE."<br />\n";
				   }else{ echo "CREATE TABLE... "._FAILED."<br />\n";}

        if($db->sql_query("CREATE TABLE ".$prefix."_ihcategory
        (`id` int(20) NOT NULL auto_increment,
         `ihuser` varchar(255) NOT NULL,
         `title` varchar(255) NOT NULL default '',
         PRIMARY KEY  (`id`)
         ) TYPE=MyISAM AUTO_INCREMENT=1")){ echo "CREATE TABLE... "._COMPLETE."<br />\n";
				   }else{ echo "CREATE TABLE... "._FAILED."<br />\n";}

        if($db->sql_query("CREATE TABLE ".$prefix."_imagehost
        (`id` int(20) NOT NULL auto_increment,
         `title` varchar(255) NOT NULL default '',
         `ihuser` varchar(255) NOT NULL default '',
         `ihfile` text NOT NULL,
         `peso` int(11) NOT NULL default '0',
         `tamano` varchar(255) default NULL,
         `cate` int(11) default '0',
         `active` int(1) default '0',
         `dates` date NOT NULL default '0000-00-00',
         PRIMARY KEY  (`id`)
        ) TYPE=MyISAM AUTO_INCREMENT=1")){ echo "CREATE TABLE... "._COMPLETE."<br />\n";
				   }else{ echo "CREATE TABLE... "._FAILED."<br />\n";}



 //INSERT INTO
 		if($db->sql_query("INSERT INTO `".$prefix."_ihconfig` VALUES ('ih_id', '1');")) {echo "INSERT INTO... "._COMPLETE."<br />\n";
		}else {echo "INSERT INTO... "._FAILED."<br />\n";}

        if($db->sql_query("INSERT INTO `".$prefix."_ihconfig` VALUES ('max_size', '1572864');")) {echo "INSERT INTO... "._COMPLETE."<br />\n";
		}else {echo "INSERT INTO... "._FAILED."<br />\n";}

        if($db->sql_query("INSERT INTO `".$prefix."_ihconfig` VALUES ('quota', '5242880');")) {echo "INSERT INTO... "._COMPLETE."<br />\n";
		}else {echo "INSERT INTO... "._FAILED."<br />\n";}

        if($db->sql_query("INSERT INTO `".$prefix."_ihconfig` VALUES ('path', 'file/');")) {echo "INSERT INTO... "._COMPLETE."<br />\n";
		}else {echo "INSERT INTO... "._FAILED."<br />\n";}

        if($db->sql_query("INSERT INTO `".$prefix."_ihconfig` VALUES ('per_page', '10');")) {echo "INSERT INTO... "._COMPLETE."<br />\n";
		}else {echo "INSERT INTO... "._FAILED."<br />\n";}

        if($db->sql_query("INSERT INTO `".$prefix."_ihconfig` VALUES ('thumbwidth', '80');")) {echo "INSERT INTO... "._COMPLETE."<br />\n";
		}else {echo "INSERT INTO... "._FAILED."<br />\n";}

        if($db->sql_query("INSERT INTO `".$prefix."_ihconfig` VALUES ('thumbheight', '60');")) {echo "INSERT INTO... "._COMPLETE."<br />\n";
		}else {echo "INSERT INTO... "._FAILED."<br />\n";}

        if($db->sql_query("INSERT INTO `".$prefix."_ihconfig` VALUES ('ihversion', '2.5');")) {echo "INSERT INTO... "._COMPLETE."<br />\n";
		}else {echo "INSERT INTO... "._FAILED."<br />\n";}
 //the end INSERT INTO
   echo "<hr>\n";

        echo"<a href=\"".$admin_file.".php?op=imagehost\">"._ADMINISTRATION." $module_name</a></div>\n";
    CloseTable();
       }elseif($ok==2){
         OpenTable();

    echo "<div align=center>"._STTEXT."<br>\n";
       echo "<hr>\n";
       if($db->sql_query("DROP TABLE IF EXISTS ".$prefix."_ihconfig")){ echo "DROP TABLE... "._COMPLETE."<br />\n";
				   }else {echo "DROP TABLE... "._FAILED."<br />";}
        if($db->sql_query("DROP TABLE IF EXISTS ".$prefix."_ihcategory")) {echo "DROP TABLE... "._COMPLETE."<br />\n";
					}else{ echo "DROP TABLE... "._FAILED."<br />";}
        if($db->sql_query("DROP TABLE IF EXISTS ".$prefix."_imagehost")) {echo "DROP TABLE... "._COMPLETE."<br />\n";
    				}else{ echo "DROP TABLE... "._FAILED."<br />";}
      echo "<hr>\n";

        echo "<a href=\"".$admin_file.".php\">"._ADMINISTRATION."</a></div>\n";
    CloseTable();
         }else{
        OpenTable();
        if(!$db->sql_query("SELECT * FROM ".$prefix."_ihconfig")){
        $instal="<a href=\"".$admin_file.".php?op=ihinstall&ok=1\">"._INSTAL." $module_name</a>";
        }else{
        $instal="<a href=\"".$admin_file.".php?op=ihinstall&ok=2\">"._UINSTAL." $module_name</a>";
        }
        echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";

        echo "<tr><td align=center>"._BETEXT." $module_name.\n";
        echo "<br />==> <b>"._BATEXT."</b> <==</td></tr>\n";
        echo "<tr><td>
        <center><br>[ $instal ]</center>";
        echo "</td></tr>\n";
       echo "</table>\n";
        CloseTable();
        }

        include("footer.php");
}
 switch($op) {
 case "imagehost":
    imagehost();
    break;
    case "jd":
    jd($taw);
    break;
    case "imagehostdel":
    imagehostdel($folder,$arc);
    break;
    case "imagerm":
    imagerm($rmdir);
    break;
    case "ihconfig":
    ihconfig();
    break;
    case "saveconfig":
    saveconfig($config_name, $config_value);
    break;
    case "ihsave":
    ihsave($xihpath,$xquota,$xmax_size,$ithumbwidth,$ithumbheight,$xper_page);
    break;
    case "ihinstall":
    ihinstall($ok);
    break;
 default:
    imagehost();
    break;

}
 } else {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<center><b>"._ERROR."</b><br><br>You do not have administration permission for module \"$module_name\"</center>";
	CloseTable();
	include("footer.php");
}
?>