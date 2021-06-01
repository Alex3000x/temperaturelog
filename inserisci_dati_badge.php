<?php

include("database.php");

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non eseguita");
$query = "SELECT *
          FROM utenti
          WHERE 1";
$result1 = mysqli_query($connection, $query);

$errore = "Tutti i campi segnati con un asterisco (*) sono obbligatori";
?>

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
      <form class="centro" action="inserisci_badge.php" method="POST"><br><br>
        <h3>Inserisci i dati del badge<br></h3>
        <fieldset>
          <label for="code">ID badge:</label>
          <input type="text" name="codice" required>
          <span class="required">*</span><br><br>
          <label for="utente">Utente associato:</label>
          <select name="idutente" id="scelta_utente" required>
            <option value=""></option>

<?php
$nome = "";
$cognome = "";
$idutente = 0;
if(mysqli_num_rows($result1) != 0)
{
    while ($row = mysqli_fetch_array($result1))
    {
      $idutente = $row['idutente'];
      $nome = $row['nome'];
      $cognome = $row['cognome'];
      print "    
            <option value=$idutente>$cognome $nome</option>";
    }
}
?>

          </select>
          <span class="required">*<br><br></span>
          <span class="required" id="error">*&hairsp;campi obbligatori</span>
        </fieldset><br><br>
        <a href="visualizza_badge.php" class="button">Torna Indietro</a>
        <input class="button" type="submit" value="Aggiungi&nbsp;badge">
      </form>
  
	</body>
</html>