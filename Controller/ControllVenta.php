<?php
session_start();
include_once '../Config/cnmysql.php';
include_once '../Model/model_venta.php';
include_once '../Model/model_financiero.php';
include_once '../Model/model_caja.php';


$metodoVenta = new MetodoVenta();
$metodofinanciero = new MetodoFinanciero();
$metodocaja=new Metodocaja();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';

switch ($ope) {
    case 'lista_venta':
        $html = "";
        $num = 1;
        $lista_venta = $metodoVenta->lista_venta();
        foreach ($lista_venta as $key) {
            $total=number_format($key['total'],'2',',','.');
            $fecha_actual=date('d/m/Y',strtotime($key['fecha_hora']));
            $html .= "<tr>
                     <td class='text-center text-uppercase'>$num</td>
                     <td class='text-center text-uppercase'>$key[id_cliente]</td>
                     <td class='text-center text-uppercase'>$ $total</td>
                     <td class='text-center text-uppercase'> $fecha_actual</td>
                     <td class='text-center text-uppercase'> $key[estado]</td>
                     
                     </tr>";
            $num++;
        }
        echo json_encode(array('html' => $html));
        break;

    case 'insertVenta':
        $html='';
        $monto_final=0.00;
        $mensaje=true;
        $infomacion='tabla esta vacida';
        $id_cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '1';
        $estado = 'pendiente';
        $fecha_hora = date('Y-m-d');
        $total = isset($_POST['monto']) ? $_POST['monto'] : '';
        $concepto = 'venta';
        $lista = $_SESSION['carrito_vent'];

        // insertar pedido
        $insert = $metodoVenta->insertVenta($id_cliente, $estado, $fecha_hora, $total);
        // insertar ingreso
        $insertingreso = $metodofinanciero->insertIngreso($concepto, $total, $fecha_hora);

        // obtener mi id del ultimo pedido
        $consulta = $metodoVenta->ultimoPedido();
        $idpedido = mysqli_fetch_array($consulta)['id_pedido'];
        
        // obtener mi ultima datos de mi ultima caja
        $ultimacaja=$metodocaja->ultimocaja();
        foreach ($ultimacaja as $key) {
            $id_caja=$key['id_caja'];
            $monto_incial=$key['monto_inicial'];
        }
        // update actulizar mi monto de mi caja
        $monto_final=floatval($total)+ floatval($monto_incial);
        $updatecaja=$metodocaja->updatemontocaja($id_caja,$monto_final);
        // insertat mi detalles de pedido
        for ($i = 0; $i < count($lista); $i++) {
            $metodoVenta->detalle_pedido($idpedido, $lista[$i]['id'], $lista[$i]['cantidad'], $lista[$i]['precioventa'], $lista[$i]['subtotal']);
        }
        // inserta mi kader financiero
        $metodofinanciero->insertKardexfinanciero($concepto, '0.00', $total, $monto_final, $fecha_hora);
        
        unset($_SESSION['carrito_vent']);
        $html .="<tr>
                <td colspan=5>$infomacion</td>
                </tr>";

        echo json_encode(array('html'=>$html,'mensaje'=>$mensaje));
        break;

    case 'lista_detalle_venta':
        $html = "";
        $num = 1;
        $lista_venta = $metodoVenta->lista_pedido();
        $num_venta=mysqli_num_rows($lista_venta);
        $informacion='No hay datos registrado';
        if($num_venta>0){
            foreach ($lista_venta as $key) {
                $subtotal=number_format($key['sub_total'],'2',',','.');
                $preciounitario=number_format($key['precio_unitario'],'2',',','.');
                $html .= "<tr>
                         <td class='text-center text-uppercase'>$num</td>
                         <td class='text-center text-uppercase'>$key[id_pedido]</td>
                         <td class='text-center text-uppercase'>$key[descripcion]</td>
                         <td class='text-center text-uppercase'>$key[cantidad]</td>
                         <td class='text-center text-uppercase'>$ $preciounitario</td>
                         <td class='text-center text-uppercase'>$ $subtotal</td>
                         </tr>";
                $num++;
            }
        }else{
            $html .= "<tr>
                         <td class='text-center text-uppercase' colspan=6>$infomacion</td>
                      </tr>";
        }
        
        echo json_encode(array('html' => $html));
        break;

    case 'carrito_venta':
        $html = '';
        $producto_id = $_POST['id'];
        $precioventa = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $nombreproducto = $_POST['producto'];
        $total = 0;
        $lista = array();

        if (isset($_SESSION['carrito_vent'])) {
            $lista = $_SESSION['carrito_vent'];
        }

        // verificar si en el carrito existe el producto seleccionado
        $posicion = -1;
        for ($i = 0; $i < count($lista); $i++) {
            if($lista[$i]['id'] ==$producto_id){
                $posicion = $i;
                break;
            }
        }

        //echo $posicion;
        if ($posicion >= 0) {
            $subtotal = $precioventa * $cantidad;
            $lista[$posicion] = array('id' => $producto_id, 'precioventa' => $precioventa, 'cantidad' => $cantidad, 'nombreproducto' => $nombreproducto, 'subtotal' => $subtotal);
        } else {
            $subtotal = $precioventa * $cantidad;
            $lista[] = array('id' => $producto_id, 'precioventa' => $precioventa, 'cantidad' => $cantidad, 'nombreproducto' => $nombreproducto, 'subtotal' => $subtotal);
        }
        $_SESSION['carrito_vent'] = $lista;
        foreach ($lista as $key){
            $precioventa=number_format($key['precioventa'],'2',',','.');
            $subtotal=number_format($key['subtotal'],'2',',','.');
            $html .= "<tr>
                      <td class='text-center text-capitalize'>".$key['nombreproducto']."</td>
                      <td class='text-center'>".$key['cantidad']."</td>;
                      <td class='text-center'>$ ".$precioventa."</td>;
                      <td class='text-center'>$ ".$subtotal."</td>;
                      <td class='text-center'>
                      <button type='button' class='btn btn-default' onclick='quitar_pedido(" .$key['id']. ")' >quitar</button>
                      </td>;
                </tr>";
            $total += $key['subtotal'];
        }
        echo json_encode(array('html' => $html, 'total' => $total));

        break;

    case 'quitar_pedido':
        $html = '';
        $id_pedido = $_POST['id'];
        $lista = array();
        $total = 0.00;
        $listaanterio = array();

        if (isset($_SESSION['carrito_vent'])) {
            $listaanterio = $_SESSION['carrito_vent'];
        }

        // generar el nuevo array sin el elemento
        for ($i = 0; $i < count($listaanterio); $i++) {
            if ($listaanterio[$i]['id'] != $id_pedido) {
                $lista[] = array('id' => $listaanterio[$i]['id'], 'precioventa' => $listaanterio[$i]['precioventa'], 'cantidad' => $listaanterio[$i]['cantidad'], 'nombreproducto' => $listaanterio[$i]['nombreproducto'], 'subtotal' => $listaanterio[$i]['subtotal']);
            }
        }
        $_SESSION['carrito_vent'] = $lista;

        foreach ($lista as $key) {
            $precioventa=number_format($key['precioventa'],'2',',','.');
            $subtotal=number_format($key['subtotal'],'2',',','.');
            $html .= "<tr>
                         <td class='text-center text-capitalize'>$key[nombreproducto]</td>
                         <td class='text-center'>$key[cantidad]</td>
                         <td class='text-center'>$ $precioventa</td>
                         <td class='text-center'>$ $subtotal</td>
                         <td class='text-center'>
                         <button type='button' class='btn btn-default' onclick='quitar_pedido(" .$key['id']. ")' >quitar</button>
                         </td>
                         </tr>";
            $total += $key['subtotal'];
        }
        echo json_encode(array('html' => $html, 'total' => $total));
        break;

    case 'vaciar_pedidos':
        unset($_SESSION['carrito_vent']);
        $html='';
        $html .="<tr>
                 <td colspan='6'></td>
                </tr>";
        $total=0.00;   
        echo json_encode(array('html'=>$html, 'total'=>$total));     
        break;
    default:
        # code...
        break;
}
