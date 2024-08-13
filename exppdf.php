<?php
require_once './Config/util.php';
require_once './Model/modal_menu.php';
require_once './Model/model_financiero.php';
require_once './Model/model_venta.php';
require_once './Model/model_cliente.php';
require_once './Model/model_trabajadore.php';
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
        $objetoticke= new FPDF('p','mm',array(48,297));
        $objetoticke->AddPage();
        $objetoticke->SetMargins(1,1,1,1);
        $objetoticke->SetFont('ARIAL','B',9);
        $objetoticke->MultiCell(28,4,'Restauran Catita',0,'C');
        $objetoticke->Ln(2);
        $objetoticke->SetFont('ARIAL','',7);
        $objetoticke->Cell(38,4,'Fecha:'.$dia.' de '.strtolower($meses[$mes]).' del '.$anio,0,0,'L');
        $objetoticke->Ln(5);
        $objetoticke->Cell(18,4,'Hora:'.$hora,0,0,'L');
        $objetoticke->Ln(5);
        $objetoticke->Cell(18,4,'Num.Pedido:'.$id_pedido,0,0,'L');
        $objetoticke->Ln(5);
        /*Datos del Mesa */
        $objetoticke->SetFont('ARIAL','B',8);
        $objetoticke->Cell(48,4,'Atencion a Mesa',0,0,'C');
        $objetoticke->Ln(2);
        $objetoticke->Cell(38,4,'-----------------------------------------------------',0,0,'L');
        $objetoticke->Ln(2);
        $objetoticke->Cell(0,4,'Atencio a la: '.$mesa,0,0,'L');
        $objetoticke->Ln(2);
        $objetoticke->Cell(38,4,'-----------------------------------------------------',0,0,'L');
        $objetoticke->Ln(4);

        $objetoticke->SetFont('ARIAL','B',7);
        $objetoticke->SetTextColor(0, 0, 0); // Color del texto negro
        $objetoticke->Cell(8,4,iconv('UTF-8','ISO-8859-1','Cant.'),0,0,'C');
        $objetoticke->Cell(34,4,iconv('UTF-8','ISO-8859-1','Descripcion'),0,0,'L');
        $objetoticke->Ln();
        $objetoticke->Cell(48,4,'-------------------------------------------------------------',0,0,'L');
        $objetoticke->Ln();
        foreach ($listapedido as $value) {
            $objetoticke->SetFont('ARIAL','',6);
            $objetoticke->Cell(8,4,$value['cantidad'],0,0,'C');
            $yinicio=$objetoticke->GetY();
            $objetoticke->MultiCell(34,4,iconv('UTF-8','ISO-8859-1',$value['descripcion']),0,'L');
            $yfin=$objetoticke->GetY();
            $objetoticke->Ln();
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
        $objetoticke= new FPDF('p','mm',array(48,210));
        $objetoticke->AddPage();
        $objetoticke->SetMargins(1,1,1,1);
        $objetoticke->SetFont('ARIAL','B',9);
        $objetoticke->MultiCell(28,4,'Restauran Catita',0,'C');
        $objetoticke->Ln(2);
        $objetoticke->SetFont('ARIAL','',7);
        $objetoticke->Cell(38,4,'Fecha:'.$dia.' de '.strtolower($meses[$mes]).' del '.$anio,0,0,'L');
        $objetoticke->Ln(5);
        $objetoticke->Cell(18,4,'Hora:'.$hora,0,0,'L');
        $objetoticke->Ln(5);
        $objetoticke->Cell(18,4,'Num.Pedido:'.$id_pedido,0,0,'L');
        $objetoticke->Ln(5);

        /*Datos del Mesa */
        $objetoticke->SetFont('ARIAL','B',8);
        $objetoticke->Cell(48,4,'Atencion a mesa',0,0,'L');
        $objetoticke->Ln(2);
        $objetoticke->Cell(38,4,'-----------------------------------------------------',0,0,'L');
        $objetoticke->Ln(2);
        $objetoticke->Cell(0,4,'Atencio a la: '.$mesa,0,0,'L');
        $objetoticke->Ln(2);
        $objetoticke->Cell(38,4,'-----------------------------------------------------',0,0,'L');
        $objetoticke->Ln(4);


        $objetoticke->SetFont('ARIAL','B',6);
        $objetoticke->SetTextColor(0, 0, 0); // Color del texto negro
        $objetoticke->Cell(6,4,iconv('UTF-8','ISO-8859-1','Cant.'),0,0,'C');
        $objetoticke->Cell(16,4,iconv('UTF-8','ISO-8859-1','Descripcion'),0,0,'L');
        $objetoticke->Cell(12,4,iconv('UTF-8','ISO-8859-1','Precio'),0,0,'R');
        $objetoticke->Cell(12,4,iconv('UTF-8','ISO-8859-1','Importe'),0,0,'R');
        $objetoticke->Ln();
        $objetoticke->Cell(48,4,'-------------------------------------------------------------',0,0,'L');

        foreach ($listapedido as $value) {
            $objetoticke->Ln();
            $objetoticke->SetFont('ARIAL','',6);
            $objetoticke->Cell(6,4,$value['cantidad'],0,0,'C');

            $yinicio=$objetoticke->GetY();
            $objetoticke->MultiCell(16,4,iconv('UTF-8','ISO-8859-1',$value['descripcion']),0,'L');
            $yfin=$objetoticke->GetY();
            $objetoticke->SetXY(23,$yinicio);
            $objetoticke->Cell(12,4,'$ '.$util->Number($value['precio_unitario']),0,0,'R');
            $objetoticke->Cell(12,4,'$ '.$util->Number($value['sub_total']),0,0,'R');
            $objetoticke->SetY($yfin);
        }
        $objetoticke->Cell(48,4,'---------------------------------------------------------------',0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetFont('ARIAL','B',6);
        $objetoticke->Cell(46,4,'Total: $ '.$util->Number($total),0,0,'R');
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
            $telefono=$key['telefono'];
            $total=$key['total'];
        }
        $listapedido=$metodoventa->detalle_ticke($id_pedido);
        $objetoticke= new FPDF('p', 'mm', array(48,297));
        $objetoticke->AddPage();
        $objetoticke->SetMargins(1,1,1,1);
        $objetoticke->SetFont('ARIAL','B',9);
        $objetoticke->MultiCell(28,4,'Restauran Catita',0,'C');
        $objetoticke->Ln(2);
        $objetoticke->SetFont('ARIAL','',7);
        $objetoticke->Cell(38,4,'Fecha:'.$dia.' de '.strtolower($meses[$mes]).' del '.$anio,0,0,'L');
        $objetoticke->Ln(5);
        $objetoticke->Cell(18,4,'Hora:'.$hora,0,0,'L');
        $objetoticke->Ln(5);
        $objetoticke->Cell(18,4,'Num.Pedido:'.$id_pedido,0,0,'L');
        $objetoticke->Ln(5);
        /*Datos del cliente */
        $objetoticke->SetFont('ARIAL','B',7);
        $objetoticke->Cell(48,4,'Datos del cliente',0,0,'C');
        $objetoticke->Ln(2);
        $objetoticke->Cell(38,4,'-----------------------------------------------------',0,0,'L');
        $objetoticke->Ln(2);
        $objetoticke->SetFont('ARIAL','',6);
        $objetoticke->MultiCell(48,4,'CLIENTE: '.strtoupper($cliente),0,'L');
        $objetoticke->Ln(0);
        $objetoticke->SetFont('ARIAL','',6);
        $objetoticke->MultiCell(48,4,'DIRECCION: '.strtoupper($direcion),0,'L');
        $objetoticke->Ln(0);
        $objetoticke->SetFont('ARIAL','',6);
        $objetoticke->Cell(48,4,'DIRECCION: '.strtoupper($telefono),0,0,'L');
        $objetoticke->Ln(4);
        /*Pedido */
        $objetoticke->SetFont('ARIAL','B',6);
        $objetoticke->SetTextColor(0, 0, 0); // Color del texto negro
        $objetoticke->Cell(8,4,iconv('UTF-8','ISO-8859-1','Cant.'),0,0,'C');
        $objetoticke->Cell(34,4,iconv('UTF-8','ISO-8859-1','Descripcion'),0,0,'L');
        $objetoticke->Ln();
        $objetoticke->Cell(48,4,'-------------------------------------------------------------',0,0,'L');
        foreach ($listapedido as $value) {   
            $objetoticke->Ln();
            $objetoticke->SetFont('ARIAL','',6);
            $objetoticke->Cell(8,4,$value['cantidad'],0,0,'C');
            $yinicio=$objetoticke->GetY();
            $objetoticke->MultiCell(34,4,iconv('UTF-8','ISO-8859-1',$value['descripcion']),0,'L');
            $yfin=$objetoticke->GetY();
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
            $telefono=$key['telefono'];
            $subtotal=$key['SubTotal'];
            $tipoAtencion=$key['tipo_atencion'];
            $PreciDeli=$key['PrecioDelivery'];
            $total=$key['total'];
        }
        $listapedido=$metodoventa->detalle_ticke($id_pedido);
        $objetoticke= new FPDF('p', 'mm', array(48,297));
        $objetoticke->AddPage();
        $objetoticke->SetMargins(1,1,1,1);
        $objetoticke->SetFont('ARIAL','B',9);
        $objetoticke->MultiCell(28,4,'Restauran Catita',0,'C');
        $objetoticke->Ln(2);
        $objetoticke->SetFont('ARIAL','',7);
        $objetoticke->Cell(38,4,'Fecha:'.$dia.' de '.strtolower($meses[$mes]).' del '.$anio,0,0,'L');
        $objetoticke->Ln(5);
        $objetoticke->Cell(18,4,'Hora:'.$hora,0,0,'L');
        $objetoticke->Ln(5);
        $objetoticke->Cell(18,4,'Num.Pedido:'.$id_pedido,0,0,'L');
        $objetoticke->Ln(5);
         /*Datos del cliente */
        $objetoticke->SetFont('ARIAL','B',7);
        $objetoticke->Cell(48,4,'Datos del cliente',0,0,'C');
        $objetoticke->Ln(2);
        $objetoticke->Cell(38,4,'-----------------------------------------------------',0,0,'L');
        $objetoticke->Ln(2);
        $objetoticke->SetFont('ARIAL','',6);
        $objetoticke->MultiCell(48,4,'CLIENTE: '.strtoupper($cliente),0,'L');
        $objetoticke->Ln(0);
        $objetoticke->SetFont('ARIAL','',6);
        $objetoticke->MultiCell(48,4,'DIRECCION: '.strtoupper($direcion),0,'L');
        $objetoticke->Ln(0);
        $objetoticke->SetFont('ARIAL','',6);
        $objetoticke->Cell(48,4,'DIRECCION: '.strtoupper($telefono),0,0,'L');
        $objetoticke->Ln(4);
        /*Pedido */
        $objetoticke->SetFont('ARIAL','B',6);
        $objetoticke->SetTextColor(0, 0, 0); // Color del texto negro
        $objetoticke->Cell(6,4,iconv('UTF-8','ISO-8859-1','Cant.'),0,0,'C');
        $objetoticke->Cell(16,4,iconv('UTF-8','ISO-8859-1','Descripcion'),0,0,'L');
        $objetoticke->Cell(12,4,iconv('UTF-8','ISO-8859-1','Precio'),0,0,'R');
        $objetoticke->Cell(12,4,iconv('UTF-8','ISO-8859-1','Importe'),0,0,'R');
        $objetoticke->Ln();
        $objetoticke->Cell(48,4,'-------------------------------------------------------------',0,0,'L');
        foreach ($listapedido as $value) {
            $objetoticke->Ln();
            $objetoticke->SetFont('ARIAL','',6);
            $objetoticke->Cell(6,4,$value['cantidad'],0,0,'C');
            $yinicio=$objetoticke->GetY();
            $objetoticke->MultiCell(16,4,iconv('UTF-8','ISO-8859-1',$value['descripcion']),0,'L');
            $yfin=$objetoticke->GetY();
            $objetoticke->SetXY(23,$yinicio);
            $objetoticke->Cell(12,4,'$ '.$util->Number($value['precio_unitario']),0,0,'R');
            $objetoticke->Cell(12,4,'$ '.$util->Number($value['sub_total']),0,0,'R');
            $objetoticke->SetY($yfin);
        }
        $objetoticke->Cell(48,4,'---------------------------------------------------------------',0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetFont('ARIAL','B',6);
        $objetoticke->Cell(46,4,'Sub Total: $ '.$util->Number($subtotal),0,0,'R');
        $objetoticke->Ln();
        if($tipoAtencion ==='delivery'){
            $objetoticke->SetFont('ARIAL','B',6);
            $objetoticke->Cell(46,4,'Prec. Delivery: $ '.$util->Number($PreciDeli),0,0,'R');
            $objetoticke->Ln();
        }
        $objetoticke->Cell(48,4,'---------------------------------------------------------------',0,0,'L');
        $objetoticke->Ln();
        $objetoticke->SetFont('ARIAL','B',6);
        $objetoticke->Cell(46,4,'Total: $ '.$util->Number($total),0,0,'R');
        $objetoticke->Output();
        ob_end_flush();
        break;
    default:
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
    case 'ListaCliente':
        $fecha_hoy = date('d-m-Y');
        $cliente = isset($_REQUEST['cliente']) ? $_REQUEST['cliente'] : '';
        $metodocliente=new MetodoCliente();
        $listado = $metodocliente->list_cliente($cliente);
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0, 0, 255); // Color del texto azul
        $pdf->Cell(0, 4, "Lista de Clientes", 0, 0, 'C');
        $pdf->Ln();
        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 4, iconv('UTF-8', 'ISO-8859-1', 'F. Reporte: ') . $fecha_hoy, 0, 0, 'R');
        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0); // Color del texto azul
        $pdf->Cell(20, 8, iconv('UTF-8', 'ISO-8859-1', '#Orden'), 1, 0, 'C', 0);
        $pdf->Cell(40, 8, iconv('UTF-8', 'ISO-8859-1', 'Dato de Cliente'), 1, 0, 'C', 0);
        $pdf->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', '#Telefono'), 1, 0, 'C', 0);
        $pdf->Cell(100, 8, iconv('UTF-8', 'ISO-8859-1', 'Direccion'), 1, 0, 'C', 0);
        $pdf->Ln();
        $pdf->SetFont('Helvetica', '', 9);
         foreach ($listado as $key => $cliente) {
             $pdf->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', $key + 1), 1, 0, 'C');
             $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $cliente['dato_cliente']), 1, 0, 'C');
             $pdf->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', $cliente['telefono']), 1, 0, 'C');
             $pdf->Cell(100, 10, iconv('UTF-8', 'ISO-8859-1', $cliente['Direccion']), 1, 0, 'L');
             $pdf->Ln();
        }
        $pdf->Output();
        ob_end_flush();
        exit;
        break;
    case 'lista_empleado':
        $fecha_hoy = date('d-m-Y');
        $metodoempleado=new MetodoEmpleado();
        $empleado=isset($_REQUEST['empleado']) ? $_REQUEST['empleado'] : '';
        $listaEmpleado=$metodoempleado->lista_empleado($empleado);
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0, 0, 255); // Color del texto azul
        $pdf->Cell(0, 4, "Lista de Empleados", 0, 0, 'C');
        $pdf->Ln();
        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 4, iconv('UTF-8', 'ISO-8859-1', 'F. Reporte: ') . $fecha_hoy, 0, 0, 'R');
        $pdf->Ln(8);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0); // Color del texto azul
        $pdf->Cell(20, 8, iconv('UTF-8', 'ISO-8859-1', '#Orden'), 1, 0, 'C', 0);
        $pdf->Cell(40, 8, iconv('UTF-8', 'ISO-8859-1', 'Dato de empleado'), 1, 0, 'C', 0);
        $pdf->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', '#Telefono'), 1, 0, 'C', 0);
        $pdf->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', 'Puesto'), 1, 0, 'C', 0);
        $pdf->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', 'Salario'), 1, 0, 'C', 0);
        $pdf->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', 'F.Contrato'), 1, 0, 'C', 0);
        $pdf->Ln();
        $pdf->SetFont('Helvetica', '', 9);
         foreach ($listaEmpleado as $key => $empleado) {
             $salario=$util->Number($empleado['salario']);
             $fechaC=$util->fecha($empleado['fech_contrato']);
             $pdf->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', $key + 1), 1, 0, 'C');
             $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $empleado['nombre_empleado'].' '.$empleado['apellido_empleado']), 1, 0, 'C');
             $pdf->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', $empleado['telefono']), 1, 0, 'C');
             $pdf->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', $empleado['puesto']), 1, 0, 'C');
             $pdf->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', '$ '.$salario), 1, 0, 'C');
             $pdf->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', $fechaC), 1, 0, 'C');
             $pdf->Ln();
        }
        $pdf->Output();
        ob_end_flush();
        exit;
        break;
}
?>