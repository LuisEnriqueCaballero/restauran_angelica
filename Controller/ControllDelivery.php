<?php
include_once '../Config/util.php';
include_once '../Model/model_delivery.php';
$metodoDelivery=new MetodoDelivery();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';
switch ($ope) {
    case '1':
        $html = '';
        $lista = $metodoDelivery->lista_delivery();
        $numero = 1;
        $num_fila = mysqli_num_rows($lista);
        $comentario = 'No Hay Datos Registrado';
        if ($num_fila > 0) {
            foreach ($lista as $key) {
                $class=($numero % 2 ===0)?'even':'odd';
                $html .= "<tr class='$class'>
                         <td class='text-center'>$numero</td>
                         <td class='text-center'>$key[distancia]</td>
                         <td class='text-center'>$key[precio]</td>
                         <td class='text-center'>
                         <button class='btn  btn-btn-outline-success' onclick='matenimiento_nuevo(" . $key['idDelivery'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
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
        $distancia = isset($_POST['inicio']) ? $_POST['inicio'] : '';
        $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
        $resulta = $metodoDelivery->insertDelivery($distancia, $precio);
        echo $resulta;
        break;

    case '3':
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $distancia = isset($_POST['inicio']) ? $_POST['inicio'] : '';
        $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
        $resulta = $metodoDelivery->updateDelivery($id, $distancia, $precio);
        echo $resulta;
        break;


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
    
    case '4':
        $id=isset($_POST['id'])?$_POST['id']:'';
        $getDelivery=$metodoDelivery->getDelivery($id);
        $mensaje=true;
        foreach ($getDelivery as $key) {
            $id=$key['idDelivery'];
            $distancia=$key['distancia'];
            $precio=$key['precio'];
        }

        echo json_encode(array('id_mesa'=>$id,'mesa'=>$distancia,$precio=>'precio','mensaje'=>$mensaje));
        break;
    default:
        # code...
        break;
}
