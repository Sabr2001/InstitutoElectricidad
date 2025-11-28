-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2025 a las 11:39:30
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `institutoelectricidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `nise` int(11) NOT NULL,
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
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`nise`, `cedula`, `nombre`, `apellido1`, `apellido2`, `telefono`, `email`, `direccion`, `provincia_id`, `tipo_tarifa`, `activo`, `fecha_registro`) VALUES
(1, '208750999', 'Carlos', 'Mora', 'Jiménez', '8888-5566', 'carlos.mora@correo.com', 'Residencial Las Flores, Casa #23', 3, 'HOGAR', 1, '2025-11-27 03:23:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nise` int(11) NOT NULL,
  `periodo_consultado` date DEFAULT NULL,
  `tipo` enum('CONSULTA','RECLAMO','QUEJA') COLLATE utf8_spanish_ci NOT NULL,
  `asunto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `correo_remitente` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_contacto` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_envio` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('RECIBIDA','EN_PROCESO','ATENDIDA') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'RECIBIDA',
  `usuario_encargado_correo` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `respuesta` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_respuesta` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nise`, `periodo_consultado`, `tipo`, `asunto`, `descripcion`, `correo_remitente`, `telefono_contacto`, `fecha_envio`, `estado`, `usuario_encargado_correo`, `respuesta`, `fecha_respuesta`) VALUES
(1, 1, '2025-01-01', 'RECLAMO', 'Facturación incorrecta', 'Creo que el consumo registrado no es correcto, solicito verificación.', 'carlos.mora@correo.com', '8888-5566', '2025-11-27 03:26:04', 'RECIBIDA', NULL, NULL, NULL),
(9, 1, '2025-01-01', 'RECLAMO', 'Muy alto el recibo', 'prueba', 'carlos.mora@correo.com', NULL, '2025-11-27 04:00:23', 'RECIBIDA', NULL, NULL, NULL),
(10, 1, '2025-04-01', 'CONSULTA', 'Probando', 'solo estoy probando el sistema', 'carlos.mora@correo.com', NULL, '2025-11-27 04:02:14', 'RECIBIDA', NULL, NULL, NULL),
(11, 1, '2025-08-01', 'RECLAMO', 'Hola Brodis', 'como estan brodis', 'carlos.mora@correo.com', NULL, '2025-11-27 04:24:54', 'RECIBIDA', NULL, NULL, NULL),
(12, 1, '2025-12-01', 'QUEJA', 'Debi tirar mas codigo', 'Debi tirar mas codigo cuando te tuve debi usar mas github las veces que pude\n', 'carlos.mora@correo.com', NULL, '2025-11-27 04:36:23', 'RECIBIDA', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `consecutivo` int(11) NOT NULL,
  `periodo` date NOT NULL,
  `nise` int(11) NOT NULL,
  `lectura_id` int(11) NOT NULL,
  `fecha_emision` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_vencimiento` date NOT NULL,
  `consumo_kWh_facturado` decimal(10,2) NOT NULL,
  `costo_kWh_aplicado` decimal(10,4) NOT NULL,
  `tarifa_id` int(11) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `impuestos` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_pagar` decimal(12,2) NOT NULL,
  `estado` enum('PENDIENTE','PAGADA','VENCIDA') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'PENDIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`consecutivo`, `periodo`, `nise`, `lectura_id`, `fecha_emision`, `fecha_vencimiento`, `consumo_kWh_facturado`, `costo_kWh_aplicado`, `tarifa_id`, `subtotal`, `impuestos`, `total_pagar`, `estado`) VALUES
(1, '2025-01-01', 1, 1, '2025-11-27 03:25:32', '2025-12-12', '125.00', '150.5000', 1, '18812.50', '0.00', '18812.50', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

CREATE TABLE `lecturas` (
  `id` int(11) NOT NULL,
  `periodo` date NOT NULL,
  `nise` int(11) NOT NULL,
  `consumo_kWh` decimal(10,2) NOT NULL,
  `fecha_lectura` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_corte` date DEFAULT NULL,
  `tarifa_id` int(11) NOT NULL,
  `observaciones` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lecturas`
--

INSERT INTO `lecturas` (`id`, `periodo`, `nise`, `consumo_kWh`, `fecha_lectura`, `fecha_corte`, `tarifa_id`, `observaciones`) VALUES
(1, '2025-01-01', 1, '125.00', '2025-11-27 03:25:08', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

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

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`) VALUES
(2, 'Alajuela'),
(3, 'Cartago'),
(5, 'Guanacaste'),
(4, 'Heredia'),
(7, 'Limón'),
(6, 'Puntarenas'),
(1, 'San José');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `habilitado`) VALUES
(1, 'ADMINISTRADOR', 'Acceso total: gestiona clientes, usuarios, tarifas, lecturas', 1),
(2, 'EMPLEADO', 'Atención al cliente: ve clientes, facturas, atiende consultas', 1),
(3, 'CLIENTE', 'Usuario final: consulta sus propias facturas y consumo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles_permisos`
--

INSERT INTO `roles_permisos` (`rol_id`, `permiso_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 10),
(2, 5),
(2, 6),
(2, 7),
(2, 10),
(3, 8),
(3, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_usuario`
--

CREATE TABLE `solicitudes_usuario` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nise` int(11) NOT NULL,
  `correo_solicitado` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nickname_solicitado` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_solicitud` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('PENDIENTE','APROBADA','RECHAZADA') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'PENDIENTE',
  `observaciones` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `procesada_por` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_procesada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id` int(11) NOT NULL,
  `tipo` enum('HOGAR','INDUSTRIAL') COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costo_kWh` decimal(10,4) NOT NULL,
  `vigente_desde` date NOT NULL,
  `vigente_hasta` date DEFAULT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `tipo`, `descripcion`, `costo_kWh`, `vigente_desde`, `vigente_hasta`, `habilitado`) VALUES
(1, 'HOGAR', 'Tarifa residencial 2025', '150.5000', '2025-01-01', NULL, 1),
(2, 'INDUSTRIAL', 'Tarifa comercial/industrial 2025', '180.7500', '2025-01-01', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_ice`
--

CREATE TABLE `usuarios_ice` (
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nickname` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_completo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios_ice`
--

INSERT INTO `usuarios_ice` (`correo`, `nickname`, `password`, `cedula`, `nombre_completo`, `fecha_creacion`, `activo`) VALUES
('admin@ice.go.cr', 'admin_ice', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'Administrador Sistema', '2025-11-27 08:54:47', 1),
('carlos.mora@correo.com', 'cmora', '$2y$10$YbZi4nOt9juIvWBbgCcyueXlQ0gdxLkvtBO36pWYn6mf1U.WX9GQy', '208750999', 'Carlos Mora Jiménez', '2025-11-27 03:23:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`correo`, `rol_id`) VALUES
('admin@ice.go.cr', 1),
('carlos.mora@correo.com', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`nise`),
  ADD UNIQUE KEY `uk_clientes_cedula` (`cedula`),
  ADD KEY `idx_clientes_provincia` (`provincia_id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_contacto_nise` (`nise`),
  ADD KEY `idx_contacto_estado` (`estado`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`consecutivo`),
  ADD UNIQUE KEY `uk_facturas_lectura` (`lectura_id`),
  ADD KEY `idx_facturas_periodo_nise` (`periodo`,`nise`),
  ADD KEY `idx_facturas_nise` (`nise`),
  ADD KEY `fk_facturas_tarifa` (`tarifa_id`);

--
-- Indices de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_lecturas_periodo_nise` (`periodo`,`nise`),
  ADD KEY `idx_lecturas_nise` (`nise`),
  ADD KEY `idx_lecturas_tarifa` (`tarifa_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_permisos_nombre` (`nombre`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_provincias_nombre` (`nombre`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_roles_nombre` (`nombre`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`rol_id`,`permiso_id`),
  ADD KEY `fk_rp_permiso` (`permiso_id`);

--
-- Indices de la tabla `solicitudes_usuario`
--
ALTER TABLE `solicitudes_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_solicitudes_correo` (`correo_solicitado`),
  ADD UNIQUE KEY `uk_solicitudes_nickname` (`nickname_solicitado`),
  ADD KEY `idx_solicitudes_cedula` (`cedula`),
  ADD KEY `fk_solicitud_cliente_nise` (`nise`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_tarifas_vigencia` (`vigente_desde`,`vigente_hasta`,`tipo`);

--
-- Indices de la tabla `usuarios_ice`
--
ALTER TABLE `usuarios_ice`
  ADD PRIMARY KEY (`correo`),
  ADD UNIQUE KEY `uk_usuarios_ice_nickname` (`nickname`),
  ADD KEY `idx_usuarios_cedula` (`cedula`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`correo`,`rol_id`),
  ADD KEY `fk_ur_rol` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `nise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes_usuario`
--
ALTER TABLE `solicitudes_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_provincia` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`);

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `fk_contacto_cliente` FOREIGN KEY (`nise`) REFERENCES `clientes` (`nise`) ON DELETE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_facturas_cliente_nise` FOREIGN KEY (`nise`) REFERENCES `clientes` (`nise`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_facturas_lectura` FOREIGN KEY (`lectura_id`) REFERENCES `lecturas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_facturas_tarifa` FOREIGN KEY (`tarifa_id`) REFERENCES `tarifas` (`id`);

--
-- Filtros para la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD CONSTRAINT `fk_lectura_cliente` FOREIGN KEY (`nise`) REFERENCES `clientes` (`nise`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lectura_tarifa` FOREIGN KEY (`tarifa_id`) REFERENCES `tarifas` (`id`);

--
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `fk_rp_permiso` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rp_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes_usuario`
--
ALTER TABLE `solicitudes_usuario`
  ADD CONSTRAINT `fk_solicitud_cliente_cedula` FOREIGN KEY (`cedula`) REFERENCES `clientes` (`cedula`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_solicitud_cliente_nise` FOREIGN KEY (`nise`) REFERENCES `clientes` (`nise`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios_ice`
--
ALTER TABLE `usuarios_ice`
  ADD CONSTRAINT `fk_usuario_cliente` FOREIGN KEY (`cedula`) REFERENCES `clientes` (`cedula`) ON DELETE SET NULL;

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `fk_ur_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ur_usuario` FOREIGN KEY (`correo`) REFERENCES `usuarios_ice` (`correo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
