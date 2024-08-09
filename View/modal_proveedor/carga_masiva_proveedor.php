<script>
var handsontable;
    $( document ).ready(function() {
        grilla_handsontable();
    });
    function grilla_handsontable(){
        var $container = $("#datagridProveedor");
        var $console = $("#consoleProveedor");
        $container.handsontable({
            startRows: 10,
            startCols: 3,
            rowHeaders: true,
            colWidths: [140,140,120,120,180],
            colHeaders: ['<b>Nombre Empresa(*)</b>','<b>RUC(*)</b>','<b>Dato Proveedor(*)</b>','<b>Telefono(*)</b>','<b>Direccion(*)</b>'],
            columns: [
                {type: 'text'},
                {type: 'text'},
                {type: 'text'},
                { type: 'numeric'},
                {type: 'text'},
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
        <h5 class="modal-title" id="staticBackdropLabel">Importar Proveedor</h5>
        <button type="button" class="close" aria-label="Close" onclick="Cerrar_Modal('media')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="example1" class="hot handsontable"></div>
                    <div id="consoleProveedor" class="console"></div>
                    <div id="datagridProveedor" style="overflow:scroll;width:100%;height:360px;background-color:#DBDBDB;margin-top:5px"></div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="Cerrar_Modal('media')">cancelar</button>
        <button type="button" class="btn btn-primary" onclick="ImportarProveedor()">Importar</button>
      </div>
    </div>
  </div>