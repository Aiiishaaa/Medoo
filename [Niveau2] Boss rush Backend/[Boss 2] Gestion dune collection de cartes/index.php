<?php

// Chargement des fichiers nécessaires
require_once ("Constants.php") ; // les constantes utilisées partout dans le projet
require_once('Card.php'); // la classe Card
require_once ("MKMParser.php") ; // la classe qui analysera les infos de chaque carte
require_once('Stats.php'); // micro module statistiques


/****** On commence par traiter les paramètres potentiellement fournis à la page *****/
$sort = "pd" ; // ordre de tri par défaut."pd" = price descending (prix décroissant)
if (isset($_GET['sort'])) // un un paramètre "sort" a été fourni à la page, c'est cette valeur qu'on garde
{
	$sort = $_GET['sort'] ;
}
$all_cards = Card::getAllCards($sort) ; // on charge l'ensemble des cartes avec l'ordre de tri choisi

if (isset($_GET['update'])) // si on a un paramètre "update" on va effectuer une mise à jour
{
    if ($_GET['update'] == "all") // si update = all, on va mettre à jour l'ensemble des cartes de la collection
    {
        $i_start = 0 ;
        $i_end = sizeof($all_cards) ;
        for ($i = $i_start ; $i < $i_end ; $i++) // on itère sur toutes les cartes
        {
            $carte = $all_cards[$i] ;
            $parser = new MKMParser($carte); // on prépare l'analyseur pour la carte en cours
            $parser->update_carte() ; // on exécute la fonction de mise à jour de la carte
        }
    }
    else // si on est sur le cas de la mise à jour d'une carte unique
    {
        $carte = new Card($_GET['update']) ;
        $parser = new MKMParser($carte); // on prépare l'analyseur pour la carte en question
        $parser->update_carte() ; // on exécute la fonction de mise à jour de la carte
    }
	$all_cards = Card::getAllCards($sort) ; // et finalement on recharge les cartes de la collection avec leurs nouvelles valeurs pour les afficher
}
/********** fin du traitement des paramètres ******/

$stats = new Stats() ; // on charge les statistiques (pour les afficher plus loin dans le code)

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="robots" content="noindex">
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <title>Collection Magic: the Gathering</title>
        <!-- on utilise bootstrap et jquery -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script
                src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- on va utiliser une library pour faire du lazyloading -->
        <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>

        <!--- jquery UI est utilisé pour le module de complétion automatique des noms -->
        <link href="css/jquery-ui.min.css" rel="stylesheet"/>
        <script src="js/jquery-ui.min.js"></script>
        <!-- feuille css perso -->
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <!-- script js perso -->
        <script src="js/script.js"></script>
        <script> // on charge dynamiquement la liste de toutes les cartes au format JSON pour alimenter le module d'autocompétion dans la recherche
            let datas = <?= Card::getJSONNames() ?></script>
	</head>
	<body>

        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top mb-2">
                <a class="navbar-brand" href="./index.php"><img class="logo" src="img/favicon.png"/></a>
                <a class="navbar-brand" href="./index.php">Magic: The Gathering</a>
                <a class="nav-link">Valeur totale de la collection : <?= number_format($stats->getTotalValue(), 2)."€" ?></a> <!-- utilisation des stats ! -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Trier par
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="./index.php?sort=pd">Prix (décroissant)</a>
                                <a class="dropdown-item" href="./index.php?sort=pa">Prix (croissant)</a>
                                <a class="dropdown-item" href="./index.php?sort=ia">ID</a>
                                <a class="dropdown-item" href="./index.php?sort=ta">Nom</a>
                                <a class="dropdown-item" href="./index.php?sort=da">Date MAJ</a>
                            </div>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="./index.php?update=all">MAJ toutes les cartes</a>
                        </li>

                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input id="search" class="form-control mr-sm-2 autocomplete" type="search" placeholder="Rechercher" aria-label="Search">
                    </form>
                </div>
            </nav>
        </header>


		<div class="container margin-top">

			<div class="row">

<?php

// pour afficher toutes les cartes on va itérer sur la collection récupérée en début de page et on créé une "card" (au sens boostrap) par carte
for ($i = 0 ; $i < sizeof($all_cards) ; $i++)
{
	$carte = $all_cards[$i] ;

	// en fonction de la condition (l'état) de la carte, on va choisir un style (une couleur bootstrap)
	$style = "success" ;
	if ($carte->condition == 1 || $carte->condition == 2)
	{
		$style = "success" ;
	}
	else if ($carte->condition == 3 || $carte->condition == 4 || $carte->condition == 5)
	{
		$style = "warning" ;
	}
	else if ($carte->condition == 6 || $carte->condition == 7 || $carte->condition == 8)
	{
		$style = "danger" ;
	}

	$date = date_create($carte->date_last_update); // on créé aussi un objet date pour l'affichage (on formatera cette date en jj/mm/aaaa au moment de l'afficher)
	?>

	<div class="col-12 col-sm-6 col-md-6 col-xl-3" >
		<div class="card mt-2" >
			<h5 class="card-title text-center"><?= $carte->title ?></h5>
			<img class="card-img-top lazyload" data-src="<?= $carte->url_image ?>" alt="<?= $carte->title ?>">
			<div class="card-body">
				<p class="card-text text-center small">
					<button type="button" class="btn btn-outline-secondary btn-sm font-weight-bold">#<?= $carte->id ?></button>
					<button type="button" class="btn btn-outline-primary btn-sm font-weight-bold"><?= $carte->edition ?></button>
					<button type="button" class="btn btn-outline-<?= $style ?> btn-sm font-weight-bold"><?= CONDITIONS[$carte->condition][0] ?></button>
				</p>

				<h1 class="card-title pricing-card-title text-center"><?= round($carte->price) ?>€</h1>

				<p class="card-text text-center small">
					Dernière mise à jour : <?= date_format($date,"d/m/Y") // affichage de la date formatée pour un affichage français ?>
				</p>
				<p class="card-text text-right">
					<a href="./index.php?update=<?= $carte->id ?>" class="btn btn-success btn-sm">Mettre à jour</a>
					<a href="<?= $carte->url ?>" target="_blank" class="btn btn-primary btn-sm">Page détaillée</a>
				</p>
			</div>
		</div>
	</div>
<?php
}

// fin de la boucle
?>

			</div>
		</div>
	</body>
</html>
