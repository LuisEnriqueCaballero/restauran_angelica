<!-- style modal -->
<?php
include_once '../../Config/cnmysql.php';
include_once '../../Model/modal_categoria.php';

$metodoCategoria = new MetodoCategoria();
$lista = $metodoCategoria->lista_categoria();
?>
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

.modal-body .table #list_plato tr .control-boton .btn {
    text-transform: capitalize;
    border: 1px solid #11235A;
    transition-property: color background-color;
    transition-duration: 2000ms;
}

.modal-body .table #lista_plato tr .control-boton .btn:hover {
    color: #11235A;
    background-color: #B6BBC4;
}

.modal-body .table #lista_plato tr td input {
    border-radius: 5px;
    width: 60px;
    height: 40px;
    padding-left: 10px;
}

.modal-body .adm_contenido .w-ful {
    display: flex;
    align-items: center;
}

.modal-body .adm_contenido .w-ful .busqueda button {
    border: 1px solid #11235A;
    color: #11235A;
    height: 50px;
    border-radius: 10px;
    margin-right: -50px;
    display: flex;
    align-items: center;
}
.modal-body .busqueda-producto{
    height: 30px;
}
</style>
<!-- Modal  Estrutura-->


<!-- Modal -->
<div class="modal fade" id="selecplato" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">lista de plato</h5>
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
                                    <option value="<?php echo $row['id_categoria'];?>"><?php echo $row['descripcion'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="">descripcion</label>
                                <input type="text" name="plato" id="plato" class="form-control busqueda-producto">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mt-2">
                        <button type="button" id="consultar" class="btn btn-success" onclick="lista_plato()"><span class="fa fa-search" aria-hidden="true"></span>
                            Buscar</button>
                    </div>
                </div>
                <br>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">categoria</th>
                            <th scope="col" class="text-center">producto</th>
                            <th scope="col" class="text-center">precio unitario</th>
                            <th scope="col" class="text-center">cantidad</th>
                            <th scope="col" class="text-center">opcion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_plato">

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
function lista_plato() {
    let nombre = $('#plato').val();
    let categoria = $('#categoria').val();
    $.ajax({
        type: 'POST',
        data: {
            plato: nombre,
            catego: categoria
        },
        dataType: 'JSON',
        url: 'Controller/ControllMenu.php?ope=seleccionar',
        beforeSend: function() {
            $("#consultar").attr("disabled", true);
            $("#consultar").html('<i class="fa fa-spinner fa-spin"></i> Cargando');
            $('#lista_plato').html('<td colspan="6" align="center"></i> Cargando Entidades ... </td>');
        },
        success: function(result) {
            $("#consultar").attr("disabled", false);
            $("#consultar").html('<i class="fa fa-search" aria-hidden="true"></i> Consultar');
            $('#lista_plato').html(result.html);
        }

    })
}

lista_plato();
</script>