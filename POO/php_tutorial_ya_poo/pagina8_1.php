<html>
<head>
<title>Pruebas</title>
</head>
<body>
<?php
class Celda {
  private $texto;
  private $colorFuente;
  private $colorFondo;
  function __construct($tex,$cfue,$cfon)
  {
    $this->texto=$tex;
    $this->colorFuente=$cfue;
    $this->colorFondo=$cfon;
  }
  public function graficar()
  {
   echo '<td style="color:'.$this->colorFuente.';background-color:'.$this->colorFondo.'">'.$this->texto.'</td>';
  }
}

class Tabla {
  private $celdas=array();
  private $cantFilas;
  private $cantColumnas;

  public function __construct($fi,$co)
  {
    $this->cantFilas=$fi;
    $this->cantColumnas=$co;
  }

  public function cargar($fila,$columna,$valor,$cfue,$cfon)
  {
    $this->celdas[$fila][$columna]=new Celda($valor,$cfue,$cfon);
  }

  private function inicioTabla()
  {
    echo '<table border="1">';
  }

  private function inicioFila()
  {
    echo '<tr>';
  }

  private function mostrar($fi,$co)
  {
     $this->celdas[$fi][$co]->graficar(); 
  }

  private function finFila()
  {
    echo '</tr>';
  }

  private function finTabla()
  {
    echo '</table>';
  }

  public function graficar()
  {
    $this->inicioTabla();
    for($f=1;$f<=$this->cantFilas;$f++)
    {
      $this->inicioFila();
      for($c=1;$c<=$this->cantColumnas;$c++)
      {
         $this->mostrar($f,$c);
      }
      $this->finFila();
    }
    $this->finTabla();
  }
}

$tabla1=new Tabla(10,3);
$tabla1->cargar(1,1,"titulo 1","#356AA0","#FFFF88");
$tabla1->cargar(1,2,"titulo 2","#356AA0","#FFFF88");
$tabla1->cargar(1,3,"titulo 3","#356AA0","#FFFF88");
for($f=2;$f<=10;$f++)
{
  $tabla1->cargar($f,1,"x","#0000ff","#EEEEEE");
  $tabla1->cargar($f,2,"x","#0000ff","#EEEEEE");
  $tabla1->cargar($f,3,"x","#0000ff","#EEEEEE");
}
$tabla1->graficar();
?>
</body>
</html>