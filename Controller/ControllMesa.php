<?php
include_once '../Config/util.php';
include_once '../Model/modal_mesa.php';
$metodoMesa = new MetodoMesa();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';
switch ($ope) {
    case '1':
        $html = '';
        $lista = $metodoMesa->lista_mesa();
        $numero = 1;
        $num_fila = mysqli_num_rows($lista);
        $comentario = 'No Hay Datos Registrado';
        if ($num_fila > 0) {
            foreach ($lista as $key) {
                $class=($numero % 2 ===0)?'even':'odd';
                $html .= "<tr class='$class'>
                         <td class='text-center'>$numero</td>
                         <td class='text-center text-uppercase'>$key[numero]</td>
                         <td class='text-center'>$key[capacidad]</td>
                         <td class='text-center'>$key[estado]</td>
                         <td class='text-center'>
                        
                         <button class='btn  btn-btn-outline-success' onclick='matenimiento_mesa(" . $key['id_mesa'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                         </td>
                         </tr>";
                $numero++;
            }
        } else {
            $html .= "<tr>
                     <td class='text-center' colspan=6>$comentario</td>
                     </tr>";
        }
        echo json_encode(array('html' => $html));
        break;

    case '2':
        $capacidad = isset($_POST['capacidad']) ? $_POST['capacidad'] : '';
        $estado = 8;
        $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
        $resulta = $metodoMesa->insertMesa($capacidad, $estado, $numero);
        echo $resulta;
        break;

    case '3':
        $id_mesa = isset($_POST['id']) ? $_POST['id'] : '';
        $capacidad = isset($_POST['capacidad']) ? $_POST['capacidad'] : '';
        
        $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
        $resulta = $metodoMesa->updateMesa($id_mesa, $capacidad, $numero);
        echo $resulta;
        break;

    case '4':
        $id_mesa = isset($_POST['id']) ? $_POST['id'] : '';
        $resulta = $metodoMesa->deleteMesa($id_mesa);
        echo $resulta;
        break;

     case '5':
        $mensaje=false;
        foreach($_REQUEST['dato'] as $value){
            if(!empty($value[0])){
            $mesa=$value[0];
            $cantidad=$value[1];
            switch ($value[2]){
                case 'libre':
                    $disponible=3;
                    break;
                case 'ocupado':
                    $disponible=4;
                    break;
            }
            $insertar = $metodoMesa->insertMesa( $cantidad, $disponible,$mesa);
            }
        }
        $mensaje=true;
        echo json_encode(array('mensaje'=>$mensaje));
        break;
        exit;
    case 'seleccionar':
        $html = '';
        $plato = isset($_POST['plato']) ? $_POST['plato'] : '';
        // $categoria = isset($_POST['catego']) ? $_POST['catego'] : '';
        $lista = $metodoMesa->lista_mesa();
        $num = 0;
        while ($key = mysqli_fetch_array($lista)) {
            $num++;

            $html .= "<tr>
                    <td class='text-center'>$num</td>
                    <td class='text-center text-uppercase'>$key[numero]</td>
                    <td class='text-center'>$key[capacidad]</td>
                    <td class='text-center'>$key[estado]</td>
                    <td class='text-center control-boton'><button class='btn btn-default' onclick='seleccionarMesa(" . $key['id_mesa'] . ")'><i class='fa fa-hand-pointer-o' aria-hidden='true'></i>seleccione</button>
                    </td class='text-center'>
                    </tr>";
        }
        echo json_encode(array('html' => $html));
        exit;
        break;
    
    case 'getdatomesa':
        $id=isset($_POST['id_mesa'])?$_POST['id_mesa']:'';
        $getMesa=$metodoMesa->getMesa($id);
        $mensaje=true;
        foreach ($getMesa as $key) {
            $id_mesa=$key['id_mesa'];
            $mesa=$key['numero'];
        }

        echo json_encode(array('id_mesa'=>$id_mesa,'mesa'=>$mesa,'mensaje'=>$mensaje));
        break;
    default:
        # code...
        break;
}
