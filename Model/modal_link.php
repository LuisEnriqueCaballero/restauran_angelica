<?php
class linkmenu{
    public function lista_link(){
        $conexion = new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT id, link, iconno, estado FROM linkmenu 
        WHERE estado='activo'
        ORDER BY orden asc";
        $result=mysqli_query($cnx,$sql);
        return $result;
    }
    
    public function lista_sublink($id){
        $conexion = new conectar();
        $cnx= $conexion->conexion();
        $sql="SELECT id, sublinkmenu, enlace,link,estado FROM sublinkmenu WHERE  link={$id} and estado='activo'";
        $result=mysqli_query($cnx,$sql);
        return $result;
    }
    
}
?>