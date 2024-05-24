-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2024 a las 19:09:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(6) UNSIGNED ZEROFILL NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL COMMENT 'A:activo,I:inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `descripcion`, `fecha`, `mes`, `anio`, `estado`) VALUES
(000001, 'caja01', '2024-05-14 17:05:15', 5, 2024, 'activo');

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
(1, 'PROMOS'),
(2, 'AS'),
(3, 'Hamburguesas'),
(4, 'Bebidas'),
(5, 'BRASA'),
(6, 'DINAMICO'),
(7, 'FAJITAS'),
(8, 'HANDROLL'),
(9, 'sushi'),
(10, 'criollas'),
(11, 'combos'),
(12, 'combos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaproducto`
--

CREATE TABLE `categoriaproducto` (
  `id_producto` int(11) NOT NULL,
  `descrip_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoriaproducto`
--

INSERT INTO `categoriaproducto` (`id_producto`, `descrip_categoria`) VALUES
(1, 'VERDURAS'),
(2, 'TUBERCULOS'),
(3, 'BEBIDAS'),
(4, 'CARNE'),
(5, 'FRUTA'),
(6, 'EMBUTIDO'),
(7, 'LIMPIEZA'),
(8, 'ACEITE'),
(9, 'CERIAL');

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

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `dato_cliente`, `telefono`, `email`, `Direccion`, `estado`) VALUES
(1, 'JUAN PEREZ', '990990990', '', 'lima 126DDDDD', 'activo'),
(2, 'maria palacio', '9601114400', '', 'urb los jardines cuadra 6', 'activo'),
(3, 'jose valdivia ', '936625014', '', 'av. lima 13 jr los asbestos', 'activo'),
(4, 'luis enrique caballero ', '990360195', '', 'av. los jirasoles de las flores', 'activo');

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

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `tipo_boleta`, `numero_recibo`, `id_proveedor`, `total`, `fecha_compra`, `mes`, `anio`) VALUES
(000001, 'factura', 'f0001-002', 1, 16000.00, '2024-05-16 20:05:42', 2024, 5);

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

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `producto`, `cantidad`, `precio`, `sub_total`) VALUES
(1, '000001', 1, 2, 2000.00, 4000.00),
(2, '000001', 2, 4, 3000.00, 12000.00);

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
(1, '000001', 1, 2, 3200.00, 6400.00),
(2, '000002', 1, 2, 3200.00, 6400.00),
(3, '000002', 3, 3, 3200.00, 9600.00),
(4, '000002', 6, 3, 3400.00, 10200.00),
(5, '000002', 9, 2, 3500.00, 7000.00),
(6, '000003', 6, 4, 3400.00, 13600.00),
(7, '000003', 15, 5, 20000.00, 100000.00),
(8, '000003', 9, 4, 3500.00, 14000.00),
(9, '000003', 8, 1, 2400.00, 2400.00),
(10, '000003', 2, 2, 3200.00, 6400.00),
(11, '000003', 4, 7, 3200.00, 22400.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egreso`
--

CREATE TABLE `egreso` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `fecha_registrado` datetime NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `egreso`
--

INSERT INTO `egreso` (`id`, `descripcion`, `monto`, `fecha_registrado`, `mes`, `anio`) VALUES
(1, 'compra', 16000.00, '2024-05-16 20:05:42', 2024, 5);

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

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre_empleado`, `apellido_empleado`, `telefono`, `puesto`, `salario`, `fech_contrato`, `estado`) VALUES
(1, 'Enrique ', 'caballero canachaya', '990990990', 'contador', 120000.00, '2024-04-30', 'inactivo'),
(2, 'maria ', 'angeles del rose', '999032456', 'mesero', 2000.00, '2024-05-14', 'inactivo'),
(3, 'maria ', 'des', '28283', 'mesero', 20.00, '2024-05-14', 'inactivo'),
(4, 'dddd', 'ddd', '72255', 'mesero', 2.00, '2024-05-14', 'inactivo'),
(5, 'eese', 'seses', '4258', 'mesero', 4000.00, '2024-05-14', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `fecha` date NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`id`, `descripcion`, `monto`, `fecha`, `mes`, `anio`) VALUES
(1, 'aumento caja', 100.00, '2024-05-16', 5, 2024),
(2, 'venta', 6400.00, '2024-05-16', 5, 2024),
(3, 'venta', 33200.00, '2024-05-17', 5, 2024),
(4, 'venta', 158800.00, '2024-05-18', 5, 2024);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_financiero`
--

CREATE TABLE `kardex_financiero` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `concepto` varchar(50) NOT NULL,
  `monto_egreso` decimal(8,2) NOT NULL,
  `monto_ingreso` decimal(8,2) NOT NULL,
  `saldo` decimal(8,2) NOT NULL,
  `fecha` date NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `kardex_financiero`
--

INSERT INTO `kardex_financiero` (`id`, `concepto`, `monto_egreso`, `monto_ingreso`, `saldo`, `fecha`, `mes`, `anio`) VALUES
(000001, 'INICIO CAJA', 0.00, 0.00, 20000.00, '2024-05-16', 5, 2024),
(000002, 'aumento caja', 0.00, 100.00, 20100.00, '2024-05-16', 5, 2024),
(000003, 'venta', 0.00, 6400.00, 26500.00, '2024-05-16', 5, 2024),
(000004, 'INICIO CAJA', 0.00, 0.00, 16000.00, '2024-05-16', 5, 2024),
(000005, 'compra', 16000.00, 0.00, 0.00, '2024-05-16', 5, 2024),
(000006, 'venta', 0.00, 33200.00, 33200.00, '2024-05-17', 5, 2024),
(000007, 'venta', 0.00, 158800.00, 192000.00, '2024-05-18', 5, 2024);

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
(1, 3, 'barros luco', 3200.00),
(2, 3, 'churrasco italiano', 3200.00),
(3, 3, 'churrasco completo', 3200.00),
(4, 3, 'chacarero', 3200.00),
(5, 3, 'hamburguesa', 6000.00),
(6, 1, '2 completo chico + bebida, te o cafe', 3400.00),
(7, 1, '2 churrascos x ', 6000.00),
(8, 1, '1 italianagrande bebida, te o cafe', 2400.00),
(9, 1, '2 italianas chicos + bebida , te o cafe', 3500.00),
(10, 4, 'bebida', 1000.00),
(11, 4, 'te', 800.00),
(12, 4, 'cafe', 800.00),
(13, 9, 'sushi 20 piezas', 8000.00),
(14, 9, 'sushi 30 pieza', 10000.00),
(15, 11, '2 gaseosas + hamburguesa italiano', 20000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id_mesa` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL COMMENT 'L:libre,O:ocupado',
  `numero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id_mesa`, `capacidad`, `estado`, `numero`) VALUES
(1, 0, 'libre', 'mesa 1'),
(2, 0, 'libre', 'mesa 2'),
(3, 0, 'libre', 'mesa 3'),
(4, 0, 'libre', 'mesa 4'),
(5, 0, 'libre', 'mesa 5'),
(6, 0, 'libre', 'mesa 6'),
(7, 0, 'libre', 'mesa 7'),
(8, 0, 'libre', 'mesa 8'),
(11, 4, 'ocupado', 'muqq');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multicajas`
--

CREATE TABLE `multicajas` (
  `id_caja_apert` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_caja` int(6) UNSIGNED ZEROFILL NOT NULL,
  `monto_inicial` decimal(8,2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha_apertura` datetime NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `multicajas`
--

INSERT INTO `multicajas` (`id_caja_apert`, `id_caja`, `monto_inicial`, `estado`, `fecha_apertura`, `fecha_cierre`, `mes`, `anio`) VALUES
(000001, 000001, 26500.00, 'cerrado', '2024-05-16 18:05:51', '2024-05-16 18:05:20', 5, 2024),
(000002, 000001, 192000.00, 'activo', '2024-05-16 18:05:05', '0000-00-00 00:00:00', 5, 2024);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_servicio`
--

CREATE TABLE `pago_servicio` (
  `id` int(11) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `tipo_servicio` varchar(20) NOT NULL,
  `numero_recibo` varchar(50) NOT NULL,
  `monto_pago` int(11) NOT NULL,
  `fecha_pago` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL COMMENT 'C:cancelado,P:pediente,A:anulado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `tipo_pago` varchar(50) NOT NULL,
  `tipo_atencion` varchar(50) NOT NULL,
  `efectivo_total` decimal(8,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(50) NOT NULL COMMENT 'P:pendiente,C:cancelado,A:anulado',
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `atencion` varchar(40) NOT NULL COMMENT 'A:atendido,P:pendiente,AP:anulado pedido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_cliente`, `id_mesa`, `tipo_pago`, `tipo_atencion`, `efectivo_total`, `total`, `fecha_hora`, `estado`, `mes`, `anio`, `atencion`) VALUES
(000001, 0, 2, 'efectivo', 'efectivo', 0.00, 6400.00, '2024-05-16 18:05:14', 'anulado', 5, 2024, 'anulado'),
(000002, 0, 4, 'efectivo', 'mesa', 0.00, 33200.00, '2024-05-17 23:05:33', 'anulado', 5, 2024, 'anulado'),
(000003, 0, 7, 'forma pago', 'mesa', 0.00, 158800.00, '2024-05-18 18:05:56', 'anulado', 5, 2024, 'anulado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `descrip_producto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `categoria`, `descrip_producto`) VALUES
(1, 1, 'lechuga'),
(2, 3, 'coca cola 1lt');

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

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `empresa`, `ruc`, `nombre_proveedor`, `telefono`, `direccion`, `estado`) VALUES
(1, 'TIENDA EL PATRON', '2020202020', 'JOSE ANTONIO', '9898989', 'AV LOS EUCALITOS', 'activo'),
(2, 'tienda los angesl', '2000', 'pepe lucho', '85522', 'seess', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservar_mesa`
--

CREATE TABLE `reservar_mesa` (
  `id_mesa` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `n_persona` int(11) NOT NULL,
  `estado` varchar(2) NOT NULL
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
(23, 'cierre caja', 'adm_caja_cierre.php', 10, 3, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaciones`
--

CREATE TABLE `transaciones` (
  `id_transacion` int(11) NOT NULL,
  `tipo_transacion` varchar(2) NOT NULL,
  `fecha_hora` date NOT NULL,
  `monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'enrique0602', '1234', 1, 'activo');

--
-- Índices para tablas volcadas
--

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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kardex_financiero`
--
ALTER TABLE `kardex_financiero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linkmenu`
--
ALTER TABLE `linkmenu`
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
  ADD PRIMARY KEY (`id_pedido`);

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
-- Indices de la tabla `reservar_mesa`
--
ALTER TABLE `reservar_mesa`
  ADD PRIMARY KEY (`id_mesa`);

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
-- Indices de la tabla `transaciones`
--
ALTER TABLE `transaciones`
  ADD PRIMARY KEY (`id_transacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoriamenu`
--
ALTER TABLE `categoriamenu`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `egreso`
--
ALTER TABLE `egreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `kardex_financiero`
--
ALTER TABLE `kardex_financiero`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `linkmenu`
--
ALTER TABLE `linkmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `multicajas`
--
ALTER TABLE `multicajas`
  MODIFY `id_caja_apert` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reservar_mesa`
--
ALTER TABLE `reservar_mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roll`
--
ALTER TABLE `roll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sublinkmenu`
--
ALTER TABLE `sublinkmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `transaciones`
--
ALTER TABLE `transaciones`
  MODIFY `id_transacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sublinkmenu`
--
ALTER TABLE `sublinkmenu`
  ADD CONSTRAINT `sublinkmenu_ibfk_1` FOREIGN KEY (`link`) REFERENCES `linkmenu` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
