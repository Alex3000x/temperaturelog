<?php
$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
$query = "SELECT *
          FROM utenti
          WHERE 1";
$result1 = mysqli_query($connection, $query);

$errore = "Tutti i campi segnati con un asterisco (*) sono obbligatori";
?>

<html>
<style>
.required {color: #FF0000;}
</style>
  <head>
    <title>temperature log</title>
  </head>
  <body>
    <center>
      <h1>GESTIONE SMART CARD</h1>
      <form id="form" name="myForm" action="inserisci_smartcard.php" onsubmit=validateForm() method="POST"><br><br>
        <h3>Inserisci i dati della smart card<br></h3>
        ID Carta: <input type="text" name="codice" >
        <span class="required">*</span><br><br>
        <label for="utente">Utente da associare:</label>
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
          <option value=$idutente>$nome $cognome</option>";
    }
}
?>

        </select>
        <span class="required">*<br><br></span>
        <span class="required" id="error">*&hairsp;campi obbligatori</span><br><br>
        <input type="submit" value="Inserisci&nbsp;smart&nbsp;card" onclick=anotherValidation()>
      </form>
  </center>
	</body>
</html>

<script>
document.getElementById("error")style.display = "none";

function anotherValidation() {
  document.getElementById('form').action = "inserisci_dati_smartcard.php";
   alert("Submit button clicked!");
   return true;
}

function validateForm() {
  var x = document.forms["myForm"]["idutente"].value;
  var y = document.forms["myForm"]["codice"].value;
  if (x == "" || y == "") {
    return false;
    document.getElementById("error")style.display = "block";
    window.location.replace('inserisci_dati_smartcard.php');
  }
  else{
    document.getElementById("error")style.display = "none";
  }
}
</script>