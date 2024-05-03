<?php
class MetodoVenta{
    public function lista_venta(){
        $conectar= new conectar();
        $cnx = $conectar->conexion();
        $sql="SELECT id_pedido,id_cliente,estado,fecha_hora,total FROM pedido";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    
    public function insertVenta($id_cliente,$estado,$fecha_hora,$total){
        $conectar= new conectar();
        $cnx = $conectar->conexion();
        $sql="INSERT INTO pedido( id_cliente,estado,fecha_hora,total) VALUE ('$id_cliente','$estado','$fecha_hora','$total')";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function ultimoPedido(){
        $conectar= new conectar();
        $cnx = $conectar->conexion();
        $sql="SELECT id_pedido FROM pedido ORDER BY id_pedido DESC limit 1";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function detalle_pedido($id_pedido,$id_producto,$cantidad,$precio_unitario,$sub_total){
        $conectar= new conectar();
        $cnx = $conectar->conexion();
        $sql="INSERT INTO detalle_pedido(id_pedido,id_producto,cantidad,precio_unitario,sub_total) VALUE ('$id_pedido','$id_producto','$cantidad','$precio_unitario','$sub_total')";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function lista_pedido(){
        $conectar= new conectar();
        $cnx = $conectar->conexion();
        $sql="SELECT TBDP.id_pedido,TBM.descripcion,TBDP.cantidad,TBDP.precio_unitario,TBDP.sub_total FROM detalle_pedido AS TBDP
              INNER JOIN menu AS TBM ON TBM.id_menu = TBDP.id_producto";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>