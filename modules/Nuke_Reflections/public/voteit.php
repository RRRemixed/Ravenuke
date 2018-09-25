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








if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


global $user, $cookie, $reflecnick, $prefix, $db, $user_prefix, $row, $admin;

if ($fileid == "") {

$davotestatus = "Vote was not entered Correctly... No Id was Selected...";
}



if ($guestvote == "1") {
} else if (is_user($user)) {
} else if (is_admin($admin)) {
} else {

$davotestatus = "Vote was not entered Correctly... Registered And Logged in member and only admins can vote...";
}

if ($vote == "") {
$davotestatus = "Vote was not entered Correctly... No Vote Selected...";
}

$supperman = strlen($vote);

if ($supperman < "2") {
$davotestatus = "Vote was not entered Correctly... Incorrect Vote Code...";
}

if ($supperman > "2") {
$davotestatus = "Vote was not entered Correctly... Incorrect Vote Code...";
}

if ($vote == "00") {
$davotestatus = "Vote was not entered Correctly... You cannot vote 0...";

}

if ($vote > "10") {
$davotestatus = "Vote was not entered Correctly... You cannot vote over 10...";

}






$today = date("Y-m-d");
$datime = date("h:i:s"); // e.g. 17:16:17

$sql = "SELECT * FROM " . $user_prefix . "_reflections_files where picid='$fileid' LIMIT 1";
$result = mysql_query($sql) or die ('SQL Select Failed!!');
$num = mysql_numrows($result);
$i = 0;
while ($i < $num) {
    $filepicid = mysql_result($result, $i, "picid");
    $filemaingalid = mysql_result($result, $i, "galid");
    $filepicname = mysql_result($result, $i, "picname");
    $filepicdesc = mysql_result($result, $i, "picdesc");
    $filefilename = mysql_result($result, $i, "filename");
    $fileupnick = mysql_result($result, $i, "upnick");
    $fileip = mysql_result($result, $i, "ip");
    $filedate = mysql_result($result, $i, "date");
    $filetime = mysql_result($result, $i, "time");
    $filerawtime = mysql_result($result, $i, "rawtime");
    $fileapproved = mysql_result($result, $i, "approved");
    $fileone = mysql_result($result, $i, "one");
    $filetwo = mysql_result($result, $i, "two");
    $filethree = mysql_result($result, $i, "three");
    $filefour = mysql_result($result, $i, "four");
    $filefive = mysql_result($result, $i, "five");
    $filesix = mysql_result($result, $i, "six");
    $fileseven = mysql_result($result, $i, "seven");
    $fileeight = mysql_result($result, $i, "eight");
    $filenine = mysql_result($result, $i, "nine");
    $fileten = mysql_result($result, $i, "ten");
    $filetotalvote = mysql_result($result, $i, "totalvote");
    $fileadvarage = mysql_result($result, $i, "advarage");
    $filelastvote = mysql_result($result, $i, "lastvote");
    $filetotalscore = mysql_result($result, $i, "totalscore");
    $filelastvotenick = mysql_result($result, $i, "lastvotenick");
    $filetotalcomments = mysql_result($result, $i, "totalcomments");
    $filetotalview = mysql_result($result, $i, "totalview");
    $filegalactive = mysql_result($result, $i, "galactive");
    $filetotalreports = mysql_result($result, $i, "totalreports");
    $filekeywords = mysql_result($result, $i, "keywords");
    $filelastseennick = mysql_result($result, $i, "lastseennick");
    $fileextra1 = mysql_result($result, $i, "extra1");
    $fileextra2 = mysql_result($result, $i, "extra2");
    $filepassword = mysql_result($result, $i, "galpassword");
    $filefolder = mysql_result($result, $i, "infolder");

    $i++;
    }

if ($filepicid == "") {
$davotestatus = "Vote was not entered Correctly... File ID not in system...";

}

if ($davotestatus == "") {


$past = time() - $voterestriction;
$sql = "DELETE FROM " . $prefix . "_reflections_votetimes WHERE rawtime < $past";
$db->sql_query($sql);

$filecode = $fileid;
$useripaddy = getenv("REMOTE_ADDR");
if (is_user($user)) {
    $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_votetimes where nick='$cookie[1]' AND picid='$filecode'"));
    $supergreat = "$cookie[1]";

} else {
    $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_votetimes where ipaddy='$useripaddy' AND picid='$filecode'"));
    $supergreat = "$useripaddy";

}
$viewcountcheck = $row6['rawtime'];
if ($viewcountcheck == "" || $viewcountcheck == "0") {
if ($vote == "01") {
    $new01 = $fileone + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 1;
    $latrate = 1;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', one='$new01' WHERE picid='$fileid'");
}

if ($vote == "02") {
    $new01 = $filetwo + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 2;
    $latrate = 2;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', two='$new01' WHERE picid='$fileid'");
}

if ($vote == "03") {
    $new01 = $filethree + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 3;
    $latrate = 3;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', three='$new01' WHERE picid='$fileid'");
}

if ($vote == "04") {
    $new01 = $filefour + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 4;
    $latrate = 4;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', four='$new01' WHERE picid='$fileid'");
}

if ($vote == "05") {
    $new01 = $filefive + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 5;
    $latrate = 5;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', five='$new01' WHERE picid='$fileid'");
}

if ($vote == "06") {
    $new01 = $filesix + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 6;
    $latrate = 6;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', six='$new01' WHERE picid='$fileid'");
}

if ($vote == "07") {
    $new01 = $fileseven + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 7;
    $latrate = 7;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', seven='$new01' WHERE picid='$fileid'");
}

if ($vote == "08") {
    $new01 = $fileeight + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 8;
    $latrate = 8;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', eight='$new01' WHERE picid='$fileid'");
}

if ($vote == "09") {
    $new01 = $filenine + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 9;
    $latrate = 9;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', nine='$new01' WHERE picid='$fileid'");
}

if ($vote == "10") {
    $new01 = $fileten + 1;
    $newtotal = $filetotalvote + 1;
    $newscore = $filetotalscore + 10;
    $latrate = 10;
    $db->sql_query("update " . $prefix . "_reflections_files set lastvotenick='$reflecnick', lastvote='$latrate', totalscore='$newscore', totalvote='$newtotal', ten='$new01' WHERE picid='$fileid'");
}

if ($vote != "") {

$avaragescore = round($newscore / $newtotal, 1);
$db->sql_query("update ".$prefix."_reflections_files set advarage='$avaragescore' WHERE picid='$fileid'");


$davotestatus = "Thank you for your Vote of $vote for File $fileid";

}
		$cooltime = time();
        $sql = "INSERT INTO `" . $user_prefix . "_reflections_votetimes` (`id`, `picid`, `nick`, `ipaddy`, `rawtime`) VALUES ('', '$filecode', '$cookie[1]', '$useripaddy', '$cooltime')";
        mysql_query($sql);
} else {
		$cooltime = time();
        $difference = $cooltime - $viewcountcheck;

        if ($difference < 60) {
            $timeleft = $difference . " seconds ago";
        } else {
            $difference = round($difference / 60);
            if ($difference < 60)
                $timeleft = $difference . " minutes ago";
            else {
                $difference = round($difference / 60);
                if ($difference < 24)
                    $timeleft = $difference . " hours ago";
                else {
                    $difference = round($difference / 24);
                    if ($difference < 7)
                        $timeleft = $difference . " days ago";
                    else {
                        $difference = round($difference / 7);
                        $timeleft = $difference . " weeks ago";
                    }
                }
            }
        }


        if ($voterestriction < 60) {
            $timeleft1 = $voterestriction . " seconds";
        } else {
            $voterestriction = round($voterestriction / 60);
            if ($voterestriction < 60)
                $timeleft1 = $voterestriction . " minutes";
            else {
                $voterestriction = round($voterestriction / 60);
                if ($difference < 24)
                    $timeleft1 = $voterestriction . " hours";
                else {
                    $voterestriction = round($voterestriction / 24);
                    if ($voterestriction < 7)
                        $timeleft1 = $voterestriction . " days";
                    else {
                        $voterestriction = round($voterestriction / 7);
                        $timeleft1 = $voterestriction . " weeks";
                    }
                }
            }
        }


$davotestatus = "You can only vote on this Image once in $timeleft1. You voted on this $timeleft";

    }

}

$arleighdaman = $davotestatus;



?>