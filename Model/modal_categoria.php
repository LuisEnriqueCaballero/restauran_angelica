<?php 
class MetodoCategoria{
    public function lista_categoria(){
        $util=new Util();
        $sql = "SELECT id_categoria, descripcion FROM  categoriamenu;";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function insertCategoria($categoria){
        $util=new Util();
        $sql = "INSERT INTO categoriamenu (descripcion) VALUE ('$categoria');";
        $query = $util->Consulta($sql);
        return $query;
    }
    public function updateCategoria($id_categoria, $descripcion){
        $util=new Util();
        $sql = "UPDATE categoriamenu SET descripcion='$descripcion' WHERE id_categoria='$id_categoria';";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function getCategoria($id){
        $util=new Util();
        $sql = "SELECT id_categoria, descripcion FROM  categoriamenu WHERE id_categoria='$id';";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function deleteCategoria($id){
        $util=new Util();
        $sql = "    DELETE FROM  categoriamenu WHERE id_categoria='$id';";
        $query = $util->Consulta($sql);
        return $query;
    }
}
?>