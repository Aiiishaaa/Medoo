
<?php
    require ("database.php");


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
                session_start();
                $email =$_SESSION['email'];
                $database-> update('connexions', ['password'=>$mdp], ['email'=>$email]);
                header('Location:login.php');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    button{
       margin-left:40%;
    }
    legend{
        text-align: center;
    }
    fieldset {
            margin-left:30%;
            width: 40%;
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
  
     label{
         margin-right:40%;
     }
</style>

</head>
<body>
<fieldset>
    <legend > <h1>Réinitailisation du mot de passe </h1></legend>
    <form method="post" action="#">
  

        <div class="form-group">
            <label for="ipwd"> Taper votre nouveau mot de passe :</label>
            <input type="text" name="password" id="ipwd">
        </div>
        <div class="form-group">
            <label for="ipasswordverif"> Confirmer le mot de passe :</label>
            <input type="text" name="verifpassword" id="ipasswordverif">
        </div>
        <div class="form-group">
        <button name="submit" class="btn btn-dark">Valider</button>
        </div>
      
    </form>
</fieldset>
</body>
</html>