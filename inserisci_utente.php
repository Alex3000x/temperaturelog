<?php

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$datanascita = $_POST["datanascita"];

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non riuscita");
$query = "INSERT
          INTO utenti (nome, cognome, datanascita)
          VALUES ('$nome','$cognome','$datanascita')";

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
        <h1>UTENTI</h1><br><br>
        <h3>Utente inserito correttamente nel database</h3>
        <a class="button" href="index.html">Torna alla home</a>
        <a class="button" href="gestione_utenti.html">Torna agli utenti</a>
    </body>
</html>

