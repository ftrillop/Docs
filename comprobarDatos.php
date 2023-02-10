<?php
    function haycookies() {
        return isset($_COOKIE["nombre"])&&isset($_COOKIE["apellidos"])&&isset($_COOKIE["color_fondo"])&&isset($_COOKIE["color_letra"])&&isset($_COOKIE["tipo_letra"]);
    }
    function hayGet() {
        return isset($_GET["nombre"])&&isset($_GET["apellidos"])&&isset($_GET["color_fondo"])&&isset($_GET["color_letra"])&&isset($_GET["tipo_letra"]);
    }
?>