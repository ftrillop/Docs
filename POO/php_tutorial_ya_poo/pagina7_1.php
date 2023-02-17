<html>
<head>
<title>Pruebas</title>
</head>
<body>
<?php
class Menu {
  private $enlaces=array();
  private $titulos=array();
  public function cargarOpcion($en,$tit)
  {
    $this->enlaces[]=$en;
    $this->titulos[]=$tit;
  }
  private function mostrarHorizontal()
  {
    for($f=0;$f<count($this->enlaces);$f++)
    {
      echo '<a href="'.$this->enlaces[$f].'">'.$this->titulos[$f].'</a>';
      echo "-";
    }
  }
  private function mostrarVertical()
  {
    for($f=0;$f<count($this->enlaces);$f++)
    {
      echo '<a href="'.$this->enlaces[$f].'">'.$this->titulos[$f].'</a>';
      echo "<br>";
    }
  }
  
  public function mostrar($orientacion)
  {
    if (strtolower($orientacion)=="horizontal")
      $this->mostrarHorizontal();
    if (strtolower($orientacion)=="vertical")
      $this->mostrarVertical();
  }
}

$menu1=new Menu();
$menu1->cargarOpcion('http://www.lanacion.com.ar','La Nación');
$menu1->cargarOpcion('http://www.clarin.com.ar','El Clarín');
$menu1->cargarOpcion('http://www.lavoz.com.ar','La Voz del Interior');
$menu1->mostrar("horizontal");
echo '<br>';
$menu2=new Menu();
$menu2->cargarOpcion('http://www.google.com','Google');
$menu2->cargarOpcion('http://www.yahoo.com','Yhahoo');
$menu2->cargarOpcion('http://www.msn.com','MSN');
$menu2->mostrar("vertical");
?>
</body>
</html>