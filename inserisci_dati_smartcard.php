<?php
$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
$query = "SELECT *
          FROM utenti
          WHERE 1";
$result1 = mysqli_query($connection, $query);
?>

<html>
  <head>
    <title>temperature log</title>
  </head>
  <body>
    <center>
      <h1>GESTIONE SMART CARD</h1>
      <form action="inserisci_utente.php" method="POST"><br><br>
        <h3>Inserisci i dati della smart card<br></h3>
        ID Carta: <input type="text" name="nome"><br><br>
        <label for="utente">Utente da associare:</label>
        <select name="scelta_utente" id="scelta_utente">
          <option value=" "></option>

<?php
$nome = "";
$cognome = "";
if(mysqli_num_rows($result1) != 0)
{
    while ($row = mysqli_fetch_array($result1))
    {
      $nome = $row['nome'];
      $cognome = $row['cognome'];
      print "    
          <option value=utente>$nome $cognome</option>";
    }
}
?>

        </select>
        <br>
        <input type="submit" value="Inserisci&nbsp;utente">
      </form>
  </center>
	</body>
</html>
