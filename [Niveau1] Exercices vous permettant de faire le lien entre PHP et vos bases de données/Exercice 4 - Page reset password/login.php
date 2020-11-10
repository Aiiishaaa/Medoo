<?php      
include ("database.php");

$login = $_POST['login'];
$password = $_POST['password'];

    if (isset($_POST['submit'])) {
         if (!empty($login) && !empty($password)) {
                    date_default_timezone_set('Europe/Paris');
                    setlocale(LC_TIME,"fr_FR.UTF-8", "French_France.1252");
                    $date = date('Y-m-d H:i:s');
                    
                    $data = $database->get('connexions','*',['email'=>$login]);

                    var_dump($data);
                    if($data)
                        {      if($data['password']){
                                echo '<script type="text/javascript">';
                                echo 'alert (" Vous êtes connectés !")';
                                echo '</script>';

                                $_SESSION['connexions'] = $data['email'];

                                header("location:home.php");
                              
                                $database->insert('connexions',[
                                    'email'=>$login,
                                    'password'=>$result,
                                    'date'=>$date     
                                ]);

                                var_dump($database)."<br><br>";
                            }
                            else{
                                echo '<script type="text/javascript">';
                                echo 'alert ("Les identifiants saisis sont incorrectes !")';
                                echo '</script>';
                            }
            
                    }
        
                        else{
  
                                echo '<script type="text/javascript">';
                                echo 'alert ("Renseignez votre email et votre mot de passe")';
                                echo '</script>';
                        }
                    }
        }
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page reset password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      
        fieldset { 
    
            margin-top: 10%;
            margin-right: 60%;
            margin-left: 10%;
        }
        button{
            margin-left: 20%;
        }
        a{
            margin-left: 10%;
        }

    </style>
    
</head>
<body>
   <fieldset>  
    <legend>Inscription</legend>
    <form method="post" action="login.php">
 
        <div class="form-group">
            <label for="ilogin">Login :</label>
            <input type="email" name="login" id="ilogin" placeholder="xxx.xxx@xxx.xx">
        </div>
        <div class="form-group">
            <label for="ipassword">Mot de passe:</label>
            <input type="text" name="password" id="ipassword">
        </div>
        <button name="submit">Valider</button>
        <br>
        <a  href="resetpassword.php" >Mot de passe oublié</a>
    </form>
    </fieldset>
</body>
</html>