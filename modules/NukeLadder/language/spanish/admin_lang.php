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
define('XL_admin_title', "Administración del plugin");
define('XL_tab_help', ' Ayuda');
define('XL_tab_games', ' Juegos');
define('XL_tab_events', ' Competiciones');
define('XL_tab_maps', ' Mapas');
define('XL_tab_teams', ' Clanes');
define('XL_tab_challenges', ' Retos');
define('XL_tab_matches', ' Partidos');
define('XL_tab_disputes', ' Disputas');
define('XL_tab_config', ' Configuración');

###########################################
#Games Administration Panel
define('XL_agames_add', 'Añadir juegos');
define('XL_agames_id', 'Id');
define('XL_agames_name', 'Nombre');
define('XL_agames_pic', 'Imágen');
define('XL_agames_desc', 'Descripción');
define('XL_agames_none', 'Aún no se han creado juegos en la base de datos.');
define('XL_agames_selectimage', 'Selecciona una imágen');
define('XL_agames_preview', 'Vista previa de la imágen');
define('XL_agames_updated', 'Juegos actualizados.');
define('XL_agames_added', ' entradas en blanco de juegos han sido añadidas');

###########################################
#Ladder ADministration Panel
define('XL_aevents_add', 'Añadir nuevas competiciones');
define('XL_aevents_fixrungs', 'Corregir posiciones de los equipos');
define('XL_aevents_new', 'Añadir nueva competición');
define('XL_aevents_hid', 'Id');
define('XL_aevents_hname', 'Nombre de la competición');
define('XL_aevents_hgame', 'Juego');
define('XL_aevents_hmod', 'Tipo de competición');
define('XL_aevents_hactive', 'Activa');
define('XL_aevents_henabled', 'Activada');
define('XL_aevents_hmodify', 'Modificar');
define('XL_aevents_none', 'No se ha creado ninguna competición');

###########################################

define('XL_aevents_general', 'Opciones generales');
define('XL_aevents_name', 'Nombre de la competición');
define('XL_aevents_game', 'Juego');
define('XL_aevents_mod', 'Tipo de competición');
define('XL_aevents_sort', 'Tipo de ordenación');
define('XL_aevents_lex1', 'Campo Extra 1 (lex1)');
define('XL_aevents_lex2', 'Campo Extra 2 (lex2)');
define('XL_aevents_options', 'Opciones y configuración de la competición');
define('XL_aevents_active', 'Competición activada');
define('XL_aevents_enabled', 'Retos activados');
define('XL_aevents_simchall', 'Número de retos simultaneos permitidos');
define('XL_aevents_maxgames', 'Máximos Juegos/Día');
define('XL_aevents_maxteams', 'Número máximo de Clanes');
define('XL_aevents_minplayers', 'Número mínimo de jugadores en el roster');
define('XL_aevents_maxplayers', 'Número máximo de jugadores');
define('XL_aevents_challdate', 'Opciones de fecha en los retos');
define('XL_aevents_resdates', 'Restringir selección simultanea de fechas');
define('XL_aevents_dropdates', 'Número de días que se muestran en el desplegable de selección de fecha');
define('XL_aevents_numdates', 'Número de desplegables para seleccionar fechas');
define('XL_aevents_timezone', 'Zona horaria');
define('XL_aevents_mapoptions', 'Opciones de mapas en los retos');
define('XL_aevents_resmaps', 'Restringir selección simultanea de mapas');
define('XL_aevents_nummaps1', 'Número de mapas seleccionables por el Clan retante.  1-10');
define('XL_aevents_nummaps2', 'Número de mapas seleccionables por el Clan retado.  1-10');
define('XL_aevents_pointoptions', 'Opciones de puntuación');
define('XL_aevents_win', 'Puntos ganados por una victoria');
define('XL_aevents_loss', 'Puntos ganados por una derrota');
define('XL_aevents_draw', 'Puntos ganados por un empate');
define('XL_aevents_declinedchall', 'Puntos perdidos por rechazar un reto');
define('XL_aevents_description', 'Introduce una descripción para la competición.');
define('XL_aevents_rules', 'Introduce tus reglas, puedes incluir Html básico.');
define('XL_aevents_notes', 'Introduce cualquier nota que desees, puedes incluir Html básico.');
define('XL_aevents_change', 'Modificar competición');
define('XL_aevents_post', 'Crear competición');
define('XL_aevents_added', 'Competición añadida');
define('XL_aevents_editing', 'Editar la competición :: ');
define('XL_aevents_removed', 'Eliminación completada.No hay vuelta atrás.');
define('XL_aevents_removewarning', 'ATENCIÓN, esto eliminará la competición y todos los elementos extra que has seleccionado eliminar, ¿estás completamente seguro de ello?');
define('XL_aevents_updated', 'Competición actualizada');
define('XL_aevents_fixed', 'Posiciones corregidas para la competición con Id:');
define('XL_aevents_expireoptions', 'Opciones de expiración en los retos');
define('XL_aevents_enableexpires', 'Permitir que los retos expiren');
define('XL_aevents_expirehours', 'Horas después de las que expiran');
define('XL_aevents_expirepenalty', 'Penalización por no aceptar el reto (puntos)');
define('XL_aevents_expirebonus', 'Bono para el Clan retante (puntos)');

define('XL_aevents_reportoptions', 'Opciones de confirmación para los resultados de los Retos');
define('XL_aevents_whoreports', '¿Quién debe confirmar el resultado del partido?');
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
define('XL_amatches_seldate', 'Selecciona día y hora en la que se jugó el partido');
define('XL_amatches_dateformat', 'Formato: MES:DIA:AÑO  EJ: 08:29:1982');
define('XL_amatches_winnermaps', 'Selecciona los mapas del vencedor (Primera selección)');
define('XL_amatches_winnerscore', 'Puntuación del vencedor');
define('XL_amatches_loserscore', 'Puntuación del perdedor');
define('XL_amatches_losermaps', 'Selecciona los mapas del perdedor (Segunda selección)');
define('XL_amatches_extras', 'Extras y comentarios');
define('XL_amatches_screenshot', 'Enlace de la Screenshot(dejar en blanco si no hay)');
define('XL_amatches_demo', 'Enlace de la Demo (dejar en blanco si no hay)');
define('XL_amatches_comments', 'Comentarios - 255 caracteres máximo Max');
define('XL_amatches_addmatch', 'Añadir partido');
define('XL_amatches_errnowinner', 'Lo siento, el vencedor no puede estar en blanco');
define('XL_amatches_errnoloser', 'Lo siento, el perdedor no puede estar en blanco');
define('XL_amatches_errsameteams', 'Lo siento, no puedes crear un partido jugado contra el mismo equipo');
define('XL_amatches_added', 'Nuevo partido añadido a la base de datos');
define('XL_amatches_addrecord', 'Añadir nuevo registro de un partido jugado');
define('XL_amatches_hid', 'Id');
define('XL_amatches_hevent', 'Competición');
define('XL_amatches_hwinner', 'Vencedor');
define('XL_amatches_hloser', 'Perdedor');
define('XL_amatches_hdate', 'Fecha');
define('XL_amatches_hmodify', 'Modificar');
define('XL_amatches_none', 'No se ha jugado ningún partido todavía');
define('XL_amatches_matchadmin', 'Administración de partidos');
define('XL_amatches_monifymatch', 'Modificar partido :: ');
define('XL_amatches_gameid', 'ID del juego');
define('XL_amatches_dateentry', 'Fecha');
define('XL_amatches_maparray1', 'Primer mapa');
define('XL_amatches_maparray2', 'Segundo mapa');
define('XL_amatches_selmaparray', 'Array de selección de mapas');
define('XL_amatches_winnerscorearray1', 'Array del Map1 de la puntuación del vencedor');
define('XL_amatches_loserscorearray1', 'Array del Map1 de la puntuación del perdedor');
define('XL_amatches_winnerscorearray2', 'Array del Map2 de la puntuación del vencedor');
define('XL_amatches_loserscorearray2', 'Array del Map2 de la puntuación del perdedor');
define('XL_amatches_screenshot1', 'Screenshot 1');
define('XL_amatches_screenshot2', 'Screenshot 2');
define('XL_amatches_eventid', 'Id de la competición');
define('XL_amatches_demolink', 'Enlace de la demo');
define('XL_amatches_nomatch', 'No se encuentra el partido, o la competición ha sido eliminada');
define('XL_amatches_updated', 'Partido actualizado');
define('XL_amatches_draw', 'El partido acabó en empate');
define('XL_amatches_hdraw', 'Empate');
define('XL_amatches_modifymatch', "Modificar este partido");
###########################################
#Teams ADministration Panel
#Translate
define('XL_ateams_editglobal', 'Editar el perfil del Clan');
define('XL_ateams_editevent', 'Editar las puntuaciones y resultados en las competiciones del Clan');
define('XL_ateams_teamadmin', 'Administración de Clanes de la competición');
define('XL_ateams_editteam', 'Modificar el Clan: ');
define('XL_ateams_eventname', 'Nombre de la competición');
define('XL_ateams_id', 'ID del Clan');
define('XL_ateams_name', 'Nombre del Clan');
define('XL_ateams_password', 'Contraseña');
define('XL_ateams_email', 'Email');
define('XL_ateams_country', 'País');
define('XL_ateams_rung', 'Posición');
define('XL_ateams_games', 'Juegos');
define('XL_ateams_wins', 'Victorias');
define('XL_ateams_losses', 'Derrotas');
define('XL_ateams_draws', 'Empates');
define('XL_ateams_points', 'Puntuación');
define('XL_ateams_twins', 'Victorias totales');
define('XL_ateams_tlosses', 'Derrotas totales');
define('XL_ateams_tgames', 'Partidos totales');
define('XL_ateams_tpoints', 'Puntuación total');
define('XL_ateams_penalties', 'Penalizaciones');
define('XL_ateams_swins', 'Tendencia de victorias');
define('XL_ateams_slosses', 'Tendencia de derrotas');
define('XL_ateams_rest', 'Inactivo');
define('XL_ateams_status', 'Estado');
define('XL_ateams_challyesno', 'ChallYesNo');
define('XL_ateams_clantags', 'Tags del Clan');
define('XL_ateams_homepage', 'Página web');
define('XL_ateams_logo', 'Logo');
define('XL_ateams_none', 'Clan no encontrado');
define('XL_ateams_teamupdated', 'Clan actualizado');
define('XL_ateams_captain', 'Capitán');
define('XL_ateams_profile', 'Perfil');
define('XL_ateams_challenged', 'Retado');
define('XL_ateams_ircserver', 'Servidor IRC');
define('XL_ateams_ircchannel', 'Canal IRC');
define('XL_ateams_joinpassword', 'Contraseña para ingresar al Clan');
#2.5.4
define('XL_ateams_updatemain', 'Update Main Team Table');
###########################################
#Teams ADministration Panel
define('XL_amaps_add', 'Añadir nuevos mapas');
define('XL_amaps_id', 'Id');
define('XL_amaps_name', 'Nombre del mapa');
define('XL_amaps_picture', 'Imágen del mapa');
define('XL_amaps_event', 'Competición');
define('XL_amaps_download', 'Enlace de descarga');
define('XL_amaps_none', 'No has añadido ningún mapa');
define('XL_amaps_updated', 'Mapas actualizados');
define('XL_amaps_added', ' mapas han sido añadidos');

###########################################
#Config Administration Panel
define('XL_aconfig_configfile', 'El archivo de configuración es : ');
define('XL_aconfig_notwritable', 'No escribible');
define('XL_aconfig_writable', 'Escribible');
define('XL_aconfig_error', 'Lo siento, imposible actualizar el archivo de configuración. Debes actualizar los permisos del archivo a escribible.');
define('XL_aconfig_updated', 'Se ha actualizado existosamente el archivo de configuración.');

###########################################
#Challengeds Administration Panel
define('XL_achallenges_title','Administración de Retos');
define('XL_achallenges_id','Id');
define('XL_achallenges_challenger','Retante');
define('XL_achallenges_challenged','Retado');
define('XL_achallenges_date','Fecha');
define('XL_achallenges_modify','Modificar');
define('XL_achallenges_delete','Eliminar');
define('XL_achallenges_create','Crear un reto en la competición');
define('XL_achallenges_selchallenger','Seleccionar Retante');
define('XL_achallenges_selchallenged','Seleccionar Retado');
define('XL_achallenges_extended','Extras y comentarios');
define('XL_achallenges_add','Añadir reto');
define('XL_achallenges_errblankteam1','Lo siento, el Clan retante no puede estar en blanco');
define('XL_achallenges_errblankteam2','Lo siento, el Clan retado no puede estar en blanco');
define('XL_achallenges_errsameteams','Lo siento, no puedes crear un reto con el mismo Clan');
define('XL_achallenges_added','Reto añadido a la base de datos');
define('XL_achallenges_editchallenge','Editar un reto de la competición');
define('XL_achallenges_maps1','Seleccionar mapas del retante (Primera selección)');
define('XL_achallenges_maps2','Seleccionar mapas del retado (Segunda selección)');
define('XL_achallenges_eventid','Id de la competición');
define('XL_achallenges_matchdate','Fecha del partido');
define('XL_achallenges_randid','Id aleatoria');
define('XL_achallenges_setdate','Establecer fecha');
define('XL_achallenges_extra1','Extra 1 - 255 caracteres máximo');
define('XL_achallenges_extra2','Extra 2 - 255 caracteres máximo');
define('XL_achallenges_comments','Comentarios - 255 caracteres máximo');
define('XL_achallenges_update','Actualizar reto');
define('XL_achallenges_editunconfirmed','Editar un reto no confirmado de la competición:');
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
define('XL_adisputes_event','Nombre de la competición');
define('XL_adisputes_date','Fecha');
define('XL_adisputes_view', 'Ver');
define('XL_adisputes_delete','Eliminar');
define('XL_adisputes_comments','Comentarios:');
define('XL_adisputes_none','No se ha comunicado ninguna disputa');

?>