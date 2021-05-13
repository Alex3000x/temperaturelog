<?php

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
$query = "SELECT *
          FROM smartcard";
$result1 = mysqli_query($connection, $query);

print "
        <html>
            <head>
                <link rel=icon href=favicon2.ico>
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
        $query = "SELECT user.idutente, user.nome, user.cognome, smart.idsmartcard, smart.codice
                  FROM utenti AS user, smartcard AS smart
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
                    <form action=inserisci_dati_smartcard.php>
                        <input type=submit value=Aggiungi&nbsp;smart&nbsp;card>
                    </form>
                </center>
            </body>
            <footer>
                <center>
                <a href=index.html>Home</a></td>
                </center>
            </footer>
        </html>
