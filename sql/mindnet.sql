--
-- Base de datos: mindnet
--

DROP DATABASE IF EXISTS mindnet;
CREATE DATABASE IF NOT EXISTS mindnet DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE mindnet;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla usuario
--

CREATE TABLE usuario (
                         idusuario smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         usuario varchar(50) NOT NULL,
                         email varchar(100) NOT NULL UNIQUE,
                         pass varchar(250) NOT NULL,
                         f_alta datetime NOT NULL,
                         tipo char(1) NOT NULL DEFAULT "b"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla alumno
--

CREATE TABLE alumno (
                        idusuario smallint UNSIGNED NOT NULL PRIMARY KEY,
                        premium bit NOT NULL DEFAULT 0,
                        nombre varchar(50) NOT NULL,
                        apellidos varchar(50) NOT NULL,
                        f_nac date NOT NULL,
                        sexo bit NOT NULL,
                        dni char(9) NOT NULL UNIQUE,
                        buscando bit NOT NULL DEFAULT 0,
                        CONSTRAINT alumnoidusuario_usuarioidusuario FOREIGN KEY (idusuario) REFERENCES usuario (idusuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla solicitud_pro
--

CREATE TABLE solicitud_pro (
                               idsolpro smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                               usuario smallint(5) UNSIGNED NOT NULL,
                               fecha date NOT NULL,
                               doc varchar(200) NOT NULL,
                               estado bit NOT NULL  DEFAULT 0,
                               titulo varchar(100) NOT NULL,
                               CONSTRAINT solicitud_prousuario_alumnoidusuario FOREIGN KEY (usuario) REFERENCES alumno (idusuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla asignatura
--

CREATE TABLE asignatura (
                            idasignatura tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            nombre varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla temario
--

CREATE TABLE temario (
                         idtemario tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         nombre varchar(50) NOT NULL,
                         asignatura tinyint(3) UNSIGNED NOT NULL,
                         sobretemario tinyint(3) UNSIGNED NOT NULL,
                         CONSTRAINT idtemariotemario_sobretemariotemario FOREIGN KEY (sobretemario) REFERENCES temario (idtemario) ON DELETE CASCADE ON UPDATE CASCADE,
                         CONSTRAINT temarioasignatura_asignaturaidasignatura FOREIGN KEY (asignatura) REFERENCES asignatura (idasignatura) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla reunion
--

CREATE TABLE reunion (
                         idreunion int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         fecha date NOT NULL,
                         anfitrion smallint(5) UNSIGNED NOT NULL,
                         participante smallint(5) UNSIGNED NOT NULL,
                         temario tinyint(3) UNSIGNED NOT NULL,
                         CONSTRAINT reunionanfitrion_usuarioidusuario FOREIGN KEY (anfitrion) REFERENCES usuario (idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
                         CONSTRAINT reunionparticipante_usuarioidusuario FOREIGN KEY (participante) REFERENCES usuario (idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
                         CONSTRAINT reuniontemario_temarioidtemario FOREIGN KEY (temario) REFERENCES temario (idtemario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla mensaje
--

CREATE TABLE mensaje (
                         idmensaje int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         reunion int(10) UNSIGNED NOT NULL,
                         texto varchar(250) NOT NULL,
                         usuario bit NOT NULL,
                         fecha date NOT NULL,
                         CONSTRAINT chatreunion_reunionidreunion FOREIGN KEY (reunion) REFERENCES reunion (idreunion) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla profesor
--

CREATE TABLE profesor (
                          idusuario smallint(5) UNSIGNED NOT NULL PRIMARY KEY,
                          certificado varchar(200) NOT NULL,
                          nombre varchar(50) NOT NULL,
                          apellidos varchar(50) NOT NULL,
                          f_nac date NOT NULL,
                          sexo bit NOT NULL,
                          dni char(9) NOT NULL UNIQUE,
                          buscando bit NOT NULL DEFAULT 0,
                          CONSTRAINT profesoridusuario_usuarioidusuario FOREIGN KEY (idusuario) REFERENCES usuario (idusuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
