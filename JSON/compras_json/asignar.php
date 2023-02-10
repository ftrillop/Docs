<?php
/*
Recibe por GET cantidad
Si recibe item por GET
Si la cantidad es 0 se asigna a 0
Si la cantidad es positiva se incrementa
Si la cantidad es negativa se resta, hasta 0 como mínimo
Si no recibe item por GET y la cantidad es igual a 0
hace un reset (cantidad a 0) de todos los elementos
*/
require('config.php');
if (isset($_GET['cantidad'])) {
$cantidad=$_GET['cantidad'];
if(preg_match("/^-?\d+$/",$cantidad)) {
if(isset($_GET['item'])) {
$item=$_GET['item'];
if(preg_match($erItem,$item)) {
if(array_key_exists($item,$datos) && $cantidad!=0)
$datos[$item]+=$cantidad;
else
$datos[$item]=$cantidad;
if($datos[$item]<0) $datos[$item]=0;
guardar_datos($datos, $rutaDatos);
}
}
else // No viene ningún item por GET
if ($cantidad==0) { // es un reset de todas las cantidades
foreach($datos as $item=>$cantidad)
$datos[$item]=0;
guardar_datos($datos, $rutaDatos);
}
}
}
header("Location:.?$paramVerTodo");