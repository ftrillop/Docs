<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
            echo "<h1>Adivina la provincia</h1>";
            $conexion = new mysqli("127.0.0.1", "root", "", "geografia");
            if ($conexion) {
                $num_aleatorio = mt_rand(2865, 3865);
                $sql = "SELECT nombre, id_localidad FROM localidades WHERE id_localidad=$num_aleatorio";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    session_start();
                    $_SESSION["nombre"] = $fila["nombre"];
                    $_SESSION["id_localidad"] = $fila["id_localidad"];
                    echo "Localidad: <strong>".$fila["nombre"]."</strong><br><br>";
                }
            }
        ?>
        <form action="BD5-comprobar.php">
            <?php
                $conexion = new mysqli("127.0.0.1", "root", "", "geografia");
                if ($conexion) {
                    $sql = "SELECT n_provincia, nombre FROM provincias ORDER BY n_provincia ASC";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $fila = $consulta->fetch_assoc();
                        echo "<select name='provincia' id='provincia'>";
                        while ($fila) {
                            echo "<option value='".$fila["n_provincia"]."'>".$fila["nombre"]."</option>";
                            $fila = $consulta->fetch_assoc();
                        }
                        echo "</select><br><br>";
                    }
                }
            ?>
            <input type="submit" value="Comprobar">
            <?php
            if (isset($_SESSION["intento"])) {
                $_SESSION["intento"]++;
            } else {
                $_SESSION["intento"] = 1;
            }
            if (!isset($_SESSION["aciertos"])) {
                $_SESSION["aciertos"] = 0;
            }
            if (!isset($_SESSION["porcentaje"])) {
                $_SESSION["porcentaje"] = 0;
            } else {
                $_SESSION["porcentaje"] = $_SESSION["aciertos"]*100/$_SESSION["intento"];
            }
            echo "<br><br>Aciertos=".$_SESSION["aciertos"].",Intentos=".$_SESSION["intento"].",Porcentaje=".$_SESSION["porcentaje"]."%";
            ?>
        </form>
    </body>
</html>