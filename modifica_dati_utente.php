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
        <h1>UTENTI</h1>

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

$idutente = $params['id'];

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non eseguita");
$query = "SELECT *
          FROM utenti
          WHERE idutente = $idutente";
$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result) != 0)
{
    while ($row = mysqli_fetch_array($result))
    {
        $nome = $row['nome'];
        $cognome = $row['cognome'];
        $datanascita = $row['datanascita'];
    }
}

print "

    <form class=centro action=modifica_utente.php?id=$idutente method=POST><br><br>
      <h3>Modifica i dati dell'utente<br></h3>
      <fieldset>
        <label for=fname>Nome:</label>
        <input type=text name=nome value=$nome required>
        <span class=required>*</span><br><br>
        <label for=lname>Cognome:</label>
        <input type=text name=cognome value=$cognome required>
        <span class=required>*</span><br><br>
        <label for=date>Data di nascita:</label>
        <input type=date name=datanascita value=$datanascita required>";
mysqli_close($connection);
session_destroy();
?>        
        <span class=required>*</span><br><br>
        <span class=required id=error>*&hairsp;campi obbligatori</span><br><br>
      </fieldset>
      <a href="visualizza_utenti.php" class="button">Torna Indietro</a>
      <input class="button"type=submit value=Applica&nbsp;modifiche>
		</form>
	</body>
</html>


