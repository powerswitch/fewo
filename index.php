<html>
    <head>
        <title>Ferienplaner</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="cache-control" content="no-cache">        
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="middle">
            <div class="header">
                Ferienplaner
            </div>
            <div class="content">
<?php
	session_start();
	
	if (isset($_SESSION['name']))
	{
        echo "<div class='user'>";
        echo "<div class='cname'>Login</div>";
        echo "<div class='ccomment'>Angemeldet als $_SESSION[name]";
        echo "</div>";
        echo "<div class='csubmit'>";
        echo "<a href='functions/logout.php'><div class='cisubmitsmall'>abmelden</div></a>";
        echo "</div>";
        echo "</div>";       
	} else {
        echo "<div class='user'><form name='login' action='functions/login.php' method='post'>";
        echo "<div class='cname'>Login</div>";
        echo "<div class='ccomment'>";
        echo "<input type='inputtext' name='name' class='cicomment' maxlength='90' placeholder='Bitte anmelden, um alle Funktionen nutzen zu können'>";
        echo "</div>";
        echo "<div class='csubmit'>";
        echo "<input type='submit' value='anmelden' class='cisubmitsmall'>";
        echo "</div>";
        echo "</form></div>";
	}
	
	include("access/sqlpw.php");
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

        echo "<span class='inputtext'>Abstimmung:</span>";
        
		$val = 0;
		if (isset($_SESSION['name']))
		{
			$vresult = mysqli_query($con, "SELECT val FROM fewo_vote WHERE id='$row[id]' and user='$_SESSION[name]'");
			while($vrow = mysqli_fetch_array($vresult)) {
				$val = $vrow['val'];
			}
			echo "<form name='input' action='functions/vote.php' method='post' class='vote'>";
			echo "<input type='hidden' name='id' value='$row[id]'>";
			if (!strcmp($val,"-1")) {
				echo "<input type='hidden' name='val' value='0'>";
				echo "<input class='inputfield active' type='submit' value='-' id='voteleft'>";
			} else {
				echo "<input type='hidden' name='val' value='-1'>";
				echo "<input class='inputfield' type='submit' value='-' id='voteleft'>";
			}
			echo "</form>";
		} else {
			echo "<span class='vote'>-</span>";
		}
        
        if (strcmp($row['stimmen'],''))
        {
            echo "<span class='vote'>$row[stimmen]</span>";
        }        

		if (isset($_SESSION['name']))
		{
			echo "<form name='input' action='functions/vote.php' method='post' class='vote'>";
			echo "<input type='hidden' name='id' value='$row[id]'>";
			if (!strcmp($val,"1")) {
				echo "<input type='hidden' name='val' value='0'>";
				echo "<input class='inputfield active' type='submit' value='+' id='voteright'>";
			} else {
				echo "<input type='hidden' name='val' value='1'>";
				echo "<input class='inputfield' type='submit' value='+' id='voteright'>";
			}
			echo "</form>";
		} else {
			echo "<span class='vote'>+</span>";
		}
        
//         echo "<form name='input' action='functions/update.php' method='post'>";
//         echo "<input type='hidden' name='id' value='$row[id]'>";
//         echo "<span class='inputtext'>Notizen:</span><textarea class='inputfield' name='notizen' placeholder='$row[notizen]' maxlength='90'></textarea>";
//         echo "<input class='inputfield' type='submit' value='Ändern'>";
//         echo "</form>";
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
			if (isset($_SESSION['name']))
			{
				if ($_SESSION['name'] == $crow['user'])
				{
					echo "<div class='csubmit'>";
					echo "<form name='delcomment' action='functions/delcomment.php' method='post'>";
					echo "<input type='hidden' name='id' value='$crow[cid]'>";
					echo "<input type='submit' value='löschen' class='cisubmitsmall'>";
					echo "</form></div>";
				}
				}
			echo "</div>";
		}
        echo "<div class='comment'><form name='comment' action='functions/comment.php' method='post'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<div class='cname'>$_SESSION[name]";
        echo "</div>";
        echo "<div class='ccomment'>";
        echo "<input type='inputtext' name='comment' maxlength='200' class='cicomment'>";
        echo "</div>";
        echo "<div class='csubmit'>";
        echo "<input type='submit' value='kommentieren' class='cisubmitsmall'>";
        echo "</div>";
        echo "</form></div>";
        echo "</div>";
    
    }

    mysqli_close($con);
?>
                <a href="hosts.php" class="button">
                    Ferienwohnungen bearbeiten
                </a>            
            </div>
            <div class="footer">
                (c) 2014 Powerswitch Entertainment, <a href="http://www.powerswitch-entertainment.de/index.php?option=com_contact&view=contact&id=1&Itemid=54">Impressum</a>
            </div>
        </div>
    </body>
</html>
