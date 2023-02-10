<?php
    function haySession() {
        return isset($_SESSION["nombre"])&&isset($_SESSION["apellidos"])&&isset($_SESSION["color_fondo"])&&isset($_SESSION["color_letra"])&&isset($_SESSION["tipo_letra"]);
    }
    function hayGet() {
        return isset($_GET["nombre"])&&isset($_GET["apellidos"])&&isset($_GET["color_fondo"])&&isset($_GET["color_letra"])&&isset($_GET["tipo_letra"]);
    }
?>