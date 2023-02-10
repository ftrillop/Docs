<?php
session_start();

if (isset($_SESSION["usuario"])&&isset($_SESSION["password"])) {
    if ($_SESSION["usuario"] != "admin" || $_SESSION["password"] != "123456") {
        header("location: practica3-autentificacion.php");
    }
}
?>
<html>
    <head>
        <title>Pagina restringida</title>
    </head>
    <body>
    <h1>Página restrinxida</h1>
    <a href="practica3-borrar.php">Iniciar sesion</a>
    </body>
</html>