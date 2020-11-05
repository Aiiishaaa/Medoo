<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Page D'acceuil</title>
    </head>

    <body>
        <a href="login.php">Se déconnecter</a>
        <?php 
            session_start();
            echo $_SESSION["login"];
            echo " Vous êtes connecté !"; 
        ?>
        </body>

    </html>