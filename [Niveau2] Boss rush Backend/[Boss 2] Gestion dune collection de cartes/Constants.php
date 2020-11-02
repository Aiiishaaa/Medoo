<?php

// constantes liées aux différents états des cartes
const CONDITION_MINT = ["Mint" , 1] ;
const CONDITION_NEAR_MINT = ["Near Mint" , 2] ;
const CONDITION_EXCELLENT = ["Excellent" , 3] ;
const CONDITION_GOOD = ["Good" , 4] ;
const CONDITION_LIGHT_PLAYED = ["Light Played" , 5] ;
const CONDITION_PLAYED = ["Played" , 6] ;
const CONDITION_POOR = ["Poor" , 7] ;
// ensuite on les range dans un tableau
const CONDITIONS = [null,
	CONDITION_MINT,
	CONDITION_NEAR_MINT,
	CONDITION_EXCELLENT,
	CONDITION_GOOD,
	CONDITION_LIGHT_PLAYED,
	CONDITION_PLAYED,
	CONDITION_POOR,

] ;

// constantes pour l'accès à la base de données
/* TODO : à personnaliser si besoin */
const DATABASE_HOST = "localhost" ;
const DATABASE_NAME = "collection_magic" ;
const DATABASE_USER = "root" ;
const DATABASE_PASSWORD = "" ;

?>