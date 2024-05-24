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
<div class="modal fade" id="mesa" tabindex="-1" >
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">Nuevo Proveedor</h5>
                <button type="button" class="close"  aria-label="Close" onclick="hide_modal_mesa()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formMesa">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">capacidad</label>
                            <input type="text" name="capacidad" id="capacidad" class="form-control" placeholder="capacidad asientos">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente"># mesa</label>
                            <input type="text" name="numero" id="numero" class="form-control" placeholder="mesa #">
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  class="cancelar" style="color: red;" onclick="hide_modal_mesa()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="mesa('2')" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>
</div>
