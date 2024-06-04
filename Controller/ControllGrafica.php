<?php
require_once "../Config/cnmysql.php";
require_once "../Model/model_grafico.php";
$mese=['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
$metodografico=new MetodoGraficos();
$ope=isset($_GET['ope'])?$_GET['ope']:'';

switch ($ope) {
    case 'grafica_anio':
        $anio=isset($_POST['id'])?$_POST['id']:'';
        $listagrafico=$metodografico->Grafica_kardex_financiero($anio);
        $montoegreso=array();
        $montoingreso=array();
        $total=array();
        $meses=array();
        foreach($listagrafico as $key){
            $montoegreso[]=$key['EGRESO'];
            $montoingreso[]=$key['INGRESO'];
            $meses[]=$key['mes'];
            $total[]=$key['total'];
        }
        echo json_encode(array('meses'=>$meses,'montoegreso'=>$montoegreso, 'montoingreso'=>$montoingreso,'total'=>$total));
        break;
    
    case 'grafica_meses':
        $fecha_inicio=isset($_POST['fech_ini'])?$_POST['fech_ini']:'';
        $fecha_fin=isset($_POST['fech_fi'])?$_POST['fech_fi']:'';
        $listagrafico=$metodografico->Grafica_fecha_kardex($fecha_inicio,$fecha_fin);
        $montoegreso=array();
        $montoingreso=array();
        $fecha=array();
        foreach($listagrafico as $key){
            $montoegreso[]=$key['EGRESO'];
            $montoingreso[]=$key['INGRESO'];
            $fecha[]=$key['fecha'];
        }
        echo json_encode(array('fecha'=>$fecha,'egreso'=>$montoegreso, 'ingreso'=>$montoingreso));
        break;
    
    case 'maspedido':
        $html='';
        $comentario='No hay datos';
        $fecha_ini=isset($_POST['fech_ini'])?$_POST['fech_ini']:'';
        $fecha_fin=isset($_POST['fech_fin'])?$_POST['fech_fin']:'';
        $listamaspedio=$metodografico->plato_pedido_dia($fecha_ini,$fecha_fin);
        $num_fila=mysqli_num_rows($listamaspedio);
        $num=0;
            if($num_fila >0){
                while($key=mysqli_fetch_array($listamaspedio)) {
                    ++$num;
                    $html .='<tr>
                             <td class="text-center">'.$num.'</td>
                             <td class="text-center text-capitalize">'.$key["descripcion"].'</td>
                             <td class="text-center">'.$key["CANTIDAD"].'</td>
                             </tr>';
                }
            }else{
                $html .='<tr>
                             <td class="text-center" colspan=3>'.$comentario.'</td>
                         </tr>';
            }
        echo  json_encode(array('html'=>$html));
        break;
    
    case 'grafico_pie':
        $mes=isset($_POST['meses'])?$_POST['meses']:'';
        $anio=isset($_POST['anios'])?$_POST['anios']:'';
        $listamaspedio=$metodografico->Menu_Mas_Pedido($mes,$anio);
        $cantidad=array();
        $producto=array();
        foreach ($listamaspedio as $key) {
            $producto[]=$key['descripcion'];
            $cantidad[]=$key['CANTIDAD'];
        }
        echo json_encode(array('cantidad'=>$cantidad,'producto'=>$producto));
        break;

    default:
        # code...
        break;
}
?>