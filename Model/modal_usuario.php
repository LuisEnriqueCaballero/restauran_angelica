<?php
class MetodoUsuario{
    public function LogueUsuario($usuario,$password){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT nombre,password FROM usuario WHERE nombre='$usuario' AND password='$password'";
        $query=mysqli_query($cnx,$sql);
        $num_fila=mysqli_num_rows($query);
        return $num_fila;
    }
}
?>