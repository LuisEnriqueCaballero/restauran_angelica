<?php
session_start();
require_once '../Config/cnmysql.php';
require_once '../Model/modal_usuario.php';
require_once '../Config/util.php';
$MetodoUsuario=new MetodoUsuario();
$util=new Util();
$ope=isset($_GET['ope'])?$_GET['ope']:'';
switch ($ope) {
    case 'validar':
        $usuario=isset($_POST['user'])?strtoupper($_POST['user']):'';
        $usuario=$util->seguridad($usuario);
        $_SESSION['usuario']=$usuario;
        $contrasenia=isset($_POST['contra'])?$_POST['contra']:'';
        $contrasenia=$util->hash_pass($contrasenia);
        $validar=$MetodoUsuario->LogueUsuario($_SESSION['usuario'],$contrasenia);
        echo $validar;
        break;
    default:
        # code...
        break;
}
?>