-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2024 a las 22:49:22
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
-- Base de datos: `todoapp`
--
CREATE DATABASE IF NOT EXISTS `todoapp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `todoapp`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app`
--

CREATE TABLE `app` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `estado_user` varchar(20) NOT NULL,
  `fecha_user` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `app`
--

INSERT INTO `app` (`id`, `titulo`, `descripcion`, `estado`, `fecha`, `estado_user`, `fecha_user`) VALUES
(26, 'Que funcioneeee', 'Vamos a topeeee', 'darkorange', '2024-04-24', 'pendiente', '2024-04-30'),
(27, 'Buen dia pepito', 'Ultimo dia programando', 'white', '2024-04-24', 'eliminado', '2024-04-28'),
(28, 'Hola mundo', 'Vamos a testear esto ya', 'darkgreen', '2024-04-24', 'finalizar', '2024-04-25'),
(29, 'HAcer los deberes', 'Hay que hacer los deberes hoy, sino voy a suspender', 'darkblue', '2024-04-24', 'ejecutando', '2024-05-03'),
(30, 'Buen dia', 'Jesus que funcione', 'darkorange', '2024-04-24', 'pendiente', '2024-04-30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `app`
--
ALTER TABLE `app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
