<script>
var handsontable;
    $( document ).ready(function() {
        grilla_handsontable();
    });
    function grilla_handsontable(){
        var $container = $("#datagridcliente");
        var $console = $("#consolecliente");
        $container.handsontable({
            startRows: 10,
            startCols: 3,
            rowHeaders: true,
            colWidths: [220,100,370],
            colHeaders: ['<b>Datos Cliente(*)</b>','<b>Telefono(*)</b>','<b>Direccion(*)</b>'],
            columns: [
                {type: 'text'},
                {type: 'numeric'},
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
        <h5 class="modal-title" id="staticBackdropLabel">Importar Cliente</h5>
        <button type="button" class="close" aria-label="Close" onclick="Cerrar_Modal('media')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="example1" class="hot handsontable"></div>
                    <div id="consolecliente" class="console"></div>
                    <div id="datagridcliente"  style="overflow:scroll;width:100%;height:360px;background-color:#DBDBDB;margin-top:5px"></div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="Cerrar_Modal('media')">cancelar</button>
        <button type="button" class="btn btn-primary" onclick="ImportarCliente()">Importar</button>
      </div>
    </div>
  </div>