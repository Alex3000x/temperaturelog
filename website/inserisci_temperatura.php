<?php

include("database.php");

$temperatura = $_GET['temperatura'];
$codice = $_GET['codice'];

print "temperatura = $temperatura\n";
print "codice = $codice\n";

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non riuscita");
$query = "SELECT idutente
          FROM badge
          WHERE codice = '$codice'";
$result1 = mysqli_query($connection,$query);
$data = mysqli_fetch_array($result1);
if(mysqli_num_rows($result1) != 0)
{
    	$idutente = $data[0];
    	print "idutente = $idutente";
        
        $query = "SELECT *
          FROM temperature AS temp, utenti AS user
          WHERE user.idutente = temp.idutente
          AND temp.idutente = '$idutente'";
		$result2 = mysqli_query($connection,$query);
		$data = mysqli_fetch_array($result2);
        if(mysqli_num_rows($result2) != 0)
        {
        	$query = "UPDATE temperature
                      SET temperatura = '$temperatura'
                      WHERE idutente = '$idutente'";
          	mysqli_query($connection,$query);   
          	// nel caso già esiste l'istanza, aggiorna la temperatura 
        }
        else
        {
        	$query = "INSERT
    		  	  	  INTO temperature (idutente, temperatura)
              	  	  VALUES ('$idutente','$temperatura')";
    		mysqli_query($connection,$query);
    		// nel caso non esiste ancora l'istanza, ne crea una nuova con la temperatura rilevata
        }
}
else
	print "Utente non registrato nel database";
mysqli_close($connection);
?>
