<?php
session_start();

require_once "Class_OperacionesBBDD.php";
if ($_SESSION["tipo"]=="a" || $_SESSION["tipo"]=="g") {
    $ObjBBDD=new OperacionesBBDD();
    $ObjBBDD->conectar();
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $sql = 'DELETE FROM usuario WHERE idusuario="'.$id.'";';//consulta borrar lugar
        $ObjBBDD->ejecutarConsulta( $sql);//ejecutar consulta
        if ($error = $ObjBBDD->comprobarError()) {//comprobar error
            echo $error;
            echo "<br><a href='gesalumnos.php'class='back'>VOLVER</a>";
        } else {
            header("LOCATION:gesalumnos.php");
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