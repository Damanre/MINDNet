<?php
session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>ALUMNO</title>
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
                    if ($_SESSION["tipo"] == "b" || $_SESSION["tipo"] == "p") {
                        $sql = "select * from asignatura";
                        $resultado=$ObjBBDD->ejecutarConsulta($sql);
                        echo "<h1>Hola " . $_SESSION["usuario"] . "</h1><!--mostrar nombre de usuario-->
                            <main id='main2'>
                            <!--Enlaces-->
                            <div class='ldiv'>
                                <a class='lnavopc' href='gesperfil.php'>PERFIL</a>
                                <a class='lnavopc' href='gesreuniones.php'>REUNIONES</a>
                            </div>
                            <div class='rdiv'>"
                        ;
                        if ($ObjBBDD->filasObtenidas($resultado) > 0) {
                            echo "
                                <form action='start.php' method='post'>
                                    <ul class='scroll'>";
                                 while ($fila = $ObjBBDD->extraerFila($resultado)) {
                                     $sql2 = "select * from temario WHERE asignatura=".$fila["idasignatura"];
                                     $resultado2=$ObjBBDD->ejecutarConsulta($sql2);
                                     echo '<li class="opcasg">' . $fila["nombre"] . '</li><ul>';
                                     while ($fila2 = $ObjBBDD->extraerFila($resultado2)) {
                                         echo '<li class="opcasg"><input type="radio" class="opc" name="materia" value="' .$fila2["idtemario"].'">' . $fila2["nombre"] . '</li>';
                                     }
                                     echo "</ul>";
                                 }
                                echo "</ul>
                                <input type='submit' class='startbt' value='COMENZAR'></form>
                                ";
                        }else{
                            echo "<h2>NO SE PUEDEN MOSTRAR LAS MATERIAS</h2>";
                        }
                        echo "</div>";
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

            ?>

        </main>
        <footer>
            <p>Copyright © 2021 - MINDNet [<a href="alp.html">Aviso Legal y Política de Privacidad</a>]</p>
        </footer>
    </body>
</html>
