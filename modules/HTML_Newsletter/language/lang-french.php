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
* Script:			HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:		01.03.01
* Author:			Rob Herder (aka: montego) of montegoscripts.com
* Contact:		montego@montegoscripts.com
* Copyright:	Copyright © 2006 by Montego Scripts
* License:		GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
/************************************************************************
* Traduction française : Stefvar
* http://www.stefvar.com
************************************************************************/
/************************************************************************
* Function: Common Use Defines
************************************************************************/

define('_MSNL_COM_LAB_SQL',					'SQL');
define('_MSNL_COM_LAB_GOBACK',				'RETOUR');
define('_MSNL_COM_LAB_ERRMSG',				'MESSAGE D\'ERREUR');
define('_MSNL_COM_LAB_HELPLEGENDTXT',		'Passez votre curseur sur l\'icône pour plus de détails '
	.'help text'
	);

define('_MSNL_COM_LNK_GOBACK',				'Cliquer pour retourner à la page précédente');

if (!defined('_MSNL_COM_ERR_SQL')) define('_MSNL_COM_ERR_SQL',					'ERREUR PRODUITE DANS LE SQL ');
define('_MSNL_COM_ERR_MODULE',				'ERREUR DANS LE MODULE');
define('_MSNL_COM_ERR_VALMSG',				'LES CHAMPS SUIVANTS ONT ECHOUE A LA VALIDATION ');
define('_MSNL_COM_ERR_VALWARNMSG',			'LES CHAMPS SUIVANTS ONT EU DES AVERTISSEMENTS ');
define('_MSNL_COM_ERR_DBGETCFG', 			'N\'a pu obtenir les informations de configuration du module!');

define('_MSNL_COM_HLP_HELPLEGENDTXT',		'Oui, c\'est comme il est fait!');

/************************************************************************
* Function: Common use defines between module and block
************************************************************************/

define('_MSNL_NLS_LAB_MORENLS',				'D\'autres lettres...');
define('_MSNL_NLS_LAB_HIT',					'vue');
define('_MSNL_NLS_LAB_HITS',				'vues');
define('_MSNL_NLS_LAB_SENTON',				'envoyé le ');
define('_MSNL_NLS_LAB_SENDER',				'expéditeur');

define('_MSNL_NLS_LNK_VIEWNL',				'Voir la lettre d\'information - s\'ouvre dans une nouvelle fenêtre');
define('_MSNL_NLS_LNK_VIEWNLARCHS',			'Voir les archives de lettres d\'information');

/************************************************************************
* Function: msnl_nls_list
************************************************************************/

define('_MSNL_NLS_LST_LAB_ARCHTITL',		'Archive des lettres d\'information');
define('_MSNL_NLS_LST_LAB_ADMNLS',			'Administrer Newsletter');

define('_MSNL_NLS_LST_LNK_ADMNLS',			'Aller à l\'administration du module');

define('_MSNL_NLS_LST_MSG_NONLS',			'Il n\'y a pas de lettres d\'information à voir');

/************************************************************************
* Function: msnl_nls_view
************************************************************************/

define('_MSNL_NLS_VIEW_ERR_DBGETNL',		'Echec d\'obtention de la lettre d\'information');
define('_MSNL_NLS_VIEW_ERR_CANNOTFIND',		'La lettre d\'information n\'a pas été trouvée');
define('_MSNL_NLS_VIEW_ERR_NOTAUTH',		'Vous n\'êtes pas autorisé à voir cette lettre d\'information ou cette dernière n\'existe pas');

/************************************************************************
* Function: msnl_copyright_view
************************************************************************/

define('_MSNL_CPY_LAB_COPYTITLE',			'Module Copyright &copy; and Credits');
define('_MSNL_CPY_LAB_MODULEFOR',			'module pour');
define('_MSNL_CPY_LAB_COPY',				'Copyright Information');
define('_MSNL_CPY_LAB_CREDITS',				'Credit Information');
define('_MSNL_CPY_LAB_MODNAME',				'Nom du module');
define('_MSNL_CPY_LAB_MODVER',				'Version du module');
define('_MSNL_CPY_LAB_MODDESC',				'Description du module');
define('_MSNL_CPY_LAB_LICENSE',				'License');
define('_MSNL_CPY_LAB_AUTHORNM',			'Nom de l\'auteur');
define('_MSNL_CPY_LAB_AUTHOREMAIL',			'Courriel de l\'auteur');
define('_MSNL_CPY_LAB_AUTHORWEB',			'Site de l\'auteur');
define('_MSNL_CPY_LAB_MODDL',				'Téléchargement du module');
define('_MSNL_CPY_LAB_DOCS',				'Support/Aide Documentation');
define('_MSNL_CPY_LAB_ORIGAUTHOR',			'Auteurs originaux');
define('_MSNL_CPY_LAB_CURRENTAUTHOR',		'Auteurs actuels');
define('_MSNL_CPY_LAB_TRANSLATIONS',		'Auteurs des traductions');
define('_MSNL_CPY_LAB_OTHER',				'Remerciement additionnel');

define('_MSNL_CPY_LNK_VIEWCOPYRIGHT',		'Voir copyright et credits');
define('_MSNL_CPY_LNK_PHPNUKE',				'Aller sur le site de PHP-Nuke - vous quitterez ce site');
define('_MSNL_CPY_LNK_AUTHORHOME',			'Aller sur le site de l\'auteur - vous quitterez ce site');
define('_MSNL_CPY_LNK_DOWNLOAD',			'Aller à l\'espace de téléchargement - vous quitterez ce site');
define('_MSNL_CPY_LNK_DOCS',				'Aller à l\'espace de documentation - vous quitterez ce site');

?>