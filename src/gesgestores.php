<?php
session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>GESTION GESTORES</title>
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
            echo '<h1><span class="error"">El servicio no esta disponible en este momento: ' . $ObjBBDD->comprobarConexion().'</span></h1>';//Mostrar Error
            echo "<br><a href='index.php'class='confirm'>VOLVER</a>";
        }else{
            if (isset($_SESSION["idusuario"])) {
                if ($_SESSION["tipo"] == "a") {
                    echo "<h1>Hola " . $_SESSION["usuario"] . "</h1><!--mostrar nombre de usuario-->";
                    $sql = "select * from usuario WHERE tipo='g'";
                    $resultado=$ObjBBDD->ejecutarConsulta($sql);
                    echo '<div class="listabox">';
                    echo '<h2>Gestores</h2>';
                    echo "<br><a href='addgestor.php'class='new'>NUEVO</a>";
                    if ($ObjBBDD->filasObtenidas($resultado) > 0) {
                        echo '<table>';
                        echo '<tr>';
                        echo '<th>ID</th><th>Email</th><th>Usuario</th><th>Fecha Alta</th>';
                        while ($fila = $ObjBBDD->extraerFila($resultado)) {
                            echo '<tr><td>' . $fila["idusuario"] . '</td><td>' . $fila["email"] . '</td><td>' . $fila["usuario"] . '</td><td>' . $fila["f_alta"] . '</td><td class="lasttd"><a href="delusr.php?w=g&id='.$fila["idusuario"].'"><img class="del" src="../style/img/logo/del.png"></a></td></tr>';
                        }
                        echo '</tr>';
                        echo '</table>';
                    } else {
                        echo '<h3>No hay Gestores</h3>';
                    }
                    echo '</div>';
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
        if ($_SESSION["tipo"]=="a"){
            echo "<br><a href='homeadmin.php'class='hdbtn'>VOLVER</a>";
        }else{
            echo "<br><a href='homegestor.php'class='hdbtn'>VOLVER</a>";
        }
        ?>
    </main>
    <footer>
        <p>Copyright © 2021 - MINDNet [<a href="alp.html">Aviso Legal y Política de Privacidad</a>]</p>
    </footer>
    </body>
</html>