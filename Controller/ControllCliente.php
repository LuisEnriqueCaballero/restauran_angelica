<?php
include_once '../Config/cnmysql.php';
include_once '../Model/model_cliente.php';

$metodocliente = new MetodoCliente();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';

switch ($ope) {
    case '1':
        $html = '';
        $cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
        $listado = $metodocliente->list_cliente($cliente);
        $num = 0;
        $num_fila=mysqli_num_rows($listado);
        $comentario='No Hay Datos Registrado';
        if($num_fila>0){
            while ($key = mysqli_fetch_array($listado)) {
                $num++;
                $class = ($num % 2 == 0) ? 'even' : 'odd';
                $html .= "<tr class=" . $class . ">
                       <td class='text-center'>$num</td>
                       <td class='text-center'>$key[dato_cliente]</td>
                       <td class='text-center'>$key[telefono]</td>
                       <td class='text-center'>$key[Direccion]</td>
                       <td class='text-center'><button class='btn btn-default' onclick='mensaje_eliminar(" . $key['id_cliente'] . ")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
                       <button class='btn  btn-btn-outline-success' onclick='matenimiento_cliente(" . $key['id_cliente'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                       </td>
                       </tr>";
            }
        }else{
            $class='even';
            $html .= "<tr class=" . $class . ">
                     <td class='text-center' colspan=5>$comentario</td>
                     </tr>";
        }
        
        echo json_encode(array('html' => $html));
        exit;
        break;

    case '2':
        $cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
        $insertar = $metodocliente->insertcliente($cliente, $telefono, $email, $direccion);
        echo $insertar;
        exit;
        break;

    case '3':
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
        $update = $metodocliente->updatecliente($id, $cliente, $telefono, $email, $direccion);
        echo $update;
        exit;
        break;

    case '4':
        $mensaje='';
        $id_cliente = isset($_POST['idcliente']) ? $_POST['idcliente'] : '';
        $delete = $metodocliente->deleteCiente($id_cliente);
        echo $delete;
        break;
    
    case 'listacliente':
        $html = '';
        $cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : '';
        $listado = $metodocliente->list_cliente($cliente);
        $num = 0;
        $num_fila=mysqli_num_rows($listado);
        $comentario='No Hay Datos Registrado';
        if($num_fila>0){
            while ($key = mysqli_fetch_array($listado)) {
                $num++;
                $html .= "<tr>
                       <td class='text-center'>$num</td>
                       <td class='text-center'>$key[dato_cliente]</td>
                       <td class='text-center'>$key[telefono]</td>
                       <td class='text-center'>$key[Direccion]</td>
                       <td class='text-center control-boton'><button class='btn btn-default' onclick='seleccionarCliente(".$key['id_cliente'].")'><i class='fa fa-hand-pointer-o' aria-hidden='true'></i>seleccione</button>
                       </td class='text-center'>
                       </tr>";
            }
        }else{
            $html .= "<tr>
                     <td class='text-center' colspan=5>$comentario</td>
                     </tr>";
        }
        echo json_encode(array('html'=>$html));
        break;
    
    case 'getdatocliente':
        $mensaje=true;
        $idcliente=isset($_POST['id_cliente'])?$_POST['id_cliente']:'';
        $getcliente =$metodocliente->getcliente($idcliente);
        foreach ($getcliente as $key) {
            $id_client=$key['id_cliente'];
            $datocliente=$key['dato_cliente'];
            $telefon=$key['telefono'];
            $direccion=$key['Direccion'];
        }
        echo json_encode(array('mensaje'=>$mensaje,'id'=>$id_client,'dato'=>$datocliente,'telefono'=>$telefon,'direccion'=>$direccion));
        break;
        
    case '6':
        include_once '../lib/fpdf.php';

        $fecha_hoy = date('d-m-Y');
        $cliente = isset($_REQUEST['cliente']) ? $_REQUEST['cliente'] : '';
        $listado = $metodocliente->list_cliente($cliente);

        $pdf = new FPDF('L');

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 4, "Lista de Clientes", 0, 0, 'C');
        $pdf->Ln();

        $pdf->Ln(6);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(0, 4, iconv('UTF-8', 'ISO-8859-1', 'F. Creación: ') . $fecha_hoy, 0, 0, 'R');
        $pdf->Ln(8);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(20, 8, iconv('UTF-8', 'ISO-8859-1', '#'), 1, 0, 'C', 0);
        $pdf->Cell(40, 8, iconv('UTF-8', 'ISO-8859-1', 'Dato de Cliente'), 1, 0, 'C', 0);
        $pdf->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', '#Telefono'), 1, 0, 'C', 0);
        $pdf->Cell(80, 8, iconv('UTF-8', 'ISO-8859-1', 'Correo'), 1, 0, 'C', 0);
        $pdf->Cell(100, 8, iconv('UTF-8', 'ISO-8859-1', 'Direccion'), 1, 0, 'C', 0);
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);

        foreach ($listado as $key => $cliente) {
            $pdf->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', $key + 1), 1, 0, 'C');
            $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $cliente['dato_cliente']), 1, 0, 'L');
            $pdf->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', $cliente['telefono']), 1, 0, 'L');
            $pdf->Cell(80, 10, iconv('UTF-8', 'ISO-8859-1', $cliente['email']), 1, 0, 'L');
            $pdf->Cell(100, 10, iconv('UTF-8', 'ISO-8859-1', $cliente['Direccion']), 1, 0, 'L');
            $pdf->Ln();
        }
        $pdf->Output();
        ob_end_flush();
        exit;
        break;
    default:
        # code...
        break;
}
