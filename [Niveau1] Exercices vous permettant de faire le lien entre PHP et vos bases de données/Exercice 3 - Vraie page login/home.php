<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Page D'acceuil</title>
    </head>
     <style>
    div {
        font-family: Tahoma, sans-serif;
        font-style: italic;
        font-size: 30px;
        width: 50%;
        height: 100px;
        margin: 0 auto;
        background-image: -moz-linear-gradient( 136deg, rgb(254,225,64) 0%, rgb(250,112,154) 100%);
        background-image: -webkit-linear-gradient( 136deg, rgb(254,225,64) 0%, rgb(250,112,154) 100%);
        background-image: -ms-linear-gradient( 136deg, rgb(254,225,64) 0%, rgb(250,112,154) 100%);
        display: flex;
        display: -webkit-flex;
        justify-content: center;
        -o-justify-content: center;
        -ms-justify-content: center;
        -moz-justify-content: center;
        -webkit-justify-content: center;
        align-items: center;
        -o-align-items: center;
        -ms-align-items: center;
        -moz-align-items: center;
        -webkit-align-items: center;
     }
 
    a{
        float: right;
        margin-right: 10em;
      }
     </style>

    <body>
    
        <?php 
            session_start();
            echo " <div>  Connexion établie !</div>"; 
        ?>    
        
        <a href="login.php">Se déconnecter</a>
        </body>

    </html>