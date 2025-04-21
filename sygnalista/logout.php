<?php 
    require_once("sesja.php");
    session_destroy();
?>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Wylogowano</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
    </head>
    <body>
        <h1 style="text-align: center">Wylogowano</h1>
        <?php
            if(isset($_COOKIE['user']) && isset($_COOKIE['haslo']))
            {
                header('Refresh:1; url=logowanieC.php');
                die();
            }
            else
                header("Refresh:1; url=index.php");
            if(isset($_COOKIE['userA']))
            {
                header('Refresh:1; url=logowanieC.php');
                die();
            }
            else
                header("Refresh:1; url=index.php");
        ?>
    </body>
</html>