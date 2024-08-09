<?php
$title_pagina = 'lista trabajadores'
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
                            opciones trabajadores
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_empleado()"><i class="fa fa-user" aria-hidden="true"></i> agregar trabajador</a>
                            <a class="dropdown-item" href="#" class="btn" onclick="ingresomaxivo()"><i class="fa fa-users" aria-hidden="true"></i> agregar masivo trabajador</a>
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
            <div class="col-sm-10">
                <div class="row ml-1">
                    <div class="col-sm-4 col-lg-4">
                        <label for="">Empleado</label>
                        <input type="text" name="empleado" id="empleado" class="form-control">
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar_empleado" onclick="lista_empleado()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datableempleado">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">nombre</th>
                            <th scope="col" class="text-center pb-4">apellido</th>
                            <th scope="col" class="text-center pb-4">telefono</th>
                            <th scope="col" class="text-center pb-4">puesto</th>
                            <th scope="col" class="text-center pb-4">salario</th>
                            <th scope="col" class="text-center pb-4">fech. contrato</th>
                            <th scope="col" class="text-center pb-4">opciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_empleado">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
  
    $(document).ready(function() {
        $("#datableempleado").DataTable({
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

    function lista_empleado(){
        let nombre = $('#empleado').val();
        $.ajax({
            type:'POST',
            url:'./Controller/ControllEmpleado.php?ope=1',
            data:{empleado:nombre},
            dataType:'JSON',

            beforeSend:function(){
                $("#consultar_empleado").attr("disabled", true);
                $("#consultar_empleado").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_empleado').html('<td colspan="8" align="center"></i> Cargando Entidades ... </td>');
            },
            success:function(result){
                $("#consultar_empleado").attr("disabled", false);
                $("#consultar_empleado").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_empleado').html(result.html);
            },
            error: function(xhr, status, error) {
            console.error(xhr.responseText); // Muestra los errores en la consola
        }

        })
    }

    function matenimiento_empleado(val) {
        if (!val) {
            ViewModal('media','View/modal_empleado/insert_mat_empleado.php','HTML','POST')
        } else {
            ViewModal('media','View/modal_empleado/update_mat_empleado.php?val=' + val,'HTML','GET')
        }
    }

    function empleado(e){
        if(e=='2'){
            InsertarDatos('formEmpleado','POST','./Controller/ControllEmpleado.php?ope=2','media',lista_empleado);
        }else{
            ActualizarDatos('formEmpleadoU','POST','./Controller/ControllEmpleado.php?ope=3','media',lista_empleado)
        }
    }
    function EliminarDatos(val){
        ViewEliminar('View/modal_empleado/delete_mat_empleado.php?val='+val,'GET','HTML','media','¿Desea Eliminar este Empleado?')
    }

    function elimar_datos(ope,option){
        let id=$('#empleado').val();
        if(option == 1){
            $.ajax({
                type:'POST',
                datatype:'JSON',
                data:{
                    idempleado:id
                },
                url:'./Controller/ControllEmpleado.php?ope='+ope,
                success:function(resulta){
                    if(resulta){
                        Cerrar_Modal('media');
                        procesando('media','modal_confirmacion.php','Mensaje Procesando');
                        setTimeout(function() {
                            Cerrar_Modal('media');
                        }, 5000);
                        lista_empleado();
                    }
                }
            })
        }else{
            Cerrar_Modal('media');
        }
    }
    function expotararchivos(e){
	var empleado=$('#empleado').val()
    if(e == 1){
        window.open('expexcel.php?exp=reportcliente&cliente='+cliente,'_blank');
    }else{
        window.open('exppdf.php?exp=lista_empleado&empleado='+empleado,'_blank');
    }
}
function ingresomaxivo(){
        $.ajax({
            url: 'View/modal_empleado/carga_masiva_empleado.php',
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

    function ImportarEmpleado(){
        let rowlista=$('#datagridEmpleado').handsontable("getData");
        let resultado=[];
        $.each(rowlista,function(key,value){
            resultado.push([value[0],value[1],value[2],value[3],value[4],value[5]]);
        })
        if(resultado.length){
            $.ajax({
                type:'POST',
                dataType: 'JSON',
                data:{
                    dato:resultado,
                },
                url:'./Controller/ControllEmpleado.php?ope=5',
                success:function(result){
                    if(result.mensaje){
                        Cerrar_Modal('media');
                        lista_empleado();
                    }
                }
            })
        }else{
            console.log('no ingreso datos');
            return;
        }
    }
    lista_empleado();
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