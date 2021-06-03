<html>
    <head>
        <link rel="icon" href="favicon.ico">
        <link rel = "stylesheet" href="allstyles.css"/>
        <title>temperaturelog</title>
    </head>
    <body>
        <div class="title">
            <img class="logo1" src=./images/logo1.png alt=T>
            <h1>emperature</h1>
            <img class="logo2" src=./images/logo2.png alt=T>
            <h1 class="og">og</h1>
        </div>
        <h1>BADGE</h1><br><br>
        
        
<?php

include("database.php");

error_reporting(0);

$codice = $_POST["codice"];
$idutente = $_POST["idutente"];

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non riuscita");
$query = "SELECT *
          FROM badge
          WHERE codice = '$codice'";
$result = mysqli_query($connection,$query);
$data = mysqli_fetch_array($result, MYSQLI_NUM);
if($data[0] > 1) {
    print "
        <h3>Errore di inserimento! ID badge già registrato nel database</h3>";
}
else {
    $query = "INSERT
                INTO badge (idutente, codice)
                VALUES ('$idutente','$codice')";
    mysqli_query($connection,$query);
    print "
        <h3>Badge inserito correttamente nel database</h3>";
}
mysqli_close($connection);
?>
        <a class="button" href="visualizza_badge.php">Torna ai badge</a>
    </body>
</html>
