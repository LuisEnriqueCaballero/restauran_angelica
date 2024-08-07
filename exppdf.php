<?php
require_once './Config/util.php';
require_once './Model/modal_menu.php';
require_once './Model/model_financiero.php';
require_once './Model/model_venta.php';
require_once 'lib/fpdf.php';
date_default_timezone_set('America/Santiago');
$util=new Util();
$exp=isset($_GET['exp'])?$_GET['exp']:'';
$meses=['01'=>'ENERO',
        '02'=>'FEBRERO',
        '03'=>'MARZO',
        '04'=>'ABRIL',
        '05'=>'MAYO',
        '06'=>'JUNIO',
        '07'=>'JULIO',
        '08'=>'AGOSTO',
        '09'=>'SEPTIEMBRE',
        '10'=>'OCTUBRE',
        '11'=>'NOVIEMBRE',
        '12'=>'DICIEMBRE'];
$objetoPDF= new FPDF();
switch ($exp) {
    case 'report_plato':
        $num=0;
        $fecha=date('d-m-Y H:i:s');
        $plato=isset($_REQUEST['plato'])?$_REQUEST['plato']:'';
        $categoria=isset($_REQUEST['categoria'])?$_REQUEST['categoria']:'0';
        $metodomenu=new MetodoMenu();
        $listaPlato=$metodomenu->lista_Menu($plato,$categoria);
        // iniciando el pdf
        $objetoPDF= new FPDF('P','mm','A4');
        $objetoPDF->AddPage();
        $objetoPDF->SetFont('Arial','B',16);
        $objetoPDF->SetTextColor(0, 0, 255); // Color del texto (en RGB)
        $objetoPDF->cell(0,4,"Lista de Plato",0,0,'C');
        $objetoPDF->Ln(10);
        $objetoPDF->SetFont('Arial', 'B', 8);
        $objetoPDF->SetTextColor(0, 0, 0); // Color del texto (en RGB)
        $objetoPDF->Cell(0, 4, iconv('UTF-8', 'ISO-8859-1', 'F.Reporte: ') . $fecha, 0, 0, 'R');
        $objetoPDF->Ln(10);
        $objetoPDF->SetFont('Arial', 'B', 10);
        $objetoPDF->SetFillColor(51, 255, 189); // Color de fondo de la celda (en RGB)
        $objetoPDF->SetTextColor(0, 0, 0); // Color del texto (en RGB)
        $objetoPDF->SetDrawColor(255, 189, 51); // Color del borde de la celda (en RGB)
        $objetoPDF->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', 'orden'), 1, 0, 'C');
        $objetoPDF->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', 'categoria'), 1, 0, 'C');
        $objetoPDF->Cell(80, 10, iconv('UTF-8', 'ISO-8859-1', 'descripcion'), 1, 0, 'C');
        $objetoPDF->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', 'precio'), 1, 0, 'C');
        $objetoPDF->Ln();
        foreach($listaPlato as $key){
            $objetoPDF->SetFont('Arial', '', 8);
            $objetoPDF->SetTextColor(0, 0, 0); // Color del texto (en RGB)
            $num++;
            $objetoPDF->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', $num), 1, 0, 'C');
            $objetoPDF->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $key['categoria_menu']), 1, 0, 'C');
            $objetoPDF->Cell(80, 10, iconv('UTF-8', 'ISO-8859-1', $key['descripcion']), 1, 0, 'L');
            $objetoPDF->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', '$ '.$util->Number($key['precio'])), 1, 0, 'C');
            $objetoPDF->Ln();
        }
        $objetoPDF->Output();
        ob_end_flush();
        exit;
        break;
    
    case 'report_egreso':
        $metodoegreso=new MetodoFinanciero();
        $fecha=date('d-m-Y H:i:s');
        $inic_date=isset($_REQUEST['inic_date'])?$_REQUEST['inic_date']:'';
        $fin_date=isset($_REQUEST['fin_date'])?$_REQUEST['fin_date']:'';
        $listaegreso=$metodoegreso->lista_egreso($inic_date,$fin_date);
        $objetoPDF->AddPage();
        $objetoPDF->SetFont('ARIAL','B',12);
        $objetoPDF->Cell(0,4,'LISTA DE EGRESO DEL DIA',0,0,'C');
        $objetoPDF->Ln(10);
        $objetoPDF->SetFont('ARIAL','',9);
        $objetoPDF->Cell(0,4,iconv('UTF-8', 'ISO-8859-1', 'Desde Fecha: ') . date('d/m/Y', strtotime($inic_date)),0,0,'L');
        $objetoPDF->Cell(0,4,iconv('UTF-8', 'ISO-8859-1', 'F.Reporte: ') . $fecha,0,0,'R');
        $objetoPDF->Ln();
        $objetoPDF->Cell(0,4,iconv('UTF-8', 'ISO-8859-1', 'Hasta Fecha: ') . date('d/m/Y', strtotime($fin_date)),0,0,'L');
        $objetoPDF->Ln(10);
        $objetoPDF->SetFont('ARIAL','B','9');
        $objetoPDF->Cell(40,7,iconv('UTF-8','ISO-8859-1','CONCEPTO'),1,0,'C');
        $objetoPDF->Cell(30,7,iconv('UTF-8','ISO-8859-1','MONTO'),1,0,'C');
        $objetoPDF->Cell(40,7,iconv('UTF-8','ISO-8859-1','FECHA'),1,0,'C');
        $objetoPDF->Cell(20,7,iconv('UTF-8','ISO-8859-1','MES'),1,0,'C');
        $objetoPDF->Cell(20,7,iconv('UTF-8','ISO-8859-1','AÑO'),1,0,'C');
        $objetoPDF->Ln();
        foreach ($listaegreso as $key) {
            $objetoPDF->SetFont('ARIAL','','8');
            $objetoPDF->Cell(40,7,iconv('UTF-8','ISO-8859-1',$key['descripcion']),1,0,'C');
            $objetoPDF->Cell(30,7,iconv('UTF-8','ISO-8859-1','$ '.$util->Number($key['monto'])),1,0,'C');
            $objetoPDF->Cell(40,7,iconv('UTF-8','ISO-8859-1',date('d/m/Y', strtotime($key['fecha_registrado']))),1,0,'C');
            $objetoPDF->Cell(20,7,iconv('UTF-8','ISO-8859-1',$key['mes']),1,0,'C');
            $objetoPDF->Cell(20,7,iconv('UTF-8','ISO-8859-1',$key['anio']),1,0,'C');
            $objetoPDF->Ln();
        }
        $objetoPDF->Output();
        ob_end_flush();
        break;
    case 'reporte_ingreso':
        $metodoingreso=new MetodoFinanciero();
        $fecha=date('d-m-Y H:i:s');
        $inic_date=isset($_REQUEST['inic_date'])?$_REQUEST['inic_date']:'';
        $fin_date=isset($_REQUEST['fin_date'])?$_REQUEST['fin_date']:'';
        $listaingreso=$metodoingreso->lista_ingreso($inic_date,$fin_date);
        $objetoPDF->AddPage();
        $objetoPDF->SetFont('ARIAL','B',12);
        $objetoPDF->Cell(0,10,'Reporte de Ingreso',0,0,'C');
        $objetoPDF->Ln(15);
        $objetoPDF->SetFont('ARIAL','',10);
        $objetoPDF->Cell(0,4,iconv('UTF-8','ISO-8859-1','Desde Fecha: ').date('d/m/Y',strtotime($inic_date)),0,0,'L');
        $objetoPDF->Cell(0,4,iconv('UTF-8','ISO-8859-1','F. Reporte: ').date('d/m/Y H:m:s',strtotime($fecha)),0,0,'R');
        $objetoPDF->Ln();
        $objetoPDF->Cell(0,4,iconv('UTF-8','ISO-8859-1','Hasta Fecha: ').date('d/m/Y',strtotime($fin_date)),0,0,'L');
        $objetoPDF->Ln(10);
        $objetoPDF->SetFont('ARIAL','B',9);
        $objetoPDF->Cell(50,8,iconv('UTF-8','ISO-8859-1','CONCEPTO'),1,0,'C');
        $objetoPDF->Cell(50,8,iconv('UTF-8','ISO-8859-1','MONTO INGRESO'),1,0,'C');
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','FECHA'),1,0,'C');
        $objetoPDF->Cell(20,8,iconv('UTF-8','ISO-8859-1','MES'),1,0,'C');
        $objetoPDF->Cell(20,8,iconv('UTF-8','ISO-8859-1','AÑO'),1,0,'C');
        $objetoPDF->Ln();
        foreach ($listaingreso as $key) {
            $objetoPDF->SetFont('ARIAL','',8);
            $objetoPDF->Cell(50,8,iconv('UTF-8','ISO-8859-1',$key['descripcion']),1,0,'C');
            $objetoPDF->Cell(50,8,iconv('UTF-8','ISO-8859-1','$ '.$util->Number($key['monto'])),1,0,'C');
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1',date('d/m/Y',strtotime($key['fecha']))),1,0,'C');
            $objetoPDF->Cell(20,8,iconv('UTF-8','ISO-8859-1',$key['mes']),1,0,'C');
            $objetoPDF->Cell(20,8,iconv('UTF-8','ISO-8859-1',$key['anio']),1,0,'C');
            $objetoPDF->Ln();
        }
        $objetoPDF->Output();
        ob_end_flush();
        break;
    case 'movimiento_finaciero':
        $fecha=date('d/m/Y H:m:s');
        $ini_fecha=isset($_REQUEST['inic_date'])?$_REQUEST['inic_date']:'';
        $fin_fecha=isset($_REQUEST['fin_date'])?$_REQUEST['fin_date']:'';
        $metodofinanciero=new MetodoFinanciero();
        $listaKardex=$metodofinanciero->lista_kardex_financiero($ini_fecha,$fin_fecha);
        $objetoPDF->AddPage();
        $objetoPDF->SetFont('ARIAL','B',15);
        $objetoPDF->SetTextColor(0, 0, 255); // Color del texto azul
        $objetoPDF->Cell(0,4,'Reportes de Movimientos de Cajas',0,0,'C');
        $objetoPDF->Ln(10);
        $objetoPDF->SetFont('ARIAL','B',9);
        $objetoPDF->SetTextColor(0, 0, 0);
        $objetoPDF->Cell(0,4,iconv('UTF-8','ISO-8859-1','Desde Fecha: ').date('d/m/Y',strtotime($ini_fecha)),0,0,'L');
        $objetoPDF->Cell(0,4,iconv('UTF-8','ISO-8859-1','F.Reporte: ').date('d/m/Y H:m:s',strtotime($fecha)),0,0,'R');
        $objetoPDF->Ln();
        $objetoPDF->Cell(0,4,iconv('UTF-8','ISO-8859-1','Hasta Fecha: ').date('d/m/Y',strtotime($fin_fecha)),0,0,'L');
        $objetoPDF->Ln(10);
        $objetoPDF->SetFont('ARIAL','B',9);
        $objetoPDF->SetTextColor(0, 0, 0); // Color del texto negro
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','N° CAJA'),1,0,'C');
        $objetoPDF->Cell(40,8,iconv('UTF-8','ISO-8859-1','Concepto'),1,0,'C');
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','M.Egreso'),1,0,'C');
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','M.Ingreso'),1,0,'C');
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','Saldo'),1,0,'C');
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','Fecha Regist.'),1,0,'C');
        $objetoPDF->Ln();
        $objetoPDF->SetTextColor(0, 0, 0); // Color del texto negro
        foreach ($listaKardex as $key) {
            $objetoPDF->SetFont('ARIAL','',8);
            $objetoPDF->SetTextColor(0, 0, 0); // Color del texto negro
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1',$key['idcaja']),1,0,'C');
            $objetoPDF->SetTextColor(0, 0, 0); // Color del texto negro
            $objetoPDF->Cell(40,8,iconv('UTF-8','ISO-8859-1',$key['descripcion']),1,0,'C');
            $objetoPDF->SetTextColor(255, 0, 0); // Color del texto rojo
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','  -$ '.$util->Number($key['monto_egreso'])),1,0,'C');
            $objetoPDF->SetTextColor(0, 128, 0); // Color del texto verde
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1',' +$ '.$util->Number($key['monto_ingreso'])),1,0,'C');
            $objetoPDF->SetTextColor(0, 0, 255); // Color del texto azul
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','$ '.$util->Number($key['saldo'])),1,0,'C');
            $objetoPDF->SetTextColor(0, 0, 0); // Color del texto negro
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1',date('d/m/Y',strtotime($key['fecha']))),1,0,'C');
            $objetoPDF->Ln();
        }
        $objetoPDF->Output();
        ob_end_flush();
        break;
    case 'recibo_detalle_pedido':
        $id=isset($_REQUEST['id_pedido'])?$_REQUEST['id_pedido']:'';
        $metodoventa=new MetodoVenta();
        $ticke=$metodoventa->ticke($id);
        foreach($ticke AS $key){
            $id_pedido=$key['id_pedido'];
            $dia=date('d',strtotime($key['fecha_hora']));
            $mes=date('m',strtotime($key['fecha_hora']));
            $anio=date('Y',strtotime($key['fecha_hora']));
            $hora =date('H:m:s',strtotime($key['fecha_hora']));
            $mesa=$key['numero'];
            $total=$key['total'];
        }
        $listapedido=$metodoventa->detalle_ticke($id_pedido);
        $objetoticke= new FPDF('p','mm',array(80,297));
        $objetoticke->AddPage();
        $objetoticke->SetFont('ARIAL','B',11);
        $objetoticke->Cell(0,10,'Restaurante Pepito',0,0,'C');
        $objetoticke->Ln(10);
        $objetoticke->SetFont('ARIAL','',9);
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,iconv('UTF-8','ISO-8859-1',$dia.' de '. strtolower($meses[$mes]).' del '.$anio.' '.$hora),0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Pedido mesa:'.$mesa,0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Pedido Numero:'.$id_pedido,0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetFont('ARIAL','B',8);
        $objetoticke->SetX(1);
        $objetoticke->Cell(65,7,iconv('UTF-8','ISO-8859-1','Producto'),0,0,'L');
        $objetoticke->Cell(10,7,iconv('UTF-8','ISO-8859-1','Cant'),0,0,'C');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(75,0,'----------------------------------------------------------------------------',0,0,);
        $objetoticke->Ln();
        foreach ($listapedido as $value) {
            $cellancho = 65;
            $cellaltura = 5;
            // Lógica para manejar descripciones de varias líneas
            $lineas = ceil($objetoticke->GetStringWidth($value['descripcion']) / $cellancho);
            // MultiCell para la descripción
            $objetoticke->SetFont('ARIAL','',6.5);
            $objetoticke->SetX(2);
            $objetoticke->MultiCell($cellancho, $cellaltura, strtoupper($value['descripcion']), 0);
            // Establecer posición XY para celdas subsiguientes
            $xpos = $objetoticke->GetX();
            $ypos = $objetoticke->GetY();
            // Ejemplo: Escribir celdas subsiguientes
            $objetoticke->SetXY($xpos + $cellancho, $ypos);
            $objetoticke->SetX(67);
            $objetoticke->Cell(10,  -5, $value['cantidad'], 0, 0,'C'); 
        }
        $objetoticke->Output();
        ob_end_flush();
        break;
    case 'factura_boleta':
        $id=isset($_REQUEST['id_pedido'])?$_REQUEST['id_pedido']:'';
        $metodoventa=new MetodoVenta();
        $ticke=$metodoventa->ticke($id);
        foreach($ticke AS $key){
            $id_pedido=$key['id_pedido'];
            $dia=date('d',strtotime($key['fecha_hora']));
            $mes=date('m',strtotime($key['fecha_hora']));
            $anio=date('Y',strtotime($key['fecha_hora']));
            $hora =date('H:m:s',strtotime($key['fecha_hora']));
            $mesa=$key['numero'];
            $total=$key['total'];
        }
        $listapedido=$metodoventa->detalle_ticke($id_pedido);
        $objetoticke= new FPDF('p','mm',array(80,297));
        $objetoticke->AddPage();
        $objetoticke->SetFont('ARIAL','B',11);
        $objetoticke->Cell(0,10,'Restaurante Pepito',0,0,'C');
        $objetoticke->Ln(10);
        $objetoticke->SetFont('ARIAL','',9);
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,iconv('UTF-8','ISO-8859-1',$dia.' de '. strtolower($meses[$mes]).' del '.$anio.' '.$hora),0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Pedido mesa:'.$mesa,0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Pedido Numero:'.$id_pedido,0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetFont('ARIAL','',9);
        $objetoticke->SetX(1);
        $objetoticke->Cell(30,7,iconv('UTF-8','ISO-8859-1','Producto'),0,0,'L');
        $objetoticke->Cell(15,7,iconv('UTF-8','ISO-8859-1','Pre. unit'),0,0,'L');
        $objetoticke->Cell(10,7,iconv('UTF-8','ISO-8859-1','Cant'),0,0,'L');
        $objetoticke->Cell(20,7,iconv('UTF-8','ISO-8859-1','Sub Total'),0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(75,0,'-----------------------------------------------------------------------',0,0,);
        $objetoticke->Ln();
        foreach ($listapedido as $value) {
            $cellancho = 30;
            $cellaltura = 5;
            // Lógica para manejar descripciones de varias líneas
            $lineas = ceil($objetoticke->GetStringWidth($value['descripcion']) / $cellancho);
            // MultiCell para la descripción
            $objetoticke->SetFont('ARIAL','',7);
            $objetoticke->SetX(1);
            $objetoticke->MultiCell($cellancho, $cellaltura, strtoupper($value['descripcion']), 0);
            // Establecer posición XY para celdas subsiguientes
            $xpos = $objetoticke->GetX();
            $ypos = $objetoticke->GetY();
            // Ejemplo: Escribir celdas subsiguientes
            $objetoticke->SetXY($xpos + $cellancho, $ypos);
            $objetoticke->SetX(31);
            $objetoticke->Cell(15, -5 * $lineas , '$ '.$util->Number($value['precio_unitario']), 0, 0,'L');
            $objetoticke->Cell(10, -5 * $lineas, $value['cantidad'], 0, 0,'C');
            $objetoticke->Cell(20, -5 * $lineas, '$ '.$util->Number($value['sub_total']), 0, 0,'R');
            
        }
        $objetoticke->Ln(1);
        $objetoticke->SetX(1);
        $objetoticke->Cell(70, 0, '------------------------------------------------------------------------------------------', 0, 0,'L');
        $objetoticke->Ln();
        $objetoticke->Cell(52, 5, 'Total         :', 0, 0,'R');
        $objetoticke->Cell(20, 5, '$ '.$util->Number($total), 0, 0,'L');
        $objetoticke->Output();
        ob_end_flush();
        break;
    
    case 'recibo_detalle_pedido_cliente':
        $id=isset($_REQUEST['id_pedido'])?$_REQUEST['id_pedido']:''; 
        $metodoventa=new MetodoVenta();
        $ticke=$metodoventa->ticket($id);
        foreach($ticke AS $key){
            $id_pedido=$key['id_pedido'];
            $dia=date('d',strtotime($key['fecha_hora']));
            $mes=date('m',strtotime($key['fecha_hora']));
            $anio=date('Y',strtotime($key['fecha_hora']));
            $hora =date('H:m:s',strtotime($key['fecha_hora']));
            $cliente=$key['dato_cliente'];
            $direcion=$key['Direccion'];
            $total=$key['total'];
        }
        $listapedido=$metodoventa->detalle_ticke($id_pedido);
        $objetoticke= new FPDF('p', 'mm', array(80,297));
        $objetoticke->AddPage();
        $objetoticke->SetFont('ARIAL','B',11);
        $objetoticke->Cell(0,10,'Restaurante Pepito',0,0,'C');
        $objetoticke->Ln(10);
        $objetoticke->SetFont('ARIAL','',9);
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,iconv('UTF-8','ISO-8859-1',$dia.' de '. strtolower($meses[$mes]).' del '.$anio.' '.$hora),0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Pedido Cliente:'.$cliente,0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Direccion:'.$direcion,0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Pedido Numero:'.$id_pedido,0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetFont('ARIAL','B',8);
        $objetoticke->SetX(1);
        $objetoticke->Cell(65,7,iconv('UTF-8','ISO-8859-1','Producto'),0,0,'L');
        $objetoticke->Cell(10,7,iconv('UTF-8','ISO-8859-1','Cant'),0,0,'C');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(75,0,'----------------------------------------------------------------------------',0,0,);
        $objetoticke->Ln();
        foreach ($listapedido as $value) {   
            $cellancho = 65;
            $cellaltura = 5;
            // Lógica para manejar descripciones de varias líneas
            $lineas = ceil($objetoticke->GetStringWidth($value['descripcion']) / $cellancho);
            // MultiCell para la descripción
            $objetoticke->SetFont('ARIAL','',6.5);
            $objetoticke->SetX(2);
            $objetoticke->MultiCell($cellancho, $cellaltura, strtoupper($value['descripcion']), 0);    
            // Establecer posición XY para celdas subsiguientes
            $xpos = $objetoticke->GetX();
            $ypos = $objetoticke->GetY();
            // Ejemplo: Escribir celdas subsiguientes   
            $objetoticke->SetXY($xpos + $cellancho, $ypos);
            $objetoticke->SetX(67);
            $objetoticke->Cell(10,  -5, $value['cantidad'], 0, 0,'C'); 
        }  
        $objetoticke->Output();
        ob_end_flush();
        break;
    case 'factura_boleta_cliente':
        $id=isset($_REQUEST['id_pedido'])?$_REQUEST['id_pedido']:'';
            
        $metodoventa=new MetodoVenta();
        $ticke=$metodoventa->ticket($id);
            
        foreach($ticke AS $key){
            $id_pedido=$key['id_pedido'];
            $dia=date('d',strtotime($key['fecha_hora']));
            $mes=date('m',strtotime($key['fecha_hora']));
            $anio=date('Y',strtotime($key['fecha_hora']));
            $hora =date('H:m:s',strtotime($key['fecha_hora']));
            $cliente=$key['dato_cliente'];
            $direcion=$key['Direccion'];
            $subtotal=$key['SubTotal'];
            $tipoAtencion=$key['tipo_atencion'];
            $PreciDeli=$key['PrecioDelivery'];
            $total=$key['total'];
        }
        $listapedido=$metodoventa->detalle_ticke($id_pedido);
        $objetoticke= new FPDF('p', 'mm', array(80,297));
    
        $objetoticke->AddPage();
        $objetoticke->SetFont('ARIAL','B',11);
        $objetoticke->Cell(0,10,'Restaurante Pepito',0,0,'C');
        $objetoticke->Ln(10);
    
       
        $objetoticke->SetFont('ARIAL','',9);
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,iconv('UTF-8','ISO-8859-1',$dia.' de '. strtolower($meses[$mes]).' del '.$anio.' '.$hora),0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Pedido Cliente:'.$cliente,0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Direccion:'.$direcion,0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(0,4,'Pedido Numero:'.$id_pedido,0,0,'L');
        $objetoticke->Ln();
    
        $objetoticke->SetFont('ARIAL','',9);
        $objetoticke->SetX(1);
        $objetoticke->Cell(30,7,iconv('UTF-8','ISO-8859-1','Producto'),0,0,'L');
        $objetoticke->Cell(15,7,iconv('UTF-8','ISO-8859-1','Pre. unit'),0,0,'L');
        $objetoticke->Cell(10,7,iconv('UTF-8','ISO-8859-1','Cant'),0,0,'L');
        $objetoticke->Cell(20,7,iconv('UTF-8','ISO-8859-1','Sub Total'),0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetX(1);
        $objetoticke->Cell(75,0,'-----------------------------------------------------------------------',0,0,);
        $objetoticke->Ln();
        foreach ($listapedido as $value) {
                
            $cellancho = 30;
            $cellaltura = 5;
             
                
            // Lógica para manejar descripciones de varias líneas
            $lineas = ceil($objetoticke->GetStringWidth($value['descripcion']) / $cellancho);
                
            // MultiCell para la descripción
            $objetoticke->SetFont('ARIAL','',7);
            $objetoticke->SetX(1);
            $objetoticke->MultiCell($cellancho, $cellaltura, strtoupper($value['descripcion']), 0);
                
            // Establecer posición XY para celdas subsiguientes
            $xpos = $objetoticke->GetX();
            $ypos = $objetoticke->GetY();
                
            // Ejemplo: Escribir celdas subsiguientes
                
            $objetoticke->SetXY($xpos + $cellancho, $ypos);
            $objetoticke->SetX(31);
                
            $objetoticke->Cell(15, -5 * $lineas , '$ '.$value['precio_unitario'], 0, 0,'L');
            $objetoticke->Cell(10, -5 * $lineas, $value['cantidad'], 0, 0,'C');
            $objetoticke->Cell(20, -5 * $lineas, '$ '.$value['sub_total'], 0, 0,'R');
                
        }
        // subtotal
        $objetoticke->Ln(1);
        $objetoticke->SetX(1);
        $objetoticke->Cell(70, 0, '------------------------------------------------------------------------------------------', 0, 0,'L');
        $objetoticke->Ln();
        $objetoticke->Cell(52, 5, 'Sub Total         :', 0, 0,'R');
        $objetoticke->Cell(20, 5, '$ '.$subtotal, 0, 0,'L');
        // precio delivery
        if($tipoAtencion=='delivery'){
            $objetoticke->Ln(1);
            $objetoticke->SetX(1);
            $objetoticke->Ln();
            $objetoticke->Cell(52, 5, 'Precio Delivery        :', 0, 0,'R');
            $objetoticke->Cell(20, 5, '$ '. $PreciDeli, 0, 0,'L');
        }
        // total
        $objetoticke->Ln(5);
        $objetoticke->SetX(1);
        $objetoticke->Cell(70, 0, '------------------------------------------------------------------------------------------', 0, 0,'L');
        $objetoticke->Ln();
        $objetoticke->Cell(52, 5, 'Total         :', 0, 0,'R');
        $objetoticke->Cell(20, 5, '$ '.$total, 0, 0,'L');
        $objetoticke->Output();
        ob_end_flush();
        break;
                                 
    default:
        # code...
        break;
    
    case 'Historial_caja':
        $id=isset($_REQUEST['idcaja'])?$_REQUEST['idcaja']:''; 
        $fecha=date('d/m/Y H:m:s');
        $MetodoFinanciero=new MetodoFinanciero();
        $Caja=$MetodoFinanciero->HistoriaCaja($id);
        $objetoPDF= new FPDF('P','mm','A4');
        $objetoPDF->AddPage();
        $objetoPDF->SetFont('ARIAL','B',12);
        $objetoPDF->Cell(0,4,'Reporte Historial Caja '.$id,0,0,'C');
        $objetoPDF->Ln(10);
        $objetoPDF->SetFont('ARIAL','',9);
        $objetoPDF->Cell(0,4,iconv('UTF-8','ISO-8859-1','F.Reporte: ').$fecha,0,0,'R');
        $objetoPDF->Ln(10);
        $objetoPDF->SetFont('ARIAL','B',9);
        $objetoPDF->SetTextColor(0, 0, 0); // Color del texto negro
        $objetoPDF->Cell(40,8,iconv('UTF-8','ISO-8859-1','Concepto'),1,0,'C');
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','M.Egreso'),1,0,'C');
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','M.Ingreso'),1,0,'C');
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','Saldo'),1,0,'C');
        $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','Fecha Regist.'),1,0,'C');
        $objetoPDF->Ln();
        $objetoPDF->SetTextColor(0, 0, 0); // Color del texto negro
        foreach ($Caja as $key) {
            $objetoPDF->SetFont('ARIAL','',8);
            $objetoPDF->SetTextColor(0, 0, 0); // Color del texto negro
            $objetoPDF->Cell(40,8,iconv('UTF-8','ISO-8859-1',$key['descripcion']),1,0,'C');
            $objetoPDF->SetTextColor(255, 0, 0); // Color del texto rojo
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1',' - $ '.$util->Number($key['monto_egreso'])),1,0,'C');
            $objetoPDF->SetTextColor(0, 128, 0); // Color del texto verde
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1',' + $ '.$util->Number($key['monto_ingreso'])),1,0,'C');
            $objetoPDF->SetTextColor(0, 0, 255); // Color del texto azul
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1','$ '.$util->Number($key['saldo'])),1,0,'C');
            $objetoPDF->SetTextColor(0, 0, 0); // Color del texto negro
            $objetoPDF->Cell(30,8,iconv('UTF-8','ISO-8859-1',date('d/m/Y',strtotime($key['fecha']))),1,0,'C');
            $objetoPDF->Ln();
        }
        $objetoPDF->Output();
        ob_end_flush();

        break;
        exit;    
}
?>