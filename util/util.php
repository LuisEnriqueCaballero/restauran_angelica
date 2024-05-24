<?php
class Util{
    public function seguridad($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    public function hash_pass($pass){
        $pass=md5($pass);
        return $pass;
    }
}
?>