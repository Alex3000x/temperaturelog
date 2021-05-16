  
<?php

$database = "temperaturelog"; // creare db myarduino
$db_table = 'smartcard'; // creare tabella card nel DB myarduino e la chiave cardid di tipo text 
$hostname = "localhost";
$user = "root"; //utente che puo' accedere al db myarduino
$password = "";


mysql_connect($hostname, $user, $password)
or die('Could not connect: ' . mysql_error());

mysql_select_db($database)
or die ('Could not select database ' . mysql_error());

$query = mysql_query("SELECT codice FROM ".$db_table);

$trovato=0;
while((list($cardid) = mysql_fetch_row($query)))
{
//  var_dump($cardid); // DEBUG
if ($_GET['smartcard']==$cardid) $trovato=1;
}

if ($trovato !=0 ) echo "SI"; // messaggio di risposta che nel codice di arduino è citato in if(line.indexOf("SI") > 0)
else echo "NIENTE DA FARE";

?>