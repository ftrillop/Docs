<html>
    <head>
        <title>Dibujar arrays</title>
    </head>
    <body>
        <?php
        $provincias = array(
            "Palencia" => 8000,
            "Valladolid" => 306000,
            "Murcia" => 439000,
            "Albacete" => 170000,
            "Barcelona" => 160000,
            "A Coruña" => 25000
        );
        $simbolos = array(
            "Au" => "Oro",
            "Ag" => "Plata",
            "Hg" => "Mercurio",
            "H" => "Hidrogeno"
        );

        function dibujar($array) {
            echo "<table border=1>";
            echo "<tr>";
            echo "<td bgcolor=Black>";
            echo "<font color='White'>Indices</font>";
            echo "</td>";
            echo "<td bgcolor=Black>";
            echo "<font color='white'>Valores</font>";
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            foreach ($array as $indice => $valor) {
                echo "<td bgcolor=Grey>$indice</td>";
                echo "<td>$valor</td>";
                echo "</tr>";
            }
            echo "</tr>";
            echo "</table>";
        }

        dibujar($provincias);
        echo "<br><br>";
        dibujar($simbolos);
        ?>
    </body>
</html>