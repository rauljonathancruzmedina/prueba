-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2023 a las 00:39:42
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `i_articulo` (IN `sku_` INT(6), IN `articulo_` VARCHAR(15), IN `marca_` VARCHAR(15), IN `modelo_` VARCHAR(20), IN `depar_` INT(1), IN `clase_` INT(2), IN `familia_` INT(3), IN `fec_alta_` CHAR(10), IN `stock_` INT(9), IN `cantidad_` INT(9), IN `descont_` SMALLINT(1), IN `fec_baja_` CHAR(10))  BEGIN
    Insert into articulo (sku,articulo,marca,modelo,depar,clase,familia,fec_alta,stock,cantidad,descont,fec_baja) 					   values(sku_,articulo_,marca_,modelo_,depar_,clase_,familia_,fec_alta_,stock_,cantidad_,descont_,fec_baja_);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `s_articulo_p` (IN `_sku` INT)  begin
    select * from articulo where sku = _sku;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `u_articulo` (IN `sku_` INT, IN `articulo_` VARCHAR(15), IN `marca_` VARCHAR(15), IN `modelo_` VARCHAR(20), IN `depar_` INT(1), IN `clase_` INT(2), IN `familia_` INT(3), IN `fec_alta_` CHAR(10), IN `stock_` INT(9), IN `cantidad_` INT(9), IN `descont_` SMALLINT(1), IN `fec_baja_` CHAR(10))  BEGIN
    Update articulo 
       set articulo=articulo_,marca=marca_,modelo=modelo_,depar=depar_,clase=clase_,
       		familia=familia_,fec_alta=fec_alta_,stock=stock_,cantidad=cantidad_,
            descont=descont_,fec_baja=fec_baja_
    where sku=sku_;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `sku` int(6) NOT NULL,
  `articulo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `depar` int(1) NOT NULL,
  `clase` int(2) NOT NULL,
  `familia` int(3) NOT NULL,
  `fec_alta` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(9) NOT NULL,
  `cantidad` int(9) NOT NULL,
  `descont` smallint(1) NOT NULL,
  `fec_baja` char(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`sku`, `articulo`, `marca`, `modelo`, `depar`, `clase`, `familia`, `fec_alta`, `stock`, `cantidad`, `descont`, `fec_baja`) VALUES
(456789, 'LAPTOP', 'SAMSUMG', 'ALS12', 3, 8, 28, '2023-05-01', 100, 90, 0, '2023-05-30'),
(123456, 'TELEVISOR', 'SAMSUMG', 'ALS12', 1, 3, 1, '2023-05-01', 50, 5, 0, '2023-05-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `n_clase` smallint(6) NOT NULL,
  `nombre_clase` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `n_depa` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`n_clase`, `nombre_clase`, `n_depa`) VALUES
(1, 'COMESTIBLES', 1),
(2, 'LICUADORA', 1),
(3, 'BATIDORAS', 1),
(4, 'CAFETERAS', 1),
(5, 'AMPLIFICADORES CAR AUDIO', 2),
(6, 'AUTO STEREOS', 2),
(7, 'COLCHON', 3),
(8, 'JUEGO BOX', 3),
(9, 'SALAS', 4),
(10, 'COMPLEMENTOS PARA SALA', 4),
(11, 'SOFAS CAMA', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `n_depa` int(1) NOT NULL,
  `nombre_depa` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`n_depa`, `nombre_depa`) VALUES
(1, 'DOMESTICOS'),
(2, 'ELECTRONICA'),
(3, 'MUEBLE SUELTO'),
(4, 'SALAS, RECAMARAS, COMEDORES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `n_familia` smallint(6) NOT NULL,
  `nom_familia` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `n_clase` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`n_familia`, `nom_familia`, `n_clase`) VALUES
(1, 'SIN NOMBRE', 1),
(2, 'LICUADORAS', 2),
(3, 'BATIDORA MANUAL', 3),
(4, 'PROCESADOR', 3),
(5, 'PICADORA', 3),
(6, 'BATIDORA PEDESTAL', 3),
(7, 'BATIDORA FUENTE DE SOL', 3),
(8, 'MULTIPRACTICOS', 3),
(9, 'CAFETERAS', 4),
(10, 'PERCOLADORAS', 4),
(11, 'AMPLIFICADOR/RECEPTOR', 5),
(12, 'KIT DE INSTALACION', 5),
(13, 'AMPLIFICADOR COPPEL', 5),
(14, 'AUTOESTEREO CD C/BOCINA', 6),
(15, 'ACCESORIOS CAR AUDIO', 6),
(16, 'AMPLIFICADOR', 6),
(17, 'ALARMA AUTO/CASA/OFICINA', 6),
(18, 'SIN MECANISMO', 6),
(19, 'CON CD', 6),
(20, 'MULTIMEDIA', 6),
(21, 'PAQUETE SIN MECANISMO', 6),
(22, 'PAQUETE CON CD', 6),
(23, 'PILLOW TOP KS', 7),
(24, 'PILLOW TOP DOBLE KS', 7),
(25, 'HULE ESPUMA KS', 7),
(26, 'ESTANDAR INDIVIDUAL', 8),
(27, 'ESQUINERAS SUPERIORES', 8),
(28, 'TIPO L SECCIONAL', 8),
(26, 'SILLON OCACIONAL', 10),
(27, 'PUFF', 10),
(28, 'BAUL', 10),
(29, 'TABURETE', 10),
(26, 'SOFA CAMA TAPIZADO', 11),
(27, 'SOFA CAMA CLASICO', 11),
(28, 'ESTUDIO', 11);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD KEY `departamento` (`depar`,`clase`,`familia`),
  ADD KEY `sku` (`sku`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD KEY `n_departamento` (`n_depa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
