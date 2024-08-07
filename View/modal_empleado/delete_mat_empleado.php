<?php
include_once '../../Config/util.php';
include_once '../../Model/model_trabajadore.php';
$metodoempleado=new MetodoEmpleado();
$val= isset($_GET['val'])?$_GET['val']:'';
$restul=$metodoempleado->getEmpleado($val);
foreach($restul as $datos){
    $id=$datos['id_empleado'];
}
?>
<div class="modal-dialog">
    <div class="modal-content" id="modalmensajeconten">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalmensajelabel">Eliminar Empleado</h5>
                <button type="button" class="close" aria-label="Close" onclick=" Cerrar_Modal('media')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="pregunta"></h4>
                <span id="aviso"></span>
                    <input type="text" hidden name="empleado" id="empleado" value="<?php echo $id?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger anular"
                    onclick=" Cerrar_Modal('media')">no</button>
                <button type="button" class="btn btn-success aceptar" onclick="elimar_datos(4,1)">si</button>
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