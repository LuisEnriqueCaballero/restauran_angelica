<?php
include_once '../../Config/util.php';
include_once '../../Model/model_venta.php';
$metodoventa=new MetodoVenta();
$val =isset($_GET['val'])?$_GET['val']:'';
$venta=$metodoventa->getVenta($val);
$lista_pago=$metodoventa->tipo_pago();
foreach($venta as $key){
    $id_venta=$key['id_pedido'];
    $tipo=$key['tipo_pago'];
    $total=$key['total'];
}

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
    <div class="modal-dialog  modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">Pago servicio</h5>
                <button type="button" class="close" aria-label="Close" onclick="Cerrar_Modal('media')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formVentaU">
                    <div class="form-row">
                        <input type="text" hidden name="id" id="id" value="<?php echo $id_venta?>">
                        <div class="col-sm-6 pago_efectivo" style="display: none;">
                            <label for="cliente">$/ monto efecito</label>
                            <input type="text" name="efectiv" id="efectiv" class="form-control" placeholder="$/. 0.00" oninput="calcular_vuelto()" step="0.002">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">$/ monto pagar</label>
                            <input type="text" name="monto" id="monto" class="form-control" placeholder="$/. 0.00" readonly oninput="calcular_vuelto()" step="0.002" value="<?php echo $total?>">
                        </div>
                        <div class="col-sm-6 pago_efectivo" style="display: none;">
                            <label for="cliente">$/ vuelto</label>
                            <input type="text" name="vuelto" id="vuelto" class="form-control" placeholder="$/ .0.00" readonly step="0.002">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">Forma de pago</label>
                            <select name="forma_pago" id="forma_pago" class="form-control" onchange="tipo_pago(this.value)">
                             <?php
                                foreach ($lista_pago as $key) {
                                    $select=($key['id'] == $tipo)?'selected':'';
                                ?>
                                <option value="<?php echo $key['id']?>"<?php echo $select?>><?php echo $key['descripcion']?></option>
                                <?php
                                 }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6 pago_tarje" style="display: none;">
                            <label for="cliente">numero operacion</label>
                            <input type="text" name="transferencia" id="transferencia" class="form-control" placeholder="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" class="cancelar" style="color: red;" onclick="Cerrar_Modal('media')">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="cancelar_servicio()" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>
<script>
    function tipo_pago(ope) {

        if (ope == '1') {
            $('.pago_tarje').hide(2000);
            $('.pago_efectivo').show(2000);
        }
        if (ope == '2' || ope == '3') {
            $('.pago_efectivo').hide(2000);
            $('.pago_tarje').show(2000);
            
        }
    }
</script>
<script type="text/javascript">
    function calcular_vuelto(){
        try{
            let pago_efectivo=parseFloat((document.getElementById('efectiv')).value) || 0.00;
            let monto=parseFloat((document.getElementById('monto')).value) || 0.00;

            document.getElementById('vuelto').value=pago_efectivo - monto ;
        }catch(e){

        }
    }
</script>