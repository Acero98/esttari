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
  `idInversiones` int DEFAULT NULL,
  `anio` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `programado` decimal(20,6) DEFAULT NULL,
  `ejecutado` decimal(20,6) DEFAULT NULL,
  `rdr` decimal(20,6) DEFAULT NULL,
  `et` decimal(20,6) DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idAnioRegulatorio`) USING BTREE,
  UNIQUE KEY `idInversiones_anio` (`idInversiones`,`anio`),
  KEY `idInversiones` (`idInversiones`),
  CONSTRAINT `FK_anio_regulatorio_inversiones` FOREIGN KEY (`idInversiones`) REFERENCES `inversiones` (`idInversiones`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.anio_regulatorio: ~4 rows (aproximadamente)
INSERT INTO `anio_regulatorio` (`idAnioRegulatorio`, `idInversiones`, `anio`, `programado`, `ejecutado`, `rdr`, `et`, `observaciones`, `fechaCreado`, `fechaActualizado`) VALUES
	(1, 1, '2025', NULL, NULL, NULL, NULL, NULL, '2026-07-04 15:16:49', NULL),
	(2, 1, '2026', NULL, NULL, NULL, NULL, NULL, '2026-07-04 15:17:28', NULL),
	(3, 1, '2027', NULL, NULL, NULL, NULL, NULL, '2026-07-04 15:18:04', NULL),
	(4, 1, '2028', NULL, NULL, NULL, NULL, NULL, '2026-07-04 15:18:05', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.areas: ~4 rows (aproximadamente)
INSERT INTO `areas` (`idAreas`, `idGerencias`, `siglasArea`, `nombreArea`, `estadoArea`, `fechaCreado`, `fechaActualizado`) VALUES
	(1, 3, 'OIPO', 'OFICINA DE INGENIERIA, PROYECTOS Y OBRAS', 1, '2026-07-04 13:14:06', NULL),
	(2, 2, 'OCCMF', 'OFICINA DE CATASTRO COMERCIAL, MEDICION Y FACTURACION', 1, '2026-07-04 13:14:54', NULL),
	(3, 4, 'OTIC', 'OFICINA DE TECNOLOGIA DE LA INFORMACION Y COMUNICACIONES', 1, '2026-07-04 13:15:30', NULL),
	(4, 3, 'GO', 'GERENCIA DE OPERACIONES', 1, '2026-07-04 13:16:08', NULL),
	(5, 4, 'GAF', 'GERENCIA DE ADMINISTRACION Y FINANZAS', 1, '2026-07-07 22:13:35', NULL),
	(6, 2, 'GC', 'GERENCIA COMERCIAL', 1, '2026-07-07 22:14:35', NULL),
	(7, 2, 'OCCC', 'OFICINA DE COBRANZA Y CONTROL COMERCIAL', 1, '2026-07-07 22:15:35', NULL),
	(8, 1, 'EAC', 'EQUIPO DE ASEGURAMIENTO DE CALIDAD', 1, '2026-07-07 22:16:02', NULL);

-- Volcando estructura para tabla bd_seprin.ejecucion_mensual
CREATE TABLE IF NOT EXISTS `ejecucion_mensual` (
  `idEjecucionMensual` int NOT NULL AUTO_INCREMENT,
  `idAnioRegulatorio` int DEFAULT NULL,
  `mes` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `programado` decimal(20,6) DEFAULT NULL,
  `ejecutado` decimal(20,6) DEFAULT NULL,
  `fisico` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idEjecucionMensual`),
  UNIQUE KEY `idAnioRegulatorio_mes` (`idAnioRegulatorio`,`mes`),
  KEY `idInversiones` (`idAnioRegulatorio`) USING BTREE,
  CONSTRAINT `FK_ejecucion_mensual_anio_regulatorio` FOREIGN KEY (`idAnioRegulatorio`) REFERENCES `anio_regulatorio` (`idAnioRegulatorio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.ejecucion_mensual: ~3 rows (aproximadamente)
INSERT INTO `ejecucion_mensual` (`idEjecucionMensual`, `idAnioRegulatorio`, `mes`, `programado`, `ejecutado`, `fisico`, `fechaCreado`, `fechaActualizado`) VALUES
	(1, 1, 'ENERO', NULL, 771.660000, NULL, '2026-07-04 16:20:44', NULL),
	(2, 1, 'FEBRERO', NULL, 4594.570000, NULL, '2026-07-04 16:21:10', NULL),
	(3, 1, 'MARZO', NULL, 17619.840000, NULL, '2026-07-04 16:21:30', NULL);

-- Volcando estructura para tabla bd_seprin.fondos
CREATE TABLE IF NOT EXISTS `fondos` (
  `idFondos` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualiuzado` datetime DEFAULT NULL,
  PRIMARY KEY (`idFondos`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.fondos: ~2 rows (aproximadamente)
INSERT INTO `fondos` (`idFondos`, `codigo`, `nombre`, `descripcion`, `fechaCreado`, `fechaActualiuzado`) VALUES
	(1, 'FI', 'FONDO DE INVERSION', 'INVERSION', '2026-07-04 13:10:20', NULL),
	(2, 'PCC&PAS', 'FONDO DE RESERVA', 'RESERVA', '2026-07-04 13:10:41', NULL),
	(3, 'GRD&ACC', 'GESTION DE RIESGO', 'RIESGO', '2026-07-04 13:12:08', NULL),
	(4, 'MRSE', 'MRSE', 'MRSE', '2026-07-07 22:10:18', NULL);

-- Volcando estructura para tabla bd_seprin.gerencias
CREATE TABLE IF NOT EXISTS `gerencias` (
  `idGerencias` int NOT NULL AUTO_INCREMENT,
  `siglasGerencia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreGerencia` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estadoGerencia` tinyint DEFAULT '1',
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idGerencias`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.gerencias: ~4 rows (aproximadamente)
INSERT INTO `gerencias` (`idGerencias`, `siglasGerencia`, `nombreGerencia`, `estadoGerencia`, `fechaCreado`, `fechaActualizado`) VALUES
	(1, 'GG', 'GERENCIA GENERAL', 1, '2026-07-05 16:05:20', NULL),
	(2, 'GC', 'GERENCIA COMERCIAL', 1, '2026-07-05 16:05:36', NULL),
	(3, 'GO', 'GERENCIA DE OPERACIONES', 1, '2026-07-05 16:05:49', NULL),
	(4, 'GAF', 'GERENCIA DE ADMINISTRACION Y FINANZAS', 1, '2026-07-05 16:06:10', NULL),
	(5, 'GAJ', 'GERENCIA DE ASESORIA JURIDICA', 1, '2026-07-05 16:06:25', NULL);

-- Volcando estructura para tabla bd_seprin.inversiones
CREATE TABLE IF NOT EXISTS `inversiones` (
  `idInversiones` int NOT NULL AUTO_INCREMENT,
  `idFondos` int DEFAULT NULL,
  `idAreas` int DEFAULT NULL,
  `cui` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `observaciones` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idInversiones`),
  UNIQUE KEY `cui` (`cui`),
  KEY `idFondos` (`idFondos`),
  KEY `idAreas` (`idAreas`),
  CONSTRAINT `FK_inversiones_areas` FOREIGN KEY (`idAreas`) REFERENCES `areas` (`idAreas`),
  CONSTRAINT `FK_inversiones_fondos` FOREIGN KEY (`idFondos`) REFERENCES `fondos` (`idFondos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.inversiones: ~1 rows (aproximadamente)
INSERT INTO `inversiones` (`idInversiones`, `idFondos`, `idAreas`, `cui`, `nombre`, `observaciones`, `estado`, `fechaCreado`, `fechaActualizado`) VALUES
	(1, 1, 1, '2634345', '"REMODELACION DE CÁMARA DE VÁLVULAS; CONSTRUCCION DE RED DE DISTRIBUCION; EN EL(LA) TRAMO: CALIENTA NEGROS - PLAYA PUERTO INGLES DE LA EPS ILO S.A DISTRITO DE ILO, PROVINCIA ILO, DEPARTAMENTO MOQUEGUA". 2634345', NULL, NULL, '2026-07-07 22:16:52', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.permisos: ~8 rows (aproximadamente)
INSERT INTO `permisos` (`idPermiso`, `permiso`, `grupo`, `ruta`, `icono`, `orden`, `estado`, `fechaCreado`) VALUES
	(1, 'Dashboard', 'General', 'dashboard', 'bi-speedometer2', '1', 1, '2026-06-27 21:51:11'),
	(2, 'Usuarios', 'Seguridad', 'usuarios', 'bi-people', '2', 1, '2026-06-27 21:51:12'),
	(3, 'Roles', 'Seguridad', 'roles', 'bi-person-badge', '3', 1, '2026-06-27 21:51:13'),
	(4, 'Permisos', 'Seguridad', 'permisos', 'bi-shield-lock', '4', 1, '2026-06-27 21:51:14'),
	(5, 'Inversion', 'Operaciones', 'inversiones', 'bi-speedometer2', '5', 1, '2026-06-27 23:04:00'),
	(6, 'Fondo', 'Operaciones', 'fondos', 'bi-speedometer2', '6', 1, '2026-06-27 23:05:05'),
	(7, 'Reporte General', 'Reportes', 'reportegeneral', 'bi-people', '7', 1, '2026-06-28 14:30:23'),
	(8, 'prueba', 'prueba', 'Prueba', 'prueba', '8', 0, '2026-06-29 21:34:30');

-- Volcando estructura para tabla bd_seprin.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `idRol` int NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcionRol` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.roles: ~6 rows (aproximadamente)
INSERT INTO `roles` (`idRol`, `nombreRol`, `descripcionRol`, `estado`, `fechaCreado`) VALUES
	(1, 'Super Admin', 'Administracion total.', '1', '2026-06-28 00:38:21'),
	(2, 'Admin', 'Administracion Parcial', '1', '2026-06-28 00:38:22'),
	(3, 'Operador', 'Usuario general.', '0', '2026-06-28 00:38:23'),
	(8, 'Jefe', 'Jefe de Oficina', '1', '2026-06-28 01:28:35'),
	(9, 'Asistente', 'Personal de apoyo', '1', '2026-06-29 19:47:51'),
	(10, 'Soporte', 'Soporte al sistema', '1', '2026-06-29 23:13:35');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.rol_permiso: ~16 rows (aproximadamente)
INSERT INTO `rol_permiso` (`idRolPermiso`, `idRol`, `idPermiso`) VALUES
	(5, 8, 2),
	(6, 8, 3),
	(7, 8, 4),
	(8, 1, 1),
	(9, 1, 5),
	(10, 1, 6),
	(11, 1, 2),
	(12, 1, 3),
	(13, 1, 4),
	(17, 9, 5),
	(18, 9, 6),
	(19, 3, 1),
	(20, 3, 5),
	(21, 10, 2),
	(22, 10, 3),
	(23, 10, 4);

-- Volcando estructura para tabla bd_seprin.seguimiento_mensual
CREATE TABLE IF NOT EXISTS `seguimiento_mensual` (
  `idSeguimientoMensual` int NOT NULL AUTO_INCREMENT,
  `idEjecucionMensual` int DEFAULT NULL,
  `producto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estadoInver` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `fechas` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `situacion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`idSeguimientoMensual`),
  KEY `idEjecucionMensual` (`idEjecucionMensual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.seguimiento_mensual: ~0 rows (aproximadamente)

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

-- Volcando datos para la tabla bd_seprin.usuarios: ~13 rows (aproximadamente)
INSERT INTO `usuarios` (`idUser`, `idRol`, `usuario`, `contrasena`, `nombres`, `apellidos`, `correo`, `estado`, `fechaCreado`, `fechaAcceso`) VALUES
	(4, 1, 'admin', '$2y$10$t5ju7zILJVZw/obgqSwRmeDlDUVW60ibK4vg4..RdF/O3WN1cgd1m', 'Administrador', 'Del Sistema', 'admin@empresa.com', '1', '2026-06-26 23:13:08', NULL),
	(5, 2, 'cesar', '$2y$10$evgiEpgf7rEya6vaK4RvSed3lzpejyi2pkdeAi0akLvSu9Iy6ufd6', 'Desarin Romantico', 'Aceros Arequipa', 'roman@empresa.com', '1', '2026-06-27 00:23:21', NULL),
	(6, 2, 'operador', '$2y$10$utWLpvEZ7bM9UqKuas8zCulhVCgnAfHenjJQZLf.wBs7fSGTVUiUm', 'Aperador', 'Num', 'operador1@empresa.com', '1', '2026-06-27 00:34:01', NULL),
	(8, 3, 'operador2', '$2y$10$jAnSEzNKbcZb99X4Sn.nhuoPVbojSjCmgo6jsIhmGHkZf62i8VSNC', 'Operador', 'Num 02', 'operador2@empresa.com', '1', '2026-06-27 10:51:24', NULL),
	(9, 3, 'operador3', '$2y$10$/qoxhyfR6hU6lmshbMS8yeE1hjE/6g2Nr2EXF58ELUbxozdlioKa6', 'Operador', 'Num 03', 'operador3@empresa.com', '1', '2026-06-27 11:25:58', NULL),
	(10, 3, 'operador4', '$2y$10$ZItI.bnOy9.sGQYRsr092ecOF0lCzwgUz3riTLMjPhkxx3w.s35me', 'Operador', 'Num 04', 'operador4@empresa.com', '1', '2026-06-27 11:54:21', NULL),
	(11, 8, 'operador5', '$2y$10$0ncDaB3.bQwKlk12TRxno.6Igaqk8qXt7OVQkFJbMqwRoN6ZZkJ5C', 'Operador', 'Num 05', 'operador5@empresa.com', '1', '2026-06-27 13:31:01', NULL),
	(12, 3, 'operador6', '$2y$10$8q5WBoseETojlBtDzkxnPOS34gGPf2NhWRrtf3XMXFA1z26Oj6ilW', 'Operador', 'Num 06', 'operador@empresa.com', '0', '2026-06-27 13:45:56', NULL),
	(13, 3, 'operador7', '$2y$10$zNdFWeHgW.3Y.5y9B2wex.UrM39out3SMKejro.31mzoTk7jGwb7O', 'Operador', 'Num 07', 'operador@empresa.com', '0', '2026-06-27 13:46:56', NULL),
	(14, 3, 'operador8', '$2y$10$cdV19DbGqtXYc3ZvtXgYSOXiEGw.34BdDjirv7GpFGC4Fo9myzrk6', 'Operador', 'Num 08', 'operador@empresa.com', '0', '2026-06-27 13:47:43', NULL),
	(15, 3, 'operador9', '$2y$10$8667U85KdPQiELcut3U4l.TYQLYWnG2cYiNRoNcPVjyU33bquZYdG', 'Operador', 'Num 09', 'operador@empresa.com', '1', '2026-06-27 13:48:27', NULL),
	(16, 3, 'operador10', '$2y$10$izrm6NZwvq.yFbHx7ZctJedbMaJxKFsuB2VLUajgYOq1qIybxV3sO', 'Operador', 'Num 10', 'operador@empresa.com', '1', '2026-06-27 13:49:31', NULL),
	(17, 8, 'operador11', '$2y$10$NGM60o3Khckol4i5P6KQsekh5Wynqvfu7xnDsGx2QIRsLF0pYKuqS', 'Operador', 'Num 11', 'operador@empresa.com', '1', '2026-06-29 18:45:56', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_seprin.usuarios_areas: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
