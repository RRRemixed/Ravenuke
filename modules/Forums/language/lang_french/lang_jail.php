<?php
/*************************************************************************** 
* 						lang_jail.php [English] 
* 							------------------- 
*
* 						Translation : seteo-bloke & phpika
* 					Forums : http://www.thegamingforum.com/ & http://www.srg.valcato.net/pikachu
* 
****************************************************************************/ 

$lang['Cell']='Prison';
$lang['Cell_admin_title']='Prison';
$lang['Cell_admin_title_explain']='Ici vous pouvez emprisonner ou lib&eacute;rer vos utilisateurs, et d&eacute;finir leur peine d\'emprisonnement ou le montant de l\'amende';
$lang['Cell_admin_select_user']='S&eacute;lectionnez un utilisateur a emprisonner';
$lang['Cell_admin_select']='Emprisonner cet utilisateur';
$lang['Cell_admin_time']='Peine d\'emprisonnement';
$lang['Cell_admin_time_explain']='Cettes valeurs repr&eacute;sentent le temps pendant lequel l\'utilisateur ne sera pas autoris&eacute; a acc&egrave;d&eacute; aux forums';
$lang['Cell_admin_caution']='Montant de l\'amende';
$lang['Cell_admin_caution_explain']='Ceci est le nombre de points que l\'utilisateur doit payer pour &ecirc;tre lib&eacute;r&eacute;. Mettre 0 si vous ne souhaitez pas utiliser cette fonctionnalit&eacute; ou si vous n\'utilisez pas de syst&egrave;me de points sur vos forums';
$lang['Cell_admin_celled_ok']='L\'utilisateur s&eacute;lectionn&eacute; a &eacute;t&eacute; emprisonn&eacute; avec succ&egrave;s.';
$lang['Cell_admin_uncelled_ok']='Les utilisateurs s&eacute;lectionn&eacute;s ont &eacute;t&eacute; lib&eacute;r&eacute;s avec succ&egrave;s.';
$lang['Cell_admin_general_return']='<br /><br /> Click <a href="'.append_sid("admin_cell.php").'">ici</a> pour revenir aux managament de la prison<br /><br />Click <a href="'.append_sid("index.php?pane=right").'">ici</a> pour revenir &agrave; l\'index de l\'administration';
$lang['Cell_admin_celled_users']='Utilisateurs emprisonn&eacute;';
$lang['Cell_admin_celled_name']='Nom';
$lang['Cell_admin_celled_caution']='Amende';
$lang['Cell_admin_celled_time']='Temps restant';
$lang['Cell_admin_celled_free']='Lib&eacute;r&eacute;';
$lang['Cell_admin_manual_update']='Mettre &agrave; jour des peines de prison';
$lang['Cell_admin_manual_update_explain']='La mise &agrave; jour des peines est faite alors que les utilisateurs emprisonn&eacute;s sont connect&eacute;s &agrave; vos forums. Si un utilisateur n\'est pas venu sur les forums depuis un certain temps, les valeurs que vous voyez peuvent &ecirc;tre incorrects. Cliquez sur ce bouton pour corriger ce probl&egrave;me.';
$lang['Cell_admin_celled_manual_update_ok']='Mise &agrave; jour des peines de prison est faite avec succ&egrave;s. Les utilisateurs suivants ont &eacute;t&eacute; lib&eacute;r&eacute;s :<br />';
$lang['Cell_sentence_example']='Vous avez &eacute;t&eacute; emprisonn&eacute; en raison d\'un langage offensant';
$lang['Cell_sentence']='Peine';
$lang['Cell_sentence_explain']='Ce texte explique la raison de la d&eacute;tention de l\'utilisateur';

$lang['Cell_title']='D&eacute;tention';
$lang['Cell_explain']='Un administrateur du site a d&eacute;cid&eacute; de vous emprisonner. Cela va durer ';
$lang['Cell_time_explain']='Jusque-l&agrave;, vous ne serez pas en mesure d\'acc&eacute;der &agrave; nos forums';
$lang['Cell_day']='Jour';
$lang['Cell_hour']='Heure';
$lang['Cell_minute']='Minute';
$lang['Cell_days']='Jours';
$lang['Cell_hours']='Heures';
$lang['Cell_minutes']='Minutes';
$lang['Cell_caution']='Il est possible pour vous d\'&ecirc;tre lib&eacute;r&eacute; de prison en payant la somme de ';
$lang['Cell_caution_pay']='Payer la peine';
$lang['Cell_free']='Vous avez maintenant &eacute;t&eacute; lib&eacute;r&eacute; de prison. Veillez faire attention a l\'avenir. <br /><br />Click <a href="'.append_sid("index.php").'">ici</a> pour aller &agrave; l\'index des forums';

// Language keys added or modified for 0.1.0
$lang['Cell_celled_time']='Dur&eacute;e';
$lang['Cell_judge_user']='Juger cet utilisateur';
$lang['Cell_judgement']='Jugement';
$lang['Cell_freeable']='Peut &ecirc;tre lib&eacute;r&eacute;';
$lang['Cell_freeable_explain']='Si vous cochez cette option, les autres utilisateurs seront en mesure de juger cet utilisateur'; 
$lang['Cell_cautionnable']='L\'amende peut &ecirc;tre pay&eacute;';
$lang['Cell_cautionnable_explain']='Si vous cochez cette option, les autres utilisateurs seront en mesure de payer l\'amende pour cet utilisateur';
$lang['Cell_admin_celled_users_explain']='Vous pouvez modifier les utilisateurs emprisonn&eacute;s en cliquant sur leur nom';
$lang['Cell_admin_celled_edited_ok']='Cet utilisateur a &eacute;t&eacute; modifi&eacute; avec succ&egrave;s';
$lang['Cell_selected_celled']='Selectionner cet utilisateur:';
$lang['Cell_judgement_none']='Aucun membre n\'est emprisonn&eacute;s';
$lang['Cell_celled_list']='Voir l\'historique';
$lang['Cell_celled_date']='Date';
$lang['Cell_freed_type']='Lib&eacute;r&eacute; par';
$lang['Cell_judgement_never']='Aucun utilisateur n\'a encore &eacute;t&eacute; emprisonn&eacute;';
$lang['Cell_freed_type_still']='Cet utilisateur est toujours emprisonn&eacute;';
$lang['Cell_freed_type_time']='Cet utilisateur est toujours emprisonn&eacute;';
$lang['Cell_freed_type_admin']='Tribunal';
$lang['Cell_celled_list_history']='Historique';
$lang['Cell_imprisonments']='Total';
$lang['Cell_admin_celled_blank']='D&eacute;sactivez cette histoire les utilisateurs de prison';
$lang['Cell_admin_celled_blank_explain']='Si vous cochez cette option, les utilisateurs de cette histoire de l\'emprisonnement sera supprim&eacute;';
$lang['Cell_admin_update_error']='Erreur lors de la mise &agrave; jour de la mise en prison';
$lang['Cell_updated_return_settings']='Les r&eacute;glages de la prison ont &eacute;t&eacute; &eacute;dit&eacute;s avec succ&egrave;s. <br /><br />Click %sici%s pour revenir &agrave; la gestion de la prison'; 
$lang['Cell_settings_explain']='Ici, vous pouvez modifier les param&egrave;tres g&eacute;n&eacute;raux du syst&egrave;me carc&eacute;ral';
$lang['Cell_settings_bars']='Afficher l\'avatar des utilisateurs emprisonn&eacute;s derri&egrave;re les barreaux de la cellule';
$lang['Cell_settings_celleds']='Afficher le nombre total de sanction des utilisateurs sur des sujets et dans leur profil';
$lang['Cell_settings_caution']='Permettre aux utilisateurs de payer l\'amende pour les autres utilisateurs';
$lang['Cell_settings_judge']='Permettre aux utilisateurs de juger les autres utilisateurs';
$lang['Cell_settings_blank']='Autoriser les utilisateurs &agrave; effacer leur casier judiciaire';
$lang['Cell_settings_blank_sum']='Somme &agrave; payer pour effacer l\'enregistrement des individus pa la police';
$lang['Cell_judgement']='Jugement';
$lang['Cell_judgement_pay_sledge']='Pay&eacute; l\amende';
$lang['Cell_lack_money']='Vous n\'avez pas assez de points pour effectuer cette action';
$lang['Cell_sledge_paid']='Cet utilisateur a pay&eacute; son amende avec succ&egrave;s';
$lang['Cell_return']='Click %shere%s pour revenir au tribunal';
$lang['Cell_settings_voters']='Nombre minimum de votes afin de valider le jugement'; 
$lang['Cell_settings_posts']='Nombre minimum de postes pour que les utilisateurs soit autoris&eacute;s &agrave; voter';
$lang['Cell_caution_not_authed']='Cet utilisateur peut &ecirc; tre lib&eacute;r&eacute; en payant l\'amende';
$lang['Cell_judgement_ever']='Vous avez d&eacute;j&agrave; jug&eacute; cet utilisateur';
$lang['Cell_judgement_explain']='Quel est votre jugement?';
$lang['Cell_judgement_guilty']='Coupable';
$lang['Cell_judgement_innocent']='Innocent';
$lang['Cell_judgement_not_authed']='Vous n\'&ecirc; tes pas autoris&eacute; &agrave; juger cet utilisateur';
$lang['Cell_judgement_done']='Votre jugement a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s';
$lang['Cell_blank_text']='Vous pouvez effacer votre casier judiciaire si vous payez la somme de %s';
$lang['Cell_blank_explain']='Videz votre casier judiciaire';
$lang['Cell_blank_done']='Votre casier judiciaire a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s';
$lang['Cell_judgement_ever_authed']='Cet utilisateur a &eacute;t&eacute; jug&eacute; coupable';

// Language keys added or modified for 0.2.0
$lang['Cell_default_points_name']='Points';
$lang['Cell_admin_punishment']='S&eacute;lectionnez les actions interdites pour l\'utilisateur :';
$lang['Cell_admin_punishment_global']='Tout';
$lang['Cell_admin_punishment_posts']='Poster un nouveau message';
$lang['Cell_admin_punishment_read']='Poster et lire les messages';
$lang['Cell_punishment']='Sanction';
$lang['Cell_punishment_global']='Banni';
$lang['Cell_punishment_posts']='Impossible de poster de nouveaux messages';
$lang['Cell_punishment_read']='Impossible lire ou poster des messages';
$lang['Cell_time_explain_posts']='Pour le moment, vous n\'&ecirc; tes pas autoris&eacute; &agrave; poster de nouveaux messages';
$lang['Cell_time_explain_read']='Pour le moment, vous n\'&ecirc; tes pas autoris&eacute; &agrave; lire ou envoyer des messages';

?>
