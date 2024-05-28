<?php
include_once '../../Config/cnmysql.php';
include_once '../../Model/modal_mesa.php';
$metodomesa=new MetodoMesa();
$val= isset($_GET['val'])?$_GET['val']:'';
$restul=$metodomesa->getMesa($val);
foreach($restul as $datos){
    $id=$datos['id_mesa'];
    $capacidad=$datos['capacidad'];
    $estado=$datos['estado'];
    $numero=$datos['numero'];
}
?>
<!-- style modal -->
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
    .modal-body select{
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
        font-size: 25px; color:#11235A">Actualizar datos</h5>
                <button type="button" class="close"  aria-label="Close" onclick="hide_modal_mesa()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formMesaU">
                    <input type="text" name="id" id="id" hidden  value="<?php echo $id?>">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="">capacidad</label>
                            <input type="text" name="capacidad" id="capacidad" class="form-control" placeholder="capacidad asientos" value="<?php echo $capacidad?>">
                        </div>
                        <div class="col-sm-6">
                            <label for=""># mesa</label>
                            <input type="text" name="numero" id="numero" class="form-control" placeholder="mesa #" value="<?php echo $numero ?>">
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  class="cancelar" style="color: red;" onclick="hide_modal_mesa()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="mesa('3')" class="aniadir" style="color:green">actualizar</button>
            </div>
        </div>
    </div>