-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2024 a las 03:04:18
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
-- Base de datos: `reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancelaciones`
--

CREATE TABLE `cancelaciones` (
  `idCancelacion` bigint(20) UNSIGNED NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `estadoOcupado` int(11) NOT NULL,
  `solicitudes_idSolicitud` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_title` varchar(150) NOT NULL,
  `event_start_date` varchar(15) NOT NULL,
  `event_start_time` varchar(15) NOT NULL,
  `event_end_date` varchar(15) NOT NULL,
  `event_end_time` varchar(15) NOT NULL,
  `event_description` text DEFAULT NULL,
  `nombreSala` text NOT NULL,
  `nombreUsuario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_08_10_034632_create_events_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_09_14_161250_create_usuarios_table', 1),
(4, '2023_09_14_170643_create_salas_table', 1),
(5, '2023_10_05_194727_modificar_solicitudes', 1),
(6, '2023_10_05_200429_cancelaciones_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `idSala` bigint(20) UNSIGNED NOT NULL,
  `numeroDeSalaComputo` int(11) NOT NULL,
  `nombreSalaComputo` varchar(255) NOT NULL,
  `ubicacionCentroComputo` varchar(255) NOT NULL,
  `descripcionCentroComputo` varchar(255) NOT NULL,
  `estadoOcupado` int(11) NOT NULL,
  `fechaDeAgregadoComputo` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`idSala`, `numeroDeSalaComputo`, `nombreSalaComputo`, `ubicacionCentroComputo`, `descripcionCentroComputo`, `estadoOcupado`, `fechaDeAgregadoComputo`, `created_at`, `updated_at`) VALUES
(36, 1, 'Gestion Empresarial', 'entre edificio C y Jl', 'cuenta con 3 computadoras, 1 smart tv de 55 pulgadas', 0, '2024-01-23', '2024-01-23 23:08:55', '2024-01-23 23:08:55'),
(38, 2, 'TICS', 'palapasaaaa', 'tiene muchas pcs', 0, '2024-02-09', '2024-02-10 01:46:43', '2024-02-10 01:46:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `idSolicitud` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `usuarios_idUsuario` bigint(20) UNSIGNED NOT NULL,
  `salas_idSala` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`idSolicitud`, `titulo`, `color`, `start`, `end`, `descripcion`, `usuarios_idUsuario`, `salas_idSala`, `created_at`, `updated_at`) VALUES
(158, 'examen bimestral', '#FFD700', '2024-02-02 13:00:00', '2024-02-03 16:00:00', 'para 20 alumnos', 1, 36, NULL, NULL),
(159, 'examen bimestral', '#0071c5', '2024-02-15 08:00:00', '2024-02-16 11:00:00', 'venir todos con gusto', 1, 36, NULL, NULL),
(160, 'eliud', '#40E0D0', '2024-02-15 14:00:00', '2024-02-15 15:00:00', 'ok', 1, 36, NULL, NULL),
(161, 'peda', '#FF0000', '2024-02-15 14:00:00', '2024-02-15 15:00:00', 'venir todos con gusto', 1, 38, NULL, NULL),
(162, 'examen bimestral', '#008000', '2024-02-06 14:00:00', '2024-02-10 23:00:00', 'para 40 alumnos', 1, 38, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `contrasenaUsuario` varchar(255) NOT NULL,
  `nombreUsuario` varchar(255) NOT NULL,
  `apellidoPaterno` varchar(255) NOT NULL,
  `apellidoMaterno` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `contrasenaUsuario`, `nombreUsuario`, `apellidoPaterno`, `apellidoMaterno`, `created_at`, `updated_at`) VALUES
(1, 'pass1234', 'Eliud', 'Ruiz', 'Xoch', NULL, NULL),
(2, '1234password', 'Mayren', 'Jacinto', 'Silva', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancelaciones`
--
ALTER TABLE `cancelaciones`
  ADD PRIMARY KEY (`idCancelacion`),
  ADD KEY `cancelaciones_solicitudes_idsolicitud_foreign` (`solicitudes_idSolicitud`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`idSala`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`idSolicitud`),
  ADD KEY `solicitudes_usuarios_idusuario_foreign` (`usuarios_idUsuario`),
  ADD KEY `solicitudes_salas_idsala_foreign` (`salas_idSala`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancelaciones`
--
ALTER TABLE `cancelaciones`
  MODIFY `idCancelacion` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `idSala` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idSolicitud` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cancelaciones`
--
ALTER TABLE `cancelaciones`
  ADD CONSTRAINT `cancelaciones_solicitudes_idsolicitud_foreign` FOREIGN KEY (`solicitudes_idSolicitud`) REFERENCES `solicitudes` (`idSolicitud`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_salas_idsala_foreign` FOREIGN KEY (`salas_idSala`) REFERENCES `salas` (`idSala`),
  ADD CONSTRAINT `solicitudes_usuarios_idusuario_foreign` FOREIGN KEY (`usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
