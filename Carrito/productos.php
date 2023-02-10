<?php
session_start();
if (!isset($_SESSION["CodRes"])) {
    header("location: login.php");
}
if (isset($_GET["categoria"])) {
    $categoria = $_GET["categoria"];
}
?>
<html>
    <head>
        <title>Comida</title>
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
            p {
                background-color: royalblue;
                color: white;
                font-size: 30px;
                padding-top: 1%;
                padding-bottom: 1%;
            }
            #categoria {
                background-color: white;
                color: black;
                font-size: 30px;
            }
            #stockArt {
                border: #4141e1;
                padding: 0.25em;
                font-size: 20px;
            }
            #stockArt:hover {
                background-color: #2EB0FF;
                font-size: 20px;
            }
            #comprar {
                color: white;
                background-color: blue;
                border: #4141e1;
                padding: 0.25em;
                font-size: 20px;
            }
            #comprar:hover {
                background-color: #2EB0FF;
                color: #D7D7D7;
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
            <?php
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "SELECT c.Nombre AS Categoria, p.CodProd, p.Nombre, p.Descripcion, c.Descripcion AS descrip, p.Peso, p.Stock FROM productos AS p JOIN categorias AS c USING (CodCat) WHERE c.CodCat='$categoria'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    $i=1;
                    ?>
                    <h1><?php echo $fila["Categoria"]; ?></h1>
                    <p id="categoria"><?php echo $fila["descrip"]; ?></p>
                    <table>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Peso</th>
                        <th>Stock</th>
                        <th>Comprar</th>
                        <?php
                        while ($fila) {
                            if (!isset($_SESSION["art".$fila["CodProd"]])) {
                                // Almacena la cantidad del producto que el cliente encarga. Será 0 mientras no encargue nada.
                                $_SESSION["art".$fila["CodProd"]] = 0;
                            }
                            if (!isset($_SESSION["stockArt".$fila["CodProd"]])) {
                                // Almacena la cantidad del producto que hay en stock.
                                $_SESSION["stockArt".$fila["CodProd"]] = $fila["Stock"];
                            } else {
                                $_SESSION["stockArt".$fila["CodProd"]] = $fila["Stock"];
                                if (isset($_POST["stockArt".$fila["CodProd"]])) {
                                    $cantidad = $_POST["stockArt".$fila["CodProd"]];
                                    if ($cantidad > 0 && $cantidad <= $_SESSION["stockArt".$fila["CodProd"]]) {
                                        $_SESSION["stockArt".$fila["CodProd"]] = $_SESSION["stockArt".$fila["CodProd"]] - $cantidad;
                                        $_SESSION["art".$fila["CodProd"]] += $cantidad;
                                    }
                                }
                            }
                            echo "<tr>";
                            echo "<td>".$fila["Nombre"]."</td>";
                            echo "<td>".$fila["Descripcion"]."</td>";
                            echo "<td>".$fila["Peso"]."</td>";
                            echo "<td>".$_SESSION["stockArt".$fila["CodProd"]]."</td>";
                            echo "<td>"."<form action='productos.php?categoria=$categoria' method='POST'><input type='number' id='stockArt' name='stockArt".$fila["CodProd"]."' value=0> <input type='submit' id='comprar' name='comprar' value='Comprar'></form></td>";
                            echo "</tr>";
                            $fila = $consulta->fetch_assoc();
                            $i++;
                        }
                }
            }
            ?>
        </table>
    </body>
</html>