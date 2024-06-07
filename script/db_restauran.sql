-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2024 a las 17:52:31
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
(1, 'Atendido'),
(2, 'Pendiente'),
(3, 'Anulado');

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
(000001, 'CAJA01', '2024-06-03 16:31:07', 6, 2024, 1);

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
(12, 'combosES'),
(13, 'TOMATESss');

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
(9, 'CERIAL'),
(10, 'MUEBLES'),
(11, 'TOMATSs');

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
(1, '000001', 1, 2, 3300.00, 6600.00),
(2, '000001', 2, 1, 3200.00, 3200.00),
(3, '000001', 3, 1, 3200.00, 3200.00),
(4, '000001', 4, 2, 3200.00, 6400.00),
(5, '000001', 5, 4, 6000.00, 24000.00),
(6, '000002', 16, 2, 300.00, 600.00),
(7, '000002', 15, 4, 20000.00, 80000.00),
(8, '000002', 14, 1, 15000.00, 15000.00),
(9, '000002', 13, 4, 8000.00, 32000.00),
(10, '000003', 8, 4, 2400.00, 9600.00),
(11, '000003', 7, 4, 6000.00, 24000.00),
(12, '000003', 6, 4, 3400.00, 13600.00),
(13, '000003', 5, 2, 6000.00, 12000.00),
(14, '000004', 1, 2, 3300.00, 6600.00),
(15, '000004', 2, 4, 3200.00, 12800.00),
(16, '000004', 3, 2, 3200.00, 6400.00),
(17, '000005', 2, 1, 3200.00, 3200.00),
(18, '000005', 1, 2, 3300.00, 6600.00),
(19, '000005', 10, 5, 1000.00, 5000.00),
(20, '000006', 1, 2, 3300.00, 6600.00),
(21, '000006', 2, 4, 3200.00, 12800.00),
(22, '000006', 9, 10, 3500.00, 35000.00),
(23, '000007', 1, 2, 3300.00, 6600.00),
(24, '000007', 2, 1, 3200.00, 3200.00),
(25, '000007', 6, 2, 3400.00, 6800.00),
(26, '000007', 7, 4, 6000.00, 24000.00),
(27, '000008', 13, 2, 8000.00, 16000.00),
(28, '000008', 12, 4, 800.00, 3200.00),
(29, '000008', 15, 1, 20000.00, 20000.00),
(30, '000008', 8, 5, 2400.00, 12000.00),
(31, '000009', 2, 1, 3200.00, 3200.00),
(32, '000009', 4, 4, 3200.00, 12800.00),
(33, '000009', 6, 5, 3400.00, 17000.00),
(34, '000010', 2, 1, 3200.00, 3200.00),
(35, '000010', 3, 2, 3200.00, 6400.00),
(36, '000010', 5, 4, 6000.00, 24000.00),
(37, '000011', 1, 1, 3300.00, 3300.00);

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
(2, 'pendiente'),
(3, 'cancelado'),
(4, 'anulado'),
(5, 'eliminado'),
(6, 'atendido'),
(7, 'ocupado'),
(8, 'libre'),
(9, 'cerrado'),
(10, 'abierto');

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

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`id`, `descripcion`, `monto`, `fecha`, `mes`, `anio`, `idcaja`) VALUES
(1, 1, 43400.00, '2024-06-05', 6, 2024, 000005),
(2, 1, 127600.00, '2024-06-05', 6, 2024, 000005),
(3, 1, 59200.00, '2024-06-05', 6, 2024, 000005),
(4, 1, 25800.00, '2024-06-05', 6, 2024, 000005),
(5, 1, 14800.00, '2024-06-05', 6, 2024, 000005),
(6, 1, 54400.00, '2024-06-05', 6, 2024, 000005),
(7, 1, 40600.00, '2024-06-05', 6, 2024, 000005),
(8, 1, 51200.00, '2024-06-05', 6, 2024, 000005),
(9, 1, 33000.00, '2024-06-05', 6, 2024, 000005),
(10, 1, 33600.00, '2024-06-05', 6, 2024, 000005);

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
(000001, 1, 0.00, 43400.00, 218400.00, '2024-06-05', 6, 2024, 000005),
(000002, 1, 0.00, 127600.00, 346000.00, '2024-06-05', 6, 2024, 000005),
(000003, 1, 0.00, 59200.00, 405200.00, '2024-06-05', 6, 2024, 000005),
(000004, 1, 0.00, 25800.00, 431000.00, '2024-06-05', 6, 2024, 000005),
(000005, 1, 0.00, 14800.00, 445800.00, '2024-06-05', 6, 2024, 000005),
(000006, 1, 0.00, 54400.00, 500200.00, '2024-06-05', 6, 2024, 000005),
(000007, 1, 0.00, 40600.00, 540800.00, '2024-06-05', 6, 2024, 000005),
(000008, 1, 0.00, 51200.00, 592000.00, '2024-06-05', 6, 2024, 000005),
(000009, 1, 0.00, 33000.00, 625000.00, '2024-06-05', 6, 2024, 000005),
(000010, 1, 0.00, 33600.00, 658600.00, '2024-06-05', 6, 2024, 000005);

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
(1, 3, 'barros luco', 3300.00),
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
(14, 9, 'sushi 30 pieza', 15000.00),
(15, 11, '2 gaseosas + hamburguesa italiano', 20000.00),
(16, 9, 'BARBIQUI', 300.00);

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

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id_mesa`, `capacidad`, `estado`, `numero`) VALUES
(3, 9, 8, 'MESA 01'),
(4, 5, 8, 'mesa 5'),
(5, 6, 8, 'Mesa 07'),
(6, 4, 8, 'mesa012'),
(7, 4, 8, 'mesa 08');

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
(000002, 000001, 44200.00, 9, '2024-06-03 16:31:34', '2024-06-03 16:42:19', 6, 2024),
(000003, 000001, 2000.00, 9, '2024-06-03 16:42:31', '2024-06-04 16:43:52', 6, 2024),
(000004, 000001, 19500.00, 9, '2024-06-04 16:44:00', '2024-06-05 09:13:21', 6, 2024),
(000005, 000001, 658600.00, 10, '2024-06-05 09:14:20', '0000-00-00 00:00:00', 6, 2024);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_servicio`
--

CREATE TABLE `pago_servicio` (
  `id` int(11) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `tipo_servicio` int(11) NOT NULL,
  `numero_recibo` varchar(50) NOT NULL,
  `monto_pago` decimal(10,2) NOT NULL,
  `fecha_pago` datetime NOT NULL,
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
  `tipo_pago` int(11) NOT NULL,
  `tipo_atencion` varchar(50) NOT NULL,
  `efectivo_total` decimal(8,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` int(11) NOT NULL COMMENT '2:pendiente,3:cancelado,4:anulado',
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `atencion` int(11) NOT NULL COMMENT '1:atendido,2:pendiente,3:anulado pedido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_cliente`, `id_mesa`, `tipo_pago`, `tipo_atencion`, `efectivo_total`, `total`, `fecha_hora`, `estado`, `mes`, `anio`, `atencion`) VALUES
(000001, 0, 3, 2, 'mesa', 0.00, 43400.00, '2024-06-05 10:21:09', 3, 6, 2024, 1),
(000002, 0, 3, 2, 'mesa', 0.00, 127600.00, '2024-06-05 10:22:06', 3, 6, 2024, 1),
(000003, 0, 3, 2, 'mesa', 0.00, 59200.00, '2024-06-05 10:23:56', 3, 6, 2024, 1),
(000004, 0, 5, 2, 'mesa', 0.00, 25800.00, '2024-06-05 10:24:37', 3, 6, 2024, 1),
(000005, 0, 6, 2, 'mesa', 0.00, 14800.00, '2024-06-05 10:25:01', 3, 6, 2024, 1),
(000006, 0, 5, 2, 'mesa', 0.00, 54400.00, '2024-06-05 10:28:44', 3, 6, 2024, 1),
(000007, 0, 7, 2, 'mesa', 0.00, 40600.00, '2024-06-05 10:30:28', 3, 6, 2024, 1),
(000008, 0, 7, 2, 'mesa', 0.00, 51200.00, '2024-06-05 10:30:45', 3, 6, 2024, 1),
(000009, 0, 7, 2, 'mesa', 0.00, 33000.00, '2024-06-05 10:30:58', 3, 6, 2024, 1),
(000010, 0, 7, 3, 'mesa', 0.00, 33600.00, '2024-06-05 10:31:12', 3, 6, 2024, 1),
(000011, 0, 4, 4, 'mesa', 0.00, 3300.00, '2024-06-05 10:42:24', 4, 6, 2024, 3);

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
(1, 1, 'lechuga');

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
(1, 'SEDAPAL', '2102222', 'pieross', '', '', 'activo');

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
(1, 'servicio agua'),
(2, 'servicio luz'),
(3, 'servicio gas'),
(4, 'servicio internet'),
(5, 'Pago empleados');

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
  ADD PRIMARY KEY (`id_caja`),
  ADD KEY `estado` (`estado`);

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
  ADD PRIMARY KEY (`id_mesa`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `multicajas`
--
ALTER TABLE `multicajas`
  ADD PRIMARY KEY (`id_caja_apert`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `estado` (`estado`),
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
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `atendido`
--
ALTER TABLE `atendido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoriamenu`
--
ALTER TABLE `categoriamenu`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `kardex_financiero`
--
ALTER TABLE `kardex_financiero`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `multicajas`
--
ALTER TABLE `multicajas`
  MODIFY `id_caja_apert` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON UPDATE CASCADE;

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
-- Filtros para la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD CONSTRAINT `mesa_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Filtros para la tabla `multicajas`
--
ALTER TABLE `multicajas`
  ADD CONSTRAINT `multicajas_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`) ON UPDATE CASCADE,
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
