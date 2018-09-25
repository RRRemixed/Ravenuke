<?php

/************************************************************************/
/* File Repository                                                      */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by MJ Hufford                                     */
/* Email:  mjhufford@gmail.com                                            */
/* http://www.GuitarVoice.com                                           */
/* Version 2.8 - Please make a donation at www.GuitarVoice.com          */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
global $db, $prefix, $cookie, $sitename, $admin, $admin_file;
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

include("modules/".$module_name."/functions.php");
include("header.php");

//SET TO 0 TO TURN OFF RIGHT BLOCKS
//SET TO 1 TO TURN ON RIGHT BLOCKS
$index = 1;

//JAVASCRIPT LANGUAGE FILES
if (file_exists("/modules/".$module_name."/language/lang-".$currentlang.".js")){
 $js_lang = $currentlang;
 } else { 
  $js_lang = "english";
}

//IF OP IS SET, SHOW THE FILE REPOSITORY HOME LINK IN MAIN MENU
if(!isset($op)==TRUE){
  $main_link = '';
  } else {
    $main_link = '<a href="modules.php?name='.$module_name.'" title="'.$custom_module_name.' '._MAIN.'">'.$custom_module_name.' '._MAIN.'</a> |';
}

//JAVASCRIPT POPUP WINDOW FOR MEDIA FILES
?>

<script type="text/javascript">
<!--
function media_popup(url)
{
	newwindow=window.open(url,'name','resizable=0, scrollbars=0, menubar=0, toolbar=0, location=0, directories=0, status=0, height=350, width=300, top=50, left=50');
	if (window.focus) {newwindow.focus()}
}
//-->
</script>

<?
//sortable tables - taken from http://yoast.com/articles/sortable-table/ - AWESOME
echo "<script src='/modules/".$module_name."/sortable.js'></script>";

//GET USERINFO
$user_id = $cookie[0];
$username = $cookie[1];
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_info = userinfo($user_id);

//CHECK IF FILE HAS BEEN REQESTED
if(isset($fetchid, $checkpass, $passcode)){getit($fetchid, $checkpass, $passcode, $file_dir, $username);}

//HAS THE PERPAGE VARIABLE CHANGED?
if(isset($newPerPage)) $perpage = round($newPerPage,0);

//MAIN MENU
$main_menu = '<center><h3>'.$custom_module_name.'</h3>
			  <form name="search_form" method="POST" action="modules.php?name='.$module_name.'&op=search">
			  <input type="text" name="query" size="25"> 
			  <input type="submit" value="'._SEARCHBUTTON.'"></form><br />
			  [ '.$main_link.'
			  <a href="modules.php?name='.$module_name.'&op=add" title="'._ADDFILETITLE.'">'._ADDFILE.'</a> | 
			  <a href="modules.php?name='.$module_name.'&op=search&sel=new" title="'._VIEWNEWTITLE.'">'._VIEWNEW.'</a> | 
			  <a href="modules.php?name='.$module_name.'&op=search&sel=popular" title="'._VIEWPOPTITLE.'">'._VIEWPOP.'</a> | 
			  <a href="modules.php?name='.$module_name.'&op=search&sel=top_rated" title="'._VIEWTOPTITLE.'">'._VIEWTOP.'</a> ]</center>';
OpenTable();
echo $main_menu;
CloseTable();
echo "<br />";
 
//BEGIN OP SWITCH STATEMENT
switch($op){
  default:
    $main_sql = "SELECT * FROM ".$prefix."_fr_categories ORDER BY name";
    $main_results = $db->sql_query($main_sql);
    $main_numrows = $db->sql_numrows($main_results);
    $num_categories = $main_numrows;
    $num_files = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE approved=1"));
    $main_table = '<table width="100%" cellpadding="4" cellspacing="4">'
                 .'<col width="50%" valign="top">'
                 .'<col width="50%" valign="top">';
    for($x=0;$x<$main_numrows;$x++){
      $main_row = $db->sql_fetchrow($main_results);
      $id = $main_row['id'];
	  $name = $main_row['name'];
      $description = $main_row['description'];
      if($x % 2 == 0){
	      $main_table .= '<tr>
	      					<td>
	      						&#149;<a href="modules.php?name='.$module_name.'&op=view&catid='.$id.'" title="Click here to view '.$name.' files">
							    	<b>'.$name.'</b>
								</a><br />
	      						'.$description.'
							</td>';
		  } else {
		    $main_table .= '<td>
	      						&#149;<a href="modules.php?name='.$module_name.'&op=view&catid='.$id.'" title="Click here to view '.$name.' files">
							    	<b>'.$name.'</b>
								</a><br />
	      						'.$description.'
							</td>
							</tr>';
	  }					
	}
	if($main_numrows % 2 != 0){$main_table .= '<td>&nbsp;</td></tr>';}
    $main_table .= '</table>'; 
    OpenTable();
    echo '<span class="title"><center>'.$custom_module_name.' '._MAINCATEGORIES.'</center></span><br />';
    echo '<table width="100%">
			<tr>
				<td>'._MODWELCOME.'
				</td>
			</tr>
		  </table>';
    echo $main_table;
    echo '<br /><center>'._THEREARE.' <b>'.$num_files.'</b> '._FILESAND.' <b>'.$num_categories.'</b> '._CATINDB.'</center>';
    CloseTable();
    include("footer.php");
  break;
  
  case "add":
    switch($mode){
      default:
        OpenTable();
        echo '<span class="title"><center>'._EUUA.'</center></span><br /><br />';
        //LEGAL DISCLAIMER
        echo _EUUADETAILS;
        //END LEGAL DISCLAIMER
        echo '<form method="POST" action="modules.php?name='.$module_name.'&op=add">'
            .'<input type="hidden" name="mode" value="euua_agree">'
            .'<center><input type="submit" value="'._AGREE.'" class="title">&nbsp;&nbsp;'
			.'<input type="button" value="'._DISAGREE.'" class="title" onclick="window.location=\'index.php\'"></form></center><br /><br />';
        CloseTable();
        include("footer.php");
      break;
      
      case "euua_agree":
        $category_list = category_list();
        OpenTable();
        echo '<span class="title"><center>'._SELECTCATEGORY.'</center></span><br /><br />';
        echo '<form method="POST" action="modules.php?name='.$module_name.'&op=add&mode=cat_selected">'
			.'<table align="center">
				<tr>
					<td><b>'._SELECTCATEGORY.': </b></td>
					<td>
						<select name="category_id">
							<option value="">*'._SELECTCATEGORY.'*</option>
							'.$category_list.'
						</select>
					</td>
				</tr>
			</table><br />
			<center><input type="submit" value="'._NEXTWIZARD.'"></form><br />';
        CloseTable();
        include("footer.php");
      break;
      
      case "cat_selected":
        $apps_list = apps_list(NULL, $category_id);
        OpenTable();
        echo '<span class="title"><center>'._SELECTAPPLICATION.'</center></span><br /><br />';
        echo '<form method="POST" action="modules.php?name='.$module_name.'&op=add&mode=app_selected">'
			.'<table align="center">
				<tr>
					<td><b>'._SELECTAPPLICATION.': </b></td>
					<td>
						<select name="application_id">
							<option value="">*'._SELECTAPPLICATION.'*</option>
							'.$apps_list.'
						</select>
					</td>
				</tr>
			</table><br />
			<center>
			<input type="submit" value="'._NEXTWIZARD.'"></form><br />';
        CloseTable();
        include("footer.php");
      break;
      
      case "app_selected":
        ?>
		<?php echo "<script src='/modules/".$module_name."/language/".$js_lang."'></script>"; ?>
		<script type="text/javascript">
		<!--
		    //var module_name = "<?php print($module_name); ?>";
		    //var lang = "<?php print($js_lang); ?>";

			function validate_form(custom1_name, custom2_name, custom3_name){
			  if(document.form1.title.value == ""){
			    alert("Please make sure all fields are complete!");
			    document.form1.title.focus();
			    return false;}
			
			  if(document.form1['custom1'] != undefined){
			    if(document.form1['custom1'].value == ""){
			      alert ("Please make sure all fields are complete!");
			      document.form1['custom1'].focus();
			      return false;}
			  }
			  
			  if(document.form1['custom2'] != undefined){
			    if(document.form1['custom2'].value == ""){
			      alert ("Please make sure all fields are complete!");
			      document.form1['custom2'].focus();
			      return false;}
			  }
			  
			  if(document.form1['custom3'] != undefined){
			    if(document.form1['custom3'].value == ""){
			      alert ("Please make sure all fields are complete!");
			      document.form1['custom3'].focus();
			      return false;}
			  }
			  
			  if(document.form1.comments.value == ""){
			    alert("Please make sure all fields are complete!");
			    document.form1.comments.focus();
			    return false;}
			  
			  if(document.form1.filename.value == ""){
			    alert("You forgot to attach the file!");
			    document.form1.filename.focus();
			    return false;}
		   }	
		// -->
		</script>
		<?
        $apps_sql = "SELECT * FROM ".$prefix."_fr_apps WHERE id=".$application_id;
        $apps_row = $db->sql_fetchrow($db->sql_query($apps_sql));
        $category_id = $apps_row['parent_id'];
        $app_name = $apps_row['app_name'];
        $app_url = $apps_row['app_url'];
        $app_icon = $apps_row['app_icon'];
        $category_info = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fr_categories WHERE id=".$category_id));
        $category_name = $category_info['name'];
        $approved_ext_array = approved_ext_array($application_id);
        $array_count = count($approved_ext_array);
		for($x=0;$x<$array_count;$x++){
		  if($x == $array_count-1){
		    $approved_ext .= $approved_ext_array[$x].".";
		   	} else {
		    	$approved_ext .= $approved_ext_array[$x].", ";
		  }
		}		   	  
		   	  
        //CUSTOM FIELD 1
        $lbl_custom1 = $apps_row['lbl_custom1'];
        $show_custom1 = $apps_row['show_custom1'];
        if($show_custom1 == 1)$custom1_row = '<tr><td><b>'.$lbl_custom1.':</b></td><td><input type="text" name="custom1" size="30"></td></tr>';
        
		//CUSTOM FIELD 2
        $lbl_custom2 = $apps_row['lbl_custom2'];
        $show_custom2 = $apps_row['show_custom2'];
        if($show_custom2 == 1)$custom2_row = '<tr><td><b>'.$lbl_custom2.':</b></td><td><input type="text" name="custom2" size="30"></td></tr>';
        
		//CUSTOM FIELD 3
        $lbl_custom3 = $apps_row['lbl_custom3'];
        $show_custom3 = $apps_row['show_custom3'];
        if($show_custom3 == 1)$custom3_row = '<tr><td><b>'.$lbl_custom3.':</b></td><td><input type="text" name="custom3" size="30"></td></tr>';

        OpenTable();
        echo '<center><span class="title">'._ADDFILE.'</span></center><br />'
            ._INSTRUCTIONS;
        echo '<form name="form1" enctype="multipart/form-data" method="POST" action="modules.php?name='.$module_name.'&op=insert" onsubmit="return validate_form(\''.$lbl_custom1.'\',\''.$lbl_custom2.'\',\''.$lbl_custom3.'\');">'
            .'<table align="center">
              	<tr>
              		<td><b>'._CATEGORY.':</b></td>
              		<td>'.$category_name.'</td>
              	</tr>
				<tr>
              		<td><b>'._APPLICATION.':</b></td>
              		<td>'.$app_name.'</td>
              	</tr>
              	<tr>
              		<td><b>'._USERNAME.':</b></td>
              		<td>'.$user_info['username'].'</td>
              	</tr>
              	<tr>
              		<td><b>'._IPADDRESS.':</b></td>
              		<td>'.$user_ip.'</td>
              	</tr>
              	<tr>
              		<td><b>'._TITLE.':</b></td>
              		<td><input type="text" name="title" size="30"></td>
              	<tr>
              	'.$custom1_row.'
              	'.$custom2_row.'
              	'.$custom3_row.'
              	<tr>
              		<td valign="top"><b>'._TCOMMENTS.':</b></td>
              		<td><textarea name="comments" cols="40" rows="6"></textarea></td>
              	</tr>
              	<tr>
				  	<td>
					  	<b>'._FILE.':</b>
					</td>
					<td>
						<input type="file" name="filename">
						<br />'._APPROVEDEXT.': <b>'.$approved_ext.'</b>
					</td>
				</tr>
              </table><br />';
        echo '<center><input type="hidden" name="parent_id" value="'.$application_id.'">
		      <input type="submit" value="'._SUBMIT.'" class="title"></center></form><br /><br />';
        CloseTable();
        include("footer.php");
      break;
    }
  break;
  
  case "insert":
    $filename_name = $_FILES['filename']['name'];
   	$filename_type = $_FILES['filename']['type'];
   	$filename_size = $_FILES['filename']['size'];
   	$filename_temp = $_FILES['filename']['tmp_name'];
   	$validate_ext = validate_file_ext($parent_id, $filename_name);
   	$file_ext = getFileExtension($filename_name);
   	if(!$validate_ext){
   	  $approved_ext = approved_ext_array($parent_id);
   	  if($approved_ext == '<center><b>'._NOFILEEXT.'</b></center>'){
   	    $error_msg = $approved_ext;
   	    } else {
   	      $array_count = count($approved_ext);
   	      for($x=0;$x<$array_count;$x++){
   	        if($x == $array_count-1){
   	          $ext_error .= $approved_ext[$x].".";
   	          } else {
   	            $ext_error .= $approved_ext[$x].", ";
   	        }
   	      }
   	      $error_msg = '<center><b>'._THEFILEEXT.' "'.$file_ext.'" '._ISNOTAPPROVED.'<br /><br />'.$ext_error.'<br /><br />'._EXTGOBACK.'<br /><br />';
   	  } 
   	  OpenTable();
   	  echo '<center><span class="title">'._EXTERROR.'</span></center><br /><br />';
   	  echo $error_msg;
   	  CloseTable();
   	  include("footer.php");
   	  die();
   	  } else {
   	    //FILE IS VALIDATED, UPLOAD AND INSERT SQL
   	    $upload_date = date('Y-m-d H:i:s');
   	    $approved = 0;
   	    $filename = time().".".$file_ext;
        $target_path = $file_dir.$filename;
        //RETURN ERROR IF THE FILE CANNOT BE RENAMED AND MOVED PROPERLY
        if(move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)){
          //FILE UPLOADED OKAY, INSERT DATA INTO SQL
          $title = addslashes($_POST['title']);
          $custom1 = addslashes($_POST['custom1']);
          $custom2 = addslashes($_POST['custom2']);
          $custom3 = addslashes($_POST['custom3']);
          $comments = str_replace(Chr(13), "<br />", $_POST['comments']);
          $comments = str_replace("\n", "<br />", $_POST['comments']);
          $comments = addslashes($comments);		  
          $file_insert = "INSERT INTO ".$prefix."_fr_files (parent_id, user_id, user_ip, upload_date, title, custom1, custom2, custom3, comments, filename, file_size, approved) VALUES ('".$parent_id."', '".$user_id."', '".$user_ip."', '".$upload_date."', '".$title."', '".$custom1."', '".$custom2."', '".$custom3."', '".$comments."', '".$filename."', '".$filename_size."', '".$approved."')";
          if($db->sql_query($file_insert)){
            $insert_id = mysql_insert_id();
            //DOUBLE CHECK MYSQL_INSERT_ID FUNCTION
            if($insert_id == 0){
              $get_last_id = $db->sql_fetchrow($db->sql_query("SELECT id FROM ".$prefix."_fr_files ORDER BY id DESC"));
              $insert_id = $get_last_id['id'];
            }
            email_admin($insert_id);
			
	        OpenTable();
	        echo '<center><span class="title">'._SUCCESS.'</span><br /><br />';
	        echo '<b>'._UPLOADED.'<br /><br />';
	        echo _REDIRECTED.'<br /></b></center>';
	        CloseTable();
			JavaScriptAlertBack(_UPLOADED, "5");
	        include("footer.php");
	        } else {
	          //DELETE FILE AND PRINT OUT SQL ERROR
	  		  unlink($target_path);
		      OpenTable();
		      echo '<span class="title"><center>'._SQLERROR.'</center></span><br/><br/>';
		      echo '<center><b>'._UPLOADPROBLEM.'</b></center><br/>';
		      CloseTable();
		      include("footer.php");
		      die();
		  }
		  } else {
		    //WE'VE GOT UPLOAD ISSUES
		    OpenTable();
	        echo '<center><span class="title">'._UPLOADEROR.'</span></center><br /><br />'
	            .'<center><b>'._UPLOADPROBLEM.' '._TRYAGAIN.'</b></center><br/>';
		    CloseTable();
		    include("footer.php");
		    die();
		}
	}
  break;
  
  //VIEW APPLICATIONS UNDER A GIVEN CATEGORY
  case "view":
    switch($mode){
      default:
        if (!isset($catid)) JavaScriptAlertBack("Oops! Category is missing!","1");
		
        //CATEGORY INFO
        $cat_row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fr_categories WHERE id=".$catid));
        $cat_name = $cat_row['name'];
        $cat_image = $cat_row['image'];
        if($cat_image == "") $cat_image = 'default.gif';
        
        //APPLICATION INFO
        $view_sql = "SELECT * FROM ".$prefix."_fr_apps WHERE parent_id=".$catid." ORDER BY app_name";
        $view_results = $db->sql_query($view_sql);
        $view_numrows = $db->sql_numrows($view_results);
        $main_table = '<table width="100%" cellpadding="4" cellspacing="4">'
                 	 .'<col width="50%" valign="top">'
                 	 .'<col width="50%" valign="top">';
	    for($x=0;$x<$view_numrows;$x++){
	      $main_row = $db->sql_fetchrow($view_results);
	      $id = $main_row['id'];
		  $name = $main_row['app_name'];
		  $app_description = $main_row['app_description'];
	      $app_url = $main_row['app_url'];
	      $app_icon = $main_row['app_icon'];
	      if($app_icon == "") $app_icon = 'default.gif';
	      $app_num_files = $db->sql_numrows($db->sql_query("SELECT id FROM ".$prefix."_fr_files WHERE parent_id=".$id." AND approved=1;"));
	      if($app_url != ""){
	        $app_info = '<a href="'.$app_url.'" title="'._APPHOMEPAGETITLE.'">'._APPHOMEPAGE.'</a>';
	        } else {
	          $app_info = '';
	      }
	      if($x % 2 == 0){
		      $main_table .= '<tr>
		      					<td valign="bottom">
		      						&#149;<a href="modules.php?name='.$module_name.'&op=view&mode=view&app_id='.$id.'" title="'._CLICKTOVIEW.' '.$name.' '._FILES.'">
								    	<img src="modules/'.$module_name.'/images/apps_images/'.$app_icon.'" border="0"/>&nbsp;<b>'.$name.'</b>
									</a> ('.$app_num_files.')<br />
									'.$app_description.'<br />
		      						'.$app_info.'<br /><br />
								</td valign="bottom">';
			  } else {
			    $main_table .= '<td>
		      						&#149;<a href="modules.php?name='.$module_name.'&op=view&mode=view&app_id='.$id.'" title="'._CLICKTOVIEW.' '.$name.' '._FILES.'">
								    	<img src="modules/'.$module_name.'/images/apps_images/'.$app_icon.'" border="0"/>&nbsp;<b>'.$name.'</b>
									</a> ('.$app_num_files.')<br />
									'.$app_description.'<br />
		      						'.$app_info.'<br /><br />
								</td>
								</tr>';
		  }					
		}
		if($main_numrows % 2 != 0){$main_table .= '<td>&nbsp;</td></tr>';}
	    $main_table .= '</table>'; 
		OpenTable();
		echo '<span class="title"><center>'.$cat_name.' '._APPLICATIONS.'</span><br /><img src="modules/'.$module_name.'/images/category_images/'.$cat_image.'" /></center><br />';
    	echo $main_table;
    	CloseTable();
    	include("footer.php");
      break;
      
      case "view":
        if (!isset($app_id)) JavaScriptAlertBack("Application is mising!", "1");
        if (!isset($min)) $min=0;
        if (!isset($max)) $max=$min+$perpage;
	    
	    //APPLICATION INFO
        $app_row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fr_apps WHERE active=1 AND id=".$app_id));
        $catid = $app_row['parent_id'];
        $app_name = $app_row['app_name'];
        $app_description = $app_row['app_description'];
        $app_icon = $app_row['app_icon'];
        if($app_icon == "") $app_icon = 'default.gif';
        $lbl_custom1 = $app_row['lbl_custom1'];
        $show_custom1 = $app_row['show_custom1'];
        $lbl_custom2 = $app_row['lbl_custom2'];
        $show_custom2 = $app_row['show_custom2'];
        $lbl_custom3 = $app_row['lbl_custom3'];
        $show_custom3 = $app_row['show_custom3'];
        
        //PROVIDE A RESET SWITCH & ESTABLISH CUSTOM FILTER SORTING
	    if(isset($custom_filter)) $filter_reset = '<center><a href="modules.php?name='.$module_name.'&op=view&mode=view&app_id='.$app_id.'" title="'._RESETFILTERSTITLE.'">'._RESETFILTERS.'</a></center><br />';
		switch($custom_filter){
		  default:
		    $custom_filter_where = "";
		  break;
		  
		  case "1":
		    $custom_filter_where = " AND custom1 LIKE '%".addslashes(str_replace("%20", " ", $filter))."%' ";
		  break;
		  
		  case "2":
		    $custom_filter_where = " AND custom2 LIKE '%".addslashes(str_replace("%20", " ", $filter))."%' ";
		  break;
		  
		  case "3":
		    $custom_filter_where = " AND custom3 LIKE '%".addslashes(str_replace("%20", " ", $filter))."%' ";
		  break;
		}
		
		//ADD CUSTOM FILTER DROPDOWNLISTS
        if($show_custom1 == 1){
		  $custom1_list = "<td>".custom1_filter($app_id, $lbl_custom1)."</td>";
		  } else {
		    $custom1_list='';
		}
        if($show_custom2 == 1){
		  $custom2_list = "<td>".custom2_filter($app_id, $lbl_custom2)."</td>";
		  } else {
		    $custom2_list = '';
		}
        if($show_custom3 == 1){
		  $custom3_list= "<td>".custom3_filter($app_id, $lbl_custom3)."</td>";
		  } else {
		    $custom3_list = '';
		}
		//END CUSTOM FILTER CREATION
		
		//CUSTOM FILTER STRING
		if($show_custom1==1 || $show_custom2==1 || $show_custom3==1){
		  $custom_filter_string = '<table align="center" cellpadding="2" cellspacing="2">
		  							  <tr>
		  							  	 <td colspan="3" align="center"><b>'._CUSTOMFILTERS.'</b></td>
		  							  </tr>
		  							  <tr>
		  							  	 '.$custom1_list.$custom2_list.$custom3_list.'
		  							  </tr>
		  						   </table>';
	    }
	    
        //CATEGORY INFO
        $cat_row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fr_categories WHERE id=".$catid));
        $cat_name = $cat_row['name'];
        
        //FILE INFO
        $total_files = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE approved=1 AND parent_id=".$app_id.$custom_filter_where));
        $file_sql = "SELECT a.id AS file_id, a.filename, c.username AS submitter, a.upload_date AS upload_date, a.title AS title,a.custom1 AS custom1, a.custom2 AS custom2, a.custom3 AS custom3, a.comments AS comments, a.file_size AS file_size, a.hits AS hits, AVG(d.rating) AS rating,  COUNT(d.id) AS num_votes FROM ".$prefix."_fr_files a INNER JOIN ".$prefix."_fr_apps b ON a.parent_id=b.id INNER JOIN ".$prefix."_users c ON a.user_id=c.user_id LEFT OUTER JOIN ".$prefix."_fr_ratings d ON a.id=d.file_id WHERE a.approved = 1 AND a.parent_id=".$app_id.$custom_filter_where." GROUP BY a.id, a.filename, c.username, a.upload_date, a.title, a.custom1, a.custom2, a.custom3, a.comments, a.file_size, a.hits ORDER BY a.upload_date DESC LIMIT ".$min.",".$perpage;

        $file_results = $db->sql_query($file_sql);
        $file_numrows = $db->sql_numrows($file_results);
        if($file_numrows == 0){
          $file_table = '<br /><center><b>'._NOFILESAPP.'</b></center><br />';
          } else {
            $file_table = $custom_filter_string;
			
            //CUSTOM FILTERS
            for($x=0;$x<$file_numrows;$x++){
              $file_row = $db->sql_fetchrow($file_results);
              $file_id = $file_row['file_id'];
              $filename = $file_row['filename'];
              $submitter = $file_row['submitter'];
              $upload_date = mk_pretty_date($file_row['upload_date']);
              $title = $file_row['title'];
              $custom1 = $file_row['custom1'];
              $custom2 = $file_row['custom2'];
              $custom3 = $file_row['custom3'];
              $comments = $file_row['comments'];
              $file_size = resize_bytes($file_row['file_size']);
              $hits = leading_zeros($file_row['hits'], 6);
              $new_file_img = new_files($file_id, $file_row['upload_date']);
              $num_votes = $file_row['num_votes'];
          	  $avg_rating = round($file_row['rating'], 2);
              if($avg_rating == 0 || $avg_rating == ""){
			    $rating_info = ''._NOTRATED.'<br />';
            	} else {
              		$rating_info = $avg_rating.' ('._FROM.' '.$num_votes.' '._VOTES.')';
          	  }
              if($show_custom1 == 1){$custom1_details = '<th>'.$lbl_custom1.'</th>';}
			  if($show_custom2 == 1){$custom2_details = '<th>'.$lbl_custom2.'</th>';}
			  if($show_custom3 == 1){$custom3_details = '<th>'.$lbl_custom3.'</th>';}
			  
			  echo fileTableStyle();
			  if($x==0){$file_table .= "<table class='sortable' id='sortable' width='100%'><th>"._FILE."</th>".$custom1_details.$custom2_details.$custom3_details."<th>"._DOWNLOADS."</th><th>"._RATING."</th><th>"._DETAILS."</th>";
}
			  //BUILD IMG LINK FOR EDITING - ADMINS ONLY
			  $img_link = getImgLink($file_id, $app_icon);
			
			  //BUILD THE FILE LINK
              $href = getFileLink($file_id, $file_dir, $filename);
			  $fileLink = '<a href="'.$href.'" title="'._DOWNLOAD.'">'.$title.'</a>';
			  $file_table .= BuildFileRepositoryRow($fileLink,$show_custom1,$custom1,$show_custom2,$custom2,$show_custom3,$custom3,$hits,$rating_info,$file_size,$upload_date,$file_id,$img_link,$new_file_img);
			  if ($x == ($file_numrows - 1)) $file_table .= '</table>';
            }
        }
		
        OpenTable();
        echo '<span class="title"><center>'.$app_name.' '._FILES.'</center></span>';
        echo '<center><b>'._CATEGORY.': </b><a href="modules.php?name='.$module_name.'&op=view&catid='.$catid.'" title="'._VIEWALL.' '.$cat_name.' '._APPLICATIONS.'">'.$cat_name.'</a>  |  <b>'._APPLICATION.': </b>'.$app_name.'</center><br /><hr>';
        echo $file_table;
        echo $filter_reset;
	    echo getPager($total_files, $perpage, $min, $max, $custom_filter_sort, $app_id,$module_name,$x, $allowPerPageChange,"","");
		
        CloseTable();
        include("footer.php");
      break;
    }
  break;
  
  case "getit":
    $grant_access = determine_access($user_id);
    $makepass = makeSecPass();
    $code = $makepass;
    $result = $db->sql_query("SELECT id, title, filename FROM ".$prefix."_fr_files WHERE approved=1 AND id=".$file_id);
    list($id, $title, $filename) = $db->sql_fetchrow($result);
        $fetchid = base64_encode($file_dir.$filename);
        $transfertitle = str_replace (" ", "_", $title);

    //CHANGED THIS TO LOAD JUST THE TEXT - NO IMAGE
    if (!extension_loaded("gd")){
      $codepass = '<script type="text/javascript">
				   <!--
				   function openwindow1(){
				     window.open ("modules/'.$module_name.'/sec_code.php?thepass='.$makepass.'","Password","toolbar=no,location=no,directories=no,status=no,scrollbars=no,resizable=no,copyhistory=no,width=300,height=200");
				   }
				   //-->
				   </script>
                   <img src="modules.php?name='.$module_name.'&op=gfx&random_num='.$makepass.'" border="1" alt="Security Code : '.$makepass.'" width="77" height="20" />[ <a href="javascript:openwindow1()">Help</a> ]';
      } else {
	  $codepass = '<font color="'.$passcodeColor.'"><b>'.$makepass.'</b></font>';
	  }

        OpenTable();
        echo '<center><span class="title">'._DOWNLOADING.' '.$title.'</span></center><br />';
        echo _BANDWIDTHWARN;
        CloseTable();
        
        OpenTable();
        echo '<p><b>'._DIRECTIONS.':</b> File: &quot;<b>'.$title.'</b>&quot;.  '._DOWNLOADDIRECTIONS.'</p>
				<form action="modules.php?name='.$module_name.'" method="POST">
				    <input type="hidden" name="lid" value="'.$file_id,'">
				    <input type="hidden" name="checkpass" value="'.$makepass.'">
				    <input type="hidden" name="fetchid" value="'.$fetchid.'">
				    <input type="hidden" name="title" value="'.$title.'">
				    <input type="hidden" name="user_id" value="'.$user_id.'">
				    <table cellpadding="1" cellspacing="1" align="center" border="0">
				        <tr>
				            <td><b>'._PASSWORD.':</b></td>
				            <td valign="middle">'.$codepass.'</td>
				        </tr>
				        <tr>
				            <td><b>'._RETYPEPASSWORD.':</b></td>
				            <td><input type="text" size="20" name="passcode"></td>
				        </tr>
				    </table>
				    <p align="center"><font color="'.$popupWarningColor.'">'._POPUP_ENABLE.'</font></p>
					<p align="center">
				      <input type="button" value="'._CANCEL.'" onclick="history.go(-1)" class="title">
				      <input type="submit" name="'._FETCHIT.'" value="'._FETCHIT.'" class="title">
				    </p>
				</form>';
        CloseTable();
        include("footer.php");
  break;
  
  case "gfx":
    gfx($random_num);
  break;
  
  case "search":
    if (!isset($min)) $min=0;
    if (!isset($max)) $max=$min+$perpage;
	if ($show!="") {$perpage = $show;} else {$show=$perpage;}
    //PREPARE QUERY FOR SQL
	$query = htmlentities($query, ENT_QUOTES);
    $query = addslashes($query);
	
	switch($sel)
	{
		default:
	    //GET ALL RESULTS
		$total_files = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE approved=1 AND (title LIKE '%".$query."%' OR custom1 LIKE '%".$query."%' OR custom2 LIKE '%".$query."%' OR custom3 LIKE '%".$query."%' OR comments LIKE '%".$query."%')"));
	    //GET PERPAGE RESULTS
	    $file_sql = "SELECT a.parent_id AS app_id, a.id AS file_id, a.filename, c.username AS submitter, a.upload_date AS upload_date, a.title AS title,a.custom1 AS custom1, a.custom2 AS custom2, a.custom3 AS custom3, a.comments AS comments, a.file_size AS file_size, a.hits AS hits, AVG(d.rating) AS rating,  COUNT(d.id) AS num_votes FROM ".$prefix."_fr_files a INNER JOIN ".$prefix."_fr_apps b ON a.parent_id=b.id INNER JOIN ".$prefix."_users c ON a.user_id=c.user_id LEFT OUTER JOIN ".$prefix."_fr_ratings d ON a.id=d.file_id WHERE 
						(a.title LIKE '%".$query."%' OR
						 a.custom1 LIKE '%".$query."%' OR
						 a.custom2 LIKE '%".$query."%' OR
						 a.custom3 LIKE '%".$query."%' OR
						 a.comments LIKE '%".$query."%')
						 AND a.approved = 1 GROUP BY a.id, a.filename, c.username, a.upload_date, a.title, a.custom1, a.custom2, a.custom3, a.comments, a.file_size, a.hits ORDER BY a.title ASC LIMIT ".$min.",".$perpage; 
					 
		break;
		
		case "new":
		 //CUTOFF DATE FOR NEW FILES IS 30 DAYS
		$cutoff_date = date('Y-m-d H:i:s', time()-(86400 * 30));
	
		//GET ALL RESULTS
		$total_files = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE approved=1 AND upload_date > '".$cutoff_date."'"));
	
	    //GET PERPAGE RESULTS
	    $file_sql = "SELECT a.parent_id AS app_id, a.id AS file_id, a.filename, c.username AS submitter, a.upload_date AS upload_date, a.title AS title,a.custom1 AS custom1, a.custom2 AS custom2, a.custom3 AS custom3, a.comments AS comments, a.file_size AS file_size, a.hits AS hits, AVG(d.rating) AS rating,  COUNT(d.id) AS num_votes FROM ".$prefix."_fr_files a INNER JOIN ".$prefix."_fr_apps b ON a.parent_id=b.id INNER JOIN ".$prefix."_users c ON a.user_id=c.user_id LEFT OUTER JOIN ".$prefix."_fr_ratings d ON a.id=d.file_id WHERE a.upload_date > '".$cutoff_date."' AND a.approved = 1 GROUP BY a.id, a.filename, c.username, a.upload_date, a.title, a.custom1, a.custom2, a.custom3, a.comments, a.file_size, a.hits ORDER BY a.upload_date DESC LIMIT ".$min.",".$perpage; 
		break;
		
		case "popular":
			//GET ALL RESULTS
			$total_files = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE approved = 1 AND hits >= ".$popular));
			
		    //GET PERPAGE RESULTS
		    $file_sql = "SELECT a.parent_id AS app_id, a.id AS file_id, a.filename, c.username AS submitter, a.upload_date AS upload_date, a.title AS title,a.custom1 AS custom1, a.custom2 AS custom2, a.custom3 AS custom3, a.comments AS comments, a.file_size AS file_size, a.hits AS hits, AVG(d.rating) AS rating,  COUNT(d.id) AS num_votes FROM ".$prefix."_fr_files a INNER JOIN ".$prefix."_fr_apps b ON a.parent_id=b.id INNER JOIN ".$prefix."_users c ON a.user_id=c.user_id LEFT OUTER JOIN ".$prefix."_fr_ratings d ON a.id=d.file_id WHERE a.hits >= ".$popular." AND a.approved = 1 GROUP BY a.id, a.filename, c.username, a.upload_date, a.title, a.custom1, a.custom2, a.custom3, a.comments, a.file_size, a.hits ORDER BY a.hits DESC LIMIT ".$min.",".$perpage; 
		break;
		
		case "top_rated":
			//GET ALL RESULTS
			$total_files = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE approved=1 AND (SELECT COUNT(file_id) AS votes FROM nuke_fr_ratings WHERE ".$prefix."_fr_files.id = ".$prefix."_fr_ratings.file_id) > ".$file_votes_min." AND (SELECT AVG(rating) AS rating_avg FROM ".$prefix."_fr_ratings WHERE ".$prefix."_fr_files.id = ".$prefix."_fr_ratings.file_id) > ".$min_avg_score));
			
			//GET PERPAGE RESULTS
			$file_sql = "SELECT a.parent_id AS app_id, a.id AS file_id, a.filename, c.username AS submitter, a.upload_date AS upload_date, a.title AS title,a.custom1 AS custom1, a.custom2 AS custom2, a.custom3 AS custom3, a.comments AS comments, a.file_size AS file_size, a.hits AS hits, AVG(d.rating) AS rating,  COUNT(d.id) AS num_votes FROM ".$prefix."_fr_files a INNER JOIN ".$prefix."_fr_apps b ON a.parent_id=b.id INNER JOIN ".$prefix."_users c ON a.user_id=c.user_id LEFT OUTER JOIN ".$prefix."_fr_ratings d ON a.id=d.file_id WHERE a.approved = 1 GROUP BY a.id, a.filename, c.username, a.upload_date, a.title, a.custom1, a.custom2, a.custom3, a.comments, a.file_size, a.hits HAVING COUNT(d.id) > ".$file_votes_min." AND AVG(d.rating) > ".$min_avg_score." ORDER BY rating DESC, num_votes DESC LIMIT ".$min.",".$perpage;
		break;
	}
	
	$file_results = $db->sql_query($file_sql);
	$file_numrows = $db->sql_numrows($file_results);
		
	//CHECK NUMROWS AND BUILD RESULTS VIEW
	if($total_files == 0){
	  $search_results = '<br /><center>'._NOMATCHES.' <b>'.$query.'</b>.</center><br />';
	  } else {
	    for($x=0;$x<$file_numrows;$x++){
	      $file_row = $db->sql_fetchrow($file_results);
	      $app_id = $file_row['app_id'];
	      $file_id = $file_row['file_id'];
		  $filename = $file_row['filename'];
          $submitter = $file_row['submitter'];
          $upload_date = mk_pretty_date($file_row['upload_date']);
          $title = $file_row['title'];
		  $custom1 = $file_row['custom1'];
          $custom2 = $file_row['custom2'];
          $custom3 = $file_row['custom3'];
          $comments = $file_row['comments'];
          $file_size = resize_bytes($file_row['file_size']);
          $hits = leading_zeros($file_row['hits'], 6);
          $new_file_img = new_files($file_id, $file_row['upload_date']);
          $num_votes = $file_row['num_votes'];;
          $avg_rating = round($file_row['rating'],2);
		  
          if($avg_rating == 0){
            $rating_info = _NOTRATED;
            } else {
              $rating_info = $avg_rating. " (from ".$num_votes." votes)";
          }
		  
	      //APPLICATION INFO
          $app_row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fr_apps WHERE id=".$app_id));
          $catid = $app_row['parent_id'];
          $cat_row = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_fr_categories WHERE id=".$catid));
          $cat_name = $cat_row['name'];
          $app_name = $app_row['app_name'];
          $app_icon = $app_row['app_icon'];

		  if ($x==0)
		  {
		    echo fileTableStyle();
			$search_results = "<table class='sortable' id='sortable' width='100%'><th>"._FILE."</th><th>"._TCOMMENTS."</th><th>"._DOWNLOADS."</th><th>"._RATING."</th><th>"._DETAILS."</th>";
		  }
		  
          //CHECK IF USER IS AN ADMIN - PROVIDE LINK TO EDIT FILE     
		  $img_link = getImgLink($file_id, $app_icon);
		  $href = getFileLink($file_id, $file_dir, $filename);
		  $fileLink = '<a href="'.$href.'" title="'._DOWNLOAD.'">'.$title.'</a>';
		  $search_results .= BuildSearchRow($fileLink,$comments,$hits,$rating_info,$file_size,$upload_date,$file_id,$img_link,$new_file_img);
		  if ($x == ($file_numrows - 1)) $search_results .= '</table>';
	    }
	  }
	  OpenTable();
	  echo '<span class="title"><center>'._SEARCHRESULTS.'</center></span>';
      echo '<center><b>'.$total_files.'</b> '._NUMRESULTS.'</center><br /><hr>';
	  echo $search_results;
      echo getPager($total_files, $perpage, $min, $max, $custom_filter_sort, $app_id,$module_name,$x, $allowPerPageChange,$query,$sel);

	  CloseTable();
	  include("footer.php");
  break;

  case "broken":
    if(!isset($file_id)){
      JavaScriptAlertBack("There was a problem with the file.  Please try again", "2");
    } else {
      if(!$db->sql_query("INSERT INTO ".$prefix."_fr_broken (file_id, submitter, date) VALUES ('".$file_id."', '".$username."', '".date('Y-m-d')."')")){
        OpenTable();
        echo '<span class="title"><center>'._SQLERROR.'</span><br /><br /><hr>'._REPORTNOTSENT;
        CloseTable();
        include("footer.php");
        } else {
          OpenTable();
          echo '<span class="title"><center>'._SUCCESS.'</span><br /><br /><hr>'
              ._FILEREPORTED.'<br /><br />'
              ._REDIRECTED.'<br /></b></center>';
	        CloseTable();
	        JavaScriptAlertBack(_FILEREPORTED, "2");
	        include("footer.php");
      }
    }
  break;
  
  case "details":
    if(!isset($file_id)){
        JavaScriptAlertBack("There was a problem with the file.  Please try again", "2");
        } else {
          $file_row = $db->sql_fetchrow($db->sql_query("SELECT a.parent_id AS app_id, a.id AS file_id, a.filename, c.username AS submitter, a.upload_date, a.title,a.custom1, a.custom2, a.custom3, a.comments, a.file_size, a.hits, AVG(d.rating) AS rating,  COUNT(d.id) AS num_votes FROM ".$prefix."_fr_files a INNER JOIN ".$prefix."_fr_apps b ON a.parent_id=b.id INNER JOIN ".$prefix."_users c ON a.user_id=c.user_id LEFT OUTER JOIN ".$prefix."_fr_ratings d ON a.id=d.file_id WHERE a.id = ".$file_id." AND a.approved = 1 GROUP BY a.id, a.filename, c.username, a.upload_date, a.title, a.custom1, a.custom2, a.custom3, a.comments, a.file_size, a.hits"));
		  
		  $app_id = $file_row['app_id'];
          $submitter = $file_row['submitter'];
          $upload_date = mk_pretty_date($file_row['upload_date']);
          $title = $file_row['title'];
		  $filename = $file_row['filename'];		  
		  $custom1 = $file_row['custom1'];
          $custom2 = $file_row['custom2'];
          $custom3 = $file_row['custom3'];
          $comments = $file_row['comments'];
          $file_size = resize_bytes($file_row['file_size']);
          $hits = $file_row['hits'];
          $new_file_img = new_files($file_id, $file_row['upload_date']);
          $num_votes = $file_row['num_votes'];
          $avg_rating = $file_row['rating'];
          if($avg_rating == 0){
            $rating_info = _NOTRATED.'<br />';
            } else {
              $rating_info = '<b>'._AVGRATING.':</b> '.$avg_rating.' ('._FROM.' '.$num_votes.' '._VOTES.')<br />';
              $rating_sql = "SELECT b.username, a.date, a.rating, a.comments FROM ".$prefix."_fr_ratings a, ".$prefix."_users b WHERE a.user_id=b.user_id AND rating > 0 AND file_id='".$file_id."'";
              $rating_results = $db->sql_query($rating_sql);
              $rating_numrows = $db->sql_numrows($rating_results);
              $rating_table = '<table cellpadding="2" cellspacing="2">'
              				 .'<caption style="text-align:left;">'._RATINGCOMMENTS.'</caption>';
              for($x=0;$x<$rating_numrows;$x++){
                $rating_row = $db->sql_fetchrow($rating_results);
                $username = $rating_row['username'];
                $date_rated = mk_pretty_date($rating_row['date']);
                $rating = $rating_row['rating'];
                $comments = $rating_row['comments'];
                $rating_table .= '<tr>
                					<td valign="top">
										<b>'._MEMBER.':</b> '.$username.'<br />
										<b>'._RATING.':</b> '.$rating.'<br />
										<b>'._DATE.':</b> '.$date_rated.'<br /><br />
									</td>
									<td valign="top">
										'.$comments.'
									</td>
								  </tr>';
			  }
			  $rating_table .= '</table>';
          }
            
	      //APPLICATION INFO
          $app_row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fr_apps WHERE id=".$app_id));
          $catid = $app_row['parent_id'];
          $cat_row = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_fr_categories WHERE id=".$catid));
          $cat_name = $cat_row['name'];
          $app_name = $app_row['app_name'];
          $app_icon = $app_row['app_icon'];
          $lbl_custom1 = $app_row['lbl_custom1'];
          $show_custom1 = $app_row['show_custom1'];
          $lbl_custom2 = $app_row['lbl_custom2'];
          $show_custom2 = $app_row['show_custom2'];
          $lbl_custom3 = $app_row['lbl_custom3'];
          $show_custom3 = $app_row['show_custom3'];
              
          if($show_custom1 == 1){$custom1_details = '<b>'.$lbl_custom1.':</b> '.$custom1.'<br />';} else {$custom1_details="";}
          if($show_custom2 == 1){$custom2_details = '<b>'.$lbl_custom2.':</b> '.$custom2.'<br />';} else {$custom2_details="";}
          if($show_custom3 == 1){$custom3_details = '<b>'.$lbl_custom3.':</b> '.$custom3.'<br />';} else {$custom3_details="";}
          //CHECK IF USER IS AN ADMIN - PROVIDE LINK TO EDIT FILE     
		  $img_link = getImgLink($file_id, $app_icon);
		  $href = getFileLink($file_id, $file_dir, $filename);

          OpenTable();
          echo '<span class="title"><center>'._FILEPROFILE.': '.$title.'</center></span><br /><hr><br />';
          echo '<table cellpadding="2" cellspacing="2">
          		  <caption style="text-align:left;">'._FILEDETAILS.'</caption>
		  		  <tr>
		  			<td>'.$img_link.'<a href="'.$href.'" title="Download this file.">'.$title.'</a>'.$new_file_img.'<br />
					  <b>'._DESCRIPTION.':</b>&nbsp;'.$comments.'<br />
					  <b>'._SUBMITTER.':</b>&nbsp;'.$submitter.'<br />
					  '.$custom1_details.'
					  '.$custom2_details.'
					  '.$custom3_details.'
					  <b>'._FILESIZE.':</b>&nbsp;'.$file_size.'<br />
					  <b>'._CATEGORY.':</b>&nbsp;'.$cat_name.' - '.$app_name.'<br />
					  <b>'._RATING.':</b> '.$rating_info.'
					  <b>'._ADDEDON.':</b>&nbsp;'.$upload_date.'&nbsp;&nbsp;<b>'._DOWNLOADS.':</b>&nbsp;'.$hits.'<br />
					  <a href="modules.php?name='.$module_name.'&op=ratings&file_id='.$file_id.'&title='.$title.'" title="'._RATETITLE.'">'._RATE.'</a> | 
					  <a href="modules.php?name='.$module_name.'&op=broken&file_id='.$file_id.'" title="'._BROKENTITLE.'">'._BROKEN.'</a>
					  <br /><br /><br />
				  </tr>
			    </table><br />';
		  echo $rating_table;
          CloseTable();
          include("footer.php");
    }    
  break;
  
  case "ratings":
    if(!isset($file_id)){
      JavaScriptAlertBack("There was a problem with the file.  Please try again", "2");
      } else {
        if($vote=='Yes'){
          //USER HAS ALREADY RATED THIS FILE
          $vote_numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_ratings WHERE file_id=".$file_id." AND user_id=".$user_id));
          if($vote_numrows>0){
            OpenTable();
            echo '<span clas="title"><center>'._VOTEERROR.'</center></span><br /><hr><br />'
            	.'<center><b>'._ONEVOTE.'</b></center><br /><br />';
            CloseTable();
            include("footer.php");
            die();
          }
          
          //USER IS THE SUBMITTER
		  $voter_is_submitter = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE approved=1 AND user_id=".$user_id." AND id=".$file_id));
		  if($voter_is_submitter>0){
            OpenTable();
            echo '<span clas="title"><center>'._VOTEERROR.'</center></span><br /><hr><br />'
            	.'<center><b>'._VOTEOWN.'</b></center><br /><br />';
            CloseTable();
            include("footer.php");
            die();
          }
          
          //INSERT RECORD
          $comments = str_replace(Chr(13), "<br />", $_POST['comments']);
          $comments = str_replace("\n", "<br />", $_POST['comments']);
          $comments = addslashes($comments);
          if(!$db->sql_query("INSERT INTO ".$prefix."_fr_ratings (file_id, user_id, user_ip, date, rating, comments) VALUES ('".$file_id."', '".$user_id."', '".$user_ip."', '".date('Y-m-d H:i:s')."', '".$rating."', '".$comments."')")){
            OpenTable();
            echo '<span clas="title"><center>'._SQLERROR.'</center></span><br /><hr><br />'
            	.'<center><b>'._VOTEPROBLEM.'</b></center><br /><br />';
            mysql_error();
            CloseTable();
            include("footer.php");
            die();
            } else {
              OpenTable();
          	  echo '<span class="title"><center>'._SUCCESS.'</span><br /><br /><hr>'
                  ._THANKYOUVOTE.'<br />'
              	  ._REDIRECTED.'<br /></b></center>';
	          CloseTable();
	          include("footer.php");
			  JavaScriptAlertBack(_THANKYOUVOTE, "2");
          }
          } else {
            for($x=1;$x<11;$x++){
		  	$rate_list .= '<option value="'.$x.'">'.$x.'</option>';
			}
			?>
			<script type="text/javascript">
			<!--
			    var module_name = "<?php print($module_name); ?>";
		        var lang = "<?php print($js_lang); ?>";
		        document.write("<script src='/modules/" + module_name + "/language/lang-english.js'></script>")
				function validate_form(){
				  if(document.form1.rating.value == ""){
				    alert(SELECTRATING);
				    document.form1.rating.focus();
				    return false;}
			   }	
			// -->
			</script>
			<?
	        OpenTable();
	        echo '<span class="title"><center>'._RATING.' '.$title.'</center></span><br /><br />'._VOTEINSTRUCTIONS;
			echo '<form name="form1" method="POST" action="modules.php?name='.$module_name.'&op=ratings" onsubmit="return validate_form();">';
			echo _YOUARE.' <b>'.$userinfo['username'].'</b><br />'
				._IPADDRESS.': <b>'.$user_ip.'</b><br /><br />';
			echo '<table cellpadding="2" cellspacing="2">
					<tr>
						<td><b>'._SELECTRATING.':</b></td>
						<td><select name="rating">
								<option value="">--</option>
								'.$rate_list.'
							</select>
						</td>
					</tr>
					<tr>
						<td valign="top"><b>'._TCOMMENTS.':</b></td>
						<td><textarea name="comments" cols="40" rows="6"></textarea></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="hidden" name="file_id" value="'.$file_id.'">
			      			<input type="hidden" name="vote" value="Yes"><br />
			      			<input type="submit" value="'._RATEBUTTON.'" class="title">
			      		</td>
			      	</tr>
				  </table><br /></form>';
	        CloseTable();
	        include("footer.php");
	    }
      }
  break;     	
}


//SECURE DOWNLOAD
function getit($fetchid, $checkpass, $passcode, $file_dir, $username){
    global $db, $prefix, $module_name, $lid, $cookie;	
	//CHECK IF THE PASSCODE IS RIGHT
	if ($checkpass == $passcode || ($isAdmin && $easy_admin_access == 1)){
	  
	  //JavaScript GoBack
	  if (!$isAdmin)
	  {
		$goBack = "history.go(-2);";
	  } else {
		$goBack = "";
	  }
	  
	  //DECODE THE URL
	  $url = base64_decode($fetchid);
	  
	  //CHECK IF THE FILE EXISTS, UPDATE SQL AND FETCH THE FILE
	  if (file_exists($url)){
		
	  //UPDATE HITS COUNTER IN SQL
	  $db->sql_query("UPDATE ".$prefix."_fr_files SET hits=hits+1 WHERE id='".$lid."'");
	    
	  //INSERT DOWNLOAD RECORD INTO DOWNLOADS TABLE
	  $db->sql_query("INSERT INTO ".$prefix."_fr_downloads (user_id, file_id, download_date) VALUES ('".$cookie[0]."', '".$lid."', '".date('Y-m-d H:i:s')."')");
	     
	  //GET EXTENSION
	  $extension = getFileExtension($url);
		
	  //CHECK THE FILE TYPE
	  $media_type = media_type($extension);
	  
	  //USE AUDIO POPUP WINDOW
	  switch($media_type){
	   default:
	     echo "<script type=\"text/javascript\">"
			 .$goBack
		     ."media_popup('modules.php?name=".$module_name."&file=media_pop&lid=".$lid."&file_type=".$media_type."');"
			 ."</script>";
	   break;
	   
	   case "other":
		 //SET HEADERS - NON MEDIA FILE TYPES
		 //REQUIRED FOR IE, OTHERWISE CONTENT-DISPOSITION IS IGNORED
	     if(ini_get('zlib.output_compression')) ini_set('zlib.output_compression', 'Off');
		 header('Pragma: public');
		 header('Expires: 0');
		 header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		 header('Cache-Control: private',false);
		 header('Content-Type: application/octet-stream');
		 header('Content-Disposition: attachment; filename="'.basename($url).'";');
		 header('Content-Transfer-Encoding: binary');
		 header('Content-Length: '.filesize($url));
		 header("Location: ".$url);
		 //readfile($url);
		 exit();
	   break;
	   
	   
	   }
	  } else {
	      //FILE NOT FOUND, NOTIFY USER AND REPORT BROKEN FILE
		  $date = date("M d, Y g:i:a");
		  
		  //FLAG BROKEN FILES IN SQL
	      $db->sql_query("INSERT INTO ".$prefix."_fr_broken VALUES (NULL, '".$lid."', '".$username."', '".date('Y-m-d')."')");
	      OpenTable();
		  echo '<center><span class=\"title\">'.$title.' '._FILENOTFOUND.'</span></center>';
		  CloseTable();
		  echo '<br />';
		  
		  OpenTable();
		  echo '<p>'._SORRY.' '.$username.', '.$title.' '._FILENOTFOUND.'</p>'._FLAGGED;
	      CloseTable();
	      echo '<br />';
	      include("footer.php");
	    }
	  } else {
	    //PASSWORD WAS WRONG, NOTIFY USER
		OpenTable();
		echo _PASSCODE_ERROR;
	    CloseTable();
	    echo '<br />';
	    include("footer.php");
	}
}
?>