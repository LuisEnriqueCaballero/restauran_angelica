<?php
$title_pagina = 'Delivery Precio por distancia'
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
                            opciones
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_nuevo()"><i class="fa fa-user" aria-hidden="true"></i> agregar</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-users" aria-hidden="true"></i> agregar masivo</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="contenido_infomacion p-1">
    <div class="adm_contenido mt-3 pt-3">
        <div class="row w-ful">
            <div class="table col-sm-12">
                <table class="table table-bordered" id="databledelivery">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">Distancias por Kilometro</th>
                            <th scope="col" class="text-center pb-4">Precio</th>
                            <th scope="col" class="text-center pb-4">opciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_delivery">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
  
    $(document).ready(function() {
        $("#databledelivery").DataTable({
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

    function lista_delivery(){
        $.ajax({
            type:'POST',
            url:'./Controller/ControllDelivery.php?ope=1',
            dataType:'JSON',
            beforeSend:function(){
                $('#lista_delivery').html('<td colspan="8" align="center"></i> Cargando Entidades ... </td>');
            },
            success:function(result){
                $('#lista_delivery').html(result.html);
            },
            error: function(xhr, status, error) {
            console.error(xhr.responseText); // Muestra los errores en la consola
        }

        })
    }

    function matenimiento_nuevo(val) {
        if (!val) {
            ViewModal('media','View/modal_delivery/insert_delivery.php','HTML','POST')
        } else {
            ViewModal('media','View/modal_delivery/update_delivery.php?val=' + val,'HTML','GET')
        }
    }

    function Delivery(e){
        if(e=='2'){
            InsertarDatos('formDelivery','POST','./Controller/ControllDelivery.php?ope=2','media',lista_delivery);
        }else{
            ActualizarDatos('formDeliveryU','POST','./Controller/ControllDelivery.php?ope=3','media',lista_delivery)
        }
    }

   
    lista_delivery();
</script>
<!-- style -->
<style>
    #lista_empleado .even {
        background-color: #212120;
        height: 60px;
        color: #F3F3F3;
        text-transform: capitalize;
    }

    #lista_empleado .odd {
        background-color: #3A4750;
        height: 60px;
        color: #F3F3F3;
        text-transform: capitalize;
    }
</style>