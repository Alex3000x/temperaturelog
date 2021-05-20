  
<?php

$database = "temperaturelog"; // creare db myarduino
//$db_table = 'smartcard'; // creare tabella card nel DB myarduino e la chiave cardid di tipo text 
$hostname = "localhost";
$user = "root"; //utente che puo' accedere al db myarduino
$password = "";


$connection = mysqli_connect($hostname, $user, $password, $database) or die('Could not connect: ' . mysqli_error());

//mysqli_select_db($database) or die ('Could not select database ' . mysqli_error());

$query = "SELECT codice 
          FROM smartcard";

$result = mysqli_query($connection, $query);

$trovato = 0;

print "Carte nel database:";

if(mysqli_num_rows($result) != 0) {
    while((list($cardid) = mysqli_fetch_array($result))) {
        echo $cardid;
        echo "\n";
        if ($_GET['codice'] == $cardid) {
            $trovato = 1;
        }

        if ($trovato == 0) {
            echo " NOT AUTHORIZED ";
        } //messaggio di risposta che nel codice di arduino è citato in if(line.indexOf("SI") > 0)
        else {
            
            break 1;
        }
    }
}



?>