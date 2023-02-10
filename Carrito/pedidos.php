<?php
session_start();
if (!isset($_SESSION["CodRes"])) {
    header("location: login.php");
}
$_SESSION["añadidos"] = false;
$_SESSION["quitados"] = false;
$insuficientes = false;
$demasiados = false;
$unidades = 0;
$producto = "";
$conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
if ($conexion) {
    if (isset($_GET["añadir"])) {
        foreach ($_GET as $indice=>$valor) {
            $unidades = $_GET[$indice];
            $producto = $indice;
            $codProd = 0;
            $stock = 0;
            $sql = "SELECT CodProd FROM pedidosproductos WHERE CodPredProd='$producto'";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $fila = $consulta->fetch_assoc();
                $codProd = $fila["CodProd"];
            }
            $sql = "SELECT Stock FROM productos WHERE CodProd='$codProd'";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $fila = $consulta->fetch_assoc();
                $stock = $fila["Stock"];
            }
            if ($unidades>0 && $unidades<=$stock) {
                $sql = "UPDATE pedidosproductos SET Unidades=Unidades+$unidades WHERE CodPredProd='$producto'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $sql = "UPDATE productos SET Stock=Stock-$unidades WHERE CodProd='$codProd'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $_SESSION["añadidos"] = true;
                    }
                }
            } else {
                $insuficientes = true;
            }
            break;
        }
    }
    if (isset($_GET["quitar"])) {
        foreach ($_GET as $indice=>$valor) {
            $unidades = $_GET[$indice];
            $producto = $indice;
            $codProd = 0;
            $total = 0;
            $stock = 0;
            $sql = "SELECT CodProd, Unidades FROM pedidosproductos WHERE CodPredProd='$producto'";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $fila = $consulta->fetch_assoc();
                $codProd = $fila["CodProd"];
                $total = $fila["Unidades"];
            }
            $sql = "SELECT Stock FROM productos WHERE CodProd='$codProd'";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $fila = $consulta->fetch_assoc();
                $stock = $fila["Stock"];
            }
            if ($unidades>0 && $unidades<=$total) {
                $sql = "UPDATE pedidosproductos SET Unidades=Unidades-$unidades WHERE CodPredProd='$producto'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $sql = "UPDATE productos SET Stock=Stock+$unidades WHERE CodProd='$codProd'";
                    $consulta = mysqli_query($conexion, $sql);
                    if ($consulta) {
                        $_SESSION["quitados"] = true;
                    }
                }

            } else {
                $demasiados = true;
            }
            break;
        }
    }
    if (isset($_GET["eliminar"])) {
        foreach ($_GET as $indice=>$valor) {
            $_SESSION["prodEliminar"] = $indice;
            header("location: eliminarArticulo.php?CodPredProd=".$indice);
            break;
        }
    }
}
?>
<html>
    <head>
        <title>Pedidos</title>
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
            .añadir {
                color: white;
                background-color: blue;
                border: #4141e1;
                padding: 0.25em;
                font-size: 20px;
            }
            .añadir:hover {
                background-color: #2EB0FF;
                color: #D7D7D7;
            }
            .quitar {
                color: white;
                background-color: blue;
                border: #4141e1;
                padding: 0.25em;
                font-size: 20px;
            }
            .quitar:hover {
                background-color: #2EB0FF;
                color: #D7D7D7;
            }
            .eliminar {
                color: white;
                background-color: blue;
                border: #4141e1;
                padding: 0.25em;
                font-size: 20px;
            }
            .eliminar:hover {
                background-color: #2EB0FF;
                color: #D7D7D7;
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
            h1 {
                text-align: center;
            }
            #lista {
                color: white;
                list-style: none;
                text-align: center;
                width: 100%;
                border-bottom: 1px solid black;
                background-color: blue;
                padding: 0.5em 0.69em 0.5em 0.69em;
                margin-left: -1.35em;
                position: relative;
                font-size: 30px;
            }
            ul {
                list-style: none;
                border: 1px solid black;
                width: 20%;
                position: relative;
                margin-top: -1.25em;
                padding-bottom: 2em;
                margin-left: 39%;
            }
            li.menu {
                margin-left: 3.5em;
                margin-top: 1em;
                font-size: 20px;
            }
            li a {
                color: black;
                text-decoration: none;
            }
            li.menu:hover {
                cursor: pointer;
                font-weight: 900;
            }
            table {
                border-collapse: collapse;
                margin-left: 20%;
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
            #desplegar {
                width: 50px;
                height: 50px;
            }
            #notificacion {
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
            #recibo {
                border: 1px solid black;
                text-decoration: none;
                color: black;
                border-radius: 15%;
                padding: 0.5%;
                font-size: 18px;
                font-weight: 900;
            }
        </style>
    </head>
    <body>
        <p>Usuario: <?php echo $_SESSION["correo"]; ?> <a href="home.php">Home</a> <a href="ver_carrito.php">Ver_carrito</a> <a href="vaciar-carro.php">Vaciar_carrito</a> <a href="rexistroCategorias.php">Categorias</a> <a href="rexistroProdutos.php">Productos</a> <a href="rexistroUsuarios.php">Usuarios</a> <a href="pedidos.php">Pedidos</a> <a href="cerrarSesion.php">Cerrar_sesion</a></p>
        <br>
        <h1>Información de los pedidos</h1>
        <br><br>
        <?php
        $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
        if ($conexion) {
            echo "<table id='pedidos'>";
            echo "<th>Num Pedido</th><th>Cliente</th><th>Artículos</th><th>Unidades</th><th></th><th></th><th></th>";
            $sql = "SELECT r.Correo, p.CodPed, pr.Nombre, pd.CodPredProd, pd.Unidades FROM restaurantes AS r JOIN pedidos AS p ON (r.CodRes=p.Restaurante) JOIN pedidosproductos AS pd ON (p.CodPed=pd.CodPed) JOIN productos AS pr ON (pd.CodProd=pr.CodProd)";
            $consulta = mysqli_query($conexion, $sql);
            if ($consulta) {
                $fila = $consulta->fetch_assoc();
                while ($fila) {
                    echo "<tr>";
                    echo "<td>".$fila["CodPed"]."</td><td>".$fila["Correo"]."</td><td>".$fila["Nombre"]."</td><td>".$fila["Unidades"]."</td><td><form action='pedidos.php' method='GET'> <input type='number' class='cantidad' name='".$fila["CodPredProd"]."'> <input type='submit' class='añadir' name='añadir' value='Añadir'> <input type='submit' name='quitar' class='quitar' value='Quitar'> <input type='submit' name='eliminar' class='eliminar' value='Eliminar'></form></td>";
                    echo "</tr>";
                    $fila = $consulta->fetch_assoc();
                }
                echo "</table>";
                if ($_SESSION["añadidos"]==true) {
                    echo "<br><br>";
                    echo "<form id='notificacion' action='pedidos.php' method='POST'>";
                    echo "<h1>Se han añadido unidades</h1>";
                    echo "<br>";
                    echo "<input type='submit' name='aceptar' value='Confirmar' id='aceptar'>";
                    $_SESSION["añadidos"] = false;
                }
                if ($_SESSION["quitados"]==true) {
                    echo "<br><br>";
                    echo "<form id='notificacion' action='pedidos.php' method='POST'>";
                    echo "<h1>Se han quitado unidades</h1>";
                    echo "<br>";
                    echo "<input type='submit' name='aceptar' value='Confirmar' id='aceptar'>";
                    $_SESSION["quitados"] = false;
                }
                if ($insuficientes == true) {
                    echo "<br><br>";
                    echo "<form id='notificacion' action='pedidos.php' method='POST'>";
                    echo "<h1>No hay suficientes unidades para añadir</h1>";
                    echo "<br>";
                    echo "<input type='submit' name='aceptar' value='Confirmar' id='aceptar'>";
                    $insuficientes = false;
                }
                if ($demasiados == true) {
                    echo "<br><br>";
                    echo "<form id='notificacion' action='pedidos.php' method='POST'>";
                    echo "<h1>Demasiadas unidades para retirar del pedido</h1>";
                    echo "<br>";
                    echo "<input type='submit' name='aceptar' value='Confirmar' id='aceptar'>";
                    $demasiados = false;
                }
                if (mysqli_num_rows($consulta)>0) {
                    echo "<a id='recibo' href='pdfPedidos.php'>Generar recibo</a>";
                    $_SESSION["hayPedido"] = "true";
                }
            }

        }
        ?>
    </body>
</html>