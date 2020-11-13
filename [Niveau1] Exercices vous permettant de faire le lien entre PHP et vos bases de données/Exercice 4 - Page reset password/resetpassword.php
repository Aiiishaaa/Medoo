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
            margin-left: 20%;
            margin-top: 10%;
        }
    </style>
    
</head>

<form action="#" method="POST">
<h2> Réinitailisation du mot de passe</h2>
<label for="imail">Saisissez votre adresse mail :</label>
<br><input type="email" name="email" placeholder=" xxx.xxx@xxx.xx"/><br/><br/>
<button name="submit">Envoyer</button>
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
