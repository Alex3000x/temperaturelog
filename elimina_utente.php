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
        <h3>Utente eliminato dal database</h3>
        <a class="button" href="index.html">Torna alla home</a>
        <a class="button" href="gestione_utenti.html">Torna agli utenti</a>
    </body>
</html>

