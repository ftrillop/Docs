<?php
session_start();
if (!isset($_SESSION["CodRes"])) {
    header("location: login.php");
}
if (!isset($_SESSION["prodEliminar"])) {
    header("location: pedidos.php");
}
?>
<html>
    <head>
        <title>Eliminar articulo</title>
        <style>
            form {
                border: 3px solid black;
                text-align: center;
                width: fit-content;
                padding: 2em;
                margin-left: 40%;
                margin-top: 5%;
            }
            #aceptar {
                border-radius: 10em;
                font-size: large;
                background-color: lightskyblue;
                font-weight: 800;
                padding: 0.5em;
            }
            #cancelar {
                border-radius: 10em;
                font-size: large;
                background-color: lightskyblue;
                font-weight: 800;
                padding: 0.5em;
            }
            table {
                border-collapse: collapse;
                border: 1px solid black;
                font-size: large;
                margin-left: 32%;
                margin-top: 10%;
            }
            th {
                padding: 1em 2em 1em 2em;
                text-align: center;
            }
            tr {
                padding: 1em 2em 1em 2em;
                text-align: center;
            }
            td {
                padding: 1em 2em 1em 2em;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php
        $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
        if ($conexion) {
            $codPed = 0;
            $sql = "SELECT r.Correo, p.CodPed, pr.Nombre, pd.CodPredProd, pd.Unidades FROM restaurantes AS r JOIN pedidos AS p ON (r.CodRes=p.Restaurante) JOIN pedidosproductos AS pd ON (p.CodPed=pd.CodPed) JOIN productos AS pr ON (pd.CodProd=pr.CodProd) WHERE CodPredProd='".$_SESSION["prodEliminar"]."'";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                echo "<table id='pedidos'>";
                echo "<th>Num Pedido</th><th>Cliente</th><th>Artículos</th><th>Unidades</th>";
                echo "<tr>";
                $fila = $consulta->fetch_assoc();
                $codPed = $fila["CodPed"];
                echo "<td>".$fila["CodPed"]."</td><td>".$fila["Correo"]."</td><td>".$fila["Nombre"]."</td><td>".$fila["Unidades"]."</td>";
                echo "</tr>";
                echo "</table>";
            }
            if (isset($_POST["aceptar"])) {
                $_SESSION["eliminarArt"] = true;
                $devolverStock = 0;
                $codProd = 0;
                $sql = "SELECT CodProd, Unidades FROM pedidosproductos WHERE CodPredProd='".$_SESSION["prodEliminar"]."'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    $devolverStock = $fila["Unidades"];
                    $codProd = $fila["CodProd"];
                }
                $sql = "UPDATE productos SET Stock=Stock+$devolverStock WHERE CodProd='$codProd'";
                $consulta = mysqli_query($conexion, $sql);
                $sql = "DELETE FROM pedidosproductos WHERE CodPredProd='".$_SESSION["prodEliminar"]."'";
                //actualizar stock
                //comprobar se quedan liñas dese pedido..e se non quedan borrar..
                //consulta count()  CodPredProd='".$_SESSION["prodEliminar"]."'";
                //se devolve 0 -> non hai liñas... e podo borrar pedidos
                $consulta = mysqli_query($conexion, $sql);
                $sql = "SELECT CodPed FROM pedidosproductos WHERE CodPed='$codPed'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    if (mysqli_num_rows($consulta)==0) {
                        $sql = "DELETE FROM pedidos WHERE CodPed='$codPed'";
                        $consulta = mysqli_query($conexion, $sql);
                    }
                }
                header("location: pedidos.php");
            }
            if (isset($_POST["cancelar"])) {
                header("location: pedidos.php");
            }
        }
        ?>
        <form action="eliminarArticulo.php" method="POST">
            <h1>¿Eliminar articulo?</h1>
            <br>
            <input type="submit" name="aceptar" value="Confirmar" id="aceptar">
            <input type="submit" name="cancelar" value="Cancelar" id="cancelar">
        </form>
    </body>
</html>