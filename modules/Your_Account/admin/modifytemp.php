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
/* RN Your Account is based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('YA_ADMIN'))
{
	header('Location: ../../../index.php');
  die ();
}

if (($radminsuper==1) OR ($radminuser==1)) {

  $chng_uid = intval($chng_uid); // waraxe - Reflected XSS
  $pagetitle = ": "._USERADMIN." - "._USERUPDATE;
  include_once 'header.php';
  title(_USERADMIN." - "._USERUPDATE);
  amain();
  echo '<br />';
	 $result = $db->sql_query("select * from ".$user_prefix."_users_temp where user_id='$chng_uid'");
	 // the fields in users_temp are user_id, username, name etc.
	 // the variable chnginfo refers to one of those fields
	 if($db->sql_numrows($result) > 0) {
	 $chnginfo = $db->sql_fetchrow($result);
	 OpenTable();
	 echo '<center><form action="'.$admin_file.'.php" method="post"><table width="100%" border="0">';
	 echo '<tr><td>'._USERID.':</td><td><b><input type="text" value="'.$chnginfo['user_id'].'" size="40" disabled="disabled" style="color=#000000;background-color: #FFFFFF" /></b></td></tr>';
	 echo '<tr><td>'._NICKNAME.':</td><td><input type="text" name="chng_uname" value="'.$chnginfo['username'].'" size="40" style="color=#000000;background-color: #FFFFFF" /> <b>'._YA_CHNGRISK.'</b></td></tr>';
	 echo '<tr><td>'._UREALNAME.':</td><td><input type="text" name="chng_realname" value="'.$chnginfo['name'].'" size="40" maxlength="60" style="color=#000000;background-color: #ffffff" /></td></tr>';
	 echo '<tr><td>'._EMAIL.':</td><td><input type="text" name="chng_email" value="'.$chnginfo['user_email'].'" size="40" maxlength="60" style="color=#000000;background-color: #ffffff" /></td></tr>';

	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_users_fields WHERE need <> '0' ORDER BY pos");
	// the fields in users_fields are fid, name, value, size, need and pos -- value is a concatenated field with :: as the separator
	// sqlvalue refers to  the users_fields table
	while ($sqlvalue = $db->sql_fetchrow($result)) {
		$t = $sqlvalue['fid'];
		$result1 = $db->sql_query("SELECT * FROM ".$user_prefix."_users_temp_field_values WHERE uid='$chng_uid' AND fid='$t'");
// users temp field values will have fields vid, uid, fid and value ... it will only have one value from the concatenated field value in the users_fields table
		while ($tmpsqlvalue = $db->sql_fetchrow($result1)) {
			$tmp_value=$tmpsqlvalue['value'];
			$value2 = explode("::", $sqlvalue['value']);
			$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
			echo '<tr><td>'.$name_exit.'</td><td>';
			if (count($value2) == 1) {
				echo '<input type="text" name="nfield['.$t.']" value="'.$tmp_value.'" size="40" maxlength="'.$sqlvalue['size'].'" />';
			} else {
				echo '<select name="nfield['.$t.']">';
				for ($i = 0; $i<count($value2); $i++) {
// now we are iterating through the concatenated value field from the users_fields table
// original code was:  	if (trim($chnginfo[$sqlvalue['name']]) == trim($value2[$i])) $sel = 'selected="selected"'; else $sel = '';
// the name field of the users fields table will be the name of a field, not any field from the users temp table
// so the attempt to use an index on $chnginfo that refers to users_temp will fail
// value2 which is the exploded value array from the users_field table needs to be compares with $tmp_value instead
				if (trim($tmp_value) == trim($value2[$i])) $sel = 'selected="selected"'; else $sel = '';
					echo '<option value="'.trim($value2[$i]).'" '.$sel.'>'.$value2[$i].'</option>';
				}
			echo '</select>';
			}
			echo '</td></tr>';
		}
  }

	 echo '<tr><td>'._REGDATE.':</td><td><input type="text" value="'.$chnginfo['user_regdate'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></td></tr>';
	 $chnginfo['time'] = date("D M j H:i T Y", $chnginfo['time']);
	 echo '<tr><td>'._YA_APPROVE2.':</td><td><input type="text" value="'.$chnginfo['time'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></td></tr>'."\n";
	 echo '<tr><td>'._CHECKNUM.':</td><td><input type="text" value="'.$chnginfo['check_num'].'" size="40" disabled="disabled" style="color=#000000;background-color: #ffffff" /></td></tr>'."\n";
	 echo '</table>';
	 echo '<br />';
		echo '<input type="hidden" name="chng_uid"  value="'.$chng_uid.'" />';
		echo '<input type="hidden" name="old_uname" value="'.$chnginfo['username'].'" />';
		echo '<input type="hidden" name="old_email" value="'.$chnginfo['user_email'].'" />';
		echo '<input type="hidden" name="op"        value="yaModifyTempConf" />';
		if (isset($listtype)) { echo '<input type="hidden" name="listtype" value="'.$listtype.'" />'."\n"; }
		if (isset($min))   { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
		if (isset($xop))   { echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n"; }
		echo '<input type="submit" value="'._SAVECHANGES.'" />'."\n";
	 echo '</form>';
	 echo '<form action="'.$admin_file.'.php" method="post">';
	 if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
	 if (isset($xop)) { echo "<input type='hidden' name='xop' value='$xop' />\n"; }
	 echo '<input type="hidden" name="apr_uid" value="'.$chnginfo['user_id'].'" />'.".\n";
	 if ($ya_config['useactivate'] == 1) {
		echo '<input type="hidden" name="op" value="yaApproveUserConf" />'."\n";
		echo '<input type="submit" value="'._YA_APPROVE.'" />'."\n";
	 } else {
		echo '<input type="hidden" name="op" value="yaActivateUser">'."\n";
		echo '<input type="submit" value="'._YA_ACTIVATE.'" />'."\n";
	 }
	 echo '</form>';
	 echo '<form action="#" method="post">'."\n";
#		if (isset($min)) { echo "<input type='hidden' name='min' value='$min' />\n"; }
#		if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
#		echo "<input type='submit' value='"._RETURN."' /></form><br />\n";
		echo '<input type="button" value="'._RETURN.'" onclick="history.go(-1)" /></form><br />'."\n";
	 echo '<b>'._NOTE.'</b><br />'."\n";
	 echo '<b>'._YA_APPROVENOTE.'</b><br />'."\n";
	 echo '<b>'._YA_ACTIVATENOTE.'</b>'."\n";
	 echo "</center>\n";
	 echo '<br />';

	 CloseTable();
  } else {
	 OpenTable();
	 echo "<center><b>"._USERNOEXIST."</b></center>\n";
	 CloseTable();
  }
  include_once 'footer.php';

}

?>