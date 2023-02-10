<?php
session_name('MENSAJES');
session_start();
if(!isset($_SESSION["usuario"])) fuera();
$usuarioSesion=$_SESSION["usuario"];
$codGrupoSesion=$_SESSION["codGrupo"];
$nombreGrupoSesion=$_SESSION["nombreGrupo"];
function fuera() {
header("Location:cerrarSesion.php");
exit();
}