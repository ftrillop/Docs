<html>
<body>
    <form action="Formulario6.php">
        <p>Escriba el numero de columnas <input type="number" name="columna"></p>
        <p>Escriba el numero de filas <input type="number" name="fila"></p>
        <p><input type="submit" value="Enviar"></p>
    </form>
    
    <?php

    if ((isset($_GET["columna"])) && (isset($_GET["fila"]))) {

        $columna = $_GET["columna"];
        $fila = $_GET["fila"];

        if ((is_numeric($columna) && $columna>=1) && (is_numeric($fila) && $fila>=1)) {

            echo "<table border=1>";

            for ($i=1; $i<=$fila; $i++) {

                echo "<tr>";

                for ($j=1; $j<=$columna; $j++) {

                    echo "<td>";
                    echo "ASDF";
                    echo "</td>";

                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No se admiten esos valores</p>";
        }
    }

    ?>
</body>
</html>