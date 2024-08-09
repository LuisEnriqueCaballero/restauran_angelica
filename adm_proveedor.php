<?php
$title_pagina = 'lista de proveedores';
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
                            opciones proveedores
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_proveedor()"><i class="fa fa-user" aria-hidden="true"></i> agregar proveedor</a>
                            <a class="dropdown-item" href="#" class="btn" onclick="ingresomaxivo()"><i class="fa fa-users" aria-hidden="true"></i> agregar masivo proveedor</a>
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
                        <label for="">nombre empresa</label>
                        <input type="text" name="empresa" id="empresa" class="form-control" placeholder="Escribe empresa">
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <label for="">proveedor</label>
                        <input type="text" name="proveedor" id="proveedor" class="form-control" placeholder="Escribe proveedor">
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar" onclick="lista_proveedor()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">empresa</th>
                            <th scope="col" class="text-center pb-4">ruc</th>
                            <th scope="col" class="text-center pb-4">nombre proveedor</th>
                            <th scope="col" class="text-center pb-4">telefono</th>
                            <th scope="col" class="text-center pb-4">direccion</th>
                            <th scope="col" class="text-center pb-4">opciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_proveedor">

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

    function lista_proveedor() {
        let nombre = $('#proveedor').val();
        let empresa =$('#empresa').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllProveedor.php?ope=1',
            data: {
                proveedor: nombre,
                empresas:empresa
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_proveedor').html('<td colspan="7" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_proveedor').html(result.html);
            }
        })
    }


    function matenimiento_proveedor(val) {
        if (!val) {
            ViewModal('media','View/modal_proveedor/insert_mat_proveedor.php','HTML','POST')
        } else {
            ViewModal('media','View/modal_proveedor/update_mat_proveedor.php?val=' + val,'HTML','GET')
        }
    }
    function EliminarDatos(val){
        ViewEliminar('View/modal_proveedor/delete_mat_proveedor.php?val='+val,'GET','HTML','media','¿Desea Eliminar este Proveedor?')
    }
    function proveedor(ope) {
        // insertar un nuevo cliente
        if (ope == 2) {
            InsertarDatos('formProveedor','POST','./Controller/ControllProveedor.php?ope=' + ope,'media',lista_proveedor)
        }
        if (ope == 3) {
            ActualizarDatos('formProveedorU','POST','./Controller/ControllProveedor.php?ope=' + ope,'media',lista_proveedor)
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
    function elimar_datos(ope,option){
        let id=$('#proveedor').val();
        if(option == 1){
            $.ajax({
                type:'POST',
                datatype:'JSON',
                data:{
                    idproveedor:id
                },
                url:'./Controller/ControllProveedor.php?ope='+ope,
                success:function(resulta){
                    if(resulta){
                        Cerrar_Modal('media');
                        procesando('media','modal_confirmacion.php','Mensaje Procesando');
                        setTimeout(function() {
                            hide_modal('mensaje');
                        }, 5000);
                        lista_proveedor();
                    }
                }
            })
        }else{
            Cerrar_Modal('media');
        }
    }

    function ingresomaxivo(){
        $.ajax({
            url: 'View/modal_proveedor/carga_masiva_proveedor.php',
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

    function ImportarProveedor(){
        let rowlista=$('#datagridProveedor').handsontable("getData");
        let resultado=[];
        $.each(rowlista,function(key,value){
            resultado.push([value[0],value[1],value[2],value[3],value[4]]);
        })
        if(resultado.length){
            $.ajax({
                type:'POST',
                dataType: 'JSON',
                data:{
                    dato:resultado,
                },
                url:'./Controller/ControllProveedor.php?ope=5',
                success:function(result){
                    if(result.mensaje){
                        Cerrar_Modal('media');
                        lista_proveedor();
                    }
                }
            })
        }else{
            console.log('no ingreso datos');
            return;
        }
    }
    lista_proveedor();
</script>

<style>

    #lista_proveedor .even {
        background-color: #212120;
        height: 60px;
        color: #F3F3F3;
        text-transform: capitalize;
    }

    #lista_proveedor .odd {
        background-color: #3A4750;
        height: 60px;
        color: #F3F3F3;
        text-transform: capitalize;
    }
</style>