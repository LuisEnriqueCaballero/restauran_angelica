<?php
class MetodoUsuario{
    public function LogueUsuario($usuario,$password){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT * FROM usuario WHERE nombre='$usuario' AND password='$password'";
        $query=mysqli_query($cnx,$sql);
        echo $query;
        return;
    }
}
?>