<?php include("/users/powerswitch/www/fewo/host/password_protect.php"); ?>
<html>
    <head>
        <title>Ferienplaner</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="cache-control" content="no-cache">        
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <div class="middle">
            <div class="header">
                Ferienplaner
            </div>
            <div class="content">
<?php
	include("../access/sqlpw.php");
	$con = mysqli_connect('localhost', $sql_user, $sql_pass, $sql_db);
    if (mysqli_connect_errno())
    {
        echo "MySQL-Verbindungsfehler: " . mysqli_connect_error();
    }
    
    $result = mysqli_query($con,"SELECT id, wohnung, beschreibung, preis, link FROM fewo WHERE aktiv=1");
    
    while($row = mysqli_fetch_array($result))
    {
        echo "<div class='produkt'>";
        echo "<div class='title'>" . $row['wohnung'] . "</div>";
        echo "<div class='change'>";
        echo "Löschen<br>";
        echo "<a href='functions/delete.php?id=" . $row['id'] . "'>X</a><br>";
        echo "</div>";
        echo "<div class='details'>";
        if (strcmp($row['preis'],''))
        {
            echo "<span class='tag'>Preis:</span> $row[preis]<br>";
        }
        if (strcmp($row['link'],''))
        {
            echo "<span class='tag'>Link:</span>  <a href='$row[link]'>$row[link]</a><br>";
        }
        if (strcmp($row['beschreibung'],''))
        {
            echo "<span class='tag'>Beschreibung:</span>$row[beschreibung]<br>";
        }
        echo "</div><div class='clear'></div>";
        echo "</div>";
    }

    mysqli_close($con);
?>
				<a href="add.php" class='button'>Wohnung hinzufügen</a>
                <a href="../guest/list.php" class="button">
                    Über Ferienwohnung abstimmen
                </a>
            </div>
            <div class="footer">
                (c) 2014 Powerswitch Entertainment, <a href="http://www.powerswitch-entertainment.de/index.php?option=com_contact&view=contact&id=1&Itemid=54">Impressum</a>
            </div>
        </div>
    </body>
</html>
