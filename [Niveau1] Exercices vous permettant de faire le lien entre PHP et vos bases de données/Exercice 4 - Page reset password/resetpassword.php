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
         fieldset{
            margin-left: 30%;
            font-family: Tahoma, sans-serif;
            width: 38%;
            height: 250px;
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
      legend {
          text-align: center;
          margin-bottom:10%;
      }
      button{
          margin-left: 30%;
      }
    </style>
    
</head>
<body>
<fieldset>
       <legend><h1> Réinitailisation du mot de passe</h1></legend>
<form action="#" method="POST">

<div class="form-group">
<label for="imail">Saisissez votre adresse mail :</label>
<br>
<input type="email" name="email" placeholder=" xxx.xxx@xxx.xx"/><br/><br/>
</div>
<div class="form-group">
    <button name="submit" class ="btn btn-dark mb-5 ">Envoyer</button>
</div>
</form>

<?php
        session_start();
        require ("database.php");
        if(isset($_POST['submit'])){
            include "sendemail.php";
            $email= htmlspecialchars($_POST['email']);
            if(!empty($email)){
       
                $email_exist = $database -> get ('connexions','*',['email'=>$email]);
               
                if($email_exist ){

                        $_SESSION['connexions']= $email_exist['id'];

                        $token = bin2hex(random_bytes(32));

                        $to = 'aicha.hamida06@yahoo.fr';
                        $subject= "Récuperatuion mot de passe";
                        $body = "<p> Vous pouvez récuperer votre mot de passe via ce lien: <a href='http://localhost/Medoo/%5bNiveau1%5d%20Exercices%20vous%20permettant%20de%20faire%20le%20lien%20entre%20PHP%20et%20vos%20bases%20de%20donn%c3%a9es/Exercice%204%20-%20Page%20reset%20password/newpasseword.php?token=".$token."'>http://localhost/Medoo/%5bNiveau1%5d%20Exercices%20vous%20permettant%20de%20faire%20le%20lien%20entre%20PHP%20et%20vos%20bases%20de%20donn%c3%a9es/Exercice%204%20-%20Page%20reset%20password/newpasseword.php?token=".$token."</a></p>";
                    
                    send_mail($to,$subject,$body);  

                    echo '<script type="text/javascript">';
                    echo 'alert (" Consultez votre boite mail !")';
                    echo '</script>';

                }
                    else{
                        echo '<script type="text/javascript">';
                        echo 'alert ("Adresse mail inexistante !")';
                        echo '</script>';
                    }
    }
    else{

        echo '<script type="text/javascript">';
        echo 'alert ("Remplissez le champs email !")';
        echo '</script>';    }
}
?>
