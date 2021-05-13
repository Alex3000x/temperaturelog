<?php

$codice = 0;
$idutente = 0;

if ($_POST['idutente'] == "" || $_POST['codice'] == "")
{
    echo $codice;
    echo $idutente;
    echo "nooooo";
    header("Location: inserisci_dati_smartcard.php");
}
else
{
    $codice = $_POST["codice"];
    $idutente = $_POST["idutente"];
    echo $codice;
    echo $idutente;
    echo "yeeeee";
    

    $connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non riuscita");
    $query = "INSERT
            INTO smartcard (idutente, codice)
            VALUES ('$idutente','$codice')";

    mysqli_query($connection,$query);
    mysqli_close($connection);

    print "
        <html>
            <head>
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
