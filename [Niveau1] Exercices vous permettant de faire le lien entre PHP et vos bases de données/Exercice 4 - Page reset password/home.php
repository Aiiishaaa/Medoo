<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Page D'acceuil</title>
    </head>
     <style>
     div {
          text-align: center;
           font-size: 35px;
          font-family: Verdana, Geneva, Tahoma, sans-serif;
          max-width: 30em;                      /* largeur de la fenêtre */
          margin: 1em auto 2em;
          border: 10px solid #F0F0FF;
          overflow: hidden;                     /* masque tout ce qui dépasse */
          box-shadow: 0 .25em .5em #CCC,inset 0 0 1em .25em #CCC;
      
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