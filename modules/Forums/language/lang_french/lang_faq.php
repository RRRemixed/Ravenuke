<?php
/***************************************************************************
 *                          lang_faq.php [French]
 *                            -------------------
 *   begin                : Wednesday Oct 3, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: lang_faq.php 3208 2002-12-18 15:40:21Z psotfx $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/***************************************************************************
 *                         Translation: Informations
 *
 *   Version: 1.0.2
 *   Date: 07/03/2008 20:44:45
 *   Author: Xaphos (Ma�l Soucaze)
 *   Website: http://www.phpbb.fr/
 *
 ***************************************************************************/

/* CONTRIBUTORS:
	2002-12-15	Philip M. White (pwhite@mailhaven.com)
		Fixed many minor grammatical problems.
*/
 
// 
// To add an entry to your FAQ simply add a line to this file in this format:
// $faq[] = array("question", "answer");
// If you want to separate a section enter $faq[] = array("--","Block heading goes here if wanted");
// Links will be created automatically
//
// DO NOT forget the ; at the end of the line.
// Do NOT put double quotes (") in your FAQ entries, if you absolutely must then escape them ie. \"something\"
//
// The FAQ items will appear on the FAQ page in the same order they are listed in this file
//
 
  
$faq[] = array("--","Probl�mes de connexion et d'inscription");
$faq[] = array("Pourquoi ne puis-je pas me connecter ?", "�tes-vous inscrit ? S�rieusement, vous devez �tre inscrit avant de pouvoir vous connecter. Avez-vous �t� banni du forum ? Un message appara�tra et vous en informera. Si vous l'�tes, vous devriez contacter le webmaster ou l'administrateur du forum afin de lui demander pourquoi. Si vous �tes inscrit, que vous n'�tes pas banni et que vous n'arrivez toujours pas � vous connecter, alors v�rifiez scrupuleusement le nom d'utilisateur et le mot de passe que vous avez saisi. Si vous continuez � rencontrer tout de m�me ce probl�me, veuillez contacter l'administrateur, il se peut qu'il ai mal configur� le forum.");
$faq[] = array("Pourquoi ai-je besoin de m'inscrire, apr�s tout ?", "Vous pouvez ne pas le faire, il appartient � l'administrateur du forum d'exiger ou non que vous soyez inscrit afin de pouvoir publier des messages. Cependant, l'inscription vous donnera acc�s � des fonctionnalit�s suppl�mentaires qui ne sont pas disponibles aux visiteurs, comme les avatars personnalis�s, la messagerie priv�e, l'envoi d'e-mail aux autres utilisateurs, l'adh�sion � un groupe d'utilisateurs, etc. Cela ne vous prend qu'un court instant et nous vous recommandons par cons�quence de le faire.");
$faq[] = array("Pourquoi suis-je d�connect� automatiquement ?", "Si vous ne cochez pas la case <i>Me connecter automatiquement lors de chaque visite</i> lors de votre connexion au forum, vous ne resterez connect� que pour une p�riode pr�d�finie. Cette pr�vention emp�che l'utilisation de votre compte par une personne malveillante. Pour rester connect�, cochez cette case lors de votre connexion, mais ce n'est pas recommand� si vous acc�dez au forum par un ordinateur public, par exemple dans une librairie, un cybercaf�, une universit�, etc.");
$faq[] = array("Comment puis-je emp�cher l'apparition de mon nom d'utilisateur dans la liste des utilisateurs en ligne ?", "Vous trouverez dans votre profil l'option <i>Masquer mon statut en ligne</i> ; si vous r�glez celle-ci sur <i>Activ�</i>, vous n'appara�trez qu'aux administrateurs du forum ou � vous-m�me. Vous serez alors compt� en tant qu'utilisateur invisible.");
$faq[] = array("J'ai perdu mon mot de passe !", "Pas de panique ! Bien que votre mot de passe ne puisse pas �tre r�cup�r�, il peut facilement �tre r�initialis�. Rendez-vous sur la page de connexion et cliquez sur <u>J'ai perdu mon mot de passe</u>. Suivez les instructions et vous devriez pouvoir vous connecter de nouveau.");
$faq[] = array("Je suis inscrit mais ne peux pas me connecter !", "Premi�rement, v�rifiez votre nom d'utilisateur et votre mot de passe. S'ils sont corrects, alors une des deux choses suivantes a pu s'�tre produite. Si le support de la COPPA est activ� et que vous avez sp�cifi� avoir en dessous de 13 ans pendant l'inscription, vous devrez suivre les instructions que vous avez re�ues. Certains forums exigeront �galement que les nouvelles inscriptions doivent �tre activ�es, par vous-m�me ou par un administrateur, avant que vous puissiez ouvrir une session ; cette information �tait affich�e pendant l'inscription. Si un e-mail vous a d�j� �t� envoy�, suivez les instructions. Si vous n'avez pas re�u d'e-mail, vous avez pu avoir sp�cifi� une adresse e-mail incorrecte ou l'e-mail a pu avoir �t� consid�r� comme un courrier ind�sirable. Si vous �tes certain que l'adresse de e-mail sp�cifi�e est correcte, essayez de contacter un administrateur.");
$faq[] = array("Je m'�tais d�j� inscrit mais ne peux plus me connecter � pr�sent ?!", "Essayez de retrouver l'e-mail qui vous a �t� envoy� lorsque vous vous �tes inscrit pour la premi�re fois, v�rifiez votre nom d'utilisateur et votre mot de passe et r�essayez. Il est possible qu'un administrateur ait d�sactiv� ou ait supprim� votre compte pour une certaine raison. Beaucoup de forums suppriment p�riodiquement les utilisateurs qui n'ont rien publi�s depuis un certain temps afin de r�duire la taille de la base de donn�es. Si tel �tait le cas, inscrivez-vous � nouveau et essayez de participer plus activement aux discussions.");


$faq[] = array("--","Pr�f�rences et r�glages des utilisateurs");
$faq[] = array("Comment puis-je modifier mes r�glages ?", "Si vous �tes un utilisateur inscrit, tous vos r�glages sont stock�s dans la base de donn�es du forum. Pour les modifier, rendez-vous sur votre <u>Profil</u> ; ce lien se situe en haut de toutes les pages du forum. Cela vous permettra de modifier tous vos r�glages.");
$faq[] = array("L'heure n'est pas correcte !", "Il est possible que l'heure affich�e soit r�gl�e sur un fuseau horaire diff�rent de celui dans lequel vous �tes. Si tel �tait le cas, rendez-vous sur votre profil et modifiez le fuseau horaire afin de trouver votre zone ad�quate, par exemple Londres, Paris, New York, Sydney, etc. Veuillez noter que la modification du fuseau horaire, comme la plupart des r�glages, n'est accessible qu'aux utilisateurs inscrits. Si vous n'�tes pas inscrit, c'est le moment id�al de le faire.");
$faq[] = array("J'ai modifi� le fuseau horaire et l'heure n'est toujours pas correcte !", "Si vous �tes certain d'avoir r�gl� le fuseau horaire et l'heure d'�t� correctement mais que l'heure est encore erron�e, il se peut que ce soit alors l'heure d'�t� qui est active alors que vous �tes en heure d'hiver, ou le contraire. Essayez de trouver la bonne heure en ajoutant ou en enlevant une heure, car phpBB2 ne supporte pas les heures sp�ciales.");
$faq[] = array("Ma langue n'appara�t pas dans la liste !", "Soit l'administrateur n'a pas install� votre langue, soit personne n'a encore traduit phpBB dans votre langue. Essayez de demander � l'administrateur du forum s'il peut installer le pack de langue que vous d�sirez. Si le pack de langue n'existe pas, vous �tes libre de vous porter volontaire afin de cr�er une nouvelle traduction. Pour plus d'informations, veuillez vous rendre sur le site de phpBB.com (voir le lien situ� en bas des pages du forum).");
$faq[] = array("Comment puis-je afficher une image sous mon nom d'utilisateur ?", "Il y a deux images qui peuvent appara�tre sous un nom d'utilisateur lors de la consultation des messages. La premi�re peut �tre une image associ�e � votre rang, g�n�ralement en forme d'�toiles, de carr�s ou de ronds, qui indiquent le nombre de messages � votre actif ou votre statut sur le forum. La seconde, habituellement une plus grande image, est connue en tant qu'avatar et est g�n�ralement unique ou personnelle � chaque utilisateur. C'est � l'administrateur du forum d'activer les avatars et de d�cider de la mani�re dont ils sont mis � disposition. Si vous ne pouvez pas utiliser d'avatars, contactez l'administrateur du forum et demandez-lui pour quelles raisons a t'il prit la d�cision de d�sactiver cette fonctionnalit�.");
$faq[] = array("Comment puis-je modifier mon rang ?", "Les rangs, qui apparaissent en dessous de votre nom d'utilisateur, indiquent le nombre de messages que vous avez publi�s ou identifient certains utilisateurs, comme les mod�rateurs et les administrateurs. Dans la plupart des cas, vous ne pouvez pas directement modifier le texte des rangs du forum car ils sont r�gl�s par l'administrateur du forum. Veuillez ne pas abuser en publiant inutilement des messages seulement afin d'augmenter votre rang sur le forum. Beaucoup de forums ne tol�reront pas cela, et un mod�rateur ou un administrateur abaissera votre compteur de messages.");
$faq[] = array("Lorsque je clique sur le lien de l'e-mail d'un utilisateur, il m'est demand� de me connecter ?", "Seuls les utilisateurs inscrits peuvent envoyer des e-mail aux autres utilisateurs par l'interm�diaire du formulaire e-mail int�gr� et seulement si l'administrateur a activ� cette fonctionnalit�. Cela � pour but d'emp�cher toute utilisation malveillante du syst�me e-mail par des utilisateurs anonymes ou par des agents automatis�s.");


$faq[] = array("--","Probl�mes de publication");
$faq[] = array("Comment puis-je publier un sujet dans un forum ?", "Pour publier un nouveau sujet dans un forum, cliquez sur le bouton ad�quat situ� sur l'�cran du forum ou du sujet. Il se peut que vous ayez besoin d'�tre inscrit avant de pouvoir r�diger un message. Une liste de vos permissions sur chaque forum est disponible en bas de l'�cran du forum ou du sujet. Par exemple : <i>vous pouvez publier de nouveaux sujets</i>, <i>vous pouvez voter dans les sondages</i>, etc.");
$faq[] = array("Comment puis-je �diter ou supprimer un message ?", "� moins que vous ne soyez un administrateur ou un mod�rateur du forum, vous ne pouvez �diter ou supprimer que vos propres messages. Vous pouvez �diter un message en cliquant le bouton ad�quat, parfois dans une limite de temps apr�s que le message ait �t� publi�. Si quelqu'un a d�j� r�pondu au message, vous trouverez un petit bout de texte en dessous du message lorsque vous revenez au sujet qui �num�re le nombre de fois que vous l'avez �dit�, avec la date et l'heure. Ceci n'appara�tra que si quelqu'un a effectu� une r�ponse ; cela n'appara�tra pas si un mod�rateur ou un administrateur a �dit� le message, bien qu'ils puissent laisser une note expliquant pourquoi ils ont �dit� le message. Veuillez noter que les utilisateurs normaux ne peuvent pas supprimer de message une fois que quelqu'un y a r�pondu.");
$faq[] = array("Comment puis-je ajouter une signature � un message ?", "Pour ajouter une signature � un message, vous devez tout d'abord en cr�er une par l'interm�diaire de votre profil. Une fois cr��e, vous pouvez cocher la case <i>Ins�rer une signature</i> sur le formulaire de r�daction afin d'ajouter votre signature. Vous pouvez �galement ajouter une signature par d�faut sur tous vos messages en cochant la case appropri�e dans votre profil. Si vous faites cela, vous pouvez alors emp�cher l'ajout individuel de la signature sur les messages en d�cochant la case d'ajout de la signature dans le formulaire de r�daction.");
$faq[] = array("Comment puis-je cr�er un sondage ?", "Lorsque vous r�digez un nouveau sujet ou �ditez le premier message d'un sujet, vous devriez voir le formulaire <i>Ajouter un sondage</i> en dessous du formulaire de r�daction. Si vous ne pouvez pas le voir, c'est que vous n'avez pas les permissions appropri�es afin de cr�er des sondages. Veuillez saisir un titre pour le sondage en incluant au moins deux options. Pour cela, cliquez sur le bouton <i>Ajouter une option</i>. Vous pouvez �galement r�gler une limite de temps en jours pour le sondage, avec 0 pour une dur�e illimit�.");
$faq[] = array("Comment puis-je �diter ou supprimer un sondage ?", "Comme avec les messages, les sondages ne peuvent �tre �dit�s que par leur auteur, un mod�rateur ou un administrateur. Pour �diter un sondage, �ditez le premier message du sujet ; il y aura toujours le sondage associ� � celui-ci. Si personne n'a vot�, les utilisateurs peuvent supprimer le sondage ou �diter chaque option du sondage. Cependant, si les membres ont d�j� exprim�s leurs votes, seuls les mod�rateurs ou les administrateurs peuvent l'�diter ou le supprimer. Cela emp�che les options d'un sondage � �tre modifi�s en cours de route.");
$faq[] = array("Pourquoi ne puis-je pas acc�der au forum ?", "Certains forums peuvent �tre limit�s � certains utilisateurs ou groupes d'utilisateurs. Pour consulter, lire, publier ou r�aliser n'importe quelle autre action, vous avez besoin de permissions sp�ciales. Contactez un mod�rateur ou un administrateur du forum afin de demander votre acc�s.");
$faq[] = array("Pourquoi ne puis-je pas voter dans les sondages ?", "Seuls les utilisateurs inscrits peuvent voter dans les sondages afin de lutter contre un abus de votes. Si vous �tes inscrit et que vous ne pouvez toujours pas exprimer votre vote, il est possible que vous n'ayez pas les permissions appropri�es.");


$faq[] = array("--","Mise en forme et types de sujets");
$faq[] = array("Qu'est-ce que le BBCode ?", "Le BBCode est une impl�mentation sp�ciale de l'HTML, offrant un meilleur contr�le sur la mise en forme d'un message. L'utilisation du BBCode est d�termin�e par l'administrateur, mais vous pouvez �galement le d�sactiver sur chacun des messages depuis le formulaire de r�daction. Le BBCode est similaire � l'architecture de l'HTML, les balises sont contenues entre des crochets [ et ] � la place de &lt; et &gt;. Pour plus d'informations � propos du BBCode, veuillez consulter le guide qui est accessible depuis la page de r�daction.");
$faq[] = array("Puis-je utiliser de l'HTML ?", "Cela d�pend des permissions attribu�es par l'administrateur. Si vous �tes autoris� � l'utiliser, seules certaines balises risquent de fonctionner. Ceci est une fonctionnalit� de <i>s�curit�</i> afin d'�viter que les utilisateurs n'abusent des balises en d�formant l'affichage d'un sujet ou � causer d'autres probl�mes. Si l'HTML est activ�, vous pouvez le d�sactiver sur chacun de vos messages depuis le formulaire de r�daction.");
$faq[] = array("Que sont les �motic�nes ?", "Les �motic�nes, ou smileys, sont de petites images qui peuvent �tre utilis�es afin d'exprimer des sentiments, en utilisant un code court. Par exemple, :) exprime la joie alors que :( exprime la tristesse. La liste compl�te des �motic�nes peut �tre affich�e depuis le formulaire de r�daction. Essayez cependant de ne pas abuser des �motic�nes, car elles peuvent rapidement rendre un message illisible et un mod�rateur pourrait d�cider de l'�diter ou de le supprimer compl�tement.");
$faq[] = array("Puis-je publier des images ?", "Des images peuvent �tre affich�es dans vos messages. Cependant, il n'est pas possible de transf�rer directement des images � partir de votre ordinateur sur le forum. vous devez faire un lien vers une image stock�e sur un serveur Internet accessible publiquement, par exemple http://www.example.com/mon-image.gif. Vous ne pouvez ni faire de lien vers des images stock�es sur votre propre ordinateur (� moins que celui-ci soit un serveur Internet), ni faire de lien vers des images stock�es derri�re un quelconque syst�me d'authentification, par exemple les bo�tes e-mail Hotmail ou Yahoo, les sites prot�g�s par un mot de passe, etc. Pour ins�rer une image, utilisez la balise BBCode [img] ou la balise HTML, si celui-ci est activ�, appropri�e.");
$faq[] = array("Que sont les annonces ?", "Les annonces contiennent souvent des informations importantes pour le forum dans lequel vous naviguez et vous devriez les consulter aussi vite que possible. Les annonces apparaissent en haut de chaque page du forum dans lequel elles ont �t� publi�es. Les permissions des annonces sont d�finies par l'administrateur du forum.");
$faq[] = array("Que sont les notes ?", "Les notes apparaissent sous les annonces et seulement sur la premi�re page du forum consult�. Elles sont souvent assez importantes et vous devriez les consulter d�s que vous en avez l'occasion. Tout comme les annonces, les permissions des notes sont d�finies par l'administrateur du forum.");
$faq[] = array("Que sont les sujets verrouill�s ?", "Les sujets verrouill�s sont les sujets dans lesquels les utilisateurs ne peuvent plus r�pondre et dans lesquels les sondages sont automatiquement termin�s. Les sujets peuvent �tre verrouill�s pour de nombreuses raisons et ont �t� mis de cette fa�on par un mod�rateur ou un administrateur du forum.");


$faq[] = array("--","Niveaux d'utilisateurs et groupes d'utilisateurs");
$faq[] = array("Qui sont les administrateurs ?", "Les administrateurs sont des membres poss�dant le plus haut niveau de contr�le sur le forum. Ces utilisateurs peuvent contr�ler chaque facette des op�rations du forum, incluant le r�glage des permissions, le bannissement d'utilisateurs, la cr�ation de groupes d'utilisateurs ou de mod�rateurs, etc. Ils peuvent �galement d�tenir les m�mes capacit�s que les mod�rateurs et cela dans tous les forums.");
$faq[] = array("Qui sont les mod�rateurs ?", "Les mod�rateurs sont des utilisateurs individuels (ou groupes d'utilisateurs individuels) qui surveillent jour apr�s jour les forums. Ils ont la possibilit� d'�diter ou de supprimer les sujets, les verrouiller, les d�verrouiller, les d�placer, les supprimer et les diviser dans le forum qu'ils mod�rent. En r�gle g�n�rale, les mod�rateurs sont pr�sents afin d'emp�cher que des utilisateurs fassent du <i>hors-sujet</i> ou publient du contenu abusif ou offensant.");
$faq[] = array("Qui sont les groupes d'utilisateurs ?", "Les groupes d'utilisateurs sont une fa�on pour les administrateurs du forum de regrouper plusieurs utilisateurs. Chaque utilisateur peut appartenir � plusieurs groupes et chaque groupe peut �tre avoir des permissions individuelles. Cela rend les t�ches plus faciles aux administrateurs car ils peuvent modifier les permissions de plusieurs utilisateurs en une seule fois, ou encore leur accorder des pouvoirs de mod�ration, ou bien leur donner acc�s � un forum priv�, etc.");
$faq[] = array("Comment puis-je rejoindre un groupe d'utilisateurs ?", "Pour rejoindre un groupe d'utilisateurs, cliquez sur le lien des groupes d'utilisateurs en haut du forum et vous pourrez voir tous les groupes d'utilisateurs. Tous les groupes ne sont cependant pas <i>ouverts</i>, certains sont ferm�s ou ont leurs adh�rents invisibles. Si le groupe est ouvert, vous pouvez le rejoindre en cliquant sur le bouton appropri�. Le responsable du groupe devra approuver votre demande ; il vous demandera sans doute la raison de votre souhait. Merci de ne pas harceler un responsable de groupe s'il refuse votre demande : il doit avoir ses propres raisons.");
$faq[] = array("Comment puis-je devenir le responsable d'un groupe ?", "Le responsable du groupe est g�n�ralement assign� lorsque les groupes d'utilisateurs sont initialement cr��s par un administrateur du forum. Si vous �tes int�ress� par la cr�ation d'un groupe d'utilisateurs, votre premier contact devrait �tre un administrateur ; essayez de lui envoyer un message priv�.");


$faq[] = array("--","Messagerie priv�e");
$faq[] = array("Je ne peux pas envoyer de messages priv�s !", "Il y a trois raisons qui peuvent en �tre la cause ; soit vous n'�tes pas inscrit ou connect�, soit un administrateur a d�sactiv� enti�rement la messagerie priv�e sur le forum ou soit il vous emp�che d'envoyer des messages priv�s. Si c'est le dernier cas, vous devriez demander la raison � l'administrateur du forum.");
$faq[] = array("Je continue � recevoir des messages priv�s non sollicit�s !", "Dans phpBB3, nous avons ajout�s cette fonctionnalit�, mais elle n'est malheureusement pas pr�sente dans phpBB2. Vous ne pouvez lutter contre cela qu'en avertissant l'administrateur du forum afin qu'il puisse d�sactiver la messagerie priv�e � l'utilisateur fautif.");
$faq[] = array("J'ai re�u un spam ou un e-mail non d�sir� de la part de quelqu'un sur ce forum !", "Nous en sommes d�sol�s. Le formulaire d'envoi d'e-mail de ce forum poss�de des protections afin d'essayer de d�pister les utilisateurs qui envoient de tels messages. Vous devriez envoyer par e-mail � un administrateur du forum une copie compl�te de l'e-mail que vous avez re�u. Il est tr�s important que celui-ci inclut les en-t�tes contenant les informations de l'auteur de l'e-mail. Il pourra alors agir en cons�quence.");

//
// These entries should remain in all languages and for all modifications
//
$faq[] = array("--","Questions � propos de phpBB2");
$faq[] = array("Qui a �crit ce syst�me de forum ?", "Ce programme (dans sa forme non modifi�e) est produit, distribu� et est sous copyright par le <a href=\"http://www.phpbb.com/\" target=\"_blank\">phpBB Group</a>. Il est rendu accessible sous la Licence Publique G�n�rale GNU et peut �tre distribu� gratuitement. Pour plus d'informations, veuillez cliquer sur le lien.");
$faq[] = array("Pourquoi la fonctionnalit� X n'est pas disponible ?", "Ce programme a �t� �crit et mis sous licence par le phpBB Group. Si vous pensez qu'une fonctionnalit� n�cessite d'�tre ajout�e, veuillez vous rendre sur le site Internet de phpBB.com, proposez-la au phpBB Group et attendez leurs avis. Merci de ne pas envoyer directement de requ�tes d'ajout de fonctionnalit�s sur le forum de phpBB.com, le phpBB Group utilise SourceForge afin de g�rer ce type de requ�tes. Veuillez consulter les forums afin de connaitre notre position, si nous en avons une, par rapport � cette fonctionnalit�, et suivre la proc�dure sp�cifi�e l�-bas.");
$faq[] = array("Qui dois-je contacter � propos de probl�mes d'abus ou d'ordres l�gaux li�s � ce forum ?", "Vous devriez contacter l'administrateur de ce forum. Si vous ne savez pas qui s'est, demandez � un mod�rateur. Si vous n'obtenez aucune r�ponse de sa part, vous devriez alors contacter le propri�taire du domaine (faites un whois) ou, si celui-ci fonctionne sur un service gratuit (comme Yahoo!, Free.fr, f2s.com, etc.), le service de gestion des abus. Veuillez notez que le phpBB Group n'a absolument aucune juridiction et ne peut en aucun cas �tre tenu comme responsable de comment, o� et par qui ce forum est utilis�. Ne contactez pas le phpBB Group pour tout probl�me d'ordre l�gal (commentaire incessant, insultant, diffamatoire, etc.) qui n'ont pas directement de relation avec le site Internet de phpBB.com ou le script phpBB en lui-m�me. Si vous envoyez un e-mail au phpBB Group � propos d'une utilisation de tierce partie de ce logiciel, attendez-vous � une r�ponse laconique ou � aucune r�ponse, tout simplement.");

//
// This ends the FAQ entries
//

?>
