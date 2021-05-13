<?php

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
$query = "SELECT *
          FROM utenti
          ORDER BY cognome";
$result1 = mysqli_query($connection, $query);

print "
        <html>
            <head>
                <link rel=icon href=favicon2.ico>
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
                            <th>Cognome</th>
                            <th>Nome</th>
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
                            <td>$row[cognome]</td>
                            <td>$row[nome]</td>
                            <td>$date</td>
                            <td><a href=modifica_dati_utente.php?id=$row[idutente]><img src=./immagini/modifica.png alt=Modifica></a></td>
                            <td><a href=elimina_utente.php?id=$row[idutente]><img src=./immagini/elimina.png alt=Elimina></a></td>
                        </tr>";
        $i++;
    }
}
else
    print "Nessun utente memorizzato nel database";
mysqli_close($connection);
?>

                    </table><br>
                    <form action=inserisci_dati_utente.html>
                        <input type=submit value=Inserisci&nbsp;utente>
                    </form>
                </center>
            </body>
            <footer>
                <center>
                    <a href=index.html>Home</a></td>
                </center>
            </footer>
        </html>
