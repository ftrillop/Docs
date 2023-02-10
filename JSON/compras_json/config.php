<?php
$titulo = "Compras do Departamento";
$rutaDatos = 'datos.json';
$erItem = '/^[^\"\';]+$/i';
$datos = leer_datos();
$verTodo = isset($_GET['verTodo']);
$paramVerTodo = $verTodo?'verTodo=':'';
function leer_datos() {
global $rutaDatos;
$json = '{}';
if(file_exists($rutaDatos))
$json = file_get_contents($rutaDatos);
$datos = json_decode($json,true);
ksort($datos);
return $datos;
}
function guardar_datos($datos) {
global $rutaDatos;
file_put_contents($rutaDatos,json_encode($datos));
}