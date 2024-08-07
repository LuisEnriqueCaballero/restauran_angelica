<?php
include_once '../../Config/util.php';
include_once '../../Model/model_venta.php';
$metodoventa=new MetodoVenta();
$val= isset($_GET['val'])?$_GET['val']:'';
$restul=$metodoventa->getVenta($val);
foreach($restul as $datos){
    $id=$datos['id_pedido'];
}
?>
<div class="modal-dialog">
    <div class="modal-content" id="modalmensajeconten">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalmensajelabel"></h5>
                <button type="button" class="close" aria-label="Close" onclick="Cerrar_Modal('media')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="pregunta"></h4>
                <span id="aviso"></span>
                    <input type="text" hidden name="pedido" id="pedido" value="<?php echo $id?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger anular"
                    onclick="Cerrar_Modal('media');">NO</button>
                <button type="button" class="btn btn-success aceptar" onclick="anular_pedido(1)">SI</button>
            </div>
        </div>
    </div>
</div>

<style>
    #pregunta{
        font-family:'sans-serif';
        font-size:1.5rem;
        font-weight:500;
        color:#000;
    }
    #aviso{
        font-family:'sans-serif';
        font-size:16px;
        font-weight:500;
        color:#000;
    }
</style>