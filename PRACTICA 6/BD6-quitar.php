<?php
if (isset($_GET["curso"])) {
    $curso = $_GET["curso"];
    $conexion = new mysqli("127.0.0.1", "root", "", "cursos");
    if ($conexion) {
        $sql = "UPDATE cursos SET plazas_ocupadas = plazas_ocupadas - 1 WHERE id_curso=$curso";
        $consulta = mysqli_query($conexion, $sql);
        header("location: BD6-index.php");
    }
} else {
    header("location: BD6-index.php");
}
?>