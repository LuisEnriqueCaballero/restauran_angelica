<?php
class MetodoServicio{
    public function lista_pago_servicio(){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT TPS.empresa,TPS.ruc, TTS.descripcion,TPS.numero_recibo,TPS.monto_pago,TPS.fecha_pago,TPS.mes,TPS.anio FROM pago_servicio AS TPS INNER JOIN tipo_servicio AS TTS ON TTS.id=TPS.tipo_servicio;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function insertPagoServicio($empresa,$ruc,$tipo_servicio,$numero_servicio,$monto_pago,$fecha_pago,$mes,$anio){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO pago_servicio(empresa,ruc,tipo_servicio,numero_recibo,monto_pago,fecha_pago,mes,anio) VALUE('$empresa','$ruc','$tipo_servicio','$numero_servicio','$monto_pago','$fecha_pago','$mes','$anio');";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function getPagoServicio($id){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT SELECT id, tipo_servicio,numero_recibo,monto_pago,fecha_pago FROM pago_servicio; FROM pago_servicio WHERE id='$id';";
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
    public function listaServicio(){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT id, descripcion FROM tipo_servicio;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>