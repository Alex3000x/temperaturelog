
<html>
    <style>
        table, th, td {
            text-align: center;
            margin-top: 80px;
            margin-bottom: 20px;
            border: 1px solid #a8afb7;
            border-collapse: collapse;
        }
    </style>
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
        <h1>SMART CARD</h1>
        <center>
            <table class="centro">
                <tr>
                    <th>N°</th>
                    <th>ID Carta</th>
                    <th>Utente associato</th>
                    <th colspan=2>Azioni</th>
                </tr>
<?php

include("database.php");

$connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non eseguita");
$query = "SELECT *
          FROM badge";
$result1 = mysqli_query($connection, $query);
if(mysqli_num_rows($result1) != 0)
{
    $i = 1;
    while ($row = mysqli_fetch_array($result1))
    {
        print "
                <tr>
                    <td>$i</td>
                    <td>$row[codice]</td>";
        $connection = mysqli_connect($DB_SERVER,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Connessione non eseguita");
        $query = "SELECT user.idutente, user.nome, user.cognome, smart.idbadge, smart.codice
                  FROM utenti AS user, badge AS smart
                  WHERE smart.idutente = user.idutente
                  AND smart.codice = '$row[codice]'
                  ORDER BY smart.codice";
        $result2 = mysqli_query($connection, $query);
        if(mysqli_num_rows($result2) != 0)
        {
            while ($row = mysqli_fetch_array($result2))
            {
                $nome = $row['nome'];
                $cognome = $row['cognome'];
            
                print "
                    <td>$row[cognome] $row[nome]</td>
                    <td><a href=modifica_dati_smartcard.php?id=$row[idsmartcard]><img src=./immagini/modifica.png alt=Modifica></a></td>
                    <td><a href=elimina_smartcard.php?id=$row[idsmartcard]><img src=./immagini/elimina.png alt=Elimina></a></td>
                </tr>";
            }
        }
        $i++;
    }
}
else
    print "Nessuna smart card memorizzata nel database";

mysqli_close($connection);
?>

            </table><br>
            <form class="centro" action=inserisci_dati_smartcard.php>
                <a class="button" href=gestione_smartcard.html>Torna indietro</a></td>
                <input class="button" type=submit value=Aggiungi&nbsp;smart&nbsp;card>
            </form>
        </center>
    </body>
</html>
