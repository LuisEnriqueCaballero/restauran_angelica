<?php
require_once 'Config/cnmysql.php';
require_once 'Model/modal_link.php';

$metodolink = new linkmenu();
$listamenu =$metodolink->lista_link();

foreach ($listamenu as $key) {
    $id=$key['id'];
    $menu=$key['link'];
    $icono=$key['iconno'];
}
$listasubmenu = $metodolink->lista_sublink($id);
?>

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
                    <img src="img/389394127d274b37b2ab0746bdef427a-removebg-preview.png" alt="" class="logo"
                        width="120px" height="120px">
                    <span>creatividad</span>
                </a>
            </div>
            <div class="logo_usuario">
                <a href="#" style="display: flex; flex-wrap: wrap;">
                    <img src="img/389394127d274b37b2ab0746bdef427a-removebg-preview.png" alt="" class="logo"
                        width="80px" height="80px">
                    <div class="dato_usuario">
                        <span class="nombre">luis enrique caballero</span>
                        <span class="roll">administrador</span>
                    </div>
                </a>
            </div>
            <ul class="nav">
                <li class="list_menu">
                    <div class="contenido_menu_link  activo">
                        <img src="icon/financial-report-svgrepo-com.svg" alt="" class="iconos_principal">
                        <a href="adm_dashboard.php" class="link_menu">dashboard</a>
                    </div>
                </li>
                <?php
                foreach ($listamenu as $key) {
                    $id=$key['id'];
                    $menu=$key['link'];
                    $icono=$key['iconno'];
                
                ?>
                <li class="list_menu list_menu-click">
                    <div class="contenido_menu_link ">
                        <img src="<?php echo $icono?>" alt="" class="iconos_principal">
                        <a href="#" class="link_menu"><?php echo $menu?></a>
                        <img src="icon/arrow-next-small-svgrepo-com (1).svg" alt="" class="arrow ">
                    </div>
                    <?php
                $listasubmenu = $metodolink->lista_sublink($id);
                ?>
                    <ul class="sub_nav ">
                        <?php
                        foreach ($listasubmenu as $key) {
                            $idsubmenu=$key['id'];
                            $submenu=$key['sublinkmenu'];
                            $enlace= $key['enlace'];
                       
                        ?>
                        <li class="sub_list list_menu"><a href="<?php echo $enlace?>" class="link_menu sub_link_menu"><?php echo $submenu?></a></li>
                        <?php
                         }
                        ?>
                    </ul>
                </li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <section class="contenido" id='contenido'>
            <header class="configuracion">
                <div class="icon_burger">
                    <img src="icon/burger-checklist-list-menu-navigation-svgrepo-com.svg" alt="">
                </div>
                <div class="configuracion_perfil">
                    <nav class="navbar navbar-expand-lg navbar-light w-100">
                        <div class="collapse navbar-collapse w-100" id="navbarNavDropdown">
                            <ul class="navbar-nav w-100">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="icon/alert-svgrepo-com.svg" alt="">
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"># notificaciones</a>
                                        <a class="dropdown-item" href="#">lista material stock</a>
                                        <a class="dropdown-item" href="#">lista factura vencido</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false">
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
           



