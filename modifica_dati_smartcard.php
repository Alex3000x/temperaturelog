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
    <h1>BADGE</h1>

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

$idbadge = $params['id'];
$codice = "";
$idutente = "";

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non eseguita");
$query = "SELECT *
          FROM badge
          WHERE idbadge = $idbadge";
$result1 = mysqli_query($connection, $query);

if(mysqli_num_rows($result1) != 0)
{
    while ($row = mysqli_fetch_array($result1))
    {
        $codice = $row['codice'];
        $idutente = $row['idutente'];
    }
}
$iduser = $idutente;

print "
    <form class=centro action=modifica_smartcard.php?id=$idbadge method=POST><br><br>
      <fieldset>
        <h3>Modifica i dati del badge<br></h3>
        <label for=code>ID badge:</label>
        <input type=text name=codice value=$codice required>
        <span class=required>*</span><br><br>
        <label for=utente>Utente associato:</label>";

$nome = "";
$cognome = "";

$query = "SELECT *
          FROM utenti
          WHERE idutente = '$idutente'";
$result2 = mysqli_query($connection, $query);

if(mysqli_num_rows($result2) != 0)
{
  print "
        <select name=idutente id=scelta_utente>";
    while ($row = mysqli_fetch_array($result2))
    {
      $nome = $row['nome'];
      $cognome = $row['cognome'];
      print "    
          <option value=$idutente selected>$cognome $nome</option>";
    }
}

$query = "SELECT *
          FROM utenti";
$result3 = mysqli_query($connection, $query);

if(mysqli_num_rows($result3) != 0)
{
    while ($row = mysqli_fetch_array($result3))
    {
      $idutente = $row['idutente'];
      $nome = $row['nome'];
      $cognome = $row['cognome'];
      print "    
          <option value=$idutente>$nome $cognome</option>";
    }
}
mysqli_close($connection);

?>

        </select>
        <span class="required">*<br><br></span>
        <span class="required" id="error">*&hairsp;campi obbligatori</span><br><br>
      </fieldset>  
      <a class="button" href="visualizza_smartcard.php" class="button">Torna Indietro</a>
      <input class="button" type="submit" value="Applica&nbsp;modifiche">
    </form>
	</body>
</html>