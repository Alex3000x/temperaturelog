<?php

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  $url = "https://";   
else
  $url = "http://";   

$url.= $_SERVER['HTTP_HOST'];   
$url.= $_SERVER['REQUEST_URI'];   

$url_components = parse_url($url);
parse_str($url_components['query'], $params);

$idutente = $params["id"];

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non riuscita");
$query = "DELETE
          FROM utenti
          WHERE idutente = $idutente";
          
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
                <h1>GESTIONE UTENTI</h1><br><br>
                <h3>Utente eliminato dal database</h3>
                <a href=index.html>Torna alla home</a>
                <a href=gestione_utenti.html>Torna alla gestione utenti</a>
                </center>
            </body>
        </html>";
?>
