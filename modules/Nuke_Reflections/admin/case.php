<?php
// *************************************************
// This file is Part of Nuke_Reflections V1 Module by
// White_Devil of http://devil-modz.us
// E-Mail arleighesq@gmail.com

// Please do not remove any copyright notices
// Or modify beyond the main parts of this script

// Everything is pretty much Explained.
// *************************************************



global $admin_file, $prefix, $admin;
if (is_admin($admin)) {
} else {
echo "Acess Denied!!!";
die;
}
$module_name = "Nuke_Reflections";



switch($op) {

    case "da_admin_main":
    include("modules/$module_name/admin/index.php");
    break;

}

?>