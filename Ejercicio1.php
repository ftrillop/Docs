<html>
    <head>
        <title>Formulario con arrays</title>
    </head>
    <body>
        
        <?php

        $suma = 0;

        if (isset($_POST["array"])) {
            $array = $_POST["array"];
            if(is_array($array)) {
                echo "<ul>";
                $suma = 0;
                foreach ($array as $indice => $valor) {
                    echo "<li>$indice cuesta $valor centimos";
                    $suma += $valor;
                }
            }
        } else {
            echo "No se ha seleccionado ningun articulo";
        }

        echo "<br>";
        echo "El precio total a pagar es de $suma centimos";
        ?>

    </body>
</html>