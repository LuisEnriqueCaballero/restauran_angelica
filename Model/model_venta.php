<?php
class MetodoVenta{
    public function lista_venta($cliente,$mesa){
        $conectar= new conectar();
        $cnx = $conectar->conexion();
        $sql="SELECT TBPED.id_pedido,TBC.dato_cliente,TBC.Direccion,TBC.telefono,TBPED.tipo_pago,TAT.estado AS PENDIENTE,TES.estado,TBPED.fecha_hora,TBPED.total FROM pedido AS TBPED 
               INNER JOIN clientes AS TBC ON TBC.id_cliente=TBPED.id_cliente
               INNER JOIN estado AS TES ON TES.id=TBPED.estado
               INNER JOIN atendido AS TAT ON TAT.id=TBPED.atencion";
              if(!empty($cliente)){
                $sql .=" WHERE TBC.dato_cliente={$cliente}";
              }
              if(!empty($mesa)){
                $sql .=" WHERE TBM.numero={$mesa}";
              }
         
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    
    public function insertVenta($id_cliente,$estado,$fecha_hora,$total,$id_mesa,$tipo_pago,$tipo_atencion,$atencion,$mes,$anio,$efectivo_total){
        $conectar= new conectar();
        $cnx = $conectar->conexion();
        $sql="INSERT INTO pedido(id_cliente,estado,fecha_hora,total,id_mesa,tipo_pago,tipo_atencion,atencion,mes,anio,efectivo_total) VALUE ('$id_cliente','$estado','$fecha_hora','$total','$id_mesa','$tipo_pago','$tipo_atencion','$atencion','$mes','$anio','$efectivo_total')";
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
    public function lista_venta_mesa($cliente,$mesa){
        $conectar= new conectar();
        $cnx = $conectar->conexion();
        $sql="SELECT TBPED.id_pedido,TBM.numero,TPS.descripcion,TBPED.tipo_atencion,TES.estado AS pendiente,TBPED.fecha_hora,TBPED.total,TAS.estado FROM pedido AS TBPED 
               INNER JOIN mesa AS TBM ON TBM.id_mesa=TBPED.id_mesa
               INNER JOIN estado AS TES ON TES.id=TBPED.estado
               INNER JOIN atendido AS TAS ON TAS.id=TBPED.atencion
               INNER JOIN medio_pago AS TPS ON TPS.id=TBPED.tipo_pago
               WHERE TBPED.estado <> 4 ";
              if(!empty($cliente)){
                $sql .=" AND TBC.dato_cliente={$cliente}";
              }
              if(!empty($mesa)){
                $sql .=" AND TBM.numero={$mesa}";
              }
         
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function getVenta($id){
      $conectar= new conectar();
      $cnx = $conectar->conexion();
      $sql = "SELECT id_pedido,tipo_pago,total FROM pedido WHERE id_pedido='$id'";
      $query=mysqli_query($cnx,$sql);
      return $query;
    }

    public function atendido_pedido($id){
      $conectar= new conectar();
      $cnx = $conectar->conexion();
      $sql = "UPDATE pedido SET atencion='1' WHERE id_pedido='$id'";
      $query=mysqli_query($cnx,$sql);
      return $query;
    }

    public function atendido_pagado($id,$tipo,$monto_efect){
      $conectar= new conectar();
      $cnx = $conectar->conexion();
      $sql = "UPDATE pedido SET estado='3',tipo_pago='$tipo',efectivo_total='$monto_efect' WHERE id_pedido='$id'";
      $query=mysqli_query($cnx,$sql);
      return $query;
    }

    public function anulado($id){
      $conectar= new conectar();
      $cnx = $conectar->conexion();
      $sql = "UPDATE pedido SET estado='4',atencion='3' WHERE id_pedido='$id'";
      $query=mysqli_query($cnx,$sql);
      return $query;
    }
    public function ticke($id){
      $conectar= new conectar();
      $cnx = $conectar->conexion();
      $sql="SELECT TP.id_pedido,TMP.numero,TP.total,TP.fecha_hora FROM pedido AS TP 
            INNER JOIN mesa AS TMP ON TMP.id_mesa=TP.id_mesa
            WHERE TP.id_pedido='$id';";
      $query=mysqli_query($cnx,$sql);
      return $query;
    }
    public function ticket($id){
      $conectar= new conectar();
      $cnx = $conectar->conexion();
      $sql="SELECT TP.id_pedido,TP.total,TP.fecha_hora,TCL.dato_cliente,TCL.telefono,TCL.Direccion FROM pedido AS TP 
            INNER JOIN clientes AS TCL ON TCL.id_cliente=TP.id_cliente
            WHERE TP.id_pedido='$id';";
      $query=mysqli_query($cnx,$sql);
      return $query;
    }
    public function detalle_ticke($id){
      $conectar= new conectar();
      $cnx = $conectar->conexion();
      $sql="SELECT TM.descripcion,TPD.cantidad,TPD.precio_unitario,TPD.sub_total FROM detalle_pedido AS TPD
      INNER JOIN menu AS TM ON TM.id_menu=TPD.id_producto
      WHERE TPD.id_pedido='$id';";
      $query=mysqli_query($cnx,$sql);
      return $query;
    }

    /*tipo pago */

    public function tipo_pago(){
      $conectar= new conectar();
      $cnx = $conectar->conexion();
      $sql="SELECT id,descripcion FROM medio_pago";
      $query=mysqli_query($cnx,$sql);
      return $query;
    }
}
?>