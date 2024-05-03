<?php
class MetodoFinanciero{
    public function lista_egreso(){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT id,descripcion, monto, fecha_registrado FROM egreso;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function lista_ingreso(){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT id,descripcion, monto, fecha FROM ingreso;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function lista_kardex_financiero(){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT id, concepto, monto_egreso,monto_ingreso, saldo, fecha FROM kardex_financiero;";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function insertIngreso($descripcion, $monto, $fecha){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO ingreso(descripcion, monto, fecha) VALUE('$descripcion', '$monto', '$fecha');";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function insertEgreso($descripcion, $monto, $fecha){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO egreso(descripcion, monto, fecha_registrado) VALUE('$descripcion', '$monto', '$fecha');";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }

    public function insertKardexfinanciero($concepto, $monto_egreso,$monto_ingreso, $saldo, $fecha){
        $conexion = new conectar();
        $cnx=$conexion->conexion();
        $sql="INSERT INTO kardex_financiero (concepto, monto_egreso,monto_ingreso, saldo, fecha) VALUE('$concepto', '$monto_egreso','$monto_ingreso', '$saldo', '$fecha');";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>