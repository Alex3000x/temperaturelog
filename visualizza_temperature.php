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
        <h1>TEMPERATURE</h1>
        <center>
            <table class="centro">
                <tr>
                    <th>N°</th>
                    <th>Utente</th>
                    <th>Temperatura</th>
                </tr>
<?php

$connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
$query = "SELECT *
          FROM temperature";
$result1 = mysqli_query($connection, $query);
if(mysqli_num_rows($result1) != 0)
{
    $temperatura = 0;
    $i = 1;
    while ($row = mysqli_fetch_array($result1))
    {
        $temperatura = $row['temperatura'];
        print "
                <tr>
                    <td>$i</td>";
        
        $connection = mysqli_connect("localhost","root","","temperaturelog") or die("Connessione non eseguita");
        $query = "SELECT user.idutente, user.nome, user.cognome, temp.idtemperatura, temp.temperatura
                  FROM utenti AS user, temperature AS temp
                  WHERE temp.idutente = user.idutente
                  AND temp.temperatura = '$temperatura'
                  ORDER BY temp.temperatura";
        $result2 = mysqli_query($connection, $query);
        if(mysqli_num_rows($result2) != 0)
        {
            while ($row = mysqli_fetch_array($result2))
            {
                $nome = $row['nome'];
                $cognome = $row['cognome'];
            
                print "
                    <td>$row[cognome] $row[nome]</td>";
            }
        }
        print "
                    <td>$temperatura</td>
                </tr>";
        $i++;
    }
}
else
    print "Nessuna smart card memorizzata nel database";
mysqli_close($connection);
?>

            </table><br>
            <a class="button" href="index.html">Torna alla home</a></td>
            </form>
        </center>
    </body>
</html>
