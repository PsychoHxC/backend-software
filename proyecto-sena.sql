-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-02-2025 a las 03:33:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto sena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprobaciones_area`
--

CREATE TABLE `aprobaciones_area` (
  `id` int(11) NOT NULL,
  `fecha_aprobacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aprobaciones_area`
--

INSERT INTO `aprobaciones_area` (`id`, `fecha_aprobacion`) VALUES
(9, '2025-01-27 00:57:13'),
(10, '2025-01-27 00:57:13'),
(11, '2025-02-16 23:05:57'),
(12, '2025-02-16 23:05:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `id_area` int(11) DEFAULT NULL,
  `Jefe_area` varchar(30) DEFAULT NULL,
  `solicitud_personal` varchar(400) DEFAULT NULL,
  `id_aprobacion` int(11) DEFAULT NULL,
  `detalle_solicitud` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `id_area`, `Jefe_area`, `solicitud_personal`, `id_aprobacion`, `detalle_solicitud`) VALUES
(12, 0, 'Carlos contreras', 'Asistente de maquina placa ', 2, NULL),
(13, 0, 'Sebastian Martinez', 'Analista de desarrollo', 1, NULL),
(21, 1, 'Carlos Contreras ', 'Secretaria de gerencia', 6, NULL),
(22, 2, 'Jhon cortes ', 'Asistente documental', 4, NULL),
(23, 15, 'Carlos Cortes ', 'Guardia de seguridad ', 8, NULL),
(24, 2, 'Yolima Rincon ', 'Revisor fiscal', 10, 'Se requiere revisor fiscal, contrato obra labor por un periodo de 4 meses, con el fin de preparar la empresa para la proxima auditoria de laDIAN, preferiblemente con experiencia '),
(28, 15, 'Carlos Renteria', 'Guarda de seguridad', 12, 'Se requiere guarda de seguridad para fines de semana, por un periodo de 6 meses.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratacion`
--

CREATE TABLE `contratacion` (
  `id` int(11) NOT NULL,
  `numero_contrato` int(20) DEFAULT NULL,
  `contrato` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_candidatos`
--

CREATE TABLE `datos_candidatos` (
  `id` int(11) NOT NULL,
  `tipo_identificacion` varchar(15) DEFAULT NULL,
  `numero_identificacion` int(25) DEFAULT NULL,
  `nombre` varchar(15) DEFAULT NULL,
  `apellidos` varchar(25) DEFAULT NULL,
  `celular` int(10) DEFAULT NULL,
  `direccion` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `fo_formacion` int(25) DEFAULT NULL,
  `fo_contratacion` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formacion`
--

CREATE TABLE `formacion` (
  `id` int(11) NOT NULL,
  `nombre_formacion` varchar(50) DEFAULT NULL,
  `tipo_formacion` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gerencia`
--

CREATE TABLE `gerencia` (
  `id_gerencia` int(11) NOT NULL,
  `id_solicitud` int(11) DEFAULT NULL,
  `solicitud_personal` varchar(50) DEFAULT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `fecha_fin_oferta` date DEFAULT NULL,
  `detalle_oferta` varchar(4000) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 0,
  `prioridad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gerencia`
--

INSERT INTO `gerencia` (`id_gerencia`, `id_solicitud`, `solicitud_personal`, `fecha_solicitud`, `fecha_fin_oferta`, `detalle_oferta`, `estado`, `prioridad`) VALUES
(4, 10, 'Revisor fiscal', '2025-01-26', '2025-01-31', 'Se requiere revisor fiscal, contrato obra labor por un periodo de 4 meses, con el fin de preparar la empresa para la proxima auditoria de laDIAN, preferiblemente con experiencia ', 1, 'Alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombre_area`
--

CREATE TABLE `nombre_area` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nombre_area`
--

INSERT INTO `nombre_area` (`id_area`, `nombre_area`) VALUES
(1, 'Dirección y Gerencia'),
(2, 'Administración y Finanzas'),
(3, 'Recursos Humanos'),
(4, 'Producción y Operaciones'),
(5, 'Comercial y Ventas'),
(6, 'Marketing y Publicidad'),
(7, 'Tecnología e Innovación'),
(8, 'Investigación y Desarrollo (I+D)'),
(9, 'Legal y Compliance'),
(10, 'Compras y Abastecimiento'),
(11, 'Logística y Transporte'),
(12, 'Servicio al Cliente'),
(13, 'Seguridad y Salud'),
(14, 'Sostenibilidad y Responsabilidad Social'),
(15, 'Servicios Generales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `numero_oferta` int(11) NOT NULL,
  `nombre_oferta` varchar(100) NOT NULL,
  `fecha_fin_oferta` date NOT NULL,
  `detalle_oferta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seleccion`
--

CREATE TABLE `seleccion` (
  `id` int(11) NOT NULL,
  `fecha_seleccion` date DEFAULT NULL,
  `fo_candidato` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  `rol_usuario` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `email`, `clave`, `telefono`, `rol_usuario`) VALUES
(1, 'Sebastian Martinez', 'batista@gmail.com', 'f4e297579bb2a443919c11d8399aa1db0d588068', 1234567890, 'admin'),
(2, 'usuario2', 'usuario2@example.com', '48e9cf9644d16a6d363d91fcc453e9efc7625a32', 2147483647, 'invitado'),
(3, 'nuevo_usuario', 'nuevo_usuario@example.com', 'ed9cf7c16bae2921cab12930ab4fae56ea0b08aa', 1234567890, 'user'),
(7, 'Sebastian Fajardo', 'nuevo_usuario@example.com', 'f0c19f5da6c8d1e2bb5b92e2370dff5efe2a457ee379029086', 1234567890, 'gerente aprobador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprobaciones_area`
--
ALTER TABLE `aprobaciones_area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contratacion`
--
ALTER TABLE `contratacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_candidatos`
--
ALTER TABLE `datos_candidatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fo_formacion` (`fo_formacion`),
  ADD KEY `fo_contratacion` (`fo_contratacion`);

--
-- Indices de la tabla `formacion`
--
ALTER TABLE `formacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gerencia`
--
ALTER TABLE `gerencia`
  ADD PRIMARY KEY (`id_gerencia`);

--
-- Indices de la tabla `nombre_area`
--
ALTER TABLE `nombre_area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`numero_oferta`);

--
-- Indices de la tabla `seleccion`
--
ALTER TABLE `seleccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fo_candidato` (`fo_candidato`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aprobaciones_area`
--
ALTER TABLE `aprobaciones_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `contratacion`
--
ALTER TABLE `contratacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_candidatos`
--
ALTER TABLE `datos_candidatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `formacion`
--
ALTER TABLE `formacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gerencia`
--
ALTER TABLE `gerencia`
  MODIFY `id_gerencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `nombre_area`
--
ALTER TABLE `nombre_area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `numero_oferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seleccion`
--
ALTER TABLE `seleccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_candidatos`
--
ALTER TABLE `datos_candidatos`
  ADD CONSTRAINT `datos_candidatos_ibfk_3` FOREIGN KEY (`fo_formacion`) REFERENCES `formacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datos_candidatos_ibfk_4` FOREIGN KEY (`fo_contratacion`) REFERENCES `contratacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seleccion`
--
ALTER TABLE `seleccion`
  ADD CONSTRAINT `seleccion_ibfk_1` FOREIGN KEY (`fo_candidato`) REFERENCES `datos_candidatos` (`id`),
  ADD CONSTRAINT `seleccion_ibfk_2` FOREIGN KEY (`fo_candidato`) REFERENCES `datos_candidatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
