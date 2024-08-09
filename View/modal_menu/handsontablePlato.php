<?php 
include_once '../../Config/util.php';
// include_once '../../Model/modal_menu.php';
include_once '../../Model/modal_categoria.php';
// $metodomenu=new MetodoMenu();
$metodocategoria=new MetodoCategoria();
$lista =$metodocategoria->lista_categoria();
$categoria=[];

foreach($lista as $key){
  $descripcion=$key['descripcion'];
  array_push($categoria,$descripcion);
}

?>
<script>
var handsontable;
    $( document ).ready(function() {
        grilla_handsontable();
    });
    function grilla_handsontable(){
        var $container = $("#datagridProveedores");
        var $console = $("#consoleProveedores");
        $container.handsontable({
            startRows: 20,
            startCols: 3,
            rowHeaders: true,
            colWidths: [280,250,160],
            colHeaders: ['<b>Categoria Plato (*)</b>','<b>Menu (*)</b>','<b>Precio $</b>'],
            columns: [
                {type: 'dropdown',source: <?php echo json_encode($categoria)?>},
                {type: 'text'},
                {type: 'numeric',
                 numericFormat: {
                 pattern: '$0,0.00',
                 culture: 'de-DE',
                 },
                 allowEmpty: false,},
            ],
            minSpareCols: 0,
            minSpareRows: 1,
            contextMenu: false
        });
        handsontable = $container.data('handsontable');
    }
</script>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Importar Todo los platos</h5>
        <button type="button" class="close" aria-label="Close" onclick="Cerrar_Modal('media')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="example1" class="hot handsontable"></div>
                    <div id="consoleProveedores" class="console"></div>
                    <div id="datagridProveedores"   style="overflow:scroll;width:100%;height:360px;background-color:#DBDBDB;margin-top:5px">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="Cerrar_Modal('media')">cancelar</button>
        <button type="button" class="btn btn-primary" onclick="ImportarMenu()">Importar</button>
      </div>
    </div>
  </div>