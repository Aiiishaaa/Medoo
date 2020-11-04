
<?php
 include 'database.php';
          
       if (isset($_POST["submit"])) {

            $login = htmlspecialchars($_POST["login"]);
            $isValidLogin = !empty($login);
    
            $password = htmlspecialchars($_POST["password"]);
            $isValidPassword = !empty($password);

            $tentative = date ('Y-m-d H:i:s') ;

        $isValidAll = $isValidLogin && $isValidPassword && $tentative;
        
            if ($isValidAll){
                $database -> insert ("connexions" , [
                "login"=> $login,
                "password"=> $password,
                "date"=> $tentative
               ]);
        
            echo '<script type="text/javascript">';
            echo 'alert("Votre compte a été créé !")';
            echo  '</script>'; 
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
           <title> Page Login </title>
       </head>
       <style>
        fieldset {
            margin-right: 70%;
            margin-left: 20%;
        }
        div {
            margin:20px;
        }
      </style>
       
       <body>
       <fieldset>
       <legend >Connexion :</legend>
           <form class="form__group" action="login.php" method="post">
       
               <div class="form__group">
                   <label for="login" class="form__label">Login :</label>
                   <input type="text" name="login" id="login" class="form__input">
               </div>
       
               <div class="form__group">
                   <label for="password" class="form__label">Mot de passe :</label>
                   <input type="text" name="password" id="password" class="form__input">
               </div>
       
               <div class="form__group">
                   <input type="submit" value="Envoyer" name="submit" class="form__input">
               </div>
       
           </form>
       </fieldset>
       </body>
       
       </html>