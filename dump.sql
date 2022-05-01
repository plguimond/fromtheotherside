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

-- Listage de la structure de la table otherside. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.users : ~1 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `lastname`, `firstname`, `mail`, `role`, `password`) VALUES
	(13, 'test', 'test', 'test@hotmail.com', 0, '$2y$10$6Xr/LMZ/rlo6eOr8frCV2.xltb7MG1di42PATZf1pyEZFUeOyO9w6'),
	(14, 'Ross', 'Bob', 'bob@gmail.com', 0, '$2y$10$Pd7XW4xEFAesiGXZSZvgn.mC1BKZcgJeTlqI7PK2Pd3ncILySwTbS'),
	(15, 'guim', 'pluc', 'guim@hotmail.com', 0, '$2y$10$cVcyWHxM1idz6B7pgm52Qubk6b76hVuz1J7qFwp0IelL3xzNkbSnu'),
	(16, 'admin', 'admin', 'admin@admin.com', 1, '$2y$10$VioORO9SmkryPjHH4Ef6MON7BYr4PchiXciFyqyxwudP4UtzeuYs2'),
	(17, 'dylan', 'Bob', 'erze@hotmail.com', 0, '$2y$10$qgRSh69RNxMZB50oqIUm6O/SCr0jWwwvfjMANZu8IU0Vqzfpw.F3i'),
	(18, 'Ross', 'Bob', 'bobross@ross.com', 0, '$2y$10$SZcwjXAZK5yimqWzr3hN7O1WywxvK06O2z2mPhRBo5lZkBhUfr98a');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table otherside. articles
DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `picture1` varchar(255) DEFAULT NULL,
  `created_At` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.articles : ~6 rows (environ)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `title`, `content`, `picture1`, `created_At`) VALUES
	(1, 'La descente aux enfer!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer consequat eros quam, ut faucibus mauris placerat ac. Aenean velit urna, euismod eu maximus at, cursus ut libero. Aenean quis eleifend ante. Praesent ornare ac dolor eleifend aliquet. Ut eget dui suscipit, fermentum sem at, malesuada urna. Suspendisse malesuada risus vitae nulla sollicitudin tincidunt. Sed sed risus fringilla, sagittis turpis at, elementum nisl.\r\n\r\n Donec sit amet risus sollicitudin nisl pellentesque hendrerit euismod ut lectus. Donec iaculis dignissim purus. Aenean tristique nisi sit amet magna malesuada, ultrices luctus enim hendrerit. Nam et venenatis nisl, vel imperdiet purus. Etiam ultrices porta diam quis pharetra. Sed hendrerit a tortor quis fringilla. Quisque turpis lorem, vulputate in ligula at, blandit ornare ante.', 'app/Public/front/images/news/pien-muller-Fh-Q-xfdh_o-unsplash.jpg', '2022-03-24 15:01:23'),
	(2, 'Nouveau Batteur!!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mollis vulputate tempus.', 'app/Public/front/images/news/photodrummer.jpg', '2022-03-23 15:05:41'),
	(3, 'Article test 3', 'Bonjour, voici un article sympa pour tester mon site internet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula ligula ut scelerisque pharetra. Suspendisse ullamcorper tristique porta. Cras in urna sed ligula placerat malesuada et id leo. Fusce neque justo, elementum et vehicula eu, imperdiet in lectus. Aliquam erat volutpat. Vestibulum feugiat mauris ac orci maximus eleifend. Cras nec commodo ante, quis mollis elit. Fusce congue tempus suscipit.', '', '2022-04-20 16:19:22'),
	(4, 'Article test 5', 'Encore un test! Magique! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula ligula ut scelerisque pharetra. Suspendisse ullamcorper tristique porta. Cras in urna sed ligula placerat malesuada et id leo. Fusce neque justo, elementum et vehicula eu, imperdiet in lectus. Aliquam erat volutpat. Vestibulum feugiat mauris ac orci maximus eleifend. Cras nec commodo ante, quis mollis elit. Fusce congue tempus suscipit.', '', '2022-04-20 16:19:42'),
	(5, 'Article test numéro...', 'Encore un autre... est-ce que tout ça aura une fin? Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula ligula ut scelerisque pharetra. Suspendisse ullamcorper tristique porta. Cras in urna sed ligula placerat malesuada et id leo. Fusce neque justo, elementum et vehicula eu, imperdiet in lectus. Aliquam erat volutpat. Vestibulum feugiat mauris ac orci maximus eleifend. Cras nec commodo ante, quis mollis elit. Fusce congue tempus suscipit.', '', '2022-04-20 16:20:20'),
	(6, 'Super Bowl de  Plouhinec', 'Venez faire semblant d\'assister au plus grand évènement de football américain avec en mi-temp From The Other Side!\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula ligula ut scelerisque pharetra. Suspendisse ullamcorper tristique porta. Cras in urna sed ligula placerat malesuada et id leo. Fusce neque justo, elementum et vehicula eu, imperdiet in lectus. Aliquam erat volutpat. Vestibulum feugiat mauris ac orci maximus eleifend. Cras nec commodo ante, quis mollis elit. Fusce congue tempus suscipit.', '', '2022-04-20 16:21:13'),
	(7, 'Notre guitariste est champion du monde', 'Non vous n\'avez pas rêver! Notre cher Guthrie est champion du monde de guitare... mais pas n\'importe quelle guitare. La AIR GUITARE.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula ligula ut scelerisque pharetra. Suspendisse ullamcorper tristique porta. Cras in urna sed ligula placerat malesuada et id leo. Fusce neque justo, elementum et vehicula eu, imperdiet in lectus. Aliquam erat volutpat. Vestibulum feugiat mauris ac orci maximus eleifend. Cras nec commodo ante, quis mollis elit. Fusce congue tempus suscipit.', 'app/Public/front/images/news/photoguitarist.jpg', '2022-04-20 16:24:18');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Listage de la structure de la table otherside. bandmembers
DROP TABLE IF EXISTS `bandmembers`;
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
	(1, 'Mars', 'Freddie', 'Chanteur', 'Une voix mélodieuse, mais un cri guttural!', 'Chanteur et fondateur du groupe, Freddie a une voix puissante et mélodieuse. Il peut à la fois ravir vos oreilles avec ses mélodies ou vous retourner le cerveau avec ses cris rauques et gutturaux!', 'app/Public/front/images/band/photochanteur.jpg'),
	(2, 'Aeroportnoy', 'Mike', 'Batteur', 'La pieuvre, on pourrait croire qu\'il a huit bras!', 'Mike est le batteur du groupe. Surnommé la pieuvre par sa rapidité et sa précision sur sa batterie. ', 'app/Public/front/images/band/photodrummer.jpg'),
	(3, 'Novan', 'Gutrhie', 'Guitariste', 'Avec Gutrhie, vos oreilles vont en prendre plein la vue!', 'Gutrhie est le co-fondateur du groupe avec Freddie, il vous fera halluciné avec ses riffs et sa techniques incrayables de sweep picking. Les plus fervents aprécieront lorsqu\'il passe en mode djent!', 'app/Public/front/images/band/photoguitarist.jpg'),
	(4, 'Burpton', 'Cliff', 'Bassiste', 'Amoureux de la basse, Cliff ne vous laissera pas tomber!', 'Cliff est le roi du slapping, mais aussi du tapping. La basse n\'est certainement pas mise à l\'écart avec From The Other Side. ', 'app/Public/front/images/band/photobassiste.jpg');
/*!40000 ALTER TABLE `bandmembers` ENABLE KEYS */;

-- Listage de la structure de la table otherside. calendar
DROP TABLE IF EXISTS `calendar`;
CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.calendar : ~4 rows (environ)
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` (`id`, `title`, `date`, `location`, `price`) VALUES
	(1, 'Vendredi soir aux Vieilles Charrues', '2022-07-15', 'Carhaix', 44),
	(2, 'From The Other Side en concert pour la première fois au Hellfest!!\r\n', '2022-06-18', 'Clisson', 105),
	(3, 'Vous en avez assez de la musique celtique, mais souhaitez profiter de la Ste-Patrick sous le signe du rock? C\'est par ici!', '2022-03-17', 'Le Bock, Rue Gustave Zédé, 56600 Lanester', 0),
	(6, 'Bière et Metal au OktoberFest de Landévant, réservez votre place rapidement!', '2022-10-15', 'Bois du château, Landévant', 15);
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;

-- Listage de la structure de la table otherside. comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUser` int(10) unsigned NOT NULL,
  `idArticle` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comments_users` (`idUser`),
  KEY `FK_comments_articles` (`idArticle`),
  CONSTRAINT `FK_comments_articles` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`id`),
  CONSTRAINT `FK_comments_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.comments : ~3 rows (environ)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `content`, `createdAt`, `idUser`, `idArticle`) VALUES
	(1, 'Wow, trop hâte d&#039;être là pour en profiter!!', '2022-03-29 14:49:44', 13, 1),
	(4, 'Je n&#039;arrive pas à y croire, c&#039;est stupéfiant!', '2022-03-31 09:05:02', 18, 2),
	(5, 'super chouette', '2022-04-06 11:18:12', 16, 1);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Listage de la structure de la table otherside. contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.contacts : ~4 rows (environ)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `lastname`, `firstname`, `mail`, `phone`, `subject`, `content`, `createdAt`) VALUES
	(1, 'Guimond', 'Pierre-Luc', 'plguimond@gmail.com', '0601020301', '', 'Bonjour premier test de message', '2022-03-28 11:55:35'),
	(4, 'Bowie', 'david', 'davidbowie@stardust.com', '0601020301', 'Bonjour je voudrais un devis', 'Bonjour, je voudrais un devis pour ma première partie au stade de France. Merci de me contacter au plus tôt.\r\n\r\nZiggy Stardust\r\n\r\n\r\n\r\n', '2022-04-04 16:21:55'),
	(7, 'Ross', 'Bob', 'erze@hotmail.com', '', 'Festival Interceltique?', 'Bonjour, je voulais savoir si vous allez jouer au OFF du festival Interceltique de Lorient, ça manque cruellement de musique métal et vous êtes génial!\r\n\r\nCordialement,\r\n\r\nBob', '2022-04-06 11:12:50'),
	(10, 'test', 'test', 'test@hotmail.com', '', '', 'test', '2022-04-25 09:50:43');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Listage de la structure de la table otherside. slider
DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slide` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Listage des données de la table otherside.slider : ~3 rows (environ)
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` (`id`, `slide`, `title`) VALUES
	(19, 'app/Public/front/images/slider/slider2.jpg', 'Guitare bleue'),
	(20, 'app/Public/front/images/slider/slider1.jpg', 'Petite salle de concert'),
	(23, 'app/Public/front/images/slider/slider3.jpg', 'Concert au hellfest');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
