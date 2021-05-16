<?php

$codice = $_POST["codice"];
$idutente = $_POST["idutente"];

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non riuscita");
$query = "INSERT
            INTO smartcard (idutente, codice)
            VALUES ('$idutente','$codice')";

mysqli_query($connection,$query);
mysqli_close($connection);

?>

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
        <h3>Smart card inserita correttamente nel database</h3>
        <a class="button" href="index.html">Torna alla home</a>
        <a class="button" href="gestione_smartcard.html">Torna alle smart card</a>
    </body>
</html>
