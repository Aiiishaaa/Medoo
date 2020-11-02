<?php

require_once ("Constants.php") ;
include_once ("Medoo.php");
// Using Medoo namespace
use Medoo\Medoo;

// Card est une classe (POO)
class Card
{
	// les propriétés ou attributs de la classe
	public $title ;
	public $date_last_update ;
	public $price ;
	public $id ;
	public $url ;
	public $url_image ;
	public $edition ;
	public $condition ;
	protected static $database ;

	// on définit un constructeur, on l'appellera pas la suite en faisant new Card(......)
	public function __construct($id, $values=null)
	{

		// si le paramètre values est null alors on va chercher les infos en base de données d'après l'id passé en paramètre
		if ($values == null)
		{
			// Initialisation de la connexion à la base de données (vous n'avez pas à modifier)
			if (is_null(self::$database))
			{
				self::$database = new Medoo([
					'database_type' => 'mysql',
					'database_name' => DATABASE_NAME,
					'server' => DATABASE_HOST,
					'username' => DATABASE_USER,
					'password' => DATABASE_PASSWORD,
					"charset" => "utf8",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				]);
			}
			$values = self::$database-> ...... ; /* TODO : écrire la requête qui vous permettra de récupérer les infos de la carte $id en base de données */
			// doc : https://medoo.in/doc
		}
		// à présent on sait qu'on a des valeurs dans values, il s'agit des infos d'une carte en particulier
		// pour chaque valeur de values on met cette valeur à la propriété correspondante de l'objet qu'on est entrain de construire ($this)
		if (isset($values['id']))
		{
			$this->id = $values['id']; // comprenez bien le fonctionnement de this->
		}
		if (isset($values['date']))
		{
			$this->date_last_update = $values['date'];
		}
		if (isset($values['nom']))
		{
			....... // TODO à faire sur le même modèle que précédemment
		}
		if (isset($values['prix']))
		{
			....... // TODO à faire
		}
		if (isset($values['image']))
		{
			....... // TODO à faire
		}
		if (isset($values['url']))
		{
			....... // TODO à faire
		}
		if (isset($values['edition']))
		{
			....... // TODO à faire
		}
		if (isset($values['condition']))
		{
			....... // TODO à faire
		}
		// notez : pas besoin de return dans un constructeur !!!
		// une fois toutes les valeurs initialisée, c'est fini
	}

	// cette fonction est static ! ça veut dire qu'elle ne s'applique pas à un objet Card en particulier, elle s'adresse à sa classe. C'est global ! Et ce qu'on veut ici c'est récupérer l'ensemble de toutes les Cards existant en base de données
	public static function getAllCards($sort="pd")
	{
		$array_sort = array() ;
		// en fonction de l'ordre de tri choisi, on adapte la requête passée en base de données
		// vous n'avez pas à toucher à ce bout de code
		if ($sort == "pd") // == prix décroissant
		{
			$array_sort = ["cartes.prix" => "DESC"] ;
		}
		else if ($sort == "pa") // == prix croissant
		{
			$array_sort = ["cartes.prix" => "ASC"] ;
		}
		else if ($sort == "ia") // == index croissant
		{
			$array_sort = ["cartes.id" => "ASC"] ;
		}
		else if ($sort == "ta") // == titre croissant
		{
			$array_sort = ["cartes.nom" => "ASC"] ;
		}
        else if ($sort == "da") // == date de mise à jour croissante
        {
            $array_sort = ["cartes.date" => "ASC"] ;
        }
		// Initialisation de la base de données
		if ( is_null( self::$database ) )
		{
			// le code vous est donné ici, pensez bien à configurer vos constantes dans Constants.php
			self::$database = new Medoo([
				'database_type' => 'mysql',
				'database_name' => DATABASE_NAME,
				'server' => DATABASE_HOST,
				'username' => DATABASE_USER,
				'password' => DATABASE_PASSWORD,
				"charset" => "utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			]);
		}
		/* TODO : la ligne ci-dessous a pour fonction de récupérer sous la forme d'un tableau ($values) toutes les
		cartes de la base de données tout en tenant compte du tri déjà préparé en amont dans $array_sort */
		$values = self::$database->.............;// à compléter, voir doc de Medoo : https://medoo.in/api/select
		$results = array() ;
		for($i = 0; $i < sizeof($values); ++$i) {
			$carte = new Card(.............) ;// TODO : à compléter pour que l'appel au constructeur Card construise bien chaque carte avec les bons paramètres
			array_push($results, $carte) ; // on ajoute la carte à $values
		}
		return $results ; // on retourne $results
	}



	/* cette fonction génère le code JSON contenant tous les noms des cartes de la base de données. Ce JSON sera gardé dans une variable et utilisée par l'autocomplétion */
	public static function getJSONNames()
	{
		// Initialisation de la base de données
		if ( is_null( self::$database ) )
		{	// le code vous est donné ici, pensez bien à configurer vos constantes dans Constants.php
			self::$database = new Medoo([
				'database_type' => 'mysql',
				'database_name' => DATABASE_NAME,
				'server' => DATABASE_HOST,
				'username' => DATABASE_USER,
				'password' => DATABASE_PASSWORD,
				"charset" => "utf8",
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			]);
		}

		/* TODO : la ligne ci-dessous a pour fonction de récupérer sous la forme d'un tableau ($values) toutes les cartes de la base de données (sans ordre de tri)*/
		$values = self::$database-> .......... // à compléter, voir doc de Medoo : https://medoo.in/api/select
		$json_array = array() ;
		for($i = 0; $i < sizeof($values); ++$i) {
			$carte = new Card( ...........) ; // TODO : à compléter pour que l'appel au constructeur Card construise bien chaque carte avec les bons paramètres (regardez la signature du constructeur)
			array_push($json_array, $carte->title) ;
		}
		return json_encode($json_array) ; // on transforme le tableau en JSON et on retourne le résultat
	}
}