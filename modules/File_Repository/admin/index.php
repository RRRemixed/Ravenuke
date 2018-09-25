<?php

/************************************************************************/
/* File Repository                                                      */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by MJ Hufford                                     */
/* Email:  mjhufford@gmail.com                                          */
/* http://www.GuitarVoice.com                                           */
/* Version 2.8 - Please make a donation at www.GuitarVoice.com          */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

global $prefix, $db, $admin_file, $cookie, $sitename, $currentlang;
if (!eregi("".$admin_file.".php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }
$aid = substr("$aid", 0,25);
$module_name = "File_Repository";
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='".$module_name."'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;	
    }
}
include("header.php");
include("modules/$module_name/functions.php");

//JAVASCRIPT LANGUAGE FILES
if (file_exists("modules/$module_name/admin/language/lang-$currentlang.js")){
 $js_lang = $currentlang;
 } else { 
  $js_lang = "english";
}

GraphicAdmin();

//GET USERINFO
$user_id = $cookie[0];
$username = $cookie[1];
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_info = userinfo($user_id);

//SCRIPT TO SHOW OR HIDE DIVS
?>
<script type="text/javascript">
<!--
	function show_hide(DivID, iState){ // 1 visible, 0 hidden
	    if(document.layers){ //NN4+
	      document.layers[DivID].visibility = iState ? "show" : "hide";
	      } else if (document.getElementById){ //gecko(NN6) + IE 5+
	        var obj = document.getElementById(DivID);
	        obj.style.visibility = iState ? "visible" : "hidden";
	        } else if(document.all){ // IE 4
	          document.all[DivID].style.visibility = iState ? "visible" : "hidden";
	    }
	}
// -->
</script>
<style type="text/css">
<!--
.hide
	{
	  width:150px;
	  height:20px;
	  z-index:99;
	  visibility:hidden;
	}
.show
	{
	  width:150px;
	  height:20px;
	  z-index:99;
	}
// -->
</style>
<?
//END SCRIPT

//CHECK IF IS ADMIN
if ($row2['radminsuper'] == 1 || $auth_user == 1) {
global $admin_file, $db, $prefix, $cookie;
$user_id = $cookie[0];

	//ADMIN MAIN MENU
	echo '<a name="admin_top" /><br />';
	OpenTable();
	echo '<center><span class="title">'._ADMINTITLE.'</span><br />
		  <a href="'.$admin_file.'.php?op='.$module_name.'&sel=restrictions#admin_top" title="'._ACCESSRESTRICTTITLE.'">'._ACCESSRESTRICT.'</a> |
		  <a href="'.$admin_file.'.php?op='.$module_name.'&sel=categories#admin_top" title="'._CATEGORIESTITLE.'">'._CATEGORIES.'</a> | 
		  <a href="'.$admin_file.'.php?op='.$module_name.'&sel=apps#admin_top" title="'._APPSTITLE.'">'._APPS.'</a> | 
		  <a href="'.$admin_file.'.php?op='.$module_name.'&sel=extensions#admin_top" title="'._EXTTITLE.'">'._EXT.'</a> | 
		  <a href="'.$admin_file.'.php?op='.$module_name.'&sel=files#admin_top" title="'._FILESTITLE.'">'._FILES.'</a> | 
		  <a href="'.$admin_file.'.php?op='.$module_name.'&sel=ratings#admin_top" title="'._RATINGSTITLE.'">'._RATINGS.'</a></center><br />';
	CloseTable();
	//END ADMIN MAIN MENU
	
	//GET SOME STATS
    $num_files = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files"));
    $num_faa = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE approved=0"));
    $num_apps = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_apps"));
    $num_cats = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_categories"));
    $num_broken = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_broken"));
    OpenTable();
    echo '<center>[<a href="'.$admin_file.'.php?op='.$module_name.'&sel=broken#admin_top" title="'._BROKENTITLE.'">'._BROKEN.' ('.$num_broken.')</a> | '
		.'<a href="'.$admin_file.'.php?op='.$module_name.'&sel=approve#admin_top" title="'._AWAITAPPROVETITLE.'">'._AWAITAPPROVE.' ('.$num_faa.')</a> | '
		.'<a href="'.$admin_file.'.php?op='.$module_name.'&sel=ghost#admin_top" title="'._GHOSTFILESTITLE.'">'._GHOSTFILES.'</a> ]</center>';
	CloseTable();
	//END BASIC STATS TABLE
	
	//START THE SWITCH STATEMENT
	switch($sel){
	  default:		
	  	OpenTable();
	  	echo '<center><img src="modules/'.$module_name.'/admin/images/file_repository.gif" alt="File Repository"><br /><br />'
	  	    ._THEREARE.' '.$num_files.' '._FILESIN.' '.$num_apps.' '._APPSAND.' '.$num_cats.' '._CATSINDB.'<br />'
	      	._ADMINOPTION.'</center><br />';
	  	CloseTable();
	  	include("footer.php");
	  break;
	  
	  case "categories":
	  	switch($action){
	  	  default:
	  	  ?>
			<script type="text/javascript">
			<!--
			    var module_name = "<?php print($module_name); ?>";
		        var lang = "<?php print($js_lang); ?>";
		        document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
				function validate_form(){
				  if(document.form1.name.value == ""){
				    alert(CATNAME);
				    document.form1.name.focus();
				    return false;}
				  
				  if(document.form1.description.value == ""){
				    alert(ENTERDESCRIPTION);
				    document.form1.description.focus();
				    return false;}
			   }	
			// -->
			</script>
		  <?
		  //ADD NEW CATEGORY
	  	  OpenTable();
	  	  echo '<center><span class="title">'._ADDCATEGORY.'</span></center><br />';
	  	  echo '<form name="form1" enctype="multipart/form-data" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=categories&action=insert#admin_top" onsubmit="return validate_form();">';
	  	  echo '<table cellpadding="2" cellspacing="3" align="center">
	  	  			<tr>
	  	  				<td><b>'._CATNAME.': </b></td>
	  	  				<td><input type="text" name="name" size="35"></td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td valign="top"><b>'._DESCRIPTION.': </td>
	  	  				<td><textarea name="description" cols="35" rows="6"></textarea></td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td><b>'._CATIMAGE.': </b></td>
	  	  				<td><input type="file" name="image"></td>
	  	  			</tr>
	  	  		</table><br />';
	  	  echo '<center><input type="submit" value="'._SUBMIT.'" class="title"></center></form>';
	  	  CloseTable();
	  	  
	  	  //MODIFY A CATEGORY
	  	  ?>
			<script type="text/javascript">
			<!--
			    var module_name = "<?php print($module_name); ?>";
		        var lang = "<?php print($js_lang); ?>";
		        document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
				function validate_form2(){
				  if(document.form2.category_id.value == ""){
				    alert(CATSELECT);
				    document.form2.category_id.focus();
				    return false;}
			   }	
			// -->
			</script>
		  <?
	  	  $category_select = category_list();  
		  if($category_select == ''){
	  	  	  $category_select = '<center><b>'._NOAPPS.'</b></center>';
	  	  		} else {
		  	  	  $category_select = '<form name="form2" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=categories&action=edit#admin_top" onsubmit="return validate_form2();">'
	  	                          .'<table align="center" cellpadding="2" cellspacing="2">
	  	      		                	<tr>
						  	      			<td><b>'._CATSELECT.': </b></td>
						  	      			<td><select name="category_id">
						  	      				    <option value="">*'._CATSELECT.'*</option>
													'.$category_select.'
												</select>
											</td>
						  	      		</tr>
						  	      	</table><br />
									<center><input type="submit" value="'._MODIFY.'" class="title"></center></form><br />';
			}	  
	  	  OpenTable();
	  	  echo '<center><span class="title">'._MODCATEGORY.'</span></center><br />';
	  	  echo  $category_select; 	  
	  	  CloseTable();
	  	  include("footer.php");
	  	  break;
	  	  
	  	  //INSERT NEW CATEGORY
	  	  case "insert":
		  //ONLY ALLOW CERTAIN FILE TYPES TO BE ATTACHED
		
		  //CHECK THE IMAGE
		  if ($_FILES["image"]["size"] > 0){
		    $image_name = $_FILES['image']['name'];
	   	    $image_type = $_FILES['image']['type'];
	   	    $image_size = $_FILES['image']['size'];
	   	    $temp_file_name = $_FILES['image']['tmp_name'];
		    if (!isAllowedImageType($image_name)){
		      OpenTable();
		      echo '<center><b>'._ATTACHERROR.'</b></center><br/><hr><br/>';
		      echo '<center>('.$image_name.') '._UNAPPROVEDEXT.'</b></center><br/>';
		      CloseTable();
		      include('footer.php');
		      die();
		      } else {
		        $filename = time().".".getFileExtension($image_name);
		        $target_path = "modules/$module_name/images/category_images/$filename";
		        //RETURN ERROR IF THE FILE CANNOT BE RENAMED AND MOVED PROPERLY
		        if(!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
		          OpenTable();
		          echo '<center><span class="title">'._UPLOADERROR.'</span></center><br /><br />'
		              .'<center><b>'._UPLOADMESSAGE.'</b></center><br/>';
				  CloseTable();
				  include("footer.php");
				  die();
				}
		      }
		    } else {
		      $filename = '';
		  }
		  $name = addslashes($_POST['name']);
		  //REPLACE \n WITH HARD BREAKS
		  $description = str_replace("\n", "<br />", $description);
		  $description = addslashes($description);
		  
		  //IF SQL INSERTS FINE AND FILE IS MOVED AND RENAMED, ALL IS WELL!
		  $sql_insert = "INSERT INTO ".$prefix."_fr_categories (name, description, image) VALUES ('".$name."', '".$description."', '".$filename."')";
		  if($db->sql_query($sql_insert)){
		    OpenTable();
		    echo '<span class="title"><center>'._SUCCESS.'</center></span><br /><br />'
		        .'<center><b>'._CATINSERTED.'<br />'
		        ._REDIRECTED.'</b></center><br />';
		    CloseTable();
		    Header("Refresh: 3; url=".$admin_file.".php?op=".$module_name."#admin_top");
		    include("footer.php");
		    } else {
		      //DELETE FILE AND PRINT OUT SQL ERROR
		      unlink($target_path);
		      OpenTable();
		      echo '<span class="title"><center>'._SQLERROR.'</center></span><br/><br/>';
		      echo '<center><b>'._SQLERRORMSG.'<br/><br/></b></center>';
		      CloseTable();
		      include("footer.php");
		      die();
		    }
	  	  break;
	  	  
	  	  case "edit":
	  	  ?>
			<script type="text/javascript">
			<!--
			    var module_name = "<?php print($module_name); ?>";
		        var lang = "<?php print($js_lang); ?>";
		        document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
				function validate_form(){
				  if(document.form1.name.value == ""){
				    alert(CATNAME);
				    document.form1.name.focus();
				    return false;}
				  
				  if(document.form1.description.value == ""){
				    alert(ENTERDESCRIPTION);
				    document.form1.description.focus();
				    return false;}
			   }	
			// -->
			</script>
		  <?
	  	  $category_sql = "SELECT * FROM ".$prefix."_fr_categories WHERE id = ".$category_id;
	  	  $category_row = $db->sql_fetchrow($db->sql_query($category_sql));
	  	  $name = $category_row['name'];
	  	  $description = str_replace("<br />", "\n", $category_row['description']);
	  	  $image = $category_row['image'];
	  	  if($image != ''){
	  	    $image_row = '<tr>
			  			  	<td valign="top"><b>'._CATIMAGE.': </b></td>
							<td valign="top"><img src="/modules/'.$module_name.'/images/category_images/'.$image.'" alt="'._CURRENTIMAGE.'"><br /><br />
							                 <input type="file" name="image"><br /><br />
											 <b>'._UPLOADERASE.'</b></td>
						  </tr>';
			} else {
			  $image_row = '<tr>
	  	  						<td><b>'._CATIMAGE.': </b></td>
	  	  						<td><input type="file" name="image"></td>
	  	  					</tr>';
	  	  }
	  	  
	  	  OpenTable();
	  	  echo '<center><span class="title">'._MODCATEGORY.'</span></center><br />';
	  	  echo '<form name="form1" enctype="multipart/form-data" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=categories&action=update#admin_top" onsubmit="return validate_form();">';
	  	  echo '<table cellpadding="2" cellspacing="3" align="center">
	  	  			<tr>
	  	  				<td><b>'._CATNAME.': </b></td>
	  	  				<td><input type="text" name="name" size="35" value="'.$name.'"></td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td valign="top"><b>'._DESCRIPTION.': </td>
	  	  				<td><textarea name="description" cols="35" rows="6">'.$description.'</textarea></td>
	  	  			</tr>
	  	  			'.$image_row.'
	  	  		</table><br />';
	  	  echo '<table align="center" cellpadding="4" cellspacing="4">
					<tr>
						<td align="right">
							<input type="hidden" name="old_image" value="'.$image.'">
	  	      				<input type="hidden" name="category_id" value="'.$category_id.'">
	  	      				<input type="submit" value="'._MODIFY.'" class="title"></form>
	  	      			</td>
	  	      			<td align="left">
							<form name="form2" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=categories&action=delete#admin_top">
					  		<input type="hidden" name="category_id" value="'.$category_id.'">
					  		<input type="submit" value="'._CATDELETE.'" class="title">
					  		</form>
					  	</td>
					</tr>
				</table>';				  					
	  	  CloseTable();
	  	  include("footer.php");	  	  
	  	  break;
	  	  
	  	  case "update":
		  //ONLY ALLOW CERTAIN FILE TYPES TO BE ATTACHED
	
		  //CHECK THE IMAGE
		  if ($_FILES["image"]["size"] > 0){
		    $image_name = $_FILES['image']['name'];
	   	    $image_type = $_FILES['image']['type'];
	   	    $image_size = $_FILES['image']['size'];
	   	    $temp_file_name = $_FILES['image']['tmp_name'];
		    if (!isAllowedImageType($image_name)){
		      OpenTable();
		      echo '<center><b>'._ATTACHERROR.'</b></center><br/><hr><br/>';
		      echo '<center>('.$image_name.') '._UNAPPROVEDEXT.'</b></center><br/>';
		      CloseTable();
		      include('footer.php');
		      die();
		      } else {
		        $filename = time().".".getFileExtension($image_name);
		        $target_path = "modules/$module_name/images/category_images/$filename";
		        //RETURN ERROR IF THE FILE CANNOT BE RENAMED AND MOVED PROPERLY
		        if(!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
		          OpenTable();
		          echo '<center><span class="title">'._UPLOADERROR.'</span></center><br /><br />'
		              .'<center><b>'._UPLOADMESSAGE.'</b></center><br/>';
				  CloseTable();
				  include("footer.php");
				  die();
				}
				if(file_exists("modules/$module_name/images/category_images/$old_image")){
				  unlink("modules/$module_name/images/category_images/$old_image");
				}
		      }
		    } else {
		      if($old_image != ''){
		        $filename = $old_image;
		        } else {
		          $filename = "";
		      }
		  }
		  $name = addslashes($_POST['name']);
		  //REPLACE \n WITH HARD BREAKS
		  $description = str_replace("\n", "<br />", $description);
		  $description = addslashes($description);
		  
		  //IF SQL INSERTS FINE AND FILE IS MOVED AND RENAMED, ALL IS WELL!
		  $sql_update = "UPDATE ".$prefix."_fr_categories SET name='$name', description='$description', image='$filename' WHERE id=$category_id";
		  if($db->sql_query($sql_update)){
		    OpenTable();
		    echo '<span class="title"><center>'._SUCCESS.'</center></span><br /><br />'
		        .'<center><b>'._CATUPDATED.'<br />'
		        ._REDIRECTED.'</b></center><br />';
		    CloseTable();
		    Header("Refresh: 2; url=".$admin_file.".php?op=".$module_name."#admin_top");
		    include("footer.php");
		    } else {
		      //DELETE FILE AND PRINT OUT SQL ERROR
		      unlink($target_path);
		      OpenTable();
		      echo '<span class=\"title\"><center>'._SQLERROR.'</center></span><br/><br/>';
		      echo '<center><b>'._SQLERRORMSG.'<br/><br/></center>';
		      CloseTable();
		      include("footer.php");
		      die();
		    }
	  	  break;
	  	  
	  	  case "delete":
		  	  switch($confirm){
		  	      default:
		  	        //GET NUMBER OF APPS
		  	        $category_row = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_fr_categories WHERE id=".$category_id));
		  	        $category_name = $category_row['name'];
		  	        $category_image = $category_row['image'];
		  	        $apps_sql = $db->sql_query("SELECT * FROM ".$prefix."_fr_apps WHERE parent_id=".$category_id);
		  	        $apps_numrows = $db->sql_numrows($apps_sql);
		  	        
		  	        //GET NUMBER OF FILES
		  	        $files_numrows=0;
		  	        for($x=0;$x<$apps_numrows;$x++){
		  	          $apps_row = $db->sql_fetchrow($apps_sql);
		  	          $application_id = $apps_row['id'];
		  	          $file_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE parent_id=".$application_id));
		  	          $files_numrows = $files_numrows+$file_rows;
		  	        }  	          
						
		  	        OpenTable();
		  	        echo '<center><span class="title">'._CONFIRMDELETE.'</span></center><br /><br />';
		  	        echo '<center><b>'._CONFIRMCATDELETE.' '.$category_name.'?</b></center><br /><br />';
		            echo '<form name="form1" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=categories&action=delete&confirm=Yes#admin_top">
						   <center>'._THEREARE.' <b>'.$apps_numrows.'</b> '._APPSAND.' <b>'.$files_numrows.'</b> '._APPFILES.'<br />
						   <b>'._ALLAPPSDELETE.'</b></center><br />
							<table align="center" cellpadding="5" cellspacing="4">
								<tr>
									<td><input type="hidden" name="category_id" value="'.$category_id.'">
										<input type="hidden" name="cat_image" value="'.$category_image.'">
							            <input type="submit" value="'._CONFIRMDELETE.'" class="title">
							        </td>
							        <td>
										<input type="button" value="'._CANCEL.'" class="title" onclick="javascript:history.go(-1);">
									</td>
								</tr>
							</table><br /></form>';
		  	        CloseTable();
		  	        include("footer.php");
		  	      break;
		  	      
		  	      case "Yes":
		  	        //DELETE CATEGORY RECORD AND IMAGE
		  	        if(file_exists('modules/'.$module_name.'/images/category_images/'.$category_image)) unlink('modules/'.$module_name.'/images/category_images/'.$category_image);
		  	        if($db->sql_query("DELETE FROM ".$prefix."_fr_categories WHERE id=".$category_id)){
		  	          //GET NUMBER OF APPS
		  	          $apps_sql = $db->sql_query("SELECT * FROM ".$prefix."_fr_apps WHERE parent_id=".$category_id);
		  	          $apps_numrows = $db->sql_numrows($apps_sql);
		  	          //DELETE FILES AND FILE RECORDS
		  	          for($x=0;$x<$apps_numrows;$x++){
		  	            $apps_row = $db->sql_fetchrow($apps_sql);
		  	            $application_id = $apps_row['id'];
		  	            $app_icon = $apps_row['app_icon'];
		  	            $file_sql = $db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE parent_id=".$application_id);
		  	            $file_numrows = $db->sql_numrows($file_sql);
		  	            for($y=0;$y<$file_numrows;$y++){
		  	              $file_row = $db->sql_fetchrow($file_sql);
		  	              $file_id = $file_row['id'];
		  	              $filename = $file_row['filename'];
		  	              $file_loc = 'modules/'.$module_name.'/files/'.$filename;
		  	              if(file_exists($file_loc)) unlink($file_loc);
		  	              if(!$db->sql_query("DELETE FROM ".$prefix."_fr_files WHERE id=".$file_id)) die(mysql_error());
		  	            }
		  	            //DELETE APP IMAGE AND RECORD
		  	            if(file_exists('modules/'.$module_name.'/images/apps_images/'.$app_image)) unlink('modules/'.$module_name.'/images/apps_images/'.$app_image);
		  	            if(!$db->sql_query("DELETE FROM ".$prefix."_fr_apps WHERE id=".$application_id)) die(mysql_error());
		  	          }
		  	          OpenTable();
		  	          echo '<center><span class="title">'._SUCCESS.'</span><br /><br />'
		  	              .'<b>'._CATDELETEMSG.'</b>';
		  	          CloseTable();
		  	          Header("Refresh: 3; url=".$admin_file.".php?op=".$module_name."#admin_top");
			          include("footer.php");
			          } else die(mysql_error());
	  	           break;
	  	   }
	    }
	  break;
	  
	  case "apps":
	  	switch($action){
	  	  default:
	  	  	?>
				<script type="text/javascript">
				<!--
				    var module_name = "<?php print($module_name); ?>";
		            var lang = "<?php print($js_lang); ?>";
		            document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
					function validate_form(){
					  if(document.form1.category_id.value == ""){
					    alert(CATSELECT);
					    document.form1.category_id.focus();
					    return false;}
					
					  if(document.form1.app_name.value == ""){
					    alert(ENTERAPP);
					    document.form1.app_name.focus();
					    return false;}
					  
					  if(document.form1.app_description.value == ""){
					    alert(ENTERDESCRIPTION);
					    document.form1.app_description.focus();
					    return false;}
				   }	
				// -->
				</script>
		  	<?
	  	  	//ADD FILE TYPE
	  	  	$category_select = category_list();
	  	  	OpenTable();
	  	  	echo '<center><span class="title">'._ADDAPPS.'</span></center><br />';
	  	  	echo '<form name="form1" enctype="multipart/form-data" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=apps&action=insert#admin_top" onsubmit="return validate_form();">';
	  	  	echo '<table cellpadding="2" cellspacing="3" align="center">
	  	  			<tr>
	  	  				<td><b>'._CATEGORY.': </b></td>
	  	  				<td><select name="category_id">
	  	  						<option value="">*'._CATSELECT.'*</option>
								'.$category_select.'
							</select>
						</td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td><b>'._APPNAME.': </b></td>
	  	  				<td><input type="text" name="app_name" size="25"></td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td valign="top"><b>'._DESCRIPTION.': </b></td>
	  	  				<td><textarea name="app_description" rows="6" cols="40"></textarea></td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td><b>'._APPURL.': </b></td>
	  	  				<td><input type="text" name="app_url" size="25"></td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td valign="top"><b>'._SHOWCUSTOMFIELD.' 1?:</b></td>
	  	  				<td valign="top">
							<table cellpadding="1" cellspacing="2">
								<tr>
									<td>Yes</td>
									<td colspan="2" align="left">No</td>
								</tr>
								<tr>
									<td><input type="radio" name="show_custom1" value="1" onclick="show_hide(\'show1\', 1);"></td>
									<td><input type="radio" name="show_custom1" value="0" onclick="show_hide(\'show1\', 0);" checked></td>
									<td>
										<div id="show1" class="hide" nowrap="true"><b>Field 1 Label: </b><input type="text" name="lbl_custom1"></div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
	  	  				<td valign="top"><b>'._SHOWCUSTOMFIELD.' 2?:</b></td>
	  	  				<td valign="top">
							<table cellpadding="1" cellspacing="2">
								<tr>
									<td>Yes</td>
									<td colspan="2" align="left">No</td>
								</tr>
								<tr>
									<td><input type="radio" name="show_custom2" value="1" onclick="show_hide(\'show2\', 1);"></td>
									<td><input type="radio" name="show_custom2" value="0" onclick="show_hide(\'show2\', 0);" checked></td>
									<td>
										<div id="show2" class="hide" nowrap="true"><b>Field 2 Label: </b><input type="text" name="lbl_custom2"></div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
	  	  				<td valign="top"><b>'._SHOWCUSTOMFIELD.' 3?:</b></td>
	  	  				<td valign="top">
							<table cellpadding="1" cellspacing="2">
								<tr>
									<td>Yes</td>
									<td colspan="2" align="left">No</td>
								</tr>
								<tr>
									<td><input type="radio" name="show_custom3" value="1" onclick="show_hide(\'show3\', 1);"></td>
									<td><input type="radio" name="show_custom3" value="0" onclick="show_hide(\'show3\', 0);" checked></td>
									<td>
										<div id="show3" class="hide" nowrap="true"><b>Field 3 Label: </b><input type="text" name="lbl_custom3"></div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
	  	  			<tr>
	  	  				<td valign="top"><b>'._APPICON.': </b></td>
	  	  				<td><input type="file" name="app_icon"></td>
	  	  			</tr>
	  	  		  </table><br />';
	  	  	echo '<center><input type="submit" value="'._ADD.'" class="title"></center></form>';
	  	  	CloseTable();
	  	  
	  	  	//MODIFY FILE TYPE
	  	  	?>
			  <script type="text/javascript">
			  <!--
			      
				  function validate_form2(){
				    if(document.form2.app_id.value == ""){
				      alert("Please select an application.");
				      document.form2.app_id.focus();
				      return false;}
			     }	
			  // -->
			  </script>
		    <?
	  	  	$apps_list = apps_list2();
	  	  	if($apps_list == ""){
	  	  	  $apps_table = '<center><b>There are no applications in the database.</b></center>';
	  	  		} else {
		  	  	  $apps_table = '<form name="form2" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=apps&action=edit#admin_top" onsubmit="return validate_form2();">
					  			 <table align="center" cellpadding="2" cellspacing="2">
		  	  	  				 	<tr>
		  	  	  						<td><b>Select a File Type: </b></td>
		  	  	  						<td><select name="app_id">
												<option value="">*Select Application*</option>
												'.$apps_list.'
											</select>
										</td>
		  	  	  					</tr>
		  	  	  				</table><br />
								<center><input type="submit" value="Modify" class="title"></center></form><br />';
			}
			OpenTable();
	  	  	echo '<center><span class="title">'._MODAPPS.'</span></center><br />';
	  	  	echo $apps_table;
	  	  	CloseTable();
	  	  	include("footer.php");
	  	  break;
	  	  
	  	  case "insert":
	  	  	  //ONLY ALLOW CERTAIN FILE TYPES TO BE ATTACHED
			  $jpg = 'image/pjpeg';
			  $gif = 'image/gif';
			  $ico = 'image/x-icon';
			
			  //CHECK THE IMAGE
			  $app_icon_name = $_FILES['app_icon']['name'];
		   	  $app_icon_type = $_FILES['app_icon']['type'];
		   	  $app_icon_size = $_FILES['app_icon']['size'];
		   	  if($app_icon_size>0){
			   	  $temp_file_name = $_FILES['app_icon']['tmp_name'];
				  if ($app_icon_name != '' && ($app_icon_type != $jpg && $app_icon_type != $gif && $app_icon_type != $ico)){
				    OpenTable();
				    echo '<center><b>'._ATTACHERROR.'</b></center><br/><hr><br/>';
		            echo '<center>('.$image_name.') '._UNAPPROVEDEXT.'</b></center><br/>';
				    CloseTable();
				    include('footer.php');
				    die();
				    } else {
				      if($app_icon_type == $jpg){$file_ext = "jpg";}
				      if($app_icon_type == $gif){$file_ext = "gif";}
				      if($app_icon_type == $ico){$file_ext = "ico";}
				      $filename = time().".".$file_ext;
				      $target_path = "modules/$module_name/images/apps_images/$filename";
				      //RETURN ERROR IF THE FILE CANNOT BE RENAMED AND MOVED PROPERLY
				      if(!move_uploaded_file($_FILES['app_icon']['tmp_name'], $target_path)){
				        OpenTable();
				        echo '<center><span class="title">'._UPLOADERROR.'</span></center><br /><br />'
		                    .'<center><b>'._UPLOADMESSAGE.'</b></center><br/>';
						CloseTable();
						include("footer.php");
						die();
					  }
				  }
				  $file_ext = addslashes($_POST['file_ext']);
				  $app_name = addslashes($_POST['app_name']);
				  $app_description = addslashes(str_replace(Chr(13), "<br />", $_POST['app_description']));
				  $app_url = addslashes($_POST['app_url']);
				  $lbl_custom1 = addslashes($_POST['lbl_custom1']);
				  $lbl_custom2 = addslashes($_POST['lbl_custom2']);
				  $lbl_custom3 = addslashes($_POST['lbl_custom3']);
			  } else $filename = '';
			  //IF SQL INSERTS FINE AND FILE IS MOVED AND RENAMED, ALL IS WELL!
			  $sql_insert = "INSERT INTO ".$prefix."_fr_apps (parent_id, app_name, app_description, app_url, app_icon, lbl_custom1, show_custom1, lbl_custom2, show_custom2, lbl_custom3, show_custom3) VALUES ('".$category_id."', '".$app_name."', '".$app_description."', '".$app_url."', '".$filename."', '".$lbl_custom1."', '".$show_custom1."', '".$lbl_custom2."', '".$show_custom2."', '".$lbl_custom3."', '".$show_custom3."')";
			  if($db->sql_query($sql_insert)){
			    OpenTable();
			    echo '<span class="title"><center>Success!</center></span><br /><br />'
			        .'<center><b>The category was successfully inserted into the database.<br />'
			        .'You are being redirected</b></center><br />';
			    CloseTable();
			    Header("Refresh: 3; url=".$admin_file.".php?op=".$module_name."#admin_top");
			    include("footer.php");
			    } else {
			      //DELETE FILE AND PRINT OUT SQL ERROR
			      unlink($target_path);
			      OpenTable();
			      echo "<span class=\"title\"><center>SQL ERROR!</center></span><br/><br/>";
			      echo "<center><b>There was a problem inserting the application into the database.<br/><br/>ERROR: ".mysql_error()."</b></center><br/>".$sql_insert;
			      CloseTable();
			      include("footer.php");
			      die();
			    }
	  	  break;
	  	  
	  	  case "edit":
	  	  	?>
			<script type="text/javascript">
			<!--
			    var module_name = "<?php print($module_name); ?>";
		        var lang = "<?php print($js_lang); ?>";
		        document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
				function validate_form(){
				  if(document.form1.app_name.value == ""){
				    alert(ENTERAPP);
				    document.form1.app_name.focus();
				    return false;}
				}
				
				function validate_form(){
				  if(document.form1.app_description.value == ""){
				    alert(ENTERDESCRIPTION);
				    document.form1.app_description.focus();
				    return false;}
				}	
			// -->
			</script>
		  <?
	  	  $apps_sql = "SELECT * FROM ".$prefix."_fr_apps WHERE id = ".$app_id;
	  	  $apps_row = $db->sql_fetchrow($db->sql_query($apps_sql));
	  	  $parent_id = $apps_row['parent_id'];
	  	  $category_list = category_list($parent_id);
	  	  $app_name = $apps_row['app_name'];
	  	  $app_description = str_replace("<br />", Chr(13), $apps_row['app_description']);
	  	  $app_url = $apps_row['app_url'];
	  	  $app_icon = $apps_row['app_icon'];
	  	  $lbl_custom1 = $apps_row['lbl_custom1'];
	  	  $show_custom1 = $apps_row['show_custom1'];
	  	  	if($show_custom1 == 1){
	  	  	  $yes1_checked = "checked";
	  	  	  $div1_class = "show";
	  	  	  $no1_checked = "";
	  	  	  } else {
	  	  	    $yes1_checked = "";
	  	  	    $div1_class = "hide";
	  	  	    $no1_checked = "checked";
	  	  	}
	  	  $lbl_custom2 = $apps_row['lbl_custom2'];
	  	  $show_custom2 = $apps_row['show_custom2'];
	  	    if($show_custom2 == 1){
	  	  	  $yes2_checked = "checked";
	  	  	  $div2_class = "show";
	  	  	  $no2_checked = "";
	  	  	  } else {
	  	  	    $yes2_checked = "";
	  	  	    $div2_class = "hide";
	  	  	    $no2_checked = "checked";
	  	  	}
	  	  $lbl_custom3 = $apps_row['lbl_custom3'];
	  	  $show_custom3 = $apps_row['show_custom3'];
	  	    if($show_custom3 == 1){
	  	  	  $yes3_checked = "checked";
	  	  	  $div3_class = "show";
	  	  	  $no3_checked = "";
	  	  	  } else {
	  	  	    $yes3_checked = "";
	  	  	    $div3_class = "hide";
	  	  	    $no3_checked = "checked";
	  	  	}
	  	  
	  	  if($app_icon != ''){
	  	    $app_icon_row = '<tr>
			  			  	 	<td valign="top"><b>'._APPICON.': </b></td>
							    <td valign="top">
									<img src="/modules/'.$module_name.'/images/apps_images/'.$app_icon.'" alt="'._CURRENTAPPICON.'"><br /><br />
							        <input type="file" name="app_icon"><br /><br />
									<b>'._UPLOADERASE.'</b>
								</td>
						     </tr>';
			} else {
			  $app_icon_row = '<tr>
	  	  					   	  <td><b>'._APPICON.': </b></td>
	  	  						  <td><input type="file" name="app_icon"></td>
	  	  					   </tr>';
	  	  }
	  	  
	  	  OpenTable();
	  	  echo '<center><span class="title">'._MODAPPS.'</span></center><br />';
	  	  echo '<form name="form1" enctype="multipart/form-data" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=apps&action=update#admin_top" onsubmit="return validate_form();">';
	  	  echo '<table cellpadding="2" cellspacing="3" align="center">
	  	  			<tr>
	  	  				<td><b>'._CATEGORY.': </b></td>
	  	  				<td>
							<select name="parent_id">
								'.$category_list.'
							</select>
						</td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td><b>'._APPNAME.': </b></td>
	  	  				<td><input type="text" name="app_name" size="35" value="'.$app_name.'"></td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td valign="top"><b>'._DESCRIPTION.': </b></td>
	  	  				<td><textarea name="app_description" rows="6" cols="40">'.$app_description.'</textarea></td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td><b>'._APPURL.': </b></td>
	  	  				<td><input type="text" name="app_url" size="35" value="'.$app_url.'"></td>
	  	  			</tr>
	  	  			<tr>
	  	  				<td valign="top"><b>'._SHOWCUSTOMFIELD.' 1?:</b></td>
	  	  				<td valign="top">
							<table cellpadding="1" cellspacing="2">
								<tr>
									<td>Yes</td>
									<td colspan="2" align="left">No</td>
								</tr>
								<tr>
									<td><input type="radio" name="show_custom1" value="1" '.$yes1_checked.'  onclick="show_hide(\'show1\', 1);"></td>
									<td><input type="radio" name="show_custom1" value="0" '.$no1_checked.'  onclick="show_hide(\'show1\', 0);"></td>
									<td><div id="show1" class="'.$div1_class.'" nowrap="true"><b>'._FIELD.' 1 '._LABEL.': </b><input type="text" name="lbl_custom1" value="'.$lbl_custom1.'"></div></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
	  	  				<td valign="top"><b>'._SHOWCUSTOMFIELD.' 2?:</b></td>
	  	  				<td valign="top">
							<table cellpadding="1" cellspacing="2">
								<tr>
									<td>Yes</td>
									<td colspan="2" align="left">No</td>
								</tr>
								<tr>
									<td><input type="radio" name="show_custom2" value="1" '.$yes2_checked.' onclick="show_hide(\'show2\', 1);"></td>
									<td><input type="radio" name="show_custom2" value="0" '.$no2_checked.'  onclick="show_hide(\'show2\', 0);"></td>
									<td><div id="show2" class="'.$div2_class.'" nowrap="true"><b>'._FIELD.' 2 '._LABEL.': </b><input type="text" name="lbl_custom2" value="'.$lbl_custom2.'"></div></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
	  	  				<td valign="top"><b>'._SHOWCUSTOMFIELD.' 3?:</b></td>
	  	  				<td valign="top">
							<table cellpadding="1" cellspacing="2">
								<tr>
									<td>Yes</td>
									<td colspan="2" align="left">No</td>
								</tr>
								<tr>
									<td><input type="radio" name="show_custom3" value="1" '.$yes3_checked.'  onclick="show_hide(\'show3\', 1);"></td>
									<td><input type="radio" name="show_custom3" value="0" '.$no3_checked.'  onclick="show_hide(\'show3\', 0);"></td>
									<td><div id="show3" class="'.$div3_class.'" nowrap="true"><b>'._FIELD.' 3 '._LABEL.': </b><input type="text" name="lbl_custom3" value="'.$lbl_custom3.'"></div></td>
								</tr>
							</table>
						</td>
					</tr>
	  	  			'.$app_icon_row.'
	  	  		</table><br />';
	  	  		
		  echo '<table align="center" cellpadding="4" cellspacing="4">
			      <tr>
					<td align="right">
						<input type="hidden" name="old_image" value="'.$app_icon.'">
						<input type="hidden" name="application_id" value="'.$app_id.'">
						<input type="submit" value="'._MODIFY.'" class="title">
					</td>
					<td align="left">
				  		<input type="button" value="'._DELETEAPP.'" class="title" onclick="window.location=\''.$admin_file.'.php?op='.$module_name.'&sel=apps&action=delete&application_id='.$app_id.'#admin_top\';">
				  	</td>
				 </tr>
			   </table></form>';
	  	  CloseTable();
	  	  include("footer.php");
	  	  break;
	  	  
	  	  case "update":
		  //CHECK THE IMAGE
		  if ($_FILES["app_icon"]["size"] > 0){
		    $image_name = $_FILES['app_icon']['name'];
	   	    $image_size = $_FILES['app_icon']['size'];
	   	    $temp_file_name = $_FILES['app_icon']['tmp_name'];
		    if (!isAllowedImageType($image_name)){
		      OpenTable();
		      echo '<center><b>'._ATTACHERROR.'</b></center><br/><hr><br/>';
		      echo '<center>('.$image_name.') '._UNAPPROVEDEXT.'</b></center><br/>';
		      CloseTable();
		      include('footer.php');
		      die();
		      } else {
		        $filename = time().".".getFileExtension($image_name);
		        $target_path = "modules/$module_name/images/apps_images/".$filename;
		        //RETURN ERROR IF THE FILE CANNOT BE RENAMED AND MOVED PROPERLY
		        if(!move_uploaded_file($_FILES['app_icon']['tmp_name'], $target_path)){
		          OpenTable();
		          echo '<center><span class="title">'._UPLOADERROR.'</span></center><br /><br />'
		              .'<center><b>'._UPLOADMESSAGE.'</b></center><br/>';
				  CloseTable();
				  include("footer.php");
				  die();
				}
				if(file_exists("modules/$module_name/images/apps_images/".$old_image)){
				  unlink("modules/$module_name/images/apps_images/".$old_image);
				}
		      }
		    } else {
		      if($old_image != ''){
		        $filename = $old_image;
		        } else {
		          $filename = "";
		      }
		  }
		  $parent_id = $_POST['parent_id'];
		  $app_name = addslashes($_POST['app_name']);
		  $app_description = addslashes(str_replace("\n", "<br />", $_POST['app_description']));
		  $app_url = addslashes($_POST['app_url']);
		  $lbl_custom1 = addslashes($_POST['lbl_custom1']);
		  $lbl_custom2 = addslashes($_POST['lbl_custom2']);
			  
		  //IF SQL INSERTS FINE AND FILE IS MOVED AND RENAMED, ALL IS WELL!
		  $sql_update = "UPDATE ".$prefix."_fr_apps SET parent_id='".$parent_id."', app_name='".$app_name."', app_description='".$app_description."', app_url='".$app_url."', app_icon='".$filename."', lbl_custom1='".$lbl_custom1."', show_custom1='".$show_custom1."', lbl_custom2='".$lbl_custom2."', show_custom2='".$show_custom2."', lbl_custom3='".$lbl_custom3."', show_custom3='".$show_custom3."' WHERE id='".$application_id."'";
		  if($db->sql_query($sql_update)){
		    OpenTable();
		    echo '<span class="title"><center>'._SUCCESS.'</center></span><br /><br />'
		        .'<center><b>'._APPUPDATED.'<br />'
		        ._REDIRECTED.'</b></center><br />';
		    CloseTable();
		    Header("Refresh: 3; url=".$admin_file.".php?op=".$module_name."#admin_top");
		    include("footer.php");
		    } else {
		      
		    }	  	  //DELETE FILE AND PRINT OUT SQL ERROR
		      unlink($target_path);
		      OpenTable();
		      echo '<span class=\"title\"><center>'._SQLERROR.'</center></span><br/><br/>';
		      echo '<center><b>'._SQLERRORMSG.'</b></center><br/>';
		      CloseTable();
		      include("footer.php");
		      die();
	  	  break;
	  	  
	  	  case "delete":
	  	    switch($confirm){
		  	      default:
		  	        $apps_sql = $db->sql_query("SELECT * FROM ".$prefix."_fr_apps WHERE id='".$application_id."'");
		  	        $apps_row = $db->sql_fetchrow($apps_sql);
		  	        $app_name = $apps_row['app_name'];
		  	        $app_icon = $apps_row['app_icon'];
		  	        //GET NUMBER OF FILES
		  	        $files_numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE parent_id='".$application_id."'")); 	          
						
		  	        OpenTable();
		  	        echo '<center><span class="title">'._CONFIRMDELETE.'</span></center><br /><br />';
		  	        echo '<center><b>'._CONFIRMAPPDELETE.': '.$app_name.'?</b></center><br /><br />';
		            echo '<form name="form1" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=apps&action=delete&confirm=Yes#admin_top">
						   <center>'._THEREARE.' <b>'.$files_numrows.'</b> '._APPFILES.'<br />
						   <b>'._ALLAPPSDELETE.'</b></center><br />
							<table align="center" cellpadding="5" cellspacing="4">
								<tr>
									<td><input type="hidden" name="application_id" value="'.$application_id.'">
										<input type="hidden" name="app_icon" value="'.$app_icon.'">
							            <input type="submit" value="'._CONFIRMDELETE.'" class="title">
							        </td>
							        <td>
										<input type="button" value="'._CANCEL.'" class="title" onclick="javascript:history.go(-1);">
									</td>
								</tr>
							</table><br /></form>';
		  	        CloseTable();
		  	        include("footer.php");
		  	      break;
		  	      
		  	      case "Yes":
		  	        //DELETE CATEGORY RECORD AND IMAGE
		  	        if(file_exists('modules/'.$module_name.'/images/apps_images/'.$app_icon)) unlink('modules/'.$module_name.'/images/apps_images/'.$app_icon);
		  	        if(!$db->sql_query("DELETE FROM ".$prefix."_fr_apps WHERE id='".$application_id."'")) die(mysql_error());
		  	        if(!$db->sql_query("DELETE FROM ".$prefix."_fr_files WHERE parent_id='".$application_id."'")) die(mysql_error());
		  	        OpenTable();
		  	        echo '<center><span class="title">'._SUCCESS.'</span><br /><br />'
		  	            .'<b>'._APPDELETEMSG.'</b>';
		  	        CloseTable();
		  	        Header("Refresh: 2; url=".$admin_file.".php?op=".$module_name."#admin_top");
			        include("footer.php");
	  	           break;
	  	    }
	  	  break;
	  	}
	  break;
	  
	  case "extensions":
	  	switch($action){
	  	  default:
	  	    //ADD FILE EXTENSIONS
	  	    ?>
			  <script type="text/javascript">
			  <!--
			      var module_name = "<?php print($module_name); ?>";
		          var lang = "<?php print($js_lang); ?>";
		          document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
				  function validate_form1(){
				    if(document.form1.parent_id.value == ""){
				      alert(SELECTAPP);
				      document.form1.parent_id.focus();
				      return false;}
			        
					if(document.form1.ext.value == ""){
				      alert(ENTEREXT);
				      document.form1.ext.focus();
				      return false;}
			      }
			  // -->
			  </script>
		    <?
		    $apps_list = apps_list2();
		    if($apps_list == ""){
	  	  	  $ext_table = '<center><b>'._NOAPPS.'</b></center>';
	  	  		} else {
		  	  	  $ext_table = '<form name="form1" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=extensions&action=insert#admin_top" onsubmit="return validate_form1();">
					  			 <table align="center" cellpadding="2" cellspacing="2">
		  	  	  				 	<tr>
		  	  	  						<td><b>'._SELECTAPP.': </b></td>
		  	  	  						<td><select name="parent_id">
												<option value="">*'._SELECTAPP.'*</option>
												'.$apps_list.'
											</select>
										</td>
		  	  	  					</tr>
		  	  	  					<tr>
		  	  	  						<td><b>'._FILEEXT.': </b></td>
		  	  	  						<td><input type="text" name="ext" size="10"></td>
		  	  	  					</tr>
		  	  	  				</table><br />
								<center><input type="submit" value="'._ADD.'" class="title"></center></form><br />';
			}
			OpenTable();
	  	  	echo '<center><span class="title">'._ADDEXT.'</span></center><br />';
	  	  	echo $ext_table;
	  	  	CloseTable();
	  	  	
	  	  	//MODIFY EXTENSION
	  	  	?>
			  <script type="text/javascript">
			  <!--
				  function validate_form2(){
				    if(document.form2.ext_id.value == ""){
				      alert("Please select a File Extension.");
				      document.form2.ext_id.focus();
				      return false;}
			     }	
			  // -->
			  </script>
		    <?
	  	  	$ext_list = ext_list();
	  	  	if($ext_list == ""){
	  	  	  $ext_table = '<center><b>There are no file extensions in the database.</b></center>';
	  	  		} else {
		  	  	  $ext_table = '<form name="form2" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=extensions&action=edit#admin_top" onsubmit="return validate_form2();">
					  			 <table align="center" cellpadding="2" cellspacing="2">
		  	  	  				 	<tr>
		  	  	  						<td><b>Select a File Extension: </b></td>
		  	  	  						<td><select name="ext_id">
												<option value="">*Select Extension*</option>
												'.$ext_list.'
											</select>
										</td>
		  	  	  					</tr>
		  	  	  				</table><br />
								<center><input type="submit" value="Modify" class="title"></center></form><br />';
			}
			OpenTable();
	  	  	echo '<center><span class="title">'._MODEXT.'</span></center><br />';
	  	  	echo $ext_table;
	  	  	CloseTable();
	  	  	include("footer.php");
	  	  break;
	  	  
	  	  case "insert":
	  	    $ext = addslashes($_POST['ext']);
	  	    $ext_sql = "INSERT INTO ".$prefix."_fr_ext (parent_id, ext) VALUES ('".$parent_id."', '".$ext."')";
	  	    if($db->sql_query($ext_sql)){
			    OpenTable();
			    echo '<span class="title"><center>Success!</center></span><br /><br />'
			        .'<center><b>The file extension was successfully inserted into the database.<br />'
			        .'You are being redirected</b></center><br />';
			    CloseTable();
			    Header("Refresh: 3; url=".$admin_file.".php?op=".$module_name."#admin_top");
			    include("footer.php");
			    } else {
			      OpenTable();
			      echo "<span class=\"title\"><center>SQL ERROR!</center></span><br/><br/>";
			      echo "<center><b>There was a problem inserting the application into the database.<br/><br/>ERROR: ".mysql_error()."</b></center><br/>";
			      CloseTable();
			      include("footer.php");
			      die();
			}	  	    
	  	  break;
	  	  
	  	  case "edit":
	  	    //EDIT FILE EXTENSIONS
	  	    ?>
			  <script type="text/javascript">
			  <!--
			      var module_name = "<?php print($module_name); ?>";
		          var lang = "<?php print($js_lang); ?>";
		          document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
				  function validate_form1(){
				    if(document.form1.parent_id.value == ""){
				      alert(SELECTAPP);
				      document.form1.parent_id.focus();
				      return false;}
			        
					if(document.form1.ext.value == ""){
				      alert(ENTEREXT);
				      document.form1.ext.focus();
				      return false;}
			      }
			  // -->
			  </script>
		    <?
		    $ext_sql = $db->sql_query("SELECT * FROM ".$prefix."_fr_ext WHERE id = $ext_id");
		    $ext_row = $db->sql_fetchrow($ext_sql);
		    $parent_id = $ext_row['parent_id'];
		    $app_row = $db->sql_fetchrow($db->sql_query("SELECT app_name FROM ".$prefix."_fr_apps WHERE id=".$parent_id));
		    $app_name = $app_row['app_name'];
		    $ext = $ext_row['ext'];
		    $apps_list = apps_list($parent_id);
			OpenTable();
	  	  	echo '<center><span class="title">'._MODEXT.'</span></center><br />';
	  	  	echo '<form name="form1" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=extensions&action=update#admin_top" onsubmit="return validate_form1();">
				  <table align="center" cellpadding="2" cellspacing="2">
		  	  	  	<tr>
		  	  	  		<td><b>'._SELECTAPP.': </b></td>
		  	  	  		<td><select name="parent_id">
								'.$apps_list.'
							</select>
						</td>
		  	  	  	</tr>
		  	  	  	<tr>
		  	  	  		<td><b>'._FILEEXT.': </b></td>
		  	  	  		<td><input type="text" name="ext" size="10" value="'.$ext.'"></td>
		  	  	  	</tr>
		  	  	  </table><br />
				  <table align="center" cellpadding="4" cellspacing="4">
					  <tr>
					  	<td align="right"><input type="hidden" name="ext_id" value="'.$ext_id.'">
					                      <input type="submit" value="'._MODIFY.'" class="title">
						</td>
						<td align="left">
							 <input type="button" value="'._DELETEEXT.'" class="title" onclick="window.location=\''.$admin_file.'.php?op='.$module_name.'&sel=extensions&action=delete&ext='.$ext.'&app_name='.$app_name.'&ext_id='.$ext_id.'#admin_top\';">
						</td>
					  </tr>
				  </table></form>';
	  	  	CloseTable();
	  	  	include("footer.php");	  	  
	  	  break;
	  	  
	  	  case "update":
	  	    $ext = addslashes($_POST['ext']);
	  	    $ext_update = "UPDATE ".$prefix."_fr_ext SET parent_id=$parent_id, ext='$ext' WHERE id = $ext_id";
	  	    if($db->sql_query($ext_update)){
		    OpenTable();
		    echo '<span class="title"><center>'._SUCCESS.'</center></span><br /><br />'
		        .'<center><b>'._EXTUPDATED.'</b><br />'
		        .''._REDIRECTED.'</b></center><br />';
		    CloseTable();
		    Header("Refresh: 2; url=".$admin_file.".php?op=".$module_name."#admin_top");
		    include("footer.php");
		    } else {
		      //DELETE FILE AND PRINT OUT SQL ERROR
		      OpenTable();
		      echo '<span class=\"title\"><center>'._SQLERROR.'</center></span><br/><br/>';
		      echo '<center><b>'._SQLERRORMSG.'</b></center><br/>';
		      CloseTable();
		      include("footer.php");
		      die();
		    }
	  	  break;
	  	  
	  	  case "delete":
	  	    switch($confirm){
	  	      default:
	  	        OpenTable();
	  	        echo '<center><span class="title">'._CONFIRMDELETE.'</span></center><br /><br />';
	  	        echo '<center><b>'._CONFIRMEXTDELETE.': '.$app_name.'?</b></center><br /><br />';
	            echo '<form name="form1" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=extensions&action=delete&confirm=Yes#admin_top">
						<table align="center" cellpadding="5" cellspacing="4">
							<tr>
								<td><input type="hidden" name="ext_id" value="'.$ext_id.'">
						            <input type="submit" value="'._CONFIRMDELETE.'" class="title">
						        </td>
						        <td>
									<input type="button" value="'._CANCEL.'" class="title" onclick="javascript:history.go(-1);">
								</td>
							</tr>
						</table><br /></form>';
	  	        CloseTable();
	  	        include("footer.php");
	  	      break;
	  	      
	  	      case "Yes":
	  	        //DELETE CATEGORY RECORD AND IMAGE
	  	        if(!$db->sql_query("DELETE FROM ".$prefix."_fr_ext WHERE id=".$ext_id)) die(mysql_error());
	  	        OpenTable();
	  	        echo '<center><span class="title">'._SUCCESS.'</span><br /><br />'
	  	            .'<b>'._EXTDELETE.'</b>';
	  	        CloseTable();
	  	        Header("Refresh: 2; url=".$admin_file.".php?op=".$module_name."#admin_top");
		        include("footer.php");
  	          break;
	  	    }
	  	  break;
	  	}	  	  
	  break;
	  
	  case "files":
	  	switch($action){
	  	  default:
	  	    //ADD NEW FILE
	  	    switch($mode){		      
		      default:
		        $category_list = category_list();
		        OpenTable();
		        echo '<center><span class="title">'._ADDFILES.' Step 1</span></center><br />';
		        echo '<center>'._SELECTCATEGORY.'</center><br />';
		        echo '<form method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=add&mode=cat_selected#admin_top">'
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
					<center><input type="submit" value="'._NEXT.'"></form><br />';
		        CloseTable();
		      break;
		      
		      case "cat_selected":
		        $apps_list = apps_list(NULL, $category_id);
		        OpenTable();
		        echo '<center><span class="title">'._ADDFILES.' Step 2</span></center><br />';
		        echo '<center>'._SELECTAPP.'</center><br />';
		        echo '<form method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=add&mode=app_selected#admin_top">'
					.'<table align="center">
						<tr>
							<td><b>'._SELECTAPP.': </b></td>
							<td>
								<select name="application_id">
									<option value="">*'._SELECTAPP.'*</option>
									'.$apps_list.'
								</select>
							</td>
						</tr>
					</table><br />
					<center>
					<input type="submit" value="'._NEXT.'"></form><br />';
		        CloseTable();
		      break;
		      
		      case "app_selected":
		        ?>
				<script type="text/javascript">
				<!--
				    var module_name = "<?php print($module_name); ?>";
		            var lang = "<?php print($js_lang); ?>";
		            document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
					function validate_form(custom1_name, custom2_name, custom3_name){
					  if(document.form1.title.value == ""){
					    alert(ENTERTITLE);
					    document.form1.title.focus();
					    return false;}
					
					  if(document.form1['custom1'] != undefined){
					    if(document.form1['custom1'].value == ""){
					      alert (custom1_name + " " + NOTBLANK);
					      document.form1['custom1'].focus();
					      return false;}
					  }
					  
					  if(document.form1['custom2'] != undefined){
					    if(document.form1['custom2'].value == ""){
					      alert (custom2_name + " " + NOTBLANK);
					      document.form1['custom2'].focus();
					      return false;}
					  }
					  
					  if(document.form1['custom3'] != undefined){
					    if(document.form1['custom3'].value == ""){
					      alert (custom3_name + " " + NOTBLANK);
					      document.form1['custom3'].focus();
					      return false;}
					  }
					  
					  if(document.form1.comments.value == ""){
					    alert(ENTERDESCRIPTION);
					    document.form1.comments.focus();
					    return false;}
					  
					  if(document.form1.filename.value == ""){
					    alert(ATTACHFILE);
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
		        echo '<center><span class="title">'._ADDFILES.' Step 3</span></center><br />';
		        echo '<form name="form1" enctype="multipart/form-data" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=insert#admin_top" onsubmit="return validate_form(\''.$lbl_custom1.'\',\''.$lbl_custom2.'\',\''.$lbl_custom3.'\');">'
		            .'<table align="center">
		            	<col valign="top">
		            	<col valign="top">
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
		              		<td><b>'._TCOMMENTS.':</b></td>
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
				      <input type="submit" value="'._SUBMIT.'" class="title"></center><br /><br />';
		        CloseTable();
		      break;
		    }
		    //DON'T LOAD IF USER IS ADDING A NEW FILE
		    if(!isset($mode)){
		        //MODIFY FILE
		  	  	?>
				  <script type="text/javascript">
				  <!--
				      var module_name = "<?php print($module_name); ?>";
		              var lang = "<?php print($js_lang); ?>";
		              document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
					  function validate_form2(){
					    if(document.form2.file_id.value == ""){
					      alert(SELECTFILE);
					      document.form2.file_id.focus();
					      return false;}
				     }	
				  // -->
				  </script>
			    <?
		  	  	$file_list = file_list();
		  	  	if($file_list == ""){
		  	  	  $file_table = '<center><b>'._NOFILES.'</b></center>';
		  	  		} else {
			  	  	  $file_table = '<form name="form2" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=edit#admin_top" onsubmit="return validate_form2();">
						  			 <table align="center" cellpadding="2" cellspacing="2">
			  	  	  				 	<tr>
			  	  	  						<td><b>'._SELECTFILE.': </b></td>
			  	  	  						<td><select name="file_id">
													<option value="">*'._SELECTFILE.'*</option>
													'.$file_list.'
												</select>
											</td>
			  	  	  					</tr>
			  	  	  				</table><br />
									<center><input type="submit" value="'._MODIFY.'" class="title"></center></form><br />';
				}
				OpenTable();
		  	  	echo '<center><span class="title">'._MODFILES.'</span></center><br />';
		  	  	echo $file_table;
		  	  	CloseTable();
		  	 }
		  	include("footer.php");
	  	  break;
	  	  
	  	  case "insert":
	  	    $filename_name = $_FILES['filename']['name'];
		   	$filename_type = $_FILES['filename']['type'];
		   	$filename_size = $_FILES['filename']['size'];
		   	$filename_temp = $_FILES['filename']['tmp_name'];
		   	$validate_ext = validate_file_ext($parent_id, $filename_name);
		   	$file_ext = getFileExtension($filename_name);
		   	if($validate_ext == FALSE){
		   	  $approved_ext = approved_ext_array($parent_id);
		   	  if($approved_ext == '<center><b>'._NOAPPFILEEXT.'</b></center>'){
		   	    $error_msg = $approved_ext;
		   	    $error_msg .= '<br /><br /><a href="'.$admin_file.'.php?op='.$module_name.'&sel=extensions#admin_top">'._NEWFILEEXT.'</a><br /><br />';
		   	    } else {
		   	      $array_count = count($approved_ext);
		   	      for($x=0;$x<$array_count;$x++){
		   	        if($x == $array_count-1){
		   	          $ext_error .= $approved_ext[$x].".";
		   	          } else {
		   	            $ext_error .= $approved_ext[$x].", ";
		   	        }
		   	      }
		   	      $error_msg = '<center><b>"'.$file_ext.'" '._UNAPPROVEDFILE.'<br /><br />'.$ext_error.'<br /><br />'._FILETRYAGAIN;
		   	  } 
		   	  OpenTable();
		   	  echo '<center><span class="title">'._FILEEXTERROR.'</span></center><br /><br />';
		   	  echo $error_msg;
		   	  CloseTable();
		   	  include("footer.php");
		   	  die();
		   	  } else {
		   	    //FILE IS VALIDATED, UPLOAD AND INSERT SQL
		   	    $upload_date = date('Y-m-d H:i:s');
		   	    $approved = 1;
		   	    $filename = time().".".$file_ext;
		        $target_path = $file_dir.$filename;
		        //RETURN ERROR IF THE FILE CANNOT BE RENAMED AND MOVED PROPERLY
		        if(move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)){
		          //FILE UPLOADED OKAY, INSERT DATA INTO SQL
		          $title = addslashes($_POST['title']);
		          $custom1 = addslashes($_POST['custom1']);
		          $custom2 = addslashes($_POST['custom2']);
		          $custom3 = addslashes($_POST['custom3']);
		          $comments = str_replace("\n", "<br />", $_POST['comments']);
		          $comments = addslashes($comments);
				  $file_insert = "INSERT INTO ".$prefix."_fr_files (parent_id, user_id, user_ip, upload_date, title, custom1, custom2, custom3, comments, filename, file_size, approved) VALUES ('".$parent_id."', '".$user_id."', '".$user_ip."', '".$upload_date."', '".$title."', '".$custom1."', '".$custom2."', '".$custom3."', '".$comments."', '".$filename."', '".$filename_size."', '".$approved."')";
		          if($db->sql_query($file_insert)){
		            OpenTable();
		            echo '<center><span class="title">'._SUCCESS.'</span><br /><br />';
		            echo '<b>'._UPLOADAPPROVE.'<br /><br />';
		            echo _REDIRECTED.'<br /></b></center>';
		            CloseTable();
		            Header("Refresh: 2; url=".$admin_file.".php?op=".$module_name."#admin_top");
		            include("footer.php");
		            } else {
		              //DELETE FILE AND PRINT OUT SQL ERROR
		      		  unlink($target_path);
				      OpenTable();
				      echo '<span class=\"title\"><center>'._SQLERROR.'</center></span><br/><br/>';
				      echo '<center><b>'._SQLERRORMSG.'</b></center><br/>';
				      CloseTable();
				      include("footer.php");
				      die();
				  }
				  } else {
				    //WE'VE GOT UPLOAD ISSUES
				    OpenTable();
		            echo '<center><span class="title">'._UPLOADERROR.'</span></center><br /><br />'
		                .'<center><b>'._FILEUPLOADMSG.'</b></center><br/>';
				    CloseTable();
				    include("footer.php");
				    die();
				}		   	    
		   	}
	  	  break;
	  	  
	  	  case "edit":
	  	    //EDIT FILES
	  	    ?>
				<script type="text/javascript">
				<!--
				    var module_name = "<?php print($module_name); ?>";
		            var lang = "<?php print($js_lang); ?>";
		            document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
					function validate_form(custom1_name, custom2_name, custom3_name){
					  if(document.form1.category_id.value == ""){
					    alert(SELECTCAT);
					    document.form1.category_id.focus();
					    return false;}
					    
					  if(document.form1.app_id.value == ""){
					    alert(SELECTAPP);
					    document.form1.app_id.focus();
					    return false;}
					    
					  if(document.form1.submitter_id.value == ""){
					    alert(SELECTSUBMITTER);
					    document.form1.submitter_id.focus();
					    return false;}
					    
					  if(document.form1.title.value == ""){
					    alert(ENTERTITLE);
					    document.form1.title.focus();
					    return false;}
					
					  if(document.form1['custom1'] != undefined){
					    if(document.form1['custom1'].value == ""){
					      alert(custom1_name + " " + NOBLANK);
					      document.form1['custom1'].focus();
					      return false;}
					  }
					  
					  if(document.form1['custom2'] != undefined){
					    if(document.form1['custom2'].value == ""){
					      alert(custom2_name + " " + NOBLANK);
					      document.form1['custom2'].focus();
					      return false;}
					  }
					  
					  if(document.form1['custom3'] != undefined){
					    if(document.form1['custom3'].value == ""){
					      alert(custom3_name + " " + NOBLANK);
					      document.form1['custom3'].focus();
					      return false;}
					  }
					  
					  if(document.form1.comments.value == ""){
					    alert(ENTERDESCRIPTION);
					    document.form1.comments.focus();
					    return false;}
				   }	
				// -->
				</script>
				<?
				$file_sql = "SELECT
								a.id AS file_id, 
								a.parent_id AS app_id, 
								a.user_id as submitter_id, 
								a.user_ip as submitter_ip, 
								a.upload_date AS upload_date, 
								a.title AS title, 
								a.custom1 AS custom1, 
								a.custom2 AS custom2, 
								a.custom3 AS custom3, 
								a.comments AS comments, 
								a.filename AS filename,
								a.file_size AS file_size, 
								a.approved AS approved, 
								b.parent_id AS category_id, 
								b.app_name AS app_name, 
								c.name AS category_name 
							 FROM
							 	".$prefix."_fr_files a, 
							 	".$prefix."_fr_apps b, 
							 	".$prefix."_fr_categories c 
							 WHERE
							 	a.parent_id = b.id AND 
							 	b.parent_id = c.id AND 
							 	a.id=".$file_id;
	  	    	$file_row = $db->sql_fetchrow($db->sql_query($file_sql));
	  	    	//CHECK IF CATEGORY DROP DOWN LIST HAS CHANGED
	  	    	if(isset($new_cat)){
	  	    	  $category_id = $new_cat;
	  	    	  } else {
	  	    	    $category_id = $file_row['category_id'];
	  	    	}
	  	    	
	  	    	$category_list = cat_postback_list($category_id, $file_id);
	  	    	$apps_list = apps_list($file_row['app_id'], $category_id);
	  	    	$user_list = user_list($file_row['submitter_id']);
	  	    	
	  	    	//GET APPLICATION INFO TO BUILD CUSTOM FIELDS
		        $apps_sql = "SELECT * FROM ".$prefix."_fr_apps WHERE id=".$file_row['app_id'];
		        $apps_row = $db->sql_fetchrow($db->sql_query($apps_sql));		   	  
				   	  
		        //CUSTOM FIELD 1
		        $lbl_custom1 = $apps_row['lbl_custom1'];
		        $show_custom1 = $apps_row['show_custom1'];
		        if($show_custom1 == 1)$custom1_row = '<tr><td><b>'.$lbl_custom1.':</b></td>
														  <td><input type="text" name="custom1" size="30" value="'.$file_row['custom1'].'"></td>
													  </tr>';
		        
				//CUSTOM FIELD 2
		        $lbl_custom2 = $apps_row['lbl_custom2'];
		        $show_custom2 = $apps_row['show_custom2'];
		        if($show_custom2 == 1)$custom2_row = '<tr><td><b>'.$lbl_custom2.':</b></td>
														  <td><input type="text" name="custom2" size="30" value="'.$file_row['custom2'].'"></td>
													  </tr>';
		        
				//CUSTOM FIELD 3
		        $lbl_custom3 = $apps_row['lbl_custom3'];
		        $show_custom3 = $apps_row['show_custom3'];
		        if($show_custom3 == 1)$custom3_row = '<tr><td><b>'.$lbl_custom3.':</b></td>
														  <td><input type="text" name="custom3" size="30" value="'.$file_row['custom3'].'"></td>
													  </tr>';
		
		        OpenTable();
		        echo '<center><span class="title">'._MODFILES.'</span></center><br />';
		        echo '<form name="form1" enctype="multipart/form-data" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=update#admin_top" onsubmit="return validate_form(\''.$lbl_custom1.'\',\''.$lbl_custom2.'\',\''.$lbl_custom3.'\');">'
		            .'<table align="center">
		            	<col valign="top">
		            	<col valign="top">
		              	<tr>
		              		<td><b>'._CATEGORY.':</b></td>
		              		<td>'.$category_list.'</td>
		              	</tr>
						<tr>
		              		<td><b>'._APPLICATION.':</b></td>
		              		<td>
							  	<select name="app_id">
							  	  <option value="">*'._SELECTAPP.'*</option>
								  '.$apps_list.'
								</select>
							</td>
		              	</tr>
		              	<tr>
		              		<td><b>'._SUBMITTER.':</b></td>
		              		<td>
							  	<select name="submitter_id">
								  '.$user_list.'
								</select>
							</td>
		              	</tr>
		              	<tr>
		              		<td><b>'._IPADDRESS.':</b></td>
		              		<td>'.$file_row['submitter_ip'].'</td>
		              	</tr>
		              	<tr>
		              		<td><b>'._TITLE.':</b></td>
		              		<td><input type="text" name="title" size="30" value="'.$file_row['title'].'"></td>
		              	<tr>
		              	'.$custom1_row.'
		              	'.$custom2_row.'
		              	'.$custom3_row.'
		              	<tr>
		              		<td><b>'._TCOMMENTS.':</b></td>
		              		<td><textarea name="comments" cols="40" rows="6">'.str_replace("<br />", Chr(13), $file_row['comments']).'</textarea></td>
		              	</tr>
		              	<tr>
						  	<td>
							  	<b>File:</b>
							</td>
							<td><a href="modules/'.$module_name.'/files/'.$file_row['filename'].'" title="'._CLICKTOVIEW.'" target="_blank">'._CLICKTOVIEW.'</a><br /><br />
								<input type="file" name="filename"><br />
								<b>'._NEWFILEWARN.'</b><br />
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<table align="center" cellpadding="5" cellspacing="4">
									<tr>
										<td align="right">
											<input type="hidden" name="file_id" value="'.$file_id.'">
											<input type="hidden" name="old_parent_id" value="'.$file_row['parent_id'].'">
											<input type="hidden" name="old_upload_date" value="'.$file_row['upload_date'].'">
											<input type="hidden" name="old_filename" value="'.$file_row['filename'].'">
											<input type="hidden" name="old_filesize" value="'.$file_row['file_size'].'">
											<input type="hidden" name="old_approved" value="'.$file_row['approved'].'">
											<input type="submit" value="'._MODIFY.'" class="title">
										</td>
										<td align="left">
					  						<input type="button" value="'._DELETE.'" class="title" onclick="window.location=\''.$admin_file.'.php?op='.$module_name.'&sel=files&action=delete&file_id='.$file_id.'#admin_top\';">
					  					</td>
					  				</tr>
					  			</table>
							</td>
					  	</tr>
		              </table><br /></form>';
		        CloseTable();
		        include("footer.php");
	  	  break;
	  	  
	  	  case "update":
	  	      if($_FILES['filename']['size'] > 0){
	  	        //FILE HAS BEEN UPLOADED - VALIDATE IT WITH APPLICATION ID
	  	        $filename_name = $_FILES['filename']['name'];
			   	$filename_type = $_FILES['filename']['type'];
			   	$filename_size = $_FILES['filename']['size'];
			   	$filename_temp = $_FILES['filename']['tmp_name'];
			   	$validate_ext = validate_file_ext($app_id, $filename_name);
			   	$file_ext = getFileExtension($filename_name);
			   	if($validate_ext == FALSE){
			   	  $approved_ext = approved_ext_array($app_id);
			   	  if($approved_ext == '<center><b>'._NOAPPFILEEXT.'</b></center>'){
			   	    $error_msg = $approved_ext;
			   	    $error_msg .= 'appid='.$app_id.'<center><br /><br /><a href="'.$admin_file.'.php?op='.$module_name.'&sel=extensions#admin_top">'._NEWFILEEXT.'</a><br /><br /></center>';
			   	    } else {
			   	      $array_count = count($approved_ext);
			   	      for($x=0;$x<$array_count;$x++){
			   	        if($x == $array_count-1){
			   	          $ext_error .= $approved_ext[$x].".";
			   	          } else {
			   	            $ext_error .= $approved_ext[$x].", ";
			   	        }
			   	      }
			   	      $error_msg = '<center><b>"'.$file_ext.'" '._UNAPPROVEDFILE.'<br /><br />'.$ext_error.'<br /><br />'._FILETRYAGAIN;
			   	  }
			   	  OpenTable();
		   	  	  echo '<center><span class="title">'._FILEEXTERROR.'</span></center><br /><br />';
		   	  	  echo $error_msg;
		   	  	  CloseTable();
		   	  	  include("footer.php");
		   	  	  die();
	  	          } else {
	  	          //FILE IS VALIDATED - UPLOAD NEW FILE - DELETE OLD FILE
	  	          $upload_date = date('Y-m-d H:i:s');
	  	          $filename = time().".".$file_ext;
	  	          $file_size = $filename_size;
	  	          $target_path = $file_dir.$filename;
		          //RETURN ERROR IF THE FILE CANNOT BE RENAMED AND MOVED PROPERLY
		          if(!move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)){
		            OpenTable();
		            echo '<center><span class="title">'._UPLOADERROR.'</span></center><br /><br />'
		                .'<center><b>'._FILEUPLOADMSG.'</b></center><br/>';
				    CloseTable();
				    include("footer.php");
				    die();
				  }
				  //DELETE OLD FILE
				  if(file_exists($file_dir.$old_filename)){unlink($file_dir.$old_filename);}
	  	      }
	  	    } else {
	  	      $upload_date = $old_upload_date;
	  	      $filename = $old_filename;
	  	      $file_size = $old_filesize;
	  	      //NO NEW FILE UPLOADED
	  	      if($app_id != $old_parent_id){
	  	        //APPLICATION HAS CHANGED - VALIDATE OLD FILE WITH NEW APPLICATION
	  	        $validate_ext = validate_file_ext($app_id, $filename);
			   	$file_ext = getFileExtension($filename);
			   	if($validate_ext == FALSE){
			   	  $approved_ext = approved_ext_array($app_id);
			   	  if($approved_ext == '<center><b>'._NOAPPFILEEXT.'</b></center>'){
			   	    $error_msg = $approved_ext;
			   	    $error_msg .= '<br /><br /><a href="'.$admin_file.'.php?op='.$module_name.'&sel=extensions#admin_top">'._NEWFILEEXT.'</a><br /><br />';
			   	    } else {
			   	      $array_count = count($approved_ext);
			   	      for($x=0;$x<$array_count;$x++){
			   	        if($x == $array_count-1){
			   	          $ext_error .= $approved_ext[$x].".";
			   	          } else {
			   	            $ext_error .= $approved_ext[$x].", ";
			   	        }
			   	      }
			   	      $error_msg = '<center><b>"'.$file_ext.'" '._UNAPPROVEDFILE.'<br /><br />'.$ext_error.'<br /><br />'._FILETRYAGAIN;
			   	  }
			   	  OpenTable();
		   	  	  echo '<center><span class="title">'._FILEEXTERROR.'</span></center><br /><br />';
		   	  	  echo $error_msg;
		   	  	  CloseTable();
		   	  	  include("footer.php");
		   	  	  die();
	  	      }
	  	     }
	  	    }
	  	    //INSERT INTO SQL
	  	    $comments = str_replace("\n", "<br />", $comments);
	  	    $comments = addslashes($comments);
	  	    $approved = 1; //APPROVE THE FILE
	  	    $file_sql = "UPDATE ".$prefix."_fr_files SET parent_id=$app_id, user_id=$submitter_id, upload_date='$upload_date', title='".addslashes($title)."', custom1='".addslashes($custom1)."', custom2='".addslashes($custom2)."', custom3='".addslashes($custom3)."', comments='$comments', filename='$filename', file_size=$file_size, approved=$approved WHERE id = $file_id";
	  	    if($db->sql_query($file_sql)){
	  	      //IF FILE WAS NEWLY APPROVED, NOTIFY USER
	  	      if($old_approved == 0){email_user_approve($file_id);}
	  	      OpenTable();
		      echo '<center><span class="title">'._SUCCESS.'</span><br /><br />';
		      echo '<b>'._FILEUPDATED.'<br /><br />';
		      echo _REDIRECTED.'<br /></b></center>';
		      CloseTable();
		      Header("Refresh: 2; url=".$admin_file.".php?op=".$module_name."#admin_top");
		      include("footer.php");
		      } else {
		        //DELETE FILE AND PRINT OUT SQL ERROR
		      	if(file_exists($target_path)){unlink($target_path);}
				OpenTable();
				echo '<span class=\"title\"><center>'._SQLERROR.'</center></span><br/><br/>';
				echo '<center><b>'._SQLERRORMSG.'</b></center><br/>';
				CloseTable();
				include("footer.php");
				die();
			 }
	  	  break;
	  	  
	  	  case "delete":
	  	    switch($confirm){
	  	      default:
	  	        ?>
			    <script type="text/javascript">
			    <!--
			      var module_name = "<?php print($module_name); ?>";
		          var lang = "<?php print($js_lang); ?>";
		          document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
				  function validate_form1(){
				    if(document.form1.denial_reason.value == "" || document.form1.denial_reason.value == EXPLAINDELETE){
				      alert(ENTERREASON);
				      document.form1.denial_reason.focus();
				      return false;}
			      }	
			    // -->
			    </script>
		        <?
	  	        $file_sql = "SELECT
				  				a.app_name AS application,
								b.username AS submitter,
								c.title AS title,
								c.comments AS comments,
								c.filename AS filename
							FROM
								".$prefix."_fr_apps a,
								".$prefix."_users b,
								".$prefix."_fr_files c		
							WHERE
								a.id = c.parent_id AND
								b.user_id = c.user_id AND
								c.id=".$file_id;
	  	        $file_row = $db->sql_fetchrow($db->sql_query($file_sql));
					
	  	        OpenTable();
	  	        echo '<center><span class="title">'._CONFIRMDELETE.'</span></center><br /><br />';
	  	        echo '<center><b>'._CONFIRMFILEDELETE.'</b></center><br /><br />';
  	            echo '<form name="form1" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=delete&confirm=Yes#admin_top" onsubmit="return validate_form1();">
					   <table align="center" cellpadding="2" cellspacing="2">
					      <col valign="top">
         	 			  <col valign="top">
					   	  <tr>
					   	  	 <td><b>'._APPLICATION.': </b></td>
					   	  	 <td>'.$file_row['application'].'</td>
					   	  </tr>
					   	  <tr>
					   	  	 <td><b>'._SUBMITTER.': </b></td>
					   	  	 <td>'.$file_row['submitter'].'</td>
					   	  </tr>
					   	  <tr>
					   	  	 <td><b>'._TITLE.': </b></td>
					   	  	 <td>'.$file_row['title'].'</td>
					   	  </tr>
					   	  <tr>
					   	  	 <td><b>'._TCOMMENTS.': </b></td>
					   	  	 <td>'.$file_row['comments'].'</td>
					   	  </tr>
					   	  <tr>
					   	  	 <td valign="top"><b>'._FILE.': </b></td>
					   	  	 <td><a href="modules/'.$module_name.'/files/'.$file_row['filename'].'" title="'._CLICKTOVIEW.'" target="_blank">'._CLICKTOVIEW.'</a></td>
					   	  </tr>
					   	  <tr>
					   	  	<td valign="top"><b>'._DENIALREASON.': </b></td>
							<td><textarea name="denial_reason" cols="40" rows="6" onclick="document.form1.denial_reason.value=\'\';">'._DENIALBOXNOTES.'</textarea>
							</td>
						  </tr>
					   	</table><br />
						<table align="center" cellpadding="5" cellspacing="4">
							<tr>
								<td><input type="hidden" name="file_id" value="'.$file_id.'">
								    <input type="hidden" name="filename" value="'.$file_row['filename'].'">
						            <input type="submit" value="'._CONFIRMDELETE.'" class="title">
						        </td>
						        <td>
									<input type="button" value="'._CANCEL.'" class="title" onclick="javascript:history.go(-1);">
								</td>
							</tr>
						</table><br /></form>';
	  	        CloseTable();
	  	        include("footer.php");
	  	      break;
	  	      
	  	      case "Yes":
	  	        //DELETE FILE IF IT EXISTS
	  	        if(file_exists($file_dir.$filename)){
	  	          if(unlink($file_dir.$filename)){$file_gone = _FILEDELETED;
	  	            } else {$file_gone = _FILENOTDELETED;}   
	  	          } else {$file_gone = _NOMATCHINGFILE;}
				if(delete_file($file_id, addslashes($denial_reason))){
	  	          //NOTIFY USER THAT FILE WAS DELETED/DENIED
	  	          OpenTable();
	  	          echo '<center><span class="title">'._SUCCESS.'</span><br /><br />'
	  	              .'<b>'._FILEDELETEDMSG.'<br /><br />'
	  	              .$file_gone.'<br /><br />'._REDIRECTED.'<br /></b></center>';
	  	          CloseTable();
	  	          Header("Refresh: 2; url=".$admin_file.".php?op=".$module_name."#admin_top");
		          include("footer.php");
		          } else {
				    OpenTable();
					echo '<center><span class="title">'._SQLERROR.'</span><br /><br />'
	  	                .'<b>'._RECORDNOTDELETE.'<br /><br />'
	  	                ._DELETEFILEACTION.'<br /><br />'.$file_gone.'<br /><br />'
						._GOBACK.'</center></b><br />';
	  	            CloseTable();
	  	            include("footer.php");
	  	            die();
	  	          }	  	          
	  	      break;
	  	    }
	  	  break;
	  	}
	  break;
	  
	  case "ratings":
	    if(isset($confirm) && $confirm == "YES"){
	      //DELETE RATINGS AND REDIRECT
	      if($db->sql_query("DELETE FROM ".$prefix."_fr_ratings")){
		  OpenTable();
          echo '<center><span class="title">'._SUCCESS.'</span><br /><br />'
              .'<b>'._RATINGSDELETEDMSG.'<br /><br />'
              ._REDIRECTED.'<br /></b></center>';
          CloseTable();
          Header("Refresh: 2; url=".$admin_file.".php?op=".$module_name."#admin_top");
          include("footer.php");
          } else {
		    OpenTable();
			echo '<center><span class="title">'._SQLERROR.'</span><br /><br />'
                .'<b>'._RATINGSNOTDELETE.'<br /><br />'
				._GOBACK.'</center></b><br />';
            CloseTable();
            include("footer.php");
            die();
          }
		  } else {
		  	OpenTable();
		  	echo '<center><span class="title">'._RATINGS.'</span><br /><br />';
		  	echo '<center><b>Are you sure you want to delete all ratings?</b></center><br /><br />';
		  	echo '<form name="form2" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=ratings&confirm=YES#admin_top"><input type="submit" value="'._CONFIRMDELETE.'" class="title"></form>';
		  	CloseTable();
		  	include("footer.php");
	  	}
	  break;
	  
	  case "approve":
  	  //GET FILES AWAITING APPROVAL
  	  $faa_sql = $db->sql_query("SELECT
									a.username AS submitter,
									b.name AS category,
									c.app_name AS application,
									d.id,
									d.title,
									d.comments,
									d.filename
								FROM
									".$prefix."_users a, 
									".$prefix."_fr_categories b, 
									".$prefix."_fr_apps c, 
									".$prefix."_fr_files d
								WHERE
									a.user_id = d.user_id AND
									b.id = c.parent_id AND
									c.id = d.parent_id AND
									approved=0");
  	  $faa_numrows = $db->sql_numrows($faa_sql);
  	  if($faa_numrows == 0){
  	    //NO FILES AWAITING APPROVAL
  	    OpenTable();
  	    echo '<center><span class="title">'._NOPENDINGFILES.'</span><br /><br />'
  	        .'<b>'._NOAPPROVEFILES.'</b></center><br /><br />';
  	    CloseTable();
  	    include("footer.php");
  	    } else {
  	      //BUILD TABLE
  	      $faa_table = '<table width="100%" cellpadding="2" cellspacing="2" border="1">'
  	                  .'<th>'._SUBMITTER.'</th>'
					  .'<th>'._CATEGORY.'</th>'
  	                  .'<th>'._APPLICATION.'</th>'
  	                  .'<th>'._TITLE.'</th>'
  	                  .'<th>'._TCOMMENTS.'</th>'
  	                  .'<th>'._FILE.'</th>'
  	                  .'<th colspan="2">'._APPROVEDENY.'</th>';	  	                  
  	      for($x=0;$x<$faa_numrows;$x++){
  	        $faa_row = $db->sql_fetchrow($faa_sql);
  	        $faa_table .= '<tr>
			  				<td>'.$faa_row['submitter'].'</td>
			  				<td>'.$faa_row['category'].'</td>
			  				<td>'.$faa_row['application'].'</td>
			  				<td>'.$faa_row['title'].'</td>
			  				<td>'.$faa_row['comments'].'</td>
			  				<td>
							  	<a href="'.$file_dir.$faa_row['filename'].'" title="'._CLICKTOVIEW.'" target="_blank">'._CLICKTOVIEW.'</a>
							</td>
			  				<td align="center">
								<a href="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=edit&file_id='.$faa_row['id'].'#admin_top">
								<img src="modules/'.$module_name.'/admin/images/green-check.jpg" alt="Approve!" border="0"></a>
							</td>
			  				<td align="center">
							  	<a href="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=delete&file_id='.$faa_row['id'].'&filename='.$faa_row['filename'].'#admin_top">
								<img src="modules/'.$module_name.'/admin/images/red-x.jpg" alt="Deny!" border="0"></a>
							</td>
			  			   </tr>';
		  }
		  $faa_table .= '</table><br />';
		  OpenTable();
		  echo '<span class="title"><center>'._FILESAWAITINGAPPROVE.'</center></span><br /><br />';
		  echo $faa_table;
		  CloseTable();
		  include("footer.php");
		}
	  break;
	  
	  case "broken":
	  switch($action){
	    default:
	    $broken_sql = $db->sql_query("SELECT a.id AS broken_id, a.file_id AS file_id, a.submitter AS submitter, a.date AS submit_date, b.title AS title, b.filename AS filename FROM ".$prefix."_fr_broken a, ".$prefix."_fr_files b WHERE a.file_id = b.id");
	    $broken_numrows = $db->sql_numrows($broken_sql);
	    if($broken_numrows > 0){
	      $broken_table = '<table cellpadding="2" cellspacing="2" border="1" align="center">
	      					  <th>Title</th>
	      					  <th>Submitter</th>
	      					  <th>Date</th>
	      					  <th>File</th>
	      					  <th>Ignore</th>
	      					  <th>Edit</th>
	      					  <th>Delete</th>';
	      for($x=0;$x<$broken_numrows;$x++){
	        $broken_row = $db->sql_fetchrow($broken_sql);
	        $broken_id = $broken_row['broken_id'];
	        $file_id = $broken_row['file_id'];
	        $submitter = $broken_row['submitter'];
	        $submit_date = $broken_row['submit_date'];
	        $title = $broken_row['title'];
	        $filename = $broken_row['filename'];
	        $broken_table .= '<tr>
								<td>'.$title.'</td>
								<td>'.$submitter.'</td>
								<td>'.$submit_date.'</td>
								<td><a href="modules/'.$module_name.'/files/'.$filename.'" title="Click here to confirm if file exists">Test File</a></td>
								<td align="center"><a href="'.$admin_file.'.php?op='.$module_name.'&sel=broken&action=ignore&broken_id='.$broken_id.'#admin_top" title="Ignore this report">X</a></td>
								<td align="center"><a href="'.$admin_file.'.php?op='.$module_name.'&sel=files&action=edit&file_id='.$file_id.'#admin_top" title="Edit this file">X</a></td>
								<td align="center"><a href="'.$admin_file.'.php?op='.$module_name.'&sel=broken&action=delete&broken_id='.$broken_id.'&file_id='.$file_id.'&filename='.$filename.'#admin_top" title="Delete this file">X</a></td>
							  </tr>';
		  }
		  $broken_table .= '</table><br />';
		  OpenTable();
		  echo '<span class="title"><center>'._BROKENREPORT.'</center></span><br /><hr><br />';
		  echo $broken_table;
		  CloseTable();
		  include("footer.php");
		  } else {
		    OpenTable();
		  	echo '<span class="title"><center>'._BROKENREPORT.'</center></span><br /><hr><br />';
		  	echo _NOBROKEN.'<br />';
		  	CloseTable();
		  	include("footer.php");
		}
		break;
		
		case "ignore":
		  if($db->sql_query("DELETE FROM ".$prefix."_fr_broken WHERE id=".$broken_id)){
		    OpenTable();
			echo '<center><span class="title">'._SUCCESS.'</span><br /><br />'
	  	        ._REDIRECTED.'<br /></b></center>';
	  	    CloseTable();
	  	    Header("Refresh: 0; url=".$admin_file.".php?op=".$module_name."#admin_top");
		    include("footer.php");
		    } else {
		      OpenTable();
			  echo '<center><span class="title">'._SQLERROR.'</span><br /><br />'
	  	          ._SQLERRORMSG;
	  	      CloseTable();
		      include("footer.php");
		      die();
		  }
		break;
		
		case "delete":
		  //DELETE FILE
		  if(file_exists($file_dir.$filename)) unlink($file_dir.$filename);
		  //DELETE FILE RECORD
		  if($db->sql_query("DELETE FROM ".$prefix."_fr_files WHERE id=".$file_id)){
		    $file_record = _RECORDDELETE;
		    } else { die(mysql_error);}
		  //DELETE BROKEN RECORD
		  if($db->sql_query("DELETE FROM ".$prefix."_fr_broken WHERE id=".$broken_id)){
		    $broken_file = _BROKENDELETE;
		    } else { die(mysql_error);}
		  OpenTable();
		  echo '<span class="title"><center>'._SUCCESS.'</span><br /><hr><br />';
		  echo $file_record.'<br /><br />'.$broken_file.'<br /><br />'._REDIRECTED.'</center>';
		  CloseTable();
		  Header("Refresh: 0; url=".$admin_file.".php?op=".$module_name."#admin_top");
		  include("footer.php");
		break;
	  }	        
	  break;
	  
	  case "ghost":
	    OpenTable();
	    if ($handle = opendir($file_dir)){
	      //OPEN DIR AND LOAD FILENAMES INTO AN ARRAY
	      if ($handle = opendir($file_dir)) {
   			while (false !== ($file = readdir($handle))) {
       		  if ($file != "." && $file != "..") {
           	    $file_array[] = $file;
       		  }
   		    }
	   	    closedir($handle);
		  }
		  $array_count = count($file_array);
		  //GHOST FILE HEADER PART
		  echo '<span class="title"><center>'._GHOSTFILES.'</span><br /><hr><br />';
		  //END HEADER PART
		  if($array_count > 0){
		    $counter = 0;
		    for($x=0;$x<$array_count;$x++){
		      if($db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_fr_files WHERE filename='".addslashes($file_array[$x])."'"))==0){
		        $results .= '<b>'.$file_array[$x].'</b><br />';
		        $counter++;
		        if($confirm_delete == "Yes") unlink($file_dir.$file_array[$x]);  //DELETE FILE
		      }
			}
			echo _THEREARE.' <b>'.$counter.'</b> '._GHOSTINDIR.'<br /><br />';
			if($counter > 0){
			  echo $results;
			  echo '<form name="form1" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=ghost#admin_top">
			  		<center><input type="hidden" name="confirm_delete" value="Yes">
					<input type="submit" value="'._DELETEGHOST.'" class="title"></form></center><br />';
			  $array_count=0;
			  $counter=0;
			}		        
		  }
	    }
	    CloseTable();
		include("footer.php");
	  break;
	  
	  case "restrictions":
	  if($modify_custom == "Yes"){
	    //INDIVIDUAL USER CUSTOM ACCESS
	        $user_list = custom_access_user_list();
	        ?>
				<script type="text/javascript">
				<!--
				    var module_name = "<?php print($module_name); ?>";
		            var lang = "<?php print($js_lang); ?>";
		            document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
					function validate_form(){					
					  if(document.form1.duration.value == ""){
					    alert(ENTERINTEGER);
					    document.form1.duration.focus();
					    return false;}
				   }	
				// -->
				</script>
			<?
			$custom_user_row = $db->sql_fetchrow($db->sql_query("SELECT a.username, b.user_id, b.access_type, b.duration, b.date_entered FROM ".$prefix."_users a, ".$prefix."_fr_custom_access b WHERE a.user_id = b.user_id AND b.user_id=$custom_user_id"));
			$custom_username = $custom_user_row['username'];
			$custom_user_id = $custom_user_row['user_id'];
			$access_type = $custom_user_row['access_type'];
			if($access_type == "Unlimitted") $unlimitted_select = "Selected";
			if($access_type == "Denied") $denied_select = "Selected";
			$duration = $custom_user_row['duration'];
			$date_entered = $custom_user_row['date_entered'];
	        OpenTable();
	        echo '<span class="title"><center>'._CUSTOMTITLE.'</center></span><br /><br />';
	        echo '<form name="form1" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=restrictions#admin_top" onsubmit="return validate_form();">
	        		<table align="center">
	        			<tr>
	        				<td><b>'._USERNAME.':</b></td>
	        				<td>'.$custom_username.'</td>
	        			</tr>
	        			<tr>
	        				<td><b>'._DATEENTERED.':</b></td>
	        				<td>'.$date_entered.'</td>
	        			</tr>
	        			<tr>
	        				<td><b>'._SELECTCUSTOMLEVEL.':</b></td>
	        				<td>
	        					<select name="access_type">
	        						<option value="'._UNLIMITTED.'" '.$unlimitted_select.'>'._UNLIMITTED.'</option>
	        						<option value="'._DENIED.'"'.$denied_select.'>'._DENY.'</option>
	        					</select>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td valign="top"><b>'._DAYDURATION.':</b><br />(0 = forever)</td>
	        				<td valign="top"><input type="text" name="duration" value="'.$duration.'"></td>
	        			</tr>
	        			<tr>
	        				<td align="right">
								      <input type="hidden" name="custom_user_id" value="'.$custom_user_id.'">
									  <input type="hidden" name="update_custom" value="Yes">
	        		  				  <input type="submit" value="'._MODIFY.'" class="title">
							</td>
							<td>
								<input type="button" value="'._DELETE.'" class="title" onclick="window.location=\''.$admin_file.'.php?op='.$module_name.'&sel=restrictions&custom_user_id='.$custom_user_id.'&delete_custom=Yes#admin_top\'"></form>
							</td>
						</tr>
					</table><br /></form>';
	        CloseTable();
	        include("footer.php");
	    } else {
	      if($delete_custom == "Yes"){
		      //DELETE RECORD
		      if(!$db->sql_query("DELETE FROM ".$prefix."_fr_custom_access WHERE user_id=".$custom_user_id)) die(mysql_error());
		  }
	      if($update_custom == "Yes"){
		      //UPDATE SQL WITH ACCESS RESTRICTIONS
		      if(!$db->sql_query("UPDATE ".$prefix."_fr_custom_access SET access_type='".$access_type."', duration=".$duration." WHERE user_id=".$custom_user_id)) die(mysql_error());
		  }
		  
	      if($update == "yes"){
		      //UPDATE SQL WITH ACCESS RESTRICTIONS
		      if(!$db->sql_query("UPDATE ".$prefix."_fr_restrictions SET down_num=".$down_num.", down_days=".$down_days.", donate_num=".$donate_num.", donate_days=".$donate_days." WHERE id=1")) 
			  	die(mysql_error());
		  }
		    
	        //GET CURRENT RESTRICTIONS
	        $restrict_row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_fr_restrictions"));
	        $down_num = $restrict_row['down_num'];
	        $down_days = $restrict_row['down_days'];
	        $donate_num = $restrict_row['donate_num'];
	        $donate_days = $restrict_row['donate_days'];
	        
	        OpenTable();
	        echo '<span class="title"><center>'._RESTRICTIONS.'</center></span><br /><br />'
	            ._RESTRICTNOTES.'<br /><br />'
	            .'<form name="form1" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=restrictions#admin_top">
	            	<b>'._DONATLEAST.'&nbsp;&nbsp;<input type="text" name="donate_num" value="'.$donate_num.'" size="3">&nbsp;&nbsp;'._FILESINLAST.'&nbsp;&nbsp;<input type="text" name="donate_days" value="'.$donate_days.'" size="3">&nbsp;&nbsp;'._DONRESULT.'&nbsp;&nbsp;<br /><br />
	            	'._DONELSE.'&nbsp;&nbsp;<input type="text" name="down_num" value="'.$down_num.'" size="3">&nbsp;&nbsp;'._ELSEFILES.'&nbsp;&nbsp;<input type="text" name="down_days" value="'.$down_days.'" size="3">&nbsp;&nbsp;'._DAYS.'.</b><br /><br /><br />';
	        echo '<center><input type="hidden" name="update" value="yes"><input type="submit" value="Submit" class="title"></center></form><br />';
	        CloseTable();

	        if($new_custom == "Yes"){
		      //CUSTOM USER ACCESS INSERT STATEMENT
		      if(!$db->sql_query("INSERT INTO ".$prefix."_fr_custom_access (user_id, access_type, duration, date_entered) VALUES ('".$custom_user_id."', '".$access_type."', '".$duration."', '".date('Y-m-d')."')")) die(mysql_error());
		    }
		
	        //INDIVIDUAL USER CUSTOM ACCESS
	        $user_list = custom_access_user_list();
	        ?>
				<script type="text/javascript">
				<!--
				    var module_name = "<?php print($module_name); ?>";
		            var lang = "<?php print($js_lang); ?>";
		            document.write("<script src='/modules/" + module_name + "/admin/language/lang-english.js'></script>")
					function validate_form2(){
					  if(document.form2.custom_user_id.value == ""){
					    alert(SELECTUSER);
					    document.form2.custom_user_id.focus();
					    return false;}
					  
					  if(document.form2.access_type.value == ""){
					    alert(SELECTACCESS);
					    document.form2.access_type.focus();
					    return false;}
					
					  if(document.form2.duration.value == ""){
					    alert(ENTERINTEGER);
					    document.form2.duration.focus();
					    return false;}
				   }
				   function validate_form3(){
					  if(document.form3.custom_user_id.value == ""){
					    alert(SELECTUSER);
					    document.form3.custom_user_id.focus();
					    return false;}
				   }	
				// -->
				</script>
			<?
	        OpenTable();
	        echo '<span class="title"><center>'._CUSTOMACCESS.'</center></span><br /><br />';
	        echo '<form name="form2" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=restrictions#admin_top" onsubmit="return validate_form2();">
	        		<table align="center">
	        			<tr>
	        				<td><b>'._SELECTUSER.':</b></td>
	        				<td>
	        					<select name="custom_user_id">
	        						<option value="">*'._SELECTUSER.'*</option>
	        						'.$user_list.'
	        					</select>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td><b>'._SELECTCUSTOMLEVEL.':</b></td>
	        				<td>
	        					<select name="access_type">
	        						<option value="">*'._SELECTACCESSTYPE.'*</option>
	        						<option value="'._UNLIMITTED.'">'._UNLIMITTED.'</option>
	        						<option value="'._DENIED.'">'._DENY.'</option>
	        					</select>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td valign="top"><b>'._DAYDURATION.':</b><br />(0 = forever)</td>
	        				<td valign="top"><input type="text" name="duration"></td>
	        			</tr>
	        		  </table><br />
	        		  <center><input type="hidden" name="new_custom" value="Yes">
	        		  <input type="submit" value="'._SUBMIT.'" class="title"></center></form><br />';
	        CloseTable();
	        
	        //MODIFY CUSTOM ACCESS
	        $custom_user_list = custom_access_user_list2();
	        if($custom_user_list == ''){
	          $modify_custom_table = '<center><b>'._NOCUSTOMUSERS.'</b></center><br />';
	          } else {
	            $modify_custom_table = '<form name="form3" method="POST" action="'.$admin_file.'.php?op='.$module_name.'&sel=restrictions#admin_top" onsubmit="return validate_form3();">
										<table align="center">
	            							<tr>
	            								<td><b>'._SELECTUSER.'</b></td>
	            								<td><select name="custom_user_id">
	            										<option value="">*'._SELECTUSER.'*</option>
	            										'.$custom_user_list.'
	            									</select>
	            								</td>
	            							</tr>
	            						</table><br />
	            						<center><input type="hidden" name="modify_custom" value="Yes">
	            						<input type="submit" value="'._MODIFY.'" class="title"><br /></center></form>';
	        }
	        OpenTable();
	        echo '<span class="title"><center>'._MODIFYCUSTOM.'</center></span><br /><br />';
	        echo $modify_custom_table;
	        CloseTable();
	        include("footer.php");
	  }
	  break;
	}
} else {
	OpenTable();
	echo "<center><b>"._ERROR."</b><br><br> \"$module_name\"</center>";
	CloseTable();
	include("footer.php");
}
?>
