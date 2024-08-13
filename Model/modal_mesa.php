<?php 
class MetodoMesa{
    public function lista_mesa(){
        $util=new Util();
        $sql="SELECT TM.id_mesa, TM.capacidad, TES.estado, TM.numero FROM mesa AS TM
              INNER JOIN estado AS TES ON TES.id=TM.estado 
              WHERE TM.estado <> 4";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function insertMesa($capacidad, $estado, $numero){
        $util=new Util();
        $sql="INSERT INTO mesa (capacidad, estado, numero) VALUE('$capacidad', '$estado', '$numero');";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function updateMesa($id_mesa, $capacidad, $numero){
        $util=new Util();
        $sql="UPDATE mesa SET capacidad='$capacidad', numero='$numero' WHERE id_mesa='$id_mesa';";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function getMesa($id_mesa){
        $util=new Util();
        $sql="SELECT id_mesa, capacidad, estado, numero FROM mesa WHERE id_mesa='$id_mesa';";
        $query = $util->Consulta($sql);
        return $query;
    }

    public function deleteMesa($id_mesa){
        $util=new Util();
        $sql="DELETE FROM mesa WHERE id_mesa='$id_mesa';";
        $query = $util->Consulta($sql);
        return $query;
    }
}
?>