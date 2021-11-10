<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>INSTALACION</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
            require_once "Class_OperacionesBBDD.php";
            require_once "Class_OperacionesEXT.php";
            $ObjBBDD=new OperacionesBBDD();
            $ObjBBDD->conectarInstalador();//Conexion BBDD
            if ($ObjBBDD->comprobarConexion()) {//Comprobar conexion BBDD
                echo '<span class="error">Error de conexión: ' . $ObjBBDD->comprobarConexion().'</span>';//Mostrar Error
                echo "<br><a href='install.php'class='back'>VOLVER</a>";
            }else {
                if (!isset($_POST["Instalar"])) {//formulario agregar admin
                    echo '
                        <h1>INSTALADOR MINDNet</h1><br><br>
                        <form action="#" method="post">
                            <label for="user">USUARIO ADMINISTRADOR</label>
                            <input type="text" name="user" placeholder="Usuario" /></br></br>
                            <label for="mail">EMAIL ADMINISTRADOR</label>
                            <input type="email" name="mail" placeholder="Email" /></br></br>
                            <label for="pass">CONTRASEÑA</label>
                            <input type="password" name="pass" placeholder="Contraseña" /></br></br>
                            <label for="pass2">REPETIR CONTRASEÑA</label>
                            <input type="password" name="pass2" placeholder="Repetir Contraseña" /></br></br>
                            <input type="submit" class="opc" name="Instalar" value="INSTALAR" />
                        </form>
                        ';
                } else {
                    if(empty($_POST["user"]) || empty($_POST["mail"]) || empty($_POST["pass"]) || empty($_POST["pass2"])){
                        echo '<span class="error">NO PUEDES DEJAR EN BLANCO NINGUN CAMPO</span><br>';//si no existe la maquina
                        echo "<br><a href='install.php'class='back'>VOLVER</a>";
                    }else{
                        if($_POST['pass'] != $_POST['pass2']){//comprobar que coinciden las contraseñas
                            echo '<span class="error">NO COINCIDEN LAS CONTRASEÑAS</span><br>';//si no existe la maquina
                            echo "<br><a href='install.php'class='back'>VOLVER</a>";
                        }
                        else{
                            $sql = file_get_contents("../sql/mindnet.sql");//consulta script bbdd
                            $ObjBBDD->ejecutarMultiConsulta($sql);//ejecutar consulta
                            if($ObjBBDD->comprobarError()) {//comprobar error
                                echo $ObjBBDD->comprobarError();
                                echo "<br><a href='install.php'class='back'>VOLVER</a>";
                            }else{
                                $ObjBBDD->cerrarConexion();//cierre conexion
                                sleep(2);//espera para que el servidor ejecute la consulta anterior a tiempo
                                $ObjBBDD->conectar();//conexion BBDD
                                $sql = 'INSERT INTO usuario (usuario,email,pass,f_alta) VALUES ("' . $_POST['user'] . '", "' . $_POST['mail'] . '", "' . encriptar($_POST['pass']) . '", NOW());';//consulta agregar admin
                                $ObjBBDD->ejecutarConsulta($sql);//ejecutar consulta
                                if($ObjBBDD->comprobarError()){//comprobar error
                                    echo $ObjBBDD->comprobarError();
                                    echo "<br><a href='install.php'class='back'>VOLVER</a>";
                                }else{
                                    header("Location:install.php");//redireccion
                                }
                                $ObjBBDD->cerrarConexion();//cerrar conexion
                            }
                        }
                    }
                }
            }
        ?>
    </body>
</html>

