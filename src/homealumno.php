<?php
session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>ALUMNO</title>
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
                if (isset($_SESSION["idusuario"])) {
                    if ($_SESSION["tipo"] == "b") {
                        echo "<h1>Hola " . $_SESSION["usuario"] . "</h1><!--mostrar nombre de usuario-->
                            <!--Enlaces-->
                            <div id='leftnav'>
                                <a id='opc1' href='gesperfil.php'>PERFIL</a>
                                <a class='opc' href='gesreuniones.php'>REUNIONES</a>
                            </div>
                        ";
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
            ?>
        </main>
        <footer>
            <p>Copyright © 2021 - MINDNet [<a href="alp.html">Aviso Legal y Política de Privacidad</a>]</p>
        </footer>
    </body>
</html>
