-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2019 a las 14:16:38
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
-- Estructura de tabla para la tabla `classes`
--

CREATE TABLE `classes` (
  `ID_CLASS` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `COD_CLASS` varchar(5) DEFAULT NULL,
  `COLOR` varchar(6) NOT NULL DEFAULT '4e73df'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `classes`
--

INSERT INTO `classes` (`ID_CLASS`, `NAME`, `COD_CLASS`, `COLOR`) VALUES
(1, 'Primero A', '1A', '4e73df'),
(2, 'Primero B', '1B', '4e73df'),
(3, 'Primero C', '1C', '4e73df'),
(4, 'Segundo A', '2A', 'f6c23e'),
(5, 'Segundo B', '2B', 'f6c23e'),
(6, 'Segundo C', '2C', 'f6c23e'),
(7, 'Tercero A', '3A', 'e74a3b'),
(8, 'Tercero B', '3B', 'e74a3b'),
(9, 'Tercero C', '3C', 'e74a3b'),
(10, 'Cuarto A', '4A', '1cc88a'),
(11, 'Cuarto B', '4B', '1cc88a'),
(12, 'Cuarto C', '4C', '1cc88a'),
(13, 'Quinto A', '5A', '858796'),
(14, 'Quinto B', '5B', '858796'),
(15, 'Quinto C', '5C', '858796'),
(16, 'Sexto A', '6A', 'ff8000'),
(17, 'Sexto B', '6B', 'ff8000'),
(18, 'Sexto C', '6C', 'ff8000');

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
(2, 'TEA', 'TEACHER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_user_classes`
--

CREATE TABLE `rel_user_classes` (
  `ID_USER_CLASS` int(11) NOT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_CLASS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_user_classes`
--

INSERT INTO `rel_user_classes` (`ID_USER_CLASS`, `ID_USER`, `ID_CLASS`) VALUES
(1, 5, 1),
(2, 5, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_user_subjects`
--

CREATE TABLE `rel_user_subjects` (
  `ID_USER_SUBJECT` int(11) NOT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_SUBJECT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_user_subjects`
--

INSERT INTO `rel_user_subjects` (`ID_USER_SUBJECT`, `ID_USER`, `ID_SUBJECT`) VALUES
(1, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `ID` int(255) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `SURNAME` varchar(30) NOT NULL,
  `SURNAME2` varchar(30) NOT NULL,
  `ID_CLASS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`ID`, `NAME`, `SURNAME`, `SURNAME2`, `ID_CLASS`) VALUES
(1, 'Alex', 'Luque', 'Prados', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subjects`
--

CREATE TABLE `subjects` (
  `ID_SUBJECT` int(11) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `ID_CLASS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subjects`
--

INSERT INTO `subjects` (`ID_SUBJECT`, `NAME`, `ID_CLASS`) VALUES
(1, 'CASTELLANO', 1),
(2, 'ENGLISH', 2);

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
(4, 'natalia', 'natalia', 2, 'nataliagf.97@gmail.com', 'Natalia', 'Fernandez'),
(5, 'Leo', '123', 2, 'leo.gonzalez@gmail.com', 'Leo', 'Gonzalez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`ID_CLASS`);

--
-- Indices de la tabla `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`GROUP_USER_ID`);

--
-- Indices de la tabla `rel_user_classes`
--
ALTER TABLE `rel_user_classes`
  ADD PRIMARY KEY (`ID_USER_CLASS`);

--
-- Indices de la tabla `rel_user_subjects`
--
ALTER TABLE `rel_user_subjects`
  ADD PRIMARY KEY (`ID_USER_SUBJECT`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`ID_SUBJECT`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `classes`
--
ALTER TABLE `classes`
  MODIFY `ID_CLASS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `group_user`
--
ALTER TABLE `group_user`
  MODIFY `GROUP_USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rel_user_classes`
--
ALTER TABLE `rel_user_classes`
  MODIFY `ID_USER_CLASS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rel_user_subjects`
--
ALTER TABLE `rel_user_subjects`
  MODIFY `ID_USER_SUBJECT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `subjects`
--
ALTER TABLE `subjects`
  MODIFY `ID_SUBJECT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
