<?php
class MetodoEmpleado
{
    public function lista_empleado($empleado)
    {
        $conexion = new conectar();
        $cnx = $conexion->conexion();
        $sql = "SELECT id_empleado,nombre_empleado,apellido_empleado,telefono,puesto,salario,fech_contrato FROM empleado WHERE estado <> 'inactivo'";
        if (!empty($empleado) && $empleado !== NULL) {
            $sql .= " AND nombre_empleado LIKE '$empleado%'";
        }
       
        $query = $cnx->query($sql);
        return $query;
    }

    public function insertEmpleado($nombre, $apellido, $telefono, $puesto, $salario, $fecha)
    {
        $conexion = new conectar();
        $cnx = $conexion->conexion();
        $sql = "INSERT INTO empleado(nombre_empleado,apellido_empleado,telefono,puesto,salario,fech_contrato,estado) VALUE ('$nombre', '$apellido', '$telefono', '$puesto', '$salario', '$fecha','activo')";
        $query = $cnx->query($sql);
        return $query;
    }

    public function updateEmpleado($id, $nombre, $apellido, $telefono, $puesto, $salario, $fecha)
    {
        $conexion = new conectar();
        $cnx = $conexion->conexion();
        $sql = "UPDATE empleado SET nombre_empleado='$nombre', apellido_empleado='$apellido', telefono='$telefono', puesto='$puesto', salario='$salario', fech_contrato='$fecha' WHERE id_empleado ='$id'";
        $query = $cnx->query($sql);
        return $query;
    }

    public function getEmpleado($id)
    {
        $conexion = new conectar();
        $cnx = $conexion->conexion();
        $sql = "SELECT id_empleado,nombre_empleado,apellido_empleado,telefono,puesto,salario,fech_contrato FROM empleado WHERE id_empleado='$id'";

        $query = $cnx->query($sql);
        return $query;
    }

    public function  deleteEmpleado($id){
        $conexion = new conectar();
        $cnx = $conexion->conexion();
        $sql = "UPDATE empleado SET estado ='inactivo' WHERE id_empleado='$id'";
        $query = $cnx->query($sql);
        return $query;
    }
}
