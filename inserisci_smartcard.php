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

print "
        <html>
            <head>
                <title>temperaturelog</title>
            </head>
            <body>
                <center>
                <h1>GESTIONE UTENTI</h1><br><br>
                <h3>Utente inserito correttamente nel database</h3>
                <a href=index.html>Torna alla home</a>
                <a href=gestione_utenti.html>Torna alla gestione utenti</a>
                </center>
            </body>
        </html>";
?>
