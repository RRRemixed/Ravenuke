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






global $user, $cookie, $reflecnick, $prefix, $db, $user_prefix, $row, $admin;

$T1 = devilcleanitup($T1);
$filepicid = devilcleanitup($filepicid);






if ($filepicid == "") {
    $davotestatus = "Comment was not entered Correctly... No Id was Selected...";
}

$filecode = $filepicid;

if ($allowguestcomment == "1" || is_user($user) || is_admin($admin)) {
} else {
    $davotestatus = "Comment was not entered Correctly... Registered And Logged in member and only admins can vote...";
}

if ($T1 == "") {
    $davotestatus = "Comment was not entered Correctly... No Comment Text Entered...";
}

if ($davotestatus == "") {
    $counttimmer = round(5 * 60);
    $past = time() - $counttimmer;
    $sql = "DELETE FROM " . $prefix . "_reflections_anticomflood WHERE rawtime < $past";
    $db->sql_query($sql);

    $filecode = $fileid;
    $useripaddy = getenv("REMOTE_ADDR");
    if (is_user($user)) {
        $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_anticomflood where nick='$cookie[1]' AND picid='$filecode' AND comment='$T1'"));
        $supergreat = "$cookie[1]";
    } else {
        $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_anticomflood where ipaddy='$useripaddy' AND picid='$filecode' AND comment='$T1'"));
        $supergreat = "$useripaddy";
    }
    $viewcountcheck = $row6['rawtime'];
    if ($viewcountcheck == "" || $viewcountcheck == "0") {




	$securitycode = devilcleanitup($securitycode);
	$securitycode1 = devilcleanitup($securitycode1);
	$securitycode1 = md5($securitycode1);


if ($commentsecurity != "1") {
	        // add it all
         $cooltime = time();
$today = date("Y-m-d");
$datime = date("h:i:s"); // e.g. 17:16:17
$sql = "INSERT INTO `" . $user_prefix . "_reflections_comments` (`comid`, `picid`, `galid`, `comment`, `date`, `time`, `rawtime`, `bynick`, `byipaddy`) VALUES ('', '$filecode', '$filemaingalid', '$T1', '$today', '$datime', '$cooltime', '$reflecnick', '$useripaddy' )";
mysql_query($sql);
        $davotestatus = "Thank you for your Comment for File $filepicid";
        $filetotalcomments = $filetotalcomments +1;
                 $cooltime = time();
    $db->sql_query("update " . $prefix . "_reflections_files set totalcomments='$filetotalcomments' WHERE picid='$filepicid'");
        $sql = "INSERT INTO `" . $user_prefix . "_reflections_anticomflood` (`id`, `picid`, `nick`, `ipaddy`, `rawtime`, `comment`) VALUES ('', '$filecode', '$cookie[1]', '$useripaddy', '$cooltime', '$T1')";
        mysql_query($sql);
            $db->sql_query("update " . $prefix . "_reflections_files set lastcommenttime='$cooltime' WHERE picid='$filepicid'");
} else {

	if ($securitycode == $securitycode1) {
	        // add it all
         $cooltime = time();
$today = date("Y-m-d");
$datime = date("h:i:s"); // e.g. 17:16:17
$sql = "INSERT INTO `" . $user_prefix . "_reflections_comments` (`comid`, `picid`, `galid`, `comment`, `date`, `time`, `rawtime`, `bynick`, `byipaddy`) VALUES ('', '$filecode', '$filemaingalid', '$T1', '$today', '$datime', '$cooltime', '$reflecnick', '$useripaddy' )";
mysql_query($sql);
        $davotestatus = "Thank you for your Comment for File $filepicid";
        $filetotalcomments = $filetotalcomments +1;
    $db->sql_query("update " . $prefix . "_reflections_files set totalcomments='$filetotalcomments' WHERE picid='$filepicid'");
        $sql = "INSERT INTO `" . $user_prefix . "_reflections_anticomflood` (`id`, `picid`, `nick`, `ipaddy`, `rawtime`, `comment`) VALUES ('', '$filecode', '$cookie[1]', '$useripaddy', '$cooltime', '$T1')";
        mysql_query($sql);
} else {
//bad
$davotestatus = "Security Code is incorrect for your comment. Please try again!";

}
}





    } else {
        $davotestatus = "Repeat Comment has been detected. You must have hit refresh.";
    }
}




$arleighdaman = $davotestatus;

?>