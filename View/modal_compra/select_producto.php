<?php
include_once '../../Config/cnmysql.php';
include_once '../../Model/modal_producto.php';

$metodoCategoria = new MetodoProducto();
$lista = $metodoCategoria->lista_CategoriaProducto();
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

.modal-title {
    text-transform: capitalize;
    font-family: sans-serif;
    color: #11235A;
}

.modal-body .table .thead-dark tr th {
    text-transform: capitalize;
    text-align: center;
}

.modal-body .table #list_producto tr .control-boton .btn {
    text-transform: capitalize;
    border: 1px solid #11235A;
    transition-property: color background-color;
    transition-duration: 2000ms;
}

.modal-body .table #list_producto tr .control-boton .btn:hover {
    color: #11235A;
    background-color: #B6BBC4;
}

.modal-body .table #list_producto tr td input {
    border-radius: 5px;
    width: 80px;
    height: 40px;
    padding-left: 10px;
}

.modal-body .busqueda-producto {
    height: 30px;
}
</style>
<!-- Modal  Estrutura-->


<!-- Modal -->
<div class="modal fade" id="selecproducto" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">lista de productos</h5>
                <button type="button" class="close" aria-label="Close" onclick="hide_modal_lista()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row" style="display:flex; align-items:center;justify-content:space-between;">
                    <div class="col-9">
                        <div class="form-row">
                            <div class="col-sm-3">
                                <label for="">Categoria</label>
                                <select name="categoria" id="categoria" class="form-control busqueda-producto">
                                    <option value="0">Selecci. Categroia</option>
                                    <?php
                                    while($row=mysqli_fetch_array($lista)){
                                    ?>
                                    <option value="<?php echo $row[0]?>"><?php echo $row['1']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="">descripcion</label>
                                <input type="text" name="producto" id="producto" class="form-control busqueda-producto">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mt-2">
                        <button type="button" id="consultar" class="btn btn-success" onclick="list_producto()"><span
                                class="fa fa-search" aria-hidden="true"></span>
                            Buscar</button>
                    </div>
                </div>
                <br>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">categoria</th>
                            <th scope="col">producto</th>
                            <th scope="col">precio unitario</th>
                            <th scope="col">cantidad</th>
                            <th scope="col">opcion</th>
                        </tr>
                    </thead>
                    <tbody id="list_producto">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="color: red;"
                    onclick="hide_modal_lista()">salir</button>
            </div>
        </div>
    </div>
</div>
<script>
list_producto();
function list_producto() {
    let categoria=$('#categoria').val();
    let producto=$('#producto').val();
    $.ajax({
        type: 'POST',
        data:{
            catego:categoria,
            produc:producto
        },
        dataType: 'JSON',
        url: 'Controller/ControllProducto.php?ope=seleccionar',
        beforeSend: function() {
            $("#consultar").attr("disabled", true);
            $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
            $('#list_producto').html('<td colspan="6" align="center"></i> Cargando Entidades ... </td>');
        },
        success: function(result) {
            $("#consultar").attr("disabled", false);
            $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
            $('#list_producto').html(result.html);
        }

    })
}

</script>