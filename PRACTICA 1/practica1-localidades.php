<html>
    <head>
        <title>Localidades</title>
    </head>
    <body>
        <?php
        if (!isset($_GET["provincia"])) {
            header("location: practica1-provincias.php");
        } else {
            $provincia = $_GET["provincia"];
            $conexion = new mysqli("127.0.0.1", "root", "", "geografia");
            if ($conexion) {
                $consulta = $conexion->query("SELECT l.nombre FROM localidades AS l JOIN provincias AS p ON (l.n_provincia = p.n_provincia) WHERE p.nombre='$provincia'");
                if ($consulta) {
                    ?>
                    <form action="practica1-localidades.php">
                        <label for="localidad">Elija la localidad deseada</label>
                        <select name="localidad" id="localidad">
                            <?php
                            $fila = $consulta->fetch_assoc();
                            while ($fila) {
                                echo "<option value='{$fila["nombre"]}'>"."{$fila["nombre"]}</option>";
                                $fila = $consulta->fetch_assoc();
                            }
                        }
                    }
                            ?>
                        </select>
                        <input type="hidden" name="provincia" id="provincia" value="<?php echo "$provincia"; ?>">
                        <button>Buscar localidades</button>
                    </form>
                    <?php
                if (isset($_GET["localidad"])) {
                    $localidad = $_GET["localidad"];
                    if ($conexion) {
                        $consulta = $conexion->query("SELECT poblacion FROM localidades WHERE nombre='$localidad'");
                        if ($consulta) {
                            $fila = $consulta->fetch_assoc();
                            echo "Localidad: ".$localidad."<br>Población: ".$fila["poblacion"];
                        }
                    }
                } else {
                    echo "<p class='error'>No se pudo obtener la lista de localidades</p>";
                }
            }
        ?>
    </body>
</html>