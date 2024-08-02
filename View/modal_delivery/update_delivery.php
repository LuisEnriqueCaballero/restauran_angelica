<?php
include_once '../../Config/util.php';
include_once '../../Model/model_delivery.php';
$metodoDelivery=new MetodoDelivery();
$val=isset($_GET['val'])?$_GET['val']:'';;
$restul=$metodoDelivery->getDelivery($val);
foreach($restul as $datos){
    $id=$datos['idDelivery'];
    $distacia=$datos['distancia'];
    $precio=$datos['precio'];
    
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
        font-size: 25px; color:#11235A">Actualizar Datos</h5>
                <button type="button" class="close"  aria-label="Close" onclick="Cerrar_Modal('media')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDeliveryU">
                    <div class="form-row">
                    <input type="text" hidden name="id" id="id" class="form-control" value='<?php echo $id?>'>
                        <div class="col-sm-12">
                            <label for="inicio">Entre Distancia</label>
                            <input type="text" name="inicio" id="inicio" class="form-control" placeholder="ingrese el kilometro" value='<?php echo $distacia?>'>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12">
                            <label for="precio">precio</label>
                            <input type="text" name="precio" id="precio" class="form-control" placeholder="ingrese por kilometro" value='<?php echo $precio?>'>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  class="cancelar" style="color: red;" onclick="Cerrar_Modal('media')">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="Delivery('3')" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>
