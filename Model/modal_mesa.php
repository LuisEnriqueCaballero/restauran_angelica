<?php 
class MetodoMesa{
    public function lista_mesa(){
        $conexion = new conectar();
        $cnx = $conexion->conexion();

        $sql="SELECT TM.id_mesa, TM.capacidad, TES.estado, TM.numero FROM mesa AS TM
              INNER JOIN estado AS TES ON TES.id=TM.estado 
              WHERE TM.estado <> 7";
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

    public function updateMesa($id_mesa, $capacidad, $numero){
        $conexion = new conectar();
        $cnx = $conexion->conexion();

        $sql="UPDATE mesa SET capacidad='$capacidad', numero='$numero' WHERE id_mesa='$id_mesa';";
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