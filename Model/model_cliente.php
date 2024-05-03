<?php 
class MetodoCliente{
    public function list_cliente($cliente){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT id_cliente,dato_cliente,telefono,email,Direccion FROM clientes WHERE estado<>'inactivo' ";
        if(!empty($cliente) && $cliente !==null){
            // siempre ve ver in espacio en where
            $sql .= "AND dato_cliente LIKE '$cliente%'";
        }
        $prepare=mysqli_query($cnx,$sql);
        return $prepare;
    }
    public function insertcliente($cliente,$telefono,$email,$direccion){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO clientes(dato_cliente,telefono,email,Direccion,estado) VALUES ('$cliente','$telefono','$email','$direccion','activo')";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function getcliente($id){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT id_cliente,dato_cliente,telefono,email,Direccion FROM clientes WHERE id_cliente={$id}";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function updatecliente($id,$cliente,$telefono,$email,$direccion){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="UPDATE clientes SET dato_cliente='$cliente',telefono='$telefono',email='$email',Direccion='$direccion' WHERE id_cliente='$id'";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function deleteCiente($id){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="UPDATE clientes SET estado='inactivo' WHERE id_cliente={$id}";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}

?>