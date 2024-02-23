-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2023 a las 19:02:39
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calendar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `idSolicitud` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `descripcion` varchar(60) NOT NULL,
  `nombreSala` varchar(50) NOT NULL,
  `nombreUsuario` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`idSolicitud`, `titulo`, `color`, `start`, `end`, `descripcion`, `nombreSala`, `nombreUsuario`) VALUES
(1, 'peda', '#008000', '2023-10-04 15:20:00', '2023-10-04 16:20:00', 'para 40 alumnos', 'gestion', 'eliud'),
(3, 'testeo', '#FFD700', '2023-10-04 11:00:00', '2023-10-04 14:00:00', 'ouioeru', 'oiuoi', 'oiuoiu'),
(5, 'fiestaxd', '#008000', '2023-10-06 22:00:00', '2023-10-06 23:00:00', 'ok', 'ok', 'ok'),
(6, 'lkkk', '#40E0D0', '2023-10-06 00:00:00', '2023-10-06 13:00:00', 'ok', 'ok', 'ok'),
(7, 'javier profe', '#40E0D0', '2023-10-05 00:00:00', '2023-10-05 14:00:00', 'francisco', 'ok', 'ok');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`idSolicitud`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
