<?php session_start(); ?>
<html>
    <head>
        <title>Ferienplaner</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="refresh" content="1; URL=../index.php">
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <div class="middle">
            <div class="header">
                Ferienplaner
            </div>
            <div class="content">
                Sie werden angemeldet…
<?php
    $name = $_POST["name"];
    $_SESSION['name'] = $name;
?>
                <br> Vielen Dank! Sie werden zurück geleitet.
            </div>
            <div class="footer">
                (c) 2014 Powerswitch Entertainment, <a href="http://www.powerswitch-entertainment.de/index.php?option=com_contact&view=contact&id=1&Itemid=54">Impressum</a>
            </div>
        </div>
    </body>
</html>