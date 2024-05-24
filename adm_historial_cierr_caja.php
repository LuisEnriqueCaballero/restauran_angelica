<?php
include_once 'adm_menu_navegador.php';
$title_pagina = 'HISTORIAL DE CIERRE CAJA';

$mes =['SELECCIONE MES','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
$anio=date('Y');
$anio_minimo=$anio;
$anio_maximo=$anio+10;
?>

<div class="conteniodo_titulio">
    <div class="title_conten">
        <h4><?php echo $title_pagina ?></h4>
    </div>
    <div class="opciones_contenido">
        <nav class="navbar navbar-expand-lg">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            exportar
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="expotararchivos('1')"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                excel</a>
                            <a class="dropdown-item"  href="javascript:void(0)" onclick="expotararchivos('2')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                pdf</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="contenido_infomacion p-1" id="contenido_inf">
    <div class="adm_contenido mt-3 pt-3">
        <div class="tabs" style="display:flex; margin-top:-15px;">
            <div class="tab_pedido_cliente" style="border:1px solid #3A4750;border-radius:0px 0px 5px 5px ;padding:10px 10px; color:#fff; background-color:#51BCDA; cursor: pointer;" onclick="ver_cierre(1)">FECHA CIERRE</div>
            <div class="tab_pedido_mesa ml-1"  style="border:1px solid #3A4750;border-radius:0px 0px 5px 5px ;padding:10px 10px; color:#fff; background-color:#51BCDA; cursor: pointer;" onclick="ver_cierre(2)">AÑO Y MES CIERRE</div>
        </div>
        <div class="row w-ful mt-3">
            <div class="col-8">
                <div class="row" >
                    <div class="col-3 fecha_day">
                        <div class="row ml-1">
                            <div class="col-sm-12 col-lg-12">
                                <label for="">desde</label>
                                <input type="date" name="date_inicio" id="date_inicio" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 fecha_day">
                        <div class="row ">
                            <div class="col-sm-12 col-lg-12">
                                <label for="">hasta</label>
                                <input type="date" name="date_fin" id="date_fin" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 fecha_mes" style="display:none;">
                        <div class="row ">
                            <div class="col-sm-12 col-lg-12">
                                <label for="">mes</label>
                                <select name="mes" id="mes" class="form-control">
                                <?php
                                for($i=0; $i<count($mes); $i++){
                                ?>
                                <option value="<?php echo $i?>"><?php echo $mes[$i]?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 fecha_mes" style="display:none;">
                        <div class="row ">
                            <div class="col-sm-12 col-lg-12">
                                <label for="">año</label>
                                <select name="anio" id="anio" class="form-control">
                                    <option value="0">seleccione año</option>
                                    <?php
                                    for($i=$anio_minimo; $i<=$anio_maximo; $i++){
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php
                                     }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3 fecha_day">
                <button class="btn btn-default" id="consultar" onclick="lista_histirial_caja()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="busqueda col-sm-2 mt-3 fecha_mes" style="display:none;">
                <button class="btn btn-default" id="consultar" onclick="lista_histirial_caja_mes()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12 fecha_day">
                <table class="table table-bordered" >
                    <thead class="">
                        <tr style="height: 70px;">
                           
                            <th scope="col" class="text-center pb-4">numero caja</th>
                            <th scope="col" class="text-center pb-4">monto</th>
                            <th scope="col" class="text-center pb-4">fecha</th>
                            <th scope="col" class="text-center pb-4">fecha hora</th>
                        </tr>
                    </thead>
                    <tbody id="lista_histirial_caja_day">

                    </tbody>
                </table>
            </div>
            <div class="table col-sm-12 fecha_mes" style="display:none;">
                <table class="table table-bordered" >
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">numero caja</th>
                            <th scope="col" class="text-center pb-4">monto</th>
                            <th scope="col" class="text-center pb-4">mes</th>
                            <th scope="col" class="text-center pb-4">año</th>
                        </tr>
                    </thead>
                    <tbody id="lista_histirial_caja_anio">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</section>
</section>
</body>

</html>
<script src="lib/jquery/code.jquery.com_jquery-3.6.0.min.js"></script>
<script src="lib/jquery/popper.min.js"></script>
<script src="lib/jquery/bootstrap.min.js"></script>
<script src="lib/jquery/cdn.datatables.net_1.13.5_js_jquery.dataTables.min.js"></script>
<script src="js/main.js"></script>
<script>
    $(document).ready(function() {
        $("#datable").DataTable({
            searching: false, // Desactivar el buscador
            lengthChange: false, // Desactivar la opción de cambiar el número de filas por página
            paging: true, // Habilitar la paginación
            info: false, // Mostrar información sobre la tabla
            // pagingType: "simple", // Tipo de paginación simple para mostrar solo los botones de navegación
            ordering: false, //para desactiva el orden columna
            language: {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(filtrados de _MAX_ registros totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna en orden ascendente",
                    "sortDescending": ": Activar para ordenar la columna en orden descendente"
                }
            }
        });
    })

    function lista_histirial_caja() {
        // let nombre = $('#cliente').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllCaja.php?ope=cierre_caja_day',
            // data: {
            //     cliente: nombre
            // },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_histirial_caja_day').html('<td colspan="5" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_histirial_caja_day').html(result.html);
            }
        })
    }

    function lista_histirial_caja_mes() {
        // let nombre = $('#cliente').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllCaja.php?ope=cierre_caja_mes',
            // data: {
            //     cliente: nombre
            // },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_histirial_caja_anio').html('<td colspan="5" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_histirial_caja_anio').html(result.html);
            }
        })
    }

    function lista_cierre(){
        lista_histirial_caja();
        lista_histirial_caja_mes();
    }

    lista_cierre();
    function ver_cierre(val){
        if(val == 1){
            $('.fecha_day').show(2000);
            $('.fecha_mes').hide(2000);
            return;
        }
        if(val==2){
            $('.fecha_day').hide(2000);
            $('.fecha_mes').show(2000);
            return;
        }
    }
// incio exportar pdf y excel
function expotararchivos(e){
  
	var cliente=$('#cliente').val()
    if(e == 1){
        window.open('expexcel.php?exp=reportcliente&cliente='+cliente,'_blank');
    }else{
        window.open('./Controller/ControllCliente.php?ope=6&cliente='+cliente,'_blank');
    }
}
// fin exportacion

    
</script>

<!-- style -->
<style>
    #lista_cliente .even {
        background-color: #F3F0FB;
        height: 60px;
        color: #365a64;
        text-transform: capitalize;
    }

    #lista_cliente .odd {
        background-color: #E7EAEF;
        height: 60px;
        color: #365a64;
        text-transform: capitalize;

    }
</style>