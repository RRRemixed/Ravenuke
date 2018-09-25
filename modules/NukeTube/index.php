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

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._YOU_TITLE."";
define('INDEX_FILE', true);

include("modules/".$module_name."/config.php");

function index() {

    global $module_name, $prefix, $db, $catperpag;
    include("header.php");
	
	menu();

	$ancho = 100/$catperpag;

	echo "<table align=\"center\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"><tr>";
	$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube_categorias ORDER BY categoria ASC");
	while($row = $db->sql_fetchrow($result)){
	$cid = intval($row['id']);
	$categoria = filter($row['categoria'], "nohtml");
	$tot_vid = intval($row['tot_vid']);
	$ult_vid = intval($row['ult_vid']);
	$ult_vid = strftime("%d/%m/%Y" , $ult_vid);
	$c++;
				
	echo "<td width=\"$ancho%\">";
			
	OpenTable();
	echo "<table align=\"center\" width=\"100%\">"
	. "<tr><td rowspan=\"3\" width=\"70\"><a href=\"modules.php?name=".$module_name."&func=ver_videos&cid=$cid\"><img src=\"modules/".$module_name."/images/folder.gif\" border=\"0\" width=\"70\" height=\"70\"></a></td>"
	. "<td width=\"100%\"><a href=\"modules.php?name=".$module_name."&func=ver_videos&cid=$cid\"><b>$categoria</b></a></td>"
	. "</tr>"
	. "<tr><td><B>"._YOU_TOTAL_VIDEOS.":</B> $tot_vid</td></tr>"	
	. "<tr><td><B>"._YOU_ULTIMOS.":</B> $ult_vid</td></tr>"
	. "</table>";	
	CloseTable();
	
	echo "</td>";
	
		if($c==$catperpag){
		echo "</tr><tr>";
		$c=0;
		}
	}
	echo "</tr></table>";
	
	include("footer.php");
}

function ver_videos($cid, $pagina) {

    global $admin, $admin_file, $module_name, $db, $registros, $comment_activo, $imagen_g;
    include("header.php");

	menu();

	$cid = intval($cid);
	$pagina = intval($pagina);
	
	if (!$pagina){ $inicio = 0; $pagina = 1; }else{ $inicio = ($pagina - 1) * $registros;} 
	
	$result_cat = $db->sql_query("SELECT categoria, tot_vid FROM ".$prefix."_nuketube_categorias WHERE id='$cid'");
	$row_cat = $db->sql_fetchrow($result_cat);
	$categoria = filter($row_cat['categoria'], "nohtml");
	$total_registros = intval($row_cat['tot_vid']); 
	$total_paginas = ceil($total_registros / $registros); 
	$a = $inicio;
	
	echo "<b>&nbsp;&nbsp;<a href=\"modules.php?name=".$module_name."\">"._YOU_INICIO."</a> > $categoria</b>";

if($total_paginas >=2){	
	OpenTable();
	//Navegacion paginación
	echo "<center>";
	if(($pagina - 1) > 0) {
	   echo "<a href='modules.php?name=".$module_name."&func=ver_videos&cid=$cid&pagina=".($pagina-1)."'>[ << "._YOU_ANT_PAG." ]</a> ";
	}
	for ($i=1; $i<=$total_paginas; $i++){ 
		if($pagina == $i){ 
		  echo "<b>".$pagina."</b> "; 
		}else{
		  echo "<a href='modules.php?name=".$module_name."&func=ver_videos&cid=$cid&pagina=$i'>$i</a> "; 
		}
	}
	if(($pagina + 1)<=$total_paginas) {
	   echo " <a href='modules.php?name=".$module_name."&func=ver_videos&cid=$cid&pagina=".($pagina+1)."'>[ "._YOU_SIG_PAG." >> ]</a>";
	}
	echo "</center>"; 
	//Final navegacion paginación
	CloseTable();
}
	
	$result= $db->sql_query("SELECT * FROM ".$prefix."_nuketube WHERE cid='$cid' ORDER BY fecha DESC LIMIT $inicio, $registros");
	while($row = $db->sql_fetchrow($result)){
	$id = intval($row['id']);
	$yid = $row['yid'];
	$titulo = filter($row['titulo'], "nohtml");
	$descripcion = filter($row['descripcion'], "nohtml");
	$imagen = 'http://img.youtube.com/vi/'.$yid.'/default.jpg';
	$poster = filter($row['poster'], "nohtml");
	$fecha = intval($row['fecha']);
	$fecha2 = strftime("%d/%m/%Y" , $fecha);
	$contador = intval($row['contador']);
	$comentarios = intval($row['comentarios']);

    OpenTable();
	echo "<table align=\"center\" width=\"98%\" cellpadding=\"5\" cellspacing=\"0\">"
	. "<tr>";
	
	if($imagen_g==1){
	echo "<td rowspan=\"4\" width=\"130\" align=\"center\">"
	. "<a href=\"modules.php?name=".$module_name."&func=ver_video&vid=$id\"><img src=\"$imagen\" border=\"0\" width=\"130\" height=\"97\"></a>"
	. "</td>";
	}
	echo "<td><a href=\"modules.php?name=".$module_name."&func=ver_video&vid=$id\"><b>$titulo</b></a>"
	. "</td></tr>"
	. "<tr><td><i>"._YOU_DESCRIPCION.":</i> $descripcion</td></tr>"
	. "<tr><td><i>"._YOU_ENVIADO." <b>$poster</b> "._YOU_ENVIADO2." <b>$fecha2</b></td></tr>"
	. "<tr><td><i>"._YOU_VISTO." $contador "._YOU_VISTO2."";
	if($comment_activo){ echo " - $comentarios "._YOU_COMENTARIOS.""; }
	echo "</td></tr>";
	if(is_admin($admin)){
echo "<tr><td><a href=\"".$admin_file.".php?op=nuketube_videos_editar&vid=$id\"><img src=\"images/edit.gif\" border=\"0\"></a> <a href=\"".$admin_file.".php?op=nuketube_borrar_video&vid=$id\"><img src=\"images/delete.gif\" border=\"0\"></a></td></tr>";
	}

	echo "</table>";
	CloseTable();
	}

    include("footer.php");
}

function ver_todos($pagina, $orden) {

    global $module_name, $admin, $admin_file, $db, $registros, $comment_activo, $imagen_g;
    include("header.php");
	
	menu();

	$pagina = intval($pagina);

	if (!$pagina) {$inicio = 0; $pagina = 1;} else { $inicio = ($pagina - 1) * $registros;} 
	
		$resultados = $db->sql_query("SELECT COUNT(id) AS total_registros FROM ".$prefix."_nuketube");
		$row_tot = $db->sql_fetchrow($resultados);
		$total_registros = intval($row_tot['total_registros']);
		$total_paginas = ceil($total_registros / $registros); 	
		$a = $inicio;

if($total_paginas >=2){	
	OpenTable();
	//Navegacion paginación
	echo "<center>";
		if(($pagina - 1) > 0) {
		   echo "<a href='modules.php?name=".$module_name."&func=ver_todos&orden=$orden&pagina=".($pagina-1)."'>[ << "._YOU_ANT_PAG." ]</a> ";
		}
		for ($i=1; $i<=$total_paginas; $i++){ 
			if($pagina == $i){
			  echo "<b>".$pagina."</b> "; 
			}else{
			  echo "<a href='modules.php?name=".$module_name."&func=ver_todos&orden=$orden&pagina=$i'>$i</a> "; 
			}
		}
		if(($pagina + 1)<=$total_paginas) {
		   echo " <a href='modules.php?name=".$module_name."&func=ver_todos&orden=$orden&pagina=".($pagina+1)."'>[ "._YOU_SIG_PAG." >> ]</a>";
		}
	echo "</center>"; 
	//Final navegacion paginación
	CloseTable();
}
		
	if($orden=="last"){
		$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube ORDER BY fecha DESC LIMIT $inicio, $registros");
	}else{
		$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube ORDER BY contador DESC LIMIT $inicio, $registros");
	}
	while($row = $db->sql_fetchrow($result)){
	$id = intval($row['id']);
	$cid = intval($row['cid']);
	$yid = $row['yid'];
	$titulo = filter($row['titulo'], "nohtml");
	$descripcion = filter($row['descripcion'], "nohtml");
	$imagen = 'http://img.youtube.com/vi/'.$yid.'/default.jpg';
	$poster = filter($row['poster'], "nohtml");
	$fecha = intval($row['fecha']);
	$fecha2 = strftime("%d/%m/%Y" , $fecha);
	$contador = intval($row['contador']);
	$comentarios = intval($row['comentarios']);
		
		$result_cat = $db->sql_query("SELECT categoria FROM ".$prefix."_nuketube_categorias WHERE id='$cid'");
		$row_cat = $db->sql_fetchrow($result_cat);
		$categoria = filter($row_cat['categoria'], "nohtml");
	
OpenTable();
	echo "<table align=\"center\" width=\"98%\" cellpadding=\"5\" cellspacing=\"0\">"
	. "<tr>";
if($imagen_g==1){
	echo "<td rowspan=\"5\" width=\"130\" align=\"center\">";
	echo "<a href=\"modules.php?name=".$module_name."&func=ver_video&vid=$id\"><img src=\"$imagen\" border=\"0\" width=\"130\" height=\"97\"></a>";
	echo "</td>";
}
	echo "<td>";
	echo " <a href=\"modules.php?name=".$module_name."&func=ver_video&vid=$id\"><b>$titulo</b></a>";
	echo "</td>"
	. "</tr>"
	. "<tr><td><i>"._YOU_DESCRIPCION.":</i> $descripcion</td></tr>"
	. "<tr><td><i>"._YOU_ENVIADO." <b>$poster</b> "._YOU_ENVIADO2." <b>$fecha2</b></td></tr>"
	. "<tr><td><i>"._YOU_CATEGORIA.": <b>$categoria</b></td></tr>"
	. "<tr><td><i>"._YOU_VISTO." $contador "._YOU_VISTO2."";
	if($comment_activo){ echo " - $comentarios "._YOU_COMENTARIOS.""; }
	echo "</td></tr>";
	if(is_admin($admin)){
	echo "<tr><td><a href=\"".$admin_file.".php?op=nuketube_videos_editar&vid=$id\"><img src=\"images/edit.gif\" border=\"0\"></a> <a href=\"".$admin_file.".php?op=nuketube_borrar_video&vid=$id\"><img src=\"images/delete.gif\" border=\"0\"></a></td></tr>";
	}
	
	echo "</table>";
CloseTable();
	}	
    include("footer.php");
}

function ult_com($pagina) {

    global $module_name, $admin, $admin_file, $db, $registros, $comment_activo, $imagen_g;
    include("header.php");

	menu();

	$pagina = intval($pagina);
	if (!$pagina) {$inicio = 0; $pagina = 1;} else { $inicio = ($pagina - 1) * $registros;} 
	
	$resultados = $db->sql_query("SELECT COUNT(id) AS total_registros FROM ".$prefix."_nuketube_comentarios");
	$row_tot = $db->sql_fetchrow($resultados);
	$total_registros = intval($row_tot['total_registros']);
	$total_paginas = ceil($total_registros / $registros); 
	$a = $inicio;

if($total_registros==0){
OpenTable();
echo "<center><i>"._YOU_NO_COMMENT."</i></center>";
CloseTable();
}

if($total_paginas >=2){	
OpenTable();
//Navegacion paginación
echo "<center>";
if(($pagina - 1) > 0) {
   echo "<a href='modules.php?name=".$module_name."&func=ult_com&pagina=".($pagina-1)."'>[ << "._YOU_ANT_PAG." ]</a> ";
}
for ($i=1; $i<=$total_paginas; $i++){ 
   if ($pagina == $i) 
      echo "<b>".$pagina."</b> "; 
   else
      echo "<a href='modules.php?name=".$module_name."&func=ult_com&pagina=$i'>$i</a> "; 
}
if(($pagina + 1)<=$total_paginas) {
   echo " <a href='modules.php?name=".$module_name."&func=ult_com&pagina=".($pagina+1)."'>[ "._YOU_SIG_PAG." >> ]</a>";
}
echo "</center>"; 
//Final navegacion paginación
CloseTable();
}
	
	$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube_comentarios ORDER BY fecha DESC LIMIT $inicio, $registros");
	while($row = $db->sql_fetchrow($result)){
	$coid = intval($row['id']);
	$vid = intval($row['vid']);
	$comentario = filter($row['comentario'], "nohtml");
	$coposter = filter($row['poster'], "nohtml");
	$cofecha = intval($row['fecha']);
	$cofecha2 = strftime("%d/%m/%Y "._YOU_ALAS." %H:%M" , $cofecha);
		$result_vid = $db->sql_query("SELECT * FROM ".$prefix."_nuketube WHERE id='$vid'");
		$row_vid = $db->sql_fetchrow($result_vid);
		$cid = intval($row_vid['cid']);
		$yid = $row_vid['yid'];
		$titulo = filter($row_vid['titulo'], "nohtml");
		$descripcion = filter($row_vid['descripcion'], "nohtml");
		$imagen = 'http://img.youtube.com/vi/'.$yid.'/default.jpg';
		$poster = filter($row_vid['poster'], "nohtml");
		$fecha = intval($row_vid['fecha']);
		$fecha2 = strftime("%d/%m/%Y" , $fecha);
		$contador = intval($row_vid['contador']);
		$comentarios = intval($row_vid['comentarios']);
			
		$result_cat = $db->sql_query("SELECT categoria FROM ".$prefix."_nuketube_categorias WHERE id='$cid'");
		$row_cat = $db->sql_fetchrow($result_cat);
		$categoria = filter($row_cat['categoria'], "nohtml");
	
OpenTable();

	echo "<table align=\"center\" width=\"98%\" cellpadding=\"5\" cellspacing=\"0\">";
	echo "<tr>";
	if($imagen_g==1){
	echo "<td rowspan=\"6\" width=\"130\" align=\"center\">
	<a href=\"modules.php?name=".$module_name."&func=ver_video&vid=$vid\"><img src=\"$imagen\" border=\"0\" width=\"130\" height=\"97\"></a>
	</td>";
	}
	
	echo "<td width=\"100%\"><a href=\"modules.php?name=".$module_name."&func=ver_video&vid=$vid\"><b>$titulo</b></a>";
	echo "</td></tr>"
	. "<tr><td><i>"._YOU_DESCRIPCION.":</i> $descripcion</td></tr>"
	. "<tr><td><i>"._YOU_ENVIADO." <b>$poster</b> "._YOU_ENVIADO2." <b>$fecha2</b></td></tr>"
	. "<tr><td><i>"._YOU_CATEGORIA.": <b>$categoria</b></td></tr>"
	. "<tr><td><i>"._YOU_VISTO." $contador "._YOU_VISTO2."";
	if($comment_activo){ echo " - $comentarios "._YOU_COMENTARIOS.""; }
	echo "</td></tr>";
		if(is_admin($admin)){
		echo "<tr><td><a href=\"".$admin_file.".php?op=nuketube_videos_editar&vid=$vid\"><img src=\"images/edit.gif\" border=\"0\"></a> <a href=\"".$admin_file.".php?op=nuketube_borrar_video&vid=$vid\"><img src=\"images/delete.gif\" border=\"0\"></a>";
		}
	echo "<tr><td colspan=\"2\"><b>$coposter:</b> $comentario</td></tr>";	
	echo "</table>";
	
CloseTable();
	}	
    include("footer.php");
}


function ver_video($vid){

    global $user, $admin, $module_name, $db, $comment_activo, $comment_user, $vancho, $valto, $vcolor, $vrel, $desc_g;
    include("header.php");

	menu();

	$vid = intval($vid);

	$result= $db->sql_query("SELECT * FROM ".$prefix."_nuketube WHERE id='$vid'");
	$row = $db->sql_fetchrow($result);
	$id = intval($row['id']);
	$cid = intval($row['cid']);
	$yid = $row['yid'];
	$titulo = filter($row['titulo'], "nohtml");
	$descripcion = filter($row['descripcion'], "nohtml");
	$poster = filter($row['poster'], "nohtml");
	$fecha = intval($row['fecha']);
	$fecha2 = strftime("%d/%m/%Y" , $fecha);
	$tot_com = intval($row['comentarios']);
	$contador = intval($row['contador']);
	$contador++;
	
	$result_cat = $db->sql_query("select categoria FROM ".$prefix."_nuketube_categorias where id='$cid'");
	$row_cat = $db->sql_fetchrow($result_cat);
	$categoria = filter($row_cat['categoria'], "nohtml");

	$db->sql_query("UPDATE ".$prefix."_nuketube SET contador='$contador' WHERE id='$id'");

	if($vcolor==1){ $colorv = "&color1=0xd6d6d6&color2=0xf0f0f0"; }
	if($vcolor==2){ $colorv = "&color1=0x3a3a3a&color2=0x999999"; }
	if($vcolor==3){ $colorv = "&color1=0x2b405b&color2=0x6b8ab6"; }
	if($vcolor==4){ $colorv = "&color1=0x006699&color2=0x54abd6"; }
	if($vcolor==5){ $colorv = "&color1=0x234900&color2=0x4e9e00"; }
	if($vcolor==6){ $colorv = "&color1=0xe1600f&color2=0xfebd01"; }
	if($vcolor==7){ $colorv = "&color1=0xcc2550&color2=0xe87a9f"; }
	if($vcolor==8){ $colorv = "&color1=0x402061&color2=0x9461ca"; }
	if($vcolor==9){ $colorv = "&color1=0x5d1719&color2=0xcd311b"; }

	$codigo = '<object width="'.$vancho.'" height="'.$valto.'">
	<param name="movie" value="http://www.youtube.com/v/'.$yid.'&rel='.$vrel.''.$colorv.'"></param>
	<param name="wmode" value="transparent"></param>
	<embed src="http://www.youtube.com/v/'.$yid.'&rel='.$vrel.''.$colorv.'" type="application/x-shockwave-flash" wmode="transparent" width="'.$vancho.'" height="'.$valto.'"></embed>
	</object>';
		
	echo "<b>&nbsp;&nbsp;<a href=\"modules.php?name=".$module_name."\">"._YOU_INICIO."</a> > <a href=\"modules.php?name=".$module_name."&func=ver_videos&cid=$cid\">$categoria</a> > $titulo</b>";

	OpenTable();
	echo "<table width=\"98%\" align=\"center\">";
	echo "<tr><td align=\"center\"><b>$titulo</b></td></tr>";
	echo "<tr><td align=\"center\"><b>$codigo</b></td></tr>";
	if($desc_g==1){
	echo "<tr><td align=\"center\"><b><a href=\"http://www.youtube.com/get_video.php?video_id=".$yid."&t=".getHeaders($yid)."\">".YOU_DESCARGAR."</a></b></td></tr>";
	}
	echo "</table>";
	CloseTable();
	
	OpenTable();
	echo "<table width=\"98%\" align=\"center\">";
	echo "<tr><td align=\"center\"><i><b>"._YOU_ENVIADO." $poster "._YOU_ENVIADO2." $fecha2</b></i></td></tr>";
	echo "<tr><td align=\"center\">$descripcion</td></tr>";
	echo "</table>";
	CloseTable();
	
if($comment_activo==1){
	if($comment_user==0){
		OpenTable();
		echo "<center>";
		echo "<form method=\"post\" action=\"modules.php?name=".$module_name."&func=guardar_comentario\">";
		echo ""._YOU_COMMENT." <input type=\"text\" name=\"comentario\" size=\"75\" maxlength=\"225\">";
		echo "<input type=\"hidden\" name=\"vid\" value=\"$vid\">";
		echo "<input type=\"submit\" value=\"OK\">";
		echo "</center>";
		CloseTable();
	}else{
		if(is_user($user)){
			OpenTable();
			echo "<center>";
			echo "<form method=\"post\" action=\"modules.php?name=".$module_name."&func=guardar_comentario\">";
			echo ""._YOU_COMMENT." <input type=\"text\" name=\"comentario\" size=\"75\" maxlength=\"225\">";
			echo "<input type=\"hidden\" name=\"vid\" value=\"$vid\">";
			echo "<input type=\"submit\" value=\"OK\">";
			echo "</center>";
			CloseTable();
		}else{
			OpenTable();
				echo "<center><i>"._YOU_COMMENT_USER."</i></center>";
			CloseTable();
		}
	}
	
	OpenTable();
		if($tot_com == 0){
		echo "<center><b><i>"._YOU_NO_COMMENT2."</i></b></center>";
		}else{
		$coment = $db->sql_query("SELECT * FROM ".$prefix."_nuketube_comentarios WHERE vid='$id' ORDER BY fecha DESC");
		while($row = $db->sql_fetchrow($coment)){
		$cid = intval($row['id']);
		$poster2 = filter($row['poster'], "nohtml");
		$comentario = filter($row['comentario'], "nohtml");
		$fecha = intval($row['fecha']);
		$fecha2 = strftime("%d/%m/%Y %H:%M" , $fecha);

		echo "<table width=\"98%\" align=\"center\">";
		echo "<tr><td align=\"left\" width=\"100%\"><b>$poster2</b></td><td align=\"right\" nowrap> <b>$fecha2</b> ";
		if(is_admin($admin)){
		echo "<a href=\"modules.php?name=".$module_name."&func=borrar_comentario&cid=$cid&vid=$id\"><img src=\"images/delete.gif\" border=\"0\">";
		}
		echo "</td></tr>";
		echo "<tr><td align=\"left\" colspan=\"2\">$comentario</td></tr>";
		echo "</table>";
		}
		}
	CloseTable();
}
 	echo "</form>";
   include("footer.php");
}

function tus_videos($pagina){

    global $user, $cookie, $module_name, $db, $user_edit, $registros, $imagen_g;
    include("header.php");

	cookiedecode($user);
	$username = $cookie[1];
	
	menu();
	
	$pagina = intval($pagina);
	if (!$pagina) {$inicio = 0; $pagina = 1;} else { $inicio = ($pagina - 1) * $registros;} 
	
	$resultados = $db->sql_query("SELECT COUNT(id) AS total_registros FROM ".$prefix."_nuketube WHERE poster='$username'");
	$row_tot = $db->sql_fetchrow($resultados);
	$total_registros = intval($row_tot['total_registros']);
	$total_paginas = ceil($total_registros / $registros); 
	
	$result_cat = $db->sql_query("SELECT categoria FROM ".$prefix."_nuketube_categorias WHERE id='$cid'");
	$row_cat = $db->sql_fetchrow($result_cat);
	$categoria = filter($row_cat['categoria'], "nohtml");

if(is_user($user)){
	if($total_registros==0){
    OpenTable();
		echo "<table align=\"center\" width=\"98%\" cellpadding=\"5\" cellspacing=\"0\">";
		echo "<tr><td align=\"center\"><b>"._YOU_NO_VIDEO."</b></td></tr>";
		echo "</table>";
	CloseTable();
	}else{
		if($total_paginas >1){	
	    OpenTable();
			//Navegacion paginación
			echo "<center>";
			if(($pagina - 1) > 0) {
			   echo "<a href='modules.php?name=".$module_name."&func=tus_videos&pagina=".($pagina-1)."'>[ << "._YOU_ANT_PAG." ]</a> ";
			}
			for ($i=1; $i<=$total_paginas; $i++){ 
			   if ($pagina == $i) 
				  echo "<b>".$pagina."</b> "; 
			   else
				  echo "<a href='modules.php?name=".$module_name."&func=tus_videos&pagina=$i'>$i</a> "; 
			}
			if(($pagina + 1)<=$total_paginas) {
			   echo " <a href='modules.php?name=".$module_name."&func=tus_videos&pagina=".($pagina+1)."'>[ "._YOU_SIG_PAG." >> ]</a>";
			}
			echo "</center>"; 
			//Final navegacion paginación
		CloseTable();
		}
	
		$result= $db->sql_query("SELECT * from ".$prefix."_nuketube WHERE poster='$username' ORDER BY fecha DESC LIMIT $inicio, $registros");
		while($row = $db->sql_fetchrow($result)){
		$id = intval($row['id']);
		$cid = intval($row['cid']);
		$yid = $row['yid'];
		$titulo = filter($row['titulo'], "nohtml");
		$descripcion = filter($row['descripcion'], "nohtml");
		$imagen = 'http://img.youtube.com/vi/'.$yid.'/default.jpg';
		$poster = filter($row['poster'], "nohtml");
		$fecha = intval($row['fecha']);
		$fecha2 = strftime("%d/%m/%Y" , $fecha);
		$contador = intval($row['contador']);
		$comentarios = intval($row['comentarios']);
			$result_cat = $db->sql_query("select categoria FROM ".$prefix."_nuketube_categorias where id='$cid'");
			$row_cat = $db->sql_fetchrow($result_cat);
			$categoria = filter($row_cat['categoria'], "nohtml");
	
	OpenTable();
		echo "<table align=\"center\" width=\"98%\" cellpadding=\"5\" cellspacing=\"0\">";
		echo "<tr>";
		
		if($imagen_g==1){
		echo "<td rowspan=\"5\" width=\"130\" align=\"center\">
		<a href=\"modules.php?name=".$module_name."&func=ver_video&cid=$cid&vid=$id\"><img src=\"$imagen\" border=\"0\" width=\"130\" height=\"97\"></a>
		</td>";
		}
		
		echo "<td><a href=\"modules.php?name=".$module_name."&func=ver_video&cid=$cid&vid=$id\"><b>$titulo</b></a>";
		if($user_edit==1){
		echo " <a href=\"modules.php?name=".$module_name."&func=editar&vid=$id\"><img src=\"images/edit.gif\" border=\"0\"></a>";
		}
		echo "</td>
		</tr>
		<tr><td><i>"._YOU_DESCRIPCION.":</i> $descripcion</td></tr>
		<tr><td><i>"._YOU_CATEGORIA.": <b>$categoria</b></td></tr>
		<tr><td><i>"._YOU_ENVIADO." <b>$poster</b> "._YOU_ENVIADO2." <b>$fecha2</b></td></tr>
		<tr><td><i>"._YOU_VISTO." $contador "._YOU_VISTO2." - $comentarios "._YOU_COMENTARIOS."</td></tr>";
		echo "</table>";
	CloseTable();
		}
	}
}else{
	OpenTable();
	echo "<table align=\"center\" width=\"98%\" cellpadding=\"5\" cellspacing=\"0\">";
	echo "<tr><td align=\"center\"><b>"._YOU_NO_USER."</b></td></tr>";
	echo "</table>";
	CloseTable();
}
    include("footer.php");
}


function anadir($ok, $yid, $cid, $titulo, $descripcion){

    global $user, $cookie, $username, $module_name, $prefix, $db, $perpage, $dev_id, $send_temp, $como_anadir;

    include("header.php");

	cookiedecode($user);
	$username = $cookie[1];

    menu();

	$ok = intval($ok);
	$cid = intval($cid);
	
    OpenTable();
	
	if(!$titulo OR !$descripcion){
	$url = "http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=$dev_id&video_id=$yid";
	$codigo = file_get_contents("$url");
	
		if(!$titulo){	//TITULO
			$titulo = explode("<title>", $codigo);
			$titulo = $titulo[1];
			$titulo = explode("</title>", $titulo);
			$titulo = $titulo[0];
			#$titulo = iconv("UTF-8","ISO-8859-1",$titulo);
		}
		if(!$descripcion){	//DESCRIPCION
			$descripcion = explode("<description>", $codigo);
			$descripcion = $descripcion[1];
			$descripcion = explode("</description>", $descripcion);
			$descripcion = $descripcion[0];
			#$descripcion = iconv("UTF-8","ISO-8859-1",$descripcion);
		}
	}	

if(!$ok OR $titulo=="" OR $descripcion == "" OR !$cid){
	if($ok){ echo "<center><b><font color=\"darkred\">"._YOU_OBLIGA."</font></b>"; }
	echo "<br>";
	if(is_user($user)){
		echo "<form method=\"post\" action=\"modules.php?name=".$module_name."&func=anadir\">";
		echo "<table align=\"center\" width=\"98%\">";
		echo "<tr><td><b>Url</b></td><td><a href=\"http://www.youtube.com/watch?v=".$yid."\" target=\"_blank\">http://www.youtube.com/watch?v=".$yid."</a></td></tr>";
		echo "<tr><td><b>Título</b></td><td><input type=\"text\" name=\"titulo\" size=\"50\" value=\"$titulo\"></td></tr>";
			echo "<tr><td><b>"._YOU_CATEGORIA.":</td><td></b>";
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

		echo "<tr><td><b>"._YOU_DESCRIPCION."</b></td><td><textarea wrap=\"virtual\" cols=\"50\" rows=\"8\" name=\"descripcion\">$descripcion</textarea><br>"._YOU_CARMAX."</td></tr>";		
		echo "<tr><td colspan=\"2\">
		<input type=\"hidden\" name=\"ok\" value=\"1\">
		<input type=\"hidden\" name=\"yid\" value=\"$yid\">
		<input type=\"submit\" value=\""._YOU_ENVIAR."\"></td></tr>";
		echo "</table>";
		echo "</form>";
	}else{
		echo "<table align=\"center\" width=\"98%\" cellpadding=\"5\" cellspacing=\"0\">";
		echo "<tr><td align=\"center\"><b>"._YOU_NO_USER."</b></td></tr>";
		echo "</table>";
	}
}else{
	$fecha = time();
	if($send_temp==0){
		$db->sql_query("INSERT INTO ".$prefix."_nuketube (cid, yid, titulo, descripcion, poster, fecha) VALUES ('$cid', '$yid', '$titulo', '$descripcion', '$username', '$fecha')");
		$db->sql_query("UPDATE ".$prefix."_nuketube_categorias SET ult_vid='$fecha', tot_vid=tot_vid+1 WHERE id='$cid'");		
  	echo "<center><b>"._YOU_ENVIADO_OK."</b></center>"; 
	}else{
		$db->sql_query("INSERT INTO ".$prefix."_nuketube_temp (cid, yid, titulo, descripcion, poster, fecha) VALUES ('$cid', '$yid', '$titulo', '$descripcion', '$username', '$fecha')");	
  	echo "<center><b>"._YOU_ENVIADO_TEMP_OK."</b></center>"; 
	}
}
	CloseTable();	
    include("footer.php");
}

function anadir2($ok, $url, $cid, $titulo, $descripcion){
    global $user, $cookie, $username, $module_name, $prefix, $db, $perpage, $dev_id, $send_temp, $como_anadir;

    include("header.php");

	cookiedecode($user);
	$username = $cookie[1];

    menu();

	$ok = intval($ok);
	$cid = intval($cid);
		
if($como_anadir==0){
  	echo "<SCRIPT LANGUAGE=\"javascript\"> 
	parent.location.href = \"modules.php?name=".$module_name."\";
	</SCRIPT>"; 
}else{
		OpenTable();
		
	if(!$ok OR $titulo=="" OR $descripcion == "" OR !$cid OR strpos($url, "youtube.com/watch?v=")===false){
		if($ok){ echo "<center><b><font color=\"darkred\">"._YOU_OBLIGA."</font></b>"; }
		if($ok AND strpos($url, "youtube.com/watch?v=")===false){ echo "<center><b><font color=\"darkred\">"._YOU_MAL_URL."</font></b>"; }
		
		echo "<br>";
		if(is_user($user)){
			echo "<form method=\"post\" action=\"modules.php?name=".$module_name."&func=anadir2\">";
			echo "<table align=\"center\" width=\"98%\">";
			echo "<tr><td><b>URL:</b></td><td><input type=\"text\" name=\"url\" value=\"".$url."\" size=\"50\"></td></tr>";
			echo "<tr><td><b></b></td><td>Exemple: http://youtube.com/watch?v=xxxxxxxxxxx</td></tr>";
			echo "<tr><td><b>Titre:</b></td><td><input type=\"text\" name=\"titulo\" size=\"50\" value=\"$titulo\"></td></tr>";
				echo "<tr><td><b>"._YOU_CATEGORIA.":</td><td></b>";
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
	
			echo "<tr><td><b>"._YOU_DESCRIPCION."</b></td><td><textarea wrap=\"virtual\" cols=\"50\" rows=\"8\" name=\"descripcion\">$descripcion</textarea><br>"._YOU_CARMAX."</td></tr>";		
			echo "<tr><td colspan=\"2\">
			<input type=\"hidden\" name=\"ok\" value=\"1\">
			<input type=\"hidden\" name=\"yid\" value=\"$yid\">
			<input type=\"submit\" value=\""._YOU_ENVIAR."\"></td></tr>";
			echo "</table>";
			echo "</form>";
		}else{
			echo "<table align=\"center\" width=\"98%\" cellpadding=\"5\" cellspacing=\"0\">";
			echo "<tr><td align=\"center\"><b>"._YOU_NO_USER."</b></td></tr>";
			echo "</table>";
		}
	}else{
		$fecha = time();
		
		$yid = explode("?v=", $url);
		$yid = $yid[1];
		$yid = explode("&", $yid);
		$yid = $yid[0];
		
		if($send_temp==0){
			$db->sql_query("INSERT INTO ".$prefix."_nuketube (cid, yid, titulo, descripcion, poster, fecha) VALUES ('$cid', '$yid', '$titulo', '$descripcion', '$username', '$fecha')");
			$db->sql_query("UPDATE ".$prefix."_nuketube_categorias SET ult_vid='$fecha', tot_vid=tot_vid+1 WHERE id='$cid'");		
		echo "<center><b>"._YOU_ENVIADO_OK."</b></center>"; 
		}else{
			$db->sql_query("INSERT INTO ".$prefix."_nuketube_temp (cid, yid, titulo, descripcion, poster, fecha) VALUES ('$cid', '$yid', '$titulo', '$descripcion', '$username', '$fecha')");	
		echo "<center><b>"._YOU_ENVIADO_TEMP_OK."</b></center>"; 
		}
	}
}
	CloseTable();	
    include("footer.php");
}


function guardar_comentario($comentario, $vid){
    global $user, $cookie, $username, $prefix, $module_name, $db;
    include("header.php");

	$vid = intval($vid);
	
	cookiedecode($user);
	$username = $cookie[1];

	$fecha = time();
		
	if($comentario){
	$db->sql_query("INSERT INTO ".$prefix."_nuketube_comentarios (vid, poster, fecha, comentario) VALUES ('$vid', '$username', '$fecha', '$comentario')"); 
	$db->sql_query("UPDATE ".$prefix."_nuketube SET comentarios=comentarios+1 WHERE id='$vid'");
	}
	
  	echo "<SCRIPT LANGUAGE=\"javascript\"> 
	parent.location.href = \"modules.php?name=".$module_name."&func=ver_video&vid=$vid\";
	</SCRIPT>"; 
}

function borrar_comentario($vid, $cid){
    global $admin, $prefix, $module_name, $db;

	$vid = intval($vid);
	$cid = intval($cid);

	if(is_admin($admin)){
	$db->sql_query("DELETE FROM ".$prefix."_nuketube_comentarios WHERE id='$cid'");
	$db->sql_query("UPDATE ".$prefix."_nuketube SET comentarios=comentarios-1 WHERE id='$vid'");
	}
  	echo "<SCRIPT LANGUAGE=\"javascript\"> 
	parent.location.href = \"modules.php?name=".$module_name."&func=ver_video&vid=$vid\";
	</SCRIPT>"; 
}
	
function editar($vid, $titulo, $cid, $descripcion, $url, $enviar){
   global $user, $cookie, $username, $module_name, $prefix, $admin, $db, $user_edit;

	$cid = intval($cid);
	$vid = intval($vid);
	$enviar = intval($enviar);

   include("header.php");
	
	cookiedecode($user);
	$username = $cookie[1];

    menu();
	
if($user_edit==0){
OpenTable();
echo "<center><b>"._YOU_NOEDIT."</b></center>";
CloseTable();
}else{
	
	OpenTable();
	$fecha = time();
		
	if ($enviar==1){		
		$yid = explode("?v=", $url);
		$yid = $yid[1];
		$yid = explode("&", $yid);
		$yid = $yid[0];

		$db->sql_query("UPDATE ".$prefix."_nuketube SET cid='$cid', yid='$yid', titulo='$titulo', descripcion='$descripcion', imagen='$imagen', codigo='$codigo' WHERE id='$vid'"); 
		echo "<SCRIPT LANGUAGE=\"javascript\"> 
		parent.location.href = \"modules.php?name=".$module_name."&func=ver_video&vid=$vid\";
		</SCRIPT>"; 
	}else{
		$result = $db->sql_query("SELECT * FROM ".$prefix."_nuketube WHERE id='$vid'");
		$row = $db->sql_fetchrow($result);
		$cid = intval($row['cid']);
		$yid = $row['yid'];
		$titulo = filter($row['titulo'], "nohtml");
		$descripcion = filter($row['descripcion'], "nohtml");
		$vposter = filter($row['poster'], "nohtml");
		$url = "http://www.youtube.com/watch?v=$yid";
		
			if(is_user($user) AND $username==$vposter){
				echo "<form method=\"post\" action=\"modules.php?name=".$module_name."&func=editar\">";
				echo "<table align=\"center\" width=\"98%\">";
				echo "<tr><td><b>Título</b></td><td><input type=\"text\" name=\"titulo\" size=\"50\" value=\"$titulo\"></td></tr>";
				echo "<tr><td><b>Categoria:</td><td></b>";
				echo "<select name=\"cid\">";
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
				echo "<tr><td><b>Descripción</b></td><td><textarea wrap=\"virtual\" cols=\"50\" rows=\"8\" name=\"descripcion\">$descripcion</textarea><br>255 carácteres maximo</td></tr>";
				echo "<tr><td><b>Url youtube</b></td><td><input type=\"text\" name=\"url\" size=\"50\" value=\"$url\"></td></tr>";
				echo "<tr><td colspan=\"2\">
				<input type=\"hidden\" name=\"enviar\" value=\"1\">
				<input type=\"hidden\" name=\"vid\" value=\"$vid\">
				<input type=\"submit\" value=\"Enviar\">
				</td></tr>";
				echo "</table>";
				echo "</form>";
		}else{
		echo "<center><b>Este video no te pertenece</b></center>";
		}
	}
	CloseTable();
}
include("footer.php");
}

function buscatube($clave, $pagina){

global $module_name, $perpage, $dev_id, $user_send, $bgcolor1, $bgcolor2, $desc_b, $mostrar_datos_b, $imagen_b;

	include ("header.php");
	
	menu();

$pagina = intval($pagina);

if($clave){
	$clave3 = str_replace(" ", "+", $clave);
	if(!$pagina){
		$pagina=1;
		$url = "http://www.youtube.com/api2_rest?method=youtube.videos.list_by_tag&dev_id=$dev_id&tag=$clave3&page=1&per_page=$perpage";
	}else{
		$url = "http://www.youtube.com/api2_rest?method=youtube.videos.list_by_tag&dev_id=$dev_id&tag=$clave3&page=$pagina&per_page=$perpage";
	}

$codigo = file_get_contents("$url");

$i=1;

OpenTable();
	echo "<table align=\"center\" width=\"98%\" cellpadding=\"0\" cellspacing=\"5\">";

//CORTAMOS CODIGO A NUESTRO GUSTO
for($i>=1; $i<=$perpage; $i++){

	//URL
	$url = explode("<url>", $codigo);
	$url = $url[$i];
	$url = explode("</url>", $url);
	$url = $url[0];
	//ID DE YOUTUBE
	$id = explode("v=", $url);
	$id = $id[1];
	//IMAGEN
	$imagen = explode("<thumbnail_url>", $codigo);
	$imagen = $imagen[$i];
	$imagen = explode("</thumbnail_url>", $imagen);
	$imagen = $imagen[0];	
	//TITULO
	$titulo = explode("<title>", $codigo);
	$titulo = $titulo[$i];
	$titulo = explode("</title>", $titulo);
	$titulo = $titulo[0];
	#$titulo = iconv("UTF-8","ISO-8859-1",$titulo);
	//DESCRIPCION
	$description = explode("<description>", $codigo);
	$description = $description[$i];
	$description = explode("</description>", $description);
	$description = $description[0];
	#$description = iconv("UTF-8","ISO-8859-1",$description);

if($mostrar_datos_b==1){
	//AUTOR
	$autor = explode("<author>", $codigo);
	$autor = $autor[$i];
	$autor = explode("</author>", $autor);
	$autor = $autor[0];
	//DURACION
	$duracion = explode("<length_seconds>", $codigo);
	$duracion = $duracion[$i];
	$duracion = explode("</length_seconds>", $duracion);
	$duracion = $duracion[0];
	$minutos = intval($duracion/60);
	$minutos_length = strlen($minutos);
	if($minutos_length==1){ $minutos="0$minutos"; }
	$minutos2 = $duracion-($minutos*60);
	$minutos_length2 = strlen($minutos2);
	if($minutos_length2==1){ $minutos2="0$minutos2"; }
	$duracion = "$minutos:$minutos2";
	//VISTAS
	$vistas = explode("<view_count>", $codigo);
	$vistas = $vistas[$i];
	$vistas = explode("</view_count>", $vistas);
	$vistas = $vistas[0];
	//VOTOS
	$votos = explode("<rating_count>", $codigo);
	$votos = $votos[$i];
	$votos = explode("</rating_count>", $votos);
	$votos = $votos[0];
	//VOTOS_MEDIA
	$votos_m = explode("<rating_avg>", $codigo);
	$votos_m = $votos_m[$i];
	$votos_m = explode("</rating_avg>", $votos_m);
	$votos_m = $votos_m[0];
	//AÑADIDO
	$anadido = explode("<upload_time>", $codigo);
	$anadido = $anadido[$i];
	$anadido = explode("</upload_time>", $anadido);
	$anadido = $anadido[0];
	$anadido = strftime("%d/%m/%Y", $anadido);	
 }	
	//TAGS
	$tags = explode("<tags>", $codigo);
	$tags = $tags[$i];
	$tags = explode("</tags>", $tags);
	$tags = $tags[0];
	$tags2 = explode(" ", "$tags");
	$tags2 = count($tags2);
	$tags3 = "";
	$ttt=0;
	
	//TAGS CON ENLACES
		for($ttt>=1; $ttt<=$tags2; $ttt++){
			$tag = explode(' ', "$tags");
			$tag = $tag[$ttt];
			$tags3 .= "<a href=\"modules.php?name=".$module_name."&clave=$tag\"><u>$tag</u></a>&nbsp; ";
		}
		#$tags = iconv("UTF-8","ISO-8859-1",$tags3);
		
	//IMPRIMIMOS LA LISTA
	if($id){
		$hay = 1;
			echo "<tr>";
			if($imagen_b==1){
			echo "<td valign=\"top\" width=\"120\">
					<table border=0 cellpadding=0 cellspacing=1>
					<tr>
					<td>
						<a href=\"modules.php?name=".$module_name."&func=ver&id=$id&clave=$clave\">
						<img src=$imagen width=\"120\" height=\"90\" border=1 style=\"BORDER-COLOR: #FFFFFF; BORDER-STYLE: solid; alt=\"$titulo\">
						</a>
					</td>
					</tr>
					</table>
			</td>";
			}
			
			echo "<td valign=\"top\" width=\"100%\">"
				. "<table border=0 cellpadding=0 cellspacing=1 width=98% align=\"center\">"
				. "<tr><td><a href=\"modules.php?name=".$module_name."&func=ver&id=$id&clave=$clave\"><u><b>$titulo</b></u></a></td></tr>"
				. "<tr><td></td></tr>"
				. "<tr><td>$description</td></tr>"
				. "<tr><td>"._YOU_TAGS.": $tags3</td></tr>"
				."</table>"
			."</td>"
			."<td valign=\"top\" width=\"120\">"				
				. "<table border=0 cellpadding=0 cellspacing=5 width=98% align=\"center\">";
				
				if($mostrar_datos_b==1){
				echo "<tr><td nowrap><b>"._YOU_ENVIADO.":</b></td><td>$autor</td></tr>"
				. "<tr><td nowrap><b>"._YOU_ENVIADO3."</b></td><td>$anadido</td></tr>"
				. "<tr><td nowrap><b>"._YOU_VISTAS.":</b></td><td>$vistas</td></tr>"
				. "<tr><td nowrap><b>"._YOU_NOTA.":</b></td><td>$votos_m</td></tr>"
				. "<tr><td nowrap><b>"._YOU_VOTOS.":</b></td><td>$votos</td></tr>"
				. "<tr><td nowrap><b>"._YOU_DURACION.":</b></td><td>$duracion</td></tr>";
				}
				if($user_send==1){
				echo "<tr><td colspan=\"2\" nowrap><a href=\"modules.php?name=".$module_name."&func=anadir&yid=$id\">"._YOU_ANADIR."</a></td></tr>";
				}else{
					if(is_admin($admin)){
					echo "<tr><td colspan=\"2\" nowrap><a href=\"modules.php?name=".$module_name."&func=anadir&yid=$id\">"._YOU_ANADIR."</a></td></tr>";
					}
				}
					if($desc_b==1){
					echo "<tr><td colspan=\"2\"><a href=\"http://www.youtube.com/get_video.php?video_id=".$id."&t=".getHeaders($id)."\">".YOU_DESCARGAR."</a></td></tr>";
					}
				echo "</table>"
			. "</td>"
		. "</tr>"
		."<tr><td bgcolor=\"$bgcolor2\" colspan=\"3\"></td></tr>";
	}	
}
		echo "</table>";
		
CloseTable();

//PAGINACION
	$paginas = explode("<total>", $codigo);
	$paginas = $paginas[1];
	$paginas = explode("</total>", $paginas);
	$paginas = $paginas[0];
	if($paginas>=1000){
	$paginas=1000;
	}
	$paginas = ceil($paginas/$perpage);
$pagina_ant = $pagina-1;
$pagina_sig = $pagina+1;
	OpenTable();
	if($hay==1){
		echo "<table align=\"center\" cellpadding=\"5\" cellspacing=\"0\">";
		echo "<tr>";
		if($pagina_ant!=0){
		echo "<td><a href=\"modules.php?name=".$module_name."&func=buscatube&clave=$clave&pagina=$pagina_ant\"><<</a></td>";
		}
		echo "<td>"._YOU_PAGINA." $pagina "._YOU_PAGINA2." $paginas</td>";
		if($pagina_sig<=$paginas){
		echo "<td><a href=\"modules.php?name=".$module_name."&func=buscatube&clave=$clave&pagina=$pagina_sig\">>></a></td>";
		}
		echo "</tr>";
		echo "</table>";
	}else{
	echo "<br><center><i><b>"._YOU_ERROR2."</b></i></center><br>";
	}
	CloseTable();

}
	include("footer.php");
}


function ver($id, $clave){
global $admin, $module_name, $dev_id, $user_send, $vancho, $valto, $vcolor, $vrel, $desc_b, $mostrar_datos_v;

$url = "http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=$dev_id&video_id=$id";
$codigo = file_get_contents("$url");

	//TITULO
	$titulo = explode("<title>", $codigo);
	$titulo = $titulo[1];
	$titulo = explode("</title>", $titulo);
	$titulo = $titulo[0];
	#$titulo = iconv("UTF-8","ISO-8859-1",$titulo);
	//DESCRIPCION
	$description = explode("<description>", $codigo);
	$description = $description[1];
	$description = explode("</description>", $description);
	$description = $description[0];
	#$description = iconv("UTF-8","ISO-8859-1",$description);
	//AUTOR
	$autor = explode("<author>", $codigo);
	$autor = $autor[1];
	$autor = explode("</author>", $autor);
	$autor = $autor[0];
	//DURACION
	$duracion = explode("<length_seconds>", $codigo);
	$duracion = $duracion[1];
	$duracion = explode("</length_seconds>", $duracion);
	$duracion = $duracion[0];
	$minutos = intval($duracion/60);
	$minutos_length = strlen($minutos);
	if($minutos_length==1){ $minutos="0$minutos"; }
	$minutos2 = $duracion-($minutos*60);
	$minutos_length2 = strlen($minutos2);
	if($minutos_length2==1){ $minutos2="0$minutos2"; }
	$duracion = "$minutos:$minutos2";
	//VISTAS
	$vistas = explode("<view_count>", $codigo);
	$vistas = $vistas[1];
	$vistas = explode("</view_count>", $vistas);
	$vistas = $vistas[0];
	//VOTOS
	$votos = explode("<rating_count>", $codigo);
	$votos = $votos[1];
	$votos = explode("</rating_count>", $votos);
	$votos = $votos[0];
	//VOTOS_MEDIA
	$votos_m = explode("<rating_avg>", $codigo);
	$votos_m = $votos_m[1];
	$votos_m = explode("</rating_avg>", $votos_m);
	$votos_m = $votos_m[0];
	//AÑADIDO
	$anadido = explode("<upload_time>", $codigo);
	$anadido = $anadido[1];
	$anadido = explode("</upload_time>", $anadido);
	$anadido = $anadido[0];
	$anadido = strftime("%d/%m/%Y", $anadido);
	
	include ("header.php");
		
	menu();
		
	//VIDEO
	OpenTable();
	echo "<table width=\"100%\" align=\"center\">"
	. "<tr><td align=\"center\">";
	
	if($vcolor==1){ $colorv = "&color1=0xd6d6d6&color2=0xf0f0f0"; }
	if($vcolor==2){ $colorv = "&color1=0x3a3a3a&color2=0x999999"; }
	if($vcolor==3){ $colorv = "&color1=0x2b405b&color2=0x6b8ab6"; }
	if($vcolor==4){ $colorv = "&color1=0x006699&color2=0x54abd6"; }
	if($vcolor==5){ $colorv = "&color1=0x234900&color2=0x4e9e00"; }
	if($vcolor==6){ $colorv = "&color1=0xe1600f&color2=0xfebd01"; }
	if($vcolor==7){ $colorv = "&color1=0xcc2550&color2=0xe87a9f"; }
	if($vcolor==8){ $colorv = "&color1=0x402061&color2=0x9461ca"; }
	if($vcolor==9){ $colorv = "&color1=0x5d1719&color2=0xcd311b"; }
	
	echo '<object width="'.$vancho.'" height="'.$valto.'">
	<param name="movie" value="http://www.youtube.com/v/'.$id.'&rel='.$vrel.''.$colorv.'"></param>
	<param name="wmode" value="transparent"></param>
	<embed src="http://www.youtube.com/v/'.$id.'&rel='.$vrel.''.$colorv.'" type="application/x-shockwave-flash" wmode="transparent" width="'.$vancho.'" height="'.$valto.'"></embed>
	</object>';
	
	echo "<br>";
	
		if($user_send==1){
		echo "[ <a href=\"modules.php?name=".$module_name."&func=anadir&yid=$id\">"._YOU_ANADIR."</a> ]";
		}else{
			if(is_admin($admin)){
			echo "[ <a href=\"modules.php?name=".$module_name."&func=anadir&yid=$id\">"._YOU_ANADIR."</a> ]";
			}
		}

		if($desc_b==1){
		echo " [ <a href=\"http://www.youtube.com/get_video.php?video_id=".$id."&t=".getHeaders($id)."\">".YOU_DESCARGAR."</a> ]";
		}
		
	echo "</td></tr>"
	. "</table>";	
	CloseTable();

	OpenTable();
echo "<table align=\"center\">";
echo "<tr><td width=\"100%\" valign=\"top\">";
	echo "<b>$titulo</b><br><br>";
	echo "$description<br>";
echo "</td>";

if($mostrar_datos_v==1){
echo "<td>";
	echo "<table align=\"center\" cellpadding=\"5\">";
	echo "<tr><td nowrap><b>"._YOU_DURACION."</b></td><td>$duracion</td></tr>";
	echo "<tr><td nowrap><b>"._YOU_ENVIADO."</b></td><td>$autor</td></tr>";
	echo "<tr><td nowrap><b>"._YOU_ENVIADO3."</b></td><td>$anadido</td></tr>";
	echo "<tr><td nowrap><b>"._YOU_VISTAS."</b></td><td>$vistas</td></tr>";
	echo "<tr><td nowrap><b>"._YOU_NOTA."</b></td><td>$votos_m</td></tr>";
	echo "<tr><td nowrap><b>"._YOU_VOTOS."</b></td><td>$votos</td></tr>";
	echo "</table>";
echo "</td>";
}

echo "</tr>";
echo "</table>";	
	CloseTable();

	include("footer.php");
}

function getHeaders($v) {
	$host = "www.youtube.com";
	$url = "/v/".$v;
	$session = "";
	$fp = fsockopen ($host, 80, $errno, $errstr, 45);
	if ($fp) {
		fputs ($fp, "GET $url HTTP/1.0\r\n\r\n");
		while (!feof($fp)) {
			$char = fgetc($fp);
			if($char === "\n") {
				if (ord($header) === 13) { 
					return($session);
				} else {
					$arrValue = split(": ", trim($header));
					if ($arrValue[0] == "Location") {
						parse_str($arrValue[1], $getvars);
						$session = $getvars['t'];
					}
				}
				unset($header);
			} else { 
				$header = $header.$char;
			}
		}
		fclose ($fp);
	}
}

function menu(){
global $user, $module_name, $user_send, $comment_activo, $tipo_logo, $como_anadir, $clave;

	OpenTable();
	echo "<center>";
	if($tipo_logo==1){
	echo "<img src=\"modules/".$module_name."/images/logo.gif\">";
	}else{
	echo "<img src=\"modules/".$module_name."/images/logo_trans.gif\">";
	}
	echo "</center>";

	echo "<table width=\"98%\" align=\"center\">";
	echo "<tr><td align=\"center\">";
	echo "<a href=\"modules.php?name=".$module_name."\">"._YOU_MENU1."</a> | <a href=\"modules.php?name=".$module_name."&func=buscatube\">"._YOU_MENU2."</a>";
		if(is_user($user) AND $user_send==1 AND $como_anadir==1){
		echo " | <a href=\"modules.php?name=".$module_name."&func=anadir2\">"._YOU_MENU3."</a>";
		}
		if(is_user($user) AND $user_send==1){
		echo " | <a href=\"modules.php?name=".$module_name."&func=tus_videos\">"._YOU_MENU4."</a>";
		}
	echo "</td></tr>";
	echo "<tr><td align=\"center\">";
	echo "<a href=\"modules.php?name=".$module_name."&func=ver_todos&orden=last\">"._YOU_MENU5."</a>";
	echo " | <a href=\"modules.php?name=".$module_name."&func=ver_todos&orden=top\">"._YOU_MENU6."</a>";
	if($comment_activo==1){
	echo " | <a href=\"modules.php?name=".$module_name."&func=ult_com\">"._YOU_MENU7."</a>";
	}
	echo "</td></tr>";
	echo "</table>";

	//BUSCADOR
	echo "<table width=\"100%\" align=\"center\">"
	. "<tr><td align=\"center\">"
		. "<form method=\"post\" action=\"modules.php?name=".$module_name."&func=buscatube\">"
		. "<input type=\"text\" name=\"clave\" value=\"$clave\" size=\"50\">"
		. "<input type=\"submit\" value=\""._YOU_BUSCAR."\">"
	. "</td></tr>"
	. "</form>"
	. "</table>";	
	CloseTable();	
}

switch($func) {

    default:
    index();
    break;
	
	case "ver_videos":
	ver_videos($cid, $pagina);
	break;
	
	case "ver_todos":
	ver_todos($pagina, $orden);
	break;
	
	case "ult_com":
	ult_com($pagina);
	break;

	case "ver_video":
	ver_video($vid);
	break;
	
	case "tus_videos":
	tus_videos($pagina);
	break;
	
	case "anadir":
	anadir($ok, $yid, $cid, $titulo, $descripcion, $url);
	break;
	
	case "anadir2":
	anadir2($ok, $url, $cid, $titulo, $descripcion, $url);
	break;
	
	case "guardar_comentario":
	guardar_comentario($comentario, $vid);
	break;
	
	case "borrar_comentario":
	borrar_comentario($vid, $cid);
	break;
	
	case "config":
	config();
	break;
	
	case "menu":
	menu();
	break;
	
	case "editar":
	editar($vid, $titulo, $cid, $descripcion, $url, $enviar);
	break;

    case "ver":
    ver($id, $clave);
    break;

    case "getHeaders":
    getHeaders($v);
    break;

    case "buscatube":
    buscatube($clave, $pagina);
    break;
}

?>