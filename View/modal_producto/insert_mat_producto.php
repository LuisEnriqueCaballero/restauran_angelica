<?php
include_once '../../Config/cnmysql.php';
include_once '../../Model/modal_producto.php';
$metodoproducto= new MetodoProducto();
$lista =$metodoproducto->lista_CategoriaProducto();
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
</style>
<!-- Modal  Estrutura-->
<div class="modal-dialog  modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">Nuevo producto</h5>
            <button type="button" class="close" aria-label="Close" onclick="hide_modal_producto()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formProducto">
                <div class="form-row">
                    <div class="col-sm-6">
                        <p>Seleccione tipo</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                value="insumo" onclick="revender1('insumo')">
                            <label class="form-check-label" for="inlineRadio1">Insumo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                value="vender" onclick="revender1('vender')">
                            <label class="form-check-label" for="inlineRadio2">Vender</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-6">
                        <label for="cliente">categoria producto</label>
                        <select name="categoria" id="categoria" class="form-control">
                            <option value="0">seleccione categoria</option>
                            <?php
                                while($row = mysqli_fetch_array($lista))
                                {
                                ?>
                            <option value="<?php echo $row['id_producto']?>"><?php echo $row['descrip_categoria']?>
                            </option>
                            <?php 
                                }
                                ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="cliente">nombre producto</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            placeholder="ingrese dato cliente">
                    </div>
                </div>
                <div class="form-row" id="revender" style="display:none;">
                    <div class="col-sm-3">
                        <label for="cliente">Precio Compra</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            placeholder="$ 0">
                    </div>
                    <div class="col-sm-3">
                        <label for="cliente">Precio Venta</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            placeholder="$ 0">
                    </div>
                    <div class="col-sm-2">
                        <label for="cliente">Cantidad</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            placeholder="0">
                    </div>
                    <div class="col-sm-4">
                        <label for="cliente">Ganacia</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control"
                            placeholder="$ 0">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" class="cancelar" style="color: red;"
                onclick="hide_modal_producto()">Cancelar</button>
            <button type="button" class="btn btn-default" onclick="producto('6')" class="aniadir"
                style="color:green">agregar</button>
        </div>
    </div>
</div>

<script>
    function revender1(val){
        if(val==='vender'){
            $('#revender').show(2000);
        }else if(val==='insumo' || val === ''){
            $('#revender').hide(2000);
        }
    }
</script>