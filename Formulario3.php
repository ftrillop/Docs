<html>
    <head>
        <meta charset="utf-8">
        <title>Formulario</title>
    </head>
    <body>

        <?php
        
        if (isset($_GET["numero"])) {
            $numero = $_GET["numero"];
            if (is_numeric($numero)) {
                $resto = $numero - (int)$numero;
                if ($resto==0) {
                    echo "<h1>El numero es entero</h1>";
                    echo "<a href=Formulario3.html>Volver</a>";
                } else {
                    echo "<h1>El numero no es entero</h1>";
                    echo "<a href=Formulario3.html>Volver</a>";
                }
            } else {
                echo "<h1>No se introdujo un numero</h1>";
                echo "<a href=Formulario3.html>Volver</a>";
            }
        }
        ?>

    </body>
</html>