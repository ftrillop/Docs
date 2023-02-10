<html>
    <head>
        <title>Comprobacion</title>
    </head>
    <body>
        <?php
            if (isset($_GET["provincia"])) {
               
                session_start();
                $provincia = $_GET["provincia"];
                $localidad = $_SESSION["id_localidad"];
                $nombreLocalidad = $_SESSION["nombre"];
 
                $conexion = new mysqli("127.0.0.1", "root", "", "geografia");
                if ($conexion) {
                    $sql = "SELECT nombre FROM provincias WHERE n_provincia='$provincia'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $fila = $consulta->fetch_assoc();
                        if ($fila) {
                            $nombreProvincia = $fila["nombre"];
                        }
                    }
                }
 
                $conexion = new mysqli("127.0.0.1", "root", "", "geografia");
                if ($conexion) {
                    $sql = "SELECT n_provincia FROM localidades WHERE nombre='$nombreLocalidad'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $fila = $consulta->fetch_assoc();
                        if ($fila) {
                            $provinciaLocalidad = $fila["n_provincia"];
                        }
                    }
                }
 
                $conexion = new mysqli("127.0.0.1", "root", "", "geografia");
                if ($conexion) {
                    $sql = "SELECT p.nombre FROM localidades AS l JOIN provincias AS p ON (p.n_provincia=l.n_provincia) WHERE l.nombre='$nombreLocalidad'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $fila = $consulta->fetch_assoc();
                        if ($fila) {
                            $provinciaReal = $fila["nombre"];
                        }
                    }
                }
 
                if ($provincia==$provinciaLocalidad) {
                    echo "<h1>¡Has acertado!$nombreLocalidad est&aacute; en $nombreProvincia</h1>";
                    $_SESSION["aciertos"]++;
                } else {
                    echo "<h1>¡Fallaste!$nombreLocalidad no est&aacute; en $nombreProvincia</h1>";
                }
                echo "Realmente está en $provinciaReal<br><br>";
                echo "Aciertos=".$_SESSION["aciertos"].",Intentos=".$_SESSION["intento"].",Porcentaje=".$_SESSION["porcentaje"]."%<br><br>";
                echo "<a href='BD5-index.php'>Volver a jugar</a>";
            }
        ?>
    </body>
</html>