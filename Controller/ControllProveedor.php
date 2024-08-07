<?php
include_once '../Config/util.php';
include_once '../Model/modal_proveedor.php';

$metodoProveedor = new MetodoProveedor();

$ope = isset($_GET['ope']) ? $_GET['ope'] : '';

switch ($ope) {
    case '1':
        $html='';
        $empresa =isset($_POST['empresas'])?$_POST['empresas']:'';
        $nombre =isset($_POST['proveedor'])?$_POST['proveedor']:'';
        $lista=$metodoProveedor->Lista_Proveedor($empresa,$nombre);
        $num=1;
        $num_fila=mysqli_num_rows($lista);
        $comentario='No Hay Datos Registrado';
        if($num_fila>0){
            foreach ($lista as $key => $value) {
                $class=($num % 2===0)?'even':'odd';
                $html .="<tr class='$class'>
                         <td class='text-center'>$num</td>
                         <td class='text-center'>$value[empresa]</td>
                         <td class='text-center'>$value[ruc]</td>
                         <td class='text-center'>$value[nombre_proveedor]</td>
                         <td class='text-center'>$value[telefono]</td>
                         <td class='text-center'>$value[direccion]</td>
                         <td class='text-center'><button class='btn btn-default' onclick='EliminarDatos(" . $value['id_proveedor'] . ")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
                         <button class='btn  btn-btn-outline-success' onclick='matenimiento_proveedor(" . $value['id_proveedor'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                       </td>
                         </tr>";
                $num++;
            }
        }else{
            $class=($num % 2===0)?'even':'odd';
            $html .="<tr class='$class'>
                     <td class='text-center' colspan=7>$comentario</td>
                    <tr>";
        }
        
        echo json_encode(array('html'=>$html));
        break;

    case '2':
        $empresa=isset($_POST['empresa'])?$_POST['empresa']:'';
        $ruc=isset($_POST['ruc'])?$_POST['ruc']:'';
        $nombre=isset($_POST['nombre'])?$_POST['nombre']:'';
        $telefono=isset($_POST['telefono'])?$_POST['telefono']:'';
        $direccion=isset($_POST['direccion'])?$_POST['direccion']:'';
        $resulta = $metodoProveedor->insertProveedor($empresa,$ruc,$nombre,$telefono,$direccion);
        echo $resulta;
        exit;
        break;

    case '3':
        $id=isset($_POST['id'])?$_POST['id']:'';
        $empresa=isset($_POST['empresa'])?$_POST['empresa']:'';
        $ruc=isset($_POST['ruc'])?$_POST['ruc']:'';
        $proveedor=isset($_POST['proveedor'])?$_POST['proveedor']:'';
        $telefono=isset($_POST['telefono'])?$_POST['telefono']:'';
        $direccion=isset($_POST['direccion'])?$_POST['direccion']:'';
        $resulta= $metodoProveedor->updateProveedor($id,$empresa,$ruc,$proveedor,$telefono,$direccion);
        echo $resulta;
        exit;

        break;

    case '4':
        $id=isset($_POST['idproveedor'])?$_POST['idproveedor']:'';
        $resulta=$metodoProveedor->deleteProveedor($id);
        echo $resulta;
        break;

    default:
        # code...
        break;
}
