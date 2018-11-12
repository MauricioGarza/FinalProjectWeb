# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.38)
# Database: parleria
# Generation Time: 2018-11-12 13:23:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table carritos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carritos`;

CREATE TABLE `carritos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `producto_id` int(11) unsigned DEFAULT NULL,
  `venta_concluida` tinyint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_carrito` (`user_id`),
  KEY `producto` (`producto_id`),
  CONSTRAINT `producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  CONSTRAINT `user_carrito` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `carritos` WRITE;
/*!40000 ALTER TABLE `carritos` DISABLE KEYS */;

INSERT INTO `carritos` (`id`, `user_id`, `producto_id`, `venta_concluida`)
VALUES
	(1,1,3,0),
	(5,1,3,0),
	(8,2,3,0),
	(9,2,1,0),
	(10,2,5,0);

/*!40000 ALTER TABLE `carritos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table productos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` int(11) unsigned DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `es_hombre` tinyint(4) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_prod` (`tipo`),
  CONSTRAINT `tipo_prod` FOREIGN KEY (`tipo`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;

INSERT INTO `productos` (`id`, `tipo`, `image`, `nombre`, `descripcion`, `es_hombre`, `precio`)
VALUES
	(1,2,'assets/ring.png','Anillo Hombre','Este es el mejor anillo que jamás vas a poder encontrar',1,35.5),
	(2,5,'assets/earring.png','arete','El mejor arete que se ha creado en la historia\n',0,110),
	(3,1,'assets/clocks.png','reloj','Un reloj bueno bonito y barato\n',1,290.5),
	(4,4,'assets/necklace.png','collar','Un collar para la esposa\n',0,329.7),
	(5,2,'assets/ring.png','Anillo Mujer','Un anillo para que te veas nice',0,329.7),
	(8,5,'assets/earring.png','arete','Otro arete',0,110),
	(9,4,'assets/necklace.png','collar','Un collar bonito',0,329.7),
	(10,5,'assets/earring.png','arete','Y un arete mas',0,110),
	(11,1,'assets/clocks.png','reloj','Un reloj para parecer James Bond\n',0,290.5),
	(12,1,'assets/clocks.png','reloj','Para Jose Antonio Toussaint\n',1,1000000.23);

/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tipos_productos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tipos_productos`;

CREATE TABLE `tipos_productos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tipos_productos` WRITE;
/*!40000 ALTER TABLE `tipos_productos` DISABLE KEYS */;

INSERT INTO `tipos_productos` (`id`, `nombre`)
VALUES
	(1,'reloj'),
	(2,'anillo'),
	(3,'pulsera'),
	(4,'collar'),
	(5,'arete'),
	(6,'Misc');

/*!40000 ALTER TABLE `tipos_productos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `nombre`, `apellido`, `pais`, `fecha_de_nacimiento`, `email`, `created`, `modified`)
VALUES
	(1,'Mauricio','Garza',1,'1996-06-24','mgarzaa96@gmail.com',NULL,NULL),
	(2,'Andres','Villanueva',1,'1996-06-24','nany@gmail.com',NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
