<?php
/*================================================================
	MODULO PHP NUKE  - TSMEMBERS VER 2.1 
	REALIZZATO DA Queen_live78 
	WWW.TUTTOSOFT.IT - PHP NUKE ITALIAN COMMUNITY -
	DATA : 20 DICEMBRE 2008
	TUTTI I DIRITTI RISERVATI
================================================================*/
if (!defined('MODULE_FILE')) {
	die ("Non puoi accedere direttamente a questo file ciao ciao....");
}

if (isset($show)) { 
    $show = intval($show); 
}
require_once("mainfile.php");
global $prefix, $db, $admin, $module_name,$perpage, $user, $admin_file;
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("config.php");
include("header.php");
$perpage = 8;
Opentable();
$dowuserstuttosoft=sql_query("select user_id from ".$prefix."_users order by user_id desc limit 0,1 ", $dbi);
list($dtot) = sql_fetch_row($dowuserstuttosoft, $dbi);
Opentable();
$anonimo= 2;
$cop = $anonimo - $dot;
CloseTable();
$variant = "Anonymous";
$fullcountresult=$db->sql_query("SELECT * FROM ".$prefix."_users");
	$totalselecteddownloads = $db->sql_numrows($fullcountresult);
	if (!isset($min)) $min=0;
    if (!isset($max)) $max=$min+$perpage;
    if ($show!="") {
	$perpage = $show;
    } else {
	$show=$perpage;
    }
    /*================================================================
	MODULO PHP NUKE  - TSMEMBERS VER 2.1 
	REALIZZATO DA Queen_live78 
	WWW.TUTTOSOFT.IT - PHP NUKE ITALIAN COMMUNITY -
	DATA : 20 DICEMBRE 2008
	TUTTI I DIRITTI RISERVATI
================================================================*/
    OpenTable();
echo "<table style=\"border-collapse:collapse;\" cellspacing=\"0\" align=\"center\" >
    <tr>
        <td width=\"100%\" style=\"border-width:1; border-color:black; border-style:none;\">
            <p align=\"center\"><font face=\"Verdana\"><span style=\"font-size:18pt;\"><img src=\"images/tsmembers/logotsmembers.gif\" width=\"320\" height=\"58\" border=\"0\"></span></font></p>
        </td>
    </tr>
    <tr>
        <td width=\"100%\" style=\"border-width:1; border-color:black; border-style:none;\">
            <p align=\"center\"><font face=\"Verdana\"><span style=\"font-size:18pt;\"><b></b></span></font></p>
        </td>
    </tr>
</table>";
CloseTable();


$cerca=mysql_query("Select * from ".$prefix."_users where username <> '$variant'ORDER BY user_id LIMIT $min,$perpage");
OpenTable();
echo "<br>Tutti gli utenti del sito:";
echo "<BR>";
echo "<BR>";
echo "<BR>";

while ($data = mysql_fetch_object($cerca))

{
$nomeid=stripslashes($data->user_id);
$nome=stripslashes($data->username);
$avatar=stripslashes($data->user_avatar);
$lingua=stripslashes($data->user_lang);
$post=stripslashes($data->user_posts);
$web=stripslashes($data->user_website);
$datareg=stripslashes($data->user_regdate);
$bull= "Utente registrato il $datareg attualmente nel forum ha effettuato $post post";
$bgcolots = "#F2F2F2";
OpenTable();
echo "<p align=\"center\"><table style=\"border-collapse:collapse;\" align=\"center\" cellspacing=\"0\" width=\"100%\">
    <tr>
        <td width=\"110\" height=\"109\" rowspan=\"7\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"center\">&nbsp;<img src=\"modules/Forums/images/avatars/$avatar\" width=\"110\" height=\"110\" border=\"0\"></p>
        </td>
        <td width=\"15\" height=\"16\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"center\"><font face=\"Verdana\"><span style=\"font-size:8pt;\"><img src=\"images/tsmembers/user.gif\" width=\"20\" height=\"20\" border=\"0\"><b> 
             </b></span></font></p>
        </td>
        <td width=\"100%\" height=\"16\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"left\"><font face=\"Verdana\"><span style=\"font-size:8pt;\">&nbsp;Username 
            :<b> </b></span></font><b><span style=\"font-size:8pt;\"><a href=\"modules.php?name=Your_Account&op=userinfo&username=$nome\"><font face=\"Verdana\" color=\"black\">$nome</font></a></span></b></p>
        </td>
    </tr>
    <tr>
        <td width=\"15\" height=\"12\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"center\"> 
            <font face=\"Verdana\"><span style=\"font-size:8pt;\"><img src=\"images/tsmembers/icon_dot.gif\" width=\"14\" height=\"9\" border=\"0\"></span></font></p>
        </td>
        <td width=\"100%\" height=\"12\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"left\"><font face=\"Verdana\"><span style=\"font-size:8pt;\">&nbsp;Registrato il<b> : </b></span></font><font face=\"Verdana\" color=\"#FF3300\"><span style=\"font-size:8pt;\"><b>$datareg</b></span></font></p>
        </td>
    </tr>
    <tr>
        <td width=\"15\" height=\"10\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"center\"> 
             <font face=\"Verdana\"><span style=\"font-size:8pt;\"><img src=\"images/tsmembers/post.gif\" width=\"17\" height=\"17\" border=\"0\"></span></font></p>
        </td>
        <td width=\"100%\" height=\"10\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"left\"><font face=\"Verdana\"><span style=\"font-size:8pt;\"><a href=\"modules.php?name=Private_Messages&file=index&mode=post&u=$nomeid\"><b>&nbsp;Inviagli un Msg Privato </b></span></a></font></p>
        </td>
    </tr>
    <tr>
        <td width=\"15\" height=\"15\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"center\"> 
            <font face=\"Verdana\"><span style=\"font-size:8pt;\"><img src=\"images/tsmembers/icon_community.gif\" width=\"20\" height=\"20\" border=\"0\"></span></font></p>
        </td>
        <td width=\"100%\" height=\"15\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"left\"><font face=\"Verdana\"><span style=\"font-size:8pt;\">&nbsp;Post :<b> </b></span></font><font face=\"Verdana\" color=\"#3366FF\"><span style=\"font-size:8pt;\"><b>$post</b></span></font></p>
        </td>
    </tr>
    <tr>
        <td width=\"15\" height=\"11\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"center\">  <font face=\"Verdana\"><span style=\"font-size:8pt;\"><img src=\"images/tsmembers/lingua.gif\" width=\"17\" height=\"17\" border=\"0\"></span></font></p>
        </td>
        <td width=\"100%\" height=\"11\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"left\">
            <font face=\"Verdana\"><span style=\"font-size:8pt;\"><b>&nbsp;Lingua : $lingua  </b></span></font></p>
        </td>
    </tr>
    <tr>
        <td width=\"15\" height=\"10\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"center\"> 
            <font face=\"Verdana\"><span style=\"font-size:8pt;\"><img src=\"images/tsmembers/icon_home.gif\" width=\"20\" height=\"20\" border=\"0\"></span></font></p>
        </td>
        <td width=\"100%\" height=\"10\" bgcolor=\"$bgcolorts\" style=\"border-width:0; border-color:black; border-style:solid;\">
            <p align=\"left\"><font face=\"Verdana\"><span style=\"font-size:8pt;\"></span></font><a href=\"$web\"><span style=\"font-size:8pt;\"><b><font face=\"Verdana\" color=\"#FF6699\">&nbsp;Website</font></b></span></a></p>
        </td>
    </tr>
  
</table>";
Closetable();
}
$downloadpagesint = ($totalselecteddownloads / $perpage);
    $downloadpageremainder = ($totalselecteddownloads % $perpage);
    if ($downloadpageremainder != 0) {
    	$downloadpages = ceil($downloadpagesint);
    	if ($totalselecteddownloads < $perpage) {
    		$downloadpageremainder = 0;
    	}
    } else {
    	$downloadpages = $downloadpagesint;
    }
Closetable();
OpenTable();
 if ($downloadpages!=1 && $downloadpages!=0) 
         {
    $counter = 1;
    $currentpage = ($max / $perpage);
    echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n<tr>\n";
    echo "<form action='' method='post'>\n";
    echo "<input type='hidden' name='min' value='".(($max - $perpage) - $perpage)."'>\n";
    echo "<td width='33%'>";
    if($currentpage <= 1) {
      echo "&nbsp;";
    } else {
      echo "<input type='submit' value='"._PREVPAGE."'>";
    }
    echo "</td>\n";
    echo "</form>\n";
    echo "<form action='' method='post'>\n";
    echo "<td align='center' width=34%'><nobr><b>"._SELECTPAGE.":</b> <select name='min'>\n";
    while ($counter <= $downloadpages ) {
      $cpage = $counter;
      $mintemp = ($perpage * $counter) - $perpage;
      echo "<option value='$mintemp'";
      if($counter == $currentpage) { echo " selected"; }
      echo ">$counter</option>\n";
      $counter++;
    }
    echo "</select><b> "._OF1." $downloadpages "._PAGES."</b> <input type='submit' value='"._GO."'></nobr></td>\n";
    echo "</form>\n";
    echo "<form action='' method='post'>\n";
    echo "<input type='hidden' name='min' value='".($max)."'>\n";
    echo "<td align='right' width='33%'>";
    if($currentpage >= $downloadpages) {
      echo "&nbsp;";
    } else {
      echo "<input type='submit' value='"._NEXTPAGE."'>";
    }
    echo "</td>\n";
    echo "</form>\n";
    echo "</tr>\n</table>\n";
  }
Closetable();
/*================================================================
	MODULO PHP NUKE  - TSMEMBERS VER 2.1 
	REALIZZATO DA Queen_live78 
	WWW.TUTTOSOFT.IT - PHP NUKE ITALIAN COMMUNITY -
	DATA : 20 DICEMBRE 2008
	TUTTI I DIRITTI RISERVATI
================================================================*/
OpenTable();
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
echo "  <tr>";
echo "    <td width=\"50%\" valign=\"top\"><div align=\"center\"><img src=images/tsmembers/sinewdown.gif>&nbsp;<b>Gli ultimi Utenti iscritti</b><br></div></td>";
echo "    <td width=\"50%\" valign=\"top\"><div align=\"center\"><img src=images/tsmembers/newdown.gif>&nbsp;<b>I 10 Utenti piu' Attivi</b><br></div></td>";
echo"  </tr>";
echo "  <tr>";
echo "<td width=\"50%\" valign=\"top\">";
$a = 1;
$result = $db->sql_query("select user_id, username, user_posts,user_avatar from ".$prefix."_users order by user_id DESC limit 0,10");
while ($row = $db->sql_fetchrow($result)) {
		$tid2 = intval($row['user_id']);
		$title = stripslashes($row['username']);
		$hits = intval($row['user_posts']);
		$avat = stripslashes($row['user_avatar']);
		$title2 = ereg_replace("_", " ", $title);
		$transfertitle = ereg_replace (" ", "_", $title);
		$linktitolo2= "<a href=\"modules.php?name=Your_Account&op=userinfo&username=$title\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$a)&nbsp;";
echo "$linktitolo2<img src=\"modules/Forums/images/avatars/$avat\" align=\"absmiddle\" width=\"32\" height=\"32\" border=\"0\">&nbsp;&nbsp;$title2</a> ";
echo "      [<b>$hits</b>]<br>";
$a++;
}
echo " </td>";
echo " <td width=\"50%\" valign=\"top\">";
$a = 1;
$result = $db->sql_query("select user_id, username, user_posts ,user_avatar from ".$prefix."_users order by user_posts DESC limit 0,10");
while ($row = $db->sql_fetchrow($result)) {
		$tid2 = intval($row['user_id']);
		$title = stripslashes($row['username']);
		$hits = intval($row['user_posts']);
		$avat = stripslashes($row['user_avatar']);
		$title2 = ereg_replace("_", " ", $title);
		$transfertitle = ereg_replace (" ", "_", $title);
		$linktitolo2= "<a href=\"modules.php?name=Your_Account&op=userinfo&username=$title\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$a)&nbsp;";
echo "$linktitolo2<img src=\"modules/Forums/images/avatars/$avat\" align=\"absmiddle\" width=\"32\" height=\"32\" border=\"0\">&nbsp;&nbsp;$title2</a> ";
echo "      [<b>$hits</b>]<br>";
$a++;
}
echo "</td>";
echo "  </tr>";
echo "</table>";
CloseTable();
Opentable();
/*================================================================
	MODULO PHP NUKE  - TSMEMBERS VER 2.1 
	REALIZZATO DA Queen_live78 
	WWW.TUTTOSOFT.IT - PHP NUKE ITALIAN COMMUNITY -
	DATA : 20 DICEMBRE 2008
	TUTTI I DIRITTI RISERVATI
================================================================*/
echo "<p align=\"right\"><span style=\"font-size:8pt;\"><font face=\"Verdana\"><a href=\"http://www.tuttosoft.it\"><b>©</b></a></font></span></p>";
Closetable();
include("footer.php");
/*================================================================
	MODULO PHP NUKE  - TSMEMBERS VER 2.1 
	REALIZZATO DA Queen_live78 
	WWW.TUTTOSOFT.IT - PHP NUKE ITALIAN COMMUNITY -
	DATA : 20 DICEMBRE 2008
	TUTTI I DIRITTI RISERVATI
================================================================*/
?>