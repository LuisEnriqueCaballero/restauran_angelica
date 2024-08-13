<?php 
class Metodocaja{
    public function lista_multicajas(){
        $util=new Util();
        $sql="SELECT TMC.id_caja_apert,TC.descripcion,TMC.monto_inicial,TMC.fecha_apertura,TMC.mes,TMC.anio,TES.estado FROM multicajas AS TMC 
              INNER JOIN caja AS TC ON TC.id_caja=TMC.id_caja AND TC.estado<>'5'
              INNER JOIN estado AS TES ON TMC.estado=TES.id 
              WHERE TMC.estado <>'7'";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function lista_multicajascierre(){
        $util=new Util();
        $sql="SELECT TMC.id_caja_apert,TC.descripcion,TMC.monto_inicial,TMC.fecha_cierre,TMC.mes,TMC.anio FROM multicajas AS TMC
              INNER JOIN caja AS TC ON TC.id_caja=TMC.id_caja
              INNER JOIN estado as TES ON TMC.estado=TES.id
              WHERE TMC.estado <> '8'";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function insertmulticaja($id_caja,$monto_inicial,$estado,$fecha_apertura,$mes,$anio){
        $util=new Util();
        $sql="INSERT INTO multicajas(id_caja,monto_inicial,estado,fecha_apertura,mes,anio) VALUE ('$id_caja','$monto_inicial','$estado','$fecha_apertura','$mes','$anio')";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function getmulticaja($id){
        $util=new Util();
        $sql="SELECT TMC.id_caja_apert,TMC.id_caja,TC.descripcion FROM multicajas AS TMC
              INNER JOIN caja AS TC ON TC.id_caja=TMC.id_caja AND TC.estado<>'5'
              WHERE TMC.estado <> 'cerrado' AND TMC.id_caja_apert='$id';";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function updatemulticaja($id,$id_caja){
        $util=new Util();
        $sql="UPDATE multicajas SET id_caja='$id_caja' WHERE id_caja_apert ='$id'";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function cierrecaja($id,$fecha){
        $util=new Util();
        $sql="UPDATE multicajas SET estado='7',fecha_cierre='$fecha' WHERE id_caja_apert='$id'";
        $query=$util->Consulta($sql);
        return $query;
    }
    public function aumentadinero($id,$monto){
        $util=new Util();
        $sql="UPDATE multicajas SET monto_inicial='$monto' WHERE id_caja_apert='$id'";
        $query=$util->Consulta($sql);
        return $query;
    }
    public function  montoactual($id){
        $util=new Util();
        $sql="SELECT id_caja_apert,monto_inicial FROM multicajas WHERE id_caja_apert='$id'";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function ultimocaja(){
        $util=new Util();
        $sql="SELECT id_caja_apert,monto_inicial FROM multicajas ORDER BY id_caja_apert DESC  LIMIT 1";
        $query=$util->Consulta($sql);
        return $query;
    }
    
     public function updatemontocaja($id,$monto){
        $util=new Util();
        $sql="UPDATE multicajas SET monto_inicial='$monto' WHERE id_caja_apert='$id'";
        $query=$util->Consulta($sql);
        return $query;
    }

   
    /*CREACION DE CAJAS CRUD*/

    public function listacajas(){
        $util=new Util();
        $sql="SELECT TCA.id_caja,TCA.descripcion,TES.estado,TCA.fecha,TCA.mes,TCA.anio FROM caja AS TCA
              INNER JOIN estado AS TES ON TCA.estado=TES.id
              WHERE TCA.estado<>'5'";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function INSERTACAJA($descripcion,$estado,$fecha,$mes,$anio){
        $util=new Util();
        $sql="INSERT INTO caja(descripcion,estado,fecha,mes,anio) VALUES ('$descripcion','$estado','$fecha','$mes','$anio')";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function UPDATECAJAS($id,$descripcion){
        $util=new Util();
        $sql="UPDATE caja SET descripcion='$descripcion' WHERE id_caja='$id'";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function OBTENERCAJA($id){
        $util=new Util();
        $sql="SELECT id_caja,descripcion FROM caja WHERE id_caja={$id}";
        $query=$util->Consulta($sql);
        return $query;
    }

    public function DESACTIVARCAJA($id){
        $util=new Util();
        $sql="UPDATE caja SET estado='5' WHERE id_caja={$id}";
        $query=$util->Consulta($sql);
        return $query;
    }
}
?>