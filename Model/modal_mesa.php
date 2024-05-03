<?php 
class MetodoMesa{
    public function lista_mesa(){
        $conexion = new conectar();
        $cnx = $conexion->conexion();

        $sql="SELECT id_mesa, capacidad, estado, numero FROM mesa ;";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }

    public function insertMesa($capacidad, $estado, $numero){
        $conexion = new conectar();
        $cnx = $conexion->conexion();

        $sql="INSERT INTO mesa (capacidad, estado, numero) VALUE('$capacidad', '$estado', '$numero');";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }

    public function updateMesa($id_mesa, $capacidad, $estado, $numero){
        $conexion = new conectar();
        $cnx = $conexion->conexion();

        $sql="UPDATE mesa SET capacidad='$capacidad', estado='$estado', numero='$numero' WHERE id_mesa='$id_mesa';";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }

    public function getMesa($id_mesa){
        $conexion = new conectar();
        $cnx = $conexion->conexion();

        $sql="SELECT id_mesa, capacidad, estado, numero FROM mesa WHERE id_mesa='$id_mesa';";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }

    public function deleteMesa($id_mesa){
        $conexion = new conectar();
        $cnx = $conexion->conexion();

        $sql="DELETE FROM mesa WHERE id_mesa='$id_mesa';";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }
}
?>