<?php        
    if (isset($_POST['submit']))
        {
            $login = $_POST['login'];
            $password = $_POST['password'];
            if (!empty($login) && !empty($password))
                {
                
                    $bdd = new PDO('mysql:host=localhost;dbname=connection;charset=utf8', 'root', '');
                    $req = $bdd->prepare('SELECT * FROM connexions WHERE login = ? AND password = ?');
                    $req-> execute(array(
                        $login,
                        $password));
 
                    $resultat = $req->fetch(PDO::FETCH_ASSOC);
 
                    if ($resultat || password_verify($password, $resultat['password']))
                    {
                        session_start();
                        $_SESSION["login"] = $login;
                        header("location: home.php");
                    }

                    else 
                    {
                            session_start();
                            if ($resultat || password_verify($password, $resultat['password']))
                            {
                                $_SESSION["login"] = $login;
                                header("location: home.php");
                            }

                            else
                            {

                                if(!isset($_SESSION['nombre']))
                                    {
                                    // Initialisation de la variable
                                    $_SESSION['nombre'] = 0;
                                    // Blocage pendant 15 min
                                    $_SESSION['timestamp_limite'] = time() + 60*15;  
                                    }

                                if($_SESSION['nombre'] <= 4)
                                   {
                                    $_SESSION['nombre']++;
                                   }
                                // Si on a dépassé les 10 tentatives
                                else
                                {
                                    // Si le cookie marqueur n'existe pas on le crée
                                    
                                            if(!isset($_COOKIE['marqueur']))
                                            {
                                                $timestamp_marque = time() + 60; // On le marque pendant une minute
                                                            $cookie_vie = time() + 606024; // Durée de vie de 24 heures pour le décalage horaire
                                                setcookie("marqueur", $timestamp_marque, $cookie_vie);
                                            }
                                    // on quitte le script
                                    exit();
                                }

                            }

                    }
                }

            else
                {
                    echo '<script type="text/javascript">';
                    echo 'alert ("Renseignez votre email et votre mot de passe")';
                    echo '</script>';
                }
        }

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
            margin-left: 40%;
            margin-top: 10%;
        }
    </style>
    
</head>
<body>
   
    <form method="post" action="login.php">
    <h3>Initialisation de mot de passe </h3>
        <div class="form-group">
            <label for="ipwd"> Taper votre nouveau mot de passe :</label>
            <input type="text" name="passeword" id="ipwd" placeholder="melanie@yahoo.com">
        </div>
        <div class="form-group">
            <label for="ipasswordverif">Confirmer le mot de passe :</label>
            <input type="text" name="verifpassword" id="ipasswordverif">
        </div>
        <button name="submit">Valider</button>
      
    </form>
    
</body>
</html>