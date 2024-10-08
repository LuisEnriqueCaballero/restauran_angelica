<?php
include_once '../Config/util.php';
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
                       <td class='text-center'><button class='btn btn-default' onclick='EliminarDatos(" . $key['id_cliente'] . ")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
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
        $cliente = isset($_POST['cliente']) ? strtoupper($_POST['cliente']) : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $direccion = isset($_POST['direccion']) ? strtoupper($_POST['direccion']): '';
        $insertar = $metodocliente->insertcliente($cliente, $telefono, $email, $direccion);
        echo $insertar;
        exit;
        break;

    case '3':
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $cliente = isset($_POST['cliente']) ? strtoupper($_POST['cliente']) : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $direccion = isset($_POST['direccion']) ? strtoupper($_POST['direccion']) : '';
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
    case '5':
        $mensaje=false;
        foreach($_REQUEST['dato'] as $value){
            if(!empty($value[0])){
            $datocliente=strtoupper($value[0]);
            $telefono=$value[1];
            $direccion =strtoupper($value[2]);
            $email='';
            $insertar = $metodocliente->insertcliente($datocliente, $telefono, $email, $direccion);
            }
        }
        $mensaje=true;
        echo json_encode(array('mensaje'=>$mensaje));
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
            $datocliente=strtoupper($key['dato_cliente']);
            $telefon=$key['telefono'];
            $direccion=strtoupper($key['Direccion']);
        }
        echo json_encode(array('mensaje'=>$mensaje,'id'=>$id_client,'dato'=>$datocliente,'telefono'=>$telefon,'direccion'=>$direccion));
        break;
    default:
        # code...
        break;
}
