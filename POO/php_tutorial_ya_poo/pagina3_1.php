<html>
<head>
<title>Pruebas</title>
</head>
<body>
<?php
class CabeceraPagina {
  private $titulo;
  private $ubicacion;
  private $colorFuente;
  private $colorFondo;
  public function inicializar($tit,$ubi,$colorFuen,$colorFon)
  {
    $this->titulo=$tit;
    $this->ubicacion=$ubi;
    $this->colorFuente=$colorFuen;
    $this->colorFondo=$colorFon;
  }
  public function graficar()
  {
    echo '<div style="font-size:40px;text-align:'.$this->ubicacion.';color:';
    echo $this->colorFuente.';background-color:'.$this->colorFondo.'">';
    echo $this->titulo;
    echo '</div>';
  }
}
//<div style="font-size:40px;text-align:center;color:#FF1A00;background-color:#CDEB8B">El blog del programador</div></body>

$cabecera=new CabeceraPagina();
$cabecera->inicializar('El blog del programador','center','#FF1A00','#CDEB8B');
$cabecera->graficar();
?>
</body>
</html>