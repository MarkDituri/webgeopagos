-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-04-2023 a las 16:17:02
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_qudimar_local`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_temp`
--

CREATE TABLE `carrito_temp` (
  `id_carrito_temp` bigint(250) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `code_session` varchar(100) DEFAULT NULL,
  `modo` varchar(100) NOT NULL,
  `total` int(20) DEFAULT NULL,
  `activo` varchar(2) NOT NULL,
  `qr` varchar(2) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `id_restaurante` bigint(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito_temp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` bigint(250) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `activo` varchar(2) DEFAULT NULL,
  `id_restaurante` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `status`, `nombre`, `activo`, `id_restaurante`) VALUES
(1, '1', 'Pizzas', 'si', 1),
(2, '1', 'Empanadas', 'si', 1),
(3, '1', 'Pastas', 'si', 1),
(4, '1', 'Bebidas', 'si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id_color` int(250) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id_color`, `nombre`, `class_name`) VALUES
(1, 'Rojo', 'perfil_red'),
(2, 'Verde', 'perfil_verde'),
(3, 'Azul', 'perfil_azul'),
(4, 'Amarillo', 'perfil_amarillo'),
(5, 'Celeste', 'perfil_celeste'),
(6, 'Naranja', 'perfil_naranja'),
(7, 'Violeta', 'perfil_violeta'),
(8, 'Rosa', 'perfil_rosa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comensales`
--

CREATE TABLE `comensales` (
  `id_comensal` int(250) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `mesa` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `piso` varchar(20) DEFAULT NULL,
  `code_session` varchar(100) DEFAULT NULL,
  `id_restaurante` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comensales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` bigint(250) NOT NULL,
  `id_producto` bigint(250) NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del sistema', 1),
(3, 'Clientes', 'Clientes de tienda', 1),
(4, 'Productos', 'Todos los productos', 1),
(5, 'Pedidos', 'Pedidos', 1),
(6, 'Caterogías', 'Caterogías Productos', 1),
(7, 'Suscriptores', 'Suscriptores del sitio web', 1),
(8, 'Contactos', 'Mensajes del formulario contacto', 1),
(9, 'Páginas', 'Páginas del sitio web', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` bigint(250) NOT NULL,
  `status` int(1) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `id_pedido` int(250) DEFAULT NULL,
  `id_restaurante` bigint(250) NOT NULL,
  `code_session` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` bigint(250) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaVen` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `fechaPago` date DEFAULT NULL,
  `precio` int(50) NOT NULL,
  `mp_payment_id` varchar(100) DEFAULT NULL,
  `mp_payment_type` varchar(100) DEFAULT NULL,
  `mp_order_id` varchar(100) DEFAULT NULL,
  `activo` varchar(2) NOT NULL,
  `id_plan` bigint(250) DEFAULT NULL,
  `id_restaurante` bigint(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `status`, `fechaInicio`, `fechaVen`, `fechaFin`, `fechaPago`, `precio`, `mp_payment_id`, `mp_payment_type`, `mp_order_id`, `activo`, `id_plan`, `id_restaurante`) VALUES
(1, 1, '2022-12-21', '2023-01-21', '2023-01-21', NULL, 0, NULL, NULL, NULL, 'si', 1, 1),
(2, 1, '2023-01-21', '2023-02-05', '2023-02-21', '2023-02-13', 790, '1312431981', 'credit_card', '7729731901', 'si', 2, 1),
(3, 1, '2023-02-21', '2023-03-08', '2023-03-23', '2023-03-18', 790, '1312212796', 'credit_card', '8267963771', 'si', 2, 1),
(4, 0, '2023-03-23', '2023-04-07', '2023-04-22', NULL, 790, NULL, NULL, NULL, 'si', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` bigint(250) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `code_session` varchar(100) DEFAULT NULL,
  `cantidad` int(10) NOT NULL,
  `precio` int(30) NOT NULL,
  `id_producto` int(250) DEFAULT NULL,
  `id_restaurante` bigint(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(3, 1, 1, 1, 1, 1, 1),
(4, 1, 2, 1, 1, 1, 1),
(5, 1, 3, 1, 1, 1, 1),
(6, 1, 4, 1, 1, 1, 1),
(7, 1, 5, 1, 1, 1, 1),
(8, 1, 6, 1, 1, 1, 1),
(9, 1, 7, 1, 1, 1, 1),
(10, 1, 8, 1, 1, 1, 1),
(11, 1, 9, 1, 1, 1, 1),
(12, 2, 1, 1, 1, 1, 1),
(13, 2, 2, 0, 0, 0, 0),
(14, 2, 3, 1, 1, 1, 0),
(15, 2, 4, 1, 1, 1, 0),
(16, 2, 5, 1, 1, 1, 0),
(17, 2, 6, 1, 1, 1, 0),
(18, 2, 7, 1, 0, 0, 0),
(19, 2, 8, 1, 0, 0, 0),
(20, 2, 9, 1, 1, 1, 1),
(21, 3, 1, 0, 0, 0, 0),
(22, 3, 2, 0, 0, 0, 0),
(23, 3, 3, 0, 0, 0, 0),
(24, 3, 4, 0, 0, 0, 0),
(25, 3, 5, 1, 0, 0, 0),
(26, 3, 6, 0, 0, 0, 0),
(27, 3, 7, 0, 0, 0, 0),
(28, 3, 8, 0, 0, 0, 0),
(29, 3, 9, 0, 0, 0, 0),
(30, 4, 1, 1, 0, 0, 0),
(31, 4, 2, 0, 0, 0, 0),
(32, 4, 3, 1, 1, 1, 0),
(33, 4, 4, 1, 0, 0, 0),
(34, 4, 5, 1, 0, 1, 0),
(35, 4, 6, 0, 0, 0, 0),
(36, 4, 7, 1, 0, 0, 0),
(37, 4, 8, 1, 0, 0, 0),
(38, 4, 9, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_plan` bigint(200) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_plan`, `status`, `nombre`, `precio`) VALUES
(1, 1, 'Demo', 0),
(2, 1, 'Estandar', 1690),
(3, 1, 'Pro', 1450);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--


--
-- Volcado de datos para la tabla `post`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` bigint(250) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `url_img` varchar(250) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `stock` varchar(30) DEFAULT NULL,
  `precio` int(50) DEFAULT NULL,
  `activo` varchar(2) NOT NULL,
  `id_categoria` bigint(250) DEFAULT NULL,
  `id_restaurante` bigint(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `status`, `url_img`, `titulo`, `descripcion`, `stock`, `precio`, `activo`, `id_categoria`, `id_restaurante`) VALUES
(1, '1', 'img_5616c65a1ce120b5bba3c6c360c2e8a6.jpg', 'Pizza napolitana', 'Salsa de tomate. muzzarella, tomates frescos, jamón, aceitunas,verdes y orégano.', NULL, 2100, 'si', 1, 1),
(2, '1', 'img_05bb480e8d0bc5c9d304fd00b6da2158.jpg', 'Pizza calabresa', 'Salsa de tomate, muzzarella, calabresa, morrones, aceitunas negras y orégano.', NULL, 2100, 'si', 1, 1),
(3, '1', 'img_722e99145f1a6ca5fdf7c9de5c67e3a4.jpg', 'Pizza con jamón y huevo', 'Sala de tomate, muzzarella, jamón, huevo y aceitunas verdes.', NULL, 2100, 'si', 1, 1),
(4, '1', 'img_d65450b26e7ad44581063b27c3492cb9.jpg', 'Pizza con rúcula y jamón serrano', 'Salsa de tomate, muzzarella, jamón serrano, rúcula, aceitunas negras y queso parmesano.', NULL, 2100, 'si', 1, 1),
(5, '1', 'img_82edaa6be5c05518308b8762f8a1108a.jpg', 'Empanada de carne suave', 'Carne suave con aceitunas y huevo.', NULL, 250, 'si', 2, 1),
(6, '1', 'img_974da4f1d98e1c54f99c97279ed5559a.jpg', 'Empanada de carne salteña', 'Carne cortada a cuchillo con papa.', NULL, 250, 'si', 2, 1),
(7, '1', 'img_f5aa0601e9cf873d3a9944ac0b69e3e2.jpg', 'Empanada de jamón y queso', '', NULL, 250, 'si', 2, 1),
(8, '1', 'img_31ebdf70486b40a34bbdea366fe67dd2.jpg', 'Empanada de pollo', '', NULL, 250, 'si', 2, 1),
(9, '1', 'img_db3bc26547105e7311c16806b4db1ddd.jpg', 'Ravioles de verdura y pollo', 'Rellenos de ricota, jamón y pollo, servidos con salsa a elección.', NULL, 1400, 'si', 3, 1),
(10, '1', 'img_01cf41b0532851c2c2aee0cf2c7f9827.jpg', 'Agnolottis', 'Rellenos de ricota, jamón y nueces, servidos con salsa a elección.', NULL, 1400, 'si', 3, 1),
(11, '1', 'img_0fe1813fe077199f070df2f5ffdcd653.jpg', 'Sorrentinos', 'Rellenos de mozzarella y jamón natural, servidos con salsa a elección', NULL, 1400, 'si', 3, 1),
(12, '1', 'img_0e09d6715d595f17521c1f0199a5d36a.jpg', 'Coca Cola 500ml', '', NULL, 300, 'si', 4, 1),
(13, '1', 'img_edd179e9b3ce2678bd42a04d11f5f73c.jpg', 'Sprite 500ml', '', NULL, 300, 'si', 4, 1),
(14, '1', 'img_e5227c6b2ee3253e372d3267d63d0a54.jpg', 'Paso de los toros Pomelo 500ml', '', NULL, 300, 'si', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id_restaurante` bigint(250) NOT NULL,
  `identificacion` varchar(30) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `nombres` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombre_rest` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email_user` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` varchar(75) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nit` varchar(20) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `nombrefiscal` varchar(80) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `direccionfiscal` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `rolid` bigint(20) NOT NULL,
  `url_logo` varchar(250) COLLATE utf8mb4_swedish_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `localidad` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `id_color` int(250) NOT NULL,
  `dark_mode` tinyint(1) NOT NULL,
  `facebook` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `instagram` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `id_plan` bigint(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `id_admin` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`id_restaurante`, `identificacion`, `nombres`, `nombre_rest`, `apellidos`, `telefono`, `email_user`, `password`, `nit`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `url_logo`, `url`, `direccion`, `numero`, `localidad`, `id_color`, `dark_mode`, `facebook`, `instagram`, `datecreated`, `id_plan`, `status`, `id_admin`) VALUES
(1, '1tloe4158', 'Qudimar', 'qudimarMAX', 'Menu', 11308784672, 'mcc.qudimar@gmail.com', '64001bd1f8f492db2e446d4c2d39062a3aade19c32acd21ffaf7a013468c1121', NULL, NULL, NULL, 'fedb1f134afd2327917d', 1, 'img_ed5ba5c9bde06fc16776cb2a57594dba.jpg', 'qudimar', '', '', '', 1, 0, '', 'qudimar', '2022-07-26 19:19:55', 2, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Acceso a todo el sistema', 1),
(2, 'Supervisor', 'Supervisor de tiendas', 1),
(3, 'Cliente', 'Clientes en general', 1),
(4, 'Vendedor', 'Operador de tienda', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sliders`
--

CREATE TABLE `sliders` (
  `id_slider` bigint(250) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `img_slider` varchar(250) DEFAULT NULL,
  `titulo` varchar(120) DEFAULT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `activo` varchar(2) NOT NULL,
  `url_action` varchar(100) DEFAULT NULL,
  `id_restaurante` bigint(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sliders`
--

INSERT INTO `sliders` (`id_slider`, `status`, `img_slider`, `titulo`, `tag`, `activo`, `url_action`, `id_restaurante`) VALUES
(1, '1', 'img_9cd361fbc541c87e11fb6804417d18fd.jpg', '30% OFF en docena de empanadas', 'Promocion', 'si', NULL, 1),
(2, '1', 'img_642c7419b1d69fd07fe4a9669f3b9082.jpg', '20% OFF en Pizza napolitana hasta las 22:00hs', 'Promocion', 'si', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_temp`
--
ALTER TABLE `carrito_temp`
  ADD PRIMARY KEY (`id_carrito_temp`),
  ADD KEY `id_restaurante` (`id_restaurante`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_restaurante` (`id_restaurante`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `comensales`
--
ALTER TABLE `comensales`
  ADD PRIMARY KEY (`id_comensal`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoid` (`id_producto`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `id_restaurante` (`id_restaurante`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_plan` (`id_plan`),
  ADD KEY `id_restaurante` (`id_restaurante`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_restaurante` (`id_restaurante`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id_plan`);

--
-- Indices de la tabla `post`
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_restaurante` (`id_restaurante`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id_restaurante`),
  ADD KEY `rolid` (`rolid`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id_slider`),
  ADD KEY `id_restaurante` (`id_restaurante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito_temp`
--
ALTER TABLE `carrito_temp`
  MODIFY `id_carrito_temp` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id_color` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comensales`
--
ALTER TABLE `comensales`
  MODIFY `id_comensal` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` bigint(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_plan` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `post`
--
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id_restaurante` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id_slider` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_temp`
--
ALTER TABLE `carrito_temp`
  ADD CONSTRAINT `carrito_temp_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id_plan`),
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD CONSTRAINT `restaurantes_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
