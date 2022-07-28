-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2022 a las 18:35:51
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `pk_ciudad` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_postal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`pk_ciudad`, `nombre`, `estado`, `municipio`, `codigo_postal`) VALUES
(1, 'Paredones', 'Nayarit', 'Santiago Ixc', '63552'),
(2, 'Santiago Ixc', 'Nayarit', 'Santiago Ixc', '63000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `pk_comentario` int(11) NOT NULL,
  `contenido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`pk_comentario`, `contenido`) VALUES
(17, 'buen dia'),
(21, 'Disponible en nayarit ?'),
(22, 'De que tipo de arroz es amigo?'),
(23, 'Hola amigo está disponible para el estado de Jalis'),
(24, 'Esta disponible para el estado de Jalisco?'),
(25, 'Puede venderme la mitad?'),
(26, 'Puede venderme 500 kg solamente?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_publicacion`
--

CREATE TABLE `comentario_publicacion` (
  `pk_comentario_publicacion` int(11) NOT NULL,
  `fk_publicacion` int(11) NOT NULL,
  `fk_persona` int(11) NOT NULL,
  `fk_comentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comentario_publicacion`
--

INSERT INTO `comentario_publicacion` (`pk_comentario_publicacion`, `fk_publicacion`, `fk_persona`, `fk_comentario`) VALUES
(1, 1, 1, 17),
(2, 3, 1, 21),
(3, 3, 1, 22),
(4, 1, 2, 24),
(5, 3, 2, 25),
(6, 1, 2, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `pk_factura` int(11) NOT NULL,
  `fecha_factura` date NOT NULL,
  `fk_producto` int(11) NOT NULL,
  `fk_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_persona`
--

CREATE TABLE `factura_persona` (
  `pk_factura_persona` int(11) NOT NULL,
  `fk_persona` int(11) NOT NULL,
  `fk_factura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `pk_persona` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apeelido_materno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrasena` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `ciudad` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_tipo_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`pk_persona`, `nombre`, `apellido_paterno`, `apeelido_materno`, `direccion`, `telefono`, `correo`, `contrasena`, `fecha_nacimiento`, `ciudad`, `fk_tipo_persona`) VALUES
(1, 'Aksel', 'herrera', 'gonzalez', 'veracruz', 2147483647, 'akselherrera18@gmail.com', 'aksel', '2022-04-10', '0', 2),
(2, 'Mario', 'Macias', 'Romero', 'Durango #4', 2147483647, 'mario@gmail.com', 'mario', '2014-05-12', '1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `pk_producto` int(11) NOT NULL,
  `nombre_producto` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`pk_producto`, `nombre_producto`, `descripcion`, `cantidad`, `precio`) VALUES
(1, 'Frijol', 'Frijol peruano de gama alta', 1500, 20),
(2, 'Arroz de grano largo', 'Arroz del tipo grano largo de calidad media', 40000, 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `pk_publicacion` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta_archivo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `estado` int(11) NOT NULL,
  `fk_persona` int(11) NOT NULL,
  `fk_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`pk_publicacion`, `titulo`, `descripcion`, `ruta_archivo`, `fecha_publicacion`, `estado`, `fk_persona`, `fk_producto`) VALUES
(1, 'Venta de frijol', '1500KG disponibles ', 'img/frijoles.jpg', '2022-07-24', 0, 1, 1),
(3, 'Venta de arroz calidad media', 'Varios kilos de arroz de grano largo disponibles p', 'img/arroz.jpg', '2022-07-28', 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_persona`
--

CREATE TABLE `tipo_persona` (
  `pk_tipo_persona` int(11) NOT NULL,
  `tipo_persona` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_persona`
--

INSERT INTO `tipo_persona` (`pk_tipo_persona`, `tipo_persona`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `pk_venta` int(11) NOT NULL,
  `fk_producto` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `fk_persona` int(11) NOT NULL,
  `comision` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`pk_venta`, `fk_producto`, `fecha_compra`, `fk_persona`, `comision`) VALUES
(10, 2, '2022-07-28', 2, '17600');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`pk_ciudad`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`pk_comentario`);

--
-- Indices de la tabla `comentario_publicacion`
--
ALTER TABLE `comentario_publicacion`
  ADD PRIMARY KEY (`pk_comentario_publicacion`),
  ADD KEY `fk_persona` (`fk_persona`),
  ADD KEY `fk_publicacion` (`fk_publicacion`),
  ADD KEY `fk_comentario` (`fk_comentario`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`pk_factura`),
  ADD KEY `fk_ciudad` (`fk_ciudad`),
  ADD KEY `fk_producto` (`fk_producto`);

--
-- Indices de la tabla `factura_persona`
--
ALTER TABLE `factura_persona`
  ADD PRIMARY KEY (`pk_factura_persona`),
  ADD KEY `fk_persona` (`fk_persona`),
  ADD KEY `fk_factura` (`fk_factura`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`pk_persona`),
  ADD KEY `fk_tipo_persona` (`fk_tipo_persona`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`pk_producto`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`pk_publicacion`),
  ADD KEY `fk_persona` (`fk_persona`);

--
-- Indices de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  ADD PRIMARY KEY (`pk_tipo_persona`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`pk_venta`),
  ADD KEY `fk_persona` (`fk_persona`),
  ADD KEY `fk_producto` (`fk_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `pk_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `pk_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `comentario_publicacion`
--
ALTER TABLE `comentario_publicacion`
  MODIFY `pk_comentario_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `pk_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_persona`
--
ALTER TABLE `factura_persona`
  MODIFY `pk_factura_persona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `pk_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `pk_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `pk_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  MODIFY `pk_tipo_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `pk_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario_publicacion`
--
ALTER TABLE `comentario_publicacion`
  ADD CONSTRAINT `comentario_publicacion_ibfk_1` FOREIGN KEY (`fk_persona`) REFERENCES `persona` (`pk_persona`),
  ADD CONSTRAINT `comentario_publicacion_ibfk_2` FOREIGN KEY (`fk_publicacion`) REFERENCES `publicacion` (`pk_publicacion`),
  ADD CONSTRAINT `comentario_publicacion_ibfk_3` FOREIGN KEY (`fk_comentario`) REFERENCES `comentario` (`pk_comentario`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`fk_ciudad`) REFERENCES `ciudad` (`pk_ciudad`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`fk_producto`) REFERENCES `producto` (`pk_producto`);

--
-- Filtros para la tabla `factura_persona`
--
ALTER TABLE `factura_persona`
  ADD CONSTRAINT `factura_persona_ibfk_1` FOREIGN KEY (`fk_persona`) REFERENCES `persona` (`pk_persona`),
  ADD CONSTRAINT `factura_persona_ibfk_2` FOREIGN KEY (`fk_factura`) REFERENCES `factura` (`pk_factura`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`fk_tipo_persona`) REFERENCES `tipo_persona` (`pk_tipo_persona`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `publicacion_ibfk_1` FOREIGN KEY (`fk_persona`) REFERENCES `persona` (`pk_persona`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`fk_persona`) REFERENCES `persona` (`pk_persona`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`fk_producto`) REFERENCES `producto` (`pk_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
