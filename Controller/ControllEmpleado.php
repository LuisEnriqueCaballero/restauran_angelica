<?php
include_once '../Config/util.php';
include_once '../Model/model_trabajadore.php';

$metodo_empleado = new MetodoEmpleado;
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';
switch ($ope) {
    case '1':
        $html = '';
        $empleado = isset($_POST['empleado']) ? $_POST['empleado'] : '';
        $result = $metodo_empleado->lista_empleado($empleado);
        $num_fila=mysqli_num_rows($result);
        $comentario="No Hay Datos Registado";
        $num = 1;
        if($num_fila>0){
            while ($row = mysqli_fetch_array($result)) {
                $class=($num % 2===0)?'even':'odd';
                $fecha_modificada=date('d/m/Y',strtotime($row['fech_contrato']));
                $salario=number_format($row['salario'],0,'','.');
                $html .= "<tr class='$class'>
                       <td class='text-center'>$num</td>
                       <td class='text-center'>$row[nombre_empleado]</td>
                       <td class='text-center'>$row[apellido_empleado]</td>
                       <td class='text-center'>$row[telefono]</td>
                       <td class='text-center'>$row[puesto]</td>
                       <td class='text-center'>$ $salario</td>
                       <td class='text-center'>$fecha_modificada</td>
                       <td class='text-center'><button class='btn btn-default' onclick='EliminarDatos(" . $row['id_empleado'] . ")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
                       <button class='btn  btn-btn-outline-success' onclick='matenimiento_empleado(" . $row['id_empleado'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                       </td>
                       </tr>";
                $num++;
            }
        }else{
            $class=($num % 2===0)?'even':'odd';
            $html .="<tr class='$class'>
                     <td class='text-center' colspan=8>$comentario</td>
                     </tr>";
        }
        echo json_encode(array('html' => $html));
        exit;
        break;

    case '2':
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $puesto = isset($_POST['puesto']) ? $_POST['puesto'] : '';
        $salario = isset($_POST['salario'])?$_POST['salario']: '0.00';
        $fecha = date('Y-m-d');

        $result = $metodo_empleado->insertEmpleado($nombre, $apellido, $telefono, $puesto, $salario, $fecha);
        echo $result;
        exit;
        break;

    case '3':
        $id=isset($_POST['id']) ? $_POST['id'] : '';
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $puesto = isset($_POST['puesto']) ? $_POST['puesto'] : '';
        $salario = isset($_POST['salario']) ? $_POST['salario'] : '';
        $fecha = isset($_POST['contrato']) ? $_POST['contrato'] : '';
        $result = $metodo_empleado->updateEmpleado($id, $nombre, $apellido, $telefono, $puesto, $salario, $fecha);
        echo $result;
        exit;
        break;

    case '4':
        $id=isset($_POST['idempleado']) ? $_POST['idempleado'] : '';
        $result =$metodo_empleado->deleteEmpleado($id);
        echo $result;
        break;

    case '5':
        $mensaje=false;
        foreach($_REQUEST['dato'] as $value){
            if(!empty($value[0])){
            $nombre=$value[0];
            $apellido=$value[1];
            $telefono =$value[2];
            $puesto=$value[3];
            $salario=$value[4];
            $fecha =date('Y-m-d',strtotime($value[5]));
            $result = $metodo_empleado->insertEmpleado($nombre, $apellido, $telefono, $puesto, $salario, $fecha);
            }
        }
        $mensaje=true;
        echo json_encode(array('mensaje'=>$mensaje));
        break;
    default:
        # code...
        break;
}
