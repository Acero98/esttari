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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.anio_regulatorio: ~11 rows (aproximadamente)
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
	(22, 1, 10, '2027', 195000.00, NULL, 0.00, 0.00, '0', 'Revisar registroo.', '2026-07-12 14:56:24', '2026-07-12 16:22:16'),
	(23, 1, 10, '2028', 55000.00, NULL, 0.00, 0.00, '0', 'Revisar datos.', '2026-07-12 15:16:47', '2026-07-12 16:22:30'),
	(24, 1, 13, '2025', 50000.00, NULL, 0.00, 0.00, '100', '', '2026-07-12 18:00:28', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bd_seprin.documentos_inversion: ~30 rows (aproximadamente)
INSERT INTO `documentos_inversion` (`idDocumento`, `idInversiones`, `tipoDocumento`, `nombreOriginal`, `nombreGuardado`, `ruta`, `tipoMime`, `tamanio`, `observacion`, `estado`, `fechaRegistro`) VALUES
	(1, 8, 'Expediente Técnico', 'pdf-1.pdf', '6a5712680ed1f.pdf', 'uploads/documentos/8/6a5712680ed1f.pdf', 'application/pdf', 271938, 'todo ok', 1, '2026-07-14 23:54:00'),
	(2, 8, 'Informe', 'Anexos+telefonicos+setiembre+2023+.pdf', '6a5712a89a491.pdf', 'uploads/documentos/8/6a5712a89a491.pdf', 'application/pdf', 616425, 'revisar', 1, '2026-07-14 23:55:04'),
	(3, 8, 'Acta', 'Acta-1.pdf', '6a5712e178d34.pdf', 'uploads/documentos/8/6a5712e178d34.pdf', 'application/pdf', 15231, 'acta xd', 1, '2026-07-14 23:56:01'),
	(4, 8, 'Bases', 'BEM6 - Material complementario.pdf', '6a571300a508a.pdf', 'uploads/documentos/8/6a571300a508a.pdf', 'application/pdf', 83408, 'bases', 1, '2026-07-14 23:56:32'),
	(5, 8, 'Contrato', 'Consulta de Multas Electorales.pdf', '6a57131487806.pdf', 'uploads/documentos/8/6a57131487806.pdf', 'application/pdf', 68492, 'xd', 0, '2026-07-14 23:56:52'),
	(6, 8, 'Contrato', 'temario_84433_07062026104026.pdf', '6a57133018f51.pdf', 'uploads/documentos/8/6a57133018f51.pdf', 'application/pdf', 185913, 'zs', 1, '2026-07-14 23:57:20'),
	(7, 8, 'Acta', 'Acta-1.pdf', '6a57134345f6e.pdf', 'uploads/documentos/8/6a57134345f6e.pdf', 'application/pdf', 15231, '', 1, '2026-07-14 23:57:39'),
	(8, 8, 'Bases', 'horario-por-periodo (1).pdf', '6a583f611c892.pdf', 'uploads/documentos/8/6a583f611c892.pdf', 'application/pdf', 28683, 'hora', 0, '2026-07-15 21:18:09'),
	(9, 8, 'Bases', 'horario-por-periodo (1).pdf', '6a583f611c892.pdf', 'uploads/documentos/8/6a583f611c892.pdf', 'application/pdf', 28683, 'hora', 0, '2026-07-15 21:18:09'),
	(10, 7, 'Expediente Técnico', 'horario-por-periodo (1).pdf', '6a583f9738efe.pdf', 'uploads/documentos/7/6a583f9738efe.pdf', 'application/pdf', 28683, 'expe', 0, '2026-07-15 21:19:03'),
	(11, 7, 'Expediente Técnico', 'horario-por-periodo (1).pdf', '6a583f9738efe.pdf', 'uploads/documentos/7/6a583f9738efe.pdf', 'application/pdf', 28683, 'expe', 1, '2026-07-15 21:19:03'),
	(12, 7, 'Contrato', 'Acta-1.pdf', '6a583fba0dbd2.pdf', 'uploads/documentos/7/6a583fba0dbd2.pdf', 'application/pdf', 15231, '1', 0, '2026-07-15 21:19:38'),
	(13, 7, 'Contrato', 'Acta-1.pdf', '6a583fba0dbd2.pdf', 'uploads/documentos/7/6a583fba0dbd2.pdf', 'application/pdf', 15231, '1', 1, '2026-07-15 21:19:38'),
	(14, 7, 'Informe', 'frac 2.pdf', '6a583fed848a3.pdf', 'uploads/documentos/7/6a583fed848a3.pdf', 'application/pdf', 797802, 'xd', 0, '2026-07-15 21:20:29'),
	(15, 7, 'Informe', 'frac 2.pdf', '6a583fed848a3.pdf', 'uploads/documentos/7/6a583fed848a3.pdf', 'application/pdf', 797802, 'xd', 1, '2026-07-15 21:20:29'),
	(16, 7, 'Acta', 'document.pdf', '6a58418fabf8a.pdf', 'uploads/documentos/7/6a58418fabf8a.pdf', 'application/pdf', 33968, 'doc', 0, '2026-07-15 21:27:27'),
	(17, 7, 'Acta', 'document.pdf', '6a58418fabf8a.pdf', 'uploads/documentos/7/6a58418fabf8a.pdf', 'application/pdf', 33968, 'doc', 1, '2026-07-15 21:27:27'),
	(18, 7, 'Otro', 'FUT DREMO.pdf', '6a5841e797b07.pdf', 'uploads/documentos/7/6a5841e797b07.pdf', 'application/pdf', 361550, 'fut', 0, '2026-07-15 21:28:55'),
	(19, 7, 'Otro', 'FUT DREMO.pdf', '6a5841e797b07.pdf', 'uploads/documentos/7/6a5841e797b07.pdf', 'application/pdf', 361550, 'fut', 1, '2026-07-15 21:28:55'),
	(20, 8, 'Contrato', 'SinTitulo1.pdf', '6a5842e17dbb7.pdf', 'uploads/documentos/8/6a5842e17dbb7.pdf', 'application/pdf', 79087, 'sin', 0, '2026-07-15 21:33:05'),
	(21, 8, 'Contrato', 'SinTitulo1.pdf', '6a5842e17dbb7.pdf', 'uploads/documentos/8/6a5842e17dbb7.pdf', 'application/pdf', 79087, 'sin', 0, '2026-07-15 21:33:05'),
	(22, 8, 'Contrato', 'horario-por-periodo.pdf', '6a58432d0738d.pdf', 'uploads/documentos/8/6a58432d0738d.pdf', 'application/pdf', 28683, '', 0, '2026-07-15 21:34:21'),
	(23, 8, 'Contrato', 'horario-por-periodo.pdf', '6a58432d0738d.pdf', 'uploads/documentos/8/6a58432d0738d.pdf', 'application/pdf', 28683, '', 0, '2026-07-15 21:34:21'),
	(24, 8, 'Bases', 'horario-por-periodo.pdf', '6a5843a22f100.pdf', 'uploads/documentos/8/6a5843a22f100.pdf', 'application/pdf', 28683, '', 0, '2026-07-15 21:36:18'),
	(25, 8, 'Bases', 'horario-por-periodo.pdf', '6a5843a22f100.pdf', 'uploads/documentos/8/6a5843a22f100.pdf', 'application/pdf', 28683, '', 0, '2026-07-15 21:36:18'),
	(26, 8, 'Otro', 'horario-por-periodo.pdf', '6a5845ef9f5fc.pdf', 'uploads/documentos/8/6a5845ef9f5fc.pdf', 'application/pdf', 28683, 'hora', 0, '2026-07-15 21:46:07'),
	(27, 6, 'Informe', 'horario-por-periodo.pdf', '6a58465830681.pdf', 'uploads/documentos/6/6a58465830681.pdf', 'application/pdf', 28683, 'hora', 1, '2026-07-15 21:47:52'),
	(28, 6, 'Bases', 'horario-por-periodo.pdf', '6a5846f8f3f39.pdf', 'uploads/documentos/6/6a5846f8f3f39.pdf', 'application/pdf', 28683, 'x', 1, '2026-07-15 21:50:33'),
	(29, 6, 'Contrato', 'horario-por-periodo.pdf', '6a5847cae4b4e.pdf', 'uploads/documentos/6/6a5847cae4b4e.pdf', 'application/pdf', 28683, 'd', 1, '2026-07-15 21:54:02'),
	(30, 10, 'Expediente Técnico', 'Acta-1 (2).pdf', '6a584b63c814e.pdf', 'uploads/documentos/10/6a584b63c814e.pdf', 'application/pdf', 15231, 'acta', 1, '2026-07-15 22:09:23'),
	(31, 13, 'Informe', 'GESTION DE REGISTROS.pdf', '6a5d6b39e3ed6.pdf', 'uploads/documentos/13/6a5d6b39e3ed6.pdf', 'application/pdf', 19322, 'xd', 1, '2026-07-19 19:26:33');

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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.ejecucion_mensual: ~9 rows (aproximadamente)
INSERT INTO `ejecucion_mensual` (`idEjecucionMensual`, `idAnioRegulatorio`, `mesOld`, `mes`, `programado`, `ejecutado`, `igv`, `total`, `archivo`, `fisico`, `estado`, `fechaCreado`, `fechaActualizado`) VALUES
	(45, 13, 1, '2025-01-31', 0.00, 46784.00, 0.00, 46784.00, NULL, NULL, 1, NULL, '2026-07-23 23:40:07'),
	(57, 14, 1, '2025-12-31', 0.00, 14657.00, 0.00, 14657.00, NULL, NULL, 1, NULL, '2026-07-23 23:47:57'),
	(74, 18, 1, '2025-12-31', 0.00, 151400.16, 0.00, 151400.16, 'uploads/ejecuciones/18/6a62be1ddd8f9.pdf', NULL, 1, NULL, '2026-07-23 20:21:33'),
	(87, 19, 1, '2026-07-17', 0.00, 66394.00, 0.00, 66394.00, NULL, NULL, 1, NULL, '2026-07-19 04:50:18'),
	(96, 24, 1, '2026-07-21', 0.00, 3001.00, 0.00, 3001.00, NULL, NULL, 1, '2026-07-12 18:01:13', '2026-07-21 20:50:07'),
	(97, 24, 2, '2026-07-21', 0.00, 3001.00, 0.00, 3001.00, NULL, NULL, 1, '2026-07-12 18:01:29', '2026-07-21 20:49:56'),
	(98, 24, 3, '2026-07-21', 0.00, 3001.00, 0.00, 3001.00, NULL, NULL, 1, '2026-07-12 18:01:45', '2026-07-21 20:49:46'),
	(104, 15, NULL, '2026-07-17', 0.00, 18400.00, 0.00, 18400.00, 'uploads/ejecuciones/15/6a587c15ac8ae.pdf', NULL, 1, '2026-07-16 01:37:09', '2026-07-23 23:57:28'),
	(109, 16, NULL, '2026-07-17', 0.00, 118340.00, 0.00, 118340.00, NULL, NULL, 1, '2026-07-19 19:15:51', '2026-07-23 23:44:36');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.estudio_tarifario: ~1 rows (aproximadamente)
INSERT INTO `estudio_tarifario` (`idEstudioTarifario`, `codigo`, `nombre`, `anioInicio`, `anioFin`, `estado`, `fechaCreado`, `fechaActualizado`) VALUES
	(1, 'ET-01', 'Estudio Tarifario 01', 2025, 2028, 'ACTIVO', '2026-07-09 20:48:44', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.fondos: ~4 rows (aproximadamente)
INSERT INTO `fondos` (`idFondos`, `codigoFondo`, `nombreFondo`, `descripcionFondo`, `estadoFondo`, `fechaCreado`, `fechaActualiuzado`) VALUES
	(1, 'FI', 'FONDO DE INVERSION', 'INVERSION', 1, '2026-07-04 13:10:20', NULL),
	(2, 'PCC&PAS', 'FONDO DE PCC&PAS', 'RESERVA', 1, '2026-07-04 13:10:41', NULL),
	(3, 'GRD&ACC', 'GESTION DE RIESGO GRD&ACC', 'RIESGO', 1, '2026-07-04 13:12:08', '2026-07-12 11:26:34'),
	(4, 'MRSE', 'MRSE', 'MRSE', 1, '2026-07-07 22:10:18', NULL);

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

-- Volcando datos para la tabla bd_seprin.gerencias: ~5 rows (aproximadamente)
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
INSERT INTO `inversiones` (`idInversiones`, `idEstudioTarifario`, `idFondos`, `idAreas`, `cui`, `descripcion`, `nombre`, `observaciones`, `estado`, `fechaCreado`, `fechaActualizado`) VALUES
	(6, 1, 2, 8, NULL, 'ADQUISICIÓN ESPECTROFOTÓMETRO PARA MONITOREO PCC', 'ADQUISICIÓN DE UN SPECTOFOTOMETRO PARA EL MONITOREO DE NUEVOS PARÁMETROS DEL PCC', NULL, 1, '2026-07-09 23:12:50', NULL),
	(7, 1, 2, 8, NULL, 'ADQUISICIÓN DE EQUIPOS DE CONTROL DE CALIDAD PCC', 'ADQUISICIÓN DE EQUIPOS DE CONTROL DE CALIDAD PARA EL MONITOREO DE NUEVOS PARAMETROS DEL PCC EPS ILO S.A.', NULL, 1, '2026-07-09 23:13:01', NULL),
	(8, 1, 2, 8, NULL, 'ACTUALIZACIÓN DEL PCC Y PAS', 'ACTUALIZACION DEL PCC Y PAS DE LA EPS ILO S.A.', '', 1, '2026-07-09 23:13:43', NULL),
	(9, 1, 4, 10, NULL, 'MRSE: CONSERVACIÓN Y RECUPERACIÓN SERVICIOS ECOSISTÉMICOS HÍDRICOS CUENCA ILO-MOQUEGUA', 'PLAN DE INTERVENCIÓN EN MECANISMO DE RETRIBUCION DE SERVICIOS ECOSISTEMATICOS HIDRICOS DE LA EPS ILO S.A. CONSERVACION Y RECUPERACION DE LOS SERVICIOS ECOSISTEMATICOS HIDRICOS DE REGULACION HIDRICA Y CALIDAD DE AGUA DE LA CUENCA ILO - MOQUEGUA.', '', 1, '2026-07-11 11:44:09', NULL),
	(10, 1, 3, 1, NULL, 'SISTEMA DE ALERTA TEMPRANA ANTE CRECIDAS DEL RÍO (PASTO GRANDE E ITE)', 'IMPLEMENTACION DE SISTEMA DE ALERTA TEMPRANA ANTE CRECIDAS DEL RIO PARA EL SISTEMA PASTO GRANDE E ITE.', '', 1, '2026-07-12 12:26:09', NULL),
	(13, 1, 3, 1, NULL, 'REFORZAMIENTO DE TALUD CAPTACIÓN ITE NORTE', 'REFORZAMIENTO DE TALUD EN LA CAPTACION ITE NORTE DE LA EPS ILO.', '', 1, '2026-07-12 17:57:38', NULL),
	(14, 1, 3, 4, NULL, 'SISTEMA DE COMUNICACIÓN SATELITAL CAPTACIÓN PASTO GRANDE Y PTAP CATA CATAS', 'IMPLEMENTACION DE SISTEMA DE COMUNICACIÓN SATELITAL DE LA CAPTACION PASTO GRANDE Y LA PLANTA 1 (CATA CATAS).', '', 1, '2026-07-21 22:36:25', NULL),
	(15, 1, 3, 4, NULL, 'REMOCIÓN DE MATERIAL ARRASTRADO POR EL RÍO HACIA BOCATOMA', 'REMOCION DE MATERIAL ARRASTRADO POR EL RIO HACIA LA BOCATOMA DE LA CAPTACION.', '', 1, '2026-07-21 22:38:04', NULL),
	(16, 1, 3, 4, NULL, 'ACTUALIZACIÓN E IMPLEMENTACIÓN DEL PLAN DE CONTINGENCIA', 'ACTUALIZACION E IMPLEMENTACION DEL PLAN DE CONTIGENCIA Y ELABORACION DE ACC.', '', 1, '2026-07-21 22:38:44', NULL),
	(17, 1, 1, 1, '2634345', 'REMODELACIÓN CÁMARA PURGA VA-5 Y AMPLIACIÓN RED DISTRIBUCIÓN (CALIENTA NEGROS–PUERTO INGLÉS)', '"REMODELACION DE CÁMARA DE VÁLVULAS; CONSTRUCCION DE RED DE DISTRIBUCION; EN EL(LA) TRAMO: CALIENTA NEGROS - PLAYA PUERTO INGLES DE LA EPS ILO S.A DISTRITO DE ILO, PROVINCIA ILO, DEPARTAMENTO MOQUEGUA".', '', 1, '2026-07-22 22:24:17', NULL),
	(18, 1, 1, 1, '2648905', 'MEJORAMIENTO Y AMPLIACIÓN COLECTOR PRIMARIO AV. INGRESO CIUDAD DE ILO (MAGISTERIO–BY PASS ALTO ILO)', 'MEJORAMIENTO Y AMPLIACION DEL SERVICIO DE ALCANTARILLADO EN COLECTOR PRIMARIO EN LA AV. DE INGRESO A CIUDAD DE ILO , DESDE LA DESCARGA DE LA URB. MAGISTERIO DE LA PAMPA INALAMBRICA HASTA EL BY PASS ALTO ILO DISTRITO DE ILO DE LA PROVINCIA DE ILO DEL DEPARTAMENTO DE MOQUEGUA.', '', 1, '2026-07-22 22:27:25', NULL),
	(19, 1, 1, 1, '2627539', 'MEJORAMIENTO PTAP N.°1 – RECUPERACIÓN AGUA DE LAVADO Y TRATAMIENTO DE LODOS', 'MEJORAMIENTO DEL SERVICIO DE AGUA POTABLE URBANO EN DE LA PTAP MEDIANTE UN SISTEMA DE RECUPERACION DE AGUA DE LAVADO DE UNIDADES Y TRATAMIENTO DE LODOS DISTRITO DE ILO DE LA PROVINCIA DE ILO DEL DEPARTAMENTO DE MOQUEGUA.', '', 1, '2026-07-22 22:29:05', NULL),
	(20, 1, 1, 1, NULL, 'CONSTRUCCIÓN CERCO PERIMÉTRICO PLANTA CATA CATAS', 'CONSTRUCCIÓN DE CERCO PERIMETRICO DE PLANTA CATA CATAS.', '', 1, '2026-07-22 22:30:07', NULL),
	(21, 1, 1, 1, '2662798', 'REHABILITACIÓN CÁMARAS PURGA DE AIRE Y LODO LÍNEAS CONDUCCIÓN ITE NORTE Y PASTO GRANDE', 'REMODELACION DE CÁMARA DE VÁLVULAS; EN EL(LA) LINEA DE CONDUCCION DE AGUA CRUDA ITE NORTE Y PASTO GRANDE DISTRITO DE EL ALGARROBAL, PROVINCIA ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 22:35:20', NULL),
	(22, 1, 1, 1, NULL, 'ELABORACIÓN DE EXPEDIENTES TÉCNICOS (AR03-AR04)', 'ELABORACIÓN DE EXPEDIENTES TECNICOS.', '', 1, '2026-07-22 22:36:33', NULL),
	(23, 1, 1, 2, NULL, 'ADQUISICIÓN DE 1,000 MEDIDORES PARA CONEXIONES NUEVAS', 'ADQUISICION DE 1000 MEDIDORES PARA CONEXIONES NUEVAS EN LA EPS ILO S.A., PARA LA OPTIMIZACIÓN DEL SISTEMA DE DISTRIBUCIÓN DE AGUA POTABLE, DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 22:37:32', NULL),
	(24, 1, 1, 2, '2702090', 'RENOVACIÓN DE MICROMEDIDORES (23,235 CONEXIONES)', 'RENOVACION DE MICROMEDIDORES EN EL (LA) EPS ILO S.A., DE 23235 CONEXIONES EN EL DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 22:40:44', NULL),
	(25, 1, 1, 2, NULL, 'ADQUISICIÓN DE 197 MEDIDORES DE ALTOS CONSUMIDORES', 'ADQUISICION DE 197 MEDIDORES DE ALTOS CONSUMIDORES DE LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 22:42:58', NULL),
	(26, 1, 1, 2, NULL, 'ADQUISICIÓN DE 19 DATALOGGERS PARA GRANDES CONSUMIDORES', 'ADQUISICION DE 19 DATALOGGER PARA GRANDES CONSUMIDORES EN LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 22:46:10', NULL),
	(27, 1, 1, 6, NULL, 'CONSTRUCCIÓN OFICINA ATENCIÓN AL CLIENTE PAMPA INALÁMBRICA', 'CONSTRUCCION DE OFICINA PARA ATENCION AL CLIENTE EN EL SECTOR DE LA PAMPA INALAMBRICA, DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 22:47:31', NULL),
	(28, 1, 1, 12, NULL, 'ADQUISICIÓN DE COMPUERTAS TIPO GUILLOTINA PARA PTAP PAMPA INALÁMBRICA', 'ADQUISICION DE COMPUERTAS  TIPO GUILLOTINA PARA LA PTAP PAMPA INALAMBRICA.', '', 1, '2026-07-22 22:51:58', NULL),
	(29, 1, 1, 3, NULL, 'RENOVACIÓN SISTEMA DE PROCESAMIENTO DE INFORMACIÓN (EQUIPOS INFORMÁTICOS)', 'RENOVACION DEL SISTEMA DE PROCESAMIENTO DE INFORMACION (COMPUTADORAS, IMPRESORAS Y PERIFERICOS, EN EL (LA) GERENCIA GENERAL , GERENCIA DE ADMINISTRACION FINANCIERA , GERENCIA COMERCIAL Y GERENCIA DE OPERACIONES DE LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 22:54:03', NULL),
	(30, 1, 1, 1, '2602293', 'ADQUISICIÓN DE VEHÍCULO, SERVIDORES Y EQUIPOS COMPLEMENTARIOS', 'ADQUISICION DE VEHICULO, SISTEMAS DE PROCESAMIENTO Y ALMACENAMIENTO (SERVIDORES, STORAGE, LIBRERIAS DE RESPALDO, CLOUDBRIDGE), COMPUTADORA (LABORATORIO) Y EQUIPO DE OTROS ACTIVOS COMPLEMENTARIOS; EN EL(LA) GERENCIA GENERAL, GERENCIA DE ADMINISTRACION FINANCIERA, GERENCIA COMERCIAL Y GERENCIA DE OPERACIONES DE LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 22:56:57', NULL),
	(31, 1, 1, 12, NULL, 'REEMPLAZO LÍNEA DE DESCARGA LAGUNA FACULTATIVA TERCIARIA 3A', 'REEMPLAZO DE LINEA DE DESCARGA DE LAGUNA FACULTATIVA TERCIARIA 3A.', '', 1, '2026-07-22 22:58:28', NULL),
	(32, 1, 1, 12, NULL, 'ADQUISICIÓN DE ARENA CUARZOSA PARA PTAP CATA CATAS', 'ADQUISICION DE ARENA CUARZOSA PARA LA PTAP CATA CATAS.', '', 1, '2026-07-22 22:59:49', NULL),
	(33, 1, 1, 3, NULL, 'IMPLEMENTACIÓN SISTEMA DE CONTROL DE ASISTENCIA WEB', 'IMPLEMENTACION DE UN SISTEMA DE CONTROL DE ASISTENCIA WEB, EN TODAS LAS SEDES DE LA GERENCIA GENERAL ,  GERENCIA DE ADMINISTRACION FINANCIERA , GERENCIA COMERCIAL Y GERENCIA DE OPERACIONES DE LA EPS ILO S.A. DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 23:02:04', NULL),
	(34, 1, 1, 2, NULL, 'ACTUALIZACIÓN DE DATOS DE USUARIOS', 'ACTUALIZACION DE DATOS DE USUARIOS DE (LA) EPS ILO S.A., PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 23:03:23', NULL),
	(35, 1, 1, 7, NULL, 'REDUCCIÓN CARTERA MOROSA Y CONEXIONES INACTIVAS', 'REDUCCION DE LA CARTERA MOROSA Y CONEXIONES INACTIVAS PARA SINCERAR LAS CUENTAS DE LA EPS ILO S.A.', '', 1, '2026-07-22 23:04:41', NULL),
	(36, 1, 1, 13, NULL, 'MEJORAMIENTO Y REMODELACIÓN OFICINAS GERENCIA COMERCIAL', 'MEJORAMIENTO, REMODELACION Y MANTENIMIENTO DE LA INFRAESTRUCTURA EXISTENTE DE LAS OFICINAS DE ATENCION AL CLIENTE DE LA GERENCIA COMERCIAL DE LA EPS ILO S.A., DISTRITO DE ILO, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 23:19:36', NULL),
	(37, 1, 1, 1, NULL, 'REMODELACIÓN CÁMARAS PURGA DE AIRE Y AGUA LÍNEA CONDUCCIÓN R-1 A COSTA AZUL', 'REMODELACIÓN DE LAS CAMARAS DE PURGA DE AIRE Y PURGA DE AGUA DE LA LINEA DE CONDUCCION EN EL (LA) TRAMO DEL R-1 A COSTA AZUL.', '', 1, '2026-07-22 23:21:04', NULL),
	(38, 1, 1, 1, NULL, 'REMODELACIÓN GALERÍA FILTRANTE CAPTACIÓN PASTO GRANDE', 'REMODELACION DE GALERIA FILTRANTE, EN EL (LA) EN LA CAPTACION DE PASTO GRANDE DE EPS ILO S.A. DISTRITO DE EL ALGARROBAL, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 23:22:03', NULL),
	(39, 1, 1, 1, NULL, 'RENOVACIÓN LÍNEA DE ADUCCIÓN COSTA AZUL – CIUDAD NUEVA', 'RENOVACIÓN DE LINEA DE ADUCCION DESDE COSTA AZUL - CIUDAD NUEVA, PROVINCIA DE ILO, DEPARTAMENTO MOQUEGUA.', '', 1, '2026-07-22 23:22:59', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.permisos: ~12 rows (aproximadamente)
INSERT INTO `permisos` (`idPermiso`, `permiso`, `grupo`, `ruta`, `icono`, `orden`, `estado`, `fechaCreado`) VALUES
	(1, 'Dashboard', 'Dashboard', 'dashboard', 'bi-speedometer2', '1', 1, '2026-06-27 21:51:11'),
	(2, 'Usuarios', 'Seguridad', 'usuarios', 'bi-people', '2', 1, '2026-06-27 21:51:12'),
	(3, 'Roles', 'Seguridad', 'roles', 'bi-person-badge', '3', 1, '2026-06-27 21:51:13'),
	(4, 'Permisos', 'Seguridad', 'permisos', 'bi-shield-lock', '4', 1, '2026-06-27 21:51:14'),
	(5, 'Inversion', 'General', 'inversiones', 'bi bi-bank', '5', 1, '2026-06-27 23:04:00'),
	(7, 'Reporte General', 'General', 'reportes', 'bi-people', '7', 1, '2026-06-28 14:30:23'),
	(9, 'Estudio Tarifario', 'Administración', 'estudioTarifario', 'bi-calendar-range', '1', 1, '2026-07-11 16:05:34'),
	(10, 'Fondos', 'Administración', 'fondos', 'bi bi-wallet2', '2', 1, '2026-07-11 17:04:47'),
	(11, 'Gerencias', 'Administración', 'gerencias', 'bi bi-diagram-3', '3', 1, '2026-07-11 23:36:18'),
	(12, 'Areas', 'Administración', 'areas', 'bi bi-grid', '4', 1, '2026-07-12 00:17:18'),
	(13, 'Año Regulatorio', 'General', 'anioregulatorio', 'bi-calendar3', '4', 1, '2026-07-12 13:50:00'),
	(14, 'Dashboard Inversion', 'Dashboard', 'dashboardInversion', 'bi-graph-up', '4', 1, '2026-07-18 20:13:21');

-- Volcando estructura para tabla bd_seprin.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `idRol` int NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcionRol` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.roles: ~8 rows (aproximadamente)
INSERT INTO `roles` (`idRol`, `nombreRol`, `descripcionRol`, `estado`, `fechaCreado`) VALUES
	(1, 'Super Admin', 'Administracion total.', '1', '2026-06-28 00:38:21'),
	(2, 'Admin', 'Administracion Parcial', '1', '2026-06-28 00:38:22'),
	(3, 'GerenteGeneral', 'Gerente General', '1', '2026-06-28 00:38:23'),
	(9, 'Asistente', 'Personal de apoyo', '1', '2026-06-29 19:47:51'),
	(10, 'Soporte', 'Soporte al sistema', '1', '2026-06-29 23:13:35'),
	(11, 'Operador', 'Usuario Operador', '1', '2026-07-18 19:57:24'),
	(12, 'GerenteLinea', 'Gerente de Línea', '1', '2026-07-18 19:57:56'),
	(13, 'JefeOficina', 'Jefe de Oficina', '1', '2026-07-18 19:58:19');

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
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.rol_permiso: ~21 rows (aproximadamente)
INSERT INTO `rol_permiso` (`idRolPermiso`, `idRol`, `idPermiso`) VALUES
	(17, 9, 5),
	(19, 3, 1),
	(20, 3, 5),
	(21, 10, 2),
	(22, 10, 3),
	(23, 10, 4),
	(80, 13, 14),
	(81, 13, 13),
	(82, 13, 5),
	(83, 1, 9),
	(84, 1, 10),
	(85, 1, 11),
	(86, 1, 12),
	(87, 1, 1),
	(88, 1, 14),
	(89, 1, 13),
	(90, 1, 5),
	(91, 1, 7),
	(92, 1, 2),
	(93, 1, 3),
	(94, 1, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.seguimiento_mensual: ~4 rows (aproximadamente)
INSERT INTO `seguimiento_mensual` (`idSeguimientoMensual`, `idAnioRegulatorio`, `producto`, `estadoInver`, `acciones`, `fechas`, `situacion`, `estado`, `fechaCreado`, `fechaActualizado`) VALUES
	(12, 16, NULL, 'EN EJECUCION ', 'Actualizacion fichas del PCC (determinacion del procedimiento SUNASS)', '2026-07-20', 'Ejecucion fisica culminada, en solicitud de modificacion de fichas.', 1, '2026-07-17 19:17:10', '2026-07-23 23:49:54'),
	(13, 19, NULL, 'ACTUALIZACION DE EXPEDIENTE TECNICO.', 'CONVOCATORIA "COCHA EN ASANA"', '2026-08-03', 'Ejecución y supervisión de la cocha según Exp Tecnico S/ 364,249.96 (incluido IGV) disponi ptop S/ 225,500 (s/igv). Presupuesto ODP de S/ 236,500 saldo', 1, '2026-07-17 21:48:04', NULL),
	(14, 19, NULL, 'ELABORACION DE TDR.', 'Culminación del servicio', '2026-10-05', '', 1, '2026-07-17 21:51:30', NULL),
	(16, 17, NULL, 'ELABORACION DE REQUERIMIENTO', 'Generacion de Orden de Servicio, tipo mensual desde enero', NULL, 'Se encuentra en ejecución del servicio.', 1, '2026-07-24 00:59:55', NULL);

-- Volcando estructura para tabla bd_seprin.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `idRol` int DEFAULT NULL,
  `usuario` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrasena` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaAcceso` datetime DEFAULT NULL,
  PRIMARY KEY (`idUser`) USING BTREE,
  UNIQUE KEY `usuario` (`usuario`),
  KEY `idRolUser` (`idRol`) USING BTREE,
  CONSTRAINT `FK_usuarios_roles` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.usuarios: ~4 rows (aproximadamente)
INSERT INTO `usuarios` (`idUser`, `idRol`, `usuario`, `contrasena`, `nombres`, `apellidos`, `correo`, `estado`, `fechaCreado`, `fechaAcceso`) VALUES
	(4, 1, 'admin', '$2y$10$t5ju7zILJVZw/obgqSwRmeDlDUVW60ibK4vg4..RdF/O3WN1cgd1m', 'Administrador TI', 'Del Sistema', 'admin@empresa.com', '1', '2026-06-26 23:13:08', NULL),
	(5, 2, 'cesar', '$2y$10$evgiEpgf7rEya6vaK4RvSed3lzpejyi2pkdeAi0akLvSu9Iy6ufd6', 'Roman', 'Acero', 'roman@empresa.com', '1', '2026-06-27 00:23:21', NULL),
	(6, 13, 'calidad', '$2y$10$IrJqOB/6eyH8ryIDqqz8kOg4fI4QtF.qZ5lb9JroXoPPn/NHyr1mi', 'Calidad', 'Num 01', 'calidad@empresa.com', '1', '2026-06-27 00:34:01', NULL),
	(11, 13, 'mrse', '$2y$10$.35630mKjt3EboKvR6nms.qustt5uEaEv9iGQctajyO08aHcmQgye', 'MRSE', 'Num 05', 'mrse@empresa.com', '1', '2026-06-27 13:31:01', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.usuarios_areas: ~3 rows (aproximadamente)
INSERT INTO `usuarios_areas` (`idUsuariosAreas`, `idUser`, `idAreas`, `fechaCreado`) VALUES
	(84, 11, 10, '2026-07-18 20:44:04'),
	(96, 5, 10, '2026-07-19 03:56:36'),
	(98, 6, 8, '2026-07-19 21:24:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
