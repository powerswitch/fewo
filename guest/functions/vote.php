<?php include("/users/powerswitch/www/fewo/guest/password_protect.php"); ?>
<html>
    <head>
        <title>Ferienplaner</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="refresh" content="2; URL=http://www.powerswitch-entertainment.de/fewo/guest/list.php">
        <link rel="stylesheet" type="text/css" href="../../style.css">
    </head>
    <body>
        <div class="middle">
            <div class="header">
                Ferienplaner
            </div>
            <div class="content">
                Änderungen werden gespeichert…
<?php
	include("../../access/sqlpw.php");
	$con = mysqli_connect('localhost', $sql_user, $sql_pass, $sql_db);
    if (mysqli_connect_errno())
    {
        echo "MySQL-Verbindungsfehler: " . mysqli_connect_error();
    }

    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $result = mysqli_query($con,"SELECT id, stimmen FROM fewo WHERE id='$id'");
    
    while($row = mysqli_fetch_array($result))
    {
        $altstimme = $row['stimmen'];
    }

    $up = mysqli_real_escape_string($con, htmlspecialchars($_POST["up"]));
    $down = mysqli_real_escape_string($con, htmlspecialchars($_POST["down"]));

    if ($up || $down)
    {
        if ($up)
        {
			$altstimme += 1;
        } else {
            $altstimme -= 1;
        }
        $sql="UPDATE fewo SET stimmen='$altstimme' WHERE id='$id';";
    }
   
    if ($sql)
    {
        if (!mysqli_query($con,$sql))
        {
            die('Fehler: ' . mysqli_error($con));
        }
    }

    mysqli_close($con);
?>
                <br> Vielen Dank! Sie werden zurück geleitet.
            </div>
            <div class="footer">
                (c) 2014 Powerswitch Entertainment, <a href="http://www.powerswitch-entertainment.de/index.php?option=com_contact&view=contact&id=1&Itemid=54">Impressum</a>
            </div>
        </div>
    </body>
</html>