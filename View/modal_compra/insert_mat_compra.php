<?php
include_once "../../Config/util.php";
include_once "../../Model/modal_proveedor.php";
$proveedor= new MetodoProveedor();
$lista_provee=$proveedor->selectProveedor();
?>
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
    .acciones{
        display: flex;
        justify-content: end;
    }
    .acciones button{
        border: 1px solid #B6BBC4;
        text-transform: capitalize;
        padding: 10px 15px 10px 15px;
        font-family: sans-serif;
        margin-left: 10px;
    }
</style>
<!-- Modal  Estrutura-->

    <div class="modal-dialog  modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">Nuevo compra</h5>
                <button type="button" class="close" aria-label="Close" onclick="Cerrar_Modal('media')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCompra">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">tipo recibo</label>
                            <select  name="tipo_recibo" id="tipo_recibo" class="form-control" onchange="tipo_reb(this.value)">
                                <option value="0">Seleccione tipo recibo</option>
                                <option value="factura">factura</option>
                                <option value="boleta">boleta</option>
                                <option value="otro tipo">otro tipo recibo</option>
                            </select>
                        </div>
                        <div class="col-sm-6 tip_reb" style="display: none;">
                            <label for="cliente">numero recibo</label>
                            <input type="text" name="num_recibo" id="num_recibo" class="form-control" placeholder="000-000-000">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 select2-proveedor">
                            <label for="cliente">proveedor</label>
                            <select name="proveedor" id="proveedor" class="form-control">
                                <option value="0">Seleccione proveedor</option>
                                <?php
                                foreach ($lista_provee as $key) {
                                    ?>
                                    <option value="<?php echo $key['id_proveedor']?>"><?php echo $key['proveedor']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">$ monto</label>
                            <input type="text" name="monto_gasto" id="monto_gasto" class="form-control" placeholder="$ . 0.00">
                        </div>
                    </div>
                    <div class="form-row acciones">
                        <button type="button" class="btn btn-default" onclick="contenido_selecionado()" class="aniadir" style="color:green"><i class="fa fa-plus" aria-hidden="true"></i>
 agregar pedido</button>
                        <button type="button" class="btn btn-default" class="cancelar" style="color: red;" onclick="vaciar_compra(event)"><i class="fa fa-times" aria-hidden="true"></i>
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
                            <tbody id="carrito_compra">

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" class="cancelar" style="color: red;" onclick="Cerrar_Modal('media')">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="compra('2')" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>

<script>
    function tipo_reb(ope){
        if(ope == 'otro tipo'){
            $('.tip_reb').hide(2000);
        }else{
            $('.tip_reb').show(2000);
        }
    }

    
</script>

<style>
    .select2-proveedor{
        display:flex;
        flex-direction: column;
    }
    
    select2-container--default .select2-selection--single  .select2-selection_rendered{
        border: 2px solid #3498db; /* Borde personalizado */
        height: 60px;
    }
</style>

