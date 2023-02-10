<html>
    <head>
        <title>Registrar usuarios</title>
        <style></style>
    </head>
    <body>
    <?php
    if (isset($_GET["usuario2"])&&isset($_GET["contraseña2"])&&isset($_GET["repcontraseña2"])) {

        $usuario2 = $_GET["usuario2"];
        $contraseña2 = $_GET["contraseña2"];
        $repcontraseña2 = $_GET["repcontraseña2"];

        $usuarioValido = true;

        $conexion = new mysqli("127.0.0.1", "root", "", "mensajeria");
        
        if ($conexion) {
            if ($contraseña2 == $repcontraseña2) {
                $sql = "INSERT INTO usuarios (usuario, pass) VALUES ('$usuario2', '$contraseña2')";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    echo "<script>alert('USUARIO CREADO!!');</script>";
                    //header("location: BD3-index.php");
                } else {
                    echo "<script>alert('ERROR');</script>";
                }
            }
        }
    }
    ?>
    </body>
</html>
