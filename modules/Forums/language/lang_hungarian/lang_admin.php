<?php

/***************************************************************************
 *                            lang_admin.php [Magyar]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_admin.php,v 1.35.2.11 2005/10/04 21:45:02 grahamje Exp $
 *
 *     translated by   :  Szilard Andai
 *     web             :  http://iranon.ezustkep.hu
 *     version         : 2.0.20
 *     completed by    : Fodor Bertalan - http://phpbb.hu and László Miklós
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

/* CONTRIBUTORS
        2002-12-15        Philip M. White (pwhite@mailhaven.com)
                Fixed many minor grammatical mistakes
*/

//
// Format is same as lang_main
//

//
// Modules, this replaces the keys used
// in the modules[][] arrays in each module file
//
$lang['General'] = 'Általános';
$lang['Users'] = 'Felhasználók';
$lang['Groups'] = 'Csoportok';
$lang['Forums'] = 'Fórumok';
$lang['Styles'] = 'Sablonok';

$lang['Configuration'] = 'Beállítás';
$lang['Permissions'] = 'Jogosultság';
$lang['Manage'] = 'Beállítás';
$lang['Disallow'] = 'Tiltott nevek';
$lang['Prune'] = 'Karbantartás';
$lang['Mass_Email'] = 'Csoportos email';
$lang['Ranks'] = 'Rangok';
$lang['Smilies'] = 'Emotikonok';
$lang['Ban_Management'] = 'Kitiltások';
$lang['Word_Censor'] = 'Cenzúra';
$lang['Export'] = 'Exportálás';
$lang['Create_new'] = 'Készítés';
$lang['Add_new'] = 'Hozzáadás';
$lang['Backup_DB'] = 'Adatbázis kimentése';
$lang['Restore_DB'] = 'Adatbázis visszaállítása';


//
// Index
//
$lang['Admin'] = 'Adminisztráció';
$lang['Not_admin'] = 'Nincs jogosultságod az adminisztrációhoz!';
$lang['Welcome_phpBB'] = 'Üdvözlünk a phpBB-ben!';
$lang['Admin_intro'] = 'Köszönjük, hogy a phpBB-t választottad a fórumod megvalósításához. Ebben az ablakban egy gyors áttekintést láthatsz a Fórum néhány adatáról. Erre az oldalra mindig visszatérhetsz, ha a bal oldali menüpontban rákattintasz az <i>Admin kezdõlap</i> linkre. A Fórumba való visszatéréshez kattints a phpBB ikonra, mely szintén a bal oldali menü tetején található meg. A többi hivatkozással a Fórum beállításait változtathatod meg, a legapróbb részletbe menõen. Minden oldalhoz egy külön kis leírás tartozik, mely segít a beállításokban.';
$lang['Main_index'] = 'Fórum kezdõlap';
$lang['Forum_stats'] = 'Fórum statisztika';
$lang['Admin_Index'] = 'Admin kezdõlap';
$lang['Preview_forum'] = 'Fórum elõnézet';

$lang['Click_return_admin_index'] = 'Kattints %side%s, hogy visszatérj az Admin kezdõlapra';

$lang['Statistic'] = 'Statisztika';
$lang['Value'] = 'Érték';
$lang['Number_posts'] = 'Hozzászólások száma';
$lang['Posts_per_day'] = 'Hozzászólások száma naponta';
$lang['Number_topics'] = 'Témák száma';
$lang['Topics_per_day'] = 'Témák száma naponta';
$lang['Number_users'] = 'Felhasználók száma';
$lang['Users_per_day'] = 'Felhasználók száma naponta';
$lang['Board_started'] = 'Fórum indulása';
$lang['Avatar_dir_size'] = 'Avatar könyvtár mérete';
$lang['Database_size'] = 'Adatbázis mérete';
$lang['Gzip_compression'] ='Gzip tömörítés';
$lang['Not_available'] = 'Nem elérhetõ';

$lang['ON'] = 'Bekapcsolva'; // This is for GZip compression
$lang['OFF'] = 'Kikapcsolva';


//
// DB Utils
//
$lang['Database_Utilities'] = 'Adatbázis eszközök';

$lang['Restore'] = 'Visszaállítás';
$lang['Backup'] = 'Kimentés';
$lang['Restore_explain'] = 'Ezzel a funkcióval a phpBB fórum adatbázisának összes tábláját vissza lehet tölteni egy kimentett fájlból. Ha a szerver támogatja a kicsomagolást, akkor egy GZIP-pel tömörített szöveges fájlból is be lehet tölteni. <b>FIGYELEM!</b> Ez felülírja az éppen használt adatbázist! Az adatbázis visszaállítása eltarthat egy ideig, ezért ne menj el addig errõl az oldalról, míg nem jelzi, hogy kész van.';
$lang['Backup_explain'] = 'Ezzel a funkcióval a phpBB fórum adatbázisának összes tábláját ki lehet menteni egy külsõ fájlba. Ha van más, egyéni phpBB-hez tartozó tábla is az adatbázisban, akkor add meg azoknak a neveit is, vesszõvel elválasztva - az alábbi Egyéb táblák mezõbe. Ha támogatja a szerver, akkor használhatsz GZIP tömörítést is, hogy kisebb legyen a letöltendõ fájl mérete.';

$lang['Backup_options'] = 'Kimentési beállítások';
$lang['Start_backup'] = 'Kimentés indítása';
$lang['Full_backup'] = 'Teljes kimentés';
$lang['Structure_backup'] = 'Csak az adatbázis felépítésének kimentése';
$lang['Data_backup'] = 'Csak az adatok kimentése';
$lang['Additional_tables'] = 'Egyéb táblák';
$lang['Gzip_compress'] = 'Gzip tömörítés';
$lang['Select_file'] = 'Fájl kiválasztása';
$lang['Start_Restore'] = 'Visszaállítás indítása';

$lang['Restore_success'] = 'Az adatbázist sikeresen visszaállítottam!<br /><br />A Fórum visszakerült a kimentés elõtti állapotba.';
$lang['Backup_download'] = 'A letöltés hamarosan elindul, várj a megkezdéséig.';
$lang['Backups_not_supported'] = 'Az adatbázis kimentése nem lehetséges, mivel ez nincsen támogatva ebben az adatbázis rendszerben.';

$lang['Restore_Error_uploading'] = 'Hiba, a kimentett fájl feltöltése közben.';
$lang['Restore_Error_filename'] = 'Hibás fájlnév, válassz egy másik fájlt.';
$lang['Restore_Error_decompress'] = 'A GZIP kitömörítés nem lehetséges, adj meg egy sima szöveges fájlt.';
$lang['Restore_Error_no_file'] = 'A feltöltés sikertelen volt.';


//
// Auth pages
//
$lang['Select_a_User'] = 'Válassz egy felhasználót';
$lang['Select_a_Group'] = 'Válassz egy csoportot';
$lang['Select_a_Forum'] = 'Válassz egy fórumot';
$lang['Auth_Control_User'] = 'Felhasználói engedélyek beállítása';
$lang['Auth_Control_Group'] = 'Csoportengedélyek beállítása';
$lang['Auth_Control_Forum'] = 'Fórumhoz tartozó jogosultságok beállítása';
$lang['Look_up_User'] = 'Felhasználó keresése';
$lang['Look_up_Group'] = 'Csoport keresése';
$lang['Look_up_Forum'] = 'Fórum keresése';

$lang['Group_auth_explain'] = 'Itt állíthatsz be jogosultságokat és moderátor jogokat az egyes csoportokhoz. Ne felejtsd el, hogy a csoport jogosultság megváltoztatásával egyes felhasználók még hozzáférhetnek a csoporthoz. Ebben az esetben egy figyelmezetõ üzenetet fogsz kapni.';
$lang['User_auth_explain'] = 'Itt állíthatsz be jogosultságokat és moderátor jogokat az egyes felhasználókhoz. Ne felejtsd el, hogy a felhasználói jogosultság megváltoztatásával egyes felhasználók még hozzáférhetnek egyes fórumokhoz, stb. Ebben az esetben egy figyelmezetõ üzenetet fogsz kapni.';
$lang['Forum_auth_explain'] = 'Itt állíthatod be a hozzáférési jogosultságokat az egyes fórumokhoz, az Egyszerû vagy Bõvített lehetõséget használva. Ne feledd, hogy a jogosultságok megváltoztatásával a felhasználók újabb opciókat, és változtatási lehetõséget érhetnek el.';

$lang['Simple_mode'] = 'Egyszerû mód';
$lang['Advanced_mode'] = 'Bõvített mód';
$lang['Moderator_status'] = 'Moderátori státusz';

$lang['Allowed_Access'] = 'Hozzáférés engedélyezve';
$lang['Disallowed_Access'] = 'Hozzáférés megtagadva';
$lang['Is_Moderator'] = 'Moderátor';
$lang['Not_Moderator'] = 'Nem moderátor';

$lang['Conflict_warning'] = 'Jogosultság-ütközés';
$lang['Conflict_access_userauth'] = 'Ennek a felhasználónak már van fórum jogosultsága, a csoporttagságon keresztül. Ha ezt meg akarod szüntetni vagy meg akarod változtatni, akkor a felhasználó egyéni jogosultságaiban változtasd meg. A felhasználónak az alábbi jogosultságai vannak:';
$lang['Conflict_mod_userauth'] = 'Ennek a felhasználónak már van moderátori joga ehhez a fórumhoz a csoporttagságon keresztül. Ha ezt meg akarod szüntetni, akkor a felhasználó egyéni jogosultságaiban változtasd meg. A felhasználónak az alábbi jogosultságai vannak:';

$lang['Conflict_access_groupauth'] = 'Az egyéni jogosultságok beállításában ennek a felhasználónak már van jogosultsága ehhez a fórumhoz. Ha ezt meg akarod változtatni, akkor a felhasználó egyéni jogosultságaiban tedd meg. A felhasználónak az alábbi jogosultságai vannak:';
$lang['Conflict_mod_groupauth'] = 'Az egyéni jogosultságok beállításában ennek a felhasználónak már van moderátori joga ehhez a fórumhoz. Ha ezt meg akarod szüntetni, akkor a felhasználó egyéni jogosultságaiban változtasd meg. A felhasználónak az alábbi jogosultságai vannak:';

$lang['Public'] = 'Nyilvános';
$lang['Private'] = 'Privát';
$lang['Registered'] = 'Regisztrált';
$lang['Administrators'] = 'Adminisztrátor';
$lang['Hidden'] = 'Rejtett';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'MINDENKI';
$lang['Forum_REG'] = 'REG';
$lang['Forum_PRIVATE'] = 'PRIVÁT';
$lang['Forum_MOD'] = 'MOD';
$lang['Forum_ADMIN'] = 'ADMIN';

$lang['View'] = 'Megnéz';
$lang['Read'] = 'Olvasás';
$lang['Post'] = 'Témanyitás';
$lang['Reply'] = 'Hozzászólás';
$lang['Edit'] = 'Szerkesztés';
$lang['Delete'] = 'Törlés';
$lang['Sticky'] = 'Kiemelt';
$lang['Announce'] = 'Közlemény';
$lang['Vote'] = 'Szavazás';
$lang['Pollcreate'] = 'Szavazás készítése';

$lang['Permissions'] = 'Jogosultságok';
$lang['Simple_Permission'] = 'Egyszerû jogosultság';

$lang['User_Level'] = 'Felhasználószint';
$lang['Auth_User'] = 'Felhasználó';
$lang['Auth_Admin'] = 'Adminisztrátor';
$lang['Group_memberships'] = 'Csoporttagságok';
$lang['Usergroup_members'] = 'A következõ felhasználók tartoznak ebbe a csoportba:';

$lang['Forum_auth_updated'] = 'Fórum engedélyek frissítve.';
$lang['User_auth_updated'] = 'Felhasználói engedélyek frissítve.';
$lang['Group_auth_updated'] = 'Csoport-jogosultságok frissítve.';

$lang['Auth_updated'] = 'A Jogosultságok sikeresen megváltoztak!';
$lang['Click_return_userauth'] = 'Kattints %side%s, hogy visszatérj a Felhasználói jogosultság beállításaihoz.';
$lang['Click_return_groupauth'] = 'Kattints %side%s hogy visszatérj a Csoport jogosultság beállításaihoz.';
$lang['Click_return_forumauth'] = 'Kattints %side%s hogy visszatérj a Fórum jogosultság beállításaihoz.';


//
// Banning
//
$lang['Ban_control'] = 'Kitiltás';
$lang['Ban_explain'] = 'Ezen az oldalon lehet kitiltani egy vagy több felhasználót, így azok nem tudják betölteni a Fórum kezdõoldalát. Ezt vagy felhasználónév, vagy IP-cím (vagy IP-tartomány), vagy hosztnév megadásával érheted el. Az email-címet is letilthatod, ekkor a felhasználó nem tudja új néven regisztrálni magát. Figyelem, egy email-cím letiltásával még nem biztos, hogy a felhasználó ki lett tiltva a Fórumról; ehhez a felhasználónév, az IP-cím, és az email-cím egyidejû letiltását használd.';
$lang['Ban_explain_warn'] = 'Figyelem! Az IP-tartomány megadásával a kezdõ, és az utolsó IP között az összes cím le lesz tiltva. Lehetõség szerint minél kisebb tartományt adj meg, hogy ne legyen túl nagy az adatbázis mérete, illetve ha túl nagy tartományt adsz meg, elõfordulhat, hogy vétlen felhasználók sem fogják tudni használni a fórumot. Ha muszáj tartományt megadni, akkor lehetõleg minél kisebbet adj meg, de jobb, ha csak az IP-címeket határozol meg.';

$lang['Select_username'] = 'Felhasználónév kiválasztása';
$lang['Select_ip'] = 'IP-cím kiválasztása';
$lang['Select_email'] = 'Email-cím kiválasztása';

$lang['Ban_username'] = 'Felhasználó kitiltása';
$lang['Ban_username_explain'] = 'A használt operációs rendszertõl és böngészõtõl függõen egyszerre több felhasználót is ki lehet tiltani (kijelöléssel, a CTRL és a SHIFT gomb használatával).';

$lang['Ban_IP'] = 'IP-cím, vagy hosztnév letiltása';
$lang['IP_hostname'] = 'IP-címek vagy hosztnevek';
$lang['Ban_IP_explain'] = 'Több IP-cím, vagy hosztnév megadásához vesszõvel válaszd el õket. IP-tartomány megadásához az elsõ és az utolsó szám elé tegyél egy kötõjelet. Jokerkaraktert (*) is használhatsz.';

$lang['Ban_email'] = 'Email-cím letiltása';
$lang['Ban_email_explain'] = 'Több email-cím kitiltásához vesszõvel válaszd el a címeket. Jokerkaraktert (*) is használhatsz, pld. *@hotmail.com';

$lang['Unban_username'] = 'Felhasználó(k) engedélyezése';
$lang['Unban_username_explain'] = 'A használt operációs rendszertõl és böngészõtõl függõen egyszerre több felhasználót is lehet újraengedélyezni (kijelöléssel, a CTRL és a SHIFT gomb használatával).';

$lang['Unban_IP'] = 'IP-cím(ek) vagy hosztnév(ek) engedélyezése';
$lang['Unban_IP_explain'] = 'A használt operációs rendszertõl és böngészõtõl függõen egyszerre több IP-címet is lehet engedélyezni (kijelöléssel, a CTRL és a SHIFT gomb használatával).';

$lang['Unban_email'] = 'Email-cím(ek) engedélyezése';
$lang['Unban_email_explain'] = 'A használt operációs rendszertõl és böngészõtõl függõen egyszerre több email-címet is lehet engedélyezni (kijelöléssel, a CTRL és a SHIFT gomb használatával).';

$lang['No_banned_users'] = 'Nincsen kitiltott felhasználó.';
$lang['No_banned_ip'] = 'Nincsen letiltott IP-cím';
$lang['No_banned_email'] = 'Nincsen letiltott email-cím';

$lang['Ban_update_sucessful'] = 'A kitiltások listája sikeresen megváltozott!';
$lang['Click_return_banadmin'] = 'Kattints %side%s, hogy visszatérj a Kitiltás beállításaihoz.';


//
// Configuration
//
$lang['General_Config'] = 'Általános beállítások';
$lang['Config_explain'] = 'A Fórum alapvetõ beállításait adhatod meg itt.';

$lang['Click_return_config'] = 'Kattints %side%s, hogy visszatérj az Általános beállításokhoz';

$lang['General_settings'] = 'Általános beállítások';
$lang['Server_name'] = 'Domain név:';
$lang['Server_name_explain'] = 'A domain név, melyen a Fórum fut';
$lang['Script_path'] = 'Fórum elérési útvonal:';
$lang['Script_path_explain'] = 'A phpBB relatív elérési útvonala, a domain névhez képest';
$lang['Server_port'] = 'Szerver port:';
$lang['Server_port_explain'] = 'A használt port, szinte mindig a 80-as.';
$lang['Site_name'] = 'Oldal neve:';
$lang['Site_desc'] = 'Oldal leírása:';
$lang['Board_disable'] = 'Fórum kikapcsolása:';
$lang['Board_disable_explain'] = 'Ha igenre állítod, a felhasználók nem érhetik el a fórumot. Az Adminsztrátorok ettõl függetlenül beléphetnek az Adminisztrációs panelbe.';
$lang['Acct_activation'] = 'Azonosító aktiválása:';
$lang['Acc_None'] = 'Nincs'; // These three entries are the type of activation
$lang['Acc_User'] = 'Felhasználói';
$lang['Acc_Admin'] = 'Adminisztrátori';

$lang['Abilities_settings'] = 'Felhasználó és fórum beállítások';
$lang['Max_poll_options'] = 'Választási lehetõségek maximális száma a szavazásokban:';
$lang['Flood_Interval'] = 'Flood idõköz:';
$lang['Flood_Interval_explain'] = 'Ennyi másodpercet kell várni a két hozzászólás elküldése között.';
$lang['Board_email_form'] = 'Felhasználói levelezés engedélyezése az oldalon keresztül:';
$lang['Board_email_form_explain'] = 'A felhasználók email üzeneteket küldhetnek egymásnak az oldalon keresztül.';
$lang['Topics_per_page'] = 'Témák oldalaként:';
$lang['Posts_per_page'] = 'Hozzászólások oldalanként:';
$lang['Hot_threshold'] = 'Hozzászólások száma téma népszerûként megjelöléséhez:';
$lang['Default_style'] = 'Kezdõsablon:';
$lang['Override_style'] = 'Felhasználó sablonjának felülírása:';
$lang['Override_style_explain'] = 'Ez esetben mindenki csak a kezdõsablont használhatja.';
$lang['Default_language'] = 'Alapbeállítású nyelv:';
$lang['Date_format'] = 'Dátum formátum:';
$lang['System_timezone'] = 'Rendszer idõzóna:';
$lang['Enable_gzip'] = 'GZIP tömörítés bekapcsolása:';
$lang['Enable_prune'] = 'Automatikus karbantartás bekapcsolása:';
$lang['Allow_HTML'] = 'HTML engedélyezése:';
$lang['Allow_BBCode'] = 'BBCode engedélyezése:';
$lang['Allowed_tags'] = 'Engedélyezett HTML tagek:';
$lang['Allowed_tags_explain'] = 'A tageket vesszõvel kell elválasztani.';
$lang['Allow_smilies'] = 'Emotikonok engedélyezése:';
$lang['Smilies_path'] = 'Emotikonok elérési útvonala:';
$lang['Smilies_path_explain'] = 'A phpBB-n belüli elérési út, általában: images/smiles';
$lang['Allow_sig'] = 'Aláírás engedélyezése:';
$lang['Max_sig_length'] = 'Aláírás maximum hossza:';
$lang['Max_sig_length_explain'] = 'Az aláírások maximum hossza karakterben';
$lang['Allow_name_change'] = 'Felhasználónév-váltás engedélyezése:';

$lang['Avatar_settings'] = 'Avatar beállítások';
$lang['Allow_local'] = 'Avatar galéria bekapcsolása:';
$lang['Allow_remote'] = 'Távoli avatar engedélyezése:';
$lang['Allow_remote_explain'] = 'Más weboldalról belinkelt avatarok engedélyezése';
$lang['Allow_upload'] = 'Avatar feltöltés engedélyezése:';
$lang['Max_filesize'] = 'Maximum avatar képméret:';
$lang['Max_filesize_explain'] = 'A feltöltött avatar képek legfeljebb ilyen nagyságúak lehetnek.';
$lang['Max_avatar_size'] = 'Maximum avatar felbontás:';
$lang['Max_avatar_size_explain'] = 'Szélesség x Magasság pixelben';
$lang['Avatar_storage_path'] = 'Avatarok elérési útvonala:';
$lang['Avatar_storage_path_explain'] = 'A phpBB-n belüli elérési út, általában: images/avatars';
$lang['Avatar_gallery_path'] = 'Avatar galéria helye:';
$lang['Avatar_gallery_path_explain'] = 'A phpBB-n belüli elérési út, általában: images/avatars/gallery';

$lang['COPPA_settings'] = 'COPPA beállítások';
$lang['COPPA_fax'] = 'COPPA fax-szám:';
$lang['COPPA_mail'] = 'COPPA levelezési cím:';
$lang['COPPA_mail_explain'] = 'Az a levélcím, ahova a szülõknek a COPPA regisztrációs kérelmeket kell küldeniük.<br />A COPPA-t az Amerikai Egyesült Államokban használják. Lényege, hogy csak a szülõ engedélyével regisztrálhat a Fórumon a 13 éven aluli gyerek (a szülõnek jóvá kell hagynia gyermeke regisztrációját a megadott címre vagy fax-számra küldött nyilatkozattal).';

$lang['Email_settings'] = 'Email beállítások';
$lang['Admin_email'] = 'Az Adminisztrátor email-címe:';
$lang['Email_sig'] = 'Email aláírás:';
$lang['Email_sig_explain'] = 'A fórum által kiküldött levelek végéhez csatolt szöveg';
$lang['Use_SMTP'] = 'SMTP szerver használata emailküldéshez:';
$lang['Use_SMTP_explain'] = 'Kapcsold be, ha egy külsõ email-szervert akarsz használni.';
$lang['SMTP_server'] = 'SMTP szerver címe:';
$lang['SMTP_username'] = 'SMTP felhasználónév:';
$lang['SMTP_username_explain'] = 'Csak akkor töltsd ki, ha szükséges.';
$lang['SMTP_password'] = 'SMTP jelszó:';
$lang['SMTP_password_explain'] = 'Csak akkor töltsd ki, ha szükséges.';

$lang['Disable_privmsg'] = 'Privát üzenetküldés:';
$lang['Inbox_limits'] = 'Üzenetek maximális száma az Érkezett fiókban:';
$lang['Sentbox_limits'] = 'Üzenetek maximális száma az Elküldött fiókban:';
$lang['Savebox_limits'] = 'Üzenetek maximális száma az Mentés fiókban:';

$lang['Cookie_settings'] = 'Cookie beállítások';
$lang['Cookie_settings_explain'] = 'Itt állíthatod be a felhasználók böngészõinek kiküldött cookie-kat. A legtöbb esetben elegendõek az alapbeállítások, így csak óvatosan változtass rajtuk, mert elõfordulhat, hogy a felhasználók nem fognak tudni belépni';
$lang['Cookie_domain'] = 'Cookie domain:';
$lang['Cookie_name'] = 'Cookie neve:';
$lang['Cookie_path'] = 'Cookie elérési út:';
$lang['Cookie_secure'] = 'Cookie titkosítása:';
$lang['Cookie_secure_explain'] = 'Ha a szerver SSL titkosítással fut, akkor kapcsold be ezt az opciót, különben hagyd kikapcsolva.';
$lang['Session_length'] = 'Session hossz [ másodperc ]:';

// Visual Confirmation
$lang['Visual_confirm'] = 'Regisztráció vizuális megerõsítése:';
$lang['Visual_confirm_explain'] = 'A regisztrációnál a felhasználónak be kell írnia egy automatikusan generált vizuális kódot, amivel megerosíti a regisztrációt (robotok regisztrációja ellen).';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Automatikus bejelentkezés engedélyezése:';
$lang['Allow_autologin_explain'] = 'A felhasználók kiválaszthatják-e, hogy automatikusan bejelentkeztesse õket a rendszer a fórum meglátogatáskor.';
$lang['Autologin_time'] = 'Automatkus bejelentkezés lejárata:';
$lang['Autologin_time_explain'] = 'Hány napig érvényes az automatikus bejelentkezéshez szükséges kulcs, ha a felhasználó nem látogatja meg a fórumot. Állítsd 0-ra, hogy soha ne járjon le.';

// Search Flood Control - added 2.0.20 
$lang['Search_Flood_Interval'] = 'Keresés flood idõköz'; 
$lang['Search_Flood_Interval_explain'] = 'Ennyi másodpercet kell várni a két keresés között.';

//
// Forum Management
//
$lang['Forum_admin'] = 'Fórum adminisztráció';
$lang['Forum_admin_explain'] = 'Innen tudsz új fórumot nyitni, törölni, szerkeszteni, átrendezni, kategorizálni és szinkronizálni.';
$lang['Edit_forum'] = 'Fórum szerkesztése';
$lang['Create_forum'] = 'Új fórum';
$lang['Create_category'] = 'Új témakör';
$lang['Remove'] = 'Eltávolít';
$lang['Action'] = 'Utasítás';
$lang['Update_order'] = 'Frissítési sorrend';
$lang['Config_updated'] = 'A Fórum beállításai sikeresen frissültek!';
$lang['Edit'] = 'Szerkeszt';
$lang['Delete'] = 'Töröl';
$lang['Move_up'] = 'Feljebb';
$lang['Move_down'] = 'Lejjebb';
$lang['Resync'] = 'Szinkronizál';
$lang['No_mode'] = 'Nem lett mód kiválasztva!';
$lang['Forum_edit_delete_explain'] = 'Az alábbi oldallal beállíthatod a fórum legfontosabb tulajdonságait. A Fórum és a Felhasználók beállításához használd a baloldali menüt.';

$lang['Move_contents'] = 'Összes tartalom átmozgatása';
$lang['Forum_delete'] = 'Fórum törlése';
$lang['Forum_delete_explain'] = 'Az alábbi oldal segítségével törölhetsz egy fórumot, (vagy kategóriát), megadva, hogy a tartalmazott fórumok (vagy témák) hova kerüljenek át.';

$lang['Status_locked'] = 'Lezárt';
$lang['Status_unlocked'] = 'Nyitott';
$lang['Forum_settings'] = 'Általános fórum beállítások';
$lang['Forum_name'] = 'Fórum neve';
$lang['Forum_desc'] = 'Leírás';
$lang['Forum_status'] = 'Fórum státusz';
$lang['Forum_pruning'] = 'Automatikus karbantartás';

$lang['prune_freq'] = 'Témák ellenõrzése (ennyi naponta):';
$lang['prune_days'] = 'Témák törlése, melyekbe ennyi napig nem érkezett hozzászólás:';
$lang['Set_prune_data'] = 'Az automatikus karbantartás be van kapcsolva, de ehhez a fórumhoz nincsen megadva a karbantartás gyakorisága. Lépj vissza, és állítsd be.';

$lang['Move_and_Delete'] = 'Átmozgatás és törlés';

$lang['Delete_all_posts'] = 'Összes hozzászólás törlése';
$lang['Nowhere_to_move'] = 'Sehova sem lehet áthelyezni.';

$lang['Edit_Category'] = 'Témakör szerkesztése';
$lang['Edit_Category_explain'] = 'Ezzel a témakör nevét változtathatod meg.';

$lang['Forums_updated'] = 'A fórum és témakör beállításai sikeresen frissültek!';

$lang['Must_delete_forums'] = 'Elõbb az összes fórumot törölnöd kell, hogy törölhesd ezt a kategóriát.';

$lang['Click_return_forumadmin'] = 'Kattints %side%s, hogy visszatérj a Fórum beállításaihoz.';


//
// Smiley Management
//
$lang['smiley_title'] = 'Emotikon beállítások';
$lang['smile_desc'] = 'Ezen az oldalon adhatsz új emotikonokat a fórumhoz, illetve szerkesztheted és törölheted a már meglévõket. Ha a "Törlés" gombra kattintasz, akkor automatikusan törölni fogja, nem kér megerõsítést.';

$lang['smiley_config'] = 'Emotikon beállítása';
$lang['smiley_code'] = 'Emotikon kód:';
$lang['smiley_url'] = 'Emotikon képfájl:';
$lang['smiley_emot'] = 'Jelentés:';
$lang['smile_add'] = 'Új emotikon hozzáadása';
$lang['Smile'] = 'Smiley';
$lang['Emotion'] = 'Emotikon';

$lang['Select_pak'] = 'Emotikon csomagfájl (.pak) kiválasztása';
$lang['replace_existing'] = 'Jelenlegi emotikonok felülírása';
$lang['keep_existing'] = 'Jelenlegi emotikonok megtartása';
$lang['smiley_import_inst'] = 'Töltsd fel az emotikonok könyvtárába a képeket, és az exportálásnál elkészített *.pak fájlt. Utána a megfelelõ adatok megadásával importálható az emotikon csomag.';
$lang['smiley_import'] = 'Emotikonok importálása';
$lang['choose_smile_pak'] = 'Emotikon csomag kiválasztása (.pak fájl)';
$lang['import'] = 'Emotikonok importálása';
$lang['smile_conflicts'] = 'Aktuális emotikonok:';
$lang['del_existing_smileys'] = 'Telepített emotikonok törlése importálás elõtt';
$lang['import_smile_pack'] = 'Emotikon csomag importálása';
$lang['export_smile_pack'] = 'Emotikon csomag exportálása';
$lang['export_smiles'] = 'Az emotikon csomag exportálásához kattints %sIDE%s, hogy letöltsd a smiles.pak fájlt. Ha át akarod nevezni, akkor figyelj arra, hogy a .pak kiterjesztés megmaradjon. Utána a .pak fájlt és az emotikon képeket tömörítsd be egy fájlba.';

$lang['smiley_add_success'] = 'Az emotikon sikeresen bekerült a listába!';
$lang['smiley_edit_success'] = 'Az emotikon beállításai sikeresen megváltoztak!';
$lang['smiley_import_success'] = 'Az emotikon csomag importálása sikeres volt!';
$lang['smiley_del_success'] = 'Az emotikon eltávolítása sikeres volt!';
$lang['Click_return_smileadmin'] = 'Kattints %side%s, hogy visszatérj az emotikonok beállításaihoz';

$lang['Confirm_delete_smiley'] = 'Biztosan törölni akarod ezt az emotikont?';

//
// User Management
//
$lang['User_admin'] = 'Felhasználói beállítások';
$lang['User_admin_explain'] = 'Ezen az oldalon megadhatod, megváltoztathatod a felhasználók adatait, és néhány általános tulajdonságot állíthatsz be. A jogosultságok kiosztásához használd az egyéni- és csoportjogosultság-kezelõ rendszert.';

$lang['Look_up_user'] = 'Felhasználó keresése';

$lang['Admin_user_fail'] = 'A felhasználó profiljának frissítése sikertelen volt.';
$lang['Admin_user_updated'] = 'A felhasználó profilja sikeresen módosult!';
$lang['Click_return_useradmin'] = 'Kattints %side%s, hogy visszatérj a Felhasználó beállításokhoz';

$lang['User_delete'] = 'Felhasználó törlése';
$lang['User_delete_explain'] = 'Jelöld be, ha törölni akarod a felhasználót. A törlés után nem lehet visszahozni!';
$lang['User_deleted'] = 'A felhasználó sikeresen törölve lett.';

$lang['User_status'] = 'Aktív felhasználó';
$lang['User_allowpm'] = 'Küldhet privát üzenetet';
$lang['User_allowavatar'] = 'Beállíthat avatart';

$lang['Admin_avatar_explain'] = 'Itt nézheted meg, és törölheted a felhasználó avatarját.';

$lang['User_special'] = 'Speciális beálíltások';
$lang['User_special_explain'] = 'A felhasználók nem módosíthatják ezeket a mezõket.';


//
// Group Management
//
$lang['Group_administration'] = 'Csoportok beállítása';
$lang['Group_admin_explain'] = 'Ezzel az oldallal kezelni tudod a Csoportokat, törölheted, módosíthatod õket, és újakat készíthetsz. Válaszhatsz moderátort a csoporthoz, megadhatod, hogy nyílt vagy zárt csoport legyen-e, megadhatod a csoport nevét és leírását.';
$lang['Error_updating_groups'] = 'A frissítés közben hiba történt.';
$lang['Updated_group'] = 'A csoport sikeresen frissült!';
$lang['Added_new_group'] = 'A csoport sikeresen elkészült!';
$lang['Deleted_group'] = 'A csoport sikeresen törölve lett!';
$lang['New_group'] = 'Új csoport';
$lang['Edit_group'] = 'Csoport szerkesztése';
$lang['group_name'] = 'Csoport neve';
$lang['group_description'] = 'Csoport leírása';
$lang['group_moderator'] = 'Csoport moderátor';
$lang['group_status'] = 'Csoport státusz';
$lang['group_open'] = 'Nyitott csoport';
$lang['group_closed'] = 'Zárt csoport';
$lang['group_hidden'] = 'Rejtett csoport';
$lang['group_delete'] = 'Csoport törlése';
$lang['group_delete_check'] = 'Csoport törlése';
$lang['submit_group_changes'] = 'Változások elküldése';
$lang['reset_group_changes'] = 'Változások törlése';
$lang['No_group_name'] = 'Meg kell adnod egy csoportnevet.';
$lang['No_group_moderator'] = 'Adj meg egy Moderátort a csoportnak!';
$lang['No_group_mode'] = 'Meg kell határoznod, hogy nyitott vagy zárt csoport legyen-e.';
$lang['No_group_action'] = 'Nem határoztál meg utasítást.';
$lang['delete_group_moderator'] = 'Régi moderátor törlése?';
$lang['delete_moderator_explain'] = 'Ha meg akarod változtatni a csoport moderátorát, és törölni akarod a régit, akkor jelöld be. Ha nem jelölöd be, akkor a felhasználó sima tag lesz a csoportban.';
$lang['Click_return_groupsadmin'] = 'Kattints %side%s, hogy visszatérj a Csoportok beállításaihoz.';
$lang['Select_group'] = 'Csoport kiválasztása';
$lang['Look_up_group'] = 'Csoport keresése';


//
// Prune Administration
//
$lang['Forum_Prune'] = 'Fórum karbantartás';
$lang['Forum_Prune_explain'] = 'A Fórum karbantartás minden olyan témát automatikusan töröl, ahova a megadott idõn belül nem érkezik hozzászólás. Ha nem adsz meg idõt. akkor az összes téma törlõdik. Ezzel nem lehet törölni azokat a témákat, ahol aktív szavazás van érvényben, vagy azokat, melyek a kiemelt közlemények kategóriába tartoznak. Ezeket kézzel kell törölnöd.';
$lang['Do_Prune'] = 'Karbantartás indítása';
$lang['All_Forums'] = 'Összes fórum';
$lang['Prune_topics_not_posted'] = 'Témák karbantartása, ahova ennyi ideig nem érkezett új hozzászólás.';
$lang['Topics_pruned'] = 'A témák karbantartása befejezõdtt.';
$lang['Posts_pruned'] = 'A hozzászólások karbantartása befejezõdtt.';
$lang['Prune_success'] = 'A Fórum karbantartása sikeresen befejezõdött!';


//
// Word censor
//
$lang['Words_title'] = 'Cenzúra';
$lang['Words_explain'] = 'Ezzel az oldallal olyan szavakat adhatsz meg (szerkeszthetsz, vehetsz el), melyeket automatikusan cenzúráz a fórum. Ezekkel a szavakkal (vagy ilyen szavakat tartalmazó szavakkal) nem regisztrálhatnak új fehasználót. A * jokerkarakter használható, pld. az *lap*-ra az alaplap szó is cenzúrázva lesz, a lap*-ra a lapszám, és a *lap-ra a fõlap szavak is.';
$lang['Word'] = 'Szó';
$lang['Edit_word_censor'] = 'Cenzúrázási szabály szerkesztése';
$lang['Replacement'] = 'Helyettes';
$lang['Add_new_word'] = 'Új szó hozzáadása';
$lang['Update_word'] = 'Cenzúrázási szabály frissítése';

$lang['Must_enter_word'] = 'Meg kell adnod egy szavat és a helyettesítését.';
$lang['No_word_selected'] = 'Nem választottál ki szót.';

$lang['Word_updated'] = 'A kiválaszott cenzúrázási szabály sikeresen frissült!';
$lang['Word_added'] = 'Cenzúrázási szabály sikeresen felvéve!';
$lang['Word_removed'] = 'A kiválasztott cenzúrázási szabály sikeresen törölve lett!';

$lang['Click_return_wordadmin'] = 'Kattints %side%s, hogy visszatérj a Cenzúra beállításaihoz.';

$lang['Confirm_delete_word'] = 'Biztosan törölni akarod ezt a cenzúrázási szabályt?';

//
// Mass Email
//
$lang['Mass_email_explain'] = 'A Csoportos levél opcióval egy emailt küldhetsz minden felhasználónak, vagy egy adott csoport összes felhasználójának. Az email az adminisztrátori címre postázódik, és egy titkos másolatot kap az összes felhasználó. Ha sok emberrõl van szó, akkor a levélküldés eltarthat egy darabig, ne szakítsd meg a program futását közben. Amint végzett, az oldal értesít errõl.';
$lang['Compose'] = 'Levélírás';

$lang['Recipients'] = 'Címzett';
$lang['All_users'] = 'Összes felhasználó';

$lang['Email_successfull'] = 'Üzenet elküldve!';
$lang['Click_return_massemail'] = 'Kattints %side%s, hogy visszatérj a Csoportos email menüponthoz.';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Rangok beállítása';
$lang['Ranks_explain'] = 'Itt állíthatod be a rangokat; hozzáadás, szerkesztés, megtekintés és törlés. Ezenkívül saját rangsort is készíthetsz, melyeket a felhasználók beállításánál hozzárendelhetsz egyes felhasználókhoz.';

$lang['Add_new_rank'] = 'Új rang hozzáadása';

$lang['Rank_title'] = 'Rang neve';
$lang['Rank_special'] = 'Speciális rang';
$lang['Rank_minimum'] = 'Minimum hozzászólások száma';
$lang['Rank_maximum'] = 'Maximum hozzászólások száma';
$lang['Rank_image'] = 'Rang képének elérési útvonala (relatív elérési út, a phpBB gyökérkönyvtárától)';
$lang['Rank_image_explain'] = 'A rangot reprezentáló kép';

$lang['Must_select_rank'] = 'Ki kell választanod egy rangot.';
$lang['No_assigned_rank'] = 'Nincsen speciális rang.';

$lang['Rank_updated'] = 'A rang sikeresen megváltozott!';
$lang['Rank_added'] = 'Rang sikeresen felvéve!';
$lang['Rank_removed'] = 'Rang sikeresen törölve!';
$lang['No_update_ranks'] = 'A rang sikeresen törölve lett, bár a felhasználói azonosítók nem frissültek. Ezt kézzel kell megtenned ezeken az azonosítókon';

$lang['Click_return_rankadmin'] = 'Kattints %side%s hogy visszaérj a Rangok beállításaihoz.';

$lang['Confirm_delete_rank'] = 'Biztosan törölni akarod ezt a rangot?';

//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Tiltott felhasználónevek beállítása';
$lang['Disallow_explain'] = 'Itt állíthatod be azokat a felhasználóneveket, melyek nem regisztrálhatóak. Használható a * jokerkarakter. Nem adhatsz meg olyan szót, amelyet már használ valaki, ehhez elõször ki kell törölnöd a felhasználót, és utána tilthatod le.';

$lang['Delete_disallow'] = 'Törlés';
$lang['Delete_disallow_title'] = 'Tiltott felhasználónév törlése:';
$lang['Delete_disallow_explain'] = 'Tiltott felhasználónév törlése. Jelöld ki és kattints a Törlés gombra.';

$lang['Add_disallow'] = 'Hozzáadás';
$lang['Add_disallow_title'] = 'Tiltott felhasználónév hozzáadása:';
$lang['Add_disallow_explain'] = 'Használhatod a * jokerkaraktert.';

$lang['No_disallowed'] = 'Nincsenek letiltott felhasználónevek.';

$lang['Disallowed_deleted'] = 'A letiltott felhasználónevet töröltem!';
$lang['Disallow_successful'] = 'A letiltott felhasználónév hozzáadása sikerült!';
$lang['Disallowed_already'] = 'A beírt felhasználónevet nem lehet letiltani; vagy már létezik a listában, vagy létezik a cenzúrázott szavak között, esetleg van ilyen nevû felhasználó.';

$lang['Click_return_disallowadmin'] = 'Kattints %side%s, hogy visszatérj a Tiltott felhasználónevek beállításaihoz';


//
// Styles Admin
//

$lang['Styles_admin'] = 'Stílus beállítások';
$lang['Styles_explain'] = 'Ezen az oldalon felvehetsz, törölhetsz, beállíthatsz stílusokat (sablonokat és témákat).';
$lang['Styles_addnew_explain'] = 'A következõ lista a még nem telepített témákat tartalmazza a jelenlegi sablonaidhoz. A telepítéshez kattints a név melletti "Új telepítés" linkre';

$lang['Select_template'] = 'Válassz egy sablont';

$lang['Style'] = 'Stílus';
$lang['Template'] = 'Sablon';
$lang['Install'] = 'Telepít';
$lang['Download'] = 'Letölt';

$lang['Edit_theme'] = 'Téma szerkesztése';
$lang['Edit_theme_explain'] = 'Az alábbi ûrlap segítségével a kiválasztott téma beállításait változtathatod meg.';

$lang['Create_theme'] = 'Téma készítése';
$lang['Create_theme_explain'] = 'Az alábbi ûrlap segítségével új témákat készíthetsz a jelenlegi sablonaidhoz. A szín megadásánál ne használd a # karaktert. A CCCCCC helyes, a #CCCCCC hibás.';

$lang['Export_themes'] = 'Témák exportálása';
$lang['Export_explain'] = 'Ennek az oldalnak a segítségével egy sablonhoz tartozó téma adatait exportálhatod ki. Válaszd ki a sablont az alábbi listából, és az oldal elkészíti a téma konfigurációs fájlját, és megpróbálja elmenteni a kiválasztott sablon könyvtárba. Ha nem lehet elmenteni (nem írható a könyvtár, ezt a webszerveren tudod beállítani), akkor töltsd le, és kézzel másold be.';

$lang['Theme_installed'] = 'A kiválasztott téma telepítése sikeresen megtörtént.';
$lang['Style_removed'] = 'A kiválaszott stílus sikeresen törölve lett az adatbázisból. A teljes törléshez a phpBB templates/ könyvtárából is távolítsd el.';
$lang['Theme_info_saved'] = 'A kiválasztott sablonhoz tartózó téma információ sikeresen el lett mentve. Változtasd meg a theme_info.cfg jogosultságait csak olvashatóra (ajánlott az egész sablon könyvtárát is csak olvashatóra átállítani).';
$lang['Theme_updated'] = 'A kiválaszott téma frissült. Most már exportálhatod az új téma beállításait.';
$lang['Theme_created'] = 'A téma elkészült. Most már exportálhatod a konfigurációs fájlba, hogy biztonságosan legyen tárolva.';

$lang['Confirm_delete_style'] = 'Biztosan törölni akarod ezt a stílust?';

$lang['Download_theme_cfg'] = 'A téma információ fájlt nem lehet írni. Kattints az alábbi gombra, hogy letöltsd, és utána másold be abba a könyvtárba, ahol a sablon fájlok vannak.';
$lang['No_themes'] = 'A kiválasztott sablonhoz nem tartozik téma. Új téma készítéséhez kattints a Hozzáadásra a bal oldalon.';
$lang['No_template_dir'] = 'Nem lehet megnyitni a sablon könyvtárat. Vagy nem olvasható, vagy nem létezik.';
$lang['Cannot_remove_style'] = 'Nem törölheted ezt a stílust, mivel ez az alapbeállítású. Menj vissza és válassz egy másikat.';
$lang['Style_exists'] = 'A kiválasztott stílus neve már létezik, menj vissza és adj meg egy másik nevet.';

$lang['Click_return_styleadmin'] = 'Kattints %side%s, hogy visszatérj a Stílus beállításokhoz.';

$lang['Theme_settings'] = 'Téma beállítások';
$lang['Theme_element'] = 'Téma elem';
$lang['Simple_name'] = 'Magyarázat';
$lang['Value'] = 'Érték';
$lang['Save_Settings'] = 'Beállítások elmentése';

$lang['Stylesheet'] = 'CSS stíluslap';
$lang['Stylesheet_explain'] = 'A témához használt CSS stíluslap fájlneve.';
$lang['Background_image'] = 'Háttérkép';
$lang['Background_color'] = 'Háttérszín';
$lang['Theme_name'] = 'Téma neve';
$lang['Link_color'] = 'Linkek színe';
$lang['Text_color'] = 'Szövegszín';
$lang['VLink_color'] = 'Meglátogatott linkek színe';
$lang['ALink_color'] = 'Aktív linkek színe';
$lang['HLink_color'] = 'Link színe, ha felette van az egér';
$lang['Tr_color1'] = 'Táblázat sor elsõ színe';
$lang['Tr_color2'] = 'Táblázat sor második színe';
$lang['Tr_color3'] = 'Táblázat sor harmadik színe';
$lang['Tr_class1'] = 'Táblázat sor elsõ osztálya';
$lang['Tr_class2'] = 'Táblázat sor második osztálya';
$lang['Tr_class3'] = 'Táblázat sor harmadik osztálya';
$lang['Th_color1'] = 'Táblázat fejléc elsõ színe';
$lang['Th_color2'] = 'Táblázat fejléc második színe';
$lang['Th_color3'] = 'Táblázat fejléc harmadik színe';
$lang['Th_class1'] = 'Táblázat fejléc elsõ osztálya';
$lang['Th_class2'] = 'Táblázat fejléc második osztálya';
$lang['Th_class3'] = 'Táblázat fejléc harmadik osztálya';
$lang['Td_color1'] = 'Elsõ cellaszín';
$lang['Td_color2'] = 'Második cellaszín';
$lang['Td_color3'] = 'Harmadik cellaszín';
$lang['Td_class1'] = 'Elsõ cellaosztály';
$lang['Td_class2'] = 'Második cellaosztály';
$lang['Td_class3'] = 'Harmadik cellaosztály';
$lang['fontface1'] = 'Elsõ betûtípus';
$lang['fontface2'] = 'Második betûtípus';
$lang['fontface3'] = 'Harmadik betûtípus';
$lang['fontsize1'] = 'Elsõ betûméret';
$lang['fontsize2'] = 'Második betûméret';
$lang['fontsize3'] = 'Harmadik betûméret';
$lang['fontcolor1'] = 'Elsõ betûszín';
$lang['fontcolor2'] = 'Második betûszín';
$lang['fontcolor3'] = 'Harmadik betûszín';
$lang['span_class1'] = 'Elsõ span osztály';
$lang['span_class2'] = 'Második span osztály';
$lang['span_class3'] = 'Harmadik span osztály';
$lang['img_poll_size'] = 'Szavazás képe [px]';
$lang['img_pm_size'] = 'Privát üzenet státuszképének mérete [px]';


//
// Install Process
//
$lang['Welcome_install'] = 'Üdvözlünk a phpBB 2 telepítõjében!';
$lang['Initial_config'] = 'Alap konfiguráció';
$lang['DB_config'] = 'Adatbázis konfiguráció';
$lang['Admin_config'] = 'Adminisztrátor konfiguráció';
$lang['continue_upgrade'] = 'Miután letöltötted a konfigurációs fájlt, kattints a \'Telepítés folytatása\' gombra, hogy továbbléphess a frissítésben. A konfigurációs fájl feltöltésével várj a frissítés befejezéséig.';
$lang['upgrade_submit'] = 'Frissítés folytatása';

$lang['Installer_Error'] = 'Hiba merült fel a telepítés közben.';
$lang['Previous_Install'] = 'Egy elõzõ verzió már telepítve van.';
$lang['Install_db_error'] = 'Hiba történt az adatbázis frissítésének próbálása közben (feltehetõleg már egyszer megpróbáltad telepíteni a phpBB-t - gyõzõdj meg arról, hogy nincsenek táblák az adatbázisban megadott elõtaggal, ha vannak töröld õket, vagy változtasd meg a tábla elõtagot).';

$lang['Re_install'] = 'Egy régebben telepített phpBB fórum még aktív.<br /><br />Ha újra akarod telepíteni a phpBB 2-t, kattints az alábbi gombra. Figyelem! Ezzel a jelenlegi adatbázis elveszik, nem készül róla másolat. Az elõzõ fórumhoz tartozó adminisztrátori felhasználónév és jelszó is elveszik!<br /><br />Gondold át, mielõtt az Igen gombra kattintasz!';

$lang['Inst_Step_0'] = 'Köszönjük, hogy a phpBB-t választottad. A telepítés megkezdéséhez töltsd ki az alábbi mezõket. Emlékeztetõül, figyelj arra, hogy a megadott adatbázis már létezhet a szerveren, vigyázz, hogy ne írd felül. Ha ODBC-t vagy MS Access-t használó adatbázist használsz, akkor elõbb készíts egy DSN-t, mielõtt folytatnád a telepítést.';

$lang['Start_Install'] = 'Telepítés megkezdése';
$lang['Finish_Install'] = 'Telepítés befejezése';

$lang['Default_lang'] = 'A fórum nyelve';
$lang['DB_Host'] = 'Az adatbázis szerver hosztneve / DSN';
$lang['DB_Name'] = 'Az adatbázis neve';
$lang['DB_Username'] = 'Adatbázis felhasználónév';
$lang['DB_Password'] = 'Adatbázis jelszó';
$lang['Database'] = 'Az adatbázis';
$lang['Install_lang'] = 'A telepítés nyelve';
$lang['dbms'] = 'Az adatbázis típusa';
$lang['Table_Prefix'] = 'A táblák elõtagja';
$lang['Admin_Username'] = 'Adminisztrátor felhasználónév';
$lang['Admin_Password'] = 'Adminisztrátor jelszó';
$lang['Admin_Password_confirm'] = 'Adminisztrátor jelszó [ Megerõsítés ]';

$lang['Inst_Step_2'] = 'A telepítés sikeresen befejezõdött, és az adminisztrátor azonosító is elkészült. Miután a Telepítés befejezése gombra kattintottál, töröld le a phpBB könyvtárból a "contrib" és az "install" könyvtárakat. Indítsd a fórumot, ahol a belépés után az Adminisztrációs felületen keresztül beállíthatod a fórumot, elsõsorban az Általános beállításokra ügyelve. Köszönjük, hogy a phpBB 2-t választottad.';

$lang['Unwriteable_config'] = 'A konfigurációs fájlt jelenleg nem lehet írni, valószínûleg írás-olvasási jogosultság probléma miatt. A fájl egy másolata letölthetõ, ha az alábbi linkre kattintasz. Ezt kézzel töltsd fel a phpBB 2 gyökérkönyvtárába. Ezután lépj be az elõbb megadott adminisztrátor felhasználónévvel és jelszóval a Fórumba, ahol a Fórum adminisztrációra kattintva beállíthatod a Fórum többi fontos elemét, elsõsorban az Általános beállítást. Köszönjük, hogy a phpBB 2-t választottad.';
$lang['Download_config'] = 'Beállítás letöltése';

$lang['ftp_choose'] = 'Válassz letöltési módot';
$lang['ftp_option'] = '<br />Mivel a PHP ezen verziója már képes kezelni az FTP-ket, így lehetõség van a konfigurációs fájl FTP-n keresztüli feltöltésére.';
$lang['ftp_instructs'] = 'FTP-n keresztüli phpBB feltöltést választottál. Ehhez add meg az alábbi mezõkbe az FTP hozzáférésének adatait.';
$lang['ftp_info'] = 'FTP információk bevitele';
$lang['Attempt_ftp'] = 'Konfigurációs fájl FTP-n keresztüli feltöltése';
$lang['Send_file'] = 'phpBB feltöltése kézzel';
$lang['ftp_path'] = 'phpBB 2 FTP elérési útja';
$lang['ftp_username'] = 'FTP felhasználónév';
$lang['ftp_password'] = 'FTP jelszó';
$lang['Transfer_config'] = 'Adatátvitel megkezdése';
$lang['NoFTP_config'] = 'A konfigurációs fájl FTP-n keresztüli átvitele sikertelen volt. Töltsd le innen a fájlt, és kézzel kelyezd el az FTP-re.';

$lang['Install'] = 'Új telepítés';
$lang['Upgrade'] = 'Frissítés';


$lang['Install_Method'] = 'Telepítés módja';

$lang['Install_No_Ext'] = 'A szerveren futó PHP beállítás nem támogatja a kiválasztott adatbázis típust.';

$lang['Install_No_PCRE'] = 'A phpBB2-höz PCRE (Perl-Compatible Regular Expressions) modul szükséges, mely nem található meg a PHP ezen verziójában!';

//
// Version Check
//
$lang['Version_up_to_date'] = 'A phpBB-d a legfrissebb, nem érhetõ el újabb verzió.';
$lang['Version_not_up_to_date'] = 'A phpBB-d <b>nem</b> a legfrissebb verziójú! A frissítés elérhetõ a <a href="http://www.phpbb.com/downloads.php" target="_phpBB">phpBB</a>, vagy a <a href="http://download.phpbb.hu" target="_hunphpBB">Magyar phpBB közösség</a> oldalán.';
$lang['Latest_version_info'] = 'A phpBB legfrissebb elérhetõ verziója a <b>phpBB %s</b>.';
$lang['Current_version_info'] = 'Jelenlegi fórumod verziója: <b>phpBB %s</b>.';
$lang['Connect_socket_error'] = 'Nem sikerült csatlakozni a phpBB szerverhez, a következõ hiba lépett fel:<br />%s';
$lang['Socket_functions_disabled'] = 'A socket funkciók nem engedélyezettek.';
$lang['Mailing_list_subscribe_reminder'] = 'Hogy mindig azonnal értesülj a phpBB frissítéseirõl, <a href="http://www.phpbb.com/support/" target="_maillist">iratkozz fel a hírlevelünkre</a>.';
$lang['Version_information'] = 'Verzió információ';

//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Engedélyezett belépési kísérletek száma';
$lang['Max_login_attempts_explain'] = 'Legfeljebb ennyiszer próbálkozhat belépni a felhasználó.';
$lang['Login_reset_time'] = 'Belépés zárolásának ideje';
$lang['Login_reset_time_explain'] = 'Ennyi percet kell várnia a felhasználónak, hogy beléphessen, miután túllépte az engedélyezett belépési kísérletek számát.';

//
// That's all Folks!
// -------------------------------------------------

?>