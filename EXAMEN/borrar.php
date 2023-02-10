<?php
session_start();
if (isset($_SESSION["nombre"])) {
    if (isset($_GET["id_mensaje"])) {
        $mensaje = $_GET["id_mensaje"];
        $conexion = new mysqli("127.0.0.1", "root", "", "modulos");
        if ($conexion) {
            $sql = "DELETE FROM mensajes WHERE id_mensaje='$mensaje'";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                header("location: mensajes.php");
            }
        }
    }
}
?>