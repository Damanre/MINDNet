<?php

    session_start();
    include_once 'class_operacionesbbdd.php';
    include_once 'class_operacionesext.php';
    //Conexion BBDD
    $ObjBBDD = new OperacionesBBDD();
    $ObjBBDD->conectar();

    if(isset($_SESSION["idusuario"])){
        $sql = 'UPDATE reunion SET activa=0, fin=NOW() WHERE idreunion="'.$_GET["r"].'";';//consulta agregar admin
        $ObjBBDD->ejecutarConsulta($sql);
        header("location:homealumno.php");
    }


?>
