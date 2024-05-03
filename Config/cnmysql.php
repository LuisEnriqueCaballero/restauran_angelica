<?php
include_once "config.php";
class conectar{
    private $servidor='localhost';
    private $usuario='root';
    private $pass='';
    private $namebd='db_restauran';
    public function conexion(){
        $conexion=new mysqli($this->servidor,$this->usuario,$this->pass,$this->namebd);

        if($conexion->connect_errno){
            die("ERROR DE CONEXION :".$conexion->connect_errno);
        }else{
            return $conexion;
        }
        
    }
}
?>