<?php
session_start();
if (!isset($_SESSION["CodRes"])) {
    header("location: login.php");
}
$conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
if ($conexion) {
    $sql = "SELECT CodProd, Stock FROM productos";
    $consulta = mysqli_query($conexion, $sql);
    if ($consulta) {
        $fila = $consulta->fetch_assoc();
        while ($fila) {
            $_SESSION["art".$fila["CodProd"]] = 0;
            $_SESSION["stockArt".$fila["CodProd"]] = $fila["Stock"];
            $fila = $consulta->fetch_assoc();
        }
    }
}
header("location: ver_carrito.php");
?>