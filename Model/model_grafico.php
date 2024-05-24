<?php
class MetodoGraficos{
    public function Grafica_kardex_financiero($anio){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT Sum(monto_egreso) AS EGRESO, SUM(monto_ingreso) AS INGRESO,SUM(monto_ingreso - monto_egreso) AS total,mes FROM `kardex_financiero` ";
        if(isset($anio)){
            $sql .= " WHERE anio='$anio'";
            };
        $sql .=" GROUP BY mes";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
    public function Grafica_fecha_kardex($fecha_inicio,$fecha_fin){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT sum(monto_egreso) AS EGRESO,sum(monto_ingreso) AS INGRESO,fecha FROM `kardex_financiero`  ";
        if(isset($fecha_inicio) AND isset($fecha_fin)){
            $sql .= " WHERE fecha BETWEEN  '$fecha_inicio' AND '$fecha_fin'";
            };
        $sql .=" GROUP BY fecha";
        $query=mysqli_query($cnx,$sql);
        
        return $query;
    }

    public function Menu_Mas_Pedido(){
        $conexion=new conectar();
        $cnx=$conexion->conexion();
        $sql="SELECT TPA.descripcion,SUM(td.cantidad) AS CANTIDAD FROM detalle_pedido AS TD INNER JOIN menu AS TPA ON TD.id_producto=TPA.id_menu GROUP BY id_producto ORDER BY `CANTIDAD` DESC LIMIT 10";
        $query=mysqli_query($cnx,$sql);
        return $query;
    }
}
?>