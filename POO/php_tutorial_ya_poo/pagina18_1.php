<html>
<head>
<title>Pruebas</title>
</head>
<body>
<?php

class Cuadrado {
  private $lado;
  public function cargarLado($la)
  {
    $this->lado=$la;
  }
  public function retornarPerimetro()
  {
    $p=$this->lado*4;
    return $p;
  }
  public function retornarSuperficie()
  {
    $s=$this->lado*$this->lado;
    return $s;
  }
}

$cuadrado1=new Cuadrado();
$cuadrado1->cargarLado(5);
$x=$cuadrado1;
echo 'La superficie del cuadrado de lado 5 es:'.$x->retornarSuperficie().'<br>';
echo 'El perímetro del cuadrado de lado 5 es:'.$x->retornarPerimetro().'<br>';

?>
</body>
</html>