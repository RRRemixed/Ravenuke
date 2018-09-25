<?php
/***************************************************************************
 *                            lang_admin_attach.php [English]
 *                              -------------------
 *     begin                : Thu Feb 07 2002
 *     copyright            : (C) 2002 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *
 *     $Id: lang_admin_attach.php,v 1.36 2003/08/30 15:47:39 acydburn Exp $
 *
 *     translated by	: Fodor Bertalan           and László Miklós
 *     web		: http://fodorb.uw.hu
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
// Attachment Mod Admin Language Variables
//

// Modules, this replaces the keys used
$lang['Control_Panel'] = 'Vezérlõpult';
$lang['Shadow_attachments'] = 'Árnyék csatolmányok';
$lang['Forbidden_extensions'] = 'Tiltott kiterjesztések';
$lang['Extension_control'] = 'Kiterjesztések beállításai';
$lang['Extension_group_manage'] = 'Kiterjesztés csoportok beállításai';
$lang['Special_categories'] = 'Speciális kategóriák';
$lang['Sync_attachments'] = 'Csatolmányok szinkronizálása';
$lang['Quota_limits'] = 'Kvóta limit';

// Attachments -> Management
$lang['Attach_settings'] = 'Csatolmányok beállítása';
$lang['Manage_attachments_explain'] = 'Itt a Csatolmány MOD fõbb beállításait változtathatod meg. Ha a Beállítások tesztelése gombra kattintasz, lefut egy teszt, mely teszteli a MOD mûködését. Ha gondjaid lennének a fájlok feltöltésével, futtast le ezt a tesztet, hogy megtudjad a hiba okát.';
$lang['Attach_filesize_settings'] = 'Csatolmányok méreteinek beállításai';
$lang['Attach_number_settings'] = 'Csatolmányok darabszámának beállítása';
$lang['Attach_options_settings'] = 'Fõbb beállítások';

$lang['Upload_directory'] = 'Feltöltési könyvtár:';
$lang['Upload_directory_explain'] = 'A phpBB2 könyvtáradtól a relatív elérési út. Pl. ha \'files\'-t írsz be, és a phpBB2 könyvtárad a http://www.yourdomain.com/phpBB2 címen található, akkor a feltöltési könyvtár teljes címe http://www.yourdomain.com/phpBB2/files.';
$lang['Attach_img_path'] = 'Csatolmány ikonja hozzászólásoknál:';
$lang['Attach_img_path_explain'] = 'Ez a kép jelenik meg a csatolmány mellett a hozzászólásban. Hagyd üresen ezt a rubrikát, ha nem akarsz semmilyen ikont megjeleníteni. Ezt a beállítást felülírhatja a Kiterjesztés csoportok beállítása.';
$lang['Attach_topic_icon'] = 'Csatolmány ikonja témánál:';
$lang['Attach_topic_icon_explain'] = 'Ez a kép jelenik meg a csatolmánnyal rendelkezõ témák mellett. Hagyd üresen ezt a rubrikát, ha nem akarsz semmilyen ikont megjeleníteni.';
$lang['Attach_display_order'] = 'Csatolmányok rendezése:';
$lang['Attach_display_order_explain'] = 'Itt választhatod ki, hogy a hozzászólásban/privát üzenetben a fájlok csökkenõ (elõször a legújabb), vagy növekvõ (elõször a legkésõbbi csatolmány) sorrendben legyenek.';
$lang['Show_apcp'] = 'Új Csatolmány küldése felület (Csatolmányok vezérlõpult):';
$lang['Show_apcp_explain'] = 'Itt választhatod ki, hogy a Csatolmányok Vezérlõpult (igen), vagy a régi két rubrika (nem) jelenjen meg hozzászólás/PÜ írásánál/szerkesztésénél. A kinézetét nehéz leírni, legegyszerûbb ha kipróbálod.';

$lang['Max_filesize_attach'] = 'Maximum fájlméret';
$lang['Max_filesize_attach_explain'] = 'A feltölthetõ fájlok méretének felsõ határa. A 0 korlátlant jelent. Ez a beállítás a szerver konfigurációtól is függ! Ha pl. a php konfigurációd csak 2 MB-os feltöltést engedélyez, ezt nem tudja felülírni ez a MOD.';
$lang['Attach_quota'] = 'Csatolmányok tárhelye';
$lang['Attach_quota_explain'] = 'Ennyi tárhelyet foglalhatnak el ÖSSZESEN a csatolmányok a tárhelyeden. A 0 korlátlant jelent.';
$lang['Max_filesize_pm'] = 'Maximum tárhely a privát üzenet mappában';
$lang['Max_filesize_pm_explain'] = 'Ennyi tárhelyet foglalhatnak el egy felhasznál csatolmányai a privát üzenet mappájában. A 0 korlátlant jelent.';
$lang['Default_quota_limit'] = 'Alapértelmezett kvóta limit';
$lang['Default_quota_limit_explain'] = 'Itt adhatod meg az újonnan regisztrálók csatolmányainak tárhelyének alapértelmezett felsõ határát. A \'Nincs kvóta limit\' opció kikapcsolja a kvótákat, ehelyett az ezen az oldalon lévõ más beállítások lesznek használva.';

$lang['Max_attachments'] = 'Csatolmányok maximum darabszáma egy hozzászólásban:';
$lang['Max_attachments_explain'] = 'Ennyi csatolmány lehet legfeljebb egy hozzászólásban.';
$lang['Max_attachments_pm'] = 'Csatolmányok maximum darabszáma egy privát üzenetben:';
$lang['Max_attachments_pm_explain'] = 'Ennyi csatolmány lehet legfeljebb egy privát üzenetben.';

$lang['Disable_mod'] = 'A Csatolmány MOD kikapcsolása';
$lang['Disable_mod_explain'] = 'Ez fõleg új sablonok tesztelésére való. Ilyenkor a fórum -az admin panel kivételével- úgy néz ki, mintha nem is lenne ez a MOD telepítve.';
$lang['PM_Attachments'] = 'Csatolmányok engedélyezése privát üzenetben:';
$lang['PM_Attachments_explain'] = 'Engedélyezi/megtiltja csatolmányok hozzáadását a privát üzenetekhez';
$lang['Ftp_upload'] = 'FTP feltöltés bekapcsolása:';
$lang['Ftp_upload_explain'] = 'Engedélyezi/megtiltja az FTP feltöltést. Ha igenre állítod, meg kell határoznod a Csatolmányok FTP beállításait, valamint a feltöltési könyvtár nem lesz használva.';
$lang['Attachment_topic_review'] = 'Csatolmányok megjelenítése a Téma elõnézetben';
$lang['Attachment_topic_review_explain'] = 'Ha igenre állítod, minden csatolt fájlt meg fog jeleníteni a Téma elõnézetben új hozzászólás küldésekor.';

$lang['Ftp_server'] = 'FTP feltöltési szerver';
$lang['Ftp_server_explain'] = 'Itt adhatod meg az IP címét vagy FTP-hosztnevét a szerverednek, melyen a feltöltött fájljaid vannak. Ha ezt a rubrikát üresen hagyod, az a szerver lesz használva melyre a phpBB2-t installáltad. Nem megengedett a címhez ftp://, vagy bármi más hozzáadása, csak egyszerûen pl. ftp.foo.com, vagy ami ennél gyorsabb: az IP cím.';

$lang['Attach_ftp_path'] = 'FTP elérési út a feltötlési könyvtárhoz';
$lang['Attach_ftp_path_explain'] = 'Ebbe a könyvtárba kerülnek a csatolmányok. Nem kell chmodozva lennie. Ne az IP-, vagy FTP-címet írd ide.<br />Például: /home/web/uploads';
$lang['Ftp_download_path'] = 'Letöltési link az FTP-hez';
$lang['Ftp_download_path_explain'] = 'Ide azt az URL-t írd, mely az FTP elérési úthoz vonatkozik, melyen a csatolmányok vannak.<br /Ha egy külsõ FTP szervert használsz a teljes címet írd be, pl. http://www.mystorage.com/phpBB2/upload.<br />Ha a helyi szervert használod, melyen a phpBB-d is van, akkor a phpBB könyvtáradhoz viszonyított relatív elérési utat is megadhatod, pl. \'upload\'.<br />Hagyd üresen ezt a rubrikát, ha az FTP-n lévõ könyvtár nem érhetõ el az Internetrõl. Ekkor viszont nem tudod a fizikális letöltési módot használni.';
$lang['Ftp_passive_mode'] = 'FTP passzív mód bekapcsolása';
$lang['Ftp_passive_mode_explain'] = 'A PASV parancsnak szüksége van rá, hogy az FTP szerver megnyisson egy portot a kapcsolódáshoz és ennek a címét visszaküldje. A felhasználó csatlakozik ehhez a porthoz és az FTP szerver ezen várja a kéréseket.';

$lang['No_ftp_extensions_installed'] = 'Nem tudod használni az FTP feltöltési módot, mivel az FTP kibõvítés nincs benne a PHP installációdban.';

// Attachments -> Shadow Attachments
$lang['Shadow_attachments_explain'] = 'Itt tudod törölni azokat a csatolmányokat, melyek fájljai már nem léteznek, vagy azokat a fájlokat, melyek már nincsenek egy hozzászóláshoz se csatolva. Ha ráklikkelsz egy fájlra letötlheted, vagy megnézheted azt, vagy ha nincs link akkor a fájl már nem létezik.';
$lang['Shadow_attachments_file_explain'] = 'Létezõ, de hozzászóláshoz nem csatolt állományok törlése';
$lang['Shadow_attachments_row_explain'] = 'Elküldött csatolmányok törlése, melyek fájlai nem léteznek';
$lang['Empty_file_entry'] = 'Nincs adat';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'Kis kép helyrehozása a következõ csatolmányoknál: %s'; // replace %s with physical Filename
$lang['Attach_sync_finished'] = 'A csatolmányk szinkronizációja befejezõdött.';

// Extensions -> Extension Control
$lang['Manage_extensions'] = 'Kiterjesztések beállítása';
$lang['Manage_extensions_explain'] = 'Ezen az oldalon a kiterjesztéseket módosíthatod. Ha szeretnéd egy kiterjesztés feltöltését engedélyezni/letiltani, kérlek használd a Kiterjesztés csoportok beállítása oldalt.';
$lang['Explanation'] = 'Magyarázat';
$lang['Extension_group'] = 'Kiterjesztés csoport';
$lang['Invalid_extension'] = 'Hibás kiterjesztés';
$lang['Extension_exist'] = 'A %s kiterjesztés már létezik'; // replace %s with the Extension
$lang['Unable_add_forbidden_extension'] = 'A %s kiterjesztés meg van tiltva, ezért nem tudod felvenni az engedélyezett kiterjesztések közé.'; // replace %s with Extension

// Extensions -> Extension Groups Management
$lang['Manage_extension_groups'] = 'Kiterjesztés csoportok beállítása';
$lang['Manage_extension_groups_explain'] = 'Ezen az oldalon felvehetsz, törölhetsz, szerkeszthetsz kiterjesztés csoportokat, le is tilthatod õket, beállíthatsz nekik egy szpeciális kategóriát, valamint a letöltés módját is megváltoztathatod. Ezen felül megadhatsz egy ikont (kis képet) mely a kiterjesztés csoporthoz tartozó csatolmányok elõtt fog megjelenni.';
$lang['Special_category'] = 'Speciális kategória';
$lang['Category_images'] = 'Kép';
$lang['Category_stream_files'] = 'Stream';
$lang['Category_swf_files'] = 'Flash';
$lang['Allowed'] = 'Engedélyezve';
$lang['Allowed_forums'] = 'Engedélyezett fórumok';
$lang['Ext_group_permissions'] = 'Csoport engedélyei';
$lang['Download_mode'] = 'Letöltési mód';
$lang['Upload_icon'] = 'Ikon';
$lang['Max_groups_filesize'] = 'Maximum méret';
$lang['Extension_group_exist'] = 'A %s kiterjesztés csoport már létezik.'; // replace %s with the group name
$lang['Collapse'] = '+';
$lang['Decollapse'] = '-';

// Extensions -> Special Categories
$lang['Manage_categories'] = 'Speciális kategóriák beállítása';
$lang['Manage_categories_explain'] = 'Ezen az oldalon a speciális kategóriákat szerkesztheted. Speciális paramétereket adhatsz meg egy kiterjesztés csoporthoz rendelt speciális kategóriának.';
$lang['Settings_cat_images'] = 'Speciális kategóriák beállítása: Képek';
$lang['Settings_cat_streams'] = 'Speciális kategóriák beállítása: Stream fájlok';
$lang['Settings_cat_flash'] = 'Speciális kategóriák beállítása: Flash fájlok';
$lang['Display_inlined'] = 'Képek direkt megjelenítése';
$lang['Display_inlined_explain'] = 'A képek a hozzászólásban jelenjenek meg (igen), vagy csak egy link mutasson rá (nem).';
$lang['Max_image_size'] = 'Maximum kép méret';
$lang['Max_image_size_explain'] = 'Itt a csatolt képek maximum nagyságát tudod megadni pixelben (szélesség x magasság).<br />Ha 0x0-ra állítod, a funkció ki lesz kapcsolva. Néhány képnél ez a funkció nem mûködik a PHP korlátai miatt.';
$lang['Image_link_size'] = 'Linkelt kép mérete';
$lang['Image_link_size_explain'] = 'Ha a kép eléri ezt a méretet, akkor csak egy link fog megjelenni hozzá.<br />Ha 0x0-ra állítod, a funkció ki lesz kapcsolva. Néhány képnél ez a funkció nem mûködik a PHP korlátai miatt.';
$lang['Assigned_group'] = 'Kijelölt csoport';

$lang['Image_create_thumbnail'] = 'Kis kép készítése';
$lang['Image_create_thumbnail_explain'] = 'Mindig készítsen egy kis képet. Ez a funkció majdnem az összes beállítást felülírja ebben a speciális kategóriában, kivéve a maximum kép méretet. Ha bekapcsolod ezt a funkciõt, a hozzászólásban a nagy kép helyett egy kis kép fog megjelenni, de a felhasználó ezt megnézheti nagyban is a kis képre kattintva.<br />A funkciónak szüksége van egy installált Imagick programra. Ha ez nincs így, vagy a biztonságos üzemmód be van kapcsolva, a PHP GD kiterjesztése lesz használva. Ha a képtípust nem támogatja a PHP, a funkció nem lesz bekapcsolva.';
$lang['Image_min_thumb_filesize'] = 'Minimum méret kis képhez';
$lang['Image_min_thumb_filesize_explain'] = 'Ha a kép kisebb mint ez, nem készül kis kép, mivel az eredeti is elég kicsi.';
$lang['Image_imagick_path'] = 'Imagick program (teljes elérési út)';
$lang['Image_imagick_path_explain'] = 'A konvertáló program teljes elérési útja, normálisan /usr/bin/convert (windows-on: c:/imagemagick/convert.exe).';
$lang['Image_search_imagick'] = 'Imagick keresése';

$lang['Use_gd2'] = 'GD2 kiterjesztés használata';
$lang['Use_gd2_explain'] = 'A PHP képes alkalmazni a GD1 és GD2 kiterjesztéseket. Hiba nélküli kis kép készítésére Imagemagick nélkül a Csatolmány MOD két eljárást alkalmaz, az itteni választás alapján. Ha kis képeid rossz minõségûek, próbáld meg megváltoztatni ezt a beállítást.';
$lang['Attachment_version'] = 'Csatolmány Modul verzió %s<br />Modul magyar fordítása &copy; <a class="copyright" href="http://fodorb.uw.hu">Fodor Bertalan</a> és László Miklós'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'Tiltott kiterjesztések beállítása';
$lang['Manage_forbidden_extensions_explain'] = 'Ezen az oldalon bõvítheted, vagy szûkítheted a tiltott kiterjesztések listáját. A php, php3, php4 kiterjesztések alapértelmezetten tiltva vannak biztonsági okok miatt, nem is tudod törölni õket.';
$lang['Forbidden_extension_exist'] = 'A %s kiterjesztés már meg van tiltva.'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = 'A %s kiterjesztés definiálva van az engedélyezett kiterjesztések között, kérlek elõször töröld onnan.';  // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'Kiterjesztés csoport engedélyei -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'Ezen az oldalon korlátozni tudod az egyes kiterjesztés csoportokat fórumokhoz dötésed szerint (Engedélyezett fórumok). Az alapértelmezett beállításban az összes kiterjesztés csoport engedélyezve van összes fórumban. Ha egy kiterjesztés csoportot korlátozni szeretnél egy bizonyos fórumra, akkor válaszd ki a megfelõ engedélyezett kiterjesztés csoportot (alul), majd válaszd ki melyik fórumra vonatkoznak a beállítások és kattints a Kijelölt(ek) hozzáadására. Minden egyes alkalommal ki tudod terjeszteni a beállításokat az összes fórumra. Ha egy beállítás csak bizonyos fórumokra vonatkozik, akkor ha új fórumot hozol létre újra el kell látogatnod ide.';
$lang['Note_admin_empty_group_permissions'] = 'Megjegyzés:<br />Az a alább felsorolt fórumokban normálisan a felhasználók csatolhatnak fájlokat, de mióta egyetlen egy kiterjesztés sem engedélyezett, a felhasználók nem tudnak csatolni semmit. Ha megpróbálják, egy hibaüzenetet kapnak. Ha ez a szándékod a \'Csatolmány küldése\' jogot állítsd át ADMINra ezeknél a fórumoknál.<br /><br />';
$lang['Add_forums'] = 'Fórumok hozzáadása';
$lang['Add_selected'] = 'Kijelölt(ek) hozzáadása';
$lang['Perm_all_forums'] = 'ÖSSZES FÓRUM';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'Csatolmány kvóták beállítása';
$lang['Manage_quotas_explain'] = 'Itt felvehetsz/szerkesztheted/törölheted a kvótákat. Ezeket késõbb hozzárendelheted egyes felhasználókhoz, csoportokhoz. Ha egy felhasználónak akarsz beállítani egy kvótát, kattints a Felhasználók menüpontban a Beállításra, válaszd ki a felhasználót, az adatlap alján megtalálod az opciókat. Ha egy csoporthoz rendelnél határoznál meg egy kvótát kattints a Csoportoknál a Beállításra, válaszd ki a csoportot, és ugyancsak alul megtalálod ezeket a beállításokat. Ha meg szeretnéd nézni, hogy egy kvótához mely felhasználók, csoportok tartoznak, kattints a kvóta mellett lévõ \'Megtekintés\'-re.';
$lang['Assigned_users'] = 'Kijelölt felhasználók';
$lang['Assigned_groups'] = 'Kijelölt csoportok';
$lang['Quota_limit_exist'] = 'A %s kvóta már létezik.'; // Replace %s with the Quota Description

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'Csatolmányok Vezérlõpult';
$lang['Control_panel_explain'] = 'Ezen az oldalon a csatolmányok statisztikáit nézheted meg, rájuk kereshetsz, stb...';
$lang['File_comment_cp'] = 'Cím';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = 'Használj *-ot a részleges szavakhoz';
$lang['Size_smaller_than'] = 'Csatolmány mérete kisebb mint (byteban)';
$lang['Size_greater_than'] = 'Csatolmány mérete nagyobb mint (byteban)';
$lang['Count_smaller_than'] = 'Letöltve kevesebbszer mint';
$lang['Count_greater_than'] = 'Letöltve többször mint';
$lang['More_days_old'] = 'Régebbi mint (nap)';
$lang['No_attach_search_match'] = 'Egy csatolmány se felelt meg a keresési kritériumoknak.';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'Csatolmányok száma';
$lang['Total_filesize'] = 'Csatolmányok összes mérete';
$lang['Number_posts_attach'] = 'Hozzászólások csatolmánnyal';
$lang['Number_topics_attach'] = 'Témák csatolmánnyal';
$lang['Number_users_attach'] = 'Független felhasználók által küldött csatolmányok';
$lang['Number_pms_attach'] = 'Csatolmányok teljes darabszáma privát üzenetekben';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = '%s csatolmány statisztikája'; // replace %s with username
$lang['Size_in_kb'] = 'Méret (KB)';
$lang['Downloads'] = 'Letöltve';
$lang['Post_time'] = 'Feltöltve';
$lang['Posted_in_topic'] = 'Téma';
$lang['Submit_changes'] = 'Változtatások jóváhagyása';

// Sort Types
$lang['Sort_Attachments'] = 'Csatolmányok';
$lang['Sort_Size'] = 'Méret';
$lang['Sort_Filename'] = 'Fájl neve';
$lang['Sort_Comment'] = 'Cím';
$lang['Sort_Extension'] = 'Kiterjesztés';
$lang['Sort_Downloads'] = 'Letöltések száma';
$lang['Sort_Posttime'] = 'Elküldés ideje';
$lang['Sort_Posts'] = 'Hozzászólások';

// View Types
$lang['View_Statistic'] = 'Statisztika';
$lang['View_Search'] = 'Keresés';
$lang['View_Username'] = 'Felhasználók';
$lang['View_Attachments'] = 'Csatolmányok';

// Successfully updated
$lang['Attach_config_updated'] = 'A csatolmányok beállításai sikeresen frissítve lettek.';
$lang['Click_return_attach_config'] = 'Kattints %side%s, hogy visszatérj a Csatolmányok beállításához.';
$lang['Test_settings_successful'] = 'A beállítások tesztelése befejezõdött, minden jónak tûnik.';

// Some basic definitions
$lang['Attachments'] = 'Csatolmányok';
$lang['Attachment'] = 'Csatolmány';
$lang['Extensions'] = 'Kiterjesztések';
$lang['Extension'] = 'Kiterjesztés';

// Auth pages
$lang['Auth_attach'] = 'Csatolmány küldése';
$lang['Auth_download'] = 'Csatolmány letöltése';

?>