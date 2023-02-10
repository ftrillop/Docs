<?php
require ('config.php');
if(isset($_GET['item'])) {
$item=$_GET['item'];
if(preg_match($erItem,$item))
if(array_key_exists($item,$datos)) {
unset($datos[$item]);
guardar_datos($datos, $rutaDatos);
}
}
header("Location:.?$paramVerTodo");