<?php 
include_once '../../Config/cnmysql.php';
include_once '../../Model/model_cliente.php';
$metodocliente=new MetodoCliente();
$val= isset($_GET['val'])?$_GET['val']:'';
$restul=$metodocliente->getcliente($val);
foreach($restul as $datos){
    $id=$datos['id_cliente'];
    $cliente=$datos['dato_cliente'];
    $telefono=$datos['telefono'];
    $correo=$datos['email'];
    $direccion=$datos['Direccion'];
}

?>

<!-- Modal  Estrutura-->

    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">actualizar datos</h5>
                <button type="button" class="close"  aria-label="Close" onclick="hide_modal_cliente()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formClienteU">
                    <input type="text" hidden name="id" id="id" value="<?php echo $id?>">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">datos cliente</label>
                            <input type="text" name="cliente" id="cliente" class="form-control" placeholder="ingrese dato cliente" value="<?php echo $cliente;?>">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente"># tefonico</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="999-999-999" value="<?php echo $telefono;?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6" hidden>
                            <label for="cliente">email</label>
                            <input type="text"  name="email" id="email" class="form-control" placeholder="ingrese email" value="<?php echo $correo;?>">
                        </div>
                        <div class="col-sm-12">
                            <label for="cliente">direccion cliente</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="ingrese direccion cliente" value="<?php echo $direccion;?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  class="cancelar" style="color: red;" onclick="hide_modal_cliente()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="cliente('3')" class="aniadir" style="color:green">actualizar</button>
            </div>
        </div>
    </div>

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
<!-- fin style -->