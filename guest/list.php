<?php include("/users/powerswitch/www/fewo/guest/password_protect.php"); ?>
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
    
    $result = mysqli_query($con,"SELECT id, wohnung, beschreibung, preis, link, stimmen, notizen FROM fewo WHERE aktiv>0 ORDER BY stimmen DESC");    
    while($row = mysqli_fetch_array($result))
    {
        echo "<div class='produkt'>";
        echo "<div class='title'>";
        if (strcmp($row['aktiv'],'2') == 0)
        {
            echo "Überraschung: ";
        } else {
            echo "Wohnung: ";
        }        
        echo $row['wohnung'] . "</div>";
        echo "<div class='change'>";
        echo "<form name='input' action='functions/vote.php' method='post'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<input type='hidden' name='up' value='1'>";
        echo "<input class='inputfield' type='submit' value='+'>";
        echo "</form>";
        echo "<form name='input' action='functions/vote.php' method='post'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<input type='hidden' name='down' value='1'>";
        echo "<input class='inputfield' type='submit' value='-'>";
        echo "</form>";
        echo "<form name='input' action='functions/update.php' method='post'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<span class='inputtext'>Notizen:</span><input class='inputfield' type='text' name='notizen' placeholder='$row[notizen]' maxlength='90'>";
        echo "<input class='inputfield' type='submit' value='Ändern'>";
        echo "</form>";
        if (strcmp($row['aktiv'],'2') == 0)
        {
            echo "<a class='inputfield' href='functions/delete.php?id=$row[id]'>Löschen</a>";
        }
        echo "</div>";
        if (strcmp($row['kaeufer'],''))
        {
            if (strcmp($row['aktiv'],'2') == 0)
            {
                echo "<div class='surprise'>";
            } else {
                echo "<div class='bought'>";
            }
        } else {
            echo "<div class='free'>";
        }
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
            echo "<span class='tag'>Beschreibung:</span> $row[beschreibung]<br>";
        }
        if (strcmp($row['stimmen'],''))
        {
            echo "<span class='tag'>Stimmen:</span>  $row[stimmen] <br>";
        }
        if (strcmp($row['notizen'],''))
        {
            echo "<span class='tag'>Notizen:</span>  $row[notizen]<br>";
        }
        echo "</div><div class='clear'></div>";
        echo "</div>";
    
    }

    mysqli_close($con);
?>
            </div>
            <div class="footer">
                (c) 2014 Powerswitch Entertainment, <a href="http://www.powerswitch-entertainment.de/index.php?option=com_contact&view=contact&id=1&Itemid=54">Impressum</a>
            </div>
        </div>
    </body>
</html>
