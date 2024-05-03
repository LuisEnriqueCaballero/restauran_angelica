<?php
include_once '../../Config/cnmysql.php';
include_once '../../Model/modal_categoria.php';
$metodocategoria= new MetodoCategoria();
$lista =$metodocategoria->lista_categoria();
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
<div class="modal fade" id="menu" tabindex="-1">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">Nuevo menu</h5>
                <button type="button" class="close" aria-label="Close" onclick="hideModalplato()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formMenu">
                    <input type="text" hidden name="id" id="id" value="<?php echo $id ?>">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">categoria producto</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="0">seleccione categoria</option>
                                <?php
                                while($row = mysqli_fetch_array($lista))
                                {
                                ?>
                                <option value="<?php echo $row['id_categoria']?>"><?php echo $row['descripcion']?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">nombre producto</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="ingrese producto">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">precio producto</label>
                            <input type="text" name="precio" id="precio" class="form-control" placeholder="precio producto">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" class="cancelar" style="color: red;" onclick="hideModalplato()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="plato('2')" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>
</div>