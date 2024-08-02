<?php
include_once '../Config/util.php';
include_once '../Model/modal_categoria.php';

$metodoCategoria = new MetodoCategoria();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';

switch ($ope) {
    case '1':
        $html = '';
        $num=1;
        $lista=$metodoCategoria->lista_categoria();
        $num_fila=mysqli_num_rows($lista);
        $comentario = 'No Hay Datos Disponible';
        if($num_fila>0){
            foreach ($lista as $key) {
                $html .="<tr>
                         <td class='text-center'>$num</td>
                         <td class='text-center text-uppercase'>$key[descripcion]</td>
                         <td class='text-center'>
                         <button class='btn  btn-btn-outline-success' onclick='matenimiento_categoria(" . $key['id_categoria'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button>
                         </td>
                         </tr>";
                $num++;         
            }
        }else {
            $html .="<tr>
                    <td class='text-center' colspan=3>$comentario</td>
                    </tr>";
        }
        
        echo json_encode(array('html'=>$html));
        break;

    case '2':   
        $descripcion=isset($_POST['descripcion'])?$_POST['descripcion']:'';
        $resulta=$metodoCategoria->insertCategoria($descripcion);   
        echo $resulta;  
        break;

    case '3':
        $id_categoria=isset($_POST['id'])?$_POST['id']:'';
        $descripcion=isset($_POST['categoria'])?$_POST['categoria']:'';
        $resulta=$metodoCategoria->updateCategoria($id_categoria,$descripcion);
        echo $resulta;
        break;

    case '4':
        $id_categoria=isset($_POST['id'])?$_POST['id']:'';
        $resulta=$metodoCategoria->deleteCategoria($id_categoria);
        echo $resulta;
        break;

    default:
        
        break;
}
