<?php
class MetodoFinanciero{
    public function lista_egreso($fech_inic,$fech_final){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql = "SELECT TE.id, TD.descripcion, TE.monto, TE.fecha_registrado,TE.mes,TE.anio FROM egreso AS TE
                INNER JOIN descripcion AS TD ON TD.id=TE.descripcion";
        if (!empty($fech_inic) && !empty($fech_final)) {
            $fech_inic_formatted = date('Y-m-d', strtotime(str_replace('/', '-', $fech_inic)));
            $fech_final_formatted = date('Y-m-d', strtotime(str_replace('/', '-', $fech_final)));
            $sql .= " WHERE fecha_registrado BETWEEN '{$fech_inic_formatted}' AND '{$fech_final_formatted}'";
        }
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function lista_ingreso($fech_inic,$fech_final){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT TI.id,TD.descripcion, TI.monto, TI.fecha,TI.mes,TI.anio FROM ingreso AS TI
        INNER JOIN descripcion AS TD ON TD.id=TI.descripcion";
        if (!empty($fech_inic) && !empty($fech_final)) {
            $fech_inic_formatted = date('Y-m-d', strtotime(str_replace('/', '-', $fech_inic)));
            $fech_final_formatted = date('Y-m-d', strtotime(str_replace('/', '-', $fech_final)));
            $sql .= " WHERE TI.fecha BETWEEN '{$fech_inic_formatted}' AND '{$fech_final_formatted}'";
        }
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function lista_kardex_financiero($fech_inic,$fech_final){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT TFI.id, TDE.descripcion, TFI.monto_egreso,TFI.monto_ingreso, TFI.saldo, TFI.fecha,TFI.mes,TFI.anio FROM kardex_financiero AS TFI
             INNER JOIN descripcion AS TDE ON TFI.concepto=TDE.id";
        if (!empty($fech_inic) && !empty($fech_final)) {
            $fech_inic_formatted = date('Y-m-d', strtotime(str_replace('/', '-', $fech_inic)));
            $fech_final_formatted = date('Y-m-d', strtotime(str_replace('/', '-', $fech_final)));
            $sql .= " WHERE TFI.fecha BETWEEN '{$fech_inic_formatted}' AND '{$fech_final_formatted}'";
        }
        $sql .=" ORDER BY TFI.fecha ASC";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function insertIngreso($descripcion, $monto, $fecha,$mes,$anio,$id_caja){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO ingreso(descripcion, monto, fecha,mes,anio,idcaja) VALUE('$descripcion', '$monto', '$fecha','$mes','$anio','$id_caja');";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function insertEgreso($descripcion, $monto, $fecha,$mes,$anio,$id_caja){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO egreso(descripcion, monto, fecha_registrado,mes,anio,idcaja) VALUE('$descripcion', '$monto', '$fecha','$mes','$anio','$id_caja');";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function insertKardexfinanciero($concepto, $monto_egreso,$monto_ingreso, $saldo, $fecha,$mes,$anio,$id_caja){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO kardex_financiero (concepto, monto_egreso,monto_ingreso, saldo, fecha,mes,anio,idcaja) VALUE('$concepto', '$monto_egreso','$monto_ingreso', '$saldo', '$fecha','$mes','$anio','$id_caja');";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>