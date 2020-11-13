<?php  
 include_once 'database.php';  

    if (isset($_POST['submit']))
        {
            $login =htmlspecialchars($_POST['login']) ;
            $password =htmlspecialchars($_POST['password']);

            if (!empty($login) && !empty($password))
                {
                
                   $resultat = $database -> get ('connexions','*', [ 'email'=> $login ]);
                    var_dump($resultat);
 
                    if ($resultat || password_verify($password, $resultat[$password]))
                    {
                        session_start();
                        $_SESSION["email"] = $login;
                        header("location: home.php");
                    }
                    else 
                    {    
                    
                    if(!isset($tentative))
                            {
                            // Initialisation de la variable
                            $tentative = 5;
                            // Blocage pendant 15 min
                            $_SESSION['timestamp_limite'] = time() + 60*15;
                            }
                    if($tentative <= 5)
                            {
                                $tentative--;
                                echo '<script type="text/javascript">';
                                echo 'alert("Mots de passe incorrect! il vous reste".$tentative."tentative")';
                                echo  '</script>';                            
                            }
                        // Si on a dépassé les 5 tentatives
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
            else
                {
                    echo '<script type="text/javascript">';
                    echo 'alert ("Remplissez les champs !")';
                    echo '</script>';
                }
        }

        
        ?>

<!DOCTYPE html>
<html lang="en">
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
     
        fieldset {
            margin-top: 5%;
            margin-right: 70%;
            margin-left: 20%;
        }
        div {
            margin:20px;
        }
         button{
            margin-left:40%;

         }
    </style>
    
</head>
<body>
<fieldset>
 
    <form method="post" action="login.php">
    <h4> Se connecter:</h4>
        <div class="form-group">
            <label for="ilogin">Login:</label>
            <input type="email" name="login" id="ilogin" placeholder="xxx.xxx@xxx.xx">
        </div>
        <div class="form-group">
            <label for="ipassword">Mot de passe:</label>
            <input type="text" name="password" id="ipassword">
        </div>
        <button name="submit">Valider</button>
    </form>
</fieldset>
</body>
</html>