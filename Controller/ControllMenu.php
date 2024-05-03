<?php
include_once '../Config/cnmysql.php';
include_once '../Model/modal_menu.php';

$metodomenu = new MetodoMenu();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';

switch ($ope) {
    case '1':
        $html = '';
        $mensaje='no hay pedidos registrado';
        $plato = isset($_POST['plato']) ? $_POST['plato'] : '';
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
        $listado = $metodomenu->lista_Menu($plato,$categoria);
        $num = 0;
        $num_fila=mysqli_num_rows($listado);

        if($num_fila>0){
            while ($key = mysqli_fetch_array($listado)) {
                $precio=number_format($key['precio'],'2',',','.');
                $num++;
                $class = ($num % 2 == 0) ? 'even' : 'odd';
                $html .= "<tr class=" . $class . ">
                       <td class='text-center text-capitalize'>$num</td>
                       <td class='text-center text-capitalize'>$key[categoria_menu]</td>
                       <td class='text-center text-capitalize'>$key[descripcion]</td>
                       <td class='text-center text-capitalize'>$ $precio</td>
                       <td class='text-center'>
                       <button class='btn  btn-btn-outline-success' onclick='mantenimientoplato(" . $key['id_menu'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                       </td>
                       </tr>";
            }

          }else{
            $html .="<tr>
                    <td class='text-center text-uppercase' colspan=5>$mensaje</td>
                    </tr>";
          }
        
        echo json_encode(array('html' => $html));
        exit;
        break;

    case 'seleccionar':
        $html = '';
        $plato = isset($_POST['plato']) ? $_POST['plato'] : '';
        $categoria = isset($_POST['catego']) ? $_POST['catego'] : '';
        $listado = $metodomenu->lista_Menu($plato,$categoria);
        $num = 0;
        while ($key = mysqli_fetch_array($listado)) {
            $num++;
            $precio=number_format($key['precio'],'2',',','.');
            $html .= "<tr>
                    <td class='text-center'>$num <input type='text' hidden name='id".$num."' id='id".$num."' value='".$key['id_menu']."'></td>
                    <td class='text-center text-uppercase'>$key[categoria_menu]</td>
                    <td class='text-center text-uppercase'>$key[descripcion] <input type='text' hidden name='nombre".$num."' id='nombre".$num."' value='".$key['descripcion']."'></td>
                    <td class='text-center'>$ $precio <input type='text' hidden name='precio".$num."' id='precio".$num."' value='".$key['precio']."'></td>
                    <td class='text-center'><input type='number' class='control-form' name='cantidad".$num."' id='cantidad".$num."'></td>
                    <td class='text-center control-boton'><button class='btn btn-default' onclick='seleccionar(".$num.")'><i class='fa fa-hand-pointer-o' aria-hidden='true'></i>seleccione</button>
                    </td class='text-center'>
                    </tr>";
        }
        echo json_encode(array('html' => $html));
        exit;
        break;
    
    case '2':
        
        $categoria=isset($_POST['categoria']) ? $_POST['categoria'] : '';
        $descripcion=isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        $precio=isset($_POST['precio']) ? $_POST['precio'] : '';
       
        $insertar = $metodomenu->insertMenu($categoria,$descripcion,$precio);
        echo $insertar;
        exit;
        break;

    case '3':
        $id_menu=isset($_POST['id']) ? $_POST['id'] : '';
        $categoria=isset($_POST['categoria']) ? $_POST['categoria'] : '';
        $descripcion=isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        $precio=isset($_POST['precio']) ? $_POST['precio'] : '';
        $update = $metodomenu->updateMenu($id_menu,$categoria,$descripcion,$precio);
        echo $update;
        exit;
        break;

    case '4':
        $id_menu = isset($_POST['id']) ? $_POST['id'] : '';
        $delete = $metodomenu->deleteMenu($id_menu);
        echo $delete;
        exit;
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

