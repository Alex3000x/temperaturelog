<?php

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
$query = "SELECT *
          FROM smartcard
          WHERE 1";
$result1 = mysqli_query($connection, $query);

print "
        <html>
            <head>
                <title>temperaturelog</title>
            </head>
            <body>
                <center>
                    <h1>GESTIONE SMART CARD</h1>
                    <table border>";

if(mysqli_num_rows($result1) != 0)
{
    print "
                        <tr>
                            <th>N°</th>
                            <th>ID Carta</th>
                            <th>Utente associato</th>
                            <th colspan=2>Azioni</th>
                        </tr>";
    $i = 1;
    while ($row = mysqli_fetch_array($result1))
    {
        print "
                        <tr>
                            <td>$i</td>
                            <td>$row[codice]</td>";
        $connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
        $query = "SELECT u.idutente, u.nome, u.cognome, s.codice
                  FROM utenti AS u, smartcard AS s
                  WHERE s.idutente = u.idutente
                  GROUP BY s.codice, u.nome, u.cognome";
        $result2 = mysqli_query($connection, $query);
        print "
                            <td>$row[nome]$row[cognome]</td>
                            <td><a href=modifica_dati_utente.php?id=$row[idutente]><img src=./immagini/modifica.png alt=Modifica></a></td>
                            <td><a href=elimina_utente.php?id=$row[idutente]><img src=./immagini/elimina.png alt=Elimina></a></td>
                        </tr>";
        $i++;
    }
}
else
    print "Nessuna smart card memorizzata nel database";

print "
                    </table>
                </center>
            </body>";
mysqli_close($connection);
print "
            <footer>
                <center>
                    <br>
                    <form action=inserisci_dati_smartcard.php>
                        <input type=submit value=Aggiungi&nbsp;smart&nbsp;card>
                    </form>
                </center>
            </footer>
        </html>";
?>