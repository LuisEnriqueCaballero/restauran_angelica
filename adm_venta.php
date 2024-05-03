<?php
include_once 'adm_menu_navegador.php';
$title_pagina = 'lista de venta';
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
                            opciones venta
                        </a>
                        <div class="dropdown-menu" style="color: #365a64;">
                            <a class="dropdown-item" class="btn" href="#" onclick="matenimiento_venta()"><i class="fa fa-user" aria-hidden="true"></i> agregar venta</a>

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
                        <label for="">cliente</label>
                        <input type="text" name="cliente" id="cliente" class="form-control">
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar" onclick="lista_venta()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4">datos cliente</th>
                            <th scope="col" class="text-center pb-4">total</th>
                            <th scope="col" class="text-center pb-4">fecha_venta</th>
                            <th scope="col" class="text-center pb-4">estado</th>
                        </tr>
                    </thead>
                    <tbody id="lista_venta">

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
    function lista_venta() {
        let nombre = $('#cliente').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllVenta.php?ope=lista_venta',
            data: {
                cliente: nombre
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar").attr("disabled", true);
                $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_venta').html('<td colspan="6" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_venta').html(result.html);
            }
        })
    }


    function matenimiento_venta(val) {
        if (!val) {
            $.ajax({
                url: 'View/modal_venta/insert_mat_venta.php',
                type: 'POST',
                dataType: 'HTML',
                success: function(data) {
                    $('#contenido_modal').html('');
                    $('#contenido_modal').html(data);
                    $('#venta').modal({
                        keyboard: false,
                        backdrop: 'static',
                        show: true
                    });
                },
                timeout: 40000
            })
        }
    }

    function venta_servicio() {
        let formu = $('#formVenta').serialize();
        $.ajax({
            type: 'POST',
            data: formu,
            dataType: 'JSON',
            url: "./Controller/ControllVenta.php?ope=insertVenta",
            success: function(resul) {
                if (resul.mensaje) {
                    $('#formVenta')[0].reset();
                    $('#carrito_venta').html(resul.html);
                }
            }
        })

    }

    // incio exportar pdf y excel
    function expotararchivos(e) {

        var cliente = $('#cliente').val()
        if (e == 1) {
            window.open('expexcel.php?exp=reportcliente&cliente=' + cliente, '_blank');
        } else {
            window.open('./Controller/ControllCliente.php?ope=6&cliente=' + cliente, '_blank');
        }


    }
    // fin exportacion

    function hide_modal_venta() {
        $('#venta').modal('hide');
        $('#contenido_modal').html('')
        body_modal_backdrop()
    }

    function body_modal_backdrop() {
        $('body').children('.modal-backdrop').first().remove();
        $('body').removeClass();
        $('body').removeAttr('style');
    }

    function contenido_selecionado() {
        $.ajax({
            type: 'POST',
            dataType: 'HTML',
            url: 'View/modal_venta/lista_producto.php',
            success: function(datos) {
                $('#contenido_pedido').html('');
                $('#contenido_pedido').html(datos);
                $('#selecplato').modal({
                    keyboard: false,
                    backdrop: 'static',
                    show: true
                });
            },
            timeout: 40000
        })
    }

    function hide_modal_lista() {
        $('#selecplato').modal('hide');
        $('#contenido_pedido').html('')
        body_modal_backdrop()
    }

    function seleccionar(cont) {

        let id_producto = $('#id' + cont).val();
        let nombre = $('#nombre' + cont).val();
        let precio = $('#precio' + cont).val();
        let cantidad = $('#cantidad' + cont).val();
        $.ajax({
            type: 'POST',
            data: {
                id: id_producto,
                producto: nombre,
                precio,
                precio,
                cantidad: cantidad
            },
            url: './Controller/ControllVenta.php?ope=carrito_venta',
            dataType: 'JSON',
            success: function(respuesta) {
                $('#carrito_venta').html(respuesta.html);
                $('#monto').val(respuesta.total)
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Muestra los errores en la consola 
            }
        })

    }

    function quitar_pedido(id_pedido) {
        let id = id_pedido;
        $.ajax({
            type: 'POST',
            data: {
                id: id
            },
            url: '././Controller/ControllVenta.php?ope=quitar_pedido',
            dataType: 'JSON',
            success: function(respuesta) {
                $('#carrito_venta').html(respuesta.html);
                $('#monto').val(respuesta.total)
            }
        })
    }

    function vaciar_pedidos(e) {
        e.preventDefault();
        $.ajax({
            url: '././Controller/ControllVenta.php?ope=vaciar_pedidos',
            dataType: 'JSON',
            success: function(respuesta) {
                $('#carrito_venta').html(respuesta.html);
                $('#monto').val(respuesta.total)
            }

        })

    }

    // modales lista de clinete , mesa

    function viewsmodal(val) {
        if(val == 1){
            $.ajax({
                    dataType: 'HTML',
                    url: 'View/modal_lista/lista_mesa.php',
                    success: function(resulta) {
                        $('#contenido_pedido').html('');
                        $('#contenido_pedido').html(resulta);
                        $('#mesa').modal({
                            keyboard: false,
                            backdrop: 'static',
                            show: true
                        });
                    },
                  
                })
        }else{
            $.ajax({
                    dataType: 'HTML',
                    url: 'View/modal_lista/lista_cliente.php',
                    success: function(resultado) {
                        $('#contenido_pedido').html('');
                        $('#contenido_pedido').html(resultado);
                        $('#list_cliente').modal({
                            keyboard: false,
                            backdrop: 'static',
                            show: true
                        });
                    },
                    
                })
        }
       
    }

    function seleccionarMesa(idmesa) {
        let id = idmesa;
        $.ajax({
            type: 'POST',
            data: {
                id_mesa: id
            },
            dataType: 'JSON',
            url: './Controller/ControllMesa.php?ope=getdatomesa',
            success: function(result) {
                if (result.mensaje) {
                    $('#id_mesa').val(result.id_mesa),
                    $('#numero').val(result.mesa);
                    hide_modal_lista();
                }
            }
        })
    }
    function seleccionarCliente(idcliente){
        let id = idcliente;
        $.ajax({
            type: 'POST',
            data: {
                id_cliente: id
            },
            dataType: 'JSON',
            url: './Controller/ControllCliente.php?ope=getdatocliente',
            success: function(result) {
                if (result.mensaje) {
                    $('#id_cliente').val(result.id),
                    $('#cliente').val(result.dato);
                    $('#telefono').val(result.telefono),
                    $('#direccion').val(result.direccion);
                    hide_modal_lista();
                }
            }
        })
    }
    lista_venta()
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