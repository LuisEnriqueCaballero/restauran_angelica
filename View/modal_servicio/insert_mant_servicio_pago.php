<?php
include_once '../../Config/cnmysql.php';
include_once '../../Model/modal_categoria.php';
$metodocategoria= new MetodoCategoria();
$lista =$metodocategoria->lista_categoria();
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
<div class="modal fade" id="servicio" tabindex="-1">
    <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: sans-serif;
        text-transform: capitalize;
        font-size: 25px; color:#11235A">cancelar nuevo servicio</h5>
                <button type="button" class="close" aria-label="Close" onclick="hide_modal_servicio()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formservicio">
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">EMPRESA</label>
                            <input type="text" name="empresa" id="empresa" class="form-control" placeholder="ingrese empresa">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">RUC</label>
                            <input type="text" name="ruc" id="ruc" class="form-control" placeholder="ingrese ruc">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="cliente">numero recibo</label>
                            <input type="text" name="recibo" id="recibo" class="form-control" placeholder="numero recibo">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">monto pago</label>
                            <input type="text" name="monto" id="monto" class="form-control" placeholder="$ 0.00">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-3">
                            <label for="cliente">fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="cliente">servicio</label>
                            <select name="servicio" id="servicio" class="form-control">
                                <option value="0">selec servicio</option>
                                <option value="luz">servicio luz</option>
                                <option value="agua">servicio agua</option>
                                <option value="gas">servicio gas</option>
                                <option value="internet">servicio internet</option>
                                <option value="empleado">pago empleado</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" class="cancelar" style="color: red;" onclick="hide_modal_servicio()">Cancelar</button>
                <button type="button" class="btn btn-default" onclick="pago_servicio()" class="aniadir" style="color:green">agregar</button>
            </div>
        </div>
    </div>
</div>