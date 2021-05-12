<?php

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
$query = "SELECT *
          FROM utenti
          WHERE 1";
$result1 = mysqli_query($connection, $query);

print "
        <html>
            <head>
                <title>temperaturelog</title>
            </head>
            <body>
                <center>
                    <h1>GESTIONE UTENTI</h1>
                    <table border>";

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
    print "Nessun utente memorizzato nel database";

print "
                    </table>
                </center>
            </body>";
mysqli_close($connection);
print "
            <footer>
                <center>
                    <br>
                    <form action=inserisci_dati_utente.html>
                        <input type=submit value=Inserisci&nbsp;utente>
                    </form>
                </center>
            </footer>
        </html>";
?>