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
                margin-top: -9px;
                padding: 1em;
            }
            a {
                position: absolute;
                top: 90%;
            }
        </style>
    </head>
    <body>
       
        <?php
            session_start();
            if (isset($_SESSION["usuario"])) {
                echo "<h1>Hola ".$_SESSION["usuario"]."</h1>";
            } else {
                header("location: BD3-index.php");
            }
        ?>
 
        <div id="area">
            <div id="area1">
                <h2>Lista de mensajes</h2>
                <?php
 
                    $conexion = new mysqli("127.0.0.1", "root", "", "mensajeria");
                    if ($conexion) {
                        $sql = "SELECT m.texto, u.usuario FROM mensajes AS m JOIN usuarios AS u ON (m.id_remite=u.id_usuario) WHERE m.id_destino='".$_SESSION["id_usuario"]."'";
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
                                        echo "<li><strong>De: </strong>".$fila["usuario"]."</li><p>".$fila["texto"]."</p>";
                                    }
                                    echo "</ul>";
                                }
                            }
                        }
                    }
                   
                ?>
            </div>
            <div id="area2">
                <h2>Nuevo mensaje</h2>
                <form id="iniciar" action="BD3-buzon.php">
                    <input type="text" placeholder="admin" name="destinatario"><br><br>
                    <textarea id="mensaje" rows="20" cols="40" placeholder="texto del mensaje" name="mensaje"></textarea><br><br>
                    <input type="submit" value="Enviar mensaje">
                </form>
            </div>
        </div>
        <?php
        if (isset($_GET["destinatario"])&&isset($_GET["mensaje"])) {
            $conexion = new mysqli("127.0.0.1", "root", "", "mensajeria");
            if ($conexion) {
                $destinatario = $_GET["destinatario"];
                $mensaje = $_GET["mensaje"];
                $sql = "SELECT u.usuario, u.id_usuario, m.id_destino FROM usuarios AS u JOIN mensajes ON (u.id_usuario=m.id_destino) WHERE u.usuario='".$destinatario."'";

                $consulta = mysqli_query($conexion, $sql);

                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    $destinatario = $fila["id_usuario"];
                }

                $sql2 = "INSERT INTO mensajes (texto, id_remite, id_destino) VALUES ('$mensaje', ".$_SESSION["usuario"].", $destinatario)";
                
                $consulta = mysqli_query($conexion, $sql2);
                
                if ($consulta) {
                    echo "<script>alert('Se pudo enviar el mensaje');</script>";
                } else {
                    echo "<script>alert('No se pudo enviar el mensaje');</script>";
                }
            }
        }
        ?>
        <a href="BD3-logout.php">Cerrar sesion</a>
    </body>
</html>