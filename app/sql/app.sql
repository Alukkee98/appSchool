-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2019 a las 19:07:34
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.33

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
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `ID_COURSE` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `COD_COURSE` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`ID_COURSE`, `NAME`, `COD_COURSE`) VALUES
(1, 'Sexto A', '6A'),
(2, 'Quinto A', '5A');

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
(1, 'ADM', 'ADMINISTRADOR'),
(2, 'COM', 'COMÚN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `GROUP_USER_ID` int(11) NOT NULL,
  `EMAIL` varchar(200) DEFAULT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `LASTNAME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID_USER`, `USERNAME`, `PASSWORD`, `GROUP_USER_ID`, `EMAIL`, `NAME`, `LASTNAME`) VALUES
(1, 'admin', 'admin', 1, 'admin@gmail.com', 'admin', 'admin'),
(3, 'Juan', 'admin', 1, 'transluque@msn.com', 'Juan', 'Luque'),
(16, 'Lolo', '123', 1, 'leo.gonzalez@gmail.com', 'Leo', 'Gonzalez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID_COURSE`);

--
-- Indices de la tabla `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`GROUP_USER_ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `ID_COURSE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `group_user`
--
ALTER TABLE `group_user`
  MODIFY `GROUP_USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
