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





if (!is_admin($admin)) {
	        echo "<b><center>You are not an admin. LEAVE NOW!</b></center>";
        closetable();
        include_once("footer.php");
        die;
}

//special show to the admin
if (is_admin($admin)) {
echo "<br>";
echo "<center>";
echo "<strong><strong>Admin Create Gallery<br><br>";

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_reflections_gallery WHERE creator='$cookie[1]' AND parentid='0' AND galtype='member'"));
$checkpersonal = $row['galid'];
if ($checkpersonal == "") {
echo "<a name='creatmaindrop' onclick='deviltag2();'><u>[ Setup Personal Gallery ]</u></a><br><br>";
}

//Main gallery create form
echo "<a name='creatmaindrop' onclick='deviltag1();'><u>[ Click Here to Create a Main Gallery ]</u></a>
<div id='deviltag1' class='deviltag1hidden'>
<form method='POST' enctype='multipart/form-data' action='modules.php?name=$module_name&adminarea=admincreategal2'>
	<table border='0' width='100%' id='maingalcreat'>
		<tr>
			<td colspan='2'>
			<p align='center'><b>Complete the form below to make the new Main Gallery</b></td>
		</tr>
		<tr onMouseover=\"ddrivetip('<b>Gallery Name. This is what will be shown for the name of the gallery. </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Gallery Name</td>
			<td width='50%'><input type='text' name='T1' size='20'></td>
		</tr>
		<tr onMouseover=\"ddrivetip('<b> Write a breif description about this gallery. Max 255 bytes long. </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%' valign='top'>Gallery Description</td>
			<td width='50%'><input type='text' name='desc' size='60' maxlength='255'></td>
		</tr>
				<tr onMouseover=\"ddrivetip('<b>  This is the folder the images will be saved in. You cannot change this later!<hr>Please use one word and only use Numbers, Letters, and _ .. Please make it lower caps!!<hr>This will be converted to 25 bytes if you exced that!  </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Folder Name</td>
			<td width='50%'><input type='text' name='foldername' size='20' maxlength='25'></td>
		</tr>
		<tr onMouseover=\"ddrivetip('<b>  Use a .gif, .jpg, or .jpeg. This is the gallery thumbnail. It can be changed later. A default image will be used if none selected.<hr>If you leave blank a no thumb image will appear untill you upload something into the gallery or change the thumb later on.<hr>  </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Gallery Thumbnail</td>
			<td width='50%'><input type='file' name='F1' size='20'></td>
		</tr>
		<tr onMouseover=\"ddrivetip('<b>  Allow members to see this then activate. If not only admins will be able to see it.  </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Gallery Active</td>
			<td width='50%'>

Yes <input type='radio' value='1' checked name='R1'>
No <input type='radio' name='R1' value='0'></td>

		</tr>
		<tr onMouseover=\"ddrivetip('<b>  Lock this gallery to allow anyone with a password to view it and anyone without one not be able to. Admins can see without the password. <hr>Members view must be active to allow members with password to see it.<br>This will be MD5 encoded so you will not be able to retrive it. You can change it later on if you need to! </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Gallery Password</td>
			<td width='50%'><input type='text' name='T3' size='20'></td>
		</tr>
		<tr onMouseover=\"ddrivetip('<b>  Allow member uploads into this gallery.  </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Can Members Upload</td>
			<td width='50%'>

Yes <input type='radio' checked name='R2' value='1'>
No <input type='radio' name='R2' value='0'></td>


		</tr>
		<tr>
			<td colspan='2'>
			<p align='center'><input type='submit' value='Submit' name='createmainadmin'><input type='reset' value='Reset' name='B2'>
<br><br>Please note your system Limits below on file upload!<br>			";

			echo "post_max_size = " . ini_get("post_max_size") . "<br>";
echo "upload_max_filesize = " . ini_get("upload_max_filesize") . "<bR>";

			echo "</td>


		</tr>
	</table>
</form></div>
";
//Main gallery create form end!


echo "<br><Br>";


//Main gallery sub create form
echo "<a name='creatmaindrop' onclick='deviltag4();'><u>[ Click Here to Create a Sub Main Gallery ]</u></a>
<div id='deviltag4' class='deviltag4hidden'>
<form method='POST' enctype='multipart/form-data' action='modules.php?name=$module_name&adminarea=admincreategal2'>
	<table border='0' width='100%' id='maingalcreat'>
		<tr>
			<td colspan='2'>
			<p align='center'><b>Complete the form below to make the new Sub Main Gallery</b></td>
		</tr>


					<tr>
			<td align='right'><b>Main Gallery Gallery</b></td>
			<td>";

echo "
<select size='1' name='mainid'>
<option selected value='---- Select ----'>---- Select ----</option>";
$sql="SELECT * FROM ".$prefix."_reflections_gallery WHERE galtype='main' AND parentid='0'";
$result=mysql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$galidnumber=mysql_result($result,$i,"galid");
$mainname=mysql_result($result,$i,"name");
echo "<option value=\"$galidnumber\">$galidnumber - $mainname</option>";
$i++;
}

echo "			</select>";


			echo "
			</td>
			</tr>




		<tr onMouseover=\"ddrivetip('<b>  Gallery Name. This is what will be shown for the name of the gallery.  </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Gallery Name</td>
			<td width='50%'><input type='text' name='T1' size='20'></td>
		</tr>
		<tr onMouseover=\"ddrivetip('<b>  Write a breif description about this gallery. Max 255 bytes long.  </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%' valign='top'>Gallery Description</td>
			<td width='50%'><input type='text' name='desc' size='60' maxlength='255'></td>
		<tr onMouseover=\"ddrivetip('<b>  Use a .gif, .jpg, or .jpeg. This is the gallery thumbnail. It can be changed later. A default image will be used if none selected.<hr>If you leave blank a no thumb image will appear untill you upload something into the gallery or change the thumb later on.<hr>  </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Gallery Thumbnail</td>
			<td width='50%'><input type='file' name='F1' size='20'></td>
		</tr>
		<tr onMouseover=\"ddrivetip('<b>  Allow members to see this then activate. If not only admins will be able to see it.  </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Gallery Active</td>
			<td width='50%'>

Yes <input type='radio' value='1' checked name='R1'>
No <input type='radio' name='R1' value='0'></td>

		</tr>
		<tr onMouseover=\"ddrivetip('<b>  Lock this gallery to allow anyone with a password to view it and anyone without one not be able to. Admins can see without the password. <hr>Members view must be active to allow members with password to see it.<br>This will be MD5 encoded so you will not be able to retrive it. You can change it later on if you need to! </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Gallery Password</td>
			<td width='50%'><input type='text' name='T3' size='20'></td>
		</tr>
		<tr onMouseover=\"ddrivetip('<b>  Allow member uploads into this gallery.  </b>','', 300)\"; onMouseout=\"hideddrivetip()\">
			<td align='right' width='50%'>Can Members Upload</td>
			<td width='50%'>

Yes <input type='radio' checked name='R2' value='1'>
No <input type='radio' name='R2' value='0'></td>


		</tr>
		<tr>
			<td colspan='2'>
			<p align='center'><input type='submit' value='Submit' name='createsubmainadmin'><input type='reset' value='Reset' name='B2'>
<br><br>Please note your system Limits below on file upload!<br>			";

			echo "post_max_size = " . ini_get("post_max_size") . "<br>";
echo "upload_max_filesize = " . ini_get("upload_max_filesize") . "<bR>";

			echo "</td>


		</tr>
	</table>
</form></div>
";
//Main gallery sub create form end!

//Create member gallery

echo "<br><Br><a name='creatmaindrop' onclick='deviltag2();'><u>[ Click Here to Create a Member Gallery ]</u></a>
<div id='deviltag2' class='deviltag2hidden'>
<center><strong>Please fill out the fallowing information to use for member gallery</strong></center><br>";
echo "
<form method='POST' name='post' action='modules.php?name=$module_name&adminarea=admincreategal2'>
	<table border='0' width='100%' id='table112323'>
			<tr>
			<td align='right'><b>Username</b></td>
			<td><input class='post' name='username' value='' size='20' style='font-weight: 700'>
			<input type='submit' name='usersubmit' value='Find a username' onClick=\"window.open('modules.php?name=Forums&file=search&mode=searchuser&popup=1', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;\" />

			</td>
		</tr>
		<tr>
			<td align='right'><b>Name of Gallery</b></td>
			<td><input name='T1' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Description of Gallery</b></td>
			<td><input name='T2' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Gallery Active</b></td>
			<td>
			Yes <input type='radio' value='1' checked name='R1' style='font-weight: 700'> No <input type='radio' name='R1' value='0' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Gallery Password <br><i>(optional Enter only if you <br>want to password protect <br>from other members)</i></b></td>
			<td valign='top'><input name='T3' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td colspan='2'>
			<p align='center'>
			<input type='submit' value='Submit' name='creatememadmin' style='font-weight: 700'><input type='reset' value='Reset' name='B2' style='font-weight: 700'></td>
		</tr>
	</table>
</form></div>
";
// end create member gallery





//Create member sub gallery

echo "<br><Br><a name='creatmaindrop' onclick='deviltag3();'><u>[ Click Here to Create a Sub Member Gallery ]</u></a>
<div id='deviltag3' class='deviltag3hidden'>
<center><strong>Please fill out the fallowing information to use for member sub gallery</strong></center><br>";
echo "
<form method='POST' name='post' action='modules.php?name=$module_name&adminarea=admincreategal2'>
	<table border='0' width='100%' id='table112323'>

			<tr>
			<td align='right'><b>Main Member Gallery</b></td>
			<td>";

echo "
<select size='1' name='memmainid'>
<option selected value='---- Select ----'>---- Select ----</option>";
$sql="SELECT * FROM ".$prefix."_reflections_gallery WHERE galtype='member' AND parentid='0'";
$result=mysql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$galidnumber=mysql_result($result,$i,"galid");
$creator=mysql_result($result,$i,"creator");
echo "<option value=\"$galidnumber\">$galidnumber - $creator</option>";
$i++;
}

echo "			</select>";


			echo "
			</td>
			</tr>

		<tr>
			<td align='right'><b>Name of Gallery</b></td>
			<td><input name='T1' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Description of Gallery</b></td>
			<td><input name='T2' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Gallery Active</b></td>
			<td>
			Yes <input type='radio' value='1' checked name='R1' style='font-weight: 700'> No <input type='radio' name='R1' value='0' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Gallery Password <br><i>(optional Enter only if you <br>want to password protect <br>from other members)</i></b></td>
			<td valign='top'><input name='T3' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td colspan='2'>
			<p align='center'>
			<input type='submit' value='Submit' name='creatememsub' style='font-weight: 700'><input type='reset' value='Reset' name='B2' style='font-weight: 700'></td>
		</tr>
	</table>
</form></div>
";


// end create member sub gallery








closetable();
include("footer.php");
die;
}
//end special show to the admin





?>