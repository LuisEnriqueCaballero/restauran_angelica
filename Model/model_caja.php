<?php 
class Metodocaja{
    public function lista_caja(){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT id_caja,numero_caja,estado,fecha_apertura,fecha_cierre, monto_inicial FROM caja";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function insertCaja($numero_caja,$estado,$fecha_apertura, $monto_incial){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="INSERT INTO caja(numero_caja,estado,fecha_apertura, monto_inicial) VALUE ('$numero_caja','$estado','$fecha_apertura','$monto_incial')";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function getCaja($id_caja){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT id_caja,numero_caja,estado,fecha_apertura,fecha_cierre, monto_inicial FROM caja WHERE id_caja='$id_caja'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function updateCaja($id_caja,$numero_caja,$estado,$fecha_apertura,$fecha_cierre, $monto_incial){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="UPDATE caja SET numero_caja='$numero_caja',estado='$estado',fecha_apertura='$fecha_apertura',fecha_cierre='$fecha_cierre', monto_inicial='$monto_incial' WHERE id_caja='$id_caja'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function deleteCaja($id_caja){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="DELETE FROM caja WHERE id_caja='$id_caja'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function ultimocaja(){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT  id_caja, monto_inicial FROM caja ORDER BY id_caja DESC LIMIT 1";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function updatemontocaja($id,$monto){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="UPDATE caja SET monto_inicial='$monto' WHERE id_caja='$id'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>