<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008-2009, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('YA_ADMIN')) 
{
   header('Location: ../../../index.php');
  die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {

    list($uname) = $db->sql_fetchrow($db->sql_query("SELECT username FROM ".$user_prefix."_users_temp WHERE user_id='$chng_uid'"));
    $pagetitle = ": "._USERADMIN." - "._RESENDMAIL;
    include("header.php");
    title(_USERADMIN." - "._RESENDMAIL);
    amain();
    echo '<br />';
    OpenTable();
    echo '<center><form action="'.$admin_file.'.php" method="post">';
    if (isset($listtype)) { echo "<input type='hidden' name='listtype' value='$listtype' />\n"; }
    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
    if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
    echo "<input type='hidden' name='op' value='yaResendMailConf' />\n";
    echo "<input type='hidden' name='rsn_uid' value='$chng_uid' />\n";
    echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
    echo "<tr><td align='center'>"._SURE2RESEND." <b>$uname<i>($chng_uid)</i></b>?</td></tr>\n";
    echo "<tr><td align='center'><input type='submit' value='"._RESENDMAIL."' /></td></tr>\n";
    echo '</table>';
    echo '</form>';
    echo "<form action='#' method='post'>\n";
#    echo '<form action="'.$admin_file.'.php" method="post">';
#    if (isset($listtype)) { echo "<input type='hidden' name='listtype' value='$listtype' />\n"; }
#    if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
#    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
#    echo "<input type='submit' value='"._CANCEL."'>\n";
		echo "<input type='button' value='"._CANCEL."' onclick=\"history.go(-1)\" /></form><br />\n";
    echo "</center>\n";
    CloseTable();
    include('footer.php');

}

?>