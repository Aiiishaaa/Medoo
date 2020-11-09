
<?php
  require 'database.php';
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
        margin: 20px auto;
        width: 500px;
        padding: 1em;
        border: 1px solid #CCC;
        border-radius: 1em;
    }
    label {
        padding-left: 20px;
        display: inline-block;
        width: 150px;
    }
   
    button  {
        width:185px;
        margin-left:32%;
        box-shadow:1px 1px 1px BLACK;
        cursor:pointer;
    }
    legend{
         font-size: 30px;
         font-family: 'Times New Roman', Times, serif;
         background-color: #000;
         color: #fff;
         padding: 3px 6px;
    }
   
    </style>
</head>
<body>

   
?>

 <form action="#" method="post" class="form-group">
 <fieldset>
  
             <legend> MODIFICATION</legend>
  
    <div class="form-group">
        <label for="iname">Nom:</label>
        <input type="text" name="nom" id="nom">
    </div>

    <div class="form-group">
        <label for="iprenom">Prénom:</label>
        <input type="text" name="prenom" id="iprenom">
    </div>

     <div class="form-group">
        <label for="ipassword">Mot de passe:</label>
        <input type="text" name="motdepasse" id="ipassword">
    </div>


    <div class="form-group">
        <label for="imail">Email:</label>
        <input type="text" name="email" id="imail">
    </div>

    <div class="form-group">
        <label for="istatut">Statut:</label>
        <input type="text" name="info" id="istatut">
     </div>
 
      
      <button  name="confirm"> Mettre à jour </button>  
       </fieldset> 
    </form>

 
</body>
</html>