<html>
    <head>
        <title>Iniciar/Alta</title>
        <style>
            h1 {
                text-align: center;
            }
            #iniciar {
                margin-top: 2em;
                margin-left: 3em;
                height: 150px;
                width: 200px;
                padding-left: 1em;
                padding-right: 1em;
            }
            #registrar {
                margin-top: 2em;
                margin-left: 3em;
                height: 150px;
                width: 200px;
                padding-left: 1em;
                padding-bottom: 1em;
                padding-right: 1em;
            }
            #area {
                display: flex;
            }
            #area1 {
                display: flex;
                justify-content: center;
                width: 100%;
            }
            #area2 {
                display: flex;
                justify-content: center;
                width: 100%;
            }
        </style>
    </head>
    <body>
        
        <h1>Conexión con el servicio de mensajería</h1>
        <div id="area">
            <div id="area1">
                <form id="iniciar" action="BD3-index.php">
                    <h2>Entrar en la cuenta</h2>
                    <input type="text" placeholder="usuario" name="usuario1"><br>
                    <input type="password" placeholder="contraseña" name="contraseña1"><br>
                    <input type="submit" value="Validar">
                </form>
            </div>
            <div id="area2">
                <form id="registrar" action="BD3-index.php">
                    <h2>Nuevo usuario</h2>
                    <input type="text" placeholder="usuario" name="usuario2"><br>
                    <input type="password" placeholder="contraseña" name="contraseña2"><br>
                    <input type="password" placeholder="Repita contraseña" name="repcontraseña2"><br>
                    <input type="submit" value="Validar">
                </form>
            </div>
        </div>
        
        
        
        <?php
        if (isset($_GET["usuario1"])&&isset($_GET["contraseña1"])) {
            $conexion = new mysqli("127.0.0.1", "root", "", "mensajeria");
            if ($conexion) {

                $usuario = $_GET["usuario1"];
                $contraseña = $_GET["contraseña1"];

                $sql = "SELECT id_usuario, usuario, pass FROM usuarios WHERE usuario='$usuario' AND pass='$contraseña'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    if ($fila) {
                        if ($usuario == $fila["usuario"] && $contraseña == $fila["pass"]) {
                            session_start();
                            $_SESSION["usuario"] = $usuario;
                            $_SESSION["id_usuario"] = $fila["id_usuario"];
                            header("location: BD3-buzon.php");
                        }
                    }
                }
            }
        }
        ?>
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