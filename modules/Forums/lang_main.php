<?php
/***************************************************************************
 *                            lang_main.php [French]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_main.php 6772 2006-12-16 13:11:28Z acydburn $
 *
 ****************************************************************************/

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
 *   Date: 05/04/2008 18:08:53
 *   Author: Xaphos (Maël Soucaze)
 *   Website: http://www.phpbb.fr/
 *
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'iso-8859-1';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'gauche';
$lang['RIGHT'] = 'droite';
$lang['DATE_FORMAT'] =  'D j M Y'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = 'Traduit par Larry Kubiac &copy; 2016';	// You can delete this line to remove the visible copyright of the translation, but the copyright localised in the files MUST BE preserved, according the General Public License!

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Forum';
$lang['Category'] = 'Cat&eacute;gorie';
$lang['Topic'] = 'Sujet';
$lang['Topics'] = 'Sujets';
$lang['Replies'] = 'R&eacute;ponses';
$lang['Views'] = 'Vus';
$lang['Post'] = 'Message';
$lang['Posts'] = 'Messages';
$lang['Posted'] = 'Publi&eacute; le';
$lang['Username'] = 'Nom d\'utilisateur';
$lang['Password'] = 'Mot de passe';
$lang['Email'] = 'E-mail';
$lang['Poster'] = 'R&eacute;dacteur';
$lang['Author'] = 'Auteur';
$lang['Time'] = 'Temps';
$lang['Hours'] = 'Heures';
$lang['Message'] = 'Message';

$lang['1_Day'] = '1 jour';
$lang['7_Days'] = '7 jours';
$lang['2_Weeks'] = '2 semaines';
$lang['1_Month'] = '1 mois';
$lang['3_Months'] = '3 mois';
$lang['6_Months'] = '6 mois';
$lang['1_Year'] = '1 an';

$lang['Go'] = 'Aller';
$lang['Jump_to'] = 'Sauter vers';
$lang['Submit'] = 'Envoyer';
$lang['Reset'] = 'R&eacute;initialiser';
$lang['Cancel'] = 'Annuler';
$lang['Preview'] = 'Aperçu';
$lang['Confirm'] = 'Confirmer';
$lang['Spellcheck'] = 'V&eacute;rification orthographique';
$lang['Yes'] = 'Oui';
$lang['No'] = 'Non';
$lang['Enabled'] = 'Activ&eacute;';
$lang['Disabled'] = 'D&eacute;sactiv&eacute;';
$lang['Error'] = 'Erreur';

$lang['Next'] = 'Suivant';
$lang['Previous'] = 'Pr&eacute;c&eacute;dent';
$lang['Goto_page'] = 'Aller &agrave; la page';
$lang['Joined'] = 'Inscrit le';
$lang['IP_Address'] = 'Adresse IP';

$lang['Select_forum'] = 'S&eacute;lectionner un forum';
$lang['View_latest_post'] = 'Voir le dernier message';
$lang['View_newest_post'] = 'Voir le message le plus r&eacute;cent';
$lang['Page_of'] = 'Page <b>%d</b> sur <b>%d</b>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'Num&eacute;ro ICQ';
$lang['FB'] = 'Adresse Facebook';
$lang['TW'] = 'Adresse Tweeter';
$lang['SKYPE'] = 'Adresse Skype';
$lang['STEAM'] = 'Adresse Steam';
$lang['AIM'] = 'Adresse AIM';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = '%s Index du forum';  // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = 'Publier un nouveau sujet';
$lang['Reply_to_topic'] = 'R&eacute;pondre au sujet';
$lang['Reply_with_quote'] = 'R&eacute;pondre en citant';

$lang['Click_return_topic'] = 'Cliquez %sici%s afin de retourner au sujet'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Cliquez %sici%s afin de recommencer';
$lang['Click_return_forum'] = 'Cliquez %sici%s afin de retourner au forum';
$lang['Click_view_message'] = 'Cliquez %sici%s afin de voir le message que vous avez publi&eacute;';
$lang['Click_return_modcp'] = 'Cliquez %sici%s afin de retourner au panneau de contr&ocirc;le du mod&eacute;rateur';
$lang['Click_return_group'] = 'Cliquez %sici%s afin de retourner aux informations du groupe';

$lang['Admin_panel'] = 'Aller au panneau de contr&ocirc;le de l\'administrateur';

$lang['Board_disable'] = 'D&eacute;sol&eacute; mais ce forum est actuellement indisponible, veuillez r&eacute;essayer ult&eacute;rieurement.';


//
// Global Header strings
//
$lang['Registered_users'] = 'Utilisateurs inscrits :';
$lang['Browsing_forum'] = 'Utilisateurs parcourant actuellement ce forum :';
$lang['Online_users_zero_total'] = 'Au total, il y a <b>0</b> utilisateur en ligne :: ';
$lang['Online_users_total'] = 'Au total, il y a <b>%d</b> utilisateurs en ligne :: ';
$lang['Online_user_total'] = 'Au total, il y a <b>%d</b> utilisateur en ligne :: ';
$lang['Reg_users_zero_total'] = '0 inscrit, ';
$lang['Reg_users_total'] = '%d inscrits, ';
$lang['Reg_user_total'] = '%d inscrit, ';
$lang['Hidden_users_zero_total'] = '0 invisible et ';
$lang['Hidden_user_total'] = '%d invisible et ';
$lang['Hidden_users_total'] = '%d invisibles et ';
$lang['Guest_users_zero_total'] = '0 invit&eacute;';
$lang['Guest_users_total'] = '%d invit&eacute;s';
$lang['Guest_user_total'] = '%d invit&eacute;';
$lang['Record_online_users'] = 'Le nombre maximum d\'utilisateurs en ligne simultan&eacute;ment a &eacute;t&eacute; de <b>%s</b> le %s'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrateur%s';
$lang['Mod_online_color'] = '%sMod&eacute;rateur%s';

$lang['You_last_visit'] = 'Derni&egrave;re visite le : %s'; // %s replaced by date/time
$lang['Current_time'] = 'Nous sommes actuellement le %s'; // %s replaced by time

$lang['Search_new'] = 'Voir les messages depuis votre derni&egrave;re visite';
$lang['Search_your_posts'] = 'Voir vos messages';
$lang['Search_unanswered'] = 'Voir les messages sans r&eacute;ponse';

$lang['Register'] = 'Inscription';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = '&eacute;diter votre profil';
$lang['Search'] = 'Rechercher';
$lang['Memberlist'] = 'Liste des membres';
$lang['FAQ'] = 'FAQ';
$lang['BBCode_guide'] = 'Guide du BBCode';
$lang['Usergroups'] = 'Groupes d\'utilisateurs';
$lang['Last_Post'] = 'Dernier message';
$lang['Moderator'] = 'Mod&eacute;rateur';
$lang['Moderators'] = 'Mod&eacute;rateurs';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Nos utilisateurs ont publi&eacute;s un total de <b>0</b> message'; // Number of posts
$lang['Posted_articles_total'] = 'Nos utilisateurs ont publi&eacute;s un total de <b>%d</b> messages'; // Number of posts
$lang['Posted_article_total'] = 'Nos utilisateurs ont publi&eacute;s un total de <b>%d</b> message'; // Number of posts
$lang['Registered_users_zero_total'] = 'Nous avons <b>0</b> utilisateur inscrit'; // # registered users
$lang['Registered_users_total'] = 'Nous avons <b>%d</b> utilisateurs inscrits'; // # registered users
$lang['Registered_user_total'] = 'Nous avons <b>%d</b> utilisateur inscrit'; // # registered users
$lang['Newest_user'] = 'Le membre le plus r&eacute;cent est <b>%s%s%s</b>'; // a href, username, /a 

$lang['No_new_posts_last_visit'] = 'Il n\'y a eu aucun nouveau message depuis votre derni&egrave;re visite';
$lang['No_new_posts'] = 'Aucun nouveau message';
$lang['New_posts'] = 'Nouveaux messages';
$lang['New_post'] = 'Nouveau message';
$lang['No_new_posts_hot'] = 'Aucun nouveau message [ Populaire ]';
$lang['New_posts_hot'] = 'Nouveaux messages [ Populaire ]';
$lang['No_new_posts_locked'] = 'Aucun nouveau message [ Verrouill&eacute; ]';
$lang['New_posts_locked'] = 'Nouveaux messages [ Verrouill&eacute;s ]';
$lang['Forum_is_locked'] = 'Le forum est verrouill&eacute;';


//
// Login
//
$lang['Enter_password'] = 'Veuillez saisir votre nom d\'utilisateur et votre mot de passe afin de vous connecter.';
$lang['Login'] = 'Connexion';
$lang['Logout'] = 'D&eacute;connexion';

$lang['Forgotten_password'] = 'J\'ai perdu mon mot de passe';

$lang['Log_me_in'] = 'Me connecter automatiquement lors de chaque visite';

$lang['Error_login'] = 'Le nom d\'utilisateur ou le mot de passe que vous avez sp&eacute;cifi&eacute; est incorrect ou inactif.';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Aucun message';
$lang['No_forums'] = 'Aucun forum';

$lang['Private_Message'] = 'Message priv&eacute;';
$lang['Private_Messages'] = 'Messages priv&eacute;s';
$lang['Who_is_Online'] = 'Qui est en ligne ?';

$lang['Mark_all_forums'] = 'Marquer tous les forums comme lus';
$lang['Forums_marked_read'] = 'Tous les forums sont &agrave; pr&eacute;sent marqu&eacute;s comme lus';


//
// Viewforum
//
$lang['View_forum'] = 'Voir le forum';

$lang['Forum_not_exist'] = 'Le forum que vous avez s&eacute;lectionn&eacute; n\'existe pas.';
$lang['Reached_on_error'] = 'Vous avez atteint cette page par erreur.';

$lang['Display_topics'] = 'Afficher les sujets depuis';
$lang['All_Topics'] = 'Tous les sujets';

$lang['Topic_Announcement'] = '<b>Annonce :</b>';
$lang['Topic_Sticky'] = '<b>Note :</b>';
$lang['Topic_Moved'] = '<b>D&eacute;plac&eacute; :</b>';
$lang['Topic_Poll'] = '<b>[ Sondage ]</b>';

$lang['Mark_all_topics'] = 'Marquer tous les sujets comme lus';
$lang['Topics_marked_read'] = 'Tous les sujets de ce forum sont &agrave; pr&eacute;sent marqu&eacute;s comme lus';

$lang['Rules_post_can'] = 'Vous <b>pouvez</b> publier de nouveaux messages dans ce forum';
$lang['Rules_post_cannot'] = 'Vous <b>ne pouvez pas</b> publier de nouveaux messages dans ce forum';
$lang['Rules_reply_can'] = 'Vous <b>pouvez</b> r&eacute;pondre aux sujets dans ce forum';
$lang['Rules_reply_cannot'] = 'Vous <b>ne pouvez pas</b> r&eacute;pondre aux sujets dans ce forum';
$lang['Rules_edit_can'] = 'Vous <b>pouvez</b> &eacute;diter vos messages dans ce forum';
$lang['Rules_edit_cannot'] = 'Vous <b>ne pouvez pas</b> &eacute;diter vos messages dans ce forum';
$lang['Rules_delete_can'] = 'Vous <b>pouvez</b> supprimer vos messages dans ce forum';
$lang['Rules_delete_cannot'] = 'Vous <b>ne pouvez pas</b> supprimer vos messages dans ce forum';
$lang['Rules_vote_can'] = 'Vous <b>pouvez</b> voter dans les sondages de ce forum';
$lang['Rules_vote_cannot'] = 'Vous <b>ne pouvez pas</b> voter dans les sondages de ce forum';
$lang['Rules_moderate'] = 'Vous <b>pouvez</b> %smod&eacute;rer ce forum%s'; // %s replaced by a href links, do not remove! 

$lang['No_topics_post_one'] = 'Il n\'y a aucun message dans ce forum.<br />Cliquez sur le bouton <b>Publier un nouveau sujet</b> afin d\'en publier un.';


//
// Viewtopic
//
$lang['View_topic'] = 'Voir le sujet';

$lang['Guest'] = 'Invit&eacute;';
$lang['Post_subject'] = 'Titre du sujet';
$lang['View_next_topic'] = 'Voir le sujet suivant';
$lang['View_previous_topic'] = 'Voir le sujet pr&eacute;c&eacute;dent';
$lang['Submit_vote'] = 'Envoyer le vote';
$lang['View_results'] = 'Voir les r&eacute;sultats';

$lang['No_newer_topics'] = 'Il n\'y a aucun nouveau sujet dans ce forum';
$lang['No_older_topics'] = 'Il n\'y a aucun ancien sujet dans ce forum';
$lang['Topic_post_not_exist'] = 'Le sujet ou le message que vous recherchez n\'existe pas';
$lang['No_posts_topic'] = 'Il n\'y a aucun message dans ce sujet';

$lang['Display_posts'] = 'Afficher les messages depuis';
$lang['All_Posts'] = 'Tous les messages';
$lang['Newest_First'] = 'Le plus r&eacute;cent d\'abord';
$lang['Oldest_First'] = 'Le plus r&eacute;cent d\'abord';

$lang['Back_to_top'] = 'Revenir en haut';

$lang['Read_profile'] = 'Voir le profil de l\'utilisateur'; 
$lang['Visit_website'] = 'Visiter le site Internet du r&eacute;dacteur';
$lang['Visit_fb'] = 'Visiter le facebook du r&eacute;dacteur';
$lang['Visit_tw'] = 'Visiter le tweeter du r&eacute;dacteur';
$lang['Visit_skype'] = 'Visiter le skype du r&eacute;dacteur';
$lang['Visit_steam'] = 'Visiter le steam du r&eacute;dacteur';
$lang['Edit_delete_post'] = '&eacute;diter/Supprimer ce message';
$lang['View_IP'] = 'Voir l\'adresse IP du r&eacute;dacteur';
$lang['Delete_post'] = 'Supprimer ce message';

$lang['wrote'] = 'a &eacute;crit'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Citer'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.

$lang['Edited_time_total'] = 'Derni&egrave;re &eacute;dition par %s le %s ; &eacute;dit&eacute; %d fois au total'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'Derni&egrave;re &eacute;dition par %s le %s ; &eacute;dit&eacute; %d fois au total'; // Last edited by me on 12 Oct 2001; edited 2 times in total

$lang['Lock_topic'] = 'Verrouiller ce sujet';
$lang['Unlock_topic'] = 'D&eacute;verrouiller ce sujet';
$lang['Move_topic'] = 'D&eacute;placer ce sujet';
$lang['Delete_topic'] = 'Supprimer ce sujet';
$lang['Split_topic'] = 'Diviser ce sujet';

$lang['Stop_watching_topic'] = 'Ne plus surveiller ce sujet';
$lang['Start_watching_topic'] = 'Surveiller les r&eacute;ponses de ce sujet';
$lang['No_longer_watching'] = 'Vous ne surveillez plus ce sujet';
$lang['You_are_watching'] = 'Vous surveillez &agrave; pr&eacute;sent ce sujet';

$lang['Total_votes'] = 'Total des votes';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Corps du message';
$lang['Topic_review'] = 'Aperçu du sujet';

$lang['No_post_mode'] = 'Aucun mode n\'a &eacute;t&eacute; sp&eacute;cifi&eacute; pour ce message'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = 'Publier un nouveau sujet';
$lang['Post_a_reply'] = 'Publier une r&eacute;ponse';
$lang['Post_topic_as'] = 'Publier le sujet en tant que';
$lang['Edit_Post'] = '&eacute;diter le message';
$lang['Options'] = 'Options';

$lang['Post_Announcement'] = 'Annonce';
$lang['Post_Sticky'] = 'Note';
$lang['Post_Normal'] = 'Normal';

$lang['Confirm_delete'] = '&ecirc;tes-vous sûr de vouloir supprimer ce message ?';
$lang['Confirm_delete_poll'] = '&ecirc;tes-vous sûr de vouloir supprimer ce sondage ?';

$lang['Flood_Error'] = 'Vous ne pouvez pas publier un message aussit&ocirc;t apr&egrave;s en avoir publi&eacute; un. Veuillez r&eacute;essayer dans un court moment.';
$lang['Empty_subject'] = 'Vous devez sp&eacute;cifier un titre lorsque vous souhaitez publier un sujet.';
$lang['Empty_message'] = 'Vous devez saisir un message lorsque vous souhaitez publier.';
$lang['Forum_locked'] = 'Ce forum est verrouill&eacute; : vous ne pouvez ni publier de messages, ni publier de r&eacute;ponses et ni &eacute;diter de sujets.';
$lang['Topic_locked'] = 'Ce sujet est verrouill&eacute; : vous ne pouvez ni &eacute;diter de messages et ni publier de r&eacute;ponses.';
$lang['No_post_id'] = 'Vous devez s&eacute;lectionner un message &agrave; &eacute;diter';
$lang['No_topic_id'] = 'Vous devez s&eacute;lectionner un sujet afin d\'y r&eacute;pondre';
$lang['No_valid_mode'] = 'Vous ne pouvez que publier, r&eacute;pondre, &eacute;diter ou citer des messages. Veuillez essayer &agrave; nouveau.';
$lang['No_such_post'] = 'Il n\'y a aucun message de ce type. Veuillez essayer &agrave; nouveau.';
$lang['Edit_own_posts'] = 'D&eacute;sol&eacute; mais vous ne pouvez &eacute;diter que vos propres messages.';
$lang['Delete_own_posts'] = 'D&eacute;sol&eacute; mais vous ne pouvez supprimer que vos propres messages.';
$lang['Cannot_delete_replied'] = 'D&eacute;sol&eacute; mais vous ne pouvez pas supprimer des messages ayant eu des r&eacute;ponses.';
$lang['Cannot_delete_poll'] = 'D&eacute;sol&eacute; mais vous ne pouvez pas supprimer un sondage en cours.';
$lang['Empty_poll_title'] = 'Vous devez saisir le titre du sondage.';
$lang['To_few_poll_options'] = 'Vous devez sp&eacute;cifier au moins deux options afin d\'ajouter un sondage.';
$lang['To_many_poll_options'] = 'Vous avez sp&eacute;cifi&eacute; un trop grand nombre d\'options.';
$lang['Post_has_no_poll'] = 'Ce message ne contient aucun sondage.';
$lang['Already_voted'] = 'Vous avez d&eacute;j&agrave; vot&eacute; dans ce sondage.';
$lang['No_vote_option'] = 'Vous devez sp&eacute;cifier une option afin de voter.';

$lang['Add_poll'] = 'Ajouter un sondage';
$lang['Add_poll_explain'] = 'Laissez ces champs vides si vous ne souhaitez pas cr&eacute;er de sondage.';
$lang['Poll_question'] = 'Question du sondage';
$lang['Poll_option'] = 'Option du sondage';
$lang['Add_option'] = 'Ajouter l\'option';
$lang['Update'] = 'Mettre &agrave; jour';
$lang['Delete'] = 'Supprimer';
$lang['Poll_for'] = 'Dur&eacute;e du sondage';
$lang['Days'] = 'jours'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Saisissez 0 ou laissez vide afin de ne jamais terminer le sondage ]';
$lang['Delete_poll'] = 'Supprimer le sondage';

$lang['Disable_HTML_post'] = 'D&eacute;sactiver l\'HTML dans ce message';
$lang['Disable_BBCode_post'] = 'D&eacute;sactiver le BBCode dans ce message';
$lang['Disable_Smilies_post'] = 'D&eacute;sactiver les &eacute;motic&ocirc;nes dans ce message';

$lang['HTML_is_ON'] = 'L\'HTML est <u>activ&eacute;</u>';
$lang['HTML_is_OFF'] = 'L\'HTML est <u>d&eacute;sactiv&eacute;</u>';
$lang['BBCode_is_ON'] = 'Le %sBBCode%s est <u>activ&eacute;</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = 'Le %sBBCode%s est <u>d&eacute;sactiv&eacute;</u>';
$lang['Smilies_are_ON'] = 'Les &eacute;motic&ocirc;nes sont <u>activ&eacute;es</u>';
$lang['Smilies_are_OFF'] = 'Les &eacute;motic&ocirc;nes sont <u>d&eacute;sactiv&eacute;es</u>';

$lang['Attach_signature'] = 'Ins&eacute;rer une signature (la signature peut &ecirc;tre modifi&eacute;e dans le profil)';
$lang['Notify'] = 'M\'avertir lorsque des r&eacute;ponses ont &eacute;t&eacute; publi&eacute;es';

$lang['Stored'] = 'Votre message a &eacute;t&eacute; saisi avec succ&egrave;s.';
$lang['Deleted'] = 'Votre message a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s.';
$lang['Poll_delete'] = 'Votre sondage a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s.';
$lang['Vote_cast'] = 'Votre vote a bien &eacute;t&eacute; pris en compte.';

$lang['Topic_reply_notification'] = 'Avertissement des r&eacute;ponses du sujet';

$lang['bbcode_b_help'] = 'Texte en gras : [b]texte[/b] (alt+b)';
$lang['bbcode_i_help'] = 'Texte en italique : [i]texte[/i] (alt+i)';
$lang['bbcode_u_help'] = 'Souligner un texte : [u]texte[/u] (alt+u)';
$lang['bbcode_q_help'] = 'Citer un texte : [quote]texte[/quote] (alt+q)';
$lang['bbcode_c_help'] = 'Affichage de code : [code]code[/code] (alt+c)';
$lang['bbcode_l_help'] = 'Liste : [list]texte[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Liste ordonn&eacute;e : [list=]texte[/list] (alt+o)';
$lang['bbcode_p_help'] = 'Ins&eacute;rer une image : [img]http://lien_de_l_image[/img] (alt+p)';
$lang['bbcode_w_help'] = 'Ins&eacute;rer un lien : [url]http://lien[/url] ou [url=http://url]texte du lien[/url] (alt+w)';
$lang['bbcode_a_help'] = 'Fermer toutes les balises BBCode ouvertes';
$lang['bbcode_s_help'] = 'Couleur du texte : [color=red]texte[/color] ou [color=#FF0000]texte[/color]';
$lang['bbcode_f_help'] = 'Taille du texte : [size=x-small]petit texte[/size]';

$lang['Emoticons'] = '&eacute;motic&ocirc;nes';
$lang['More_emoticons'] = 'Voir plus d\'&eacute;motic&ocirc;nes';

$lang['Font_color'] = 'Couleur du texte';
$lang['color_default'] = 'D&eacute;faut';
$lang['color_dark_red'] = 'Rouge fonc&eacute;';
$lang['color_red'] = 'Rouge';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Marron';
$lang['color_yellow'] = 'Jaune';
$lang['color_green'] = 'Vert';
$lang['color_olive'] = 'Vert olive';
$lang['color_cyan'] = 'Bleu cyan';
$lang['color_blue'] = 'Bleu';
$lang['color_dark_blue'] = 'Bleu fonc&eacute;';
$lang['color_indigo'] = 'Violet indigo';
$lang['color_violet'] = 'Violet';
$lang['color_white'] = 'Blanc';
$lang['color_black'] = 'Noir';

$lang['Font_size'] = 'Taille du texte';
$lang['font_tiny'] = 'Minuscule';
$lang['font_small'] = 'Petite';
$lang['font_normal'] = 'Normale';
$lang['font_large'] = 'Grande';
$lang['font_huge'] = '&eacute;norme';

$lang['Close_Tags'] = 'Fermer les balises';
$lang['Styles_tip'] = 'Astuce : des styles peut &ecirc;tre rapidement appliqu&eacute;s au texte s&eacute;lectionn&eacute;.';


//
// Private Messaging
//
$lang['Private_Messaging'] = 'Messagerie priv&eacute;e';

$lang['Login_check_pm'] = 'Se connecter afin de v&eacute;rifier vos messages priv&eacute;s';
$lang['New_pms'] = 'Vous avez %d nouveaux messages'; // You have 2 new messages
$lang['New_pm'] = 'Vous avez %d nouveau message'; // You have 1 new message
$lang['No_new_pm'] = 'Vous n\'avez aucun nouveau message';
$lang['Unread_pms'] = 'Vous avez %d messages non-lus';
$lang['Unread_pm'] = 'Vous avez %d message non-lu';
$lang['No_unread_pm'] = 'Vous n\'avez aucun message non-lu';
$lang['You_new_pm'] = 'Un nouveau message vous attend dans votre boîte de r&eacute;ception';
$lang['You_new_pms'] = 'De nouveaux messages vous attendent dans votre boîte de r&eacute;ception';
$lang['You_no_new_pm'] = 'Aucun nouveau message ne vous attend dans votre boîte de r&eacute;ception';

$lang['Unread_message'] = 'Message non-lu';
$lang['Read_message'] = 'Message lu';

$lang['Read_pm'] = 'Lire le message';
$lang['Post_new_pm'] = 'Publier le message';
$lang['Post_reply_pm'] = 'R&eacute;pondre au message';
$lang['Post_quote_pm'] = 'Citer le message';
$lang['Edit_pm'] = '&eacute;diter le message';

$lang['Inbox'] = 'Boîte de r&eacute;c&eacute;ption';
$lang['Outbox'] = 'Boîte d\'envoi';
$lang['Savebox'] = 'Archives';
$lang['Sentbox'] = 'Messages envoy&eacute;s';
$lang['Flag'] = 'Drapeau';
$lang['Subject'] = 'Sujet';
$lang['From'] = 'De';
$lang['To'] = '&agrave;';
$lang['Date'] = 'Date';
$lang['Mark'] = 'S&eacute;lectionner';
$lang['Sent'] = 'Envoyer';
$lang['Saved'] = 'Archiv&eacute;';
$lang['Delete_marked'] = 'Supprimer la s&eacute;lection';
$lang['Delete_all'] = 'Tout supprimer';
$lang['Save_marked'] = 'Archiver la s&eacute;lection'; 
$lang['Save_message'] = 'Archiver le message';
$lang['Delete_message'] = 'Supprimer le message';

$lang['Display_messages'] = 'Afficher les messages depuis'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Tous les messages';

$lang['No_messages_folder'] = 'Vous n\'avez aucun message dans ce dossier';

$lang['PM_disabled'] = 'La messagerie priv&eacute;e a &eacute;t&eacute; d&eacute;sactiv&eacute;e sur ce forum.';
$lang['Cannot_send_privmsg'] = 'D&eacute;sol&eacute; mais l\'administrateur vous emp&ecirc;che d\'envoyer des messages priv&eacute;s.';
$lang['No_to_user'] = 'Vous devez sp&eacute;cifier un nom d\'utilisateur &agrave; qui envoyer le message.';
$lang['No_such_user'] = 'D&eacute;sol&eacute; mais cet utilisateur n\'existe pas.';

$lang['Disable_HTML_pm'] = 'D&eacute;sactiver l\'HTML dans ce message';
$lang['Disable_BBCode_pm'] = 'D&eacute;sactiver le BBCode dans ce message';
$lang['Disable_Smilies_pm'] = 'D&eacute;sactiver les &eacute;motic&ocirc;nes dans ce message';

$lang['Message_sent'] = 'Votre message a &eacute;t&eacute; envoy&eacute; avec succ&egrave;s.';

$lang['Click_return_inbox'] = 'Cliquez %sici%s afin de retourner &agrave; votre boîte de r&eacute;ception';
$lang['Click_return_index'] = 'Cliquez %sici%s afin de retourner &agrave; l\'index';

$lang['Send_a_new_message'] = 'Envoyer un nouveau message priv&eacute;';
$lang['Send_a_reply'] = 'R&eacute;pondre au message priv&eacute;';
$lang['Edit_message'] = '&eacute;diter le message priv&eacute;';

$lang['Notification_subject'] = 'Un nouveau message priv&eacute; est arriv&eacute; !';

$lang['Find_username'] = 'Trouver un nom d\'utilisateur';
$lang['Find'] = 'Trouver';
$lang['No_match'] = 'Aucun r&eacute;sultat n\'a &eacute;t&eacute; trouv&eacute;.';

$lang['No_post_id'] = 'L\'identification du message n\'a pas &eacute;t&eacute; sp&eacute;cifi&eacute;e';
$lang['No_such_folder'] = 'Le dossier n\'existe pas';
$lang['No_folder'] = 'Aucun dossier n\'a &eacute;t&eacute; sp&eacute;cifi&eacute;';

$lang['Mark_all'] = 'Tout s&eacute;lectionner';
$lang['Unmark_all'] = 'Tout d&eacute;s&eacute;lectionner';

$lang['Confirm_delete_pm'] = '&ecirc;tes-vous sûr de vouloir ce message ?';
$lang['Confirm_delete_pms'] = '&ecirc;tes-vous sûr de supprimer ces messages ?';

$lang['Inbox_size'] = 'Votre boîte de r&eacute;ception est pleine &agrave; %d%%'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Votre boîte d\'envoi est pleine &agrave; %d%%'; 
$lang['Savebox_size'] = 'Vos archives sont pleines &agrave; %d%%'; 

$lang['Click_view_privmsg'] = 'Cliquez %sici%s afin d\'atteindre votre boîte de r&eacute;ception';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Consulte le profil :: %s'; // %s is username 
$lang['About_user'] = 'Tout &agrave; propos de %s'; // %s is username

$lang['Preferences'] = 'Pr&eacute;f&eacute;rences';
$lang['Items_required'] = 'Les champs marqu&eacute;s par * sont obligatoires.';
$lang['Registration_info'] = 'Inscription';
$lang['Profile_info'] = 'Profil';
$lang['Profile_info_warn'] = 'Ces informations seront visibles publiquement';
$lang['Avatar_panel'] = 'Panneau de contr&ocirc;le des avatars';
$lang['Avatar_gallery'] = 'Galerie d\'avatars';

$lang['Website'] = 'Site Internet';
$lang['Location'] = 'Localisation';
$lang['Contact'] = 'Contact';
$lang['Email_address'] = 'Adresse e-mail';
$lang['Send_private_message'] = 'Envoyer un message priv&eacute;';
$lang['Hidden_email'] = '[ Invisible ]';
$lang['Interests'] = 'Loisirs';
$lang['Occupation'] = 'Emploi'; 
$lang['Poster_rank'] = 'Rang du r&eacute;dacteur';

$lang['Total_posts'] = 'Messages au total';
$lang['User_post_pct_stats'] = '%.2f%% du total'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f messages par jour'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Trouver tous les messages de %s'; // Find all posts by username

$lang['No_user_id_specified'] = 'D&eacute;sol&eacute; mais cet utilisateur n\'existe pas.';
$lang['Wrong_Profile'] = 'Vous ne pouvez pas modifier un profil qui n\'est pas le v&ocirc;tre.';

$lang['Only_one_avatar'] = 'Seul un type d\'avatar peut &ecirc;tre sp&eacute;cifi&eacute;';
$lang['File_no_data'] = 'Le fichier du lien que vous avez sp&eacute;cifi&eacute; ne contient aucune donn&eacute;e';
$lang['No_connection_URL'] = 'Une connexion ne peut &ecirc;tre &eacute;tablie avec le lien que vous avez sp&eacute;cifi&eacute;';
$lang['Incomplete_URL'] = 'Le lien que vous avez sp&eacute;cifi&eacute; est incomplet';
$lang['Wrong_remote_avatar_format'] = 'Le lien de l\'avatar &agrave; distance que vous avez sp&eacute;cifi&eacute; est incorrect';
$lang['No_send_account_inactive'] = 'D&eacute;sol&eacute; mais votre mot de passe ne peut &ecirc;tre renouvel&eacute; car votre compte est actuellement inactif. Pour plus d\'informations, veuillez contacter l\'administrateur du forum.';

$lang['Always_smile'] = 'Toujours activer les &eacute;motic&ocirc;nes';
$lang['Always_html'] = 'Toujours activer l\'HTML';
$lang['Always_bbcode'] = 'Toujours activer le BBCode';
$lang['Always_add_sig'] = 'Toujours ins&eacute;rer ma signature';
$lang['Always_notify'] = 'Toujours m\'avertir toujours des r&eacute;ponses';
$lang['Always_notify_explain'] = 'Envoie un e-mail lorsque quelqu\'un r&eacute;pond &agrave; un sujet que vous avez publi&eacute;. Cela peut &ecirc;tre modifi&eacute; &agrave; chaque fois que vous publiez un message.';

$lang['Board_style'] = 'Style du forum';
$lang['Board_lang'] = 'Langue du forum';
$lang['No_themes'] = 'Aucun th&egrave;me n\'est pr&eacute;sent dans la base de donn&eacute;es';
$lang['Timezone'] = 'Fuseau horaire';
$lang['Date_format'] = 'Format de la date';
$lang['Date_format_explain'] = 'La syntaxe utilis&eacute;e est identique &agrave; la fonction PHP <a href=\'http://www.php.net/date\' target=\'_blank\'>date()</a>.';
$lang['Signature'] = 'Signature';
$lang['Signature_explain'] = 'Ceci est un bloc de texte qui peut &ecirc;tre ajout&eacute; aux messages que vous publiez. Il est limit&eacute; &agrave; %d caract&egrave;res';
$lang['Public_view_email'] = 'Toujours afficher mon adresse e-mail';

$lang['Current_password'] = 'Mot de passe actuel';
$lang['New_password'] = 'Nouveau mot de passe';
$lang['Confirm_password'] = 'Confirmer le mot de passe';
$lang['Confirm_password_explain'] = 'Vous devez confirmer votre mot de passe actuel si vous souhaitez modifiez votre adresse e-mail ou votre mot de passe';
$lang['password_if_changed'] = 'Vous ne devez fournir un mot de passe que si vous souhaitez le modifier';
$lang['password_confirm_if_changed'] = 'Vous ne devez confirmer le mot de passe que si vous l\'avez modifi&eacute; ci-dessus';

$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Affiche une petite image sous les informations relatives aux messages. Seule une image peut &ecirc;tre affich&eacute;e. Sa largeur ne doit pas d&eacute;passer %d pixels, sa hauteur ne soit pas d&eacute;passer %d pixels et la taille du fichier ne doit pas d&eacute;passer %d Ko.';
$lang['Upload_Avatar_file'] = 'Transf&eacute;rer un avatar &agrave; partir de votre ordinateur';
$lang['Upload_Avatar_URL'] = 'Transf&eacute;rer un avatar &agrave; partir d\'un lien';
$lang['Upload_Avatar_URL_explain'] = 'Saisissez le lien de l\'endroit contenant l\'image. Elle sera copi&eacute;e sur ce site.';
$lang['Pick_local_Avatar'] = 'S&eacute;lectionner un avatar &agrave; partir de la galerie';
$lang['Link_remote_Avatar'] = 'Lien vers l\'image &agrave; distance';
$lang['Link_remote_Avatar_explain'] = 'Saisissez le lien de l\'endroit contenant l\'image que vous souhaitez utiliser.';
$lang['Avatar_URL'] = 'Lien de l\'image';
$lang['Select_from_gallery'] = 'S&eacute;lectionner un avatar &agrave; partir de la galerie';
$lang['View_avatar_gallery'] = 'Afficher la galerie';

$lang['Select_avatar'] = 'S&eacute;lectionner l\'avatar';
$lang['Return_profile'] = 'Annuler l\'avatar';
$lang['Select_category'] = 'S&eacute;lectionner la cat&eacute;gorie';

$lang['Delete_Image'] = 'Supprimer l\'image';
$lang['Current_Image'] = 'Image actuelle';

$lang['Notify_on_privmsg'] = 'M\'avertir des nouveaux messages priv&eacute;s';
$lang['Popup_on_privmsg'] = 'Afficher une fen&ecirc;tre pop-up lors de nouveaux messages priv&eacute;s'; 
$lang['Popup_on_privmsg_explain'] = 'Certains templates peuvent ouvrir une nouvelle fen&ecirc;tre afin de vous informer de l\'arriv&eacute;e d\'un nouveau message priv&eacute;.';
$lang['Hide_user'] = 'Masquer mon statut en ligne';

$lang['Profile_updated'] = 'Votre profil a &eacute;t&eacute; mis &agrave; jour avec succ&egrave;s';
$lang['Profile_updated_inactive'] = 'Votre profil a &eacute;t&eacute; mis &agrave; jour avec succ&egrave;s. Cependant, vous avez modifi&eacute; des informations importantes. Par cons&eacute;quence, votre compte est &agrave; pr&eacute;sent inactif. V&eacute;rifiez vos e-mail et r&eacute;activez votre compte. Si une activation par l\'administrateur est exig&eacute;e, veuillez patienter le temps qu\'il le r&eacute;active.';

$lang['Password_mismatch'] = 'Les mots de passe que vous avez sp&eacute;cifi&eacute;s ne concordent pas.';
$lang['Current_password_mismatch'] = 'Le mot de passe actuel que vous avez sp&eacute;cifi&eacute; ne correspond pas &agrave; celui qui est stock&eacute; dans la base de donn&eacute;es.';
$lang['Password_long'] = 'Votre mot de passe ne doit pas d&eacute;passer 32 caract&egrave;res.';
$lang['Username_taken'] = 'D&eacute;sol&eacute; mais ce nom d\'utilisateur est d&eacute;j&agrave; utilis&eacute;.';
$lang['Username_invalid'] = 'D&eacute;sol&eacute; mais ce nom d\'utilisateur contient un ou des caract&egrave;res incorrects.';
$lang['Username_disallowed'] = 'D&eacute;sol&eacute; mais ce nom d\'utilisateur a &eacute;t&eacute; interdit.';
$lang['Email_taken'] = 'D&eacute;sol&eacute; mais cette adresse e-mail est d&eacute;j&agrave; utilis&eacute;e par un autre utilisateur.';
$lang['Email_banned'] = 'D&eacute;sol&eacute; mais cette adresse e-mail a &eacute;t&eacute; bannie.';
$lang['Email_invalid'] = 'D&eacute;sol&eacute; mais cette adresse e-mail est incorrecte.';
$lang['Signature_too_long'] = 'Votre signature est trop longue.';
$lang['Fields_empty'] = 'Vous devez remplir les champs obligatoires.';
$lang['Avatar_filetype'] = 'Le type de fichier de l\'avatar doit &ecirc;tre JPEG, GIF ou PNG';
$lang['Avatar_filesize'] = 'La taille de l\'avatar ne doit pas d&eacute;passer %d Ko'; // The avatar image file size must be less than 6 KB
$lang['Avatar_imagesize'] = 'Les dimensions de l\'avatar ne doivent pas d&eacute;passer %d pixels de large et %d pixels de haut'; 

$lang['Welcome_subject'] = 'Bienvenue sur les forums de %s'; // Welcome to my.com forums
$lang['New_account_subject'] = 'Nouveau compte utilisateur';
$lang['Account_activated_subject'] = 'Compte activ&eacute;';

$lang['Account_added'] = 'Nous vous remercions de votre inscription. Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s. Vous pouvez d&egrave;s &agrave; pr&eacute;sent vous connecter en utilisant votre nom d\'utilisateur et votre mot de passe';
$lang['Account_inactive'] = 'Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s. Cependant, vous devez activer votre compte. Une cl&eacute; d\'activation a &eacute;t&eacute; envoy&eacute;e &agrave; l\'adresse e-mail que vous avez fournie. Pour plus d\'informations, veuillez v&eacute;rifier vos e-mail';
$lang['Account_inactive_admin'] = 'Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s. Cependant, l\'administrateur du forum doit activer votre compte. Un e-mail vous sera envoy&eacute; lorsque l\'activation de votre compte sera effective';
$lang['Account_active'] = 'Votre compte est &agrave; pr&eacute;sent activ&eacute;. Nous vous remercions de votre inscription';
$lang['Account_active_admin'] = 'Le compte est &agrave; pr&eacute;sent activ&eacute;';
$lang['Reactivate'] = 'R&eacute;activez votre compte !';
$lang['Already_activated'] = 'Vous avez d&eacute;j&agrave; activ&eacute; votre compte';
$lang['COPPA'] = 'Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s mais il n&eacute;cessite d\'&ecirc;tre approuv&eacute;. Pour plus d\'informations, veuillez v&eacute;rifier vos e-mail.';

$lang['Registration'] = 'Conditions d\'inscription';
$lang['Reg_agreement'] = 'Lorsque les administrateurs et les mod&eacute;rateurs de ce forum essaieront de supprimer ou d\'&eacute;diter des messages r&eacute;pr&eacute;hensibles aussi rapidement que possible, il faut &ecirc;tre conscient qu\'il sera impossible de v&eacute;rifier tous les messages. Vous devez accepter alors le fait que l\'administrateur et les mod&eacute;rateurs de ce forum ne peuvent &ecirc;tre tenus comme responsables, mis &agrave; part de leurs propres messages.<br /><br />Vous consentez au fait de ne publier aucun contenu &agrave; caract&egrave;re abusif, obsc&egrave;ne, vulgaire, scandaleux, diffamatoire, menaçant, pornographique ou tout autre message qui violeraient les lois appliqu&eacute;es &agrave; votre pays. Si cela n\'est pas respect&eacute;, vous serez alors banni imm&eacute;diatement et d&eacute;finitivement. Votre Fournisseur d\'Acc&egrave;s &agrave; Internet en sera &eacute;galement inform&eacute;. Les adresses IP de tous les messages publi&eacute;s sont enregistr&eacute;es afin de lutter contre ce genre d\'abus. Vous consentez au fait que l\'administrateur et les mod&eacute;rateurs du forum puissent supprimer, &eacute;diter, d&eacute;placer ou verrouiller chaque sujet et message en toute libert&eacute;. En tant qu\'utilisateur vous acceptez le fait que toutes les informations saisies ci-dessus sont stock&eacute;es dans une base de donn&eacute;es. Cependant, ces informations sont strictement r&eacute;serv&eacute;es &agrave; ce site et elles ne seront pas d&eacute;voil&eacute;es &agrave; un site de tierce-partie sans votre consentement. L\'administrateur et les mod&eacute;rateurs du forum ne peuvent &ecirc;tre tenus comme responsables si une tentative ou un acte de piratage a lieu sur votre compte, ce qui rendra les informations compromises.<br /><br />Ce syst&egrave;me de forum utilise des cookies afin de stocker des informations sur votre ordinateur. Ces cookies ne contiennent pas les informations que vous avez saisies ci-dessus ; ils ne servent qu\'&agrave; am&eacute;liorer votre navigation. L\'adresse e-mail n\'est utilis&eacute;e que pour confirmer les informations de votre inscription et pour votre mot de passe (l\'envoi d\'un nouveau mot de passe, par exemple).<br /><br />En vous inscrivant, vous acceptez de respecter toutes ces conditions.';

$lang['Agree_under_13'] = 'J\'accepte ces conditions et j\'ai <b>moins</b> de 13 ans';
$lang['Agree_over_13'] = 'J\'accepte ces conditions et j\'ai <b>plus</b> de 13 ans';
$lang['Agree_not'] = 'Je refuse ces conditions';

$lang['Wrong_activation'] = 'La cl&eacute; d\'activation que vous avez fournie n\'existe pas dans la base de donn&eacute;es.';
$lang['Send_password'] = 'M\'envoyer un nouveau mot de passe'; 
$lang['Password_updated'] = 'Un nouveau mot de passe a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s. Pour plus d\'informations, veuillez consulter vos e-mail.';
$lang['No_email_match'] = 'L\'adresse e-mail que vous avez fournie ne correspond pas &agrave; ce nom d\'utilisateur.';
$lang['New_password_activation'] = 'Activation du nouveau mot de passe';
$lang['Password_activated'] = 'Votre compte a &eacute;t&eacute; r&eacute;activ&eacute; avec succ&egrave;s. Pour vous connecter, veuillez utiliser le mot de passe fourni dans l\'e-mail que vous avez reçu.';

$lang['Send_email_msg'] = 'Envoyer un e-mail';
$lang['No_user_specified'] = 'Aucun utilisateur n\'a &eacute;t&eacute; sp&eacute;cifi&eacute;';
$lang['User_prevent_email'] = 'Cet utilisateur ne souhaite recevoir aucun e-mail. Veuillez essayer de lui envoyer un message priv&eacute;.';
$lang['User_not_exist'] = 'Cet utilisateur n\'existe pas';
$lang['CC_email'] = 'M\'envoyer une copie de cet e-mail';
$lang['Email_message_desc'] = 'Ce message sera envoy&eacute; en texte brut, veuillez n\'y inclure aucun HTML ou BBCode. L\'adresse de retour de ce message sera votre adresse e-mail.';
$lang['Flood_email_limit'] = 'Vous ne pouvez pas envoyer d\'e-mail actuellement. Veuillez r&eacute;essayer ult&eacute;rieurement.';
$lang['Recipient'] = 'Destinataire';
$lang['Email_sent'] = 'L\'e-mail a &eacute;t&eacute; envoy&eacute; avec succ&egrave;s.';
$lang['Send_email'] = 'Envoyer un e-mail';
$lang['Empty_subject_email'] = 'Vous devez sp&eacute;cifier le titre de l\'e-mail.';
$lang['Empty_message_email'] = 'Vous devez saisir un message afin d\'envoyer un e-mail.';


//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'Le code de confirmation que vous avez saisi est incorrect';
$lang['Too_many_registers'] = 'Vous avez d&eacute;pass&eacute; le nombre de tentative d\'inscription pour cette session. Veuillez r&eacute;essayer ult&eacute;rieurement.';
$lang['Confirm_code_impaired'] = 'Veuillez contacter l\'%sadministrateur du forum%s si vous &ecirc;tes visuellement d&eacute;ficient ou que vous &eacute;prouvez des difficult&eacute;s &agrave; lire ce code correctement.';
$lang['Confirm_code'] = 'Code de confirmation';
$lang['Confirm_code_explain'] = 'Veuillez saisir le code exactement comme il apparaît. Celui-ci n\'est pas sensible &agrave; la casse et le z&eacute;ro comporte une barre diagonale.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'S&eacute;lectionner une m&eacute;thode de tri';
$lang['Sort'] = 'Tri';
$lang['Sort_Top_Ten'] = 'Dix meilleurs r&eacute;dacteurs';
$lang['Sort_Joined'] = 'Date d\'inscription';
$lang['Sort_Username'] = 'Nom d\'utilisateur';
$lang['Sort_Location'] = 'Localisation';
$lang['Sort_Posts'] = 'Messages au total';
$lang['Sort_Email'] = 'E-mail';
$lang['Sort_Website'] = 'Site Internet';
$lang['Sort_Ascending'] = 'Croissant';
$lang['Sort_Descending'] = 'D&eacute;croissant';
$lang['Order'] = 'Ordre';


//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Panneau de contr&ocirc;le des groupes';
$lang['Group_member_details'] = 'Informations sur les adh&eacute;rents du groupe';
$lang['Group_member_join'] = 'Adh&eacute;rer &agrave; un groupe';

$lang['Group_Information'] = 'Informations sur le groupe';
$lang['Group_name'] = 'Nom du groupe';
$lang['Group_description'] = 'Description du groupe';
$lang['Group_membership'] = 'Adh&eacute;rer au groupe';
$lang['Group_Members'] = 'Membres du groupe';
$lang['Group_Moderator'] = 'Responsable du groupe';
$lang['Pending_members'] = 'Membres en attente';

$lang['Group_type'] = 'Type du groupe';
$lang['Group_open'] = 'Groupe ouvert';
$lang['Group_closed'] = 'Groupe ferm&eacute;';
$lang['Group_hidden'] = 'Groupe invisible';

$lang['Current_memberships'] = 'Adh&eacute;rents actuels';
$lang['Non_member_groups'] = 'Non-membre du groupe';
$lang['Memberships_pending'] = 'Adh&eacute;rents en attente';

$lang['No_groups_exist'] = 'Aucun groupe n\'existe';
$lang['Group_not_exist'] = 'Ce groupe d\'utilisateurs n\'existe pas';

$lang['Join_group'] = 'Adh&eacute;rer au groupe';
$lang['No_group_members'] = 'Ce groupe d\'utilisateurs n\'a aucun membre';
$lang['Group_hidden_members'] = 'Ceci est un groupe invisible ; vous ne pouvez pas voir ses adh&eacute;rents';
$lang['No_pending_group_members'] = 'Ce groupe d\'utilisateurs n\'a aucun membre en attente';
$lang['Group_joined'] = 'Votre demande &agrave; adh&eacute;rer ce groupe d\'utilisateurs a bien &eacute;t&eacute; prise en compte.<br />Vous serez averti lorsque votre adh&eacute;sion sera approuv&eacute;e par le responsable du groupe.';
$lang['Group_request'] = 'Votre demande &agrave; adh&eacute;rer ce groupe d\'utilisateurs a bien &eacute;t&eacute; prise en compte.';
$lang['Group_approved'] = 'Votre demande a &eacute;t&eacute; approuv&eacute;e.';
$lang['Group_added'] = 'Vous avez &eacute;t&eacute; ajout&eacute; &agrave; ce groupe d\'utilisateurs avec succ&egrave;s.'; 
$lang['Already_member_group'] = 'Vous &ecirc;tes d&eacute;j&agrave; un membre de ce groupe d\'utilisateurs';
$lang['User_is_member_group'] = 'L\'utilisateur est d&eacute;j&agrave; un membre de ce groupe d\'utilisateurs';
$lang['Group_type_updated'] = 'Le type du groupe d\'utilisateurs a &eacute;t&eacute; mis &agrave; jour avec succ&egrave;s.';

$lang['Could_not_add_user'] = 'L\'utilisateur que vous avez s&eacute;lectionn&eacute; n\'existe pas.';
$lang['Could_not_anon_user'] = 'Un utilisateur anonyme ne peut pas adh&eacute;rer &agrave; un groupe d\'utilisateurs.';

$lang['Confirm_unsub'] = '&ecirc;tes-vous sûr de vouloir vous d&eacute;sinscrire de ce groupe d\'utilisateurs ?';
$lang['Confirm_unsub_pending'] = 'Votre inscription &agrave; ce groupe d\'utilisateurs n\'a pas encore &eacute;t&eacute; approuv&eacute;e. &ecirc;tes-vous sûr de vouloir vous d&eacute;sinscrire ?';

$lang['Unsub_success'] = 'Vous avez &eacute;t&eacute; d&eacute;sinscrit de ce groupe d\'utilisateurs avec succ&egrave;s.';

$lang['Approve_selected'] = 'Approuver la s&eacute;lection';
$lang['Deny_selected'] = 'D&eacute;sapprouver la s&eacute;lection';
$lang['Not_logged_in'] = 'Vous devez &ecirc;tre inscrit afin d\'adh&eacute;rer &agrave; ce groupe d\'utilisateurs.';
$lang['Remove_selected'] = 'Supprimer la s&eacute;lection';
$lang['Add_member'] = 'Ajouter le membre';
$lang['Not_group_moderator'] = 'Vous n\'&ecirc;tes pas le responsable de ce groupe d\'utilisateurs. Par cons&eacute;quence, vous ne pouvez pas r&eacute;aliser cette action.';

$lang['Login_to_join'] = 'Vous connecter afin d\'adh&eacute;rer ou de g&eacute;rer ce groupe d\'utilisateurs';
$lang['This_open_group'] = 'Ceci est un groupe ouvert ; cliquez afin de r&eacute;aliser une demande d\'adh&eacute;sion';
$lang['This_closed_group'] = 'Ceci est un groupe ferm&eacute; ; aucun utilisateur ne peut le rejoindre';


$lang['This_hidden_group'] = 'Ceci est un groupe invisible ; seul le responsable du groupe peut ajouter des membres';
$lang['Member_this_group'] = 'Vous n\'&ecirc;tes pas un membre de ce groupe';
$lang['Pending_this_group'] = 'Votre adh&eacute;sion &agrave; ce groupe d\'utilisateurs est en attente';
$lang['Are_group_moderator'] = 'Vous &ecirc;tes le responsable de ce groupe d\'utilisateurs';
$lang['None'] = 'Aucun';

$lang['Subscribe'] = 'Inscription';
$lang['Unsubscribe'] = 'D&eacute;sinscription';
$lang['View_Information'] = 'Voir les informations';


//
// Search
//
$lang['Search_query'] = 'Rechercher';
$lang['Search_options'] = 'Options de la recherche';

$lang['Search_keywords'] = 'Rechercher par mot-cl&eacute;';
$lang['Search_keywords_explain'] = 'Vous pouvez utiliser <u>AND</u> afin de d&eacute;terminer les mots qui doivent apparaître dans les r&eacute;sultats, <u>OR</u> afin de d&eacute;terminer les mots qui peuvent apparaître dans les r&eacute;sultats et <u>NOT</u> afin de d&eacute;terminer les mots qui ne doivent pas apparaître dans les r&eacute;sultats. Utilisez * comme joker pour des recherches partielles';
$lang['Search_author'] = 'Rechercher par auteur';
$lang['Search_author_explain'] = 'Utilisez * comme joker pour des recherches partielles';

$lang['Search_for_any'] = 'Rechercher n\'importe quels de ces termes ou utiliser une question comme entr&eacute;e';
$lang['Search_for_all'] = 'Rechercher pour tous les termes';
$lang['Search_title_msg'] = 'Rechercher dans les titres des sujets et les messages';
$lang['Search_msg_only'] = 'Rechercher dans les messages uniquement';

$lang['Return_first'] = 'Retourner les'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'caract&egrave;res de messages';

$lang['Search_previous'] = 'Rechercher depuis'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Trier par';
$lang['Sort_Time'] = 'Heure du message';
$lang['Sort_Post_Subject'] = 'Sujet du message';
$lang['Sort_Topic_Title'] = 'Titre du sujet';
$lang['Sort_Author'] = 'Auteur';
$lang['Sort_Forum'] = 'Forum';

$lang['Display_results'] = 'Afficher les r&eacute;sultats sous forme de';
$lang['All_available'] = 'Tous disponibles';
$lang['No_searchable_forums'] = 'Vous ne pouvez pas rechercher un forum sur ce site.';

$lang['No_search_match'] = 'Aucun sujet ou message ne correspond &agrave; votre crit&egrave;re de recherche';
$lang['Found_search_match'] = 'La recherche a retourn&eacute; %d r&eacute;sultat'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'La recherche a retourn&eacute; %d r&eacute;sultats'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'Vous ne pouvez pas effectuer une recherche aussit&ocirc;t apr&egrave;s en avoir effectu&eacute; une. Veuillez r&eacute;essayer ult&eacute;rieurement.';

$lang['Close_window'] = 'Fermer la fen&ecirc;tre';


//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'D&eacute;sol&eacute; mais seul %s peut publier des annonces dans ce forum.';
$lang['Sorry_auth_sticky'] = 'D&eacute;sol&eacute; mais seul %s peut publier des notes dans ce forum.'; 
$lang['Sorry_auth_read'] = 'D&eacute;sol&eacute; mais seul %s peut lire les sujets de ce forum.'; 
$lang['Sorry_auth_post'] = 'D&eacute;sol&eacute; mais seul %s peut publier des sujets dans ce forum.'; 
$lang['Sorry_auth_reply'] = 'D&eacute;sol&eacute; mais seul %s peut r&eacute;pondre aux messages de ce forum.';
$lang['Sorry_auth_edit'] = 'D&eacute;sol&eacute; mais seul %s peut &eacute;diter des messages de ce forum.'; 
$lang['Sorry_auth_delete'] = 'D&eacute;sol&eacute; mais seul %s peut supprimer des messages de ce forum.';
$lang['Sorry_auth_vote'] = 'D&eacute;sol&eacute; mais seul %s peut voter aux sondages de ce forum.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>utilisateurs anonymes</b>';
$lang['Auth_Registered_Users'] = '<b>utilisateurs inscrits</b>';
$lang['Auth_Users_granted_access'] = '<b>utilisateurs ayant un acc&egrave;s sp&eacute;cial</b>';
$lang['Auth_Moderators'] = '<b>mod&eacute;rateurs</b>';
$lang['Auth_Administrators'] = '<b>administrateurs</b>';

$lang['Not_Moderator'] = 'Vous n\'&ecirc;tes pas un mod&eacute;rateur de ce forum.';
$lang['Not_Authorised'] = 'Acc&egrave;s interdit';

$lang['You_been_banned'] = 'Vous avez &eacute;t&eacute; banni de ce forum.<br />Pour plus d\'informations, veuillez contacter l\'administrateur du forum.';


//
// Viewonline
//
$lang['Reg_users_zero_online'] = 'Il y a 0 utilisateur inscrit et '; // There are 5 Registered and
$lang['Reg_users_online'] = 'Il y a %d utilisateurs inscrits et '; // There are 5 Registered and
$lang['Reg_user_online'] = 'Il y a %d utilisateur inscrit et '; // There is 1 Registered and
$lang['Hidden_users_zero_online'] = '0 utilisateur invisible en ligne'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d utilisateurs invisibles en ligne'; // 6 Hidden users online
$lang['Hidden_user_online'] = '%d utilisateur invisible en ligne'; // 6 Hidden users online
$lang['Guest_users_online'] = 'Il y a %d invit&eacute;s en ligne'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = 'Il y a 0 invit&eacute; en ligne'; // There are 10 Guest users online
$lang['Guest_user_online'] = 'Il y a %d invit&eacute; en ligne'; // There is 1 Guest user online
$lang['No_users_browsing'] = 'Il n\'y a aucun utilisateur parcourant actuellement le forum';

$lang['Online_explain'] = 'Ces donn&eacute;es sont bas&eacute;es sur les utilisateurs actifs des cinq derni&egrave;res minutes';

$lang['Forum_Location'] = 'Localisation dans le forum';
$lang['Last_updated'] = 'Derni&egrave;re mise &agrave; jour';

$lang['Forum_index'] = 'Index du forum';
$lang['Logging_on'] = 'Se connecter';
$lang['Posting_message'] = 'Publie un message';
$lang['Searching_forums'] = 'Effectue une recherche';
$lang['Viewing_profile'] = 'Consulte un profil';
$lang['Viewing_online'] = 'Consulte qui est en ligne';
$lang['Viewing_member_list'] = 'Consulte la liste des membres';
$lang['Viewing_priv_msgs'] = 'Consulter ses messages priv&eacute;s';
$lang['Viewing_FAQ'] = 'Consulte la FAQ';


//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Panneau de contr&ocirc;le du mod&eacute;rateur';
$lang['Mod_CP_explain'] = 'En utilisant ce formulaire, vous pouvez r&eacute;aliser de nombreuses op&eacute;rations de mod&eacute;ration sur ce forum. Vous pouvez verrouiller, d&eacute;verrouiller, d&eacute;placer ou supprimer les sujets et les messages.';

$lang['Select'] = 'S&eacute;lectionner';
$lang['Delete'] = 'Supprimer';
$lang['Move'] = 'D&eacute;placer';
$lang['Lock'] = 'Verrouiller';
$lang['Unlock'] = 'D&eacute;verrouiller';

$lang['Topics_Removed'] = 'Les sujets que vous avez s&eacute;lectionn&eacute;s ont &eacute;t&eacute; supprim&eacute;s de la base de donn&eacute;es avec succ&egrave;s.';
$lang['Topics_Locked'] = 'Les sujets que vous avez s&eacute;lectionn&eacute;s ont &eacute;t&eacute; verrouill&eacute;s avec succ&egrave;s.';
$lang['Topics_Moved'] = 'Les sujets que vous avez s&eacute;lectionn&eacute;s ont &eacute;t&eacute; d&eacute;plac&eacute;s avec succ&egrave;s.';
$lang['Topics_Unlocked'] = 'Les sujets que vous avez s&eacute;lectionn&eacute;s ont &eacute;t&eacute; d&eacute;verrouill&eacute;s avec succ&egrave;s.';
$lang['No_Topics_Moved'] = 'Aucun sujet n\'a &eacute;t&eacute; d&eacute;plac&eacute;.';

$lang['Confirm_delete_topic'] = '&ecirc;tes-vous sûr de vouloir supprimer le(s) sujet(s) s&eacute;lectionn&eacute;(s) ?';
$lang['Confirm_lock_topic'] = '&ecirc;tes-vous sûr de vouloir verrouiller le(s) sujet(s) s&eacute;lectionn&eacute;(s) ?';
$lang['Confirm_unlock_topic'] = '&ecirc;tes-vous sûr de vouloir d&eacute;verrouiller le(s) sujet(s) s&eacute;lectionn&eacute;(s) ?';
$lang['Confirm_move_topic'] = '&ecirc;tes-vous sûr de vouloir d&eacute;placer le(s) sujet(s) s&eacute;lectionn&eacute;(s) ?';

$lang['Move_to_forum'] = 'D&eacute;placer dans le forum';
$lang['Leave_shadow_topic'] = 'Laisser un clone sur place.';

$lang['Split_Topic'] = 'Panneau de contr&ocirc;le de division de sujets';
$lang['Split_Topic_explain'] = 'En utilisant le formulaire ci-dessous, vous pouvez diviser un sujet en deux en s&eacute;lectionnant individuellement les messages &agrave; diviser ou en divisant &agrave; partir d\'un message s&eacute;lectionn&eacute;';
$lang['Split_title'] = 'Titre du nouveau sujet';
$lang['Split_forum'] = 'Forum du nouveau sujet';
$lang['Split_posts'] = 'Diviser les messages s&eacute;lectionn&eacute;s';
$lang['Split_after'] = 'Diviser &agrave; partir d\'un message s&eacute;lectionn&eacute;';
$lang['Topic_split'] = 'Le sujet que vous avez s&eacute;lectionn&eacute; a &eacute;t&eacute; divis&eacute; avec succ&egrave;s';

$lang['Too_many_error'] = 'Vous avez s&eacute;lectionn&eacute; un trop grand nombre de sujets. Vous ne pouvez s&eacute;lectionner qu\'un seul message de ce sujet &agrave; diviser !';

$lang['None_selected'] = 'Vous n\'avez s&eacute;lectionn&eacute; aucun message &agrave; diviser. Veuillez en s&eacute;lectionner au moins un.';
$lang['New_forum'] = 'Nouveau forum';

$lang['This_posts_IP'] = 'Adresse IP de ce message';
$lang['Other_IP_this_user'] = 'Autres adresses IP utilis&eacute;es par le r&eacute;dacteur';
$lang['Users_this_IP'] = 'Utilisateurs ayant publi&eacute;s &agrave; partir de cette adresse IP';
$lang['IP_info'] = 'Informations sur l\'IP';
$lang['Lookup_IP'] = 'Rechercher une adresse IP';


//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Heures au format %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 heures';
$lang['-11'] = 'GMT - 11 heures';
$lang['-10'] = 'GMT - 10 heures';
$lang['-9'] = 'GMT - 9 heures';
$lang['-8'] = 'GMT - 8 heures';
$lang['-7'] = 'GMT - 7 heures';
$lang['-6'] = 'GMT - 6 heures';
$lang['-5'] = 'GMT - 5 heures';
$lang['-4'] = 'GMT - 4 heures';
$lang['-3.5'] = 'GMT - 3.5 heures';
$lang['-3'] = 'GMT - 3 heures';
$lang['-2'] = 'GMT - 2 heures';
$lang['-1'] = 'GMT - 1 heure';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 heure';
$lang['2'] = 'GMT + 2 heures';
$lang['3'] = 'GMT + 3 heures';
$lang['3.5'] = 'GMT + 3.5 heures';
$lang['4'] = 'GMT + 4 heures';
$lang['4.5'] = 'GMT + 4.5 heures';
$lang['5'] = 'GMT + 5 heures';
$lang['5.5'] = 'GMT + 5.5 heures';
$lang['6'] = 'GMT + 6 heures';
$lang['6.5'] = 'GMT + 6.5 heures';
$lang['7'] = 'GMT + 7 heures';
$lang['8'] = 'GMT + 8 heures';
$lang['9'] = 'GMT + 9 heures';
$lang['9.5'] = 'GMT + 9.5 heures';
$lang['10'] = 'GMT + 10 heures';
$lang['11'] = 'GMT + 11 heures';
$lang['12'] = 'GMT + 12 heures';
$lang['13'] = 'GMT + 13 heures';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 heures';
$lang['tz']['-11'] = 'GMT - 11 heures';
$lang['tz']['-10'] = 'GMT - 10 heures';
$lang['tz']['-9'] = 'GMT - 9 heures';
$lang['tz']['-8'] = 'GMT - 8 heures';
$lang['tz']['-7'] = 'GMT - 7 heures';
$lang['tz']['-6'] = 'GMT - 6 heures';
$lang['tz']['-5'] = 'GMT - 5 heures';
$lang['tz']['-4'] = 'GMT - 4 heures';
$lang['tz']['-3.5'] = 'GMT - 3.5 heures';
$lang['tz']['-3'] = 'GMT - 3 heures';
$lang['tz']['-2'] = 'GMT - 2 heures';
$lang['tz']['-1'] = 'GMT - 1 heure';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 heure';
$lang['tz']['2'] = 'GMT + 2 heures';
$lang['tz']['3'] = 'GMT + 3 heures';
$lang['tz']['3.5'] = 'GMT + 3.5 heures';
$lang['tz']['4'] = 'GMT + 4 heures';
$lang['tz']['4.5'] = 'GMT + 4.5 heures';
$lang['tz']['5'] = 'GMT + 5 heures';
$lang['tz']['5.5'] = 'GMT + 5.5 heures';
$lang['tz']['6'] = 'GMT + 6 heures';
$lang['tz']['6.5'] = 'GMT + 6.5 heures';
$lang['tz']['7'] = 'GMT + 7 heures';
$lang['tz']['8'] = 'GMT + 8 heures';
$lang['tz']['9'] = 'GMT + 9 heures';
$lang['tz']['9.5'] = 'GMT + 9.5 heures';
$lang['tz']['10'] = 'GMT + 10 heures';
$lang['tz']['11'] = 'GMT + 11 heures';
$lang['tz']['12'] = 'GMT + 12 heures';
$lang['tz']['13'] = 'GMT + 13 heures';

$lang['datetime']['Sunday'] = 'Dimanche';
$lang['datetime']['Monday'] = 'Lundi';
$lang['datetime']['Tuesday'] = 'Mardi';
$lang['datetime']['Wednesday'] = 'Mercredi';
$lang['datetime']['Thursday'] = 'Jeudi';
$lang['datetime']['Friday'] = 'Vendredi';
$lang['datetime']['Saturday'] = 'Samedi';
$lang['datetime']['Sun'] = 'Dim';
$lang['datetime']['Mon'] = 'Lun';
$lang['datetime']['Tue'] = 'Mar';
$lang['datetime']['Wed'] = 'Mer';
$lang['datetime']['Thu'] = 'Jeu';
$lang['datetime']['Fri'] = 'Ven';
$lang['datetime']['Sat'] = 'Sam';
$lang['datetime']['January'] = 'Janvier';
$lang['datetime']['February'] = 'F&eacute;vrier';
$lang['datetime']['March'] = 'Mars';
$lang['datetime']['April'] = 'Avril';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['June'] = 'Juin';
$lang['datetime']['July'] = 'Juillet';
$lang['datetime']['August'] = 'Août';
$lang['datetime']['September'] = 'Septembre';
$lang['datetime']['October'] = 'Octobre';
$lang['datetime']['November'] = 'Novembre';
$lang['datetime']['December'] = 'D&eacute;cembre';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Fev';
$lang['datetime']['Mar'] = 'Mar';
$lang['datetime']['Apr'] = 'Avr';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['Jun'] = 'Juin';
$lang['datetime']['Jul'] = 'Juil';
$lang['datetime']['Aug'] = 'Aoû';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Oct';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'D&eacute;c';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Informations';
$lang['Critical_Information'] = 'Informations critiques';

$lang['General_Error'] = 'Erreur g&eacute;n&eacute;rale';
$lang['Critical_Error'] = 'Erreur critique';
$lang['An_error_occured'] = 'Une erreur est survenue';
$lang['A_critical_error'] = 'Une erreur critique est survenue';

$lang['Admin_reauthenticate'] = 'Pour administrer le forum, vous devez vous authentifier de nouveau.';
$lang['Login_attempts_exceeded'] = 'Vous avez d&eacute;pass&eacute; le nombre maximum de tentative de connexion r&eacute;gl&eacute; &agrave; %s. Vous n\'&ecirc;tes plus autoris&eacute; &agrave; vous connecter durant les %s prochaines minutes.';
$lang['Please_remove_install_contrib'] = 'Veuillez vous assurer de supprimer les r&eacute;pertoires install/ et contrib/';
$lang['Session_invalid'] = 'Session incorrecte. Veuillez renvoyer le formulaire.';

// Quick Reply Mod
$lang['Quick_Reply'] = 'Quick Reply';
$lang['Quick_quote'] = 'Quote the last message';

// Profile modal pop-up about using YA to edit profile
$lang['Attention'] = 'Attention';
$lang['Continue'] = 'Continue';
$lang['Go_Your_Account'] = 'Go to Your Account';
$lang['YA_Warning'] = 'Unless you are uploading an avatar you should be using %s to edit your profile';

// Arcade
$lang['lib_arcade'] = 'Arcade' ; 
$lang['statuser'] = 'Stats Arcade' ;

//====================================================================== |
//==== Start Advanced BBCode Box MOD =================================== |
//==== v5.1.0 ========================================================== |
//====
$lang['BBCode_box_hidden'] = 'Hidden';
$lang['BBcode_box_view'] = 'Click to View Content';
$lang['BBcode_box_hide'] = 'Click to Hide Content';
$lang['bbcode_help']['GVideo'] = 'GVideo: [GVideo]GVideo URL[/GVideo]';
$lang['GVideo_link'] = 'Link';
$lang['bbcode_help']['youtube'] = 'YouTube: [youtube]YouTube URL[/youtube]';
$lang['youtube_link'] = 'Link';
//====
//==== End Advanced BBCode Box MOD ==================================== |
//===================================================================== |
//Jail
$lang['Cell_courthouse']='Tribunal';
$lang['Celleds_time']='Emprisonnement';
// SMILIES List
$lang['SMILIES'] = "Smilies";
$lang['smiley_url'] = "Emoticon";
$lang['smiley_code'] = "Code";
// Start add - Gender MOD
$lang['Gender'] = 'Sexe';//used in users profile to display witch gender he/she is 
$lang['Male'] = 'Masculin'; 
$lang['Female']='F&eacute;minin'; 
$lang['No_gender_specify'] = 'Non Sp&eacute;cifi&eacute;'; 
// End add - Gender MOD
//
//signature editor
$lang['sig_description'] = "Edit Signature (<b>Preview included</b>)";
$lang['sig_edit'] = "Edit Signature";
$lang['sig_current'] = "Current Signature";
$lang['sig_preview'] = "Preview";
$lang['sig_none'] = "No Signature available";
$lang['sig_save'] = "Save";
$lang['sig_save_message'] = "Signature saved successful ! <br /><br />Click on \"Current Signature\" to see or check it again.";
//+MOD: Select Expand BBcodes MOD
$lang['Select'] = "Select";
$lang['Expand'] = "Expand";
$lang['Contract'] = "Contract";
//-MOD: Select Expand BBcodes MOD
//Staff Site
$lang['Staff'] = "Staff Site";
$lang['Forums'] = 'Forums';
$lang['Mod'] = "Moderator";
$lang['Admin'] = "Administrator";
$lang['Super'] = "Super Moderator";
$lang['Junior'] = "Junior Admin";
$lang['Period'] = 'since <b>%d</b> days'; // %d = days
$lang['Messenger'] = 'Messenger';
// Lottery Variables
$lang['lottery_second'] = 'Seconde';
$lang['lottery_seconds'] = 'Secondes';
$lang['lottery_minute'] = 'Minute';
$lang['lottery_minutes'] = 'Minutes';
$lang['lottery_hour'] = 'Heure';
$lang['lottery_hours'] = 'Heures';
$lang['lottery_day'] = 'Jour';
$lang['lottery_days'] = 'Jours';
$lang['lottery_current_history'] = 'Current History';
$lang['lottery_no_history'] = 'There is currently no history recorded!';
$lang['lottery_history_disabled'] = 'Lottery history is disabled on these forums!';
$lang['lottery_ticket_bought'] = 'Your ticket in the %s has been successfully purchased.';
$lang['lottery_tickets_bought'] = 'Your %s tickets in the %s have been successfully purchased.';
$lang['lottery_purchased_ticket'] = ' to purchase a ticket!';
$lang['lottery_purchased_tickets'] = ' to purchase %s tickets!';
$lang['lottery_purchased_ne'] = 'You do not have enough ';
$lang['lottery_too_many_tickets'] = 'You have already purchased the maximum amount of tickets allowed in this lottery! Please wait until the next draw.';
$lang['lottery_information'] = 'Information';
$lang['lottery_actions'] = 'Lottery Actions';
$lang['lottery_disabled'] = 'The lottery is currently turned off!<br /><br />Try again later.';
$lang['lottery_ID'] = 'ID';
$lang['lottery_winner'] = 'Winner';
$lang['lottery_amount_won'] = 'Amount Won';
$lang['lottery_time_won'] = 'Time Won';
$lang['lottery_total_history'] = 'There are a total of %s lottery history entries.';
$lang['lottery_history'] = 'History';
$lang['lottery_tickets_owned'] = 'Tickets Owned';
$lang['lottery_ticket_cost'] = 'Ticket Cost';
$lang['lottery_base_pool'] = 'Base Prize Pool';
$lang['lottery_current_entries'] = 'Current Entries';
$lang['lottery_total_pool'] = 'Total Prize Pool';
$lang['lottery_item_draw'] = 'Items in Draw';
$lang['lottery_time_draw'] = 'Time Until Drawn';
$lang['lottery_last_winner'] = 'Last Winner';
$lang['lottery_buy_ticket'] = 'Buy Ticket';
$lang['lottery_buy_tickets'] = 'Buy Tickets';
$lang['lottery_view_history'] = 'View Lottery History';
$lang['lottery_view_phistory'] = 'View Personal History';
$lang['lottery'] = 'Lottery';

// Lottery Error Variables
$lang['lottery_error_updating'] = 'Error updating %s table!';
$lang['lottery_error_deleting'] = 'Error deleting from %s table!';
$lang['lottery_error_selecting'] = 'Error getting information from %s table!';
$lang['lottery_error_inserting'] = 'Error inserting into %s table!';
$lang['lottery_error_variable'] = 'Could not read %s variable!';
$lang['lottery_invalid_command'] = 'That is not a valid command!';
$lang['lottery_no_history_type'] = 'No history type selected!';

// FLAGHACK-start
$lang['Country_Flag'] = 'Country Flag';
$lang['Select_Country'] = 'SELECT COUNTRY' ;
// FLAGHACK-end

//Add on for Birthday Mod 
$lang['Birthday'] = 'Birthday'; 
$lang['No_birthday_specify'] = 'None Specified'; 
$lang['Age'] = 'Age'; 
$lang['Birthday_explain'] = 'The syntax used is %s, e.g. %s, remember prefixed zeros'; 
$lang['Wrong_birthday_format'] = 'The birthday format was entered incorrectly.'; 
$lang['Submit_date_format'] = 'd-m-Y'; //php date() format - Note: ONLY d, m and Y may be used and SHALL ALL be used (different seperators are accepted) 
$lang['Birthday_greeting_today'] ='We would like to wish you congratulatons on reaching %s years old today.<br /><br /> The Management';//%s is substituted with the users age 
$lang['Birthday_greeting_prev'] ='We would like to give you a belated congratulatons for becoming %s years old on the %s.<br /><br /> The Management';//%s is substituted with the users age, and birthday 
$lang['Greeting_Messaging'] ='Congratulations'; 
$lang ['Birthday_today'] = 'Users with a birthday today:'; 
$lang ['Birthday_week'] = 'Users with a birthday within the next %d days:'; 
$lang ['Nobirthday_week'] = 'No users are having a birthday in the upcoming %d days'; // %d is substitude with the number of days 
$lang ['Nobirthday_today']='No users have a birthday today'; 
//
// That's all, Folks!
// -------------------------------------------------

?>
