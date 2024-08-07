<?php
require_once '../Config/util.php';
require_once '../Model/model_financiero.php';

$metodofinanciero = new MetodoFinanciero();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';

switch ($ope) {
    case 'egreso':
        $html = '';
        $num=1;
        $fec_ini=isset($_POST['fech_inicio'])?$_POST['fech_inicio']:'';
        $fec_final=isset($_POST['fech_final'])?$_POST['fech_final']:'';
        $lista_egreso=$metodofinanciero->lista_egreso($fec_ini,$fec_final);
        $num_fila=mysqli_num_rows($lista_egreso);
        $informacion='no hay datos';
        if($num_fila>0){
            foreach ($lista_egreso as $key) {
                $monto=number_format($key['monto'],'2',',','.');
                $fecha=date('d/m/Y',strtotime($key['fecha_registrado']));
                $html .= "<tr>
                          <td class='text-center text-text-uppercase'>$num</td>
                          <td class='text-center text-text-uppercase'>$key[descripcion]</td>
                          <td class='text-center text-text-uppercase text-danger'>- $ $monto</td>
                          <td class='text-center text-text-uppercase'>$fecha</td>
                          </tr>";
                $num++;
            }
        }else{
            $html .="<tr>
                    <td class='text-center text-capitalize' colspan=4>$informacion</td>
                    </tr>";
        }
        echo json_encode(array('html'=>$html));
        break;

    case 'ingreso':
        $html = '';
        $num=1;
        $fec_ini=isset($_POST['fech_inicio'])?$_POST['fech_inicio']:'';
        $fec_final=isset($_POST['fech_final'])?$_POST['fech_final']:'';
        $lista_ingreso=$metodofinanciero->lista_ingreso($fec_ini,$fec_final);
        $num_fila=mysqli_num_rows($lista_ingreso);
        $informacion='no hay datos';
        if($num_fila>0){
            foreach ($lista_ingreso as $key) {
                $monto=number_format($key['monto'],'2',',','.');
                $fecha=date('d-m-Y',strtotime($key['fecha']));
                $html .= "<tr>
                          <td class='text-center text-text-uppercase'>$num</td>
                          <td class='text-center text-text-uppercase'>$key[descripcion]</td>
                          <td class='text-center text-text-uppercase text-success'>+ $.$monto</td>
                          <td class='text-center text-text-uppercase'>$fecha</td>
                          </tr>";
                $num++;
            }
        }else{
            $html .="<tr>
                    <td class='text-center text-capitalize' colspan=4>$informacion</td>
                    </tr>";
        }
        echo json_encode(array('html'=>$html));
        break;

    case 'kardex':
        $html = '';
        $num=1;
        $class='';
        $fec_ini=isset($_POST['fech_inicio'])?$_POST['fech_inicio']:'';
        $fec_final=isset($_POST['fech_final'])?$_POST['fech_final']:'';
        $lista_kardex=$metodofinanciero->lista_kardex_financiero($fec_ini,$fec_final);
        $num_fila=mysqli_num_rows($lista_kardex);
        $informacion='no hay datos';
        if($num_fila>0){
            foreach ($lista_kardex as $key) {
                $fecha_modificada=date('d/m/Y',strtotime($key['fecha']));
                $saldo=number_format($key['saldo'],'2',',','.');
                if($saldo<0){
                    $class .='text-danger text-center';
                }
                $monto_ingreso=number_format($key['monto_ingreso'],'2',',','.');
                $monto_egreso=number_format($key['monto_egreso'],'2',',','.');
                $html .= "<tr>
                          <td class='text-center'>$num</td>
                          <td class='text-center text-uppercase'>$key[descripcion]</td>
                          <td class='text-center text-danger'>- $ $monto_egreso</td>
                          <td class='text-center text-success'>+ $ $monto_ingreso</td>
                          <td class='".$class." text-center text-success' >$ $saldo </td>
                          <td class='text-center'>$fecha_modificada</td>
                          </tr>";
                $num++;
            }
        }else {
            $html .= "<tr>
                          <td class='text-center text-uppercase' colspan=7>$informacion</td>
                    </tr>";
        }
        
        echo json_encode(array('html'=>$html));
        break;

    case 'value':
        # code...
        break;

    case 'value':
        # code...
        break;

    default:
        # code...
        break;
}
