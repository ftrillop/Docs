<?php
$servidorBD="localhost";
$usuarioBD="root";
$passwordBD="";
$nombreBD="mensaxes";
@$con=new mysqli($servidorBD,$usuarioBD,$passwordBD,$nombreBD);
if ($con->connect_error)
die("Erro na conexión<br>" . $con->connect_error);
$con->set_charset('UTF8');
?>