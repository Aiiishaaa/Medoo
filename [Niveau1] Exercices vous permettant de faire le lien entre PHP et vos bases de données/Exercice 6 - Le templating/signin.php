<?php
       require 'database.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

    form{
        margin: 20px auto;
        width: 500px;
        padding: 1em;
        border: 1px solid #CCC;
        border-radius: 1em;
    }
    label {
        padding-left: 20px;
        display: inline-block;
        width: 150px;
    }
   
    button  {
        width:100px;
        margin-left:40%;
        box-shadow:1px 1px 1px BLACK;
        cursor:pointer;
    }
    legend{
         font-size: 30px;
         font-family: 'Times New Roman', Times, serif;
         background-color: #000;
         color: #fff;
         padding: 3px 6px;
    }
    .radio {
            margin-left: 30%;
            text-align: left; 
    }
    input[type=radio] {
        background-color:transparent;
        border:none;
        width:10px;
    }

    </style>
</head>
<body>

<?php

    if (isset($_POST['confirm'])) {
        $nom = htmlspecialchars($_POST["nom"]);
        $isValidfirstName = !empty($nom);

        $prenom = htmlspecialchars($_POST["prenom"]);
        $isValidlastName = !empty($prenom);

        $password = htmlspecialchars($_POST["motdepasse"]);
        $isValidpwd = !empty($password);

        $confirmpassword = htmlspecialchars($_POST["confirmpassword"]);
        $isValidconfirmpwd = !empty($confirmpassword);

        $email = htmlspecialchars($_POST["email"]);
        $isValidemail = !empty($email);

        $info = htmlspecialchars($_POST["info"]);
        $isValidinfo = !empty($info);

        $condition = $_POST['condition'];

    if (empty($condition)){
        echo '<script type="text/javascript">';
        echo 'alert("Vous devez accepter les conditions !")'; 
        echo '</script>';
    }

    else{ 
        if( $isValidfirstName && $isValidlastName && $isValidemail && $isValidpwd && $isValidinfo && $isValidconfirmpwd ){ 
            if (!preg_match ( "/^[a-zA-Z0-9_-]{8,40}$/i", $password)){
                echo '<script type="text/javascript">';
                echo 'alert("Le mot de passe doit contenir au moins 8 caractéres sans espaces")';
                echo  '</script>'; 
            }

           else if($password != $confirmpassword ) {
                echo '<script type="text/javascript">';
                echo 'alert("Les mots de passe saisis ne sont pas identiques")';
                echo '</script>';         
            } 
            
            else {
 
                $data = $database -> get('utilisateurs','email',['email'=> $email]);
                var_dump($data);

                    if (!$data){
                            $nom = $_POST['nom'];
                            $prenom = $_POST['prenom'];
                            $motdepasse = $_POST['motdepasse'];
                            $email = $_POST['email'];
                            $info = $_POST['info'];

                            $database -> insert('utilisateurs',[
                                'nom'=> $nom,
                                'prenom' => $prenom,
                                'motdepasse' =>  $motdepasse,
                                'email' => $email,
                                'statut' => $info
                            ]);
                            echo '<script type="text/javascript">';
                            echo 'alert(" Vous venez d\'être inscrit ! ")';
                            echo  '</script>';
                    } 
                    else 
                    {
                            echo '<script type="text/javascript">';
                            echo 'alert("Cet utilisateur existe déja dans la base de données! ")';
                            echo  '</script>';
                    }    
            }
        }
                    else{
                    echo '<script type="text/javascript">';
                    echo 'alert("Tous les champs sont obligatoires !")';
                    echo  '</script>';
                    }
                
    }
}
   
?>

 <form action="#" method="post" class="form-group">
 <fieldset>
  
             <legend> Inscription </legend>
  
    <div class="form-group">
        <label for="iname">Nom:</label>
        <input type="text" name="nom" id="nom">
    </div>

    <div class="form-group">
        <label for="iprenom">Prénom:</label>
        <input type="text" name="prenom" id="iprenom">
    </div>

     <div class="form-group">
        <label for="ipassword">Mot de passe:</label>
        <input type="text" name="motdepasse" id="ipassword">
    </div>

    <div class="form-group">
        <label for="iconfirmpassword">Confirmation:</label>
        <input type="text" name="confirmpassword">
    </div>

    <div class="form-group">
        <label for="imail">Email:</label>
        <input type="text" name="email" id="imail">
    </div>

    <div class="form-group">
        <label>Statut:</label>
         <br>
        <input type="radio" class="radio" id="ipro" name="info" value="professionnel" >
        <label for="professionnel">Professionnel</label><br>
        <input type="radio" class="radio" id="ipart" name="info" value="particulier">
        <label for="particulier" >Particulier</label> <br>
     </div>
 
      <input type="checkbox" class="checkbox" name="condition"> Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement.<br>
      <button  name="confirm"> Enregistrer </button>  
       </fieldset> 
    </form>

 
</body>
</html>