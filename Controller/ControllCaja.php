<?php
include_once '../Config/cnmysql.php';
include_once '../Model/model_caja.php';
include_once '../Model/model_financiero.php';

$metodocaja = new Metodocaja();
$metodoFinanciero= new MetodoFinanciero();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';

switch ($ope) {
    case '1':
        $html = '';
        $num=1;
        $lista=$metodocaja->lista_caja();
        $num_fila=mysqli_num_rows($lista);
        $informa='no se encontro datos';
        if($num_fila>0){
            foreach ($lista as $key ) {
                $html .= "<tr>
                         <td class='text-center text-uppercase'>$num</td>
                         <td class='text-center text-uppercase'>$key[id_caja]-$key[numero_caja]</td>
                         <td class='text-center text-uppercase'>$key[monto_inicial]</td>
                         <td class='text-center text-uppercase'>$key[fecha_apertura]</td>
                         <td class='text-center text-uppercase'>$key[fecha_cierre]</td>
                         <td class='text-center text-uppercase'>$key[estado]</td>
                         <td class='text-center'><button class='btn btn-default' onclick='eliminar_caja(" . $key['id_caja'] . ")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
                         <button class='btn  btn-btn-outline-success' onclick='matenimiento_caja(" . $key['id_caja'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                         </td>
                         </tr>";
                $num++;         
            }
        }else{
            $html .="<tr>
                     <td class='text-center text-uppercase' colspan=7>$informa</td>
                    </tr>";
        }
        echo json_encode(array('html'=>$html));
        break;

    case '2':
        $numero_caja='caja1';
        $estado=isset($_POST['estado'])?$_POST['estado']:'abierto';
        $fecha_apertura=date('Y-m-d');
        // $fecha_cierre=isset($_POST['fech_cie'])?$_POST['fech_cie']:'';
        $monto_incial=isset($_POST['monto'])?$_POST['monto']:'0.00';
        $insert = $metodocaja->insertCaja($numero_caja,$estado,$fecha_apertura,$monto_incial);
        $concepto='saldo inicia';
        $egreso='0.00';
        $ingreso='0.00';
        $insertaKardex = $metodoFinanciero->insertKardexfinanciero($concepto,$egreso,$ingreso,$monto_incial,$fecha_apertura);
        echo  $insertaKardex;
        exit;
        break;

    case '3':
        $id_caja='caja1';
        $numero_caja=isset($_POST['numero'])?$_POST['numero']:'';
        $estado=isset($_POST['estado'])?$_POST['estado']:'';
        $fecha_apertura=isset($_POST['fech_apert'])?$_POST['fech_apert']:'';
        $fecha_cierre=date('Y-m-d');
        $monto_incial=isset($_POST['monto'])?$_POST['monto']:'';
        $update=$metodocaja->updateCaja($id_caja,$numero_caja,$estado,$fecha_apertura,$fecha_cierre, $monto_incial);
        echo $update;
        break;

    case '4':
        $id_caja=isset($_POST['id'])?$_POST['id']:'';
        $delete=$metodocaja->deleteCaja($id_caja);
        echo $delete;
        break;

    default:
        # code...
        break;
}
