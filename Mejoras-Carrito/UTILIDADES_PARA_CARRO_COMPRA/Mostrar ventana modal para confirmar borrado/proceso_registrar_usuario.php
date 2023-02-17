<?php
session_start();
include_once("db.php");

$nombres = filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

$result_usuario = "INSERT INTO usuarios (nombres, email, creado) VALUES ('$nombres', '$email', NOW())";
$resultado_usuario = mysqli_query($conectar, $result_usuario);

if(mysqli_insert_id($conectar)){
	$_SESSION['msg'] = "<p style='color:green;'>Usuario registrado con exito</p>";
	header("Location: index.php");
}else{
	$_SESSION['msg'] = "<p style='color:red;'>Usuario no ha sido registrado</p>";
	header("Location: registro_usuario.php");
}
