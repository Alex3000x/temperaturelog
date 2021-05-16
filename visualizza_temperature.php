<?php

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
$query = "SELECT *
          FROM utenti
          WHERE 1";
$result1 = mysqli_query($connection, $query);

print "
        <html>
            <head>
                <link rel=icon href=favicon.ico>
                <title>temperaturelog</title>
            </head>
            <body>
                <center>
                    <h1>UTENTI</h1>
                    <table border>
                    <p>NON C'È NIENTE!</p>";
/*
                    
if(mysqli_num_rows($result1) != 0)
{
    print "
                        <tr>
                            <th>N°</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Data di nascita</th>
                            <th colspan=2>Azioni</th>
                        </tr>";
    $i = 1;
    while ($row = mysqli_fetch_array($result1))
    {
        $timestamp = strtotime($row['datanascita']);
        $date = date('d/m/Y', $timestamp);

        print "
                        <tr>
                            <td>$i</td>
                            <td>$row[nome]</td>
                            <td>$row[cognome]</td>
                            <td>$date</td>
                            <td><a href=modifica_dati_utente.php?id=$row[idutente]><img src=./immagini/modifica.png alt=Modifica></a></td>
                            <td><a href=elimina_utente.php?id=$row[idutente]><img src=./immagini/elimina.png alt=Elimina></a></td>
                        </tr>";
        $i++;
    }
}
else
    print "Nessun utente memorizzato nel database";*/
mysqli_close($connection);
?>

                    </table><br>
                    </form>
                </center>
            </body>
            <footer>
                <center>
                    <a href=index.html>Home</a></td>
                </center>
            </footer>
        </html>
