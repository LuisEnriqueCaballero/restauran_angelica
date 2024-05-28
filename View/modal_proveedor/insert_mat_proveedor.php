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
        font-size: 25px; color:#11235A">Nuevo Proveedor</h5>
                <button type="button" class="close"  aria-label="Close" onclick="hide_modal_proveedor()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formProveedor">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">empresa</label>
                            <input type="text" name="empresa" id="empresa" class="form-control" placeholder="nombre empresa">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">ruc</label>
                            <input type="text" name="ruc" id="ruc" class="form-control" placeholder="numero ruc">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">nombre proveedor</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="ingrese dato proveedor">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="999-999-999">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12">
                            <label for="cliente">direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="direccion empresa">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  class="cancelar" style="color: red;" onclick="hide_modal_proveedor()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="proveedor('2')" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>

