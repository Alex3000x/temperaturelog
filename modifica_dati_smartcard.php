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
$codice = "";
$idutente = "";

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
$query = "SELECT *
          FROM smartcard
          WHERE idsmartcard = $idsmartcard";
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

<html>
<style>
.required {color: #FF0000;}
</style>
  <head>
    <link rel=icon href=favicon2.ico>
    <title>temperaturelog</title>
  </head>
  <body>
    <center>
    <h1>GESTIONE SMART CARD</h1>
    <form action=modifica_smartcard.php?id=$idsmartcard method=POST><br><br>
        <h3>Modifica i dati della smart card<br></h3>
        ID Carta: <input type=text name=codice value=$codice required>
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
          <option value=$idutente selected>$nome $cognome</option>";
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

print "

        </select>
        <span class=required>*<br><br></span>
        <span class=required id=error>*&hairsp;campi obbligatori</span><br><br>
        <input type=submit value=Applica&nbsp;modifiche>
      </form>
  </center>
	</body>
</html>";

mysqli_close($connection);
session_destroy();
?>
