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
            margin-left: 40%;
            margin-top: 10%;
        }
    </style>
    
</head>
<body>

<form method="post" action="#">
    <div class="form-group">
    <label for="imail">Taper votre adresse mail :</label>
    <input type="email" name="email" id="imail" placeholder="Alex@yahoo.fr">
    </div>
    <button name="submit">Envoyer</button>
</form>



<?php
    if (isset($_POST['submit']))
        {
        $email=$_POST['email'];
        $bdd = new PDO('mysql:host=localhost;dbname=connection;charset=utf8','root','');
        $req = $bdd->prepare('SELECT login FROM connexions WHERE login = ? ');
        $req-> execute();
        $result=$sql-> fetch ();
        if (!$result ) {
            echo '<script type="text/javascript">';
            echo 'alert ("Adresse email inexistante !")';
            echo '</script>';
        }
         else 
        {

        }

                
        }
?>


</body>
</html>