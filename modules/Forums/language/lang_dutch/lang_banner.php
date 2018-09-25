<?php
/**************************************************************
*
*  MOD Title:   Complete banner
*  MOD Version: 1.1.5
*  Translation: Nederlands (Dutch)
*  Rev date:    08/12/2003
*
*  Translator:  **MIKE** < mbwalter30@hotmail.com > (n/a)
*
***************************************************************/

// this is the text showen in admin panel, depending on your template layout, 
// you may change the text, so this reflect the placement in the templates 
// these are only exampels, you may add more or remove some of them. 

$lang['Banner_spot']['0'] = "Algemene banner"; // used for {BANNER_0_IMG} tag in the template files 
$lang['Banner_spot']['1'] = "Boven links 1"; // used for {BANNER_1_IMG} tag in the template files 
$lang['Banner_spot']['2'] = "Boven links 2"; // used for {BANNER_2_IMG} tag in the template files 
$lang['Banner_spot']['3'] = "Boven midden 1"; // used for {BANNER_3_IMG} tag in the template files 
$lang['Banner_spot']['4'] = "Boven midden 2"; // used for {BANNER_4_IMG} tag in the template files 
$lang['Banner_spot']['5'] = "Boven rechts 1"; // used for {BANNER_5_IMG} tag in the template files 
$lang['Banner_spot']['6'] = "Boven rechts 2"; // used for {BANNER_6_IMG} tag in the template files 
$lang['Banner_spot']['7'] = "Onder links 1"; // used for {BANNER_7_IMG} tag in the template files 
$lang['Banner_spot']['8'] = "Onder links 2"; // used for {BANNER_8_IMG} tag in the template files 
$lang['Banner_spot']['9'] = "Onder midden 1"; // used for {BANNER_9_IMG} tag in the template files 
$lang['Banner_spot']['10'] = "Onder midden 2"; // used for {BANNER_10_IMG} tag in the template files 
$lang['Banner_spot']['11'] = "Onder rechts 1"; // used for {BANNER_11_IMG} tag in the template files 
$lang['Banner_spot']['12'] = "Onder rechts 2"; // used for {BANNER_12_IMG} tag in the template files 
$lang['Banner_spot']['13'] = "Forum_view boven"; // used for {BANNER_13_IMG} tag in the template files 
$lang['Banner_spot']['14'] = "Topic view boven"; // used for {BANNER_14_IMG} tag in the template files 
$lang['Banner_spot']['15'] = "Topic view onder"; // used for {BANNER_15_IMG} tag in the template files 

// 
// please do not modify the text below (except if you are translating) 
// 
$lang['Banner_title'] = "Banner instellingen"; 
$lang['Banner_text'] = "Vanaf hier kan je de banners die op deze site gebruikt worden aanpassen. Banners kunnen ingesteld worden op tijd."; 
$lang['Add_new_banner'] = "Nieuwe banner"; 
$lang['Banner_add_text'] = "Hier mag je een banner toevoegen wijzigen"; 

$lang['Banner_name'] = "Banner"; 
$lang['Banner_name_explain'] = "moet relatief zijn tot het phpbb2 pad of complete URL"; 
$lang['Banner_activated'] = "Geactiveerd"; 
$lang['Banner_activate'] = "Activeer banner"; 
$lang['Banner_comment'] = "Commentaar"; 
$lang['Banner_description'] = "Banner beschrijving"; 
$lang['Banner_description_explain'] = "Deze tekst is zichtbaar als je met de muis over de banner beweegd"; 
$lang['Banner_url'] = "Redirect url"; 
$lang['Banner_url_explain'] ="De url van de site waarnaar geredirect word, na een muisklik, start met HTTP://"; 
$lang['Banner_owner']="Moderator van de banner"; 
$lang['Banner_owner_explain']="Deze gebruiker mag de instellingen van de banner wijzigen - (nog niet geimplementeerd)"; 
$lang['Banner_placement'] = "Plaats"; 
$lang['Banner_clicks'] = "Aantal keer aangeklikt"; 
$lang['Banner_view'] = "Aantal keer gezien"; 
$lang['Banner_weigth'] = "Gewicht van de banner"; 
$lang['Banner_weigth_explain'] = "Hoe vaak moet de banner gezien worden, relatief tot andere banners op dit tijdstip. (1-99)"; 
$lang['Show_to_users'] ='Laat aan gebruikers zien'; 
$lang['Show_to_users_explain'] ='Selecteer welk type gebruikers deze banner moeten zien'; 
$lang['Show_to_users_select'] = 'Gebruikers zijn %s aan %s'; //%s are supstituded with dropdown selections 
$lang['Banner_level']['-1'] = 'Gast'; 
$lang['Banner_level']['0'] = 'Geregistreerd'; 
$lang['Banner_level']['1'] = 'Moderators'; 
$lang['Banner_level']['2'] = 'Admin'; 
$lang['Banner_level_type']['0'] = 'gelijk'; 
$lang['Banner_level_type']['1'] = 'lager of gelijk'; 
$lang['Banner_level_type']['2'] = 'hoger of gelijk'; 
$lang['Banner_level_type']['3'] = 'niet'; 

$lang['Time_interval'] = "Tijd interval"; 
$lang['Time_interval_explain'] = "Gebruik alleen of een datum, een dagvan de week of/en een tijd"; 
$lang['Start'] = "Start"; 
$lang['End'] = "Einde"; 
$lang['Year'] = "Jaar"; 
$lang['Month'] = "Maand"; 
$lang['Date'] = "Datum"; 
$lang['Weekday'] = "Dag van de week"; 
$lang['Hour'] = "Uur"; 
$lang['Min'] = "Min"; 
$lang['Time_type'] = "Tijd type"; 
$lang['Time_type_explain'] = "Selecteer als de informatie een tijd interval of een datum interval is<i>(je mag nog steeds een tijd interval kiezen, als je een op datum gebaseerde regel gebruikt)</i>"; 
$lang['Not_specify'] = "Niet gespecificeerd"; 
$lang['No_time'] = "Geen tijd"; 
$lang['By_time'] = "Door tiid"; 
$lang['By_week'] = "Door dag van de week"; 
$lang['By_date'] = "Door datum"; 

// messages 
$lang['Missing_banner_id'] = "De banner id is niet aanwezig"; 
$lang['Missing_banner_owner'] = "Je moet een banner eigenaar kiezen"; 
$lang['Missing_time'] = "Als je een banner insteld op tijd gebasseerd, moet je een tij interval instellen"; 
$lang['Missing_date'] ="Als je een banner insteld op datum, moet je minimaal een datum en tijd interval instellen"; 
$lang['Missing_week'] ="Als je een banner insteld op weekdag. moet je minimaal een dag van de week en een tijd interval instellen"; 

$lang['Banner_removed'] = "De banner is nu verwijderd"; 
$lang['Banner_updated'] = "De banner is nu geupdate"; 
$lang['Banner_added'] = "De banner is nu toegevoegd"; 
$lang['Click_return_banneradmin'] = 'Klik %sHier%s om terug te gaan naar de banner instellingen'; 

$lang['No_redirect_error'] = 'Als je pagina niet kort te zien is, klik dan <b><a href="%s" id="jumplink" name="jumplink">Hier<a></b> om naar de gevraagde URL te gaan'; 
$lang['Left_via_banner'] = '';

?>