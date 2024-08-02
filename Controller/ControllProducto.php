<?php
include_once '../Config/util.php';
include_once '../Model/modal_producto.php';

$MetodoProducto = new MetodoProducto();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';

switch ($ope) {
    case '1':
        $html ='';
        $num=1;
        // $categoria=isset($_POST['categoria'])?$_POST['categoria']:'';
        $lista = $MetodoProducto->lista_CategoriaProducto();
        $num_fila=mysqli_num_rows($lista);
        $infor='NO SE ENCONTRO DATOS';
        if($num_fila>0){
            foreach($lista as $key){
                $html .= "<tr>
                          <td class='text-center'>$num</td>
                          <td class='text-center'>$key[descrip_categoria]</td>
                          <td class='text-center'>
                          <button class='btn  btn-btn-outline-success' onclick='matenimiento_categoria(" . $key['id_producto'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button></td>
                           </tr>";
                $num++;
            }
        }else{
            $html .= "<tr>
                          <td colspan='4' class='text-center'>$infor</td>
                     </tr>";
        }
        echo json_encode(array('html'=>$html));
        break;

    case '2':
        $categoria =isset($_POST['categoria'])?$_POST['categoria']:'';
        $insert=$MetodoProducto->InsertCategorioProducto($categoria);
        echo $insert;
        break;

    case '3':
        $id=isset($_POST['id'])?$_POST['id']:'';
        $categoria=isset($_POST['categoria'])?$_POST['categoria']:'';
        $update=$MetodoProducto->UpdateCategorioProducto($id,$categoria);
        echo $update;
        break;

    case '4':
        $id=isset($_POST['id'])?$_POST['id']:'';
        $delete=$MetodoProducto->DeleteCategorioProducto($id);
        echo $delete;
        break;

    case '5':
        $html ='';
        $num=1;
        $categoria=isset($_POST['categoria'])?$_POST['categoria']:'';
        $producto=isset($_POST['producto'])?$_POST['producto']:'';
        $lista = $MetodoProducto->lista_Producto($categoria,$producto);
        $num_fila=mysqli_num_rows($lista);
        $infor='NO SE ENCONTRO DATOS';
        if($num_fila>0){
            foreach($lista as $key){
                $html .= "<tr>
                          <td class='text-center'>$num</td>
                          <td class='text-center'>$key[descrip_categoria]</td>
                          <td class='text-center'>$key[descrip_producto]</td>
                          <td class='text-center'><button class='btn btn-default' onclick='mensaje_eliminar(" . $key['id'] . ")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>
                          <button class='btn  btn-btn-outline-success' onclick='matenimiento_producto(" . $key['id'] . ")'><i class='fa fa-pencil' aria-hidden='true'></i></button></td>
                           </tr>";
                $num++;
            }
        }else{
            $html .= "<tr>
                          <td colspan='4' class='text-center'>$infor</td>
                     </tr>";
        }
        echo json_encode(array('html'=>$html));
        break;

    case '6':
        $categoria =isset($_POST['categoria'])?$_POST['categoria']:'';
        $producto =isset($_POST['descripcion'])?$_POST['descripcion']:'';
        $insert=$MetodoProducto->InsertProducto($categoria,$producto);
        echo $insert;
        break;

    case '7':
        $id=isset($_POST['id'])?$_POST['id']:'';
        $categoria =isset($_POST['categoria'])?$_POST['categoria']:'';
        $producto =isset($_POST['descripcion'])?$_POST['descripcion']:'';
        $update=$MetodoProducto->UpdateProducto($id,$categoria,$producto);
        echo $update;
        break;

    case '8':
        $id=isset($_POST['idproducto'])?$_POST['idproducto']:'';
        $delete=$MetodoProducto->DeleteProducto($id);
        echo $delete;
        break;

    case 'seleccionar':
        $html ='';
        $num=1;
        $categoria=isset($_POST['catego'])?$_POST['catego']:'';
        $producto=isset($_POST['produc'])?$_POST['produc']:'';
        $lista = $MetodoProducto->lista_Producto($categoria,$producto);
        $num_fila=mysqli_num_rows($lista);
        $infor='NO SE ENCONTRO PRODUCTO';
        if($num_fila>0){
            foreach($lista as $key){
                $html .= "<tr>
                          <td class='text-center'>$num <input type='text' hidden name='id".$num."' id='id".$num."' value='".$key['id']."'></td>
                          <td class='text-center'>$key[descrip_categoria]</td>
                          <td class='text-center'>$key[descrip_producto] <input type='text' hidden name='nombre".$num."' id='nombre".$num."' value='".$key['descrip_producto']."'></td>
                          <td class='text-center'><input type='text' name='precio".$num."' id='precio".$num."'></td>
                          <td class='text-center'><input type='number' min='1' name='cantidad".$num."' id='cantidad".$num."'></td>
                          <td class='text-center control-boton'><button class='btn btn-default' onclick='seleccionar(".$num.")'><i class='fa fa-hand-pointer-o' aria-hidden='true'></i>seleccione</button>
                          </td class='text-center'>
                           </tr>";
                $num++;
            }
        }else{
            $html .= "<tr>
                          <td colspan='6' class='text-center'>$infor</td>
                     </tr>";
        }
        echo json_encode(array('html'=>$html));
        break;
        

    case '10':
        # code...
        break;

    default:
        # code...
        break;
}
