<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by Ramón			                                */
/* http://www.songohack.com                                             */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $admin, $admlanguage, $language, $prefix, $db, $multilingual, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {

		include ("header.php");
		GraphicAdmin();

function nuketube_menu(){
	global $admin, $admlanguage, $language, $multilingual, $admin_file;
		OpenTable();
		echo "<center><font class=\"title\"><b>NukeTube</b></font></center>";
		echo "<center><a href=\"".$admin_file.".php?op=nuketube\">"._YOU_Menu1."</a> | <a href=\"".$admin_file.".php?op=nuketube_config\">"._YOU_Menu2."</a> | <a href=\"".$admin_file.".php?op=nuketube_envios\">"._YOU_Menu3."</a></center>";
		CloseTable();

}
	
function nuketube(){
	global $prefix, $db, $admin_file;
	
	nuketube_menu();
	
	OpenTable();
		echo "<form method=\"post\" action=\"".$admin_file.".php?op=nuketube_nueva_categoria\">";
		echo "<center>";
		echo ""._YOU_Newcat." <input type=\"text\" name=\"titulo\" size=\"30\"> <input type=\"submit\" value=\""._YOU_Guardar."\">";
		echo "</center>";
	CloseTable();

	OpenTable();
		echo "<table width=\"100%\" border=\"1\">";
		echo "</form>";
		echo "<tr><td width=\"100%\"><b>"._YOU_Categoria."</b></td><td align=\"center\"><b>"._YOU_Funciones."<b></td></tr>";
		$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube_categorias ORDER BY id ASC");
		while($row = $db->sql_fetchrow($result)){
		$id = intval($row['id']);
		$categoria = filter($row['categoria'], "nohtml");
		echo "<tr>
		<td> <a href=\"".$admin_file.".php?op=nuketube_cat&cid=$id\">$categoria</a></td>
		<td align=\"center\">
		<a href=\"".$admin_file.".php?op=nuketube_editar_categoria&cid=$id\"><img src=\"images/edit.gif\" border=\"0\"></a>
		<a href=\"".$admin_file.".php?op=nuketube_borrar_categoria&cid=$id\"><img src=\"images/delete.gif\" border=\"0\"></a>
		</td></tr>";
		}
		echo "</table>";
	CloseTable();
	
}

function nuketube_cat($cid, $pagina){

	global $prefix, $db, $admin_file;
	
	nuketube_menu();

		$registros = 15;
		
		if (!$pagina) {$inicio = 0; $pagina = 1;} else { 
		$pagina_ini = $pagina-1;
		$inicio = $pagina_ini * $registros;
		} 
		
	$resultados = $db->sql_query("SELECT COUNT(id) AS total_registros FROM ".$prefix."_nuketube_comentarios");
	$row_tot = $db->sql_fetchrow($resultados);
	$total_registros = intval($row_tot['total_registros']);
	$total_paginas = ceil($total_registros / $registros); 
		
		$a = $inicio;
			
		OpenTable();
			echo "<form method=\"post\" action=\"".$admin_file.".php?op=nuketube_anadir&cid=$cid\">";
			echo "<table align=\"center\" width=\"98%\">";
			echo "<tr><td><b>Url</b></td><td><input type=\"text\" name=\"url\" value=\"".$url."\" size=\"50\"></td></tr>";
			echo "<tr><td><b></b></td><td>P.ej.: http://youtube.com/watch?v=xxxxxxxxxxx</td></tr>";
			echo "<tr><td><b>"._YOU_Titulo."</b></td><td><input type=\"text\" name=\"titulo\" size=\"50\" value=\"$titulo\"></td></tr>";
				echo "<tr><td><b>"._YOU_Categoria.":</td><td></b>";
				echo "<select name=\"cid\">";
				echo "<option></option>";
				$result_cat = $db->sql_query("select * FROM ".$prefix."_nuketube_categorias");
				while($row_cat = $db->sql_fetchrow($result_cat)){
				$ccid = intval($row_cat['id']);
				$categoria = filter($row_cat['categoria'], "nohtml");
				echo "<option value=\"$ccid\" ";
					if($cid == $ccid){
					echo "selected";
					}
				echo ">$categoria</option\">";
				}
				echo "</select></td></tr>";
	
			echo "<tr><td><b>"._YOU_Descripcion."</b></td><td><textarea wrap=\"virtual\" cols=\"50\" rows=\"8\" name=\"descripcion\">$descripcion</textarea></td></tr>";		
			echo "<tr><td colspan=\"2\">
			<input type=\"hidden\" name=\"ok\" value=\"1\">
			<input type=\"hidden\" name=\"yid\" value=\"$yid\">
			<input type=\"submit\" value=\""._YOU_Enviar."\"></td></tr>";
			echo "</table>";
			echo "</form>";
		CloseTable();
		
		OpenTable();
	
	if($total_paginas >=2){	
		//Navegacion paginación
		echo "<center>";
		if(($pagina - 1) > 0) {
		   echo "<a href='".$admin_file.".php?op=nuketube_cat&cid=$cid&pagina=".($pagina-1)."'>[ << "._YOU_Pag_ant." ]</a> ";
		}
		for ($i=1; $i<=$total_paginas; $i++){ 
		   if ($pagina == $i) 
			  echo "<b>".$pagina."</b> "; 
		   else
			  echo "<a href='".$admin_file.".php?op=nuketube_cat&cid=$cid&pagina=$i'>$i</a> "; 
		}
		if(($pagina + 1)<=$total_paginas) {
		   echo " <a href='".$admin_file.".php?op=nuketube_cat&cid=$cid&pagina=".($pagina+1)."'>[ "._YOU_Pag_sig." >> ]</a>";
		}
		echo "</center>"; 
		//Final navegacion paginación
	}
		
		echo "<table align=\"center\" width=\"98%\">";
		echo "<tr><td>";
		$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube WHERE cid='$cid' ORDER BY fecha DESC LIMIT $inicio, $registros");
		while($row = $db->sql_fetchrow($result)){
		$id = intval($row['id']);
		$yid = $row['yid'];
		$titulo = filter($row['titulo'], "nohtml");
		$descripcion = filter($row['descripcion']);
		$imagen = 'http://img.youtube.com/vi/'.$yid.'/default.jpg';
		$vposter = filter($row['poster'], "nohtml");
		$fecha = intval($row['fecha']);
		$fecha2 = strftime("%d/%m/%Y" , $fecha);
		$contador = intval($row['contador']);
		$comentarios = intval($row['comentarios']);
			
		$result_cat = $db->sql_query("select categoria FROM ".$prefix."_nuketube_categorias where id='$cid'");
		$row_cat = $db->sql_fetchrow($result_cat);
		$categoria = filter($row_cat['categoria'], "nohtml");
			
		echo "<table align=\"center\" width=\"98%\" cellpadding=\"5\" cellspacing=\"0\">";
		echo "<tr>
		<td rowspan=\"5\" width=\"130\" align=\"center\"><a href=\"modules.php?name=NukeTube&func=ver_video&vid=$id\"><img src=\"$imagen\" border=\"0\" width=\"130\" height=\"97\"></a><br><a href=\"".$admin_file.".php?op=nuketube_videos_editar&vid=$id\"><img src=\"images/edit.gif\" border=\"0\"></a> <a href=\"".$admin_file.".php?op=nuketube_borrar_video&vid=$id\"><img src=\"images/delete.gif\" border=\"0\"></a></td>
		<td><a href=\"modules.php?name=NukeTube&func=ver_video&vid=$id\"><b>$titulo</b></a></td>
		</tr>
		<tr><td><i>"._YOU_Categoria.":</i> $categoria</td></tr>
		<tr><td><i>"._YOU_Descripcion.":</i> $descripcion</td></tr>
		<tr><td><i>"._YOU_Enviado." <b>$vposter</b> "._YOU_Enviado2." <b>$fecha2</b></td></tr>
		<tr><td><i>"._YOU_Visto." $contador "._YOU_Visto2." - $comentarios "._YOU_Comentarios."</td></tr>
		<tr><td>&nbsp;</td></tr>
		";
		echo "</table>";
		}
		
		echo "</td></tr>";
		echo "</table>";
		
		CloseTable();
	}

function nuketube_anadir($titulo, $cid, $descripcion, $url){
	global $user, $cookie, $username, $prefix, $db, $admin_file;
	
	cookiedecode($user);
	$username = $cookie[1];

		$yid = explode("?v=", $url);
		$yid = $yid[1];
		$yid = explode("&", $yid);
		$yid = $yid[0];
		
			$db->sql_query("INSERT INTO ".$prefix."_nuketube (cid, yid, titulo, descripcion, poster, fecha) VALUES ('$cid', '$yid', '$titulo', '$descripcion', '$username', '$fecha')");
			$db->sql_query("UPDATE ".$prefix."_nuketube_categorias SET ult_vid='$fecha', tot_vid=tot_vid+1 WHERE id='$cid'");		

		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"".$admin_file.".php?op=nuketube_cat&cid=$cid\";
		</SCRIPT>"; 
}

function nuketube_videos_editar($vid) {
	global $prefix, $db, $admin_file;

	nuketube_menu();

		  define('NO_EDITOR', 1);
		
			$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube WHERE id='$vid'");
			$row = $db->sql_fetchrow($result);
			$id = intval($row['id']);
			$cid = intval($row['cid']);
			$yid = $row['yid'];
			$titulo = filter($row['titulo'], "nohtml");
			$descripcion = filter($row['descripcion']);
			$poster = filter($row['poster'], "nohtml");
			$url = "http://www.youtube.com/watch?v=$yid";
			
		OpenTable();

		echo "<form method=\"post\" action=\"".$admin_file.".php?op=nuketube_editar_video\">";
		echo "<table align=\"center\" width=\"98%\">";
		echo "<tr><td><b>"._YOU_Titulo."</b></td><td><input type=\"text\" name=\"titulo\" size=\"50\" value=\"$titulo\"></td></tr>";
		echo "<tr><td><b>"._YOU_Categoria."</b></td><td><select name=\"cid\">";
		
			$result_cat = $db->sql_query("select * FROM ".$prefix."_nuketube_categorias");
			while($row_cat = $db->sql_fetchrow($result_cat)){
			$ccid = intval($row_cat['id']);
			$categoria = filter($row_cat['categoria'], "nohtml");;
			echo "<option value=\"$ccid\" ";
				if($cid == $ccid){
				echo "selected";
				}
			echo ">$categoria</option\">";
			}
		
		echo "</select></td></tr>";
		
		echo "<tr><td><b>"._YOU_Descripcion."</b></td><td><textarea cols=\"50\" rows=\"8\" name=\"descripcion\">$descripcion</textarea></td></tr>";
		echo "<tr><td><b>"._YOU_Url."</b></td><td><input type=\"text\" name=\"imagen\" size=\"50\" value=\"$url\"></td></tr>";
		echo "<tr><td colspan=\"2\">
		<input type=\"hidden\" name=\"vid\" value=\"$vid\">
		<input type=\"submit\" value=\""._YOU_Enviar."\">
		</td></tr>";
		echo "</table>";
		echo "</form>";

		CloseTable();
		
}

function nuketube_editar_video($vid, $cid, $titulo, $descripcion, $url){
	global $prefix, $db, $admin_file;

		$yid = explode("?v=", $url);
		$yid = $yid[1];
		$yid = explode("&", $yid);
		$yid = $yid[0];

	$result = $db->sql_query("UPDATE " . $prefix . "_nuketube SET cid='$cid', yid='$yid', titulo='$titulo', descripcion='$descripcion' WHERE id='$vid'");
	
		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"".$admin_file.".php?op=nuketube_cat&cid=$cid\";
		</SCRIPT>"; 

} 
	
function nuketube_borrar_video($vid){
	global $prefix, $db, $admin_file;

	nuketube_menu();
		
		$result = $db->sql_query("SELECT * FROM " . $prefix . "_nuketube WHERE id='$vid'");
		$row = $db->sql_fetchrow($result);
		$cid = intval($row['cid']);
		$yid = $row['yid'];
		$titulo = filter($row['titulo'], "nohtml");
		$descripcion = filter($row['descripcion']);
		$poster = filter($row['poster'], "nohtml");
		$url = "http://www.youtube.com/watch?v=$yid";
			
		OpenTable();
		echo "<table align=\"center\" width=\"98%\">";
		echo "<tr><td><b>"._YOU_Titulo."</b></td><td>$titulo</td></tr>";
		echo "<tr><td><b>"._YOU_Descripcion."</b></td><td>$descripcion</td></tr>";
		echo "<tr><td><b>"._YOU_Url."</b></td><td>$url</td></tr>";
		echo "</table>";
		echo "<table align=\"center\" width=\"98%\">";
		echo "<tr><td><b>"._YOU_Borrar_Seguro."</b></td></tr>";
		echo "<tr><td><b><a href=\"".$admin_file.".php?op=nuketube_borrar_video_si&vid=$vid&cid=$cid\">"._YOU_Si."</a></b></td></tr>";
		echo "</table>";
		CloseTable();
		
}	
	
function nuketube_borrar_video_si($vid, $cid){
	global $prefix, $db, $admin_file;
	$db->sql_query("DELETE FROM " . $prefix . "_nuketube WHERE id='$vid'");
	$db->sql_query("DELETE FROM " . $prefix . "_nuketube_comentarios WHERE vid='$vid'");
	$db->sql_query("UPDATE ".$prefix."_nuketube_categorias SET tot_vid=tot_vid-1 WHERE id='$cid'");			
		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"".$admin_file.".php?op=nuketube_cat&cid=$cid\";
		</SCRIPT>"; 
}
	
function nuketube_nueva_categoria($titulo){
	global $prefix, $db, $admin_file;
	$result= $db->sql_query("INSERT INTO ".$prefix."_nuketube_categorias (categoria) VALUES ('$titulo')");	
		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"".$admin_file.".php?op=nuketube\";
		</SCRIPT>"; 
}
	
function nuketube_editar_categoria($cid){
	global $prefix, $db, $admin_file;

	nuketube_menu();

	$result= $db->sql_query("SELECT * from ".$prefix."_nuketube_categorias WHERE id='$cid'");
	$row = $db->sql_fetchrow($result);
	$categoria = filter($row['categoria'], "nohtml");

	OpenTable();
	echo "<form method=\"post\" action=\"".$admin_file.".php?op=nuketube_guardar_editar_categoria&cid=$cid\">";
	echo "<table align=\"center\">";
	echo "<tr><td>"._YOU_Categoria." <input type=\"text\" name=\"categoria\" value=\"$categoria\" size=\"40\"> <input type=\"submit\" value=\""._YOU_Guardar."\"></td></tr>";
	echo "</table>";
	echo "</form>";
	CloseTable();
}
	
function nuketube_guardar_editar_categoria($cid, $categoria){
	global $prefix, $db, $admin_file;
	$db->sql_query("UPDATE ".$prefix."_nuketube_categorias SET categoria='$categoria' WHERE id='$cid'");
		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"".$admin_file.".php?op=nuketube\";
		</SCRIPT>"; 
}
	
function nuketube_borrar_categoria($cid){
	global $prefix, $db, $admin_file;
	$db->sql_query("DELETE FROM ".$prefix."_nuketube_categorias WHERE id = '$cid'");
	$db->sql_query("UPDATE ".$prefix."_nuketube SET cid='0' WHERE cid='$cid'");
		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"".$admin_file.".php?op=nuketube\";
		</SCRIPT>"; 
}

function nuketube_envios(){
	global $prefix, $db, $admin_file;
	nuketube_menu();

OpenTable();
	echo "<table width=\"100%\" align=\"center\">";
	$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube_temp ORDER BY fecha ASC");
	while($row = $db->sql_fetchrow($result)){
	$i++;
	$id = intval($row['id']);
	$titulo = filter($row['titulo'], "nohtml");
	$vposter = filter($row['poster'], "nohtml");
	$fecha = intval($row['fecha']);
	$fecha2 = strftime("%d/%m/%Y", $fecha);	
	echo "<tr><td><a href=\"".$admin_file.".php?op=nuketube_envios_aceptar&id=$id\">$titulo</a></td><td>$fecha2</td><td>$vposter</td></tr>";
	}
	echo "</table>";

	if($i==0){
	echo "<table width=\"100%\" align=\"center\">";
	echo "<tr><td align=\"center\"><b>"._YOU_Pendientes_No."</b></td></tr>";
	echo "</table>";
	}
CloseTable();
}

function nuketube_envios_aceptar($id){
	global $prefix, $db, $admin_file;
	nuketube_menu();

		OpenTable();

		$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube_temp WHERE id='$id'");
		$row = $db->sql_fetchrow($result);
		$cid = intval($row['cid']);
		$yid = $row['yid'];
		$titulo = filter($row['titulo'], "nohtml");
		$descripcion = filter($row['descripcion']);
		$vposter = filter($row['poster'], "nohtml");
		$fecha = intval($row['fecha']);
		$fecha2 = strftime("%d/%m/%Y" , $fecha);
		$contador = intval($row['contador']);

		$codigo = '<object width="425" height="355">
		<param name="movie" value="http://www.youtube.com/v/'.$yid.'"></param>
		<param name="wmode" value="transparent"></param>
		<embed src="http://www.youtube.com/v/'.$yid.'" type="application/x-shockwave-flash" wmode="transparent" width="425" height="355"></embed>
		</object>';

		echo "<center>$codigo</center>";
		echo "<form method=\"post\" action=\"".$admin_file.".php?op=nuketube_envios_aceptar_si\">";
		echo "<table align=\"center\" width=\"98%\">";
		echo "<tr><td><b>"._YOU_Titulo."</b></td><td><input type=\"text\" name=\"titulo\" size=\"50\" value=\"$titulo\"></td></tr>";
		echo "<tr><td><b>"._YOU_Categoria."</b></td><td><select name=\"cid\">";
		
			$result_cat = $db->sql_query("select * FROM ".$prefix."_nuketube_categorias");
			while($row_cat = $db->sql_fetchrow($result_cat)){
			$ccid = intval($row_cat['id']);
			$categoria = filter($row_cat['categoria'], "nohtml");
			echo "<option value=\"$ccid\" ";
				if($cid == $ccid){
				echo "selected";
				}
			echo ">$categoria</option\">";
			}
		
		echo "</select></td></tr>";
		
		echo "<tr><td><b>"._YOU_Descripcion."</b></td><td><textarea cols=\"50\" rows=\"8\" name=\"descripcion\">$descripcion</textarea></td></tr>";
		echo "<tr><td colspan=\"2\">
		<input type=\"hidden\" name=\"tid\" value=\"$id\">
		<input type=\"submit\" value=\""._YOU_Aceptar."\"> <a href=\"".$admin_file.".php?op=nuketube_envios_aceptar_no&tid=$id\">"._YOU_Borrar."</a>
		</td></tr>";
		echo "</table>";
		echo "</form>";

		CloseTable();	
}
	
function nuketube_envios_aceptar_si($tid, $cid, $titulo, $descripcion){
	global $prefix, $db, $admin_file;

	nuketube_menu();
	
	$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube_temp WHERE id='$tid'");
	$row = $db->sql_fetchrow($result);
	$yid = $row['yid'];
	$vposter = filter($row['poster'], "nohtml");
	$fecha = time();

$db->sql_query("INSERT INTO ".$prefix."_nuketube (cid, yid, titulo, descripcion, poster, fecha) VALUES ('$cid', '$yid', '$titulo', '$descripcion', '$vposter', '$fecha')");
$db->sql_query("UPDATE ".$prefix."_nuketube_categorias SET ult_vid='$fecha', tot_vid=tot_vid+1 WHERE id='$cid'");
$db->sql_query("DELETE FROM ".$prefix."_nuketube_temp WHERE id='$tid'");
		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"".$admin_file.".php?op=nuketube_envios\";
		</SCRIPT>"; 
}
	
function nuketube_envios_aceptar_no($tid){
	global $prefix, $db, $admin_file;

$db->sql_query("DELETE FROM ".$prefix."_nuketube_temp WHERE id='$tid'");
		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"".$admin_file.".php?op=nuketube_envios\";
		</SCRIPT>"; 
}
	
function nuketube_config(){
	global $prefix, $db, $admin_file;
	nuketube_menu();
	
	$result_conf = $db->sql_query("SELECT * FROM ".$prefix."_nuketube_config");
	$row_conf = $db->sql_fetchrow($result_conf);
	$tipo_logo = intval($row_conf['tipo_logo']);
	$vancho = intval($row_conf['vancho']);
	$valto = intval($row_conf['valto']);
	$vcolor = intval($row_conf['vcolor']);
	$vrel = intval($row_conf['vrel']);
    $dev_id = filter($row_conf['dev_id'], "nohtml");
    $perpage = intval($row_conf['perpage']);
    $mostrar_datos_b = intval($row_conf['mostrar_datos_b']);
    $mostrar_datos_v = intval($row_conf['mostrar_datos_v']);
    $desc_b = intval($row_conf['desc_b']);
    $imagen_b = intval($row_conf['imagen_b']);
    $registros = intval($row_conf['registros']);
    $catperpag = intval($row_conf['catperpag']);
	$como_anadir = intval($row_conf['como_anadir']);
    $desc_g = intval($row_conf['desc_g']);
    $imagen_g = intval($row_conf['imagen_g']);
    $comment_activo = intval($row_conf['comment_activo']);
    $comment_user = intval($row_conf['comment_user']);
    $user_send = intval($row_conf['user_send']);
    $send_temp = intval($row_conf['send_temp']);
    $user_edit = intval($row_conf['user_edit']);

OpenTable();
	echo "<form method=\"post\" action=\"".$admin_file.".php?op=nuketube_config_guardar\">";
	echo "<table width=\"100%\" cellpadding=\"5\">";
		echo "<tr><td colspan=\"2\"><b>"._YOU_Conf1."</b></td></tr>";
	echo "<tr><td>"._YOU_Conf1_Op1."</td><td>";
		echo "<select name=\"tipo_logo\">";
			echo "<option value=\"0\">"._YOU_Conf1_Op2."</option>"; 
			echo "<option value=\"1\""; if($tipo_logo==1){ echo " selected=selected"; } echo ">"._YOU_Conf1_Op3."</option>"; 
		echo "</select>";
	echo "</td></tr>";
		echo "<tr><td colspan=\"2\"><b>"._YOU_Conf12."</b></td></tr>";	
	echo "<tr><td>"._YOU_Conf12_Op1."</td><td>";
		echo "<input type=\"text\" name=\"vancho\" value=\"$vancho\" size=\"4\">";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf12_Op2."</td><td>";
		echo "<input type=\"text\" name=\"valto\" value=\"$valto\" size=\"4\">";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf12_Op3."</td><td>";
		echo "<select name=\"vcolor\">";
			echo "<option value=\"0\"></option>"; 
			echo "<option value=\"1\""; if($vcolor==1){ echo "selected=\" selected\""; } echo ">"._YOU_Conf12_Op31."</option>"; 
			echo "<option value=\"2\""; if($vcolor==2){ echo "selected=\" selected\""; } echo ">"._YOU_Conf12_Op32."</option>"; 
			echo "<option value=\"3\""; if($vcolor==3){ echo "selected=\" selected\""; } echo ">"._YOU_Conf12_Op33."</option>"; 
			echo "<option value=\"4\""; if($vcolor==4){ echo "selected=\" selected\""; } echo ">"._YOU_Conf12_Op34."</option>"; 
			echo "<option value=\"5\""; if($vcolor==5){ echo "selected=\" selected\""; } echo ">"._YOU_Conf12_Op35."</option>"; 
			echo "<option value=\"6\""; if($vcolor==6){ echo "selected=\" selected\""; } echo ">"._YOU_Conf12_Op36."</option>"; 
			echo "<option value=\"7\""; if($vcolor==7){ echo "selected=\" selected\""; } echo ">"._YOU_Conf12_Op37."</option>"; 
			echo "<option value=\"8\""; if($vcolor==8){ echo "selected=\" selected\""; } echo ">"._YOU_Conf12_Op38."</option>"; 
			echo "<option value=\"9\""; if($vcolor==9){ echo "selected=\" selected\""; } echo ">"._YOU_Conf12_Op39."</option>"; 
		echo "</select>";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf12_Op4."</td><td>";
		echo "<select name=\"vrel\">";
			echo "<option value=\"0\">"._YOU_No."</option>"; 
			echo "<option value=\"1\""; if($vrel==1){ echo " selected=selected"; } echo ">"._YOU_Si."</option>"; 
		echo "</select>";
	echo "</td></tr>";
		echo "<tr><td colspan=\"2\"><b>"._YOU_Conf2."</b></td></tr>";	
	echo "<tr><td>"._YOU_Conf2_Op1."</td><td>";
		echo "<input type=\"text\" name=\"dev_id\" value=\"$dev_id\"> <a href=\"http://www.youtube.com/my_profile_dev\" target=\"_blank\">"._YOU_Conf2_Op2."</a>";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf2_Op3."</td><td>";
		echo "<input type=\"text\" name=\"perpage\" value=\"$perpage\">";
	echo "</td></tr>";
		echo "<tr><td>"._YOU_Conf2_Op4."</td><td>";
		echo "<select name=\"mostrar_datos_b\">";
			echo "<option value=\"0\">"._YOU_No."</option>"; 
			echo "<option value=\"1\""; if($mostrar_datos_b==1){ echo " selected=selected"; } echo ">"._YOU_Si."</option>"; 
		echo "</select>";
	echo "</td></tr>";
		echo "<tr><td>"._YOU_Conf2_Op5."</td><td>";
		echo "<select name=\"mostrar_datos_v\">";
			echo "<option value=\"0\">"._YOU_No."</option>"; 
			echo "<option value=\"1\""; if($mostrar_datos_v==1){ echo " selected=selected"; } echo ">"._YOU_Si."</option>"; 
		echo "</select>";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf2_Op6."</td><td>";
		echo "<select name=\"desc_b\">";
			echo "<option value=\"0\">"._YOU_No."</option>"; 
			echo "<option value=\"1\""; if($desc_b==1){ echo " selected=selected"; } echo ">"._YOU_Si."</option>"; 
		echo "</select>";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf2_Op7."</td><td>";
		echo "<select name=\"imagen_b\">";
			echo "<option value=\"0\">"._YOU_No."</option>"; 
			echo "<option value=\"1\""; if($imagen_b==1){ echo " selected=selected"; } echo ">"._YOU_Si."</option>"; 
		echo "</select>";
	echo "</td></tr>";
		echo "<tr><td colspan=\"2\"><b>"._YOU_Conf3."</b></td></tr>";
	echo "<tr><td>"._YOU_Conf3_Op1."</td><td>";
		echo "<input type=\"text\" name=\"registros\" value=\"$registros\">";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf3_Op2."</td><td>";
		echo "<input type=\"text\" name=\"catperpag\" value=\"$catperpag\">";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf3_Op3."</td><td>";
		echo "<select name=\"como_anadir\">";
			echo "<option value=\"0\">"._YOU_Conf3_Op4."</option>"; 
			echo "<option value=\"1\""; if($como_anadir==1){ echo " selected=selected"; } echo ">"._YOU_Conf3_Op5."</option>"; 
		echo "</select>";
	echo "</td></tr>";
		echo "<tr><td>"._YOU_Conf3_Op6."</td><td>";
		echo "<select name=\"desc_g\">";
			echo "<option value=\"0\">"._YOU_No."</option>"; 
			echo "<option value=\"1\""; if($desc_g==1){ echo " selected=selected"; } echo ">"._YOU_Si."</option>"; 
		echo "</select>";
	echo "</td></tr>";
		echo "<tr><td>"._YOU_Conf3_Op7."</td><td>";
		echo "<select name=\"imagen_g\">";
			echo "<option value=\"0\">"._YOU_No."</option>"; 
			echo "<option value=\"1\""; if($imagen_g==1){ echo " selected=selected"; } echo ">"._YOU_Si."</option>"; 
		echo "</select>";
	echo "</td></tr>";
		echo "<tr><td colspan=\"2\"><b>"._YOU_Conf4."</b></td></tr>";	
	echo "<tr><td>"._YOU_Conf4_Op1."</td><td>";
		echo "<select name=\"comment_activo\">";
			echo "<option value=\"0\">"._YOU_No."</option>"; 
			echo "<option value=\"1\""; if($comment_activo==1){ echo " selected=selected"; } echo ">"._YOU_Si."</option>"; 
		echo "</select>";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf4_Op2."</td><td>";
		echo "<select name=\"comment_user\">";
			echo "<option value=\"0\">"._YOU_Conf4_Op3."</option>"; 
			echo "<option value=\"1\""; if($comment_user==1){ echo " selected=selected"; } echo ">"._YOU_Conf4_Op4."</option>"; 
		echo "</select>";
	echo "</td></tr>";
		echo "<tr><td colspan=\"2\"><b>"._YOU_Conf5."</b></td></tr>";
	echo "<tr><td>"._YOU_Conf5_Op1."</td><td>";
		echo "<select name=\"user_send\">";
			echo "<option value=\"0\">"._YOU_Conf5_Op2."</option>"; 
			echo "<option value=\"1\""; if($user_send==1){ echo " selected=selected"; } echo ">"._YOU_Conf5_Op3."</option>"; 
		echo "</select>";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf5_Op4."</td><td>";
		echo "<select name=\"send_temp\">";
			echo "<option value=\"0\">"._YOU_Conf5_Op5."</option>"; 
			echo "<option value=\"1\""; if($send_temp==1){ echo " selected=selected"; } echo ">"._YOU_Conf5_Op6."</option>"; 
		echo "</select>";
	echo "</td></tr>";
	echo "<tr><td>"._YOU_Conf5_Op7."</td><td>";
		echo "<select name=\"user_edit\">";
			echo "<option value=\"0\">"._YOU_No."</option>"; 
			echo "<option value=\"1\""; if($user_edit==1){ echo " selected=selected"; } echo ">"._YOU_Si."</option>"; 
		echo "</select>";
	echo "</td></tr>";
	echo "<tr><td colspan=\"2\"><input type=\"submit\" value=\""._YOU_Guardar_Camb."\"></td></tr>";
	echo "</table>";
	echo "</form>";
CloseTable();	
}
	
function nuketube_config_guardar($tipo_logo, $vancho, $valto, $vcolor, $vrel, $dev_id, $perpage, $mostrar_datos_b, $mostrar_datos_v, $desc_b, $imagen_b, $registros, $catperpag, $como_anadir, $desc_g, $imagen_g, $comment_activo, $comment_user, $user_send, $send_temp, $user_edit){

global $prefix, $db, $admin_file;

$db->sql_query("UPDATE ".$prefix."_nuketube_config SET tipo_logo = '$tipo_logo', vancho = '$vancho', valto = '$valto', vcolor = '$vcolor', vrel = '$vrel', dev_id = '$dev_id', perpage = '$perpage', mostrar_datos_b = '$mostrar_datos_b', mostrar_datos_v = '$mostrar_datos_v', desc_b = '$desc_b', imagen_b = '$imagen_b', registros = '$registros', catperpag = '$catperpag', como_anadir = '$como_anadir', desc_g = '$desc_g', imagen_g = '$imagen_g', comment_activo = '$comment_activo', comment_user = '$comment_user', user_send = '$user_send', send_temp = '$send_temp', user_edit = '$user_edit'");
		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"".$admin_file.".php?op=nuketube_config\";
		</SCRIPT>"; 
}
	
switch ($op){

	case "nuketube_menu":
	nuketube_menu();
	break;
		
	case "nuketube":
	nuketube();
	break;
		
	case "nuketube_cat":
	nuketube_cat($cid, $pagina);
	break;

	case "nuketube_cat":
	nuketube_anadir($titulo, $cid, $descripcion, $url);	
	break;
		
	case "nuketube_videos_editar":
	nuketube_videos_editar($vid);
	break;

	case "nuketube_editar_video":
	nuketube_editar_video($vid, $cid, $titulo, $descripcion, $imagen);
	break;

	case "nuketube_borrar_video":
	nuketube_borrar_video($vid);
	break;

	case "nuketube_borrar_video_si":
	nuketube_borrar_video_si($vid, $cid);
	break;

	case "nuketube_nueva_categoria":
	nuketube_nueva_categoria($titulo);
	break;

	case "nuketube_editar_categoria":
	nuketube_editar_categoria($cid);
	break;
		
	case "nuketube_guardar_editar_categoria":
	nuketube_guardar_editar_categoria($cid, $categoria);
	break;

	case "nuketube_borrar_categoria":
	nuketube_borrar_categoria($cid);
	break;

	case "nuketube_envios":
	nuketube_envios();
	break;

	case "nuketube_envios_aceptar":
	nuketube_envios_aceptar($id);
	break;

	case "nuketube_envios_aceptar_si":
	nuketube_envios_aceptar_si($tid, $cid, $titulo, $descripcion);
	break;

	case "nuketube_envios_aceptar_no":
	nuketube_envios_aceptar_no($tid);
	break;

	case "nuketube_config":
	nuketube_config();
	break;

	case "nuketube_config_guardar":
	nuketube_config_guardar($tipo_logo, $vancho, $valto, $vcolor, $vrel, $dev_id, $perpage, $mostrar_datos_b, $mostrar_datos_v, $desc_b, $imagen_b, $registros, $catperpag, $como_anadir, $desc_g, $imagen_g, $comment_activo, $comment_user, $user_send, $send_temp, $user_edit);
	break;

}

} else {
	echo "Access Denied";
}

?>