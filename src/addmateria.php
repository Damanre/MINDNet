<?php
session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>AÑADIR MATERIA</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
        <script src="validaciones.js" type="text/javascript"></script>
    </head>
    <body>
        <header id="hdcorto">
            <a href="index.php"><img id="logo" src="../style/img/logo/logob.png"></a>
            <a id="logout" href="logout.php">CERRAR SESION</a>
        </header>
        <main id="main1col">
            <?php
                include_once 'Class_OperacionesBBDD.php';
                include_once 'Class_OperacionesEXT.php';
                //Conexion BBDD
                $ObjBBDD=new OperacionesBBDD();
                $ObjBBDD->conectar();
                //Comprobar conexion BBDD
                if ($ObjBBDD->comprobarConexion()) {
                    echo '<h1><span class="error">El servicio no esta disponible en este momento: ' . $ObjBBDD->comprobarConexion().'</span></h1>';//Mostrar Error
                    echo "<br><a href='index.php'class='confirm'>VOLVER</a>";
                }else{
                    if (isset($_SESSION["idusuario"])) {
                        if ($_SESSION["tipo"] == "a" || $_SESSION["tipo"] == "g") {
                            if (!isset($_POST["add"])){
                                echo '
                                    <h2>AÑADIR MATERIA</h2>
                                    <form action="#" method="post">
                                        <label for="user">NOMBRE</label>
                                        <input type="text" name="nombre" placeholder="Nombre" class="textbox"/></br></br>
                                        <label for="asg">ASIGNATURA (OPC)</label>
                                        <select name="asg" class="textbox">
                                            <option></option>';
                                $sql3='SELECT * FROM asignatura';
                                $resultado3=$ObjBBDD->ejecutarConsulta($sql3);
                                while ($fila3 = $ObjBBDD->extraerFila($resultado3)) {
                                    echo'<option value="'.$fila3["idasignatura"].'">'.$fila3["nombre"].'</option>';
                                }
                                echo'
                                        </select></br></br>
                                        <input type="submit" class="add" name="add" value="AÑADIR" />
                                    </form>
                                ';
                            }else{
                                if(empty($_POST["nombre"])){
                                    echo '<span class="error">NO PUEDES DEJAR EN BLANCO EL NOMBRE</span><br>';//si no existe la maquina
                                    echo "<br><a href='addmateria.php'class='back'>VOLVER</a>";
                                }else{
                                    if($_POST["asg"]==""){
                                        $sql = 'INSERT INTO asignatura (nombre) VALUES ("' . $_POST['nombre'] . '");';//consulta agregar admin
                                        $ObjBBDD->ejecutarConsulta($sql);//ejecutar consulta
                                        if($ObjBBDD->comprobarError()){//comprobar error
                                            echo $ObjBBDD->comprobarError();
                                            echo "<br><a href='addmateria.php'class='back'>VOLVER</a>";
                                        }else{
                                            header("Location:gesmaterias.php");//redireccion
                                        }
                                    }else{
                                        $sql2='SELECT * FROM asignatura WHERE idasignatura="'.$_POST["asg"].'"';
                                        $resultado2=$ObjBBDD->ejecutarConsulta($sql2);
                                        $fila2 = $ObjBBDD->extraerFila($resultado2);
                                        $sql = 'INSERT INTO temario (nombre,asignatura) VALUES ("' . $_POST['nombre'] . '","' . $fila2['idasignatura'] . '");';//consulta agregar admin
                                        $ObjBBDD->ejecutarConsulta($sql);//ejecutar consulta
                                        if($ObjBBDD->comprobarError()){//comprobar error
                                            echo $ObjBBDD->comprobarError();
                                            echo "<br><a href='addmateria.php'class='back'>VOLVER</a>";
                                        }else{
                                            header("Location:gesmaterias.php");//redireccion
                                        }
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
            <br><a href='gesmaterias.php'class='hdbtn'>VOLVER</a>
        </main>
        <footer>
            <p>Copyright © 2021 - MINDNet [<a href="alp.html">Aviso Legal y Política de Privacidad</a>]</p>
        </footer>
    </body>
</html>
