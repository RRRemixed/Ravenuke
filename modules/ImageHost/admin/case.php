<?php

/************************************************************************/
/* Copyright (c) 2006 por Jhon Doe  	                            	*/
/*                                                                      */
/* Adicción creada por Jhon Doe            					    		*/
/************************************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
$module_name = "ImageHost";
get_lang($module_name);


switch($op) {

    case "imagehost":
    case "jd":
    case "imagehostdel":
    case "imagerm":
    case "saveconfig":
    case "ihconfig":
    case "ihsave":
    case "ihinstall":
    include("modules/$module_name/admin/index.php");
    break;

}

?>