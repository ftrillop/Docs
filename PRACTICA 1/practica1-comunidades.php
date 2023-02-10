<html>
    <head>
        <title>Comunidades</title>
    </head>
    <body>
        <?php

            $conexion = new mysqli("127.0.0.1","root","","geografia");
            if ($conexion) {
                $consulta = $conexion->query("SELECT nombre FROM comunidades ORDER BY nombre");
                if ($consulta) {
                    ?>
                    <form action="practica1-provincias.php">
                        <label for="comunidad">Elija la comunidad deseada </label>
                        <select name="comunidad" id="comunidad">
                            <?php
                            $fila = $consulta->fetch_assoc();
                            while($fila) {
                                echo "<option value='{$fila["nombre"]}'>"."{$fila["nombre"]}</option>";
                                $fila = $consulta->fetch_assoc();
                            }
                            ?>
            </select>
            <button>Buscar provincias</button>
        </form>
        <?php
                } else {
                    echo "<p class='error'>No se pudo obtener la lista de comunidades</p>";
                }
            }
        ?>
    </body>
</html>