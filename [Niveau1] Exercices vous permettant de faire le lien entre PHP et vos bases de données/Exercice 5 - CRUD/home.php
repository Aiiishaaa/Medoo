<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Page D'acceuil</title>
    </head>
<style>
     div 
     {
         margin-top: 10%;
         margin-bottom: 5%;
         font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
         font-size:40px;
         text-align: center;

     }
     a{
         font-size: 20px;
         float: right;
         margin-top: 20px;
         margin-right: 20%;
     }
    .favorite {
        margin-left: 43%;
    }
    .styled {
    border: 0;
    line-height: 2.5;
    padding: 0 20px;
    font-size: 1rem;
    text-align: center;
    color: #fff;
    text-shadow: 1px 1px 1px #000;
    border-radius: 10px;
    background-color: rgba(20, 10, 100, 1);
    background-image: linear-gradient(to top left,
                                      rgba(0, 0, 0, .2),
                                      rgba(0, 0, 0, .2) 30%,
                                      rgba(0, 0, 0, 0));
    box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .6),
                inset -2px -2px 3px rgba(0, 0, 0, .6);
}

.styled:hover {
    background-color: rgba(255, 0, 0, 1);
}

.styled:active {
    box-shadow: inset -2px -2px 3px rgba(255, 255, 255, .6),
                inset 2px 2px 3px rgba(0, 0, 0, .6);
}

    </style>
    <body>
        <?php 
            session_start();
            echo '<div>';
            echo ' Vous êtes connecté !';
            echo '</div>';
           
        ?>
        <button class="favorite styled"
        type="button"> Modifier    
        </button>

        <button class="styled"
        type="button"> Supprimer    
        </button>
         <br>
        <a href="login.php">Se déconnecter</a>
    </body>

    </html>