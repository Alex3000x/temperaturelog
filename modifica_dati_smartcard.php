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

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
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

<html>
  <head>
    <title>temperaturelog</title>
  </head>
  <body>
    <center>
    <h1>GESTIONE UTENTI</h1>
    <form action=modifica_utente.php?id=$idutente method=POST><br><br>
            <h3>Modifica i dati dell'utente<br></h3>
			Nome: <input type=text name=nome value=$nome><br><br>
			Cognome: <input type=text name=cognome value=$cognome><br><br>
      Data di nascita: <input type=date name=datanascita value=$datanascita><br><br>
			<input type=submit value=Applica&nbsp;modifiche>
		</form>
  </center>
	</body>
</html>";

mysqli_close($connection);
session_destroy();
?>
