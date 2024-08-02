<?php
class MetodoProveedor{
    public function Lista_Proveedor($empresa,$nombre_proveedor){
        $util=new Util();
        $sql="SELECT id_proveedor, empresa, ruc, nombre_proveedor,telefono, direccion FROM proveedor  WHERE estado<>'inactivo'";
        if(!empty($empresa) || !empty($nombre_proveedor) ){
            $sql .= " AND empresa LIKE '$empresa%' AND nombre_proveedor LIKE '$nombre_proveedor%'";
        }
        $query = $util->Consulta($sql);
        return $query;
    }

    public function insertProveedor($empresa,$ruc,$nombre,$telefono,$direccion){
        $util=new Util();
        $sql="INSERT INTO proveedor(empresa, ruc,nombre_proveedor,telefono,  direccion,estado) VALUE ('$empresa','$ruc','$nombre','$telefono','$direccion','activo');";
        $query = $util->Consulta($sql);
        return $query;
    }
    public function getProveedor($id){
        $util=new Util();
        $sql="SELECT id_proveedor, empresa, ruc,nombre_proveedor,telefono,  direccion FROM proveedor WHERE id_proveedor='$id';";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function updateProveedor($id,$empresa,$ruc,$nombre,$telefono,$direccion){
        $util=new Util();
        $sql="UPDATE proveedor SET  empresa='$empresa', ruc='$ruc',nombre_proveedor='$nombre',telefono='$telefono',  direccion='$direccion' WHERE id_proveedor='$id';";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function deleteProveedor($id){
        $util=new Util();
        $sql="UPDATE proveedor SET estado='inactivo' WHERE id_proveedor='$id';";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function selectProveedor(){
        $util=new Util();
        $sql="SELECT id_proveedor,concat(empresa,'-',nombre_proveedor) AS proveedor FROM proveedor";
        $query = $util->Consulta($sql);
        return $query;
    }
}
?>