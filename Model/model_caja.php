<?php 
class Metodocaja{
    public function lista_multicajas(){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT TMC.id_caja_apert,TC.descripcion,TMC.monto_inicial,TMC.fecha_apertura,TMC.mes,TMC.anio,TES.estado FROM multicajas AS TMC 
              INNER JOIN caja AS TC ON TC.id_caja=TMC.id_caja AND TC.estado<>'5'
              INNER JOIN estado AS TES ON TMC.estado=TES.id 
              WHERE TMC.estado <>'9'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function lista_multicajascierre(){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT TMC.id_caja_apert,TC.descripcion,TMC.monto_inicial,TMC.fecha_cierre,TMC.mes,TMC.anio FROM multicajas AS TMC
              INNER JOIN caja AS TC ON TC.id_caja=TMC.id_caja
              INNER JOIN estado as TES ON TMC.estado=TES.id
              WHERE TMC.estado <> '10'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function insertmulticaja($id_caja,$monto_inicial,$estado,$fecha_apertura,$mes,$anio){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="INSERT INTO multicajas(id_caja,monto_inicial,estado,fecha_apertura,mes,anio) VALUE ('$id_caja','$monto_inicial','$estado','$fecha_apertura','$mes','$anio')";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function getmulticaja($id){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT TMC.id_caja_apert,TMC.id_caja,TC.descripcion FROM multicajas AS TMC
              INNER JOIN caja AS TC ON TC.id_caja=TMC.id_caja AND TC.estado<>'5'
              WHERE TMC.estado <> 'cerrado' AND TMC.id_caja_apert='$id';";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function updatemulticaja($id,$id_caja){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="UPDATE multicajas SET id_caja='$id_caja' WHERE id_caja_apert ='$id'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function cierrecaja($id,$fecha){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="UPDATE multicajas SET estado='9',fecha_cierre='$fecha' WHERE id_caja_apert='$id'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function aumentadinero($id,$monto){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="UPDATE multicajas SET monto_inicial='$monto' WHERE id_caja_apert='$id'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function  montoactual($id){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT id_caja_apert,monto_inicial FROM multicajas WHERE id_caja_apert='$id'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function ultimocaja(){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT id_caja_apert,monto_inicial FROM multicajas ORDER BY id_caja_apert DESC  LIMIT 1";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    
     public function updatemontocaja($id,$monto){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="UPDATE multicajas SET monto_inicial='$monto' WHERE id_caja_apert='$id'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

   
    /*CREACION DE CAJAS CRUD*/

    public function listacajas(){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT TCA.id_caja,TCA.descripcion,TES.estado,TCA.fecha,TCA.mes,TCA.anio FROM caja AS TCA
              INNER JOIN estado AS TES ON TCA.estado=TES.id
              WHERE TCA.estado<>'5'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function INSERTACAJA($descripcion,$estado,$fecha,$mes,$anio){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="INSERT INTO caja(descripcion,estado,fecha,mes,anio) VALUES ('$descripcion','$estado','$fecha','$mes','$anio')";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function UPDATECAJAS($id,$descripcion){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="UPDATE caja SET descripcion='$descripcion' WHERE id_caja='$id'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function OBTENERCAJA($id){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT id_caja,descripcion FROM caja WHERE id_caja={$id}";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function DESACTIVARCAJA($id){
        $conexion=new conectar();
        $cnx= $conexion->conexion();
        $sql="UPDATE caja SET estado='5' WHERE id_caja={$id}";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>