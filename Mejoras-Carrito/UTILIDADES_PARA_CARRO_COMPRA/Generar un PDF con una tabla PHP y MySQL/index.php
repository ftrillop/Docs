<?php
include "Conexion.php";
$db =  connect();
$query=$db->query("select * from clientes");
$clientes = array();
$n=0;
while($r=$query->fetch_object()){ $clientes[]=$r; $n++;}

?>
<!DOCTYPE html>
<html>
<head>

<title>Generar PDF con jsPDF con AutoTable</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="jspdf/dist/jspdf.min.js"></script>
<script src="js/jspdf.plugin.autotable.min.js"></script>
<meta charset="utf-8">
</head>
<body>
<br>
 <div class="container">
<div class="panel panel-default">


<nav class="navbar navbar-default">
 
    <!-- Extra para moviles mostrar -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./">DAWPHP</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="./">INICIO <span class="sr-only">(current)</span></a></li>
      </ul>

    </div><!-- /.navbar-collapse -->
  
</nav>


<div class="panel-body">

<div class="row">
<div class="col-md-12">

<h1>Crear un PDF con una Tabla</h1>
<br>
</div>
<div class="col-md-12"><br></div>


<div class="col-md-4">
<p><strong>Creando PDF con JavaScript.</strong></p>
<button id="GenerarPDF" class="btn btn-default">Crear PDF</button>
<br>
</div>

<div class="col-md-4">
<p><strong>Ejemplo usando PHP y MySQL.</strong></p>
<button id="GenerarMysql" class="btn btn-default">Crear PDF MySQL</button>
<br>
</div>

<div class="col-md-4"></div>

</div>

</div>

 <div class="panel-footer"><p>Códigos <a href="https://www.GOOGLE.com/" target="_blank">daw2023</a></p></div>
</div><!-- /.Cierra-default-panel -->
</div><!-- /.container-fluid -->

<script>
$("#GenerarPDF").click(function(){
  var pdf = new jsPDF();
  pdf.text(20,20,"Mostrando una Tabla con JsPDF");

  var columns = ["Id", "Nombre", "Email", "Pais"];
  var data = [
      [1, "Carlos", "009@gmail.com", "Mexico"],
      [2, "Miguel",  "888@hotmail.com", "Brasil"],
      [3, "Jorge", "jorge@yandex.com", "Ecuador"],
      [3, "mario", "mario@yandex.com", "Colombia"],
  ];

  pdf.autoTable(columns,data,
    { margin:{ top: 25  }}
  );

  pdf.save('MiTabla.pdf');

});
</script>

<script>
$("#GenerarMysql").click(function(){
  var pdf = new jsPDF();
  pdf.text(20,20,"Mostrando una Tabla con PHP y MySQL");

  var columns = ["Id", "Nombres", "Apellidos", "Telefono", "Edad"];
  var data = [
<?php foreach($clientes as $c):?>
 [<?php echo $n; ?>, "<?php echo $c->nombres; ?>", "<?php echo $c->apellidos; ?>", "<?php echo $c->telefono; ?>", "<?php echo $c->edad; ?>"],
<?php endforeach; ?>  
  ];

  pdf.autoTable(columns,data,
    { margin:{ top: 25  }}
  );

  pdf.save('MiTabla.pdf');

});
</script>

</body>
</html>