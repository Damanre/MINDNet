<?php
session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>GESTION MATERIAS</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.4.min.js"></script>
        <script src="validaciones.js" type="text/javascript"></script>
    </head>
    <body>
        <header id="hdcorto">
            <a href="index.php"><img id="logo" src="../style/img/logo/logob.png"></a>
            <a id="logout" href="logout.php">CERRAR SESION</a>
        </header>

            <?php
            include_once 'class_operacionesbbdd.php';
            include_once 'class_operacionesext.php';
            //Conexion BBDD
            $ObjBBDD=new OperacionesBBDD();
            $ObjBBDD->conectar();
            //Comprobar conexion BBDD
            if ($ObjBBDD->comprobarConexion()) {
                echo '<h1><span class="error"">El servicio no esta disponible en este momento: ' . $ObjBBDD->comprobarConexion().'</span></h1>';//Mostrar Error
                echo "<br><a href='index.php'class='confirm'>VOLVER</a>";
            }else{
                if (isset($_SESSION["idusuario"])) {
                    if ($_SESSION["tipo"] == "a" || $_SESSION["tipo"] == "g") {
                        echo "<h1>Hola " . $_SESSION["usuario"] . "</h1><!--mostrar nombre de usuario-->";
                        echo "<br><a href='addmateria.php' class='new'>NUEVO</a>";
                        echo "<main id='main2col'>";
                        echo '<div>';
                        $sql = "select * from asignatura"; //obtener asignaturas
                        $resultado=$ObjBBDD->ejecutarConsulta($sql);
                        echo '<h2>ASIGNATURAS</h2>';
                        if ($ObjBBDD->filasObtenidas($resultado) > 0) {
                            echo '<table>';
                            echo '<tr>';
                            echo '<th>Asignatura</th>';
                            while ($fila = $ObjBBDD->extraerFila($resultado)) {
                                echo '<tr><td>' . $fila["nombre"] . '</td><td class="lasttd"><a href="delasi.php?f=1&id='.$fila["idasignatura"].'"><img class="del" src="../style/img/logo/del.png"></a></td></tr>';
                            }
                            echo '</tr>';
                            echo '</table>';
                        } else {
                            echo '<h3>No hay Asignaturas</h3>';
                        }
                        echo '</div>';
                        echo '<div>';
                        $sql = "select * from temario";//Obtener temarios
                        $resultado=$ObjBBDD->ejecutarConsulta($sql);
                        echo '<h2>TEMARIOS</h2>';
                        if ($ObjBBDD->filasObtenidas($resultado) > 0) {
                            echo '<table>';
                            echo '<tr>';
                            echo '<th>Nombre</th><th>Asignatura</th>';
                            while ($fila = $ObjBBDD->extraerFila($resultado)) {
                                $sql = "select * from asignatura WHERE idasignatura=".$fila["asignatura"];
                                $resultado2=$ObjBBDD->ejecutarConsulta($sql);
                                $fila2 = $ObjBBDD->extraerFila($resultado2);
                                echo '<tr><td>' . $fila["nombre"] . '</td><td>' . $fila2["nombre"] . '</td><td class="lasttd"><a href="delasi.php?f=2&id='.$fila["idtemario"].'"><img class="del" src="../style/img/logo/del.png"></a></td></tr>';
                            }
                            echo '</tr>';
                            echo '</table>';
                        } else {
                            echo '<h3>No hay Temarios</h3>';
                        }
                        echo '</div>';
                        echo '</main>';
                    } else {
                        echo '<span class="error">NO PUEDES ACCEDER A ESTE SITIO</span>
                            <br><a class="back" href="login.php">VOLVER</a>
                        ';
                    }
                } else {
                    echo '<span class="error">NO PUEDES ACCEDER A ESTE SITIO</span>
                        <br><a class="back" href="login.php">VOLVER</a>
                    ';
                }
            }
            if ($_SESSION["tipo"]=="a"){
                echo "<br><a href='homeadmin.php'class='hdbtn'>VOLVER</a>";
            }else{
                echo "<br><a href='homegestor.php'class='hdbtn'>VOLVER</a>";
            }
            ?>

        <footer>
            <p>Copyright ?? 2021 - MINDNet [<a href="alp.html">Aviso Legal y Pol??tica de Privacidad</a>]</p>
        </footer>
    </body>
</html>