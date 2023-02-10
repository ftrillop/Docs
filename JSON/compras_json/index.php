<?php
require ('config.php');
?>
<!DOCTYPE html>
<html>
<head>
<title><?=$titulo?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class='container'>
<h1 class='text-center'><?=$titulo?></h1>
<div class="row">
<table class='table table-bordered table-striped'>
<tr>
<th>Artículo</th>
<th>Cantidad</th>
<th colspan='2'class = 'text-center'>
<a href='?<?=$verTodo?'':'verTodo='?>' class='glyphicon glyphicon-eye-<?=$verTodo?'open':'close'?>'>
</th>
<th colspan='2'class = 'text-center'>
<a href='asignar.php?cantidad=0&<?=$paramVerTodo?>' class='glyphicon glyphicon-remove-circle'>
</th>
</tr>
<?php
$jsBorrar = 'return confirm("Desexa eliminar  o elemento?")';
foreach($datos as $item=>$cantidad):
if($cantidad>0 || $verTodo):
$param = "item=$item";
if($verTodo) $param .= "&$paramVerTodo";
?>
<tr>
<td><?=$item?></td>
<td><?=$cantidad?></td>
<td><a href='asignar.php?<?=$param?>&cantidad=1' class='glyphicon glyphicon-plus'></td>
<td><a href='asignar.php?<?=$param?>&cantidad=-1' class='glyphicon glyphicon-minus'></td>
<td><a href='asignar.php?<?=$param?>&cantidad=0' class='glyphicon glyphicon-remove-circle'></td>
<td><a href='borrar.php?<?=$param?>' onClick='<?=$jsBorrar?>' class='glyphicon glyphicon-trash'></td>
</tr>
<?php
endif;
endforeach;
?>
<tr>
<td>
<form class='form-inline' action='asignar.php'>
<input type='text' name='item' class='form-control' style='width:300px'>
<?php if($verTodo): ?> <input type='hidden' name='verTodo' value=''> <?php endif;?>
</td><td>
<div class='col-xs-6'><input type='number' name='cantidad' value='1' class='form-control'></div>
</td><td colspan='4'>
<div class='text-center'><input type='submit' value='+' class='btn btn-primary btn-sm'></div>
</td>
</form>
</table>
</div>
</div>
</body>
</html>

