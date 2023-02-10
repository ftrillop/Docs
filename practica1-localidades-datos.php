<html>
    <head>
        <title>Localidades</title>
    </head>
    <body>
        <?php
        if (!isset($_GET["localidad"])) {
            header("location: practica1-localidades.php");
        } else {
            $provincia = $_GET["provincia"];
            $conexion = new mysqli("127.0.0.1", "root", "", "geografia");
            if ($conexion) {
                $consulta = $conexion->query("SELECT l.nombre FROM localidades AS l JOIN provincias AS p ON (l.n_provincia = p.n_provincia) WHERE p.nombre='$provincia' ORDER BY l.nombre");
                if ($consulta) {
                    ?>
                    <form action="practica1-localidades-datos.php">
                        <label for="localidad">Elija la localidad deseada</label>
                        <select name="localidad" id="localidad">
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
                    $localidad = $_GET["localidad"];
                    $consulta = $conexion->query("SELECT l.nombre, l.poblacion FROM localidades AS l JOIN provincias AS p ON (l.n_provincia = p.n_provincia) WHERE p.nombre='$provincia' ORDER BY l.nombre");
                    ?>
                    <?php
                } else {
                    echo "<p class='error'>No se pudo obtener la lista de localidades</p>";
                }
            }
        }
        ?>
    </body>
</html>