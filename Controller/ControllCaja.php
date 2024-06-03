<?php
include_once '../Config/cnmysql.php';
include_once '../Model/model_caja.php';
include_once '../Model/model_financiero.php';
date_default_timezone_set('America/Santiago');
$metodocaja = new Metodocaja();
$metodoFinanciero= new MetodoFinanciero();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';
$meses=['mes','ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
switch ($ope) {
    case 'caja':
        $html = '';
        $mensaje=false;
        $num=1;
        $lista=$metodocaja->listacajas();
        $num_fila=mysqli_num_rows($lista);
        $informa='no se encontro datos';
        if($num_fila>0){
            foreach ($lista as $key ) {
                $fecha_actual=date('d/m/Y H:i:s',strtotime($key['fecha']));
                $mes=$meses[$key['mes']];
                $html .= "<tr>
                         <td class='text-center text-uppercase'>$num</td>
                         <td class='text-center text-uppercase'>$key[descripcion]</td>
                         <td class='text-center text-uppercase'>$fecha_actual</td>
                         <td class='text-center text-uppercase'>$mes</td>
                         <td class='text-center text-uppercase'>$key[anio]</td>
                         <td class='text-center text-uppercase'>$key[estado]</td>
                         <td class='text-center'>
                         <button class='btn  btn-btn-outline-success' onclick='matenimiento_caja(" . $key['id_caja'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                         </td>
                         </tr>";
                $num++;         
            }
            $mensaje=true;
        }else{
            $html .="<tr>
                     <td class='text-center text-uppercase' colspan=7>$informa</td>
                    </tr>";
        }
        echo json_encode(array('html'=>$html,'mensaje'=>$mensaje));
        break;
    
    case 'cierrecaja':
        $html = '';
        $num=1;
        $lista=$metodocaja->lista_multicajascierre();
        $num_fila=mysqli_num_rows($lista);
        $informa='no se encontro datos';
        if($num_fila>0){
            foreach ($lista as $key ) {
                $monto_incial=number_format($key['monto_inicial'],2,',','.');
                $fecha =date('d-m-Y H:i:s', strtotime($key['fecha_cierre']));
                $mes=$meses[$key['mes']];
                $html .= "<tr>
                         <td class='text-center text-uppercase'>$num</td>
                         <td class='text-center text-uppercase'>$key[descripcion]</td>
                         <td class='text-center text-uppercase'>$ $monto_incial</td>
                         <td class='text-center text-uppercase'>$fecha</td>
                         <td class='text-center text-uppercase'>$mes</td>
                         <td class='text-center text-uppercase'>$key[anio]</td>
                         </tr>";
                $num++;         
            }
        }else{
            $html .="<tr>
                     <td class='text-center text-uppercase' colspan=6>$informa</td>
                    </tr>";
        }
        echo json_encode(array('html'=>$html));
        break;
    case 'crearcaja':
        $mensaje=true;
        $descripcion=isset($_POST['descripcion'])?$_POST['descripcion']:'';
        $fecha=date('Y-m-d H:i:s');
        $mes =date('m');
        $anio=date('Y');
        $insertcaja=$metodocaja->INSERTACAJA($descripcion,'1',$fecha,$mes,$anio);
        echo $insertcaja;
        break;
    
    case 'updatecaja':
        $id=isset($_POST['id'])?$_POST['id']:'';
        $descripcion=isset($_POST['descripcion'])?$_POST['descripcion']:'';
        $updatecaja=$metodocaja->UPDATECAJAS($id,$descripcion);
        $mensaje=true;
        echo $updatecaja;
        break;

    case 'deletecaja':
        $mensaje = false;
        $id=isset($_POST['id'])?$_POST['id']:'';
        $updatecaja=$metodocaja->DESACTIVARCAJA($id);
        if($updatecaja){
            $mensaje=true;
        }
        echo $updatecaja;
        break;

   case '1':
        $html = '';
        $num=1;
        $lista=$metodocaja->lista_multicajas();
        $num_fila=mysqli_num_rows($lista);
        $informa='no se encontro datos';
        if($num_fila>0){
            foreach ($lista as $key ) {
                $monto_incial=number_format($key['monto_inicial'],2,',','.');
                $fecha =date('d-m-Y H:i:s', strtotime($key['fecha_apertura']));
                $mes=$meses[$key['mes']];
                $html .= "<tr>
                         <td class='text-center text-uppercase'>$num</td>
                         <td class='text-center text-uppercase'>$key[descripcion]</td>
                         <td class='text-center text-uppercase'>$ $monto_incial</td>
                         <td class='text-center text-uppercase'>$fecha</td>
                         <td class='text-center text-uppercase'>$mes</td>
                         <td class='text-center text-uppercase'>$key[anio]</td>
                         <td class='text-center text-uppercase'>
                         <button type='button' onclick='cierre_caja(".$key['id_caja_apert'].")'>$key[estado]</button>
                         </td>
                         <td class='text-center text-uppercase'>
                         <button type='button' class='btn btn-success' onclick='aumentar(".$key['id_caja_apert'].")'><span class='fa fa-plus' aria-hidden='true'></span></button>
                         </td>
                         <td class='text-center'><button class='btn  btn-btn-outline-success' onclick='matenimiento_multicaja(" . $key['id_caja_apert'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                         </td>
                         </tr>";
                $num++;         
            }
        }else{
            $html .="<tr>
                     <td class='text-center text-uppercase' colspan=9>$informa</td>
                    </tr>";
        }
        echo json_encode(array('html'=>$html));
        break;

    case '2':
        $caja=isset($_POST['caja'])?$_POST['caja']:'';
        $monto=isset($_POST['monto'])?$_POST['monto']:0.00;
        $fecha=date('Y-m-d H:i:s');
        $mes=date('m');
        $anio=date('Y');
        $estado=10;
        $concepto=4;
        $insert=$metodocaja->insertmulticaja($caja,$monto,$estado,$fecha,$mes,$anio);
        $ultimalista=$metodocaja->ultimocaja();
        foreach($ultimalista as $key){
            $id_caja=$key['id_caja_apert'];
        }
        $insertkardex=$metodoFinanciero->insertKardexfinanciero($concepto,'0.00','0.00',$monto,$fecha,$mes,$anio,$id_caja);
        echo $insertkardex;
        break;

    case '3':
        $id=isset($_POST['id'])?$_POST['id']:'';
        $id_caja=isset($_POST['caja'])?$_POST['caja']:'';
        $update=$metodocaja->updatemulticaja($id,$id_caja);
        echo $update;
        
        break;

    case '4':
        $id_caja=isset($_POST['id'])?$_POST['id']:'';
        $fecha=date('Y-m-d H:i:s');
        $delete=$metodocaja->cierrecaja($id_caja,$fecha);
        echo $delete;
        break;

    
    case 'aumentadinero':
        $id=isset($_POST['id'])?$_POST['id']:'';
        $monto=isset($_POST['monto'])?$_POST['monto']:'';
        $ingreso=isset($_POST['dinero'])?$_POST['dinero']:'';
        $nuevo_monto=(float)$ingreso +(float)$monto;
        $fecha=date('Y-m-d');
        $mes=date('m');
        $anio=date('Y');
        $concepto='6';
        $updatemonto=$metodocaja->aumentadinero($id,$nuevo_monto);
        $insertingreso=$metodoFinanciero->insertIngreso($concepto,$ingreso,$fecha,$mes,$anio);
        $insertkardex=$metodoFinanciero->insertKardexfinanciero($concepto,'0.00',$ingreso, $nuevo_monto,$fecha,$mes,$anio);
        echo $insertkardex;
        break;
   
       
}
