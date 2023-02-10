<?php
session_start();
if (!isset($_SESSION["CodRes"])) {
    header("location: login.php");
} else {
    $cod_usuario = $_SESSION["CodRes"];
}
$conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
?>
<html>
    <head>
        <title>Carrito</title>
        <style>
            table {
                text-align: center;
                background-color: royalblue;
                color: white;
                padding: 0.5%;
            }
            th {
                padding-left: 1em;
                padding-right: 1em;
                font-size: 20px;
            }
            td {
                padding: 1em;
                font-size: 20px;
            }
            #art {
                border: #4141e1;
                padding: 0.25em;
                font-size: 20px;
            }
            #art:hover {
                background-color: #2EB0FF;
                font-size: 20px;
            }
            #eliminar {
                color: white;
                background-color: blue;
                border: #4141e1;
                padding: 0.25em;
                font-size: 20px;
            }
            #eliminar:hover {
                background-color: #2EB0FF;
                color: #D7D7D7;
            }
            #realizarPedido {
                margin-left: 25%;
                text-decoration: none;
                background-color: royalblue;
                color: white;
                font-size: 25px;
                padding: 0.7em;
                border: 1px solid black;
            }
            #realizarPedido:hover {
                background-color: #005199;
            }
            #realizarPedidoVacio {
                margin-left: 9%;
                text-decoration: none;
                background-color: royalblue;
                color: white;
                font-size: 25px;
                padding: 0.7em;
                border: 1px solid black;
            }
            #realizarPedidoVacio:hover {
                background-color: #005199;
            }

            p {
                background-color: royalblue;
                color: white;
                font-size: 30px;
                padding-top: 1%;
                padding-bottom: 1%;
            }
            p a {
                color: white;
                text-decoration: none;
                margin-top: 0%;
                margin-left: 1%;
                padding: 1% 1% 1% 1%;
            }
            p a:hover {
                 background-color: #4141e1;
            }
        </style>
    </head>
    <body>
        <p>Usuario: <?php echo $_SESSION["correo"]; ?> <a href="home.php">Home</a> <a href="ver_carrito.php">Ver_carrito</a> <a href="vaciar-carro.php">Vaciar_carrito</a> <a href="rexistroCategorias.php">Categorias</a> <a href="rexistroProdutos.php">Productos</a> <a href="rexistroUsuarios.php">Usuarios</a> <a href="pedidos.php">Pedidos</a> <a href="cerrarSesion.php">Cerrar_sesion</a></p>
        <h1>Carrito de la compra</h1>
        <table>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Peso</th>
            <th>Unidades</th>
            <th>Eliminar</th>
            <?php
            if ($conexion) {
                $sql = "SELECT CodProd, Nombre, Descripcion, Peso FROM productos";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    while ($fila) {
                        if (isset($_SESSION["art".$fila["CodProd"]]) && $_SESSION["art".$fila["CodProd"]] > 0) {
                            echo "<tr>";
                            echo "<td>".$fila["Nombre"]."</td>";
                            echo "<td>".$fila["Descripcion"]."</td>";
                            echo "<td>".$fila["Peso"]."</td>";
                            if (isset($_POST["articulo".$fila["CodProd"]])) {
                                $cantidad = $_POST["articulo".$fila["CodProd"]];
                                if ($cantidad > 0 && $cantidad <= $_SESSION["art".$fila["CodProd"]]) {
                                    $_SESSION["art".$fila["CodProd"]] = $_SESSION["art".$fila["CodProd"]] - $cantidad;
                                    $_SESSION["stockArt".$fila["CodProd"]] += $cantidad;
                                    $_SESSION["Carro_lleno"] = "lleno";
                                }
                            } else {
                                $_SESSION["Carro_lleno"] = "vacio";
                            }
                            echo "<td>".$_SESSION["art".$fila["CodProd"]]."</td>";
                            echo "<form action='ver_carrito.php' method='POST'>";
                            echo "<td><input type='number' id='art' name='articulo".$fila["CodProd"]."' value='0'></td>";
                            echo "<td><input type='submit' id='eliminar' name='eliminarArt".$fila["CodProd"]."' value='Eliminar'></td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                        $fila = $consulta->fetch_assoc();
                    }
                }
            }
            ?>
        </table>
        <br><br><br>
        <?php
        if (isset($_SESSION["Carro_lleno"])) {
            echo "<a id='realizarPedido' href='realizarPedido.php'>Realizar pedido</a>";
        } else {
            echo "<a id='realizarPedidoVacio' href='realizarPedido.php'>Realizar pedido</a>";
        }
        ?>
    </body>
</html>