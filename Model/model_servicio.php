<?php
class MetodoServicio{
    public function lista_pago_servicio(){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT id, tipo_servicio,numero_servicio,monto_pago,fecha_pago FROM pago_servicio;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function insertPagoServicio($tipo_servicio,$numero_servicio,$monto_pago,$fecha_pago){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO pago(tipo_servicio,numero_servicio,monto_pago,fecha_pago) VALUE('$tipo_servicio','$numero_servicio','$monto_pago','$fecha_pago');";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function getPagoServicio($id){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT id, tipo_servicio,numero_servicio,monto_pago,fecha_pago FROM pago_servicio WHERE id='$id';";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function updatePagoServicio($id,$tipo_servicio,$numero_servicio,$monto_pago,$fecha_pago){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="UPDATE pago_servicio SET  id='$id',tipo_servicio='$tipo_servicio',numero_servicio='$numero_servicio',monto_pago='$monto_pago',fecha_pago='$fecha_pago' WHERE id='$id' ";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function deletePagoServicio($id){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="DELETE FROM pago_servicio WHERE id='$id'; ";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>