<html>
    <head>
        <link rel=icon href=favicon.ico>
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
$query = "SELECT *
          FROM smartcard
          WHERE codice = '$codice'";
$result = mysqli_query($connection,$query);
$data = mysqli_fetch_array($result, MYSQLI_NUM);
if($data[0] > 1) {
    print "
        <h3>Errore di aggiornamento! ID smart card già registrato nel database</h3>";
}
else {

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
  print "
      <h3>Modifiche apportate correttamente alla smart card</h3>";
}

mysqli_close($connection);

session_unset();
session_destroy();
?>

      <a class="button" href="index.html">Torna alla home</a>
      <a class="button" href="gestione_smartcard.html">Torna alle smart card</a>
    </body>
</html>