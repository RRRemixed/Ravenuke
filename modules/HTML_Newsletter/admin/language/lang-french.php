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
/* Copyright � 2004 by NukeWorks                                        */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright � 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Script:			HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:		01.03.01
* Author:			Rob Herder (aka: montego) of montegoscripts.com
* Contact:		montego@montegoscripts.com
* Copyright:	Copyright � 2006 by Montego Scripts
* License:		GNU/GPL (see provided LICENSE.txt file)
************************************************************************/

/*************************************************************************
* All attempts are made to place defines into the Function and Section
* on the screen where it is used as well as in the order of placement on
* the screen reading left-to-right and then top-down.  In cases where a
* define is used on multiple screens, it may only be defined once, so the
* first Function/Section: will have the define in it.
************************************************************************/

/************************************************************************
* Function: General Use Defines
************************************************************************/

define('_MSNL_COM_LAB_MODULENAME',					'HTML Newsletter');
define('_MSNL_LAB_ADMIN',							'Administration');

//Module Menu Labels and Link Titles

define('_MSNL_LAB_CREATENL',						'Cr�er un lettre');
define('_MSNL_LAB_MAINCFG',							'Configuration');
define('_MSNL_LAB_CATEGORYCFG',						'Configuration des cat�gories');
define('_MSNL_LAB_MAINTAINNLS',						'Maintenance');
define('_MSNL_LAB_SENDTESTED',						'Envoyer le test');
define('_MSNL_LAB_SITEADMIN',						'Administration du site');
define('_MSNL_LAB_NLARCHIVES',						'Archives');
define('_MSNL_LAB_NLDOCS',							'Documentation en ligne');

define('_MSNL_LNK_CREATENL',						'Cr�er un lettre d\'information');
define('_MSNL_LNK_MAINCFG',							'Configuration des options');
define('_MSNL_LNK_CATEGORYCFG',						'Gestion des cat�gories de lettre d\'information');
define('_MSNL_LNK_MAINTAINNLS',						'Gestion des lettres d\'information existantes');
define('_MSNL_LNK_SENDTESTED',						'Envoyer le dernier test de lettre d\'information');
define('_MSNL_LNK_SITEADMIN',						'Aller � l\'administration du site');
define('_MSNL_LNK_NLARCHIVES',						'Aller aux archives de lettres d\'information');
define('_MSNL_LNK_NLDOCS',							'Aller � la documentation en ligne du module');

define('_MSNL_ERR_NOTAUTHORIZED',					'Vous n\'avez pas l\'autorisation n�cessaire pour administrer ce module');

//For module functions.php (not admin functions.php)

define('_MSNL_COM_ERR_SQL',							'ERREUR SQL RENCONTREE');
define('_MSNL_COM_ERR_MODULE',						'ERREUR DANS LE MODULE');
define('_MSNL_COM_ERR_VALMSG',						'LES CHAMPS SUIVANT ONT FAIT ECHOUES LA VALIDATION');
define('_MSNL_COM_ERR_VALWARNMSG',					'LES CHAMPS SUIVANTS ONT UN AVERTISSEMENT');
define('_MSNL_COM_ERR_DBGETCFG', 					'Echec d\'optention des informations de configuration du module!');

//Common use Defines

define('_MSNL_COM_LAB_ACTIONS',						'Actions');
define('_MSNL_COM_LAB_ACTIVE',						'Active');
define('_MSNL_COM_LAB_ADD',							'AJOUTER');
define('_MSNL_COM_LAB_ALL',							'TOUT');
define('_MSNL_COM_LAB_GO',							'VALIDER');
define('_MSNL_COM_LAB_INACTIVE',					'Inactive');
define('_MSNL_COM_LAB_LANG',						'Language');
define('_MSNL_COM_LAB_NO',							'Non');
define('_MSNL_COM_LAB_PREVIEW',						'Pr�visualisation');
define('_MSNL_COM_LAB_SAVE',						'SAUVEGARDER');
define('_MSNL_COM_LAB_SHOW_ALL',					'**Tout afficher**');
define('_MSNL_COM_LAB_SEND',						'Envoyer');
define('_MSNL_COM_LAB_VERSION',						'Version');
define('_MSNL_COM_LAB_YES',							'Oui');

define('_MSNL_COM_LNK_ADD',							'Cliquer pour ajouter les donn�es ci-dessus ');
define('_MSNL_COM_LNK_CANCEL',						'Annuler la transaction');
define('_MSNL_COM_LNK_CONTINUE',					'Continuer la transaction ');
define('_MSNL_COM_LNK_SAVE',						'Cliquer pour sauvegarder tous les changements');
define('_MSNL_COM_LNK_SEND',						'Envoyer la lettre d\'information');
define('_MSNL_COM_LNK_PREVIEW',						'Valider et pr�visualiser le lettre');

//define('_MSNL_COM_ERR_SQL',							'SQL');
define('_MSNL_COM_ERR_MSG',							'ERREUR MSG');
define('_MSNL_COM_ERR_DBGETCATS',					'Echec d\'obtention des cat�gories de lettre d\'information');
define('_MSNL_COM_ERR_FILENOTEXIST',				'Ce fichier n\'existe pas');
define('_MSNL_COM_ERR_FILENOTWRITEABLE',			'Was unable to write the newsletter file - Check that permissions on the archive directory are set to 777');
define('_MSNL_COM_ERR_DBGETPHPBB',					'Impossible d\'obtenir les information de configuration du forum PHPBB');
define('_MSNL_COM_ERR_DBGETRECIPIENTS',				'Impossible d\'obtenir le nombre de destinataire pour :');

define('_MSNL_COM_MSG_WARNING',						'Attention !');
define('_MSNL_COM_MSG_UPDSUCCESS',					'Mise � jour effectu�e !');
define('_MSNL_COM_MSG_ADDSUCCESS',					'Ajout effectu� !');
define('_MSNL_COM_MSG_DELSUCCESS',					'Supression effectu�e!');
define('_MSNL_COM_MSG_REQUIRED',					'Ce champ exige une valeur');
define('_MSNL_COM_MSG_POSNONZEROINT',				'Requier une valeur diff�rente de z�ro');

define('_MSNL_COM_HLP_ACTIONS',						'Passez le curseur sur les ic�nes ci-dessous pour voir ce que l\'action va donner.');

/************************************************************************
* Function: msnl_admin  (Create Newsletter)
************************************************************************/

//Section: Letter

define('_MSNL_ADM_LAB_LETTER',						'Lettre');
define('_MSNL_ADM_LAB_TOPIC',						'Sujet');
define('_MSNL_ADM_LAB_SENDER',						'Nom de l\'exp�diteur');
define('_MSNL_ADM_LAB_NLSCAT',						'Categorie');
define('_MSNL_ADM_LAB_TEXTBODY',					'Texte de la lettre');
define('_MSNL_ADM_LAB_HTMLOK',						'(Les tags HTML sont autoris�s)');

define('_MSNL_ADM_HLP_TOPIC', 						'Ce texte remplace le tag {EMAILTOPIC} dans le template choisi.  Ce tag est habituellement sur une seule ligne, il est souhaitable qu\'il ne soit pas trop long - 40 caract�res ou moins.  Seuls les tags HTML suivants sont autoris� pour ce champ : & lt;b& gt; & lt;i& gt; & lt;u& gt;.');
define('_MSNL_ADM_HLP_SENDER', 						'Ce texte remplace le tag {SENDER} dans le template choisi.  Ce tag est habituellement sur une seule ligne, il est recommand� qu\'il soit cout et personnel - moins de 20 caract�res.  Seuls les tags HTML suivants sont autoris� pour ce champ : & lt;b& gt; & lt;i& gt; & lt;u& gt;.');
define('_MSNL_ADM_HLP_NLSCAT', 						'Choisissez simplement la cat�gorie o� placer la lettre d\'information.  Les cat�gories de lettres d\'information peuvent �tre utilis�es pour organiser des sujets sp�cifiques.  Les lettres d\'information inscritent dans des cat�gories sp�cifiques via le menu d\'administration.');
define('_MSNL_ADM_HLP_TEXTBODY',					'C\'est l\'emplacement principal du texte de votre lettre d\'information. Il peut �tre pr�f�rable d\'�crire au pr�alable votre texte dans un �diteur HTML afin d\'avoir une pr�visualisation, puis de le copier ensuite dans cet emplacement. Ce texte remplacera le tag {TEXTBODY} dans le template choisi.<br /><br /> Les tags HTML sont g�n�ralement laiss�s, mais il est pr�f�rable de n\'utiliser que les plus courant pour une meilleure compatibilit� avec les lecteurs de courriel des destinatiares de la lettre. Pour de long texte vous pouvez marquer des sections en <b>gras</b> pour plus de lisibilit�. <br /><br />Les tags HTML les plus courant emply�s sont : & lt;br& gt; & lt;b& gt; & lt;i& gt; & lt;u& gt;.');

//Section: Templates

define('_MSNL_ADM_LAB_TEMPLATES',					'Mises en page');
define('_MSNL_ADM_LAB_CHOOSETMPLT',					'Choisissez une mise en page');

define('_MSNL_ADM_LNK_SHOWTEMPLATE',				'Cliquez pour voir un apper�u de la mise en page');

define('_MSNL_ADM_HLP_TEMPLATES',					'La liste ci-dessous correspond � l\'ensemble de mises en page pr�sentent dans le r�pertoire modules/HTML_Newsletter/templates/. Si vous choisissez d\'envoyer votre lettre d\'information en choisissant <b>no template</b>, seul le texte �crit plus haut appara�tra dans votre lettre.<br /><br />Pour cr�er une lettre avec une mise en forme, s�lectionnez en une parmis la liste ci-dessous. Vous pouvez avoir un apper�u de cette mise en page en cliquant sur le petit ic�ne citu� � droite du nom de la mise en page.<br /><br />Vous pouvez cr�er vos propre mise en page en choisissant comme mod�le <b>Fancy_Content</b> ce dernier �tant le seul mod�le cr�� par le cr�ateur du module.');

//Section: Stats and Newsletter Contents

define('_MSNL_ADM_LAB_STATS',						'Statistiques et contenu');
define('_MSNL_ADM_LAB_INCLSTATS',					'Inclure les statistiques du site');
define('_MSNL_ADM_LAB_INCLTOC',						'Inclure le menu du contenu');

define('_MSNL_ADM_HLP_INCLSTATS',					'La validation de cette option inclura les statistiques principales de votre site. Elle remplacera le tag {STATS} dans la mise en page choisie. Voir les �chantillons de mise en page ci-dessus pour vous donner une id�e des statistiques affich�s.');
define('_MSNL_ADM_HLP_INCLTOC',						'La validation de cette option inclura un menu sous forme de bloc avec des liens pour les diff�rentes rubriques de votre lettre d\'information. Voir les �chantillons de mise en page ci-dessus pour vous donner une id�e du menu affich�.');

//Section: Include Latest Items

define('_MSNL_ADM_LAB_INCLLATEST',					'Inclure les derniers :');
define('_MSNL_ADM_LAB_INCLLATESTDLS',				'Derniers t�l�chargements');
define('_MSNL_ADM_LAB_INCLLATESTWLS',				'Derniers liens');
define('_MSNL_ADM_LAB_INCLLATESTFORS',				'Derniers messages');
define('_MSNL_ADM_LAB_INCLLATESTNEWS',				'Derniers articles');
define('_MSNL_ADM_LAB_INCLLATESTREVS',				'Derniers comptes rendus');

define('_MSNL_ADM_HLP_INCLLATESTNEWS',				'D�finit le nombre des derniers articles � afficher dans votre lettre d\'information. Les articles seront class�s du plus r�cent au plus ancien. Utilisez une valeur <b>0</b> pour ne pas inclure les derniers articles dans votre lettre d\'information. Vous pourrez modifier cette option � tout moment lors de la pr�visualisation de votre lettre.');
define('_MSNL_ADM_HLP_INCLLATESTDLS',			 	'D�finit le nombre des derniers t�l�chargements � afficher dans votre lettre d\'information. Les t�l�chargements seront class�s du plus r�cent au plus ancien. Utilisez une valeur <b>0</b> pour ne pas inclure les derniers t�l�chargements dans votre lettre d\'information. Vous pourrez modifier cette option � tout moment lors de la pr�visualisation de votre lettre.');
define('_MSNL_ADM_HLP_INCLLATESTWLS',				'D�finit le nombre des derniers liens � afficher dans votre lettre d\'information. Les liens seront class�s du plus r�cent au plus ancien. Utilisez une valeur <b>0</b> pour ne pas inclure les derniers liens dans votre lettre d\'information. Vous pourrez modifier cette option � tout moment lors de la pr�visualisation de votre lettre.');
define('_MSNL_ADM_HLP_INCLLATESTFORS',				'D�finit le nombre des derniers messages des forums � afficher dans votre lettre d\'information. Les messages seront class�s du plus r�cent au plus ancien. Utilisez une valeur <b>0</b> pour ne pas inclure les derniers messages des forums dans votre lettre d\'information. Vous pourrez modifier cette option � tout moment lors de la pr�visualisation de votre lettre. En outre, seuls les messages autoris�s en lecture aux visiteurs seront affich�s');
define('_MSNL_ADM_HLP_INCLLATESTREVS',				'D�finit le nombre des derniers comptes rendus � afficher dans votre lettre d\'information. Les comptes rendus seront class�s du plus r�cent au plus ancien. Utilisez une valeur <b>0</b> pour ne pas inclure les derniers comptes rendus dans votre lettre d\'information. Vous pourrez modifier cette option � tout moment lors de la pr�visualisation de votre lettre.');

//Section: Sponsors

define('_MSNL_ADM_LAB_SPONSORS',					'Sponsors');
define('_MSNL_ADM_LAB_CHOOSESPONSOR',				'Choisissez un sponsor');
define('_MSNL_ADM_LAB_NOSPONSOR',					'Pas de sponsor');

define('_MSNL_ADM_HLP_CHOOSESPONSOR',				'Le choix d\'un sponsor remplacera la banni�re du site par celle choisie. Ce choix remplacera le tag {BANNER} dans la mise en page choisie.'
  );

define('_MSNL_ADM_ERR_DBGETBANNERS',				'Echec de l\'obtention d\'information sur la banni�re du commanditaire');

//Section: Who to Send the Newsletter To

define('_MSNL_ADM_LAB_WHOSNDTO',					'A qui voulez vous envoyer la lettre ?');
define('_MSNL_ADM_LAB_CHOOSESENDTO',				'Choisissez l\'option correspondante :');

define('_MSNL_ADM_LAB_WHOSNDTONLSUBS',				'Aux abonn�s de la lettre seulement');
define('_MSNL_ADM_LAB_WHOSNDTOALLREG',				'Tous les membres enregistr�s');
define('_MSNL_ADM_LAB_WHOSNDTOPAID',				'Abonn�s payants seulement');
define('_MSNL_ADM_LAB_WHOSNDTOANONY',				'Tous les visiteurs du site - Pas de mail envoy� mais tous les visiteurs pourront voir la lettre');
define('_MSNL_ADM_LAB_WHOSNDTONSNGRPS',				'Un ou plusieurs NSN Groups - choisissez le(s) groupe(s) plus bas');
define('_MSNL_ADM_LAB_WHOSNDTOADM',					'Test email (� l\'Admin seulement)');
define('_MSNL_ADM_LAB_SUBSCRIBEDUSRS',				'utilistaeurs abonn�s');
define('_MSNL_ADM_LAB_USERS',						'Utilisateurs');
define('_MSNL_ADM_LAB_PAIDUSRS',					'abonn�s payants');
define('_MSNL_ADM_LAB_NSNGRPUSRS',					'Utilisateur NSN Group');
define('_MSNL_ADM_LAB_WHOSNDTOADHOC',				'Liste de distributeur de mails');
define('_MSNL_ADM_LAB_WHOSNDTOANONYV',				'Tous les visiteurs du site');

define('_MSNL_ADM_HLP_WHOSNDTONLSUBS',				'Le choix de cette option enverra la lettre d\'information � tous les utilisateurs qui ont souscrit � la lettre d\'information de votre site.');
define('_MSNL_ADM_HLP_WHOSNDTOALLREG',				'Le choix de cette option enverra la lettre d\'informations � tous les utilisateurs inscrit sur votre site. Attention en utilisant cette option car certains de vos utilisateurs risquent de ne pas appr�cier recevoir une lettre pour laquelle ils n\'ont pas souscrit.');
define('_MSNL_ADM_HLP_WHOSNDTOPAID',				'Le choix de cette option enverra la lettre d\'information � tous les abonn�s payant. C\'est � dire � tous ceux qui ont un abonnement actif sur votre site.');
define('_MSNL_ADM_HLP_NSNGRPUSRS',					'Le choix de cette option permettra d\'envoyer la lettre d\'information � un ou plusieurs groupes NSN � choisir ci-dessous');
define('_MSNL_ADM_HLP_WHOSNDTOANONYV',				'Le choix de cette option n\'enverra pas la lettre d\'information mais montrera cette derni�re dans le bloc des archives de lettre. Cependant, prendre garde � ce que le bloc et module soient acc�ssible aux utilisateurs.');
define('_MSNL_ADM_HLP_WHOSNDTOADM',					'Le choix de cette option enverra la lettre d\'information � l\'administrateur seulement.C\'est en quelque sorte une lettre de test. Vous pourrez par la suite modifier cette option pour diffuser votre lettre.');
define('_MSNL_ADM_HLP_WHOSNDTOADHOC',				'Le choix de cette option enverra la lettre d\'information � une ou plusieurs adresses courriels s�par�es par une virgule. Assurez vous que les adresses soient bien valides.');

//Section: NSN Groups

define('_MSNL_ADM_LAB_CHOOSENSNGRP',				'A quel NSN Group vouslez envoyer ?');
define('_MSNL_ADM_LAB_CHOOSENSNGRP1',				'(la s�lection sera ignor� si l\'option n\'a pas �t� coch�e plus haut)');
define('_MSNL_ADM_LAB_WHONSNGRP',					'Choisissez un ou plusieurs groupes');

define('_MSNL_ADM_ERR_DBGETNSNGRPS',				'Impossible d\'optenir les information de NSN Groups');

define('_MSNL_ADM_HLP_CHOOSENSNGRPUSRS',			'S�lectionnez un ou plusieurs groupes auxquels vous souhaitez envoyer une lettre d\'information.');

/************************************************************************
* Function: msnl_admin_preview  (Create Newsletter --> Preview)
************************************************************************/

define('_MSNL_ADM_PREV_LAB_VALPREVNL',				'Cr�er une nouvelle lettre - Validation et pr�visualisation');
define('_MSNL_ADM_PREV_LAB_PREVNL',					'Pr�visualisation de la lettre');

define('_MSNL_ADM_PREV_MSG_SUCCESS',				'La lettre a pass� toutes les valisation et est pr�te pour la pr�visualisation ci-dessous');

/************************************************************************
* Function: msnl_admin  (Create Newsletter --> admin_check_post.php)
************************************************************************/

define('_MSNL_ADM_LAB_NSNGRPS',						'NSN Groups');

define('_MSNL_ADM_VAL_NONSNGRP',					'Vous avez choisi d\'envoyer � un groupe de NSN Groups mais have not selected a group to send to');

define('_MSNL_ADM_ERR_NOTEMPLATE',					'Erreur : aucune mise en page choisie');
define('_MSNL_ADM_ERR_NOSENDTO',					'Erreur : aucune option d\'envoie choisie');

define('_MSNL_ADM_ERR_DBUPDLATEST',					'Une erreur c\'est produite pour mettre � jour la configuration de \'Dernier _____\'');

/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_send_mail.php)
************************************************************************/

define('_MSNL_ADM_SEND_LAB_SENDNL',					'Create Newsletter - Send Mail');
define('_MSNL_ADM_SEND_LAB_TESTNLFROM',				'Lettre d\'information de TEST de');
define('_MSNL_ADM_SEND_LAB_NLFROM',					'Lettre d\'information de');

define('_MSNL_ADM_SEND_MSG_ANONYMOUS',				'La lettre d\'information a �t� ajout�e � la vue de tous les visiteurs.');
define('_MSNL_ADM_SEND_MSG_LOTSSENT',				'Plus de 500 utilisateurs recevront la lettre d\'information, ceci peut prendre 10 minutes ou plus et peut g�n�rer un arr�t de PHP.'
  );
define('_MSNL_ADM_SEND_MSG_TOTALSENT',				'Total de lettres envoy�s');
define('_MSNL_ADM_SEND_MSG_SENDSUCCESS',			'Le lettre d\'information a �t� envoy�e avec succ�s');
define('_MSNL_ADM_SEND_MSG_SENDFAILURE',			'Newsletter email sends failed');

define('_MSNL_ADM_SEND_ERR_NOTESTEMAIL',			'N\'a pu trouver le fichier testemail.php');
define('_MSNL_ADM_SEND_ERR_INVALIDVIEW',			'Option de vue fournie invalide');
define('_MSNL_ADM_SEND_ERR_CREATENL',				'N\'a pas pu copier testemail au '
  .'newsletter file'
  );
define('_MSNL_ADM_SEND_ERR_DBNLSINSERT',			'Ne peut ins�rer la lettre d\'information dans '
  .'the database'
  );
define('_MSNL_ADM_SEND_ERR_DBNLSNID',				'Ne peut pas obtenir le bon NID '
  .'inserted newsletter'
  );
define('_MSNL_ADM_SEND_ERR_MAIL',					'La fonction PHP mail a �chou� - ne peut pas envoyer '
  .'newsletter to:'
  );
define('_MSNL_ADM_SEND_ERR_DELFILETEST',			'L\'effacement du fichier testemail.php a �chou� ');
define('_MSNL_ADM_SEND_ERR_DELFILETMP',				'L\'effacement du fichier tmp.php a �chou� ');

/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_make_nls.php)
************************************************************************/

define('_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR',			'Incapable de rechercher des statistiques pour le nombre d\'utilisateurs ');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS',			'Incapable de rechercher des statistiques pour le nombre de visite du site');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS',			'Incapable de rechercher des statistiques pour le nombre des derniers articles');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT',		'Incapable de rechercher des statistiques pour le nombre des nouvelles cat�gories d\'articles');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS',			'Incapable de rechercher des statistiques pour le nombre des derniers t�l�chargements');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT',		'Incapable de rechercher des statistiques pour le nombre des derni�res cat�gories de t�l�chargement');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS',		'Incapable de rechercher des statistiques pour le nombre des derniers liens');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT',		'Incapable de rechercher des statistiques pour le nombre des derni�res cat�gories de liens');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS',		'Incapable de rechercher des statistiques pour le nombre des forums');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS',		'Incapable de rechercher des statistiques pour le nombre des messages des forums');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS',		'Incapable de rechercher des statistiques pour le nombre des derniers comptes rendus');

define('_MSNL_ADM_SEND_ERR_DBGETNEWS',				'Incapable de rechercher les derniers articles');
define('_MSNL_ADM_MAKE_ERR_DBGETDLS',				'Incapable de rechercher les derniers t�l�chargements');
define('_MSNL_ADM_MAKE_ERR_DBGETWLS',				'Incapable de rechercher les derniers liens');
define('_MSNL_ADM_MAKE_ERR_DBGETPOSTS',				'Incapable de rechercher les derniers messages des forums');
define('_MSNL_ADM_MAKE_ERR_DBGETREVIEWS',			'Incapable de rechercher les derniers comptes rendus');
define('_MSNL_ADM_MAKE_ERR_DBGETBANNER',			'Incapable de rechercher les derni�res banni�res');

/************************************************************************
* Function: msnl_admin_send_tested  (Send Tested)
************************************************************************/

define('_MSNL_ADM_TEST_LAB_PREVNL',					'Pr�visualiser et valider la lettre de test');

/************************************************************************
* Function: msnl_cfg	(Main Configuration Options)
************************************************************************/

define('_MSNL_CFG_LAB_MAINCFG',						'Menu de configuration du module');

//Module Options

define('_MSNL_CFG_LAB_MODULEOPT',					'Options du module');
define('_MSNL_CFG_LAB_DEBUGMODE',					'Mode de d�bugage');
define('_MSNL_CFG_LAB_DEBUGMODE_OFF',				'INACTIF');
define('_MSNL_CFG_LAB_DEBUGMODE_ERR',				'ERREUR');
define('_MSNL_CFG_LAB_DEBUGMODE_VER',				'COMPLET');
define('_MSNL_CFG_LAB_DEBUGOUTPUT',					'Debug Output');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_DIS',				'DISPLAY');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_LOG',				'LOG FILE');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_BTH',				'TOUT');
define('_MSNL_CFG_LAB_SHOWBLOCKS',					'Afficher les blocs de droite');
define('_MSNL_CFG_LAB_NSNGRPS',						'Utilisation de NSN Groups');
define('_MSNL_CFG_LAB_DLMODULE',					'Nom du module de t�l�chargement');
define('_MSNL_CFG_LAB_WYSIWYGON',					'Utilisation d\'un �diteur WYSIWYG');
define('_MSNL_CFG_LAB_WYSIWYGROWS',					'Nombre de lignes');

define('_MSNL_CFG_HLP_DEBUGMODE',					'Cette option permet � l\'administrateur de placer sur diverse position les retours d\'erreurs. Elles correspondent � :<br /><strong>INACTIF</strong> = seuls les messages d\'erreurs de l\'application sans les d�tails seront affich�s.<br /><strong>ERREUR</strong> = les erreurs d\'application seront affich�s avec un message �ventuel de correction. Les erreurs SQL affichront �galement l\'erreur r�elle produite.<br /><strong>COMPLET</strong> = des messages tr�s d�taill�s seront affich�s dans toute l\'application, y compris dans le module visible par tous. Faire attention de ne pas laisser cette option sur cette position pour un site � fort traffic, car elle pourrait donner des indications utiles � une personne malveillante. <b>NOTE : aucune lettre d\'information ne pourra �tre envoy�e avec cette option.</b> Elle est seulement utile pour la correction');
define('_MSNL_CFG_HLP_DEBUGOUTPUT',					'Cette option n\'est pas utilis�e actuellement. A l\'avenir permettra de montrer les erreurs produites sur le module.'
  );
define('_MSNL_CFG_HLP_SHOWBLOCKS',					'Cocher cette option affichera les blocs de droites dans le module. L\'option par d�faut est non coch�.');
define('_MSNL_CFG_HLP_NSNGRPS',						'Cette option ne peut �tre emply�e que si vous avez install� le module NSN Groups. Si le module est install�, elle permet d\'envoyer des lettres d\'information � un ou plusieurs groupes dans les options d\'envoie de la lettre d\'information.'
  );
define('_MSNL_CFG_HLP_DLMODULE',					'Ins�rez ici l\'extension appropri�e du module. La table par d�faut des t�l�chargements est nuke_<strong>downloads</strong>_downloads, il vous faut donc ins�rer \'downloads\'. Si vous utilisez le module NSN GR Downloads la table est nuke_<strong>nsngd</strong>_downloads. Dans ce cas il vous faut ins�rer \'nsngd\'.');
define('_MSNL_CFG_HLP_WYSIWYGON',					'Cochez cette option si vous utilisez un �diteur WYSIWYG. <strong>NOTE :</strong> cette option n�cessite obligatoirement l\'installation effective d\'un WYSIWYG');
define('_MSNL_CFG_HLP_WYSIWYGROWS',					'Ceci d�finit le nombre de lignes qui sont rendues disponibles pour la r�daction du texte de la lettre d\'information {TEXTBODY}. Fonctionne avec et sans WYSIWYG.');

//Show Options

define('_MSNL_CFG_LAB_SHOWOPT',						'Options d\'affichage');
define('_MSNL_CFG_LAB_SHOWCATS',					'Afficher les cat�gories');
define('_MSNL_CFG_LAB_SHOWHITS',					'Afficher les hits');
define('_MSNL_CFG_LAB_SHOWDATES',					'Afficher les dates d\'envoie');
define('_MSNL_CFG_LAB_SHOWSENDER',					'Afficher l\'exp�diteur');

define('_MSNL_CFG_HLP_SHOWCATS',					'Si coch�, affichera les cat�gories dans la lettre d\'information. Les cat�gories seront aussi montr�es dans les archives du module');
define('_MSNL_CFG_HLP_SHOWHITS',					'Si coch�, affichera le nombre de vue d\'une lettre d\'information dans le bloc et dans les archives.');
define('_MSNL_CFG_HLP_SHOWDATES',					'Si coch�, affichera la date d\'envoie de chaque lettre d\'information dans le bloc et dans les archives.');
define('_MSNL_CFG_HLP_SHOWSENDER',					'Si coch�, affichera le nom de l\'exp�diteur de la lettre d\'information dans le bloc et dans les archives.');

//Block Options

define('_MSNL_CFG_LAB_BLKOPT',						'Options du bloc');
define('_MSNL_CFG_LAB_BLKLMT',						'Nombre de lettres affich�es dans le bloc');
define('_MSNL_CFG_LAB_SCROLL',						'Utiliser le mode d�filant du bloc');
define('_MSNL_CFG_LAB_SCROLLHEIGHT',				'Hauteur du bloc d�filant');
define('_MSNL_CFG_LAB_SCROLLAMT',					'Pas de d�filement');
define('_MSNL_CFG_LAB_SCROLLDELAY',					'D�lais de d�filement');

define('_MSNL_CFG_HLP_BLKLMT',						'Limite le nombre de lettres d\'information � afficher dans le bloc. Si l\'affichage des cat�gories est coch�, cette option est � d�finir en �ditant les cat�gories concern�es.');
define('_MSNL_CFG_HLP_SCROLL',						'Cette option permet de faire d�filer vers le haut le contenu du bloc.');
define('_MSNL_CFG_HLP_SCROLLHEIGHT',				'D�finit la hauteur en pixel du bloc, par d�faut la taille est de 180. Faire attention de ne pas le mettre trop petit sous peine de visibilit� r�duite.');
define('_MSNL_CFG_HLP_SCROLLAMT',					'D�finit le pas de d�filement en pixel du bloc. Par d�faut la valeur est de 2.');
define('_MSNL_CFG_HLP_SCROLLDELAY',					'D�finit en millisecondes le temps d\'attente entre chaque d�filement du bloc. La valeur par d�faut est de 25.');

/************************************************************************
* Function: msnl_cfg_apply	(Apply Changes to Main Configuration)
************************************************************************/

define('_MSNL_CFG_APPLY_ERR_DBFAILED',				'La mise � jour d\'information de configuration a �chou� ');

define('_MSNL_CFG_APPLY_VAL_DEBUGMODE',				'Un invalide mode de d�bugage a �t� fournit - pourrait provenir d\'une mauvaise installation du module.');
define('_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT',			'Un message invalide de d�bugage a �t� fournit - pourrait provenir d\'une mauvaise installation du module.');

define('_MSNL_CFG_APPLY_MSG_BACK',					'Retour au menu de configuration');

/************************************************************************
* Function: msnl_cat	(Maintain Newsletter Categories)
************************************************************************/

define('_MSNL_CAT_LAB_CATCFG',						'Configuration des cat�gories de lettre');

define('_MSNL_CAT_LAB_ADDCAT',						'Ajouter une cat�gorie');
define('_MSNL_CAT_LAB_CATTITLE',					'Titre de la cat�gorie');
define('_MSNL_CAT_LAB_CATDESC',						'Description de la cat�gorie');
define('_MSNL_CAT_LAB_CATBLOCKLMT',					'Limite du bloc');

define('_MSNL_CAT_LNK_ADDCAT',						'Add a new newsletter category');
define('_MSNL_CAT_LNK_CATCHG',						'Editer une cat�gorie de lettre');
define('_MSNL_CAT_LNK_CATDEL',						'Supprimer une cat�gorie de lettre');

define('_MSNL_CAT_MSG_CATBACK',						'Retour � la liste des cat�gories');

define('_MSNL_CAT_ERR_DBGETCAT',					'N\'a pu obtenir l\'information sur la cat�gorie de la lettre d\'information');
define('_MSNL_CAT_ERR_DBGETCATS',					'N\'a pu obtenir les informations sur les cat�gories des lettres d\'information.');
define('_MSNL_CAT_ERR_NOCATS',						'No categories found - Major problem with installation');
define('_MSNL_CAT_ERR_INVALIDCID',					'Une ID de cat�gorie de lettre d\'information a �t� fournie');
define('_MSNL_CAT_ERR_DBGETCNT',					'Echec dans le comptage des lettres d\'information.');

define('_MSNL_CAT_HLP_CATTITLE',					'Ce champ est le titre de la cat�gorie qui s\'affichera dans le bloc (si permis dans les options de configuration) et dans les archives de lettre d\'information. Comme cette information est emply�e dans le bloc pour grouper les lettres, il est pr�f�rable de ne pas d�passer 30 caract�res.');
define('_MSNL_CAT_HLP_CATDESC',						'Ceci est la description d�taill�e de la cat�gorie.'
  );
define('_MSNL_CAT_HLP_CATBLOCKLMT',					'Ce champ n\'est utilis� seulement si le champ <b>afficher les cat�gories</b> est activ� et doit �tre sup�rieure � z�ro. Entrez le nombre de lettre d\'information � afficher dans le bloc pour cette cat�gorie. Si aucune valeur n\'est fournie, elle sera par d�faut de ');

/************************************************************************
* Function: msnl_cat_add
************************************************************************/

define('_MSNL_CAT_ADD_LAB_CATADD',					'Configuration des cat�gories de lettre - Ajouter une cat�gorie');

/************************************************************************
* Function: msnl_cat_add_apply
************************************************************************/

define('_MSNL_CAT_ADD_APPLY_DBCATADD',				'Echec de l\'ajout de la cat�gorie de lettre d\'information.');

/************************************************************************
* Function: msnl_cat_chg
************************************************************************/

define('_MSNL_CAT_CHG_LAB_CATCHG',					'Configuration des cat�gories de lettre - Modifier la cat�gorie');

define('_MSNL_CAT_CHG_MSG_CHGIMPACT',				'Lettre(s) affect�e(s) par le changement');

/************************************************************************
* Function: msnl_cat_chg_apply
************************************************************************/

define('_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG',			'La mise � jour de la cat�gorie de lattre d\'information a �chou�.');

/************************************************************************
* Function: msnl_cat_del
************************************************************************/

define('_MSNL_CAT_DEL_MSG_DELIMPACT',				'Lettres d\'information seront impact�es par cette suppression');
define('_MSNL_CAT_DEL_MSG_DELIMPACT1',				'Les lettres impact�es par cette suppressions seront assign�es par d�faut � la c�t�gorie \'non assign�e\'. Souhaitez vous continuer cette suppression ?');

/************************************************************************
* Function: msnl_cat_del_apply
************************************************************************/

define('_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN',		'La rattribution des lettres d\'information a �chou�.');
define('_MSNL_CAT_DEL_APPLY_ERR_DBDELETE',			'La suppression de la cat�gorie de lettre d\'information a �chou�.');

/************************************************************************
* Function: msnl_nls
************************************************************************/

define('_MSNL_NLS_LAB_NLSCFG',						'Maintenance des lettres');
define('_MSNL_NLS_LAB_CURRENTCAT',					'Cat�gories actuelles');
define('_MSNL_NLS_LAB_DATESENT',					'Date d\'envoi');
define('_MSNL_NLS_LAB_CATEGORY',					'Cat�gorie');

define('_MSNL_NLS_LNK_GETNLS',						'Obtenir la lmettre d\'information demand�e');
define('_MSNL_NLS_LNK_VIEWNL',						'Voir la lettre d\'information - s\'ouvre dans une nouvelle fen�tre');
define('_MSNL_NLS_LNK_NLSCHG',						'Editer les information de la lettre');
define('_MSNL_NLS_LNK_NLSDEL',						'Supprimer la lettre');

define('_MSNL_NLS_MSG_NONLSS',						'Pas de lettre(s) trouv�e(s) pour cette cat�gorie');
define('_MSNL_NLS_MSG_NLSBACK',						'Retour � la liste des lettres');

define('_MSNL_NLS_ERR_DBGETNLSS',					'Echec de l\'obtention de la lettre d\'information');
define('_MSNL_NLS_ERR_DBGETNLS',					'Echec de l\'obtention des informations de la lettre d\'information');

define('_MSNL_NLS_ERR_INVALIDNID',					'Une ID invalide de lettre d\'information a �t� fournie');
define('_MSNL_NLS_ERR_NONLSS',						'	Pas de lettres dinformations trouv�es - Probl�me majeur avec l\'installation du module.');

/************************************************************************
* Function: msnl_nls_chg
************************************************************************/

define('_MSNL_NLS_CHG_LAB_NLSCHG',					'Maintenance des lettres d\'informations - Changer les informations des lettres');
define('_MSNL_NLS_CHG_LAB_DATESENT',				'Date d\'envoie');
define('_MSNL_NLS_CHG_LAB_WHOVIEW',					'Qui peut voir la lettre d\'information');
define('_MSNL_NLS_CHG_LAB_NSNGRPS',					'Quel groupe NSN peut voir la lettre d\'information');
define('_MSNL_NLS_CHG_LAB_NBRHITS',					'Nombre de vues');
define('_MSNL_NLS_CHG_LAB_FILENAME',				'Nom du fichier de la lettre d\'information');
define('_MSNL_NLS_CHG_LAB_CAUTION',					'Ne changer les valeurs ci-dessous SEULEMENT si vous savez ce que vous faites.');

define('_MSNL_NLS_CHG_HLP_DATESENT', 				'Actuellement la date doit �tre �crite dans le format AAAA-MM-JJ comme affich� ci-contre. Lorsque la lettre d\'information a �t� cr��e et envoy�e, ce champ a �t� compl�t� avec la date courante du syst�me. Les lettres d\'informations sont toujours �num�r�es dans l\'ordre des dates avec la plus r�cente au-dessus.');
define('_MSNL_NLS_CHG_HLP_WHOVIEW', 				'Ce champ est assign� au syst�me, faire attention en le changeant. Les valeurs valides sont : <br /><strong>0</strong> = anonymes - tout le monde peut la voir<br /><strong>1</strong> = tous les utilisateurs enregistr�s<br /><strong>2</strong> = seulement ceux qui ont souscrit � la lettre<br /><strong>3</strong> = seulement aux membres abonn�s<br /><strong>4</strong> = seulement aux groupes NSN s�lectionn�s<br /><strong>5</strong> = seulement � la liste de distribution<br /><strong>99</strong> = seulement � l\'administrateur.');
define('_MSNL_NLS_CHG_HLP_NSNGRPS', 				'Requier que l\'option ci-dessus soit plac� sur 4 pour \'groupe NSN seulemenr\'. Chaque groupe NSN � un champ sp�cifique d\'identification. Au moment de cr�er et d\'envoyer une lettre d\'information, il est possible de choisir un ou plusieurs groupes NSN destinataire de la lettre. Pour seulement un groupe ce champ ne devrait avoir qu\'un seul ID de groupe. Pour plus d\'un groupe, chaque ID identifiant les groupes doivent �tre s�par� par un tiret, par exemple : <b>1-2-3</b>');
define('_MSNL_NLS_CHG_HLP_NBRHITS',					'Lorsqu\'une lettre d\'information est visualis� en utilsant le lien du bloc ou des archives, chaque vue est comptabilis�e. Seules les vues de l\'administrateur ne sont pas comptabilis�es');
define('_MSNL_NLS_CHG_HLP_FILENAME',				'Ce champ est assign� au syst�me. Si vous le changez, assurez vous que le nom du fichier existe et qu\'il fonctionne correctement.');

/************************************************************************
* Function: msnl_nls_chg_apply
************************************************************************/

define('_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW',			'La valeur doit �tre de 0, 4 ou 99');

define('_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG',			'La mise � jour de la lettre d\'information a �chou�');

/************************************************************************
* Function: msnl_nls_del
************************************************************************/

define('_MSNL_NLS_DEL_MSG_DELIMPACT',				'Vous �tes sur le point de supprimer de mani�re permanente cette lettre d\'information.');
define('_MSNL_NLS_DEL_MSG_DELIMPACT1',				'Toutes les informations li�es � cette lettre d\'information seront supprim�es de la base de donn�es et du r�pertoire des archives. Souhaitez vous continuer la suppression ?');

/************************************************************************
* Function: msnl_nls_del_apply
************************************************************************/

define('_MSNL_NLS_DEL_APPLY_ERR_FILEDEL',			'Impossible de supprimer la lettre d\'information du r�pertoire des archives - v�rifiez les permissions de ce r�pertoire'
  );

define('_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL',			'La suppression de la lettre d\'information a �chou�.');

?>