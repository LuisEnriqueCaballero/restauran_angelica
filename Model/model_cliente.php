<?php 
class MetodoCliente{
    public function list_cliente($cliente){
        $util=new Util();
        $sql="SELECT id_cliente,dato_cliente,telefono,email,Direccion FROM clientes WHERE estado<>'inactivo' ";
        if(!empty($cliente) && $cliente !==null){
            // siempre ve ver in espacio en where
            $sql .= "AND dato_cliente LIKE '$cliente%'";
        }
        $prepare=$util->Consulta($sql);
        return $prepare;
    }
    public function insertcliente($cliente,$telefono,$email,$direccion){
        $util=new Util();
        $sql="INSERT INTO clientes(dato_cliente,telefono,email,Direccion,estado) VALUES ('$cliente','$telefono','$email','$direccion','activo')";
        $consulta=$util->Consulta($sql);
        return $consulta;
    }
    public function getcliente($id){
        $util=new Util();
        $sql="SELECT id_cliente,dato_cliente,telefono,email,Direccion FROM clientes WHERE id_cliente={$id}";
        $query=$util->Consulta($sql);
        return $query;
    }
    public function updatecliente($id,$cliente,$telefono,$email,$direccion){
        $util=new Util();
        $sql="UPDATE clientes SET dato_cliente='$cliente',telefono='$telefono',email='$email',Direccion='$direccion' WHERE id_cliente='$id'";
        $query=$util->Consulta($sql);
        return $query;
    }
    public function deleteCiente($id){
        $util=new Util();
        $sql="UPDATE clientes SET estado='inactivo' WHERE id_cliente={$id}";
        $query=$util->Consulta($sql);
        return $query;
    }
}

?>