<html>
    <head>
        <title>Autentificacion</title>
    </head>
    <body>
        <form action="practica3-autentificacion.php" method="post">
            <label for="usuario">Nombre de usuario </label>
            <input type="text" name="usuario" id="usuario">
            <br>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Comprobar">
        </form>
    </body>
    <?php
    session_start();

    if (isset($_POST["usuario"])&&isset($_POST["password"])) {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    if ($usuario == "admin" && $password == "123456") {
        $_SESSION["usuario"] = $usuario;
        $_SESSION["password"] = $password;
        header("location: practica3-restrinxida.php");
    } else {
        echo "<h2>Datos incorrectos</h2>";
    }
    }
    ?>
</html>