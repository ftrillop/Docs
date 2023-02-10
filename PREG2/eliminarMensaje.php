<?php
require 'autentificacion.php';
require 'conexion.php';
if(!isset($_GET['codMensaje'])) fuera();
$codMensaje=$_GET['codMensaje'];
if(!preg_match('/^\d+$/',$codMensaje)) fuera();
$sql="DELETE FROM mensajes WHERE codMensaje=$codMensaje
AND usuario='$usuarioSesion'";
$con->query($sql);
header('Location:mensajes.php');