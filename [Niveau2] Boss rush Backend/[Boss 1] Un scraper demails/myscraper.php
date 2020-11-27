<?php
include_once "email_scraper.php";
include_once "Medoo.php";

use Medoo\Medoo;

//Se connecter à la data base
        function base()
        {
            $database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'scraper',         
            'server' => 'localhost',         
            'username' => 'root',
            'password' => ''     
            ]);
    
            return $database;
        }


//Insertion
        function getEmail($url)
        {
            $emails = scrape_email($url);
            foreach ($emails as $mail) {

                base()->insert("emails", ["email" => $mail]);
            }
        }


//Récuperation des emails à partir d'url entrée dans l'input
        if (isset($_POST["submit"])) {
            $url = htmlspecialchars($_POST["url"]);
            getEmail($url);
        }


//Récuperation les emails qui sont dans la database
        $req = base()->select("emails", ['email']);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Scraper d'emails</title>
</head>

<body>
    <h1 class="text-center"> Le scraper d’emails </h1>
    
    <div class="container p-2">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <form action="" method="post">
                        <div class="form-group d-flex justify-content-center">
                            <input class="form-control form-control" type="url" id="url" name="url" placeholder="https://exemples.com">
                        </div>
                        <div class="d-flex justify-content-center">
                            <input class='btn btn-primary' type="submit" value="Envoyer" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
        <h4 class="text-center"> La liste des emails :</h4>
            <div class="col-12">
                <table class='table table-light table-hover table-striped table-bordered table-sm'>
                    <?php $i = 0;
                    foreach ($req as $email) : $i++ ?>
                        <?php if ($i == 1) : ?>
                            <tr>
                            <?php endif; ?>

                            <td class="text-center m-0"><?= $email['email'] ?></td>
                            <?php if ($i == 6) : $i = 0 ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if ($i != 0) : ?>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
