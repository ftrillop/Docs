-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para mensaxes
CREATE DATABASE IF NOT EXISTS `mensaxes` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mensaxes`;

-- Volcando estructura para tabla mensaxes.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `codGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codGrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla mensaxes.grupos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` (`codGrupo`, `nombre`) VALUES
	(1, 'ProgramacionServidor'),
	(2, 'Implantacion'),
	(3, 'DeseñoInterfaces'),
	(4, 'ProgramacionCliente');
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;

-- Volcando estructura para tabla mensaxes.mensajes
CREATE TABLE IF NOT EXISTS `mensajes` (
  `codMensaje` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `codGrupo` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`codMensaje`),
  KEY `usuario` (`usuario`),
  KEY `codGrupo` (`codGrupo`),
  CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`codGrupo`) REFERENCES `grupos` (`codGrupo`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla mensaxes.mensajes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` (`codMensaje`, `mensaje`, `usuario`, `codGrupo`, `fecha`) VALUES
	(37, 'Esta é unha proba para o exame', 'blasco', NULL, '2022-11-20 10:51:43'),
	(38, 'Mensaxe so para o modulo meu', 'blasco', 1, '2022-11-20 10:54:11');
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;

-- Volcando estructura para tabla mensaxes.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` char(128) COLLATE utf8_spanish_ci NOT NULL,
  `codGrupo` int(11) NOT NULL,
  PRIMARY KEY (`usuario`),
  KEY `codGrupo` (`codGrupo`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`codGrupo`) REFERENCES `grupos` (`codGrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla mensaxes.usuarios: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`usuario`, `password`, `codGrupo`) VALUES
	('blasco', '4E5FB359B9FD8A1C1AE85E431936D3FC80CC4C917620162D0FD1930C47BB0CD8D7424C99E6C88B6E09D406F8BE2C51B17EECF460A2FFB2CFC8C6994C9B4D90FB', 1),
	('brais', '4E5FB359B9FD8A1C1AE85E431936D3FC80CC4C917620162D0FD1930C47BB0CD8D7424C99E6C88B6E09D406F8BE2C51B17EECF460A2FFB2CFC8C6994C9B4D90FB', 1),
	('damian', '4E5FB359B9FD8A1C1AE85E431936D3FC80CC4C917620162D0FD1930C47BB0CD8D7424C99E6C88B6E09D406F8BE2C51B17EECF460A2FFB2CFC8C6994C9B4D90FB', 2),
	('fabian', '4E5FB359B9FD8A1C1AE85E431936D3FC80CC4C917620162D0FD1930C47BB0CD8D7424C99E6C88B6E09D406F8BE2C51B17EECF460A2FFB2CFC8C6994C9B4D90FB', 2),
	('fernando', '4E5FB359B9FD8A1C1AE85E431936D3FC80CC4C917620162D0FD1930C47BB0CD8D7424C99E6C88B6E09D406F8BE2C51B17EECF460A2FFB2CFC8C6994C9B4D90FB', 3);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
