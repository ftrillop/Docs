<?php
session_start();
if (isset($_SESSION["nombre"])) {
    
    $id_alumno = $_SESSION["id_curso"];
    $nombre =$_SESSION["nombre"];
    $id_curso = $_SESSION["id_curso"];

    $conexion = new mysqli("127.0.0.1", "root", "", "modulos");
    if ($conexion) {
        $sql = "SELECT c.curso FROM alumnos AS a JOIN cursos AS c ON (a.id_curso=c.id_curso) WHERE c.id_curso='$id_curso'";
        $consulta = mysqli_query($conexion, $sql);
        if ($consulta) {
            $fila = $consulta->fetch_assoc();
            if ($fila) {
                $nombre_curso = $fila["curso"];
            }
        }
    }

    echo "<h1>Mensaxes de $nombre_curso</h1>";
    echo "<a href='cerrar_sesion.php'>$nombre</a><br><br>";
} else {
    header("location: mensajes.php");
}
?>
<html>
    <head>
        <title>Mensajes</title>
    </head>
    <body>
        <form action="mensajes.php">
            <input type="text" name="mensaje">
            <label for="todos">A todos</label>
            <input type="checkbox" name="todos">
            <input type="submit" value="Publicar">
        </form>
        <hr>
        <?php
        if (isset($_GET["mensaje"])) {
            $mensaje = $_GET["mensaje"];
            if (isset($_GET["todos"])) {
                $todos = 1;
            } else {
                $todos = 0;
            }
            if ($conexion) {
                $sql = "INSERT INTO mensajes (mensaje, todos, id_curso, id_alumno) VALUES ('$mensaje', '$todos', '$id_curso', '$id_alumno')";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    echo "<script>alert('MENSAXE ENVIADO!');</script>";
                }
            }
        }
        ?>
        <?php
        $altavoz = "\u{1F4E3}";
        $eliminar = "\u{274C}";

        if ($conexion) {
            $sql = "SELECT m.mensaje, m.id_mensaje, m.id_alumno, m.todos, m.id_curso, a.nombre, m.fecha FROM mensajes AS m JOIN alumnos AS a ON (m.id_alumno=a.id_alumno) WHERE m.id_curso='$id_curso' OR m.todos='1'";

            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $num_mensajes = mysqli_num_rows($consulta);
                if ($num_mensajes == 0) {
                    echo "<p>No hay mensajes</p>";
                } else {
                    $fila = $consulta->fetch_assoc();
                    if ($fila) {
                
                        echo "<table>";
                        echo "<th>Fecha</th>";
                        echo "<th>Usuario</th>";
                        echo "<th>Mensaje</th>";
                        while ($fila) {
                            echo "<tr>";
                            echo "<td>".$fila["fecha"]."</td>";
                            echo "<td>".$fila["nombre"]."</td>";
                            if ($fila["todos"] == 1) {
                                if ($fila["id_alumno"] == $id_alumno) {
                                echo "<td>"."$altavoz".$fila["mensaje"]."<a href='borrar.php?id_mensaje=".$fila["id_mensaje"]."'>$eliminar</a>"."</td>";
                                } else {
                                    echo "<td>"."$altavoz".$fila["mensaje"]."</td>";
                                }
                            } else {
                                if ($fila["id_alumno"] == $id_alumno) {
                                    echo "<td>".$fila["mensaje"]."<a href='borrar.php?id_mensaje=".$fila["id_mensaje"]."'>$eliminar</a>"."</td>";
                                } else {
                                    echo "<td>".$fila["mensaje"]."</td>";
                                }
                            }
                            echo "</tr>";
                            $fila = $consulta->fetch_assoc();
                        }
                        echo "</table>";
                        
                    }
                }
            } else {
                echo "ERROR";
            }
        }
        ?>
    </body>
</html>