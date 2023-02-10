<html>
    <head>
        <title>Provincias</title>
    </head>
    <body>
        <?php

        if (!isset($_GET["comunidad"])) {
            header("location: practica1-comunidades.php");
        } else {
            $comunidad = $_GET["comunidad"];

            $conexion = new mysqli("127.0.0.1", "root", "", "geografia");
            if ($conexion) {
                $consulta = $conexion->query("SELECT p.nombre FROM provincias AS p JOIN comunidades AS c ON (c.id_comunidad=p.id_comunidad) WHERE c.nombre='$comunidad' ORDER BY p.nombre");
                if ($consulta) {
                    ?>
                    <form action="practica1-localidades.php">
                        <label for="provincia">Elija la provincia deseada</label>
                        <select name="provincia" id="provincia">
                            <?php
                            $fila = $consulta->fetch_assoc();
                            while ($fila) {
                                echo "<option value='{$fila["nombre"]}'>"."{$fila["nombre"]}</option>";
                                $fila = $consulta->fetch_assoc();
                            }
                            ?>
                        </select>
                        <button>Buscar localidades</button>
                    </form>
                    <?php
                } else {
                    echo "<p class='error'>No se pudo obtener la lista de provincias</p>";
                }
        }
        }
        ?>
    </body>
</html>