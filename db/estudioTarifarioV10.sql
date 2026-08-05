-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bd_seprin
CREATE DATABASE IF NOT EXISTS `bd_seprin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bd_seprin`;

-- Volcando estructura para tabla bd_seprin.anio_regulatorio
CREATE TABLE IF NOT EXISTS `anio_regulatorio` (
  `idAnioRegulatorio` int NOT NULL AUTO_INCREMENT,
  `idEstudioTarifario` int DEFAULT NULL,
  `idInversiones` int DEFAULT NULL,
  `anio` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `programado` decimal(20,2) DEFAULT NULL,
  `ejecutado` decimal(20,2) DEFAULT NULL,
  `rdr` decimal(20,2) DEFAULT NULL,
  `et` decimal(20,2) DEFAULT NULL,
  `avanceFisico` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idAnioRegulatorio`) USING BTREE,
  UNIQUE KEY `idInversiones_anio` (`idInversiones`,`anio`),
  KEY `idInversiones` (`idInversiones`),
  KEY `idEstudioTarifario` (`idEstudioTarifario`),
  CONSTRAINT `FK_anio_regulatorio_estudio_tarifario` FOREIGN KEY (`idEstudioTarifario`) REFERENCES `estudio_tarifario` (`idEstudioTarifario`),
  CONSTRAINT `FK_anio_regulatorio_inversiones` FOREIGN KEY (`idInversiones`) REFERENCES `inversiones` (`idInversiones`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.anio_regulatorio: ~36 rows (aproximadamente)
INSERT INTO `anio_regulatorio` (`idAnioRegulatorio`, `idEstudioTarifario`, `idInversiones`, `anio`, `programado`, `ejecutado`, `rdr`, `et`, `avanceFisico`, `observaciones`, `fechaCreado`, `fechaActualizado`) VALUES
	(13, 1, 6, '2025', 100000.00, NULL, 0.00, 0.00, '100', '', NULL, '2026-07-23 23:37:30'),
	(14, 1, 7, '2025', 70000.00, NULL, 0.00, 0.00, '100', '', NULL, '2026-07-19 19:19:44'),
	(15, 1, 8, '2026', 85000.00, NULL, 0.00, 52800.00, NULL, NULL, NULL, NULL),
	(16, 1, 7, '2026', 180000.00, NULL, 0.00, 180000.00, '0', '', NULL, '2026-07-19 19:19:37'),
	(17, 1, 8, '2028', 67000.00, NULL, 0.00, 0.00, NULL, NULL, NULL, NULL),
	(18, 1, 9, '2025', 373084.00, NULL, 0.00, 0.00, '0', '', NULL, '2026-07-23 20:20:11'),
	(19, 1, 9, '2026', 517335.00, NULL, 0.00, 517335.00, '50', NULL, NULL, NULL),
	(20, 1, 9, '2027', 55173.00, NULL, 0.00, 0.00, '0', '', NULL, '2026-07-13 01:08:50'),
	(21, 1, 9, '2028', 55173.00, NULL, 0.00, 0.00, '0', '', NULL, '2026-07-13 01:08:56'),
	(22, 1, 10, '2025', 50000.00, NULL, 0.00, 0.00, '0', '', '2026-07-12 14:56:24', '2026-07-26 15:39:53'),
	(23, 1, 10, '2026', 125000.00, NULL, 0.00, 0.00, '0', '', '2026-07-12 15:16:47', '2026-07-26 15:40:49'),
	(24, 1, 13, '2027', 195000.00, NULL, 0.00, 0.00, '0', '', '2026-07-12 18:00:28', '2026-07-26 15:33:42'),
	(25, 1, 13, '2028', 55000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 15:34:12', '2026-07-26 15:38:05'),
	(26, 1, 10, '2027', 100000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 15:41:46', NULL),
	(27, 1, 10, '2028', 30000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 15:42:07', NULL),
	(28, 1, 14, '2025', 9700.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:07:37', NULL),
	(29, 1, 14, '2026', 9960.00, NULL, 0.00, 9960.00, '25', '', '2026-07-26 16:09:04', NULL),
	(30, 1, 14, '2027', 9960.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:11:19', NULL),
	(31, 1, 14, '2028', 8680.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:11:34', NULL),
	(32, 1, 15, '2025', 50000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:13:47', NULL),
	(33, 1, 15, '2026', 50000.00, NULL, 0.00, 50000.00, '25', '', '2026-07-26 16:14:44', NULL),
	(34, 1, 15, '2027', 50000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:16:29', NULL),
	(35, 1, 15, '2028', 50000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:16:40', NULL),
	(36, 1, 16, '2025', 65000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:19:00', NULL),
	(37, 1, 16, '2026', 35000.00, NULL, 0.00, 35000.00, '25', '', '2026-07-26 16:20:15', NULL),
	(38, 1, 16, '2027', 65000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:28:32', NULL),
	(39, 1, 16, '2028', 35000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:28:42', NULL),
	(40, 1, 17, '2025', 180000.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:36:46', NULL),
	(41, 1, 17, '2026', 275262.00, NULL, 69185.00, 108506.00, '100', '', '2026-07-26 16:39:47', NULL),
	(42, 1, 18, '2025', 580171.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 16:48:55', NULL),
	(43, 1, 18, '2026', 325789.00, NULL, 0.00, 314798.00, '100', '', '2026-07-26 16:52:33', '2026-08-04 23:41:17'),
	(44, 1, 19, '2026', 1846909.00, NULL, 0.00, 2033116.00, '0', '', '2026-07-26 17:05:37', '2026-08-04 23:44:58'),
	(45, 1, 19, '2027', 1846909.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 17:09:07', NULL),
	(46, 1, 20, '2026', 856164.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 17:13:05', NULL),
	(47, 1, 20, '2027', 856164.00, NULL, 0.00, 0.00, '0', '', '2026-07-26 17:13:36', NULL),
	(48, 1, 22, '2027', 99141.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:09:32', NULL),
	(49, 1, 22, '2028', 438947.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:09:52', NULL),
	(50, 1, 23, '2025', 30000.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:19:50', NULL),
	(51, 1, 23, '2026', 30000.00, NULL, 0.00, 30000.00, '100', '', '2026-08-04 22:21:18', NULL),
	(52, 1, 21, '2025', 463482.00, NULL, 0.00, 0.00, '', '', '2026-08-04 22:25:30', NULL),
	(53, 1, 23, '2027', 30000.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:27:02', '2026-08-04 22:27:27'),
	(54, 1, 23, '2028', 30000.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:27:41', NULL),
	(55, 1, 25, '2025', 77118.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:28:55', NULL),
	(56, 1, 25, '2026', 0.00, NULL, 0.00, 65375.00, '0', '', '2026-08-04 22:29:57', '2026-08-04 22:32:47'),
	(57, 1, 21, '2026', 1027398.00, NULL, 0.00, 858209.00, '100', '', '2026-08-04 22:30:41', NULL),
	(58, 1, 25, '2027', 72845.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:36:14', NULL),
	(59, 1, 26, '2025', 23729.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:37:23', NULL),
	(60, 1, 26, '2026', 21356.00, NULL, 0.00, 21356.00, '0', '', '2026-08-04 22:39:14', NULL),
	(61, 1, 27, '2027', 538934.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:44:22', NULL),
	(62, 1, 27, '2028', 538934.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 22:44:43', NULL),
	(63, 1, 24, '2025', 2076924.00, NULL, 0.00, 0.00, '', '', '2026-08-04 23:00:41', NULL),
	(64, 1, 28, '2025', 515036.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 23:01:20', NULL),
	(65, 1, 28, '2026', 515036.00, NULL, 0.00, 1030072.00, '0', '', '2026-08-04 23:02:17', '2026-08-04 23:02:39'),
	(66, 1, 24, '2026', 577174.00, NULL, 0.00, 2070911.00, '15', '', '2026-08-04 23:03:46', '2026-08-04 23:55:02'),
	(67, 1, 29, '2025', 107957.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 23:06:42', NULL),
	(68, 1, 29, '2026', 107957.00, NULL, 0.00, 107957.00, '100', '', '2026-08-04 23:07:27', NULL),
	(69, 1, 30, '2025', 102468.00, NULL, 0.00, 0.00, '', '', '2026-08-04 23:09:25', NULL),
	(70, 1, 29, '2027', 107957.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 23:09:51', NULL),
	(71, 1, 29, '2028', 107957.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 23:10:02', NULL),
	(72, 1, 30, '2026', 124378.00, NULL, 0.00, 229847.00, '0', '', '2026-08-04 23:10:34', '2026-08-05 00:03:19'),
	(73, 1, 31, '2025', 24530.00, NULL, 0.00, 0.00, '100', '', '2026-08-04 23:12:04', '2026-08-04 23:12:49'),
	(74, 1, 32, '2025', 109334.00, NULL, 0.00, 0.00, '100', '', '2026-08-04 23:14:43', NULL),
	(75, 1, 32, '2026', 0.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 23:16:26', NULL),
	(76, 1, 33, '2025', 19200.00, NULL, 0.00, 0.00, '100', '', '2026-08-04 23:20:55', NULL),
	(77, 1, 34, '2025', 105200.00, NULL, 0.00, 0.00, '100', '', '2026-08-04 23:24:08', NULL),
	(78, 1, 35, '2025', 157773.00, NULL, 0.00, 0.00, '100', '', '2026-08-04 23:30:03', '2026-08-04 23:30:58'),
	(79, 1, 36, '2025', 74426.00, NULL, 0.00, 0.00, '100', '', '2026-08-04 23:35:02', NULL),
	(80, 1, 37, '2028', 601055.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 23:38:02', NULL),
	(81, 1, 38, '2028', 1466336.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 23:39:20', NULL),
	(82, 1, 39, '2028', 574005.00, NULL, 0.00, 0.00, '0', '', '2026-08-04 23:40:33', NULL),
	(83, 1, 24, '2027', 3593366.00, NULL, 0.00, 0.00, '0', '', '2026-08-05 00:00:08', NULL),
	(84, 1, 24, '2028', 401624.00, NULL, 0.00, 0.00, '0', '', '2026-08-05 00:00:35', NULL),
	(85, 1, 30, '2028', 825063.00, NULL, 0.00, 0.00, '0', '', '2026-08-05 00:13:28', '2026-08-05 00:13:36');

-- Volcando estructura para tabla bd_seprin.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `idAreas` int NOT NULL AUTO_INCREMENT,
  `idGerencias` int DEFAULT NULL,
  `siglasArea` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreArea` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estadoArea` tinyint DEFAULT '1',
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idAreas`),
  KEY `idGerencias` (`idGerencias`),
  CONSTRAINT `FK_areas_gerencias` FOREIGN KEY (`idGerencias`) REFERENCES `gerencias` (`idGerencias`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.areas: ~12 rows (aproximadamente)
INSERT INTO `areas` (`idAreas`, `idGerencias`, `siglasArea`, `nombreArea`, `estadoArea`, `fechaCreado`, `fechaActualizado`) VALUES
	(1, 3, 'OIPO', 'OFICINA DE INGENIERIA, PROYECTOS Y OBRAS', 1, '2026-07-04 13:14:06', NULL),
	(2, 2, 'OCCMF', 'OFICINA DE CATASTRO COMERCIAL, MEDICION Y FACTURACION', 1, '2026-07-04 13:14:54', NULL),
	(3, 4, 'OTIC', 'OFICINA DE TECNOLOGIA DE LA INFORMACION Y COMUNICACIONES', 1, '2026-07-04 13:15:30', NULL),
	(4, 3, 'GO', 'GERENCIA DE OPERACIONES', 1, '2026-07-04 13:16:08', NULL),
	(5, 4, 'GAF', 'GERENCIA DE ADMINISTRACION Y FINANZAS', 1, '2026-07-07 22:13:35', NULL),
	(6, 2, 'GC', 'GERENCIA COMERCIAL', 1, '2026-07-07 22:14:35', NULL),
	(7, 2, 'OCCC', 'OFICINA DE COBRANZA Y CONTROL COMERCIAL', 1, '2026-07-07 22:15:35', NULL),
	(8, 1, 'EAC', 'EQUIPO DE ASEGURAMIENTO DE CALIDAD', 1, '2026-07-07 22:16:02', NULL),
	(9, 1, 'ODP', 'OFICINA DE DESARROLLO Y PRESUPUESTO', 1, '2026-07-09 20:55:12', '2026-07-12 01:08:40'),
	(10, 3, 'MRSE', 'MECANISMOS DE RETRIBUCIÓN POR SERVICIOS ECOSISTÉMICOS', 1, '2026-07-11 11:43:34', '2026-07-23 19:42:20'),
	(12, 3, 'OPAPTAR', 'OFICINA DE PRODUCCIÓN DE AGUA POTABLE Y TRATAMIENTO DE AGUAS RESIDUALES', 1, '2026-07-22 22:50:46', NULL),
	(13, 2, 'OAC', 'OFICINA DE ATENCION AL CLIENTE', 1, '2026-07-22 23:18:56', NULL);

-- Volcando estructura para tabla bd_seprin.documentos_inversion
CREATE TABLE IF NOT EXISTS `documentos_inversion` (
  `idDocumento` int NOT NULL AUTO_INCREMENT,
  `idInversiones` int NOT NULL,
  `tipoDocumento` varchar(50) NOT NULL,
  `nombreOriginal` varchar(255) NOT NULL,
  `nombreGuardado` varchar(255) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `tipoMime` varchar(100) NOT NULL,
  `tamanio` bigint NOT NULL,
  `observacion` text,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idDocumento`),
  KEY `idInversiones` (`idInversiones`),
  CONSTRAINT `documentos_inversion_ibfk_1` FOREIGN KEY (`idInversiones`) REFERENCES `inversiones` (`idInversiones`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bd_seprin.documentos_inversion: ~29 rows (aproximadamente)

-- Volcando estructura para tabla bd_seprin.ejecucion_mensual
CREATE TABLE IF NOT EXISTS `ejecucion_mensual` (
  `idEjecucionMensual` int NOT NULL AUTO_INCREMENT,
  `idAnioRegulatorio` int DEFAULT NULL,
  `mesOld` tinyint DEFAULT NULL,
  `mes` date DEFAULT NULL,
  `programado` decimal(20,2) DEFAULT NULL,
  `ejecutado` decimal(20,2) DEFAULT NULL,
  `igv` decimal(20,2) DEFAULT NULL,
  `total` decimal(20,2) DEFAULT NULL,
  `archivo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fisico` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint DEFAULT '1',
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idEjecucionMensual`),
  KEY `idInversiones` (`idAnioRegulatorio`) USING BTREE,
  CONSTRAINT `FK_ejecucion_mensual_anio_regulatorio` FOREIGN KEY (`idAnioRegulatorio`) REFERENCES `anio_regulatorio` (`idAnioRegulatorio`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.ejecucion_mensual: ~15 rows (aproximadamente)
INSERT INTO `ejecucion_mensual` (`idEjecucionMensual`, `idAnioRegulatorio`, `mesOld`, `mes`, `programado`, `ejecutado`, `igv`, `total`, `archivo`, `fisico`, `estado`, `fechaCreado`, `fechaActualizado`) VALUES
	(45, 13, 1, '2025-01-31', 0.00, 46784.00, 0.00, 46784.00, NULL, NULL, 1, NULL, '2026-07-23 23:40:07'),
	(57, 14, 1, '2025-12-31', 0.00, 14657.00, 0.00, 14657.00, NULL, NULL, 1, NULL, '2026-07-23 23:47:57'),
	(74, 18, 1, '2025-12-31', 0.00, 151400.16, 0.00, 151400.16, 'uploads/ejecuciones/2026/18/18_20260802_225549_955AF77D.pdf', NULL, 1, NULL, '2026-08-02 22:55:49'),
	(87, 19, 1, '2026-07-17', 0.00, 66394.00, 0.00, 66394.00, 'uploads/ejecuciones/2026/19/19_20260802_224955_CF2B58BD.pdf', NULL, 1, NULL, '2026-08-02 22:49:56'),
	(104, 15, NULL, '2026-07-17', 0.00, 18400.00, 0.00, 18400.00, 'uploads/ejecuciones/15/6a587c15ac8ae.pdf', NULL, 1, '2026-07-16 01:37:09', '2026-07-23 23:57:28'),
	(109, 16, NULL, '2026-07-17', 0.00, 118340.00, 0.00, 118340.00, NULL, NULL, 1, '2026-07-19 19:15:51', '2026-07-23 23:44:36'),
	(113, 22, NULL, '2025-12-31', 0.00, 36017.00, 0.00, 36017.00, NULL, NULL, 1, '2026-07-16 15:42:34', NULL),
	(114, 28, NULL, '2025-12-31', 0.00, 9377.00, 0.00, 9377.00, NULL, NULL, 1, '2026-07-16 16:08:00', NULL),
	(115, 29, NULL, '2026-07-17', 0.00, 3970.00, 0.00, 3970.00, NULL, NULL, 1, '2026-07-16 16:09:44', NULL),
	(116, 32, NULL, '2025-12-31', 0.00, 45085.00, 0.00, 45085.00, NULL, NULL, 1, '2026-07-16 16:14:07', NULL),
	(117, 36, NULL, '2025-12-31', 0.00, 36102.00, 0.00, 36102.00, NULL, NULL, 1, '2026-07-16 16:19:27', NULL),
	(118, 40, NULL, '2025-12-31', 0.00, 290102.99, 0.00, 290102.99, NULL, NULL, 1, '2026-07-26 16:37:10', NULL),
	(119, 41, NULL, '2026-07-17', 0.00, 72476.00, 0.00, 72476.00, NULL, NULL, 1, '2026-07-26 16:40:37', NULL),
	(120, 42, NULL, '2025-12-31', 0.00, 369413.00, 0.00, 369413.00, NULL, NULL, 1, '2026-07-26 16:50:38', NULL),
	(121, 43, NULL, '2026-07-17', 0.00, 199211.00, 0.00, 199211.00, NULL, NULL, 1, '2026-07-26 16:56:55', NULL),
	(122, 50, NULL, '2025-12-31', 0.00, 26250.00, 0.00, 26250.00, NULL, NULL, 1, '2026-08-04 22:20:15', '2026-08-04 22:22:23'),
	(123, 51, NULL, '2026-07-17', 0.00, 26250.00, 0.00, 26250.00, NULL, NULL, 1, '2026-08-04 22:22:02', NULL),
	(124, 55, NULL, '2025-12-31', 0.00, 31101.00, 0.00, 31101.00, NULL, NULL, 1, '2026-08-04 22:29:16', NULL),
	(125, 56, NULL, '2026-07-17', 0.00, 3600.73, 0.00, 3600.73, NULL, NULL, 1, '2026-08-04 22:33:11', NULL),
	(127, 59, NULL, '2025-12-31', 0.00, 23000.00, 0.00, 23000.00, NULL, NULL, 1, '2026-08-04 22:37:41', NULL),
	(128, 63, NULL, '2025-12-31', 0.00, 333477.00, 0.00, 333477.00, NULL, NULL, 1, '2026-08-04 23:01:54', '2026-08-04 23:53:43'),
	(129, 67, NULL, '2025-12-31', 0.00, 104083.00, 0.00, 104083.00, NULL, NULL, 1, '2026-08-04 23:06:59', NULL),
	(130, 68, NULL, '2026-07-17', 0.00, 45853.70, 0.00, 45853.70, NULL, NULL, 1, '2026-08-04 23:07:52', NULL),
	(131, 73, NULL, '2025-12-31', 0.00, 12905.00, 0.00, 12905.00, NULL, NULL, 1, '2026-08-04 23:12:20', NULL),
	(132, 74, NULL, '2026-12-31', 0.00, 93746.00, 0.00, 93746.00, NULL, NULL, 1, '2026-08-04 23:15:01', NULL),
	(133, 75, NULL, '2026-07-17', 0.00, 1437.00, 0.00, 1437.00, NULL, NULL, 1, '2026-08-04 23:16:49', NULL),
	(134, 76, NULL, '2026-12-31', 0.00, 12395.00, 0.00, 12395.00, NULL, NULL, 1, '2026-08-04 23:21:05', NULL),
	(135, 77, NULL, '2026-12-31', 0.00, 103935.00, 0.00, 103935.00, NULL, NULL, 1, '2026-08-04 23:24:28', NULL),
	(136, 78, NULL, '2026-12-31', 0.00, 121328.00, 0.00, 121328.00, NULL, NULL, 1, '2026-08-04 23:30:35', NULL),
	(137, 79, NULL, '2025-12-31', 0.00, 68412.00, 0.00, 68412.00, NULL, NULL, 1, '2026-08-04 23:35:20', NULL),
	(138, 52, NULL, '2025-12-31', 0.00, 313153.00, 0.00, 313153.00, NULL, NULL, 1, '2026-08-04 23:48:05', NULL),
	(139, 57, NULL, '2026-07-17', 0.00, 683342.00, 0.00, 683342.00, NULL, NULL, 1, '2026-08-04 23:48:59', NULL),
	(140, 66, NULL, '2026-07-17', 0.00, 80917.00, 0.00, 80917.00, NULL, NULL, 1, '2026-08-04 23:54:32', NULL),
	(141, 69, NULL, '2025-12-31', 0.00, 11723.00, 0.00, 11723.00, NULL, NULL, 1, '2026-08-05 00:02:14', NULL),
	(142, 72, NULL, '2026-07-17', 0.00, 6600.00, 0.00, 6600.00, NULL, NULL, 1, '2026-08-05 00:05:03', NULL);

-- Volcando estructura para tabla bd_seprin.estudio_tarifario
CREATE TABLE IF NOT EXISTS `estudio_tarifario` (
  `idEstudioTarifario` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anioInicio` smallint DEFAULT NULL,
  `anioFin` smallint DEFAULT NULL,
  `estado` enum('ACTIVO','CERRADO') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idEstudioTarifario`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.estudio_tarifario: ~2 rows (aproximadamente)
INSERT INTO `estudio_tarifario` (`idEstudioTarifario`, `codigo`, `nombre`, `anioInicio`, `anioFin`, `estado`, `fechaCreado`, `fechaActualizado`) VALUES
	(1, 'ET-01', 'Estudio Tarifario 01', 2025, 2028, 'ACTIVO', '2026-07-09 20:48:44', NULL),
	(4, 'ET-02', 'Estudio Tarifario 02', 2029, 2032, 'ACTIVO', '2026-07-27 15:16:05', NULL);

-- Volcando estructura para tabla bd_seprin.fondos
CREATE TABLE IF NOT EXISTS `fondos` (
  `idFondos` int NOT NULL AUTO_INCREMENT,
  `codigoFondo` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreFondo` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcionFondo` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estadoFondo` tinyint DEFAULT '1',
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualiuzado` datetime DEFAULT NULL,
  PRIMARY KEY (`idFondos`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.fondos: ~6 rows (aproximadamente)
INSERT INTO `fondos` (`idFondos`, `codigoFondo`, `nombreFondo`, `descripcionFondo`, `estadoFondo`, `fechaCreado`, `fechaActualiuzado`) VALUES
	(1, 'FI', 'FONDO DE INVERSION', 'INVERSION', 1, '2026-07-04 13:10:20', NULL),
	(2, 'PCC&PAS', 'FONDO DE PCC&PAS', 'RESERVA', 1, '2026-07-04 13:10:41', NULL),
	(3, 'GRD&ACC', 'GESTION DE RIESGO GRD&ACC', 'RIESGO', 1, '2026-07-04 13:12:08', '2026-07-12 11:26:34'),
	(4, 'MRSE', 'MRSE', 'MRSE', 1, '2026-07-07 22:10:18', NULL),
	(10, 'S/R', 'SIN REGISTRO', 'No cuenta con tipo de fondo o denominación.', 1, '2026-08-04 22:02:07', NULL),
	(11, 'ACT', 'ACTIVIDAD', 'Actividad', 1, '2026-08-04 22:12:25', NULL);

-- Volcando estructura para tabla bd_seprin.gerencias
CREATE TABLE IF NOT EXISTS `gerencias` (
  `idGerencias` int NOT NULL AUTO_INCREMENT,
  `siglasGerencia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreGerencia` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estadoGerencia` tinyint DEFAULT '1',
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idGerencias`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.gerencias: ~6 rows (aproximadamente)
INSERT INTO `gerencias` (`idGerencias`, `siglasGerencia`, `nombreGerencia`, `estadoGerencia`, `fechaCreado`, `fechaActualizado`) VALUES
	(1, 'GG', 'GERENCIA GENERAL', 1, '2026-07-05 16:05:20', NULL),
	(2, 'GC', 'GERENCIA COMERCIAL', 1, '2026-07-05 16:05:36', NULL),
	(3, 'GO', 'GERENCIA DE OPERACIONES', 1, '2026-07-05 16:05:49', NULL),
	(4, 'GAF', 'GERENCIA DE ADMINISTRACION Y FINANZAS', 1, '2026-07-05 16:06:10', NULL),
	(5, 'GAJ', 'GERENCIA DE ASESORIA JURIDICA', 1, '2026-07-05 16:06:25', NULL);

-- Volcando estructura para tabla bd_seprin.inversiones
CREATE TABLE IF NOT EXISTS `inversiones` (
  `idInversiones` int NOT NULL AUTO_INCREMENT,
  `idEstudioTarifario` int DEFAULT NULL,
  `idFondos` int DEFAULT NULL,
  `idAreas` int DEFAULT NULL,
  `cui` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `observaciones` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint DEFAULT '1',
  `estadoInversion` enum('1','2','3','4','5','6','7','8','9') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idInversiones`),
  UNIQUE KEY `cui` (`cui`),
  KEY `idFondos` (`idFondos`),
  KEY `idAreas` (`idAreas`),
  KEY `idEstudioTarifario` (`idEstudioTarifario`),
  CONSTRAINT `FK_inversiones_areas` FOREIGN KEY (`idAreas`) REFERENCES `areas` (`idAreas`),
  CONSTRAINT `FK_inversiones_estudio_tarifario` FOREIGN KEY (`idEstudioTarifario`) REFERENCES `estudio_tarifario` (`idEstudioTarifario`),
  CONSTRAINT `FK_inversiones_fondos` FOREIGN KEY (`idFondos`) REFERENCES `fondos` (`idFondos`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.inversiones: ~32 rows (aproximadamente)
INSERT INTO `inversiones` (`idInversiones`, `idEstudioTarifario`, `idFondos`, `idAreas`, `cui`, `descripcion`, `nombre`, `observaciones`, `estado`, `estadoInversion`, `fechaCreado`, `fechaActualizado`) VALUES
	(6, 1, 2, 8, NULL, 'ADQUISICIÓN ESPECTROFOTÓMETRO PARA MONITOREO PCC', 'ADQUISICIÓN DE UN SPECTOFOTOMETRO PARA EL MONITOREO DE NUEVOS PARÁMETROS DEL PCC', NULL, 1, '1', '2026-07-09 23:12:50', NULL),
	(7, 1, 2, 8, NULL, 'ADQUISICIÓN DE EQUIPOS DE CONTROL DE CALIDAD PCC', 'ADQUISICIÓN DE EQUIPOS DE CONTROL DE CALIDAD PARA EL MONITOREO DE NUEVOS PARAMETROS DEL PCC EPS ILO S.A.', NULL, 1, '1', '2026-07-09 23:13:01', NULL),
	(8, 1, 2, 8, NULL, 'ACTUALIZACIÓN DEL PCC Y PAS', 'ACTUALIZACION DEL PCC Y PAS DE LA EPS ILO S.A.', '', 1, '1', '2026-07-09 23:13:43', NULL),
	(9, 1, 4, 10, NULL, 'MRSE: CONSERVACIÓN Y RECUPERACIÓN SERVICIOS ECOSISTÉMICOS HÍDRICOS CUENCA ILO-MOQUEGUA', 'PLAN DE INTERVENCIÓN EN MECANISMO DE RETRIBUCION DE SERVICIOS ECOSISTEMATICOS HIDRICOS DE LA EPS ILO S.A. CONSERVACION Y RECUPERACION DE LOS SERVICIOS ECOSISTEMATICOS HIDRICOS DE REGULACION HIDRICA Y CALIDAD DE AGUA DE LA CUENCA ILO - MOQUEGUA.', '', 1, '1', '2026-07-11 11:44:09', NULL),
	(10, 1, 3, 1, NULL, 'SISTEMA DE ALERTA TEMPRANA ANTE CRECIDAS DEL RÍO (PASTO GRANDE E ITE)', 'IMPLEMENTACION DE SISTEMA DE ALERTA TEMPRANA ANTE CRECIDAS DEL RIO PARA EL SISTEMA PASTO GRANDE E ITE.', '', 1, '1', '2026-07-12 12:26:09', NULL),
	(13, 1, 3, 1, NULL, 'REFORZAMIENTO DE TALUD CAPTACIÓN ITE NORTE', 'REFORZAMIENTO DE TALUD EN LA CAPTACION ITE NORTE DE LA EPS ILO.', '', 1, '1', '2026-07-12 17:57:38', NULL),
	(14, 1, 3, 4, NULL, 'SISTEMA DE COMUNICACIÓN SATELITAL CAPTACIÓN PASTO GRANDE Y PTAP CATA CATAS', 'IMPLEMENTACION DE SISTEMA DE COMUNICACIÓN SATELITAL DE LA CAPTACION PASTO GRANDE Y LA PLANTA 1 (CATA CATAS).', '', 1, '1', '2026-07-21 22:36:25', NULL),
	(15, 1, 3, 4, NULL, 'REMOCIÓN DE MATERIAL ARRASTRADO POR EL RÍO HACIA BOCATOMA', 'REMOCION DE MATERIAL ARRASTRADO POR EL RIO HACIA LA BOCATOMA DE LA CAPTACION.', '', 1, '1', '2026-07-21 22:38:04', NULL),
	(16, 1, 3, 4, NULL, 'ACTUALIZACIÓN E IMPLEMENTACIÓN DEL PLAN DE CONTINGENCIA', 'ACTUALIZACION E IMPLEMENTACION DEL PLAN DE CONTIGENCIA Y ELABORACION DE ACC.', '', 1, '1', '2026-07-21 22:38:44', NULL),
	(17, 1, 1, 1, '2634345', 'REMODELACIÓN CÁMARA PURGA VA-5 Y AMPLIACIÓN RED DISTRIBUCIÓN (CALIENTA NEGROS–PUERTO INGLÉS)', '"REMODELACION DE CÁMARA DE VÁLVULAS; CONSTRUCCION DE RED DE DISTRIBUCION; EN EL(LA) TRAMO: CALIENTA NEGROS - PLAYA PUERTO INGLES DE LA EPS ILO S.A DISTRITO DE ILO, PROVINCIA ILO, DEPARTAMENTO MOQUEGUA".', '', 1, '3', '2026-07-22 22:24:17', NULL),
	(18, 1, 1, 1, '2648905', 'MEJORAMIENTO Y AMPLIACIÓN COLECTOR PRIMARIO AV. INGRESO CIUDAD DE ILO (MAGISTERIO–BY PASS ALTO ILO)', 'MEJORAMIENTO Y AMPLIACION DEL SERVICIO DE ALCANTARILLADO EN COLECTOR PRIMARIO EN LA AV. DE INGRESO A CIUDAD DE ILO , DESDE LA DESCARGA DE LA URB. MAGISTERIO DE LA PAMPA INALAMBRICA HASTA EL BY PASS ALTO ILO DISTRITO DE ILO DE LA PROVINCIA DE ILO DEL DEPARTAMENTO DE MOQUEGUA.', '', 1, '3', '2026-07-22 22:27:25', NULL),
	(19, 1, 1, 1, '2627539', 'MEJORAMIENTO PTAP N.°1 – RECUPERACIÓN AGUA DE LAVADO Y TRATAMIENTO DE LODOS', 'MEJORAMIENTO DEL SERVICIO DE AGUA POTABLE URBANO EN DE LA PTAP MEDIANTE UN SISTEMA DE RECUPERACION DE AGUA DE LAVADO DE UNIDADES Y TRATAMIENTO DE LODOS DISTRITO DE ILO DE LA PROVINCIA DE ILO DEL DEPARTAMENTO DE MOQUEGUA.', '', 1, '6', '2026-07-22 22:29:05', NULL),
	(20, 1, 10, 1, NULL, 'CONSTRUCCIÓN CERCO PERIMÉTRICO PLANTA CATA CATAS', 'CONSTRUCCIÓN DE CERCO PERIMETRICO DE PLANTA CATA CATAS.', '', 1, '6', '2026-07-22 22:30:07', NULL),
	(21, 1, 1, 1, '2662798', 'REHABILITACIÓN CÁMARAS PURGA DE AIRE Y LODO LÍNEAS CONDUCCIÓN ITE NORTE Y PASTO GRANDE', 'REMODELACION DE CÁMARA DE VÁLVULAS; EN EL(LA) LINEA DE CONDUCCION DE AGUA CRUDA ITE NORTE Y PASTO GRANDE DISTRITO DE EL ALGARROBAL, PROVINCIA ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '3', '2026-07-22 22:35:20', NULL),
	(22, 1, 1, 1, NULL, 'ELABORACIÓN DE EXPEDIENTES TÉCNICOS (AR03-AR04)', 'ELABORACIÓN DE EXPEDIENTES TECNICOS.', '', 1, '1', '2026-07-22 22:36:33', NULL),
	(23, 1, 11, 2, NULL, 'ADQUISICIÓN DE 1,000 MEDIDORES PARA CONEXIONES NUEVAS', 'ADQUISICION DE 1000 MEDIDORES PARA CONEXIONES NUEVAS EN LA EPS ILO S.A., PARA LA OPTIMIZACIÓN DEL SISTEMA DE DISTRIBUCIÓN DE AGUA POTABLE, DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '1', '2026-07-22 22:37:32', NULL),
	(24, 1, 1, 2, '2702090', 'RENOVACIÓN DE MICROMEDIDORES (23,235 CONEXIONES)', 'RENOVACION DE MICROMEDIDORES EN EL (LA) EPS ILO S.A., DE 23235 CONEXIONES EN EL DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '6', '2026-07-22 22:40:44', NULL),
	(25, 1, 11, 2, NULL, 'ADQUISICIÓN DE 197 MEDIDORES DE ALTOS CONSUMIDORES', 'ADQUISICION DE 197 MEDIDORES DE ALTOS CONSUMIDORES DE LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '1', '2026-07-22 22:42:58', NULL),
	(26, 1, 11, 2, NULL, 'ADQUISICIÓN DE 19 DATALOGGERS PARA GRANDES CONSUMIDORES', 'ADQUISICION DE 19 DATALOGGER PARA GRANDES CONSUMIDORES EN LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '1', '2026-07-22 22:46:10', NULL),
	(27, 1, 10, 6, NULL, 'CONSTRUCCIÓN OFICINA ATENCIÓN AL CLIENTE PAMPA INALÁMBRICA', 'CONSTRUCCION DE OFICINA PARA ATENCION AL CLIENTE EN EL SECTOR DE LA PAMPA INALAMBRICA, DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '1', '2026-07-22 22:47:31', NULL),
	(28, 1, 11, 12, NULL, 'ADQUISICIÓN DE COMPUERTAS TIPO GUILLOTINA PARA PTAP PAMPA INALÁMBRICA', 'ADQUISICION DE COMPUERTAS  TIPO GUILLOTINA PARA LA PTAP PAMPA INALAMBRICA.', '', 1, '1', '2026-07-22 22:51:58', NULL),
	(29, 1, 11, 3, NULL, 'RENOVACIÓN SISTEMA DE PROCESAMIENTO DE INFORMACIÓN (EQUIPOS INFORMÁTICOS)', 'RENOVACION DEL SISTEMA DE PROCESAMIENTO DE INFORMACION (COMPUTADORAS, IMPRESORAS Y PERIFERICOS, EN EL (LA) GERENCIA GENERAL , GERENCIA DE ADMINISTRACION FINANCIERA , GERENCIA COMERCIAL Y GERENCIA DE OPERACIONES DE LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '1', '2026-07-22 22:54:03', NULL),
	(30, 1, 1, 1, '2602293', 'ADQUISICIÓN DE VEHÍCULO, SERVIDORES Y EQUIPOS COMPLEMENTARIOS', 'ADQUISICION DE VEHICULO, SISTEMAS DE PROCESAMIENTO Y ALMACENAMIENTO (SERVIDORES, STORAGE, LIBRERIAS DE RESPALDO, CLOUDBRIDGE), COMPUTADORA (LABORATORIO) Y EQUIPO DE OTROS ACTIVOS COMPLEMENTARIOS; EN EL(LA) GERENCIA GENERAL, GERENCIA DE ADMINISTRACION FINANCIERA, GERENCIA COMERCIAL Y GERENCIA DE OPERACIONES DE LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '3', '2026-07-22 22:56:57', NULL),
	(31, 1, 11, 12, NULL, 'REEMPLAZO LÍNEA DE DESCARGA LAGUNA FACULTATIVA TERCIARIA 3A', 'REEMPLAZO DE LINEA DE DESCARGA DE LAGUNA FACULTATIVA TERCIARIA 3A.', '', 1, '7', '2026-07-22 22:58:28', NULL),
	(32, 1, 11, 12, NULL, 'ADQUISICIÓN DE ARENA CUARZOSA PARA PTAP CATA CATAS', 'ADQUISICION DE ARENA CUARZOSA PARA LA PTAP CATA CATAS.', '', 1, '7', '2026-07-22 22:59:49', NULL),
	(33, 1, 11, 3, NULL, 'IMPLEMENTACIÓN SISTEMA DE CONTROL DE ASISTENCIA WEB', 'IMPLEMENTACION DE UN SISTEMA DE CONTROL DE ASISTENCIA WEB, EN TODAS LAS SEDES DE LA GERENCIA GENERAL ,  GERENCIA DE ADMINISTRACION FINANCIERA , GERENCIA COMERCIAL Y GERENCIA DE OPERACIONES DE LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '7', '2026-07-22 23:02:04', NULL),
	(34, 1, 11, 2, NULL, 'ACTUALIZACIÓN DE DATOS DE USUARIOS', 'ACTUALIZACION DE DATOS DE USUARIOS DE (LA) EPS ILO S.A., PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '7', '2026-07-22 23:03:23', NULL),
	(35, 1, 11, 7, NULL, 'REDUCCIÓN CARTERA MOROSA Y CONEXIONES INACTIVAS', 'REDUCCION DE LA CARTERA MOROSA Y CONEXIONES INACTIVAS PARA SINCERAR LAS CUENTAS DE LA EPS ILO S.A.', '', 1, '7', '2026-07-22 23:04:41', NULL),
	(36, 1, 11, 13, NULL, 'MEJORAMIENTO Y REMODELACIÓN OFICINAS GERENCIA COMERCIAL', 'MEJORAMIENTO, REMODELACION Y MANTENIMIENTO DE LA INFRAESTRUCTURA EXISTENTE DE LAS OFICINAS DE ATENCION AL CLIENTE DE LA GERENCIA COMERCIAL DE LA EPS ILO S.A., DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '7', '2026-07-22 23:19:36', NULL),
	(37, 1, 10, 1, NULL, 'REMODELACIÓN CÁMARAS PURGA DE AIRE Y AGUA LÍNEA CONDUCCIÓN R-1 A COSTA AZUL', 'REMODELACIÓN DE LAS CAMARAS DE PURGA DE AIRE Y PURGA DE AGUA DE LA LINEA DE CONDUCCION EN EL (LA) TRAMO DEL R-1 A COSTA AZUL.', '', 1, '1', '2026-07-22 23:21:04', NULL),
	(38, 1, 10, 1, NULL, 'REMODELACIÓN GALERÍA FILTRANTE CAPTACIÓN PASTO GRANDE', 'REMODELACION DE GALERIA FILTRANTE, EN EL (LA) EN LA CAPTACION DE PASTO GRANDE DE EPS ILO S.A. DISTRITO DE EL ALGARROBAL, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '1', '2026-07-22 23:22:03', NULL),
	(39, 1, 10, 1, NULL, 'RENOVACIÓN LÍNEA DE ADUCCIÓN COSTA AZUL – CIUDAD NUEVA', 'RENOVACIÓN DE LINEA DE ADUCCION DESDE COSTA AZUL - CIUDAD NUEVA, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '1', '2026-07-22 23:22:59', NULL);

-- Volcando estructura para tabla bd_seprin.permisos
CREATE TABLE IF NOT EXISTS `permisos` (
  `idPermiso` int NOT NULL AUTO_INCREMENT,
  `permiso` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grupo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruta` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icono` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orden` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint DEFAULT '1',
  `fechaCreado` datetime DEFAULT NULL,
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.permisos: ~16 rows (aproximadamente)
INSERT INTO `permisos` (`idPermiso`, `permiso`, `grupo`, `ruta`, `icono`, `orden`, `estado`, `fechaCreado`) VALUES
	(1, 'Dashboard Ejecutivo', 'General', 'dashboard', 'bi-speedometer2', '1', 1, '2026-06-27 21:51:11'),
	(2, 'Usuarios', 'Seguridad', 'usuarios', 'bi-people', '1', 1, '2026-06-27 21:51:12'),
	(3, 'Roles', 'Seguridad', 'roles', 'bi-person-badge', '2', 1, '2026-06-27 21:51:13'),
	(4, 'Permisos', 'Seguridad', 'permisos', 'bi-shield-lock', '3', 1, '2026-06-27 21:51:14'),
	(5, 'Inversion', 'Inversiones', 'inversiones', 'bi bi-bank', '1', 1, '2026-06-27 23:04:00'),
	(7, 'Centro de Reportes', 'Reportes', 'reportes', 'bi bi-file-earmark-bar-graph', '1', 1, '2026-06-28 14:30:23'),
	(9, 'Estudio Tarifario', 'Administración', 'estudioTarifario', 'bi-calendar-range', '1', 1, '2026-07-11 16:05:34'),
	(10, 'Fondos', 'Administración', 'fondos', 'bi bi-wallet2', '2', 1, '2026-07-11 17:04:47'),
	(11, 'Gerencias', 'Administración', 'gerencias', 'bi bi-diagram-3', '3', 1, '2026-07-11 23:36:18'),
	(12, 'Areas', 'Administración', 'areas', 'bi bi-grid', '4', 1, '2026-07-12 00:17:18'),
	(13, 'Año Regulatorio', 'Inversiones', 'anioregulatorio', 'bi-calendar3', '2', 1, '2026-07-12 13:50:00'),
	(14, 'Dashboard Inversión', 'General', 'dashboardInversion', 'bi-graph-up', '2', 1, '2026-07-18 20:13:21'),
	(15, 'I. Ver todas las inversiones', 'Inversiones', 'ver_todas_inversiones', 'bi bi-eye', '4', 1, '2026-07-28 11:02:15'),
	(16, 'Ver inversiones asignadas', 'Inversiones', 'ver_inversiones_asignadas', 'bi bi-diagram-3', '3', 0, '2026-07-28 11:39:09'),
	(17, 'C.R. Ver todas las inversiones', 'Reportes', 'reportes_globales', 'bi bi-eye', '2', 1, '2026-07-28 14:12:01'),
	(18, 'D.I. Ver todas las inversiones', 'General', 'ver_dashboard_inversion_todo', 'bi bi-eye', '3', 1, '2026-07-28 14:56:26');

-- Volcando estructura para tabla bd_seprin.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `idRol` int NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcionRol` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.roles: ~9 rows (aproximadamente)
INSERT INTO `roles` (`idRol`, `nombreRol`, `descripcionRol`, `estado`, `fechaCreado`) VALUES
	(1, 'Super Admin', 'Administracion total.', '1', '2026-06-28 00:38:21'),
	(2, 'Admin', 'Administracion Parcial', '1', '2026-06-28 00:38:22'),
	(3, 'GerenteGeneral', 'Gerente General', '0', '2026-06-28 00:38:23'),
	(9, 'Asistente', 'Personal de apoyo', '1', '2026-06-29 19:47:51'),
	(10, 'Soporte', 'Soporte al sistema.', '1', '2026-06-29 23:13:35'),
	(11, 'Operador', 'Usuario Operador', '0', '2026-07-18 19:57:24'),
	(12, 'GerenteLinea', 'Gerente de Línea', '0', '2026-07-18 19:57:56'),
	(13, 'JefeOficina', 'Jefe de Oficina', '0', '2026-07-18 19:58:19'),
	(14, 'Administrativo', 'Personal que registra datos.', '1', '2026-07-28 00:38:48');

-- Volcando estructura para tabla bd_seprin.rol_permiso
CREATE TABLE IF NOT EXISTS `rol_permiso` (
  `idRolPermiso` int NOT NULL AUTO_INCREMENT,
  `idRol` int DEFAULT NULL,
  `idPermiso` int DEFAULT NULL,
  PRIMARY KEY (`idRolPermiso`),
  KEY `FK_rol_permiso_roles` (`idRol`),
  KEY `FK_rol_permiso_permisos` (`idPermiso`),
  CONSTRAINT `FK_rol_permiso_permisos` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`idPermiso`),
  CONSTRAINT `FK_rol_permiso_roles` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=337 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.rol_permiso: ~58 rows (aproximadamente)
INSERT INTO `rol_permiso` (`idRolPermiso`, `idRol`, `idPermiso`) VALUES
	(95, 13, 14),
	(96, 13, 13),
	(97, 13, 5),
	(98, 13, 7),
	(99, 3, 9),
	(100, 3, 10),
	(101, 3, 11),
	(102, 3, 12),
	(103, 3, 1),
	(104, 3, 14),
	(105, 3, 13),
	(106, 3, 5),
	(107, 3, 7),
	(108, 3, 2),
	(109, 3, 3),
	(110, 3, 4),
	(154, 12, 14),
	(155, 12, 13),
	(156, 12, 5),
	(157, 12, 7),
	(158, 11, 14),
	(159, 11, 13),
	(160, 11, 5),
	(161, 11, 7),
	(173, 9, 13),
	(174, 9, 5),
	(175, 10, 2),
	(176, 10, 3),
	(177, 10, 4),
	(300, 2, 9),
	(301, 2, 10),
	(302, 2, 11),
	(303, 2, 12),
	(304, 2, 1),
	(305, 2, 14),
	(306, 2, 18),
	(307, 2, 5),
	(308, 2, 13),
	(309, 2, 15),
	(310, 2, 7),
	(311, 2, 17),
	(312, 2, 2),
	(313, 1, 9),
	(314, 1, 10),
	(315, 1, 11),
	(316, 1, 12),
	(317, 1, 1),
	(318, 1, 14),
	(319, 1, 18),
	(320, 1, 5),
	(321, 1, 13),
	(322, 1, 15),
	(323, 1, 7),
	(324, 1, 17),
	(325, 1, 2),
	(326, 1, 3),
	(327, 1, 4),
	(332, 14, 14),
	(333, 14, 5),
	(334, 14, 13),
	(335, 14, 15),
	(336, 14, 7);

-- Volcando estructura para tabla bd_seprin.seguimiento_mensual
CREATE TABLE IF NOT EXISTS `seguimiento_mensual` (
  `idSeguimientoMensual` int NOT NULL AUTO_INCREMENT,
  `idAnioRegulatorio` int DEFAULT NULL,
  `producto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estadoInver` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acciones` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechas` date DEFAULT NULL,
  `situacion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint DEFAULT '1',
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idSeguimientoMensual`),
  KEY `idAnioRegulatorio` (`idAnioRegulatorio`),
  CONSTRAINT `FK_seguimiento_mensual_anio_regulatorio` FOREIGN KEY (`idAnioRegulatorio`) REFERENCES `anio_regulatorio` (`idAnioRegulatorio`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.seguimiento_mensual: ~13 rows (aproximadamente)
INSERT INTO `seguimiento_mensual` (`idSeguimientoMensual`, `idAnioRegulatorio`, `producto`, `estadoInver`, `acciones`, `fechas`, `situacion`, `estado`, `fechaCreado`, `fechaActualizado`) VALUES
	(12, 16, NULL, 'EN EJECUCION ', 'Actualizacion fichas del PCC (determinacion del procedimiento SUNASS)', '2026-07-20', 'Ejecucion fisica culminada, en solicitud de modificacion de fichas.', 1, '2026-07-17 19:17:10', '2026-07-23 23:49:54'),
	(13, 19, NULL, 'ACTUALIZACION DE EXPEDIENTE TECNICO.', 'CONVOCATORIA "COCHA EN ASANA"', '2026-08-03', 'Ejecución y supervisión de la cocha según Exp Tecnico S/ 364,249.96 (incluido IGV) disponi ptop S/ 225,500 (s/igv). Presupuesto ODP de S/ 236,500 saldo', 1, '2026-07-17 21:48:04', NULL),
	(14, 19, NULL, 'ELABORACION DE TDR.', 'Culminación del servicio', '2026-10-05', '', 1, '2026-07-17 21:51:30', NULL),
	(16, 17, NULL, 'ELABORACION DE REQUERIMIENTO', 'Generacion de Orden de Servicio, tipo mensual desde enero', NULL, 'Se encuentra en ejecución del servicio.', 1, '2026-07-17 00:59:55', NULL),
	(17, 23, NULL, 'EN TRATO DE FINANCIAMIENTO DEL PROYECTO INTEGRAL', 'ELABORACION DE TDR según presupuesto de ET', '2026-07-21', '', 1, '2026-07-17 15:46:02', NULL),
	(18, 33, NULL, 'ELABORACION DE REQUERIMIENTOS', 'ORDEN DE SERV.', NULL, '', 1, '2026-07-17 16:15:38', NULL),
	(19, 37, NULL, '', 'En Ejecución, plazo 3 meses', '2026-07-30', '', 1, '2026-07-17 16:21:11', NULL),
	(20, 41, NULL, 'EJECUCION CONTRATO CULMINADO', 'Emision de acto resolutivo de supervision de obra', '2026-07-16', 'Aprobacion de liquidacion de contrato de obra mediante RGG N° XX', 1, '2026-07-17 16:42:33', NULL),
	(21, 41, NULL, 'EJECUCION CONTRATO CULMINADO', 'Notificacion de acto resolutivo para el ejecutor y supervisor de obra', NULL, 'Aprobacion de liquidacion de contrato de obra mediante RGG N° XX', 1, '2026-07-17 16:43:21', NULL),
	(22, 43, NULL, 'EJECUCION CONTRATO CULMINADO', 'Revision de la liquidacion del contrato de obra por el Supervisor de Obra (OIPO)', '2026-07-17', 'Se estima su liquidación del contrato de obra por el Supervisor de Obra', 1, '2026-07-17 16:59:30', NULL),
	(23, 43, NULL, 'EJECUCION CONTRATO CULMINADO', 'Aprobación de Liq. De obra mediante acto resolutivo.', '2026-08-15', 'Se estima su liquidación del contrato de obra por el Supervisor de Obra', 1, '2026-07-17 17:00:18', NULL),
	(24, 44, NULL, 'EVALUACION EXPEDIENTE TECNICO', 'Levantamiento de observaciones y revisión.', '2026-08-07', 'Se encuentra en Levantamiento de observaciones.', 1, '2026-07-17 17:06:42', NULL),
	(25, 44, NULL, 'EVALUACION EXPEDIENTE TECNICO', 'APROB. DE EXP. TEC.', '2026-08-24', 'Se encuentra en Levantamiento de observaciones.', 1, '2026-07-17 17:07:17', NULL),
	(26, 46, NULL, 'EVALUACION DE EXPEDIENTE TECNICO Y OPCIONES ALTERNATIVAS PARA SU EJECUCIUON', 'Actualización de Exp. Tec. Por parte de OIPO', '2026-08-31', 'Con posibilidad para reprogramar en el 3er o 4to año regulatorio mediante información y aprobación por SUNASS.', 1, '2026-07-17 17:14:56', NULL),
	(27, 48, NULL, 'CORRESPONDE AÑO 3', 'FORMULACIÓN DE PROYECTO RESERVORIO', '2026-03-19', '', 1, '2026-07-17 22:10:53', NULL),
	(28, 51, NULL, 'META CULMINADA', '', NULL, 'CULMINADO POR LA ENTREGA DE LOS MICROMEDIDORES', 1, '2026-07-17 22:24:30', NULL),
	(29, 56, NULL, 'EN EJECUCION', '', NULL, 'Culminado, cancelado en el mes de julio', 1, '2026-07-17 22:35:17', NULL),
	(30, 57, NULL, 'EJECUCION CONTRATO CULMINADO', 'Liquidación de Contrato de Obra', '2026-07-31', 'Se estima su presentación de liquidación para fines de julio', 1, '2026-07-17 22:39:30', NULL),
	(31, 60, NULL, 'EN EJECUCION', '', NULL, 'Culminado, cancelado en el mes de julio', 1, '2026-07-17 22:40:07', NULL),
	(32, 57, NULL, 'EJECUCION CONTRATO CULMINADO', 'Levantamiento de observaciones', '2026-08-31', '', 1, '2026-07-17 22:40:14', NULL),
	(33, 61, NULL, 'AÑO 3 - ASIGNACION DE PRESUPUESTO PARA FORMULACION DEL EXP. TECNICO R5.', 'Asig de Presupuesto para la  Elab. de Anteproyecto y Exp. Tec.', NULL, '', 1, '2026-07-17 22:45:56', '2026-08-04 22:55:33'),
	(34, 61, NULL, 'AÑO 3 - PROPUESTA ANTEPROYECTO R5.', 'Asig de Presupuesto para la Elab. de Anteproyecto y Exp. Tec.', NULL, '', 1, '2026-07-17 22:56:35', NULL),
	(35, 65, NULL, 'PROCESO ADJUDICADO CON ORDEN COMPRA (INCLUYE META 1ER AÑO REGULATORIO)', 'Orden de Compra', '2026-05-19', 'SE estima su terminacion para el mes de octubre 2026', 1, '2026-07-17 23:03:39', NULL),
	(36, 65, NULL, 'PROCESO ADJUDICADO CON ORDEN COMPRA (INCLUYE META 1ER AÑO REGULATORIO)', 'Puesto en funcionamiento', '2026-10-19', 'SE estima su terminacion para el mes de octubre 2026', 1, '2026-07-17 23:04:07', NULL),
	(37, 66, NULL, 'EN EJECUCION', 'Conformidad de recepción de medidores', '2026-08-03', 'En revision de la formalizacion del contrato de adquisición de llaves termoplásticas con opinión legal ', 1, '2026-07-17 23:05:31', NULL),
	(38, 66, NULL, 'EN EJECUCION', 'Reinicio del proceso por llaves termoplásticas', '2026-08-13', 'En revision de la formalizacion del contrato de adquisición de llaves termoplásticas con opinión legal ', 1, '2026-07-17 23:07:00', NULL),
	(39, 68, NULL, 'ELABORACION DE TDR', 'Pendiente de pago', '2026-07-20', 'Bienes ingresados a almacen, pendientes de pago (Fotocopiadora multifuncional, Fotocopiadora de gran volumen Ing., 1 escaner de gran volumen) - mes de julio', 1, '2026-07-17 23:09:12', NULL),
	(40, 73, NULL, 'CULMINADO', '', NULL, '', 1, '2026-07-17 23:13:06', NULL),
	(41, 74, NULL, 'CULMINADO', '', NULL, '', 1, '2026-07-17 23:17:17', NULL),
	(42, 76, NULL, 'CULMINADO', '', NULL, '', 1, '2026-07-17 23:21:36', NULL),
	(43, 77, NULL, 'CULMINADO', '', NULL, '', 1, '2026-07-17 23:25:31', NULL),
	(44, 78, NULL, 'CULMINADO', '', NULL, '', 1, '2026-07-17 23:31:25', NULL),
	(45, 79, NULL, 'CULMINADO', '', NULL, '', 1, '2026-07-17 23:35:53', NULL),
	(46, 80, NULL, 'CORRESPONDE PROGRAMACION AÑO 4', '', NULL, '', 1, '2026-07-17 23:38:14', NULL),
	(47, 81, NULL, 'CORRESPONDE PROGRAMACION AÑO 4', '', NULL, '', 1, '2026-07-17 23:39:27', NULL),
	(48, 82, NULL, 'CORRESPONDE PROGRAMACION AÑO 4', '', NULL, '', 1, '2026-07-17 23:40:41', NULL),
	(49, 72, NULL, 'ACTOS PREPARATORIOS - ELAB. DE REQUERIMIENTO', 'Entrega de bienes (para el kit de dureza)', '2026-08-23', 'En tramite de solicitud de asignación presupuestal.', 1, '2026-07-17 00:07:31', '2026-08-05 00:12:22'),
	(50, 72, NULL, 'ACTOS PREPARATORIOS', 'Instrumentos de laboratorio - adjudicación proceso', '2026-07-21', 'En tramite de solicitud de asignación presupuestal.', 0, '2026-07-17 00:09:15', NULL),
	(51, 72, NULL, 'ACTOS PREPARATORIOS', 'Instrumentos de laboratorio - adjudicación proceso', '2026-07-21', 'En tramite de solicitud de asignación presupuestal.', 0, '2026-07-17 00:09:15', NULL),
	(52, 72, NULL, 'ACTOS PREPARATORIOS - ELAB. DE REQUERIMIENTO', 'Instrumentos de laboratorio - adjudicación proceso', '2026-07-21', 'En tramite de solicitud de asignación presupuestal.', 1, '2026-07-17 00:09:15', '2026-08-05 00:12:48'),
	(53, 72, NULL, 'ACTOS PREPARATORIOS - ELAB. DE REQUERIMIENTO', 'Entrega de bienes', '2026-09-21', 'En tramite de solicitud de asignación presupuestal.', 1, '2026-07-17 00:14:02', NULL),
	(54, 72, NULL, 'ACTOS PREPARATORIOS - ELAB. DE REQUERIMIENTO', 'Adquisición de válvulas - convocatoria proceso de selección', '2026-08-10', 'En tramite de solicitud de asignación presupuestal.', 1, '2026-08-05 00:15:12', NULL);

-- Volcando estructura para tabla bd_seprin.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `idRol` int DEFAULT NULL,
  `usuario` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrasena` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dni` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaAcceso` datetime DEFAULT NULL,
  PRIMARY KEY (`idUser`) USING BTREE,
  UNIQUE KEY `usuario` (`usuario`),
  KEY `idRolUser` (`idRol`) USING BTREE,
  CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.usuarios: ~6 rows (aproximadamente)
INSERT INTO `usuarios` (`idUser`, `idRol`, `usuario`, `contrasena`, `nombres`, `apellidos`, `dni`, `correo`, `estado`, `fechaCreado`, `fechaAcceso`) VALUES
	(4, 1, 'admin', '$2y$10$t5ju7zILJVZw/obgqSwRmeDlDUVW60ibK4vg4..RdF/O3WN1cgd1m', 'Administrador TI', 'Del Sistema', '111', 'admin@ejemplo.com', '1', '2026-06-26 23:13:08', NULL),
	(5, 14, 'cesar', '$2y$10$evgiEpgf7rEya6vaK4RvSed3lzpejyi2pkdeAi0akLvSu9Iy6ufd6', 'Cesar', 'Acero', '444', 'cesar@ejemplo.com', '1', '2026-06-27 00:23:21', NULL),
	(6, 13, 'calidad', '$2y$10$IrJqOB/6eyH8ryIDqqz8kOg4fI4QtF.qZ5lb9JroXoPPn/NHyr1mi', 'Calidad', 'Num 01', '222', 'calidad@ejemplo.com', '1', '2026-06-27 00:34:01', NULL),
	(11, 13, 'mrse', '$2y$10$.35630mKjt3EboKvR6nms.qustt5uEaEv9iGQctajyO08aHcmQgye', 'MRSE', 'Num 05', '333', 'mrse@ejemplo.com', '1', '2026-06-27 13:31:01', NULL),
	(18, 14, 'alfredro.paredes', '$2y$10$.p1wTbW2FIK9Fl6d5AwK7eJ8/o4LELjbWDSRDtwJkUmcvMpOdcK8K', 'Alfredo', 'Paredes', '55555555', 'alfredo@ejemplo.com', '1', '2026-07-28 00:55:56', NULL),
	(19, 2, 'soporte', '$2y$10$jOGvn7EUw7kt6LBcDqBcweF4PoNPKzi2xMt000Yn1.MEcpsf00EGa', 'Soporte', 'Técnico', '999', 'soporte@ejemplo.com', '1', '2026-08-04 21:46:35', NULL);

-- Volcando estructura para tabla bd_seprin.usuarios_areas
CREATE TABLE IF NOT EXISTS `usuarios_areas` (
  `idUsuariosAreas` int NOT NULL AUTO_INCREMENT,
  `idUser` int DEFAULT NULL,
  `idAreas` int DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  PRIMARY KEY (`idUsuariosAreas`),
  KEY `idUser` (`idUser`),
  KEY `idAreas` (`idAreas`),
  CONSTRAINT `FK_usuarios_areas_areas` FOREIGN KEY (`idAreas`) REFERENCES `areas` (`idAreas`),
  CONSTRAINT `FK_usuarios_areas_usuarios` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.usuarios_areas: ~2 rows (aproximadamente)
INSERT INTO `usuarios_areas` (`idUsuariosAreas`, `idUser`, `idAreas`, `fechaCreado`) VALUES
	(84, 11, 10, '2026-07-18 20:44:04'),
	(98, 6, 8, '2026-07-19 21:24:58'),
	(116, 5, 10, '2026-07-28 14:17:08');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
