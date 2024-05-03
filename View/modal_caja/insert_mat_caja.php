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
<div class="modal fade" id="caja" tabindex="-1" >
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">Nuevo Caja</h5>
                <button type="button" class="close"  aria-label="Close" onclick="hide_modal_caja()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCaja">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <label for="cliente">monto</label>
                            <input type="text" name="monto" id="monto" class="form-control" placeholder="$/. 0.00">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  class="cancelar" style="color: red;" onclick="hide_modal_caja()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="caja('2')" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>
</div>
