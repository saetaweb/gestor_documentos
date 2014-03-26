-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-03-2014 a las 14:13:33
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `portafolio_mimastin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `id_documento` int(10) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `archivo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_documento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `id_perfil`, `id_usuario`, `nombre`, `descripcion`, `tipo`, `archivo`) VALUES
(1, 1, 1, 'claymore', 'de lo mejor que he visto en anime.', 'texto txt', 'claymore_pdf.pdf'),
(3, 2, 4, 'agregado01', 'descripcion agregado 01 y listo', 'text/plain', 'agregado01.txt'),
(4, 2, 2, 'agregado02', 'esta es la descripcion de agregado 02 y listo listo', 'text/plain', 'agregado02.txt'),
(5, 1, 2, 'yaeditado', 'esta es la descripcion del archivo ya editado, suerte', 'text/plain', 'yaeditado.txt'),
(6, 1, 2, 'teresa y clare', 'teresa y clare editado fgsdfg', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'teresa y clare.docx'),
(7, 1, 3, 'nuevaofelia', 'descripcion nuevo ofelia para probar el nvo acampo usuario\\r\\nesto ya tiene edixion', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'nuevaofelia.docx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id_perfil` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `nombre`) VALUES
(1, 'administrador'),
(2, 'recurso humano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_perfil` int(10) unsigned NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `login` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `passwordjs` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `passwordjsphp` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_perfil`, `nombre`, `login`, `passwordjs`, `passwordjsphp`, `email`) VALUES
(1, 1, 'Elvis Martín Rozo', 'elvis', '827CCB0EEA8A706C4C34A16891F84E7B', 'cf7d4bdd2afbb023f0b265b3e99ba1f9', 'saetaweb@gmail.com'),
(2, 2, 'Alicia', 'pelusa', '827CCB0EEA8A706C4C34A16891F84E7B', 'cf7d4bdd2afbb023f0b265b3e99ba1f9', 'pilu@pilu.com'),
(3, 1, 'clare', 'miria', 'C20AD4D76FE97759AA27A0C99BFF6710', '5a4d32083e0bd086385a4d261fa77bc5', 'miria@miria.com'),
(4, 2, 'ofelia', 'myofelia', '386D467ED7D9DE3142E41A1458DCFE94', '1e353ba47b6358b4ddf49fa0c9e7f4c1', 'ofelia@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
