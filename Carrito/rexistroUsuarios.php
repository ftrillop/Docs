<?php
session_start();
if (!isset($_SESSION["CodRes"])) {
    header("location: login.php");
}
?>
<html>
    <head>
        <title>Registrar usuarios</title>
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
        <h1>Datos de los usuarios</h1>
        <div id="crear">
            <form action="rexistroUsuarios.php" method="POST">
                <label for="cod">Codigo del usuario </label>
                <?php
                if (isset($_GET["CodRes"])) { 
                    $cod = $_GET["CodRes"];
                    echo "<input type='text' name='cod' id='cod' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='text' name='cod' id='cod' value=''><br><br>";
                }
                ?>
                <label for="correo">Nombre del usuario </label>
                <?php
                if (isset($_GET["Correo"])) { 
                    $cod = $_GET["Correo"];
                    echo "<input type='text' name='correo' id='correo' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='text' name='correo' id='correo' value=''><br><br>";
                }
                ?>
                <label for="clave">Clave del usuario </label>
                <?php
                if (isset($_GET["Clave"])) { 
                    $cod = $_GET["Clave"];
                    echo "<input type='password' name='clave' id='clave' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='password' name='clave' id='clave' value=''><br><br>";
                }
                ?>
                <label for="pais">Pais </label>
                <?php
                if (isset($_GET["Pais"])) {
                    $cod = $_GET["Pais"];
                    echo "<input type='text' name='pais' id='pais' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='text' name='pais' id='pais' value=''><br><br>";
                }
                ?>
                <label for="cp">CP </label>
                <?php
                if (isset($_GET["CP"])) {
                    $cod = $_GET["CP"];
                    echo "<input type='number' name='cp' id='cp' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='number' name='cp' id='cp' value=''><br><br>";
                }
                ?>
                <label for="ciudad">Ciudad </label>
                <?php
                if (isset($_GET["Ciudad"])) { 
                    $cod = $_GET["Ciudad"];
                    echo "<input type='text' name='ciudad' id='ciudad' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='text' name='ciudad' id='ciudad' value=''><br><br>";
                }
                ?>
                <label for="direccion">Direccion </label>
                <?php
                if (isset($_GET["Direccion"])) { 
                    $cod = $_GET["Direccion"];
                    echo "<input type='text' name='direccion' id='direccion' value='".$cod."'><br><br>";
                } else {
                    echo "<input type='text' name='direccion' id='direccion' value=''><br><br>";
                }
                ?>

                <input type="submit" value="Crear" id="confirmarCrear" name="crear">
                <input type="submit" value="Actualizar" id="confirmarActualizar" name="modificar">
                <input type="submit" value="Eliminar" id="confirmarEliminar" name="eliminar">
            </form>
        </div>
        <?php
        if (isset($_POST["crear"])&&isset($_POST["correo"])&&isset($_POST["clave"])&&$_POST["correo"]!=""&&$_POST["clave"]!=""&&isset($_POST["pais"])&&isset($_POST["cp"])&&isset($_POST["direccion"])) {
            $cod = 0;
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "SELECT * FROM restaurantes";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $cod = mysqli_num_rows($consulta)+1;
                }
            }
            $correo = $_POST["correo"];
            $clave = $_POST["clave"];
            $pais = $_POST["pais"];
            $cp = $_POST["cp"];
            $ciudad = $_POST["ciudad"];
            $direccion = $_POST["direccion"];

            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "INSERT INTO restaurantes (CodRes, Correo, Clave, Pais, CP, Ciudad, Direccion) VALUES ('$cod', '$correo', '$clave', '$pais', '$cp', '$ciudad', '$direccion')";
                $consulta = mysqli_query($conexion, $sql);
                if (!$consulta) {
                    echo "<h2>No se ha podido dar de alta el usuario</h2>";
                }
            }
        }
        if (isset($_POST["modificar"])&&isset($_POST["cod"])&&isset($_POST["correo"])&&isset($_POST["clave"])&&$_POST["correo"]!=""&&$_POST["clave"]!=""&&isset($_POST["pais"])&&isset($_POST["cp"])&&isset($_POST["ciudad"])&&isset($_POST["direccion"])) {
            $cod = $_POST["cod"];
            $correo = $_POST["correo"];
            $clave = $_POST["clave"];
            $pais = $_POST["pais"];
            $cp = $_POST["cp"];
            $ciudad = $_POST["ciudad"];
            $direccion = $_POST["direccion"];

            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "UPDATE restaurantes SET Correo='$correo', Clave='$clave', Pais='$pais', CP='$cp', Ciudad='$ciudad', Direccion='$direccion' WHERE CodRes='$cod'";
                $consulta = mysqli_query($conexion, $sql);
                if (!$consulta) {
                    echo "<h2>No se ha podido modificar el usuario</h2>";
                }
            }
        }
        if (isset($_POST["eliminar"])&&isset($_POST["cod"])) {
            $cod = $_POST["cod"];
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $pedidos = [];
                $sql = "SELECT CodPed FROM pedidos WHERE Restaurante='$cod'";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila = $consulta->fetch_assoc();
                    while ($fila) {
                        array_push($pedidos, $fila["CodPed"]);
                        $fila = $consulta->fetch_assoc();
                    }
                }
                if (sizeof($pedidos)>0) {
                    foreach ($pedidos as $valor) {
                        $sql = "DELETE FROM pedidosproductos WHERE CodPed='$valor'";
                        $consulta = mysqli_query($conexion, $sql);
                        $sql = "DELETE FROM pedidos WHERE CodPed='$valor'";
                        $consulta = mysqli_query($conexion, $sql);
                    }
                }
                $sql = "DELETE FROM restaurantes WHERE CodRes='$cod'";
                $consulta = mysqli_query($conexion, $sql);
                if (!$consulta) {
                    echo "<h2>No se ha podido eliminar el usuario</h2>";
                }
            }
        }
        ?>
        <nav>
            <?php
            $conexion = new mysqli("127.0.0.1", "root", "", "pedidos");
            if ($conexion) {
                $sql = "SELECT * FROM restaurantes";
                $consulta = mysqli_query($conexion, $sql);
                if ($consulta) {
                    $fila=$consulta->fetch_assoc();
                    
                    echo "<ul>";
                    echo "<li id='lista'>Lista de usuarios</li>";
                    while ($fila) {
                        echo "<li id='datos".$fila["CodRes"]."' class='menu'><a href='rexistroUsuarios.php?CodRes=".$fila["CodRes"]."&Correo=".$fila["Correo"]."&Clave=".$fila["Clave"]."&Pais=".$fila["Pais"]."&CP=".$fila["CP"]."&Ciudad=".$fila["Ciudad"]."&Direccion=".$fila["Direccion"]."'>".$fila["CodRes"]."➭".$fila["Correo"]."</a></li>";
                        $fila = $consulta->fetch_assoc();
                    }
                    echo "</ul>";
                }
            }
            ?>
        </nav>
    </body>
</html>