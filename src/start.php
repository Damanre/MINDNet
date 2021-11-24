<?php
session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>REUNION</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="cam.js"></script>
        <script type="text/javascript" src="chat.js"></script>
    </head>
    <body>
        <header id="hdcorto">
            <a href="index.php"><img id="logo" src="../style/img/logo/logob.png"></a>
            <a id="logout" href="logout.php">CERRAR SESION</a>
        </header>
        <?php
        include_once 'Class_OperacionesBBDD.php';
        include_once 'Class_OperacionesEXT.php';
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
                    $sql = 'SELECT * FROM temario WHERE idtemario='.$_POST["materia"];//consulta agregar admin
                    $resultado=$ObjBBDD->ejecutarConsulta($sql);
                    $fila = $ObjBBDD->extraerFila($resultado);
                    $sql2 = 'SELECT * FROM reunion WHERE activa=1 AND participante IS NULL AND temario='.$_POST["materia"];//consulta agregar admin
                    $resultado2=$ObjBBDD->ejecutarConsulta($sql2);
                    $fila2 = $ObjBBDD->extraerFila($resultado2);
                    if($ObjBBDD->filasObtenidas($resultado2) > 0){
                        $room=$fila2["idreunion"];
                        $sql = 'UPDATE reunion SET participante="' . $_SESSION["idusuario"] . '"WHERE idreunion="'.$fila2["idreunion"].'";';//consulta agregar admin
                        $ObjBBDD->ejecutarConsulta($sql);
                    }else{
                        $sql = 'INSERT INTO reunion (inicio,anfitrion,temario) VALUES (NOW(), "' . $_SESSION["idusuario"] . '", "' . $_POST["materia"] . '");';//consulta agregar admin
                        $ObjBBDD->ejecutarConsulta($sql);//ejecutar consulta
                        $room=$ObjBBDD->getId();
                    }
                    echo '<h1>ROOM '.$room.'</h1>';
                    echo "SELECCIONADO ".$fila["nombre"];
                    echo'
                    <main>
                        <div  id="main2">
                            <div id="yourcam">
                            <video autoplay id="vid">
                            
                            </video>
                            <div id="mycam">
                                <video autoplay muted id="yourvid">
                            
                                </video>
                            </div>
                        </div>
                        <div id="chat">
                            
                        </div>
                        </div>
                        <br><a href="close.php?r='.$room.'" class="back">ABANDONAR</a>                        
                    </main>
                    ';

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
