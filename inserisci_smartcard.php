<?php

$codice = 0;
$idutente = 0;

if ($_POST['idutente'] == "" || $_POST['codice'] == "")
    header("Location: inserisci_dati_smartcard.php");
else
{
    $connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non riuscita");
    $query = "INSERT
            INTO smartcard (idutente, codice)
            VALUES ('$idutente','$codice')";

    mysqli_query($connection,$query);
    mysqli_close($connection);

    print "
        <html>
            <head>
                <link rel=icon href=favicon2.ico>
                <title>temperaturelog</title>
            </head>
            <body>
                <center>
                <h1>GESTIONE SMART CARD</h1><br><br>
                <h3>Smart card inserita correttamente nel database</h3>
                <a href=index.html>Torna alla home</a>
                <a href=gestione_smartcard.html>Torna alla gestione smart card</a>
                </center>
            </body>
        </html>";
}
?>
