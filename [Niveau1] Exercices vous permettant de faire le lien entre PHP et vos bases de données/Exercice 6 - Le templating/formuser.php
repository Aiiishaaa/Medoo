<?php
include 'database.php';
$message="";

$id = $_GET['id'];

if($id > 0){
    $utilisateur = $database->get("utilisateurs", [
        "ID",
        "nom", 
        "prenom", 
        "email", 
        "statut"
    ], [
        "ID" => $id
    ]);
}


if (isset($_POST["submit"])){

    $id = $_POST["id"];
    $nom =htmlspecialchars($_POST["nom"]);
    $nomValid = !empty($nom);

    $prenom =htmlspecialchars($_POST["prenom"]);
    $prenomValid = !empty($prenom);

    $email = htmlspecialchars($_POST["email"]);
    $emailValid = !empty($email);

    $password =htmlspecialchars($_POST["password"]);
    $confirmPassword=htmlspecialchars($_POST["confirmPassword"]);
    $charPassword = preg_match('@[A-Z]@', $password) && preg_match('@[a-z]@', $password) && preg_match ('@[0-9]@', $password);
    $passwordValid = !empty($password) && $password === $confirmPassword && $charPassword;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
      

    $statut=htmlspecialchars($_POST["statut"]);
    $statutValid = !empty($statut);

    $mentionValid = !empty($_POST['mentions']);

    $succes = $nomValid && $prenomValid && $passwordValid && $mentionValid && $emailValid && $statutValid;

    if($succes){

        $database->update("utilisateurs", [
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "statut" => $statut
        ], [
            "ID" => $id
        ]);
       
    } else {
        header("Location:modif.php");
    }
    header("Location:home.php");
}



  
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include ('style.php')?>
    <title>Exercice1, niveau 2</title>
    </head>

    <body>
   

    <?php include ('header.php')?>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-4">
                <h2 class="text-center">Mise a jour Utilisateurs</h2>
                    <form action="modif.php?id=<?=$utilisateur["ID"];?>" method="post">
                        <input type="hidden" name="id" value="<?= $utilisateur["ID"];?>">
                            <div class="form-group">
                                <label for="login">Nom</label>
                                <input class ="form-control form-control-sm" type="text" id="nom" name="nom" value="<?= $utilisateur ['nom'];?>">
                                    
                                <label for="login">Prénom</label>
                                <input class ="form-control form-control-sm" type="text" id="prenom" name="prenom" value="<?=$utilisateur['prenom']?>">
                                
                                <label for="login">Email</label>
                                <input class ="form-control form-control-sm" type="email" id="email" name="email" value="<?= $utilisateur["email"]?>">
                            
                                <label for="password">Mot de Passe</label>
                                <input class ="form-control form-control-sm" type="password" id="password" name="password">
                            
                                <label for="password">Confirmation du mot de passe</label>
                                <input class ="form-control form-control-sm" type="password" id="confirmPassword" name="confirmPassword">
                        
                                <label for="particulier">Particulier</label>
                                <input  type="radio" id="particulier" name="statut" value="particulier" checked>
                                
                                <label for="professionnel">Professionnel</label>
                                <input  type="radio" id="professionnel" name="statut" value="professionnel">
                            </div>
                            <div class="form-group">
                                    
                                <input type="checkbox" name="mentions" id="mentions">
                                <label for="mentions">Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement</label>
                                    
                                <input class="btn btn-sm btn-secondary" type="submit" value="Mettre a jour" name="submit">     
                            </div>
                    </form>
            </div>
        </div>
    </div>
        <?php include 'footer.php' ?>
    </body>
</html>
