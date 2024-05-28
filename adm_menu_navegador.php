<?php
session_start();
if(!empty($_SESSION['usuario'])){
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
    <div class="modal fade" id="modalmedia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
    <div class="modal fade" id="listado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
    <div class="modal fade" id="cancelar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>
    <div class="modal fade" id="mensaje" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <a href="adm_menu_navegador.php" class="link_menu">dashboard</a>
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
                        <li class="sub_list list_menu"><a href="#" class="link_menu sub_link_menu"
                                onclick="load('contenido_restaurante','<?php echo $enlace?>')"><?php echo $submenu?></a>
                        </li>
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
                                        <a class="dropdown-item" href="<?php echo "cerrar_sesion.php"?>">cerra
                                            sesion</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <div id="contenido_restaurante">
                <div class="conteniodo_titulio">
                    <?php
                     $anio=date('Y');
                     $maxano=$anio +10;
                     $fecha=date('Y-m-d');
                     ?>
                </div>
                <div class="contenido_infomacion p-1">
                    <div class="contenido_cajas">
                        <div class="card" style="width:380px;">
                            <div class="card-body">
                                <div class="cards">
                                    <div>
                                        <h4>Monto Caja del dia</h4>
                                        <h5>Cantidad</h5>
                                        <h5>fecha</h5>
                                    </div>
                                    <div>
                                        <img src="" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="width:380px;">
                            <div class="card-body">
                                <div class="cards">
                                    <div>
                                        <h4>Monto Caja del Mes</h4>
                                        <h5>Cantidad</h5>
                                        <h5>mes</h5>
                                    </div>
                                    <div>
                                        <img src="" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="width:380px;">
                            <div class="card-body">
                                <div class="cards">
                                    <div>
                                        <h4>Monto Caja del año</h4>
                                        <h5>Cantidad</h5>
                                        <h5>año</h5>
                                    </div>
                                    <div>
                                        <img src="" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="graficas">
                    <h1 class="titulo_graficas text-center">GRAFICAS DEL RESTAURAN</h1>
                    <div class="grafica_material grafica_dashbord">
                        <h2>Grafica lineal de Ingreso vs Egreso por dia</h2>
                        <div class="form-row" style="display:flex; justify-content: flex-start;align-items:center">
                            <div class="col-sm-3">
                                <label for="">Desde</label>
                                <input type="date" name="fech_inicio" id="fech_inicio" class="form-control"
                                    value='2024-05-01'>
                            </div>
                            <div class="col-sm-3">
                                <label for="">Hasta</label>
                                <input type="date" name="fech_fin" id="fech_fin" class="form-control"
                                    value="<?php echo $fecha?>">
                            </div>
                            <div class="col-sm-3" style="margin-top:30px">
                                <button type="button" class="btn btn-success form-control"
                                    onclick="grafifecha()">Buscar</button>
                            </div>
                        </div>
                        <canvas id="datafechas">

                        </canvas>
                    </div>
                    <div class="grafica_mensual grafica_dashbord">
                        <h2>Grafica barras de Ingreso vs Egreso mes por año</h2>
                        <label for="">Año</label>
                        <select name="anio" id="anio" class="form-control" onchange="anio()">
                            <?php
                for($i=$anio; $i<$maxano; $i++){
                ?>
                            <option value="<?php echo $i?>"><?php echo $i?></option>
                            <?php
                 }
                ?>
                        </select>
                        <canvas id="dataanio">

                        </canvas>
                    </div>
                    <div class="grafica_mensual grafica_dashbord mt-1">
                        <h2>Grafica de pie pedido mas demandado</h2>
                        <canvas id="graficopie">

                        </canvas>
                    </div>
                    <div class="grafica_mensual grafica_dashbord mt-1">
                        <h2>tabla de lista menu mas pedidos</h2>
                        <table class="table table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center text-capitalize">#Orden</th>
                                    <th class="text-center text-capitalize">Producto</th>
                                    <th class="text-center text-capitalize">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody id="lista_pedido">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="material_demandado">

                </div>
            </div>
        </section>
    </section>
</body>
<script src="lib/jquery/code.jquery.com_jquery-3.6.0.min.js"></script>
<script src="lib/jquery/popper.min.js"></script>
<script src="lib/jquery/bootstrap.min.js"></script>
<script src="lib/jquery/cdn.datatables.net_1.13.5_js_jquery.dataTables.min.js"></script>
<script src="lib/chartjs/chart.umd.min.js"></script>
<script src="lib/alert/sweetalert.min.js"></script>
<script src="js/main.js"></script>

</html>
<?php
}else{
    header("location:index.html");
}
?>
<script>
function load(div, url) {
    $('#' + div).load(url);
}

anio();
grafifecha();
graficopie();
lista_pedido();

function lista_pedido() {
    $.ajax({
        dataType: 'json',
        url: './Controller/ControllGrafica.php?ope=maspedido',
        success: function(result) {
            $('#lista_pedido').html(result.html);
        }
    })
}

function anio(e) {
    let anio = $('#anio').val();
    let mese = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE',
        'NOVIEMBRE', 'DICIEMBRE'
    ];
    $.ajax({
        type: 'POST',
        data: {
            id: anio
        },
        url: './Controller/ControllGrafica.php?ope=grafica_anio',
        dataType: 'json',
        success: function(resultado) {

            let mesesLabels = resultado.meses.map(numeroMes => mese[numeroMes - 1]);
            const dataanio = document.querySelector('#dataanio');

            // Destroy existing chart instance if it exists
            if (window.myChart instanceof Chart) {
                window.myChart.destroy();
            }

            window.myChart = new Chart(dataanio, {
                type: 'bar',
                data: {
                    labels: mesesLabels,
                    datasets: [{
                            label: 'EGRESO',
                            data: resultado.montoegreso,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'INGRESO',
                            data: resultado.montoingreso,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'TOTAL',
                            data: resultado.total,
                            backgroundColor: 'rgba(35, 155, 86, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(35, 155, 86, 1)',
                            borderWidth: 1
                        }
                    ]

                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })

}

// Call the function when the document is ready
function grafifecha() {
    let fecha_inicio = $("#fech_inicio").val();
    let fecha_fin = $("#fech_fin").val();
    $.ajax({
        type: 'POST',
        data: {
            fech_ini: fecha_inicio,
            fech_fi: fecha_fin
        },
        url: './Controller/ControllGrafica.php?ope=grafica_meses',
        dataType: 'json',
        success: function(result) {

            const fechadato = document.querySelector('#datafechas');

            // Destroy existing chart instance if it exists
            if (window.graficafech instanceof Chart) {
                window.graficafech.destroy();
            }

            window.graficafech = new Chart(fechadato, {
                type: 'line',
                data: {
                    labels: result.fecha,
                    datasets: [{
                            label: 'EGRESO',
                            data: result.egreso,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'INGRESO',
                            data: result.ingreso,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }
                    ]

                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })
}

function graficopie() {
    $.ajax({
        url: './Controller/ControllGrafica.php?ope=grafico_pie',
        dataType: 'json',
        success: function(resulta) {
            const piegrafico = document.querySelector('#graficopie');
            if (window.graficapie instanceof Chart) {
                window.graficapie.destroy();
            }
            window.graficapie = new Chart(piegrafico, {
                type: 'pie',
                data: {
                    labels: resulta.producto,
                    datasets: [{
                        label: 'cantidad',
                        data: resulta.cantidad,
                        backgroundColor: [
                            'rgb(245, 183, 177)',
                            'rgb(235, 222, 240)',
                            'rgb(169, 204, 227)',
                            'rgb(163, 228, 215)',
                            'rgb(22, 160, 133)',
                            'rgb(244, 208, 63)',
                            'rgb(214, 137, 16)',
                            'rgb(151, 154, 154)',
                            'rgb(52, 73, 94)',
                            'rgb(255, 99, 132)'
                        ],
                        hoverOffset: 4
                    }]
                },

            });
        }
    })
}
</script>