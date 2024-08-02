<!-- style modal -->
<?php
include_once '../../Config/util.php';
include_once '../../Model/modal_producto.php';
$metodoCategoria = new MetodoProducto();
$cod = isset($_GET['cod'])?$_GET['cod']:'';

$listaeGetProducto=$metodoCategoria->GetCategorioProducto($cod);
foreach($listaeGetProducto as $key){
    $id=$key['id_producto'];
    $categoria=$key['descrip_categoria'];
}
?>
<style>
    .modal-body form .form-row{
        margin: 10px;
        padding: 10px;
    }
    .modal-body label{
        text-transform: capitalize;
        color: #11235A;
        font-family: sans-serif;
        font-size: 18px;
    }
    .modal-body input{
      height: 60px;
      text-transform: uppercase;
    }
    .modal-footer button{
     border: 1px solid #B6BBC4;
     text-transform: capitalize;
     padding: 10px 15px 10px 15px;
     font-family: sans-serif;
    }
    modal-header .modal-title{
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
        font-size: 25px; color:#11235A">actualizacion de datos</h5>
                <button type="button" class="close"  aria-label="Close" onclick="Cerrar_Modal('media')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCategoriaU">
                    <input type="text" hidden name="id" id="id" value="<?php echo $id?>">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <label for="cliente">nombre categoria</label>
                            <input type="text" name="categoria" id="categoria" class="form-control" placeholder="ingrese categoria" value="<?php echo $categoria?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  class="cancelar" style="color: red;" onclick="Cerrar_Modal('media')">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="categoria('3')" class="aniadir" style="color:green">actualizar</button>
            </div>
        </div>
    </div>
