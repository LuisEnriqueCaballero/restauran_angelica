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
        font-size: 25px; color:#11235A">registrar Nuevo empleado</h5>
                <button type="button" class="close"  aria-label="Close" onclick="hide_modal_empleado()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEmpleado">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="">nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="INGRESE NOMBRE EMPLEADO">
                        </div>
                        <div class="col-sm-6">
                            <label for="">apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" placeholder="INGRESE APELLIDO EMPLEADO">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for=""># telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="999-999-999">
                        </div>
                        <div class="col-sm-6">
                            <label for="">puesto</label>
                            <select name="puesto" id="puesto" class="form-control">
                                <option value="0">seleccione el puesto</option>
                                <option value="mesero">mesero o mesera</option>
                                <option value="cocinero">cocinero o  cocinera</option>
                                <option value="contador">contador</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="">salario</label>
                            <input type="text" name="salario" id="salario" class="form-control" placeholder="ingrese salario">
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  class="cancelar" style="color: red;" onclick="hide_modal_empleado()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="empleado('2')" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>