<?php
session_start();
include_once("db.php");

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nombres = filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);


$result_usuario = "UPDATE usuarios SET nombres='$nombres', email='$email', modificado=NOW() WHERE id='$id'";
$resultado_usuario = mysqli_query($conectar, $result_usuario);

if(mysqli_affected_rows($conectar)){
	$_SESSION['msg'] = "<p style='color:green;'>Usuario editado con exito</p>";
	header("Location: index.php");
}else{
	$_SESSION['msg'] = "<p style='color:red;'>Hubo un error al editar usuario</p>";
	header("Location: editar_usuario.php?id=$id");
}
