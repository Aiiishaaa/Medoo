-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table collection_magic. cartes
CREATE TABLE IF NOT EXISTS `cartes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) DEFAULT NULL,
  `edition` varchar(80) DEFAULT NULL,
  `condition` int(11) unsigned NOT NULL DEFAULT '2',
  `url` varchar(1024) DEFAULT NULL,
  `prix` float unsigned DEFAULT NULL,
  `image` varchar(1024) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cartes_conditions` (`condition`),
  CONSTRAINT `FK_cartes_conditions` FOREIGN KEY (`condition`) REFERENCES `conditions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Listage des données de la table collection_magic.cartes : ~25 rows (environ)
/*!40000 ALTER TABLE `cartes` DISABLE KEYS */;
INSERT INTO `cartes` (`id`, `nom`, `edition`, `condition`, `url`, `prix`, `image`, `date`) VALUES
	(1, 'Faille cyclonique', 'Retour à Ravnica', 1, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Return-to-Ravnica/Cyclonic-Rift', 18.448, 'https://static.cardmarket.com/img/a8ab371b085b4b235dee7b888497a9fe/items/1/RTR/258354.jpg', '2020-09-08'),
	(2, 'Crypte de sang', 'Retour à Ravnica', 1, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Return-to-Ravnica/Blood-Crypt', 13.94, 'https://static.cardmarket.com/img/a8ab371b085b4b235dee7b888497a9fe/items/1/RTR/258316.jpg', '2020-09-08'),
	(3, 'Fontaine sacrée', 'Retour à Ravnica', 1, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Return-to-Ravnica/Hallowed-Fountain', 11.498, 'https://static.cardmarket.com/img/a8ab371b085b4b235dee7b888497a9fe/items/1/RTR/258230.jpg', '2020-09-08'),
	(4, 'Guivre mondéchine', 'Retour à Ravnica', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Return-to-Ravnica/Worldspine-Wurm', 5.658, 'https://static.cardmarket.com/img/a8ab371b085b4b235dee7b888497a9fe/items/1/RTR/258287.jpg', '2020-09-08'),
	(5, 'Maze of Ith', 'The Dark', 3, 'https://www.cardmarket.com/fr/Magic/Products/Singles/The-Dark/Maze-of-Ith', 31.0385, 'https://static.cardmarket.com/img/65200be89cc23a4c6706a9455394bfcb/items/1/DRK/7395.jpg', '2020-09-08'),
	(6, 'Shamane ritemort', 'Retour à Ravnica', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Return-to-Ravnica/Deathrite-Shaman', 3.16258, 'https://static.cardmarket.com/img/a8ab371b085b4b235dee7b888497a9fe/items/1/RTR/258509.jpg', '2020-09-08'),
	(7, 'Bibelot de pierrenuage', 'Ravnica: La Cité des Guildes', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Ravnica-City-of-Guilds/Cloudstone-Curio', 11.9388, 'https://static.cardmarket.com/img/ece3b30f51a40b672e2e82be29870e09/items/1/RAV/13333.jpg', '2020-09-08'),
	(8, 'Vie du terreau', 'Ravnica: La Cité des Guildes', 5, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Ravnica-City-of-Guilds/Life-from-the-Loam', 7.34143, 'https://static.cardmarket.com/img/ece3b30f51a40b672e2e82be29870e09/items/1/RAV/13449.jpg', '2020-09-08'),
	(9, 'Tombeau luxuriant', 'Ravnica: La Cité des Guildes', 3, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Ravnica-City-of-Guilds/Overgrown-Tomb', 6.87244, 'https://static.cardmarket.com/img/ece3b30f51a40b672e2e82be29870e09/items/1/RAV/13481.jpg', '2020-09-08'),
	(10, 'Aperçu de l\'inimaginable', 'Ravnica: La Cité des Guildes', 4, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Ravnica-City-of-Guilds/Glimpse-the-Unthinkable', 6.06892, 'https://static.cardmarket.com/img/ece3b30f51a40b672e2e82be29870e09/items/1/RAV/13405.jpg', '2020-09-08'),
	(11, 'Forêt pluviale embrumée', 'Zendikar', 3, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Zendikar/Misty-Rainforest', 45.5282, 'https://static.cardmarket.com/img/9d0d5a245669bccaaebc2f91bba9d269/items/1/ZEN/21726.jpg', '2020-09-08'),
	(12, 'Lac de montagne bouillant', 'Zendikar', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Zendikar/Scalding-Tarn', 45.6321, 'https://static.cardmarket.com/img/9d0d5a245669bccaaebc2f91bba9d269/items/1/ZEN/21786.jpg', '2020-09-08'),
	(13, 'Cobra de lotus', 'Zendikar', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Zendikar/Lotus-Cobra', 7.08878, 'https://static.cardmarket.com/img/9d0d5a245669bccaaebc2f91bba9d269/items/1/ZEN/21807.jpg', '2020-09-08'),
	(14, 'Éméria, la Ruine Céleste', 'Zendikar', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Zendikar/Emeria-the-Sky-Ruin', 4.2898, 'https://static.cardmarket.com/img/9d0d5a245669bccaaebc2f91bba9d269/items/1/ZEN/21749.jpg', '2020-09-08'),
	(15, 'Contreforts Boisés', 'Carnage', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Onslaught/Wooded-Foothills', 28.9199, 'https://static.cardmarket.com/img/9602e0e5b3cbae2ae4f5518f525b3186/items/1/ONS/1961.jpg', '2020-09-08'),
	(16, 'Lune de sang', '9ème édition', 3, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Ninth-Edition/Blood-Moon', 9.85243, 'https://static.cardmarket.com/img/2585e07db5a94233fbc4872d140dcdf4/items/1/9ED/12292.jpg', '2020-09-08'),
	(17, 'Fondrière Sanguinolente', 'Carnage', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Onslaught/Bloodstained-Mire', 32.146, 'https://static.cardmarket.com/img/40b5efd939eda860937c1901755cb6fd/items/1/ONS/1944.jpg', '2020-09-08'),
	(18, 'Académie Tolariane', 'Epopée d\'Urza', 3, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Urzas-Saga/Tolarian-Academy', 69.9642, 'https://static.cardmarket.com/img/9a14852ab3c6846a6e9eb19a8f8262e5/items/1/USG/10537.jpg', '2020-09-08'),
	(19, 'Orbe de l\'hiver', '5ème édition', 3, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Fifth-Edition/Winter-Orb', 8.31032, 'https://static.cardmarket.com/img/1e26a87f89b85cb582bf688ee8df680b/items/1/5ED/9779.jpg', '2020-09-08'),
	(20, 'Mine des Morts-terrains', '4ème édition', 3, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Fourth-Edition/Strip-Mine', 6.65938, 'https://static.cardmarket.com/img/eae4753f32cb713da786c7cae2344a8d/items/1/4ED/6023.jpg', '2020-09-08'),
	(21, 'Usine de Mishra', '4ème édition', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Fourth-Edition/Mishra-s-Factory', 1.5272, 'https://static.cardmarket.com/img/eae4753f32cb713da786c7cae2344a8d/items/1/4ED/6015.jpg', '2020-09-08'),
	(22, 'Mana Drain', 'Legends', 6, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Legends/Mana-Drain', 123.256, 'https://static.cardmarket.com/img/703efdf301f85b4cab441656e5a0b9d0/items/1/LEG/7036.jpg', '2020-09-08'),
	(23, 'Arène phyrexiane', '9ème édition', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Ninth-Edition/Phyrexian-Arena', 7.4358, 'https://static.cardmarket.com/img/2585e07db5a94233fbc4872d140dcdf4/items/1/9ED/12478.jpg', '2020-09-08'),
	(24, 'Championne elfe', '9ème édition', 2, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Ninth-Edition/Elvish-Champion', 3.142, 'https://static.cardmarket.com/img/2585e07db5a94233fbc4872d140dcdf4/items/1/9ED/12338.jpg', '2020-09-08'),
	(25, 'Landes d\'Adarkar', '9ème édition', 5, 'https://www.cardmarket.com/fr/Magic/Products/Singles/Ninth-Edition/Adarkar-Wastes', 2.99, 'https://static.cardmarket.com/img/2585e07db5a94233fbc4872d140dcdf4/items/1/9ED/12262.jpg', '2020-09-08');
/*!40000 ALTER TABLE `cartes` ENABLE KEYS */;

-- Listage de la structure de la table collection_magic. conditions
CREATE TABLE IF NOT EXISTS `conditions` (
  `id` int(10) unsigned NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table collection_magic.conditions : ~7 rows (environ)
/*!40000 ALTER TABLE `conditions` DISABLE KEYS */;
INSERT INTO `conditions` (`id`, `label`) VALUES
	(1, 'Mint'),
	(2, 'Near Mint'),
	(3, 'Excellent'),
	(4, 'Good'),
	(5, 'Light Played'),
	(6, 'Played'),
	(7, 'Poor');
/*!40000 ALTER TABLE `conditions` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
