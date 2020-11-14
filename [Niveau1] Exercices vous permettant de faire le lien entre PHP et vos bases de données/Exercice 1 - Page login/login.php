
<?php
 include 'database.php';
          
       if (isset($_POST["submit"])) {

            $login = $_POST["login"];
            $isValidLogin = !empty($login);
    
            $password = htmlspecialchars($_POST["password"]);
            $isValidPassword = !empty($password);

            $tentative = date ('Y-m-d H:i:s') ;

        $isValidAll = $isValidLogin && $isValidPassword && $tentative;
        
            if ($isValidAll){

                 $Userexist = $database-> get ("connexions" , '*',[
                 "email"=> $login]);

                if ($Userexist) {
                    echo '<script type="text/javascript">';
                    echo 'alert(" Vous avez déja un compte!")';
                    echo  '</script>';

                } 
                else {
                $database -> insert ("connexions" , [
                "email"=> $login,
                "password"=> $password,
                "date"=> $tentative
               ]);
        
            echo '<script type="text/javascript">';
            echo 'alert("Votre compte a été créé !")';
            echo  '</script>'; 
                }
           
            }
    else
            {
            echo '<script type="text/javascript">';
            echo 'alert(" Les champs sont vides !")';
            echo  '</script>';
            }

    }
?>
       
       
       <!DOCTYPE html>
       <html lang="fr">
       
       <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
           <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
           <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
           <title> Page Login </title>
       </head>
       <style>
       
        fieldset {
            width: 20%;
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
        div {
            margin:30px;
        }
        legend{
            text-align: center;
        }
        ::placeholder {
        color: hsl(30, 100%, 50%);
        font-family: 'Times New Roman', Times, serif;
        font-weight: bolder;
        opacity: 1; 
        }
        button{
           margin-left: 30%;
        }
        body {
                font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
      </style>
       
       <body>
       
       <fieldset>
           
         <legend><h1>Connexion</h1></legend>
           <form class="form__group" action="login.php" method="post">
       
               <div class="form__group">
                   <input type="text" name="login" id="login" class="form__input" placeholder="Login">
               </div>
       
               <div class="form__group">
                   <input type="text" name="password" id="password"  placeholder="Password">
               </div>
       
            <button type="submit" name="submit" class="btn btn-dark mb-5"> Envoyer </button>
               
           </form>
        
        </fieldset>
     
       </body>
       
       </html>