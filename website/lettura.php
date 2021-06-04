  
<?php

include("database.php");

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die('Could not connect: ' . mysqli_error());

//mysqli_select_db($database) or die ('Could not select database ' . mysqli_error());

$query = "SELECT codice 
          FROM badge";

$result = mysqli_query($connection, $query);

$trovato = 0;
;

if(mysqli_num_rows($result) != 0) {
    while((list($cardid) = mysqli_fetch_array($result))) {
        if ("$_GET[codice]" == "$cardid") {
            $trovato = 1;
        }
		print "$cardid";
        if ($trovato == 0) {
            echo " NOT AUTHORIZED ";
        } //messaggio di risposta che nel codice di arduino è citato in if(line.indexOf("SI") > 0)
        else {
            
            break 1;
        }
    }
}



?>