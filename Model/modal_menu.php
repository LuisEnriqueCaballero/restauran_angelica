<?php 
class MetodoMenu{
    public function lista_Menu($nombre,$categoria){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "SELECT TME.id_menu,TCA.descripcion AS categoria_menu, TME.descripcion,TME.precio,TCA.id_categoria FROM menu AS TME
                INNER JOIN categoriamenu AS TCA ON TCA.id_categoria=TME.categoria";
        if(!empty($categoria)){
            $sql .= " WHERE  TCA.id_categoria = '$categoria'";
            if(strpos($sql,'WHERE')){
                if(!empty($nombre)){
                   $sql .= " AND TME.descripcion LIKE '$nombre%'";
                }
            }
         }else if(!empty($nombre)){
            $sql .= " WHERE TME.descripcion LIKE '$nombre%'";
        }
        $query = mysqli_query($cnx, $sql);
        return $query;
    }

    public function insertMenu($categoria,$descripcion,$precio){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "INSERT INTO menu (categoria,descripcion,precio) VALUE ('$categoria','$descripcion','$precio');";
        $query = mysqli_query($cnx, $sql);
        return $query;
    }
    public function updateMenu($id_menu,$categoria,$descripcion,$precio){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "UPDATE menu SET categoria='$categoria' ,descripcion='$descripcion', precio='$precio' WHERE id_Menu='$id_menu';";
        $query = mysqli_query($cnx, $sql);
        return $query;
    }

    public function getMenu($id){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "SELECT id_menu,categoria, descripcion,precio FROM  menu WHERE id_menu='$id';";
        $query = mysqli_query($cnx, $sql);
        return $query;
    }

    public function deleteMenu($id){
        $conexion = new conectar();
        $cnx= $conexion->conexion();

        $sql = "DELETE FROM  menu WHERE id_menu='$id';";
        $query = mysqli_query($cnx, $sql);
        return $query;
    }
}
?>