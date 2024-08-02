<?php
include_once 'cnmysql.php';
class Util{
    public function seguridad($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    public function hash_pass($pass){
        $pass =trim($pass);
        $pass=stripslashes($pass);
        $pass=md5($pass);
        return $pass;
    }
    public function fecha_hora($date){
        $date =date('d/m/Y H:i:s');
        return $date;
    }
    public function Consulta($sql){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>