<?php
class MetodoCompra{
    public function lista_compra(){
        $util=new Util();
        $sql="SELECT TBCO.tipo_boleta,TBCO.numero_recibo,TBPRO.empresa,TBCO.total,TBCO.fecha_compra FROM compra as TBCO
        INNER JOIN proveedor AS TBPRO ON TBPRO.id_proveedor=TBCO.id_proveedor;";
        $query=$util->Consulta($sql);
        return $query;
    }
    public function insertCompra($tipo_boleta,$numero_recibo,$id_proveedor,$total,$fecha_compra,$mes,$anio){
        $util=new Util();
        $sql="INSERT INTO compra(tipo_boleta,numero_recibo,id_proveedor,total,fecha_compra,mes,anio) VALUE('$tipo_boleta','$numero_recibo','$id_proveedor','$total','$fecha_compra','$mes','$anio');";
        $query=$util->Consulta($sql);
        return $query;
    }
    public function ultimoCompra(){
        $util=new Util();
        $sql="SELECT id FROM compra ORDER BY id DESC LIMIT 1;";
        $query=$util->Consulta($sql);
        return $query;
    }
    public function lista_detalleCompra(){
        $util=new Util();
        $sql="SELECT TBDP.id, TBDP.id_compra, TBPR.descrip_producto,TBDP.cantidad, TBDP.precio, TBDP.sub_total FROM detalle_compra AS TBDP
        INNER JOIN producto AS TBPR ON TBPR.id=TBDP.producto
        INNER JOIN compra AS TBCO ON TBCO.id=TBDP.id_compra;";
        $query=$util->Consulta($sql);
        return $query;
    }
    public function detalleCompra($id_compra, $producto,$cantidad, $precio, $sub_total){
        $util=new Util();
        $sql="INSERT INTO detalle_compra(id_compra, producto,cantidad, precio, sub_total) VALUE('$id_compra', '$producto','$cantidad', '$precio', '$sub_total') ";
        $query=$util->Consulta($sql);
        return $query;
    }
}
?>