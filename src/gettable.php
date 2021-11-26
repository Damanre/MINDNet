<?php
    session_start();
include_once 'class_operacionesbbdd.php';
include_once 'class_operacionesext.php';
//Conexion BBDD
$ObjBBDD=new OperacionesBBDD();
$ObjBBDD->conectar();
if($_SESSION["tipo"]=="b" || $_SESSION["tipo"]=="p"){
    $sql = "select * from reunion WHERE activa=0 AND (anfitrion=".$_SESSION["idusuario"]." OR participante=".$_SESSION["idusuario"].") ORDER BY activa DESC;";
}else{
    $sql = "SELECT * FROM reunion ORDER BY activa DESC;";
}
$resultado=$ObjBBDD->ejecutarConsulta($sql);
echo '<h2>Reuniones</h2>';
if ($ObjBBDD->filasObtenidas($resultado) > 0) {
    echo '<table>';
    echo '<tr>';
    echo '<th>ID</th><th>Usuario 1</th><th>Usuario 2</th><th>Asignatura</th><th>Temario</th><th>Duracion</th>';
    while ($fila = $ObjBBDD->extraerFila($resultado)) {
        $sql2 = "select usuario from usuario WHERE idusuario=" . $fila['anfitrion'];
        $resultado2=$ObjBBDD->ejecutarConsulta($sql2);
        $fila2 = $ObjBBDD->extraerFila($resultado2);
        if(is_null($fila["participante"])){
            $fila3["usuario"]="Buscando...";
        }else{
            $sql3 = "select usuario from usuario WHERE idusuario=" . $fila['participante'];
            $resultado3=$ObjBBDD->ejecutarConsulta($sql3);
            $fila3 = $ObjBBDD->extraerFila($resultado3);
        }
        $sql5 = "select * from temario WHERE idtemario=" . $fila['temario'];
        $resultado5=$ObjBBDD->ejecutarConsulta($sql5);
        $fila5 = $ObjBBDD->extraerFila($resultado5);
        $sql4 = "select nombre from asignatura WHERE idasignatura=" . $fila5['asignatura'];
        $resultado4=$ObjBBDD->ejecutarConsulta($sql4);
        $fila4 = $ObjBBDD->extraerFila($resultado4);

        if($fila["activa"]==1){
            $date1 = new DateTime(date("Y-m-d G:i:s"));
            $date2 = new DateTime($fila["inicio"]);
            $diff = $date2->diff($date1);

            echo '<tr class="act"><td>' . $fila["idreunion"] . '</td><td>' . $fila2["usuario"] . '</td><td>' . $fila3["usuario"] . '</td><td>' . $fila4["nombre"] . '</td><td>' . $fila5["nombre"] . '</td><td>' .$diff->d.' d ' .$diff->h. ' h '.$diff->i.' Min '.$diff->s. ' Sec </td></tr>';

        }else{
            $date1 = new DateTime($fila["inicio"]);
            $date2 = new DateTime($fila["fin"]);
            $diff = $date1->diff($date2);

            echo '<tr><td>' . $fila["idreunion"] . '</td><td>' . $fila2["usuario"] . '</td><td>' . $fila3["usuario"] . '</td><td>' . $fila4["nombre"] . '</td><td>' . $fila5["nombre"] . '</td><td>' .$diff->d.' d ' .$diff->h.' h '.$diff->i.' Min '.$diff->s. ' Sec </td></tr>';

            $date1=0;
            $date2=0;
        }

    }
    echo '</tr>';
    echo '</table>';
} else {
    echo '<h3>No hay Reuniones</h3>';
}

?>