<?php
session_start();
include_once 'Class_OperacionesBBDD.php';
include_once 'Class_OperacionesEXT.php';
//Conexion BBDD
$ObjBBDD=new OperacionesBBDD();
$ObjBBDD->conectar();
$sql = "select participante from reunion WHERE idreunion=".$_COOKIE["room"];
$resultado=$ObjBBDD->ejecutarConsulta($sql);
if ($ObjBBDD->filasObtenidas($resultado) > 0) {
    $fila = $ObjBBDD->extraerFila($resultado);
    if($fila["participante"]==NULL){
        echo '<img id="imgld" src="../style/img/logo/loading.gif">';
    }
}
