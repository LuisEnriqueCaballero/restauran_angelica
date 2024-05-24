<?php
$title_pagina = 'lista de plato';
?>
<div class="conteniodo_titulio">
    <?php
    include_once 'Config/cnmysql.php';
    include_once 'Model/modal_categoria.php';

    $metodoCategoria = new MetodoCategoria();
    $lista = $metodoCategoria->lista_categoria();
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
                            Exportar
                        </a>
                        <div class="dropdown-menu">
                            <!-- <a class="dropdown-item" href="javascript:void(0)" onclick="exportarArchivos(1)"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                Excel</a> -->
                            <a class="dropdown-item"  href="javascript:void(0)" onclick="exportarArchivos(2)"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                PDF</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown" style="color: #365a64;">
                        <a class="nav-link btn-block" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            Opciones de platos
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="mantenimientoplato()"><i class="fa fa-user" aria-hidden="true"></i> Agregar platos</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-users" aria-hidden="true"></i> Agregar Masivo platos</a>
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
                        <label for="">nombre plato</label>
                        <input type="text" name="plato" id="plato" class="form-control" placeholder="escribe nombre plato">
                    </div>
                    <div class="col-sm-4 col-lg-4">
                        <label for="">Seleccione Categoria</label>
                        <select name="categoria" id="categoria" class="form-control">
                            <option value="0">Seleccione categoria</option>
                            <?php
                            while($row=mysqli_fetch_row($lista)){
                                ?>
                                <option value="<?php echo $row['0']?>"><?php echo $row['1']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar" onclick="listaplato()"><i class="fa fa-search" aria-hidden="true"></i>
                    Consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">Categoría Plato</th>
                            <th scope="col" class="text-center pb-4">plato</th>
                            <th scope="col" class="text-center pb-4">Precio</th>
                            <th scope="col" class="text-center pb-4">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_plato">

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
                "lengthcliente": "Mostrar _cliente_ registros por página",
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

    function listaplato() {
        let nombre = $('#plato').val();
        let categoria =$('#categoria').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllMenu.php?ope=1',
            data: {
                plato: nombre,
                categoria:categoria
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_plato').html('<td colspan="5" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_plato').html(result.html);
            }
        })
    }


    function mantenimientoplato(val) {
        if (!val) {
            $.ajax({
                url: 'View/modal_menu/insert_mat_menu.php',
                type: 'POST',
                dataType: 'HTML',
                success: function(data) {
                    $('#contenido_modal').html('');
                    $('#contenido_modal').html(data);
                    $('#menu').modal({
                        keyboard: false,
                        backdrop: 'static',
                        show: true
                    });
                },
                timeout: 40000
            })
        } else {
            $.ajax({
                url: 'View/modal_menu/update_mat_menu.php?val=' + val,
                type: 'GET',
                dataType: 'HTML',
                success: function(data) {
                    $('#contenido_modal').html('');
                    $('#contenido_modal').html(data);
                    $('#menu').modal({
                        keyboard: false,
                        backdrop: 'static',
                        show: true
                    });
                },
                timeout: 40000
            })
        }
    }

    function plato(ope) {
        // insertar un nuevo Menú
        if (ope == 2) {
            let formulario = $('#formMenu').serialize();
            $.ajax({
                type: 'POST',
                data: formulario,
                url: './Controller/ControllMenu.php?ope=' + ope,
                success: function(data) {
                    if (data == 1) {
                        $('#formMenu')[0].reset();
                        listaplato();
                        hideModalplato();
                        // hide_modal_cliente();
                    }
                }
            })
        }
        if (ope == 3) {
            let formulario = $('#formMenuU').serialize();
            $.ajax({
                type: 'POST',
                data: formulario,
                url: './Controller/ControllMenu.php?ope=' + ope,
                success: function(data) {
                    if (data == 1) {
                        listaplato();
                        hideModalplato();
                    }
                }
            })
        }
    }

    function eliminarplato(id) {
        let id_menu = id;
        $.ajax({
            type: 'POST',
            data: {
                id: id_menu
            },
            url: './Controller/ControllMenu.php?ope=4',
            success: function(data) {
                if (data == 1) {
                    listaplato();
                }
            }
        })
    }
    // incio exportar pdf y excel
    function exportarArchivos(e) {
        let categoria = $('#categoria').val();
        let plato=$('#plato').val();
        if(e == 1){
            //window.open('expexcel.php?exp=reportcliente&cliente='+cliente,'_blank');
        } else {
            window.open('exppdf.php?exp=report_plato&plato='+plato+'&categoria='+categoria,'_blank');
        }
    }
    // fin exportacion

    function hideModalplato() {
        $('#menu').modal('hide');
        $('#contenido_modal').html('')
        bodyModalBackdrop()
    }

    function bodyModalBackdrop() {
        $('body').children('.modal-backdrop').remove();
        $('body').removeClass();
        $('body').removeAttr('style');
    }

    listaplato();
</script>

<!-- style -->
<style>
    #lista_Mmnu .even {
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
