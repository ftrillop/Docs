<?php
session_start();
if (!isset($_SESSION["CodRes"])) {
    header("location: login.php");
}
?>
<html>
    <head>
        <title>Lista de categorias</title>
        <style>
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
            ul {
                list-style: none;
            }
            ul a {
                text-decoration: none;
                color: black;
                font-size: 25px;
            }
            ul a:hover {
                color: grey;
            }
        </style>
        <link href="estilos.css" rel="stylesheet"> 
    </head>
    <body>
        <p>Usuario <?php echo $_SESSION["correo"]; ?> <a href="home.php">Home</a> <a href="ver_carrito.php">Ver_carrito</a> <a href="vaciar-carro.php">Vaciar_carrito</a> <a href="rexistroCategorias.php">Categorias</a> <a href="rexistroProdutos.php">Productos</a> <a href="rexistroUsuarios.php">Usuarios</a> <a href="pedidos.php">Pedidos</a> <a href="cerrarSesion.php">Cerrar_sesion</a></p>
        <h1>Lista de categorías</h1>
        <ul>
            <?php
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "SELECT CodCat, nombre FROM categorias WHERE Activo=TRUE ORDER BY CodCat";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    while ($fila) {
                        echo "<li>"."<a href='productos.php?categoria=".$fila["CodCat"]."'>".$fila["nombre"]."</a></li>";
                        $fila = $consulta->fetch_assoc();
                    }
                }
            }
            ?>
        </ul>
    </body>
</html>