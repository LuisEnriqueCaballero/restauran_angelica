<script>
var handsontable;
    $( document ).ready(function() {
        grilla_handsontable();
    });
    function grilla_handsontable(){
        var $container = $("#datagridMenu");
        var $console = $("#consoleMenu");
        $container.handsontable({
            startRows: 20,
            startCols: 1,
            rowHeaders: true,
            colWidths: [170],
            colHeaders: ['<b>Categoria Plato (*)</b>'],
            columns: [
                {type: 'text'},
            ],
            minSpareCols: 0,
            minSpareRows: 1,
            contextMenu: false
        });
        handsontable = $container.data('handsontable');
    }
</script>

<div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Importar Categoria Menu</h5>
        <button type="button" class="close" aria-label="Close" onclick="Cerrar_Modal('media')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="example1" class="hot handsontable"></div>
                    <div id="consoleMenu" class="console"></div>
                    <div id="datagridMenu">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="Cerrar_Modal('media')">cancelar</button>
        <button type="button" class="btn btn-primary" onclick="ImportarMenu()">Importar</button>
      </div>
    </div>
  </div>