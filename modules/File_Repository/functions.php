<?php

/************************************************************************/
/* File Repository FUNCTIONS LIST                                       */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by MJ Hufford                                     */
/* http://www.GuitarVoice.com                                           */
/* v2.8                                                                 */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

//****************CONFIGURATION OF MODULE VARIABLES*********************//
//WHAT THE MODULE NAME APPEARS TO BE TO END USERS
$custom_module_name = "Gig Bag";

//NUMBER OF FILES TO SHOW PER PAGE
$perpage = 25;

//ALLOW USERS TO CHANGE PERPAGE SIZE
$allowPerPageChange = 1;

//MIN DOWNLOADS BEFORE A FILE BECOMES POPULAR
$popular = 250;

//MIN VOTES BEFORE FILE WILL BE IN TOP RATED QUERY
$file_votes_min = 0;

//MIN VOTES BEFORE FILE WILL BE IN TOP RATED QUERY
$min_avg_score = 7;

//COLOR OF PASSCODE TEXT
$passcodeColor = "yellow";
$popupWarningColor = "red";

//FILE DIRECTORY
//BE SURE TO CHMOD TO 777
//MUST START WITH FOLDER NAME AND END WITH A FORWARD SLASH "/"
$file_dir = "modules/File_Repository/files/";

//GIVES ADMINS DIRECT LINK TO FILE
//0 = NO BYPASS
//1 = BYPASSES FETCH-IT 
$easy_admin_access = 1;

//MEDIA ARRAY FOR MEDIA POPUP WINDOW
//ADD MEDIA TYPES BY EXTENSION, SEPARATED BY COMMAS
$audio_array = array("mp3","wav","wma","mid");
$video_array = array("mpg","mpeg","avi","mp4","mov");
$allowedImageExtensions = array("gif", "jpg", "png", "ico");

//********************DO NOT EDIT BELOW THIS LINE*************************//
$isAdmin = is_admin($admin);

function JavaScriptAlertBack($message, $backCount)
{
	echo "<script type=\"text/javascript\">alert(\"".$message."\"); history.go(-".$backCount.");</script>";
}

function user_list($user_id=NULL){
  global $db, $prefix;
  $user_sql = "SELECT user_id, username FROM ".$prefix."_users ORDER BY username";
  $user_results = $db->sql_query($user_sql);
  $user_numrows = $db->sql_numrows($user_results);
  if($user_numrows == ''){
    $user_select = '';
    } else {
      for($x=0;$x<$user_numrows;$x++){
        $user_row = $db->sql_fetchrow($user_results);
        $id = $user_row['user_id'];
        $username = $user_row['username'];
        if($id == $user_id){
          $selected = 'Selected';
          } else {
            $selected = '';
        }
        $user_select .= '<option value="'.$id.'" '.$selected.'>'.$username.'</option>';
      }
    }
	return $user_select;        
}

function userinfo($user_id){
  global $db, $prefix;
  $user_sql = "SELECT * FROM ".$prefix."_users WHERE user_id=".$user_id;
  $user_row = $db->sql_fetchrow($db->sql_query($user_sql));
  return $user_row;        
}
  
function category_list($category_id=NULL){
  global $db, $prefix;
  $category_sql = "SELECT * FROM ".$prefix."_fr_categories ORDER BY name";
  $category_results = $db->sql_query($category_sql);
  $category_numrows = $db->sql_numrows($category_results);
  if($category_numrows == 0){
    $category_select = '';
    } else {
      for($x=0;$x<$category_numrows;$x++){
	    $category_row = $db->sql_fetchrow($category_results);
	  	$id = $category_row['id'];
	  	$name = $category_row['name'];
	  	if ($id == $category_id){
	  	  $selected = 'Selected';
	  	  } else {
	  	  	$selected = '';
	  	}
	  	$category_select .= '<option value="'.$id.'" '.$selected.'>'.$name.'</option>';
	  }
	}
  return $category_select;
}

function cat_postback_list($category_id, $file_id){
  global $db, $prefix, $admin_file, $module_name;
  $category_sql = "SELECT * FROM ".$prefix."_fr_categories ORDER BY name";
  $category_results = $db->sql_query($category_sql);
  $category_numrows = $db->sql_numrows($category_results);
  $category_select = '<select name="category_id" onchange="window.top.location=(this.options[this.selectedIndex].value);">';
  for($x=0;$x<$category_numrows;$x++){
    $category_row = $db->sql_fetchrow($category_results);
  	$id = $category_row['id'];
  	$name = $category_row['name'];
  	if ($id == $category_id){
  	  $selected = 'Selected';
  	  } else {
  	  	$selected = '';
  	}
  	$category_select .= '<option value="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=edit&file_id='.$file_id.'&new_cat='.$id.'#admin_top" '.$selected.'>'.$name.'</option>';
  }
  $category_select .= '</select>';
  return $category_select;
}

function apps_list($app_id=NULL, $category_id=NULL){
  global $db, $prefix;
  if($category_id != NULL){$where = "WHERE parent_id = $category_id";}
  $apps_sql = "SELECT id, app_name FROM ".$prefix."_fr_apps $where ORDER BY app_name";
  $apps_results = $db->sql_query($apps_sql);
  $apps_numrows = $db->sql_numrows($apps_results);
  if($apps_numrows == 0){
    $apps_select = '';
    } else {
      for($x=0;$x<$apps_numrows;$x++){
	    $apps_row = $db->sql_fetchrow($apps_results);
	    $id = $apps_row['id'];
	    $app_name = $apps_row['app_name'];
	    if ($id == $app_id){
	      $selected = 'Selected';
	      } else {
	        $selected = '';
	    }
	    $apps_select .= '<option value="'.$id.'" '.$selected.'>'.$app_name.'</option>';
	  }
	}
  return $apps_select;
}

function apps_list2(){
  global $db, $prefix;
  $apps_sql = "SELECT a.id, CONCAT(b.name, ': ', a.app_name) AS list_name FROM ".$prefix."_fr_apps a, ".$prefix."_fr_categories b WHERE a.parent_id = b.id ORDER BY list_name";
  $apps_results = $db->sql_query($apps_sql);
  $apps_numrows = $db->sql_numrows($apps_results);
  if($apps_numrows == 0){
    $apps_select = '';
    } else {
      for($x=0;$x<$apps_numrows;$x++){
	    $apps_row = $db->sql_fetchrow($apps_results);
	    $id = $apps_row['id'];
	    $app_name = $apps_row['list_name'];
	    if ($id == $app_id){
	      $selected = 'Selected';
	      } else {
	        $selected = '';
	    }
	    $apps_select .= '<option value="'.$id.'" '.$selected.'>'.$app_name.'</option>';
	  }
	}
  return $apps_select;
}
  
function ext_list($ext_id=NULL){
  global $db, $prefix;
  $ext_sql = "SELECT a.id, CONCAT(b.app_name, ': ', a.ext) AS ext FROM ".$prefix."_fr_ext a, ".$prefix."_fr_apps b WHERE a.parent_id = b.id ORDER BY ext";
  $ext_results = $db->sql_query($ext_sql);
  $ext_numrows = $db->sql_numrows($ext_results);
  if($ext_numrows == 0){
    $ext_select = '';
    } else {
      for($x=0;$x<$ext_numrows;$x++){
	    $ext_row = $db->sql_fetchrow($ext_results);
	    $id = $ext_row['id'];
	    $ext = $ext_row['ext'];
	    if ($id == $ext_id){
	      $selected = 'Selected';
	      } else {
	        $selected = '';
	    }
	    $ext_select .= '<option value="'.$id.'" '.$selected.'>'.$ext.'</option>';
	  }
	}
  return $ext_select;
}

function approved_ext_array($parent_id){
  global $db, $prefix;
  $ext_sql = "SELECT ext FROM ".$prefix."_fr_ext WHERE parent_id=".$parent_id." ORDER BY ext";
  $ext_results = $db->sql_query($ext_sql);
  $ext_numrows = $db->sql_numrows($ext_results);
  if($ext_numrows == 0){
    $approved_array = '<center><b>There are no file extensions associated with this applicaiton</b></center>';
    } else {
      for($x=0;$x<$ext_numrows;$x++){
        $ext_row = $db->sql_fetchrow($ext_results);
        $ext = $ext_row['ext'];
        $approved_array[] .= $ext;
      }
  }
  return $approved_array;
}

function validate_file_ext($application_id, $filename){
  global $db, $prefix;
  $file_array = explode(".", $filename);
  $array_length = count($file_array);
  $file_ext = $file_array[$array_length-1];
  $ext_sql = "SELECT * FROM ".$prefix."_fr_ext WHERE ext='".$file_ext."'";
  $ext_numrows = $db->sql_numrows($db->sql_query($ext_sql));
  if($ext_numrows > 0){
    $ext_ok = TRUE;
    } else {
      $ext_ok = FALSE;
  }
  return $ext_ok;
}

function file_list($file_id=NULL){
  global $db, $prefix;
  $file_sql = "SELECT a.id, CONCAT(b.app_name, ': ', a.title, ' (', c.username, ')') AS file_name FROM ".$prefix."_fr_files a, ".$prefix."_fr_apps b, ".$prefix."_users c WHERE a.parent_id = b.id AND a.user_id = c.user_id ORDER BY file_name";
  $file_results = $db->sql_query($file_sql);
  $file_numrows = $db->sql_numrows($file_results);
  if($file_numrows == 0){
    $file_select = '';
    } else {
      for($x=0;$x<$file_numrows;$x++){
	    $file_row = $db->sql_fetchrow($file_results);
	    $id = $file_row['id'];
	    $file_name = $file_row['file_name'];
	    if ($id == $file_id){
	      $selected = 'Selected';
	      } else {
	        $selected = '';
	    }
	    $file_select .= '<option value="'.$id.'" '.$selected.'>'.$file_name.'</option>';
	  }
	}
  return $file_select;
}

function email_admin($file_id){
  global $db, $prefix, $sitename, $module_name, $custom_module_name;  
  //GET ADMIN EMAIL ADDRESSES
  $admin_mail_sql = $db->sql_query("SELECT * FROM ".$prefix."_authors");
  $admin_mail_numrows = $db->sql_numrows($admin_mail_sql);
  for($x=0;$x<$admin_mail_numrows;$x++){
    $admin_mail_row = $db->sql_fetchrow($admin_mail_sql);
    $name = $admin_mail_row['name'];
    $email = $admin_mail_row['email'];
    $radminsuper = $admin_mail_row['radminsuper'];
    if($radminsuper == 1){
      if($x == 0){$admin_email .= $email.', ';}
      if($x == $admin_mail_numrows -1){$admin_email .= $email;} 
      if($x > 0 && $x < $admin_mail_numrows-1){$admin_email .= $email.', ';} 
	  } else {
	    $mod_admin = $db->sql_query("SELECT * FROM ".$prefix."_modules WHERE admins LIKE '%".$name."%' AND title='".$module_name."'");
	    $mod_admin_numrows = $db->sql_numrows($mod_admin);
	    if($mod_admin_numrows > 0) {
	      if($x == 0){$admin_email .= $email.', ';}
      	  if($x == $admin_mail_numrows -1){$admin_email .= $email;} 
      	  if($x > 0 && $x < $admin_mail_numrows-1){$admin_email .= $email.', ';} 
	    }
	}
  }
  //GET FILE INFO
  $new_file_sql = "SELECT
  					  a.username AS username,
  					  a.user_email AS user_email, 
					  b.user_ip AS user_ip,
					  b.title AS title,
					  c.app_name AS application,
					  b.comments AS comments
				   FROM
				   	  ".$prefix."_users a,
					  ".$prefix."_fr_files b,
					  ".$prefix."_fr_apps c
				   WHERE
				   	  a.user_id = b.user_id AND
					  b.parent_id = c.id AND
					  b.id = ".$file_id;
  $new_file_row = $db->sql_fetchrow($db->sql_query($new_file_sql));

  //MAIL HEADERS
  $headers = "Content-Type: text/html\n";
  $headers .= "From: ".$sitename." <NoReply@".$sitename.">\n";
  $headers .= "Reply-To: NoReply@".$sitename."\n\n";  
  $to = $admin_email;
  $subject = "New ".$custom_module_name." Submission";
  $msg = '<center><b>New '.$custom_module_name.' Submission</b></center><br /><br />'
         .'You have a new '.$custom_module_name.' submission for your site!<br />'
         .'<table cellpadding="2" cellspacing="2">
         	 <col valign="top">
         	 <col valign="top">
         	 <tr>
         	 	<td><b>User: </b></td>
         	 	<td>'.$new_file_row['username'].'</td>
         	 </tr>
         	 <tr>
         	 	<td><b>User Email:</b></td>
         	 	<td>'.$new_file_row['user_email'].'</td>
         	 </tr>
         	 <tr>
         	 	<td><b>User IP:</b></td>
         	 	<td>'.$new_file_row['user_ip'].'</td>
         	 </tr>
         	 <tr>
         	 	<td><b>Application:</b></td>
         	 	<td>'.$new_file_row['application'].'</td>
         	 </tr>
         	 <tr>
         	 	<td><b>Title:</b></td>
         	 	<td>'.$new_file_row['title'].'</td>
         	 </tr>
         	 <tr>
         	 	<td><b>Comments:</b></td>
         	 	<td>'.$new_file_row['comments'].'</td>
         	 </tr>
          </table><br />
          Login to the admin control panel to approve or deny this file.<br />';
  mail($to,$subject,$msg,$headers);
}
  
function email_user_approve($file_id){
  global $db, $prefix, $sitename;
  //GET FILE INFO
  $file_sql = "SELECT
  					  a.user_email AS user_email, 
					  b.title AS title,
					  c.app_name AS application,
					  b.comments AS comments
				   FROM
				   	  ".$prefix."_users a,
					  ".$prefix."_fr_files b,
					  ".$prefix."_fr_apps c
				   WHERE
				   	  a.user_id = b.user_id AND
					  b.parent_id = c.id AND
					  b.id = ".$file_id;
  $file_row = $db->sql_fetchrow($db->sql_query($file_sql));
  //BUILD EMAIL
  $headers = "Content-Type: text/html\n";
  $headers .= "From: ".$sitename." <NoReply@".$sitename.">\n";
  $headers .= "Reply-To: NoReply@".$sitename."\n\n";  
  $to = $file_row['user_email'];
  $subject = "File Submission Approved!";
  $msg = '<center><b>'.$custom_module_name.' Submission Approved!</b></center><br /><br />'
         .'Your '.$custom_module_name.' submission at '.$sitename.' has been approved!  Details are listed below.<br />'
         .'<table cellpadding="2" cellspacing="2">
         	 <col valign="top">
         	 <col valign="top">
         	 <tr>
         	 	<td><b>Application:</b></td>
         	 	<td>'.$file_row['application'].'</td>
         	 </tr>
         	 <tr>
         	 	<td><b>Title:</b></td>
         	 	<td>'.$file_row['title'].'</td>
         	 </tr>
         	 <tr>
         	 	<td><b>Comments:</b></td>
         	 	<td>'.$file_row['comments'].'</td>
         	 </tr>
          </table><br />
          Thank you for your support of '.$sitename.'.
		  <br /><br /><hr>-'.$sitename.' Staff';
  //SEND EMAIL
  mail($to,$subject,$msg,$headers);
}

function delete_file($file_id, $denial_reason){
  global $db, $prefix, $sitename, $module_name;
  //GET FILE INFO
  $file_sql = "SELECT
  					  a.user_email AS user_email, 
					  b.title AS title,
					  c.app_name AS application,
					  b.comments AS comments
				   FROM
				   	  ".$prefix."_users a,
					  ".$prefix."_fr_files b,
					  ".$prefix."_fr_apps c
				   WHERE
				   	  a.user_id = b.user_id AND
					  b.parent_id = c.id AND
					  b.id = ".$file_id;
  $file_row = $db->sql_fetchrow($db->sql_query($file_sql));
  
  //GET ADMIN EMAIL ADDRESSES
  $admin_mail_sql = $db->sql_query("SELECT * FROM ".$prefix."_authors");
  $admin_mail_numrows = $db->sql_numrows($admin_mail_sql);
  for($x=0;$x<$admin_mail_numrows;$x++){
    $admin_mail_row = $db->sql_fetchrow($admin_mail_sql);
    $name = $admin_mail_row['name'];
    $email = $admin_mail_row['email'];
    $radminsuper = $admin_mail_row['radminsuper'];
    if($radminsuper == 1){
      if($x == 0){$admin_email .= $email.', ';}
      if($x == $admin_mail_numrows -1){$admin_email .= $email;} 
      if($x > 0 && $x < $admin_mail_numrows-1){$admin_email .= $email.', ';} 
	  } else {
	    $mod_admin = $db->sql_query("SELECT * FROM ".$prefix."_modules WHERE admins LIKE '%".$name."%' AND title='".$module_name."'");
	    $mod_admin_numrows = $db->sql_numrows($mod_admin);
	    if($mod_admin_numrows > 0) {
	      if($x == 0){$admin_email .= $email.', ';}
      	  if($x == $admin_mail_numrows -1){$admin_email .= $email;} 
      	  if($x > 0 && $x < $admin_mail_numrows-1){$admin_email .= $email.', ';} 
	    }
	}
  }
  
  //BUILD EMAIL
  $headers = "Content-Type: text/html\n";
  $headers .= "From: ".$sitename." <NoReply@".$sitename.">\n";
  $headers .= "Bcc: $admin_email\r\n";
  $headers .= "Reply-To: NoReply@".$sitename."\n\n";  
  $to = $file_row['user_email'];
  $subject = "File Submission Denied";
  $msg = '<center><b>'.$custom_module_name.' Submission Denied</b></center><br /><br />'
         .'We\'re sorry, but your '.$custom_module_name.' submission at '.$sitename.' has been denied.  Details are listed below.<br />'
         .'<table cellpadding="2" cellspacing="2">
             <col valign="top">
         	 <col valign="top">
         	 <tr>
         	 	<td><b>Application:</b></td>
         	 	<td>'.$file_row['application'].'</td>
         	 </tr>
         	 <tr>
         	 	<td><b>Title:</b></td>
         	 	<td>'.$file_row['title'].'</td>
         	 </tr>
         	 <tr>
         	 	<td><b>Comments:</b></td>
         	 	<td>'.$file_row['comments'].'</td>
         	 </tr>
          </table><br />
          <b>Reason for file denial:</b> '.$denial_reason.'
		  <br /><br /><hr>-'.$sitename.' Staff';
    //DELETE RECORD FROM DB
    if($db->sql_query("DELETE FROM ".$prefix."_fr_files WHERE id=".$file_id)){
     	//SEND EMAIL
  		if(mail($to,$subject,$msg,$headers)){
      		return TRUE;
      	} else {return FALSE;}
    } else {return FALSE;}
}

//GET THE DAY OUT OF THE LINUX BASED DATE/TIMESTAMP FIELD
function date_day($date) {
  $explode_date = explode ("-", $date);
  $explode_funky = explode (" ", $explode_date[2]);
  $date_day = $explode_funky[0];
  return $date_day;
}

//GET THE MONTH OUT OF THE LINUX BASED DATE/TIMESTAMP FIELD
function date_month($date) {
  $explode_date = explode ("-", $date);
  $date_month = $explode_date[1];
  return $date_month;
}

//GET THE YEAR OUT OF THE LINUX BASED DATE/TIMESTAMP FIELD
function date_year($date) {
  $explode_date = explode ("-", $date);
  $date_year = $explode_date[0];
  return $date_year;
}

//GET THE HOURS OUT OF THE LINUX BASED DATE/TIMESTAMP FIELD
function time_hours($date) {
  $explode_date = explode ("-", $date);
  $explode_funky = explode (" ", $explode_date[2]);
  $explode_time = explode (":", $explode_funky[1]);
  $time_hours = $explode_time[0];
  return $time_hours;
}

//GET THE MINUTES OUT OF THE LINUX BASED DATE/TIMESTAMP FIELD
function time_minutes($date) {
  $explode_date = explode ("-", $date);
  $explode_funky = explode (" ", $explode_date[2]);
  $explode_time = explode (":", $explode_funky[1]);
  $time_minutes = $explode_time[1];
  return $time_minutes;
}

//GET THE SECONDS OUT OF THE LINUX BASED DATE/TIMESTAMP FIELD
function time_seconds($date) {
  $explode_date = explode ("-", $date);
  $explode_funky = explode (" ", $explode_date[2]);
  $explode_time = explode (":", $explode_funky[1]);
  $time_seconds = $explode_time[2];
  return $time_seconds;
}

//MAKE A NICE PERTY DATE (Sunday, March 25, 2006)
function mk_pretty_date($ugly_date) {
  $day = date_day($ugly_date);
  $month = date_month($ugly_date);
  $year = date_year($ugly_date);
  $timestamp = mktime(0,0,0,$month,$day,$year);
  $pretty_date = date('l, F d Y', $timestamp);
  return $pretty_date;
}
 
function resize_bytes($size){
   $count = 0;
   $format = array("B","KB","MB","GB","TB","PB","EB","ZB","YB");
   while(($size/1024)>1 && $count<8){
       $size=$size/1024;
       $count++;
   }
   $new_size = number_format($size,0,'','.')." ".$format[$count];
   return $new_size;
}

function makeSecPass() {
	  global $module_name;
	  $cons = "bcdfghjklmnpqrstvwxyz";
	  $vocs = "aeiou";
	  for ($x=0; $x < 6; $x++) {
	      mt_srand ((double) microtime() * 1000000);
		$con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
		$voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
	  }
	  $makepass = $con[0] . $voc[0] .$con[2] . $con[1] . $voc[1] . $con[3] . $voc[3] . $con[4];
	  return($makepass);
}

function gfx($random_num) {
    global $module_name;
    $image = ImageCreateFromJPEG('modules/'.$module_name.'/images/code_bg.jpg');
    $text_color = ImageColorAllocate($image, 0, 255, 0);
    Header("Content-type: image/jpeg");
    ImageString ($image, 5, 3, 2, $random_num, $text_color);
    ImageJPEG($image, '', 75);
    ImageDestroy($image);
    echo "$random_num";
    die();
}

function new_files($file_id, $upload_date){
  global $module_name;
  //NEWEST FILES - LESS THAN 1 WEEK OLD
  if($upload_date > (date('Y-m-d H:i:s', time()-(86400 * 7)))){
    $new_file_img = '&nbsp;&nbsp;<img src="modules/'.$module_name.'/images/new_1.gif" alt="New this week!" />';
    //NEWER FILES - LESS THAN 2 WEEKS OLD
    } elseif ($upload_date > (date('Y-m-d H:i:s', time()-(86400 * 14)))){
      $new_file_img = '&nbsp;&nbsp;<img src="modules/'.$module_name.'/images/new_2.gif" alt="New last week!" />';
      //NEW FILES - LESS THAN ONE MONTH OLD
      } elseif ($upload_date > (date('Y-m-d H:i:s', time()-(86400 * 30)))){
        $new_file_img = '&nbsp;&nbsp;<img src="modules/'.$module_name.'/images/new_3.gif" alt="New this month!" />';
        //NOT A NEW FILE
  		} else $new_file_img = '';
  return $new_file_img;
}

//CUSTOM FILTERS
function custom1_filter($app_id, $lbl_custom1){
  global $db, $prefix, $admin_file, $module_name;
  $custom1_sql = "SELECT DISTINCT(custom1) FROM ".$prefix."_fr_files WHERE parent_id=".$app_id." ORDER BY custom1";
  $custom1_results = $db->sql_query($custom1_sql);
  $custom1_numrows = $db->sql_numrows($custom1_results);
  $custom1_select = '<select name="category_id" onchange="window.top.location=(this.options[this.selectedIndex].value);">';
  $custom1_select .= '<option value="">*Filter by '.$lbl_custom1.'*</option>';
  for($x=0;$x<$custom1_numrows;$x++){
    $custom1_row = $db->sql_fetchrow($custom1_results);
  	$custom1 = $custom1_row['custom1'];
  	$custom1_select .= '<option value="modules.php?name='.$module_name.'&op=view&mode=view&app_id='.$app_id.'&custom_filter=1&filter='.$custom1.'#admin_top">'.$custom1.'</option>';
  }
  $custom1_select .= '</select>';
  return $custom1_select;
}

function custom2_filter($app_id, $lbl_custom2){
  global $db, $prefix, $admin_file, $module_name;
  $custom2_sql = "SELECT DISTINCT(custom2) FROM ".$prefix."_fr_files WHERE parent_id=".$app_id." ORDER BY custom2";
  $custom2_results = $db->sql_query($custom2_sql);
  $custom2_numrows = $db->sql_numrows($custom2_results);
  $custom2_select = '<select name="category_id" onchange="window.top.location=(this.options[this.selectedIndex].value);">';
  $custom2_select .= '<option value="">*Filter by '.$lbl_custom2.'*</option>';
  for($x=0;$x<$custom2_numrows;$x++){
    $custom2_row = $db->sql_fetchrow($custom2_results);
  	$custom2 = $custom2_row['custom2'];
  	$custom2_select .= '<option value="modules.php?name='.$module_name.'&op=view&mode=view&app_id='.$app_id.'&custom_filter=2&filter='.$custom2.'#admin_top">'.$custom2.'</option>';
  }
  $custom2_select .= '</select>';
  return $custom2_select;
}

function custom3_filter($app_id, $lbl_custom3){
  global $db, $prefix, $admin_file, $module_name;
  $custom3_sql = "SELECT DISTINCT(custom3) FROM ".$prefix."_fr_files WHERE parent_id=".$app_id." ORDER BY custom3";
  $custom3_results = $db->sql_query($custom3_sql);
  $custom3_numrows = $db->sql_numrows($custom3_results);
  $custom3_select = '<select name="category_id" onchange="window.top.location=(this.options[this.selectedIndex].value);">';
  $custom3_select .= '<option value="">*Filter by '.$lbl_custom3.'*</option>';
  for($x=0;$x<$custom3_numrows;$x++){
    $custom3_row = $db->sql_fetchrow($custom3_results);
  	$custom3 = $custom3_row['custom3'];
  	$custom3_select .= '<option value="modules.php?name='.$module_name.'&op=view&mode=view&app_id='.$app_id.'&custom_filter=3&filter='.$custom3.'#admin_top">'.$custom3.'</option>';
  }
  $custom3_select .= '</select>';
  return $custom3_select;
}
//END CUSTOM FILTERS

//FIND OUT IF USER HAS ACCESS
function determine_access($user_id){
  global $prefix, $db, $admin, $module_name, $sitename, $custom_module_name;
  $grant = "No";
  
  //GET RESTRCIOTION PARAMETERS
  $restrict_row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fr_restrictions"));
  
  //DOWNLOAD INFO
  $down_num = $restrict_row['down_num'];
  $down_days = $restrict_row['down_days'];
  $old_down_date = date('Y-m-d H:i:s', time()-(86400 * $down_days));
  if($down_num == 0 && $down_days == 0) $grant = "Yes"; //GIVE ACCESS IF VALUES ARE ZERO
  
  
  //CLEAN DOWNLOADS TABLE
  $db->sql_query("DELETE FROM ".$prefix."_fr_downloads WHERE DATEDIFF('".date('Y-m-d')."', download_date) > ".$down_days);
  //CLEAN TABLE OF EXPIRED ACCESS RESTRICTIONS
  $db->sql_query("DELETE FROM ".$prefix."_fr_custom_access WHERE duration > 0 AND '".date('Y-m-d')."' > ADDDATE(date_entered, duration)");
  
  
  //DONATE INFO
  $donate_num = $restrict_row['donate_num'];
  $donate_days = $restrict_row['donate_days'];
  $old_donate_date = date('Y-m-d H:i:s', time()-(86400 * $donate_days));
  if($donate_num == 0 && $donate_days == 0) $grant = "Yes"; //GIVE ACCESS IF VALUES ARE ZEROS
  
  //USER DOWNLOADS
  $user_downloads = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_downloads WHERE user_id=".$user_id." AND download_date > '".$old_down_date."'"));
  if($user_downloads < $down_num) $grant = "Yes";
 
  //USER DONATIONS
  $user_donations = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE user_id=".$user_id." AND upload_date > '".$old_donate_date."' AND approved=1"));
  if($user_donations >= $donate_num) $grant = "Yes";

  
  //CUSTOM INDIVIDUAL USER ACCESS CHECK
  $custom_sql = $db->sql_query("SELECT * FROM ".$prefix."_fr_custom_access WHERE user_id=".$user_id);
  $custom_numrows = $db->sql_numrows($custom_sql);
  if($custom_numrows > 0){
    $custom_row = $db->sql_fetchrow($custom_sql);
    $access_type = $custom_row['access_type'];
    $duration = $custom_row['duration'];
    $duration_seconds = (86400 * $duration);
    $date_entered = $custom_row['date_entered'];
    $date_entered_ts = strtotime($date_entered);
    $custom_access_over = $date_entered_ts+$duration_seconds;
    switch($access_type){
      case "Unlimitted":
      	if($duration == 0){
		  $grant = "Yes";
		  } else {
		    if(time() < $custom_access_over){
		      $grant = "Yes";
		      } else $grant = "No";
	    }
      break;
      
      case "Denied":
        if($duration == 0){
		  $denied = "Yes";
		  $duration_days = "an unlimitted number of";
		  } else {
		    if(time() < $custom_access_over){
			  $denied = "Yes";
			  $duration_days = $duration;
			}
	    }
	    if($denied == "Yes"){
	      OpenTable();
		  echo '<span class="title"><center>ACCESS DENIED!</center></span><br /><br />';
		  echo '<center><b>You\'ve been denied access to this module for '.$duration_days.' days! Please contact an administrator if you have any questions.</center></b><br /><br />';
		  CloseTable();
		  include("footer.php");
		  die();
		}
      break;
    }
  }
  if(is_admin($admin)) $grant = "Yes";
  //IF GRANT IS NO - DENY USER FILE
  if($grant == "No"){
    OpenTable();
    echo '<span class="title"><center>User Download Quota Exceeded</center></span><br /><br />';
    echo '<center><b>You\'ve exceeded your download quota!</center></b><br /><br />';
    echo 'In an effort to promote community participation, '.$sitename.' has implemented a quota limit for members using the '.$custom_module_name.'.  If you have donated <b>'.$donate_num.'</b> files in the last <b>'.$donate_days.'</b> days, you will be granted full access to the '.$custom_module_name.'.  Otherwise, you will be permitted to download <b>'.$down_num.'</b> files every <b>'.$down_days.'</b> days.  <a href="modules.php?name='.$module_name.'&op=add" title="Help our community grow!">Please click here to donate files to the community!</a><br /><br />'; 
    CloseTable();
    include("footer.php");
    die();
  } else return $grant;  
}

//RETURNS USERS WHO DO NOT HAVE CUSTOM ACCESS
function custom_access_user_list(){
  global $db, $prefix;
  $user_sql = "SELECT a.user_id AS custom_user_id, a.username AS username FROM ".$prefix."_users a LEFT OUTER JOIN ".$prefix."_fr_custom_access b ON a.user_id = b.user_id WHERE b.user_id IS NULL ORDER BY a.username";
  $user_results = $db->sql_query($user_sql);
  $user_numrows = $db->sql_numrows($user_results);
  for($x=0;$x<$user_numrows;$x++){
    $user_row = $db->sql_fetchrow($user_results);
    $id = $user_row['custom_user_id'];
    $username = $user_row['username'];
    $user_select .= '<option value="'.$id.'">'.$username.'</option>';
  }
	return $user_select;
}

//RETURNS USERS WHO CURRENTLY HAVE CUSTOM ACCESS
function custom_access_user_list2(){
  global $db, $prefix;
  $user_sql = "SELECT a.username AS username, b.user_id AS user_id FROM ".$prefix."_users a, ".$prefix."_fr_custom_access b WHERE a.user_id = b.user_id ORDER BY a.username";
  $user_results = $db->sql_query($user_sql);
  $user_numrows = $db->sql_numrows($user_results);
  if($user_numrows == 0){
    $user_select = '';
    } else {
      for($x=0;$x<$user_numrows;$x++){
	    $user_row = $db->sql_fetchrow($user_results);
	    $id = $user_row['user_id'];
	    $username = $user_row['username'];
	    $user_select .= '<option value="'.$id.'">'.$username.'</option>';
	  }
	}
	return $user_select;
}	

//VALIDATE MEDIA TYPE
function media_type($extension){
 global $audio_array, $video_array;
  $media_type = "other";  
  for($x=0;$x<count($audio_array);$x++){
     if($extension == $audio_array[$x]){$media_type = "audio";}
  }
  
  for($x=0;$x<count($video_array);$x++){
     if($extension == $video_array[$x]){$media_type = "video";}
  }
  return $media_type;
}  

function fileTableStyle()
{
	return '<style type="text/css">
				.sortable td
				{
					white-space:nowrap;
					vertical-align: text-top;					
				}
				.fr_details
				{
					white-space:normal !important;
				}
			</style>';
}

//Get File Repository Row
function BuildFileRepositoryRow($fileLink, $show_custom1, $custom1, $show_custom2, $custom2, $show_custom3, $custom3, $hits, $rating, $fileSize, $createDate, $fileId, $editIcon, $newIcon)
{
	global $module_name;
   if($show_custom1){$custom1_cell="<td>".$custom1."</td>";}
   if($show_custom2){$custom2_cell="<td>".$custom2."</td>";}
   if($show_custom3){$custom3_cell="<td>".$custom3."</td>";}
   
   return  "<tr>"
		  ."<td>".$editIcon." ".$fileLink." (".$fileSize.") ".$newIcon."</td>"
		  .$custom1_cell
		  .$custom2_cell
		  .$custom3_cell
		  ."<td>".$hits."</td>"
		  ."<td>".$rating."</td>"
		  ."<td><a href='modules.php?name=".$module_name."&op=details&file_id=".$fileId."' title='"._DETAILSTITLE."'>"._DETAILS."</a></td>"
		  ."</tr>";
}

function BuildSearchRow($fileLink,$details,$hits,$rating,$fileSize,$createDate,$fileId,$editIcon,$newIcon)
{
	global $module_name;
	return  "<tr>"
		   ."<td>".$editIcon." ".$fileLink." (".$fileSize.") ".$newIcon."</td>"
		   ."<td class='fr_details'>".$details."</td>"
		   ."<td>".$hits."</td>"
		   ."<td>".$rating."</td>"
		   ."<td><a href='modules.php?name=".$module_name."&op=details&file_id=".$fileId."' title='"._DETAILSTITLE."'>"._DETAILS."</a></td>"
		   ."</tr>";
}

function leading_zeros($value, $places){
// Function written by Marcus L. Griswold (vujsa)
// Can be found at http://www.handyphp.com
// Do not remove this header!

    if(is_numeric($value)){
        for($x = 1; $x <= $places; $x++){
            $ceiling = pow(10, $x);
            if($value < $ceiling){
                $zeros = $places - $x;
                for($y = 1; $y <= $zeros; $y++){
                    $leading .= "0";
                }
            $x = $places + 1;
            }
        }
        $output = $leading . $value;
    }
    else{
        $output = $value;
    }
    return $output;
}

function getImgLink($file_id, $app_icon)
{
	global $isAdmin, $admin_file, $module_name;
	//BUILD IMG LINK FOR EDITING - ADMINS ONLY
	if ($isAdmin==1)
		return '<a href="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=edit&file_id='.$file_id.'#admin_top"><img src="modules/'.$module_name.'/images/apps_images/'.$app_icon.'" border="0" title="'._EDIT.'"></a>&nbsp;&nbsp;';
	else
		return '<img src="modules/'.$module_name.'/images/apps_images/'.$app_icon.'" border="0" />&nbsp;&nbsp;';
}

function getFileLink($file_id, $file_dir, $filename)
{
	global $isAdmin, $easy_admin_access, $module_name;
	//CHECK IF USER IS AN ADMIN - PROVIDE LINK TO EDIT FILE     
	if ($isAdmin==1)
	{
		if($easy_admin_access==1)
		{
			//GET EXTENSION
		    $extension = substr(strrchr($file_dir.$filename, "."), 1);
		    //CHECK THE FILE TYPE
		    $media_type = media_type($extension);
		    //USE AUDIO POPUP WINDOW
		    switch($media_type)
			{
				default:
					$href="javascript:media_popup('modules.php?name=".$module_name."&file=media_pop&lid=".$file_id."&file_type=".$media_type."');";
			    break;
			   
			    case "other":
					$href = $file_dir.$filename;
			   break;
		    }
		} 
		else 
		{
			$href = 'modules.php?name='.$module_name.'&op=getit&file_id='.$file_id;
		}
	} 
	else 
	{
		$href = 'modules.php?name='.$module_name.'&op=getit&file_id='.$file_id;
	}
	return $href;
}

function getPager($total_files, $itemsPerPage, $min, $max, $custom_filter_sort, $app_id, $module_name, $itemsOnPage, $allowPerPageChange,$query,$sel)
{
	if($query != "")
		$queryString = "search&query=".$query;
	else
		$queryString = "view&mode=view&app_id=".$app_id;
	
	if($sel != "") $queryString = "search&sel=".$sel;
	
	//HOW MANY PAGES EXIST - WHAT PAGE ARE WE ON
	$file_pages_int = ($total_files / $itemsPerPage);
	$file_pages_mod = ($total_files % $itemsPerPage);
	if ($file_pages_mod != 0) {
	  $file_pages = ceil($file_pages_int);
	  if ($total_files < $itemsPerPage) {
		$file_pages_mod = 0;
		}
	  } else {
		  $file_pages = $file_pages_int;
	}

	//PAGE NUMBERING
	if ($file_pages > 1) {
	  $gridPager .= _SELECTPAGE.': ';
	  $prev = $min - $itemsPerPage;
	  if ($prev>=0)
	  {
		$gridPager .= '&nbsp;&nbsp;<b>[ <a href="modules.php?name='.$module_name.'&op='.$queryString.'&min='.$prev.'&newPerPage='.$itemsPerPage.$custom_filter_sort.'">';
		$gridPager .= " &lt;&lt; "._PREVIOUS."</a> ]</b> ";
	  }
	  $counter = 1;
	  $currentpage = ($max / $itemsPerPage);

	  while ($counter<=$file_pages) 
	  {
		$cpage = $counter;
		$mintemp = ($itemsPerPage * $counter) - $itemsPerPage;
		if ($counter == $currentpage) 
		{
		  $gridPager .= '<b><i><u>'.$counter.'</u></i></b> ';
		} else {
			$gridPager .= '<a href="modules.php?name='.$module_name.'&op='.$queryString.'&min='.$mintemp.'&newPerPage='.$itemsPerPage.$custom_filter_sort.'">'.$counter.'</a> ';
		}
		$counter++;
	  }
	  $next=$min+$itemsPerPage;

	  if ($itemsOnPage>=$itemsPerPage) {
		$gridPager .= '&nbsp;&nbsp;<b>[ <a href="modules.php?name='.$module_name.'&op='.$queryString.'&min='.$max.'&newPerPage='.$itemsPerPage.$custom_filter_sort.'">';
		$gridPager .= ' '._NEXT.' &gt;&gt;</a> ]</b> ';
	  }
	}
	//END PAGE NUMBERING
	$gridPager = '<br /><div style="float: left; padding: 0 0 0 25px; max-width:70%;">'.$gridPager.'</div>'; 
	
	//ALLOW USERS TO CHANGE PAGE SIZE
	if ($allowPerPageChange == 1)
	{	
		$gridPager .= '
		<script type="text/javascript">
		<!--
		function checkRange(numValue,numLow,numHigh)
		{
			if(isNaN(numValue))
			{
				alert("Please enter a valid number");
				return false;
			} 
			else
			{
				if(parseFloat(numValue)< numLow || parseFloat(numValue)>numHigh)
				{
					alert("Please enter a value between " + numLow + " and " + numHigh);
					return false;
				}
			}
			return true;
		}
		//-->
		</script>';
		
		$currentUrl = "http" . (($_SERVER['HTTPS']=="on") ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."?".$_SERVER['QUERY_STRING'];
		$gridPager .= '<form id="customPage" action="'.$currentUrl.'" method="POST">'
					 .'<div style="float: right; padding: 0 25px 0;">'
					 .'Items per page: '
					 .'<input type="hidden" name="query" value="'.$query.'">'
					 .'<input type="textbox" name="newPerPage" value="'.$itemsPerPage.'" style="width:75px;">&nbsp;'
					 .'<input type="submit" value="Go" onclick="return checkRange(newPerPage.value,0,'.$total_files.');">'
					 .'</div>'
					 .'</form>';
	}
	
	return $gridPager;
}

//RETURNS FILE EXTENSION
function getFileExtension($filename)
{
	return end(explode(".", $fileName));
}

function isAllowedImageExtension($fileName) {
  global $allowedImageExtensions;
  return in_array(getFileExtension($fileName), $allowedImageExtensions);
}
?>