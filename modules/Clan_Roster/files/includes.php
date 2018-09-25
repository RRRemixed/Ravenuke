<?php

if (!defined("MODULE_FILE"))
{
    exit("You can't access this file directly...");
}
global $db, $prefix, $admin_file, $module_name;
$module_name = "Clan_Roster";
$copyright = "modules/{$module_name}/copyright.php";
$filesize = filesize($copyright);
if (file_exists($copyright) && 2815 <= $filesize)
{
    function pubmenu()
    {
        global $db, $prefix, $admin_file, $module_name;
        $crfig = array();
        $sql = "SELECT * FROM ".$prefix."_croster_config";
        $result = $db->sql_query($sql);
        while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
        $crfig[$config_name] = $config_value;
        }
        echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='{$crfig['bcolor']}'>\n";
        echo "<tr><td align='center' colspan='1' class='option'><b><font color='{$crfig['hcolor']}'>Navigation</font></b></td></tr>\n";
        echo "<tr bgcolor='{$crfig['rcolor']}' align='center'>\n";
        echo "<td><center><b><a href='modules.php?name={$module_name}'>Main</a><strong>&nbsp;&nbsp;<font color='{$crfig['bcolor']}'>&middot;</font>&nbsp;&nbsp;</strong></b>";
        $ribboncount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons"));
        if ($crfig[cribbons] == 1 && 0 < $ribboncount)
        {
            echo "<b><a href='modules.php?name={$module_name}&amp;op=ribbons'>View Ribbons</a><b><strong>&nbsp;&nbsp;<font color='{$crfig['bcolor']}'>&middot;</font>&nbsp;&nbsp;</strong></b>";
        }
        echo "<b><a href='javascript:history.go(-1)'>Go Back</a><strong>&nbsp;&nbsp;<font color='{$crfig['bcolor']}'>&middot;</font>&nbsp;&nbsp;</strong></b>";
        echo "<b><a href='javascript:history.go(+1)'>Go Forward</a></b>";
        echo "</center>";
        echo "</td></tr>\n";
        $members = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members"));
        $activemembers = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members WHERE active='1'"));
        $inactivemembers = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members WHERE active='0'"));
        $ranks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ranks"));
        $ribboncount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons"));
        echo "<tr bgcolor='{$crfig['rcolor']}' align='center'>\n";
        echo "<td><center>";
        echo "<font color='{$crfig['bcolor']}'>[</font>&nbsp;Members:&nbsp;<b>{$members}</b>&nbsp;";
        if ($crfig['cranks'] == 1 || $crfig['cribbons'] == 1)
        {
            echo "<font color='{$crfig['bcolor']}'>||</font>&nbsp;";
        }
        if ($crfig['cranks'] == 1)
        {
            echo "Ranks:&nbsp;<b>{$ranks}</b>&nbsp;<font color='{$crfig['bcolor']}'>||</font>&nbsp;";
        }
        if ($crfig['cribbons'] == 1)
        {
            echo "Ribbons:&nbsp;<b>{$ribboncount}</b>&nbsp;";
        }
        echo "<font color='{$crfig['bcolor']}'>]</font>";
        echo "</center>";
        echo "</td></tr>\n";
        echo "</table>";
    }
    function usermenu($username, $uid)
    {
        global $db, $prefix, $admin_file, $module_name;
        $crfig = array();
        $sql = "SELECT * FROM ".$prefix."_croster_config";
        $result = $db->sql_query($sql);
	while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
        	$crfig[$config_name] = $config_value;
        }
        $colspan = 3;
        $userhardcount = $db->sql_numrows($db->sql_query("SELECT *  FROM ".$prefix."_croster_members_hardware where uid='{$uid}'"));
        $gamecount = $db->sql_numrows($db->sql_query("SELECT *  FROM ".$prefix."_croster_games"));
        if ($crfig[cgames] == 1 && 1 < $gamecount)
        {
            $colspan = $colspan + 1;
        }
        else if (1 <= $userhardcount)
        {
            $colspan = $colspan + 1;
        }
        echo "<center><table width='100%' cellpadding='1' cellspacing='1' bgcolor='{$crfig['bcolor']}'>\n";
        echo "<tr><td align='center' colspan='{$colspan}' class='option'><b><font color='{$crfig['hcolor']}'></font></b></td></tr>\n";
        $sql = "SELECT * FROM ".$prefix."_croster_members where username='{$username}' AND uid='{$uid}' AND active='1'";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result))
        {
            $uid = intval($row['uid']);
            $gid = intval($row['gid']);
            $username = $row['username'];
            $cusername = $row['cusername'];
            if ($crfig[cgames] == 1 && 1 < $gamecount)
            {
                $sql2 = "SELECT * FROM ".$prefix."_croster_games WHERE cgid='{$gid}'";
                $result2 = $db->sql_query($sql2);
                $row2 = $db->sql_fetchrow($result2);
                $gtitle = $row2['gtitle'];
                $gabbrev = $row2['gabbrev'];
                $gimage = $row2['gimage'];
                if ($crfig[ugimg] == 1)
                {
                    $gout = "<img src='{$crfig['gamepath']}/{$gimage}' alt='{$gtitle}'>";
                }
                else if ($crfig['ugabbrev'] == 1)
                {
                    $gout = $gabbrev;
                }
                else
                {
                    $gout = $gtitle;
                }
            }
        }
        echo "<tr bgcolor='{$crfig['rcolor']}' align='center'>\n";
        echo "<td width='25%'><center><a href='modules.php?name={$module_name}&amp;op=profile&amp;uid={$uid}&amp;username={$username}'>{$crfig['ctag']}{$cusername}</a></center></td>";
        if ($crfig[cgames] == 1 && 1 < $gamecount)
        {
            echo "<td width='25%'><center>{$gout}</center></td>\n";
        }
        echo "<td width='25%'><center><a href='modules.php?name={$module_name}&amp;op=editprofile&amp;username={$username}&amp;uid={$uid}'>Edit Profile</a></center></td>";
        if ($crfig[uhard] == 1 && 1 <= $userhardcount)
        {
            echo "<td width='25%'><center><a href='modules.php?name={$module_name}&amp;op=edithardware&amp;username={$username}&amp;uid={$uid}'>Edit Hardware</a></center></td>";
        }
        echo "</tr>";
        echo "</table>";
    }
    function do_age($birthday, $birthmonth, $birthyear)
    {
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $yearsold = $year - $birthyear;
        if ($birthday <= $day && $birthmonth <= $month && date("Y") == $year)
        {
            $yearsold = $yearsold;
        }
        else
        {
            $yearsold = $yearsold - 1;
        }
        if ($birthday == 0 && $birthmonth == 0 && $birthyear == 0)
        {
            $yearsold = "";
        }
        return $yearsold;
    }
    function scale_size($filename, $max)
    {
        list( $width, $height, $type, $attr ) = getimagesize( $filename );
        if ($width <= $max && $height <= $max)
        {
            $return = array($width, $height);
        }
        else
        {
            $k = $height <= $width ? $width / $max : $height / $max;
            $width = floor($width / $k);
            $height = floor($height / $k);
            $return = array($width, $height);
        }
        return $return;
    }
    function thumb_img($image, $type, $imgdir, $destdir)
    {
        $size = scale_size($imgdir."/".$image, 250);
        $thumbwidth = $size[0];
        $thumbheight = $size[1];
        $type = strtolower($type);
        if ($type == "jpeg" || $type == "jpg")
        {
            thumb_jpeg($image, $thumbwidth, $thumbheight, $imgdir, $destdir);
        }
        else if ($type == "png")
        {
            thumb_png($image, $thumbwidth, $thumbheight, $imgdir, $destdir);
        }
        else if ($type == "gif")
        {
            thumb_gif($image, $thumbwidth, $thumbheight, $imgdir, $destdir);
        }
        else
        {
            echo "<center>Sorry, only jpg, gif, and png files can be resized<br></center>";
        }
    }
    function thumb_jpeg($image, $thumbwidth, $thumbheight, $spath, $dpath)
    {
        $destimg = imagecreatetruecolor($thumbwidth, $thumbheight);
        $srcimg = imagecreatefromjpeg($spath."/".$image);
        imagecopyresized($destimg, $srcimg, 0, 0, 0, 0, $thumbwidth, $thumbheight, imagesx($srcimg), imagesy($srcimg));
        imagejpeg($destimg, $dpath."/".$image);
    }
    function thumb_png($image, $thumbwidth, $thumbheight, $spath, $dpath)
    {
        $destimg = imagecreatetruecolor($thumbwidth, $thumbheight);
        $srcimg = imagecreatefrompng($spath."/".$image);
        imagecopyresized($destimg, $srcimg, 0, 0, 0, 0, $thumbwidth, $thumbheight, imagesx($srcimg), imagesy($srcimg));
        imagepng($destimg, $dpath."/".$image);
    }
    function thumb_gif($image, $thumbwidth, $thumbheight, $spath, $dpath)
    {
        $destimg = imagecreatetruecolor($thumbwidth, $thumbheight);
        $srcimg = imagecreatefromgif($spath."/".$image);
        imagecopyresized($destimg, $srcimg, 0, 0, 0, 0, $thumbwidth, $thumbheight, imagesx($srcimg), imagesy($srcimg));
        imagejpeg($destimg, $dpath."/".$image);
    }
}
else
{
    opentable();
    echo "<center><font color='red' size='1'>ERROR! Illegal Copy</font><br />The copyright.php file is missing from the Clan Roster module folder or the filesize has been altered. You will have to restore it to use this module.</center>";
    closetable();
}
?>
