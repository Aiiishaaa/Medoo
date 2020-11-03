<?php
       require_once 'database.php';
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
        margin-left: 300px;
        margin-top: 100px;
    }
    input  {
    margin-left: 50px;
    }
    button{
        margin-top: 50px;
        margin-left: 300px;
    }
    </style>
</head>
<body>



<?php

    if (isset($_POST['confirm'])) {
        $firstName = htmlspecialchars($_POST["firstName"]);
        $isValidfirstName = !empty($firstName);

        $lastName = htmlspecialchars($_POST["lastName"]);
        $isValidlastName = !empty($lastName);

        $password = htmlspecialchars($_POST["password"]);
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
 
                // $base = new PDO('mysql:host=localhost;dbname=connection;charset=utf8', 'root','');
                
               // $queryReq = $base->prepare("SELECT email FROM users WHERE email = :email");
               // $queryReq->bindParam(':email', $email);
               // $queryReq->execute();
               // $data = $queryReq->fetch();

                $data = $database -> get('users','email',['email'=> $email]);
                var_dump($data);

                    if (!$data){

                            $firstName = $_POST['firstName'];
                            $lastName = $_POST['lastName'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                            $info = $_POST['info'];

                            //$base = new PDO('mysql:host=localhost;dbname=connection;charset=utf8', 'root', '');
                            //$sql = "INSERT INTO users(firstName,lastName,password,email,info)VALUES('$firstName','$lastName','$passwordHash','$email','$info')"; 
                            //$base -> query($sql);

                            $database -> insert('users',[
                                'firstName'=>$firstName,
                                'lastName' => $lastName,
                                'password' => $password,
                                'email' => $email,
                                'info' => $info
                            ]);
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
 
 <form action="signin.php" method="post" class="form-group">
 <h2> S'inscrire </h2> <br>
    <div class="form-group">
        <label for="iprenom">Prenom :</label>
        <input type="text" name="firstName" id="iprenom">
    </div>
    <div class="form-group">
        <label for="iname">Nom :</label>
        <input type="text" name="lastName" id="nom">
    </div>

     <div class="form-group">
        <label for="ipassword">Mot de passe:</label>
        <input type="text" name="password" id="ipassword">
    </div>
    <div class="form-group">
        <label for="iconfirmpassword"> Confirmation :</label>
        <input type="text" name="confirmpassword">
    </div>
    <div class="form-group">
        <label for="imail">    Email :</label>
        <input type="text" name="email" id="imail">
    </div>
   
    <div class="form-group">
        <p>Statut :</p>
        <input type="radio" id="ipro" name="info" value="professionnel" >
        <label for="professionnel">Professionnel</label><br>
        <input type="radio" id="ipart" name="info" value="particulier">
        <label for="particulier">Particulier</label> <br>
  
      <input style="margin-top:50px" type="checkbox" name="condition"> Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement.<br>
    <button name="confirm"> Valider</button>  
    </div>  
    </form>
</body>
</html>