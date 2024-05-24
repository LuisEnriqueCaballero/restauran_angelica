<!-- style modal -->
<style>
    .modal-body form .form-row {
        margin: 10px;
        padding: 10px;
    }

    .modal-body label {
        text-transform: capitalize;
        color: #11235A;
        font-family: sans-serif;
        font-size: 18px;
    }

    .modal-body input {
        height: 60px;
        text-transform: uppercase;
    }

    .modal-body select {
        height: 60px;
        text-transform: uppercase;
    }

    .modal-footer button {
        border: 1px solid #B6BBC4;
        text-transform: capitalize;
        padding: 10px 15px 10px 15px;
        font-family: sans-serif;
    }

    modal-header .modal-title {
        font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px;
    }

    .acciones {
        display: flex;
        justify-content: end;
    }

    .acciones button {
        border: 1px solid #B6BBC4;
        text-transform: capitalize;
        padding: 10px 15px 10px 15px;
        font-family: sans-serif;
        margin-left: 10px;
    }
</style>
<!-- Modal  Estrutura-->
<div class="modal fade" id="venta" tabindex="-1" >
    <div class="modal-dialog  modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">Nuevo Venta</h5>
                <button type="button" class="close" aria-label="Close" onclick="hide_modal_venta()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formVenta">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">tipo atencion</label>
                            <select name="atencion" id="atencion" class="form-control" onchange="forma_atencion(this.value)">
                                <option value="0">Seleccion el tipo atencion</option>
                                <option value="mesa">Atencion mesa</option>
                                <option value="cliente">Atencion a cliente</option>
                                <option value="delivery">Delivery</option>
                            </select>
                        </div>
                        <div class="col-sm-6 atencion_mesa" hidden>
                            <label for="cliente">id mesa</label>
                            <input type="text" name="id_mesa" id="id_mesa" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6 atencion_mesa" style="display: none;">
                            <label for="cliente"># mesa</label>
                            <input type="text" name="numero" id="numero" class="form-control" placeholder="numero de mesa" onclick="viewsmodal('1')" readonly>
                        </div>
                        <div class="col-sm-6 atencion_cliente" hidden>
                            <label for="cliente"># id_cliente</label>
                            <input type="text" name="id_cliente" id="id_cliente" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6 atencion_cliente" style="display: none;">
                            <label for="cliente">nombre cliente</label>
                            <input type="text" name="cliente" id="cliente" class="form-control" placeholder="datos cliente" onclick="viewsmodal('2')" readonly>
                        </div>
                        <div class="col-sm-6 atencion_cliente" style="display: none;">
                            <label for="cliente">Direccion cliente</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="direccion del cliente" readonly>
                        </div>
                        <div class="col-sm-6 atencion_cliente" style="display: none;">
                            <label for="cliente">Telefono cliente</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="telefono cliente" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">$/ monto pagar</label>
                            <input type="text" name="monto" id="monto" class="form-control" placeholder="$/. 0.00" readonly oninput="calcular_vuelto()">
                        </div>
                    </div>
                    <div class="form-row acciones">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#selecplato" style="color:green" onclick="contenido_selecionado()">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            agregar pedido
                        </button>

                        <button type=" button" class="btn btn-default" class="cancelar" style="color: red;" onclick="vaciar_pedidos(event)"><i class="fa fa-times" aria-hidden="true"></i>
                                Cancelar pedido</button>
                    </div>
                    <div class="form-row">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-capitalize">producto</th>
                                    <th class="text-center text-capitalize">cantidad</th>
                                    <th class="text-center text-capitalize">precio unitario</th>
                                    <th class="text-center text-capitalize">sub_total</th>
                                    <th class="text-center text-capitalize">quitar</th>
                                </tr>
                            </thead>
                            <tbody id="carrito_venta">

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" class="cancelar" style="color: red;" onclick="hide_modal_venta()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="venta_servicio()" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function forma_atencion(val) {
        if (val == 'mesa') {
            $('.atencion_cliente').hide(2000);
            $('.atencion_mesa').show(2000);
        }
        if (val == 'cliente' || val == 'delivery') {
            $('.atencion_mesa').hide(2000);
            $('.atencion_cliente').show(2000);
        }
    }
</script>

