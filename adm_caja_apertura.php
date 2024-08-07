<?php
$title_pagina='Lista de caja Aperturadas';
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
                <ul class="navbar-nav">
                    <li class="nav-item dropdown" style="color: #365a64;">
                        <a class="nav-link btn-block" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            opciones caja
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_multicaja()"><i class="fa fa-user" aria-hidden="true"></i> apertura nueva caja</a>
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
            <div class="col-sm-10">
                <div class="row ml-1">
                    <div class="col-sm-4 col-lg-4">
                        <label for="">numero caja</label>
                        <input type="text" name="numero" id="numero" class="form-control">
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar" onclick="lista_multicaja()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">descripcion</th>
                            <th scope="col" class="text-center pb-4">monto</th>
                            <th scope="col" class="text-center pb-4">fecha_abertura</th>
                            <th scope="col" class="text-center pb-4">mes</th>
                            <th scope="col" class="text-center pb-4">anio</th>
                            <th scope="col" class="text-center pb-4">estado</th>
                            <th scope="col" class="text-center pb-4">aumentar</th>
                            <th scope="col" class="text-center pb-4">opciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_multicaja">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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

    function lista_multicaja() {
        $.ajax({
            type: "POST",
            url: './Controller/ControllCaja.php?ope=1',
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_multicaja').html('<td colspan="8" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_multicaja').html(result.html);
            }
        })
    }

    lista_multicaja();
    function matenimiento_multicaja(val) {
        if (!val) {
            ViewModal('media','View/modal_caja/insert_mant_apertcaja.php','HTML','POST')
        } else {
            ViewModal('media','View/modal_caja/update_mant_apertcaja.php?val=' + val,'HTML','GET')
        }
    }

    function apertura_caja(ope) {
        // insertar un nuevo cliente
        if (ope == 2) {
            InsertarDatos('formCaja','POST','./Controller/ControllCaja.php?ope=' + ope,'media',lista_multicaja)
        }
        if (ope == 3) {
            ActualizarDatos('formCajaU','POST','./Controller/ControllCaja.php?ope=' + ope,'media',lista_multicaja)
        }
    }
    function CierreDia(id){
        ViewEliminar('View/modal_caja/CierreDia.php?val='+id,'POST','HTML','media','¿Desea Cerrar esta caja?');
    }
    function cierre_caja() {
        let form=$('#formcierre').serialize();
        $.ajax({
            type: 'POST',
            data: form,
            url: './Controller/ControllCaja.php?ope=4',
            success: function(data) {
                if (data == 1) {
                    lista_multicaja();
                    Cerrar_Modal('media');
                }
            }
        })
    }
    function aumentar(val){
        $.ajax({
            type: 'GET',
            dataType: 'HTML',
            url: 'View/modal_caja/aumenta_monto.php?val=' + val,
            success: function(data) {
                    $('#modalmedia').html('');
                    $('#modalmedia').html(data);
                    $('#modalmedia').modal({
                        keyboard: false,
                        backdrop: 'static',
                        show: true
                    });
                },
        })
    }
    function ingresadinero(){
        let formulario = $('#formingreso').serialize();
            $.ajax({
                type: 'POST',
                data: formulario,
                url: './Controller/ControllCaja.php?ope=aumentadinero',
                success: function(data) {
                    if (data == 1) {
                        lista_multicaja();
                        hide_modal_caja();
                    }
                }
            })
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

    function hide_modal_caja() {
        $('#modalmedia').modal('hide');
        $('#modalmedia').html('');
    }
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