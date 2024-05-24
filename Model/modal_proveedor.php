<?php
class MetodoProveedor{
    public function Lista_Proveedor($empresa,$nombre_proveedor){
        $conexion=new conectar();
        $cnx=$conexion->conexion();

        $sql="SELECT id_proveedor, empresa, ruc, nombre_proveedor,telefono, direccion FROM proveedor  WHERE estado<>'inactivo'";
        if(!empty($empresa) || !empty($nombre_proveedor) ){
            $sql .= " AND empresa LIKE '$empresa%' AND nombre_proveedor LIKE '$nombre_proveedor%'";
        }
        $query = mysqli_query($cnx,$sql);
        return $query;
    }

    public function insertProveedor($empresa,$ruc,$nombre,$telefono,$direccion){
        $conexion=new conectar();
        $cnx=$conexion->conexion();

        $sql="INSERT INTO proveedor(empresa, ruc,nombre_proveedor,telefono,  direccion,estado) VALUE ('$empresa','$ruc','$nombre','$telefono','$direccion','activo');";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }
    public function getProveedor($id){
        $conexion=new conectar();
        $cnx=$conexion->conexion();

        $sql="SELECT id_proveedor, empresa, ruc,nombre_proveedor,telefono,  direccion FROM proveedor WHERE id_proveedor='$id';";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }

    public function updateProveedor($id,$empresa,$ruc,$nombre,$telefono,$direccion){
        $conexion=new conectar();
        $cnx=$conexion->conexion();

        $sql="UPDATE proveedor SET  empresa='$empresa', ruc='$ruc',nombre_proveedor='$nombre',telefono='$telefono',  direccion='$direccion' WHERE id_proveedor='$id';";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }

    public function deleteProveedor($id){
        $conexion=new conectar();
        $cnx=$conexion->conexion();

        $sql="UPDATE proveedor SET estado='inactivo' WHERE id_proveedor='$id';";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }

    public function selectProveedor(){
        $conexion=new conectar();
        $cnx=$conexion->conexion();

        $sql="SELECT id_proveedor,concat(empresa,'-',nombre_proveedor) AS proveedor FROM proveedor";
        $query = mysqli_query($cnx,$sql);
        return $query;
    }
}
?>