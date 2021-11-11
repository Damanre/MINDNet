<?php
session_start();
?>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <title>ADMINISTRADOR</title>
    <link href="../style/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<header id="hdcorto">
    <a href="index.html"><img id="logo" src="../style/img/logo/logob.png"></a>
    <a id="logout" href="logout.php">CERRAR SESION</a>
</header>
<main id="main1col">
    <?php
    if (isset($_SESSION["idusuario"])) {
        if ($_SESSION["tipo"] == "b") {
            echo "<h1>Hola " . $_SESSION["usuario"] . "</h1><!--mostrar nombre de usuario-->
                        <!--Enlaces-->
                        <div id='leftnav'>
                            <!--listado de asignaturas-->
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
</body>
</html>
