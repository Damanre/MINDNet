<?php
    session_start();
    include_once 'Class_OperacionesBBDD.php';
    include_once 'Class_OperacionesEXT.php';
    //Conexion BBDD
    $ObjBBDD=new OperacionesBBDD();
    $ObjBBDD->conectar();
    if($_SESSION["tipo"]=="b" || $_SESSION["tipo"]=="p"){
        $sql = 'INSERT INTO mensaje (reunion,texto,usuario) VALUES ("' . $_GET['r'] . '", "' . $_POST['texto'] . '", "' . $_SESSION["idusuario"] . '");';//consulta agregar admin
        $ObjBBDD->ejecutarConsulta($sql);
    }
    echo  "<script type='text/javascript'>";

    echo "window.close();";
    echo "</script>";
?>