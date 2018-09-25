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
 *     translated by	: Fodor Bertalan           and L�szl� Mikl�s
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
$lang['Control_Panel'] = 'Vez�rl�pult';
$lang['Shadow_attachments'] = '�rny�k csatolm�nyok';
$lang['Forbidden_extensions'] = 'Tiltott kiterjeszt�sek';
$lang['Extension_control'] = 'Kiterjeszt�sek be�ll�t�sai';
$lang['Extension_group_manage'] = 'Kiterjeszt�s csoportok be�ll�t�sai';
$lang['Special_categories'] = 'Speci�lis kateg�ri�k';
$lang['Sync_attachments'] = 'Csatolm�nyok szinkroniz�l�sa';
$lang['Quota_limits'] = 'Kv�ta limit';

// Attachments -> Management
$lang['Attach_settings'] = 'Csatolm�nyok be�ll�t�sa';
$lang['Manage_attachments_explain'] = 'Itt a Csatolm�ny MOD f�bb be�ll�t�sait v�ltoztathatod meg. Ha a Be�ll�t�sok tesztel�se gombra kattintasz, lefut egy teszt, mely teszteli a MOD m�k�d�s�t. Ha gondjaid lenn�nek a f�jlok felt�lt�s�vel, futtast le ezt a tesztet, hogy megtudjad a hiba ok�t.';
$lang['Attach_filesize_settings'] = 'Csatolm�nyok m�reteinek be�ll�t�sai';
$lang['Attach_number_settings'] = 'Csatolm�nyok darabsz�m�nak be�ll�t�sa';
$lang['Attach_options_settings'] = 'F�bb be�ll�t�sok';

$lang['Upload_directory'] = 'Felt�lt�si k�nyvt�r:';
$lang['Upload_directory_explain'] = 'A phpBB2 k�nyvt�radt�l a relat�v el�r�si �t. Pl. ha \'files\'-t �rsz be, �s a phpBB2 k�nyvt�rad a http://www.yourdomain.com/phpBB2 c�men tal�lhat�, akkor a felt�lt�si k�nyvt�r teljes c�me http://www.yourdomain.com/phpBB2/files.';
$lang['Attach_img_path'] = 'Csatolm�ny ikonja hozz�sz�l�sokn�l:';
$lang['Attach_img_path_explain'] = 'Ez a k�p jelenik meg a csatolm�ny mellett a hozz�sz�l�sban. Hagyd �resen ezt a rubrik�t, ha nem akarsz semmilyen ikont megjelen�teni. Ezt a be�ll�t�st fel�l�rhatja a Kiterjeszt�s csoportok be�ll�t�sa.';
$lang['Attach_topic_icon'] = 'Csatolm�ny ikonja t�m�n�l:';
$lang['Attach_topic_icon_explain'] = 'Ez a k�p jelenik meg a csatolm�nnyal rendelkez� t�m�k mellett. Hagyd �resen ezt a rubrik�t, ha nem akarsz semmilyen ikont megjelen�teni.';
$lang['Attach_display_order'] = 'Csatolm�nyok rendez�se:';
$lang['Attach_display_order_explain'] = 'Itt v�laszthatod ki, hogy a hozz�sz�l�sban/priv�t �zenetben a f�jlok cs�kken� (el�sz�r a leg�jabb), vagy n�vekv� (el�sz�r a legk�s�bbi csatolm�ny) sorrendben legyenek.';
$lang['Show_apcp'] = '�j Csatolm�ny k�ld�se fel�let (Csatolm�nyok vez�rl�pult):';
$lang['Show_apcp_explain'] = 'Itt v�laszthatod ki, hogy a Csatolm�nyok Vez�rl�pult (igen), vagy a r�gi k�t rubrika (nem) jelenjen meg hozz�sz�l�s/P� �r�s�n�l/szerkeszt�s�n�l. A kin�zet�t neh�z le�rni, legegyszer�bb ha kipr�b�lod.';

$lang['Max_filesize_attach'] = 'Maximum f�jlm�ret';
$lang['Max_filesize_attach_explain'] = 'A felt�lthet� f�jlok m�ret�nek fels� hat�ra. A 0 korl�tlant jelent. Ez a be�ll�t�s a szerver konfigur�ci�t�l is f�gg! Ha pl. a php konfigur�ci�d csak 2 MB-os felt�lt�st enged�lyez, ezt nem tudja fel�l�rni ez a MOD.';
$lang['Attach_quota'] = 'Csatolm�nyok t�rhelye';
$lang['Attach_quota_explain'] = 'Ennyi t�rhelyet foglalhatnak el �SSZESEN a csatolm�nyok a t�rhelyeden. A 0 korl�tlant jelent.';
$lang['Max_filesize_pm'] = 'Maximum t�rhely a priv�t �zenet mapp�ban';
$lang['Max_filesize_pm_explain'] = 'Ennyi t�rhelyet foglalhatnak el egy felhaszn�l csatolm�nyai a priv�t �zenet mapp�j�ban. A 0 korl�tlant jelent.';
$lang['Default_quota_limit'] = 'Alap�rtelmezett kv�ta limit';
$lang['Default_quota_limit_explain'] = 'Itt adhatod meg az �jonnan regisztr�l�k csatolm�nyainak t�rhely�nek alap�rtelmezett fels� hat�r�t. A \'Nincs kv�ta limit\' opci� kikapcsolja a kv�t�kat, ehelyett az ezen az oldalon l�v� m�s be�ll�t�sok lesznek haszn�lva.';

$lang['Max_attachments'] = 'Csatolm�nyok maximum darabsz�ma egy hozz�sz�l�sban:';
$lang['Max_attachments_explain'] = 'Ennyi csatolm�ny lehet legfeljebb egy hozz�sz�l�sban.';
$lang['Max_attachments_pm'] = 'Csatolm�nyok maximum darabsz�ma egy priv�t �zenetben:';
$lang['Max_attachments_pm_explain'] = 'Ennyi csatolm�ny lehet legfeljebb egy priv�t �zenetben.';

$lang['Disable_mod'] = 'A Csatolm�ny MOD kikapcsol�sa';
$lang['Disable_mod_explain'] = 'Ez f�leg �j sablonok tesztel�s�re val�. Ilyenkor a f�rum -az admin panel kiv�tel�vel- �gy n�z ki, mintha nem is lenne ez a MOD telep�tve.';
$lang['PM_Attachments'] = 'Csatolm�nyok enged�lyez�se priv�t �zenetben:';
$lang['PM_Attachments_explain'] = 'Enged�lyezi/megtiltja csatolm�nyok hozz�ad�s�t a priv�t �zenetekhez';
$lang['Ftp_upload'] = 'FTP felt�lt�s bekapcsol�sa:';
$lang['Ftp_upload_explain'] = 'Enged�lyezi/megtiltja az FTP felt�lt�st. Ha igenre �ll�tod, meg kell hat�roznod a Csatolm�nyok FTP be�ll�t�sait, valamint a felt�lt�si k�nyvt�r nem lesz haszn�lva.';
$lang['Attachment_topic_review'] = 'Csatolm�nyok megjelen�t�se a T�ma el�n�zetben';
$lang['Attachment_topic_review_explain'] = 'Ha igenre �ll�tod, minden csatolt f�jlt meg fog jelen�teni a T�ma el�n�zetben �j hozz�sz�l�s k�ld�sekor.';

$lang['Ftp_server'] = 'FTP felt�lt�si szerver';
$lang['Ftp_server_explain'] = 'Itt adhatod meg az IP c�m�t vagy FTP-hosztnev�t a szerverednek, melyen a felt�lt�tt f�jljaid vannak. Ha ezt a rubrik�t �resen hagyod, az a szerver lesz haszn�lva melyre a phpBB2-t install�ltad. Nem megengedett a c�mhez ftp://, vagy b�rmi m�s hozz�ad�sa, csak egyszer�en pl. ftp.foo.com, vagy ami enn�l gyorsabb: az IP c�m.';

$lang['Attach_ftp_path'] = 'FTP el�r�si �t a felt�tl�si k�nyvt�rhoz';
$lang['Attach_ftp_path_explain'] = 'Ebbe a k�nyvt�rba ker�lnek a csatolm�nyok. Nem kell chmodozva lennie. Ne az IP-, vagy FTP-c�met �rd ide.<br />P�ld�ul: /home/web/uploads';
$lang['Ftp_download_path'] = 'Let�lt�si link az FTP-hez';
$lang['Ftp_download_path_explain'] = 'Ide azt az URL-t �rd, mely az FTP el�r�si �thoz vonatkozik, melyen a csatolm�nyok vannak.<br /Ha egy k�ls� FTP szervert haszn�lsz a teljes c�met �rd be, pl. http://www.mystorage.com/phpBB2/upload.<br />Ha a helyi szervert haszn�lod, melyen a phpBB-d is van, akkor a phpBB k�nyvt�radhoz viszony�tott relat�v el�r�si utat is megadhatod, pl. \'upload\'.<br />Hagyd �resen ezt a rubrik�t, ha az FTP-n l�v� k�nyvt�r nem �rhet� el az Internetr�l. Ekkor viszont nem tudod a fizik�lis let�lt�si m�dot haszn�lni.';
$lang['Ftp_passive_mode'] = 'FTP passz�v m�d bekapcsol�sa';
$lang['Ftp_passive_mode_explain'] = 'A PASV parancsnak sz�ks�ge van r�, hogy az FTP szerver megnyisson egy portot a kapcsol�d�shoz �s ennek a c�m�t visszak�ldje. A felhaszn�l� csatlakozik ehhez a porthoz �s az FTP szerver ezen v�rja a k�r�seket.';

$lang['No_ftp_extensions_installed'] = 'Nem tudod haszn�lni az FTP felt�lt�si m�dot, mivel az FTP kib�v�t�s nincs benne a PHP install�ci�dban.';

// Attachments -> Shadow Attachments
$lang['Shadow_attachments_explain'] = 'Itt tudod t�r�lni azokat a csatolm�nyokat, melyek f�jljai m�r nem l�teznek, vagy azokat a f�jlokat, melyek m�r nincsenek egy hozz�sz�l�shoz se csatolva. Ha r�klikkelsz egy f�jlra let�tlheted, vagy megn�zheted azt, vagy ha nincs link akkor a f�jl m�r nem l�tezik.';
$lang['Shadow_attachments_file_explain'] = 'L�tez�, de hozz�sz�l�shoz nem csatolt �llom�nyok t�rl�se';
$lang['Shadow_attachments_row_explain'] = 'Elk�ld�tt csatolm�nyok t�rl�se, melyek f�jlai nem l�teznek';
$lang['Empty_file_entry'] = 'Nincs adat';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'Kis k�p helyrehoz�sa a k�vetkez� csatolm�nyokn�l: %s'; // replace %s with physical Filename
$lang['Attach_sync_finished'] = 'A csatolm�nyk szinkroniz�ci�ja befejez�d�tt.';

// Extensions -> Extension Control
$lang['Manage_extensions'] = 'Kiterjeszt�sek be�ll�t�sa';
$lang['Manage_extensions_explain'] = 'Ezen az oldalon a kiterjeszt�seket m�dos�thatod. Ha szeretn�d egy kiterjeszt�s felt�lt�s�t enged�lyezni/letiltani, k�rlek haszn�ld a Kiterjeszt�s csoportok be�ll�t�sa oldalt.';
$lang['Explanation'] = 'Magyar�zat';
$lang['Extension_group'] = 'Kiterjeszt�s csoport';
$lang['Invalid_extension'] = 'Hib�s kiterjeszt�s';
$lang['Extension_exist'] = 'A %s kiterjeszt�s m�r l�tezik'; // replace %s with the Extension
$lang['Unable_add_forbidden_extension'] = 'A %s kiterjeszt�s meg van tiltva, ez�rt nem tudod felvenni az enged�lyezett kiterjeszt�sek k�z�.'; // replace %s with Extension

// Extensions -> Extension Groups Management
$lang['Manage_extension_groups'] = 'Kiterjeszt�s csoportok be�ll�t�sa';
$lang['Manage_extension_groups_explain'] = 'Ezen az oldalon felvehetsz, t�r�lhetsz, szerkeszthetsz kiterjeszt�s csoportokat, le is tilthatod �ket, be�ll�thatsz nekik egy szpeci�lis kateg�ri�t, valamint a let�lt�s m�dj�t is megv�ltoztathatod. Ezen fel�l megadhatsz egy ikont (kis k�pet) mely a kiterjeszt�s csoporthoz tartoz� csatolm�nyok el�tt fog megjelenni.';
$lang['Special_category'] = 'Speci�lis kateg�ria';
$lang['Category_images'] = 'K�p';
$lang['Category_stream_files'] = 'Stream';
$lang['Category_swf_files'] = 'Flash';
$lang['Allowed'] = 'Enged�lyezve';
$lang['Allowed_forums'] = 'Enged�lyezett f�rumok';
$lang['Ext_group_permissions'] = 'Csoport enged�lyei';
$lang['Download_mode'] = 'Let�lt�si m�d';
$lang['Upload_icon'] = 'Ikon';
$lang['Max_groups_filesize'] = 'Maximum m�ret';
$lang['Extension_group_exist'] = 'A %s kiterjeszt�s csoport m�r l�tezik.'; // replace %s with the group name
$lang['Collapse'] = '+';
$lang['Decollapse'] = '-';

// Extensions -> Special Categories
$lang['Manage_categories'] = 'Speci�lis kateg�ri�k be�ll�t�sa';
$lang['Manage_categories_explain'] = 'Ezen az oldalon a speci�lis kateg�ri�kat szerkesztheted. Speci�lis param�tereket adhatsz meg egy kiterjeszt�s csoporthoz rendelt speci�lis kateg�ri�nak.';
$lang['Settings_cat_images'] = 'Speci�lis kateg�ri�k be�ll�t�sa: K�pek';
$lang['Settings_cat_streams'] = 'Speci�lis kateg�ri�k be�ll�t�sa: Stream f�jlok';
$lang['Settings_cat_flash'] = 'Speci�lis kateg�ri�k be�ll�t�sa: Flash f�jlok';
$lang['Display_inlined'] = 'K�pek direkt megjelen�t�se';
$lang['Display_inlined_explain'] = 'A k�pek a hozz�sz�l�sban jelenjenek meg (igen), vagy csak egy link mutasson r� (nem).';
$lang['Max_image_size'] = 'Maximum k�p m�ret';
$lang['Max_image_size_explain'] = 'Itt a csatolt k�pek maximum nagys�g�t tudod megadni pixelben (sz�less�g x magass�g).<br />Ha 0x0-ra �ll�tod, a funkci� ki lesz kapcsolva. N�h�ny k�pn�l ez a funkci� nem m�k�dik a PHP korl�tai miatt.';
$lang['Image_link_size'] = 'Linkelt k�p m�rete';
$lang['Image_link_size_explain'] = 'Ha a k�p el�ri ezt a m�retet, akkor csak egy link fog megjelenni hozz�.<br />Ha 0x0-ra �ll�tod, a funkci� ki lesz kapcsolva. N�h�ny k�pn�l ez a funkci� nem m�k�dik a PHP korl�tai miatt.';
$lang['Assigned_group'] = 'Kijel�lt csoport';

$lang['Image_create_thumbnail'] = 'Kis k�p k�sz�t�se';
$lang['Image_create_thumbnail_explain'] = 'Mindig k�sz�tsen egy kis k�pet. Ez a funkci� majdnem az �sszes be�ll�t�st fel�l�rja ebben a speci�lis kateg�ri�ban, kiv�ve a maximum k�p m�retet. Ha bekapcsolod ezt a funkci�t, a hozz�sz�l�sban a nagy k�p helyett egy kis k�p fog megjelenni, de a felhaszn�l� ezt megn�zheti nagyban is a kis k�pre kattintva.<br />A funkci�nak sz�ks�ge van egy install�lt Imagick programra. Ha ez nincs �gy, vagy a biztons�gos �zemm�d be van kapcsolva, a PHP GD kiterjeszt�se lesz haszn�lva. Ha a k�pt�pust nem t�mogatja a PHP, a funkci� nem lesz bekapcsolva.';
$lang['Image_min_thumb_filesize'] = 'Minimum m�ret kis k�phez';
$lang['Image_min_thumb_filesize_explain'] = 'Ha a k�p kisebb mint ez, nem k�sz�l kis k�p, mivel az eredeti is el�g kicsi.';
$lang['Image_imagick_path'] = 'Imagick program (teljes el�r�si �t)';
$lang['Image_imagick_path_explain'] = 'A konvert�l� program teljes el�r�si �tja, norm�lisan /usr/bin/convert (windows-on: c:/imagemagick/convert.exe).';
$lang['Image_search_imagick'] = 'Imagick keres�se';

$lang['Use_gd2'] = 'GD2 kiterjeszt�s haszn�lata';
$lang['Use_gd2_explain'] = 'A PHP k�pes alkalmazni a GD1 �s GD2 kiterjeszt�seket. Hiba n�lk�li kis k�p k�sz�t�s�re Imagemagick n�lk�l a Csatolm�ny MOD k�t elj�r�st alkalmaz, az itteni v�laszt�s alapj�n. Ha kis k�peid rossz min�s�g�ek, pr�b�ld meg megv�ltoztatni ezt a be�ll�t�st.';
$lang['Attachment_version'] = 'Csatolm�ny Modul verzi� %s<br />Modul magyar ford�t�sa &copy; <a class="copyright" href="http://fodorb.uw.hu">Fodor Bertalan</a> �s L�szl� Mikl�s'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'Tiltott kiterjeszt�sek be�ll�t�sa';
$lang['Manage_forbidden_extensions_explain'] = 'Ezen az oldalon b�v�theted, vagy sz�k�theted a tiltott kiterjeszt�sek list�j�t. A php, php3, php4 kiterjeszt�sek alap�rtelmezetten tiltva vannak biztons�gi okok miatt, nem is tudod t�r�lni �ket.';
$lang['Forbidden_extension_exist'] = 'A %s kiterjeszt�s m�r meg van tiltva.'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = 'A %s kiterjeszt�s defini�lva van az enged�lyezett kiterjeszt�sek k�z�tt, k�rlek el�sz�r t�r�ld onnan.';  // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'Kiterjeszt�s csoport enged�lyei -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'Ezen az oldalon korl�tozni tudod az egyes kiterjeszt�s csoportokat f�rumokhoz d�t�sed szerint (Enged�lyezett f�rumok). Az alap�rtelmezett be�ll�t�sban az �sszes kiterjeszt�s csoport enged�lyezve van �sszes f�rumban. Ha egy kiterjeszt�s csoportot korl�tozni szeretn�l egy bizonyos f�rumra, akkor v�laszd ki a megfel� enged�lyezett kiterjeszt�s csoportot (alul), majd v�laszd ki melyik f�rumra vonatkoznak a be�ll�t�sok �s kattints a Kijel�lt(ek) hozz�ad�s�ra. Minden egyes alkalommal ki tudod terjeszteni a be�ll�t�sokat az �sszes f�rumra. Ha egy be�ll�t�s csak bizonyos f�rumokra vonatkozik, akkor ha �j f�rumot hozol l�tre �jra el kell l�togatnod ide.';
$lang['Note_admin_empty_group_permissions'] = 'Megjegyz�s:<br />Az a al�bb felsorolt f�rumokban norm�lisan a felhaszn�l�k csatolhatnak f�jlokat, de mi�ta egyetlen egy kiterjeszt�s sem enged�lyezett, a felhaszn�l�k nem tudnak csatolni semmit. Ha megpr�b�lj�k, egy hiba�zenetet kapnak. Ha ez a sz�nd�kod a \'Csatolm�ny k�ld�se\' jogot �ll�tsd �t ADMINra ezekn�l a f�rumokn�l.<br /><br />';
$lang['Add_forums'] = 'F�rumok hozz�ad�sa';
$lang['Add_selected'] = 'Kijel�lt(ek) hozz�ad�sa';
$lang['Perm_all_forums'] = '�SSZES F�RUM';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'Csatolm�ny kv�t�k be�ll�t�sa';
$lang['Manage_quotas_explain'] = 'Itt felvehetsz/szerkesztheted/t�r�lheted a kv�t�kat. Ezeket k�s�bb hozz�rendelheted egyes felhaszn�l�khoz, csoportokhoz. Ha egy felhaszn�l�nak akarsz be�ll�tani egy kv�t�t, kattints a Felhaszn�l�k men�pontban a Be�ll�t�sra, v�laszd ki a felhaszn�l�t, az adatlap alj�n megtal�lod az opci�kat. Ha egy csoporthoz rendeln�l hat�rozn�l meg egy kv�t�t kattints a Csoportokn�l a Be�ll�t�sra, v�laszd ki a csoportot, �s ugyancsak alul megtal�lod ezeket a be�ll�t�sokat. Ha meg szeretn�d n�zni, hogy egy kv�t�hoz mely felhaszn�l�k, csoportok tartoznak, kattints a kv�ta mellett l�v� \'Megtekint�s\'-re.';
$lang['Assigned_users'] = 'Kijel�lt felhaszn�l�k';
$lang['Assigned_groups'] = 'Kijel�lt csoportok';
$lang['Quota_limit_exist'] = 'A %s kv�ta m�r l�tezik.'; // Replace %s with the Quota Description

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'Csatolm�nyok Vez�rl�pult';
$lang['Control_panel_explain'] = 'Ezen az oldalon a csatolm�nyok statisztik�it n�zheted meg, r�juk kereshetsz, stb...';
$lang['File_comment_cp'] = 'C�m';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = 'Haszn�lj *-ot a r�szleges szavakhoz';
$lang['Size_smaller_than'] = 'Csatolm�ny m�rete kisebb mint (byteban)';
$lang['Size_greater_than'] = 'Csatolm�ny m�rete nagyobb mint (byteban)';
$lang['Count_smaller_than'] = 'Let�ltve kevesebbszer mint';
$lang['Count_greater_than'] = 'Let�ltve t�bbsz�r mint';
$lang['More_days_old'] = 'R�gebbi mint (nap)';
$lang['No_attach_search_match'] = 'Egy csatolm�ny se felelt meg a keres�si krit�riumoknak.';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'Csatolm�nyok sz�ma';
$lang['Total_filesize'] = 'Csatolm�nyok �sszes m�rete';
$lang['Number_posts_attach'] = 'Hozz�sz�l�sok csatolm�nnyal';
$lang['Number_topics_attach'] = 'T�m�k csatolm�nnyal';
$lang['Number_users_attach'] = 'F�ggetlen felhaszn�l�k �ltal k�ld�tt csatolm�nyok';
$lang['Number_pms_attach'] = 'Csatolm�nyok teljes darabsz�ma priv�t �zenetekben';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = '%s csatolm�ny statisztik�ja'; // replace %s with username
$lang['Size_in_kb'] = 'M�ret (KB)';
$lang['Downloads'] = 'Let�ltve';
$lang['Post_time'] = 'Felt�ltve';
$lang['Posted_in_topic'] = 'T�ma';
$lang['Submit_changes'] = 'V�ltoztat�sok j�v�hagy�sa';

// Sort Types
$lang['Sort_Attachments'] = 'Csatolm�nyok';
$lang['Sort_Size'] = 'M�ret';
$lang['Sort_Filename'] = 'F�jl neve';
$lang['Sort_Comment'] = 'C�m';
$lang['Sort_Extension'] = 'Kiterjeszt�s';
$lang['Sort_Downloads'] = 'Let�lt�sek sz�ma';
$lang['Sort_Posttime'] = 'Elk�ld�s ideje';
$lang['Sort_Posts'] = 'Hozz�sz�l�sok';

// View Types
$lang['View_Statistic'] = 'Statisztika';
$lang['View_Search'] = 'Keres�s';
$lang['View_Username'] = 'Felhaszn�l�k';
$lang['View_Attachments'] = 'Csatolm�nyok';

// Successfully updated
$lang['Attach_config_updated'] = 'A csatolm�nyok be�ll�t�sai sikeresen friss�tve lettek.';
$lang['Click_return_attach_config'] = 'Kattints %side%s, hogy visszat�rj a Csatolm�nyok be�ll�t�s�hoz.';
$lang['Test_settings_successful'] = 'A be�ll�t�sok tesztel�se befejez�d�tt, minden j�nak t�nik.';

// Some basic definitions
$lang['Attachments'] = 'Csatolm�nyok';
$lang['Attachment'] = 'Csatolm�ny';
$lang['Extensions'] = 'Kiterjeszt�sek';
$lang['Extension'] = 'Kiterjeszt�s';

// Auth pages
$lang['Auth_attach'] = 'Csatolm�ny k�ld�se';
$lang['Auth_download'] = 'Csatolm�ny let�lt�se';

?>