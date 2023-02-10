<?php
    session_start();
    include "comprobarDatos2.php";
    $hayPreferencias = true;
    $array = null;
    if (haySession()==false) {
        if (hayGet()==false) {
            $hayPreferencias = false;
        } else {
            $array = $_GET;
        }
    } else {
        $array = $_SESSION;
    }
    if ($hayPreferencias == false) {
        header("loacation: practica2_index.php");
    } else {
        foreach ($array as $indice=>$valor) {
            $$indice = $valor;
        }
        $_SESSION["nombre"] = $nombre;
        $_SESSION["apellidos"] = $apellidos;
        $_SESSION["color_fondo"] = $color_fondo;
        $_SESSION["color_letra"] = $color_letra;
        $_SESSION["tipo_letra"] = $tipo_letra;
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
            header("location: practica2_index.php");
        }

        ?>
        <a href="borrar2.php">Volver a cambiar las preferencias</a>
    </body>
</html>