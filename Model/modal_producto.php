<?php 
class MetodoProducto{
    public function lista_CategoriaProducto(){
        $util=new Util();
        $sql="SELECT id_producto ,descrip_categoria FROM categoriaproducto";
        if(!empty($categoria)){
            $sql .=" WHERE descrip_categoria LIKE '$categoria%'";
        }
        $query = $util->Consulta($sql);
        return $query;
    }

    public function InsertCategorioProducto($descrip_categoria){
        $util=new Util();
        $sql="INSERT INTO categoriaproducto (descrip_categoria) VALUE ('$descrip_categoria')";
        $query = $util->Consulta($sql);
        return $query;
    }
    public function UpdateCategorioProducto($id,$descrip_categoria){
        $util=new Util();
        $sql="UPDATE categoriaproducto SET descrip_categoria='$descrip_categoria' WHERE id_producto='$id'";
        $query = $util->Consulta($sql);
        return $query;
    }
    public function DeleteCategorioProducto($id){
        $util=new Util();
        $sql="DELETE FROM categoriaproducto WHERE id_producto='$id'";
        $query = $util->Consulta($sql);
        return $query;
    }
    public function GetCategorioProducto($id){
        $util=new Util();
        $sql="SELECT id_producto ,descrip_categoria FROM categoriaproducto WHERE id_producto='$id'";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function lista_Producto($categoria,$producto){
        $util=new Util();
        $sql="SELECT PRO.id, CAT.descrip_categoria,PRO.descrip_producto,CAT.id_producto FROM producto AS PRO
             INNER JOIN categoriaproducto AS CAT ON CAT.id_producto=PRO.categoria";
        if(!empty($categoria)){
            $sql .=" WHERE CAT.id_producto = {$categoria} ";
            if(strpos($sql,'WHERE')){
                if(!empty($producto)){
                    $sql .= " AND PRO.descrip_producto LIKE '$producto%'";
                }
            }
        }else if(!empty($producto)){
                $sql .= " WHERE PRO.descrip_producto LIKE '$producto%'";
        }
        $query = $util->Consulta($sql);
        return $query;
    }

    public function InsertProducto($categoria,$producto){
        $util=new Util();
        $sql="INSERT INTO producto (categoria,descrip_producto) VALUE ('$categoria','$producto')";
        $query = $util->Consulta($sql);
        return $query;
    }
    public function UpdateProducto($id,$categoria,$producto){
        $util=new Util();
        $sql="UPDATE producto SET categoria='$categoria', descrip_producto='$producto' WHERE id='$id'";
        $query = $util->Consulta($sql);
        return $query;
    }
    public function DeleteProducto($id){
        $util=new Util();
        $sql="DELETE FROM producto WHERE id='$id'";
        $query = $util->Consulta($sql);
        return $query;
    }
    public function GetProducto($id){
        $util=new Util();
        $sql="SELECT id ,categoria,descrip_producto FROM producto WHERE id='$id'";
        $query = $util->Consulta($sql);
        return $query;
    }
}