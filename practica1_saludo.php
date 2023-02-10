<?php
    include "comprobarDatos.php";
    $hayPreferencias = true;
    $array = null;
    if (haycookies()==false) {
        if (hayGet()==false) {
            $hayPreferencias = false;
        } else {
            $array = $_GET;
        }
    } else {
        $array = $_COOKIE;
    }
    if ($hayPreferencias == false) {
        header("loacation: practica1_index.php");
    } else {
        foreach ($array as $indice=>$valor) {
            $$indice = $valor;
        }
        setcookie('nombre', $nombre, time()+3600*24*30);
        setcookie('apellidos', $apellidos, time()+3600*24*30);
        setcookie('color_fondo', $color_fondo, time()+3600*24*30);
        setcookie('color_letra', $color_letra, time()+3600*24*30);
        setcookie('tipo_letra', $tipo_letra, time()+3600*24*30);
    }
?>
<html>
    <head>
        <title>Saludo</title>
        <style>
            body {
                color: <?php echo "$color_letra"; ?>;
                background-color: <?php echo "$color_fondo"; ?>;
                font-family: <?php echo "$tipo_letra"; ?>;
                font-size: larger;
            }
            a {
                background-color: white;
                font-size: medium;
                font-family: Arial, Helvetica, sans-serif;
            }
        </style>
    </head>
    <body>

        <?php

        if ($hayPreferencias == true) {
            echo "<p>";
            echo "Hola $nombre $apellidos";
            echo "</p>";
        } else {
            header("location: practica1_index.php");
        }

        ?>
        <a href="borrar.php">Volver a cambiar las preferencias</a>
    </body>
</html>