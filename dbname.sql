-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2021 a las 04:26:07
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbname`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `msgId` int(11) NOT NULL,
  `sender_username` varchar(100) NOT NULL,
  `receiver_username` varchar(100) NOT NULL,
  `msg_content` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `readed` tinyint(1) NOT NULL DEFAULT 0,
  `picture` varchar(255) DEFAULT NULL,
  `topic` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`msgId`, `sender_username`, `receiver_username`, `msg_content`, `date`, `readed`, `picture`, `topic`) VALUES
(3, 'Alber', 'poco', 'asdasdasdasd', '2021-11-24 00:00:00', 0, '', ''),
(4, 'Alber', 'poco', 'ppppppp', '2021-11-24 00:00:00', 0, '', ''),
(5, 'poco', 'Alber', '12121212121', '2021-11-24 00:00:00', 0, '', ''),
(6, 'Maria', 'Irene', 'hola hola hola', '2021-11-24 00:00:00', 1, '', ''),
(7, 'Maria', 'Irene', 'asdasdasdasd', '2021-11-24 00:00:00', 1, '', ''),
(8, 'Irene', 'Maria', 'aasdasdasdsad', '2021-11-24 00:00:00', 1, '', ''),
(9, 'Irene', '', 's<dasdasedasdas', '2021-11-24 00:00:00', 0, '', ''),
(10, 'Maria', 'Irene', 'adsdasdasdasd', '2021-11-24 00:00:00', 1, '', ''),
(11, 'felix', 'Irene', 'assdasdasd', '2021-11-24 00:00:00', 0, '', ''),
(12, 'xavi', 'felix', 'ASDASDASDSA', '2021-11-24 00:00:00', 1, '', ''),
(13, 'xavi', 'felix', 'adasdasdasd', '2021-11-24 00:00:00', 1, '', ''),
(14, 'xavi', 'felix', 'dasdasda', '2021-11-25 00:00:00', 1, 'upload/Captura.JPG', ''),
(15, 'felix', 'xavi', 'fsdfsdfsdfsdfsdfs', '2021-11-25 00:11:30', 1, '', ''),
(16, 'xavi', 'felix', 'sdasdasdasd', '2021-11-25 00:12:52', 1, '', ''),
(17, 'xavi', 'felix', 'asddasdasda', '2021-11-25 00:15:02', 1, 'upload/CaraIIIIIIIIIII.JPG', ''),
(18, 'xavi', 'felix', 'asdasasdasdasd', '2021-11-25 01:08:28', 1, 'upload/BuzzHmmmmm.jpg', 'mensaje topic'),
(19, 'felix', 'xavi', 'dasdasdasd', '2021-11-25 02:27:25', 0, 'upload/makoto-streetfighter-teppen-art.jpg', 'adsdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`msgId`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `msgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
