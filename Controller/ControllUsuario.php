<?php
require_once '../Config/cnmysql.php';
require_once '../Model/modal_usuario.php';
require_once '../util/util.php';
$MetodoUsuario=new MetodoUsuario();
$util=new Util();

$ope=isset($_GET['ope'])?$_GET['ope']:'';
switch ($ope) {
    case 'validar':
        $usuario =isset($_POST['usuario'])?$_POST['usuario']:'';
        $contrasenia=isset($_POST['password'])?$_POST['password']:'';
        $usuario=$util->seguridad($usuario);
        $contrasenia=$util->hash_pass($contrasenia);
        $validar=$MetodoUsuario->LogueUsuario($usuario,$contrasenia);
        echo $validar;
        break;
    
    default:
        # code...
        break;
}
?>