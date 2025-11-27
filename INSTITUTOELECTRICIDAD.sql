-- phpMyAdmin SQL Dump (CORREGIDO)
-- Servidor: 127.0.0.1
-- BD: INSTITUTOELECTRICIDAD

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS INSTITUTOELECTRICIDAD;
CREATE DATABASE INSTITUTOELECTRICIDAD;
USE INSTITUTOELECTRICIDAD;

-- --------------------------------------------------------
-- PROVINCIAS
-- --------------------------------------------------------

CREATE TABLE `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_provincias_nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `provincias` (`id`, `nombre`) VALUES
(1,'San José'),(2,'Alajuela'),(3,'Cartago'),(4,'Heredia'),
(5,'Guanacaste'),(6,'Puntarenas'),(7,'Limón');

-- --------------------------------------------------------
-- CLIENTES (personas físicas que consumen electricidad)
-- --------------------------------------------------------

CREATE TABLE `clientes` (
  `nise` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido1` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido2` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `provincia_id` int(11) NOT NULL,
  `tipo_tarifa` enum('HOGAR','INDUSTRIAL') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'HOGAR',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nise`),
  UNIQUE KEY `uk_clientes_cedula` (`cedula`),
  KEY `idx_clientes_provincia` (`provincia_id`),
  CONSTRAINT `fk_clientes_provincia` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------
-- ROLES (perfiles de usuario del sistema)
-- --------------------------------------------------------

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_roles_nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `habilitado`) VALUES
(1, 'ADMINISTRADOR', 'Acceso total: gestiona clientes, usuarios, tarifas, lecturas', 1),
(2, 'EMPLEADO', 'Atención al cliente: ve clientes, facturas, atiende consultas', 1),
(3, 'CLIENTE', 'Usuario final: consulta sus propias facturas y consumo', 1);

-- --------------------------------------------------------
-- PERMISOS (acciones específicas del sistema)
-- --------------------------------------------------------

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_permisos_nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `permisos` (`id`, `nombre`, `descripcion`, `habilitado`) VALUES
(1, 'gestionar_clientes', 'Crear, editar y eliminar clientes', 1),
(2, 'gestionar_usuarios', 'Crear, editar y eliminar usuarios del sistema', 1),
(3, 'gestionar_tarifas', 'Configurar tarifas y costos por kWh', 1),
(4, 'gestionar_lecturas', 'Registrar y modificar lecturas de consumo', 1),
(5, 'ver_todos_clientes', 'Ver listado completo de clientes', 1),
(6, 'ver_todas_facturas', 'Ver facturas de cualquier cliente', 1),
(7, 'atender_consultas', 'Gestionar formularios de contacto', 1),
(8, 'ver_propias_facturas', 'Ver solo sus propias facturas', 1),
(9, 'solicitar_usuario', 'Solicitar creación de cuenta de usuario', 1),
(10, 'ver_reportes', 'Acceder a reportes y gráficos del sistema', 1);

-- --------------------------------------------------------
-- ROLES_PERMISOS (qué puede hacer cada rol)
-- --------------------------------------------------------

CREATE TABLE `roles_permisos` (
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  PRIMARY KEY (`rol_id`,`permiso_id`),
  CONSTRAINT `fk_rp_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_rp_permiso` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ADMINISTRADOR: puede hacer TODO
INSERT INTO `roles_permisos` (`rol_id`, `permiso_id`) VALUES
(1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,10);

-- EMPLEADO: ve clientes y facturas, atiende consultas
INSERT INTO `roles_permisos` (`rol_id`, `permiso_id`) VALUES
(2,5),(2,6),(2,7),(2,10);

-- CLIENTE: solo ve sus facturas y puede solicitar usuario
INSERT INTO `roles_permisos` (`rol_id`, `permiso_id`) VALUES
(3,8),(3,9);

-- --------------------------------------------------------
-- USUARIOS_ICE (cuentas de acceso al sistema)
-- --------------------------------------------------------

CREATE TABLE `usuarios_ice` (
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nickname` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_completo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`correo`),
  UNIQUE KEY `uk_usuarios_ice_nickname` (`nickname`),
  KEY `idx_usuarios_cedula` (`cedula`),
  CONSTRAINT `fk_usuario_cliente` FOREIGN KEY (`cedula`) REFERENCES `clientes` (`cedula`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Usuario ADMINISTRADOR por defecto
INSERT INTO `usuarios_ice` (`correo`, `nickname`, `password`, `cedula`, `nombre_completo`, `activo`) VALUES
('admin@ice.go.cr', 'admin_ice', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'Administrador Sistema', 1);
-- password: "password" (debes cambiarla después)

-- --------------------------------------------------------
-- USUARIOS_ROLES (qué rol tiene cada usuario)
-- --------------------------------------------------------

CREATE TABLE `usuarios_roles` (
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`correo`,`rol_id`),
  CONSTRAINT `fk_ur_usuario` FOREIGN KEY (`correo`) REFERENCES `usuarios_ice` (`correo`) ON DELETE CASCADE,
  CONSTRAINT `fk_ur_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Asignar rol ADMINISTRADOR al usuario por defecto
INSERT INTO `usuarios_roles` (`correo`, `rol_id`) VALUES
('admin@ice.go.cr', 1);

-- --------------------------------------------------------
-- SOLICITUDES_USUARIO (clientes solicitan crear su cuenta)
-- --------------------------------------------------------

CREATE TABLE `solicitudes_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nise` int(11) NOT NULL,
  `correo_solicitado` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nickname_solicitado` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_solicitud` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('PENDIENTE','APROBADA','RECHAZADA') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'PENDIENTE',
  `observaciones` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `procesada_por` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_procesada` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_solicitudes_correo` (`correo_solicitado`),
  UNIQUE KEY `uk_solicitudes_nickname` (`nickname_solicitado`),
  KEY `idx_solicitudes_cedula` (`cedula`),
  CONSTRAINT `fk_solicitud_cliente_cedula` FOREIGN KEY (`cedula`) REFERENCES `clientes` (`cedula`) ON DELETE CASCADE,
  CONSTRAINT `fk_solicitud_cliente_nise` FOREIGN KEY (`nise`) REFERENCES `clientes` (`nise`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------
-- TARIFAS (configuración de precios)
-- --------------------------------------------------------

CREATE TABLE `tarifas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('HOGAR','INDUSTRIAL') COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costo_kWh` decimal(10,4) NOT NULL,
  `vigente_desde` date NOT NULL,
  `vigente_hasta` date DEFAULT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_tarifas_vigencia` (`vigente_desde`,`vigente_hasta`,`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Tarifas iniciales de ejemplo
INSERT INTO `tarifas` (`tipo`, `descripcion`, `costo_kWh`, `vigente_desde`, `vigente_hasta`, `habilitado`) VALUES
('HOGAR', 'Tarifa residencial 2025', 150.5000, '2025-01-01', NULL, 1),
('INDUSTRIAL', 'Tarifa comercial/industrial 2025', 180.7500, '2025-01-01', NULL, 1);

-- --------------------------------------------------------
-- LECTURAS (consumo mensual por cliente)
-- --------------------------------------------------------

CREATE TABLE `lecturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` date NOT NULL,
  `nise` int(11) NOT NULL,
  `consumo_kWh` decimal(10,2) NOT NULL,
  `fecha_lectura` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_corte` date DEFAULT NULL,
  `tarifa_id` int(11) NOT NULL,
  `observaciones` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_lecturas_periodo_nise` (`periodo`,`nise`),
  KEY `idx_lecturas_nise` (`nise`),
  KEY `idx_lecturas_tarifa` (`tarifa_id`),
  CONSTRAINT `fk_lectura_cliente` FOREIGN KEY (`nise`) REFERENCES `clientes` (`nise`) ON DELETE CASCADE,
  CONSTRAINT `fk_lectura_tarifa` FOREIGN KEY (`tarifa_id`) REFERENCES `tarifas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------
-- FACTURAS (recibos generados)
-- --------------------------------------------------------

CREATE TABLE `facturas` (
  `consecutivo` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` date NOT NULL,
  `nise` int(11) NOT NULL,
  `lectura_id` int(11) NOT NULL,
  `fecha_emision` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_vencimiento` date NOT NULL,
  `consumo_kWh_facturado` decimal(10,2) NOT NULL,
  `costo_kWh_aplicado` decimal(10,4) NOT NULL,
  `tarifa_id` int(11) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `impuestos` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_pagar` decimal(12,2) NOT NULL,
  `estado` enum('PENDIENTE','PAGADA','VENCIDA') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'PENDIENTE',
  PRIMARY KEY (`consecutivo`),
  UNIQUE KEY `uk_facturas_lectura` (`lectura_id`),
  KEY `idx_facturas_periodo_nise` (`periodo`,`nise`),
  KEY `idx_facturas_nise` (`nise`),
  CONSTRAINT `fk_facturas_cliente_nise` FOREIGN KEY (`nise`) REFERENCES `clientes` (`nise`) ON DELETE CASCADE,
  CONSTRAINT `fk_facturas_tarifa` FOREIGN KEY (`tarifa_id`) REFERENCES `tarifas` (`id`),
  CONSTRAINT `fk_facturas_lectura` FOREIGN KEY (`lectura_id`) REFERENCES `lecturas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------
-- CONTACTO (consultas, reclamos, quejas)
-- --------------------------------------------------------

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nise` int(11) NOT NULL,
  `periodo_consultado` date DEFAULT NULL,
  `tipo` enum('CONSULTA','RECLAMO','QUEJA') COLLATE utf8_spanish_ci NOT NULL,
  `asunto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `correo_remitente` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_contacto` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_envio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('RECIBIDA','EN_PROCESO','ATENDIDA') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'RECIBIDA',
  `usuario_encargado_correo` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `respuesta` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_respuesta` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_contacto_nise` (`nise`),
  KEY `idx_contacto_estado` (`estado`),
  CONSTRAINT `fk_contacto_cliente` FOREIGN KEY (`nise`) REFERENCES `clientes` (`nise`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

COMMIT;