<div class="conteniodo_titulio">
    <div class="title_conten">
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
                            opciones categoria
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_categoria()"><i class="fa fa-user" aria-hidden="true"></i> agregar categoria</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-users" aria-hidden="true"></i> agregar masivo categoria</a>
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
                        <label for="">categoria</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control">
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar" onclick="lista_categoria()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div> -->
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">descripcion categoria</th>
                            <th scope="col" class="text-center pb-4">opciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_categoria">

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

    function lista_categoria() {
        // let nombre = $('#descripcion').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllCategoria.php?ope=1',
            // data: {
            //     categoria: nombre
            // },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_categoria').html('<td colspan="3" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_categoria').html(result.html);
            }
        })
    }


    function matenimiento_categoria(val) {
        if (!val) {
            $.ajax({
                url: 'View/modal_categoria/insert_mat_categoria.php',
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
                url: 'View/modal_categoria/update_mat_categoria.php?val=' + val,
                type: 'GET',
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

    function categoria(ope) {
        // insertar un nuevo categoria
        if (ope == 2) {
            let formulario = $('#formCategoria').serialize();
            $.ajax({
                type: 'POST',
                data: formulario,
                url: './Controller/ControllCategoria.php?ope=' + ope,
                success: function(data) {
                    if (data == 1) {
                        $('#formCategoria')[0].reset();
                        hide_modal_categoria();
                        lista_categoria();
                    }
                }
            })
        }
        if (ope == 3) {
            let formulario = $('#formCategoriaU').serialize();
            $.ajax({
                type: 'POST',
                data: formulario,
                url: './Controller/ControllCategoria.php?ope=' + ope,
                success: function(data) {
                    if (data == 1) {
                        hide_modal_categoria();
                        lista_categoria();
                    }
                }
            })
        }
    }

    function eliminar_categoria(id) {
        let id_categoria = id;
        $.ajax({
            type: 'POST',
            data: {
                id: id_categoria
            },
            url: './Controller/ControllCategoria.php?ope=4',
            success: function(data) {
                if (data == 1) {
                    lista_categoria();
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

    function hide_modal_categoria() {
        $('#modalmedia').modal('hide');
        $('#modalmedia').html('');
    }
    lista_categoria();
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