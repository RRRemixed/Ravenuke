<?php
/********************************************************************/
/* SN Dynamic Titles Addon                                          */  
/* ===========================                                      */
/* Copyright (c) 2003 by Greg Schoper                               */
/* http://nuke.schoper.net                                          */
/*                                                                  */
/* Based on code from PHP-Nuke                                      */
/* Copyright (c) 2002 by Francisco Burzi                            */
/* http://phpnuke.org                                               */
/*                                                                  */
/* This program is free software. You can redistribute it and/or    */
/* modify it under the terms of the GNU General Public License as   */
/* published by the Free Software Foundation; either version 2 of   */
/* the License.                                                     */
/********************************************************************/
/* Credit to unknown author of original forums code in              */
/* includes/dynamic_titles.php.                                     */
/********************************************************************/

if (eregi("dynamic_titles.php",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}

// Item Delimeter
$item_delim = ">>";

$newpagetitle = "";
global $name;
include ("config.php");
include("db/db.php");

// Forums
if($name=="Forums"){
global $p,$t,$forum,$f;
$newpagetitle = "$name"; 
    if($p) { 
        $sql = "SELECT post_subject, post_id FROM ".$prefix."_bbposts_text WHERE post_id='$p'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $title = $row[post_subject]; 
        $post = $row[post_id]; 

        $newpagetitle = "$name $item_delim Post $post $item_delim $title"; 
    } 
    if($t) { 
        $sql = "SELECT topic_title, forum_id FROM ".$prefix."_bbtopics WHERE topic_id='$t'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $title = $row[topic_title]; 
        $forum = $row[forum_id]; 

        $sql = "SELECT forum_name FROM ".$prefix."_bbforums WHERE forum_id='$forum'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $forum = $row[forum_name]; 
        $newpagetitle = "$item_delim $name $item_delim $forum $item_delim $title"; 
    } 
    elseif($f) { 
        $sql = "SELECT forum_name FROM ".$prefix."_bbforums WHERE forum_id='$f'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $forum = $row[forum_name]; 
        $newpagetitle = "$item_delim $name $item_delim $forum"; 
    }
}

// News
if($name=="News"){
global $file,$sid,$new_topic;
$newpagetitle= "$item_delim $name";
    if ($new_topic!=""){
	    $sql = "SELECT topictext FROM ".$prefix."_topics WHERE topicid='$new_topic'";
		$result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $top = $row[topictext];
        $newpagetitle= "$item_delim $top";
	}
    if ($file=="article"){
	    $sql = "SELECT title, topic FROM ".$prefix."_stories WHERE sid='$sid'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $art = $row[title];
        $top = $row[topic];
		$sql = "SELECT topictext FROM ".$prefix."_topics WHERE topicid='$top'";
		$result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $top = $row[topictext];
        $newpagetitle= "$item_delim $top $item_delim $art";
    }
}

// Topics
if($name=="Topics"){
$newpagetitle = "$item_delim "._ACTIVETOPICS."";
}

// Downloads
if($name=="Downloads"){
global $d_op,$cid,$lid;
$newpagetitle = "$item_delim $name"; 
    if($d_op=="viewdownload") {
        $sql = "SELECT title, parentid FROM ".$prefix."_downloads_categories WHERE cid='$cid'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $cat = $row[title]; 
        $parent = $row[parentid];
            if($parent=="0"){
                $newpagetitle = "$item_delim $name $item_delim $cat";
            }
            else{
                $sql = "SELECT title FROM ".$prefix."_downloads_categories WHERE cid='$parent'";
                $result = $db->sql_query($sql); 
                $row = $db->sql_fetchrow($result);
                $parent = $row[title];
                $newpagetitle = "$item_delim $name $item_delim $parent $item_delim $cat";
            }
    }
	if($d_op=="viewdownloaddetails" || $d_op=="getit") {
	    $sql = "SELECT title FROM ".$prefix."_downloads_downloads WHERE lid='$lid'";
		$result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result);
		$dl = $row[title];
		$newpagetitle = "$item_delim $name $item_delim $dl";
	}
}

// Web Links
if($name=="Web_Links"){
global $l_op,$cid,$lid;
$name=ereg_replace("_", " ", "$name");
$newpagetitle = "$item_delim $name"; 
    if($l_op=="viewlink") {
        $sql = "SELECT title, parentid FROM ".$prefix."_links_categories WHERE cid='$cid'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $cat = $row[title]; 
        $parent = $row[parentid];
            if($parent=="0"){
                $newpagetitle = "$item_delim $name $item_delim $cat";
            }
            else{
                $sql = "SELECT title FROM ".$prefix."_links_categories WHERE cid='$parent'";
                $result = $db->sql_query($sql); 
                $row = $db->sql_fetchrow($result);
                $parent = $row[title];
                $newpagetitle = "$item_delim $name $item_delim $parent $item_delim $cat";
            }
    }
}

// Content
if($name=="Content"){
global $pa,$cid,$pid;
$newpagetitle = "$item_delim $name"; 
    if($pa=="list_pages_categories") {
        $sql = "SELECT title FROM ".$prefix."_pages_categories WHERE cid='$cid'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $cat = $row[title]; 
        $newpagetitle = "$item_delim $name $item_delim $cat";
    }
    if($pa=="showpage") {
	    $sql = "SELECT title, cid FROM ".$prefix."_pages WHERE pid='$pid'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $page = $row[title];
		$cid = $row[cid];
		$sql = "SELECT title FROM ".$prefix."_pages_categories WHERE cid='$cid'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $cat = $row[title]; 
        $newpagetitle = "$item_delim $name $item_delim $cat $item_delim $page";
	}
}

// Reviews
if($name=="Reviews"){
global $rop,$id;
$newpagetitle = "$item_delim $name";
    if($rop=="showcontent") {
        $sql = "SELECT title FROM ".$prefix."_reviews WHERE id='$id'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $rev = $row[title]; 
        $newpagetitle = "$item_delim $name $item_delim $rev";
    }
}

// Stories Archive
if($name=="Stories_Archive"){
global $sa,$year,$month_l;
$name=ereg_replace("_", " ", "$name");
$newpagetitle = "$item_delim $name";
    if($sa=="show_month") {
        $newpagetitle = "$item_delim $name $item_delim $month_l, $year";
    }
}

// Sections
if($name=="Sections"){
global $op,$secid,$artid;
$newpagetitle = "$item_delim $name"; 
    if($op=="listarticles") {
        $sql = "SELECT secname FROM ".$prefix."_sections WHERE secid='$secid'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $sec = $row[secname]; 
        $newpagetitle = "$item_delim $name $item_delim $sec";
    }
    if($op=="viewarticle") {
	    $sql = "SELECT title, secid FROM ".$prefix."_seccont WHERE artid='$artid'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $art = $row[title];
		$cid = $row[secid];
		$sql = "SELECT secname FROM ".$prefix."_sections WHERE secid='$cid'"; 
        $result = $db->sql_query($sql); 
        $row = $db->sql_fetchrow($result); 
        $sec = $row[secname]; 
        $newpagetitle = "$item_delim $name $item_delim $sec $item_delim $art";
	}
}

// Catchall for anything we don't have custom coding for
if($newpagetitle==""){
    $name=ereg_replace("_", " ", "$name");
    $newpagetitle="$item_delim $name";
}

// Admin Pages
if(substr($_SERVER['REQUEST_URI'], 0, 10)=="/admin.php"){
    $newpagetitle="$item_delim Administration";
} 

// If we're on the main page let's use our site slogan
if($_SERVER['REQUEST_URI']=="/index.php" || $_SERVER['REQUEST_URI']=="/"){
    $newpagetitle="$item_delim $slogan";
}

// We're Done! Place the Title on the page
echo "<title>$sitename $newpagetitle</title>\n";

?>