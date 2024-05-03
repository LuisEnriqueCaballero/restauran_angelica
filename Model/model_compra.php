<?php
class MetodoCompra{
    public function lista_compra(){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT tipo_boleta,numero_recibo,id_proveedor,total,fecha_compra FROM compra;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function insertCompra($tipo_boleta,$numero_recibo,$id_proveedor,$total,$fecha_compra){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO compra(tipo_boleta,numero_recibo,id_proveedor,total,fecha_compra) VALUE('$tipo_boleta','$numero_recibo','$id_proveedor','$total','$fecha_compra');";
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
        $sql="SELECT id, id_compra, producto,cantidad, precio, sub_total FROM detalle_compra ";
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