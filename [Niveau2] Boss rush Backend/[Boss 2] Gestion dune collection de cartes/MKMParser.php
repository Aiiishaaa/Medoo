<?php
require_once ("Constants.php") ;
include_once ("simple_html_dom.php");
include_once ("Medoo.php");
require_once('Card.php');

// Using Medoo namespace
use Medoo\Medoo;

class MKMParser
{
	// Le "parser" aura besoin d'accéder aux informations d'une carte en particulier et d'avoir accès à la base de données pour pouvoir la mettre à jour
	protected $card ;
	protected $database ;

	/* on passe une carte en paramètre du constructeur, vous n'avez rien à modifier dans ce constructeur */
	public function __construct($card)
	{
		$this->card = $card ;
		// Initialisation de connexion à la base de données
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


	// fonction principale de cette classe - elle charge une page web contenant toutes les infos de la carte en question, récupère les infos utiles et met à jour en base de données
	function update_carte ()
	{
		$my_condition = CONDITIONS[$this->card->condition]; // on récupère la "condition" de la carte en allant chercher dans le tableau des constantes les infos
		$url_MKM = $this->card->url;
		$html_source = $this->poster($url_MKM, ["minCondition" => $my_condition[1], "extra[isSigned]" => "N", "extra[isFoil]" => "N"])[0]; // chargement de la page avec les paramètres propres au site

		// Creation du DOM de la page chargée
		$html = str_get_html($html_source);

		$url_image = null ; // url de l'image de la carte, on utilisera ce visuel lorsqu'on affichera les cartes sur notre page web
		$price_array = array(); // tableau qui contiendra l'ensemble des prix trouvés pour la carte, on fera ensuite une moyenne

		// TODO pour bien comprendre la suite, inspectez une url de carte pour comprendre la structure de la page

		/* on va itérer (comme en JS) sur tous les élément qui ont la classe .article-row, chaque article-row = une ligne avec un prix de vente */
		foreach ($html->find(........) as $element) // TODO : mettez le bon sélecteur dans la fonction find() (voir explications ci-dessus)
		{
			// on compare si la carte est bien dans la condition souhaitée afin de ne calculer une moyenne de prix que sur des cartes ayant une condition identique
			if ($this->has_condition($element, $my_condition[0])) // vous n'avez pas à modifier la fonction has_condition qui vous est donnée
			{
				$price = $this->getPrice($element); // si c'est ok, alors on ajoute le prix (obtenu par getPrice qui vous est donnée) à notre tableau de prix
				array_push($price_array, $price);
			}

		}
		try{ // TODO : cherchez à quoi sert la struture try {} catch()
			// on va désormais chercher à récupérer l'image servant de visuel à la carte
		    $images = $html->find('div.slide div.image img.is-front') ;
		    // on a 3 resultats, l'image qui nous intéresse c'est celle du milieu (indice 1). C'est en regardant la structure du code qu'on le comprend !
		    if (sizeof($images) > 1)
            {
            	// si cette image existe, on la récupère
                $url_image = $images[1]->getAttribute("src");
            }
		} catch(Exception $e){
			// echo $e->getMessage(); // pas de message d'erreur, on considère que ce n'est pas dramatique si cette instruction échoue
		}

		// TODO BONUS : si vous souhaitez raffiner la moyenne (voir "améliorations" à la fin de l'énoncé) en supprimant des extrema vous pouvez le faire ici

		$nb_element = sizeof($price_array);
		if ($nb_element > 0)
		{
			// si on a bien trouvé plusieurs prix correspondant à notre carte et à la condition voulue, on va pouvoir calculer la moyenne
			$price = array_sum($price_array) / $nb_element; // on calcule le prix moyen

			// on fait les mises à jour en base de données
			$this->database->update('cartes', ["date" => date("Y-m-d")], ['id' => $this->card->id]); // update de la date
			$this->database->update(.........); // TODO update du prix
			if ($url_image != null)
            {
                $this->database->update(.........); // TODO update de l'url de l'image
            }
		}

	}


	// Les fonctions ci-dessous vous sont données vous ne devriez pas avoir à les modifier

	/**
	 * @param $element
	 * @param $condition
	 * 1 = "Mint" et plus
	// 2 = "Near Mint" et +
	// 3 = "Excellent" et +
	// 4 = "Good" et +
	// 5 = "Light Played" et +
	// 6 = "Played" et +
	// 7 = "Poor" et +
	 * @return bool
	 */
	function has_condition($element, $condition)
	{
		$res = false ;
		foreach ($element->find("span[data-original-title]") as $span)
		{
			$res = $res || $span->getAttribute("data-original-title") == $condition ;
		}
		return $res ;
	}



	// transforme une nombre ou une chaine de caractères représentant un nombre en un nombre décimal
	function tofloat($num) {
		$dotPos = strrpos($num, '.');
		$commaPos = strrpos($num, ',');
		$sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
			((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

		if (!$sep) {
			return floatval(preg_replace("/[^0-9]/", "", $num));
		}

		return floatval(
			preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
			preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
		);
	}

	// cette fonction récupère le prix d'une carte dans le DOM de la page
	function getPrice($element)
	{
		$price = null ;
		foreach ($element->find(".price-container span.extra-small") as $span)
		{
			$price = $span->plaintext ;
			$price = str_replace("(PU: ", "", $price);
			$price = str_replace(")", "", $price);
		}
		if ($price == null){
			foreach ($element->find(".price-container span") as $span)
			{
				$price = $span->plaintext ;
			}
		}

		// on raffine l'affichage du prix
		$price = str_replace("€", "", $price);
		$price = str_replace(",00", "", $price);
		$price = str_replace(".", "", $price);
		$price = str_replace(",", ".", $price);
		return $this->tofloat($price) ;
	}

// Cette fonction ouvre une URL (en post) et récupère le contenu de la page dans le but d'analyser son contenu
// vous n'avez pas à modifier cette fonction, vous vous en servez telle qu'elle
// $url = url de la page à charger, et $field_string = tableau de données à passer en paramètre "post" de la requête (peut etre null)
	function poster($url, $fields_string=null){
		$ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		curl_setopt($ch, CURLOPT_COOKIE, 'NID=67=pdjIQN5CUKVn0bRgAlqitBk7WHVivLsbLcr7QOWMn35Pq03N1WMy6kxYBPORtaQUPQrfMK4Yo0vVz8tH97ejX3q7P2lNuPjTOhwqaI2bXCgPGSDKkdFoiYIqXubR0cTJ48hIAaKQqiQi_lpoe6edhMglvOO9ynw; PREF=ID=52aa671013493765:U=0cfb5c96530d04e3:FF=0:LD=en:TM=1370266105:LM=1370341612:GM=1:S=Kcc6KUnZwWfy3cOl; OTZ=1800625_34_34__34_; S=talkgadget=38GaRzFbruDPtFjrghEtRw; SID=DQAAALoAAADHyIbtG3J_u2hwNi4N6UQWgXlwOAQL58VRB_0xQYbDiL2HA5zvefboor5YVmHc8Zt5lcA0LCd2Riv4WsW53ZbNCv8Qu_THhIvtRgdEZfgk26LrKmObye1wU62jESQoNdbapFAfEH_IGHSIA0ZKsZrHiWLGVpujKyUvHHGsZc_XZm4Z4tb2bbYWWYAv02mw2njnf4jiKP2QTxnlnKFK77UvWn4FFcahe-XTk8Jlqblu66AlkTGMZpU0BDlYMValdnU; HSID=A6VT_ZJ0ZSm8NTdFf; SSID=A9_PWUXbZLazoEskE; APISID=RSS_BK5QSEmzBxlS/ApSt2fMy1g36vrYvk; SAPISID=ZIMOP9lJ_E8SLdkL/A32W20hPpwgd5Kg1J');
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		$result = curl_exec($ch);
		$last = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		curl_close($ch);
		return array($result,$last); // on retourne le texte de la page chargée + un code correspondant à la réussite ou non de l'action
	}

}