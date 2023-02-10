<?php
if(isset($_POST['usuario'],$_POST['password'])) {
require("conexion.php");
$usuario=$con->real_escape_string($_POST["usuario"]);
$password=$con->real_escape_string($_POST["password"]);
$password=hash("SHA512",$password);
$sql="SELECT
usuarios.codGrupo AS codGrupoUsuario,
grupos.nombre AS nombreGrupo
FROM usuarios LEFT JOIN grupos USING (codGrupo)
WHERE usuario='$usuario' AND password='$password'";
$filas=$con->query($sql);
$fila=$filas->fetch_object();
$con->close();
if($fila) {
session_name('MENSAJES');
session_start();
$_SESSION["usuario"]=$usuario;
$_SESSION["codGrupo"]=$fila->codGrupoUsuario;
$_SESSION['nombreGrupo']=$fila->nombreGrupo;
header("Location:mensajes.php");
}
}
?>
<!DOCTYPE html>
<html lang='es'>
<head><title>Identificación</title></head>
<body>
<h1>Identificación</h1>
<form method="POST">
<input type='text' name='usuario' required='' placeholder='Usuario'>
<br>
<input type='password' name='password' required='' placeholder='Contrasinal'>
<br>
<button type="submit">Entrar</button>
<span style='color: red'>
<?php if(isset($sql)) echo "Erro na autentificación"; ?>
</span>
</form>
</body>
</html>