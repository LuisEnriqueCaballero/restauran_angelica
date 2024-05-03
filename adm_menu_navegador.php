<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="lib/bootstrap//jquery.dataTables.min.css">
    <link rel="stylesheet" href="lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="contenido_modal">

    </div>
    <div id="contenido_pedido">

    </div>
    <div id="contenido_venta">

    </div>
    <section class="slider">
        <nav class="menu">
            <div class="logo_menu">
                <a href="#" class="enlace_menu">
                    <img src="img/389394127d274b37b2ab0746bdef427a-removebg-preview.png" alt="" class="logo" width="120px" height="120px">
                    <span>creatividad</span>
                </a>
            </div>
            <div class="logo_usuario">
                <a href="#" style="display: flex; flex-wrap: wrap;">
                    <img src="img/389394127d274b37b2ab0746bdef427a-removebg-preview.png" alt="" class="logo" width="80px" height="80px">
                    <div class="dato_usuario">
                        <span class="nombre">luis enrique caballero</span>
                        <span class="roll">administrador</span>
                    </div>
                </a>
            </div>
            <ul class="nav">
                <li class="list_menu">
                    <div class="contenido_menu_link  activo">
                        <img src="icon/dashboard.svg" alt="" class="iconos_principal">
                        <a href="#" class="link_menu">dashboard</a>
                    </div>
                </li>
                <li class="list_menu list_menu-click">
                    <div class="contenido_menu_link ">
                        <img src="icon/configuracion.svg" alt="" class="iconos_principal">
                        <a href="#" class="link_menu">configuracion</a>
                        <img src="icon/arrow-next-small-svgrepo-com (1).svg" alt="" class="arrow ">
                    </div>
                    <ul class="sub_nav ">
                        <li class="sub_list list_menu"><a href="#" class="link_menu sub_link_menu">lista usuario</a></li>
                        <li class="sub_list list_menu"><a href="#" class="link_menu sub_link_menu">control permiso</a>
                        </li>
                        <li class="sub_list list_menu"><a href="#" class="link_menu sub_link_menu">lista roles</a></li>
                    </ul>
                </li>
                <li class="list_menu  list_menu-click">
                    <div class="contenido_menu_link">
                        <img src="icon/empresa.svg" alt="" class="iconos_principal">
                        <a href="#" class="link_menu">restauran</a>
                        <img src="icon/arrow-next-small-svgrepo-com (1).svg" alt="" class="arrow">
                    </div>
                    <ul class="sub_nav ">
                        <li class="sub_list list_menu"><a href="adm_empleado.php" class="link_menu sub_link_menu">lista empleado</a>
                        </li>
                        <li class="sub_list list_menu"><a href="adm_cliente.php" class="link_menu sub_link_menu">lista cliente</a></li>
                        <li class="sub_list list_menu"><a href="adm_proveedor.php" class="link_menu sub_link_menu">lista proveedore</a>
                        </li>
                        <li class="sub_list list_menu"><a href="adm_mesa.php" class="link_menu sub_link_menu">lista mesas</a>
                        </li>
                    </ul>
                </li>
                <li class="list_menu  list_menu-click">
                    <div class="contenido_menu_link">
                        <img src="icon/almacen.svg" alt="" class="iconos_principal">
                        <a href="#" class="link_menu">lista menu</a>
                        <img src="icon/arrow-next-small-svgrepo-com (1).svg" alt="" class="arrow">
                    </div>
                    <ul class="sub_nav ">
                        <li class="sub_list list_menu"><a href="adm_categoria_plato.php" class="link_menu sub_link_menu">categoria plato</a></li>
                        <li class="sub_list list_menu"><a href="adm_platos.php" class="link_menu sub_link_menu">lista platos</a>
                        </li>
                    </ul>
                </li>
                <li class="list_menu">
                <div class="contenido_menu_link">
                        <img src="icon/almacen.svg" alt="" class="iconos_principal">
                        <a href="#" class="link_menu">mini almacen</a>
                        <img src="icon/arrow-next-small-svgrepo-com (1).svg" alt="" class="arrow">
                    </div>
                    <ul class="sub_nav ">
                        <li class="sub_list list_menu"><a href="adm_categoria_producto.php" class="link_menu sub_link_menu">categ. producto</a></li>
                        <li class="sub_list list_menu"><a href="adm_producto.php" class="link_menu sub_link_menu">lista producto</a>
                        </li>
                    </ul>
                </li>
                <li class="list_menu">
                <div class="contenido_menu_link">
                        <img src="icon/almacen.svg" alt="" class="iconos_principal">
                        <a href="#" class="link_menu">contabilidad</a>
                        <img src="icon/arrow-next-small-svgrepo-com (1).svg" alt="" class="arrow">
                    </div>
                    <ul class="sub_nav ">
                        <li class="sub_list list_menu"><a href="adm_caja.php" class="link_menu sub_link_menu">caja</a></li>
                        <li class="sub_list list_menu"><a href="adm_egreso.php" class="link_menu sub_link_menu">lista egreso</a>
                        </li>
                        <li class="sub_list list_menu"><a href="adm_ingreso.php" class="link_menu sub_link_menu">lista ingreso</a>
                        </li>
                        <li class="sub_list list_menu"><a href="adm_kardex_financiero.php" class="link_menu sub_link_menu">kardex financiero</a>
                        </li>
                    </ul>
                </li>
                <li class="list_menu">
                <div class="contenido_menu_link">
                        <img src="icon/almacen.svg" alt="" class="iconos_principal">
                        <a href="#" class="link_menu">venta</a>
                        <img src="icon/arrow-next-small-svgrepo-com (1).svg" alt="" class="arrow">
                    </div>
                    <ul class="sub_nav ">
                        <li class="sub_list list_menu"><a href="adm_venta.php" class="link_menu sub_link_menu">servicio</a></li>
                        <li class="sub_list list_menu"><a href="adm_detalle_venta.php" class="link_menu sub_link_menu">detalle venta</a></li>
                    </ul>
                </li>
                <li class="list_menu">
                <div class="contenido_menu_link">
                        <img src="icon/almacen.svg" alt="" class="iconos_principal">
                        <a href="#" class="link_menu">compra</a>
                        <img src="icon/arrow-next-small-svgrepo-com (1).svg" alt="" class="arrow">
                    </div>
                    <ul class="sub_nav ">
                        <li class="sub_list list_menu"><a href="adm_compra.php" class="link_menu sub_link_menu">compra</a></li>
                        <li class="sub_list list_menu"><a href="adm_detalle_compra.php" class="link_menu sub_link_menu">detalle compra</a></li>
                    </ul>    
                </li>
                <li class="list_menu">
                <div class="contenido_menu_link">
                        <img src="icon/almacen.svg" alt="" class="iconos_principal">
                        <a href="#" class="link_menu">pago</a>
                        <img src="icon/arrow-next-small-svgrepo-com (1).svg" alt="" class="arrow">
                    </div>
                    <ul class="sub_nav ">
                        <li class="sub_list list_menu"><a href="adm_categoria_plato.php" class="link_menu sub_link_menu">pago de servicio</a></li>
                        <li class="sub_list list_menu"><a href="adm_categoria_plato.php" class="link_menu sub_link_menu">pago trabajadores</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <section class="contenido">
            <header class="configuracion">
                <div class="icon_burger">
                    <img src="icon/burger-checklist-list-menu-navigation-svgrepo-com.svg" alt="">
                </div>
                <div class="configuracion_perfil">
                    <nav class="navbar navbar-expand-lg navbar-light w-100">
                        <div class="collapse navbar-collapse w-100" id="navbarNavDropdown">
                            <ul class="navbar-nav w-100">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                        <img src="icon/alert-svgrepo-com.svg" alt="">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"># notificaciones</a>
                                        <a class="dropdown-item" href="#">lista material stock</a>
                                        <a class="dropdown-item" href="#">lista factura vencido</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                        <img src="icon/user-circle-svgrepo-com.svg" alt="">
                                    </a>
                                    <div class="dropdown-menu dropdown-menus">
                                        <a class="dropdown-item" href="#">configurar perfil</a>
                                        <a class="dropdown-item" href="#">cerra sesion</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>