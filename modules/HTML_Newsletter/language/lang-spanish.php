<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright © 2004 by NukeWorks                                        */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright © 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Script:     HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:    01.03.02
* Author:     Rob Herder (aka: montego) of montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
/************************************************************************
* Rev Date      Change ID       Description
* -----------   --------------  -----------------------------------------
* 18-MAY-2006   RN_0000185      Make XHTML 1.0 Compliant, plus better use of quotes
************************************************************************/

/************************************************************************
* Function: Common Use Defines
************************************************************************/

define('_MSNL_COM_LAB_SQL', 'SQL');
define('_MSNL_COM_LAB_GOBACK', 'REGRESAR');
define('_MSNL_COM_LAB_ERRMSG', 'MENSAJE DE ERROR');
define('_MSNL_COM_LAB_HELPLEGENDTXT', 'Sit&uacute;e el cursor sobre estos iconos para obtener texto de ayuda detallada '
  .''
  );

define('_MSNL_COM_LNK_GOBACK', 'Presione para volver a la p&aacute;gina anterior');

if (!defined('_MSNL_COM_ERR_SQL')) define('_MSNL_COM_ERR_SQL', 'SE ENCONTR&Oacute; UN ERROR EN SQL');
define('_MSNL_COM_ERR_MODULE', 'ERROR EN EL M&Oacute;DULO');
define('_MSNL_COM_ERR_VALMSG', 'LOS SIGUIENTES CAMPOS FALLARON LA VALIDACI&Oacute;N');
define('_MSNL_COM_ERR_VALWARNMSG', 'LOS SIGUIENTES CAMPOS CONTIENEN ADVERTENCIAS');
define('_MSNL_COM_ERR_DBGETCFG',  'No se ha podido obtener informaci&oacute;n de la configuraci&oacute;n del m&oacute;dulo!');

define('_MSNL_COM_HLP_HELPLEGENDTXT', 'S&iacute;, as&iacute; es como se hace!');

/************************************************************************
* Function: Common use defines between module and block
************************************************************************/

define('_MSNL_NLS_LAB_MORENLS', 'M&aacute;s Boletines...');
define('_MSNL_NLS_LAB_HIT', 'hit');
define('_MSNL_NLS_LAB_HITS', 'hits');
define('_MSNL_NLS_LAB_SENTON', 'enviado en');
define('_MSNL_NLS_LAB_SENDER', 'remitente');

define('_MSNL_NLS_LNK_VIEWNL', 'Ver bolet&iacute;n - puede abrirse una nueva ventana');
define('_MSNL_NLS_LNK_VIEWNLARCHS', 'Ver archivos del Boletin');

/************************************************************************
* Function: msnl_nls_list
************************************************************************/

define('_MSNL_NLS_LST_LAB_ARCHTITL', 'Boletines Archivados');
define('_MSNL_NLS_LST_LAB_ADMNLS', 'Administrar Bolet&iacute;n');

define('_MSNL_NLS_LST_LNK_ADMNLS', 'Ir a la administraci&oacute;n del m&oacute;dulo');

define('_MSNL_NLS_LST_MSG_NONLS', 'No hay boletines para ver');

/************************************************************************
* Function: msnl_nls_view
************************************************************************/

define('_MSNL_NLS_VIEW_ERR_DBGETNL', 'No se ha podido obtener informaci&oacute;n del Bolet&iacute;n');
define('_MSNL_NLS_VIEW_ERR_CANNOTFIND', 'No se puede encontrar el archivo seleccionado del Bolet&iacute;n');
define('_MSNL_NLS_VIEW_ERR_NOTAUTH', 'No est&aacute;s autorizado para ver este bolet&iacute;n '
  .'o este bolet&iacute;n no existe!');

/************************************************************************
* Function: msnl_copyright_view
************************************************************************/

define('_MSNL_CPY_LAB_COPYTITLE', 'Copyright &copy; y Cr&eacute;ditos del M&oacute;dulo');
define('_MSNL_CPY_LAB_MODULEFOR', 'm&oacute;dulo para');
define('_MSNL_CPY_LAB_COPY', 'Informaci&oacute;n de Derecho de Autor');
define('_MSNL_CPY_LAB_CREDITS', 'Informaci&oacute;n de Cr&eacute;ditos');
define('_MSNL_CPY_LAB_MODNAME', 'Nombre del M&oacute;dulo');
define('_MSNL_CPY_LAB_MODVER', 'Versi&oacute;n del M&oacute;dulo');
define('_MSNL_CPY_LAB_MODDESC', 'Descripci&oacute;n del M&oacute;dulo');
define('_MSNL_CPY_LAB_LICENSE', 'Licencia');
define('_MSNL_CPY_LAB_AUTHORNM', 'Nombre del Autor');
define('_MSNL_CPY_LAB_AUTHOREMAIL', 'Correo del Autor');
define('_MSNL_CPY_LAB_AUTHORWEB', 'Sitio Web del Autor');
define('_MSNL_CPY_LAB_MODDL', 'Descargar el M&oacute;dulo');
define('_MSNL_CPY_LAB_DOCS', 'Documentaci&oacute;n de Soporte / Ayuda');
define('_MSNL_CPY_LAB_ORIGAUTHOR', 'Autor(es) Original(es)');
define('_MSNL_CPY_LAB_CURRENTAUTHOR', 'Autor(es) Actual(es)');
define('_MSNL_CPY_LAB_TRANSLATIONS', 'Autor(es) de Traducci&oacute;n');
define('_MSNL_CPY_LAB_OTHER', 'Agradecimientos Adicionales');

define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'Ver derechos de autor y cr&eacute;ditos');
define('_MSNL_CPY_LNK_PHPNUKE', 'Ir al sitio web de PHP-Nuke - abandonar&aacute;s este sitio');
define('_MSNL_CPY_LNK_AUTHORHOME', 'Ir al sitio web del Autor - abandonar&aacute;s este sitio');
define('_MSNL_CPY_LNK_DOWNLOAD', 'Ir al sitio web de Descargas - abandonar&aacute;s este sitio');
define('_MSNL_CPY_LNK_DOCS', 'Ir al sitio web de la Documentaci&oacute;n - abandonar&aacute;s este sitio');

?>