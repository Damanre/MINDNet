-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2021 a las 00:07:10
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
-- Base de datos: `mindnet`
--
USE `user2daw_BD1-23`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `idusuario` smallint(5) UNSIGNED NOT NULL,
  `premium` bit(1) NOT NULL DEFAULT b'0',
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `f_nac` date NOT NULL,
  `sexo` CHAR(1) NOT NULL,
  `dni` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idusuario`, `premium`, `nombre`, `apellidos`, `f_nac`, `sexo`, `dni`, `buscando`) VALUES
(10, b'0', 'Dario', 'Manzanedo Reja', '2001-05-10', 'h', '80096493M'),
(11, b'0', 'Selu', 'Delgado', '2001-06-20', 'o', '80054246S'),
(12, b'0', 'Marta', 'Broncano Suarez', '2001-10-14', 'm', '84234875J');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `idasignatura` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`idasignatura`, `nombre`) VALUES
(1, 'Matematicas'),
(2, 'Lengua'),
(3, 'Informatica'),
(4, 'CCSS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `idmensaje` int(10) UNSIGNED NOT NULL,
  `reunion` int(10) UNSIGNED NOT NULL,
  `texto` varchar(250) NOT NULL,
  `usuario` smallint(5) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL DEFAULT NOW()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `idusuario` smallint(5) UNSIGNED NOT NULL,
  `certificado` varchar(200) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `f_nac` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `dni` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`idusuario`, `certificado`, `nombre`, `apellidos`, `f_nac`, `sexo`, `dni`, `buscando`) VALUES
(20, 'prueba.pdf', 'Isabel', 'Muñoz', '2021-11-01', 'm', '80096656M');
(21, 'prueba.pdf', 'Manuel ', 'Merino', '2021-01-21', 'h', '80054856W');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reunion`
--

CREATE TABLE `reunion` (
  `idreunion` int(10) UNSIGNED NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime DEFAULT NULL,
  `anfitrion` smallint(5) UNSIGNED NOT NULL,
  `participante` smallint(5) UNSIGNED DEFAULT NULL,
  `temario` tinyint(3) UNSIGNED NOT NULL,
  `activa` bit(1) NOT NULL DEFAULT b'1',
  `seed` char(6);
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `solicitud_pro`
--

CREATE TABLE `solicitud_pro` (
  `idsolpro` smallint(5) UNSIGNED NOT NULL,
  `usuario` smallint(5) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `doc` varchar(200) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'0',
  `titulo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temario`
--

CREATE TABLE `temario` (
  `idtemario` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `asignatura` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `temario`
--

INSERT INTO `temario` (`idtemario`, `nombre`, `asignatura`) VALUES
(1, 'Multiplicaciones', 1),
(2, 'Divisiones', 1),
(3, 'Suma y Resta', 1),
(4, 'Sintaxis', 2),
(5, 'Acentuacion', 2),
(6, 'Hardware', 5),
(7, 'Relieve', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` smallint(5) UNSIGNED NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `f_alta` datetime NOT NULL,
  `tipo` char(1) NOT NULL DEFAULT 'b'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usuario`, `email`, `pass`, `f_alta`, `tipo`) VALUES
(1, 'Admin', 'admin@mind.net', '$2y$10$FPLmzlQxv0UKKhxJzIGI1.e5H4.9BD9MEjrgRqmHXNw0r/usWwBSa', '2021-11-16 13:09:05', 'a'),
(21, 'Mmerino', 'mmerino@evg.es', '$2y$10$fOJ7zhYn5nw4Su0QgyaR9uTJX0qRS5uh0j2DquIrynixHUyLttqQW', '2021-11-16 16:55:52', 'p'),
(20, 'Imuñoz', 'imunoz@evg.es', '$2y$10$fOJ7zhYn5nw4Su0QgyaR9uTJX0qRS5uh0j2DquIrynixHUyLttqQW', '2021-11-16 17:06:16', 'p'),
(11, 'Sdelgado', 'sdelgado@gmail.com', '$2y$10$FVjvKYSBRu7kVs1sJO8hqObA3t6zdjqYxbWI9ogBCqyVmLVEX2jri', '2021-11-16 18:20:19', 'b'),
(10, 'Damanre', 'damanre.dmr@gmail.com', '$2y$10$eUXK4hMHVGN05Bk6fu84EuxSY.Cl6Bd1W7iGTByBQwULaIB1DcR7i', '2021-11-24 20:39:22', 'g'),
(12, 'Mbroncano', 'mbroncano@gmail.com', '$2y$10$f7PG8o2emMLeuC8uV7mM4OG8ijJpIXfscVsPpZt/U15liaE42iUza', '2021-11-24 20:51:58', 'b');


--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`idasignatura`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`idmensaje`),
  ADD KEY `chatreunion_reunionidreunion` (`reunion`),
  ADD KEY `chatusuario_usuarioidusuario` (`usuario`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `reunion`
--
ALTER TABLE `reunion`
  ADD PRIMARY KEY (`idreunion`),
  ADD KEY `reunionanfitrion_usuarioidusuario` (`anfitrion`),
  ADD KEY `reunionparticipante_usuarioidusuario` (`participante`),
  ADD KEY `reuniontemario_temarioidtemario` (`temario`);

--
-- Indices de la tabla `solicitud_pro`
--
ALTER TABLE `solicitud_pro`
  ADD PRIMARY KEY (`idsolpro`),
  ADD KEY `solicitud_prousuario_alumnoidusuario` (`usuario`);

--
-- Indices de la tabla `temario`
--
ALTER TABLE `temario`
  ADD PRIMARY KEY (`idtemario`),
  ADD KEY `temarioasignatura_asignaturaidasignatura` (`asignatura`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `idasignatura` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `idmensaje` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reunion`
--
ALTER TABLE `reunion`
  MODIFY `idreunion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `solicitud_pro`
--
ALTER TABLE `solicitud_pro`
  MODIFY `idsolpro` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temario`
--
ALTER TABLE `temario`
  MODIFY `idtemario` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumnoidusuario_usuarioidusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `chatreunion_reunionidreunion` FOREIGN KEY (`reunion`) REFERENCES `reunion` (`idreunion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatusuario_usuarioidusuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `profesoridusuario_usuarioidusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reunion`
--
ALTER TABLE `reunion`
  ADD CONSTRAINT `reunionanfitrion_usuarioidusuario` FOREIGN KEY (`anfitrion`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reunionparticipante_usuarioidusuario` FOREIGN KEY (`participante`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reuniontemario_temarioidtemario` FOREIGN KEY (`temario`) REFERENCES `temario` (`idtemario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_pro`
--
ALTER TABLE `solicitud_pro`
  ADD CONSTRAINT `solicitud_prousuario_alumnoidusuario` FOREIGN KEY (`usuario`) REFERENCES `alumno` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `temario`
--
ALTER TABLE `temario`
  ADD CONSTRAINT `temarioasignatura_asignaturaidasignatura` FOREIGN KEY (`asignatura`) REFERENCES `asignatura` (`idasignatura`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
