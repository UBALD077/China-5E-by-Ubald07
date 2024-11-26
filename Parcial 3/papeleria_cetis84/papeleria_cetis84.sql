-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2024 a las 18:20:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `papeleria_cetis84`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `ID_DETALLE` int(11) NOT NULL,
  `ID_VENTA` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `PRECIO_UNITARIO` decimal(10,2) NOT NULL,
  `SUBTOTAL` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_PRODUCTO` int(11) NOT NULL,
  `NOMBRE_PRODUCTO` varchar(100) NOT NULL,
  `DESCRIPCION` text DEFAULT NULL,
  `PRECIO` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_PRODUCTO`, `NOMBRE_PRODUCTO`, `DESCRIPCION`, `PRECIO`) VALUES
(1, 'Lapiz', 'Afilida punta y mas duracion', 20.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `USUARIO` varchar(50) NOT NULL,
  `CONTRASENA` varchar(255) NOT NULL,
  `ROL` enum('admin','vendedor') NOT NULL,
  `FECHA_CREACION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOMBRE`, `USUARIO`, `CONTRASENA`, `ROL`, `FECHA_CREACION`) VALUES
(6, 'Rangel Durán', 'Rengel', '123', 'admin', '2024-10-30 19:35:26'),
(7, 'Ubaldo Torres', 'Ubaldo', 'lepe', 'vendedor', '2024-10-30 19:37:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID_VENTA` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `FECHA_VENTA` timestamp NOT NULL DEFAULT current_timestamp(),
  `TOTAL` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`ID_DETALLE`),
  ADD KEY `ID_VENTA` (`ID_VENTA`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_PRODUCTO`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `USUARIO` (`USUARIO`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_VENTA`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `ID_DETALLE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID_VENTA` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`ID_VENTA`) REFERENCES `ventas` (`ID_VENTA`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `productos` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
