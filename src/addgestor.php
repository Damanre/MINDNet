<?php
session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>AÑADIR GESTOR</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.4.min.js"></script>
        <script src="validaciones.js" type="text/javascript"></script>
    </head>
    <body>
        <header id="hdcorto"><!--Header corto-->
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
                        if ($_SESSION["tipo"] == "a") {//Proteccion de acceso por url
                            if (!isset($_POST["add"])){
                                echo '<!--formulario de añadir gestor-->
                                    <h2>AÑADIR GESTOR</h2>
                                    <form action="#" method="post">
                                        <label for="user">USUARIO GESTOR</label>
                                        <input type="text" name="user" placeholder="Usuario" class="textbox"/></br></br>
                                        <label for="mail">EMAIL GESOR</label>
                                        <input type="email" name="mail" placeholder="Email" class="textbox"/></br></br>
                                        <label for="pass">CONTRASEÑA</label>
                                        <input type="password" name="pass" placeholder="Contraseña" class="textbox"/></br></br>
                                        <label for="pass2">REPETIR CONTRASEÑA</label>
                                        <input type="password" name="pass2" placeholder="Repetir Contraseña" class="textbox"/></br>
                                        <input type="submit" class="add" name="add" value="AÑADIR" />
                                    </form>
                                ';
                            }else{
                                if(empty($_POST["user"]) || empty($_POST["mail"]) || empty($_POST["pass"]) || empty($_POST["pass2"])){//Comprobar campos vacios
                                    echo '<span class="error">NO PUEDES DEJAR EN BLANCO NINGUN CAMPO</span><br>';
                                    echo "<br><a href='addgestor.php'class='back'>VOLVER</a>";
                                }else{
                                    if($_POST['pass'] != $_POST['pass2']){//comprobar que coinciden las contraseñas
                                        echo '<span class="error">NO COINCIDEN LAS CONTRASEÑAS</span><br>';
                                        echo "<br><a href='addgestor.php'class='back'>VOLVER</a>";
                                    }else{
                                        $sql = 'INSERT INTO usuario (usuario,email,pass,f_alta,tipo) VALUES ("' . $_POST['user'] . '", "' . $_POST['mail'] . '", "' . encriptar($_POST['pass']) . '", NOW(),"g");';//consulta agregar gestor
                                        $ObjBBDD->ejecutarConsulta($sql);
                                        if($ObjBBDD->comprobarError()){
                                            echo $ObjBBDD->comprobarError();
                                            echo "<br><a href='addgestor.php'class='back'>VOLVER</a>";
                                        }else{
                                            header("Location:gesgestores.php");//redireccion
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
            <br><a href='gesgestores.php'class='hdbtn'>VOLVER</a>
        </main>
        <footer>
            <p>Copyright © 2021 - MINDNet [<a href="alp.html">Aviso Legal y Política de Privacidad</a>]</p>
        </footer>
    </body>
</html>
