<html>
<head>
    <title>Formulario</title>
</head>
<body>

    <form action="EjFormulario.php" method="get">

        <?php
        $nombre = $_REQUEST["nombre"];
        $apellidos = $_REQUEST["apellidos"];
        $edad = $_REQUEST["edad"];
        $salario = $_REQUEST["salario"];    
        ?>
        <?php

        if ($_REQUEST["nombre"] == "") {
            print "<p>No ha escrito ningún nombre</p>";
        }
        if ($_REQUEST["apellidos"] == "") {
            print "<p>No ha introducido ningún apellido</p>";
        }
        if ($_REQUEST["edad"] == "") {
            print "<p>No ha introducido ninguna edad</p>";
        }
        if ($_REQUEST["salario"] == "") {
            print "<p>No ha introducido ningún salario</p>";
        }
        ?>
        <?php

        $salario = $_REQUEST["salario"];
        $edad = $_REQUEST["edad"];

        if ($salario > 2000) {
            $salario = $salario;
        }
        if ($salario > 1000 && $salario < 2000) {
            if ($edad > 45) {
                $salario = $salario * 1.03;
            }
            if ($edad <= 45) {
                $salario = $salario * 1.1;
            }
        }
        if ($salario < 1000) {
            if ($edad < 30) {
                $salario = 1100;
            }
            if ($edad > 30 && $edad < 45) {
                $salario = $salario * 1.03;
            }
            if ($edad > 45) {
                $salario = $salario * 1.15;
            }
        }
        ?>

        <?php
        print "<p>$_REQUEST[nombre] $_REQUEST[apellidos] tu salario será de $salario</p>\n";
        ?>
</body>
</html>