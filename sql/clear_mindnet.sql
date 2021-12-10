--
-- Dario Manzanedo Reja
-- Base de datos: user2daw_BD1-23
--
USE `user2daw_BD1-23`;



--
-- Estructura de tabla para la tabla alumno
--

CREATE TABLE alumno (
  idusuario smallint(5) UNSIGNED PRIMARY KEY NOT NULL,
  premium bit(1) NOT NULL DEFAULT b'0',
  nombre varchar(50) NOT NULL,
  apellidos varchar(50) NOT NULL,
  f_nac date NOT NULL,
  sexo CHAR(1) NOT NULL,
  dni char(9) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla asignatura
--

CREATE TABLE asignatura (
  idasignatura tinyint(3) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre varchar(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla mensaje
--

CREATE TABLE mensaje (
  idmensaje int(10) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  reunion int(10) UNSIGNED NOT NULL,
  texto varchar(250) NOT NULL,
  usuario smallint(5) UNSIGNED NOT NULL,
  fecha datetime NOT NULL DEFAULT NOW()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla profesor
--

CREATE TABLE profesor (
  idusuario smallint(5) UNSIGNED PRIMARY KEY NOT NULL,
  certificado varchar(200) NOT NULL,
  nombre varchar(50) NOT NULL,
  apellidos varchar(50) NOT NULL,
  f_nac date NOT NULL,
  sexo char(1) NOT NULL,
  dni char(9) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla reunion
--

CREATE TABLE reunion (
  idreunion int(10) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  inicio datetime NOT NULL,
  fin datetime DEFAULT NULL,
  anfitrion smallint(5) UNSIGNED NOT NULL,
  participante smallint(5) UNSIGNED DEFAULT NULL,
  temario tinyint(3) UNSIGNED NOT NULL,
  activa bit(1) NOT NULL DEFAULT b'1',
  seed char(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla solicitud_pro
--

CREATE TABLE solicitud_pro (
  idsolpro smallint(5) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  usuario smallint(5) UNSIGNED NOT NULL,
  fecha date NOT NULL,
  doc varchar(200) NOT NULL,
  estado bit(1) NOT NULL DEFAULT b'0',
  titulo varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla temario
--

CREATE TABLE temario (
  idtemario tinyint(3) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nombre varchar(50) NOT NULL UNIQUE,
  asignatura tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla usuario
--

CREATE TABLE usuario (
  idusuario smallint(5) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  usuario varchar(50) NOT NULL,
  email varchar(100) NOT NULL UNIQUE,
  pass varchar(250) NOT NULL,
  f_alta datetime NOT NULL,
  tipo char(1) NOT NULL DEFAULT 'b'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Indices de la tabla mensaje
--
ALTER TABLE mensaje
  ADD KEY chatreunion_reunionidreunion (reunion),
  ADD KEY chatusuario_usuarioidusuario (usuario);


--
-- Indices de la tabla reunion
--
ALTER TABLE reunion
  ADD KEY reunionanfitrion_usuarioidusuario (anfitrion),
  ADD KEY reunionparticipante_usuarioidusuario (participante),
  ADD KEY reuniontemario_temarioidtemario (temario);

--
-- Indices de la tabla solicitud_pro
--
ALTER TABLE solicitud_pro
  ADD KEY solicitud_prousuario_alumnoidusuario (usuario);

--
-- Indices de la tabla temario
--
ALTER TABLE temario
  ADD KEY temarioasignatura_asignaturaidasignatura (asignatura);


--
-- Filtros para la tabla alumno
--
ALTER TABLE alumno
  ADD CONSTRAINT alumnoidusuario_usuarioidusuario FOREIGN KEY (idusuario) REFERENCES usuario (idusuario) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla mensaje
--
ALTER TABLE mensaje
  ADD CONSTRAINT chatreunion_reunionidreunion FOREIGN KEY (reunion) REFERENCES reunion (idreunion) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT chatusuario_usuarioidusuario FOREIGN KEY (usuario) REFERENCES usuario (idusuario) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla profesor
--
ALTER TABLE profesor
  ADD CONSTRAINT profesoridusuario_usuarioidusuario FOREIGN KEY (idusuario) REFERENCES usuario (idusuario) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla reunion
--
ALTER TABLE reunion
  ADD CONSTRAINT reunionanfitrion_usuarioidusuario FOREIGN KEY (anfitrion) REFERENCES usuario (idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT reunionparticipante_usuarioidusuario FOREIGN KEY (participante) REFERENCES usuario (idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT reuniontemario_temarioidtemario FOREIGN KEY (temario) REFERENCES temario (idtemario) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla solicitud_pro
--
ALTER TABLE solicitud_pro
  ADD CONSTRAINT solicitud_prousuario_alumnoidusuario FOREIGN KEY (usuario) REFERENCES alumno (idusuario) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla temario
--
ALTER TABLE temario
  ADD CONSTRAINT temarioasignatura_asignaturaidasignatura FOREIGN KEY (asignatura) REFERENCES asignatura (idasignatura) ON DELETE CASCADE ON UPDATE CASCADE;

