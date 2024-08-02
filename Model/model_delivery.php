<?php 
class MetodoDelivery{
    public function lista_delivery(){
        $util=new Util();
        $sql="SELECT idDelivery, distancia,precio FROM delivery";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function insertDelivery($distancia,$precio){
        $util=new Util();
        $sql="INSERT INTO delivery (distancia,precio) VALUE('$distancia','$precio');";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function updateDelivery($idDelivery, $distancia,$precio){
        $util=new Util();
        $sql="UPDATE delivery SET distancia='$distancia', precio='$precio' WHERE idDelivery='$idDelivery';";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function getDelivery($idDelivery){
        $util=new Util();
        $sql="SELECT idDelivery, distancia,precio FROM delivery WHERE idDelivery='$idDelivery';";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function deleteMesa($idDelivery){
        $util=new Util();
        $sql="DELETE FROM delivery WHERE idDelivery='$idDelivery';";
        $query = $util->Consulta($sql);
        return $query;
    }
}
?>