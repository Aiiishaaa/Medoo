<?php      
include ("database.php");

$email= $_POST['email'];
$password = $_POST['password'];

    if (isset($_POST['submit'])) {

         if (!empty($email) && !empty($password)) {
                    date_default_timezone_set('Europe/Paris');
                    setlocale(LC_TIME,"fr_FR.UTF-8", "French_France.1252");
                    $date = date('Y-m-d H:i:s');
                    
                    $data = $database->get('utilisateurs','*',['email'=>$email]);

                    var_dump($data);
                    if($data)
                        {      if($data['motdepasse'] == $password ){
                                echo '<script type="text/javascript">';
                                echo 'alert (" Vous êtes connectés !")';
                                echo '</script>';

                                $_SESSION['utilisateurs'] = $data['email'];

                                header("location:home.php");
                
                            }
                            else{
                                echo '<script type="text/javascript">';
                                echo 'alert ("Les identifiants saisis sont incorrectes !")';
                                echo '</script>';
                            }
            
                    } 
                    else{
                        echo '<script type="text/javascript">';
                        echo 'alert (" Vous n\'êtes pas inscrits !")';
                        echo '</script>';
                    }
                 } 
         
            else{
  
                echo '<script type="text/javascript">';
                echo 'alert ("Renseignez votre email et votre mot de passe")';
                 echo '</script>';
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
      
      form{ 
        margin: 0 auto;
        width: 400px;
        padding: 2em;
        border: 1px solid #CCC;
        border-radius: 1em;
        box-shadow: inset 0 0 1em red;
        }

        .styled {
    border: 0;
    width: 10rem;
    line-height: 2.5;
    padding: 0 20px;
    font-size: 1rem;
    text-align: center;
    color: #fff;
    text-shadow: 1px 1px 1px #000;
    border-radius: 10px;
    background-color: rgba(20, 10, 100, 1);
    background-image: linear-gradient(to top left,
                                      rgba(0, 0, 0, .2),
                                      rgba(0, 0, 0, .2) 30%,
                                      rgba(0, 0, 0, 0));
    box-shadow: inset 2px 2px 3px rgba(255, 255, 255, .6),
                inset -2px -2px 3px rgba(0, 0, 0, .6);
}

.styled:hover {
    background-color: rgba(255, 0, 0, 1);
}

.styled:active {
    box-shadow: inset -2px -2px 3px rgba(255, 255, 255, .6),
                inset 2px 2px 3px rgba(0, 0, 0, .6);
}
    </style>
    
</head>
<body>

    <form method="post" action="login.php">
     
  
        <div class="form-group">
            <label for="ilogin">Login :</label>
            <input type="email" name="email" id="imail" placeholder="xxx.xxx@xxx.xx">
        </div>
        <div class="form-group">
            <label for="ipassword">Mot de passe:</label>
            <input type="text" name="password" id="ipassword">
        </div>
        <button name="submit" class="styled" >SE CONNECTER</button>
        <a href="signin.php" class="btn styled" > S'INSCRIRE</button></a>
    </form>

</body>
</html>