<?php
session_start();

require_once "class_operacionesbbdd.php";
if ($_SESSION["tipo"]=="a" || $_SESSION["tipo"]=="g") {
    $ObjBBDD=new OperacionesBBDD();
    $ObjBBDD->conectar();
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $f=$_GET["f"];
        if($f==1){
            $sql = 'DELETE FROM asignatura WHERE idasignatura="'.$id.'";';//consulta borrar asignatura
            $ObjBBDD->ejecutarConsulta( $sql);//ejecutar consulta
            if ($error = $ObjBBDD->comprobarError()) {//comprobar error
                echo $error;
                echo "<br><a href='index.php' class='back'>VOLVER</a>";
            } else {
                header("LOCATION:gesmaterias.php");
            }
        }else{
            $sql = 'DELETE FROM temario WHERE idtemario="'.$id.'";';//consulta borrar temario
            $ObjBBDD->ejecutarConsulta( $sql);//ejecutar consulta
            if ($error = $ObjBBDD->comprobarError()) {//comprobar error
                echo $error;
                echo "<br><a href='index.php' class='back'>VOLVER</a>";
            } else {
                header("LOCATION:gesmaterias.php");
            }
        }
    }else{
        echo '<h1>NO PUEDES ACCEDER A ESTE SITIO1</h1>
                <br><a href="index.php"class="back">VOLVER</a>
            ';
    }

}else{
    echo '<h1>NO PUEDES ACCEDER A ESTE SITIO2</h1>
                <br><a href="index.php"class="back">VOLVER</a>
            ';
}
?>