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
$lang['Rules_attach_can'] = '<b>Csatolhat</b> f�jlokat ebben a f�rumban';
$lang['Rules_attach_cannot'] = '<b>Nem</b> csatolhat f�jlokat ebben a f�rumban';
$lang['Rules_download_can'] = '<b>Let�lthet</b> f�jlokat ebb�l a f�rumb�l';
$lang['Rules_download_cannot'] = '<b>Nem</b> t�lthet le f�jlokat ebb�l a f�rumb�l';
$lang['Sorry_auth_view_attach'] = 'Sajnos az �n sz�m�ra nem enged�lyezett a csatolm�ny megtekint�se vagy let�lt�se.';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'C�m'; // used in Administration Panel too...
$lang['Downloaded'] = 'Let�ltve';
$lang['Download'] = 'Let�lt�s'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'F�jl m�rete';
$lang['Viewed'] = 'Megtekintve';
$lang['Download_number'] = '%d alkalommal'; // replace %d with count
$lang['Extension_disabled_after_posting'] = 'A \'%s\' kiterjeszt�st az Adminisztr�tor nem enged�lyezte, enn�l fogva a csatolm�ny nem lesz megjelen�tve.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Csatolm�nyok Vez�rl�pult';
$lang['Attach_posting_cp_explain'] = 'Ha a Csatolm�ny Hozz�ad�s�ra kattint, megjelenik egy r�sz mely seg�ts�g�vel csatolhat dolgokat.<br />Ha az Csatolt �llom�nyokra kattint, a m�r csatolt f�jlok list�j�t tekintheti meg �s szerkesztheti.<br />Ha friss�teni akar egy csatolm�nyt mindk�t linkre kattintson r�. V�lassza ki a csatolm�nyt, mint egy�bk�nt, de ezut�n ne a Csatol gombra, hanem az �j Verzi� Felt�lt�s�re kattintson a Csatolt �llom�nyok list�j�ban a megfelel� f�jln�l.';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Csatol';
$lang['Add_attachment_title'] = 'Csatolm�ny hozz�ad�sa';
$lang['Add_attachment_explain'] = 'Ha nem akar semmit se csatolni a hozz�sz�l�s�hoz, hagyja �resen ezt a r�szt.';
$lang['File_name'] = 'F�jl neve';
$lang['File_comment'] = 'C�m';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'Csatolt �llom�nyok';
$lang['Options'] = 'Be�ll�t�sok';
$lang['Update_comment'] = 'C�m friss�t�se';
$lang['Delete_attachments'] = 'Csatolm�nyok t�rl�se';
$lang['Delete_attachment'] = 'Csatolm�ny t�rl�se';
$lang['Delete_thumbnail'] = 'Kis k�p t�rl�se';
$lang['Upload_new_version'] = '�j verzi� felt�lt�se';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = '%s egy hib�s f�jln�v.'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'A csatolm�ny t�l nagy.<br />Nem hat�rozhat� meg a PHP-ben defini�lt maximum f�jlm�ret.<br />A Csatolm�ny Modul nem tudja fel�l�rni a php.ini-ben meghat�rozott maximum felt�lt�si m�retet.';
$lang['Attachment_php_size_overrun'] = 'A csatolm�ny t�l nagy.<br />Maximum F�jl M�ret: %d MB.<br />Ez a php.ini-ben van meghat�rozva, ez�rt a Csatolm�ny Modul se tudja fel�l�rni.'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = 'A %s kiterjeszt�s nem enged�lyezett'; // replace %s with extension (e.g. .php) 
$lang['Disallowed_extension_within_forum'] = 'Az �n sz�m�ra nem enged�lyezett %s kiterjeszt�s� f�jlok csatol�sa ebbe a f�urmba.'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'A csatolm�ny t�l nagy.<br />Maximum M�ret: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = 'Sajnos a csatolm�nyoknak sz�nt hely betelt. L�pjen kapcsolatba az Adminisztr�torral.';
$lang['Too_many_attachments'] = 'Az �llom�ny nem csatolhat�, t�l sok (%d db.) csatolm�ny van a hozz�sz�l�sban.'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'A csatolm�nynak/k�pnek %d pixeln�l keskenyebbnek, �s %d pixeln�l alacsonyabbnak kell lennie.'; 
$lang['General_upload_error'] = 'Felt�lt�si hiba: Nem siker�lt felt�lteni a csatolm�ny a k�vetkez� helyre: %s.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = 'Nem hagyhatja �resen a Csatolm�ny Hozz�ad�sa mez�t.';
$lang['Error_missing_old_entry'] = 'Nem siker�lt friss�teni a csatolm�nyt, nem tal�lhat� a r�gi csatolm�nyok jegyz�ke.';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = 'A priv�t �zenet mapp�j�ban l�v� csatolm�nyok m�rete el�rte az enged�lyezettet. K�rj�k t�r�lj�n n�h�ny �rkezett/elk�ld�tt csatolm�nyt.';
$lang['Attach_quota_receiver_pm_reached'] = '\'%s\' priv�t �zenet mapp�j�ban l�v� csatolm�nyok m�rete el�rte az enged�lyezettet. K�rj�k tudassa ezt vele, vagy v�rjon m�g nem t�rli ki n�h�ny csatolm�ny�t.';

// Errors -> Download
$lang['No_attachment_selected'] = 'Nem v�lasztott ki csatolm�nyt, hogy let�ltse vagy megn�zze.';
$lang['Error_no_attachment'] = 'A kiv�lasztott csatolm�ny nem l�tezik.';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Biztos, hogy t�r�lni akarja a kiv�lasztott csatolm�nyokat?';
$lang['Deleted_attachments'] = 'A kiv�lasztott csatolm�nyok sikeresen t�r�lve lettek.';
$lang['Error_deleted_attachments'] = 'Nem siker�lt a csatolm�nyok t�rl�se.';
$lang['Confirm_delete_pm_attachments'] = 'Biztos, hogy az ebben a priv�t �zenetben l�v� �sszes csatolm�nyt t�r�lni akarja?';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'A csatol�si funkci� ki van kapcsolva.';

$lang['Directory_does_not_exist'] = 'A \'%s\' k�nyvt�r nem l�tezik, vagy nem tal�lhat�.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'K�rj�k ellen�rizze, hogy \'%s\' egy k�nyvt�r-e.'; // replace %s with directory
$lang['Directory_not_writeable'] = 'Meg kell hat�roznia a felt�lt�si k�nyvt�r el�r�si �tj�t �s ezt 777-re chmod-ozni (vagy a http szervere tulajdons�gait megv�ltoztatni), hogy fel tudjon t�lteni f�jlokat.<br />Ha ftp hozz�f�r�ssel rendelkezik �ll�tsa �t a k�nyvt�r jogosults�gait (Change Attributes) rwxrwxrwx-re.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'Nem siker�lt csatlakozni az FTP szerverhez: \'%s\'. K�rj�k ellen�rizze az FTP be�ll�t�sait.';
$lang['Ftp_error_login'] = 'Nem siker�lt bel�pni az FTP szerverre. A \'%s\' felhaszn�l�n�v, vagy a jelsz� rossz. K�rj�k ellen�rizze az FTP be�ll�t�sait.';
$lang['Ftp_error_path'] = 'Nem siker�lt hozz�f�rni az ftp k�nyvt�rhoz: \'%s\'. K�rj�k ellen�rizze az FTP be�ll�t�sait.';
$lang['Ftp_error_upload'] = 'Nem siker�lt felt�lteni a f�jlokat az ftp k�nyvt�rba: \'%s\'. K�rj�k ellen�rizze az FTP be�ll�t�sait.';
$lang['Ftp_error_delete'] = 'Nem siker�lt t�r�lni a f�jlokat az ftp k�nyvt�rban: \'%s\'. K�rj�k ellen�rizze az FTP be�ll�t�sait.<br />A hiba m�sik oka a csatolm�ny nem l�tez�se lehet, k�rj�k ezt ellen�rizze az �rny�k csatolm�nyokban.';
$lang['Ftp_error_pasv_mode'] = 'Nem siker�lt ki-/bekapcsolni az FTP passz�v m�dot.';

// Attach Rules Window
$lang['Rules_page'] = 'Csatolm�ny szab�lyok';
$lang['Attach_rules_title'] = 'Enged�lyezett kiterjeszt�sek csoportjai �s m�reteik';
$lang['Group_rule_header'] = '%s -> Maximum m�ret: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = 'Enged�lyezett kiterjeszt�sek �s m�reteik';
$lang['Note_user_empty_group_permissions'] = 'Megjegyz�s:<br />Norm�l esetben csatolhat f�jlokat ebbe a f�rumba, <br />de mi�ta egyetlen egy kiterjeszt�s sem enged�lyezett, <br />nem tud csatolni semmit. Ha megpr�b�lja,  <br />egy hiba�zenetet kap.<br />';

// Quota Variables
$lang['Upload_quota'] = 'Felt�lt�si kv�ta';
$lang['Pm_quota'] = 'P� kv�ta';
$lang['User_upload_quota_reached'] = 'El�rte a %d %s-os felt�lt�si kv�t�t.'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'Felhaszn�l�i Csatolm�nyok Vez�rl�pult';
$lang['UACP'] = 'Felhaszn�l�i Csatolm�nyok Vez�rl�pult';
$lang['User_uploaded_profile'] = 'Felt�ltve: %s';
$lang['User_quota_profile'] = 'Kv�ta: %s';
$lang['Upload_percent_profile'] = '%d%%';

// Common Variables
$lang['Bytes'] = 'Byte';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';
$lang['Attach_search_query'] = 'Csatolm�ny keres�se';
$lang['Test_settings'] = 'Be�ll�t�sok tesztel�se';
$lang['Not_assigned'] = 'Nincs kijel�lve';
$lang['No_file_comment_available'] = 'A f�jlnak nincs c�me.';
$lang['Attachbox_limit'] = 'A csatolm�nyai t�rhely�nek %d%%-a telt be.';
$lang['No_quota_limit'] = 'Nincs kv�ta limit';
$lang['Unlimited'] = 'Korl�tlan';

?>