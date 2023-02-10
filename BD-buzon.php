<html>
    <head>
        <title>Login</title>
        <style>
            h1 {
                text-align: center;
            }
            #area {
                display: flex;
                justify-content: center;
                width: 100%;
            }
            #area1 {
                text-align: center;
                width: 40%;
            }
            #area2 {
                text-align: center;
                width: 40%;
            }
            #area1 ul {
                text-align: left;
                margin-left: 11em;
            }
            #area1 p {
                width: fit-content;
                margin-left: -1em;
                padding: 1em;
            }
            span.nuevo {
                color: blue;
            }
        </style>
    </head>
    <body>
       
        <?php
            session_start();
            if (isset($_SESSION["usuario"])) {
                echo "<h1>Hola ".$_SESSION["usuario"]."</h1>";
            } else {
                header("location: BD4-index.php");
            }
        ?>
 
        <div id="area">
            <div id="area1">
                <h2>Lista de mensajes</h2>
                <?php
 
                    $conexion = new mysqli("127.0.0.1", "root", "", "mensajeria");
                    if ($conexion) {
                        $sql = "SELECT m.id_mensaje, m.texto, u.usuario, m.nuevo FROM mensajes AS m JOIN usuarios AS u ON (m.id_remite=u.id_usuario) WHERE m.id_destino=".$_SESSION["id_usuario"]." ORDER BY m.id_mensaje DESC";
                        $consulta = mysqli_query($conexion, $sql);
                        if ($consulta) {
                            $contador = mysqli_num_rows($consulta);
                            if ($contador == 0) {
                                echo "<h3>No hay mensajes</h3>";
                            } else {
                                $fila = $consulta->fetch_assoc();
                                if ($fila) {
                                    echo "<ul>";
                                    for ($i=0; $i<$contador; $i++) {
                                        $direccion = "BD4-borrar.php?mensaje=".$fila["id_mensaje"];
                                        if ($fila["nuevo"] == 1) {
                                            echo "<li><strong>De: </strong>".$fila["usuario"]."</li><span class='nuevo'>".$fila["texto"]."</span><br><a href='$direccion'>Borrar</a><br><br>";
                                        } else {
                                            echo "<li><strong>De: </strong>".$fila["usuario"]."</li>".$fila["texto"]."<br><a href='$direccion'>Borrar</a><br><br>";
                                        }
                                        $fila = $consulta->fetch_assoc();
                                    }
                                    echo "</ul>";
                                }
                            }
                        }
                    }
                    $conexion = new mysqli("127.0.0.1", "root", "", "mensajeria");
                    if ($conexion) {
                        $sql = "UPDATE mensajes SET nuevo=0 WHERE nuevo=1 AND id_destino='".$_SESSION["id_usuario"]."'";
                        $consulta = mysqli_query($conexion, $sql);
                    }
                   
                ?>
            </div>
            <div id="area2">
                <h2>Nuevo mensaje</h2>
                <form id="iniciar" action="BD4-buzon.php">
                    <input type="text" placeholder="admin" name="destinatario"><br><br>
                    <textarea id="mensaje" placeholder="escribe un mensaje" name="mensaje" rows="10" cols="20"></textarea><br><br>
                    <input type="submit" value="Enviar mensaje">
                </form>
            </div>
        </div>
        <?php
        if (isset($_GET["destinatario"])&&isset($_GET["mensaje"])) {
            $conexion = new mysqli("127.0.0.1", "root", "", "mensajeria");
            if ($conexion) {
 
                $mensaje = $_GET["mensaje"];
                $destinatario = $_GET["destinatario"];
 
                $sql = "SELECT id_usuario FROM usuarios WHERE usuario='$destinatario'";
                $consulta = mysqli_query($conexion, $sql);
 
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    if ($fila) {
                        $id_destino = $fila["id_usuario"];
                    }
                }
            }
            $conexion = new mysqli("127.0.0.1", "root", "", "mensajeria");
            if ($conexion) {
                $sql = "INSERT INTO mensajes (texto, id_remite, id_destino, nuevo) VALUES ('$mensaje', '".$_SESSION["id_usuario"]."','$id_destino', 1)";
                $consulta = mysqli_query($conexion, $sql);
 
                if ($consulta) {
                    header("location: BD4-enviado.php");
                } else {
                    echo "alert('No se pudo enviar el mensaje');";
                }
            }
        }
        ?>
        <a href="BD4-logout.php">Cerrar sesion</a>
    </body>
</html>