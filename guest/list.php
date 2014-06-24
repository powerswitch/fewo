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
    
    $result = mysqli_query($con,"SELECT id, wohnung, beschreibung, preis, link, stimmen, notizen, image FROM fewo WHERE aktiv>0 ORDER BY stimmen DESC");    
    while($row = mysqli_fetch_array($result))
    {
        echo "<div class='produkt'>";
        echo "<div class='title'>";
        echo $row['wohnung'] . "</div>";
        echo "<div class='change'>";
        echo "<span class='inputtext'>Abstimmung:</span><form name='input' action='functions/vote.php' method='post' class='vote'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<input type='hidden' name='down' value='1'>";
        echo "<input class='inputfield' type='submit' value='-' id='voteleft'>";
        echo "</form>";
        if (strcmp($row['stimmen'],''))
        {
            echo "<span class='vote'>$row[stimmen]</span>";
        }        
        echo "<form name='input' action='functions/vote.php' method='post' class='vote'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<input type='hidden' name='up' value='1'>";
        echo "<input class='inputfield' type='submit' value='+'  id='voteright'>";
        echo "</form>";
        echo "<form name='input' action='functions/update.php' method='post'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<span class='inputtext'>Notizen:</span><textarea class='inputfield' name='notizen' placeholder='$row[notizen]' maxlength='90'></textarea>";
        echo "<input class='inputfield' type='submit' value='Ändern'>";
        echo "</form>";
        echo "</div>";
		if (strcmp($row['image'],''))
        {
			echo "<div class='image'><img class='image' src='$row[image]'></div>";
		}
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
        
        $cresult = mysqli_query($con, "SELECT cid, comment, user FROM fewo_comment WHERE id=$row[id]");
		while($crow = mysqli_fetch_array($cresult))
		{
			echo "<div class='comment'>";
			echo "<div class='cname'>$crow[user]</div>";
			echo "<div class='ccomment'>$crow[comment]</div>";
			echo "<div class='csubmit'>";
			echo "<form name='delcomment' action='functions/delcomment.php' method='post'>";
			echo "<input type='hidden' name='id' value='$crow[cid]'>";
			echo "<input type='submit' value='löschen' class='cisubmitsmall'>";
			echo "</form></div>";
			echo "</div>";
		}
        echo "<div class='comment'><form name='comment' action='functions/comment.php' method='post'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<div class='cname'>Name";
        echo "<input type='inputtext' name='user' class='ciuser' maxlength='90'>";
        echo "</div>";
        echo "<div class='ccomment'>Kommentar";
        echo "<input type='inputtext' name='comment' class='cicomment' maxlength='200'>";
        echo "</div>";
        echo "<div class='csubmit'>";
        echo "<input type='submit' value='kommentieren' class='cisubmit'>";
        echo "</div>";
        echo "</form></div>";
        echo "</div>";
    
    }

    mysqli_close($con);
?>
                <a href="../host/list.php" class="button">
                    Ferienwohnung hinzufügen
                </a>            
            </div>
            <div class="footer">
                (c) 2014 Powerswitch Entertainment, <a href="http://www.powerswitch-entertainment.de/index.php?option=com_contact&view=contact&id=1&Itemid=54">Impressum</a>
            </div>
        </div>
    </body>
</html>
