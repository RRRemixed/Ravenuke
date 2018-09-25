<?php
/***************************************************************************
 *                            lang_main_attach.php [Hungarian]
 *                              -------------------
 *     begin                : Thu Feb 07 2002
 *     copyright            : (C) 2002 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *
 *     $Id: lang_main_attach.php,v 1.27 2003/01/16 11:11:56 acydburn Exp $
 *
 *     translated	: Fodor Bertalan
 *     web			: http://fodorb.uw.hu
 *     email		: phpbb@fberci.tk
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

//
// Attachment Mod Main Language Variables
//

// Auth Related Entries
$lang['Rules_attach_can'] = '<b>Csatolhat</b> fájlokat ebben a fórumban';
$lang['Rules_attach_cannot'] = '<b>Nem</b> csatolhat fájlokat ebben a fórumban';
$lang['Rules_download_can'] = '<b>Letölthet</b> fájlokat ebbõl a fórumból';
$lang['Rules_download_cannot'] = '<b>Nem</b> tölthet le fájlokat ebbõl a fórumból';
$lang['Sorry_auth_view_attach'] = 'Sajnos az Ön számára nem engedélyezett a csatolmány megtekintése vagy letöltése.';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'Cím'; // used in Administration Panel too...
$lang['Downloaded'] = 'Letöltve';
$lang['Download'] = 'Letöltés'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'Fájl mérete';
$lang['Viewed'] = 'Megtekintve';
$lang['Download_number'] = '%d alkalommal'; // replace %d with count
$lang['Extension_disabled_after_posting'] = 'A \'%s\' kiterjesztést az Adminisztrátor nem engedélyezte, ennél fogva a csatolmány nem lesz megjelenítve.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Csatolmányok Vezérlõpult';
$lang['Attach_posting_cp_explain'] = 'Ha a Csatolmány Hozzáadására kattint, megjelenik egy rész mely segítségével csatolhat dolgokat.<br />Ha az Csatolt Állományokra kattint, a már csatolt fájlok listáját tekintheti meg és szerkesztheti.<br />Ha frissíteni akar egy csatolmányt mindkét linkre kattintson rá. Válassza ki a csatolmányt, mint egyébként, de ezután ne a Csatol gombra, hanem az Új Verzió Feltöltésére kattintson a Csatolt Állományok listájában a megfelelõ fájlnál.';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Csatol';
$lang['Add_attachment_title'] = 'Csatolmány hozzáadása';
$lang['Add_attachment_explain'] = 'Ha nem akar semmit se csatolni a hozzászólásához, hagyja üresen ezt a részt.';
$lang['File_name'] = 'Fájl neve';
$lang['File_comment'] = 'Cím';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'Csatolt állományok';
$lang['Options'] = 'Beállítások';
$lang['Update_comment'] = 'Cím frissítése';
$lang['Delete_attachments'] = 'Csatolmányok törlése';
$lang['Delete_attachment'] = 'Csatolmány törlése';
$lang['Delete_thumbnail'] = 'Kis kép törlése';
$lang['Upload_new_version'] = 'Új verzió feltöltése';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = '%s egy hibás fájlnév.'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'A csatolmány túl nagy.<br />Nem határozható meg a PHP-ben definiált maximum fájlméret.<br />A Csatolmány Modul nem tudja felülírni a php.ini-ben meghatározott maximum feltöltési méretet.';
$lang['Attachment_php_size_overrun'] = 'A csatolmány túl nagy.<br />Maximum Fájl Méret: %d MB.<br />Ez a php.ini-ben van meghatározva, ezért a Csatolmány Modul se tudja felülírni.'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = 'A %s kiterjesztés nem engedélyezett'; // replace %s with extension (e.g. .php) 
$lang['Disallowed_extension_within_forum'] = 'Az Ön számára nem engedélyezett %s kiterjesztésû fájlok csatolása ebbe a fóurmba.'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'A csatolmány túl nagy.<br />Maximum Méret: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = 'Sajnos a csatolmányoknak szánt hely betelt. Lépjen kapcsolatba az Adminisztrátorral.';
$lang['Too_many_attachments'] = 'Az állomány nem csatolható, túl sok (%d db.) csatolmány van a hozzászólásban.'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'A csatolmánynak/képnek %d pixelnél keskenyebbnek, és %d pixelnél alacsonyabbnak kell lennie.'; 
$lang['General_upload_error'] = 'Feltöltési hiba: Nem sikerült feltölteni a csatolmány a következõ helyre: %s.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = 'Nem hagyhatja üresen a Csatolmány Hozzáadása mezõt.';
$lang['Error_missing_old_entry'] = 'Nem sikerült frissíteni a csatolmányt, nem található a régi csatolmányok jegyzéke.';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = 'A privát üzenet mappájában lévõ csatolmányok mérete elérte az engedélyezettet. Kérjük töröljön néhány érkezett/elküldött csatolmányt.';
$lang['Attach_quota_receiver_pm_reached'] = '\'%s\' privát üzenet mappájában lévõ csatolmányok mérete elérte az engedélyezettet. Kérjük tudassa ezt vele, vagy várjon míg nem törli ki néhány csatolmányát.';

// Errors -> Download
$lang['No_attachment_selected'] = 'Nem választott ki csatolmányt, hogy letöltse vagy megnézze.';
$lang['Error_no_attachment'] = 'A kiválasztott csatolmány nem létezik.';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Biztos, hogy törölni akarja a kiválasztott csatolmányokat?';
$lang['Deleted_attachments'] = 'A kiválasztott csatolmányok sikeresen törölve lettek.';
$lang['Error_deleted_attachments'] = 'Nem sikerült a csatolmányok törlése.';
$lang['Confirm_delete_pm_attachments'] = 'Biztos, hogy az ebben a privát üzenetben lévõ összes csatolmányt törölni akarja?';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'A csatolási funkció ki van kapcsolva.';

$lang['Directory_does_not_exist'] = 'A \'%s\' könyvtár nem létezik, vagy nem található.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'Kérjük ellenõrizze, hogy \'%s\' egy könyvtár-e.'; // replace %s with directory
$lang['Directory_not_writeable'] = 'Meg kell határoznia a feltöltési könyvtár elérési útját és ezt 777-re chmod-ozni (vagy a http szervere tulajdonságait megváltoztatni), hogy fel tudjon tölteni fájlokat.<br />Ha ftp hozzáféréssel rendelkezik állítsa át a könyvtár jogosultságait (Change Attributes) rwxrwxrwx-re.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'Nem sikerült csatlakozni az FTP szerverhez: \'%s\'. Kérjük ellenõrizze az FTP beállításait.';
$lang['Ftp_error_login'] = 'Nem sikerült belépni az FTP szerverre. A \'%s\' felhasználónév, vagy a jelszó rossz. Kérjük ellenõrizze az FTP beállításait.';
$lang['Ftp_error_path'] = 'Nem sikerült hozzáférni az ftp könyvtárhoz: \'%s\'. Kérjük ellenõrizze az FTP beállításait.';
$lang['Ftp_error_upload'] = 'Nem sikerült feltölteni a fájlokat az ftp könyvtárba: \'%s\'. Kérjük ellenõrizze az FTP beállításait.';
$lang['Ftp_error_delete'] = 'Nem sikerült törölni a fájlokat az ftp könyvtárban: \'%s\'. Kérjük ellenõrizze az FTP beállításait.<br />A hiba másik oka a csatolmány nem létezése lehet, kérjük ezt ellenõrizze az árnyék csatolmányokban.';
$lang['Ftp_error_pasv_mode'] = 'Nem sikerült ki-/bekapcsolni az FTP passzív módot.';

// Attach Rules Window
$lang['Rules_page'] = 'Csatolmány szabályok';
$lang['Attach_rules_title'] = 'Engedélyezett kiterjesztések csoportjai és méreteik';
$lang['Group_rule_header'] = '%s -> Maximum méret: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = 'Engedélyezett kiterjesztések és méreteik';
$lang['Note_user_empty_group_permissions'] = 'Megjegyzés:<br />Normál esetben csatolhat fájlokat ebbe a fórumba, <br />de mióta egyetlen egy kiterjesztés sem engedélyezett, <br />nem tud csatolni semmit. Ha megpróbálja,  <br />egy hibaüzenetet kap.<br />';

// Quota Variables
$lang['Upload_quota'] = 'Feltöltési kvóta';
$lang['Pm_quota'] = 'PÜ kvóta';
$lang['User_upload_quota_reached'] = 'Elérte a %d %s-os feltöltési kvótát.'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'Felhasználói Csatolmányok Vezérlõpult';
$lang['UACP'] = 'Felhasználói Csatolmányok Vezérlõpult';
$lang['User_uploaded_profile'] = 'Feltöltve: %s';
$lang['User_quota_profile'] = 'Kvóta: %s';
$lang['Upload_percent_profile'] = '%d%%';

// Common Variables
$lang['Bytes'] = 'Byte';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';
$lang['Attach_search_query'] = 'Csatolmány keresése';
$lang['Test_settings'] = 'Beállítások tesztelése';
$lang['Not_assigned'] = 'Nincs kijelölve';
$lang['No_file_comment_available'] = 'A fájlnak nincs címe.';
$lang['Attachbox_limit'] = 'A csatolmányai tárhelyének %d%%-a telt be.';
$lang['No_quota_limit'] = 'Nincs kvóta limit';
$lang['Unlimited'] = 'Korlátlan';

?>