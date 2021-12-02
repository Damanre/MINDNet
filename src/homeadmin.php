<?php
    session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>ADMINISTRADOR</title>
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
                if (isset($_SESSION["idusuario"])) {
                    if ($_SESSION["tipo"] == "a") {
                        echo "<h1>Hola " . $_SESSION["usuario"] . "</h1><!--mostrar nombre de usuario-->
                            <!--Enlaces-->
                            <div id='leftnav'>
                                <a class='opc' href='gesalumnos.php'>ALUMNOS</a>
                                <a class='opc' href='gesprofesores.php'>PROFESORES</a>
                                <a class='opc' href='gesgestores.php'>GESTORES</a>
                                <a class='opc' href='gesreuniones.php'>REUNIONES</a>
                                <a class='opc' href='gessolicitudes.php'>SOLICITUDES</a>
                                <a class='opc' href='gesmaterias.php'>MATERIAS</a>
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