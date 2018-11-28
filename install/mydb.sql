-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2018 a las 16:50:54
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas_bach`
--

CREATE TABLE `asignaturas_bach` (
  `Bach_codAsig` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas_eso`
--

CREATE TABLE `asignaturas_eso` (
  `ESO_codAsig` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bach`
--

CREATE TABLE `bach` (
  `codAsig` int(11) NOT NULL,
  `curso` varchar(20) NOT NULL,
  `grupo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bach_has_solicitud`
--

CREATE TABLE `bach_has_solicitud` (
  `Bach_codAsig` int(11) NOT NULL,
  `Solicitud_codSolicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cf`
--

CREATE TABLE `cf` (
  `codCF` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `FP_codFP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eso`
--

CREATE TABLE `eso` (
  `codAsig` int(11) NOT NULL,
  `curso` varchar(20) NOT NULL,
  `grupo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eso_has_solicitud`
--

CREATE TABLE `eso_has_solicitud` (
  `ESO_codAsig` int(11) NOT NULL,
  `Solicitud_codSolicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fp`
--

CREATE TABLE `fp` (
  `codFP` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fp_has_solicitud`
--

CREATE TABLE `fp_has_solicitud` (
  `FP_codFP` int(11) NOT NULL,
  `Solicitud_codSolicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `codAsig` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `curso` varchar(45) NOT NULL,
  `grupo` varchar(45) NOT NULL,
  `clave_matri` varchar(45) NOT NULL,
  `CF_codCF` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `codSolicitud` int(11) NOT NULL,
  `Usuarios_dni` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` varchar(15) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido1` varchar(30) NOT NULL,
  `apellido2` varchar(30) NOT NULL,
  `fotografia` varchar(100) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `contraseña` varchar(45) NOT NULL,
  `perfil` varchar(45) NOT NULL,
  `telefono_fijo` int(11) NOT NULL,
  `telefono_movil` int(11) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  `web` varchar(45) DEFAULT NULL,
  `blog` varchar(45) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `activo` tinyint(4) NOT NULL,
  `fecha_alta` date NOT NULL,
  `asignatura` varchar(400) DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaturas_bach`
--
ALTER TABLE `asignaturas_bach`
  ADD KEY `fk_Asignaturas_Bach_Bach1_idx` (`Bach_codAsig`);

--
-- Indices de la tabla `asignaturas_eso`
--
ALTER TABLE `asignaturas_eso`
  ADD KEY `fk_Asignaturas_ESO_ESO1_idx` (`ESO_codAsig`);

--
-- Indices de la tabla `bach`
--
ALTER TABLE `bach`
  ADD PRIMARY KEY (`codAsig`);

--
-- Indices de la tabla `bach_has_solicitud`
--
ALTER TABLE `bach_has_solicitud`
  ADD PRIMARY KEY (`Bach_codAsig`,`Solicitud_codSolicitud`),
  ADD KEY `fk_Bach_has_Solicitud_Solicitud1_idx` (`Solicitud_codSolicitud`),
  ADD KEY `fk_Bach_has_Solicitud_Bach1_idx` (`Bach_codAsig`);

--
-- Indices de la tabla `cf`
--
ALTER TABLE `cf`
  ADD PRIMARY KEY (`codCF`),
  ADD KEY `fk_CF_FP1_idx` (`FP_codFP`);

--
-- Indices de la tabla `eso`
--
ALTER TABLE `eso`
  ADD PRIMARY KEY (`codAsig`);

--
-- Indices de la tabla `eso_has_solicitud`
--
ALTER TABLE `eso_has_solicitud`
  ADD PRIMARY KEY (`ESO_codAsig`,`Solicitud_codSolicitud`),
  ADD KEY `fk_ESO_has_Solicitud_Solicitud1_idx` (`Solicitud_codSolicitud`),
  ADD KEY `fk_ESO_has_Solicitud_ESO1_idx` (`ESO_codAsig`);

--
-- Indices de la tabla `fp`
--
ALTER TABLE `fp`
  ADD PRIMARY KEY (`codFP`);

--
-- Indices de la tabla `fp_has_solicitud`
--
ALTER TABLE `fp_has_solicitud`
  ADD PRIMARY KEY (`FP_codFP`,`Solicitud_codSolicitud`),
  ADD KEY `fk_FP_has_Solicitud_Solicitud1_idx` (`Solicitud_codSolicitud`),
  ADD KEY `fk_FP_has_Solicitud_FP1_idx` (`FP_codFP`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`codAsig`),
  ADD KEY `fk_Modulo_CF1_idx` (`CF_codCF`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`codSolicitud`),
  ADD KEY `fk_Solicitud_Usuarios1_idx` (`Usuarios_dni`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bach`
--
ALTER TABLE `bach`
  MODIFY `codAsig` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cf`
--
ALTER TABLE `cf`
  MODIFY `codCF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eso`
--
ALTER TABLE `eso`
  MODIFY `codAsig` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fp`
--
ALTER TABLE `fp`
  MODIFY `codFP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `codAsig` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `codSolicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaturas_bach`
--
ALTER TABLE `asignaturas_bach`
  ADD CONSTRAINT `fk_Asignaturas_Bach_Bach1` FOREIGN KEY (`Bach_codAsig`) REFERENCES `bach` (`codAsig`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignaturas_eso`
--
ALTER TABLE `asignaturas_eso`
  ADD CONSTRAINT `fk_Asignaturas_ESO_ESO1` FOREIGN KEY (`ESO_codAsig`) REFERENCES `eso` (`codAsig`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bach_has_solicitud`
--
ALTER TABLE `bach_has_solicitud`
  ADD CONSTRAINT `fk_Bach_has_Solicitud_Bach1` FOREIGN KEY (`Bach_codAsig`) REFERENCES `bach` (`codAsig`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bach_has_Solicitud_Solicitud1` FOREIGN KEY (`Solicitud_codSolicitud`) REFERENCES `solicitud` (`codSolicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cf`
--
ALTER TABLE `cf`
  ADD CONSTRAINT `fk_CF_FP1` FOREIGN KEY (`FP_codFP`) REFERENCES `fp` (`codFP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `eso_has_solicitud`
--
ALTER TABLE `eso_has_solicitud`
  ADD CONSTRAINT `fk_ESO_has_Solicitud_ESO1` FOREIGN KEY (`ESO_codAsig`) REFERENCES `eso` (`codAsig`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ESO_has_Solicitud_Solicitud1` FOREIGN KEY (`Solicitud_codSolicitud`) REFERENCES `solicitud` (`codSolicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fp_has_solicitud`
--
ALTER TABLE `fp_has_solicitud`
  ADD CONSTRAINT `fk_FP_has_Solicitud_FP1` FOREIGN KEY (`FP_codFP`) REFERENCES `fp` (`codFP`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FP_has_Solicitud_Solicitud1` FOREIGN KEY (`Solicitud_codSolicitud`) REFERENCES `solicitud` (`codSolicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD CONSTRAINT `fk_Modulo_CF1` FOREIGN KEY (`CF_codCF`) REFERENCES `cf` (`codCF`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `fk_Solicitud_Usuarios1` FOREIGN KEY (`Usuarios_dni`) REFERENCES `usuarios` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
