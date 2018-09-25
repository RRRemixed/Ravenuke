<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
//########################################################################
//
// nukeWYSIWYG Copyright (c) 2005 Kevin Guske    http://nukeseo.com
// kses developed by Ulf Harnhammar              http://kses.sf.net
// kses ideas contributed by sixonetonoffun      http://netflake.com
// FCKeditor by Frederico Caldeira Knabben       http://fckeditor.net
// Original FCKeditor for PHP-Nuke by H.Theisen  http://phpnuker.de
//
//########################################################################

if ( !defined('ADMIN_FILE') ) {
	die ('Access Denied');
}

global $prefix, $db, $admin_file;

$module_name = 'News';

$aid = substr($aid, 0,25);
$query = $db->sql_query('SELECT title, admins FROM '.$prefix.'_modules where title=\''.$module_name.'\'');
list($title, $admins) = $db->sql_fetchrow($query);
$query2 = $db->sql_query('SELECT name, radminsuper FROM '.$prefix.'_authors where aid=\''.$aid.'\'');
list($name, $radminsuper) = $db->sql_fetchrow($query2);
$admins = explode(',', $admins);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($name == $admins[$i] AND !empty($admins)) {
        $auth_user = 1;
    }
}

if ($radminsuper == 1 || $auth_user == 1) {
	if (!isset($ok)) { $ok = 0; }
	if (!isset($sid)) $sid = '';
	if (!isset($op)) $op = '';
	if (!isset($cat)) $cat = '';
	if (!isset($catid)) $catid = '';
	if (!isset($newcat)) $newcat = '';
	if (!isset($ctitle)) $ctitle = '';
	if (!isset($qid)) $qid = '';
	if (!isset($assotop)) { $assotop = ''; }

	switch($op) {
		case 'EditCategory':
			EditCategory($catid);
			break;

		case 'subdelete':
			csrf_check();
			subdelete();
			break;

		case 'DelCategory':
			//csrf_check in function
			DelCategory($cat);
			break;

		case 'YesDelCategory':
			csrf_check();
			YesDelCategory($catid);
			break;

		case 'NoMoveCategory':
			//csrf_check in function
			NoMoveCategory($catid, $newcat);
			break;

		case 'SaveEditCategory':
			csrf_check();
			SaveEditCategory($catid, $ctitle);
			break;

		case 'SelectCategory':
			SelectCategory($cat);
			break;

		case 'AddCategory':
			AddCategory();
			break;

		case 'SaveCategory':
			csrf_check();
			SaveCategory($ctitle);
			break;

		case 'DisplayStory':
			displayStory($qid);
			break;

		case 'PreviewAgain':
			previewStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
			break;

		case 'PostStory':
			csrf_check();
			postStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
			break;

		case 'EditStory':
			editStory($sid);
			break;

		case 'RemoveStory':
			//csrf_check in function
			removeStory($sid, $ok);
			break;

		case 'ChangeStory':
			csrf_check();
			changeStory($sid, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $assotop);
			break;

		case 'DeleteStory':
			csrf_check();
			deleteStory($qid);
			break;

		case 'adminStory':
			adminStory($sid);
			break;

		case 'PreviewAdminStory':
			previewAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
			break;

		case 'PostAdminStory':
			csrf_check();
			postAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
			break;

		case 'autoDelete':
			csrf_check();
			autodelete($anid);
			break;

		case 'autoEdit':
			autoEdit($anid);
			break;

		case 'autoSaveEdit':
			csrf_check();
			autoSaveEdit($anid, $year, $day, $month, $hour, $min, $story_title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm);
			break;

		case 'submissions':
			submissions();
			break;
    }
} else {
	include_once 'header.php';
	GraphicAdmin();
	OpenTable();
	echo '<center><b>'._ERROR.'</b><br /><br />You do not have administration permission for module \''.$module_name.'\'</center>';
	CloseTable();
	include_once 'footer.php';
}
die();
/*********************************************************/
/* Story/News Functions                                  */
/*********************************************************/

function puthome($ihome, $acomm) {
    echo '<br /><b>'._PUBLISHINHOME.'</b>&nbsp;&nbsp;';
    if (($ihome == 0) OR (empty($ihome))) {
        $sel1 = 'checked="checked"';
        $sel2 = '';
    }
    if ($ihome == 1) {
        $sel1 = '';
        $sel2 = 'checked="checked"';
    }
    echo '<input type="radio" name="ihome" value="0" '.$sel1.' />'._YES.'&nbsp;'
        .'<input type="radio" name="ihome" value="1" '.$sel2.' />'._NO
        .'&nbsp;&nbsp;<font class="content">[ '._ONLYIFCATSELECTED.' ]</font><br />';

    echo '<br /><b>'._ACTIVATECOMMENTS.'</b>&nbsp;&nbsp;';
    if (($acomm == 0) OR (empty($acomm))) {
        $sel1 = 'checked="checked"';
        $sel2 = '';
    }
    if ($acomm == 1) {
        $sel1 = '';
        $sel2 = 'checked="checked"';
    }
    echo '<input type="radio" name="acomm" value="0" '.$sel1.' />'._YES.'&nbsp;'
    .'<input type="radio" name="acomm" value="1" '.$sel2.' />'._NO.'<br /><br />';
}

function deleteStory($qid) {
    global $prefix, $db, $admin_file;
    $qid = intval($qid);
    $result = $db->sql_query('delete from '.$prefix.'_queue where qid=\''.$qid.'\'');
    if (!$result) {
        return;
        die();
    }
    Header('Location: '.$admin_file.'.php?op=submissions');
}

function SelectCategory($cat) {
    global $prefix, $db, $admin_file;
    $selcat = $db->sql_query('select catid, title from '.$prefix.'_stories_cat order by title');
    $a = 1;
    echo '<b>'._CATEGORY.'</b> ';
    echo '<select name="catid">';
    if ($cat == 0) {
        $sel = 'selected="selected"';
    } else {
        $sel = '';
    }
    echo '<option value="0" '.$sel.'>'._ARTICLES.'</option>';
    while(list($catid, $ctitle) = $db->sql_fetchrow($selcat)) {
        $catid = intval($catid);
        if ($catid == $cat) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option value="'.$catid.'" '.$sel.'>'.$ctitle.'</option>';
        $a++;
    }
    echo '</select> [ <a href="'.$admin_file.'.php?op=AddCategory">'._ADD.'</a> | <a href="'.$admin_file.'.php?op=EditCategory&amp;catid='.$cat.'">'
        ._EDIT.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=DelCategory&amp;cat='.$cat.'">'._DELETE.'</a> ]';
    }

function putpoll($pollTitle, $optionText) {
    OpenTable();
    echo '<center><font class="title"><b>'._ATTACHAPOLL.'</b></font><br />'
        .'<font class="tiny">'._LEAVEBLANKTONOTATTACH.'</font><br />'
        .'<br /><br />'._POLLTITLE.': <input type="text" name="pollTitle" size="50" maxlength="100" value="'.$pollTitle.'" /><br /><br />'
        .'<font class="content">'._POLLEACHFIELD.'</font><br />'
        .'<table border="0">';
    for($i = 1; $i <= 12; $i++)    {
        if (!isset($optionText[$i])) { $optionText[$i] = ''; }
        echo '<tr>'
            .'<td>'._OPTION.' '.$i.':</td><td><input type="text" name="optionText['.$i.']" size="50" maxlength="50" value="'.$optionText[$i].'" /></td>'
            .'</tr>';
    }
    echo '</table></center>';
    CloseTable();
}

function AddCategory () {
    global $admin_file;
    include_once 'header.php';
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._CATEGORIESADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    OpenTable();
    echo '<center><font class="option"><b>'._CATEGORYADD.'</b></font><br /><br /><br />'
        .'<form action="'.$admin_file.'.php" method="post">'
        .'<b>'._CATNAME.':</b> '
        .'<input type="text" name="ctitle" size="22" maxlength="20" /> '
        .'<input type="hidden" name="op" value="SaveCategory" />'
        .'<input type="submit" value="'._SAVE.'" />'
        .'</form></center>';
    CloseTable();
    include_once 'footer.php';
}

function EditCategory($catid) {
    global $prefix, $db, $admin_file;
    $catid = intval($catid);
    $result = $db->sql_query('select title from '.$prefix.'_stories_cat where catid=\''.$catid.'\'');
    list($ctitle) = $db->sql_fetchrow($result);
    include_once 'header.php';
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._CATEGORIESADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    OpenTable();
    echo '<center><font class="option"><b>'._EDITCATEGORY.'</b></font><br />';
    if (!$catid) {
        $selcat = $db->sql_query('select catid, title from '.$prefix.'_stories_cat');
        echo '<form action="'.$admin_file.'.php" method="post">';
        echo '<b>'._ASELECTCATEGORY.'</b>';
        echo '<select name="catid">';
        echo '<option value="0" '.$sel.'>Articles</option>';
        while(list($catid, $ctitle) = $db->sql_fetchrow($selcat)) {
            $catid = intval($catid);
            echo '<option value="'.$catid.'" '.$sel.'>'.$ctitle.'</option>';
        }
        echo '</select>';
        echo '<input type="hidden" name="op" value="EditCategory" />';
        echo '<input type="submit" value="'._EDIT.'" /><br /><br />';
        echo _NOARTCATEDIT;
    } else {
        echo '<form action="'.$admin_file.'.php" method="post">';
        echo '<b>'._CATEGORYNAME.':</b> ';
        echo '<input type="text" name="ctitle" size="22" maxlength="20" value="'.$ctitle.'" /> ';
        echo '<input type="hidden" name="catid" value="'.$catid.'" />';
        echo '<input type="hidden" name="op" value="SaveEditCategory" />';
        echo '<input type="submit" value="'._SAVECHANGES.'" /><br /><br />';
        echo _NOARTCATEDIT;
    }
    echo '</form>';
    echo '</center>';
    CloseTable();
    include_once 'footer.php';
}

function DelCategory($cat) {
    global $prefix, $db, $admin_file;
    $cat = intval($cat);
    $result = $db->sql_query('select title from '.$prefix.'_stories_cat where catid=\''.$cat.'\'');
    list($ctitle) = $db->sql_fetchrow($result);
    include_once 'header.php';
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._CATEGORIESADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    OpenTable();
    echo '<center><font class="option"><b>'._DELETECATEGORY.'</b></font><br />';
    if (!$cat) {
        $selcat = $db->sql_query('select catid, title from '.$prefix.'_stories_cat');
        echo '<form action="'.$admin_file.'.php" method="post">'
            .'<b>'._SELECTCATDEL.': </b>'
            .'<select name="cat">';
        while(list($catid, $ctitle) = $db->sql_fetchrow($selcat)) {
            $catid = intval($catid);
            echo '<option value="'.$catid.'">'.$ctitle.'</option>';
        }
        echo '</select>'
            .'<input type="hidden" name="op" value="DelCategory" />'
            .'<input type="submit" value="Delete" />'
            .'</form>';
    } else {
		csrf_check();
        $result2 = $db->sql_query('select * from '.$prefix.'_stories where catid=\''.$cat.'\'');
        $numrows = $db->sql_numrows($result2);
        if ($numrows == 0) {
            $db->sql_query('delete from '.$prefix.'_stories_cat where catid=\''.$cat.'\'');
            echo '<br /><br />'._CATDELETED.'<br /><br />'._GOTOADMIN;
        } else {
            echo '<br /><br /><b>'._WARNING.':</b> '._THECATEGORY.' <b>'.$ctitle.'</b> '._HAS.' <b>'.$numrows.'</b> '._STORIESINSIDE.'<br />'
                ._DELCATWARNING1.'<br />'
                ._DELCATWARNING2.'<br /><br />'
                ._DELCATWARNING3.'<br /><br />'
                .'<b>[ <a class="rn_csrf" href="'.$admin_file.'.php?op=YesDelCategory&amp;catid='.$cat.'">'._YESDEL.'</a> | '
                .'<a href="'.$admin_file.'.php?op=NoMoveCategory&amp;catid='.$cat.'">'._NOMOVE.'</a> ]</b>';
        }
    }
    echo '</center>';
    CloseTable();
    include_once 'footer.php';
}

function YesDelCategory($catid) {
    global $prefix, $db, $admin_file;
    $catid = intval($catid);
    $db->sql_query('delete from '.$prefix.'_stories_cat where catid=\''.$catid.'\'');
    $result = $db->sql_query('select sid from '.$prefix.'_stories where catid=\''.$catid.'\'');
    while(list($sid) = $db->sql_fetchrow($result)) {
        $sid = intval($sid);
        $db->sql_query('delete from '.$prefix.'_stories where catid=\''.$catid.'\'');
        $db->sql_query('delete from '.$prefix.'_comments where sid=\''.$sid.'\'');
    }
    Header('Location: '.$admin_file.'.php');
}

function NoMoveCategory($catid, $newcat) {
    global $prefix, $db, $admin_file;
    $catid = intval($catid);
    $result = $db->sql_query('select title from '.$prefix.'_stories_cat where catid=\''.$catid.'\'');
    list($ctitle) = $db->sql_fetchrow($result);
    include_once 'header.php';
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._CATEGORIESADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    OpenTable();
    echo '<center><font class="option"><b>'._MOVESTORIES.'</b></font><br /><br />';
    if (!$newcat) {
        echo _ALLSTORIES.' <b>'.$ctitle.'</b> '._WILLBEMOVED.'<br /><br />';
        $selcat = $db->sql_query('select catid, title from '.$prefix.'_stories_cat');
        echo '<form action="'.$admin_file.'.php" method="post">';
        echo '<b>'._SELECTNEWCAT.':</b> ';
        echo '<select name="newcat">';
        echo '<option value="0">'._ARTICLES.'</option>';
        while(list($newcat, $ctitle) = $db->sql_fetchrow($selcat)) {
            echo '<option value="'.$newcat.'">'.$ctitle.'</option>';
        }
        echo '</select>';
        echo '<input type="hidden" name="catid" value="'.$catid.'" />';
        echo '<input type="hidden" name="op" value="NoMoveCategory" />';
        echo '<input type="submit" value="'._OK.'" />';
        echo '</form>';
    } else {
		csrf_check();
        $resultm = $db->sql_query('select sid from '.$prefix.'_stories where catid=\''.$catid.'\'');
        while(list($sid) = $db->sql_fetchrow($resultm)) {
            $sid = intval($sid);
            $db->sql_query('update '.$prefix.'_stories set catid=\''.$newcat.'\' where sid=\''.$sid.'\'');
        }
        $db->sql_query('delete from '.$prefix.'_stories_cat where catid=\''.$catid.'\'');
        echo _MOVEDONE;
    }
    CloseTable();
    include_once 'footer.php';
}

function SaveEditCategory($catid, $ctitle) {
    global $prefix, $db, $admin_file;
    $ctitle = ereg_replace('"','',$ctitle);
    $result = $db->sql_query('select catid from '.$prefix.'_stories_cat where title=\''.$ctitle.'\'');
    $catid = intval($catid);
    if ($db->sql_numrows($result) == 1) {
        $what1 = _CATEXISTS;
        $what2 = _GOBACK;
    } else {
        $what1 = _CATSAVED;
        $what2 = '[ <a href="'.$admin_file.'.php">'._GOTOADMIN.'</a> ]';
        $result = $db->sql_query('update '.$prefix.'_stories_cat set title=\''.$ctitle.'\' where catid=\''.$catid.'\'');
        if (!$result) {
            return;
        }
    }
    include_once 'header.php';
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._CATEGORIESADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    OpenTable();
    echo '<center><font class="content"><b>'.$what1.'</b></font><br /><br />';
    echo $what2.'</center>';
    CloseTable();
    include_once 'footer.php';
}

function SaveCategory($ctitle) {
    global $prefix, $db;
    $ctitle = ereg_replace('"','',$ctitle);
    $result = $db->sql_query('select catid from '.$prefix.'_stories_cat where title=\''.$ctitle.'\'');
    if ($db->sql_numrows($result) == 1) {
        $what1 = _CATEXISTS;
        $what2 = _GOBACK;
    } else {
        $what1 = _CATADDED;
        $what2 = _GOTOADMIN;
        $result = $db->sql_query('insert into '.$prefix.'_stories_cat values '."(NULL, '$ctitle', 0)");
        if (!$result) {
            return;
        }
    }
    include_once 'header.php';
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._CATEGORIESADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    OpenTable();
    echo '<center><font class="content"><b>'.$what1.'</b></font><br /><br />';
    echo $what2.'</center>';
    CloseTable();
    include_once 'footer.php';
}

function autodelete($anid) {
    global $prefix, $db, $admin_file;
    $anid = intval($anid);
    $db->sql_query('delete from '.$prefix.'_autonews where anid=\''.$anid.'\'');
    Header('Location: '.$admin_file.'.php?op=adminMain');
}

function autoEdit($anid) {
    global $aid, $bgcolor1, $bgcolor2, $prefix, $db, $multilingual, $admin_file;
    $sid = intval($sid);
    $aid = substr("$aid", 0,25);
    $result = $db->sql_query('select radminsuper from '.$prefix.'_authors where aid=\''.$aid.'\'');
    list($radminsuper) = $db->sql_fetchrow($result);
    $radminsuper = intval($radminsuper);
    $result = $db->sql_query('SELECT admins FROM '.$prefix.'_modules where title=\'News\'');
    $row2 = $db->sql_fetchrow($db->sql_query('SELECT name FROM '.$prefix.'_authors where aid=\''.$aid.'\''));
    while ($row = $db->sql_fetchrow($result)) {
        $admins = explode(',', $row['admins']);
        $auth_user = 0;
        for ($i=0; $i < sizeof($admins); $i++) {
            if ($row2['name'] == '$admins[$i]') {
                $auth_user = 1;
            }
        }
        if ($auth_user == 1) {
            $radminarticle = 1;
        }
    }
    $result2 = $db->sql_query('select aid from '.$prefix.'_stories where sid=\''.$sid.'\'');
    list($aaid) = $db->sql_fetchrow($result2);
    $aaid = substr("$aaid", 0,25);
    if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
        include_once 'header.php';
        $result = $db->sql_query('select catid, aid, title, time, hometext, bodytext, topic, informant, notes, ihome, alanguage, acomm from '.$prefix.'_autonews where anid=\''.$anid.'\'');
        list($catid, $aid, $story_title, $time, $hometext, $bodytext, $topic, $informant, $notes, $ihome, $alanguage, $acomm) = $db->sql_fetchrow($result);
        $catid = intval($catid);
        $aid = substr("$aid", 0,25);
        $informant = substr("$informant", 0,25);
        $ihome = intval($ihome);
        $acomm = intval($acomm);
        ereg ('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})', $time, $datetime);
        GraphicAdmin();
        OpenTable();
        echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
        CloseTable();
        echo '<br />';
        OpenTable();
        $today = getdate();
        $tday = $today['mday'];
        if ($tday < 10){
            $tday = "0$tday";
        }
        $tmonth = $today['month'];
        $tyear = $today['year'];
        $thour = $today['hours'];
        if ($thour < 10){
            $thour = "0$thour";
        }
        $tmin = $today['minutes'];
        if ($tmin < 10){
            $tmin = "0$tmin";
        }
        $tsec = $today['seconds'];
        if ($tsec < 10){
            $tsec = "0$tsec";
        }
        $date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
        echo '<center><font class="option"><b>'._AUTOSTORYEDIT.'</b></font></center><br /><br />'
            .'<form action="'.$admin_file.'.php" method="post">';
        $story_title = stripslashes($story_title);
        $hometext = stripslashes($hometext);
        $bodytext = stripslashes($bodytext);
        $notes = stripslashes($notes);
        $result=$db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
        list($topicimage) = $db->sql_fetchrow($result);
        echo '<table border="0" width="75%" cellpadding="0" cellspacing="1" bgcolor="'.$bgcolor2.'" align="center"><tr><td>'
            .'<table border="0" width="100%" cellpadding="8" cellspacing="1" bgcolor="'.$bgcolor1.'"><tr><td>'
            .'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
        themepreview($story_title, $hometext, $bodytext);
        echo '</td></tr></table></td></tr></table>'
            .'<br /><br /><b>'._TITLE.'</b><br />'
            .'<input type="text" name="story_title" size="50" value="'.$story_title.'" /><br /><br />'
            .'<b>'._TOPIC.'</b> <select name="topic">';
        $toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
        echo '<option value=\'\'>'._ALLTOPICS.'</option>'."\n";
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			$topicid = intval($topicid);
			if ($topicid==$topic) { 
				$sel = 'selected="selected"';
			} else {
				$sel = '';
			}
			echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
		}
        echo '</select><br /><br />';
        $cat = $catid;
        SelectCategory($cat);
        echo '<br />';
        puthome($ihome, $acomm);
        if ($multilingual == 1) {
            $langFound = '';
            $languageslist = '';
            echo '<br /><b>'._LANGUAGE.': </b>'
                .'<select name="alanguage">';
            $handle=opendir('language');
            while ($file = readdir($handle)) {
                if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
                    $langFound = $matches[1];
                    $languageslist .= "$langFound ";
                }
            }
            closedir($handle);
            $languageslist = explode(' ', $languageslist);
            sort($languageslist);
            for ($i=0; $i < sizeof($languageslist); $i++) {
                if (!empty($languageslist[$i])) {
                    echo '<option value="'.$languageslist[$i].'" ';
                    if ($languageslist[$i]==$alanguage) echo 'selected="selected"';
                    echo '>'.ucfirst($languageslist[$i]).'</option>'."\n";
                }
            }
            if (empty($alanguage)) {
                $sellang = 'selected="selected"';
            } else {
                $sellang = '';
            }
            echo '<option value="'.$sellang.'">'._ALL.'</option></select>';
        } else {
            echo '<input type="hidden" name="alanguage" value="" />';
        }
        echo '<br /><br /><b>'._STORYTEXT.'</b><br />';
        wysiwyg_textarea('hometext', "$hometext", 'PHPNukeAdmin', 50, 12);
        echo '<br /><b>'._EXTENDEDTEXT.'</b><br />';
        wysiwyg_textarea('bodytext', "$bodytext", 'PHPNukeAdmin', 50, 12);
        echo '<font class="content">'._ARESUREURL.'</font><br /><br />';
        if ($aid != $informant) {
            echo '<br /><br /><b>'._NOTES.'</b><br />';
            wysiwyg_textarea('notes', "$notes", 'PHPNukeAdmin', 50, 6);
        }
        echo '<br /><br /><br /><b>'._CHNGPROGRAMSTORY.'</b><br /><br />'
        ._NOWIS.': '.$date.'<br /><br />';
        $xday = 1;
        echo _DAY.': <select name="day">';
        while ($xday <= 31) {
            if ($xday == $datetime[3]) {
                $sel = 'selected="selected"';
            } else {
                $sel = '';
            }
            echo '<option '.$sel.'>'.$xday.'</option>';
            $xday++;
        }
        echo '</select>';
        $xmonth = 1;
        echo _UMONTH.': <select name="month">';
        while ($xmonth <= 12) {
            if ($xmonth == $datetime[2]) {
                $sel = 'selected="selected"';
            } else {
                $sel = '';
            }
            echo '<option '.$sel.'>'.$xmonth.'</option>';
            $xmonth++;
        }
        echo '</select>';
        echo _YEAR.': <input type="text" name="year" value="'.$datetime[1].'" size="5" maxlength="4" />';
        echo '<br />'._HOUR.': <select name="hour">';
        $xhour = 0;
        $cero = 0;
        while ($xhour <= 23) {
            $dummy = $xhour;
            if ($xhour < 10) {
                $xhour = "$cero$xhour";
            }
            if ($xhour == $datetime[4]) {
                $sel = 'selected="selected"';
            } else {
                $sel = '';
            }
            echo '<option '.$sel.'>'.$xhour.'</option>';
            $xhour = $dummy;
            $xhour++;
        }
        echo '</select>';
        echo ': <select name="min">';
        $xmin = 0;
        while ($xmin <= 59) {
            if (($xmin == 0) OR ($xmin == 5)) {
                $xmin = "0$xmin";
            }
            if ($xmin == $datetime[5]) {
                $sel = 'selected="selected"';
            } else {
                $sel = '';
            }
            echo '<option '.$sel.'>'.$xmin.'</option>';
            $xmin = $xmin + 5;
        }
        echo '</select>';
        echo ': 00<br /><br />
        <input type="hidden" name="anid" value="'.$anid.'" />
        <input type="hidden" name="op" value="autoSaveEdit" />
        <input type="submit" value="'._SAVECHANGES.'" />
        </form>';
        CloseTable();
        include_once 'footer.php';
    } else {
        include_once 'header.php';
        GraphicAdmin();
        OpenTable();
        echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
        CloseTable();
        echo '<br />';
        OpenTable();
        echo '<center><b>'._NOTAUTHORIZED1.'</b><br /><br />'
        ._NOTAUTHORIZED2.'<br /><br />'
        ._GOBACK;
        CloseTable();
        include_once 'footer.php';
    }
}

function autoSaveEdit($anid, $year, $day, $month, $hour, $min, $story_title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm) {
    global $aid, $prefix, $db, $admin_file;
    $aid = substr("$aid", 0,25);
    $sid = intval($sid);
    $result = $db->sql_query('select radminsuper from '.$prefix.'_authors where aid=\''.$aid.'\'');
    list($radminsuper) = $db->sql_fetchrow($result);
    $radminsuper = intval($radminsuper);
    $result = $db->sql_query('SELECT admins FROM '.$prefix.'_modules where title=\'News\'');
    $row2 = $db->sql_fetchrow($db->sql_query('SELECT name FROM '.$prefix.'_authors where aid=\''.$aid.'\''));
    while ($row = $db->sql_fetchrow($result)) {
        $admins = explode(",", $row['admins']);
        $auth_user = 0;
        for ($i=0; $i < sizeof($admins); $i++) {
            if ($row2['name'] == "$admins[$i]") {
                $auth_user = 1;
            }
        }
        if ($auth_user == 1) {
            $radminarticle = 1;
        }
    }
    $result2 = $db->sql_query('select aid from '.$prefix.'_stories where sid=\''.$sid.'\'');
    list($aaid) = $db->sql_fetchrow($result2);
    $aaid = substr("$aaid", 0,25);
    if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
        if ($day < 10) {
            $day = "0$day";
        }
        if ($month < 10) {
            $month = "0$month";
        }
        $sec = '00';
        $date = "$year-$month-$day $hour:$min:$sec";
        $story_title = stripslashes(FixQuotes($story_title));
        $hometext = stripslashes(FixQuotes($hometext));
        $bodytext = stripslashes(FixQuotes($bodytext));
        $notes = stripslashes(FixQuotes($notes));
        $result = $db->sql_query('update '.$prefix.'_autonews set '."catid='$catid', title='$story_title', time='$date', hometext='$hometext', bodytext='$bodytext', topic='$topic', notes='$notes', ihome='$ihome', alanguage='$alanguage', acomm='$acomm'".' where anid=\''.$anid.'\'');
        if (!$result) {
            exit();
        }
        Header('Location: '.$admin_file.'.php?op=adminMain');
    } else {
        include_once 'header.php';
        GraphicAdmin();
        OpenTable();
        echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
        CloseTable();
        echo '<br />';
        OpenTable();
        echo '<center><b>'._NOTAUTHORIZED1.'</b><br /><br />'
            ._NOTAUTHORIZED2.'<br /><br />'
            ._GOBACK;
        echo '/center';
        CloseTable();
        include_once 'footer.php';
    }
}

function displayStory($qid) {
    global $user, $subject, $story, $bgcolor1, $bgcolor2, $anonymous, $user_prefix, $prefix, $db, $multilingual, $admin_file;
    include_once 'header.php';
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._SUBMISSIONSADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    $today = getdate();
    $tday = $today['mday'];
    if ($tday < 10){
        $tday = "0$tday";
    }
    $tmonth = $today['month'];
    $ttmon = $today['mon'];
    if ($ttmon < 10){
        $ttmon = "0$ttmon";
    }
    $tyear = $today['year'];
    $thour = $today['hours'];
    if ($thour < 10){
        $thour = "0$thour";
    }
    $tmin = $today['minutes'];
    if ($tmin < 10){
        $tmin = "0$tmin";
    }
    $tsec = $today['seconds'];
    if ($tsec < 10){
        $tsec = "0$tsec";
    }
    $date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
    $qid = intval($qid);
    $result = $db->sql_query('SELECT qid, uid, uname, subject, story, storyext, topic, alanguage FROM '.$prefix.'_queue where qid=\''.$qid.'\'');
    list($qid, $uid, $uname, $subject, $story, $storyext, $topic, $alanguage) = $db->sql_fetchrow($result);
    $qid = intval($qid);
    $uid = intval($uid);
    $subject = stripslashes($subject);
    $story = stripslashes($story);
    $storyext = stripslashes($storyext);
    $story1 = eregi_replace('<a href="http://', '<a href="index.php?url=http://', $story);
    $storyext1 = eregi_replace('<a href="http://', '<a href="index.php?url=http://', $storyext);
    echo '<form action="'.$admin_file.'.php" method="post">';
    OpenTable();
    echo '<font class="content">'
        .'<b>'._NAME.'</b></font><br />'
        .'<input type="text" name="author" size="25" value="'.$uname.'" />';
    if ($uname != $anonymous) {
        $res = $db->sql_query('select user_email from '.$user_prefix.'_users where username=\''.$uname.'\'');
        list($email) = $db->sql_fetchrow($res);
        echo '&nbsp;&nbsp;[ <a href="mailto:'.$email.'?Subject=Re: '.$subject.'"><font class="content">'._EMAILUSER.'</font></a> | <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$uname.'"><font class="content">'._USERPROFILE.'</font></a> | <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$uid.'"><font class="content">'._SENDPM.'</font></a> ]';
    }
    echo '<br /><br /><b>'._TITLE.'</b><br />'
        .'<input type="text" name="subject" size="50" value="'.$subject.'" /><br /><br />';
    if (empty($topic)) {
        $topic = 1;
    }
    $result = $db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
    list($topicimage) = $db->sql_fetchrow($result);
    echo '<table border="0" width="70%" cellpadding="0" cellspacing="1" bgcolor="'.$bgcolor2.'" align="center"><tr><td>'
        .'<table border="0" width="100%" cellpadding="8" cellspacing="1" bgcolor="'.$bgcolor1.'"><tr><td>'
        .'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
    $storypre = "$story1".'<br /><br />'."$storyext1";
    themepreview($subject, $storypre);
    echo '</td></tr></table></td></tr></table>'
        .'<br /><b>'._TOPIC.'</b> <select name="topic">';
    $toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
    echo '<option value="">'._SELECTTOPIC.'</option>'."\n";
	while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
		$topicid = intval($topicid);
		if ($topicid==$topic) {
			$sel = 'selected="selected "';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
	}
    echo '</select>';
    echo '<br /><br />';
    echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><b>'._ASSOTOPIC.'</b></td><td width="100%">'
        .'<table border="1" cellspacing="3" cellpadding="8"><tr>';
    $a = 0;
    $sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        if ($a == 3) {
            echo '</tr><tr>';
            $a = 0;
        }
        echo '<td><input type="checkbox" name="assotop[]" value="'.intval($row['topicid']).'" />'.$row['topictext'].'</td>';
        $a++;
    }
    echo '</tr></table></td></tr></table><br /><br />';
    if (!isset($cat)) {$cat = '';  }
    SelectCategory($cat);
    if (!isset($ihome)) {$ihome = ''; }
    if (!isset($acomn)) {$acomm = ''; }
    echo '<br />';
    puthome($ihome, $acomm);
    if ($multilingual == 1) {
        $langFound = '';
        $languageslist = '';
        echo '<br /><b>'._LANGUAGE.': </b>'
            .'<select name="alanguage">';
        $handle=opendir('language');
        while ($file = readdir($handle)) {
            if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
                $langFound = $matches[1];
                $languageslist .= "$langFound ";
            }
        }
        closedir($handle);
        $languageslist = explode(' ', $languageslist);
        sort($languageslist);
        for ($i=0; $i < sizeof($languageslist); $i++) {
            if (!empty($languageslist[$i])) {
                echo '<option value="'.$languageslist[$i].'" ';
                if ($languageslist[$i]==$alanguage) echo 'selected="selected"';
                echo '>'.ucfirst($languageslist[$i]).'</option>'."\n";
            }
        }
        if (empty($alanguage)) {
            $sellang = 'selected="selected"';
        } else {
            $sellang = '';
        }
        echo '<option value=" '.$sellang.'">'._ALL.'</option></select>';
    } else {
        echo '<input type="hidden" name="alanguage" value="" />';
    }
    echo '<br /><br /><b>'._STORYTEXT.'</b><br />';
    wysiwyg_textarea('hometext', "$story", 'PHPNukeAdmin', 50, 7);
    echo '<br /><br /><b>'._EXTENDEDTEXT.'</b><br />';
    wysiwyg_textarea('bodytext', "$storyext", 'PHPNukeAdmin', 50, 8);
    echo '<br /><font class="content">'._AREYOUSURE.'</font><br /><br />'
        .'<b>'._NOTES.'</b><br />';
    wysiwyg_textarea('notes', '', 'PHPNukeAdmin', 50, 6);
    echo '<input type="hidden" name="qid" size="50" value="'.$qid.'" />'
        .'<input type="hidden" name="uid" size="50" value="'.$uid.'" />'
        .'<br /><b>'._PROGRAMSTORY.'</b>&nbsp;&nbsp;'
        .'<input type="radio" name="automated" value="1" />'._YES.' &nbsp;&nbsp;'
        .'<input type="radio" name="automated" value="0" checked="checked" />'._NO.'<br /><br />'
        ._NOWIS.': '.$date.'<br /><br />';
    $day = 1;
    echo _DAY.': <select name="day">';
	while ($day <= 31) {
		if ($tday==$day) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$day.'</option>';
		$day++;
	}
    echo '</select>';
    $month = 1;
    echo _UMONTH.': <select name="month">';
    while ($month <= 12) {
        if ($ttmon==$month) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$month.'</option>';
        $month++;
    }
    echo '</select>';
    $date = getdate();
    $year = $date['year'];
    echo _YEAR.': <input type="text" name="year" value="'.$year.'" size="5" maxlength="4" />';
    echo '<br />'._HOUR.': <select name="hour">';
    $hour = 0;
    $cero = 0;
    while ($hour <= 23) {
        $dummy = $hour;
            if ($hour < 10) {
                $hour = "$cero$hour";
            }
            echo '<option>'.$hour.'</option>';
            $hour = $dummy;
            $hour++;
    }
    echo '</select>';
    echo ': <select name="min">';
    $min = 0;
    while ($min <= 59) {
        if (($min == 0) OR ($min == 5)) {
            $min = "0$min";
        }
        echo '<option>'.$min.'</option>';
        $min = $min + 5;
    }
    echo '</select>';
    echo ': 00<br /><br />'
        .'<select name="op">'
        .'<option value="DeleteStory">'._DELETESTORY.'</option>'
        .'<option value="PreviewAgain" selected="selected">'._PREVIEWSTORY.'</option>'
        .'<option value="PostStory">'._POSTSTORY.'</option>'
        .'</select>'
        .'<input type="submit" value="'._OK.'" />&nbsp;&nbsp;[ <a class="rn_csrf" href="'.$admin_file.'.php?op=DeleteStory&amp;qid='.$qid.'">'._DELETE.'</a> ]';
    CloseTable();
    echo '<br />';
    if (!isset($pollTitle)) {$pollTitle = '';  }
    if (!isset($optionText)) {$optionText = ''; }
    putpoll($pollTitle, $optionText);
    echo '</form>';
    include_once 'footer.php';
}

function previewStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
    global $user, $boxstuff, $anonymous, $bgcolor1, $bgcolor2, $user_prefix, $prefix, $db, $multilingual, $admin_file;
    include_once 'header.php';
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    $today = getdate();
    $tday = $today['mday'];
    if ($tday < 10){
        $tday = "0$tday";
    }
    $tmonth = $today['month'];
    $tyear = $today['year'];
    $thour = $today['hours'];
    if ($thour < 10){
        $thour = "0$thour";
    }
    $tmin = $today['minutes'];
    if ($tmin < 10){
        $tmin = "0$tmin";
    }
    $tsec = $today['seconds'];
    if ($tsec < 10){
        $tsec = "0$tsec";
    }
    $date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
    $subject = stripslashes($subject);
    $hometext = stripslashes($hometext);
    $bodytext = stripslashes($bodytext);
    $hometext1 = eregi_replace('<a href="http://', '<a href="index.php?url=http://', $hometext);
    $bodytext1 = eregi_replace('<a href="http://', '<a href="index.php?url=http://', $bodytext);
    $notes = stripslashes($notes);
    echo '<form action="'.$admin_file.'.php" method="post">';
    OpenTable();
    echo '<font class="content">'
        .'<b>'._NAME.'</b></font><br />'
        .'<input type="text" name="author" size="25" value="'.$author.'" />';
    if ($author != $anonymous) {
        $res = $db->sql_query('select user_id, user_email from '.$user_prefix.'_users where username=\''.$author.'\'');
        list($pm_userid, $email) = $db->sql_fetchrow($res);
        $pm_userid = intval($pm_userid);
        echo '&nbsp;&nbsp;[ <a href="mailto:'.$email.'?Subject=Re: '.$subject.'"><font class="content">'._EMAILUSER.'</font></a> | <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$author.'"><font class="content">'._USERPROFILE.'</font></a> | <a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$uid.'"><font class="content">'._SENDPM.'</font></a> ]';
    }
    echo '<br /><br /><b>'._TITLE.'</b><br />'
        .'<input type="text" name="subject" size="50" value="'.$subject.'" /><br /><br />';
    $result = $db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
    list($topicimage) = $db->sql_fetchrow($result);
    echo '<table width="70%" bgcolor="'.$bgcolor2.'" cellpadding="0" cellspacing="1" border="0" align="center"><tr><td>'
        .'<table width="100%" bgcolor="'.$bgcolor1.'" cellpadding="8" cellspacing="1" border="0"><tr><td>'
        .'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
    themepreview($subject, $hometext1, $bodytext1, $notes);
    echo '</td></tr></table></td></tr></table>'
        .'<br /><b>'._TOPIC.'</b> <select name="topic">';
    $toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
    echo '<option value="">'._ALLTOPICS.'</option>'."\n";
	while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
		$topicid = intval($topicid);
		if ($topicid==$topic) {
			$sel = 'selected="selected "';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
	}
    echo '</select>';
    echo '<br /><br />';
    $associated = '';
    if (!empty($assotop)) {
        $j = sizeof($assotop);
        for ($i=0; $i<$j; ++$i) {
            $associated .= "$assotop[$i]-";
        }
        $asso_t = explode('-', $associated);
    } else {
        $asso_t = '';
    }
    echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><b>'._ASSOTOPIC.'</b></td><td width="100%">'
        .'<table border="1" cellspacing="3" cellpadding="8"><tr>';
    $a = 0;
    $sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        if ($a == 3) {
            echo '</tr><tr>';
            $a = 0;
        }
        if ($asso_t == '') {
            $checked = ''; }
        else {
            for ($i=0; $i<sizeof($asso_t); $i++) {
                if ($asso_t[$i] == $row['topicid']) {
                $checked = 'checked="checked"';
                break;
                }
            }
        }  // end of else
        echo '<td><input type="checkbox" name="assotop[]" value="'.intval($row['topicid']).'"'. $checked .'/>'.$row['topictext'].'</td>';
        $checked = '';
        $a++;
    }
    echo '</tr></table></td></tr></table><br /><br />';
    $cat = $catid;
    SelectCategory($cat);
    echo '<br />';
    puthome($ihome, $acomm);
    if ($multilingual == 1) {
        $langFound = '';
        $languageslist = '';
        echo '<br /><b>'._LANGUAGE.': </b>'
            .'<select name="alanguage">';
        $handle=opendir('language');
        while ($file = readdir($handle)) {
            if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
                $langFound = $matches[1];
                $languageslist .= "$langFound ";
            }
        }
        closedir($handle);
        $languageslist = explode(" ", $languageslist);
        sort($languageslist);
        for ($i=0; $i < sizeof($languageslist); $i++) {
            if (!empty($languageslist[$i])) {
                echo '<option value="'.$languageslist[$i].'" ';
                if ($languageslist[$i]==$alanguage) echo 'selected="selected"';
                echo '>'.ucfirst($languageslist[$i]).'</option>'."\n";
            }
        }
		if (empty($alanguage)) {
			$sellang = 'selected="selected"';
		} else {
			$sellang = '';
		}
        echo '<option value="'.$sellang.'">'._ALL.'</option></select>';
    } else {
        echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
    }
    echo '<br /><br /><b>'._STORYTEXT.'</b><br />';
    wysiwyg_textarea('hometext', "$hometext", 'PHPNukeAdmin', 50, 7);
    echo '<br /><br /><b>'._EXTENDEDTEXT.'</b><br />';
    wysiwyg_textarea('bodytext', "$bodytext", 'PHPNukeAdmin', 50, 10);
    echo '<br /><font class="content">'._AREYOUSURE.'</font><br /><br />'
        .'<b>'._NOTES.'</b><br />';
    wysiwyg_textarea('notes', "$notes", 'PHPNukeAdmin', 50, 6);
    echo '<br /><br /><input type="hidden" name="qid" size="50" value="'.$qid.'" />'
        .'<input type="hidden" name="uid" size="50" value="'.$uid.'" />';
    if ($automated == 1) {
        $sel1 = 'checked="checked"';
        $sel2 = '';
    } else {
        $sel1 = '';
        $sel2 = 'checked="checked"';
    }
    echo '<b>'._PROGRAMSTORY.'</b>&nbsp;&nbsp;'
        .'<input type="radio" name="automated" value="1" '.$sel1.' />'._YES.' &nbsp;&nbsp;'
        .'<input type="radio" name="automated" value="0" '.$sel2.' />'._NO.'<br /><br />'
        ._NOWIS.': '.$date.'<br /><br />';
    $xday = 1;
    echo _DAY.': <select name="day">';
    while ($xday <= 31) {
        if ($xday == $day) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$xday.'</option>';
        $xday++;
    }
    echo '</select>';
    $xmonth = 1;
    echo _UMONTH.': <select name="month">';
    while ($xmonth <= 12) {
        if ($xmonth == $month) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$xmonth.'</option>';
        $xmonth++;
    }
    echo '</select>';
    echo _YEAR.': <input type="text" name="year" value="'.$year.'" size="5" maxlength="4" />';
    echo '<br />'._HOUR.': <select name="hour">';
    $xhour = 0;
    $cero = 0;
    while ($xhour <= 23) {
        $dummy = $xhour;
        if ($xhour < 10) {
            $xhour = "$cero$xhour";
        }
        if ($xhour == $hour) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$xhour.'</option>';
        $xhour = $dummy;
        $xhour++;
    }
    echo '</select>';
    echo ': <select name="min">';
    $xmin = 0;
    while ($xmin <= 59) {
        if (($xmin == 0) OR ($xmin == 5)) {
            $xmin = "0$xmin";
        }
        if ($xmin == $min) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$xmin.'</option>';
        $xmin = $xmin + 5;
    }
    echo '</select>';
    echo ': 00<br /><br />'
        .'<select name="op">'
        .'<option value="DeleteStory">'._DELETESTORY.'</option>'
        .'<option value="PreviewAgain" selected="selected">'._PREVIEWSTORY.'</option>'
        .'<option value="PostStory">'._POSTSTORY.'</option>'
        .'</select>'
        .'<input type="submit" value="'._OK.'" />';
    CloseTable();
    echo '<br />';
    putpoll($pollTitle, $optionText);
    echo '</form>';
    include_once 'footer.php';
}

function postStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
    global $aid, $prefix, $db, $user_prefix, $admin_file;
    $associated = '';
    if (!empty($assotop)) {
        $j = sizeof($assotop);
        for ($i=0; $i<$j; ++$i) {
            $associated .= "$assotop[$i]-";
        }
    }
    if ($automated == 1) {
        if ($day < 10) {
            $day = "0$day";
        }
        if ($month < 10) {
            $month = "0$month";
        }
        $sec = '00';
        $date = "$year-$month-$day $hour:$min:$sec";
        if ($uid == 1) $author = '';
        if ($hometext == $bodytext) $bodytext = '';
        $subject = stripslashes(FixQuotes($subject));
        $hometext = stripslashes(FixQuotes($hometext));
        $bodytext = stripslashes(FixQuotes($bodytext));
        $notes = stripslashes(FixQuotes($notes));
        $result = $db->sql_query('insert into '.$prefix.'_autonews values '."(NULL, '$catid', '$aid', '$subject', '$date', '$hometext', '$bodytext', '$topic', '$author', '$notes', '$ihome', '$alanguage', '$acomm', '$associated')");
        if (!$result) {
            return;
        }
        if ($uid != 1) {
            $db->sql_query('update '.$user_prefix.'_users set counter=counter+1 where user_id=\''.$uid.'\'');
            $row = $db->sql_fetchrow($db->sql_query('SELECT points FROM '.$prefix.'_groups_points where id=\'4\''));
            $db->sql_query('UPDATE '.$user_prefix.'_users SET points=points+'.intval($row['points']).' where user_id=\''.$uid.'\'');
        }
        $db->sql_query('update '.$prefix.'_authors set counter=counter+1 where aid=\''.$aid.'\'');
        $qid = intval($qid);
        $db->sql_query('delete from '.$prefix.'_queue where qid=\''.$qid.'\'');
        Header('Location: '.$admin_file.'.php?op=submissions');
    } else {
        if ($uid == 1) $author = '';
        if ($hometext == $bodytext) $bodytext = '';
        $subject = stripslashes(FixQuotes($subject));
        $hometext = stripslashes(FixQuotes($hometext));
        $bodytext = stripslashes(FixQuotes($bodytext));
        $notes = stripslashes(FixQuotes($notes));
        if ((!empty($pollTitle)) AND (!empty($optionText[1])) AND (!empty($optionText[2]))) {
            $haspoll = 1;
            $timeStamp = time();
            $pollTitle = FixQuotes($pollTitle);
            if (!$db->sql_query('INSERT INTO '.$prefix.'_poll_desc '."VALUES (NULL, '$pollTitle', '$timeStamp', 0, '$alanguage', 0)")) {
                return;
            }
            $object = $db->sql_fetchrow($db->sql_query('SELECT pollID FROM '.$prefix.'_poll_desc where pollTitle=\''.$pollTitle.'\''));
            $id = $object['pollID'];
            $id = intval($id);
            for($i = 1; $i <= sizeof($optionText); $i++) {
                if ($optionText[$i] != '') {
                    $optionText[$i] = FixQuotes($optionText[$i]);
                }
                if (!$db->sql_query('INSERT INTO '.$prefix.'_poll_data (pollID, optionText, optionCount, voteID) '."VALUES ('$id', '$optionText[$i]', 0, '$i')")) {
                    return;
                }
            }
        } else {
            $haspoll = 0;
            $id = 0;
        }
        $result = $db->sql_query('insert into '.$prefix.'_stories '."values (NULL, '$catid', '$aid', '$subject', now(), '$hometext', '$bodytext', 0, 0, '$topic', '$author', '$notes', '$ihome', '$alanguage', '$acomm', '$haspoll', '$id', 0, 0, '$associated')");
        $result = $db->sql_query('select sid from '.$prefix.'_stories where title=\''.$subject.'\' order by time DESC limit 0,1');
        list($artid) = $db->sql_fetchrow($result);
        $artid = intval($artid);
        $db->sql_query('UPDATE '.$prefix.'_poll_desc SET artid=\''.$artid.'\' where pollID=\''.$id.'\'');
        if (!$result) {
            return;
        }
        if ($uid != 1) {
            $row = $db->sql_fetchrow($db->sql_query('SELECT points FROM '.$prefix.'_groups_points where id=\'4\''));
            $db->sql_query('UPDATE '.$user_prefix.'_users SET points=points+'.intval($row['points']).' where user_id=\''.$uid.'\'');
            $db->sql_query('update '.$user_prefix.'_users set counter=counter+1 where user_id=\''.$uid.'\'');
        }
        $db->sql_query('update '.$prefix.'_authors set counter=counter+1 where aid=\''.$aid.'\'');
        deleteStory($qid);
    }
}

function editStory($sid) {
    global $user, $bgcolor1, $bgcolor2, $aid, $prefix, $db, $multilingual, $admin_file;
    $aid = substr("$aid", 0,25);
    $sid = intval($sid); //added by montego
    if (!isset($checked)) $checked = '';
    if (!isset($radminarticle)) $radminarticle = '';
    if (!isset($a)) $a = 0;
    $result = $db->sql_query('select radminsuper from '.$prefix.'_authors where aid=\''.$aid.'\'');
    list($radminsuper) = $db->sql_fetchrow($result);
    $radminsuper = intval($radminsuper);

    $result = $db->sql_query('SELECT admins FROM '.$prefix.'_modules where title=\'News\'');
    $row2 = $db->sql_fetchrow($db->sql_query('SELECT name FROM '.$prefix.'_authors where aid=\''.$aid.'\''));
    while ($row = $db->sql_fetchrow($result)) {
        $admins = explode(",", $row['admins']);
        $auth_user = 0;
        for ($i=0; $i < sizeof($admins); $i++) {
            if ($row2['name'] == "$admins[$i]") {
                $auth_user = 1;
            }
        }
        if ($auth_user == 1) {
            $radminarticle = 1;
        }
    }
    $result2 = $db->sql_query('select aid from '.$prefix.'_stories where sid=\''.$sid.'\'');
    list($aaid) = $db->sql_fetchrow($result2);
    $aaid = substr("$aaid", 0,25);
    if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
        include_once 'header.php';
        GraphicAdmin();
        OpenTable();
        echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
        CloseTable();
        echo '<br />';
        $result = $db->sql_query('SELECT catid, title, hometext, bodytext, topic, notes, ihome, alanguage, acomm FROM '.$prefix.'_stories where sid=\''.$sid.'\'');
        list($catid, $subject, $hometext, $bodytext, $topic, $notes, $ihome, $alanguage, $acomm) = $db->sql_fetchrow($result);
        $catid = intval($catid);
        $subject = stripslashes($subject);
        $hometext = stripslashes($hometext);
        $bodytext = stripslashes($bodytext);
        $notes = stripslashes($notes);
        $ihome = intval($ihome);
        $acomm = intval($acomm);
        $result2=$db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
        list($topicimage) = $db->sql_fetchrow($result2);
        OpenTable();
        echo '<center><font class="option"><b>'._EDITARTICLE.'</b></font></center><br />'
            .'<table width="80%" border="0" cellpadding="0" cellspacing="1" bgcolor="'.$bgcolor2.'" align="center"><tr><td>'
            .'<table width="100%" border="0" cellpadding="8" cellspacing="1" bgcolor="'.$bgcolor1.'"><tr><td>'
            .'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
        themepreview($subject, $hometext, $bodytext, $notes);
        echo '</td></tr></table></td></tr></table><br /><br />'
            .'<form action="'.$admin_file.'.php" method="post">'
            .'<b>'._TITLE.'</b><br />'
            .'<input type="text" name="subject" size="50" value="'.$subject.'" /><br /><br />'
            .'<b>'._TOPIC.'</b> <select name="topic">';
        $toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
        echo '<option value="">'._ALLTOPICS.'</option>'."\n";
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			$topicid = intval($topicid);
			if ($topicid==$topic) {
				$sel = 'selected="selected "';
			} else {
				$sel = '';
			}
			echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
		}
        echo '</select>';
        echo '<br /><br />';
        $asql = 'SELECT associated FROM '.$prefix.'_stories where sid=\''.$sid.'\'';
        $aresult = $db->sql_query($asql);
        $arow = $db->sql_fetchrow($aresult);
        $asso_t = explode('-', $arow['associated']);
        echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><b>'._ASSOTOPIC.'</b></td><td width="100%">'
            .'<table border="1" cellspacing="3" cellpadding="8"><tr>';
        $sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            if ($a == 3) {
                echo '</tr><tr>';
                $a = 0;
            }
            for ($i=0; $i<sizeof($asso_t); $i++) {
                if ($asso_t[$i] == $row['topicid']) {
                    $checked = 'checked="checked"';
                    break;
                }
            }
            echo '<td><input type="checkbox" name="assotop[]" value="'.intval($row['topicid']).'" '.$checked.' />'.$row['topictext'].'</td>';
            $checked = '';
            $a++;
        }
        echo '</tr></table></td></tr></table><br /><br />';
        $cat = $catid;
        SelectCategory($cat);
        echo '<br />';
        puthome($ihome, $acomm);
        if ($multilingual == 1) {
            $langFound = '';
            $languageslist = '';
            echo '<br /><b>'._LANGUAGE.':</b>'
            .'<select name="alanguage">';
            $handle=opendir('language');
            while ($file = readdir($handle)) {
                if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
                    $langFound = $matches[1];
                    $languageslist .= "$langFound ";
                }
            }
            closedir($handle);
            $languageslist = explode(' ', $languageslist);
            sort($languageslist);
            for ($i=0; $i < sizeof($languageslist); $i++) {
                if (!empty($languageslist[$i])) {
                    echo '<option value="'.$languageslist[$i].'" ';
                    if ($languageslist[$i]==$alanguage) echo 'selected="selected"';
                    echo '>'.ucfirst($languageslist[$i])."\n".'</option>';
                }
            }
            if (empty($alanguage)) {
                $sellang = 'selected="selected"';
            } else {
                $sellang = '';
            }
            echo '<option value="" '.$sellang.'>'._ALL.'</option></select>';
        } else {
            echo '<input type="hidden" name="alanguage" value="" />';
        }
        echo '<br /><br /><b>'._STORYTEXT.'</b><br />';
        wysiwyg_textarea('hometext', "$hometext", 'PHPNukeAdmin', 50, 17);
        echo '<br /><br /><b>'._EXTENDEDTEXT.'</b><br />';
        wysiwyg_textarea('bodytext', "$bodytext", 'PHPNukeAdmin', 50, 10);
        echo '<br /><font class="content">'._AREYOUSURE.'</font><br /><br />'
            .'<b>'._NOTES.'</b><br />';
        wysiwyg_textarea('notes', "$notes", 'PHPNukeAdmin', 50, 6);
        echo '<br /><br /><input type="hidden" name="sid" size="50" value="'.$sid.'" />'
            .'<input type="hidden" name="op" value="ChangeStory" />'
            .'<input type="submit" value="'._SAVECHANGES.'" />'
            .'</form>';
        CloseTable();
        include_once 'footer.php';
    } else {
        include_once 'header.php';
        GraphicAdmin();
        OpenTable();
        echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
        CloseTable();
        echo '<br />';
        OpenTable();
        echo '<center><b>'._NOTAUTHORIZED1.'</b><br /><br />'
            ._NOTAUTHORIZED2.'<br /><br />'
            ._GOBACK;
        CloseTable();
        include_once 'footer.php';
    }
}

function removeStory($sid, $ok=0) {
    global $aid, $prefix, $db, $admin_file;
    if (!isset($radminarticle)) $radminarticle = 0;
    $aid = substr("$aid", 0,25);
    $result = $db->sql_query('select counter, radminsuper from '.$prefix.'_authors where aid=\''.$aid.'\'');
    list($counter, $radminsuper) = $db->sql_fetchrow($result);
    $radminsuper = intval($radminsuper);
    $counter = intval($counter);
    $sid = intval($sid);
    $result = $db->sql_query('SELECT admins FROM '.$prefix.'_modules where title=\'News\'');
    $row2 = $db->sql_fetchrow($db->sql_query('SELECT name FROM '.$prefix.'_authors where aid=\''.$aid.'\''));
    while ($row = $db->sql_fetchrow($result)) {
        $admins = explode(",", $row['admins']);
        $auth_user = 0;
        for ($i=0; $i < sizeof($admins); $i++) {
            if ($row2['name'] == "$admins[$i]") {
                $auth_user = 1;
            }
        }
        if ($auth_user == 1) {
            $radminarticle = 1;
        }
    }
    $result2 = $db->sql_query('select aid from '.$prefix.'_stories where sid=\''.$sid.'\'');
    list($aaid) = $db->sql_fetchrow($result2);
    $aaid = substr("$aaid", 0,25);
    if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
        if ($ok) {
			csrf_check();
            $counter--;
            $db->sql_query('DELETE FROM '.$prefix.'_stories where sid=\''.$sid.'\'');
            $db->sql_query('DELETE FROM '.$prefix.'_comments where sid=\''.$sid.'\'');
            $db->sql_query('update '.$prefix.'_poll_desc set artid=0 where artid=\''.$sid.'\'');
            $result = $db->sql_query('update '.$prefix.'_authors set counter=\''.$counter.'\' where aid=\''.$aid.'\'');
            Header('Location: '.$admin_file.'.php');
        } else {
            include_once 'header.php';
            GraphicAdmin();
            OpenTable();
            echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
            CloseTable();
            echo '<br />';
            OpenTable();
            echo '<center>'._REMOVESTORY.' '.$sid.' '._ANDCOMMENTS;
            echo '<br /><br />[ <a href="'.$admin_file.'.php">'._NO.'</a> | <a class="rn_csrf" href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'&amp;ok=1">'._YES.'</a> ]</center>';
            CloseTable();
            include_once 'footer.php';
        }
    } else {
        include_once 'header.php';
        GraphicAdmin();
        OpenTable();
        echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
        CloseTable();
        echo '<br />';
        OpenTable();
        echo '<center><b>'._NOTAUTHORIZED1.'</b><br /><br />'
            ._NOTAUTHORIZED2.'<br /><br />'
            ._GOBACK;
        CloseTable();
        include_once 'footer.php';
    }
}

function changeStory($sid, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $assotop) {
    global $aid, $prefix, $db, $admin_file;
    if (!isset($radminarticle)) $radminarticle = 0;
    $associated = '';
    if ($assotop != '') {
        $j = sizeof($assotop);
        for ($i=0; $i<$j; ++$i) {
            $associated .= "$assotop[$i]-";
        }
    }
    $sid = intval($sid);
    $aid = substr("$aid", 0,25);
    $result = $db->sql_query('select radminsuper from '.$prefix.'_authors where aid=\''.$aid.'\'');
    list($radminsuper) = $db->sql_fetchrow($result);
    $radminsuper = intval($radminsuper);
    $result = $db->sql_query('SELECT admins FROM '.$prefix.'_modules where title=\'News\'');
    $row2 = $db->sql_fetchrow($db->sql_query('SELECT name FROM '.$prefix.'_authors where aid=\''.$aid.'\''));
    while ($row = $db->sql_fetchrow($result)) {
        $admins = explode(",", $row['admins']);
        $auth_user = 0;
        for ($i=0; $i < sizeof($admins); $i++) {
            if ($row2['name'] == "$admins[$i]") {
                $auth_user = 1;
            }
        }
        if ($auth_user == 1) {
            $radminarticle = 1;
        }
    }
    $result2 = $db->sql_query('select aid from '.$prefix.'_stories where sid=\''.$sid.'\'');
    list($aaid) = $db->sql_fetchrow($result2);
    $aaid = substr("$aaid", 0,25);
    if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
        $subject = stripslashes(FixQuotes($subject));
        $hometext = stripslashes(FixQuotes($hometext));
        $bodytext = stripslashes(FixQuotes($bodytext));
        $notes = stripslashes(FixQuotes($notes));
        $db->sql_query('update '.$prefix.'_stories set '."catid='$catid', title='$subject', hometext='$hometext', bodytext='$bodytext', topic='$topic', notes='$notes', ihome='$ihome', alanguage='$alanguage', acomm='$acomm', associated='$associated'".' where sid=\''.$sid.'\'');
        Header('Location: '.$admin_file.'.php?op=adminMain');
    }
}

function adminStory() {
    global $prefix, $db, $language, $multilingual, $admin_file;
    include_once 'header.php';
    GraphicAdmin();
    $sel = '';
    OpenTable();
    echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    $today = getdate();
    $tday = $today['mday'];
    if ($tday < 10){
        $tday = "0$tday";
    }
    $tmonth = $today['month'];
    $ttmon = $today['mon'];
    if ($ttmon < 10){
        $ttmon = "0$ttmon";
    }
    $tyear = $today['year'];
    $thour = $today['hours'];
    if ($thour < 10){
        $thour = "0$thour";
    }
    $tmin = $today['minutes'];
    if ($tmin < 10){
        $tmin = "0$tmin";
    }
    $tsec = $today['seconds'];
    if ($tsec < 10){
        $tsec = "0$tsec";
    }
    $date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
    echo '<form action="'.$admin_file.'.php" method="post">';
    OpenTable();
    echo '<center><font class="option"><b>'._ADDARTICLE.'</b></font></center><br /><br />'
        .'<b>'._TITLE.'</b><br />'
        .'<input type="text" name="subject" size="50" /><br /><br />'
        .'<b>'._TOPIC.'</b> ';
    $toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
    if (!isset($topic)) $topic='';
    echo '<select name="topic">';
    echo '<option value="">'._SELECTTOPIC.'</option>'."\n";
	while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
		$topicid = intval($topicid);
		if ($topicid == $topic) {
			$sel = 'selected="selected "';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
		$sel = '';
	}
    echo '</select><br /><br />';
    echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><b>'._ASSOTOPIC.'</b></td><td width="100%">'
        .'<table border="1" cellspacing="3" cellpadding="8"><tr>';
    $a = 0;
    $sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        if ($a == 3) {
            echo '</tr><tr>';
            $a = 0;
        }
        echo '<td><input type="checkbox" name="assotop[]" value="'.intval($row['topicid']).'" />'.$row['topictext'].'</td>';
        $a++;
    }
    echo '</tr></table></td></tr></table><br /><br />';
    $cat = 0;
    SelectCategory($cat);
    echo '<br />';
    puthome('', '');
    if ($multilingual == 1) {
        $langFound = '';
        $languageslist = '';
        echo '<br /><b>'._LANGUAGE.': </b>'
            .'<select name="alanguage">';
        $handle=opendir('language');
        while ($file = readdir($handle)) {
            if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
                $langFound = $matches[1];
                $languageslist .= "$langFound ";
            }
        }
        closedir($handle);
        $languageslist = explode(" ", $languageslist);
        sort($languageslist);
        for ($i=0; $i < sizeof($languageslist); $i++) {
            if (!empty($languageslist[$i])) {
                echo '<option value="'.$languageslist[$i].'" ';
                if ($languageslist[$i]==$language) echo 'selected="selected"';
                echo '>'.ucfirst($languageslist[$i]).'</option>'."\n";
            }
        }
        echo '<option value="">'._ALL.'</option></select>';
    } else {
        echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
    }
    echo '<br /><br /><b>'._STORYTEXT.'</b><br />';
    wysiwyg_textarea('hometext', '', 'PHPNukeAdmin', 50, 12);
    echo '<br /><br /><b>'._EXTENDEDTEXT.'</b><br />';
    wysiwyg_textarea('bodytext', '', 'PHPNukeAdmin', 50, 12);
    echo '<br /><font class="content">'._ARESUREURL.'</font>'
        .'<br /><br /><b>'._PROGRAMSTORY.'</b>&nbsp;&nbsp;'
        .'<input type="radio" name="automated" value="1" />'._YES.' &nbsp;&nbsp;'
        .'<input type="radio" name="automated" value="0" checked="checked" />'._NO.'<br /><br />'
        ._NOWIS.': '.$date.'<br /><br />';
    $day = 1;
    echo _DAY.': <select name="day">';
    while ($day <= 31) {
        if ($tday==$day) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$day.'</option>';
        $day++;
    }
    echo '</select>';
    $month = 1;
    echo _UMONTH.': <select name="month">';
    while ($month <= 12) {
        if ($ttmon==$month) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$month.'</option>';
        $month++;
    }
    echo '</select>';
    $date = getdate();
    $year = $date['year'];
    echo _YEAR.': <input type="text" name="year" value="'.$year.'" size="5" maxlength="4" />'
        .'<br />'._HOUR.': <select name="hour">';
    $hour = 0;
    $cero = 0;
    while ($hour <= 23) {
        $dummy = $hour;
        if ($hour < 10) {
            $hour = "$cero$hour";
        }
        echo '<option>'.$hour.'</option>';
        $hour = $dummy;
        $hour++;
    }
    echo '</select>'
    .': <select name="min">';
    $min = 0;
    while ($min <= 59) {
        if (($min == 0) OR ($min == 5)) {
            $min = "0$min";
        }
        echo '<option>'.$min.'</option>';
        $min = $min + 5;
    }
    echo '</select>';
    echo ': 00<br /><br />'
        .'<select name="op">'
        .'<option value="PreviewAdminStory" selected="selected">'._PREVIEWSTORY.'</option>'
        .'<option value="PostAdminStory">'._POSTSTORY.'</option>'
        .'</select>'
        .'<input type="submit" value="'._OK.'" />';
    CloseTable();
    echo '<br />';
    if (!isset($pollTitle) OR !isset($optionText)) {
        putpoll('', array_fill(1, 12, ''));
    }
    else putpoll($pollTitle,$optionText);
    echo '</form>';
    include_once 'footer.php';
}

function previewAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
    global $user, $bgcolor1, $bgcolor2, $prefix, $db, $alanguage, $multilingual, $admin_file, $language;
    include_once 'header.php';
    if ($topic<1) {
        $topic = 1;
    }
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._ARTICLEADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    $today = getdate();
    $tday = $today['mday'];
    if ($tday < 10){
        $tday = "0$tday";
    }
    $tmonth = $today['month'];
    $tyear = $today['year'];
    $thour = $today['hours'];
    if ($thour < 10){
        $thour = "0$thour";
    }
    $tmin = $today['minutes'];
    if ($tmin < 10){
        $tmin = "0$tmin";
    }
    $tsec = $today['seconds'];
    if ($tsec < 10){
        $tsec = "0$tsec";
    }
    $date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
    echo '<form action="'.$admin_file.'.php" method="post">';
    OpenTable();
    echo '<center><font class="option"><b>'._PREVIEWSTORY.'</b></font></center><br /><br />'
        .'<input type="hidden" name="catid" value="'.$catid.'" />';
    $subject = stripslashes($subject);
    $subject = ereg_replace('"', '\'\'', $subject);
    $hometext = stripslashes($hometext);
    $bodytext = stripslashes($bodytext);
    $result=$db->sql_query('select topicimage from '.$prefix.'_topics where topicid=\''.$topic.'\'');
    list($topicimage) = $db->sql_fetchrow($result);
    echo '<table border="0" width="75%" cellpadding="0" cellspacing="1" bgcolor="'.$bgcolor2.'" align="center"><tr><td>'
        .'<table border="0" width="100%" cellpadding="8" cellspacing="1" bgcolor="'.$bgcolor1.'"><tr><td>'
        .'<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
    themepreview($subject, $hometext, $bodytext);
    echo '</td></tr></table></td></tr></table>'
        .'<br /><br /><b>'._TITLE.'</b><br />'
        .'<input type="text" name="subject" size="50" value="'.$subject.'" /><br /><br />'
        .'<b>'._TOPIC.'</b><select name="topic">';
    $toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
    echo '<option value="">'._ALLTOPICS.'</option>'."\n";
    while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
        $topicid = intval($topicid);
        if ($topicid==$topic) {
            $sel = 'selected="selected "';
        } else {
			$sel = '';
		}
        echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
    }
    echo '</select><br /><br />';
    $associated = '';
    if (!empty($assotop)) {
        $j = sizeof($assotop);
        for ($i=0; $i<$j; ++$i) {
            $associated .= "$assotop[$i]-";
        }
    }
    $asso_t = explode('-', $associated);
    echo '<table border="0" width="100%" cellspacing="0"><tr><td width="20%"><b>'._ASSOTOPIC.'</b></td><td width="100%">'
        .'<table border="1" cellspacing="3" cellpadding="8"><tr>';
    $a = 0;
    $sql = 'SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext';
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        if ($a == 3) {
            echo '</tr><tr>';
            $a = 0;
        }
        $checked = '';
        for ($i=0; $i<sizeof($asso_t); $i++) {
            if ($asso_t[$i] == $row['topicid']) {
                $checked = 'checked="checked"';
                break;
            }
        }
        echo '<td><input type="checkbox" name="assotop[]" value="'.intval($row['topicid']).'" '.$checked.' />'.$row['topictext'].'</td>';
        $a++;
    }
    echo '</tr></table></td></tr></table><br /><br />';
    $cat = $catid;
    SelectCategory($cat);
    echo '<br />';
    puthome($ihome, $acomm);
    if ($multilingual == 1) {
        $langFound = '';
        $languageslist = '';
        $handle=opendir('language');
        while ($file = readdir($handle)) {
            if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
                $langFound = $matches[1];
                $languageslist .= "$langFound ";
            }
        }
        closedir($handle);
        $languageslist = explode(" ", $languageslist);
        sort($languageslist);
        echo '<br /><b>'._LANGUAGE.': </b>'
            .'<select name="alanguage">';

        for ($i=0; $i < sizeof($languageslist); $i++) {
            if (!empty($languageslist[$i])) {
                echo '<option value="'.$languageslist[$i].'" ';
                if ($languageslist[$i]==$alanguage) echo 'selected="selected"';
                echo '>'.ucfirst($languageslist[$i]).'</option>'."\n";
            }
        }
        if (empty($alanguage)) {
            $sellang = 'selected="selected"';
        } else {
            $sellang = '';

        }
          echo '<option value="" '.$sellang.'>'._ALL.'</option></select>';
    } else {
        echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
    }
    echo '<br /><br /><b>'._STORYTEXT.'</b><br />';
    wysiwyg_textarea('hometext', "$hometext", 'PHPNukeAdmin', 50, 12);
    echo '<br /><br /><b>'._EXTENDEDTEXT.'</b><br />';
    wysiwyg_textarea('bodytext', "$bodytext", 'PHPNukeAdmin', 50, 12);
    if ($automated == 1) {
        $sel1 = 'checked="checked"';
        $sel2 = '';
    } else {
        $sel1 = '';
        $sel2 = 'checked="checked"';
    }
    echo '<br /><br /><b>'._PROGRAMSTORY.'</b>&nbsp;&nbsp;'
        .'<input type="radio" name="automated" value="1" '.$sel1.' />'._YES.' &nbsp;&nbsp;'
        .'<input type="radio" name="automated" value="0" '.$sel2.' />'._NO.'<br /><br />'
        ._NOWIS.': '.$date.'<br /><br />';
    $xday = 1;
    echo _DAY.': <select name="day">';
	while ($xday <= 31) {
		if ($xday == $day) {
			$sel = 'selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option '.$sel.'>'.$xday.'</option>';
		$xday++;
	}
    echo '</select>';
    $xmonth = 1;
    echo _UMONTH.': <select name="month">';
    while ($xmonth <= 12) {
        if ($xmonth == $month) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$xmonth.'</option>';
        $xmonth++;
    }
    echo '</select>';
    echo _YEAR.': <input type="text" name="year" value="'.$year.'" size="5" maxlength="4" />';
    echo '<br />'._HOUR.': <select name="hour">';
    $xhour = 0;
    $cero = 0;
    while ($xhour <= 23) {
        $dummy = $xhour;
        if ($xhour < 10) {
            $xhour = "$cero$xhour";
        }
        if ($xhour == $hour) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$xhour.'</option>';
        $xhour = $dummy;
        $xhour++;
    }
    echo '</select>';
    echo ': <select name="min">';
    $xmin = 0;
    while ($xmin <= 59) {
        if (($xmin == 0) OR ($xmin == 5)) {
            $xmin = "0$xmin";
        }
        if ($xmin == $min) {
            $sel = 'selected="selected"';
        } else {
            $sel = '';
        }
        echo '<option '.$sel.'>'.$xmin.'</option>';
        $xmin = $xmin + 5;
    }
    echo '</select>';
    echo ': 00<br /><br />'
        .'<select name="op">'
        .'<option value="PreviewAdminStory" selected="selected">'._PREVIEWSTORY.'</option>'
        .'<option value="PostAdminStory">'._POSTSTORY.'</option>'
        .'</select>'
        .'<input type="submit" value="'._OK.'" />';
    CloseTable();
    echo '<br />';
    putpoll($pollTitle, $optionText);
    echo '</form>';
    include_once 'footer.php';
}

function postAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
    global $aid, $prefix, $db, $admin_file;
    $associated = '';
    if (!empty($assotop)) {
        $j = sizeof($assotop);
        for ($i=0; $i<$j; ++$i) {
            $associated .= "$assotop[$i]-";
        }
    }
    $notes = '';
    if ($automated == 1) {
        if ($day < 10) {
            $day = "0$day";
        }
        if ($month < 10) {
            $month = "0$month";
        }
        $sec = '00';
        $date = "$year-$month-$day $hour:$min:$sec";
        $author = $aid;
        $subject = stripslashes(FixQuotes($subject));
        $subject = ereg_replace('"', '\'\'', $subject);
        $hometext = stripslashes(FixQuotes($hometext));
        $bodytext = stripslashes(FixQuotes($bodytext));
        $result = $db->sql_query('insert into '.$prefix.'_autonews '."values (NULL, '$catid', '$aid', '$subject', '$date', '$hometext', '$bodytext', '$topic', '$author', '$notes', '$ihome', '$alanguage', '$acomm', '$associated')");
        if (!$result) {
            exit();
        }
        $result = $db->sql_query('update '.$prefix.'_authors set counter=counter+1 where aid=\''.$aid.'\'');
        Header('Location: '.$admin_file.'.php?op=adminMain');
    } else {
        $subject = stripslashes(FixQuotes($subject));
        $hometext = stripslashes(FixQuotes($hometext));
        $bodytext = stripslashes(FixQuotes($bodytext));
        if (($pollTitle != '') AND ($optionText[1] != '') AND ($optionText[2] != '')) {
            $haspoll = 1;
            $timeStamp = time();
            $pollTitle = FixQuotes($pollTitle);
            if (!$db->sql_query('INSERT INTO '.$prefix.'_poll_desc '."VALUES (NULL, '$pollTitle', '$timeStamp', 0, '$alanguage', 0)")) {
                return;
            }
            $object = $db->sql_fetchrow($db->sql_query('SELECT pollID FROM '.$prefix.'_poll_desc where pollTitle=\''.$pollTitle.'\''));
            $id = $object['pollID'];
            $id = intval($id);
            for($i = 1; $i <= sizeof($optionText); $i++) {
                if (!empty($optionText[$i])) {
                    $optionText[$i] = FixQuotes($optionText[$i]);
                }
                if (!$db->sql_query('INSERT INTO '.$prefix.'_poll_data (pollID, optionText, optionCount, voteID) '."VALUES ('$id', '$optionText[$i]', 0, '$i')")) {
                    return;
                }
            }
        } else {
            $haspoll = 0;
            $id = 0;
        }
        $result = $db->sql_query('insert into '.$prefix.'_stories '."values (NULL, '$catid', '$aid', '$subject', now(), '$hometext', '$bodytext', 0, 0, '$topic', '$aid', '$notes', '$ihome', '$alanguage', '$acomm', '$haspoll', '$id', 0, 0, '$associated')");
        $result = $db->sql_query('select sid from '.$prefix.'_stories where title=\''.$subject.'\' order by time DESC limit 0,1');
        list($artid) = $db->sql_fetchrow($result);
        $artid = intval($artid);
        $db->sql_query('UPDATE '.$prefix.'_poll_desc SET artid='.$artid.' where pollID=\''.$id.'\'');
        if (!$result) {
            exit();
        }
        $result = $db->sql_query('update '.$prefix.'_authors set counter=counter+1 where aid=\''.$aid.'\'');
        Header('Location: '.$admin_file.'.php?op=adminMain');
    }
}

function submissions() {
    global $admin, $bgcolor1, $bgcolor2, $prefix, $db, $radminsuper, $anonymous, $multilingual, $admin_file;
    $dummy = 0;
    include_once 'header.php';
    GraphicAdmin();
    OpenTable();
    echo '<center><font class="title"><b>'._SUBMISSIONSADMIN.'</b></font></center>';
    CloseTable();
    echo '<br />';
    OpenTable();
    $result = $db->sql_query('SELECT qid, uid, uname, subject, timestamp, alanguage FROM '.$prefix.'_queue order by timestamp DESC');
    if ($db->sql_numrows($result) == 0) {
        echo '<table width="100%"><tr><td bgcolor="'.$bgcolor1.'" align="center"><b>'._NOSUBMISSIONS.'</b></td></tr></table>'."\n";
    } else {
        echo '<center><font class="content"><b>'._NEWSUBMISSIONS.'</b></font></center><form action="'.$admin_file.'.php" method="post"><table width="100%" border="1" bgcolor="'.$bgcolor2.'"><tr><td><b>&nbsp;'._TITLE.'&nbsp;</b></td>';
        if ($multilingual == 1) {
            echo '<td><center><b>&nbsp;'._LANGUAGE.'&nbsp;</b></center></td>';
        }
        echo '<td><center><b>&nbsp;'._AUTHOR.'&nbsp;</b></center></td><td><center><b>&nbsp;'._DATE.'&nbsp;</b></center></td><td><center><b>&nbsp;'._FUNCTIONS.'&nbsp;</b></center></td></tr>'."\n";
        while (list($qid, $uid, $uname, $subject, $timestamp, $alanguage) = $db->sql_fetchrow($result)) {
            $qid = intval($qid);
            $uid = intval($uid);
            /*
            $hour = 'AM';
            ereg ('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})', $timestamp, $datetime);
            if ($datetime[4] > 12) { $datetime[4] = $datetime[4]-12; $hour = 'PM'; }
            $datetime = date(_DATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
            */
            echo '<tr><td width="100%">'."\n";
            if (empty($subject)) {
                echo '&nbsp;<a href="'.$admin_file.'.php?op=DisplayStory&amp;qid='.$qid.'"><font class="content">'._NOSUBJECT.'</font></a>'."\n";
            } else {
                echo '&nbsp;<a href="'.$admin_file.'.php?op=DisplayStory&amp;qid='.$qid.'"><font class="content">'.$subject.'</font></a>'."\n";
            }
            if ($multilingual == 1) {
                if (empty($alanguage)) {
                    $alanguage = _ALL;
                }
                echo '</td><td align="center"><font size="2">&nbsp;'.$alanguage.'&nbsp;</font>'."\n";
            }
            if ($uname != $anonymous) {
                echo '</td><td align="center" nowrap="nowrap"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$uname.'"><font size="2">&nbsp;'.$uname.'&nbsp;</font></a>'."\n";
            } else {
                echo '</td><td align="center" nowrap="nowrap"><font size="2">&nbsp;'.$uname.'&nbsp;</font>'."\n";
            }
            $timestamp = explode(" ", $timestamp);
            echo '</td><td align="right" nowrap="nowrap"><font class="content">&nbsp;'.$timestamp[0].'&nbsp;</font></td><td align="center"><a class="rn_csrf" href="'.$admin_file.'.php?op=DeleteStory&amp;qid='.$qid.'"><font class="content">&nbsp;'._DELETE.'</font></a>&nbsp;</td></tr>'."\n";
            $dummy++;
        }
        if ($dummy < 1) {
            echo '<tr><td bgcolor="'.$bgcolor1.'" align="center"><b>'._NOSUBMISSIONS.'</b></form></td></tr></table>'."\n";
        } else {
            echo '</table></form>'."\n";
        }
    }
    if ($radminsuper == 1) {
        echo '<br /><center>'
        .'[ <a class="rn_csrf" href="'.$admin_file.'.php?op=subdelete">'._DELETE.'</a> ]'
        .'</center><br />';
    }
    CloseTable();
    include_once 'footer.php';
}

function subdelete() {
    global $prefix, $db, $admin_file;
    $db->sql_query('delete from '.$prefix.'_queue');
    Header('Location: '.$admin_file.'.php?op=adminMain');
}

?>