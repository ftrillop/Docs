<?php
$mensaje = $_GET["mensaje"];
$conexion = new mysqli("127.0.0.1", "root", "", "mensajeria");
if ($conexion) {
    $sql = "DELETE FROM mensajes WHERE id_mensaje='$mensaje'";
    $consulta = mysqli_query($conexion, $sql);
    if ($consulta) {
        header("location: BD4-buzon.php");
    } else {
        echo "ERROR! NO SE PUDO BORRAR EL MENSAJE";
    }
}
?>
