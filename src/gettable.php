<?php
include_once 'Class_OperacionesBBDD.php';
include_once 'Class_OperacionesEXT.php';
//Conexion BBDD
$ObjBBDD=new OperacionesBBDD();
$ObjBBDD->conectar();
$sql = "select * from reunion";
$resultado=$ObjBBDD->ejecutarConsulta($sql);
echo '<h2>Reuniones</h2>';
if ($ObjBBDD->filasObtenidas($resultado) > 0) {
    echo '<table id="tabla">';
    echo '<tr>';
    echo '<th>ID</th><th>Usuario 1</th><th>Usuario 2</th><th>Asignatura</th><th>Temario</th><th>Duracion</th>';
    while ($fila = $ObjBBDD->extraerFila($resultado)) {
        $sql2 = "select * from usuario WHERE idusuario=" . $fila['anfitrion'];
        $resultado2=$ObjBBDD->ejecutarConsulta($sql2);
        $fila2 = $ObjBBDD->extraerFila($resultado2);
        $sql3 = "select * from usuario WHERE idusuario=" . $fila['participante'];
        $resultado3=$ObjBBDD->ejecutarConsulta($sql3);
        $fila3 = $ObjBBDD->extraerFila($resultado3);
        $sql5 = "select * from temario WHERE idtemario=" . $fila['temario'];
        $resultado5=$ObjBBDD->ejecutarConsulta($sql5);
        $fila5 = $ObjBBDD->extraerFila($resultado5);
        $sql4 = "select * from asignatura WHERE idasignatura=" . $fila5['asignatura'];
        $resultado4=$ObjBBDD->ejecutarConsulta($sql4);
        $fila4 = $ObjBBDD->extraerFila($resultado4);
        $date1 = new DateTime(date("Y-m-d h:i:s"));
        $date2 = new DateTime($fila["fecha"]);
        $diff = $date1->diff($date2);
        echo '<tr><td>' . $fila["idreunion"] . '</td><td>' . $fila2["usuario"] . '</td><td>' . $fila3["usuario"] . '</td><td>' . $fila4["nombre"] . '</td><td>' . $fila5["nombre"] . '</td><td>' .$diff->h.' h '.$diff->i.' Min '.$diff->s. ' Sec </td></tr>';
    }
    echo '</tr>';
    echo '</table>';
} else {
    echo '<h3>No hay Reuniones</h3>';
}

?>