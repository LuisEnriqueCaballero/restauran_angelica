<?php
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
        <div class="tabs" style="display:flex; margin-top:-15px;">
            <div class="tab_pedido_cliente" style="border:1px solid #3A4750;border-radius:0px 0px 5px 5px ;padding:10px 10px; color:#fff; background-color:#51BCDA; cursor: pointer;" onclick="ver_pedido(1)">PEDIDO CLIENTE</div>
            <div class="tab_pedido_mesa ml-1"  style="border:1px solid #3A4750;border-radius:0px 0px 5px 5px ;padding:10px 10px; color:#fff; background-color:#51BCDA; cursor: pointer;" onclick="ver_pedido(2)">PEDIDO MESA</div>
        </div>
        <!-- lista de cliente antendido -->
        <div class="row w-ful mt-3 pedido_client">
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
                            <th scope="col" class="text-center pb-4">direccion</th>
                            <th scope="col" class="text-center pb-4">telefono</th>
                            <th scope="col" class="text-center pb-4">forma pago</th>
                            <th scope="col" class="text-center pb-4">total</th>
                            <th scope="col" class="text-center pb-4">fecha_venta</th>
                            <th scope="col" class="text-center pb-4">atencion</th>
                            <th scope="col" class="text-center pb-4">pago</th>
                            <th scope="col" class="text-center pb-4">accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_venta">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- lista de mesa antendido -->
        <div class="row w-ful mt-3 pedido_mesa" style="display:none;">
            <div class="col-sm-10">
                <div class="row ml-1">
                    <div class="col-sm-4 col-lg-4">
                        <label for="">mesa</label>
                        <input type="text" name="mesa" id="mesa" class="form-control">
                    </div>
                </div>
            </div>
            <div class="busqueda col-sm-2 mt-3">
                <button class="btn btn-default" id="consultar_mesa" onclick="lista_venta_mesa()"><i class="fa fa-search" aria-hidden="true"></i>
                    consultar</button>
            </div>
            <div class="table col-sm-12">
                <table class="table table-bordered" id="datable">
                    <thead class="">
                        <tr style="height: 70px;">
                            <th scope="col" class="text-center pb-4">#</th>
                            <th scope="col" class="text-center pb-4"># mesa</th>
                            <th scope="col" class="text-center pb-4">forma pago</th>
                            <th scope="col" class="text-center pb-4">total</th>
                            <th scope="col" class="text-center pb-4">fecha_venta</th>
                            <th scope="col" class="text-center pb-4">atencion</th>
                            <th scope="col" class="text-center pb-4">pago</th>
                            <th scope="col" class="text-center pb-4">accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_venta_mesa">

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
                $('#lista_venta').html('<td colspan="10" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar").attr("disabled", false);
                $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_venta').html(result.html);
            }
        })
    }

    function lista_venta_mesa() {
        let nummesa = $('#mesa').val();
        $.ajax({
            type: "POST",
            url: './Controller/ControllVenta.php?ope=lista_venta_mesa',
            data: {
                mesa: nummesa
            },
            dataType: 'JSON',
            beforeSend: function() {
                $("#consultar_mesa").attr("disabled", true);
                $("#consultar_mesa").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
                $('#lista_venta').html('<td colspan="6" align="center"></i> Cargando Entidades ... </td>');
            },
            success: function(result) {
                $("#consultar_mesa").attr("disabled", false);
                $("#consultar_mesa").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
                $('#lista_venta_mesa').html(result.html);
            }
        })
    }

    function matenimiento_venta(val) {
        if (!val) {
            ViewModal('media','View/modal_venta/insert_mat_venta.php','HTML','POST');
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
                    lista_venta();
                    lista_venta_mesa();
                }
            }
        })

    }

    // incio exportar pdf y excel
    // function expotararchivos(e) {
    //     var cliente = $('#cliente').val()
    //     if (e == 1) {
    //         window.open('expexcel.php?exp=reportcliente&cliente=' + cliente, '_blank');
    //     } else {
    //         window.open('exppdf.php?exp=report_egreso&' + cliente, '_blank');
    //     }
    // }
    function ticke(val,id_pedido){
        if(val == 3){
            window.open('exppdf.php?exp=recibo_detalle_pedido&id_pedido='+id_pedido,'_blank');
        }else if(val==4){
            window.open('exppdf.php?exp=factura_boleta&id_pedido='+id_pedido,'_blank');
        }else if(val==5){
            window.open('exppdf.php?exp=recibo_detalle_pedido_cliente&id_pedido='+id_pedido,'_blank');
        }else if(val==6){
            window.open('exppdf.php?exp=factura_boleta_cliente&id_pedido='+id_pedido,'_blank');
        }
    }
    // fin exportacion

    function hide_modal_venta() {
        $('#modalmedia').modal('hide');
        $('#modalmedia').html('');
    }

    function hide_modal_cancelar() {
        $('#cancelar').modal('hide');
        $('#cancelar').html('');
    }

    function contenido_selecionado() {
        ViewModal('listado','./View/modal_venta/lista_producto.php','HTML','POST')
    }

    function hide_modal_lista() {
        $('#listado').modal('hide');
        $('#listado').html('')
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
            ViewModal('listado','View/modal_lista/lista_mesa.php','HTML','POST');
        }if(val == 2){
            ViewModal('listado','View/modal_lista/lista_cliente.php','HTML','POST');
        }if(val == 3){
            ViewModal('listado','View/modal_lista/lista_delivery.php','HTML','POST');
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
                    Cerrar_Modal('listado');
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
                    Cerrar_Modal('listado');
                }
            }
        })
    }
    function seleccionarPrecio(idDelivery){
        const id = idDelivery;
        $.ajax({
            type: 'POST',
            data: {
                id_Delivery: id
            },
            dataType: 'JSON',
            url: './Controller/ControllDelivery.php?ope=4',
            success: function(result) {
                if (result.mensaje) {
                    $('#id_delivery').val(result.idDelivery),
                    $('#Pdelivery').val(result.precioDelivery);
                    Cerrar_Modal('listado');
                }
            }
        })
    }

    function ver_pedido(val){
        if(val == 1){
            $('.pedido_mesa').hide();
            $('.pedido_client').show();
            return;
        }
        if(val == 2){
            $('.pedido_mesa').show();
            $('.pedido_client').hide();
            return;
        }
    }

    function atendido(id){
        let id_pedi=id;
        $.ajax({
            type:'POST',
            data:{
                id:id_pedi
            },
            url:'./Controller/ControllVenta.php?ope=atencion',
            success:function(r){
                if(r==1){
                lista_venta()
                lista_venta_mesa(); 
            }
            }
        })
    }

    function cancelado(val){
        ViewModal('media','./View/modal_venta/cancelar_pedido.php?val='+val,'HTML','GET')
    }
    function cancelar_servicio(){
        let formulario=$('#formVentaU').serialize();
        $.ajax({
            type:'POST',
            data:formulario,
            url:'./Controller/ControllVenta.php?ope=cancelado',
            success:function(r){
                if(r==1){
                    hide_modal_cancelar();
                    lista_venta()
                    lista_venta_mesa();  
                }
            }
        })
    }
    function anulado(id){
        mensaje(id,'media','¿Deseas Anular el pedido?')
    }
    function anular_pedido(ope){
        let id=$('#pedido').val();
        if(ope==1){
            $.ajax({
            type:'POST',
            data:{
                idpedido:id
            },
            url:'./Controller/ControllVenta.php?ope=anulado',
            success:function(resultado){
                if(resultado){
                    Cerrar_Modal('media');
                    lista_venta();
                    lista_venta_mesa();
                }
            }
        })
        }else{
            Cerrar_Modal('media');
        }
    }
    lista_venta()
    lista_venta_mesa()
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