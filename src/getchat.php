<?php
    session_start();
include_once 'Class_OperacionesBBDD.php';
include_once 'Class_OperacionesEXT.php';
//Conexion BBDD
$ObjBBDD=new OperacionesBBDD();
$ObjBBDD->conectar();
$sql = "select * from mensaje WHERE reunion=28 ORDER BY fecha asc;";
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

            echo '<tr><td class="youmsg">' . $fila2["usuario"] . '<br>' . $fila["texto"] . '</td></tr>';

        }

    }
    echo '</table>';
} else {
    echo '<h3>Comienza a chatear</h3>';
}

?>