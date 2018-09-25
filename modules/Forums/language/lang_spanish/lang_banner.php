<?php
/**************************************************************
*
*  MOD Title:   Complete banner
*  MOD Version: 1.1.5
*  Translation: Espa�ol (Spanish)
*  Rev date:    08/12/2003
*
*  Translator:  Venom < eddiebroke@lycos.com > (n/a) n/a
*               Zita
*
***************************************************************/

// �ste es el texto mostrado en panel del administrador, dependiendo de donde piense colocar 
// los banners en su templete, usted podr� cambiar este texto, de tal manera que este refleje 
// el lugar donde colocara los banners dentro de su foro. 
// Estos son s�lo ejemplos basados en la colocaci�n hecha por el autor del mod. 
// Debe definir el n�mero exacto del banner seg�n el lugar donde lo este usando. 

$lang['Banner_spot']['0'] = "Arriba de todos los banners"; // used for {BANNER_0_IMG} tag in the template files 
$lang['Banner_spot']['1'] = "Arriba 1"; // used for {BANNER_1_IMG} tag in the template files 
$lang['Banner_spot']['2'] = "Arriba 2"; // used for {BANNER_2_IMG} tag in the template files 
$lang['Banner_spot']['3'] = "Arriba 3"; // used for {BANNER_3_IMG} tag in the template files 
$lang['Banner_spot']['4'] = "Arriba 4"; // used for {BANNER_4_IMG} tag in the template files 
$lang['Banner_spot']['5'] = "Arriba 5"; // used for {BANNER_5_IMG} tag in the template files 
$lang['Banner_spot']['6'] = "Arriba 6"; // used for {BANNER_6_IMG} tag in the template files 
$lang['Banner_spot']['7'] = "Abajo 1"; // used for {BANNER_7_IMG} tag in the template files 
$lang['Banner_spot']['8'] = "Abajo 2"; // used for {BANNER_8_IMG} tag in the template files 
$lang['Banner_spot']['9'] = "Abajo 3"; // used for {BANNER_9_IMG} tag in the template files 
$lang['Banner_spot']['10'] = "Abajo 4"; // used for {BANNER_10_IMG} tag in the template files 
$lang['Banner_spot']['11'] = "Abajo 5"; // used for {BANNER_11_IMG} tag in the template files 
$lang['Banner_spot']['12'] = "Abajo 6"; // used for {BANNER_12_IMG} tag in the template files 
$lang['Banner_spot']['13'] = "Vista del Foro arriba"; // used for {BANNER_13_IMG} tag in the template files 
$lang['Banner_spot']['14'] = "Vista del tema arriba"; // used for {BANNER_14_IMG} tag in the template files 
$lang['Banner_spot']['15'] = "Vista del tema abajo"; // used for {BANNER_15_IMG} tag in the template files 

// 
// por favor no modifique el texto de abajo (a menos que vaya a traducirlo) 
// 
$lang['Banner_title'] = "Administraci�n de los Banners"; 
$lang['Banner_text'] = "El siguiente formulario, le permitir� cambiar las opciones de los banners que se usan en este sitio, pueden ser definidos con la regla basada en el tiempo de rotaci�n."; 
$lang['Add_new_banner'] = "Nuevo banner"; 
$lang['Banner_add_text'] = "Aqu� puede a�adir/editar un banner"; 

$lang['Banner_name'] = "im�gen"; 
$lang['Banner_name_explain'] = "Ruta dentro de phpBB donde se encuentran los banners o el URL completo"; 
$lang['Banner_activated'] = "Activado"; 
$lang['Banner_activate'] = "Active banner"; 
$lang['Banner_comment'] = "Comentario"; 
$lang['Banner_description'] = "Descripci�n de la im�gen"; 
$lang['Banner_description_explain'] = "Este texto ser� mostrado al pasar el puntero del mouse sobre la im�gen"; 
$lang['Banner_url'] = "URL de la Redirecci�n"; 
$lang['Banner_url_explain'] ="La direcci�n url del sitio a donde ser� redireccionado el visitante al dar click sobre el banner"; 
$lang['Banner_owner']="Moderador de banners"; 
$lang['Banner_owner_explain']="Este usuario puede manejar los banners - (No esta implementado aun)"; 
$lang['Banner_placement'] = "Colocaci�n"; 
$lang['Banner_clicks'] = "Clicks"; 
$lang['Banner_view'] = "Visualizaciones"; 
$lang['Banner_weigth'] = "Peso del banner"; 
$lang['Banner_weigth_explain'] = "Cada cu�nto este banner debe ser mostrado, relativo a otros banners activos en este momento. (1-99)"; 
$lang['Show_to_users'] ='Usuarios a los que se Mostrara'; 
$lang['Show_to_users_explain'] ='Seleccione que tipo de usuarios desea que vean el banner'; 
$lang['Show_to_users_select'] = 'Los usuarios deben ser %s a %s'; //%s are supstituded with dropdown selections 
$lang['Banner_level']['-1'] = 'Visitantes'; 
$lang['Banner_level']['0'] = 'Registrados'; 
$lang['Banner_level']['1'] = 'Moderadores'; 
$lang['Banner_level']['2'] = 'Administrador'; 
$lang['Banner_level_type']['0'] = 'igual'; 
$lang['Banner_level_type']['1'] = 'menor o igual'; 
$lang['Banner_level_type']['2'] = 'mayor o igual'; 
$lang['Banner_level_type']['3'] = 'no'; 

$lang['Time_interval'] = "Intervalo de tiempo"; 
$lang['Time_interval_explain'] = "Apliquese solamente una fecha, un d�a de la semana y/o una hora"; 
$lang['Start'] = "Inicio"; 
$lang['End'] = "Final"; 
$lang['Year'] = "A�o"; 
$lang['Month'] = "Mes"; 
$lang['Date'] = "Fecha"; 
$lang['Weekday'] = "D�a de la semana"; 
$lang['Hour'] = "Hora"; 
$lang['Min'] = "Min"; 
$lang['Time_type'] = "Tipo de tiempo"; 
$lang['Time_type_explain'] = "Seleccione si la informaci�n esta basada en un intervalo de tiempo o intervalo de fecha <i>(puede seguir aplicando un intervalo de tiempo, si selecciona la regla basada en la fecha)</i>"; 
$lang['Not_specify'] = "No Especificado"; 
$lang['No_time'] = "Sin hora"; 
$lang['By_time'] = "Por hora"; 
$lang['By_week'] = "Por d�a de la semana"; 
$lang['By_date'] = "Por fecha"; 

// messages 
$lang['Missing_banner_id'] = "El ID del banner esta extraviado"; 
$lang['Missing_banner_owner'] = "Debe seleccionar un propietario de banner"; 
$lang['Missing_time'] = "Cuando define un banner basado en hora, debe proveer un intervalo de tiempo"; 
$lang['Missing_date'] ="Cuando define un banner basado en la fecha, debe al menos proveer una fecha e intervalo de tiempo"; 
$lang['Missing_week'] ="Cuando define un banner basado en un d�a de la semana, debe al menos de proveer un dia de la semana y un intervalo de tiempo"; 

$lang['Banner_removed'] = "El banner fue borrado de la base de datos"; 
$lang['Banner_updated'] = "El banner ha sido actualizado con exito"; 
$lang['Banner_added'] = "El banner ha sido a�adido a la base de datos"; 
$lang['Click_return_banneradmin'] = 'Click %sAqu�%s para regresar a la Administraci�n de Banners'; 

$lang['No_redirect_error'] = 'De click <b><a href="%s" id="jumplink" name="jumplink">Aqu�<a></b> para ir a la direcci�n de la pagina, en caso de que no se muestre.'; 
$lang['Left_via_banner'] = '';

?> 
