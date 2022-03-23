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

-- Listage de la structure de la table otherside. articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `picture1` varchar(255) DEFAULT NULL,
  `picture2` varchar(255) DEFAULT NULL,
  `picture3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.articles : ~0 rows (environ)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Listage de la structure de la table otherside. bandmembers
CREATE TABLE IF NOT EXISTS `bandmembers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `excerpt` varchar(100) NOT NULL,
  `info` text NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.bandmembers : ~4 rows (environ)
/*!40000 ALTER TABLE `bandmembers` DISABLE KEYS */;
INSERT INTO `bandmembers` (`id`, `lastname`, `firstname`, `type`, `excerpt`, `info`, `picture`) VALUES
	(1, 'Mars', 'Freddie', 'Chanteur', 'Une voix mélodieuse, mais un cri guttural!', 'Chanteur et fondateur du groupe, Freddie a une voix puissante et mélodieuse. Il peut à la fois ravir vos oreilles avec ses mélodies ou vous retourner le cerveau avec ses cris rauques et guturaux!', 'app/Public/front/images/photochanteur.jpg'),
	(2, 'Aeroportnoy', 'Mike', 'Batteur', 'La pieuvre, on pourrait croire qu\'il a huit bras!', 'Mike est le batteur du groupe. Surnommé la pieuvre par sa rapidité et sa précision sur sa batterie. ', 'app/Public/front/images/photodrummer.jpg'),
	(3, 'Novan', 'Gutrhie', 'Guitariste', 'Avec Gutrhie, vos oreilles vont en prendre plein la vue!', 'Gutrhie est le co-fondateur du groupe avec Freddie, il vous fera halluciné avec ses riffs et sa techniques incrayables de sweep picking. Les plus fervents aprécieront lorsqu\'il passe en mode djent!', 'app/Public/front/images/photoguitarist.jpg'),
	(4, 'Burpton', 'Cliff', 'Bassiste', 'Amoureux de la basse, Cliff ne vous laissera pas tomber!', 'Cliff est le roi du slapping, mais aussi du tapping. La basse n\'est certainement pas mise à l\'écart avec From The Other Side. ', 'app/Public/front/images/photobassiste.jpg');
/*!40000 ALTER TABLE `bandmembers` ENABLE KEYS */;

-- Listage de la structure de la table otherside. calendar
CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `published` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.calendar : ~0 rows (environ)
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;

-- Listage de la structure de la table otherside. comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `idUser` int(10) unsigned NOT NULL,
  `idArticle` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comments_users` (`idUser`),
  KEY `FK_comments_articles` (`idArticle`),
  CONSTRAINT `FK_comments_articles` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`id`),
  CONSTRAINT `FK_comments_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.comments : ~0 rows (environ)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Listage de la structure de la table otherside. contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.contacts : ~0 rows (environ)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Listage de la structure de la table otherside. slider
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slide` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.slider : ~3 rows (environ)
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` (`id`, `slide`, `title`) VALUES
	(4, 'app/Public/front/images/austin-neill-hgO1wFPXl3I-unsplash.jpg', 'Chanteur sur scene'),
	(5, 'app/Public/front/images/pien-muller-Fh-Q-xfdh_o-unsplash.jpg', 'Photo de concert de folie'),
	(8, 'app/Public/front/images/yvette-de-wit-8XLapfNMW04-unsplash.jpg', 'Concert génial');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;

-- Listage de la structure de la table otherside. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.users : ~6 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `lastname`, `firstname`, `mail`, `role`, `password`) VALUES
	(12, 'Legless', 'Mumu', 'mumupudejambes@gmail.com', 0, '$2y$10$hxqV0SGyNHH1.oONUjDZjehlHP5i2WqF.5PTd8cff2tYbSEnJjI0q'),
	(13, 'test', 'test', 'test@hotmail.com', 0, '$2y$10$6Xr/LMZ/rlo6eOr8frCV2.xltb7MG1di42PATZf1pyEZFUeOyO9w6'),
	(14, 'Ross', 'Bob', 'bob@gmail.com', 0, '$2y$10$Pd7XW4xEFAesiGXZSZvgn.mC1BKZcgJeTlqI7PK2Pd3ncILySwTbS'),
	(15, 'guim', 'pluc', 'guim@hotmail.com', 0, '$2y$10$cVcyWHxM1idz6B7pgm52Qubk6b76hVuz1J7qFwp0IelL3xzNkbSnu'),
	(16, 'admin', 'admin', 'admin@admin.com', 1, '$2y$10$VioORO9SmkryPjHH4Ef6MON7BYr4PchiXciFyqyxwudP4UtzeuYs2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
