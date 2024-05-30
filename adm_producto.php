<?php
$title_pagina = 'lista de productos';
?>

<div class="conteniodo_titulio">
    <?php
    include_once 'Config/cnmysql.php';
    include_once 'Model/modal_producto.php';
    $metodoCategoria =new MetodoProducto();
    $lista=$metodoCategoria->lista_CategoriaProducto();
    ?>
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
                            opciones producto
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_producto()"><i class="fa fa-user" aria-hidden="true"></i> agregar producto</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-users" aria-hidden="true"></i> agregar masivo producto</a>
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
                        <label for="">producto</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="nombre producto">
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <label for="">categoria</label>
                        <select name="categor" id="categor" class="form-control">
                            <option value="0">Seleccione categoria</option>
                            <?php
                            while($row=mysqli_fetch_row($lista)){
                                ?>
                                <option value="<?php echo $row['0'] ?>"><?php echo $row['1'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar" onclick="lista_producto()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">categoria</th>
                            <th scope="col" class="text-center pb-4">prducto</th>
                            <th scope="col" class="text-center pb-4">opciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_producto">

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

    function lista_producto() {
        let nombre = $('#descripcion').val();
        let catego = $('#categor').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllProducto.php?ope=5',
            data: {
                producto: nombre,
                categoria: catego
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_producto').html('<td colspan="4" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_producto').html(result.html);
            }
        })
    }


    function matenimiento_producto(val) {
        if (!val) {
            $.ajax({
                url: 'View/modal_producto/insert_mat_producto.php',
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
                timeout: 40000
            })
        } else {
            $.ajax({
                url: 'View/modal_producto/update_mat_producto.php?val=' + val,
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
                timeout: 40000
            })
        }
    }

    function producto(ope) {
        // insertar un nuevo categoria
        if (ope == 6) {
            let formulario = $('#formProducto').serialize();
            $.ajax({
                type: 'POST',
                data: formulario,
                url: './Controller/ControllProducto.php?ope=' + ope,
                success: function(data) {
                    if (data == 1) {
                        $('#formProducto')[0].reset();
                        hide_modal_producto();
                        lista_producto();
                    }
                }
            })
        }
        if (ope == 7) {
            let formulario = $('#formProductoU').serialize();
            $.ajax({
                type: 'POST',
                data: formulario,
                url: './Controller/ControllProducto.php?ope=' + ope,
                success: function(data) {
                    if (data == 1) {
                        hide_modal_producto();
                        lista_producto();
                    }
                }
            })
        }
    }

    function eliminar_producto(id) {
        let id_producto = id;
        $.ajax({
            type: 'POST',
            data: {
                id: id_producto
            },
            url: './Controller/ControllProducto.php?ope=8',
            success: function(data) {
                if (data == 1) {
                    lista_producto();
                }
            }
        })
    }
// incio exportar pdf y excel
function expotararchivos(e){
  
	var categoria=$('#categoria').val()
    if(e == 1){
        window.open('expexcel.php?exp=reportcategoria&categoria='+categoria,'_blank');
    }else{
        window.open('./Controller/Controllcategoria.php?ope=6&categoria='+categoria,'_blank');
    }
	

}
// fin exportacion

    function hide_modal_producto() {
        $('#modalmedia').modal('hide');
        $('#modalmedia').html('');
    }
    lista_producto();
</script>

<!-- style -->
<style>
    #lista_categoria .even {
        background-color: #F3F0FB;
        height: 60px;
        color: #365a64;
        text-transform: capitalize;
    }

    #lista_categoria .odd {
        background-color: #E7EAEF;
        height: 60px;
        color: #365a64;
        text-transform: capitalize;

    }
</style>