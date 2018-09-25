<?

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by Ramon        			                        */
/* http://www.songhack.com                                              */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

require_once("mainfile.php");

	$result_conf = $db->sql_query("SELECT * FROM ".$prefix."_nuketube_config");
	$row_conf = $db->sql_fetchrow($result_conf);
	$tipo_logo = $row_conf['tipo_logo'];
    $vancho = $row_conf['vancho'];
    $valto = $row_conf['valto'];
    $vcolor = $row_conf['vcolor'];
    $vrel = $row_conf['vrel'];
    $dev_id = $row_conf['dev_id'];
    $perpage = $row_conf['perpage'];
    $mostrar_datos_b = $row_conf['mostrar_datos_b'];
    $mostrar_datos_v = $row_conf['mostrar_datos_v'];
    $desc_b = $row_conf['desc_b'];
    $imagen_b = $row_conf['imagen_b'];
    $registros = $row_conf['registros'];
    $catperpag = $row_conf['catperpag'];
    $como_anadir = $row_conf['como_anadir'];
    $desc_g = $row_conf['desc_g'];
    $imagen_g = $row_conf['imagen_g'];
    $comment_activo = $row_conf['comment_activo'];
    $comment_user = $row_conf['comment_user'];
    $user_send = $row_conf['user_send'];
    $send_temp = $row_conf['send_temp'];
    $user_edit = $row_conf['user_edit'];

?>