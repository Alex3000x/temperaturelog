<html>
    <head>
        <link rel="icon" href="favicon.ico">
        <link rel = "stylesheet" href="allstyles.css"/>
        <title>temperaturelog</title>
    </head>
    <body>
        <div class="title">
            <img class="logo1" src=./immagini/logo1.png alt=T>
            <h1>emperature</h1>
            <img class="logo2" src=./immagini/logo2.png alt=T>
            <h1 class="og">og</h1>
        </div>
        <h1>SMART CARD</h1><br><br>
        
        
<?php

include("database.php");

error_reporting(0);

$codice = $_POST["codice"];
$idutente = $_POST["idutente"];

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non riuscita");
$query = "SELECT *
          FROM smartcard
          WHERE codice = '$codice'";
$result = mysqli_query($connection,$query);
$data = mysqli_fetch_array($result, MYSQLI_NUM);
if($data[0] > 1) {
    print "
        <h3>Errore di inserimento! ID smart card già registrato nel database</h3>";
}
else {
    $query = "INSERT
                INTO smartcard (idutente, codice)
                VALUES ('$idutente','$codice')";
    mysqli_query($connection,$query);
    print "
        <h3>Smart card inserita correttamente nel database</h3>";
}
mysqli_close($connection);
?>

<a class="button" href="index.html">Torna alla home</a>
        <a class="button" href="gestione_smartcard.html">Torna alle smart card</a>
    </body>
</html>
