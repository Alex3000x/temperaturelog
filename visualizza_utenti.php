<html>
    <style>
        table, th, td {
            text-align: center;
            margin-top: 80px;
            margin-bottom: 20px;
            border: 1px solid #a8afb7;
            border-collapse: collapse;
        }
    </style>
    <head>
        <link rel="icon" href="favicon.ico">
        <link rel = "stylesheet" href="allstyles.css"/>
        <title>temperaturelog</title>
    </head>
    <body>
        <center>
            <div class="title">
                <img class="logo1" src=./immagini/logo1.png alt=T>
                <h1>emperature</h1>
                <img class="logo2" src=./immagini/logo2.png alt=T>
                <h1 class="og">og</h1>
            </div>
            <h1>UTENTI</h1>
            <table class="centro">
            <tr>
                <th>N°</th>
                <th>Cognome</th>
                <th>Nome</th>
                <th>Data di nascita</th>
                <th colspan=2>Azioni</th>
            </tr>

<?php

include("database.php");

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non eseguita");
$query = "SELECT *
          FROM utenti
          ORDER BY cognome";
$result1 = mysqli_query($connection, $query);

if(mysqli_num_rows($result1) != 0)
{
    $i = 1;
    while ($row = mysqli_fetch_array($result1))
    {
        $timestamp = strtotime($row['datanascita']);
        $date = date('d/m/Y', $timestamp);

        print "
                        <tr>
                            <td>$i</td>
                            <td>$row[cognome]</td>
                            <td>$row[nome]</td>
                            <td>$date</td>
                            <td><a href=modifica_dati_utente.php?id=$row[idutente]><img src=./immagini/modifica.png alt=Modifica></a></td>
                            <td><a href=elimina_utente.php?id=$row[idutente]><img src=./immagini/elimina.png alt=Elimina></a></td>
                        </tr>";
        $i++;
    }
}
else
    print "Nessun utente memorizzato nel database";
mysqli_close($connection);
?>

                    </table><br>
                    <form class="centro" action=inserisci_dati_utente.html>
                        <a class="button" href=index.html>Torna alla home</a>
                        <input class="button" type=submit value=Aggiungi&nbsp;utente>
                    </form>
                </center>
            </body>
        </html>
