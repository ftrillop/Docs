<?php
require 'autentificacion.php';
require 'conexion.php';
$error=''; $altavoz="\u{1F4E3}"; $eliminar="\u{274C}";
if(isset($_POST['mensaje'])) {
$mensaje=$con->real_escape_string(strip_tags($_POST['mensaje']));
$codGrupo=isset($_POST['todos'])?'NULL':$codGrupoSesion;
$sql="INSERT INTO mensajes (mensaje,usuario,codGrupo)
VALUES ('$mensaje','$usuarioSesion',$codGrupo)";
$con->query($sql);
if($con->affected_rows!=1) $error='Problemas insertando o mensaxe';
}
?>
<!DOCTYPE html>
<html><head><title>Mensaxes de <?=$nombreGrupoSesion?></title></head>
<body>
<h1>Mensaxes de <?=$nombreGrupoSesion?></h1>
<a href='cerrarSesion.php'><?=$usuarioSesion?></a>
<p style='color:red'><?=$error?></p>
<FORM METHOD='POST'>
<input type='text' name='mensaje' required='' placeholder='Mensaje'>
<label for='todos'>A todos</label>
<input type='checkbox' name='todos' id='todos'>
<input type='submit' value='Publicar'>
</FORM>
<hr>
<?php
$sql="SELECT * FROM mensajes WHERE codGrupo=$codGrupoSesion
OR codGrupo IS NULL ORDER BY codGrupo ASC,fecha ASC";
$mensajes=$con->query($sql);
if($mensajes->num_rows>0):?>
<TABLE>
<TR><TH>Fecha</TH><TH>Usuario</TH><TH>Mensaje</TH><TH></TH></TR>
<?php while($mensaje=$mensajes->fetch_object()):?>
<TR>
<TD><?=date('j/n G:i',strtotime($mensaje->fecha))?></TD>
<TD><?=$mensaje->usuario?></TD>
<TD>
<?=is_null($mensaje->codGrupo)?$altavoz:''?>
<?=$mensaje->mensaje?>
</TD>
<TD>
<?php if($mensaje->usuario==$usuarioSesion):?>
<a href='eliminarMensaje.php?codMensaje=<?=$mensaje->codMensaje?>'
onClick='return confirm("¿ Eliminar mensaje ?")'><?=$eliminar?></a>
<?php endif?>
</TD>
</TR>
<?php endwhile;?>
</TABLE>
<?php else:?>
No hay mensajes
<?php endif;?>
</body></html>