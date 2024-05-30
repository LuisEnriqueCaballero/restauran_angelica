
<div class="conteniodo_titulio">
    <div class="title_conten">
        <h4></h4>
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
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_caja()"><i class="fa fa-user" aria-hidden="true"></i> agregar cajas</a>
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
                <button class="btn btn-default" id="consultar" onclick="lista_caja()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">descripcion caja</th>
                            <th scope="col" class="text-center pb-4">fecha</th>
                            <th scope="col" class="text-center pb-4">mes</th>
                            <th scope="col" class="text-center pb-4">año</th>
                            <th scope="col" class="text-center pb-4">estado</th>
                            <th scope="col" class="text-center pb-4">opciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista_caja">

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

    function lista_caja() {
        // let nombre = $('#cliente').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllCaja.php?ope=caja',
            // data: {
            //     cliente: nombre
            // },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_caja').html('<td colspan="7" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_caja').html(result.html);
            }
        })
    }


    function matenimiento_caja(val) {
        if (!val) {
            $.ajax({
                url: 'View/modal_caja/insert_mant_caja.php',
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
                url: 'View/modal_caja/upd_mant_caja.php?val=' + val,
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

    function caja(ope) {
        // insertar un nuevo caja
        if (ope == 2) {
            let formulario = $('#formCaja').serialize();
            $.ajax({
                type: 'POST',
                data: formulario,
                url: './Controller/ControllCaja.php?ope=crearcaja',
                success: function(data) {
                    if (data) {
                        $('#formCaja')[0].reset();
                        lista_caja();
                        hide_modal_caja()
                    }
                }
            })
        }
        if (ope == 3) {
            let formulario = $('#formCajaU').serialize();
            $.ajax({
                type: 'POST',
                data: formulario,
                url: './Controller/ControllCaja.php?ope=updatecaja',
                success: function(data) {
                    if (data) {
                        lista_caja();
                        hide_modal_caja()
                    }
                }
            })
        }
    }

    function eliminar_caja(id) {
        let id_caja = id;
        $.ajax({
            type: 'POST',
            data: {
                id: id_caja
            },
            url: './Controller/ControllCaja.php?ope=deletecaja',
            success: function(data) {
                if (data) {
                    lista_caja();
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
        $('#modalmedia').html('')
    }
    lista_caja();
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