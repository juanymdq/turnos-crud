-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-08-2018 a las 19:31:35
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `roles_codeigniter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito`
--

CREATE TABLE `distrito` (
  `id_ciudad` int(10) UNSIGNED NOT NULL,
  `id_prov` int(10) UNSIGNED NOT NULL,
  `c_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `distrito`
--

INSERT INTO `distrito` (`id_ciudad`, `id_prov`, `c_nombre`) VALUES
(1, 1, 'SALLIQUELO'),
(2, 1, 'MAR DEL PLATA'),
(3, 2, 'SAN MIGUEL'),
(4, 4, 'USUAHIA'),
(5, 7, 'CINCO SALTOS'),
(6, 7, 'BARILOCHE'),
(7, 17, 'TERMAS DE RIO HONDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` int(10) UNSIGNED NOT NULL,
  `desc_especialidad` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_especialidad`, `desc_especialidad`) VALUES
(1, 'MEDICINA PREVENTIVA Y SALUD PUBLICA'),
(2, 'PEDIATRIA'),
(3, 'OFTALMOLOGIA'),
(4, 'CIRUJIA CARDIOVASCULAR'),
(5, 'OTORRINOLARINGOLOGIA'),
(6, 'ALERGEOLOGIA'),
(7, 'ANESTESIOLOGIA Y REANIMACION'),
(8, 'CARDIOLOGIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_social`
--

CREATE TABLE `obra_social` (
  `id_os` int(10) UNSIGNED NOT NULL,
  `os_nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `portal` varchar(100) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `id_prov` int(10) UNSIGNED NOT NULL,
  `id_ciudad` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `obra_social`
--

INSERT INTO `obra_social` (`id_os`, `os_nombre`, `direccion`, `telefono`, `portal`, `observaciones`, `id_prov`, `id_ciudad`) VALUES
(2, 'OMINT', 'MITRE 2154', '02234567898', 'www.omint.com.ar', '', 0, 0),
(3, 'GALENO', 'ALVEAR 1235', '02234987542', 'www.galeno.com.ar', '', 0, 0),
(4, 'UPCN', 'LAVALLE 3021', '01143256987', 'www.upcn.com.ar', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `matricula` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `id_especialidad` int(10) UNSIGNED NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`matricula`, `nombre`, `apellido`, `id_especialidad`, `telefono`, `email`) VALUES
('454587', 'JUAN', 'FERNANDEZ', 3, '0223155836761', 'jifernandez04@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id_prov` int(10) UNSIGNED NOT NULL,
  `prov_nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_prov`, `prov_nombre`) VALUES
(1, 'BUENOS AIRES'),
(2, 'TUCUMAN'),
(3, 'CATAMARCA'),
(4, 'TIERRA DEL FUEGO'),
(5, 'CHUBUT'),
(6, 'SANTA CRUZ'),
(7, 'RIO NEGRO'),
(8, 'NEUQUEN'),
(9, 'LA PAMPA'),
(10, 'MENDOZA'),
(11, 'SAN JUAN'),
(12, 'LA RIOJA'),
(13, 'SALTA'),
(14, 'JUJUY'),
(15, 'FORMOSA'),
(16, 'CHACO'),
(17, 'SANTIAGO DEL ESTERO'),
(18, 'SAN LUIS'),
(19, 'CORDOBA'),
(20, 'SANTA FE'),
(21, 'ENTRE RIOS'),
(22, 'CORRIENTES'),
(23, 'MISIONES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio`
--

CREATE TABLE `socio` (
  `id_socio` int(10) UNSIGNED NOT NULL,
  `dni` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `id_os` int(10) UNSIGNED NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `socio`
--

INSERT INTO `socio` (`id_socio`, `dni`, `nombre`, `apellido`, `id_os`, `telefono`, `email`) VALUES
(1, 27625457, 'JUAN', 'FERNANDEZ', 3, '02234987542', 'jifernandez04@hotmail.com'),
(2, 30109740, 'GEORGINA', 'CORTI MONZON', 2, '02234567898', 'georgina-cm@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id_turno` int(10) UNSIGNED NOT NULL,
  `id_profesional` int(10) UNSIGNED NOT NULL,
  `id_especialidad` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `observaciones` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `perfil` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `perfil`, `username`, `password`, `nombre`, `apellido`) VALUES
(1, 'administrador', 'israel965', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Israel', 'Suarez'),
(2, 'editor', 'vanessa78', 'ab41949825606da179db7c89ddcedcc167b64847', 'Vanessa', 'Rothman'),
(3, 'suscriptor', 'jaime70', '1a248d7a471ad8d5993aa523c8397ce1d0bafe78', 'Jaime', 'Avila'),
(4, 'administrador', 'jfernandez', 'db1206f3394d43602b2300cea1fbb18d68e09ed8', 'Juan', 'Fernandez'),
(5, 'editor', 'gcorti', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Geor', 'Corti'),
(7, 'editor', 'Admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Administrador', 'Admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  ADD PRIMARY KEY (`id_os`);

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indices de la tabla `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`id_socio`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id_turno`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_ciudad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  MODIFY `id_os` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_prov` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `socio`
--
ALTER TABLE `socio`
  MODIFY `id_socio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_turno` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
