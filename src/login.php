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
    }else {
        if (!isset($_POST["login"]) && !isset($_POST["register"])) {
            echo '
                <html lang="es">
                    <head>
                        <meta charset="UTF-8"/>
                        <title>LOGIN</title>
                        <link href="../style/style.css" rel="stylesheet" type="text/css">
                        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
                        <script src="validaciones.js" type="text/javascript"></script>
                    </head>
                    <body>
                        <header id="hdcorto">
                            <a href="index.php"><img id="logo" alt="Logo web" src="../style/img/logo/logob.png"></a>
                        </header>
                <main id="main2col">
                    <div>
                        <h2>INICIAR SESION</h2>
                        <form action="?bt=0" method="post">
                            <label for="lemail">Email</label><br>
                            <input class="textbox" type="email" id="lemail" name="lemail"><br>
                            <label for="lpass">Contraseña</label><br>
                            <input class="textbox" type="password" id="lpass" name="lpass"><br>
                            <input type="submit" class="confirm" name="login" value="INICIAR SESION">
                        </form>
                    </div>
                    <div>
                        <h2>REGISTRARSE</h2>
                        <form action="?bt=1" method="post">
                            <label for="rnombre">Nombre</label><br>
                            <input class="textbox" type="text" id="rnombre" name="rnombre"><br>
                            <label for="rapellidos">Apellidos</label><br>
                            <input class="textbox" type="text" id="rapellidos" name="rapellidos"><br>
                            <label>Sexo</label><br>
                            <label for="mas">Masculino</label>
                            <input type="radio" id="mas" class="rsexo" value="0" name="rsexo">
                            <label for="fem">Femenino</label>
                            <input type="radio" id="fem" class="rsexo" value="1" name="rsexo"><br><br>
                            <label for="rdni">NIF / NIE</label><br>
                            <input class="textbox" type="text" id="rdni" name="rdni"><br>
                            <label for="rfnac">Fecha de nacimiento</label><br>
                            <input class="textbox" type="date" id="rfnac" name="rfnac"><br>
                            <label for="rusuario">Nombre usuario</label><br>
                            <input class="textbox" type="text" id="rusuario" name="rusuario"><br>
                            <label for="remail">Email</label><br>
                            <input class="textbox" type="email" id="remail" name="remail"><br>
                            <label for="rpass">Contraseña</label><br>
                            <input class="textbox" type="password" id="rpass" name="rpass"><br>
                            <label for="rpass2">Repita la contraseña</label><br>
                            <input class="textbox" type="password" id="rpass2" name="rpass2"><br>
                            <input type="submit" class="confirm" name="register" value="REGISTRARSE">
                        </form>
                    </div>
                </main>
            ';
        } else {
            if($_GET["bt"]==0){
                if(empty($_POST["lemail"]) || empty($_POST["lpass"])){
                    echo '
                        <html lang="es">
                    <head>
                        <meta charset="UTF-8"/>
                        <title>LOGIN</title>
                        <link href="../style/style.css" rel="stylesheet" type="text/css">
                        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
                        <script src="validaciones.js" type="text/javascript"></script>
                    </head>
                    <body>
                        <header id="hdcorto">
                            <a href="index.php"><img id="logo" alt="Logo web" src="../style/img/logo/logob.png"></a>
                        </header>
                        <span class="error">NO PUEDES DEJAR EN BLANCO NINGUN CAMPO</span><br>';//si no existe la maquina
                    echo "<br><a href='login.php'class='back'>VOLVER</a>";
                }else{
                    session_start();
                    $sql = "SELECT * FROM usuario WHERE email = '" . $_POST["lemail"] . "' ;";//consulta comprobar si existe administrador
                    $resultado=$ObjBBDD->ejecutarConsulta($sql);//ejecuta consulta
                    if($ObjBBDD->filasObtenidas($resultado) != 0) {//comprueba error
                        $fila = $ObjBBDD->extraerFila($resultado);//extrae filas consulta
                        if(comprobarHash($_POST['lpass'],$fila['pass'])){
                            //inicia sesion y assigna variables sesion
                            $_SESSION["idusuario"] = $fila["idusuario"];
                            $_SESSION["usuario"] = $fila["usuario"];
                            $_SESSION["tipo"] = $fila["tipo"];
                            if($_SESSION["tipo"]=="a"){
                                header('Location:homeadmin.php');//redirecion
                            }else{
                                if($_SESSION["tipo"]=="b"){
                                    header("Location:homealumno.php");//redirecion
                                }else{
                                    if($_SESSION["tipo"]=="p"){
                                        header("Location:homealumno.php");//redirecion
                                    }else{
                                        if($_SESSION["tipo"]=="g"){
                                            header("Location:homegestor.php");//redirecion
                                        }
                                    }
                                }
                            }
                        }
                    }
                    echo '
                          <html lang="es">
                    <head>
                        <meta charset="UTF-8"/>
                        <title>LOGIN</title>
                        <link href="../style/style.css" rel="stylesheet" type="text/css">
                        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
                        <script src="validaciones.js" type="text/javascript"></script>
                    </head>
                    <body>
                        <header id="hdcorto">
                            <a href="index.php"><img id="logo" alt="Logo web" src="../style/img/logo/logob.png"></a>
                        </header>
                            <span class="error">USUARIO O CONTRASEÑA<br>INCORRECTOS</span><br>';//contraseña o usuario incorrecto
                    echo "<br><a href='login.php'class='back'>VOLVER</a>";
                }
            }else{
                if(empty($_POST["rnombre"]) || empty($_POST["rapellidos"]) || !isset($_POST["rsexo"]) || empty($_POST["rdni"]) || empty($_POST["rfnac"]) || empty($_POST["rusuario"]) || empty($_POST["remail"]) ||empty($_POST["rpass"]) ||empty($_POST["rpass2"])){
                    echo '
                        <html lang="es">
                    <head>
                        <meta charset="UTF-8"/>
                        <title>LOGIN</title>
                        <link href="../style/style.css" rel="stylesheet" type="text/css">
                        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
                        <script src="validaciones.js" type="text/javascript"></script>
                    </head>
                    <body>
                        <header id="hdcorto">
                            <a href="index.php"><img id="logo" alt="Logo web" src="../style/img/logo/logob.png"></a>
                        </header>
                        <span class="error">NO PUEDES DEJAR EN BLANCO NINGUN CAMPO</span><br>';//si no existe la maquina
                    echo "<br><a href='login.php'class='back'>VOLVER</a>";
                }else{
                    if($_POST['rpass'] != $_POST['rpass2']){//comprobar que coinciden las contraseñas
                        echo '
                        <html lang="es">
                    <head>
                        <meta charset="UTF-8"/>
                        <title>LOGIN</title>
                        <link href="../style/style.css" rel="stylesheet" type="text/css">
                        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
                        <script src="validaciones.js" type="text/javascript"></script>
                    </head>
                    <body>
                        <header id="hdcorto">
                            <a href="index.php"><img id="logo" alt="Logo web" src="../style/img/logo/logob.png"></a>
                        </header>
                        <span class="error">NO COINCIDEN LAS CONTRASEÑAS</span><br>';//si no existe la maquina
                        echo "<br><a href='login.php'class='back'>VOLVER</a>";
                    }else{
                        $sql = 'INSERT INTO usuario (usuario,email,pass,f_alta) VALUES ("' . $_POST['rusuario'] . '", "' . $_POST['remail'] . '", "' . encriptar($_POST['rpass']) . '", NOW());';//consulta agregar user
                        $ObjBBDD->ejecutarConsulta($sql);//ejecutar consulta
                        if($ObjBBDD->comprobarError()){//comprobar error
                            echo $ObjBBDD->comprobarError();
                            echo "<br><a href='login.php'class='back'>VOLVER</a>";
                        }else{
                            $sql = 'INSERT INTO alumno (idusuario,nombre,apellidos,f_nac,sexo,dni) VALUES (LAST_INSERT_ID(), "' . $_POST['rnombre'] . '", "' . $_POST['rapellidos'] . '", "' . $_POST['rfnac'] . '", ' . $_POST['rsexo'] . ', "' . $_POST['rdni'] . '");';//consulta agregar alumno
                            $ObjBBDD->ejecutarConsulta($sql);//ejecutar consulta
                            if($ObjBBDD->comprobarError()){//comprobar error
                                echo $ObjBBDD->comprobarError();
                                echo $sql;
                                echo "<br><a href='login.php'class='back'>VOLVER</a>";
                            }else {
                                header("Location:index.php");//redireccion
                            }
                        }
                    }
                }
            }
        }
        echo '
            <footer>
                <p>Copyright © 2021 - MINDNet [<a href="alp.html">Aviso Legal y Política de Privacidad</a>]</p>
            </footer>
        </body>
    </html>';
    }
?>

