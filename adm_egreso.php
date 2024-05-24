<?php
include_once 'adm_menu_navegador.php';
$title_pagina = 'lista de egreso';
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
            </div>
        </nav>
    </div>
</div>
<div class="contenido_infomacion p-1" id="contenido_inf">
    <div class="adm_contenido mt-3 pt-3">
        <div class="row w-ful">
            <div class="col-8">
                <div class="row" >
                    <div class="col-4">
                        <div class="row ml-1">
                            <div class="col-sm-12 col-lg-12">
                                <label for="">desde</label>
                                <input type="date" name="date_inicio" id="date_inicio" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row ">
                            <div class="col-sm-12 col-lg-12">
                                <label for="">hasta</label>
                                <input type="date" name="date_fin" id="date_fin" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="busqueda col-2 mt-3">
                <button class="btn btn-default" id="consultar" onclick="lista_egreso()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">concepto</th>
                            <th scope="col" class="text-center pb-4">monto</th>
                            <th scope="col" class="text-center pb-4">fecha registrado</th>
                        </tr>
                    </thead>
                    <tbody id="lista_egreso">

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

    function lista_egreso() {
        let inicio = $('#date_inicio').val();
        let final = $('#date_fin').val();
        $.ajax({
            
            type: "POST",
            url: './Controller/ControllFinanciero.php?ope=egreso',
            data: {
                fech_inicio:inicio,
                fech_final:final,
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_egreso').html('<td colspan="4" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_egreso').html(result.html);
            }
        })
    }

    // incio exportar pdf y excel
    function expotararchivos(e) {
        let inicio = $('#date_inicio').val();
        let final = $('#date_fin').val();
        if (e == 1) {
            window.open('expexcel.php?exp=reportcliente&cliente=' + cliente, '_blank');
        } else {
            window.open('exppdf.php?exp=report_egreso&inic_date='+inicio+'&fin_date='+final, '_blank');
        }


    }
    // fin exportacion

    function hide_modal_caja() {
        $('#caja').modal('hide');
        $('#contenido_modal').html('')
        body_modal_backdrop()
    }

    function body_modal_backdrop() {
        $('body').children('.modal-backdrop').remove();
        $('body').removeClass();
        $('body').removeAttr('style');
    }

    lista_egreso();
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