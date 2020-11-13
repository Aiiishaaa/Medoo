<?php

include 'database.php';
session_start();

if (!isset($_SESSION["email"])){
    header("Location:login.php");
}


        
$req = $database->select("utilisateurs", [
            "ID",
            "nom",
            "prenom",
            "email",
            "statut"
]);

?>

<!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include ('style.php')?>
        <title>Page d'accueil</title>
    </head>

    <body>
   
    <?php include ('header.php')?>
    
        <div class="container w-75  pt-5"> 
            <h3 class="text-center">Liste d'utilisateur</h3>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <th class="text-center text-white">ID</th>
                    <th class="text-center text-white">Nom</th>
                    <th class="text-center text-white">Prenom</th>
                    <th class="text-center text-white">Email</th>
                    <th class="text-center text-white">Statut</th>
                    <th class="text-center text-white">Action</th>
                </thead>
                <tbody>
                    <?php foreach($req as $utilisateur){ ?>
                    <tr>
                        <td class="text-center m-0"><?= $utilisateur ['ID'] ?></td>
                        <td class="text-cente m-0"><?= $utilisateur ['nom'] ?></td>
                        <td class="text-center m-0"><?= $utilisateur ['prenom'] ?></td>
                        <td class="text-center m-0"><?= $utilisateur ['email'] ?></td>
                        <td class="text-center m-0"><?= $utilisateur ['statut'] ?></td>
                        <td class="text-center m-0"><a href="modif.php?id=<?= $utilisateur ['ID']?>" class="btn btn-secondary btn-sm">Mettre a jour</a>
                        <a href="supp.php?id=<?= $utilisateur ['ID']?>" class="btn btn-danger btn-sm">Supprimer</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="signin.php" class="btn btn-success btn-sm">Ajouter un utilisiteur</a>
        </div>

        <?php include ('footer.php')?>
      

    </body>

    </html>
