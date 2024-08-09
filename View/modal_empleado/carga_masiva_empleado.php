<script>
var handsontable;
    $( document ).ready(function() {
        grilla_handsontable();
    });
    function grilla_handsontable(){
        var $container = $("#datagridEmpleado");
        var $console = $("#consoleEmpleado");
        $container.handsontable({
            startRows: 10,
            startCols: 3,
            rowHeaders: true,
            colWidths: [140,140,100,120,120,100],
            colHeaders: ['<b>Nombre Empleado(*)</b>','<b>Apellido Empleado(*)</b>','<b>Telefono(*)</b>','<b>Puesto(*)</b>','<b>Salario(*)</b>','<b>Fecha(*)</b>'],
            columns: [
                {type: 'text'},
                {type: 'text'},
                {type: 'text'},
                {type: 'dropdown',
                 source: ['mesero',
                          'cocinero',
                          'contador',],
                },
                { type: 'numeric',
                  numericFormat: {
                  pattern: '$0,0.00',
                  culture: 'en-US',
                  },
                   allowEmpty: false,
                 },
                 {
                  type: 'date',
                  dateFormat: 'MM/DD/YYYY',
                  correctFormat: true,
                  
                  // datePicker additional options
                  // (see https://github.com/dbushell/Pikaday#configuration)
                  datePickerConfig: {
                    // First day of the week (0: Sunday, 1: Monday, etc)
                    firstDay: 0,
                    showWeekNumber: true,
                    disableDayFn(date) {
                      // Disable Sunday and Saturday
                      return date.getDay() === 0 || date.getDay() === 6;
                    },
                  },
                },
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
        <h5 class="modal-title" id="staticBackdropLabel">Importar Empleado</h5>
        <button type="button" class="close" aria-label="Close" onclick="Cerrar_Modal('media')">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="example1" class="hot handsontable"></div>
                    <div id="consoleEmpleado" class="console"></div>
                    <div id="datagridEmpleado" style="overflow:scroll;width:100%;height:360px;background-color:#DBDBDB;margin-top:5px"></div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="Cerrar_Modal('media')">cancelar</button>
        <button type="button" class="btn btn-primary" onclick="ImportarEmpleado()">Importar</button>
      </div>
    </div>
  </div>