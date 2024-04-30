-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2024 a las 10:53:07
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
-- Base de datos: `e-comerce`
--
CREATE DATABASE IF NOT EXISTS `e-comerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `e-comerce`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `nombre_ciudad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciudad`, `nombre_ciudad`) VALUES
(1, 'Barcelona'),
(3, 'Madrid'),
(4, 'washington'),
(5, '4321'),
(6, '4321'),
(7, 'Barcelona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(20) NOT NULL,
  `apellido_cliente` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `telefono` int(9) NOT NULL,
  `direccion_cliente` varchar(100) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha_alta` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `apellido_cliente`, `password`, `nif`, `telefono`, `direccion_cliente`, `id_ciudad`, `email`, `fecha_alta`) VALUES
(1, 'josep', 'guardiola', '1234', '1234', 1234, 'st jaume 1', 0, 'x@gmail.com', '2024-04-29 09:14:47'),
(2, 'juan', 'perez', '$2y$10$6AwIz9QNcrIChwq530uw4.9hmMfBHeS3f4Zq44ZKZDAR8dTTrPRza', '1233', 1233, 'ivone street', 4, 'y@gmail.com', '2024-04-29 10:13:47'),
(4, 'luis', 'cortazar', '$2y$10$/eWcdTGftV7iWWaPm2n12.yjnEm.sEB08ETtc7pZPnAKe8pycu092', '1233', 1233, 'manami street', 4, 'pronto se hace', '2024-04-29 10:25:43'),
(5, 'carlos', 'carlins', '$2y$10$u5D/OpHC.0TLFH2AVB6U.uM1N09GUhj1gVgcsQp/bzuo45lNAp//C', '4321', 4321, '4321', 5, 'e.exe', '2024-04-29 10:46:09'),
(6, 'marcos ', 'perron', '$2y$10$lCeiecs2sXN05owfY139uelho1zlk6477oe8llCvxx5hbXzbxm0Hy', '4321', 4321, '4321', 5, 'e.execyuere', '2024-04-29 10:47:06'),
(7, 'luis', 'cortes', '$2y$10$rj9HDTSirdAmekrdGESGm./rpmF37.5KvwbG0xWVZXL5z5xvLqLUu', '1234', 615053328, 'Trinitat 6', 1, 'wincho_05@hotmail.com', '2024-04-29 11:08:56');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
