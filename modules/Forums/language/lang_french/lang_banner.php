<?php
/**************************************************************
*
*  MOD Title:   Complete banner
*  MOD Version: 1.1.5
*  Translation: Français (French)
*  Rev date:    08/12/2003
*
*  Translator:  ?
*
***************************************************************/

// this is the text showen in admin panel, depending on your template layout,
// you may change the text, so this reflect the placement in the templates
// these are only exampels, you may add more or remove some of them.

$lang['Banner_spot']['0'] = 'Vision des bannières'; // used for {BANNER_0_IMG} tag in the template files
$lang['Banner_spot']['1'] = 'Haut gauche 1'; // used for {BANNER_1_IMG} tag in the template files
$lang['Banner_spot']['2'] = 'Haut gauche 2'; // used for {BANNER_2_IMG} tag in the template files
$lang['Banner_spot']['3'] = 'Haut centré 1'; // used for {BANNER_3_IMG} tag in the template files
$lang['Banner_spot']['4'] = 'Haut centré 2'; // used for {BANNER_4_IMG} tag in the template files
$lang['Banner_spot']['5'] = 'Haut droite 1'; // used for {BANNER_5_IMG} tag in the template files
$lang['Banner_spot']['6'] = 'Haut droite 2'; // used for {BANNER_6_IMG} tag in the template files
$lang['Banner_spot']['7'] = 'Bas gauche 1'; // used for {BANNER_7_IMG} tag in the template files
$lang['Banner_spot']['8'] = 'Bas gauche 2'; // used for {BANNER_8_IMG} tag in the template files
$lang['Banner_spot']['9'] = 'Bas centré 1'; // used for {BANNER_9_IMG} tag in the template files
$lang['Banner_spot']['10'] = 'Bas centré 2'; // used for {BANNER_10_IMG} tag in the template files
$lang['Banner_spot']['11'] = 'Bas droite 1'; // used for {BANNER_11_IMG} tag in the template files
$lang['Banner_spot']['12'] = 'Bas droite 2'; // used for {BANNER_12_IMG} tag in the template files
$lang['Banner_spot']['13'] = 'Forum_view top'; // used for {BANNER_13_IMG} tag in the template files
$lang['Banner_spot']['14'] = 'En haut dans les sujets'; // used for {BANNER_14_IMG} tag in the template files
$lang['Banner_spot']['15'] = 'En bas dans les sujets'; // used for {BANNER_15_IMG} tag in the template files

//
// please do not modify the text below (except if you are translating)
//
$lang['Banner_title'] = 'Administration des bannières';
$lang['Banner_text'] = 'Ici, vous pouvez modifier les bannières utilisées sur ce site, elles peuvent être définies à partir d\'un temps basé sur un réglement';
$lang['Add_new_banner'] = 'Nouvelle bannière';
$lang['Banner_add_text'] = 'Ici, vous pouvez ajouter/éditer une bannière';

$lang['Banner_example']="Example";
$lang['Banner_example_explain'] ="This should be how the banner display";
$lang['Banner_type_text'] = "type";
$lang['Banner_type_explain'] = "Select the type of banner";
//pre-defined types
$lang['Banner_type'][0] = "Image link";
$lang['Banner_type'][2] = "Text link";
$lang['Banner_type'][4] = "Custom HTML code";
$lang['Banner_type'][6] = "Flash file";

$lang['Banner_name'] = 'Image';
$lang['Banner_name_explain'] = 'doit être relatif au chemin phpbb2 ou de l\'adresse complète';
$lang['Banner_size'] = "Image Size";
$lang['Banner_size_explain'] = "if size is set to zero, the image will default to is pixel size";
$lang['Banner_width'] = "Width";
$lang['Banner_height'] = "Height";

$lang['Banner_activated'] = 'Activée';
$lang['Banner_activate'] = 'Activer la bannière';
$lang['Banner_comment'] = 'Commentaire';
$lang['Banner_description'] = 'Description de l\'image';
$lang['Banner_description_explain'] = 'Ce texte est affiché lorsque la souris passe au-dessus de l\'image';
$lang['Banner_url'] = 'Adresse de redirection';
$lang['Banner_url_explain'] = 'L\'adresse URL du site de redirection, lors du clic ouverture avec HTTP://';
$lang['Banner_owner'] = 'Modérateur des bannières';
$lang['Banner_owner_explain'] = 'Cet utilisateur peut gérer la bannière - (pas encore fonctionnel)';
$lang['Banner_placement'] = 'Placement';
$lang['Banner_clicks'] = 'Clics';
$lang['Banner_clicks_explain'] = "(Counting is only enabled if type is Image or Text link)";
$lang['Banner_view'] = 'Vus';
$lang['Banner_weigth'] = 'Poids de la bannière';
$lang['Banner_weigth_explain'] = 'Fréquence d\'affichage de la bannière, relatif aux autres bannières actives à l\'heure actuelle. (1-99)';
$lang['Show_to_users'] = 'Montrer aux utilisateurs';
$lang['Show_to_users_explain'] = 'Sélectionner quels types d\'utilisateurs peuvent être autorisés à voir les bannières';
$lang['Show_to_users_select'] = 'L\'utilisateur doit être %s pour %s'; //%s are supstituded with dropdown selections
$lang['Banner_level']['-1'] = 'Invité';
$lang['Banner_level']['0'] = 'Enregistré';
$lang['Banner_level']['1'] = 'Modérateur';
$lang['Banner_level']['2'] = 'Admin';
$lang['Banner_level_type']['0'] = 'égal';
$lang['Banner_level_type']['1'] = 'inférieur ou égal';
$lang['Banner_level_type']['2'] = 'suppérieur ou égal';
$lang['Banner_level_type']['3'] = 'aucun';

$lang['Time_interval'] = 'Intervalle de temps';
$lang['Time_interval_explain'] = 'Appliquer uniquement à chaque date, un jour de la semaine ou/et une heure';
$lang['Start'] = 'début';
$lang['End'] = 'fin';
$lang['Year'] = 'année';
$lang['Month'] = 'mois';
$lang['Date'] = 'date';
$lang['Weekday'] = 'jour';
$lang['Hour'] = 'heure';
$lang['Min'] = 'min';
$lang['Time_type'] = 'Type d\'heure';
$lang['Time_type_explain'] = 'Sélectionner les informations de l\'intervalle de temps ou de la date d\'intervalle (<i>vous pourrez encore appliquer un temps d\'intervalle si vous sélectionnez une date basé sur le réglement</i>)';
$lang['Not_specify'] = 'Non specifié';
$lang['No_time'] = 'Aucune heure';
$lang['By_time'] = 'par heure';
$lang['By_week'] = 'par jour';
$lang['By_date'] = 'par date';

// messages
$lang['Missing_banner_id'] = 'L\'ID de la bannière a été perdue';
$lang['Missing_banner_owner'] = 'Vous devez sélectionner un propriètaire de bannière';
$lang['Missing_time'] = 'Lorsque vous définissez une bannière sur une base de temps, vous devez fournir un intervalle de temps.';
$lang['Missing_date'] = 'Lorsque vous définissez une bannière à partir d\'une date, vous devez au moins fournir une date et un intervalle de temps.';
$lang['Missing_week'] = 'Lorsque vous définissez une bannière à partir d\'un jour de la semaine, vous devez au moins fournir un jour de la semaine et un temps d\'intervalle.';

$lang['Banner_removed'] = 'La bannière a été supprimée';
$lang['Banner_updated'] = 'La bannière a été mise à jour';
$lang['Banner_added'] = 'La bannière a été ajoutée';
$lang['Click_return_banneradmin'] = 'Cliquez %sici%s pour revenir à la gestion des bannières';

$lang['No_redirect_error'] = 'Si votre page ne s\'affiche pas rapidement, veuillez cliquer <b><a href="%s" id="jumplink" name="jumplink">ici<a></b> pour aller vers l\'adresse URL requise';
$lang['Left_via_banner'] = '';

$lang['Banner_filter'] = 'Banner filter';
$lang['Banner_filter_explain'] = 'Hide this banner after the user have clicked on it';
$lang['Banner_filter_time'] = 'Inactive click time';
$lang['Banner_filter_time_explain'] = 'Number of sec the banner becomes inactive after a user click on it, if banner filter is enabled, the banner will nor show in this time';

?>
