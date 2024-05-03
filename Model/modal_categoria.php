<?php 
class MetodoCategoria{
    public function lista_categoria(){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "SELECT id_categoria, descripcion FROM  categoriamenu;";
        $query = mysqli_query($cnx, $sql);
        return $query;
    }

    public function insertCategoria($categoria){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "INSERT INTO categoriamenu (descripcion) VALUE ('$categoria');";
        $query = mysqli_query($cnx, $sql);
        return $query;
    }
    public function updateCategoria($id_categoria, $descripcion){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "UPDATE categoriamenu SET descripcion='$descripcion' WHERE id_categoria='$id_categoria';";
        $query = mysqli_query($cnx, $sql);
        return $query;
    }

    public function getCategoria($id){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "SELECT id_categoria, descripcion FROM  categoriamenu WHERE id_categoria='$id';";
        $query = mysqli_query($cnx, $sql);
        return $query;
    }

    public function deleteCategoria($id){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "    DELETE FROM  categoriamenu WHERE id_categoria='$id';";
        $query = mysqli_query($cnx, $sql);
        return $query;
    }
}
?>