<?php
###############################################################
# X1plugin Competition Management
# Author::Emerica
# Homepage::http://www.projectxnetwork.com
# Admin Panel Version 2.5.5
###########################################
# line 6 _delete dupe fixed
# line 137 _comments dupe fixed
# syswide removed
#
#
###########################################
#Main Administration Panel
define('XL_admin_title', "Administraci�n del plugin");
define('XL_tab_help', ' Ayuda');
define('XL_tab_games', ' Juegos');
define('XL_tab_events', ' Competiciones');
define('XL_tab_maps', ' Mapas');
define('XL_tab_teams', ' Clanes');
define('XL_tab_challenges', ' Retos');
define('XL_tab_matches', ' Partidos');
define('XL_tab_disputes', ' Disputas');
define('XL_tab_config', ' Configuraci�n');

###########################################
#Games Administration Panel
define('XL_agames_add', 'A�adir juegos');
define('XL_agames_id', 'Id');
define('XL_agames_name', 'Nombre');
define('XL_agames_pic', 'Im�gen');
define('XL_agames_desc', 'Descripci�n');
define('XL_agames_none', 'A�n no se han creado juegos en la base de datos.');
define('XL_agames_selectimage', 'Selecciona una im�gen');
define('XL_agames_preview', 'Vista previa de la im�gen');
define('XL_agames_updated', 'Juegos actualizados.');
define('XL_agames_added', ' entradas en blanco de juegos han sido a�adidas');

###########################################
#Ladder ADministration Panel
define('XL_aevents_add', 'A�adir nuevas competiciones');
define('XL_aevents_fixrungs', 'Corregir posiciones de los equipos');
define('XL_aevents_new', 'A�adir nueva competici�n');
define('XL_aevents_hid', 'Id');
define('XL_aevents_hname', 'Nombre de la competici�n');
define('XL_aevents_hgame', 'Juego');
define('XL_aevents_hmod', 'Tipo de competici�n');
define('XL_aevents_hactive', 'Activa');
define('XL_aevents_henabled', 'Activada');
define('XL_aevents_hmodify', 'Modificar');
define('XL_aevents_none', 'No se ha creado ninguna competici�n');

###########################################

define('XL_aevents_general', 'Opciones generales');
define('XL_aevents_name', 'Nombre de la competici�n');
define('XL_aevents_game', 'Juego');
define('XL_aevents_mod', 'Tipo de competici�n');
define('XL_aevents_sort', 'Tipo de ordenaci�n');
define('XL_aevents_lex1', 'Campo Extra 1 (lex1)');
define('XL_aevents_lex2', 'Campo Extra 2 (lex2)');
define('XL_aevents_options', 'Opciones y configuraci�n de la competici�n');
define('XL_aevents_active', 'Competici�n activada');
define('XL_aevents_enabled', 'Retos activados');
define('XL_aevents_simchall', 'N�mero de retos simultaneos permitidos');
define('XL_aevents_maxgames', 'M�ximos Juegos/D�a');
define('XL_aevents_maxteams', 'N�mero m�ximo de Clanes');
define('XL_aevents_minplayers', 'N�mero m�nimo de jugadores en el roster');
define('XL_aevents_maxplayers', 'N�mero m�ximo de jugadores');
define('XL_aevents_challdate', 'Opciones de fecha en los retos');
define('XL_aevents_resdates', 'Restringir selecci�n simultanea de fechas');
define('XL_aevents_dropdates', 'N�mero de d�as que se muestran en el desplegable de selecci�n de fecha');
define('XL_aevents_numdates', 'N�mero de desplegables para seleccionar fechas');
define('XL_aevents_timezone', 'Zona horaria');
define('XL_aevents_mapoptions', 'Opciones de mapas en los retos');
define('XL_aevents_resmaps', 'Restringir selecci�n simultanea de mapas');
define('XL_aevents_nummaps1', 'N�mero de mapas seleccionables por el Clan retante.  1-10');
define('XL_aevents_nummaps2', 'N�mero de mapas seleccionables por el Clan retado.  1-10');
define('XL_aevents_pointoptions', 'Opciones de puntuaci�n');
define('XL_aevents_win', 'Puntos ganados por una victoria');
define('XL_aevents_loss', 'Puntos ganados por una derrota');
define('XL_aevents_draw', 'Puntos ganados por un empate');
define('XL_aevents_declinedchall', 'Puntos perdidos por rechazar un reto');
define('XL_aevents_description', 'Introduce una descripci�n para la competici�n.');
define('XL_aevents_rules', 'Introduce tus reglas, puedes incluir Html b�sico.');
define('XL_aevents_notes', 'Introduce cualquier nota que desees, puedes incluir Html b�sico.');
define('XL_aevents_change', 'Modificar competici�n');
define('XL_aevents_post', 'Crear competici�n');
define('XL_aevents_added', 'Competici�n a�adida');
define('XL_aevents_editing', 'Editar la competici�n :: ');
define('XL_aevents_removed', 'Eliminaci�n completada.No hay vuelta atr�s.');
define('XL_aevents_removewarning', 'ATENCI�N, esto eliminar� la competici�n y todos los elementos extra que has seleccionado eliminar, �est�s completamente seguro de ello?');
define('XL_aevents_updated', 'Competici�n actualizada');
define('XL_aevents_fixed', 'Posiciones corregidas para la competici�n con Id:');
define('XL_aevents_expireoptions', 'Opciones de expiraci�n en los retos');
define('XL_aevents_enableexpires', 'Permitir que los retos expiren');
define('XL_aevents_expirehours', 'Horas despu�s de las que expiran');
define('XL_aevents_expirepenalty', 'Penalizaci�n por no aceptar el reto (puntos)');
define('XL_aevents_expirebonus', 'Bono para el Clan retante (puntos)');

define('XL_aevents_reportoptions', 'Opciones de confirmaci�n para los resultados de los Retos');
define('XL_aevents_whoreports', '�Qui�n debe confirmar el resultado del partido?');
#Translate
define('XL_aevents_winner', 'Winner Reports');
define('XL_aevents_loser', 'Loser Reports');

###########################################
#Matches ADministration Panel
define('XL_amatches_createtitle', 'Crear un partido jugado');
define('XL_amatches_winner', 'Vencedor');
define('XL_amatches_selwinner', 'Selecciona vencedor');
define('XL_amatches_loser', 'Perdedor');
define('XL_amatches_selloser', 'Selecciona perdedor');
define('XL_amatches_seldate', 'Selecciona d�a y hora en la que se jug� el partido');
define('XL_amatches_dateformat', 'Formato: MES:DIA:A�O  EJ: 08:29:1982');
define('XL_amatches_winnermaps', 'Selecciona los mapas del vencedor (Primera selecci�n)');
define('XL_amatches_winnerscore', 'Puntuaci�n del vencedor');
define('XL_amatches_loserscore', 'Puntuaci�n del perdedor');
define('XL_amatches_losermaps', 'Selecciona los mapas del perdedor (Segunda selecci�n)');
define('XL_amatches_extras', 'Extras y comentarios');
define('XL_amatches_screenshot', 'Enlace de la Screenshot(dejar en blanco si no hay)');
define('XL_amatches_demo', 'Enlace de la Demo (dejar en blanco si no hay)');
define('XL_amatches_comments', 'Comentarios - 255 caracteres m�ximo Max');
define('XL_amatches_addmatch', 'A�adir partido');
define('XL_amatches_errnowinner', 'Lo siento, el vencedor no puede estar en blanco');
define('XL_amatches_errnoloser', 'Lo siento, el perdedor no puede estar en blanco');
define('XL_amatches_errsameteams', 'Lo siento, no puedes crear un partido jugado contra el mismo equipo');
define('XL_amatches_added', 'Nuevo partido a�adido a la base de datos');
define('XL_amatches_addrecord', 'A�adir nuevo registro de un partido jugado');
define('XL_amatches_hid', 'Id');
define('XL_amatches_hevent', 'Competici�n');
define('XL_amatches_hwinner', 'Vencedor');
define('XL_amatches_hloser', 'Perdedor');
define('XL_amatches_hdate', 'Fecha');
define('XL_amatches_hmodify', 'Modificar');
define('XL_amatches_none', 'No se ha jugado ning�n partido todav�a');
define('XL_amatches_matchadmin', 'Administraci�n de partidos');
define('XL_amatches_monifymatch', 'Modificar partido :: ');
define('XL_amatches_gameid', 'ID del juego');
define('XL_amatches_dateentry', 'Fecha');
define('XL_amatches_maparray1', 'Primer mapa');
define('XL_amatches_maparray2', 'Segundo mapa');
define('XL_amatches_selmaparray', 'Array de selecci�n de mapas');
define('XL_amatches_winnerscorearray1', 'Array del Map1 de la puntuaci�n del vencedor');
define('XL_amatches_loserscorearray1', 'Array del Map1 de la puntuaci�n del perdedor');
define('XL_amatches_winnerscorearray2', 'Array del Map2 de la puntuaci�n del vencedor');
define('XL_amatches_loserscorearray2', 'Array del Map2 de la puntuaci�n del perdedor');
define('XL_amatches_screenshot1', 'Screenshot 1');
define('XL_amatches_screenshot2', 'Screenshot 2');
define('XL_amatches_eventid', 'Id de la competici�n');
define('XL_amatches_demolink', 'Enlace de la demo');
define('XL_amatches_nomatch', 'No se encuentra el partido, o la competici�n ha sido eliminada');
define('XL_amatches_updated', 'Partido actualizado');
define('XL_amatches_draw', 'El partido acab� en empate');
define('XL_amatches_hdraw', 'Empate');
define('XL_amatches_modifymatch', "Modificar este partido");
###########################################
#Teams ADministration Panel
#Translate
define('XL_ateams_editglobal', 'Editar el perfil del Clan');
define('XL_ateams_editevent', 'Editar las puntuaciones y resultados en las competiciones del Clan');
define('XL_ateams_teamadmin', 'Administraci�n de Clanes de la competici�n');
define('XL_ateams_editteam', 'Modificar el Clan: ');
define('XL_ateams_eventname', 'Nombre de la competici�n');
define('XL_ateams_id', 'ID del Clan');
define('XL_ateams_name', 'Nombre del Clan');
define('XL_ateams_password', 'Contrase�a');
define('XL_ateams_email', 'Email');
define('XL_ateams_country', 'Pa�s');
define('XL_ateams_rung', 'Posici�n');
define('XL_ateams_games', 'Juegos');
define('XL_ateams_wins', 'Victorias');
define('XL_ateams_losses', 'Derrotas');
define('XL_ateams_draws', 'Empates');
define('XL_ateams_points', 'Puntuaci�n');
define('XL_ateams_twins', 'Victorias totales');
define('XL_ateams_tlosses', 'Derrotas totales');
define('XL_ateams_tgames', 'Partidos totales');
define('XL_ateams_tpoints', 'Puntuaci�n total');
define('XL_ateams_penalties', 'Penalizaciones');
define('XL_ateams_swins', 'Tendencia de victorias');
define('XL_ateams_slosses', 'Tendencia de derrotas');
define('XL_ateams_rest', 'Inactivo');
define('XL_ateams_status', 'Estado');
define('XL_ateams_challyesno', 'ChallYesNo');
define('XL_ateams_clantags', 'Tags del Clan');
define('XL_ateams_homepage', 'P�gina web');
define('XL_ateams_logo', 'Logo');
define('XL_ateams_none', 'Clan no encontrado');
define('XL_ateams_teamupdated', 'Clan actualizado');
define('XL_ateams_captain', 'Capit�n');
define('XL_ateams_profile', 'Perfil');
define('XL_ateams_challenged', 'Retado');
define('XL_ateams_ircserver', 'Servidor IRC');
define('XL_ateams_ircchannel', 'Canal IRC');
define('XL_ateams_joinpassword', 'Contrase�a para ingresar al Clan');
#2.5.4
define('XL_ateams_updatemain', 'Update Main Team Table');
###########################################
#Teams ADministration Panel
define('XL_amaps_add', 'A�adir nuevos mapas');
define('XL_amaps_id', 'Id');
define('XL_amaps_name', 'Nombre del mapa');
define('XL_amaps_picture', 'Im�gen del mapa');
define('XL_amaps_event', 'Competici�n');
define('XL_amaps_download', 'Enlace de descarga');
define('XL_amaps_none', 'No has a�adido ning�n mapa');
define('XL_amaps_updated', 'Mapas actualizados');
define('XL_amaps_added', ' mapas han sido a�adidos');

###########################################
#Config Administration Panel
define('XL_aconfig_configfile', 'El archivo de configuraci�n es : ');
define('XL_aconfig_notwritable', 'No escribible');
define('XL_aconfig_writable', 'Escribible');
define('XL_aconfig_error', 'Lo siento, imposible actualizar el archivo de configuraci�n. Debes actualizar los permisos del archivo a escribible.');
define('XL_aconfig_updated', 'Se ha actualizado existosamente el archivo de configuraci�n.');

###########################################
#Challengeds Administration Panel
define('XL_achallenges_title','Administraci�n de Retos');
define('XL_achallenges_id','Id');
define('XL_achallenges_challenger','Retante');
define('XL_achallenges_challenged','Retado');
define('XL_achallenges_date','Fecha');
define('XL_achallenges_modify','Modificar');
define('XL_achallenges_delete','Eliminar');
define('XL_achallenges_create','Crear un reto en la competici�n');
define('XL_achallenges_selchallenger','Seleccionar Retante');
define('XL_achallenges_selchallenged','Seleccionar Retado');
define('XL_achallenges_extended','Extras y comentarios');
define('XL_achallenges_add','A�adir reto');
define('XL_achallenges_errblankteam1','Lo siento, el Clan retante no puede estar en blanco');
define('XL_achallenges_errblankteam2','Lo siento, el Clan retado no puede estar en blanco');
define('XL_achallenges_errsameteams','Lo siento, no puedes crear un reto con el mismo Clan');
define('XL_achallenges_added','Reto a�adido a la base de datos');
define('XL_achallenges_editchallenge','Editar un reto de la competici�n');
define('XL_achallenges_maps1','Seleccionar mapas del retante (Primera selecci�n)');
define('XL_achallenges_maps2','Seleccionar mapas del retado (Segunda selecci�n)');
define('XL_achallenges_eventid','Id de la competici�n');
define('XL_achallenges_matchdate','Fecha del partido');
define('XL_achallenges_randid','Id aleatoria');
define('XL_achallenges_setdate','Establecer fecha');
define('XL_achallenges_extra1','Extra 1 - 255 caracteres m�ximo');
define('XL_achallenges_extra2','Extra 2 - 255 caracteres m�ximo');
define('XL_achallenges_comments','Comentarios - 255 caracteres m�ximo');
define('XL_achallenges_update','Actualizar reto');
define('XL_achallenges_editunconfirmed','Editar un reto no confirmado de la competici�n:');
define('XL_achallenges_dt1','Fecha /Hora 1');
define('XL_achallenges_dt2','Fecha /Hora 2');
define('XL_achallenges_dt3','Fecha /Hora 3');
define('XL_achallenges_updated','Reto actualizado');
define('XL_achallenges_deleted','Reto eliminado');
#Translate
define('XL_achallenges_confirmed', 'Un-confirmed challenges on ladder:');
define('XL_achallenges_unconfirmed', 'Confirmed challenges on ladder');
define('XL_achallenges_none', 'There are no challenges on this event');

###########################################
#Disputes Administration Panel
define('XL_adisputes_id','Id');
define('XL_adisputes_sender','Enviado por');
define('XL_adisputes_offender','Ofensor/implicado');
define('XL_adisputes_event','Nombre de la competici�n');
define('XL_adisputes_date','Fecha');
define('XL_adisputes_view', 'Ver');
define('XL_adisputes_delete','Eliminar');
define('XL_adisputes_comments','Comentarios:');
define('XL_adisputes_none','No se ha comunicado ninguna disputa');

?>