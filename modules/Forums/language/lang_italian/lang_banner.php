<?php
/**************************************************************
*
*  MOD Title:   Complete banner
*  MOD Version: 1.1.5
*  Translation: Italiano (Italian)
*  Rev date:    08/12/2003
*
*  Translator:  Mighty Gorgon < mightygorgon@supereva.it > (n/a) http://www.mightygorgon.cjb.net/
*
***************************************************************/

// this is the text showen in admin panel, depending on your template layout, 
// you may change the text, so this reflect the placement in the templates 
// these are only exampels, you may add more or remove some of them. 

$lang['Banner_spot']['0'] = "Banner Principale"; // used for {BANNER_0_IMG} tag in the template files 
$lang['Banner_spot']['1'] = "Superiore Sinistro 1"; // used for {BANNER_1_IMG} tag in the template files 
$lang['Banner_spot']['2'] = "Superiore Sinistro 2"; // used for {BANNER_2_IMG} tag in the template files 
$lang['Banner_spot']['3'] = "Superiore Centrale 1"; // used for {BANNER_3_IMG} tag in the template files 
$lang['Banner_spot']['4'] = "Superiore Centrale 2"; // used for {BANNER_4_IMG} tag in the template files 
$lang['Banner_spot']['5'] = "Superiore Destro 1"; // used for {BANNER_5_IMG} tag in the template files 
$lang['Banner_spot']['6'] = "Superiore Destro 2"; // used for {BANNER_6_IMG} tag in the template files 
$lang['Banner_spot']['7'] = "Inferiore Sinistro 1"; // used for {BANNER_7_IMG} tag in the template files 
$lang['Banner_spot']['8'] = "Inferiore Sinistro 2"; // used for {BANNER_8_IMG} tag in the template files 
$lang['Banner_spot']['9'] = "Inferiore Centrale 1"; // used for {BANNER_9_IMG} tag in the template files 
$lang['Banner_spot']['10'] = "Inferiore Centrale 2"; // used for {BANNER_10_IMG} tag in the template files 
$lang['Banner_spot']['11'] = "Inferiore Destro 1"; // used for {BANNER_11_IMG} tag in the template files 
$lang['Banner_spot']['12'] = "Inferiore Destro 2"; // used for {BANNER_12_IMG} tag in the template files 
$lang['Banner_spot']['13'] = "Superiore Vista Forum"; // used for {BANNER_13_IMG} tag in the template files 
$lang['Banner_spot']['14'] = "Superiore Vista Argomenti"; // used for {BANNER_14_IMG} tag in the template files 
$lang['Banner_spot']['15'] = "Inferiore Vista Argomenti"; // used for {BANNER_15_IMG} tag in the template files 

// 
// please do not modify the text below (except if you are translating) 
// 
$lang['Banner_title'] = "Amministrazione Banner"; 
$lang['Banner_text'] = "Da qui è possibile modificare i banners utilizzati nel sito. I banners possono anche essere visualizzati a tempo"; 
$lang['Add_new_banner'] = "Nuovo Banner"; 
$lang['Banner_add_text'] = "Da qui è possibile aggiungere/modificare un banner"; 

$lang['Banner_name'] = "Immagine"; 
$lang['Banner_name_explain'] = "deve essere relativo al percorso di phpbb2 o deve essere un indirizzo URL completo"; 
$lang['Banner_activated'] = "Attivo"; 
$lang['Banner_activate'] = "Attiva Banner"; 
$lang['Banner_comment'] = "Commento"; 
$lang['Banner_description'] = "Descrizione Immagine"; 
$lang['Banner_description_explain'] = "Questo testo è mostrato quando viene puntato il mouse sull'immagine"; 
$lang['Banner_url'] = "Reindirizzamento URL"; 
$lang['Banner_url_explain'] ="L'URL del sito verso cui si verrà reindirizzati al click (deve iniziare per HTTP://"; 
$lang['Banner_owner']="Moderatore del banner"; 
$lang['Banner_owner_explain']="Questo utente può gestire il banner - (ancora non implementato)"; 
$lang['Banner_placement'] = "Posizionamento"; 
$lang['Banner_clicks'] = "Clicks"; 
$lang['Banner_view'] = "Visualizzazioni"; 
$lang['Banner_weigth'] = "Dimensione del banner"; 
$lang['Banner_weigth_explain'] = "Frequenza di visualizzazione del banner, relativa agli altri banners attivi nello stesso momento. (1-99)"; 
$lang['Show_to_users'] ='Visualizzato Da'; 
$lang['Show_to_users_explain'] ='Seleziona quali utenti debbono visualizzare il banner'; 
$lang['Show_to_users_select'] = 'Il livello dell\'utente deve essere da %s a %s'; //%s are supstituded with dropdown selections 
$lang['Banner_level']['-1'] = 'Ospite'; 
$lang['Banner_level']['0'] = 'Registrato'; 
$lang['Banner_level']['1'] = 'Moderatore'; 
$lang['Banner_level']['2'] = 'Amministratore'; 
$lang['Banner_level_type']['0'] = 'uguale'; 
$lang['Banner_level_type']['1'] = 'inferiore o uguale'; 
$lang['Banner_level_type']['2'] = 'superiore o uguale'; 
$lang['Banner_level_type']['3'] = 'non'; 

$lang['Time_interval'] = "Intervallo"; 
$lang['Time_interval_explain'] = "Si applica soltanto a date, giorni della settimana e/o orari"; 
$lang['Start'] = "Inizio"; 
$lang['End'] = "Fine"; 
$lang['Year'] = "Anno"; 
$lang['Month'] = "Mese"; 
$lang['Date'] = "Data"; 
$lang['Weekday'] = "Giorno della settimana"; 
$lang['Hour'] = "Ore"; 
$lang['Min'] = "Min"; 
$lang['Time_type'] = "Tipologia Orario"; 
$lang['Time_type_explain'] = "Selezion se l'informazione è un intervallo di tempo o di date (<i>dovresti applicaro ad un intervallo di tempo, se hai selezionato una regola di data</i>)"; 
$lang['Not_specify'] = "Non Specificato"; 
$lang['No_time'] = "Nessun Orario"; 
$lang['By_time'] = "Per Orario"; 
$lang['By_week'] = "Per Giorno Della Settimana"; 
$lang['By_date'] = "Per Data"; 

// messages 
$lang['Missing_banner_id'] = "L'ID del banner è mancante"; 
$lang['Missing_banner_owner'] = "Devi specificare il proprietario del banner"; 
$lang['Missing_time'] = "Quando viene definito un banner per orario, devi specificare l'intervallo"; 
$lang['Missing_date'] ="Quando viene definito un banner per data, devi specificare almeno data ed intervallo orario"; 
$lang['Missing_week'] ="Quando viene definito un banner per giorno della settimana, devi specificare almeno il giorno della settimana e l'intervallo orario"; 

$lang['Banner_removed'] = "Il banner è stato rimosso"; 
$lang['Banner_updated'] = "Il banner è stato aggiornato"; 
$lang['Banner_added'] = "Il banner è stato aggiunto"; 
$lang['Click_return_banneradmin'] = 'Clicca %sQui%s per tornare alla gestione dei Banners'; 

$lang['No_redirect_error'] = 'Se la pagina non viene visualizzata a breve, per favore clicca <b><a href="%s" id="jumplink" name="jumplink">Qui<a></b> per essere reindirizzato all\'indirizzo richiesto'; 
$lang['Left_via_banner'] = 'Ridirezionato dal banner'; 

?>