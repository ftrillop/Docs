<?php
session_start();
include_once("db.php");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$result_usuario = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado_usuario = mysqli_query($conectar, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CRUD - Editar</title>		
	</head>
	<body>
		<a href="registrar_usuario.php">Registrar</a><br>
		<a href="index.php">Listar</a><br>
		<h1>Editar Usuario</h1>
		<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
		<form method="POST" action="proceso_editar_usuario.php">
			<input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>">
			
			<label>Nome: </label>
			<input type="text" name="nombres" placeholder="Digite nombres completos" value="<?php echo $row_usuario['nombres']; ?>"><br><br>
			
			<label>E-mail: </label>
			<input type="email" name="email" placeholder="Digite su e-mail" value="<?php echo $row_usuario['email']; ?>"><br><br>
			
			<input type="submit" value="Editar registro">
		</form>
	</body>
</html>