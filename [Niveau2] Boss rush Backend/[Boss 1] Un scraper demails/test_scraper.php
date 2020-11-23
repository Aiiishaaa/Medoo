<?php 
include_once 'email_scraper.php';
include_once 'myscraper.php';
if (isset($_POST['submit'])) {
    $url = $_POST['url'];
    $emails = scrape_email($url);
    if (!empty($emails)) {
        myscraper($emails);
    } 
    else
    {
        echo 'Aucune email trouvée';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title> Un scraper d'emails </title>
</head>

<body>
    <form action="" method="POST">
        <div class="form-group">
            <label for="url">Entrez une URL</label>
            <input type="text" id="url" name="url">
            <button type="submit" name="submit">Rechercher</button>
        </div>
        <table>
            <?php 
            
            for () { 
                echo '<tr>';

                echo '</tr>';
            };
            
            ?>
        </table>
    </form>
</body>

</html>