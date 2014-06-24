<html>
    <head>
        <title>Ferienplaner</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="refresh" content="2; URL=../index.php">
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <div class="middle">
            <div class="header">
                Ferienplaner
            </div>
            <div class="content">
                Änderungen werden gespeichert…
<?php
	session_start();

	include("../access/sqlpw.php");
	$con = mysqli_connect('localhost', $sql_user, $sql_pass, $sql_db);
    if (mysqli_connect_errno())
    {
        echo "MySQL-Verbindungsfehler: " . mysqli_connect_error();
    }

	if (isset($_SESSION['name'])) {

		$id = mysqli_real_escape_string($con, $_POST["id"]);
		$val = mysqli_real_escape_string($con, htmlspecialchars($_POST["val"]));
		$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['name']));

		if ($user and $id) {
			if (!mysqli_query($con,"REPLACE INTO fewo_vote(id, user, val) VALUES ('$id', '$user', '$val')"))
			{
				die('Fehler: ' . mysqli_error($con));
			}

			$result = mysqli_query($con,"SELECT SUM(val) AS s FROM fewo_vote WHERE id='$id'");

			while($row = mysqli_fetch_array($result))
			{
				$sum = $row['s'];
			}

			if (!mysqli_query($con,"UPDATE fewo SET stimmen='$sum' WHERE id='$id'"))
			{
				die('Fehler: ' . mysqli_error($con));
			}
		}
	} else {
		echo "<br> Fehler! Nicht angemeldet.";
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