
<?php
    session_start();
    require ("database.php");

    $token = $_GET[$token];
 /* vérifier l'existance de token dans base de données si oui récupérer l'email associé  "pour l'utiliser dans update" */
    if(isset($_POST['submit'])){

        if(!empty($_POST['password']) && !empty($_POST['verifpassword'])){

            $mdp = htmlspecialchars($_POST['password']);
            $mdp2 = htmlspecialchars($_POST['verifpassword']);

                if($mdp !== $mdp2){

                    echo'<script type="text/javascript">';
                    echo'alert("Vos deux mots de passes ne sont pas indentiques!")';
                    echo'</script>';

                    if (!preg_match ( "/^[a-zA-Z0-9_-]{8,40}$/i", $mdp)){
                        echo '<script type="text/javascript">';
                        echo 'alert("Le mot de passe doit contenir au moins 8 caractéres sans espaces")';
                        echo  '</script>'; 
                    }
                }

            else{
                $database-> update('connexions', ['password'=>$mdp], ['email'=>$email]);
        
            }
        }
  
        else{
            echo '<script type="text/javascript">';
            echo 'alert("Veuillez renseigner le nouveau mot de passe")';
            echo  '</script>'; 
        }
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe</title>
</head>
<style>
    button{
       margin-left:70%;
    }
    legend{
        text-align: center;
    }
    fieldset {
            margin-right: 60%;
            margin-left: 20%;
            padding-top: 20px;
    }
    div{
        margin-bottom: 30px;
    }
    input{
        margin-top: 10px;
    }
</style>
<body>
<body>
<fieldset>
       <legend > Réinitailisation du mot de passe </legend>
    <form method="post" action="#">
  

        <div class="form-group">
            <label for="ipwd"> Taper votre nouveau mot de passe :</label>
            <input type="text" name="password" id="ipwd">
        </div>
        <div class="form-group">
            <label for="ipasswordverif"> Confirmer le mot de passe :</label>
            <input type="text" name="verifpassword" id="ipasswordverif">
        </div>
        <button name="submit">Valider</button>
      
    </form>
</fieldset>
</body>
</html>