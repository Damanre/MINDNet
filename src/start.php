<?php
session_start();

        include_once 'class_operacionesbbdd.php';
        include_once 'class_operacionesext.php';
        //Conexion BBDD
        $ObjBBDD=new OperacionesBBDD();
        $ObjBBDD->conectar();
        //Comprobar conexion BBDD
        if ($ObjBBDD->comprobarConexion()) {
            echo '<h1><span class="error"">El servicio no esta disponible en este momento: ' . $ObjBBDD->comprobarConexion().'</span></h1>';//Mostrar Error
            echo "<br><a href='https://23.2daw.esvirgua.com/MINDNet/src/index.php'class='confirm'>VOLVER</a>";
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
                        header("Location:instart.php?r=".$room."#".$fila2["seed"]);
                    }else{
                        $sql = 'INSERT INTO reunion (inicio,anfitrion,temario,seed) VALUES (NOW(), "' . $_SESSION["idusuario"] . '", "' . $_POST["materia"] . '", "' . $_COOKIE["hash"] . '");';//consulta agregar admin
                        $ObjBBDD->ejecutarConsulta($sql);//ejecutar consulta
                        $room=$ObjBBDD->getId();
                        setcookie("room",$room);
                        echo '
                        <html lang="es">
                            <head>
                                <meta charset="UTF-8"/>
                                <title>REUNION</title>
                                <link href="../style/style.css" rel="stylesheet" type="text/css">
                                <script type="text/javascript" src="https://cdn.scaledrone.com/scaledrone.min.js"></script>
                                <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.4.min.js"></script>
                                <script type="text/javascript" src="https://23.2daw.esvirgua.com/MINDNet/src/chat.js"></script>
                                <script type="text/javascript" src="https://23.2daw.esvirgua.com/MINDNet/src/cam.js"></script>
                            </head>
                            <body>
                                <header id="hdcorto">
                                    <a href="https://23.2daw.esvirgua.com/MINDNet/src/index.php"><img id="logo" src="../style/img/logo/logob.png"></a>
                                    <a id="logout" href="https://23.2daw.esvirgua.com/MINDNet/src/logout.php">CERRAR SESION</a>
                                </header>
                        
                        ';

                        echo '<h1>ROOM '.$room.'</h1>';
                        echo'
                        <main id="load">
                            <div id="main2">
                                <div id="yourcam">
                                <video autoplay id="remoteVideo">
                                
                                </video>
                                <div id="mycam">
                                    <video autoplay muted id="localVideo">
                                
                                    </video>
                                </div>
                            </div>
                            <div id="chatbx">
                                <div id="chat">
                                
                                </div>
                                <div id="envio">
                                    <form id="ftext" method="post" action="https://23.2daw.esvirgua.com/MINDNet/src/send.php?r='.$room.'" target="_blank">
                                        <input type="text" placeholder="Escribe un mensaje..." onclick="limpio()" name="texto" id="txbox"><input type="submit" id="send" value="ENVIAR">
                                    </form>
                                </div>
                            </div>
                                                  
                        </main>
                        <br><a href="https://23.2daw.esvirgua.com/MINDNet/src/close.php?r='.$room.'" class="back">ABANDONAR</a>  
                        ';
                        echo'
                    <footer>
                        <p>Copyright © 2021 - MINDNet [<a href="https://23.2daw.esvirgua.com/MINDNet/src/alp.html">Aviso Legal y Política de Privacidad</a>]</p>
                    </footer>
                </body>
                <script>
                    function limpio(){
                        document.getElementById("txbox").value=null;
                    }
                </script>
            </html>
            ';
                    }


                } else {
                    echo '<span class="error">NO PUEDES ACCEDER A ESTE SITIO</span>
                        <br><a class="back" href="https://23.2daw.esvirgua.com/MINDNet/src/login.php">VOLVER</a>
                    ';
                }
            } else {
                echo '<span class="error">NO PUEDES ACCEDER A ESTE SITIO</span>
                    <br><a class="back" href="https://23.2daw.esvirgua.com/MINDNet/src/login.php">VOLVER</a>
                ';
            }

        }

        ?>


