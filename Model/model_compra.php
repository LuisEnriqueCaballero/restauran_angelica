<?php
class MetodoCompra{
    public function lista_compra(){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT TBCO.tipo_boleta,TBCO.numero_recibo,TBPRO.empresa,TBCO.total,TBCO.fecha_compra FROM compra as TBCO
        INNER JOIN proveedor AS TBPRO ON TBPRO.id_proveedor=TBCO.id_proveedor;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function insertCompra($tipo_boleta,$numero_recibo,$id_proveedor,$total,$fecha_compra,$mes,$anio){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO compra(tipo_boleta,numero_recibo,id_proveedor,total,fecha_compra,mes,anio) VALUE('$tipo_boleta','$numero_recibo','$id_proveedor','$total','$fecha_compra','$mes','$anio');";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function ultimoCompra(){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT id FROM compra ORDER BY id DESC LIMIT 1;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function lista_detalleCompra(){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT TBDP.id, TBDP.id_compra, TBPR.descrip_producto,TBDP.cantidad, TBDP.precio, TBDP.sub_total FROM detalle_compra AS TBDP
        INNER JOIN producto AS TBPR ON TBPR.id=TBDP.producto
        INNER JOIN compra AS TBCO ON TBCO.id=TBDP.id_compra;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function detalleCompra($id_compra, $producto,$cantidad, $precio, $sub_total){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO detalle_compra(id_compra, producto,cantidad, precio, sub_total) VALUE('$id_compra', '$producto','$cantidad', '$precio', '$sub_total') ";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>