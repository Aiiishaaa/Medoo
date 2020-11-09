<?php 
include 'database.php';
?>
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
 <title> Page D'acceuil</title>
    </head>
<style>
     header {
        text-align: center;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
     }
  .bienvenue 
     {
       
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

        <header class="container-fluid bg-primary  p-2">
            <h4 class="text-white">Mon premier CRUD</h4>
       
        <?php 
            session_start();
            echo '<div class="bienvenue">';
            echo ' Bienvenue !';
            echo '</div>';
           
        ?> 
        </header>
            
        <div class="container w-75  pt-5"> 
            <h3 class="text-center">Liste d'utilisateurs</h3>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <th class="text-center text-white ">ID</th>
                    <th class="text-center text-white"> Nom:</th>
                    <th class="text-center text-white"> Prénom:</th>
                    <th class="text-center text-white">mot de passe:</th>
                    <th class="text-center text-white">Email: </th>
                    <th class="text-center text-white"> Statut:</th>
                    <th class="text-center text-white"> Action : </th>
                </thead>
                <tbody>
                    <?php
                       $count = $database->count("utilisateurs");
                   
                     var_dump($count);
                     foreach($count as $utilisateurs) { ?>
                    <tr>
                        <td class="text-center m-0"><?= $utilisateurs ['ID'] ?></td>
                        <td class="text-cente m-0"><?= $utilisateurs ['nom'] ?></td>
                        <td class="text-center m-0"><?= $utilisateurs ['prenom'] ?></td>
                        <td class="text-center m-0"><?= $utilisateurs ['motdepasse'] ?></td>
                        <td class="text-center m-0"><?= $utilisateurs ['email'] ?></td>
                        <td class="text-center m-0"><?= $utilisateurs ['statut'] ?></td>
                         
                        <td class="text-center m-0"> 
                        <button class="styled" type="button"> Modifier    
                            </button>
                        <button class="styled" type="button"> Supprimer    
                            </button>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
            <a href="signin.php" class="btn btn-success btn-sm"> Ajouter un utilisiteur</a>
        </div>


        <footer class=" container-fluid bg-primary fixed-bottom">
            <a href="login.php"> Se déconnecter</a>

        </footer>
    </body>

    </html>