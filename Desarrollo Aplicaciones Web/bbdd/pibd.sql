-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2021 a las 21:05:39
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
-- Base de datos: `pibd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `IdAlbum` int(11) NOT NULL,
  `Titulo` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`IdAlbum`, `Titulo`, `Descripcion`, `Usuario`) VALUES
(1, 'Marbella', 'U que bonito Marbella', 1),
(7, 'Los preciosos años 20', 'Mira que bonico el album', 1),
(8, 'Adidas Superstar', 'watgfgaegrga', 1),
(10, 'AlbumAntonio', 'Mira que guapo', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `IdEstilo` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Fichero` text NOT NULL COMMENT 'contiene el nombre y quizás la ruta del fichero que almacena la hoja de estilo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`IdEstilo`, `Nombre`, `Descripcion`, `Fichero`) VALUES
(1, 'Dark', 'U el estilo oscurito', '\'../CSS/dark.css\''),
(2, 'AltoContraste', 'Estilo alta contraste como su nombre indica.', '\'../CSS/altoContraste.css\''),
(3, 'Accesible', 'estilo accesible nen', '\'../CSS/accesible.css\''),
(4, 'Letra Grande', 'UN ESTILAZO', '\'../CSS/letraGrande.css\''),
(5, 'Predeterminado', 'Estilo por defecto', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `IdFoto` int(11) NOT NULL,
  `Titulo` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Fecha` date DEFAULT NULL COMMENT 'fecha en la que fue tomada la foto',
  `Pais` int(11) DEFAULT NULL COMMENT ' país en el que se tomo la foto',
  `Album` int(11) NOT NULL,
  `Fichero` text NOT NULL COMMENT ' contiene el nombre y quizás la ruta del fichero que almacena la foto',
  `Alternativo` text NOT NULL COMMENT 'texto alternativo\r\npara ser empleado con el atributo alt de HTML',
  `FRegistro` datetime NOT NULL COMMENT ' fecha de registro en el sistema de la foto, se emplea para\r\nmostrar las últimas cinco fotos subidas en la página principal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`IdFoto`, `Titulo`, `Descripcion`, `Fecha`, `Pais`, `Album`, `Fichero`, `Alternativo`, `FRegistro`) VALUES
(1, 'Fiordos', 'U que bonitos los Fiordos', '2021-11-02', 1, 1, '\'../img/paisaje.jpg\'', 'Una bonita foto para una bonita persona, tu.', '2021-11-24 12:09:27'),
(2, 'Bosque', 'U que bonitos los bosques', '2021-11-02', 1, 1, '\'../img/paisaje3.jpg\'', 'Una bonita foto para una bonita persona, yo.', '2021-11-24 12:09:27'),
(3, 'Hielo', 'Mucho hielo', '2021-11-02', 2, 1, '\'../img/paisaje4.jpg\'', 'Una bonita foto para una bonita persona, ella.', '2021-11-24 12:09:27'),
(5, 'Desierto', 'U que bonitos los desiertos', '2021-11-02', 1, 1, '\'../img/paisaje5.jpg\'', 'Una bonita foto para una bonita persona, el.', '2021-11-24 12:09:27'),
(25, 'Fotito', 'Esta fotito to guapa', '2021-12-25', 2, 10, '\'../img/lupa.jpg\'', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2021-12-16 19:15:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `IdPais` int(11) NOT NULL,
  `NomPais` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`IdPais`, `NomPais`) VALUES
(1, 'Andorra'),
(2, 'España'),
(3, 'Francia'),
(4, 'Portugal'),
(5, 'Afganistan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `IdSolicitud` int(11) NOT NULL,
  `Album` int(11) NOT NULL,
  `Nombre` text NOT NULL COMMENT ' también puede ser dos campos separados (nombre,\r\napellidos)',
  `Titulo` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Email` text NOT NULL,
  `Direccion` text NOT NULL COMMENT '; también puede ser campos serados con la estructura típica (calle, número, piso, puerta,\r\ncódigo postal, localidad, provincia y país)',
  `Color` text NOT NULL,
  `Copias` int(11) NOT NULL,
  `Resolucion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `IColor` tinyint(1) NOT NULL,
  `FRegistro` datetime NOT NULL COMMENT 'fecha de registro en el sistema de la solicitud',
  `Coste` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`IdSolicitud`, `Album`, `Nombre`, `Titulo`, `Descripcion`, `Email`, `Direccion`, `Color`, `Copias`, `Resolucion`, `Fecha`, `IColor`, `FRegistro`, `Coste`) VALUES
(3, 1, 'Juan Alberto', 'Album de prueba', 'Vamoh a probar a ver si funciona esta vaina', 'pepe@gmail.com', 'calle del pene,2,03005,Novelda,Alicante,España,666666666', '#df1111', 11, 450, '2021-12-04', 1, '0000-00-00 00:00:00', 1.65);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `NomUsuario` text NOT NULL,
  `Clave` text NOT NULL,
  `Email` text NOT NULL,
  `Sexo` smallint(6) NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` text NOT NULL,
  `Pais` int(11) NOT NULL,
  `Foto` text NOT NULL,
  `FRegistro` datetime NOT NULL,
  `Estilo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`, `Estilo`) VALUES
(1, 'JoseLu', '1234', 'pepe@gmail.com', 1, '1964-11-11', 'Novelda', 1, '../img/perfil1.jpg', '2021-11-24 11:59:16', 2),
(27, 'Juan Antonio', 'afc677037be3d92324fa6597d6c1506b534e306b', 'juanAntonio@gmail.com', 0, '0000-00-00', 'Novelda', 5, '../img/ABP.jpg', '0000-00-00 00:00:00', 1),
(31, 'Juan', 'afc677037be3d92324fa6597d6c1506b534e306b', 'pabloguillengarcia2@gmail-.com', 0, '0000-00-00', 'Novelda', 1, '../perfiles/edpb.png', '0000-00-00 00:00:00', 1),
(33, 'Herme', 'afc677037be3d92324fa6597d6c1506b534e306b', 'herme@gmail.com', 0, '0000-00-00', 'Valencia', 3, '../perfiles/BD.png', '0000-00-00 00:00:00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`IdAlbum`),
  ADD KEY `ClaveAjenaUsuario` (`Usuario`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`IdEstilo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`IdFoto`),
  ADD KEY `ClaveAjenaPaisF` (`Pais`),
  ADD KEY `ClaveAjenaAlbumF` (`Album`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`IdPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`IdSolicitud`),
  ADD KEY `ClaveAjenaAlbum` (`Album`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `NomUsuario` (`NomUsuario`) USING HASH,
  ADD KEY `ClaveAjenaPais` (`Pais`),
  ADD KEY `ClaveAjenaEstilos` (`Estilo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `IdAlbum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `IdEstilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `IdFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD CONSTRAINT `ClaveAjenaUsuario` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `ClaveAjenaAlbumF` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`) ON DELETE CASCADE,
  ADD CONSTRAINT `ClaveAjenaPaisF` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `ClaveAjenaAlbum` FOREIGN KEY (`Album`) REFERENCES `albumes` (`IdAlbum`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `ClaveAjenaEstilos` FOREIGN KEY (`Estilo`) REFERENCES `estilos` (`IdEstilo`),
  ADD CONSTRAINT `ClaveAjenaPais` FOREIGN KEY (`Pais`) REFERENCES `paises` (`IdPais`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
