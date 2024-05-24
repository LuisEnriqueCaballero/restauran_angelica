<?php
include_once 'adm_menu_navegador.php';
$title_pagina = 'pago servio';

$mes=['MES','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
$anio=date('Y');
$maximo_anio=$anio + 10;
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
                            <a class="dropdown-item" href="javascript:void(0)" onclick="expotararchivos('2')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                pdf</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown" style="color: #365a64;">
                        <a class="nav-link btn-block" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            opciones servicio
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_servicio()"><i class="fa fa-user" aria-hidden="true"></i> agregar servicio</a>

                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="contenido_infomacion p-1" id="contenido_inf">
    <div class="adm_contenido mt-3 pt-3">
        <!-- lista de cliente antendido -->
        <div class="row w-ful mt-3">
            <div class="col-sm-10">
                <div class="row ml-1">
                    <div class="col-sm-4 col-lg-4">
                        <label for="">numero recibo</label>
                        <input type="text" name="recibo" id="recibo" class="form-control">
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <label for="">mes</label>
                        <select name="mes" id="mes" class="form-control">
                            <?php
                            for($i=0; $i<count($mes);$i++){
                            ?>
                            <option value="<?php echo $i?>"><?php echo $mes[$i]?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2 col-lg-2">
                        <label for="">año</label>
                        <select name="anio" id="anio" class="form-control">
                           <option value="0">ANIO</option>
                           <?php
                            for($i=$anio; $i<$maximo_anio;$i++){
                            ?>
                            <option value="<?php echo $i?>"><?php echo $i?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <label for="">servicio</label>
                        <select name="servicio" id="servicio" class="form-control">
                           <option value="0">selec servicio</option>
                           <option value="luz">servicio luz</option>
                           <option value="agua">servicio agua</option>
                           <option value="gas">servicio gas</option>
                           <option value="internet">servicio internet</option>
                           <option value="empleado">pago empleado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar" onclick="lista_pago_servicio_general()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">empresa</th>
                            <th scope="col" class="text-center pb-4">ruc</th>
                            <th scope="col" class="text-center pb-4">servicio</th>
                            <th scope="col" class="text-center pb-4">numero recibo</th>
                            <th scope="col" class="text-center pb-4">monto</th>
                            <th scope="col" class="text-center pb-4">fecha</th>
                            <th scope="col" class="text-center pb-4">mes</th>
                            <th scope="col" class="text-center pb-4">año</th>
                        </tr>
                    </thead>
                    <tbody id="lista_pago_servicio_general">

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
    function lista_pago_servicio_general() {
        let num_recibo = $('#recibo').val();
        let meses=$('#mes').val();
        let anios=$('#anio').val();
        let servicios=$('#servicio').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllServicio.php?ope=lista_pago',
            data: {
                recibo:num_recibo,
                meses:meses,
                anio:anios,
                servicio:servicios
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_pago_servicio_general').html('<td colspan="8" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_pago_servicio_general').html(result.html);
            }
        })
    }

   

    function matenimiento_servicio(val) {
        if (!val) {
            $.ajax({
                url: 'View/modal_servicio/insert_mant_servicio_pago.php',
                type: 'POST',
                dataType: 'HTML',
                success: function(data) {
                    $('#contenido_modal').html('');
                    $('#contenido_modal').html(data);
                    $('#servicio').modal({
                        keyboard: false,
                        backdrop: 'static',
                        show: true
                    });
                },
                timeout: 40000
            })
        }
    }

    function pago_servicio() {
        let formu = $('#formservicio').serialize();
        $.ajax({
            type: 'POST',
            data: formu,
            dataType: 'JSON',
            url: "./Controller/ControllServicio.php?ope=insertat_pago",
            success: function(resul) {
                if (resul) {
                    $('#formservicio')[0].reset();
                    lista_pago_servicio_general();
                    hide_modal_servicio()
                }
            }
        })

    }

    // incio exportar pdf y excel
    function expotararchivos(e) {

        var cliente = $('#cliente').val()
        if (e == 1) {
            window.open('expexcel.php?exp=reportcliente&cliente=' + cliente, '_blank');
        } else {
            window.open('./Controller/ControllCliente.php?ope=6&cliente=' + cliente, '_blank');
        }


    }
    // fin exportacion

    function hide_modal_servicio() {
        $('#servicio').modal('hide');
        $('#contenido_modal').html('')
        body_modal_backdrop()
    }

    function body_modal_backdrop() {
        $('body').children('.modal-backdrop').first().remove();
        $('body').removeClass();
        $('body').removeAttr('style');
    }

    lista_pago_servicio_general();

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