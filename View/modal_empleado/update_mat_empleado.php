<?php
include_once '../../Config/cnmysql.php';
include_once '../../Model/model_trabajadore.php';
$metodotrabajador = new MetodoEmpleado();
$val = isset($_GET['val']) ? $_GET['val'] : '';
$restul = $metodotrabajador->getEmpleado($val);
foreach ($restul as $datos) {
    $id = $datos['id_empleado'];
    $nombre = $datos['nombre_empleado'];
    $apellido = $datos['apellido_empleado'];
    $telefono = $datos['telefono'];
    $puesto = $datos['puesto'];
    $salario = $datos['salario'];
    $fecha = $datos['fech_contrato'];
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
</style>
<!-- Modal  Estrutura-->

    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">Actualizar Datos</h5>
                <button type="button" class="close" aria-label="Close" onclick="hide_modal_empleado()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEmpleadoU">
                    <input type="text" hidden name="id" id="id" value="<?php echo $id; ?>">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="ingrese dato cliente" value="<?php echo $nombre; ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" placeholder="999-999-999" value="<?php echo $apellido; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="ingrese telefono" value="<?php echo $telefono; ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="puesto">Puesto</label>
                            <select name="puesto" id="puesto" class="form-control">
                                <option value="0">Seleccione el puesto</option>
                                <option value="mesero" <?php echo ($puesto == 'mesero') ? ' selected' : ''; ?>>Mesero o Mesera</option>
                                <option value="cocinero" <?php echo ($puesto == 'cocinero') ? ' selected' : ''; ?>>Cocinero o Cocinera</option>
                                <option value="contador" <?php echo ($puesto == 'contador') ? ' selected' : ''; ?>>Contador</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">salario</label>
                            <input type="text" name="salario" id="salario" class="form-control" placeholder="ingrese direccion" value="<?php echo $salario; ?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">fecha contrato</label>
                            <input type="date" name="contrato" id="contrato" class="form-control" placeholder="ingrese direccion" value="<?php echo $fecha; ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" class="cancelar" style="color: red;" onclick="hide_modal_empleado()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="empleado()" class="aniadir" style="color:green">actualizar</button>
            </div>
        </div>
    </div>
