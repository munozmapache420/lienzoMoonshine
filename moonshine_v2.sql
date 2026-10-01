-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2026 a las 00:55:54
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
-- Base de datos: `moonshine_v2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `precio`) VALUES
(1, 'Tés e Infusiones', 'Tés e infusiones de hierbas 100% naturales', 9000.00),
(2, 'Miel y Derivados', 'Miel de abejas y productos de la colmena', 24000.00),
(3, 'Aceites Naturales', 'Aceites vegetales prensados en frío', 28000.00),
(4, 'Suplementos Naturales', 'Superalimentos y suplementos a base de plantas', 24000.00),
(5, 'Cosmética Natural', 'Jabones, cremas y bálsamos sin químicos agresivos', 11000.00),
(6, 'Frutos Secos y Semillas', 'Almendras, semillas y granos naturales sin procesar', 17000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `registro_unico` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `telefono`, `direccion`, `registro_unico`) VALUES
(1, 'Cliente Genérico', '3000000000', 'Sin dirección', 'CLI-0001'),
(2, 'Laura Martínez', '3104567890', 'Cra 15 # 82-45, Bogotá', 'CLI-0002'),
(3, 'Carlos Rodríguez', '3157894561', 'Calle 50 # 23-10, Medellín', 'CLI-0003'),
(4, 'Andrea Torres', '3209871234', 'Av. 6N # 28-15, Cali', 'CLI-0004'),
(5, 'Juan Pérez', '3011234567', 'Cra 7 # 45-20, Bogotá', 'CLI-0005');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precio_unitario` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha_registro` date NOT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `venta_id`, `producto_id`, `cantidad`, `precio_unitario`, `fecha_registro`, `subtotal`) VALUES
(1, 1, 1, 2, 10500.00, '2026-09-01', 21000.00),
(2, 1, 4, 1, 28000.00, '2026-09-01', 28000.00),
(3, 2, 7, 1, 35000.00, '2026-09-03', 35000.00),
(4, 2, 10, 2, 27000.00, '2026-09-03', 54000.00),
(5, 3, 13, 3, 7000.00, '2026-09-05', 21000.00),
(6, 3, 15, 2, 6500.00, '2026-09-05', 13000.00),
(7, 4, 17, 2, 15000.00, '2026-09-10', 30000.00),
(8, 4, 16, 1, 19000.00, '2026-09-10', 19000.00),
(9, 4, 2, 3, 8000.00, '2026-09-10', 24000.00),
(10, 5, 14, 1, 19000.00, '2026-09-15', 19000.00),
(11, 5, 9, 1, 16000.00, '2026-09-15', 16000.00),
(12, 6, 11, 2, 23000.00, '2026-09-18', 46000.00),
(13, 6, 6, 1, 20000.00, '2026-09-18', 20000.00),
(14, 7, 8, 2, 32000.00, '2026-09-22', 64000.00),
(15, 7, 3, 2, 9500.00, '2026-09-22', 19000.00),
(16, 8, 5, 1, 24000.00, '2026-09-25', 24000.00),
(17, 8, 18, 2, 12000.00, '2026-09-25', 24000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_compra`
--

CREATE TABLE `historial_compra` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `total_compra` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial_compra`
--

INSERT INTO `historial_compra` (`id`, `cliente_id`, `fecha_registro`, `total_compra`) VALUES
(1, 2, '2026-09-01', 49000.00),
(2, 3, '2026-09-03', 89000.00),
(3, 4, '2026-09-10', 73000.00),
(4, 2, '2026-09-15', 35000.00),
(5, 3, '2026-09-22', 83000.00),
(6, 4, '2026-09-25', 48000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_compra_venta`
--

CREATE TABLE `historial_compra_venta` (
  `id` int(11) NOT NULL,
  `historial_compra_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial_compra_venta`
--

INSERT INTO `historial_compra_venta` (`id`, `historial_compra_id`, `venta_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 4),
(4, 4, 5),
(5, 5, 7),
(6, 6, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT 'entrada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `fecha_actualizacion`, `tipo`) VALUES
(1, '2026-08-25', 'entrada'),
(2, '2026-08-25', 'entrada'),
(3, '2026-08-26', 'entrada'),
(4, '2026-08-26', 'entrada'),
(5, '2026-08-27', 'entrada'),
(6, '2026-08-27', 'entrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `tipo` enum('Efectivo','Transferencia','Tarjeta') NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`id`, `venta_id`, `tipo`, `total`, `fecha`) VALUES
(1, 1, 'Efectivo', 49000.00, '2026-09-01'),
(2, 2, 'Tarjeta', 89000.00, '2026-09-03'),
(3, 3, 'Efectivo', 34000.00, '2026-09-05'),
(4, 4, 'Transferencia', 73000.00, '2026-09-10'),
(5, 5, 'Tarjeta', 35000.00, '2026-09-15'),
(6, 6, 'Transferencia', 66000.00, '2026-09-18'),
(7, 7, 'Efectivo', 83000.00, '2026-09-22'),
(8, 8, 'Tarjeta', 48000.00, '2026-09-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `id_inventario` int(11) DEFAULT NULL,
  `stock_minimo` int(11) NOT NULL DEFAULT 0,
  `estado` varchar(30) NOT NULL DEFAULT 'activo',
  `precio_compra` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio_venta` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `categoria_id`, `id_inventario`, `stock_minimo`, `estado`, `precio_compra`, `precio_venta`, `stock`) VALUES
(1, 'Té Verde Orgánico x20 sobres', 'Té verde orgánico rico en antioxidantes', 1, 1, 10, 'activo', 6000.00, 10500.00, 58),
(2, 'Infusión de Manzanilla x20 sobres', 'Manzanilla natural, relajante y digestiva', 1, 1, 10, 'activo', 4500.00, 8000.00, 77),
(3, 'Té de Jengibre y Limón x20 sobres', 'Infusión cítrica y picante, sin azúcar añadida', 1, 1, 10, 'activo', 5500.00, 9500.00, 48),
(4, 'Miel de Abejas Pura 500 g', 'Miel 100% pura, sin aditivos ni jarabes', 2, 2, 8, 'activo', 18000.00, 28000.00, 39),
(5, 'Polen de Abeja 250 g', 'Polen natural multifloral', 2, 2, 5, 'activo', 15000.00, 24000.00, 24),
(6, 'Propóleo en Gotas 30 ml', 'Extracto de propóleo para reforzar defensas', 2, 2, 5, 'activo', 12000.00, 20000.00, 30),
(7, 'Aceite de Coco Virgen 500 ml', 'Prensado en frío, uso culinario y cosmético', 3, 3, 6, 'activo', 22000.00, 35000.00, 34),
(8, 'Aceite de Oliva Extra Virgen 500 ml', 'Primera prensada en frío', 3, 3, 6, 'activo', 20000.00, 32000.00, 28),
(9, 'Aceite de Almendras Dulces 100 ml', 'Hidratante natural para piel y cabello', 3, 3, 5, 'activo', 9000.00, 16000.00, 19),
(10, 'Spirulina en Polvo 100 g', 'Superalimento rico en proteína vegetal', 4, 4, 5, 'activo', 16000.00, 27000.00, 23),
(11, 'Cúrcuma en Cápsulas x60', 'Cúrcuma con pimienta negra para mejor absorción', 4, 4, 6, 'activo', 14000.00, 23000.00, 30),
(12, 'Moringa en Polvo 200 g', 'Hoja de moringa deshidratada y molida', 4, 4, 5, 'activo', 13000.00, 22000.00, 4),
(13, 'Jabón de Avena y Miel', 'Jabón artesanal exfoliante suave', 5, 5, 10, 'activo', 3500.00, 7000.00, 67),
(14, 'Crema Facial de Aloe Vera 60 g', 'Hidratante facial con aloe vera orgánico', 5, 5, 6, 'activo', 11000.00, 19000.00, 27),
(15, 'Bálsamo Labial de Caléndula', 'Bálsamo con cera de abeja y caléndula', 5, 5, 10, 'activo', 3000.00, 6500.00, 88),
(16, 'Almendras Naturales 250 g', 'Almendras sin sal, sin tostar', 6, 6, 8, 'activo', 12000.00, 19000.00, 44),
(17, 'Semillas de Chía 500 g', 'Chía negra rica en omega 3', 6, 6, 8, 'activo', 9000.00, 15000.00, 53),
(18, 'Linaza Molida 500 g', 'Linaza dorada molida, fuente de fibra', 6, 6, 8, 'activo', 7000.00, 12000.00, 38),
(19, 'Nueces del Brasil 200 g', 'Producto sin existencias, temporalmente inactivo', 6, 6, 5, 'inactivo', 15000.00, 24000.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'administrador'),
(2, 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cargo` varchar(60) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `rol_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `cargo`, `activo`, `rol_id`) VALUES
(1, 'Huber Useche', 'huber@moonshine.com', 'admin123', 'Administrador', 1, 1),
(2, 'Vendedor Uno', 'vendedor1@moonshine.com', 'venta123', 'Vendedor', 1, 2),
(3, 'María Fernanda Gómez', 'maria@moonshine.com', 'venta456', 'Vendedora', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `anulada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `cliente_id`, `usuario_id`, `fecha`, `total`, `anulada`) VALUES
(1, 2, 2, '2026-09-01', 49000.00, 0),
(2, 3, 3, '2026-09-03', 89000.00, 0),
(3, NULL, 2, '2026-09-05', 34000.00, 0),
(4, 4, 1, '2026-09-10', 73000.00, 0),
(5, 2, 3, '2026-09-15', 35000.00, 0),
(6, 5, 2, '2026-09-18', 66000.00, 1),
(7, 3, 2, '2026-09-22', 83000.00, 0),
(8, 4, 3, '2026-09-25', 48000.00, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registro_unico` (`registro_unico`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_detalle_venta` (`venta_id`),
  ADD KEY `idx_detalle_producto` (`producto_id`);

--
-- Indices de la tabla `historial_compra`
--
ALTER TABLE `historial_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_historial_cliente` (`cliente_id`);

--
-- Indices de la tabla `historial_compra_venta`
--
ALTER TABLE `historial_compra_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_hcv_historial` (`historial_compra_id`),
  ADD KEY `idx_hcv_venta` (`venta_id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_metodopago_venta` (`venta_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_producto_categoria` (`categoria_id`),
  ADD KEY `idx_producto_inventario` (`id_inventario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_usuarios_rol` (`rol_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_venta_cliente` (`cliente_id`),
  ADD KEY `idx_venta_usuario` (`usuario_id`),
  ADD KEY `idx_venta_fecha` (`fecha`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `historial_compra`
--
ALTER TABLE `historial_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historial_compra_venta`
--
ALTER TABLE `historial_compra_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalleventa_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalleventa_venta` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_compra`
--
ALTER TABLE `historial_compra`
  ADD CONSTRAINT `fk_historialcompra_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_compra_venta`
--
ALTER TABLE `historial_compra_venta`
  ADD CONSTRAINT `fk_hcv_historial` FOREIGN KEY (`historial_compra_id`) REFERENCES `historial_compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hcv_venta` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD CONSTRAINT `fk_metodopago_venta` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_inventario` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_rol` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_venta_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
