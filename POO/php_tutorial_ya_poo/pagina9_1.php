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

  public function insertar($cel,$fila,$columna)
  {
    $this->celdas[$fila][$columna]=$cel;
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

$tabla1=new Tabla(10,2);
$celda=new Celda('titulo 1','#356AA0','#FFFF88');
$tabla1->insertar($celda,1,1);
$celda=new Celda('titulo 2','#356AA0','#FFFF88');
$tabla1->insertar($celda,1,2);
for($f=2;$f<=10;$f++)
{
  $celda=new Celda('x','#0000ff','#eeeeee');
  $tabla1->insertar($celda,$f,1);
  $celda=new Celda('y','#0000ff','#eeeeee');
  $tabla1->insertar($celda,$f,2);
}
$tabla1->graficar();
?>
</body>
</html>