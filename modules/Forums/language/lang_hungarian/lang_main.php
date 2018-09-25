<?php
/***************************************************************************
 *                            lang_main.php [Magyar magázó]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_main.php,v 1.85.2.15 2003/06/10 00:31:19 psotfx Exp $
 *
 *     translated by   : Szilard Andai
 *     web             : http://iranon.ezustkep.hu
 *     version         : 2.0.22
 *     edited by       : Fodor Bertalan - http://phpbb.hu and László Miklós
 *
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// CONTRIBUTORS:
//         Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'ISO-8859-2';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
$lang['DATE_FORMAT'] =  'Y.m.d. l G:i'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = 'Magyar fordítás &copy; <a class="copyright" href="http://iranon.ezustkep.hu">Andai Szilárd</a> - Magázó verzió: <a class="copyright" href="http://www.phpbb.hu" title="Fordítás frissítése és javítása valamint a magázó verzió készítése: Fodor Bertalan">Magyar phpBB közösség</a> és László Miklós';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Fórum';
$lang['Category'] = 'Témakör';
$lang['Topic'] = 'Téma';
$lang['Topics'] = 'Témák';
$lang['Replies'] = 'Válaszok';
$lang['Views'] = 'Megtekintve';
$lang['Post'] = 'Hozzászólás';
$lang['Posts'] = 'Hozzászólások';
$lang['Posted'] = 'Elküldve';
$lang['Username'] = 'Felhasználónév';
$lang['Password'] = 'Jelszó';
$lang['Email'] = 'Email';
$lang['Poster'] = 'Küldõ';
$lang['Author'] = 'Szerzõ';
$lang['Time'] = 'Idõ';
$lang['Hours'] = 'Óra';
$lang['Message'] = 'Üzenet';

$lang['1_Day'] = '1 nap';
$lang['7_Days'] = '7 nap';
$lang['2_Weeks'] = '2 hét';
$lang['1_Month'] = '1 hónap';
$lang['3_Months'] = '3 hónap';
$lang['6_Months'] = '6 hónap';
$lang['1_Year'] = '1 év';

$lang['Go'] = 'Mehet';
$lang['Jump_to'] = 'Ugrás';
$lang['Submit'] = 'Elküld';
$lang['Reset'] = 'Töröl';
$lang['Cancel'] = 'Mégsem';
$lang['Preview'] = 'Elõnézet';
$lang['Confirm'] = 'Elfogad';
$lang['Spellcheck'] = 'Helyesírás';
$lang['Yes'] = 'Igen';
$lang['No'] = 'Nem';
$lang['Enabled'] = 'Bekapcsolva';
$lang['Disabled'] = 'Kikapcsolva';
$lang['Error'] = 'Hiba';

$lang['Next'] = 'Következõ';
$lang['Previous'] = 'Elõzõ';
$lang['Goto_page'] = 'Ugrás a köv. oldalra:';
$lang['Joined'] = 'Csatlakozott';
$lang['IP_Address'] = 'IP-cím';

$lang['Select_forum'] = 'Fórum kiválasztása';
$lang['View_latest_post'] = 'Legutóbbi hozzászólások';
$lang['View_newest_post'] = 'Legújabb hozzászólások';
$lang['Page_of'] = '<b>%d</b> / <b>%d</b> oldal'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'ICQ';
$lang['AIM'] = 'AIM';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = 'Tartalomjegyzék';  // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = 'Új téma nyitása';
$lang['Reply_to_topic'] = 'Hozzászólás a témához';
$lang['Reply_with_quote'] = 'Hozzászólás az elõzmény idézésével';

$lang['Click_return_topic'] = '%sVisszatérés%s a témához.'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Kattintson %side%s, hogy ismét megpróbálja.';
$lang['Click_return_forum'] = 'Kattintson %side%s, hogy visszatérjenen a fórumba.';
$lang['Click_view_message'] = 'Kattintson %side%s a hozzászólása megtekintéséhez.';
$lang['Click_return_modcp'] = '%sVisszatérés%s a Moderátor vezérlõpulthoz.';
$lang['Click_return_group'] = '%sVisszatérés%s a csoporthoz.';

$lang['Admin_panel'] = 'Fórum adminisztráció';

$lang['Board_disable'] = 'A fórum ideiglenesen szünetel, kérem próbálkozzon késõbb.';


//
// Global Header strings
//
$lang['Registered_users'] = 'Regisztrált felhasználók:';
$lang['Browsing_forum'] = 'Jelenlévõ fórumozók:';
$lang['Online_users_zero_total'] = 'Összesen <b>0</b> felhasználó van jelen :: ';
$lang['Online_users_total'] = 'Jelenleg <b>%d</b> felhasználó van itt :: ';
$lang['Online_user_total'] = 'Jelenleg <b>%d</b> felhasználó van itt :: ';
$lang['Reg_users_zero_total'] = '0 regisztrált, ';
$lang['Reg_users_total'] = '%d regisztrált, ';
$lang['Reg_user_total'] = '%d regisztrált, ';
$lang['Hidden_users_zero_total'] = '0 rejtett és ';
$lang['Hidden_user_total'] = '%d rejtett és ';
$lang['Hidden_users_total'] = '%d rejtett és ';
$lang['Guest_users_zero_total'] = '0 vendég';
$lang['Guest_users_total'] = '%d vendég';
$lang['Guest_user_total'] = '%d vendég';
$lang['Record_online_users'] = 'A legtöbb felhasználó (<b>%s</b> fõ) %s-kor volt itt.'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdminisztrátor%s';
$lang['Mod_online_color'] = '%sModerátor%s';

$lang['You_last_visit'] = 'Legutolsó látogatásának dátuma: %s'; // %s replaced by date/time
$lang['Current_time'] = 'Pontos idõ: %s'; // %s replaced by time

$lang['Search_new'] = 'Hozzászólások a legutolsó látogatás óta';
$lang['Search_your_posts'] = 'Üzenetei megtekintése';
$lang['Search_unanswered'] = 'Megválaszolatlan üzenetek megtekintése';

$lang['Register'] = 'Regisztráció';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = 'Profil szerkesztése';
$lang['Search'] = 'Keresés';
$lang['Memberlist'] = 'Taglista';
$lang['FAQ'] = 'Gy.I.K.';
$lang['BBCode_guide'] = 'BBCode kalauz';
$lang['Usergroups'] = 'Csoportok';
$lang['Last_Post'] = 'Legutolsó üzenet';
$lang['Moderator'] = 'Moderátor';
$lang['Moderators'] = 'Moderátorok';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Jelenleg összesen <b>0</b> hozzászólás olvasható.'; // Number of posts
$lang['Posted_articles_total'] = 'Jelenleg összesen <b>%d</b> hozzászólás olvasható.'; // Number of posts
$lang['Posted_article_total'] = 'Eddig összesen <b>%d</b> hozzászólás olvasható.'; // Number of posts
$lang['Registered_users_zero_total'] = 'Összesen <b>0</b> regisztrált felhasználónk van.'; // # registered users
$lang['Registered_users_total'] = 'Összesen <b>%d</b> regisztrált felhasználónk van.'; // # registered users
$lang['Registered_user_total'] = 'Összesen <b>%d</b> regisztrált felhasználónk van.'; // # registered users
$lang['Newest_user'] = 'Legújabb regisztrált tagunk: <b>%s%s%s</b>'; // a href, username, /a

$lang['No_new_posts_last_visit'] = 'Nincsen új hozzászólás a legutolsó látogatása óta.';
$lang['No_new_posts'] = 'Nincsenek új hozzászólások';
$lang['New_posts'] = 'Új hozzászólások';
$lang['New_post'] = 'Új hozzászólás';
$lang['No_new_posts_hot'] = 'Nincsenek új hozzászólások [ Népszerû ]';
$lang['New_posts_hot'] = 'Új hozzászólások [ Népszerû ]';
$lang['No_new_posts_locked'] = 'Nincsenek új hozzászólások [ Lezárt ]';
$lang['New_posts_locked'] = 'Új hozzászólások [ Lezárt ]';
$lang['Forum_is_locked'] = 'Lezárt fórum';


//
// Login
//
$lang['Enter_password'] = 'A belépéshez adja meg a felhasználónevét és jelszavát.';
$lang['Login'] = 'Belépés';
$lang['Logout'] = 'Kilépés';

$lang['Forgotten_password'] = 'Elfelejtettem a jelszót!';

$lang['Log_me_in'] = 'Automatikus bejelentkezés';

$lang['Error_login'] = 'Hibás, vagy inaktív felhasználónevet és/vagy hibás jelszót adott meg!';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Nincs hozzászólás.';
$lang['No_forums'] = 'Nincsenek fórumok.';

$lang['Private_Message'] = 'Privát üzenet';
$lang['Private_Messages'] = 'Privát üzenetek';
$lang['Who_is_Online'] = 'Ki van itt?';

$lang['Mark_all_forums'] = 'Összes fórum megjelölése olvasottként';
$lang['Forums_marked_read'] = 'Összes fórum megjelölve olvasottként.';


//
// Viewforum
//
$lang['View_forum'] = 'Fórum megtekintése';

$lang['Forum_not_exist'] = 'A kiválsztott fórum nem létezik.';
$lang['Reached_on_error'] = 'Hiba.';

$lang['Display_topics'] = 'Összes téma mutatása';
$lang['All_Topics'] = 'Összes téma';

$lang['Topic_Announcement'] = '<b>Közlemény:</b>';
$lang['Topic_Sticky'] = '<b>Kiemelt:</b>';
$lang['Topic_Moved'] = '<b>Árnyék:</b>';
$lang['Topic_Poll'] = '<b>[ Szavazás ]</b>';

$lang['Mark_all_topics'] = 'Összes téma megjelölése olvasottként';
$lang['Topics_marked_read'] = 'Összes téma megjelölve olvasottként.';

$lang['Rules_post_can'] = '<b>Készíthet</b> új témákat ebben a fórumban.';
$lang['Rules_post_cannot'] = '<b>Nem</b> készíthet új témákat ebben a fórumban.';
$lang['Rules_reply_can'] = '<b>Válaszolhat</b> egy témára ebben a fórumban.';
$lang['Rules_reply_cannot'] = '<b>Nem</b> válaszolhat egy témára ebben a fórumban.';
$lang['Rules_edit_can'] = '<b>Módosíthatja</b> a hozzászólásait a fórumban.';
$lang['Rules_edit_cannot'] = '<b>Nem</b> módosíthatja a hozzászólásait a fórumban.';
$lang['Rules_delete_can'] = '<b>Törölheti</b> a hozzászólásait a fórumban.';
$lang['Rules_delete_cannot'] = '<b>Nem</b> törölheti a hozzászólásait a fórumban.';
$lang['Rules_vote_can'] = '<b>Szavazhat</b> ebben a fórumban.';
$lang['Rules_vote_cannot'] = '<b>Nem</b> szavazhat ebben fórumban.';
$lang['Rules_moderate'] = '<b>%sModerálhatja%s</b> ezt a fórumot.'; // %s replaced by a href links, do not remove!

$lang['No_topics_post_one'] = 'Nincsenek témák a fórumban.<br />Kattintson az <b>Új téma készítésére</b>.';


//
// Viewtopic
//
$lang['View_topic'] = 'Téma megtekintése';

$lang['Guest'] = 'Vendég';
$lang['Post_subject'] = 'Hozzászólás témája';
$lang['View_next_topic'] = 'Következõ téma megtekintése';
$lang['View_previous_topic'] = 'Elõzõ téma megtekintése';
$lang['Submit_vote'] = 'Szavazás küldése';
$lang['View_results'] = 'Eredmény megtekintése';

$lang['No_newer_topics'] = 'Nincsenek újabb témák a fórumban.';
$lang['No_older_topics'] = 'Nincsenek régbbi témák a fórumban.';
$lang['Topic_post_not_exist'] = 'A téma vagy hozzászólás nem létezik.';
$lang['No_posts_topic'] = 'Nincs hozzászólás a témában.';

$lang['Display_posts'] = 'Hozzászólások megtekintése';
$lang['All_Posts'] = 'Összes';
$lang['Newest_First'] = 'Újak elõre';
$lang['Oldest_First'] = 'Régebbiek elõre';

$lang['Back_to_top'] = 'Vissza az elejére';

$lang['Read_profile'] = 'Felhasználó profiljának megtekintése';
$lang['Visit_website'] = 'Felhasználó weblapjának megtekintése';
$lang['ICQ_status'] = 'ICQ státusz';
$lang['Edit_delete_post'] = 'Hozzászólás szerkesztése/törlése';
$lang['View_IP'] = 'Felhasználó IP-címe';
$lang['Delete_post'] = 'Hozzászólás törlése';

$lang['wrote'] = 'írta'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Idézet'; // comes before bbcode quote output.
$lang['Code'] = 'Kód'; // comes before bbcode code output.

$lang['Edited_time_total'] = 'A hozzászólást %1$s összesen %3$d alkalommal szerkesztette, legutóbb %2$s-kor.';
$lang['Edited_times_total'] = 'A hozzászólást %1$s összesen %3$d alkalommal szerkesztette, legutóbb %2$s-kor.';

$lang['Lock_topic'] = 'Téma lezárása';
$lang['Unlock_topic'] = 'Téma megnyitása';
$lang['Move_topic'] = 'Téma áthelyezése';
$lang['Delete_topic'] = 'Téma törlése';
$lang['Split_topic'] = 'Téma szétválasztása';

$lang['Stop_watching_topic'] = 'Leiratkozás a témáról';
$lang['Start_watching_topic'] = 'Feliratkozás a témára';
$lang['No_longer_watching'] = 'Téma figyelése megszüntetve!';
$lang['You_are_watching'] = 'Feliratkozott a témára.';

$lang['Total_votes'] = 'Összes szavazat';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Üzenet tartalma';
$lang['Topic_review'] = 'Téma elõnézet';

$lang['No_post_mode'] = 'Nincs hozzászólás-típus kiválasztva.'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = 'Új téma küldése';
$lang['Post_a_reply'] = 'Új válasz küldése';
$lang['Post_topic_as'] = 'Téma küldése, mint';
$lang['Edit_Post'] = 'Hozzászólás szerkesztése';
$lang['Options'] = 'Beállítások';

$lang['Post_Announcement'] = 'Közlemény';
$lang['Post_Sticky'] = 'Kiemelt';
$lang['Post_Normal'] = 'Sima';

$lang['Confirm_delete'] = 'Biztosan törölni akarja a hozzászólást?';
$lang['Confirm_delete_poll'] = 'Biztosan törölni akarja a szavazást?';

$lang['Flood_Error'] = 'Nem küldhet rövid idõn belül több hozzászólást, várjon egy kicsit.';
$lang['Empty_subject'] = 'Új téma indításakor adja meg a címét.';
$lang['Empty_message'] = 'Nem küldhet üres hozzászólást.';
$lang['Forum_locked'] = 'Lezárt fórum: ide nem küldhet témát, választ, nem szerkesztheti a hozzászólásait.';
$lang['Topic_locked'] = 'Lezárt téma: ide nem írhat választ, és nem szerkesztheti a hozzászólásait.';
$lang['No_post_id'] = 'A szerkesztéshez válasszon ki egy hozzászólást.';
$lang['No_topic_id'] = 'Válaszüzenet küldéséhez válasszon ki egy témát.';
$lang['No_valid_mode'] = 'Csak küldhet, szerkeszthet, vagy idézhet hozzászólást. Lépjen vissza, és próbálja újra.';
$lang['No_such_post'] = 'Nincsen ilyen hozzászólás. Lépjen vissza, és próbálja újra.';
$lang['Edit_own_posts'] = 'Csak szerkesztheti a hozzászólásait.';
$lang['Delete_own_posts'] = 'Csak törölheti a hozzászólásait.';
$lang['Cannot_delete_replied'] = 'Nem törölheti a hozzászólást, melyre már érkezett válasz.';
$lang['Cannot_delete_poll'] = 'Nem törölhet aktív szavazást.';
$lang['Empty_poll_title'] = 'Adjon meg egy címet a szavazásnak.';
$lang['To_few_poll_options'] = 'Legalább két választási lehetõséget adjon meg.';
$lang['To_many_poll_options'] = 'Túl sok választási lehetõséget adott meg.';
$lang['Post_has_no_poll'] = 'A hozzászóláshoz nem tartozik szavazás.';
$lang['Already_voted'] = 'Egyszer már szavazott.';
$lang['No_vote_option'] = 'Válasszon egy lehetõséget a szavazásnál.';

$lang['Add_poll'] = 'Szavazás hozzáadása';
$lang['Add_poll_explain'] = 'Ha nem akar szavazást adni a témához, hagyja üresen a mezõket.';
$lang['Poll_question'] = 'A szavazás kérdése';
$lang['Poll_option'] = 'Választási lehetõség';
$lang['Add_option'] = 'Hozzáadás';
$lang['Update'] = 'Frissítés';
$lang['Delete'] = 'Törlés';
$lang['Poll_for'] = 'A szavazás érvényes';
$lang['Days'] = 'nap'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Hagyja üresen, ha soha sem jár le a szavazás. ]';
$lang['Delete_poll'] = 'Szavazás törlése';

$lang['Disable_HTML_post'] = 'HTML kikapcsolása a hozzászólásban';
$lang['Disable_BBCode_post'] = 'BBCode kikapcsolása a hozzászólásban';
$lang['Disable_Smilies_post'] = 'Emotikonok kikapcsolása a hozzászólásban';

$lang['HTML_is_ON'] = 'HTML <u>bekapcsolva</u>';
$lang['HTML_is_OFF'] = 'HTML <u>kikapcsolva</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s <u>bekapcsolva</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s <u>kikapcsolva</u>';
$lang['Smilies_are_ON'] = 'Emotikonok <u>bekapcsolva</u>';
$lang['Smilies_are_OFF'] = 'Emotikonok <u>kikapcsolva</u>';

$lang['Attach_signature'] = 'Aláírás hozzáadása (az aláírás megváltoztatható a profilban)';
$lang['Notify'] = 'Értesítés, ha válasz érkezik';

$lang['Stored'] = 'A hozzászólás sikeresen bekerült a fórumba!';
$lang['Deleted'] = 'A hozzászólás törlése sikerült.';
$lang['Poll_delete'] = 'A szavazás törlése sikerült.';
$lang['Vote_cast'] = 'Szavazás elfogadva.';

$lang['Topic_reply_notification'] = 'Téma emlékeztetõ';

$lang['bbcode_b_help'] = 'Félkövér: [b]szöveg[/b]  (alt+b)';
$lang['bbcode_i_help'] = 'Dõlt: [i]szöveg[/i]  (alt+i)';
$lang['bbcode_u_help'] = 'Aláhúzás: [u]szöveg[/u]  (alt+u)';
$lang['bbcode_q_help'] = 'Idézet: [quote]szöveg[/quote]  (alt+q)';
$lang['bbcode_c_help'] = 'Kód: [code]kód[/code]  (alt+c)';
$lang['bbcode_l_help'] = 'Lista: [list]szöveg[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Rendezett lista: [list=]szöveg[/list]  (alt+o)';
$lang['bbcode_p_help'] = 'Kép beillesztése: [img]http://kép_url[/img]  (alt+p)';
$lang['bbcode_w_help'] = 'Link beillesztése: [url]http://link[/url]vagy[url=http://url]link szöveg[/url]  (alt+w)';
$lang['bbcode_a_help'] = 'Nyitott BBCode tag-ek lezárása';
$lang['bbcode_s_help'] = 'Betûszín: [color=red]szöveg[/color] \(a \"color=#FF0000 is használható\)';
$lang['bbcode_f_help'] = 'Betûméret: [size=x-small]kis szöveg[/size]';

$lang['Emoticons'] = 'Emotikonok';
$lang['More_emoticons'] = 'A többi emotikon megtekintése';

$lang['Font_color'] = 'Betûszín';
$lang['color_default'] = 'Alap';
$lang['color_dark_red'] = 'Sötétpiros';
$lang['color_red'] = 'Piros';
$lang['color_orange'] = 'Narancs';
$lang['color_brown'] = 'Barna';
$lang['color_yellow'] = 'Sárga';
$lang['color_green'] = 'Zöld';
$lang['color_olive'] = 'Olíva';
$lang['color_cyan'] = 'Cián';
$lang['color_blue'] = 'Kék';
$lang['color_dark_blue'] = 'Sötétkék';
$lang['color_indigo'] = 'Indigó';
$lang['color_violet'] = 'Ibolya';
$lang['color_white'] = 'Fehér';
$lang['color_black'] = 'Fekete';

$lang['Font_size'] = 'Betûméret';
$lang['font_tiny'] = 'Apró';
$lang['font_small'] = 'Kicsi';
$lang['font_normal'] = 'Normál';
$lang['font_large'] = 'Nagy';
$lang['font_huge'] = 'Óriási';

$lang['Close_Tags'] = 'Tag-ek lezárása';
$lang['Styles_tip'] = 'Tipp: stílusok gyors alkalmazása az adott szövegen.';


//
// Private Messaging
//
$lang['Private_Messaging'] = 'Privát üzenetek';

$lang['Login_check_pm'] = 'Privát üzenetei olvasásához be kell jelentkeznie';
$lang['New_pms'] = '%d új privát üzenete van'; // You have 2 new messages
$lang['New_pm'] = '%d új privát üzenete van'; // You have 1 new message
$lang['No_new_pm'] = 'Nincsen új privát üzenete';
$lang['Unread_pms'] = '%d olvasatlan privát üzenete van.';
$lang['Unread_pm'] = '%d olvasatlan privát üzenete van.';
$lang['No_unread_pm'] = 'Nincsen olvasatlan privát üzenete.';
$lang['You_new_pm'] = 'Új privát üzenet érkezett!';
$lang['You_new_pms'] = 'Új privát üzenetek érkeztek!';
$lang['You_no_new_pm'] = 'Nincs új privát üzenet.';

$lang['Unread_message'] = 'Olvasatlan üzenetek';
$lang['Read_message'] = 'Olvasott üzenetek';

$lang['Read_pm'] = 'Üzenet olvasása';
$lang['Post_new_pm'] = 'Üzenet küldése';
$lang['Post_reply_pm'] = 'Válasz az üzenetre';
$lang['Post_quote_pm'] = 'Üzenet idézése';
$lang['Edit_pm'] = 'Üzenet szerkesztése';

$lang['Inbox'] = 'Érkezett fiók';
$lang['Outbox'] = 'Kimenõ fiók';
$lang['Savebox'] = 'Mentés fiók';
$lang['Sentbox'] = 'Elküldött fiók';
$lang['Flag'] = 'Jelölés';
$lang['Subject'] = 'Téma';
$lang['From'] = 'Feladó';
$lang['To'] = 'Címzett';
$lang['Date'] = 'Dátum';
$lang['Mark'] = 'Kijelölés';
$lang['Sent'] = 'Elküldött';
$lang['Saved'] = 'Elmentett';
$lang['Delete_marked'] = 'Kijelöltek törlése';
$lang['Delete_all'] = 'Összes törlése';
$lang['Save_marked'] = 'Kijelöltek mentése';
$lang['Save_message'] = 'Üzenet mentése';
$lang['Delete_message'] = 'Üzenet törlése';

$lang['Display_messages'] = 'Üzenetek megjelenítése'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Összes üzenet';

$lang['No_messages_folder'] = 'Nincs üzenete ebben a fiókban.';

$lang['PM_disabled'] = 'Nincs lehetõség privát üzenet küldésére.';
$lang['Cannot_send_privmsg'] = 'Sajnos nem küldhet privát üzeneteket. Lépjen kapcsolatba az Adminisztrátorral.';
$lang['No_to_user'] = 'Az üzenet küldéséhez meg kell adnia a címzettet.';
$lang['No_such_user'] = 'Ilyen nevû felhasználó nem létezik.';

$lang['Disable_HTML_pm'] = 'HTML kikapcsolása az üzenetben';
$lang['Disable_BBCode_pm'] = 'BBCode kikapcsolása az üzenetben';
$lang['Disable_Smilies_pm'] = 'Emotikonok kikapcsolása az üzenetben';

$lang['Message_sent'] = 'Üzenet elküldve.';

$lang['Click_return_inbox'] = 'Kattintson %side%s, hogy visszatérjen az Érkezett üzenetekhez.';
$lang['Click_return_index'] = 'Kattintson %side%s, hogy visszatérjen a Tartalomjegyzékhez.';

$lang['Send_a_new_message'] = 'Új privát üzenet küldése';
$lang['Send_a_reply'] = 'Válasz a privát üzenetre';
$lang['Edit_message'] = 'Privát üzenet szerkesztése';

$lang['Notification_subject'] = 'Új privát üzenet érkezett!';

$lang['Find_username'] = 'Felhasználónév keresése';
$lang['Find'] = 'Találat';
$lang['No_match'] = 'Nincs találat.';

$lang['No_post_id'] = 'Nincs hozzászólás azonosító meghatározva.';
$lang['No_such_folder'] = 'Nem létezik ilyen fiók.';
$lang['No_folder'] = 'Nincs fiók meghatározva.';

$lang['Mark_all'] = 'Összes kijelölése';
$lang['Unmark_all'] = 'Összes kijelölésének megszüntetése';

$lang['Confirm_delete_pm'] = 'Biztosan törölni akarja az üzenetet?';
$lang['Confirm_delete_pms'] = 'Biztosan törölni akarja az üzeneteket?';

$lang['Inbox_size'] = 'Az Érkezett fiók %d%%-a telt meg.'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Az Elküldött fiók %d%%-a telt meg.';
$lang['Savebox_size'] = 'A Mentés fiók %d%%-a telt meg.';

$lang['Click_view_privmsg'] = 'Kattintson %side%s az Érkezett fiókja megtekintéséhez.';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Profil megtekintése :: %s'; // %s is username
$lang['About_user'] = '%s adatlapja'; // %s is username

$lang['Preferences'] = 'Beállítások';
$lang['Items_required'] = 'A csillaggal megjelölt mezõk kitöltése kötelezõ.';
$lang['Registration_info'] = 'Regisztráció információ';
$lang['Profile_info'] = 'Profil információ';
$lang['Profile_info_warn'] = 'Ezek az információk mindenki számára láthatóak lesznek.';
$lang['Avatar_panel'] = 'Avatar beállítás';
$lang['Avatar_gallery'] = 'Avatar galéria';

$lang['Website'] = 'Honlap';
$lang['Location'] = 'Tartózkodási hely';
$lang['Contact'] = 'Kapcsolat: ';
$lang['Email_address'] = 'Email cím';
$lang['Send_private_message'] = 'Privát üzenet küldése';
$lang['Hidden_email'] = '[ Rejtett ]';
$lang['Interests'] = 'Érdeklõdési kör';
$lang['Occupation'] = 'Foglalkozás';
$lang['Poster_rank'] = 'Rang';

$lang['Total_posts'] = 'Összes hozzászólása';
$lang['User_post_pct_stats'] = 'Az összes %.2f%%-ka'; // 1.25% of total
$lang['User_post_day_stats'] = 'Naponta %.2f hozzászólás'; // 1.5 posts per day
$lang['Search_user_posts'] = '%s hozzászólásainak keresése'; // Find all posts by username

$lang['No_user_id_specified'] = 'A felhasználó nem létezik.';
$lang['Wrong_Profile'] = 'Nem módosíthatja más profilját.';

$lang['Only_one_avatar'] = 'Csak egy avatart válasszon ki.';
$lang['File_no_data'] = 'A megadott webcím nem tartalmaz adatot!';
$lang['No_connection_URL'] = 'A megadott webcímhez nem lehet csatlakozni!';
$lang['Incomplete_URL'] = 'A megadott webcím hiányos.';
$lang['Wrong_remote_avatar_format'] = 'A távoli avatar webcíme nem érvényes.';
$lang['No_send_account_inactive'] = 'A jelszó sajnos nem kérhetõ le, mivel a felhasználónév jelenleg inaktív. Lépjen kapcsolatba az Adminisztrátorral.';

$lang['Always_smile'] = 'Mindig engedélyezze a emotikonokat';
$lang['Always_html'] = 'Mindig engedélyezze a HTML-t';
$lang['Always_bbcode'] = 'Mindig engedélyezze a BBCode-ot';
$lang['Always_add_sig'] = 'Mindig csatolja az aláírásomat';
$lang['Always_notify'] = 'Mindig értesítsen, ha válasz érkezik';
$lang['Always_notify_explain'] = 'Küld egy emailt, ha hozzászólás érkezik az adott témában. Ez bármikor megváltoztatható, ha egy újabb hozzászólást küld.';

$lang['Board_style'] = 'Sablon';
$lang['Board_lang'] = 'Nyelv';
$lang['No_themes'] = 'Nincsenek sablonok az adatbázisban.';
$lang['Timezone'] = 'Idõzóna';
$lang['Date_format'] = 'Dátum formátum';
$lang['Date_format_explain'] = 'A PHP <a href=\'http://hu.php.net/manual/hu/function.date.php#AEN22851\' target=\'_blank\'>date()</a> függvénye szerint használandó.';
$lang['Signature'] = 'Aláírás';
$lang['Signature_explain'] = 'A hozzászólások végére kerülõ szöveg. Legfeljebb %d karakter lehet.';
$lang['Public_view_email'] = 'Email-cím megjelenítése';

$lang['Current_password'] = 'Jelenlegi jelszó';
$lang['New_password'] = 'Új jelszó';
$lang['Confirm_password'] = 'Jelszó megismétlése';
$lang['Confirm_password_explain'] = 'Ha meg szeretné változtatni a jelszavát, vagy az email címét, meg kell adnia a jelenlegi jelszavát.';
$lang['password_if_changed'] = 'Csak akkor kell megadnia a jelszót, ha meg akarja változtatni.';
$lang['password_confirm_if_changed'] = 'A fenti jelszó érvényesítéséhez szükséges.';

$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Egy kép, mely a hozzászólásokban a nevedénél lesz látható.<br />Az avatar nem lehet szélesebb, mint %d pixel, és nem lehet magasabb, mint %d pixel. A mérete nem lehet nagyobb, mint %d KByte.';
$lang['Upload_Avatar_file'] = 'Avatar feltöltése a számítógéprõl';
$lang['Upload_Avatar_URL'] = 'Avatar feltöltése webcímrõl';
$lang['Upload_Avatar_URL_explain'] = 'Írja be az avatar képének webcímét (a kép át lesz másolva erre az oldalra).';
$lang['Pick_local_Avatar'] = 'Avatar kiválasztása a galériából';
$lang['Link_remote_Avatar'] = 'Avatar kép belinkelése';
$lang['Link_remote_Avatar_explain'] = 'Írja be az Avatar képének webcímét, amelyet be szeretne linkelni (a kép nem lesz átmásolva erre az oldalra).';
$lang['Avatar_URL'] = 'Avatar képének webcíme';
$lang['Select_from_gallery'] = 'Avatar kiválasztása a galériából';
$lang['View_avatar_gallery'] = 'Galéria megtekintése';

$lang['Select_avatar'] = 'Avatar kiválasztása';
$lang['Return_profile'] = 'Mégsem';
$lang['Select_category'] = 'Kategória kiválasztása';

$lang['Delete_Image'] = 'Kép törlése';
$lang['Current_Image'] = 'Jelenlegi kép';

$lang['Notify_on_privmsg'] = 'Értesítés új privát üzenet érkezésekor';
$lang['Popup_on_privmsg'] = 'Felugró ablak új privát üzenet érkezésekor';
$lang['Popup_on_privmsg_explain'] = 'Néhány sablon új ablakot nyit, ha új üzeneted érkezik.';
$lang['Hide_user'] = 'Jelenlét elrejtése';

$lang['Profile_updated'] = 'A profil megváltozott!';
$lang['Profile_updated_inactive'] = 'A profil megváltozott, de mivel néhány alapvetõ információn változtatott, így a hozzáférése inaktívra változott. Ellenõrize az email-címét, melyben a megtalálja az újraaktiváláshoz szükséges információkat, vagy ha ehhez Adminisztrátor szükséges, várjon míg õ reaktiválja a hozzáférését.';

$lang['Password_mismatch'] = 'A beírt jelszavak nem egyeznek meg.';
$lang['Current_password_mismatch'] = 'A jelenlegi jelszó nem egyezik meg az adatbázisban találhatóval.';
$lang['Password_long'] = 'A jelszó nem lehet több mint 32 karakter.';
$lang['Username_taken'] = 'Ez a felhasználónév már foglalt.';
$lang['Username_invalid'] = 'A felhasználónév érvénytelen karaktert tartalmaz.';
$lang['Username_disallowed'] = 'Ez a felhasználónév nem engedélyezett.';
$lang['Email_taken'] = 'Ezt az email-címet már regisztrálta egy másik felhasználó.';
$lang['Email_banned'] = 'Ez az email-cím le van tiltva.';
$lang['Email_invalid'] = 'Érvénytelen email-cím.';
$lang['Signature_too_long'] = 'Túl hosszú aláírás.';
$lang['Fields_empty'] = 'A csillaggal jelölt mezõk kitöltése kötelezõ.';
$lang['Avatar_filetype'] = 'Az avatar kép típusa csak JPG, GIF vagy PNG lehet.';
$lang['Avatar_filesize'] = 'Az avatar kép nem lehet nagyobb mint %d KByte.'; // The avatar image file size must be less than 6 KB
$lang['Avatar_imagesize'] = 'Az avatar nem lehet nagyobb mint %d pixel széles és %d pixel magas.';

$lang['Welcome_subject'] = 'Üdvözöljük a fórumban!'; // Welcome to dollar-s forums
$lang['New_account_subject'] = 'Új felhasználó';
$lang['Account_activated_subject'] = 'Felhasználó aktiválva.';

$lang['Account_added'] = 'Köszönjük a regisztrációját, mely sikeresen befejezõdött. Most már bejelentkezhet a nevével, és a hozzá tartozó jelszóval.';
$lang['Account_inactive'] = 'A regisztráció sikeres volt, de a belépés elõtt még aktiválnia kell az azonosítójátt.<br />Az ezzel kapcsolatos információkért nézze meg a regisztrációnál megadott email-címet.';
$lang['Account_inactive_admin'] = 'A regisztráció sikeres volt, de a fórum használatához az Adminisztrátor jóváhagyása szükséges.<br />Rövidesen értesíti az regisztrációja befejezésérõl, a felhasználóneve aktiválásáról.';
$lang['Account_active'] = 'A felhasználóneve aktiválva lett. Köszönjük a regisztrációt.';
$lang['Account_active_admin'] = 'A felhasználó aktiválva van.';
$lang['Reactivate'] = 'Felhasználónév újraaktiválása!';
$lang['Already_activated'] = 'Már aktiválta a felhasználónevét.';
$lang['COPPA'] = 'A felhasználónév elkészült, de ellenõrzés ügyében elõbb nézze meg az email-címét.';

$lang['Registration'] = 'Felhasználói szabályzat';
$lang['Reg_agreement'] = 'Noha az Adminisztrátor, és a moderátorok mindent megtesznek, hogy minél hamarabb eltávolítsák a Fórumból az általánosan kifogásolható anyagokat, lehetetlen, hogy minden egyes hozzászólást átnézzenek. Ebbõl adódóan elfogadom, hogy a Fórumon található összes hozzászólás a szerzõ nézeteit tükrözi, és nem az Adminisztrátorok, Moderátorok, vagy a Webmester álláspontját - így õk nem vállalnak felelõsséget a hozzászólások tartalmáért.<br /><br
/>Beleegyezek, hogy nem küldök sértegetõ, obszcén, vulgáris, rágalmazó, gyûlöletkeltõ, támadó,
vagy bármely más olyan tartalmat, illetve anyagot, mely törvényt sért. Mivel ez egy nyilvános fórum, ezért olyan anyagot sem küldök, mely ellentétes az általános közízléssel. A fentiek megsértése azonnali és végleges törlést von maga után.<br
/>Elfogadom, hogy a Fórum webmesterének, az Adminisztrátornak és bármely Moderátornak jogában áll
eltávolítani, szerkeszteni a hozzászólásaimat, vagy lezárni az általam nyitott témákat,
amennyiben úgy ítélik meg hogy ez szükséges. Mint felhasználó, elfogadom, hogy néhány, általam
megadott adat tárolásra kerül a Fórum adatbázisában. Ezek az információk semmilyen módon nem kerülnek ki egy
harmadik félhez, de sem az Adminisztrátor sem a Moderátorok nem tudnak felelõsséget vállalni az adatokért egy esetleges "hacker-támadás" esetén.<br /><br />A Fórum "cookie"-kat (sütiket) használ, hogy adatokat tároljon a felhasználó számítógépén, de egyik sem tartalmaz személyes adatokat, melyek a regisztrációnál kerültek megadásra: a cookie-k pusztán technikai szempontból szükségesek.<br />A megadott email-cím csak a regisztráció (és az új jelszó) érvényesítéséhez szükségeltetik, semmilyen más felhasználásra nem kerül, és a hozzátartozó személyes adatok sem.<br /><br />';

$lang['Agree_under_13'] = '<b>Elfogadom</b> a feltételeket, és 13 évesnél <i>fiatalabb</i> vagyok.';
$lang['Agree_over_13'] = '<b>Elfogadom</b> a feltételeket.';
$lang['Agree_not'] = '<b>Nem fogadom el</b> a feltételeket.';

$lang['Wrong_activation'] = 'Az aktivációs kulcs nem egyezik meg az adatbázisban lévõvel.';
$lang['Send_password'] = 'Új jelszó küldése';
$lang['Password_updated'] = 'Az új jelszó elkészült, ellenõrizze az email-címét a további információkért.';
$lang['No_email_match'] = 'A megadott email-cím nem egyezik meg a hozzá adott felhasználónévhez.';
$lang['New_password_activation'] = 'Új jelszó aktiváció';
$lang['Password_activated'] = 'A hozzáférését újraaktiváltuk. A bejelentkezéshez írja be az emailben megadott jelszót.';

$lang['Send_email_msg'] = 'Email üzenet küldése';
$lang['No_user_specified'] = 'Nem adott meg felhasználónevet.';
$lang['User_prevent_email'] = 'A felhasználó nem kíván emaileket fogadni. Próbáljon privát üzenetet küldeni.';
$lang['User_not_exist'] = 'Ilyen felhasználó nem létezik.';
$lang['CC_email'] = 'Másolat küldése magának';
$lang['Email_message_desc'] = 'Az üzenet sima szövegként lesz elküldve, ezért ne használjon HTML-t vagy BBCode tageket. A válaszcím az Ön email-címe lesz.';
$lang['Flood_email_limit'] = 'Most nem küldhet több emailt, próbálkozzon késõbb.';
$lang['Recipient'] = 'Címzett';
$lang['Email_sent'] = 'Email elküldve.';
$lang['Send_email'] = 'Email küldése';
$lang['Empty_subject_email'] = 'Kötelezõ a téma megadása.';
$lang['Empty_message_email'] = 'Az üzenet üres.';


//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'Az érvényesítõ kód hibás.';
$lang['Too_many_registers'] = 'Egyszerre túl sok regisztrációval próbálkoztott. Próbálkozzon késõbb.';
$lang['Confirm_code_impaired'] = 'Ha látási (vagy egyéb) problémák folytán nem tudná elolvasni a kódot, vegye fel a kapcsolatot az %sAdminisztrátorral%s.';
$lang['Confirm_code'] = 'Érvényesítõ kód';
$lang['Confirm_code_explain'] = 'A kódot úgy kell begépelni, ahogy itt látja. Ügyeljen a kis- és nagybetûkre, a 0 egy átlós vonallal van áthúzva.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'Rendezési mód kiválasztása';
$lang['Sort'] = 'Rendezés';
$lang['Sort_Top_Ten'] = 'A legtöbb hozzászólást küldõ 10 felhasználó';
$lang['Sort_Joined'] = 'Regisztráció dátuma';
$lang['Sort_Username'] = 'Felhasználónév';
$lang['Sort_Location'] = 'Tartózkodási hely';
$lang['Sort_Posts'] = 'Összes hozzászólás';
$lang['Sort_Email'] = 'Email';
$lang['Sort_Website'] = 'Honlap';
$lang['Sort_Ascending'] = 'Növekvõ';
$lang['Sort_Descending'] = 'Csökkenõ';
$lang['Order'] = 'Sorrend';


//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Csoport vezérlõpult';
$lang['Group_member_details'] = 'Csoporttagság részletek';
$lang['Group_member_join'] = 'Csatlakozás egy csoporthoz';

$lang['Group_Information'] = 'Csoport információ';
$lang['Group_name'] = 'A csoport neve';
$lang['Group_description'] = 'A csoport leírása';
$lang['Group_membership'] = 'Csoporttagság';
$lang['Group_Members'] = 'Csoporttagok';
$lang['Group_Moderator'] = 'Csoport moderátor';
$lang['Pending_members'] = 'Kérelmezett tagságok';

$lang['Group_type'] = 'A csoport típusa';
$lang['Group_open'] = 'Nyílt csoport';
$lang['Group_closed'] = 'Zárt csoport';
$lang['Group_hidden'] = 'Rejtett csoport';

$lang['Current_memberships'] = 'Aktuális tagságok';
$lang['Non_member_groups'] = 'Csoportok';
$lang['Memberships_pending'] = 'Tagsági kérelmek';

$lang['No_groups_exist'] = 'Jelenleg még nincsen csoport a Fórumon.';
$lang['Group_not_exist'] = 'A megadott csoport nem létezik.';

$lang['Join_group'] = 'Csatlakozás a csoporthoz';
$lang['No_group_members'] = 'A csoportnak nincsenek tagjai.';
$lang['Group_hidden_members'] = 'A csoport rejtett, nem tudja megnézni a tagjait.';
$lang['No_pending_group_members'] = 'A csoportnak nincsenek függõ kérelmezésben lévõ tagjai.';
$lang['Group_joined'] = 'A jelentkezés sikeresen megtörtént!<br />A Csoport moderátora értesíteni fogja, ha elfogadta a kérelmét.';
$lang['Group_request'] = 'A csatlakozási kérelme elkészült.';
$lang['Group_approved'] = 'Csatlakozási kérelme elfogadva.';
$lang['Group_added'] = 'Csatlakozott a csoporthoz.';
$lang['Already_member_group'] = 'Már tagja ennek a csoportnak.';
$lang['User_is_member_group'] = 'A felhasználó már most is tagja ennek a csoportnak.';
$lang['Group_type_updated'] = 'Sikeresen megváltozott a csoport típusa.';

$lang['Could_not_add_user'] = 'A kiválasztott felhasználó nem létezik.';
$lang['Could_not_anon_user'] = 'Nem készíthet névtelen csoporttagot.';

$lang['Confirm_unsub'] = 'Biztosan le akarja mondani ezt a csoporttagságot?';
$lang['Confirm_unsub_pending'] = 'A jelentkezése még nincs jóváhagyva ehhez a csoporthoz, biztosan le akarja mondani?';

$lang['Unsub_success'] = 'Sikeresen lemondta a csoporttagságot.';

$lang['Approve_selected'] = 'Kiválasztottak elfogadása';
$lang['Deny_selected'] = 'Kiválaszottak elutasítása';
$lang['Not_logged_in'] = 'Be kell jelentkeznie, hogy csatlakozhasson egy csoporthoz.';
$lang['Remove_selected'] = 'Kijelölt tagok törlése';
$lang['Add_member'] = 'Tag hozzáadása';
$lang['Not_group_moderator'] = 'Ön nem a csoport moderátora, így nem végezheti el ezeket a módosításokat.';

$lang['Login_to_join'] = 'A csatlakozáshoz, vagy a csoporttagságok irányításához elõször be kell jelentkeznie.';
$lang['This_open_group'] = 'Nyitott csoport, kattints a tagság kérelmezéséshez.';
$lang['This_closed_group'] = 'Zárt csoport, több felhasználó nem engedélyezett.';
$lang['This_hidden_group'] = 'Ehhez a rejtett csoporthoz nem lehet automatikusan új felhasználókat adni!';
$lang['Member_this_group'] = 'Ön a csoport tajga.';
$lang['Pending_this_group'] = 'A csoport moderátora még nem döntött a felvételérõl.';
$lang['Are_group_moderator'] = 'Ön a csoport moderátora.';
$lang['None'] = 'nincsen';

$lang['Subscribe'] = 'Jelentkezés';
$lang['Unsubscribe'] = 'Lemondás';
$lang['View_Information'] = 'Információk a csoportról';


//
// Search
//
$lang['Search_query'] = 'Keresési feltételek';
$lang['Search_options'] = 'Keresési beállítások';

$lang['Search_keywords'] = 'Keresés kulcsszóra';
$lang['Search_keywords_explain'] = 'Használhatja az <u>AND</u> (és) szót, hogy a keresésben megadott összes szó benne legyen a találatban, az <u>OR</u> (vagy) szót mellyel a "benne lehet" szavakat választhatja el, és a <u>NO</u> (nem) szót, mellyel kizárhat szavakat.<br />Használjon *-ot a részleges szavakhoz.';
$lang['Search_author'] = 'Szerzõ keresése';
$lang['Search_author_explain'] = 'Használjon *-ot a részleges szavakhoz.';

$lang['Search_for_any'] = 'Keresés bármely kifejezésre';
$lang['Search_for_all'] = 'Keresés az összes kifejezésre';
$lang['Search_title_msg'] = 'Keresés téma címre, és szövegre';
$lang['Search_msg_only'] = 'Csak szövegben keresse';

$lang['Return_first'] = 'A talált témák elsõ'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'karakterének megjelenítése.';

$lang['Search_previous'] = 'Keresés az elõzõ x idõtartamban'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Rendezési feltétel';
$lang['Sort_Time'] = 'Beküldés ideje';
$lang['Sort_Post_Subject'] = 'Téma';
$lang['Sort_Topic_Title'] = 'Téma címe';
$lang['Sort_Author'] = 'Szerzõ';
$lang['Sort_Forum'] = 'Fórum';

$lang['Display_results'] = 'Találatok megjelenítése';
$lang['All_available'] = 'Összes találat';
$lang['No_searchable_forums'] = 'Nincs joga keresni a fórumban.';

$lang['No_search_match'] = 'A keresési feltételeknek egy fórum, és egy téma sem felelt meg.';
$lang['Found_search_match'] = '%d találat'; // eg. Search found 1 match
$lang['Found_search_matches'] = '%d találat'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'Két keresés között el kell telnie egy meghatározott idõtartamnak, várjon egy kicsit és próbálkozzon újra.';

$lang['Close_window'] = 'Ablak bezárása';


//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Csak a %s küldhetnek közleményt ebbe a fórumba.';
$lang['Sorry_auth_sticky'] = 'Csak a %s küldhetnek kiemelt témát ebbe a fórumba.';
$lang['Sorry_auth_read'] = 'Csak a %s olvashatják a fórum témáit.';
$lang['Sorry_auth_post'] = 'Csak a %s nyithatnak új témát ebben a fórumban.';
$lang['Sorry_auth_reply'] = 'Csak a %s válaszolhatnak egy hozzászólásra ebben a fórumban.';
$lang['Sorry_auth_edit'] = 'Csak a %s szerkeszthetnek hozzászólásokat ebben a fórumban.';
$lang['Sorry_auth_delete'] = 'Csak a %s törölhetnek hozzászólásokat ebben a fórumban.';
$lang['Sorry_auth_vote'] = 'Csak a %s szavazhatnak ebben a fórumban.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>vendégek</b>';
$lang['Auth_Registered_Users'] = '<b>regisztrált felhasználók</b>';
$lang['Auth_Users_granted_access'] = '<b>privát engedéllyel rendelkezõ felhasználók</b>';
$lang['Auth_Moderators'] = '<b>moderátorok</b>';
$lang['Auth_Administrators'] = '<b>adminisztrátorok</b>';

$lang['Not_Moderator'] = 'Ön nem a fórum moderátora!';
$lang['Not_Authorised'] = 'Ön nem jogosult erre a mûveletre!';

$lang['You_been_banned'] = 'Ki lett tiltva a Fórumról!<br />A további tudnivalókért vegye fel a kapcsolatot a Webmesterrel, vagy az Adminisztrátorral.';


//
// Viewonline
//
$lang['Reg_users_zero_online'] = '0 regisztrált felhasználó és  '; // There are 5 Registered and
$lang['Reg_users_online'] = '%d regisztrált felhasználó és '; // There are 5 Registered and
$lang['Reg_user_online'] = '%d regisztrált felhasználó és '; // There is 1 Registered and
$lang['Hidden_users_zero_online'] = '0 rejtett felhasználó van jelen'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d rejtett felhasználó van jelen.'; // 6 Hidden users online
$lang['Hidden_user_online'] = '%d rejtett felhasználó van jelen'; // 6 Hidden users online
$lang['Guest_users_online'] = '%d vendég van jelen'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = '0 vendég van jelen'; // There are 10 Guest users online
$lang['Guest_user_online'] = '%d vendég van jelen'; // There is 1 Guest user online
$lang['No_users_browsing'] = 'Jelenleg egy felhasználó sem böngészi a fórum oldalait';

$lang['Online_explain'] = 'A fenti adat az elmúlt 5 perc alapján készült.';

$lang['Forum_Location'] = 'Fórum helye';
$lang['Last_updated'] = 'Legutóbb frissített';

$lang['Forum_index'] = 'Fórum index';
$lang['Logging_on'] = 'Bejelentkezés';
$lang['Posting_message'] = 'Üzenet küldése';
$lang['Searching_forums'] = 'Fórumok keresése';
$lang['Viewing_profile'] = 'Profil megtekintése';
$lang['Viewing_online'] = 'Jelenlévõ felhasználók megtekintése';
$lang['Viewing_member_list'] = 'Taglista megtekintése';
$lang['Viewing_priv_msgs'] = 'Privát üzenetek megtekintése';
$lang['Viewing_FAQ'] = 'Gy.I.K. megtekintése';


//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Moderátor vezérlõpult';
$lang['Mod_CP_explain'] = 'Az alábbi ûrlap segítségével kezelheti a fórumot, pld. lezárás, megnyitás, áthelyezés, törlés.';

$lang['Select'] = 'Kiválaszt';
$lang['Delete'] = 'Töröl';
$lang['Move'] = 'Áthelyez';
$lang['Lock'] = 'Lezár';
$lang['Unlock'] = 'Megnyit';

$lang['Topics_Removed'] = 'A kiválaszott témák sikeresen törölve lettek az adatbázisból!';
$lang['Topics_Locked'] = 'A kiválaszott témák le lettek zárva!';
$lang['Topics_Moved'] = 'A kiválaszott témák sikeresen átkerültek az új helyre!';
$lang['Topics_Unlocked'] = 'A kiválaszott témák sikeresen meg lettek nyitva!';
$lang['No_Topics_Moved'] = 'Nem lett áthelyezve téma!';

$lang['Confirm_delete_topic'] = 'Biztosan el akarja távolítani a kiválaszott témá(ka)t?';
$lang['Confirm_lock_topic'] = 'Biztosan le akarja zárni a kiválasztott témá(ka)t?';
$lang['Confirm_unlock_topic'] = 'Biztosan meg akarja nyitni a kiválasztott témá(ka)t?';
$lang['Confirm_move_topic'] = 'Biztosan át akarja helyezni a kiválasztott témá(ka)t?';

$lang['Move_to_forum'] = 'Áthelyezés a következõ fórumba:';
$lang['Leave_shadow_topic'] = 'Árnyék-téma hagyása a régi fórumban.';

$lang['Split_Topic'] = 'Téma-szétválasztó';
$lang['Split_Topic_explain'] = 'Az alábbi mezõk használatával egy témát kétféleképpen választhat szét: vagy az adott hozzászólások kiemelésével, vagy egy adott hozzászólástól számítva';
$lang['Split_title'] = 'A téma új címe';
$lang['Split_forum'] = 'A téma új fóruma';
$lang['Split_posts'] = 'Megjelölt hozzászólások szétválasztása';
$lang['Split_after'] = 'Szétválasztás a bejelölt hozzászólástól';
$lang['Topic_split'] = 'A téma szétválasztása sikerült!';

$lang['Too_many_error'] = 'Túl sok hozzászólást választott ki. Csak egy hozzászólást válasszon ki, az utána következõk is kiemelõdnek!';

$lang['None_selected'] = 'A mûvelet végrahajtásához témát is ki kell választani. Lépjen vissza, és válasszon ki legalább egyet.';
$lang['New_forum'] = 'Új fórum';

$lang['This_posts_IP'] = 'A hozzászólás IP-je';
$lang['Other_IP_this_user'] = 'A felhasználóhoz tartozó egyéb IP-címek';
$lang['Users_this_IP'] = 'Az IP-hez tartozó felhasználók';
$lang['IP_info'] = 'IP információ';
$lang['Lookup_IP'] = 'IP keresése';


//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Idõzóna: %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = '(GMT -12 óra)';
$lang['-11'] = '(GMT -11 óra)';
$lang['-10'] = '(GMT -10 óra)';
$lang['-9'] = '(GMT -9 óra)';
$lang['-8'] = '(GMT -8 óra)';
$lang['-7'] = '(GMT -7 óra)';
$lang['-6'] = '(GMT -6 óra)';
$lang['-5'] = '(GMT -5 óra)';
$lang['-4'] = '(GMT -4 óra)';
$lang['-3.5'] = '(GMT -3.5 óra)';
$lang['-3'] = '(GMT -3 óra)';
$lang['-2'] = '(GMT -2 óra)';
$lang['-1'] = '(GMT -1 óra)';
$lang['0'] = '(GMT 0) ';
$lang['1'] = '(GMT +1 óra)';
$lang['2'] = '(GMT +2 óra)';
$lang['3'] = '(GMT +3 óra)';
$lang['3.5'] = '(GMT +3.5 óra)';
$lang['4'] = '(GMT +4 óra)';
$lang['4.5'] = '(GMT +4.5 óra)';
$lang['5'] = '(GMT +5 óra)';
$lang['5.5'] = '(GMT +5.5 óra)';
$lang['6'] = '(GMT +6 óra)';
$lang['6.5'] = '(GMT +6.5 óra)';
$lang['7'] = '(GMT +7 óra)';
$lang['8'] = '(GMT +8 óra)';
$lang['9'] = '(GMT +9 óra)';
$lang['9.5'] = '(GMT +9.5 óra)';
$lang['10'] = '(GMT +10 óra)';
$lang['11'] = '(GMT +11 óra)';
$lang['12'] = '(GMT +12 óra)';
$lang['13'] = 'GMT + 13 óra';

// These are displayed in the timezone select box
$lang['tz']['-12'] = '(GMT -12 óra) Eniwetok, Kwajalein';
$lang['tz']['-11'] = '(GMT -11 óra) Midway-sziget, Szamoa';
$lang['tz']['-10'] = '(GMT -10 óra) Hawaii';
$lang['tz']['-9'] = '(GMT -9 óra) Alaszka';
$lang['tz']['-8'] = '(GMT -8 óra) Csendes-óceáni idõ, Tijuana';
$lang['tz']['-7'] = '(GMT -7 óra) Arizona, Hegyi idõ';
$lang['tz']['-6'] = '(GMT -6 óra) Amerikai középidõ, Közép-Amerika, Mexikóváros';
$lang['tz']['-5'] = '(GMT -5 óra) Bogota, Lima, Quito, Indiana, Keleti idõ';
$lang['tz']['-4'] = '(GMT -4 óra) Atlanti-óceáni idõ, Caracas, La Paz';
$lang['tz']['-3.5'] = '(GMT -3.5 óra) Új-Fulland';
$lang['tz']['-3'] = '(GMT -3 óra) Brazília, Buenos Aires, Georgetown, Grönland';
$lang['tz']['-2'] = '(GMT -2 óra) Közép-atlanti idõzóna';
$lang['tz']['-1'] = '(GMT -1 óra) Azori-szigetek, Zöld-foki-szigetek';
$lang['tz']['0'] = '(GMT 0) Greenwich, London, Dublin, Lisszabon';
$lang['tz']['1'] = '(GMT +1 óra) Belgrád, Budapest, Ljubljana, Pozsony, Prága';
$lang['tz']['2'] = '(GMT +2 óra) Budapest nyári isz., Athén, Isztambul, Minszk, Helsinki';
$lang['tz']['3'] = '(GMT +3 óra) Bagdad, Kuvait, Rijád, Moszkva, Szentpétervár';
$lang['tz']['3.5'] = '(GMT +3.5 óra) Teherán';
$lang['tz']['4'] = '(GMT +4 óra) Baku, Tbiliszi';
$lang['tz']['4.5'] = '(GMT +4.5 óra) Kabul';
$lang['tz']['5'] = '(GMT +5 óra) Iszlámbád, Karacsi, Taskent, Jekatyerinburg';
$lang['tz']['5.5'] = '(GMT +5.5 óra) Chennai, Kalkutta, Mumbai, Új-Delhi';
$lang['tz']['6'] = '(GMT +6 óra) Almaty, Novoszibirszk, Astana, Dhaka';
$lang['tz']['6.5'] = '(GMT +6.5 óra) Rangun';
$lang['tz']['7'] = '(GMT +7 óra) Bangkok, Dzsakarta, Hanoi, Krasznojarszk';
$lang['tz']['8'] = '(GMT +8 óra) Hongkong, Peking, Irkutszk, Ulánbátor, Perth';
$lang['tz']['9'] = '(GMT +9 óra) Jakutszk, Oszkara, Szapporo, Tokió, Szöul';
$lang['tz']['9.5'] = '(GMT +9.5 óra) Adelaide, Darwin';
$lang['tz']['10'] = '(GMT +10 óra) Brisbane, Canberra, Melbourne, Sydney, Guam';
$lang['tz']['11'] = '(GMT +11 óra) Magadán, Salamon-szigetek, Új Kaledónia';
$lang['tz']['12'] = '(GMT +12 óra) Auckland, Wellington, Fidzsi-szigetek, Kamcsatka';

$lang['datetime']['Sunday'] = 'Vasárnap';
$lang['datetime']['Monday'] = 'Hétfõ';
$lang['datetime']['Tuesday'] = 'Kedd';
$lang['datetime']['Wednesday'] = 'Szerda';
$lang['datetime']['Thursday'] = 'Csütörtök';
$lang['datetime']['Friday'] = 'Péntek';
$lang['datetime']['Saturday'] = 'Szombat';
$lang['datetime']['Sun'] = 'Vas.';
$lang['datetime']['Mon'] = 'Hétf.';
$lang['datetime']['Tue'] = 'Kedd.';
$lang['datetime']['Wed'] = 'Szer.';
$lang['datetime']['Thu'] = 'Csüt.';
$lang['datetime']['Fri'] = 'Pént.';
$lang['datetime']['Sat'] = 'Szomb.';
$lang['datetime']['January'] = 'Január';
$lang['datetime']['February'] = 'Február';
$lang['datetime']['March'] = 'Március';
$lang['datetime']['April'] = 'Április';
$lang['datetime']['May'] = 'Május';
$lang['datetime']['June'] = 'Június';
$lang['datetime']['July'] = 'Július';
$lang['datetime']['August'] = 'Augusztus';
$lang['datetime']['September'] = 'Szeptember';
$lang['datetime']['October'] = 'Október';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'December';
$lang['datetime']['Jan'] = 'Jan.';
$lang['datetime']['Feb'] = 'Feb.';
$lang['datetime']['Mar'] = 'Márc.';
$lang['datetime']['Apr'] = 'Ápr.';
$lang['datetime']['May'] = 'Máj.';
$lang['datetime']['Jun'] = 'Jún.';
$lang['datetime']['Jul'] = 'Júl.';
$lang['datetime']['Aug'] = 'Aug.';
$lang['datetime']['Sep'] = 'Szept.';
$lang['datetime']['Oct'] = 'Okt.';
$lang['datetime']['Nov'] = 'Nov.';
$lang['datetime']['Dec'] = 'Dec.';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Információ';
$lang['Critical_Information'] = 'Kritikus információ';

$lang['General_Error'] = 'Általános hiba';
$lang['Critical_Error'] = 'Kritikus hiba';
$lang['An_error_occured'] = 'Hiba adódott';
$lang['A_critical_error'] = 'Kritikus hiba adódott';

$lang['Admin_reauthenticate'] = 'A fórum adminisztrációjához újra azonosítania kell magát.';
$lang['Login_attempts_exceeded'] = 'Túllépte a %s engedélyezett belépési kísérletet. A következõ %s percben nem léphet be.';
$lang['Please_remove_install_contrib'] = 'Kérjük törölje az install/ és a contrib/ könyvtárat.';
$lang['Session_invalid'] = 'Érvénytelen munkamenet. Kérjük küldje el újra az ûrlapot.';

// Profile modal pop-up about using YA to edit profile
$lang['Attention'] = 'Attention';
$lang['Continue'] = 'Continue';
$lang['Go_Your_Account'] = 'Go to Your Account';
$lang['YA_Warning'] = 'Unless you are uploading an avatar you should be using %s to edit your profile';

//
// That's all, Folks!
// -------------------------------------------------

?>