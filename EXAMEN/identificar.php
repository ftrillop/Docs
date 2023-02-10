<html>
    <head>
        <title>Identificar</title>
        <style>
            .error_inicio {
                color: red;
            }
        </style>
    </head>
    <body>
        <h1>Identificaci&oacute;n</h1>
        <form action="identificar.php">
            <input type="text" name="usuario"><br>
            <input
             type="password" name="contraseña"><br>
             <input type="submit" value="Entrar">
        </form>
        <?php
        if (isset($_GET["usuario"])&&isset($_GET["contraseña"])) {
            $usuario = $_GET["usuario"];
            $contraseña = $_GET["contraseña"];
            $conexion = new mysqli("127.0.0.1", "root", "", "modulos");
            if ($conexion) {
                $sql = "SELECT id_alumno, nombre, pass, id_curso FROM alumnos WHERE nombre='$usuario' AND pass='$contraseña'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    if ($fila) {
                        if ($usuario == $fila["nombre"] && $contraseña == $fila["pass"]) {
                            session_start();
                            $_SESSION["id_alumno"] = $fila["id_alumno"];
                            $_SESSION["nombre"] = $fila["nombre"];
                            $_SESSION["id_curso"] = $fila["id_curso"];
                            header("location: mensajes.php");
                        }
                    } else {
                        echo "<p class='error_inicio'>Error en la autentificación</p>";
                    } 
                }
            } else {
                echo "<script>alert('ERROR! No se pudo establecer la conexion');</script>";
            }
        }
        ?>
    </body>
</html>