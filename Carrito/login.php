<html>
    <head>
        <title>Identificar</title>
        <style>
            .error {
                color: red;
            }
        </style>
    </head>
        <body>
            <form action="login.php" method="POST">
                <label for="correo">Usuario </label>
                <input type="text" name="correo">
                <label for="clave">Clave </label>
                <input type="password" name="clave">
                <input type="submit" value="Enviar">
            </form>
            <?php
            if (isset($_POST["correo"])&&isset($_POST["clave"])) {
                $correo = $_POST["correo"];
                $clave = $_POST["clave"];
                $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
                if ($conexion) {
                    $sql = "SELECT CodRes, correo, clave FROM restaurantes WHERE correo='$correo' AND clave='$clave'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $fila = $consulta->fetch_assoc();
                        if ($fila) {
                            if ($correo == $fila["correo"] && $clave == $fila["clave"]) {
                                session_start();
                                $_SESSION["correo"] = $fila["correo"];
                                $_SESSION["clave"] = $fila["clave"];
                                $_SESSION["CodRes"] = $fila["CodRes"];
                                header("location: home.php");
                            }
                        } else {
                            echo "<p class='error'>Error en la autentificación</p>";
                        } 
                    }
                } else {
                    echo "<script>alert('ERROR! No se pudo establecer la conexion');</script>";
                }
            }
            ?>
        </body>
</html>