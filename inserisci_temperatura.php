<?php

/*$idutene = 29;
$temperatura = 33.3;

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non riuscita");



$query = "UPDATE temperature
            SET temperatura = '$cognome'
            WHERE idutente = '$idutente'";
          
mysqli_query($connection,$query);
mysqli_close($connection);*/

$temperatura = $_GET['temperatura'];
$codice = $_GET['codice'];

print "temperatura = $temperatura\n";
print "codice = $codice\n";

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non riuscita");
$query = "SELECT idutente
          FROM smartcard
          WHERE codice = '$codice'";
$result = mysqli_query($connection,$query);
$data = mysqli_fetch_array($result, MYSQLI_NUM);
if($data[0] > 1) {
    $idutente = $data[0];
    print "idutente = $idutente";

    $query = "UPDATE temperature
            SET temperatura = '$temperatura'
            WHERE idutente = '$idutente'";
    mysqli_query($connection,$query);   
    // nel caso già esiste l'istanza, aggiorna la temperatura 
}
else {
    $idutente = $data["idutente"];

    $query = "INSERT
              INTO temperature (idutente, temperatura)
              VALUES ('$idutente','$temperatura')";
    mysqli_query($connection,$query);   
}
mysqli_close($connection);
?>
