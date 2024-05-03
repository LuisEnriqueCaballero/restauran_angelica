<?php
require_once './Config/cnmysql.php';
require_once './Model/model_cliente.php';
require_once 'lib/excel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$metodocliente = new MetodoCliente();
$objPHPExcel = new Spreadsheet();

$excel = isset($_GET['exp']) ? $_GET['exp'] : '';

if ($excel !== '') {
    switch ($excel) {
        case 'reportcliente':
            $fecha_hoy = date('d-m-Y');
            $cliente = isset($_REQUEST['cliente']) ? $_REQUEST['cliente'] : '';
            $listado = $metodocliente->list_cliente($cliente);


            $objPHPExcel->getProperties()->setTitle("Reporte - Reporte de Clientes");
            $objPHPExcel->getProperties()->setSubject("Reporte - Reporte de Clientes");
            $objPHPExcel->getProperties()->setDescription("Reporte - Reporte de Clientes");
            // el index hoja de trabajo donde se va hacer
            $objPHPExcel->setActiveSheetIndex(0);

            // para activa la hoja excel

            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'CODIGO DE PROGRAMCION');
            $objPHPExcel->getActiveSheet()->mergeCells('A1' . ':H1');

            $objPHPExcel->getActiveSheet()->SetCellValue("A2", "#");
            $objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->SetCellValue("B2", "datos cliente");
            $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->SetCellValue("C2", "telefono");
            $objPHPExcel->getActiveSheet()->getStyle("C2")->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->SetCellValue("D2", "email");
            $objPHPExcel->getActiveSheet()->getStyle("D2")->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->SetCellValue("E2", "direccion");
            $objPHPExcel->getActiveSheet()->getStyle("E2")->getFont()->setBold(true);

            $index = 3;
            $orden=1;
            foreach ($listado as $key => $value) {

                $objPHPExcel->getActiveSheet()->SetCellValue("A".$index, "$orden");
                $objPHPExcel->getActiveSheet()->getStyle("A".$index)->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->SetCellValue("B".$index, "$value[dato_cliente]");
                $objPHPExcel->getActiveSheet()->getStyle("B".$index)->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->SetCellValue("C".$index, "$value[telefono]");
                $objPHPExcel->getActiveSheet()->getStyle("C".$index)->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->SetCellValue("D".$index, "$value[email]");
                $objPHPExcel->getActiveSheet()->getStyle("D".$index)->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->SetCellValue("E".$index, "$value[Direccion]");
                $objPHPExcel->getActiveSheet()->getStyle("E".$index)->getFont()->setBold(true);

                $index++;
                $orden++;
            }


            $file = "reporte_cliente.xlsx";
            break;

        default:
            # code...
            break;
    }
    // Establece las cabeceras para descargar el archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $file . '"');
    header('Cache-Control: max-age=0');
    $writer = new Xlsx($objPHPExcel);

    // Guarda el archivo Excel en el buffer de salida
    $writer->save('php://output');
}
