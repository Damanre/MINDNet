<?php
session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>PERFIL</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.4.min.js"></script>
        <script src="validaciones.js" type="text/javascript"></script>
    </head>
    <body>
        <header id="hdcorto">
            <a href="index.php"><img id="logo" src="../style/img/logo/logob.png"></a>
            <a id="logout" href="logout.php">CERRAR SESION</a>
        </header>
        <main id="main1col">
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
                        if (!isset($_POST["edit"])){
                            $sql = "select * from usuario WHERE idusuario='".$_SESSION["idusuario"]."'";
                            $resultado=$ObjBBDD->ejecutarConsulta($sql);
                            if($_SESSION["tipo"]=="b"){
                                $sql = "select * from alumno WHERE idusuario='".$_SESSION["idusuario"]."'";
                            }else{
                                $sql = "select * from profesor WHERE idusuario='".$_SESSION["idusuario"]."'";
                            }

                            $resultado2=$ObjBBDD->ejecutarConsulta($sql);
                            if ($ObjBBDD->filasObtenidas($resultado) > 0) {
                                $fila = $ObjBBDD->extraerFila($resultado);
                                $fila2 = $ObjBBDD->extraerFila($resultado2);
                                echo '
                                <h2>DATOS PERFIL</h2>
                                <form action="#" method="post">
                                        <label for="rnombre">Nombre</label><br>
                                        <input class="textbox" type="text" id="rnombre" name="rnombre" value="'.$fila2["nombre"].'" ><br>
                                        <label for="rapellidos">Apellidos</label><br>
                                        <input class="textbox" type="text" id="rapellidos" name="rapellidos"value="'.$fila2["apellidos"].'" ><br>
                                        <label>Sexo</label><br>
                                        ';
                                if($fila2["sexo"]==0){
                                    echo'
                                        <label for="mas">Masculino</label>
                                        <input type="radio" id="mas" class="rsexo" value="0" name="rsexo" checked >
                                        <label for="fem">Femenino</label>
                                        <input type="radio" id="fem" class="rsexo" value="1" name="rsexo" ><br><br>
                                    ';
                                }else{
                                    echo '
                                        <label for="mas">Masculino</label>
                                        <input type="radio" id="mas" class="rsexo" value="0" name="rsexo">
                                        <label for="fem">Femenino</label>
                                        <input type="radio" id="fem" class="rsexo" value="1" name="rsexo" checked><br><br>
                                    ';
                                }
                                echo '
                                        <label for="rdni">NIF / NIE</label><br>
                                        <input class="textbox" type="text" id="rdni" name="rdni" value="'.$fila2["dni"].'"><br>
                                        <label for="rfnac">Fecha de nacimiento</label><br>
                                        <input class="textbox" type="date" id="rfnac" name="rfnac" value="'.$fila2["f_nac"].'" disabled><br>
                                        <label for="rusuario">Nombre usuario</label><br>
                                        <input class="textbox" type="text" id="rusuario" name="rusuario" value="'.$fila["usuario"].'" ><br>
                                        <label for="remail">Email</label><br>
                                        <input class="textbox" type="email" id="remail" name="remail" value="'.$fila["email"].'"><br>
                                        <button class="confirm" id="edit">EDITAR</button><br>
                                        <input type="submit" class="confirm" name="edit" value="GUARDAR" >
                                    </form>
                                    
                            ';

                            echo "<br><a href='homealumno.php' class='hdbtn'>VOLVER</a>";

                            }
                        }else{
                            if(empty($_POST["rnombre"]) || empty($_POST["rapellidos"]) || !isset($_POST["rsexo"]) || empty($_POST["rdni"]) || empty($_POST["rusuario"]) || empty($_POST["remail"])){
                                echo '<span class="error">NO PUEDES DEJAR EN BLANCO NINGUN CAMPO</span><br>';//si no existe la maquina
                                echo "<br><a href='gesperfil.php'class='back'>VOLVER</a>";
                            }else{
                                $sql = 'UPDATE usuario SET usuario="' . $_POST['rusuario'] . '" ,email="' . $_POST['remail'] . '" WHERE idusuario="'.$_SESSION["idusuario"].'";';//consulta agregar admin
                                $ObjBBDD->ejecutarConsulta($sql);//ejecutar consulta
                                if($ObjBBDD->comprobarError()){//comprobar error
                                    echo $ObjBBDD->comprobarError();
                                    echo "<br><a href='homealumno.php'class='back'>VOLVER</a>";
                                }else{
                                   header("Location:gesperfil.php");//redireccion
                                }
                            }
                        }
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
