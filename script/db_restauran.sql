-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2024 a las 16:42:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_restauran`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atendido`
--

CREATE TABLE `atendido` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `atendido`
--

INSERT INTO `atendido` (`id`, `estado`) VALUES
(1, 'atendido'),
(2, 'por atender'),
(3, 'anulado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(6) UNSIGNED ZEROFILL NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `estado` int(11) NOT NULL COMMENT 'A:activo,I:inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `descripcion`, `fecha`, `mes`, `anio`, `estado`) VALUES
(000003, 'CAJA01', '2024-08-13 19:42:15', 8, 2024, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriamenu`
--

CREATE TABLE `categoriamenu` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoriamenu`
--

INSERT INTO `categoriamenu` (`id_categoria`, `descripcion`) VALUES
(1, 'promo'),
(2, 'as');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaproducto`
--

CREATE TABLE `categoriaproducto` (
  `id_producto` int(11) NOT NULL,
  `descrip_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `dato_cliente` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `estado` varchar(20) NOT NULL COMMENT 'A:activo,I:inactivo,E:eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `tipo_boleta` varchar(50) NOT NULL,
  `numero_recibo` varchar(20) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `delivery`
--

CREATE TABLE `delivery` (
  `idDelivery` int(11) NOT NULL,
  `distancia` varchar(50) NOT NULL,
  `precio` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `delivery`
--

INSERT INTO `delivery` (`idDelivery`, `distancia`, `precio`) VALUES
(1, '0 km - 1.5km', 3000.00),
(2, '1.6km - 2.5 km', 4000.00),
(3, '2.5km- 3.5km', 6000.00),
(4, '4km - 5.5km', 6000.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion`
--

CREATE TABLE `descripcion` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `descripcion`
--

INSERT INTO `descripcion` (`id`, `descripcion`) VALUES
(1, 'Venta'),
(2, 'Compra'),
(3, 'Pago Servicio'),
(4, 'Saldo inicial'),
(5, 'Pago trabajadores'),
(6, 'abonar caja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` varchar(6) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `sub_total` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` varchar(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(8,2) NOT NULL,
  `sub_total` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`, `sub_total`) VALUES
(10, '000001', 1, 1, 1500.00, 1500.00),
(11, '000001', 2, 2, 1500.00, 3000.00),
(12, '000001', 3, 4, 1500.00, 6000.00),
(13, '000002', 1, 2, 1500.00, 3000.00),
(14, '000002', 2, 1, 1500.00, 1500.00),
(15, '000002', 3, 3, 1500.00, 4500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egreso`
--

CREATE TABLE `egreso` (
  `id` int(11) NOT NULL,
  `descripcion` int(11) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `fecha_registrado` datetime NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `idcaja` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre_empleado` varchar(100) NOT NULL,
  `apellido_empleado` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `puesto` varchar(20) NOT NULL,
  `salario` decimal(8,2) NOT NULL,
  `fech_contrato` date NOT NULL,
  `estado` varchar(50) NOT NULL COMMENT 'A:activo,I:inactivo, E:eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado`) VALUES
(1, 'activo'),
(2, 'inactivo'),
(3, 'libre'),
(4, 'ocupado'),
(5, 'por pagar'),
(6, 'pagado'),
(7, 'cierre'),
(8, 'apertura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `id` int(11) NOT NULL,
  `descripcion` int(11) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `fecha` date NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `idcaja` int(6) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_financiero`
--

CREATE TABLE `kardex_financiero` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `concepto` int(11) NOT NULL,
  `monto_egreso` decimal(10,2) NOT NULL,
  `monto_ingreso` decimal(10,2) NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `idcaja` int(6) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `kardex_financiero`
--

INSERT INTO `kardex_financiero` (`id`, `concepto`, `monto_egreso`, `monto_ingreso`, `saldo`, `fecha`, `mes`, `anio`, `idcaja`) VALUES
(000001, 4, 0.00, 0.00, 5000.00, '2024-08-13', 8, 2024, 000018);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linkmenu`
--

CREATE TABLE `linkmenu` (
  `id` int(11) NOT NULL,
  `link` varchar(50) NOT NULL,
  `iconno` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL COMMENT 'A:activo,I:inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `linkmenu`
--

INSERT INTO `linkmenu` (`id`, `link`, `iconno`, `orden`, `estado`) VALUES
(1, 'dashbord', '', 1, 'inactivo'),
(2, 'configuracion', 'icon/configuracion.svg', 2, 'activo'),
(3, 'restauran', 'icon/restaurant.svg', 3, 'activo'),
(4, 'lista menu', 'icon/menu.svg', 4, 'activo'),
(5, 'mini almacen', 'icon/online.svg', 5, 'activo'),
(6, 'contabilidad', 'icon/contabilidad.svg', 7, 'activo'),
(7, 'compra', 'icon/compra.svg', 9, 'activo'),
(8, 'venta', 'icon/venta.svg', 8, 'activo'),
(9, 'pago servicio', 'icon/bill.svg', 10, 'activo'),
(10, 'caja', 'icon/cash.svg', 6, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medio_pago`
--

CREATE TABLE `medio_pago` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medio_pago`
--

INSERT INTO `medio_pago` (`id`, `descripcion`) VALUES
(1, 'efectivo'),
(2, 'tarjeta'),
(3, 'transferencia'),
(4, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `categoria`, `descripcion`, `precio`) VALUES
(1, 2, 'AS ITALIANO CHICO con dos hamburguesa de piña con peperoni', 1500.00),
(2, 2, 'AS GRANDE', 1500.00),
(3, 2, 'AS XL', 1500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id_mesa` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL COMMENT '7:libre,8:ocupado',
  `numero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multicajas`
--

CREATE TABLE `multicajas` (
  `id_caja_apert` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_caja` int(6) UNSIGNED ZEROFILL NOT NULL,
  `monto_inicial` decimal(8,2) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_apertura` datetime NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `multicajas`
--

INSERT INTO `multicajas` (`id_caja_apert`, `id_caja`, `monto_inicial`, `estado`, `fecha_apertura`, `fecha_cierre`, `mes`, `anio`) VALUES
(000018, 000003, 5000.00, 8, '2024-08-13 19:42:31', '2024-08-13 19:52:19', 8, 2024);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `tipo_atencion` varchar(50) NOT NULL,
  `efectivo_total` decimal(8,2) NOT NULL,
  `PrecioDelivery` decimal(8,2) NOT NULL,
  `SubTotal` decimal(8,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` int(11) NOT NULL COMMENT '6:pagado ; 5:por pagar',
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `atencion` int(11) NOT NULL COMMENT '1:atendido,2:pendiente,3:anulado pedido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `descrip_producto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `ruc` varchar(30) NOT NULL,
  `nombre_proveedor` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `estado` varchar(20) NOT NULL COMMENT 'A:activo,I:inactivo,E:eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roll`
--

CREATE TABLE `roll` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL COMMENT 'A:activo,I:inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roll`
--

INSERT INTO `roll` (`id`, `descripcion`, `estado`) VALUES
(1, 'administrador general', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sublinkmenu`
--

CREATE TABLE `sublinkmenu` (
  `id` int(11) NOT NULL,
  `sublinkmenu` varchar(50) NOT NULL,
  `enlace` varchar(50) NOT NULL,
  `link` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL COMMENT 'A:activo, I:inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sublinkmenu`
--

INSERT INTO `sublinkmenu` (`id`, `sublinkmenu`, `enlace`, `link`, `orden`, `estado`) VALUES
(1, 'categoria plato', 'adm_categoria_plato.php', 4, 1, 'activo'),
(2, 'lista plato', 'adm_platos.php', 4, 2, 'activo'),
(3, 'caja', 'adm_caja.php', 10, 1, 'activo'),
(4, 'egreso', 'adm_egreso.php', 6, 2, 'activo'),
(5, 'ingreso', 'adm_ingreso.php', 6, 3, 'activo'),
(6, 'Movimiento caja', 'adm_kardex_financiero.php', 6, 4, 'activo'),
(7, 'venta pedido', 'adm_venta.php', 8, 1, 'activo'),
(8, 'detalle pedido', 'adm_detalle_venta.php', 8, 2, 'activo'),
(9, 'compra', 'adm_compra.php', 7, 1, 'activo'),
(10, 'detalle compra', 'adm_detalle_compra.php', 7, 2, 'activo'),
(11, 'mesa', 'adm_mesa.php', 3, 1, 'activo'),
(12, 'cliente', 'adm_cliente.php', 3, 2, 'activo'),
(13, 'empleado', 'adm_empleado.php', 3, 3, 'activo'),
(14, 'proveedor', 'adm_proveedor.php', 3, 4, 'activo'),
(15, 'categ. producto', 'adm_categoria_producto.php', 5, 1, 'activo'),
(16, 'producto', 'adm_producto.php', 5, 2, 'activo'),
(17, 'servicio general', 'adm_servicio_general.php', 9, 1, 'activo'),
(22, 'apertura caja', 'adm_caja_apertura.php', 10, 2, 'activo'),
(23, 'cierre caja', 'adm_caja_cierre.php', 10, 3, 'activo'),
(24, 'Distancia entrega', 'adm_entrega.php', 3, 5, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`id`, `descripcion`) VALUES
(1, 'Pago agua'),
(2, 'Pago luz'),
(3, 'Pago gas'),
(4, 'Pago internet'),
(5, 'Pago empleados'),
(6, 'Pago otro servicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_roll` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL COMMENT 'A:activo,I:inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `password`, `id_roll`, `estado`) VALUES
(1, 'enrique0602', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `atendido`
--
ALTER TABLE `atendido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `categoriamenu`
--
ALTER TABLE `categoriamenu`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`idDelivery`);

--
-- Indices de la tabla `descripcion`
--
ALTER TABLE `descripcion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `egreso`
--
ALTER TABLE `egreso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descripcion` (`descripcion`),
  ADD KEY `idcaja` (`idcaja`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descripcion` (`descripcion`),
  ADD KEY `idcaja` (`idcaja`);

--
-- Indices de la tabla `kardex_financiero`
--
ALTER TABLE `kardex_financiero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concepto` (`concepto`),
  ADD KEY `idcaja` (`idcaja`);

--
-- Indices de la tabla `linkmenu`
--
ALTER TABLE `linkmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medio_pago`
--
ALTER TABLE `medio_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id_mesa`);

--
-- Indices de la tabla `multicajas`
--
ALTER TABLE `multicajas`
  ADD PRIMARY KEY (`id_caja_apert`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `atencion` (`atencion`),
  ADD KEY `tipo_pago` (`tipo_pago`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `roll`
--
ALTER TABLE `roll`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sublinkmenu`
--
ALTER TABLE `sublinkmenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link` (`link`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `atendido`
--
ALTER TABLE `atendido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoriamenu`
--
ALTER TABLE `categoriamenu`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `delivery`
--
ALTER TABLE `delivery`
  MODIFY `idDelivery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `descripcion`
--
ALTER TABLE `descripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `egreso`
--
ALTER TABLE `egreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `kardex_financiero`
--
ALTER TABLE `kardex_financiero`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `linkmenu`
--
ALTER TABLE `linkmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `medio_pago`
--
ALTER TABLE `medio_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `multicajas`
--
ALTER TABLE `multicajas`
  MODIFY `id_caja_apert` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roll`
--
ALTER TABLE `roll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sublinkmenu`
--
ALTER TABLE `sublinkmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `egreso`
--
ALTER TABLE `egreso`
  ADD CONSTRAINT `egreso_ibfk_1` FOREIGN KEY (`descripcion`) REFERENCES `descripcion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `egreso_ibfk_2` FOREIGN KEY (`idcaja`) REFERENCES `multicajas` (`id_caja_apert`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`descripcion`) REFERENCES `descripcion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`idcaja`) REFERENCES `multicajas` (`id_caja_apert`);

--
-- Filtros para la tabla `kardex_financiero`
--
ALTER TABLE `kardex_financiero`
  ADD CONSTRAINT `kardex_financiero_ibfk_1` FOREIGN KEY (`concepto`) REFERENCES `descripcion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kardex_financiero_ibfk_2` FOREIGN KEY (`idcaja`) REFERENCES `multicajas` (`id_caja_apert`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`atencion`) REFERENCES `atendido` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`tipo_pago`) REFERENCES `medio_pago` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sublinkmenu`
--
ALTER TABLE `sublinkmenu`
  ADD CONSTRAINT `sublinkmenu_ibfk_1` FOREIGN KEY (`link`) REFERENCES `linkmenu` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
