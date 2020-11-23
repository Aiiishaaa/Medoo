<?php
include_once "email_scraper.php";
include_once "database.php";


function test_input($data)
{
    $data = trim($data); //Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); //Remove backslashes
    $data = htmlspecialchars($data); //converts special characters to HTML entities to avoid malicious code injection
    return $data;
}

if (!isset($emails)) {
    $emails = [];
}

if (isset($_POST['url'])) {
    $url = test_input($_POST['url']);
    $emails = scrape_email($url);
    if (empty($emails)) {
        echo "<p>Aucune adresse email n'a pu être récupéré à cette URL!</p>";
    } else {
        $datas = [];
        $existingEmails = [];
        $newEmails = [];
        $nbEmailFound = 0;
        $nbEmailAlreadyExisting = 0;
        $nbNewEmail = 0;
        foreach ($emails as $email) {
            $nbEmailFound++;
            $emailInDdb = dbInit()->get('emails', 'email', ['email' => $email]);
            if (!$emailInDdb) {
                $nbNewEmail++;
                $data = ['email' => $email];
                array_push($datas, $data);
                array_push($newEmails, $email);
            } else {
                $nbEmailAlreadyExisting++;
                array_push($existingEmails, $email);
            }
        }
        dbInit()->insert('emails', $datas);
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <title>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
    <script>
        $(function() {
            $('#all').click(function() {
                if ($('#divAll').hasClass('hidden')) {
                    $('#divAll').removeClass('hidden');
                    if (!$('#divExisting').hasClass('hidden')) {
                        $('#divExisting').addClass('hidden');
                        $("#existing").prop("value", "Afficher");
                    }
                    if (!$('#divNew').hasClass('hidden')) {
                        $('#divNew').addClass('hidden');
                        $("#new").prop("value", "Afficher");
                    }
                    $("#all").prop("value", "Cacher");
                }else{
                    $('#divAll').addClass('hidden');
                    $("#all").prop("value", "Afficher");
                }

            });
            $('#existing').click(function() {
                if ($('#divExisting').hasClass('hidden')) {
                    $('#divExisting').removeClass('hidden');
                    if (!$('#divAll').hasClass('hidden')) {
                        $('#divAll').addClass('hidden');
                        $("#all").prop("value", "Afficher");
                    }
                    if (!$('#divNew').hasClass('hidden')) {
                        $('#divNew').addClass('hidden');
                        $("#new").prop("value", "Afficher");
                    }
                    $("#existing").prop("value", "Cacher");
                }else{
                    $('#divExisting').addClass('hidden');
                    $("#existing").prop("value", "Afficher");
                }
            });
            $('#new').click(function() {
                if ($('#divNew').hasClass('hidden')) {
                    $('#divNew').removeClass('hidden');
                    if (!$('#divExisting').hasClass('hidden')) {
                        $('#divExisting').addClass('hidden');
                        $("#existing").prop("value", "Afficher");
                    }
                    if (!$('#divAll').hasClass('hidden')) {
                        $('#divAll').addClass('hidden');
                        $("#all").prop("value", "Afficher");
                    }
                    $("#new").prop("value", "Cacher");
                }else{
                    $('#divNew').addClass('hidden');
                    $("#new").prop("value", "Afficher");
                }
            });
        });
    </script>
    <title>Email scraper</title>
</head>

<body>
<div>
    <form action="" method="POST">
        <label for="url">Url :</label>
        <input type="text" id="url" name='url'>
        <button type="submit">Envoyer</button>
    </form>
</div>

    <?php if (isset($nbEmailFound) && $nbEmailFound != 0) : ?>
        <div class="d-flex">
            <div class="m-3">
                <p>Nombre d'emails trouvés : <?php echo $nbEmailFound; ?></p>
                <input type="button" id="all" value="Afficher">
            </div>
            <?php if ($nbNewEmail != 0) : ?>
                <div class="m-3">
                    <p>Nombre d'emails n'étant pas déjà dans la base de donnée : <?php echo $nbNewEmail; ?></p>
                    <input type="button" id="new" value="Afficher">
                </div>
            <?php endif; ?>
            <?php if ($nbEmailAlreadyExisting != 0) : ?>
                <div class="m-3">
                    <p>Nombre d'emails existant déjà dans la base de donnée : <?php echo $nbEmailAlreadyExisting; ?></p>
                    <input type="button" id="existing" value="Afficher">
                </div>
            <?php endif; ?>
        </div>
        <div id="divAll" class='hidden m-5'>
            <h3>Emails trouvés</h3>
            <table class='table table-bordered table-hover table-striped'>

                <?php $i = 0;
                foreach ($emails as $email) : $i++ ?>

                    <?php if ($i == 1) : ?>
                        <tr>
                        <?php endif; ?>

                        <td><?php echo $email; ?></td>

                        <?php if ($i == 8) : $i = 0 ?>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>
                <?php if ($i != 0) : ?>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <div id="divExisting" class='hidden m-5'>
            <h3>Emails, déjà dans la base de donnée, trouvés</h3>
            <table class='table table-bordered table-hover table-striped'>

                <?php $i = 0;
                foreach ($existingEmails as $email) : $i++ ?>

                    <?php if ($i == 1) : ?>
                        <tr>
                        <?php endif; ?>

                        <td><?php echo $email; ?></td>

                        <?php if ($i == 8) : $i = 0 ?>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>
                <?php if ($i != 0) : ?>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <div id="divNew" class='hidden m-5'>
            <h3>Nouveaux emails trouvés</h3>
            <table class='table table-bordered table-hover table-striped'>

                <?php $i = 0;
                foreach ($newEmails as $email) : $i++ ?>

                    <?php if ($i == 1) : ?>
                        <tr>
                        <?php endif; ?>

                        <td><?php echo $email; ?></td>

                        <?php if ($i == 8) : $i = 0 ?>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>
                <?php if ($i != 0) : ?>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

    <?php endif; ?>