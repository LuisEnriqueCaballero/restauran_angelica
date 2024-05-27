<?php
include_once '../Config/cnmysql.php';
include_once '../Model/model_servicio.php';
include_once '../Model/model_financiero.php';
include_once '../Model/model_caja.php';
$meses=[0=>'MES',1=>'ENERO',2=>'FEBRERO',3=>'MARZO',4=>'ABRIL',5=>'MAYO',6=>'JUNIO',7=>'JULIO',8=>'AGOSTO',9=>'SEPTIEMBRE',10=>'OCTUBRE',11=>'NOVIEMBRE',12=>'DICIEMBRE'];
$metodoservicio=new MetodoServicio();
$metodofinanza=new MetodoFinanciero();
$metodocaja=new Metodocaja();
$ope=isset($_GET['ope'])?$_GET['ope']:'';

switch ($ope) {
    case 'lista_pago':
        $html='';
        $recibo=isset($_POST['recibo'])?$_POST['recibo']:'';
        $mes=isset($_POST['meses'])?$_POST['meses']:'';
        $anio=isset($_POST['anio'])?$_POST['anio']:'';
        $servicio=isset($_POST['servicio'])?$_POST['servicio']:'';
        $mensaje='NO SE ENCUENTRA RECIBO PAGADO';
        $listapago=$metodoservicio->lista_pago_servicio();
        $num=1;
        $num_fila=mysqli_num_rows($listapago);
        if($num_fila>0){
            foreach ($listapago as $key) {
                $monto=number_format($key['monto_pago'],2,'.',',');
                $nueva_fecha = date('d-m-Y', strtotime($key['fecha_pago']));
                $html .='<tr>
                         <td class="text-center text-capitalize">'.$key['empresa'].'</td>
                         <td class="text-center text-capitalize">'.$key['ruc'].'</td>
                         <td class="text-center text-capitalize">'.$key['descripcion'].'</td>
                         <td class="text-center text-capitalize">'.$key['numero_recibo'].'</td>
                         <td class="text-center text-capitalize">$ '.$key['monto_pago'].'</td>
                         <td class="text-center text-capitalize">'.$nueva_fecha.'</td>
                         <td class="text-center text-capitalize">'.$meses[$key['mes']].'</td>
                         <td class="text-center text-capitalize">'.$key['anio'].'</td>
                        </tr>';
                $num++;        
            }
        }else{
            $html='<tr>
                   <td class="text-center text-capitalize" colspan="8">'.$mensaje.'</td>
                   </tr>';
        }
        echo json_encode(array('html'=>$html));
        break;
    
    case 'insertat_pago':
        $mensaje=true;
        $cancelar='pago';
        $empresa=isset($_POST['empresa'])?$_POST['empresa']:'';
        $ruc=isset($_POST['ruc'])?$_POST['ruc']:'';
        $recibo=isset($_POST['recibo'])?$_POST['recibo']:'';
        $monto=isset($_POST['monto'])?$_POST['monto']:'';
        $fecha=isset($_POST['fecha'])?$_POST['fecha']:'';
        $mes=date('m');
        $anio=date('Y');
        $servicio='3';
        $insert=$metodoservicio->insertPagoServicio($empresa,$ruc,$servicio,$recibo,$monto,$fecha,$mes,$anio);
        $insertegreso=$metodofinanza->insertEgreso($servicio,$monto,$fecha,$mes,$anio);
        $caja=$metodocaja->ultimocaja();
        foreach ($caja as $key) {
            $id_caja=$key['id_caja_apert'];
            $monto_actual=$key['monto_inicial'];
        }
        $nuevo_saldo=$monto_actual-$monto;
        $updatecaha=$metodocaja->updatemontocaja($id_caja,$nuevo_saldo);
        $insertkardex=$metodofinanza->insertKardexfinanciero( $servicio,$monto,0,$nuevo_saldo,$fecha,$mes,$anio);
        
        echo json_encode(array('mensaje'=>$mensaje));
        break;
    
    case 'actulizar':
        
        break;
    
    case 'value':
        
        break;
    
    case 'value':
         
        break;
                    
    default:
        # code...
        break;
}
?>