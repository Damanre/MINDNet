<?php
    session_start();
include_once 'class_operacionesbbdd.php';
include_once 'class_operacionesext.php';
//Conexion BBDD
$ObjBBDD=new OperacionesBBDD();
$ObjBBDD->conectar();
$sql = "select * from mensaje WHERE reunion=".$_COOKIE['room']." ORDER BY fecha asc";
$resultado=$ObjBBDD->ejecutarConsulta($sql);
if ($ObjBBDD->filasObtenidas($resultado) > 0) {
    echo '<table>';
    while ($fila = $ObjBBDD->extraerFila($resultado)) {
        $sql2 = "select usuario from usuario WHERE idusuario=" . $fila['usuario'];
        $resultado2=$ObjBBDD->ejecutarConsulta($sql2);
        $fila2 = $ObjBBDD->extraerFila($resultado2);

        if($fila["usuario"]==$_SESSION["idusuario"]){

            echo '<tr><td class="mymsg"><b>' . $fila2["usuario"] . '</b><br>' . $fila["texto"] . '</td></tr>';

        }else{

            echo '<tr><td class="youmsg"><b>' . $fila2["usuario"] . '</b><br>' . $fila["texto"] . '</td></tr>';

        }

    }
    echo '</table>';
} else {
    echo '<h3>Comienza a chatear</h3>';
}
$sqlh = 'UPDATE reunion SET seed="' . $_COOKIE["hash"] . '"WHERE idreunion="'.$_COOKIE["room"].'";';//consulta agregar admin
$ObjBBDD->ejecutarConsulta($sqlh);

?>