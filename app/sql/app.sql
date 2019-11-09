-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2019 a las 16:43:26
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_user`
--

CREATE TABLE `group_user` (
  `GROUP_USER_ID` int(11) NOT NULL,
  `GROUP_COD` varchar(3) NOT NULL,
  `DESCRIPCION` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `group_user`
--

INSERT INTO `group_user` (`GROUP_USER_ID`, `GROUP_COD`, `DESCRIPCION`) VALUES
(1, 'ADM', 'ADMINISTRATOR'),
(2, 'COM', 'COMMON');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(15) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `GROUP_USER_ID` int(11) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `LASTNAME` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `GROUP_USER_ID`, `EMAIL`, `NAME`, `LASTNAME`) VALUES
(1, 'admin', '$2y$10$iwq8J9.x6I3WG', 1, 'admin@gmail.com', 'admin', ''),
(7, 'Leo', '$2y$10$mYwX6M0IrMLht', 2, 'leo.gonzalez.cruz@gmail.com', 'Leo', 'Gonzalez Cruz');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
