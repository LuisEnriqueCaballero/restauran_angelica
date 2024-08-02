<?php
date_default_timezone_set('America/Santiago');
session_start();
include_once '../Config/util.php';
include_once '../Model/model_compra.php';
include_once '../Model/model_financiero.php';
include_once '../Model/model_caja.php';

$metodoCompra = new MetodoCompra();
$metodofinanciero = new MetodoFinanciero();
$metodoCaja= new Metodocaja();
$ope = isset($_GET['ope']) ? $_GET['ope'] : '';

switch ($ope) {
    case 'lista_compra':
        $html = "";
        $num = 1;
        $inform='NO HAY DATOS';
        $lista_compra = $metodoCompra->lista_compra();
        $numfila=mysqli_num_rows($lista_compra);
        if($numfila>0){
            foreach ($lista_compra as $key) {
                $total=number_format($key['total'],'2',',','.');
                $fecha_actual=date('d/m/Y',strtotime($key['fecha_compra']));
                $html .= "<tr>
                         <td>$num</td>
                         <td>$key[tipo_boleta]</td>
                         <td>$key[numero_recibo]</td>
                         <td>$key[empresa]</td>
                         <td>$ $total</td>
                         <td>$fecha_actual</td>
                         </tr>";
                $num++;
            }
        }
        echo json_encode(array('html' => $html));
        break;

    case 'insertCompra':
        // llamando los valores
        $html='';
        $mensaje=true;
        $infomacion='tabla esta vacida';
        $id_proveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : '';
        $fecha_hora = date('Y-m-d H:i:s');
        $mes=date('m');
        $anio=date('Y');
        $tipo_boleta=isset($_POST['tipo_recibo']) ? $_POST['tipo_recibo'] : '';
        $num_recibo=isset($_POST['num_recibo']) ? $_POST['num_recibo'] : '';
        $total = isset($_POST['monto_gasto']) ? $_POST['monto_gasto'] : '';
        $concepto = '2';
        $lista = $_SESSION['carrito_compra'];

        // haciendo consulta del monto de caja
        $ultimomonto=$metodoCaja->ultimocaja();
        foreach ($ultimomonto as $key) {
            $id_caja = $key['id_caja_apert'];
            $montocaja = $key['monto_inicial'];
        }

        // insertando dato las tablas
        // insertando a la tabla de compra
        $insert = $metodoCompra->insertCompra($tipo_boleta, $num_recibo, $id_proveedor, $total,$fecha_hora,$mes,$anio);

        // insertando a la tabla de egreso
        $insertegreso = $metodofinanciero->insertEgreso($concepto, $total, $fecha_hora,$mes,$anio,$id_caja);

        // haciendo consulta de id de la ultima compra
        $consulta = $metodoCompra->ultimoCompra();
        $idcompra = mysqli_fetch_array($consulta)['id'];

        // insertando datos en la tabla detalle compra
        for ($i = 0; $i < count($lista); $i++) {
            $metodoCompra->detalleCompra($idcompra, $lista[$i]['id'], $lista[$i]['cantidad'], $lista[$i]['precio'], $lista[$i]['subtotal']);
        }

        // actulizacion del monto de caja
        $updatemonto=$montocaja - $total ;
        $update=$metodoCaja->updatemontocaja($id_caja,$updatemonto);

        // insertando datos en tabla de kardex financiero
        $metodofinanciero->insertKardexfinanciero($concepto, $total,'0.00', $updatemonto, $fecha_hora,$mes,$anio,$id_caja);
        unset($_SESSION['carrito_compra']);
        $html .="<tr>
                <td colspan=5>$infomacion</td>
                </tr>";

        echo json_encode(array('html'=>$html,'mensaje'=>$mensaje));
        break;

    case 'lista_detalle_compra':
        $html = "";
        $num = 1;
        $lista_compra = $metodoCompra->lista_detalleCompra();
        $num_fila=mysqli_num_rows($lista_compra);
        $informacion='No hay datos registrado';
        if($num_fila>0){
            foreach ($lista_compra as $key) {
                $subtotal=number_format($key['sub_total'],'2',',','.');
                $precio=number_format($key['precio'],'2',',','.');
                $html .= "<tr>
                         <td class='text-center text-uppercase'>$num</td>
                         <td class='text-center text-uppercase'>$key[id_compra]</td>
                         <td class='text-center text-uppercase'>$key[descrip_producto]</td>
                         <td class='text-center text-uppercase'>$key[cantidad]</td>
                         <td class='text-center text-uppercase'>$ $precio</td>
                         <td class='text-center text-uppercase'>$ $subtotal</td>
                         </tr>";
                $num++;
            }
        }else{
            $html .="<tr>
            <td class='text-center text-uppercase' colspan=6>$informacion</td>
            </tr>";
        }
        echo json_encode(array('html' => $html));
        break;

    case 'carrito_compra':
        $html = '';
        $producto_id = $_POST['id'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $producto = $_POST['producto'];
        $total = 0;
        $lista = array();

        if (isset($_SESSION['carrito_compra'])) {
            $lista = $_SESSION['carrito_compra'];
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
            $subtotal = $precio * $cantidad;
            $lista[$posicion] = array('id' => $producto_id, 'precio' => $precio, 'cantidad' => $cantidad, 'producto' => $producto, 'subtotal' => $subtotal);
        } else {
            $subtotal = $precio * $cantidad;
            $lista[] = array('id' => $producto_id, 'precio' => $precio, 'cantidad' => $cantidad, 'producto' => $producto, 'subtotal' => $subtotal);
        }
        $_SESSION['carrito_compra'] = $lista;
        foreach ($lista as $key){
            $subtotal=number_format($key['subtotal'],'2',',','.');
            $precio=number_format($key['precio'],'2',',','.');
            $html .= "<tr>
                      <td class='text-center text-capitalize'>".$key['producto']."</td>
                      <td class='text-center'>".$key['cantidad']."</td>;
                      <td class='text-center'>$ ".$precio."</td>;
                      <td class='text-center'>$ ".$subtotal."</td>;
                      <td class='text-center'>
                      <button type='button' class='btn btn-default' onclick='quitar_compra(" .$key['id']. ")' ><span class='fa fa-times-circle text-danger' aria-hidden='true'></span></button>
                      </td>;
                </tr>";
            $total += $key['subtotal'];
        }
        echo json_encode(array('html' => $html, 'total' => $total));

        break;

    case 'quitar_compra':
        $html = '';
        $id_pedido = $_POST['id'];
        $lista = array();
        $total = 0.00;
        $listaanterio = array();

        if (isset($_SESSION['carrito_compra'])) {
            $listaanterio = $_SESSION['carrito_compra'];
        }

        // generar el nuevo array sin el elemento
        for ($i = 0; $i < count($listaanterio); $i++) {
            if ($listaanterio[$i]['id'] != $id_pedido) {
                $lista[] = array('id' => $listaanterio[$i]['id'], 'precio' => $listaanterio[$i]['precio'], 'cantidad' => $listaanterio[$i]['cantidad'], 'producto' => $listaanterio[$i]['producto'], 'subtotal' => $listaanterio[$i]['subtotal']);
            }
        }
        $_SESSION['carrito_compra'] = $lista;

        foreach ($lista as $key) {
            $subtotal=number_format($key['subtotal'],'2',',','.');
            $precio=number_format($key['precio'],'2',',','.');
            $html .= "<tr>
                         <td class='text-center'>$key[producto]</td>
                         <td class='text-center'>$key[cantidad]</td>
                         <td class='text-center'>$ $precio</td>
                         <td class='text-center'>$ $subtotal</td>
                         <td class='text-center'>
                         <button type='button' class='btn btn-default' onclick='quitar_compra(" .$key['id']. ")'><span class='fa fa-times-circle text-danger' aria-hidden='true'></span></button>
                         </td>
                         </tr>";
            $total += $key['subtotal'];
        }
        echo json_encode(array('html' => $html, 'total' => $total));
        break;

    case 'vaciar_compra':
        unset($_SESSION['carrito_compra']);
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
