<?php

use function PHPSTORM_META\map;
session_start();
if (!isset($_SESSION["CodRes"])) {
    header("location: login.php");
}
?>
<html>
    <head>
        <title>Registrar categorias</title>
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
            h1 {
                text-align: center;
            }
            h2 {
                text-align: center;
            }
            form {
                text-align: justify;
                margin-left: 8em;
            }
            #crear {
                border: 1px solid black;
                border-radius: 1em;
                width: 35%;
                margin-left: 31%;
            }
            input {
                border-radius: 0.3em;
                margin-top: 1em;
                text-align: justify;
            }
            #confirmarCrear {
                padding: 0.5em;
                font-size: larger;
            }
            #confirmarActualizar {
                padding: 0.5em;
                font-size: larger;
            }
            #confirmarEliminar {
                padding: 0.5em;
                font-size: larger;
            }
            nav {
                margin-top: 4em;
                margin-right: 2em;
                text-align: justify;
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
                margin-left: 40%;
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
        </style>
    </head>
    <body>
        <p>Usuario: <?php echo $_SESSION["correo"]; ?> <a href="home.php">Home</a> <a href="ver_carrito.php">Ver_carrito</a> <a href="vaciar-carro.php">Vaciar_carrito</a> <a href="rexistroCategorias.php">Categorias</a> <a href="rexistroProdutos.php">Productos</a> <a href="rexistroUsuarios.php">Usuarios</a> <a href="pedidos.php">Pedidos</a> <a href="cerrarSesion.php">Cerrar_sesion</a></p>
        <br>
        <h1>Datos de las categorias</h1>
        <div id="crear">
            <form action="rexistroCategorias.php" method="POST">
                <label for="cod">Codigo </label>
                <?php
                if (isset($_GET["CodCat"])) { 
                    $cod = $_GET["CodCat"];
                    echo "<input type='text' name='cod' id='cod' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='text' name='cod' id='cod' value=''><br><br>";
                }
                ?>
                <label for="nombre">Nombre </label>
                <?php
                if (isset($_GET["Nombre"])) { 
                    $cod = $_GET["Nombre"];
                    echo "<input type='text' name='nombre' id='nombre' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='text' name='nombre' id='nombre' value=''><br><br>";
                }
                ?>
                <label for="descripcion">Descripcion </label>
                <?php
                if (isset($_GET["Descripcion"])) { 
                    $cod = $_GET["Descripcion"];
                    echo "<input type='text' name='descripcion' id='descripcion' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='text' name='descripcion' id='descripcion' value=''><br><br>";
                }
                ?>
                <?php
                if (isset($_GET["Activo"])) { 
                    $cod = $_GET["Activo"];
                    if ($cod==1) {
                        echo "<input type='checkbox' name='activo' id='activo' checked>";
                    } else {
                        echo "<input type='checkbox' name='activo' id='activo'>";
                    }
                } else {
                    echo "<input type='checkbox' name='activo' id='activo'>";
                }
                ?>
                <label for="activo">Activo </label><br><br>

                <input type="submit" value="Crear" id="confirmarCrear" name="crear">
                <input type="submit" value="Actualizar" id="confirmarActualizar" name="modificar">
                <input type="submit" value="Eliminar" id="confirmarEliminar" name="eliminar">
            </form>
        </div>
        <?php
        if (isset($_POST["crear"])&&isset($_POST["nombre"])&&isset($_POST["descripcion"])&&$_POST["nombre"]!=""&&$_POST["descripcion"]!="") {
            $cod = 0;
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "SELECT * FROM categorias";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $cod = mysqli_num_rows($consulta)+1;
                }
            }
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $activo = 0;
            if (isset($_POST["activo"])) {
                    if ($_POST["activo"]=="on") {
                        $activo = 1;
                    } else {
                        $activo = 0;
                    }
                }
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "INSERT INTO categorias (CodCat, Nombre, Descripcion, Activo) VALUES ('$cod', '$nombre', '$descripcion', '$activo')";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    header("location: rexistroCategorias.php");
                } else {
                    echo "<h2>No se ha podido crear la nueva categoria</h2>";
                }
            }
        }
        if (isset($_POST["modificar"])&&isset($_POST["cod"])&&isset($_POST["nombre"])&&isset($_POST["descripcion"])&&$_POST["nombre"]!=""&&$_POST["descripcion"]!="") {
            $cod = $_POST["cod"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $activo = 0;
            if (isset($_POST["activo"])) {
                if ($_POST["activo"]=="on") {
                    $activo = 1;
                } else {
                    $activo = 0;
                }
            }
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "UPDATE categorias SET Nombre='$nombre', Descripcion='$descripcion', Activo='$activo' WHERE CodCat='$cod'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    header("location: rexistroCategorias.php");
                } else {
                    echo "<h2>No se ha podido modificar la categoria</h2>";
                }
            }
        }
        if (isset($_POST["eliminar"])&&isset($_POST["cod"])) {
            $cod = $_POST["cod"];
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $productos = [];
                $pedidosproductos = [];
                $pedidos = [];
                $sql = "SELECT CodProd FROM productos WHERE CodCat='$cod'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    while ($fila) {
                        array_push($productos, $fila["CodProd"]);
                        $fila = $consulta->fetch_assoc();
                    }
                }
                if (sizeof($productos)>0) {
                    foreach ($productos as $valor) {
                        $sql = "SELECT CodPed FROM pedidosproductos WHERE CodProd='$valor'";
                        $consulta = mysqli_query($conexion, $sql);
                        if ($consulta) {
                            $fila = $consulta->fetch_assoc();
                            while ($fila) {
                                array_push($pedidos, $fila["CodPed"]);
                                $fila = $consulta->fetch_assoc();
                            }
                        }
                        $sql = "DELETE FROM pedidosproductos WHERE CodProd='$valor'";
                        $consulta = mysqli_query($conexion, $sql);
                        if ($consulta) {
                            $sql = "DELETE FROM productos WHERE CodProd='$valor'";
                            $consulta = mysqli_query($conexion, $sql);
                        }
                    }
                    foreach ($pedidos as $valor) {
                        $sql = "DELETE FROM pedidos WHERE CodPed='$valor'";
                        $consulta = mysqli_query($conexion, $sql);
                    }
                }
                $sql = "DELETE FROM categorias WHERE CodCat='$cod'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    header("location: rexistroCategorias.php");
                } else {
                    echo "<h2>No se ha podido eliminar la categoria</h2>";
                }
            }
        }
        ?>
        <nav>
            <?php
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "SELECT * FROM categorias";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila=$consulta->fetch_assoc();
                    
                    echo "<ul>";
                    echo "<li id='lista'>Lista de categorias</li>";
                    while ($fila) {
                        if ($fila["Activo"]==1){
                            echo "<li id='datos".$fila["Nombre"]."' class='menu'><a href='rexistroCategorias.php?CodCat=".$fila["CodCat"]."&Nombre=".$fila["Nombre"]."&Descripcion=".$fila["Descripcion"]."&Activo=".$fila["Activo"]."'>".$fila["CodCat"]."➭".$fila["Nombre"]."</a></li>";
                        } else {
                            echo "<li id='datos".$fila["Nombre"]."' class='menu'><a href='rexistroCategorias.php?CodCat=".$fila["CodCat"]."&Nombre=".$fila["Nombre"]."&Descripcion=".$fila["Descripcion"]."&Activo=".$fila["Activo"]."'><del>".$fila["CodCat"]."➭".$fila["Nombre"]."</del></a></li>";
                        }
                        $fila = $consulta->fetch_assoc();
                    }
                    echo "</ul>";
                }
            }
            ?>
        </nav>
    </body>
</html>
