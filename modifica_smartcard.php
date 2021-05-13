<?php

session_start();

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  $url = "https://";   
else
  $url = "http://";   

$url.= $_SERVER['HTTP_HOST'];   
$url.= $_SERVER['REQUEST_URI'];   

$url_components = parse_url($url);
parse_str($url_components['query'], $params);

$idsmartcard = $params['id'];
$codice = $_POST["codice"];
$idutente = $_POST["idutente"];

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non riuscita");

if(strlen($codice) != 0)
{
  $query = "UPDATE smartcard
            SET codice = '$codice'
            WHERE idsmartcard = '$idsmartcard'";
  mysqli_query($connection,$query);
}

if(strlen($idutente) != 0)
{
  $query = "UPDATE smartcard
            SET idutente = '$idutente'
            WHERE idsmartcard = '$idsmartcard'";
  mysqli_query($connection,$query);
}

mysqli_close($connection);

print "
        <html>
            <head>
                <title>temperaturelog</title>
            </head>
            <body>
                <center>
                <h1>GESTIONE SMART CARD</h1><br><br>
                <h3>Modifiche apportate correttamente alla smart card</h3>
                <a href=index.html>Torna alla home</a>
                <a href=gestione_smartcard.html>Torna alla gestione smart card</a>
                </center>
            </body>
        </html>";

session_unset();
session_destroy();
?>
