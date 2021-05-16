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

$idutente = $params['id'];
$cognome = $_POST["cognome"];
$nome = $_POST["nome"];
$datanascita = $_POST["datanascita"];

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non riuscita");

if(strlen($cognome) != 0)
{
  $query = "UPDATE utenti
            SET cognome = '$cognome'
            WHERE idutente = '$idutente'";
  mysqli_query($connection,$query);
}

if(strlen($nome) != 0)
{
  $query = "UPDATE utenti
            SET nome = '$nome'
            WHERE idutente = '$idutente'";
  mysqli_query($connection,$query);
}

if(strlen($datanascita) != 0)
{
  $query = "UPDATE utenti
            SET datanascita = '$datanascita'
            WHERE idutente = '$idutente'";
  mysqli_query($connection,$query);
}

mysqli_close($connection);

session_unset();
session_destroy();
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
      <h3>Modifiche apportate correttamente all'utente</h3>
      <a class="button" href="index.html">Torna alla home</a>
      <a class="button" href="gestione_utenti.html">Torna agli utenti</a>
  </body>
</html>
