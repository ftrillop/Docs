<html>
<head>
<title>Pruebas</title>
</head>
<body>
<?php
class Persona {
  private $nombre;
  public function inicializar($nom)
  {
    $this->nombre=$nom;
  }
  public function imprimir()
  {
    echo $this->nombre;
    echo '<br>';
  }
}

$per1=new Persona();
$per1->inicializar('Juan');
$per1->imprimir();
$per2=new Persona();
$per2->inicializar('Ana1');
$per2->imprimir();
$per3=new Persona();
$per3->inicializar('2222222');
$per3->imprimir();
?>
</body>
</html>