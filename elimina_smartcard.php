<?php

include("database.php");

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  $url = "https://";   
else
  $url = "http://";   

$url.= $_SERVER['HTTP_HOST'];   
$url.= $_SERVER['REQUEST_URI'];   

$url_components = parse_url($url);
parse_str($url_components['query'], $params);

$idbadge = $params["id"];

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non riuscita");
$query = "DELETE
          FROM badge
          WHERE idbadge = '$idbadge'";
          
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
        <h3>Smart card eliminata dal database</h3>
        <a class="button" href="index.html">Torna alla home</a>
        <a class="button" href="gestione_smartcard.html">Torna alle smart card</a>
    </body>
</html>

