<html>
<head>
<title>Pruebas</title>
</head>
<body>
<?php
abstract class Persona {
  protected $nombre;
  protected $edad;
  public function cargarDatosPersonales($nom,$ed)
  {
    $this->nombre=$nom;
    $this->edad=$ed;
  }
  public function imprimirDatosPersonales()
  {
    echo 'Nombre:'.$this->nombre.'<br>';
    echo 'Edad:'.$this->edad.'<br>';
  }
}

class Empleado extends Persona{
  protected $sueldo;
  public function cargarSueldo($su)
  {
    $this->sueldo=$su;
  }
  public function imprimirSueldo()
  {
    echo 'Sueldo:'.$this->sueldo.'<br>';
  }
}

//Desmarcar para ver el error producido por la definición de un 
//objeto de una clase abstracta.
//$persona1=new Persona();
//$persona1->cargarDatosPersonales('Rodriguez Pablo',24);
//echo 'Datos personales de la persona:<br>';
//$persona1->imprimirDatosPersonales();
$empleado1=New Empleado();
$empleado1->cargarDatosPersonales('Gonzalez Ana',32);
$empleado1->cargarSueldo(2400);
echo 'Datos personales y sueldo del empleado:<br>';
$empleado1->imprimirDatosPersonales();
$empleado1->imprimirSueldo();
?>
</body>
</html>