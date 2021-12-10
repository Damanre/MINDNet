<?php

    function encriptar($pass){//devuelve el hash de la cadena
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    function comprobarHash($pass,$hash){//comprueba una cadena con un hash
        return password_verify($pass, $hash);
    }
?>
