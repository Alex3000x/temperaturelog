<h1>temperaturelog</h1>

<h3><b>Cartelle</b></h3>
- website: contiente la struttura web back-end per la gestione di un database contenente gli utenti, i badge associati ad essi e le relative temperature corporee;
<br><br>
- databasescheme: contiene il database-schema SQL da importare;
<br><br>
- embeddedsystem: contiente il codice per il funzionamento del sistema informatico automatizzato per la telerilevazione delle temperature corporee degli utenti che si autenticano tramite badge RFID.
<br><br>

<br><br>
<h3><b>Descrizione sintetica della struttura del sito</b></h3>
Si è cercato di sviluppare la struttura back-end del database attraverso l'uso di più pagine da cui ci si sposta attraverso pulsanti. 
Il nodo iniziale è il file index.html. Al suo interno è presente lo script HTML che costituisce la sezione Home del sito da quale si può navigare verso le altre pagine.
Proprio per questo appena verrà aperto il sito, rimanderà direttamente a una pagina "Home" iniziale dove poi si avrà la panoramica di tutte le funzionalità del sito.

<br><br><br>
<h3><b>Descrizione delle componenti</b></h3>
- database.php: contiente i dati del database (nome server, nome utente, password, nome database) da sostituire opportunamente con i propri posseduti;
<br><br>
- elimina_badge.php: elimina dal database il badge selezionato precedentemente;
<br><br>
- elimina_utente.php: elimina dal database l'utente selezionato precedentemente;
<br><br>
- gestione_badge.html: pagina per la gestione dei badge;
<br><br>
- gestione_temperature.html: pagina per la gestione delle temperature;
<br><br>
- gestione_utenti.html: pagina per la gestione degli utenti;
<br><br>
- index.html: pagina iniziale dove poter scegliere cosa gestire tra utenti, badge e temperature;
<br><br>
- inserisci_badge.php: aggiunge nel database un nuovo badge, avente i dati inseriti precedentemente in inserisci_dati_badge.php;
<br><br>
- inserisci_dati_badge.php: pagina dedicata all'inserimento dei dati di un badge da aggiungere al database;
<br><br>
- inserisci_dati_utente.html: pagina dedicata all'inserimento dei dati di un utente da aggiungere al database;
<br><br>
- inserisci_temperatura.php: aggiunge nel database la temperatura misurata dal dispositivo all'utente autenticato, o l'aggiorna nel caso già esistesse;
<br><br>
- inserisci_utente.php: aggiunge nel database un nuovo utente, avente i dati inseriti precedentemente in inserisci_dati_utente.php;
<br><br>
- lettura.php: verifica nel database l'esistenza del badge letto dal dispositivo di misurazione remoto, inviandogli una risposta dell'esito;
<br><br>
- modifica_badge.php: modifica nel database i dati del badge selezionato con i nuovi dati inseriti precedentemente in modifica_dati_badge.php;
<br><br>
- modifica_dati_badge.php: pagina dedicata all'inserimento di nuovi dati di un badge da aggiornare all'interno del database;
<br><br>
- modifica_dati_utente.php: pagina dedicata all'inserimento di nuovi dati di un utente da aggiornare all'interno del database;
<br><br>
- modifica_utente.php: modifica nel database i dati dell' utente selezionato con i  nuovi dati inseriti precedentemente in modifica_dati_utente.php;
<br><br>
- visualizza_badge.php: pagina che mostra l'elenco di tutti i badge registrati nel database;
<br><br>
- visualizza_temperature.php: pagina che mostra l'elenco di tutte le temperature registrate nel database;
<br><br>
- visualizza_utenti.php: pagina che mostra l'elenco di tutti gli utenti registrati nel database;

<br><br><br>
<b><h3>Installazione</b></h3>
Prima di poter rendere operativa il servizio, è necessario svolgere le seguenti operazioni:
- Modificare il file database.php inserendo le credenziali corrette per l'accesso al database (nome utente, password, hostname e nome del database)
- Importare il file temperaturelog.sql nel proprio DBMS per avere con sé la struttura del database.
N.B. È importante che sia stato precedentemente creato il database vuoto chiamato "temperaturelog" ed importare il file all'interno, poiché la struttura del database da importare contiene esclusivamente le tabelle da creare, altrimenti potrebbero riscontrarsi errori.

<br><br><br>
<b><h3>Ulteriori documenti e collegamenti</b></h3>
Sono presenti immagini, font per una grafica base del sito e documenti vari che descrivono la struttura del database e quella del circuito da realizzare.

<br><br><br>
<b><h3>Contatti</b></h3>
Email: alessio.gurgoglione@gmail.com
<br>
Telefono: //
<br>
Instagram: @ale_gurgo
<br>
Facebook: Alessio Gurgoglione
<br>
