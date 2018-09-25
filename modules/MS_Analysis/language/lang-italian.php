<?php

/************************************************************************************/
/*                                                                                  */
/* Maty Scripts Analysis for PHP-Nuke 6.5-7.9                                       */
/* v2.3                                                                             */
/*                                                                                  */
/* Copyright © 2002-2005 by: Maty Scripts (webmaster@matyscripts.com)               */
/* http://www.matyscripts.com                                                       */
/*                                                                                  */
/* (c) Translation by: ShultZ (admin@newell.it)                                     */
/* http://www.newell.it                                                             */
/*                                                                                  */
/* This program is free software. You can redistribute it and/or modify             */
/* it under the terms of the GNU General Public License as published by             */
/* the Free Software Foundation; either version 2 of the License.                   */
/*                                                                                  */
/************************************************************************************/

/*************************************/
/* MSA v2.2 New Language definitions */
/*************************************/
define("_MSA_UPDATEERROR","Error: Could not update the MSA tables");

/*************************************/
/* MSA v2.1 New Language definitions */
/*************************************/
define("_MSA_SUNDAY","Sunday");
define("_MSA_MONDAY","Monday");
define("_MSA_TUESDAY","Tuesday");
define("_MSA_WEDNESDAY","Wednesday");
define("_MSA_THURSDAY","Thursday");
define("_MSA_FRIDAY","Friday");
define("_MSA_SATURDAY","Saturday");
define("_MSA_TOTALVISITSHOURS","Total Page Visits per Hour");
define("_MSA_TOTALVISITSWEEKDAYS","Total Page Visits per WeekDay" );
define("_MSA_TOTALVISITSMONTHS","Total Page Visits per Month");
define("_MSA_GENAVERAGES","Averages" );
define("_MSA_DAYS","Day" );
define("_MSA_VISITSDAYS","Page Visits per day" );
define("_MSA_POINTS","Points" );
define("_MSA_ADMINFUNCTIONS","User Administration" );
define("_MSA_MSAEDITUSER","Edit User" );
define("_MSA_MSASUSPENDUSER","Suspend User" );
define("_MSA_MSADELETEUSER","Delete User" );
define("_MSA_MSADELETEUSERS","Delete Users" );
define("_MSA_MENUNUKETHEMES","Themes" );
define("_MSA_MENUNUKEDEFTHEME","Default Theme" );
define("_MSA_MENUNUKEINSTTHEMES","Installed Theme(s)" );
define("_MSA_MENUNUKESELECTEDTHEMES","Theme Selection Overview" );
define("_MSA_MENUNUKEUSERTHEMES","Users who selected this theme" );
define("_MSA_ENDISABLE","Enable/Disable the MS-Analysis Module" );
define("_MSA_ENABLED","Enabled" );
define("_MSA_DISABLED","Disabled" );
define("_MSA_DELETEINACTIVEUSR","Delete Inactive Users" );
define("_MSA_DELETEALLINACTIVEUSR1","Delete ALL selected Inactive Users from MSA Users Table" );
define("_MSA_DELETEALLINACTIVEUSR2","Delete ALL selected Inactive Users from MSA <u>AND</u> PHP-Nuke Users Table" );
define("_MSA_SELECTEDINACTIVEUSR","Selected Users" );
define("_MSA_SHOWINACTIVEUSR","Show Users who didn't visit this site since:" );
define("_MSA_INACTIVEUSR","Users who didn't visit this site since:" );
define("_MSA_SEARCHINACTIVEUSR","Search" );
define("_MSA_CLOSE","Close" );
define("_MSA_PAGE1","Page" );
define("_MSA_PAGE2","Select Page" );
define("_MSA_PAGE3","of" );
define("_MSA_PAGE4","Pages" );
define("_MSA_DELINACTIVEMSA","Delete only from MSA Users Table" );
define("_MSA_CDELINACTIVEMSA","Are you sure you want to delete the following User <u>ONLY</u> from the MSA Users Table:" );
define("_MSA_DELINACTIVEMSAPHP","Delete from MSA <u>AND</u> PHP-Nuke Users Table" );
define("_MSA_CDELINACTIVEMSAPHP","Are you sure you want to delete the following User from the MSA <u>AND</u> PHP-Nuke Users Table:" );
define("_MSA_CDELINACTIVESMSA","Are you sure you want to delete <u>ALL</u> selected Users <u>ONLY</u> from the MSA Users Table" );
define("_MSA_CDELINACTIVESMSAPHP","Are you sure you want to delete <u>ALL</u> selected Users from the MSA <u>AND</u> PHP-Nuke Users Table" );

/*************************************/
/* MSA v2.0 New Language definitions */
/*************************************/
define("_MSA_NEWSTATS","Statistiche fino a" );
define("_MSA_SINCE","da" );
define("_MSA_DATAUPDATE","Aggiornamento di tutte le statistiche.<br><br>
                          Si consiglia di selezionare: <i>Statico</i>. In questo modo l'impatto sulle performance del vostro sistema host sarà minimo.<br><br>
                          Se potete configurare il vostro host, scegliete:
                          <i>Statico (Aggiornato da CRON).</i> Consultate il file installation.txt per le istruzioni di configurazione.<br><br>
                          Se la vostra interfaccia non cvi permette di utilizzare i CRON JOBS, scegliete:
                          <i>Statico (Aggiornato da MSA).</i> Le statistiche verranno aggiornate automaticamente ogni ora. Questa opzione non è consigliata per siti ad elevato volume di traffico.<br><br>
                          Se preferite statistiche aggiornate ad ogni singola pagina visitata, scegliete:
                          <i>Dinamico</i>. Tenete presente che ciò può avere un forte impatto sulle prestazioni dell'host." );
define("_MSA_UPDATESTATIC","Statico" );
define("_MSA_UPDATESTATIC1","Statico (Aggiornato da CRON)" );
define("_MSA_UPDATESTATIC2","Statico (Aggiornato da MSA)" );
define("_MSA_UPDATEDYNAMIC","Dinamico" );
define("_MSA_MSAURL","URL del vostro sito, per l'esclusione dalla lista dei referenti" );
define("_MSA_VISITOROVERVIEWGRAPH","Grafici statistici dei visitatori" );
define("_MSA_SCREENTYPE","Pagina di default in MS-Analysis" );
define("_MSA_UP","Ascendente" );
define("_MSA_DOWN","Discendente" );

/*************************************/
/* MSA v1.1 New Language definitions */
/*************************************/
define("_MSA_MSAVERSION","MS-Analysis" );
define("_MSA_SORTONTIME","Tempo" );
define("_MSA_SEARCHIP","Cerca indirizzo IP" );
define("_MSA_NOSUCHIPADDR","Indirizzo IP non presente nel database di MS-Analysis" );
define("_MSA_OVERVIEWPERIODS","Seleziona la visualizzazione temporale" );
define("_MSA_OVERVIEWTODAY","Traffico odierno" );
define("_MSA_OVERVIEWLASTDAYS1","Traffico degli ultimi" );
define("_MSA_OVERVIEWLASTDAYS2","giorni" );
define("_MSA_OVERVIEWALL","Traffico complessivo" );
define("_MSA_VISITSHOURS","Visite orarie per");
define("_MSA_PAGESVIEWED"," pagine visitate");
define("_MSA_HOURS","Ora");
define("_MSA_VISITSMONTHS","Visite mensili per");
define("_MSA_MONTHS","Mese");
define("_MSA_VISITSYEARS","Visite annuali per");
define("_MSA_YEARS","Anno");
define("_MSA_OVERVIEWTYPE","Pagina di riepilogo di MS-Analysis");
define("_MSA_TIMEZONE","Fuso orario");
define("_MSA_GMTHOUR","Ora");
define("_MSA_GMTHOURS","Ore");
define("_MSA_STATSRESET","Reset delle statistiche");
define("_MSA_ADMINOPTIONS","Opzioni");
define("_MSA_SEARCHINFO","Cerca informazioni su un utente");
define("_MSA_RESETTODAY","Reset del traffico odierno?");
define("_MSA_RESETLASTXDATE","Reset del traffico degli ultimi X giorni?");
define("_MSA_USERINFO","Informazioni utente");
define("_MSA_RESETALL", "Sei sicuro di voler resettare TUTTE le tabelle delle statistiche? Tutte le informazioni finora raccolte saranno permanentemente cancellate!");
define("_MSA_SOFAR","finora");
define("_MSA_TABLEPRUNING","Pulizia periodica");
define("_MSA_PRUNINGSETTINGS","Settaggi di pulizia");
define("_MSA_PRUNINGAUTO","Ripulisci le tabelle ogni [xx] giorni automaticamente");
define("_MSA_PRUNINGEVERY","Ogni");
define("_MSA_PRUNINGSTARTFROM","giorni a partire da");
define("_MSA_PRUNINGNOAUTO","Pulizia automatica -DISATTIVATA-");
define("_MSA_PRUNINGYESAUTO","Pulizia automatica -ATTIVATA-");
define("_MSA_PRUNINGMAX","Max");
define("_MSA_PRUNINGLINKS","Links");
define("_MSA_PRUNINGEXPLANATION","Nota: ogni [xx] giorni, le tabelle contenenti più di [tot] links saranno ripulite automaticamente. L'MSA cancellerà per primi i links con 1 sola visita. Se esistono ancora più di [tot] links in una tabella, verranno cancellati i links con 2 visite, ecc.
                                  <br><br><b>Lascia vuoto il relativo campo o inserisci '0', se una tabella non deve essere ripulita anche se la pulizia automatica è attivata.</b>");
define("_MSA_PRUNINGMESSAGE1","Pulizia automatica disattivata");
define("_MSA_PRUNINGMESSAGE2","Pulizia automatica tra");
define("_MSA_PRUNINGMESSAGE3","giorni");

/*********************************/
/* MSA v1.0 Language definitions */
/*********************************/
define("_MSA_ADMIN","Amministrazione");
define("_MSA_WIDTH","Larghezza");
define("_MSA_HEIGHT","Altezza");
define("_MSA_COLORS","Colori");
define("_MSA_HITS","Hits");
define("_MSA_STATS","Statistiche Accessi");
define("_MSA_WERECEIVED","Abbiamo ricevuto");
define("_MSA_PAGESVIEWS","visite da");
define("_MSA_TODAYIS","Oggi è il");
define("_MSA_MOSTMONTH","Mese più impegnato");
define("_MSA_MOSTDAY","Giorno più impegnato");
define("_MSA_MOSTHOUR","Ora più impegnata");
define("_MSA_STATS","Statistiche Accessi");
define("_MSA_TOP","Top");
define("_MSA_DOWNLOADS1", "Attualmente ci sono");
define("_MSA_DOWNLOADS2", "file scaricati");
define("_MSA_DOWNLOADS3", "volte");
define("_MSA_GENTITLE", "Vista Generale TOP-HITS");
define("_MSA_GENCOUNTRIES", "Stati");
define("_MSA_GENBROWSERS", "Browsers");
define("_MSA_GENTYPEBROWSERS", "Browsers per Tipo");
define("_MSA_GENOTHERBROWSERS", "Web Crawlers");
define("_MSA_GENOS", "Sistemi Operativi");
define("_MSA_GENMODULES", "Moduli");
define("_MSA_GENREFERRALS", "Referenti");
define("_MSA_GENSENGINES", "Motori di Ricerca");
define("_MSA_GENQUERIES", "Parole Cercate");
define("_MSA_GENUSERS", "Utenti");
define("_MSA_GENTOTAL", "Totale");
define("_MSA_GENRESOLUTION", "Risoluzioni Schermo");
define("_MSA_MENUPAGEVISITS", "Ultime pagine visitate");
define("_MSA_MENUOVERVIEW", "Vista Generale");
define("_MSA_MENUNUKESTATS", "Statistiche PHP-Nuke");
define("_MSA_ONLINETITLE1", "Ultimo");
define("_MSA_ONLINETITLE2", "Visitatori");
define("_MSA_ONLINEDATE", "Tempo");
define("_MSA_ONLINEUSER", "Utente");
define("_MSA_ONLINEMOD", "Modulo");
define("_MSA_ONLINECOUNTRY", "Stato");
define("_MSA_ONLINEBROWSER", "Browser");
define("_MSA_ONLINEOPSYSTEM", "Sistema Op.");
define("_MSA_ONLINEHOST", "Host");
define("_MSA_ONLINEGUEST", "(Anonimo)");
define("_MSA_DELETE", "Cancella");
define("_MSA_NAME", "Nome");
define("_MSA_SYMBOL", "Simbolo");
define("_MSA_FLAG", "Bandiera");
define("_MSA_HITS", "Hits");
define("_MSA_LASTVISIT", "Ultima volta qui");
define("_MSA_GPAGESVIEWS", "Ultimi 7 giorni");
define("_MSA_RESETTABLE", "Reimposta Tabella");
define("_MSA_DELETETABLE", "Sei sicuro di voler reimpostare questa tabella ? Tutte le statistiche accumulate in questa tabella saranno irrimediabilmente perse !");
define("_MSA_YES", "Sì");
define("_MSA_NO", "No");
define("_MSA_ON", "su");
define("_MSA_RETURNBASICSTATS","Torna alle Statistiche Base");
define("_MSA_BACKTODETSTATS","Torna alle Statistiche Dettagliate");
define("_MSA_BACKTOMAIN","Torna all'Indice");
define("_MSA_MOSTMONTH","Mese di maggior traffico");
define("_MSA_MOSTDAY","Giorno di maggior traffico");
define("_MSA_MOSTHOUR","Ora di maggior traffico");
define("_MSA_YEARLYSTATS","Statistiche Annuali");
define("_MSA_MONTLYSTATS","Statistiche mensili per");
define("_MSA_SPAGESVIEWS","Pagine Visualizzate");
define("_MSA_DAILYSTATS","Statistiche Giornaliere per");
define("_MSA_HOURLYSTATS","Statistiche Orarie per");
define("_MSA_VIEWDETAILED","Guarda Statistiche Dettagliate");
define("_MSA_DATE","Data");
define("_MSA_HOUR","Ora");
define("_MSA_UMONTH","Mese");
define("_MSA_YEAR","Anno");
define("_MSA_JANUARY","Gennaio");
define("_MSA_FEBRUARY","Febbraio");
define("_MSA_MARCH","Marzo");
define("_MSA_APRIL","Aprile");
define("_MSA_MAY","Maggio");
define("_MSA_JUNE","Giugno");
define("_MSA_JULY","Luglio");
define("_MSA_AUGUST","Agosto");
define("_MSA_SEPTEMBER","Settembre");
define("_MSA_OCTOBER","Ottobre");
define("_MSA_NOVEMBER","Novembre");
define("_MSA_DECEMBER","Dicembre");
define("_MSA_TOTMEM"," Totale Membri:");
define("_MSA_REGTODAY","Registrati Oggi");
define("_MSA_REGYESTERDAY","Registrati Ieri");
define("_MSA_ONLINE","Utenti Attualmente Online");
define("_MSA_NAME","Nome");
define("_MSA_MISCSTATS","Statistiche Generali del Sito");
define("_MSA_ACTIVEAUTHORS"," Autori Attivi: ");
define("_MSA_STORIESPUBLISHED"," Storie Pubblicate: ");
define("_MSA_SACTIVETOPICS"," Argomenti Attivi: ");
define("_MSA_SACTIVESTORIES"," Articoli Attivi: ");
define("_MSA_SACTIVECONTENTS"," Contenuti Categorie/Pagine: ");
define("_MSA_COMMENTSPOSTED"," Commenti Inviati: ");
define("_MSA_ARTICLESSEC"," Articoli nelle Sezioni: ");
define("_MSA_LINKSINLINKS"," Links nei Web Links: ");
define("_MSA_LINKSCAT"," Categorie nei Links: ");
define("_MSA_NEWSWAITING"," News in Attesa di essere Pubblicate: ");
define("_MSA_SECTIONS"," Sezioni: ");
define("_MSA_REVIEWS"," Recensioni: ");
define("_MSA_FAQ"," Domande Frequenti (FAQ): ");
define("_MSA_DWNLC"," Numero delle Categorie nei Download: ");
define("_MSA_DWNLSIZE"," MB di dati scaricati: ");
define("_MSA_PAGEVIEWS"," Page Views: ");
define("_MSA_NUKEVERSION"," Versione PHP-Nuke: ");
define("_MSA_VIEW","Mostra Dettagli Utente");
define("_MSA_USRLINE","Dettagli dell'Utente: ");
define("_MSA_COMESFROM","Questo articolo proviene da");
define("_MSA_THEURL","L'URL è:");
define("_MSA_USRFN"," Nome Completo:");
define("_MSA_USRLN"," Username: ");
define("_MSA_USREMAIL"," E-Mail: ");
define("_MSA_USRWWW"," Homepage: ");
define("_MSA_USRUF"," Residenza: ");
define("_MSA_USRIP"," Indirizzo-IP Host: ");
define("_MSA_USRRD"," Data di registrazione: ");
define("_MSA_TOTHITS"," Pagine Visualizzate da ");
define("_MSA_AMOUNTDOWNLOADS"," File scaricabili: ");
define("_MSA_TOTALDOWNLOADS"," Numero Totale Download: ");
define("_MSA_AVIEWS","Numero massimo di celle visualizzabili in:");
define("_MSA_AITEMS","Vista Generale");
define("_MSA_AVIEW","Pagina dei Dettagli");
define("_MSA_AONLINE","Ultime Pagine Visitate");
define("_MSA_SAVE","Salva");
define("_MSA_GOBACK","Indietro" );
define("_MSA_TABLEMAIN","Mantenimento Tabella" );
define("_MSA_SORTON","Ordina per" );
define("_MSA_SORTONID","Id" );
define("_MSA_SORTONHITS","Hits" );
define("_MSA_SORTDIRASC","Ascendente" );
define("_MSA_SORTDIRDESC","Discendente" );
define("_MSA_BACKUP","Backup Database come File SQL" );
define("_MSA_YESTERDAY","Ieri" );
define("_MSA_DAYSAGO","gg fa" );
define("_MSA_SEARCHUSER","Cerca un Utente" );
define("_MSA_NOSUCHUSER","Utente non presente nel Database di MS-Analysis" );
define("_MSA_USERNAME","Nome utente" );
define("_MSA_EMAIL","Indirizzo E-mail" );
define("_MSA_URL","URL" );
define("_MSA_REGDATE","Data di registrazione" );
define("_MSA_OCC","Occupazione" );
define("_MSA_INTREST","Interessi" );
define("_MSA_SIG","Firma" );
define("_MSA_BROWSER","Browser" );
define("_MSA_OS","Sistema operativo" );
define("_MSA_IP","Indirizzo IP" );
define("_MSA_COUNTRY","Luogo" );
define("_MSA_HOST","ISP/Host" );
define("_MSA_TIME","Ultima Visita" );
define("_MSA_HITS","Page Hits" );
define("_MSA_LAST10BBTOPICS","Ultime 10 Discussioni iniziate nel Forum");
define("_MSA_LAST10DOWNLOADS","Ultimi 10 Download inviati da");
define("_MSA_LAST10WEBLINKS","Ultimi 10 Web Link inviati da");
define("_MSA_LAST10COMMENTS","Ultimi 10 Commenti di");
define("_MSA_LAST10SUBMISSIONS","Ultimi 10 Articoli inviati da");
define("_MSA_GENSETTINGS","Impostazioni Generali");
define("_MSA_EXCLUDEIP","Escludi Indirizzi IP");
define("_MSA_EXCLUDEUSERS","Escludi Utenti");
define("_MSA_DEFSE","Definisci Motori di Ricerca");
define("_MSA_ADDEXCLUDEIP","Aggiungi Indirizzo IP da Escludere");
define("_MSA_ADDEXCLUDEUSER","Aggiungi Nome Utente da Escludere");
define("_MSA_WRITEERROR","<b>Impossibile scrivere sul file. Accertarsi di avere permessi di lettura e scrittura per la directory !</b>" );
define("_MSA_ENTERVALUE","Prego, inserire un valore" );
define("_MSA_QUERYID","ID Query di Ricerca" );
define("_MSA_VISITOROVERVIEW","Statistiche Visitatori" );
define("_MSA_SQUERY","Memorizza le ricerche come" );
define("_MSA_SEARCH","<BR>0 = Intera Frase, 1 = Singole Parole" );
define("_MSA_DELETERROR","Il record non può essere cancellato dal database");
define("_MSA_VIEWERROR","Prego, compilare tutti i campi" );
define("_MSA_UPATEERROR","Errore Aggiornamento!" );
define("_MSA_BLOCKCOUNTRY","Top-Ten Stati Visitatori");
define("_MSA_BLOCKONLINE","Ultime 10 pagine visitate");
define("_MSA_BLOCKVIEW","MS-Analysis");