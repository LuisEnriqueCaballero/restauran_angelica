<?php
$title_pagina = 'lista de mesa';
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
                            opciones mesa
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_mesa()"><i class="fa fa-user" aria-hidden="true"></i> agregar mesa</a>
                            <a class="dropdown-item" href="#" class="btn" onclick="ingresomaxivo()"><i class="fa fa-users" aria-hidden="true"></i> agregar masivo mesa</a>
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
            <!-- <div class="col-sm-10">
                <div class="row ml-1">
                    <div class="col-sm-4 col-lg-4">
                        <label for="">Mesa</label>
                        <input type="text" name="Mesa" id="Mesa" class="form-control">
                    </div>
                </div>
            </div> -->
            <!-- <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar" onclick="lista_mesa()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div> -->
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">numero mesa</th>
                            <th scope="col" class="text-center pb-4">capacidad</th>
                            <th scope="col" class="text-center pb-4">estado</th>
                            <th scope="col" class="text-center pb-4">opciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_mesa">

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

    function lista_mesa() {
        $.ajax({
            type: "POST",
            url: './Controller/ControllMesa.php?ope=1',
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_mesa').html('<td colspan="5" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_mesa').html(result.html);
            }
        })
    }


    function matenimiento_mesa(val) {
        if (!val) {
            ViewModal('media','View/modal_mesas/insert_mat_mesa.php','HTML','POST')
        } else {
            ViewModal('media','View/modal_mesas/update_mat_mesa.php?val=' + val,'HTML','GET')
        }
    }

    function mesa(ope) {
        // insertar un nuevo Mesa
        if (ope == 2) {
            InsertarDatos('formMesa','POST','./Controller/ControllMesa.php?ope='+ope,'media',lista_mesa)
        }
        if (ope == 3) {
            ActualizarDatos('formMesaU','POST','./Controller/ControllMesa.php?ope=' + ope,'media',lista_mesa)
        }
    }

    function eliminar_mesa(id) {
        let id_mesa = id;
        $.ajax({
            type: 'POST',
            data: {
                id: id_mesa
            },
            url: './Controller/ControllMesa.php?ope=4',
            success: function(data) {
                if (data == 1) {
                    lista_mesa();
                }
            }
        })
    }
// incio exportar pdf y excel
function expotararchivos(e){
  
	var Mesa=$('#Mesa').val()
    if(e == 1){
        window.open('expexcel.php?exp=reportMesa&Mesa='+Mesa,'_blank');
    }else{
        window.open('./Controller/ControllMesa.php?ope=6&Mesa='+Mesa,'_blank');
    }
	

}
function ingresomaxivo(){
        $.ajax({
            url: 'View/modal_mesas/carga_masiva.php',
            type: 'POST',
            dataType: 'HTML',
            success: function(data) {
                $('#modalmedia').html('');
                $('#modalmedia').html(data);
                $('#modalmedia').modal({
                    keyboard: false,
                    backdrop: 'static',
                    show: true
                });
            },
            timeout: 4000
    })
    }
    function ImportarMesa(){
        let rowlista=$('#datagridMesa').handsontable("getData");
        let resultado=[];
        $.each(rowlista,function(key,value){
            resultado.push([value[0],value[1],value[2]]);
        })
        if(resultado.length){
            $.ajax({
                type:'POST',
                dataType: 'JSON',
                data:{
                    dato:resultado,
                },
                url:'./Controller/ControllMesa.php?ope=5',
                success:function(result){
                    if(result.mensaje){
                        Cerrar_Modal('media');
                        lista_mesa();
                    }
                }
            })
        }else{
            console.log('no ingreso datos');
            return;
        }
    }
// fin exportacion

    function hide_modal_mesa() {
        $('#modalmedia').modal('hide');
        $('#modalmedia').html('')
    }

    lista_mesa();
</script>

<!-- style -->
<style>
    #lista_mesa .even {
        background-color: #212120;
        height: 60px;
        color: #F3F3F3;
        text-transform: capitalize;
    }

    #lista_mesa .odd {
        background-color: #3A4750;
        height: 60px;
        color: #F3F3F3;
        text-transform: capitalize;

    }
</style>