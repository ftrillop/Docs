-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para pedidos
CREATE DATABASE IF NOT EXISTS `pedidos` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pedidos`;

-- Volcando estructura para tabla pedidos.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `CodCat` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`CodCat`),
  UNIQUE KEY `UN_NOM_CAT` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pedidos.categorias: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`CodCat`, `Nombre`, `Descripcion`, `Activo`) VALUES
	(1, 'Comida', 'Platos e ingredientes', 1),
	(2, 'Bedidas sin', 'Bebidas sin alcohol', 1),
	(3, 'Bebidas con', 'Bebidas con alcohol', 1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `CodPed` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `Enviado` int(11) NOT NULL,
  `Restaurante` int(11) NOT NULL,
  PRIMARY KEY (`CodPed`),
  KEY `Restaurante` (`Restaurante`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`Restaurante`) REFERENCES `restaurantes` (`CodRes`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pedidos.pedidos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`CodPed`, `Fecha`, `Enviado`, `Restaurante`) VALUES
	(11, '2023-01-17 11:22:02', 0, 2),
	(12, '2023-01-17 11:22:42', 0, 2),
	(13, '2023-01-17 11:24:10', 0, 2),
	(14, '2023-01-23 09:34:54', 0, 2);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.pedidosproductos
CREATE TABLE IF NOT EXISTS `pedidosproductos` (
  `CodPredProd` int(11) NOT NULL AUTO_INCREMENT,
  `CodPed` int(11) NOT NULL,
  `CodProd` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL,
  PRIMARY KEY (`CodPredProd`),
  KEY `CodPed` (`CodPed`),
  KEY `CodProd` (`CodProd`),
  CONSTRAINT `pedidosproductos_ibfk_1` FOREIGN KEY (`CodPed`) REFERENCES `pedidos` (`CodPed`),
  CONSTRAINT `pedidosproductos_ibfk_2` FOREIGN KEY (`CodProd`) REFERENCES `productos` (`CodProd`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pedidos.pedidosproductos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidosproductos` DISABLE KEYS */;
INSERT INTO `pedidosproductos` (`CodPredProd`, `CodPed`, `CodProd`, `Unidades`) VALUES
	(15, 11, 3, 3),
	(16, 12, 5, 20),
	(17, 13, 3, 0),
	(19, 14, 1, 44),
	(20, 14, 6, 7),
	(21, 11, 5, 6);
/*!40000 ALTER TABLE `pedidosproductos` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `CodProd` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(90) NOT NULL,
  `Peso` float NOT NULL,
  `Stock` int(11) NOT NULL,
  `CodCat` int(11) NOT NULL,
  PRIMARY KEY (`CodProd`),
  UNIQUE KEY `Nombre` (`Nombre`),
  KEY `productos_ibfk_1` (`CodCat`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`CodCat`) REFERENCES `categorias` (`CodCat`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pedidos.productos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`CodProd`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `CodCat`) VALUES
	(1, 'Harina', '8 paquetes de 1kg de harina cada uno', 8, 95, 1),
	(2, 'Azúcar', '20 paquetes de 1kg cada uno', 20, 4, 1),
	(3, 'Agua 0.5', '100 botellas de 0.5 litros cada una', 51, 98, 2),
	(4, 'Agua 1.5', '20 botellas de 1.5 litros cada una', 31, 50, 2),
	(5, 'Cerveza Alhambra tercio', '24 botellas de 33cl', 10, 13, 3),
	(6, 'Vino tinto Rioja 0.75', '6 botellas de 0.75 ', 5.5, 3, 3);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.restaurantes
CREATE TABLE IF NOT EXISTS `restaurantes` (
  `CodRes` int(11) NOT NULL AUTO_INCREMENT,
  `Correo` varchar(90) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Pais` varchar(45) NOT NULL,
  `CP` int(5) DEFAULT NULL,
  `Ciudad` varchar(45) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  PRIMARY KEY (`CodRes`),
  UNIQUE KEY `UN_RES_COR` (`Correo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pedidos.restaurantes: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `restaurantes` DISABLE KEYS */;
INSERT INTO `restaurantes` (`CodRes`, `Correo`, `Clave`, `Pais`, `CP`, `Ciudad`, `Direccion`) VALUES
	(1, 'david', '1234', 'España', 28002, 'Madrid', 'C/ Padre  Claret, 8'),
	(2, 'antonio', '1234', 'España', 11001, 'Cádiz', 'C/ Portales, 2');
/*!40000 ALTER TABLE `restaurantes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
