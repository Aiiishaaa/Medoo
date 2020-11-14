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
    <html lang="fr">
       
    <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <title> Inscription </title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
       <style>
        fieldset {
            margin-right: 70%;
            font-family: Tahoma, sans-serif;
            width: 20%;
            height: 50%;
            margin: 0 auto;
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
        legend{
            text-align: center;
        }
        div {
            margin:30px ;
        }
      
        button{
            margin-left: 30%;
        }
        a{
            margin-left: 17%;      
        }
      </style>
       
       <body>
       <fieldset>
       <legend ><h1> Inscription </h1></legend>
           <form class="form__group" action="login.php" method="post">
       
        <div class="form-group">
            <label for="ilogin">Login :</label> <br>
            <input type="email" name="login" id="ilogin" placeholder="xxx.xxx@xxx.xx">
        </div>

        <div class="form-group">
            <label for="ipassword">Mot de passe:</label>
            <input type="text" name="password" id="ipassword">
        </div>

        <div class="form-group">
        <button name="submit" class ="btn btn-dark">Valider</button>
        <br>
        <a  href="resetpassword.php" >Mot de passe oublié</a>
        </div>

        </form>
       </fieldset>

       </body>
       </html>