<?php
###############################################################
##X1plugin Competition Management
##File::core-lang.php (spanish)
##File Version::2.5.4
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak
###############################################################
#Syswide 
define('XL_add', 'Añadir');
define('XL_save', 'Guardar');
define('XL_delete', 'Eliminar');
define('XL_edit','Editar');
define('XL_view','Ver');
define('XL_yes','Si');
define('XL_no','No');
define('XL_ok','Ok');
define('XL_na','n/a');
define('XL_missingfile','Error:Archivo perdido o configuración de la variable no definida.');
define('XL_notlogggedin','Error:Por favor, logueate para usar esta función.');
#Translate
define('XL_adminonly','<center>Sorry, Administrators Only.</center>');
###########################################
# Select Boxes
define('XL_select_event','Selecciona Competición');
define('XL_select_team','Selecciona Clan');
define('XL_select_map', 'Selecciona Mapa');
define('XL_select_game','Selecciona Juego');
define('XL_select_user','Selecciona Usuario');

###########################################
# Emails
define('X1_emailsubject','Atención usuario de la competición!');

###########################################
# Core Index Page
define('XL_index_title','Bienvenido a nuestro sitio de Competiciones.');
define('XL_index_none','No se ha creado ningúna competición todavía, intentalo más tarde.');
define('XL_index_mod','Tipo de Competición :: ');
define('XL_index_teams','Clanes actuales :: ');
define('XL_index_matches','Partidos Jugados :: ');
define('XL_index_challenges','Retos confirmados :: ');
#Translate
define('XL_index_image','Image');
define('XL_index_events','Events');
###########################################

# Team Profile Page
define('XL_teamprofile_noteam','El Clan solicitado no ha sido encontrado. Puede que haya sido eliminado o ser un error en la conexión con la base de datos.');
define('XL_teamprofile_noprofile','Este Clan no ha actualizado su perfil todavía');
define('XL_teamprofile_title','Información del Clan: ');
define('XL_teamprofile_tprofile','Perfil');
define('XL_teamprofile_troster','Roster');
define('XL_teamprofile_tevents','Competiciones');
define('XL_teamprofile_thistory','Resultados');
define('XL_teamprofile_logo','Logo del Clan');
define('XL_teamprofile_name','Nombre del Clan');
define('XL_teamprofile_homepage','Página web');
define('XL_teamprofile_location','País');
define('XL_teamprofile_mail','Email del Clan');
define('XL_teamprofile_captain','Capitán');
define('XL_teamprofile_contact','Contacto del Capitán');
define('XL_teamprofile_moto','Eslogan del Clan');
define('XL_teamprofile_report','Informar de este perfil');
define('XL_teamprofile_husername','Nombre de Usuario');
define('XL_teamprofile_hcontact','Contacto');
define('XL_teamprofile_hjoindate','Fecha de ingreso');
define('XL_teamprofile_hextras','SteamId');
define('XL_teamprofile_nomembers','Este Clan no tiene miembros.');
define('XL_teamprofile_hid','Id');
define('XL_teamprofile_hevent','Competición');
define('XL_teamprofile_spacer','|');
define('XL_teamprofile_tgp','TGP');
define('XL_teamprofile_tw','TW');
define('XL_teamprofile_tl','TL');
define('XL_teamprofile_td','TD');
define('XL_teamprofile_tp','TP');
define('XL_teamprofile_gp','GP');
define('XL_teamprofile_w','W');
define('XL_teamprofile_l','L');
define('XL_teamprofile_d','D');
define('XL_teamprofile_p','P');
define('XL_teamprofile_noevents','Este Clan no está en ninguna competición');
define('XL_teamprofile_hwinner','Vencedor');
define('XL_teamprofile_hloser','Perdedor');
define('XL_teamprofile_hdate','Fecha');
define('XL_teamprofile_hdetails','Detalles');
define('XL_teamprofile_details','Detalles');
define('XL_teamprofile_nomatches','Este Clan no ha jugado ningún partido');
define('XL_teamprofile_recruiting','Recruiting:');
###########################################
# Team List Page
define('XL_teamlist_title','Listado de Clanes');
define('XL_teamlist_hcountry','País');
define('XL_teamlist_hname','Nombre');
define('XL_teamlist_hcontact','Contacto');
define('XL_teamlist_hmembers','Miembros');
define('XL_teamlist_hevents','Competiciones');
define('XL_teamlist_recruiting', 'Recruiting');
define('XL_teamlist_prev','Ant');
define('XL_teamlist_next','Sig');
###########################################
# Team Create Page
define('XL_teamcreate_logintocreate','Por favor, logueate para poder crear un Clan');
define('XL_teamcreate_title','Crear nuevo Clan');
define('XL_teamcreate_name','Nombre del Clan');
define('XL_teamcreate_tags','Tags del Clan');
define('XL_teamcreate_email','Email del Clan');
define('XL_teamcreate_homepage','Página web del Clan');
define('XL_teamcreate_pass1','Contraseña del administrador del Clan');
define('XL_teamcreate_pass2','Confirmar la contraseña del administrador del Clan');
define('XL_teamcreate_jpass1','Contraseña para ingresar al Clan');
define('XL_teamcreate_jpass2','Confirmar la contraseña para ingresar al Clan');
define('XL_teamcreate_location','País');
define('XL_teamcreate_newteam','Crear nuevo Clan');
define('XL_teamcreate_blankname','El nombre del Clan no puede estar en blanco');
define('XL_teamcreate_invalidfeed','Caracteres inválidos en el nombre del Clan');
define('XL_teamcreate_blankpass','La contraseña no puede estar en blanco.');
define('XL_teamcreate_dupepass','La contraseña de administrador del Clan no puede ser la misma que la de ingresar al Clan');
define('XL_teamcreate_blankjpass','La contraseña para ingresar al Clan no puede estar en blanco');
define('XL_teamcreate_blankemail','Por favor, introduce una dirección de email');
define('XL_teamcreate_blanktags','Por favor, introduce el Tag del Clan o las iniciales del Clan');
define('XL_teamcreate_passnomatch','Las contraseñas de administrador no concuerdan, por favor confirmalas de nuevo');
define('XL_teamcreate_jpassnomatch','Las contraseñas de ingreso al Clan no concuerdan, por favor confirmalas de nuevo');
define('XL_teamcreate_blankcountry','No has seleccionado el país');
define('XL_teamcreate_toomanyteams','Ya has creado demasiados Clanes');
define('XL_teamcreate_dupeteam','Este Clan ya existe con anterioridad!');
define('XL_teamcreate_created','Clan creado, ahora puedes loguearte.');
define('XL_teamcreate_requestpass','Solicitar contraseña perdida de administración del Clan');
define('XL_teamcreate_sendrequest','Enviar solicitud');
define('XL_teamcreate_emailoff','El envío de emails está desactivado, contacta con un admin para solicitar una nueva contraseña');
define('XL_teamcreate_reset','Contraseña Reseteada');
define('XL_teamcreate_emptyuser','Por favor, Logueate');
define('XL_teamcreate_enteremail', 'Introduce la dirección de email de tu Clan(es)');
define('XL_teamcreate_noteam','No se puede encontrar esa dirección de email');
###########################################

# Team Report Page
define('XL_teamreport_title','Informe del Partido');
define('XL_teamreport_previous','Ver partidos previos');
define('XL_teamreport_event','Nombre de la competición');
define('XL_teamreport_opponent','Nombre del oponente');
define('XL_teamreport_you','Tu Clan');
define('XL_teamreport_mapsandscores','Mapas y puntuaciones');
define('XL_teamreport_comments','Comentarios del partido');
define('XL_teamreport_textarea','Por favor, mantenlo limpio');
define('XL_teamreport_textarea2','255 caracteres max.');
define('XL_teamreport_demolink','Enlace demo o video');
define('XL_teamreport_screenlink1','Enlace screenshot');
define('XL_teamreport_screenlink2','Enlace screenshot');
define('XL_teamreport_report','Informe');
define('XL_teamreport_rules','Reglas ::');
define('XL_teamreport_loss',' Perdido');
define('XL_teamreport_draw','Empatado');
#2.5.4
define('XL_teamreport_win','Win');
#
define('XL_teamreport_blankwinner','Clan desconocido');
define('XL_teamreport_blankloser','Clan desconocido');
define('XL_teamreport_notactive','Esta competición está desactivada');
define('XL_teamreport_disabled','Los retos están desactivados');
define('XL_teamreport_playwithself','Deja de jugar contigo mismo!');
define('XL_teamreport_gamesmaxday','Has jugado demasiados juegos en esta competición hoy');
define('XL_teamreport_emailloss','Derrota registrada');
define('XL_teamreport_emailwin','Victoria registrada');
define('XL_teamreport_emaildraw','Empate registrado');

###########################################

# Team Quit Page
define('XL_teamquit_login','Por favor, logueate para poder abandonar un Clan');
define('XL_teamquit_title','Abandonar un Clan');
define('XL_teamquit_header','Selecciona un Clan del que eliminarte a ti mismo');
define('XL_teamquit_username','Nombre de usuario');
define('XL_teamquit_team','Selecciona Clan');
define('XL_teamquit_button','Abandonar Clan');
define('XL_teamquit_none','No has sido encontrado en este Clan. Puede que ya estés eliminado de él.');
define('XL_teamquit_removed','Has sido eliminado del Clan :');

###########################################

# Player Profile Page
define('XL_playerprofile_title','Perfil del jugador');
define('XL_playerprofile_homepage','Página web:');
define('XL_playerprofile_location','Localidad:');
define('XL_playerprofile_contact','Información de contacto:');
define('XL_playerprofile_reg','Registro:');
define('XL_playerprofile_missing','El jugador ha sido eliminado o has introducido incorrectamente su nombre');
define('XL_playerprofile_id','Id');
define('XL_playerprofile_country','País');
define('XL_playerprofile_team','Clan');
define('XL_playerprofile_tags','Tags');
define('XL_playerprofile_mail','Email del Capitán');
define('XL_playerprofile_none','No hay miembros en este roster');
define('XL_playerprofile_joinedteams','Clanes en los que ha ingresado');
###########################################

# Match History Page
define('XL_matchhistory_title','Resultados de partidos');
define('XL_matchhistory_id','Id');
define('XL_matchhistory_winner','Vencedor');
define('XL_matchhistory_loser','Perdedor');
define('XL_matchhistory_date','Fecha');
define('XL_matchhistory_draw', 'Empate');
define('XL_matchhistory_details','Detalles');
define('XL_matchhistory_button','Ver');
define('XL_matchhistory_none','No hay partidos previos');

###########################################
# Match History Page
define('XL_matchpreview_title','Vista previa de partidos');
define('XL_matchpreview_date','Fecha');
define('XL_matchpreview_challenger','Retante');
define('XL_matchpreview_challenged','Retado');
define('XL_matchpreview_matchdate','Fecha del partido');
define('XL_matchpreview_none','No hay partidos pendientes');

###########################################
# Match Information Page
define('XL_matchinfo_title','Información del partido');
define('XL_matchinfo_nodemo','No hay demo disponible');
define('XL_matchinfo_demo','Descargar demo');
define('XL_matchinfo_event','Competición');
define('XL_matchinfo_winner','Vencedor');
define('XL_matchinfo_loser','Perdedor');
define('XL_matchinfo_date','Fecha');
define('XL_matchinfo_comments','Comentarios');
define('XL_matchinfo_mapimage','Imágen del mapa');
define('XL_matchinfo_mapname','Nombre del mapa');
define('XL_matchinfo_notfound','<center>La Id de este partido ya no existe</center>');
define('XL_matchinfo_screen1','ScreenShot');
define('XL_matchinfo_screen2','ScreenShot');
define('XL_matchinfo_noscreen','No hay ScreenShot disponible');
define('XL_matchinfo_gamewasdraw', 'Este partido se ha declaro empate');
###########################################
# Maps Listing Page
define('XL_maplist_title','Lista de mapas para: ');
define('XL_maplist_image','Imágen del mapa');
define('XL_maplist_name','Nombre');
define('XL_maplist_download','Descargar');
define('XL_maplist_nodownload','No hay descarga disponible');
define('XL_maplist_none','No se han añadido mapas a este evento.');


###########################################
# Event Home Page

#Translate
define('XL_eventhome_viewtitle','Viewing Options');

define('XL_eventhome_mapsbutton','Mapas');
define('XL_eventhome_standingsbutton','Clasificación');
define('XL_eventhome_viewhistory','Resultados');
define('XL_eventhome_newmatches','Partidos pendientes');
define('XL_eventhome_pastmatches','Resultados de partidos');
define('XL_eventhome_settings','Opciones de la competición');
define('XL_eventhome_viewrules', 'Normas/Reglas');

###########################################
# Event Rules Page
define('XL_eventrules_title','Normas/Reglas de la competición.');
define('XL_eventrules_none','No se han puesto aun las reglas, intentalo mas tarde.');


###########################################
# Event Settings
define('XL_eventhome_active','Activa :');
define('XL_eventhome_enabled','Activada :');
define('XL_eventhome_timezone','Zona horaria :');
define('XL_eventhome_numdates','Nº de fechas seleccionables en los retos:');
define('XL_eventhome_dupedates','Fechas duplicadas permitidas :');
define('XL_eventhome_maps1','Mapas seleccionables por el Clan retante :');
define('XL_eventhome_maps2','Mapas seleccionables por el Clan retado :');
define('XL_eventhome_dupemaps','Mapas duplicados permitidos :');
define('XL_eventhome_pointswin','Puntos por victoria :');
define('XL_eventhome_pointsloss','Puntos por derrota :');
define('XL_eventhome_pointsdraw','Puntos por empate :');
define('XL_eventhome_pointsdecline','Puntos perdidos por rechazar un reto :');
define('XL_eventhome_gamesday','Límite de juegos por día :');
define('XL_eventhome_challlimit','Limite de retos :');
define('XL_eventhome_timeout','Días en el que expira el reto :');
define('XL_eventhome_maxteams','Límite de Clanes en la competición :');
define('XL_eventhome_rostermin','Nº mínimo de miembros en el roster :');


###########################################
# Team Join Page
define('XL_teamjoin_title','Unirse a un Clan');
define('XL_teamjoin_header','Selecciona el Clan en el que quieres ingresar.');
define('XL_teamjoin_username','Nombre de usuario');
define('XL_teamjoin_team','Selecciona el Clan');
define('XL_teamjoin_password','Contraseña para ingresar en el Clan');
define('XL_teamjoin_joinbutton','Ingresar en el Clan');
define('XL_teamjoin_none','El Clan no existe o la contraseña es incorrecta');
define('XL_teamjoin_login','Por favor, logueate para poder ingresar en un Clan');
define('XL_teamjoin_dupe','Ya eres miembro de este Clan');
define('XL_teamjoin_limit','Eres miembro de demasiados Clanes');
define('XL_teamjoin_joined','Has ingresado en el Clan: ');

##########################################
# Team Invites Page
define('XL_teaminvites_title','Confirmar invitación');
define('XL_teaminvites_limit','Este usuario es miembro de demasiados Clanes actualmente.');
define('XL_teaminvites_sent','Invitación enviada');
define('XL_teaminvites_accept','Aceptar invitación');
define('XL_teaminvites_decline','Rechazar invitación');
define('XL_teaminvites_button','Aceptar');
define('XL_teaminvites_none','La invitación no existe.');
define('XL_teaminvites_youlimit','Ya eres miembro de demasiados Clanes');
define('XL_teaminvites_accepted','Invitación aceptada');
define('XL_teaminvites_declined','Invitación rechazada');
define('XL_teaminvites_removed','Invitación eliminada');
define('XL_teaminvites_enterid', 'Por favor, introduce la ID enviada en el email de confirmación');

###########################################
# Team Disputes
define('XL_teamdisputes_filedispute','Archivo de Disputas');
define('XL_teamdisputes_winner','Vencedor');
define('XL_teamdisputes_loser','Perdedor');
define('XL_teamdisputes_event','Competición');
define('XL_teamdisputes_comments','Comentarios');
define('XL_teamdisputes_button','Enviar');
define('XL_teamdisputes_error','Error');
define('XL_teamdisputes_submitted','Disputa enviada');

###########################################
# Team Admin Actions
define('XL_teamadmina_teamupdated','Datos del Clan actualizados');
define('XL_teamadmina_passupdated','<br />Contraseña cambiada');
define('XL_teamadmina_noeventsel','No se ha seleccionado ninguna competición');
define('XL_teamadmina_noevent','La competición no existe');
define('XL_teamadmina_joinevent','Ingresar en la competición');
define('XL_teamadmina_joininfo1','Información de ingreso');
define('XL_teamadmina_joininfo2','Información de ingreso 2');
define('XL_teamadmina_joinmaxplayers','Tu Clan tiene a demasiados miembros en el roster para esta competición');
define('XL_teamadmina_joinminplayers','Tu Clan no tiene suficientes miembros en el roster para esta competición');
define('XL_teamadmina_captainonly','Debes ser capitán para poder eliminar un Clan');
define('XL_teamadmina_teamremoved','Clan eliminado');
define('XL_teamadmina_memberremoved','Miembro eliminado');
define('XL_teamadmina_memberupdated','Miembro actualizado');
define('XL_teamadmin_msgsent','Las notificaciones han sido enviadas a :');

###########################################
# Team Admin Page
define('XL_teamadmin_loggingout','Has sido deslogueado.');
define('XL_teamadmin_errorlogin','Error logueandote.');
define('XL_teamadmin_badpass','Fallo en la comprobación de la contraseña');
define('XL_teamadmin_loggingin','Logueandote, por favor, espera...');
define('XL_teamadmin_title','Administración del Clan: ');
define('XL_teamadmin_profile','Perfil');
define('XL_teamadmin_roster','Roster');
define('XL_teamadmin_invites','Invitaciones');
define('XL_teamadmin_events','Competiciones');
define('XL_teamadmin_matches','Partidos');
define('XL_teamadmin_history','Resultados');
define('XL_teamadmin_quit','Eliminar');
define('XL_teamadmin_teamname','Nombre del Clan');
define('XL_teamadmin_teamtags','Tags del Clan');
define('XL_teamadmin_adminpass','Contraseña del administrador del Clan');
define('XL_teamadmin_joinpass','Contraseña para ingresar al Clan');
define('XL_teamadmin_homepage','Página web del Clan');
define('XL_teamadmin_logo','Logo del Clan');
define('XL_teamadmin_ircchannel','Canal de Irc');
define('XL_teamadmin_ircserver','Servidor Irc');
define('XL_teamadmin_captaininfo','Información del Capitán');
define('XL_teamadmin_captain','Capitán');
define('XL_teamadmin_mail','Email del Clan');
define('XL_teamadmin_country','País');
define('XL_teamadmin_profilemoto','Eslogan');
define('XL_teamadmin_update','Actualizar información');
define('XL_teamadmin_recruiting','Recruiting');
define('XL_teamadmin_rosterusername','Nombre de usuario');
define('XL_teamadmin_rostercontact','Contacto');
define('XL_teamadmin_rosterjoindate','Fecha de ingreso');
define('XL_teamadmin_rosterextra','SteamId');
define('XL_teamadmin_rostermodify','Modificar');
define('XL_teamadmin_rosterupdate','Actualizar');
define('XL_teamadmin_resterremove','Eliminar');
define('XL_teamadmin_rosterbut','Aceptar');
define('XL_teamadmin_invname','Nombre del usuario invitado');
define('XL_teamadmin_invcontact','Información de contacto');
define('XL_teamadmin_invcancel','Cancelar invitación');
define('XL_teamadmin_invcancelbut','Cancelar');
define('XL_teamadmin_invnone','No hay invitaciones pendientes');
define('XL_teamadmin_invuser','Invitar a un usuario');
define('XL_teamadmin_challnew','Iniciar un nuevo reto');
define('XL_teamadmin_challchallenger','Clan retante');
define('XL_teamadmin_challchallenged','Clan retado');
define('XL_teamadmin_challcontact','Contacto');
define('XL_teamadmin_challevent','Competición');
define('XL_teamadmin_challdate','Fecha');
define('XL_teamadmin_challconfirm','Confirmar');
define('XL_teamadmin_challstatus','Estado');
define('XL_teamadmin_challwidthdraw','Retirado');
define('XL_teamadmin_challnone','No hay retos');
define('XL_teamadmin_challmaps','Selección de mapas');
define('XL_teamadmin_challcomments','Comentarios del reto');
define('XL_teamadmin_challreportwin','Registrar una Victoria');
define('XL_teamadmin_challreportloss','Registrar una Derrota');
define('XL_teamadmin_challreportdraw','Registrar un Empate');
define('XL_teamadmin_challnotify','Notificar Roster');
define('XL_teamadmin_challdispute','Registrar un conflicto en el partido');
define('XL_teamadmin_eventsid','Id');
define('XL_teamadmin_eventsname','Competición');
define('XL_teamadmin_eventsspace','|');
define('XL_teamadmin_eventstgp','TGP');
define('XL_teamadmin_eventstw','TW');
define('XL_teamadmin_eventstl','TL');
define('XL_teamadmin_eventstd', 'TD');
define('XL_teamadmin_eventstp','TP');
define('XL_teamadmin_eventsgp','GP');
define('XL_teamadmin_eventsw','W');
define('XL_teamadmin_eventsl','L');
define('XL_teamadmin_eventsd', 'D');
define('XL_teamadmin_eventsp','P');
define('XL_teamadmin_eventsquit','Abandonar');
define('XL_teamadmin_eventsbut','Abandonar');
define('XL_teamadmin_eventsnone','No has ingresado en ningúna competición');
define('XL_teamadmin_eventsjoin','Unirse a la competición');
define('XL_teamadmin_nosetmatches', 'No se ha confirmado ningún partido');
define('XL_teamadmin_matchcontact', 'Información de contacto');
define('XL_teamadmin_matchcomments', 'Comentarios');
define('XL_teamadmin_matchmappicks', 'Imágnes del mapa');
define('XL_teamadmin_matchchallenger', 'Retante');
define('XL_teamadmin_matchchallenged', 'Retado');
define('XL_teamadmin_matchevent', 'Competición');
define('XL_teamadmin_matchdate', 'Fecha');
define('XL_teamadmin_matchesid','Id');
define('XL_teamadmin_matchesevent','Competición');
define('XL_teamadmin_matcheswinner','Vencedor');
define('XL_teamadmin_matchesloser','Perdedor');
define('XL_teamadmin_matchesdate','Fecha');
define('XL_teamadmin_matchesdetails','Detalles');
define('XL_teamadmin_matchesnone','No has jugado ningún partido');
define('XL_teamadmin_removeteam','Eliminación del clan');
define('XL_teamadmin_removeteamwarming','ATENCIÓN, si eliminas el Clan no podrás volver a darlo de alta. Una vez fuera, estas fuera.');
define('XL_teamadmin_removeteambut','Si, Eliminar mi Clan!');

###########################################
# Challenges
define('XL_challenges_selectevent','Selecciona la competición en la que quieres retar.');
define('XL_challenges_continue','Continuar');
define('XL_challenges_notenabled','Competición no activada');
define('XL_challenges_challengeteam','Retar a un Clan');
define('XL_challenges_event','Competición');
define('XL_challenges_yourteam','Tu Clan');
define('XL_challenges_otherteam','Selecciona el Clan al que quieres retar');
define('XL_challenges_selectdates','Selecciona fecha(s)');
define('XL_challenges_selectmaps','Selecciona mapa(s)');
define('XL_challenges_addedinfo','Información adicional');
define('XL_challenges_declinechall','Rechazar reto');
define('XL_challenges_warning',' son substraidos por rechazar un reto');
define('XL_challenges_vs','Vs');
define('XL_challenges_selectdate','Seleccionar fecha');
define('XL_challenges_challengermaps','Mapas del Clan retante');
define('XL_challenges_yourmaps','Tus mapas');
define('XL_challenges_comments','Comentarios');
define('XL_challenges_followup','Seguimiento');
define('XL_challenges_acceptchalenge','Aceptar reto');
define('XL_challenges_notfound','Reto no encontrado');
define('XL_challenges_allreadychallenged', 'Este Clan ya ha sido retado');
define('XL_challenges_gamesmaxday', 'Has sobrepasado el límite de partidos para hoy');
define('XL_challenges_notactive', 'Esta competición no está activa');
define('XL_challenges_disabled', 'La posibilidad de retar no está activada');
define('XL_challenges_playwithself', 'Deja de jugar contigo mismo');
define('XL_mapsrestricted', "No puedes seleccionar el mismo mapa mas de una vez, inténtalo de nuevo");
#Expired
define('XL_challenges_expired','Reto expirado');
###########################################
?>
