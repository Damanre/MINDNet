<?php
    session_start();
    require_once "class_operacionesbbdd.php";
    if ($_SESSION["tipo"]=="b" || $_SESSION["tipo"]=="p") {
        $ObjBBDD=new OperacionesBBDD();
        $ObjBBDD->conectar();
        header("LOCATION:homealumno.php");
    }

?>
