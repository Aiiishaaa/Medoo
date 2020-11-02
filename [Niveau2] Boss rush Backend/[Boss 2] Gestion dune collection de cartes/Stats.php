<?php

require_once ("Constants.php") ;
include_once ("Medoo.php");
// Using Medoo namespace
use Medoo\Medoo;

// la classe stats sert simplement à calculé la valeur globale des cartes, mais il est possible de l'utiliser pour faire plus de choses
class Stats
{
	protected $database ;

	// constructeur de la classe
	public function __construct()
	{
		// initialise simplement la base de données
		$this->database = new Medoo([
			'database_type' => 'mysql',
			'database_name' => DATABASE_NAME,
			'server' => DATABASE_HOST,
			'username' => DATABASE_USER,
			'password' => DATABASE_PASSWORD,
			"charset" => "utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		]);
	}

	// renvoie la somme du prix de tous les cartes en base de données
	function getTotalValue()
	{
		return $this->database->sum(......); // TODO : on veut faire la somme du prix de toutes les cartes en une seule requête
		// doc : https://medoo.in/api/sum
	}
}