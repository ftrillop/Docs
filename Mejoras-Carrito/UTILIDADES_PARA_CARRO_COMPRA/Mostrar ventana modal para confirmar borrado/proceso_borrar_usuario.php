<?php
session_start();
include_once("db.php");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)){
	$result_usuario = "DELETE FROM usuarios WHERE id='$id'";
	$resultado_usuario = mysqli_query($conectar, $result_usuario);
	if(mysqli_affected_rows($conectar)){
		$_SESSION['msg'] = "<p style='color:green;'>Cliente borrado con exito</p>";
		header("Location: index.php");
	}else{
		
		$_SESSION['msg'] = "<p style='color:red;'>Error al borrar cliente</p>";
		header("Location: index.php");
	}
}else{	
	$_SESSION['msg'] = "<p style='color:red;'>Es necesario seleccionar un cliente</p>";
	header("Location: index.php");
}
